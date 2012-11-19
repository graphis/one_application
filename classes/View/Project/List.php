<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Portfolio/List — partial
 *
 * @package    sandorzsolt.hu
 * @category   View
 * @author     Zsolt Sándor
 * @copyright  (c) 2012 Zsolt Sándor
 * @license    http://kohanaphp.com/license.html
 */
class View_Project_List extends View_Layout {

	public $project_list;

	/**
	 * Return the project list for the page
	 *
	 * @return  array
	 */
	public function project_list()
	{
		$project_list = $this->project_list['result_array'];

		return $project_list;
	}

} // End View_Portfolio_List
