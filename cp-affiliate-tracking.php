<?php
/**
* Plugin Name: Inflektion Affiliate Tracking - Enhanced Attribution
* Plugin URI: https://inflektion.ai/
* Description: Sets tracking cookies based on get parameters to ensure proper attribution
* Version: 1.4
* Author: Inflektion
**/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
cpatea_set_cookie
Sets a cpclid cookie if there is a non empty get parameter of cpclid
This makes it on the same domain/ip
*/
function cpatea_set_cookie() {

  if (isset($_GET["cpclid"]) && !empty($_GET["cpclid"])) {
    $hostName = cpatea_get_domain();
    setcookie("cpclid", sanitize_text_field($_GET["cpclid"]), time()+60*60*24*365, '/', $hostName, true);
  }
}

//add the action to set the cookie
add_action( 'init', 'cpatea_set_cookie' );


/*
cpatea_get_domain
simple function to get just the domain of the wordpress site
*/
function cpatea_get_domain() {
  $siteURL    = site_url(); // Wordpress get the site url ( not necessarily the current domain, but what it thinks it is)
  $parts = wp_parse_url( $siteURL ); // parse and grab the host

  if ( ! $parts )
    return "";

  return $parts['host'];
}