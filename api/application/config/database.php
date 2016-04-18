<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
	'default' => array
	(
		'type'       => 'MySQLi',
		'connection' => array(
		'hostname'   => 'localhost',
		'database'   => 'mymusicdb',
		'username'   => 'root',
		'password'   => '',
		'persistent' => FALSE,
		),
		'table_prefix' => '',
		'charset'      => 'utf8',
		'caching'      => FALSE,
	),
	'alternate' => array(
		'type'       => 'PDO',
		'connection' => array(
		'dsn'        => 'mysql:host=localhost;dbname=mymusicdb',
		'username'   => 'root',
		'password'   => '',
		'persistent' => FALSE,
		),
		'table_prefix' => '',
		'charset'      => 'utf8',
		'caching'      => FALSE,
	),
);
