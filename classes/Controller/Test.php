<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Test extends Controller {

	public function action_index()
	{
		
		// $welcome = new Model_Welcome;
		// $welcome = $welcome->index();
		// $this->response->body($welcome);

		$this->page_slug = $this->request->param('page');
		$this->project_slug = $this->request->param('project');

		$image = './content/lost-and-found/01.jpg';

		echo HTML::zimage($image, TRUE, array('alt'=>'ping', 'title'=>'ping'));


		// count projects
		// $test = new Model_Test;
		// $testcount = $test->count_projects($this->page_slug);
		// $this->response->body('hello, world! -- test -- counted projects: <br/>' . $testcount);







		// $this->response->body('hello, world! -- test -- counted projects: <br/>' . $test_next_project);




	}

} // End Welcome
