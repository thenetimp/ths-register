<?php
/**
 * @package THS Register
 * @version 1.0
 */
/*
Plugin Name: THS Register
Description: A simple plugin allowing a user to register on a wordpress website
Author: James Andrews
Version: 1.0
*/

require_once(dirname(__FILE__) . '/functions.php');

// Add shortcodes
add_shortcode( 'memreg_register_form', 'ths_register\functions\register_form' );
add_shortcode( 'memreg_register_success', 'ths_register\functions\register_success' );