<?php
/*
Plugin Name: PoP Add Post Links
Version: 0.1
Description: The foundation for a PoP Add Post Links
Plugin URI: https://getpop.org/
Author: Leonardo Losoviz
*/

//-------------------------------------------------------------------------------------
// Constants Definition
//-------------------------------------------------------------------------------------
define('POP_ADDPOSTLINKS_VERSION', 0.106);
define('POP_ADDPOSTLINKS_DIR', dirname(__FILE__));

class PoP_AddPostLinks
{
    public function __construct()
    {

        // Priority: after PoP Content Creation
        \PoP\Root\App::addAction('plugins_loaded', $this->init(...), 888360);
    }
    public function init()
    {
        if ($this->validate()) {
            $this->initialize();
            define('POP_ADDPOSTLINKS_INITIALIZED', true);
        }
    }
    public function validate()
    {
        return true;
        include_once 'validation.php';
        $validation = new PoP_AddPostLinks_Validation();
        return $validation->validate();
    }
    public function initialize()
    {
        include_once 'initialization.php';
        $initialization = new PoP_AddPostLinks_Initialization();
        return $initialization->initialize();
    }
}

/**
 * Initialization
 */
new PoP_AddPostLinks();
