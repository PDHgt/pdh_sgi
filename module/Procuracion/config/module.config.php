<?php

namespace Procuracion;

return array(
    'controllers' => array(
        'invokables' => array(
            'Procuracion\Controller\Index' => 'Procuracion\Controller\IndexController',
            'Procuracion\Controller\Recepcion' => 'Procuracion\Controller\RecepcionController',
        //'Procuracion\Controller\Formulario' => 'Procuracion\Controller\FormularioController'
        ),
    ),
    'router' => array(
        'routes' => array(
            'inicio' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Procuracion\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'procesar' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'recepcion' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/recepcion',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Procuracion\Controller',
                        'controller' => 'Recepcion',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'procesar' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:action[/:id]][/:param1]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                    'registro' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:action[/:id]][/:param1]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            'visita' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/recepcion/visita',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Procuracion\Controller',
                        'controller' => 'Recepcion',
                        'action' => 'visita',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'procesar' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:action[/:id]][/:param1]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            )
        /* 'formulario' => array(
          'type' => 'Literal',
          'options' => array(
          'route' => '/formulario',
          'defaults' => array(
          '__NAMESPACE__' => 'Procuracion\Controller',
          'controller' => 'Formulario',
          'action' => 'registrovisita',
          ),
          ),
          'may_terminate' => true,
          'child_routes' => array(
          'default' => array(
          'type' => 'Segment',
          'options' => array(
          'route' => '/[:action]',
          //'route'    => '/[:controller[/:action[/:id]]]',
          //'route'    => '/[:controller[/:action[/:id/:id2]]]',
          'constraints' => array(
          'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
          'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
          ),
          'defaults' => array(
          ),
          ),
          ),
          ),
          ), */
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'es_ES',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/index' => __DIR__ . '/../view/layout/layout-index.phtml',
            'layout/layout' => __DIR__ . '/../view/layout/layout-recepcion.phtml',
            'layout/modal' => __DIR__ . '/../view/layout/layout-modal.phtml',
            'recepcion/header' => __DIR__ . '/../view/procuracion/header.phtml',
            'recepcion/aside' => __DIR__ . '/../view/procuracion/aside.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'Application_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Procuracion/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Procuracion\Entity' => 'Application_driver'
                )
            )
        ),
        'authentication' => array(
            'orm_default' => array(
                'object_manager' => 'Doctrine\ORM\EntityManager',
                'identity_class' => 'Procuracion\Entity\Usuario',
                'identity_property' => 'usuario',
                'credential_property' => 'password'/* ,
              'credential_callable' => function (Usuario $user, $passwordGiven) {
              return my_awesome_check_test($user->getPassword(), $passwordGiven);
              }, */
            ),
        ),
    ),
);

