<?php

/**
 * Let's superseed wordpress/wp-config.php
 *
 * We'll use __wp_config/ do the rest and figure out
 * configs from there.
 *
 * Ensure the common fallbacks are guessed here.
 *
 * NO CHANGES SHOULD BE MADE HERE!! (EVER!!1)
 **/

 /**
  * Kick composer in.
  *
  * Configuration is expected to be loaded from Composer
  * at autoload.files, in file config.wordpress.php
  **/
if( !file_exists( dirname( dirname( __FILE__ ) ) . '/composer_modules/autoload.php' ) ){
  die('Site is not setup properly. Ensure you have installed your composer modules at root of this site.');
}
require dirname( dirname( __FILE__ ) ) . '/composer_modules/autoload.php';

/**
 * See to superseed $table_prefix from what we get in __wp_config/ configuration. #TODO
 * this has to be there to have a fresh WordPress install work
 */
$table_prefix  = 'wp_';

/**
 * Finish up what wp-config.php would do
 **/
if(!defined('ABSPATH'))
	define('ABSPATH', dirname(__FILE__).'/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
