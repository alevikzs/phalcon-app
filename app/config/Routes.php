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
                    'route' => '/user',
                    'class' => 'Create',
                    'method' => 'post'
                ],
                [
                    'route' => '/user/{id}',
                    'class' => 'Update',
                    'method' => 'put'
                ],
                [
                    'route' => '/user/{id}',
                    'class' => 'Delete',
                    'method' => 'delete'
                ],
                [
                    'route' => '/user/{id}',
                    'class' => 'View',
                    'method' => 'get'
                ]
            ]
        ];
    }

}