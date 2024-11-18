<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
global $post;
?>
<div <?php echo get_block_wrapper_attributes(); ?>>
	<div>
		<p><?php esc_html_e( get_post_meta( $post->ID, 'employeeTitle', true ) ); ?></p>
	</div>
    
	<div>		
		<?php if( !empty(  get_post_meta( $post->ID, 'employeeEmail', true )  ) ): ?>
        	<h3>Contact</h3>
			<a href="mailto:<?php esc_html_e( get_post_meta( $post->ID, 'employeeEmail', true ) ); ?>" target="_blank"> <?php esc_html_e( get_post_meta( $post->ID, 'employeeEmail', true ) ); ?></a>
		<?php endif; ?>

		<?php if( !empty(get_post_meta( $post->ID, 'employeeLinkedin', true )) ||  !empty(get_post_meta( $post->ID, 'employeeThreads', true )) ): ?>
		<div class="sdg_social-links">
			<h3>Socials</h3>

			<?php if( !empty(  get_post_meta( $post->ID, 'employeeLinkedin', true )  ) ): ?>
			<a href="<?php esc_html_e( get_post_meta( $post->ID, 'employeeLinkedin', true ) ); ?>" title="LinkedIn Profile" rel="noreferrer" aria-label="LinkedIn Profile">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
			</a>
			<?php endif; ?>

			<?php if( !empty(  get_post_meta( $post->ID, 'employeeThreads', true )  ) ): ?>
			<a href="<?php esc_html_e( get_post_meta( $post->ID, 'employeeThreads', true ) ); ?>" title="Threads Profile" rel="noreferrer" aria-label="LinkedIn Profile">
				<svg xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 512 512"><path d="M105 0h302c57.75 0 105 47.25 105 105v302c0 57.75-47.25 105-105 105H105C47.25 512 0 464.75 0 407V105C0 47.25 47.25 0 105 0z"/><path fill="#fff" fill-rule="nonzero" d="M337.36 243.58c-1.46-.7-2.95-1.38-4.46-2.02-2.62-48.36-29.04-76.05-73.41-76.33-25.6-.17-48.52 10.27-62.8 31.94l24.4 16.74c10.15-15.4 26.08-18.68 37.81-18.68h.4c14.61.09 25.64 4.34 32.77 12.62 5.19 6.04 8.67 14.37 10.39 24.89-12.96-2.2-26.96-2.88-41.94-2.02-42.18 2.43-69.3 27.03-67.48 61.21.92 17.35 9.56 32.26 24.32 42.01 12.48 8.24 28.56 12.27 45.26 11.35 22.07-1.2 39.37-9.62 51.45-25.01 9.17-11.69 14.97-26.84 17.53-45.92 10.51 6.34 18.3 14.69 22.61 24.73 7.31 17.06 7.74 45.1-15.14 67.96-20.04 20.03-44.14 28.69-80.55 28.96-40.4-.3-70.95-13.26-90.81-38.51-18.6-23.64-28.21-57.79-28.57-101.5.36-43.71 9.97-77.86 28.57-101.5 19.86-25.25 50.41-38.21 90.81-38.51 40.68.3 71.76 13.32 92.39 38.69 10.11 12.44 17.73 28.09 22.76 46.33l28.59-7.63c-6.09-22.45-15.67-41.8-28.72-57.85-26.44-32.53-65.1-49.19-114.92-49.54h-.2c-49.72.35-87.96 17.08-113.64 49.73-22.86 29.05-34.65 69.48-35.04 120.16v.24c.39 50.68 12.18 91.11 35.04 120.16 25.68 32.65 63.92 49.39 113.64 49.73h.2c44.2-.31 75.36-11.88 101.03-37.53 33.58-33.55 32.57-75.6 21.5-101.42-7.94-18.51-23.08-33.55-43.79-43.48zm-76.32 71.76c-18.48 1.04-37.69-7.26-38.64-25.03-.7-13.18 9.38-27.89 39.78-29.64 3.48-.2 6.9-.3 10.25-.3 11.04 0 21.37 1.07 30.76 3.13-3.5 43.74-24.04 50.84-42.15 51.84z"/></svg>
			</a>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</div>
</div>