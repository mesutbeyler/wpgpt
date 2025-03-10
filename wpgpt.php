<?php
/**
 * Plugin Name:       WPGPT
 * Plugin URI:        https://github.com/dreamsicle-io/wpgpt/
 * Description:       An experimental plugin integrating ChapGPT with WordPress.
 * Version:           0.1.0
 * Requires at least: 6.0.0
 * Requires PHP:      7.4.0
 * Author:            Dreamsicle
 * Author URI:        https://www.dreamsicle.io/
 * License:           UNLICENSED
 * Text Domain:       wpgpt
 * Domain Path:       /languages
 *
 * @package wpgpt
 */

define( 'WPGPT_PATH', plugin_dir_path( __FILE__ ) );

require WPGPT_PATH . '/vendor/autoload.php';
require WPGPT_PATH . '/includes/class-wpgpt.php';
require WPGPT_PATH . '/includes/class-wpgpt-settings.php';
require WPGPT_PATH . '/includes/class-wpgpt-post-generator.php';
require WPGPT_PATH . '/includes/class-wpgpt-caption-generator.php';
require WPGPT_PATH . '/includes/class-wpgpt-utils.php';

add_action( 'plugins_loaded', array( new WPGPT(), 'init' ), 0 );
add_action( 'plugins_loaded', array( new WPGPT_Settings(), 'init' ), 0 );
add_action( 'plugins_loaded', array( new WPGPT_Post_Generator(), 'init' ), 0 );
add_action( 'plugins_loaded', array( new WPGPT_Caption_Generator(), 'init' ), 0 );
