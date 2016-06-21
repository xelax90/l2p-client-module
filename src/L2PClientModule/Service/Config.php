<?php

/*
 * Copyright (C) 2016 schurix
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

namespace L2PClientModule\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use L2PClientModule\Options\L2PClientOptions;
use L2PClient\Config as L2PConfig;

/**
 * Factory for L2P Client Configuration
 *
 * @author schurix
 */
class Config implements FactoryInterface{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null){
		/* @var $clientOptions L2PClientOptions */
		$clientOptions = $container->get(L2PClientOptions::class);
		$storage = $container->get($options->getStorageService());
		
		$config = new $requestedName($storage, $clientOptions->getClientId(), $clientOptions->getAuthUrl(), $clientOptions->getApiUrl(), $clientOptions->getScope());
		return $config;
	}
	
	public function createService(ServiceLocatorInterface $serviceLocator) {
		$services = $serviceLocator;
		if($services instanceof AbstractPluginManager){
			$services = $services->getServiceLocator();
		}
		return $this($services, L2PConfig::class);
	}
}
