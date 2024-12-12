<?php

/**
* Trigger this file on plugin unintsall
*
* @package UptimePlugin
*/

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	delete_metadata( 'user', $user_id, 'mem_verse', null, true );
	die;
}