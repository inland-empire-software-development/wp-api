<?php

add_filter( 'register_post_type_args', function ( $args, $post_type ) {
	$plural   = false;
	$singular = false;

	switch ( $post_type ) {
		case "staff":
			$plural   = "Staff";
			$singular = "Staff";
			break;
		case "speakers":
			$plural   = "Speakers";
			$singular = "Speaker";
			break;
		case "community":
			$plural   = "Community";
			$singular = "Community";
			break;
		case "story":
			$plural   = "Stories";
			$singular = "Story";
			break;
		case "sponsor":
			$plural   = "Sponsors";
			$singular = "Sponsor";
			break;
		case "settings":
			$plural   = "Settings";
			$singular = "Setting";
			break;
		default:
			break;
	}

	if ( $plural && $singular ) {
		$args['show_in_graphql']     = true;
		$args['graphql_single_name'] = $singular;
		$args['graphql_plural_name'] = $plural;
	}

	return $args;

}, 10, 2 );
