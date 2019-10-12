<?php

add_filter( 'register_post_type_args', function( $args, $post_type ) {

	if ( 'staff' === $post_type ) {
		$args['show_in_graphql'] = true;
		$args['graphql_single_name'] = 'Staff';
		$args['graphql_plural_name'] = 'Staff';
	}

	if ( 'speakers' === $post_type ) {
		$args['show_in_graphql'] = true;
		$args['graphql_single_name'] = 'Speaker';
		$args['graphql_plural_name'] = 'Speakers';
	}


	if ( 'community' === $post_type ) {
		$args['show_in_graphql'] = true;
		$args['graphql_single_name'] = 'Community';
		$args['graphql_plural_name'] = 'Community';
	}

	return $args;

}, 10, 2 );
