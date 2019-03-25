<?php namespace Tatter\Alerts;

/***
* Name: Alerts
* Author: Matthew Gatner
* Contact: mgatner@tattersoftware.com
* Created: 2019-02-13
*
* Description:  Lightweight user notification library for CodeIgniter 4
*
* Requirements:
* 	>= PHP 7.1
* 	>= CodeIgniter 4.0
*	CodeIgniter's Session Library (loaded automatically)
*
* Configuration:
* 	Use Config/Alerts.php to override default behavior
*
* @package CodeIgniter4-Alerts
* @author Matthew Gatner
* @link https://github.com/tattersoftware/codeigniter4-alerts
*
***/

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Config\Services;
use Tatter\Alerts\Exceptions\AlertsException;

/*** CLASS ***/
class Alerts {

	/**
	 * Our configuration instance.
	 *
	 * @var \Tatter\Alerts\Config\Alerts
	 */
	protected $config;

	/**
	 * The view engine to render the alerts with.
	 *
	 * @var RendererInterface
	 */
	protected $view;

	/**
	 * The active user session, for loading and storing alerts.
	 *
	 * @var \CodeIgniter\Session\Session
	 */
	protected $session;	

	// initiate library, check for existing session
	public function __construct(BaseConfig $config, RendererInterface $view = null)
	{
		// save configuration
		$this->config = $config;

		// initiate the Session library
		$this->session = Services::session();
		
		// verify renderer
		if ($view instanceof RendererInterface)
			$this->view = $view;
		else
			$this->view = Services::renderer();
		
		// validations
		if (empty($this->config->template))
			throw AlertsException::forInvalidTemplate('');

		$locator = Services::locator();
		if (! $locator->locateFile($this->config->template))
			throw AlertsException::forMissingTemplateView($this->config->template);
	}
	
	// add a new alert to the queue
	public function add($class, $text)
	{
		$alert = [
			'class' => $class,
			'text' => $text
		];
		
		// start the queue if it doesn't exist
		if (! $this->session->has($this->config->prefix . 'queue'))
			$this->session->set($this->config->prefix . 'queue', [$alert]);
		
		// push onto the queue if it was already there
		else
			$this->session->push($this->config->prefix . 'queue', [$alert]);
		
		return;
	}

	// clears the queue and returns template formatted alerts
	public function display()
	{	
		// get any alerts
		$alerts = $this->session->get($this->config->prefix . 'queue') ?? [ ];
	
		// clear alerts
		$this->session->remove($this->config->prefix . 'queue');
		
		if (empty($alerts))
			return;
		
		// render the specified view template
		return $this->view->setVar('prefix', $this->config->prefix)
			->setVar('alerts', $alerts)
			->render($this->config->template);
	}
	
	// returns default CSS as inline style sheet
	// should be injected into <head>
	public function css()
	{
		return $this->view->setVar('prefix', $this->config->prefix)->render("Tatter\Alerts\Views\css");
	}	
}
