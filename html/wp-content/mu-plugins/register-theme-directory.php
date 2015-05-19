<?php
/**
 * Plugin Name: Register Core Theme Directory
 * Plugin URI: https://github.com/richaber/wpstack
 * Description: Registers the theme directory of WP Core in VCS friendly structure. Based upon the work of Andrey Savchenko and Mark Jaquith.
 * Author: Richard Aber
 * Version: 1.0
 * Author URI: https://github.com/richaber/wpstack
 *
 * @link     http://goo.gl/fghv6l register_theme_directory function reference
 *
 * @var string ABSPATH Absolute path to the WordPress directory
 *
 * @author   Richard Aber <richaber@gmail.com>
 * @version  1.0
 * @category Plugins
 * @package  WPStack
 */

register_theme_directory(ABSPATH . 'wp-content/themes/');
