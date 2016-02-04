<?php
namespace L2PClientModule;

use Zend\ServiceManager\ServiceManager;
use L2PClient\Config as L2PConfig;
use L2PClient\Client as L2PClient;
use L2PClient\Storage\StorageInterface as L2PStorage;
use BjyAuthorize\Guard;
use L2PClient\Storage\ZendSessionStorage;

return array(
	'l2p_client' => array(
		'client_id' => '',
	),
	
	'controllers' => array(
		'invokables' => array(
			Controller\TokenController::class => Controller\TokenController::class,
		),
	),
	
	'router' => array(
		'routes' => array(
			'l2p' => array(
				'type' => 'Literal',
				'options' => array(
					'route' => '/l2p',
					'defaults' => array(
						'controller' => Controller\TokenController::class,
						'action'     => 'index',
					),
				),
				'may_terminate' => false,
				'child_routes' => array(
					'authenticate' => array(
						'type' => 'Literal',
						'options' => array(
							'route' => '/authenticate',
							'defaults' => array(
								'action'     => 'authorize',
							),
						),
					)
				)
			)
		),
	),
	
	'bjyauthorize' => array(
        'guards' => array(
            Guard\Route::class => array(
				'l2p/authenticate' => ['route' => 'l2p/authenticate',  'roles' => ['guest', 'user'] ],
			),
		),
	),
	
	'service_manager' => array(
		'invokables' => array(
		),
		'factories' => array(
			Options\L2PClientOptions::class => function (ServiceManager $sm) {
				$config = $sm->get('Config');
				return new Options\L2PClientOptions(isset($config['l2p_client']) ? $config['l2p_client'] : array());
			},
			L2PConfig::class => Service\Config::class,
			L2PClient::class => Service\Client::class,
			L2PStorage::class => Service\SessionStorage::class,
			ZendSessionStorage::class => Service\SessionStorage::class,
		),
	),
);