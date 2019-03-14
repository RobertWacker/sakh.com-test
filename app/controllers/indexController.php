<?php

namespace app\controllers;

use app\models\{AdminModel, WalletModel};
use app\core\{View,Controller};


class IndexController extends Controller {

    /**
   	 * The variable contains an instance of the class for working with user table
   	 *
	 * @var object
	 *
	 * @access protected
	 */

	protected $admin;

	protected $wallet;

    /**
	 * Creating an instance of a class UserModel
	 *
	 * @access public
     */
	public function __construct() {

		// Create an instance
		$this->admin = new AdminModel();

		// Create an instance
		$this->wallet = new WalletModel();
	}

    /**
	 * The main page of the site displays a description ot the test task and user list
	 *
	 * @access public
	 *
	 * @return boolen
     */
	public function indexAction() {

		$data['balance'] = $this->wallet->getBalance(1);

		// Main page rendering
		View::render('index/index', 'main', $data);

		return true;
	}

    /**
	 * Authorization method for access to the site pages
	 *
	 * @access public
	 *
	 * @return boolen
     */
	public function loginAction() {

		// Checking the availability of entered data in $_POST
		if (isset($_POST['login']) && isset($_POST['password']) && !empty($_POST['login']) && !empty($_POST['password'])) {
			
			// If the method returns true, then the authorization was successful, and we show the site pages.
			if($this->admin->login()) {

				// We start action of the main page
				$this->indexAction();
			}

			// If authorization failed, we show login page
			else {

				$data = 'Wrong login or password';
				// Render of login page with error message
				View::render('index/login', 'main', $data); //!!! добавить ошибку на экран
			}
		}

		// If we doт't have data in $_POST for authorization we show the login page
		else {

			// Render of login page
			View::render('index/login', 'main');
		}

		return true;
	}


}








