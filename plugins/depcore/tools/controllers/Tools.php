<?php namespace Depcore\Tools\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use Lang;
use Depcore\Tools\Models\tool;

/**
 * Tools Back-end Controller
 */
class Tools extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.ReorderController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Depcore.Tools', 'tools', 'tools');
    }

    /**
     * Deleted checked tools.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $toolId) {
                if (!$tool = tool::find($toolId)) continue;
                $tool->delete();
            }

            Flash::success(Lang::get('depcore.tools::lang.tools.delete_selected_success'));
        }
        else {
            Flash::error(Lang::get('depcore.tools::lang.tools.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}
