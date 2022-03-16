<?php

return [
    'plugin' => [
        'name' => 'tools',
        'description' => 'No description provided yet...',
        'fields' => [
            'name' => 'Tool name',
        ],
    ],
    'permissions' => [
        'some_permission' => 'Permission example',
    ],
    'tool' => [
        'new' => 'New Tool',
        'label' => 'Tool',
        'create_title' => 'Create Tool',
        'update_title' => 'Edit Tool',
        'preview_title' => 'Preview Tool',
        'list_title' => 'Manage Tools',
    ],
    'tools' => [
        'delete_selected_confirm' => 'Delete the selected Tools?',
        'menu_label' => 'Tools',
        'return_to_list' => 'Return to Tools',
        'delete_confirm' => 'Do you really want to delete this Tool?',
        'delete_selected_success' => 'Successfully deleted the selected Tools.',
        'delete_selected_empty' => 'There are no selected Tools to delete.',
    ],
    'components' => [
        'toollist' => [
            'name' => 'ToolList Component',
            'description' => 'No description provided yet...',
            'new_description' => 'depcore.tools::lang.components.toollist.new_description',
        ],
    ],
];