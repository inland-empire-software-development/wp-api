<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Not today, bad hombre.' );
}
require_once( __DIR__ . '/core.php' );

// TODO: Put this in core
require_once( "inc/class-tgm-plugin-activation.php" );
require_once( "inc/required-plugins.php" );
require_once("inc/graphql.php");
require_once("inc/options.php");

// TODO: use auto loader for routes
require_once("routes/Settings.php");

$IESD = new IESD\Core();
