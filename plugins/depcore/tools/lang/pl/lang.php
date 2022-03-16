<?php

return [
    'plugin' => [
        'name' => 'tools',
        'description' => 'Opis wtyczki',
        'fields' => [
            'name' => 'Nazwa Narzędzia',
            'description' => 'Opis Narzędzia'
        ],
    ],
    'permissions' => [
        'some_permission' => 'Przykład prawa dostępu',
    ],
    'tool' => [
        'new' => 'Nowy Tool',
        'label' => 'Tool',
        'create_title' => 'Utwórz Narzędzie',
        'update_title' => 'Edytuj Tool',
        'preview_title' => 'Podgląd Tool',
        'list_title' => 'Zarządzaj Tools',
    ],
    'tools' => [
        'delete_selected_confirm' => 'Usunąć zaznaczoną Tools?',
        'menu_label' => 'Tools',
        'return_to_list' => 'Powrót do listy Tools',
        'delete_confirm' => 'Na pewno usunąć zaznaczone Tool?',
        'delete_selected_success' => 'Pomyślnie usunięto zaznaczone Tools.',
        'delete_selected_empty' => 'Nie wybrano Tools do usunięcia.',
    ],
    'components' => [
        'toollist' => [
            'name' => 'Komponent ToolList',
            'description' => 'Nie dodano opisu',
            'new_description' => 'depcore.tools::lang.components.toollist.new_description',
        ],
    ],
];