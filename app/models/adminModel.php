<?php

namespace app\models;

use app\core\Model;


class AdminModel extends Model {

	public function checkAcl() {

		$config = require 'app/configs/admin.php';
		if ($config['login'] != $_POST['login'] or $config['password'] != $_POST['password']) {

			return false;
		}

		return true;
	}

	public function login() {

		$config = require 'app/configs/admin.php';

		if ($config['login'] == $_POST['login'] && $config['password'] == $_POST['password']) {

			$_SESSION['login'] = $_POST['login'];
			$_SESSION['password'] = $_POST['password'];

			return true;
		}

		else {
			return false;
		}

	}

}