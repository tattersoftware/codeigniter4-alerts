<?php namespace Tatter\Libraries;

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
* 	Use Config/Alerts.php for variable overrides
*
* @package CodeIgniter4-Alerts
* @author Matthew Gatner
* @link https://github.com/tattersoftware/codeigniter4-alerts
*
***/

use CodeIgniter\Config\Services;

/*** CLASS ***/
class Alerts {

	// prefix to add to SESSION variables and HTML elements, to prevent collision
	// can be override with Config
	protected $prefix;
	
	// view engine to render the output with
	protected $view;
	
	// view template to format the output
	protected $template;

	// initiate library, check for existing session
	public function __construct($config = null, RendererInterface $view = null) {
	
		// load optional configuration
		$config = $config ?? config('Alerts', false);
		
		// verify renderer
		if ($view instanceof RendererInterface)
			$this->view = $view;
		else
			$this->view = Services::renderer();
		
		// class-wide settings
		$this->prefix = $config->prefix ?? "alerts-";
		$this->template = $config->template ?? "Tatter\bootstrap";
	}
	
	// add a new alert to the queue
	public function add($class, $text) {
		$session = session();
		$alert = [
			'class' => $class,
			'text' => $text
		];
		
		// start the queue if it doesn't exist
		if (! $session->has($this->prefix.'queue'))
			$session->set($this->prefix.'queue', [$alert]);
		
		// push onto the queue if it was already there
		else
			$session->push($this->prefix.'queue', [$alert]);
		
		return;
	}

	// clears the queue and returns template formatted alerts
	public function display() {
		$session = session();
	
		// get any alerts
		$alerts = $session->get($this->prefix.'queue') ?? [ ];
	
		// clear alerts
		$session->remove($this->prefix.'queue');
		
		if (empty($alerts))
			return;
		
		// render the specified view template
		return $this->view->setVar('prefix', $this->prefix)
		                  ->setVar('alerts', $alerts)
		                  ->render($this->template);
	}
	
	// returns default CSS as inline style sheet
	// should be injected into <head>
	public function css() {
		return $this->view->setVar('prefix', $this->prefix)
		                  ->render("Tatter\css");
	}	
}
