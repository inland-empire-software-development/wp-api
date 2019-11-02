<?php

namespace IESD_API;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Not today, bad hombre.' );
}

class Settings {
	function __construct() {
		add_action( 'rest_api_init', [ $this, 'engine_register' ] );
	}

	function prepare_response( array $obj ) {



		return rest_ensure_response( $obj );

	}

	function engine_filter( \WP_REST_Request $request ) {

		if ( isset( $request['name'] ) && ! empty( $request['name'] ) ) {

			$setting = $request['name'];

			$arguments['name'] = strip_tags( $setting );

			$settings = [];

			$settings[$setting] = get_fields('client-settings');

			$response = $this->prepare_response( $settings );

			$query_response = rest_ensure_response( $response );

			return $query_response;

		}

		return rest_ensure_response( [ "error" => "No name passed in." ] );
	}

	function query_args() {
		$args = [];

		$args['name'] = [
			'description' => esc_html( 'Requires a setting name.' ),
			'type'        => 'string'
		];

		return $args;
	}

	function engine_register() {
		register_rest_route( 'iesd/api', '/settings', [
			'methods'  => \WP_REST_Server::READABLE, //  READABLE || EDITABLE || DELETABLE || ALLMETHODS
			'callback' => [
				$this,
				'engine_filter'
			],
			'args'     => $this->query_args(),
		] );
	}
}

new Settings();

//add_action( 'wp', function () {
//	if ( is_single() ) {
//		global $post;
//
//		if ( $post->post_status !== 'draft' && $post->post_password === '' && $post->post_status !== 'private' ) {
//			return;
//		}
//
//		$response = [];
//
//		$authors_array       = getAuthorsArray( $post->authors );
//		$authors_information = [];
//
//		foreach ( $authors_array as $author_data ) {
//			array_push( $authors_information, [
//				'portrait'   => ! empty( $author_data['avatar'] ) ? $author_data['avatar'] : null,
//				'authorPage' => ! empty( $author_data['url'] ) ? $author_data['url'] : null,
//				'name'       => html_entity_decode( $author_data['name'] )
//			] );
//		}
//
//		$category = html_entity_decode( get_post_primary_category( $post->ID ) );
//		$category_url = home_url( '/' ) . '&s=&category_name=' . get_post_primary_category($post->ID, 'category', 'slug');
//		$date     = get_the_date( 'F d, Y', $post->ID );
//
//
//
//		if ( $post->post_type === 'arcuser' || $post->post_type === 'arcnews' || $post->post_type === 'arcwatch' ) {
//			$term     = wp_get_post_terms( $post->ID, $post->post_type . '_issues' );
//			$issue    = is_array( $term ) && array_key_exists( 'name', $term[0] ) ? $term[0]->name : null;
//			$issue_id = is_array( $term ) && array_key_exists( 'term_taxonomy_id', $term[0] ) ? $term[0]->term_taxonomy_id : null;
//			$gateway_url = site_url() . "/" . $post->post_type;
//			$date     = $issue ? $issue : null;
//		} else if ( $post->post_type === 'arcwatch' ) {
//			$date = get_the_date( 'F, Y', $post->ID );
//		} else {
//			switch ( $post->post_type ) {
//				case 'wherenext':
//					$gateway_url = site_url() . "/publications/" . $post->post_type;
//					break;
//				default:
//					$category = ucfirst($post->post_type);
//					$gateway_url = site_url() . "/" . $post->post_type;
//			}
//		}
//
//		$response = [
//			'aib_meta_category'     => $category,
//			'aib_meta_date'         => $date,
//			'aib_post_type'         => $post->post_type,
//			'aib_post_type_gateway' => $category_url,
//			'aib_authors'           => $authors_information,
//			'aib_action_meta_info'  => __("Download article", "newsroom"),
//			'aib_action_meta_url'   => get_post_meta( $post->ID, 'aib_action_meta_url', true),
//			'aib_action_meta_size'  => get_post_meta( $post->ID, 'aib_action_meta_size', true),
//			'issue'                 => $issue ? $issue : null,
//			'issue_id'              => $issue_id ? $issue_id : null,
//			'id' => $post->ID
//		];
//
//		wp_localize_script( 'jquery', 'draft_aib', $response );
//	}
//} );
