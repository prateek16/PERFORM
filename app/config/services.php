<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => array(
		'domain' => 'mg.tech4i2.com',
		'secret' => 'key-4560eb65c182fae418078733d9eef120',
	),

	'mandrill' => array(
		'secret' => 'xCUC8D7RZH25tOOyhsDckA',
	),

	'stripe' => array(
		'model'  => 'User',
		'secret' => '',
	),

);
