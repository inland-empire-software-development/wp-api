<?php // display the admin options page
if ( function_exists( 'acf_add_options_page' ) ) {

	function register_client_settings() {
		// hidden by menu editor pro
		acf_add_options_page( array(
			'menu_title' => 'API Config',
			'menu_slug'  => 'api-config',
			'capability' => 'edit_posts',
			'redirect'   => false
		) );

		acf_add_options_sub_page( array(
			'page_title'  => 'Organization',
			'menu_title'  => 'Organization',
			'post_id'     => 'organization',
			'autoload'    => true,
			'parent_slug' => 'api-config',
		) );

		acf_add_options_sub_page( array(
			'page_title'  => 'Legal',
			'menu_title'  => 'Legal',
			'post_id'     => 'legal',
			'autoload'    => true,
			'parent_slug' => 'api-config',
		) );
	}

	add_action( 'acf/init', 'register_client_settings' );
}
