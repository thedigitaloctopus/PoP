<?php
/*
Plugin Name: PoP Engine for WordPress
Version: 0.1
Description: Implementation of Module Definitions for PoP modules
Plugin URI: https://getpop.org/
Author: Leonardo Losoviz
*/
namespace PoP\Engine\WP;

//-------------------------------------------------------------------------------------
// Constants Definition
//-------------------------------------------------------------------------------------
define('POP_ENGINEWP_VERSION', 0.108);
define('POP_ENGINEWP_DIR', dirname(__FILE__));

class Plugins
{
    public function __construct()
    {
        include_once 'validation.php';
        \PoP\Root\App::addFilter(
            'PoP_Engine_Validation:provider-validation-class',
            $this->getProviderValidationClass(...)
        );

        // Priority: after PoP Engine, inner circle
        \PoP\Root\App::addAction('plugins_loaded', $this->init(...), 88824);
    }
    public function getProviderValidationClass($class)
    {
        return Validation::class;
    }

    public function init()
    {
        if ($this->validate()) {
            $this->initialize();
            define('POP_ENGINEWP_INITIALIZED', true);
        }
    }
    public function validate()
    {
        include_once 'validation.php';
        $validation = new Validation();
        return $validation->validate();
    }
    public function initialize()
    {
        include_once 'initialization.php';
        $initialization = new Initialization();
        return $initialization->initialize();
    }
}

/**
 * Initialization
 */
new Plugins();
