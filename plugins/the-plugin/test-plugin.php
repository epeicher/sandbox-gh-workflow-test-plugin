<?php
/*
Plugin Name: Test plugin
Description: Plugin for testing GitHub deployments on WordPress.com 
Version: 0.1.0
Author: @gcsecsey
Author URI: http://gcsecsey.dev
*/

add_action(
    'wp_head', function () {
	    echo '<div style="background: #efe; color: #060; padding: 10px; font-weight: bold;">';
	    echo 'The test plugin was deployed from the main branch';
	    echo 'This should not be synchronized';
	    echo '</div>';
    }
);
