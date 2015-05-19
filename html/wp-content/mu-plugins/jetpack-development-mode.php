<?php
/**
 * Plugin Name: Jetpack Development Mode
 * Version: 0.0.2
 * Plugin URI: http://voceconnect.com/
 * Description: Turn on Jetpack Development Mode
 * Author: Voce Platforms
 * Author URI: http://voceconnect.com/
 */

if ( ! defined( 'JETPACK_DEV_DEBUG' ) ) {
	define( 'JETPACK_DEV_DEBUG', true );
}

add_filter( 'jetpack_development_mode', '__return_true' );
