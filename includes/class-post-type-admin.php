<?php
/**
 * Team Post Type
 *
 * @package   Team_Post_Type
 * @license   GPL-2.0+
 */

/**
 * Register post types and taxonomies.
 *
 * @package Team_Post_Type
 */
class Team_Post_Type_Admin {

	protected $registration_handler;

	public function __construct( $registration_handler ) {
		$this->registration_handler = $registration_handler;
	}

	public function init() {

		// Add thumbnail support for this post type
		add_theme_support( 'post-thumbnails', array( $this->registration_handler->post_type ) );

		// Add thumbnails to column view
		add_filter( 'manage_edit-' . $this->registration_handler->post_type . '_columns', array( $this, 'add_image_column'), 10, 1 );
		add_action( 'manage_' . $this->registration_handler->post_type . '_posts_custom_column', array( $this, 'display_image' ), 10, 1 );

		// Allow filtering of posts by taxonomy in the admin view
		add_action( 'restrict_manage_posts', array( $this, 'add_taxonomy_filters' ) );

		// Show post counts in the dashboard
		add_action( 'right_now_content_table_end', array( $this, 'add_rightnow_counts' ) );
		add_action( 'dashboard_glance_items', array( $this, 'staff_to_at_a_glance' ) );

	}

	/**
	 * Add columns to post type list screen.
	 *
	 * @link http://wptheming.com/2010/07/column-edit-pages/
	 *
	 * @param array $columns Existing columns.
	 *
	 * @return array Amended columns.
	 */
	public function add_image_column( $columns ) {
		$column_thumbnail = array( 'thumbnail' => __( 'Image', 'team-post-type' ) );
		return array_slice( $columns, 0, 2, true ) + $column_thumbnail + array_slice( $columns, 1, null, true );
	}

	/**
	 * Custom column callback
	 *
	 * @global stdClass $post Post object.
	 *
	 * @param string $column Column ID.
	 */
	public function display_image( $column ) {

		// global $post;
		switch ( $column ) {
			case 'thumbnail':
				// echo get_the_post_thumbnail( $post->ID, array(35, 35) );
				echo get_the_post_thumbnail( get_the_ID(), array( 35, 35 ) );
				break;
		}
	}

	/**
	 * Add taxonomy filters to the post type list page.
	 *
	 * Code artfully lifted from http://pippinsplugins.com/
	 *
	 * @global string $typenow
	 */
	public function add_taxonomy_filters() {
		global $typenow;

		// Must set this to the post type you want the filter(s) displayed on
		if ( $this->registration_handler->post_type !== $typenow ) {
			return;
		}

		foreach ( $this->registration_handler->taxonomies as $tax_slug ) {
			echo $this->build_taxonomy_filter( $tax_slug );
		}
	}

	/**
	 * Build an individual dropdown filter.
	 *
	 * @param  string $tax_slug Taxonomy slug to build filter for.
	 *
	 * @return string Markup, or empty string if taxonomy has no terms.
	 */
	protected function build_taxonomy_filter( $tax_slug ) {
		$terms = get_terms( $tax_slug );
		if ( 0 == count( $terms ) ) {
			return '';
		}

		$tax_name         = $this->get_taxonomy_name_from_slug( $tax_slug );
		$current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;

		$filter  = '<select name="' . esc_attr( $tax_slug ) . '" id="' . esc_attr( $tax_slug ) . '" class="postform">';
		$filter .= '<option value="0">' . esc_html( $tax_name ) .'</option>';
		$filter .= $this->build_term_options( $terms, $current_tax_slug );
		$filter .= '</select>';

		return $filter;
	}

	/**
	 * Get the friendly taxonomy name, if given a taxonomy slug.
	 *
	 * @param  string $tax_slug Taxonomy slug.
	 *
	 * @return string Friendly name of taxonomy, or empty string if not a valid taxonomy.
	 */
	protected function get_taxonomy_name_from_slug( $tax_slug ) {
		$tax_obj = get_taxonomy( $tax_slug );
		if ( ! $tax_obj )
			return '';
		return $tax_obj->labels->name;
	}

	/**
	 * Build a series of option elements from an array.
	 *
	 * Also checks to see if one of the options is selected.
	 *
	 * @param  array  $terms            Array of term objects.
	 * @param  string $current_tax_slug Slug of currently selected term.
	 *
	 * @return string Markup.
	 */
	protected function build_term_options( $terms, $current_tax_slug ) {
		$options = '';
		foreach ( $terms as $term ) {
			$options .= sprintf(
				'<option value="%s"%s />%s</option>',
				esc_attr( $term->slug ),
				selected( $current_tax_slug, $term->slug, false ),
				esc_html( $term->name . '(' . $term->count . ')' )
			);
		}
		return $options;
	}

	/**
	 * Add counts to "At a Glance" dashboard widget in WP 3.8+
	 *
	 * @since 0.1.0
	 */
	public function staff_to_at_a_glance() {
	    // Custom post types counts
	    $post_types = get_post_types( 
	    	array( 
	    		'_builtin'	=> false,
	    		'public'	=> true,
	    	),
	    	'objects' );
		foreach ( $post_types as $post_type ) {
	    	$num_posts = wp_count_posts( $post_type->name );
			$num = number_format_i18n( $num_posts->publish );
			$text = _n( $post_type->labels->singular_name, $post_type->labels->name, $num_posts->publish );
			if ( current_user_can( 'edit_posts' ) ) {
	        	$num = '<li class="page-count"><a href="edit.php?post_type=' . $post_type->name . '">' . $num . ' ' . $text . '</a></li>';
	    	}
			echo $num;
		}
	}
}