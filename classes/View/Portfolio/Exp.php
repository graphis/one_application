<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Portfolio/Exp — partial
 * gets the project detail and the project list
 *
 * @package    sandorzsolt.hu
 * @category   View
 * @author     Zsolt Sándor
 * @copyright  (c) 2012 Zsolt Sándor
 * @license    http://kohanaphp.com/license.html
 */
class View_Portfolio_Exp extends View_Layout {

	public $project_list;
	public $project_detail;
	public $project_pager;
	
	/**
	 * Return the project list for the page
	 *
	 * @return  array
	 */
	public function project_detail()
	{
		$project_detail = $this->project_detail['result_array'];

		return $project_detail;
	}

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

	/**
	 * Return the project list for the page
	 *
	 * @return  array
	 */
	public function pager()
	{
		$project_pager = $this->pager['result_array'];

		return $project_pager;
	}

} // End View_Portfolio_Index
