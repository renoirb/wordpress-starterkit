<?php

/**
 * Must-Use plugins... functions to disable non needed WordPress features
 *
 * Those are things I generally disable to make the HTML be
 * cleaner and to remove things I don't need from WordPress
 **/


add_action( 'wp', function() {

  /**
   * Remove unneeded wlmanifest and rsd links in head
   *
   * They're useful only if we use mobile WordPress editor apps
   **/
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'rsd_link');

  /**
   * Remove the admin bar from frontend when logged-in, we do not need it
   **/
  show_admin_bar(false);

} );
