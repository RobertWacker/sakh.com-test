<?php

namespace app\core;

use app\libs\Db;

class Model {

	public $db;
	
	public function __construct() {
		$this->db = new Db;
	}
	//Подключение к БД
	public static function connectionDB() {

		//подключение к БД
		return $db = new db();
	}


}