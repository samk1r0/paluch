<?php namespace Depcore\Tools\Components;

use Cms\Classes\ComponentBase;
use Depcore\Tools\Models\Tool;

class ToolList extends ComponentBase
{

    public $tools;

    public function componentDetails()
    {
        return [
            'name'        => 'depcore.tools::lang.components.toollist.name',
            'description' => 'depcore.tools::lang.components.toollist.new_description'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun(){
        $this->tools = Tool::all();
    }
}