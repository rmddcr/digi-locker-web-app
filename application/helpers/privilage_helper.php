<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('get_privilage_array')) {
    function get_privilage_array($access_level)
    {
        if ($access_level == 1) {
            $privilages['a'] ="block";
            $privilages['b'] ="block";

        } elseif ($access_level == 2) {
            $privilages['a'] ="block";
            $privilages['b'] ="block";

        } elseif ($access_level == 3) {
            $privilages['a'] ="block";
            $privilages['b'] ="block";

        } else {
            $privilages['a'] = "none";
            $privilages['b'] = "none";


        }

        return $privilages;
        //Your code here
    }
}


