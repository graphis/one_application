<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller — Cache for sandorzsolt.hu
 *
 * @package    sandorzsolt.hu
 * @category   Controller
 * @author     Zsolt Sándor
 * @copyright  (c) 2012 Zsolt Sándor
 * @license    http://kohanaphp.com/license.html
 */
class Controller extends Kohana_Controller {

	/**
	 * Add caching to pages if in production
	 *
	 * @return void
	 */
	public function after()
	{

		//if ($this->response instanceof View_Layout)
		//{
//			if ($this->request->is_ajax())
//			{
				// Display only the page content for AJAX requests
//				$this->render_layout = FALSE;
//			}
 
			// $this->response->body();
			// $this->response = $this->response->body();
		//}

		return parent::after();

		// $this->config = Kohana::$config->load('application');
		// print_r(Kohana::$environment);
		//if (Kohana::$environment === Kohana::PRODUCTION)
		//{
			// orig
			$this->response->headers('cache-control', 'max-age=3600, public');
			
//			$this->response->headers( 'cache-control', 'private' );
			$this->response->check_cache( null, $this->request ); 
			// $this->headers('cache-control', 'max-age=3600, public');
 		//}

	}

} // End Controller
