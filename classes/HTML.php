<?php defined('SYSPATH') or die('No direct script access.');
/**
 * HTML extended
 *
 * @package    graphis app
 * @category   Controllers
 * @author     Sándor Zsolt
 */
class HTML extends Kohana_HTML {

	/**
	 * Creates a image link, with dimensions.
	 *
	 *     echo HTML::image('media/img/logo.png', TRUE, array('alt' => 'My Company'));
	 *
	 * @param   string   file name
	 * @param   boolean  image dimensions
	 * @param   array    default attributes
	 * @return  string
	 * @uses    URL::base
	 * @uses    HTML::attributes
	 */
	public static function zimage($file, $dimensions = NULL, array $attributes = NULL, $index = FALSE)
	{
		if ($dimensions === TRUE)
		{
			$size = getimagesize($file);
			
			// Add image dimensions
			$attributes['width'] = $size[0];
			$attributes['height'] = $size[1];
		}

		if (strpos($file, '://') === FALSE)
		{
			// Add the base URL
			$file = URL::base($index).$file;
		}

		// Add the image link
		$attributes['src'] = $file;

		return '<img'.HTML::attributes($attributes).' />';
	}

















	/**
	 * Creates HTML link anchors, adds class active if current controller
	 *
	 * @param   string  controller name
	 * @param   string  link text
	 * @param   array   HTML anchor attributes
	 * @return  string  HTML anchor
	 */
	public static function menu_anchor($controller, $title = null, $attributes = array())
	{
		if (Request::instance()->controller === $controller)
			$attributes['class'] = 'active';

		return parent::anchor(Route::get('default')
				->uri(array('controller' => $controller)), $title, $attributes);
	}

	/**
	 * Creates HTML link anchors, adds class active if current controller
	 *
	 * @param   array   associative array of parameter names and values
	 * @return  string  params string
	 */
	public static function url_params(array $params)
	{
		$encoded_params = array();

		foreach ($params as $key => $value)
			$encoded_params[] = urlencode($key) . '=' . urlencode($value);

		return '?' . implode('&', $encoded_params);
	}


} // End Graphis_HTML