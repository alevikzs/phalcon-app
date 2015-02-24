<?php

namespace App\Config;

class Routes {

    public static function get() {
        return [
            'User' => [
                [
                    'route' => '/users',
                    'action' => 'index',
                    'method' => 'get'
                ],
                [
                    'route' => '/user/create',
                    'action' => 'create',
                    'method' => 'post'
                ],
                [
                    'route' => '/user/update',
                    'action' => 'update',
                    'method' => 'put'
                ],
                [
                    'route' => '/user/delete',
                    'action' => 'delete',
                    'method' => 'delete'
                ]
            ]
        ];
    }

}