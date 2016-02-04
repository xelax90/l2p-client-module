# L²P Client Module for Zend Framework 2

Simple module built around xelax90/l2p-client

# Configuration

* Copy the config/l2p.local.php.dist file into your config/autoload and remove the .dist extension
* Insert your client id
* You can define a custom storage by setting the ``storage_service``` key`in the configuration.
* For more options, look into the ```L2PClientModule\Options\L2PClientOptions``` class

# Getting the client

* Use the ServiceLocator to get an instance of L2PClient\Client: ```$serviceLocator->get(\L2PClient\Client::class);```
* Refer to the xelax90/l2p-client and L2P API documentation for usage

