<?php

namespace App\Config;

/**
 * Class Routes
 * @package App\Config
 */
final class Routes {

    /**
     * @return array
     */
    public static function get() {
        return [
            'User' => [
                [
                    'route' => '/users',
                    'class' => 'Collection',
                    'method' => 'POST'
                ],
                [
                    'route' => '/user',
                    'class' => 'Create',
                    'method' => 'POST'
                ],
                [
                    'route' => '/user/{id}',
                    'class' => 'Update',
                    'method' => 'PUT'
                ],
                [
                    'route' => '/user/{id}',
                    'class' => 'Delete',
                    'method' => 'DELETE'
                ],
                [
                    'route' => '/user/{id}',
                    'class' => 'View',
                    'method' => 'GET'
                ],
                [
                    'route' => '/user/register',
                    'class' => 'Register',
                    'method' => 'POST'
                ]
            ],
            'Login' => [
                [
                    'route' => '/login/inner',
                    'class' => 'inner',
                    'method' => 'POST'
                ]
            ]
        ];
    }

}