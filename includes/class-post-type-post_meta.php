<?php
/**
 * Team Post Type
 *
 * @package   Team_Post_Type
 * @license   GPL-2.0+
 */

/**
 * Register metaboxes.
 *
 * @package Staff_Post_Type
 */
class Staff_Post_Type_Metaboxes {

	public function init() {
		add_action( 'init', array($this,'staff_meta') );
	}

	public function staff_meta() {
		register_post_meta(
			'staff',
			'employee_title',
			array(
				'show_in_rest' => true,
				'single'       => true,
				'type'         => 'string',
			)
		);

		register_post_meta(
			'staff',
			'employee_email',
			array(
				'show_in_rest' => true,
				'single'       => true,
				'type'         => 'string',
			)
		);
	}


	
}