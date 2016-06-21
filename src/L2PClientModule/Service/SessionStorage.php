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
use L2PClient\Storage\ZendSessionStorage;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\AbstractPluginManager;

/**
 * Creates an instance of L2PClient\Storage\ZendSessionStorage;
 *
 * @author schurix
 */
class SessionStorage implements FactoryInterface{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null){
		$storage = new $requestedName();
		return $storage;
	}
	
	public function createService(ServiceLocatorInterface $serviceLocator) {
		$services = $serviceLocator;
		if($services instanceof AbstractPluginManager){
			$services = $services->getServiceLocator();
		}
		return $this($services, ZendSessionStorage::class);
	}
}
