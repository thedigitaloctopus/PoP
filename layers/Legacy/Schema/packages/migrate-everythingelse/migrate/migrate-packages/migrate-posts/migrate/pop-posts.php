<?php
/*
Plugin Name: PoP Posts
Version: 0.1
Description: The foundation for a PoP Posts
Plugin URI: https://getpop.org/
Author: Leonardo Losoviz
*/
namespace PoPCMSSchema\Posts;

//-------------------------------------------------------------------------------------
// Constants Definition
//-------------------------------------------------------------------------------------
define('POP_POSTS_VERSION', 0.106);
define('POP_POSTS_DIR', dirname(__FILE__));

class Plugins
{
    public function __construct()
    {

        // Priority: new section, after PoP Engine section
        \PoP\Root\App::addAction('plugins_loaded', $this->init(...), 888210);
    }
    public function init()
    {
        if ($this->validate()) {
            $this->initialize();
            define('POP_POSTS_INITIALIZED', true);
        }
    }
    public function validate()
    {
        return true;
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
