<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Project model — project list and detail
 *
 * @package    sandorzsolt.hu
 * @category   Model
 * @author     Zsolt Sándor
 * @copyright  (c) 2012 Zsolt Sándor
 * @license    http://kohanaphp.com/license.html
 */
class Model_Project extends one_Model_Database {

//	public function __destruct()
//	{
//		echo __FILE__ . '<br/>';	
//	}

	/**
	 * Returns the project detail
	 *
	 * @return  array
	 */
	public function get_project($project_slug, $page_slug) // 
	{

		// get the project based on the $project_slug
		$query = "SELECT * FROM project WHERE slug = '$project_slug' AND published = 1 AND page_slug = '$page_slug'" ;
		$project = $this->pdo->query($query)->fetch(PDO::FETCH_ASSOC);

		// construct result array
		$loop_number = 0;
		//foreach($result as $project)
		//{

			// select images
			$project_id = $project['id'];
			$query = "SELECT * FROM image WHERE project_id = '$project_id'";
			$images = $this->pdo->query($query)->fetchall(PDO::FETCH_ASSOC); // FETCH_ASSOC

			$result_array[$loop_number] = array(
				'id'          => $project['id'],
				'slug'        => $project['slug'],
				'title'       => $project['title'],
				'description' => $project['description'],
				'images'      => $img[] = array(),
			);

			// push the image list to the result array
			foreach ($images as $image)
			{
				$img[ $image['id'] ] = array(
					'id'          => $image['id'],
					'filename'    => $project['slug'] . '/highres/' . $image['filename'],
					'title'       => $image['title'],
					'description' => $image['description'],
				);
				array_push($result_array[$loop_number]['images'], $img[$image['id']] );
				// array_push($result_array[$project['slug']]['images'], $img[$image['id']] );
			}

			$loop_number++;
		//}

		if (empty($project))
		{
			$status = ['status' => self::FAILURE];
		}
		else
		{
			$status = ['status' => self::SUCCESS, 'result_array' => $result_array];
		}

		return $status;
    }



	/**
	 * Returns the project list result
	 *
	 * @return  array
	 */
	public function get_all_projects($page_slug) // 
	{

		// select projects
		$query = "SELECT * FROM project WHERE page_slug = '$page_slug' AND published = 1";
		$result = $this->pdo->query($query)->fetchall(PDO::FETCH_ASSOC);

		// construct result array
		$loop_number = 0;
		foreach($result as $project)
		{
			// select images
			$project_id = $project['id'];
			$query = "SELECT * FROM image WHERE project_id = '$project_id'";
			$images = $this->pdo->query($query)->fetchall(PDO::FETCH_ASSOC); // FETCH_ASSOC

			// $result_array[$project['slug']] = array(
			$result_array[$loop_number] = array(
				'id'          => $project['id'],
				'slug'        => $project['slug'],
				'title'       => $project['title'],
				'description' => $project['description'],
				'images'      => $img[] = array(),
			);

			// push the image list to the result array
			foreach ($images as $image)
			{
				$img[ $image['id'] ] = array(
					'id'          => $image['id'],
					'filename'    => $project['slug'] .'/'. $image['filename'],
					'title'       => $image['title'],
					'description' => $image['description'],
				);
				array_push($result_array[$loop_number]['images'], $img[$image['id']] );
				// array_push($result_array[$project['slug']]['images'], $img[$image['id']] );
			}

			$loop_number++;
		}

		// if there is no result...
		if (!isset($result_array))
		{
			$status = ['status' => self::FAILURE];
		}
		else
		{
			$status = ['status' => self::SUCCESS, 'result_array' => $result_array];
		}

		return $status;
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

		echo '<pre>';
		print_r($result_array);
		echo '</pre>';

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
