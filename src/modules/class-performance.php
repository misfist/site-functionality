<?php
/**
 * Performance
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
 * Performance Class
 */
class Performance extends Base {

	/**
	 * Register hooks and load saved options.
	 *
	 * @since  1.0.2
	 * @return void
	 */
	public function init(): void {
		add_filter( 'script_loader_src', array( $this, 'remove_script_version' ), 15, 1 );
		add_filter( 'style_loader_src', array( $this, 'remove_script_version' ), 15, 1 );
	}

	/**
	 * Remove query strings from static resources
	 *
	 * @since  1.0.2
	 *
	 * @link https://developer.wordpress.org/reference/hooks/script_loader_src/
	 * @link https://developer.wordpress.org/reference/hooks/style_loader_src/
	 *
	 * @param   string $src
	 * @return  string $parts[0]
	 */
	function remove_script_version( string $src ): string {
		$parts = explode( '?ver', $src );
		return $parts[0];
	}
}
