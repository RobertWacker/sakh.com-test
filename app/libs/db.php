<?php

//в данном коде теряется весь смысл использования pdo т.к. этот кок по прежнему уязвим к sql injection ломается за 2 мин при помощи sqlmap﻿
namespace app\libs;
use PDO;

class Db extends PDO {

	/**
    * @var object соединение с БД
    */
	protected $db;
	
	public function __construct() {

		$config = require CONFIG.'db.php';
		parent::__construct('mysql:host='.$config['host'].';dbname='.$config['db'].'', $config['user'], $config['password']);
		$this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['db'].'', $config['user'], $config['password']);

		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	public function query($sql, $params = []) {
		$stmt = $this->db->prepare($sql);
		if (!empty($params)) {
			foreach ($params as $key => $val) {
				$stmt->bindValue(':'.$key, $val);
			}
		}
		$stmt->execute();
		return $stmt;
	}
	public function row($sql, $params = []) {
		$result = $this->query($sql, $params);
		return $result->fetchAll(PDO::FETCH_ASSOC);
	}
	public function column($sql, $params = []) {
		$result = $this->query($sql, $params);
		return $result->fetchColumn();
	}
}
