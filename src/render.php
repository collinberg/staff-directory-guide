<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
global $post;
?>
<div <?php echo get_block_wrapper_attributes(); ?>>
	<div>
		<svg width="24px" height="24px" viewBox="0 0 24 24" stroke-width="1.5" fill="none" xmlns="http://www.w3.org/2000/svg" color="#000000"><path d="M21 4V20C21 21.1046 20.1046 22 19 22H5C3.89543 22 3 21.1046 3 20V4C3 2.89543 3.89543 2 5 2H19C20.1046 2 21 2.89543 21 4Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M3 8L11 8L11 6" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M21 8L13 8L13 6" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
		<p><?php esc_html_e( get_post_meta( $post->ID, 'employeeTitle', true ) ); ?></p>
	</div>
    
	<div>
        <h3>Contact</h3>
		<a href="mailto:<?php esc_html_e( get_post_meta( $post->ID, 'employeeEmail', true ) ); ?>" target="_blank"> <?php esc_html_e( get_post_meta( $post->ID, 'employeeEmail', true ) ); ?></a>
	</div>
</div>