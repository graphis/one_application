<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Email form Controller — Email form for sandorzsolt.hu
 *
 * @package    sandorzsolt.hu
 * @category   Controller
 * @author     Zsolt Sándor
 * @copyright  (c) 2012 Zsolt Sándor
 * @license    http://kohanaphp.com/license.html
 */
class Controller_Contact extends Controller {

	/**
	 * Check post
	 */
    public function action_home()
    {
//        $this->view = Kostache::factory('contact/index');
		$this->view = new View_Contact_Index();

        if ($this->request->query('sent') === 'yes')
        {
            $this->view->sent = TRUE;
        }

        if ($this->request->method() === Request::POST)
        {
            $post = Arr::extract($this->request->post(), array(
                'your_name',
                'email_address',
				'message_text',
				'',
                'total_guests',
                'not_attending',
                ));

            $post = Validation::factory($post)
                ->rule('your_name', 'not_empty')
                ->rule('email_address', 'not_empty')
                ->rule('message_text', 'not_empty')
                ->rule('total_guests', 'digit')
                ->rule('not_attending', 'in_array', array(':value', array('yes')))
                ;

            if ($post->check())
            {
                $email = Email::factory()
                    ->to('ezsolt@gmail.com', 'Sandor Zsolt')
                    ->from($post['email_address'], $post['your_name'])
                    // ->bcc('ezsolt@gmail.com', 'Woody Gilk')
				->subject('Test')
                    ->message($this->_message($post->as_array()))
                    ;

                $email->send();

                $this->redirect('contact/?sent=yes');
            }
            else
            {
                $this->view->errors = $post->errors('rsvp');
                $this->view->post = $post;
            }
        }
    }

	public function action_sent()
	{
		echo 'sent';
	}

	/**
	 * protected function _message
	 */
    protected function _message($post)
    {
        $body = $post['not_attending']
              ? ':your_name sent a message through sandorzsolt.hu.'
				  : 'Hey, :your_name sent you a message through sandorzsolt.hu/contact <br/>Message :message_text'
              ;

        $values = array();

        foreach ($post as $key => $value)
        {
            $values[":{$key}"] = $value;
        }

        return strtr($body, $values);
    }









	public function action_page()
	{
		$page = $this->request->param('page');

        if (empty($page) OR $page === 'home')
        {
            $this->redirect('', 301);
        }

		$this->view = Kostache::factory("contact/{$page}");
	}





	public function after()
	{
		$this->response->body($this->view->render());
		parent::after();
	}

}
