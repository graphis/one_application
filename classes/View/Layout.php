<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Layout — Main Layout for sandorzsolt.hu
 *
 * @package    sandorzsolt.hu
 * @category   View
 * @author     Zsolt Sándor
 * @copyright  (c) 2012 Zsolt Sándor
 * @license    http://kohanaphp.com/license.html
 */
class View_Layout extends Kostache_Layout {

	/**
	 * @var     string    main layout for the page
	 */
	protected $_layout = 'layout';

	/**
	 * @var     array    partials for the page
	 */
	protected $_partials = array(
		'head'       => 'partials/head',
		'navigation' => 'partials/navigation',
		'footer'     => 'partials/footer',
		'background' => 'partials/background',
	);

	/**
	 * @var     string    title of the site
	 */
	public $title = 'Sándor Zsolt | tervezőgrafikus';

	/**
	 * Email link for hello@sandorzsolt.hu.org
	 *
	 * @return  string
	 */
	public function email_address()
	{
		// return HTML::mailto('ezsolt@gmail.com');
		return 'ezsolt@gmail.com';
	}

	/**
	 * @var     string    description of the page
	 */
	public $description = 'Kohana homepage. Kohana is an HMVC PHP5 framework
	 that provides a rich set of components for building web applications.';

	/**
	 * Return the charset for the page
	 *
	 * @return  string
	 */
	public function charset()
	{
		return Kohana::$charset;
	}

	/**
	 * Return the full year (for copyright notice)
	 *
	 * @return  string
	 */
	public function year()
	{
		return date('Y');
	}

	/**
	 * Turn on the google analytics in production
	 *
	 * @return  boolean
	 */
	public function stats()
	{
		$stat = View::factory('profiler/stats');
		// echo $stat;
	}

	/**
	 * Returns URL::base() in order to link to assets properly
	 *
	 * @return  string
	 */
	public function base_url()
	{
		return URL::base();
	}

	/**
	 * Returns home page url
	 *
	 * @return  string
	 */
	public function home_url()
	{
		return Route::url('home');
	}



	/**
	 * Returns current  url
	 *
	 * @return  string
	 */
	public function current_url()
	{
		$current = URL::site(Request::current()->uri());
		return $current;
	}

	/**
	 * Returns portfolio page url
	 *
	 * @return  string
	 */
	public function portfolio_url()
	{
		return Route::url('work');
	}

	/**
	 * Returns current  url
	 *
	 * @return  string
	 */
	public function zzz_url()
	{
		$zzz = Route::url('work').'/'.Request::current()->param('page');
		// Request::initial()->controller();
		return $zzz;
	}

	/**
	 * Returns current kohana version
	 *
	 * @return  string
	 */
	public function kohana_version()
	{
		return Kohana::VERSION;
	}
	
	/**
	 * Returns current kohana codename
	 *
	 * @return  string
	 */
	public function kohana_codename()
	{
		return Kohana::CODENAME;
	}

	/**
	 * Return request type for debug purposes
	 *
	 * @return  string
	 */
	public function load()
	{
		$loadtype = (Request::current()->is_ajax()) ? '____Ajax' : '____Refresh';
		return $loadtype;
	}

	/**
	 * Return header for debug purposes
	 *
	 * @return  array
	 */
	public function header()
	{
		$header = Request::current()->headers();
		return $header;
	}

} // End View_Layout
