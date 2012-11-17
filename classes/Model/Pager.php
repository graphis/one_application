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
class Model_Pager extends one_Model_Database {

	public function zzz()
	{
		
	}


	/**
	 * Return the page id
	 *
	 * @return  string
	 */
	public function count_projects($page_slug)
	{
		$this->page_slug = $page_slug;

		return $this->_count_projects();
	}

	private function _count_projects()
	{
		// select projects
		$query = "SELECT * FROM project WHERE page_slug = '$this->page_slug' AND published = 1";
		$result = $this->pdo->query($query)->fetchall(PDO::FETCH_ASSOC);

		$row_count = count($result);

		return $row_count;
	}




	/**
	 * Return the previous next project id's and slug's
	 *
	 * @return  array
	 */
	public function next_project($page_slug, $project_slug)
	{
		$this->page_slug = $page_slug;
		$this->project_slug = $project_slug;

		// get current project id
		$query = "SELECT id, slug FROM project WHERE slug = '$this->project_slug' AND published = 1 LIMIT 1";
		$current_id = $this->pdo->query($query)->fetchall(PDO::FETCH_ASSOC);
		$current_id = $current_id[0]['id'];

		// get the prev and next id + slug
		$prev = "SELECT id, slug AS prev FROM project WHERE id < '$current_id' AND page_slug = '$this->page_slug' AND published = 1 LIMIT 1";
		$next = "SELECT id, slug AS next FROM project WHERE id > '$current_id' AND page_slug = '$this->page_slug' AND published = 1 LIMIT 1";

		$prev = $this->pdo->query($prev)->fetchall(PDO::FETCH_ASSOC);
		$next = $this->pdo->query($next)->fetchall(PDO::FETCH_ASSOC);
		// $complex = "SELECT id, slug FROM project WHERE page_slug = '$this->page_slug' AND published = 1  AND ( id < '$current_id' OR id > '$current_id' )";

		$result_array = array_merge($prev, $next);

//		echo '<pre>';
//		print_r($result_array);
//		echo '</pre>';

		if (empty($result_array))
		{
			$status = ['status' => self::FAILURE];
		}
		else
		{
			$status = ['status' => self::SUCCESS, 'result_array' => $result_array];
		}

		return $status;

	}

} // End Model_Page
