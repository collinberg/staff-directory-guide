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
		add_action( 'init', array($this,'staff_meta'));
	}


	public function staff_meta() {
		register_post_meta(
			'staff',
			'employeeTitle',
			array(
				'show_in_rest' => true,
				'single'       => true,
				'type'         => 'string',
			)
		);
		register_post_meta(
			'staff',
			'employeeEmail',
			array(
				'show_in_rest' => true,
				'single'       => true,
				'type'         => 'string',
			)
		);
		register_post_meta(
			'staff',
			'employeeLinkedin',
			array(
				'show_in_rest' => true,
				'single'       => true,
				'type'         => 'string',
			)
		);
		register_post_meta(
			'staff',
			'employeeThreads',
			array(
				'show_in_rest' => true,
				'single'       => true,
				'type'         => 'string',
			)
		);
	}
}