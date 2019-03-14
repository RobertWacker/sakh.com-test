<?php

namespace app\models;

use app\core\Model;


class WalletModel extends Model {

	/**
	 * Перевод УЕ
	 *
	 * @param integer $sender - отправитель
	 * @param integer $recepient - получатель
	 * @param float $amount - сумма перевода
	 *
	 * @return boolen
	 */ 
	public function transfer($sender, $recepient, $amount) {

		// Проверяем хватит ли баланса пользователя для перевода
		if($this->checkBalance($sender, $amount)) {

			try {  

  				$this->db->beginTransaction();
				
				// 1. Уменьшаем баланс отправителя
				$params = [
					's' => $sender,
					'a' => $amount,
				];
				$query = 'UPDATE `users` SET `balance`=`balance` - :a WHERE `id`=:s';
				$this->db->query($query, $params);
  				


				// 2. Увеличиваем баланс получателя
				$params = [
					'r' => $recepient,
					'a' => $amount,
				];
				$query = 'UPDATE `users` SET `balance`=`balance` + :a WHERE `id`=:r';

				$result = $this->db->query($query, $params);


				// 3. Записываем транзакцию
				$params = [
					's' => $sender,
					'r' => $recepient,
					'a' => $amount,
				];
				$query = 'INSERT INTO `log` (`id`, `sender_id`, `recepien_id`, `amount`) VALUES (null, :s, :r, :a)';

				$this->db->query($query, $params);

				$this->db->commit();

			} catch (Exception $e) {
  				$this->db->rollBack();
  				echo "Ошибка: " . $e->getMessage();
			}
			return true;

		} else {
			return false;
		}
	}

	/**
	 * Баланс пользователя
	 *
	 * @param integer $userID
	 *
	 * @return string
	 */
	public function getBalance($userID){

			$params = [
				'id' => $userID,
			];

			$query = 'SELECT `balance` FROM `users` WHERE `id`=:id LIMIT 1';

			$result = $this->db->query($query, $params);

			$data = $result->fetch();

			//print_r($result->errorInfo());

			return $data['balance'];	
	}

	/**
	 * Получить 10 последних операций по счету
	 *
	 * @param integer $userID - id пользователя
	 *
	 * @return array
	 */
	public function getLog($userID) {
		$params = [
			'id' => $userID,
		];

		$query = 'SELECT * FROM `log` WHERE `sender_id`=:id OR `recepien_id`=:id ORDER BY `id` DESC LIMIT 10';

		$result = $this->db->query($query, $params);

		//print_r($result->errorInfo());

		$i =1;
		while ($row = $result -> fetch ()) {

			$data[$i] = $row;

			$i++;
		}

		return $data;

	}

	/*=============== HELPERS ===============*/

	/**
	 * Проверка наличия суммы УЕ у пользователя
	 *
	 * @param integer $userID - id пользователя
	 * @param float $amount - сумма
	 *
	 * @return boolen
	 */
	public function checkBalance($userID, $amount) {

		$params = [
			'id' => $userID
		];

		$query = 'SELECT `balance` FROM `users` WHERE `id`=:id LIMIT 1 ';

		$result = $this->db->query($query, $params);

		$data = $result -> fetch();

		// Сравниваем баланс пользователя и нужную сумму
		if ($data['balance'] >= $amount) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Добавить УЕ пользователю
	 *
	 * @param integer $userID - id пользователя
	 * @param float $amount - сумма
	 *
	 * @return boolen
	 */
	public function addBalance($userID, $amount) {
		$params = [
			'id' => $userID,
			'amount' => $amount,
		];

		$query = 'UPDATE `users` SET `balance`=`balance` + :amount WHERE `id`=:id';

		$this->db->query($query, $params);

	}

	// Получаем спиок пользователей, которым можно отправить УЕ
	public function getUsers(){

		$query = 'SELECT `id`, `name` FROM `users`';

		$result = $this->db->query($query);

		$i =1;
		while ($row = $result -> fetch ()) {

			$data[$i] = $row;

			$i++;
		}
		
		return $data;

	}

}