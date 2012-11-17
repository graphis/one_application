<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Home — View
 *
 * @package    sandorzsolt.hu
 * @category   View
 * @author     Zsolt Sándor
 * @copyright  (c) 2012 Zsolt Sándor
 * @license    http://kohanaphp.com/license.html
 */
class View_Home_Index extends View_Layout {

	/**
	 * @var     string    main layout for the page
	 */
//	protected $_layout = 'layout';

	/**
	 * @var     array    partials for the page
	 */
	protected $_partials = array(
		'head'       => 'partials/head',
		'navigation' => 'partials/navigation',
		'footer'     => 'partials/footer',
		'background' => 'partials/background',
		'text'       => 'home/text',
	);

	/**
	 * Return the project list for the page
	 *
	 * @return  array
	 */
	public function message()
	{
		// $project_list = $this->project_list['result_array'];

		return $this->message;
	}



} // End View_Contact_Index