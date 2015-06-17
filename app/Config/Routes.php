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
                ]
            ],
            'Token' => [
                [
                    'route' => '/token/inner',
                    'class' => 'Inner',
                    'method' => 'post'
                ],
                [
                    'route' => '/token/facebook',
                    'class' => 'Facebook',
                    'method' => 'post'
                ],
            ]
        ];
    }

}