<?php

/**
 * WordPress project configuration file
 *
 * Temporary development only configuration file
 * Add any constants you need for development here
 * Configuration in production will be superseeded later.
 *
 * Reminder: We should not set protocol hardcoded.
 **/

 /**
  * Use a file called env-local.php
  * returning an array similar to this:
  *
  *  ```
  *  return array(
  *    'constants' => array(
  *      'DB_CHARSET'  => 'utf8',
  *      'DB_COLLATE'  => '',
  *      'DB_HOST'     => 'localhost',
  *      'DB_NAME'     => 'wordpress',
  *      'DB_USER'     => 'root',
  *      'DB_PASSWORD' => '',
  *      // And other preferred WordPress constants key-value pairs.
  *    ),
  *    'globals' => array(
  *      'table_prefix' => 'wp_'
  *    )
  *  );
  *  ```
  **/


/**
 * What should not change and can be dynamically set
 **/
define('WP_CONTENT_DIR', __DIR__ . '/public/wp-content');


/**
 * If we have a configuration file matching in production,
 * let's just load it and nothing else.
 *
 * Get files in alphabetical order.
 * Assuming we want order dev,local,production, alphabet got us back;
 *
 * - env-local.php
 *
 *
 **/
$config_files_ignore = ['sample'];
$config_files_superseed = ['production'];
$config_files = [];
array_map(function($file_path) use (&$config_files) {
  $slug = substr(substr(strrchr($file_path, '/env-'), 5), 0, -4);
  $config_files[$slug] = $file_path;
}, glob(__DIR__.'/env-*.php'));

// We do not need sample
unset($config_files['sample']);

// If we have a file matching production, we stop right there
if (in_array('production', array_keys($config_files))) {
  $config_files = ['production' => $config_files['production']];
}

$config_file_loaded = false;
foreach ($config_files as $level_slug => $config_file) {
  #echo 'Loaded '. $level_slug . PHP_EOL; ## DEBUG
  $c = require($config_file);
  foreach ($c['constants'] as $k => $v) {
    #echo $k.':'.$v . PHP_EOL; ## DEBUG
    define($k, $v);
  }
  $config_file_loaded = true;
  break;
}


/**
 * What we should minimally have in a env-$envName.php file
 **/
if (!defined('CONST_PROTO')) {
  define('CONST_PROTO', 'http');
}
if (!defined('WP_CONTENT_URL') && defined('CONST_PROTO')) {
  define('WP_CONTENT_URL', CONST_PROTO.'://'.$_SERVER['SERVER_NAME'].'/wp-content');
}
if (!defined('WP_SITEURL') && defined('CONST_PROTO')) {
  define('WP_SITEURL', CONST_PROTO.'://'.$_SERVER['SERVER_NAME'].'/backoffice');
}
if (!defined('WP_HOME') && defined('CONST_PROTO')) {
  define('WP_HOME', CONST_PROTO.'://'.$_SERVER['SERVER_NAME']);
}

/**
 * Load config.wordpress.php only if we are in development.
 * When we deploy on Cloud-Providers, we'll clone a wp-configurator
 * project and write up a generated configuration array.
 * This allows us to continue support conventions, yet have a stash
 * configuration file to experiment with different settings.
 **/
if ($config_file_loaded === false) {
  if (file_exists(__DIR__.'/config.wordpress.php')) {
    require_once(__DIR__.'/config.wordpress.php');
  } else {
    die('This site is not configured');
  }
}


# vi set ai syntax=php
