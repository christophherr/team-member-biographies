<?php
/**
 * Custom Post Type functionality
 *
 * @package     ChristophHerr\TeamMemberBiographies\Custom
 * @since       1.0.0
 * @author      christophherr
 * @link        https://www.christophherr.com
 * @license     GNU General Public License 2.0+
 */

namespace ChristophHerr\TeamMemberBiographies\Custom;

add_action( 'init', __NAMESPACE__ . '\register_custom_post_type' );
/**
 * Register the custom post type.
 *
 * @since 1.0.0
 *
 * @return void
 */
function register_custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Team Bios', 'post type general name', 'team-member-biographies' ),
		'singular_name'         => _x( 'Team Bio', 'post type singular name', 'team-member-biographies' ),
		'menu_name'             => _x( 'Team Bios', 'admin menu', 'team-member-biographies' ),
		'name_admin_bar'        => _x( 'Team Bio', 'add new on admin bar', 'team-member-biographies' ),
		'add_new_item'          => __( 'Add New Team Bio', 'team-member-biographies' ),
		'new_item'              => __( 'New Team Bio', 'team-member-biographies' ),
		'edit_item'             => __( 'Edit Team Bio', 'team-member-biographies' ),
		'view_item'             => __( 'View Team Bio', 'team-member-biographies' ),
		'all_items'             => __( 'All Team Bios', 'team-member-biographies' ),
		'search_items'          => __( 'Search Team Bios', 'team-member-biographies' ),
		'parent_item_colon'     => __( 'Parent Team Bios:', 'team-member-biographies' ),
		'not_found'             => __( 'No Team Bios found.', 'team-member-biographies' ),
		'not_found_in_trash'    => __( 'No Team Bios found in Trash.', 'team-member-biographies' ),
		'featured_image'        => __( 'Profile Image', 'team-member-biographies' ),
		'set_featured_image'    => __( 'Set Profile Image', 'team-member-biographies' ),
		'remove_featured_image' => __( 'Remove Profile Image', 'team-member-biographies' ),
		'use_featured_image'    => __( 'Use Profile Image', 'team-member-biographies' ),
	);

	// Get the features of the 'post' post type. The elements in the array are going to be excluded.
	$features = get_all_post_type_features( 'post', array(
		'excerpt',
		'comments',
		'trackbacks',
		'custom-fields',
	) );

	$args = array(
		'label'        => __( 'Team Member Bios', 'team-member-biographies' ),
		'labels'       => $labels,
		'public'       => true,
		'supports'     => $features,
		'menu_icon'    => 'dashicons-admin-users',
		'hierarchical' => false,
		'has_archive'  => true,
	);

	register_post_type( 'team-member-bios', $args );
}

/**
 * Get all the post type features for the given post type.
 *
 * @since 1.0.0
 *
 * @param string $post_type Given post type.
 * @param array  $exclude_features Array of features to exclude.
 * @return array
 */
function get_all_post_type_features( $post_type = 'post', $exclude_features = array() ) {
	$builtin_features = get_all_post_type_supports( $post_type );

	if ( ! $exclude_features ) {
		return array_keys( $builtin_features );
	}

	$features = array_filter( $builtin_features, function( $feature ) use ( $exclude_features ) {
		return ! in_array( $feature, $exclude_features, true );
	}, ARRAY_FILTER_USE_KEY );

	return array_keys( $features );
}
