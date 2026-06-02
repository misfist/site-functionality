<?php
/**
 * Security
 *
 * Custom security settings
 *
 * @since   1.0.2
 * @package Site_Functionality
 */

namespace Site_Functionality\Modules;

use Site_Functionality\Common\Abstracts\Base;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Security Class
 */
class Security extends Base {

	/**
	 * Register hooks and load saved options.
	 *
	 * @since  1.0.2
	 * @return void
	 */
	public function init(): void {
		add_filter( 'script_loader_src', array( $this, 'remove_wp_version_strings' ) );
		add_filter( 'style_loader_src', array( $this, 'remove_wp_version_strings' ) );

		add_filter( 'the_generator', array( $this, 'remove_wp_version_meta_tag' ) );
	}

	/**
	 * Hide WP version strings from scripts and styles
	 *
	 * @since      @since 1.0.2
	 * 
	 * @link https://developer.wordpress.org/reference/hooks/script_loader_src/
	 * @link https://developer.wordpress.org/reference/hooks/style_loader_src/
	 *
	 * @param string $src
	 * @return string
	 */
	function remove_wp_version_strings( string $src ): string {
		global $wp_version;

		parse_str( parse_url( $src, PHP_URL_QUERY ), $query );

		if ( ! empty( $query['ver'] ) && $query['ver'] === $wp_version ) {
			$src = remove_query_arg( 'ver', $src );
		}

		return $src;
	}

	/**
	 * Hide WP version strings from generator meta tag
	 * 
	 * @link https://developer.wordpress.org/reference/hooks/the_generator/
	 *
	 * @since   0.1.0
	 *
	 * @return string Empty string
	 */
	function remove_wp_version_meta_tag(): string {
		return '';
	}
}
