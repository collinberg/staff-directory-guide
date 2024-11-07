<?php
/**
 * Plugin Name:     Staff Directory
 * Plugin URI:      https://sjiassociates.com/staff
 * Description:     A Basic Plugin for adding a Staff Page and Custom Post Type
 * Author:          Collin Berg
 * Author URI:      https://hirecollin.com
 * Text Domain:     staff
 * Domain Path:     /languages
 * Version:         1.0.0
 *
 */
 
 
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require plugin_dir_path( __FILE__ ) .'includes/class-post-type.php';
require plugin_dir_path( __FILE__ ) .'includes/class-staff-post-type.php';
require plugin_dir_path( __FILE__ ) .'includes/class-post-type-metaboxes.php';

// Instantiate registration class, so we can add it as a dependency to main plugin class.
$post_type_registrations = new Team_Post_Type_Registrations;

// Instantiate main plugin file, so activation callback does not need to be static.
$post_type = new Team_Post_Type( $post_type_registrations );

// Register callback that is fired when the plugin is activated.
register_activation_hook( __FILE__, array( $post_type, 'activate' ) );

// Initialize registrations for post-activation requests.
$post_type_registrations->init();

// Initialize metaboxes
$post_type_metaboxes = new Team_Post_Type_Metaboxes;
$post_type_metaboxes->init();

/**
 * Adds styling to the dashboard for the post type and adds team posts
 * to the "At a Glance" metabox.
 */
/*
if ( is_admin() ) {

	require plugin_dir_path( __FILE__ ) . 'includes/class-post-type-admin.php';

	$post_type_admin = new Team_Post_Type_Admin( $post_type_registrations );
	$post_type_admin->init();

}
*/


add_action('wp_enqueue_scripts','staff_styles');
function staff_styles(){
  if( is_page() && !is_front_page() ) {
	  wp_enqueue_style( 'staff-styles', plugin_dir_url(__FILE__) .'assets/css/staff.css' );
	}
}




add_filter( 'upload_mimes', 'my_myme_types', 1, 1 );
function my_myme_types( $mime_types ) {
  $mime_types['vcf'] = 'text/x-vcard'; // Adding .json extension
  
  return $mime_types;
}

// Add Shortcode
function staff_shortcode() {

  $args = [
    'post_type'       => 'staff',
    'posts_per_page'  => -1,
    'orderby' => 'menu_order', 
    'order' => 'ASC',
  ];

	// Query
	$the_query = new WP_Query( $args );
	
	// Posts
	$output = '<ul class="staff-list">';
	while ( $the_query->have_posts() ) :
	
		$the_query->the_post();
		
		if( "" != get_the_post_thumbnail_url( $the_query->ID, 'thumbnail') ):
			$post_thumb = get_the_post_thumbnail_url( $the_query->ID, 'full');
		else:
			$post_thumb = plugins_url('assets/img/profile-placeholder.jpg', __FILE__);
		endif;
		
		$output .=  '<li>';

      $output .=  '<a href="' . get_permalink() . '" class="profileLink" title="' . get_the_title() . '">';
      $output .=  '<img src="' . $post_thumb . '"/>';
      $output .=  '<div class="hover-area"><div class="hoverbg"></div><span>→</span></div></a>';
      $output .=  '<h3>' . get_the_title() . '</h3>';
      $output .=  '<span class="staff-title-sc">' . get_post_meta( get_the_ID(), 'profile_title',  true ) . '</span>';
    $output .=  '</li>';
		
	endwhile;
	$output .= '</ul>';
	
	// Reset post data
	wp_reset_postdata();
	
	// Return code
	return $output;

}
add_shortcode( 'staff', 'staff_shortcode' );

