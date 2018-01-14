<?php
/**
 * Simple autoloader
 *
 * @package     ChristophHerr\TeamMemberBiographies\Support
 * @since       1.0.0
 * @author      christophherr
 * @link        https://www.christophherr.com
 * @license     GNU General Public License 2.0+
 */

namespace ChristophHerr\TeamMemberBiographies\Support;

/**
 * Load the plugin files.
 *
 * @since 1.0.0
 *
 * @param string $src_root_dir Root directory for the source files.
 * @return void
 */
function autoload_files( $src_root_dir ) {

	$filenames = array(
		'custom/post-type',
		'custom/taxonomy',
	);

	foreach ( $filenames as $filename ) {
		include_once $src_root_dir . $filename . '.php';
	}
}
