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

namespace L2PClientModule\Options;

use Zend\Stdlib\AbstractOptions;
use L2PClient\Storage\StorageInterface;

/**
 * Options wrapper for L2P configuration
 *
 * @author schurix
 */
class L2PClientOptions extends AbstractOptions{
	/**
	 * URL to OAuth server
	 * @var string
	 */
	protected $authUrl =null;
	
	/**
	 * Client id provided by IT Center
	 * @var string
	 */
	protected $clientId = null;
	
	/**
	 * @var string
	 */
	protected $scope = null;
	
	/**
	 * L2P API server
	 * @var string
	 */
	protected $apiUrl = null;
	
	/**
	 * Storage that saves the tokens
	 * @var StorageInterface
	 */
	protected $storageService = StorageInterface::class;
	
	public function getAuthUrl() {
		return $this->authUrl;
	}

	public function getClientId() {
		return $this->clientId;
	}

	public function getScope() {
		return $this->scope;
	}

	public function getApiUrl() {
		return $this->apiUrl;
	}

	public function getStorageService() {
		return $this->storageService;
	}

	public function setAuthUrl($authUrl) {
		$this->authUrl = $authUrl;
		return $this;
	}

	public function setClientId($clientId) {
		$this->clientId = $clientId;
		return $this;
	}

	public function setScope($scope) {
		$this->scope = $scope;
		return $this;
	}

	public function setApiUrl($apiUrl) {
		$this->apiUrl = $apiUrl;
		return $this;
	}

	public function setStorageService($storageService) {
		$this->storageService = $storageService;
		return $this;
	}
}
