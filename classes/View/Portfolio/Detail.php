<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Portfolio/Detail — partial
 *
 * @package    sandorzsolt.hu
 * @category   View
 * @author     Zsolt Sándor
 * @copyright  (c) 2012 Zsolt Sándor
 * @license    http://kohanaphp.com/license.html
 */
class View_Portfolio_Detail extends View_Layout {

	public $project_detail;
	
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

} // End View_Portfolio_Index
