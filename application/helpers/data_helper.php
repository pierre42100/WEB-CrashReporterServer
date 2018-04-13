<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Data helper
 *
 * @author Pierre HUBERT
 */

if(!function_exists("path_data")){


    /**
     * Get the system path to data helper
     *
     * @param string $uri The URI pointing to a file (optionnal)
     * @return string The full path to data helper
     */
    function path_data(string $uri = "") : string {
        return get_instance()->config->item("data_directory");
    }
    
}