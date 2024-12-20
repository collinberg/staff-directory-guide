<?php
/**
 * Staff List Block Pattern
 *
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
            'title'       => __('Staff Listing', 'staff-profile'),
            'description' => __('Persons name with their title below it. Two Columns, The persons profile picture in the first column, and bio in the second column.'),
            'content'     => "<!-- wp:columns -->\n
                <div class=\"wp-block-columns\"><!-- wp:column {\"width\":\"33%\"} -->\n
                    <div class=\"wp-block-column\" style=\"flex-basis:33%\"><!-- wp:post-featured-image /-->\n\n
                        <!-- wp:heading {\"level\":3} -->\n
                        <h3 class=\"wp-block-heading\">Contact Info</h3>\n<!-- /wp:heading -->\n\n
<!-- wp:paragraph {
	"metadata":{
		"bindings":{
			"content":{
				"source":"core/employeeTitle",
				"args":{
					"key":"book-genre"
				}
			}
		}
	}
} -->
<p></p>
<!-- /wp:paragraph -->
                    </div>\n
                <!-- /wp:column -->\n\n
                    <!-- wp:column {\"style\":{\"spacing\":{\"padding\":{\"left\":\"var:preset|spacing|10\"}}},\"layout\":{\"type\":\"default\"}} -->\n
                    <div class=\"wp-block-column\" style=\"padding-left:var(--wp--preset--spacing--10)\"><!-- wp:paragraph -->\n
                    <p>Add Paragraph....</p>\n<!-- /wp:paragraph -->
                </div>\n
                <!-- /wp:column --></div>\n
            <!-- /wp:columns -->",
            'categories'    => array( 'staff' ),
        )
    );
}
add_action('init', 'staff_single_pattern');