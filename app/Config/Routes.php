<?php

namespace App\Config;

/**
 * Class Routes
 * @package App\Config
 */
final class Routes {

    public static function get() {
        return [
            'User' => [
                [
                    'route' => '/users',
                    'class' => 'Collection',
                    'method' => 'post'
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
                ],
                [
                    'route' => '/user/register',
                    'class' => 'Register',
                    'method' => 'post'
                ]
            ],
            'Login' => [
                [
                    'route' => '/login/inner',
                    'class' => 'Inner',
                    'method' => 'post'
                ],
                [
                    'route' => '/login/facebook',
                    'class' => 'Facebook',
                    'method' => 'post'
                ],
            ]
        ];
    }

}