<?php defined('SYSPATH') or die('No direct access allowed.');

// pjax portfolio routes
Route::set('work', 'work(/<page>(/<project>))')
	->defaults(array(
		'controller' => 'work',
		'action'     => 'index',
		'page'       => NULL,
		'project'    => NULL,
	));

// contact mail me
Route::set('contact', 'contact')
	->defaults(array(
		'controller' => 'contact',
		'action'     => 'home',
	));

// default route / home
Route::set('home', '(index)')
	->defaults(array(
		'controller' => 'home',
		'action'     => 'index'
	));

///// test area
Route::set('test', 'test(/<page>(/<project>))')
	->defaults(array(
		'controller' => 'test',
		'action'     => 'index',
		'page'       => NULL,
		'project'    => NULL,
	));




// default route
Route::set('default', '(<controller>(/<action>(/<id>)))')
	->defaults(array(
		'controller' => 'welcome',
		'action'     => 'index',
	));