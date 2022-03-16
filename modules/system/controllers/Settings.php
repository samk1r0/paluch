<?php namespace System\Controllers;

use Lang;
use Flash;
use Backend;
use BackendMenu;
use System\Classes\SettingsManager;
use Backend\Classes\Controller;
use ApplicationException;
use Exception;

/**
 * Settings controller
 *
 * @package october\system
 * @author Alexey Bobkov, Samuel Georges
 *
 */
class Settings extends Controller
{
    /**
     * @var WidgetBase formWidget reference to the widget object
     */
    protected $formWidget;

    /**
     * @var array requiredPermissions to view this page
     */
    public $requiredPermissions = [];

    /**
     * __construct
     */
    public function __construct()
    {
        parent::__construct();

        if ($this->action == 'backend_preferences') {
            $this->requiredPermissions = ['backend.manage_preferences'];
        }

        $this->addCss('/modules/system/assets/css/settings/settings.css', 'core');

        BackendMenu::setContext('October.System', 'system', 'settings');
    }

    /**
     * index action
     */
    public function index()
    {
        $this->pageTitle = 'system::lang.settings.menu_label';
        $this->vars['items'] = SettingsManager::instance()->listItems('system');
        $this->bodyClass = 'compact-container sidenav-tree-expanded';
    }

    /**
     * mysettings action
     */
    public function mysettings()
    {
        BackendMenu::setContextSideMenu('mysettings');
        $this->pageTitle = 'backend::lang.mysettings.menu_label';
        $this->vars['items'] = SettingsManager::instance()->listItems('mysettings');
        $this->bodyClass = 'compact-container';
    }

    //
    // Generated Form
    //

    /**
     * update action
     */
    public function update($author, $plugin, $code = null)
    {
        SettingsManager::setContext($author.'.'.$plugin, $code);

        $this->vars['parentLink'] = Backend::url('system/settings');
        $this->vars['parentLabel'] = Lang::get('system::lang.settings.menu_label');

        try {
            if (!$item = $this->findSettingItem($author, $plugin, $code)) {
                throw new ApplicationException(Lang::get('system::lang.settings.not_found'));
            }

            $this->pageTitle = $item->label;

            if ($item->context == 'mysettings') {
                $this->vars['parentLink'] = Backend::url('system/settings/mysettings');
                $this->vars['parentLabel'] = Lang::get('backend::lang.mysettings.menu_label');
            }

            $model = $this->createModel($item);
            $this->initWidgets($model);
        }
        catch (Exception $ex) {
            $this->handleError($ex);
        }
    }

    /**
     * update_onSave AJAX handler
     */
    public function update_onSave($author, $plugin, $code = null)
    {
        $item = $this->findSettingItem($author, $plugin, $code);
        $model = $this->createModel($item);
        $this->initWidgets($model);

        $saveData = $this->formWidget->getSaveData();
        foreach ($saveData as $attribute => $value) {
            $model->{$attribute} = $value;
        }
        $model->save(null, $this->formWidget->getSessionKey());

        Flash::success(Lang::get('system::lang.settings.update_success', ['name' => Lang::get($item->label)]));

        /*
         * Handle redirect
         */
        if ($redirectUrl = post('redirect', true)) {
            $redirectUrl = ($item->context == 'mysettings')
                ? 'system/settings/mysettings'
                : 'system/settings';

            return Backend::redirect($redirectUrl);
        }
    }

    /**
     * update_onResetDefault AJAX handler
     */
    public function update_onResetDefault($author, $plugin, $code = null)
    {
        $item = $this->findSettingItem($author, $plugin, $code);
        $model = $this->createModel($item);
        $model->resetDefault();

        Flash::success(Lang::get('backend::lang.form.reset_success'));

        return Backend::redirect('system/settings/update/'.$author.'/'.$plugin.'/'.$code);
    }

    /**
     * formRender renders the form
     */
    public function formRender($options = [])
    {
        if (!$this->formWidget) {
            throw new ApplicationException(Lang::get('backend::lang.form.behavior_not_ready'));
        }

        return $this->formWidget->render($options);
    }

    /**
     * initWidgets prepare the widgets used by this action
     * @param Model $model
     */
    protected function initWidgets($model)
    {
        $config = $model->getFieldConfig();
        $config->model = $model;
        $config->arrayName = class_basename($model);
        $config->context = 'update';

        $widget = $this->makeWidget(\Backend\Widgets\Form::class, $config);
        $widget->bindToController();
        $this->formWidget = $widget;
    }

    /**
     * Internal method, prepare the list model object
     */
    protected function createModel($item)
    {
        if (!isset($item->class) || !strlen($item->class)) {
            throw new ApplicationException(Lang::get('system::lang.settings.missing_model'));
        }

        $class = $item->class;
        return $class::instance();
    }

    /**
     * Locates a setting item for a module or plugin
     */
    protected function findSettingItem($author, $plugin, $code)
    {
        $manager = SettingsManager::instance();

        $moduleOwner = $author;
        $moduleCode = $plugin;
        $item = $manager->findSettingItem($moduleOwner, $moduleCode);

        if (!$item) {
            $pluginOwner = $author . '.' . $plugin;
            $pluginCode = $code;
            $item = $manager->findSettingItem($pluginOwner, $pluginCode);
        }

        return $item;
    }
}
