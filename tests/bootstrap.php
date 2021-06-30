<?php

/**
 * PHPUnit bootstrap file for WordPress plugin
 */

$tmp_dir = getenv( 'TMPDIR' );
$tmp_dir = $tmp_dir ? $tmp_dir : '/tmp';

$wp_tests_dir = getenv( 'WP_TESTS_LIB_DIR' );
$wp_tests_dir = $wp_tests_dir ? $wp_tests_dir : "$tmp_dir/wordpress-tests-lib";

$wp_core_dir = getenv( 'WP_TESTS_CORE_DIR' );
$wp_core_dir = $wp_core_dir ? $wp_core_dir : "$tmp_dir/wordpress";

$composer_dir = dirname( __DIR__, 2 ) . '/vendor';

if ( ! file_exists( $wp_tests_dir . '/includes/functions.php' ) ) {
    throw new Exception( "Could not find $wp_tests_dir/includes/functions.php, have you run bin/install-wp-tests.sh ?" );
}

$patchwork = "$composer_dir/antecedent/patchwork/Patchwork.php";

if ( file_exists( $patchwork ) ) {
    require_once $patchwork;
}

$autoloader = "$composer_dir/autoload.php";

if ( file_exists( $autoloader ) ) {
    require_once $autoloader;
}

// Start up the WP testing environment.
require "$wp_tests_dir/includes/bootstrap.php";
