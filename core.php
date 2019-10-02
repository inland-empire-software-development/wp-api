<?php

namespace IESD;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Not today, bad hombre.' );
}

/**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */
class Core {
	public $core_resources = [];

	function __construct() {
		add_action( 'after_setup_theme', [ $this, 'setup' ] );
		add_action( 'login_head', function () {
			$this->login();
		} );
	}

	public function setup() {
		add_action( 'login_head', function () {
			$this->login();
		} );
	}

	public function login() {
		require_once 'settings/login/login.php';
	}

	public function path( $path ) {
		return get_site_url() . '/' . str_replace( ABSPATH, '', $path );
	}

	public function load( $parent_directory ) {
		if ( ! ( is_dir( $parent_directory ) || is_file( $parent_directory ) ) ) {
			return $this;
		}
		foreach ( array_diff( scandir( $parent_directory ), [ '.', '..' ] ) as $file_name ) {
			$path = $parent_directory . $file_name;
			if ( is_file( $path ) ) {
				$file_extension = pathinfo( $path, PATHINFO_EXTENSION );
				if ( $file_extension === 'php' ) {
					require_once $path;
				}
			} else if ( is_dir( $path ) ) {
				$this->load( $path . '/' );
			}
		}

		return $this;
	}
}
