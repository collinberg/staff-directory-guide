<?php
/**
 * Staff Blocks
 *
 * @package   Team_Post_Type
 * @license   GPL-2.0+
 */
register_block_pattern_category(
    'staff',
    array( 'label' => __( 'Staff', 'staff-directory-guide' ) )
);

function staff_single_pattern()
{
 
    register_block_pattern(
        'staff-directory-plugin/staff-single',
        array(
            'title'       => __('Staff Profile', 'staff-profile'),
            'description' => __('Persons name with their title below it. Two Columns, The persons profile picture in the first column, and bio in the second column.'),
            'content'     => "<!-- wp:columns -->\n<div class=\"wp-block-columns\"><!-- wp:column {\"width\":\"33%\"} -->\n<div class=\"wp-block-column\" style=\"flex-basis:33%\"><!-- wp:post-featured-image /-->\n\n<!-- wp:heading {\"level\":3} -->\n<h3 class=\"wp-block-heading\">Contact Info</h3>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"placeholder\":\"Add a inner paragraph\"} -->\n<p></p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"style\":{\"spacing\":{\"padding\":{\"left\":\"var:preset|spacing|10\"}}},\"layout\":{\"type\":\"default\"}} -->\n<div class=\"wp-block-column\" style=\"padding-left:var(--wp--preset--spacing--10)\"><!-- wp:paragraph -->\n<p>Add Paragraph....</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns -->",
            'categories'    => array( 'staff' ),
        )
    );
}
add_action('init', 'staff_single_pattern');