<?php
/**
 * Custom Taxonomy functionality
 *
 * @package     ChristophHerr\TeamMemberBiographies\Custom
 * @since       1.0.0
 * @author      christophherr
 * @link        https://www.christophherr.com
 * @license     GNU General Public License 2.0+
 */

namespace ChristophHerr\TeamMemberBiographies\Custom;

add_action( 'init', __NAMESPACE__ . '\register_custom_taxonomy' );
/**
 * Register the custom taxonomy.
 *
 * @since 1.0.0
 *
 * @return void
 */
function register_custom_taxonomy() {

	$menu_label = __( 'Departments', 'team-member-biography' );

	$labels = array(
		'name'                       => _x( 'Departments', 'taxonomy general name', 'team-member-biography' ),
		'singular_name'              => _x( 'Department', 'taxonomy singular name', 'team-member-biography' ),
		'search_items'               => __( 'Search Departments', 'team-member-biography' ),
		'popular_items'              => __( 'Popular Departments', 'team-member-biography' ),
		'all_items'                  => __( 'All Departments', 'team-member-biography' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Department', 'team-member-biography' ),
		'view_item'                  => __( 'View Department', 'team-member-biography' ),
		'update_item'                => __( 'Update Department', 'team-member-biography' ),
		'add_new_item'               => __( 'Add New Department', 'team-member-biography' ),
		'new_item_name'              => __( 'New Department Name', 'team-member-biography' ),
		'separate_items_with_commas' => __( 'Separate departments with commas', 'team-member-biography' ),
		'add_or_remove_items'        => __( 'Add or remove departments', 'team-member-biography' ),
		'choose_from_most_used'      => __( 'Choose from the most used departments.', 'team-member-biography' ),
		'not_found'                  => __( 'No departments found.', 'team-member-biography' ),
		'menu_name'                  => $menu_label,
	);

	$args = array(
		'label'             => $menu_label,
		'labels'            => $labels,
		'hierarchical'      => true,
		'show_admin_column' => true,
	);

	register_taxonomy( 'department', 'team-member-bios', $args );
}

add_filter( 'genesis_post_meta', __NAMESPACE__ . '\filter_footer_post_meta' );
/**
 * Add taxonomy to post_meta
 *
 * @param string $post_meta Post meta passed from Genesis core.
 * @return string $post_meta with taxonomy added.
 */
function filter_footer_post_meta( $post_meta ) {
	$post_meta .= sprintf(
		' [post_terms taxonomy="department" before="%s"]',
		__( 'Department: ', 'team-member-biography' )
	);
	return $post_meta;
}
