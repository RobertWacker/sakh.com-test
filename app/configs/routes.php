<?php

return array(

	'' => 'index/index',


	'login' => 'index/login',

	// Для добавления средств на счет через $_GET
	'wallet([\?][=&A-Za-z0-9]+)' => 'wallet/index',

	
	'wallet' => 'wallet/index',
);