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

		$content = [];

		if ( isset( $request['name'] ) && ! empty( $request['name'] ) ) {
			$name = strip_tags( $request['name'] );
		}

		if ( isset( $request['set'] ) && ! empty( $request['set'] ) ) {
			$set = strip_tags( $request['set'] );
		}

		if ( empty( $name ) && ! empty( $set ) ) {
			$content = $this->prepare_response( [ get_field_objects( $set ) ] );
		} else if ( ! empty( $name ) && ! empty( $set ) ) {
			$content = $this->prepare_response( [ get_field_object( $name, $set ) ] );
		} else {
			return rest_ensure_response( [ "error" => "No name passed in." ] );
		}

		$query_response = rest_ensure_response( $content );

		return $query_response;

	}

	function query_args() {
		$args = [];

		$args['name'] = [
			'description' => esc_html( 'Name of field you are requesting.' ),
			'type'        => 'string'
		];

		$args['set'] = [
			'description' => esc_html( 'Name of set for fields you are querying.' ),
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
