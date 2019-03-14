<?php

namespace app\controllers;

use app\models\{WalletModel, IndexModel};
use app\core\View;


class WalletController {

    /**
   	 * Содержит экземпляр класса walletModel
   	 *
	 * @var object
	 *
	 * @access protected
	 */
	protected $wallet;
	protected $index;


	public function __construct() {

		$this->wallet = new WalletModel();
		$this->index = new IndexModel();
	}

    /**
	 * Основной метод с отображение профиля
	 *
	 * @access public
	 *
	 * @return boolen
     */
	public function indexAction() {

		if (isset($_POST['transfer'])) {

			// Совершаем операцию со счетом
			$this->wallet->transfer(1, $_POST['recipient'], $_POST['transfer']);
		}

		if (isset($_GET['add'])) {
			$this->wallet->addBalance(1, 1000);
		}

		// Получить операции по счету
		$data['log'] = $this->wallet->getLog(1);

		// Получаем свой баланс
		$data['balance'] = $this->wallet->getBalance(1);

		$data['contacts'] = $this->wallet->getUsers();

		$data['rows'] = $this->index->getUsersList();

		// Отрисовываем страницу
		View::render('wallet/index', 'main', $data);

		return true;
	}

}








