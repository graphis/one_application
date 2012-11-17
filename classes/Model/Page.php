<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Page — page id and metadata
 *
 * @package    sandorzsolt.hu
 * @category   Model
 * @author     Zsolt Sándor
 * @copyright  (c) 2012 Zsolt Sándor
 * @license    http://kohanaphp.com/license.html
 */
class Model_Page extends one_Model_Database {

	/**
	 * Return the page id
	 *
	 * @return  string
	 */
	public function get_page_id($page_slug)
	{
		// get the id of the page based on the $page_slug
		$query = "SELECT * FROM page WHERE slug = '$page_slug' AND published = 1";
		$result = $this->pdo->query($query)->fetch(PDO::FETCH_ASSOC);

		return $result['id'];
	}





} // End Model_Page
