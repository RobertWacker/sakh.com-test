<?php
namespace app\core;
// Parental controler contains ACL methods
class Controller {
    /**
   	 * Contains action name of controller
   	 *
	 * @var string
	 */
	public $route;
	/**
   	 * Contains acl settings list
   	 *
	 * @var object
	 */
	public $acl;
    /**
	 * Checks page access
	 *
	 * @param $route string - contains action name of controller
     */
	public function __construct($route) {
		// Add value to class
		$this->route = $route;
		// If don't have access, display an error
		if (!$this->checkAcl()) {
			View::errorCode(403);
		}
	}
    /**
	 * Check access to the page and authorization
	 *
	 * @return boolen
     */
	public function checkAcl() {
		// Include acl settings list
		$this->acl = require APP.'acl/index.php';
		// Check access for all users
		if ($this->isAcl('all')) {
			return true;
		}
		// Check access for admin
		elseif (isset($_SESSION['login']) and $this->isAcl('authorize')) {
			return true;
		}
		// Checks access if you are not an admin
		elseif (!isset($_SESSION['login']) and $this->isAcl('guest')) {
			return true;
		}
		return false;
	}
    /**
	 * Checks the correlation of user roles and page access
	 *
	 * @return boolen
     */
	public function isAcl($key) {
		// Checking access
		return in_array($this->route, $this->acl[$key]);
	}
}