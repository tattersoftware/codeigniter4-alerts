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

/*** CLASS ***/
class Alerts {

	// prefix to add to SESSION variables and HTML elements, to prevent collision
	// can be override with Config
	private $prefix;

	// initiate library, check for existing session
	public function __construct() {
	
		// load optional configuration
		$config = config('Alerts', false);
		
		// class-wide settings
		$this->prefix = $config->prefix ?? "alerts-";
		$this->view = $config->view ?? "Tatter\Alerts\Views\bootstrap";
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

	// clears the queue and displays all alerts
	public function display() {
		$session = session();
	
		// get any alerts
		$alerts = $session->get($this->prefix.'queue') ?? [ ];
	
		// clear alerts
		$session->remove($this->prefix.'queue');
		
		if (empty($alerts))
			return;
		
		// load the specified view
		$data = [
			'prefix' => $this->prefix,
			'alerts' => $alerts,
		];
		echo view($this->view, $data);

		return;
	}
	
	// outputs default CSS as inline style sheet
	// should be called in <head>
	public function css() {
		echo view("Tatter\Alerts\Views\css", ['prefix' => $this->prefix]);
	}	
}
