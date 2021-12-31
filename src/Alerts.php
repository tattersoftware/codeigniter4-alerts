<?php

namespace Tatter\Alerts;

use CodeIgniter\Session\Session;
use CodeIgniter\View\RendererInterface;
use Tatter\Alerts\Config\Alerts as AlertsConfig;
use Tatter\Alerts\Exceptions\AlertsException;

class Alerts
{
    /**
     * Our configuration instance.
     *
     * @var AlertsConfig
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
     * @var Session
     */
    protected $session;

    /**
     * The session key to use for the queue.
     *
     * @var string
     */
    private $key;

    /**
     * Initiates the library, check for existing session.
     *
     * @param AlertsConfig           $config
     * @param RendererInterface|null $view
     */
    public function __construct(AlertsConfig $config, RendererInterface $view = null)
    {
        $this->config  = $config;
        $this->session = service('session');
        $this->view    = $view ?? service('renderer');
        $this->key     = $this->config->prefix . 'queue';

        // Validate the configuration
        if (empty($this->config->template)) {
            throw AlertsException::forInvalidTemplate('');
        }
        if (! service('locator')->locateFile($this->config->template)) {
            throw AlertsException::forMissingTemplateView($this->config->template);
        }
    }

    /**
     * Adds a new alert to the queue.
     *
     * @param string $class Class to apply, e.g. "info", "success"
     * @param string $text  Text of the alert
     *
     * @return void
     */
    public function add($class, $text)
    {
        $alert = [
            'class' => $class,
            'text'  => $text,
        ];

        // Start the queue if it doesn't exist
        if (! $this->session->has($this->key)) {
            $this->session->set($this->key, [$alert]);
        }
        // Push onto the queue if it was already there
        else {
            $this->session->push($this->key, [$alert]);
        }
    }

    /**
     * Clears the queue and returns template formatted alerts.
     *
     * @return string
     */
    public function display()
    {
        // Retrieve and clear the queue
        $alerts = $this->session->get($this->key) ?? [];
        $this->session->remove($this->key);

        // Check for flashdata (if configured)
        if ($this->config->getflash) {
            if ($message = $this->session->getFlashdata('message')) {
                $alerts[] = ['class' => 'info', 'text' => $message];
            } elseif ($error = $this->session->getFlashdata('error')) {
                $alerts[] = ['class' => 'danger', 'text' => $error];
            } elseif ($errors = $this->session->getFlashdata('errors')) {
                foreach ($errors as $error) {
                    $alerts[] = ['class' => 'danger', 'text' => $error];
                }
            }
        }

        if (empty($alerts)) {
            return '';
        }

        // Render the specified view template
        return $this->view->setVar('prefix', $this->config->prefix)
            ->setVar('alerts', $alerts)
            ->render($this->config->template);
    }

    /**
     * Returns default CSS as inline style sheet to be
     * included in the <head> tag.
     *
     * @return string
     */
    public function css()
    {
        return $this->view->setVar('prefix', $this->config->prefix)->render('Tatter\Alerts\Views\css');
    }
}
