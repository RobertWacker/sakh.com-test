<?php

namespace app\core;

/* Класс преднозначен для отображения страниц, получает инструкции какой шаблон и какую страницу отобразить*/
class View {

	public static function render($page, $layer, $data='') {
		//Адрес вида страницы
		$path = APP.'views/'.$page.'.php';

		if (file_exists($path)) {
			ob_start();
			require $path;
			$content = ob_get_clean();

			require APP.'views/'.$layer.'.php';
		}
	}


	public static function errorCode($code) {
		http_response_code($code);

		self::render('index/'.$code, 'main', '');
	}


}