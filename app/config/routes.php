<?php

namespace App\Config;

final class Routes {

    public static function get() {
        return [
            'User' => [
                [
                    'route' => '/users',
                    'class' => 'Collection',
                    'method' => 'get'
                ],
                [
                    'route' => '/user/create',
                    'class' => 'Create',
                    'method' => 'post'
                ],
                [
                    'route' => '/user/update',
                    'class' => 'Update',
                    'method' => 'put'
                ],
                [
                    'route' => '/user/delete',
                    'class' => 'Delete',
                    'method' => 'delete'
                ]
            ]
        ];
    }

}