<?php
namespace L2PClientModule;

use Zend\ServiceManager\ServiceManager;
use L2PClient\Config as L2PConfig;
use L2PClient\Client as L2PClient;
use L2PClient\Storage\StorageInterface as L2PStorage;

return array(
	'l2p_client' => array(
		'client_id' => '',
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
		),
	),
);