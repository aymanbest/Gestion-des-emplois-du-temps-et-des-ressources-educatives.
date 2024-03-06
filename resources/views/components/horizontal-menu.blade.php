<div class="ui inverted menu">
    @include('components.dropdowns.dropdown', [
        'label' => 'Year',
        'id' => 'menu-year',
        'data' => [
            [
                'value' => 1,
                'name' => 2023
            ],
            [
                        'value' => 2,
                        'name' => 2024
            ]
        ]
    ])
    @include('components.dropdowns.dropdown', [
        'label' => 'Department',
        'id' => 'menu-department',
        'data' => [
            [
                'value' => 1,
                'name' => 2023
            ],
            [
                        'value' => 2,
                        'name' => 2024
            ]
        ]
    ])
    @include('components.dropdowns.dropdown', [
        'label' => 'Class',
        'id' => 'menu-class',
        'data' => [
            [
                'value' => 1,
                'name' => 2023
            ],
            [
                        'value' => 2,
                        'name' => 2024
            ]
        ]
    ])
</div>
