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

namespace L2PClientModule\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use L2PClient\Client as L2PClient;
use Zend\View\Model\JsonModel;

/**
 * Description of TokenController
 *
 * @author schurix
 */
class TokenController extends AbstractActionController{
	
	/** @var L2PClient */
	protected $l2p;
	
	public function getClient(){
		if(null === $this->l2p){
			$this->l2p = $this->getServiceLocator()->get(L2PClient::class);
		}
		return $this->l2p;
	}
	
	public function authorizeAction(){
		$result = array();
		
		$client = $this->getClient();
		$token = $client->getAccessToken();
		if(null === $token){
			$deviceToken = $client->getConfig()->getStorage()->getDeviceToken();
			$result = array(
				'success' => false,
				'error' => 'No refresh token',
				'verifyUrl' => $deviceToken->buildVerificationUrl(),
				'interval' => $deviceToken->getInterval(),				
			);
		} else {
			$result = array(
				'success' => true,
			);
			$this->getEventManager()->trigger('l2p.authorized', $this);
		}
		return new JsonModel($result);
	}
	
}
