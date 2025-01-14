<?php
/**
 * Plugin Name:     Staff Directory
 * Plugin URI:      https://hirecollin.com/projects/staff
 * Description:     A Basic Plugin for adding a Staff Page and Custom Post Type
 * Author:          Collin Berg
 * Author URI:      https://hirecollin.com
 * Text Domain:     sdg
 * Requires at least: 6.1
 * Requires PHP:      8.0
 * Version:           0.1.0
 *
 */
 
 
// If this file is called directly, abort.
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

require plugin_dir_path( __FILE__ ) .'includes/class-post-type.php';
require plugin_dir_path( __FILE__ ) .'includes/class-staff-post-type.php';
require plugin_dir_path( __FILE__ ) .'includes/class-block-patterns.php';
require plugin_dir_path( __FILE__ ) .'includes/class-post-type-post_meta.php';

// Instantiate registration class, so we can add it as a dependency to main plugin class.
$post_type_registrations = new Team_Post_Type_Registrations;

// Instantiate main plugin file, so activation callback does not need to be static.
$post_type = new Team_Post_Type( $post_type_registrations );

// Register callback that is fired when the plugin is activated.
register_activation_hook( __FILE__, array( $post_type, 'activate' ) );

// Initialize registrations for post-activation requests.
$post_type_registrations->init();

// Initialize metaboxes
$post_type_metaboxes = new Staff_Post_Type_Metaboxes;
$post_type_metaboxes->init();

/**
 * Registers the CSS file for the archive and shortcode.
 * We're only doing this if the theme is not a block theme. For block themes, the style will be loaded in with the blocks.
 *
 * @see https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts/
 */
function staff_styles(){
    if( is_page() && !is_front_page() ) {
      wp_enqueue_style( 'staff-styles', plugin_dir_url(__FILE__) .'assets/css/staff.css' );
    }
}
add_action('wp_enqueue_scripts','staff_styles');
/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function staff_register_meta_block()
{
	register_block_type(__DIR__ . '/build/staff-profile');
}
add_action('init', 'staff_register_meta_block');



add_filter( 'upload_mimes', 'my_myme_types', 1, 1 );
function my_myme_types( $mime_types ) {
  $mime_types['vcf'] = 'text/x-vcard'; // Adding .json extension
  
  return $mime_types;
}

/**
 *
 * Register a Shortcode for displaying a list of hte staff
 */
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

function staff_single_template($single) {
    global $post;

    // Check if the post type matches
    if ($post->post_type == 'staff' ) {
        // Locate the custom template in your plugin folder
        if (file_exists(plugin_dir_path(__FILE__) . '/templates/single-staff.html')) {
            return plugin_dir_path(__FILE__) . '/templates/single-staff.html';
        }
    }
    return $single;
}
add_filter('single_template', 'staff_single_template');


/*
 * Function for grabbing templates and returning them as a string. We use this when building block templates.
 */
function staff_template_block_build($template){
  ob_start();
  include __DIR__ . "/templates/{$template}";
  return ob_get_clean();
}
/* 
 * Registers a block template for the Staff Profile block.
 * @see https://developer.wordpress.org/reference/functions/register_block_template/
 */
add_action( 'init', 'staff_block_theme_template' );
function staff_block_theme_template() {
    register_block_template(
        'staff-directory-guide//staff-profile',
        [
          'title'       => 'Single Staff',
          'description' => 'Displays a Staff Profile on your website unless a custom template has been applied to that post or a dedicated template exists.',
          'content'     => staff_template_block_build('single-staff.html'),
          'post_types'  => array( 'staff' ),
        ]
    ); 
}
//For whatever Reason, this is not working. It does not check the post type correctly it seems.
// add_action('single_template_hierarchy', 'staff_single_template_default',99);
// function staff_single_template_default($single) {
//     global $post;

//     // Check if the post type matches
//     if ($post->post_type == 'staff' ) {
//         // Locate the custom template in your plugin folder
//           return ['staff-profile'];
//     }
//     return $single;
// }
