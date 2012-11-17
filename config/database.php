<?php defined('SYSPATH') or die('No direct access allowed.');

return array(
	'default' => array(
		'type'       => 'PDO',
		'connection' => array(
			/**
			 * The following options are available for PDO:
			 *
			 * string   dsn         Data Source Name
			 * string   username    database username
			 * string   password    database password
			 * boolean  persistent  use persistent connections?
			 */
			'dsn'        => 'sqlite:'.APPPATH.'/database/db.sqlite',
			// 'username'   => 'root',
			// 'password'   => 'r00tdb',
			'persistent' => FALSE,
		),
		/**
		 * The following extra options are available for PDO:
		 *
		 * string   identifier  set the escaping identifier
		 */
		'table_prefix' => '',
		'charset'      => NULL,
		'caching'      => FALSE,
		'profiling'    => TRUE,

		/**
		 * The following option is available for the "one" module (install database controller):
		 * string   shema       Schema Source Name
		 */
		'shema'    => 'sandorzsolt',
	),
);
