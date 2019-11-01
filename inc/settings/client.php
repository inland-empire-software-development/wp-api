<?php // display the admin options page
if( function_exists('acf_add_options_page') ) {

	// hidden by menu editor pro
	acf_add_options_page(array(
		'menu_title'	=> 'Client Settings',
		'menu_slug' 	=> 'client-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Organization Settings',
		'menu_title'	=> 'Organization',
		'parent_slug'	=> 'client-settings',
	));

}
