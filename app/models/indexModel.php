<?php

namespace app\models;

use app\core\Model;


class IndexModel extends Model {

	public function getUsersList() {

		
		$query = 'SELECT * FROM users';

		$result = $this->db->query($query);

		$i = 0;
		while ($row = $result -> fetch ()) {
			$data[$i] = $row;

			$i++;
		}

		return $data; //Защита от пустого результата
	}


}