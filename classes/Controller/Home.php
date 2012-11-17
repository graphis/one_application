<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller {

	private $view;
	private $content;

	public function action_index()
	{
		$this->view = new View_Home_Index; // details and list together
		$this->view->message = '——————————————————————————————————————— ying and young';
	}

	/**
	 * check if request is ajax and handle views
	 */
	public function after()
	{
//		return parent::before();

		if ( ! $this->request->is_initial() OR $this->request->is_ajax())
		{
			$this->view->render_layout = FALSE;
			$this->response->body($this->view);
		}
		// Fall back to standard page view
		$this->response->body($this->view->render());

		return parent::after();
	}

} // End Home
