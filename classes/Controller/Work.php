<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Portfolio Controller — Main controller for sandorzsolt.hu
 *
 * @package    sandorzsolt.hu
 * @category   Controller
 * @author     Zsolt Sándor
 * @copyright  (c) 2012 Zsolt Sándor
 * @license    http://kohanaphp.com/license.html
 */
class Controller_Work extends Controller {

	private $view;
	private $content;

	/**
	 * Checking request params "<controller>/page/project"
	 */
	public function before()
	{
		// parent::before();
		$this->page_slug = $this->request->param('page');
		$this->project_slug = $this->request->param('project');
	}



	/**
	 * Check requests, and database results
	 * Check for page_slug and project slug
	 */
	public function action_index()
	{
		// set up a model, we do this only once, since we hawe only one model
		// if we would like to have different models, then do this once for every _project_list() function
		$this->projects = new Model_Project();

		// if page_slug and project_slug both are set, then get them from the db and render them
		if (isset($this->project_slug) AND isset($this->page_slug))
		{
			// call _project_detail function
			$this->view = new View_Portfolio_Exp; // details and list together
			$this->_project_detail();
			$this->_project_list();

			// and check for errors
			if ($this->project_detail['status'] == Model_Project::FAILURE)
			{
				throw new HTTP_Exception_404('No project found');
			}

			// prev next buttons for project detail
			$this->_project_pager();

		}
		// if only page_slug is set then print only a project list
		else if (isset($this->page_slug))
		{
			$this->view = new View_Portfolio_List;
			$this->_project_list();

			if ($this->project_list['status'] == Model_Project::FAILURE)
			{
				throw new HTTP_Exception_404('No project found');
			}

		} // If no page slug and no project slug defined. > redirect
		else
		{
			$this->redirect(Route::get('work')->uri(array('page'=>'latest')), 302);	
		}
	}



	/**
	 * Sets the project list result
	 * 1. new view
	 * 2. new model
	 * 3. call model function / get project list based on page slug
	 * 4. set view param with view function call
	 * @todo check: the "new Model_" is set up at the first steps
	 *
	 * example from https://raw.github.com/zombor/Auto-Modeler-Demo/
	 */
	protected function _project_list()
	{
		// $this->view = new View_Portfolio_List;                               // 1.

		// $projects = new Model_Project();                                     // 2.
		$projects = $this->projects;
		$this->project_list = $projects->get_all_projects($this->page_slug); // 3.
		$this->view->project_list = $this->project_list;                     // 4.
	}

	/**
	 * project detail
	 */
	protected function _project_detail()
	{
		// $this->view = new View_Portfolio_Detail;

		// $details = new Model_Project();
		$details = $this->projects;
		$this->project_detail = $details->get_project($this->project_slug, $this->page_slug);
		$this->view->project_detail = $this->project_detail;
	}

	/**
	 * project previous next thingie
	 */
	protected function _project_pager()
	{
		$this->test = new Model_Pager;

		$test = $this->test;
		$this->test_next_project = $test->next_project($this->page_slug, $this->project_slug);
		
		// and check for errors
		if ($this->test_next_project['status'] == Model_Project::SUCCESS)
		{
			$this->view->pager = $this->test_next_project;
		}
		else
		{
			$this->view->pager = NULL;
		}
	}

	/**
	 * check if request is ajax and handle views
	 */
	public function after()
	{
		if ( ! $this->request->is_initial() OR $this->request->is_ajax())
		{
			$this->view->render_layout = FALSE;
			$this->response->body($this->view);
		}
		// Fall back to standard page view
		$this->response->body($this->view->render());

		return parent::after();
	}

} // End Controller_Portfolio