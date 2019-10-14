<?php

add_filter( 'register_post_type_args', function( $args, $post_type ) {

	if ( 'staff' === $post_type ) {
		$args['show_in_graphql'] = true;
		$args['graphql_single_name'] = 'Staff';
		$args['graphql_plural_name'] = 'Staff';
	}
	elseif ( 'speakers' === $post_type ) {
		$args['show_in_graphql'] = true;
		$args['graphql_single_name'] = 'Speaker';
		$args['graphql_plural_name'] = 'Speakers';
	} elseif ( 'community' === $post_type ) {
		$args['show_in_graphql'] = true;
		$args['graphql_single_name'] = 'Community';
		$args['graphql_plural_name'] = 'Community';
	} elseif ( 'story' === $post_type ) {
		$args['show_in_graphql'] = true;
		$args['graphql_single_name'] = 'Story';
		$args['graphql_plural_name'] = 'Stories';
	} elseif ( 'sponsor' === $post_type ) {
		$args['show_in_graphql'] = true;
		$args['graphql_single_name'] = 'Sponsor';
		$args['graphql_plural_name'] = 'Sponsors';
	}

	return $args;

}, 10, 2 );
