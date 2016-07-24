<?php

/**
 * Front controller
 *
 * This should allow us to control doorslams for maintenance and
 * replace what would be in wordpress/index.php.
 *
 * NO CHANGES SHOULD BE MADE HERE!! (EVER!1)
 **/

/**
 * Front to the WordPress application.
 *
 * We first load configuration, then delegate to WordPress.
 */

/**
 * Kick composer in
 *
 * Configuration is expected to be loaded from Composer
 * at autoload.files, in file config.wordpress.php
 **/
if( !file_exists( dirname( dirname( __FILE__ ) ) . '/composer_modules/autoload.php' ) ){
 die('Site is not setup properly. Ensure you have installed your composer modules at root of this site.');
}
require dirname( dirname( __FILE__ ) ) . '/composer_modules/autoload.php';

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . '/backoffice/wp-blog-header.php' );
