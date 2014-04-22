<?php
namespace Usuario;

return array(
		'controllers' => array(
				'invokables' => array(
						'Usuario\Controller\Index' => 'Usuario\Controller\IndexController',
						'Usuario\Controller\Users' => 'Usuario\Controller\UsersController',
						'Usuario\Controller\Auth' => 'Usuario\Controller\AuthController',
						
					)
		),
		'router' => array(
				'routes' => array(
						
						'usuario-register' => array(
								'type' => 'Literal',
								'options' => array(
										'route' => '/register',
										'defaults' => array(
												'__NAMESPACE__' => 'Usuario\Controller',
												'controller' => 'Index',
												'action' => 'register',
										)
								)
						),
						
						'usuario-activate' => array(
								'type' => 'Segment',
								'options' => array(
										'route' => '/register/activate[/:key]',
										'defaults' => array(
												'controller' => 'Usuario\Controller\Index',
												'action' => 'activate'
										)
								)
						),
						
						'usuario-auth' => array(
								'type' => 'Literal',
								'options' => array(
										'route'=>'/auth',
										'defaults' => array(
												'__NAMESPACE__' => 'Usuario\Controller',
												'controller' => 'Auth',
												'action' => 'index'
										)
								)
						),
						'usuario-logout' => array(
								'type' => 'Literal',
								'options' => array(
										'route'=>'/auth/logout',
										'defaults' => array(
												'__NAMESPACE__' => 'Usuario\Controller',
												'controller' => 'Auth',
												'action' => 'logout'
										)
								)
						),
						
						
						
						
						
						
						'usuario-admin' => array(
								'type' => 'Literal',
								'options' => array(
										'route' => '/admin',
										'defaults' => array(
												'__NAMESPACE__' => 'Usuario\Controller',
												'controller' => 'Users',
												'action' => 'index'
										)
								),
								'may_terminate' => true,
								'child_routes' => array(
										'default' => array(
												'type' => 'Segment',
												'options' => array(
														'route' => '/[:controller[/:action[/:id]]]',
														'constraints' => array(
																'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
																'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
																'id' => '\d+'
														),
														'defaults' => array(
																'__NAMESPACE__' => 'Usuario\Controller',
																'controller' => 'users'
														)
												)
										),
										'paginator' => array(
												'type' => 'Segment',
												'options' => array(
														'route' => '/[:controller[/page/:page]]',
														'constraints' => array(
																'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
																'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
																'page' => '\d+'
														),
														'defaults' => array(
																'__NAMESPACE__' => 'Usuario\Controller',
																'controller' => 'users'
														)
												)
										)
								)
						)
						
					)
				),
		'view_manager' => array(
				'display_not_found_reason' => true,
				'display_exceptions' => true,
				'doctype' => 'HTML5',
				'not_found_template' => 'error/404',
				'exception_template' => 'error/index',
				'template_map' => array(
						'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
						'error/404' => __DIR__ . '/../view/error/404.phtml',
						'error/index' => __DIR__ . '/../view/error/index.phtml',
				),
				'template_path_stack' => array(
						__DIR__ . '/../view',
				),
		),
		'doctrine' => array(
				'driver' => array(
						__NAMESPACE__ . '_driver' => array(
								'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
								'cache' => 'array',
								'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
						),
						'orm_default' => array(
								'drivers' => array(
										__NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
								),
						),
				),
		),
		'data-fixture' => array(
				'Usuario_fixture' => __DIR__ . '/../src/Usuario/Fixture',
		),
		
 
);
