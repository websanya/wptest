<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @since      1.0.0
 *
 * @package    test_plugin
 * @subpackage test_plugin/public
 */
class Test_Plugin_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of the plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheet for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function test_plugin_enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/test_plugin-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Start buffering.
	 *
	 * @since    1.0.0
	 */
	function test_plugin_wp_head() {
		ob_start( [ $this, 'test_plugin_buffer' ] );
	}

	/**
	 * Place the Hello World code on front page.
	 *
	 * @since    1.0.0
	 *
	 * @param $buffer
	 *
	 * @return mixed
	 */
	public function test_plugin_buffer( $buffer ) {
		if ( is_front_page() ) {
			$startContainerOpen = stripos( $buffer, '<div class="site-news">' );

			date_default_timezone_set( 'Europe/Moscow' );
			$startPluginPos = $startContainerOpen + 24;
			$current_date   = date( 'H' );
			if ( $current_date >= 8 and $current_date < 18 ) {
				$class = 'day';
			} else {
				$class = 'night';
			}
			$pluginHtml = '<div class="plugin-hello ' . $class . '" data-hour="' . $current_date . '">Hello World Plugin!</div>';

			$buffer = substr_replace( $buffer, "\r\n" . $pluginHtml . "\r\n", $startPluginPos, 0 );
		}

		return $buffer;
	}

	/**
	 * Place the ad block itself.
	 *
	 * @since    1.0.0
	 *
	 * @param $content
	 *
	 * @return mixed|string
	 */
	function adg_the_content( $content ) {
		if ( is_singular() ) {
			if ( version_compare( PHP_VERSION, '7.2.0', '>=' ) ) {
				$contentLength = strlen( utf8_decode( $content ) );
			} elseif ( function_exists( 'mb_strlen' ) ) {
				$contentLength = mb_strlen( utf8_decode( $content ) );
			} else {
				$contentLength = strlen( utf8_decode( $content ) );
			}
			$middleContentLength = intval( $contentLength / 2 );

			$content = substr_replace( $content, '<span class="js-agb-mark"></span>', stripos( $content, ' ', $middleContentLength ), 0 );
			$content = '<div class="js-adg-page-content adg-page-content">' . $content . '</div>';
		}

		return $content;
	}

}
