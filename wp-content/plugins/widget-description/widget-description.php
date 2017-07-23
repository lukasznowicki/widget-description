<?php
/**
 * Plugin Name: Widget Description
 * Description: How to style your widget description field?
 * Version: 0.1.0
 * Author: Łukasz Nowicki
 * Author URI: http://lukasznowicki.info/
 * Requires at least: 4.8
 * Tested up to: 4.8
 */
namespace Phylax\WPPlugin\WD;

if ( !defined( 'ABSPATH' ) ) { exit; }

class Plugin {

	public $widget_description = [];
	public $card_to_ord = [];

	function __construct() {
		$this->card_to_ord = [ 1 => 'First', 'Second', 'Third', 'Fourth', 'Fifth' ];
		add_action( 'widgets_init', [ $this, 'widgets_init' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_enqueue_scripts' ] );
	}

	function admin_enqueue_scripts() {
		wp_enqueue_style( 'wd-widget-css', plugins_url( 'widget.css', __FILE__ ) );
		wp_enqueue_script( 'wd-widget', plugins_url( 'widget.js', __FILE__ ), [ 'jquery' ] );
		wp_localize_script( 'wd-widget', 'widgetdesc', $this->widget_description );
	}

	function widgets_init() {
		for( $index = 1; $index <= 3; $index++ ) {
			$widget_id = 'phylax-desc-sidebar-' . $index;
			$this->widget_description[ $widget_id ] = '<div class="wd-h1">' . $this->card_to_ord[ $index ] . ' sidebar.</div><div class="incolor">And this is <strong>true</strong> description for <em>our widget</em>!</div>';
			register_sidebar( [
				'name' => sprintf( 'Desc sidebar #%d', $index ),
				'id' => $widget_id,
				'description' => '&hellip;'
			] );
		}
	}

}

$wd_plugin = new Plugin();

?>