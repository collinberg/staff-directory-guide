<?php
/**
 * Staff Post Type DECLARED.
 *
 * @param array $messages Existing post update messages.
 *
 * @return array Amended post update messages with new CPT update messages.
 */

class Team_Post_Type_Registrations {
	
	public $post_type = 'staff';

	public $taxonomies = array( 'staff-category' );

	public function init() {
		// Add the staff post type and taxonomies
		add_action( 'init', array( $this, 'register' ) );
	}
	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses Team_Post_Type_Registrations::register_post_type()
	 * @uses Team_Post_Type_Registrations::register_taxonomy_category()
	 */
	public function register() {
		$this->register_post_type();
		$this->register_taxonomy_category();
	}
	/**
	 * Register the custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	//add_action( 'init', 'staff_CPT_declare' );
	protected function register_post_type() {
		$labels = array(
			'name'               => _x( 'Staff', 'staff', 'staff-direcotry-guide' ),
			'singular_name'      => _x( 'Staff Member', 'staff', 'staff-direcotry-guide' ),
			'menu_name'          => _x( 'Staff', 'admin menu', 'staff-direcotry-guide' ),
			'name_admin_bar'     => _x( 'Staff', 'add new on admin bar', 'staff-direcotry-guide' ),
			'add_new'            => _x( 'Add New Staff Member', 'staff', 'staff-direcotry-guide' ),
			'add_new_item'       => __( 'Add New Staff Member', 'staff-direcotry-guide' ),
			'new_item'           => __( 'New Staff Member', 'staff-direcotry-guide' ),
			'edit_item'          => __( 'Edit Staff Member', 'staff-direcotry-guide' ),
			'view_item'          => __( 'View Staff Member', 'staff-direcotry-guide' ),
			'all_items'          => __( 'All Staff', 'staff-direcotry-guide' ),
			'search_items'       => __( 'Search Staff', 'staff-direcotry-guide' ),
			'parent_item_colon'  => __( 'Parent Staff Member:', 'staff-direcotry-guide' ),
			'not_found'          => __( 'No Staff Member found.', 'staff-direcotry-guide' ),
			'not_found_in_trash' => __( 'No Staff Member found in Trash.', 'staff-direcotry-guide' )
		);
	
		$args = array(
			'labels'             => $labels,
	        'description'        => __( 'Description.', 'staff-direcotry-guide' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array('slug' => 'staff', 'with_front' => false),
			'capability_type'    => 'post',
			'has_archive'        => false,		
			'hierarchical'       => true,
			'menu_position'      => null,
			'menu_icon' => 'dashicons-admin-users',
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail','page-attributes')
		);
	
		register_post_type( $this->post_type, $args );
	}
	
	/**
	 * Register a taxonomy for Team Categories.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_taxonomy_category() {
		$labels = array(
			'name'                       => __( 'Staff Categories', 'staff-direcotry-guide' ),
			'singular_name'              => __( 'Staff Category', 'staff-direcotry-guide' ),
			'menu_name'                  => __( 'Staff Categories', 'staff-direcotry-guide' ),
			'edit_item'                  => __( 'Edit Staff Category', 'staff-direcotry-guide' ),
			'update_item'                => __( 'Update Staff Category', 'staff-direcotry-guide' ),
			'add_new_item'               => __( 'Add New Staff Category', 'staff-direcotry-guide' ),
			'new_item_name'              => __( 'New Team Category Staff', 'staff-direcotry-guide' ),
			'parent_item'                => __( 'Parent Staff Category', 'staff-direcotry-guide' ),
			'parent_item_colon'          => __( 'Parent Staff Category:', 'staff-direcotry-guide' ),
			'all_items'                  => __( 'All Staff Categories', 'staff-direcotry-guide' ),
			'search_items'               => __( 'Search Staff Categories', 'staff-direcotry-guide' ),
			'popular_items'              => __( 'Popular Staff Categories', 'staff-direcotry-guide' ),
			'separate_items_with_commas' => __( 'Separate Staff categories with commas', 'staff-direcotry-guide' ),
			'add_or_remove_items'        => __( 'Add or remove team categories', 'staff-direcotry-guide' ),
			'choose_from_most_used'      => __( 'Choose from the most used staff categories', 'staff-direcotry-guide' ),
			'not_found'                  => __( 'No staff categories found.', 'staff-direcotry-guide' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'staff-category' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'team_post_type_category_args', $args );

		register_taxonomy( $this->taxonomies[0], $this->post_type, $args );
	}		 			
}