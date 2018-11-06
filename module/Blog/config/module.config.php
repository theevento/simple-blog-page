<?php

namespace Blog;

use Blog\Adapter\AuthAdapter;
use Blog\Adapter\Factory\AuthAdapterFactory;
use Blog\Controller\Factory\LoginControllerFactory;
use Blog\Repository\UsersRepository\Factory\UsersDoctrineRepositoryFactory;
use Blog\Repository\UsersRepository\UsersDoctrineRepository;
use Blog\Repository\UsersRepository\UsersRepositoryInterface;
use Blog\Service\AuthenticationService\Factory\AuthenticationServiceFactory;
use Blog\Service\UserAuthService\Factory\UserAuthServiceFactory;
use Blog\Service\UserAuthService\UserAuthService;
use Blog\Service\UserAuthService\UserAuthServiceInterface;
use Blog\Service\UsersService\Factory\UsersServiceFactory;
use Blog\Service\UsersService\UsersService;
use Blog\Service\UsersService\UsersServiceInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Router\Http\Literal;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'login' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/login',
                    'defaults' => [
                        'controller' => Controller\LoginController::class,
                        'action' => 'index',
                    ]
                ]
            ]
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\LoginController::class => LoginControllerFactory::class
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'translator' => [
        'locale' => 'pl',
        'translation_file_patterns' => [
            [
                'type' => 'phparray',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => 'lang.array.%s.php',
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            UsersDoctrineRepository::class => UsersDoctrineRepositoryFactory::class,
            UsersService::class => UsersServiceFactory::class,
            AuthenticationService::class => AuthenticationServiceFactory::class,
            AuthAdapter::class => AuthAdapterFactory::class,
            UserAuthService::class => UserAuthServiceFactory::class
        ],
        'aliases' => [
            UsersRepositoryInterface::class => UsersDoctrineRepository::class,
            UsersServiceInterface::class => UsersService::class,
            UserAuthServiceInterface::class => UserAuthService::class
        ]
    ]
];
