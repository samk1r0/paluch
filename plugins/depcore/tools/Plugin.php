<?php namespace Depcore\Tools;

use Backend;
use System\Classes\PluginBase;

/**
 * tools Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'depcore.tools::lang.plugin.name',
            'description' => 'depcore.tools::lang.plugin.description',
            'author'      => 'depcore',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Depcore\Tools\Components\ToolList' => 'ToolList',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'depcore.tools.create_tools' => [
                'tab' => 'depcore.tools::lang.plugin.name',
                'label' => 'depcore.tools::lang.permissions.some_permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'tools' => [
                'label'       => 'depcore.tools::lang.plugin.name',
                'url'         => Backend::url('depcore/tools/tools/index'),
                'icon'        => 'icon-wrench',
                'permissions' => ['depcore.tools.create_tools'],
                'order'       => 500,
                'sideMenu' => [
                    'Tools' => [
                        'label'       => 'depcore.tools::lang.plugin.name',
                        'icon'        => 'icon-wrench',
                        'url'         => Backend::url('depcore/tools/tools'),
                        'permissions' => ['depcore.tools.create_tools'],
                    ],
                    'Add tool' => [
                        'label' => 'depcore.tools::lang.tool.create_title',
                        'icon' => 'icon-plus',
                        'url' => Backend::url('depcore/tools/tools/create'),
                        'permissions' => ['depcore.tools.create_tools'],
                    ],
                ],
            ],
        ];
    }

}
