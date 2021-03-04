<?php

// Exit if accessed directly
if ( ! defined('ABSPATH') ) {
    exit;
}

if ( ! class_exists( 'WR_Abstract_Module' ) ):

/**
 * WooRechnung Abstract Module Class
 *
 * @class    WR_Abstract_Module
 * @version  1.0.0
 * @package  WooRechnung\Abstract
 * @author   Zweischneider
 */
abstract class WR_Abstract_Module
{
    /**
     * The plugin instance via dependency injection.
     *
     * @var WR_Plugin
     */
    protected $_plugin;

    /**
     * Create a new instance of this module.
     *
     * @param  WR_Plugin $plugin
     * @return void
     */
    public function __construct(WR_Plugin $plugin)
    {
        $this->_plugin = $plugin;
        $this->init_hooks();
    }

    /**
     * Initialize the hooks this module provides callbacks for.
     *
     * This abstract method is to be implemented by each module
     * of this plugin and is called automatically with the initialization
     * of the module object.
     *
     * @return void
     */
    abstract function init_hooks();

    /**
     * Register an action hook for this module.
     *
     * This method provides a more convenient way for registering
     * action hooks for this module.
     *
     * @param  string $hook
     * @param  string $method
     * @param  int $priority
     * @param  int $args
     * @return void
     */
    public function add_action($hook, $method, $priority = 10, $args = 1)
    {
        $this->loader()->add_action($hook, array($this, $method), $priority, $args);
    }

    /**
     * Register a filter hook for this module.
     *
     * This method provides a more convenient way for registering
     * filter hooks for this module.
     *
     * @param  string $hook
     * @param  string $method
     * @param  int $priority
     * @param  int $args
     * @return void
     */
    public function add_filter($hook, $method, $priority = 10, $args = 1)
    {
        $this->loader()->add_filter($hook, array($this, $method), $priority, $args);
    }

    /**
     * Trigger an action in that another module might react to it.
     *
     * @param string $hook
     * @param mixed $args
     * @return void
     */
    public function do_action($hook, $args)
    {
        do_action($hook, $args);
    }

    /**
     * Convenient method to access the plugin from inside this module.
     *
     * @return WR_Plugin
     */
    public function plugin()
    {
        return $this->_plugin;
    }

    /**
     * Convenient method to access the loader from inside this module.
     *
     * @return WR_Loader
     */
    public function loader()
    {
        return $this->_plugin->get_loader();
    }

    /**
     * Convenient method to access the logger from inside this module.
     *
     * @return WR_Logger
     */
    public function logger()
    {
        return $this->_plugin->get_logger();
    }

    /**
     * Convenient method to access the client from inside this module.
     *
     * @return WR_Client
     */
    public function client()
    {
        return $this->_plugin->get_client();
    }

    /**
     * Convenient method to access the factory from inside this module.
     *
     * @return WR_Factory
     */
    public function factory()
    {
        return $this->_plugin->get_factory();
    }

    /**
     * Convenient method to access the mailer from inside this module.
     *
     * @return WR_Mailer
     */
    public function mailer()
    {
        return $this->_plugin->get_mailer();
    }

    /**
     * Convenient method to access the settings from inside this module.
     *
     * @return WR_Settings
     */
    public function settings()
    {
        return $this->_plugin->get_settings();
    }

    /**
     * Convenient method to access the options from inside this module.
     *
     * @return WR_Options
     */
    public function options()
    {
        return $this->_plugin->get_options();
    }

    /**
     * Convenient method to access the storage from inside this module.
     *
     * @return WR_Storage
     */
    public function storage()
    {
        return $this->_plugin->get_storage();
    }

    /**
     * Convenient method to access the viewer from inside this module.
     *
     * @return WR_Viewer
     */
    public function viewer()
    {
        return $this->_plugin->get_viewer();
    }

    /**
     * Convenient method to access the error handler from inside this module.
     *
     * @return WR_Handler
     */
    public function handler()
    {
        return $this->_plugin->get_handler();
    }
}

endif;
