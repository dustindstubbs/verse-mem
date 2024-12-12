<?php

/**
 * @package Verse Mem
 */

/*
Plugin Name: Verse Mem
Description: A fully fledged bible verse memorization tool.
Version: 0.1.0
Author: Dustin Stubbs
License GPLv2 or later
*/

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

class VerseMem
{

	public $plugin;

	//Passing variable to __construct for classes
	function __construct() {
		$this->plugin = plugin_basename( __FILE__ );
	}

	function register() {
		// Admin panel css
		add_action( 'admin_enqueue_scripts', array( $this, 'adminEnqueue' ) );

		// Front end scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'frontEnqueue' ) );

		// Add plugin page links
		add_filter( "plugin_action_links_$this->plugin", array( $this, 'settingsLink') );

		// Add static routes
		add_action( "wp", array( $this, 'staticRoutes' ) );

		// Ajax Add Verse
		add_action( 'wp_ajax_edit_verse', array( $this, 'editVerse' ) );
		add_action( 'wp_ajax_nopriv_edit_verse', array( $this, 'mustLogin' ) );

	}

	public function editVerse() {
		$data = $_POST;
		if ($data['usage'] == 'add') {

			//Clean text
			$text = $data['text'];
			$text = trim(preg_replace('/\s+/', ' ', $text));
			$text = str_replace('“', '', $text);
			$text = str_replace('  ', '', $text);

			$difficulty = ceil(strlen($text)/str_word_count($text))*str_word_count($text)/2;

			add_user_meta( get_current_user_id(), 'mem_verse', array(
				'title' => $data['verse'],
				'text' => $text,
				'difficulty' => $difficulty,
				'score' => 0,
				'completed' => false,
				'last_practice' => 0
			));

		}elseif($data['usage'] == 'delete') {
			if (!is_null($data['key'])){
				delete_user_meta( get_current_user_id(), 'mem_verse', get_user_meta( get_current_user_id(), 'mem_verse' )[$data['key']]);
			}else{
				delete_user_meta( get_current_user_id(), 'mem_verse');
			}
		}elseif($data['usage'] == 'score') {
			// Write increased score for verse
			$verseInitial = get_user_meta( get_current_user_id(), 'mem_verse' )[$data['key']];
			$verseUpdate = $verseInitial;

			$verseUpdate['score'] = $verseUpdate['score']+10;
			$verseUpdate['last_practice'] = date('Ymd');

			if ($verseUpdate['score'] >= $verseUpdate['difficulty']){
				$verseUpdate['completed'] = true;
			}

			update_user_meta(get_current_user_id(), 'mem_verse', $verseUpdate, $verseInitial);
		}
		die;
	}

	public function mustLogin() {
		echo "You must log in first.";
		die();
	}

	public function staticRoutes() {
		global $wp;
		if($wp->request == 'learn'){   
			include plugin_dir_path( __FILE__ ) . 'includes/learn.php';
			die();
		}elseif($wp->request == 'practice'){   
			include(plugin_dir_path( __FILE__ ) . "includes/practice.php");
			die();
		}elseif($wp->request == 'game'){   
			include(plugin_dir_path( __FILE__ ) . "includes/game.php");
			die();
		}elseif($wp->request == 'shop'){   
			include(plugin_dir_path( __FILE__ ) . "includes/shop.php");
			die();
		}elseif($wp->request == 'profile'){   
			include(plugin_dir_path( __FILE__ ) . "includes/profile.php");
			die();
		}elseif($wp->request == 'lineups'){   
			include(plugin_dir_path( __FILE__ ) . "includes/lineups.php");
			die();
		}
	}

	public function trunc($phrase, $max_words) {
		$phrase_array = explode(' ',$phrase);
		if(count($phrase_array) > $max_words && $max_words > 0)
		   $phrase = implode(' ',array_slice($phrase_array, 0, $max_words)).'...';
		return $phrase;
	}

	public function progressIcon($score, $difficulty) {
		if ($score/$difficulty > 0.60){
			include plugin_dir_path( __FILE__ ) . 'assets/img/progress-4.svg';
		}elseif ($score/$difficulty > 0.40){
			include plugin_dir_path( __FILE__ ) . 'assets/img/progress-3.svg';
		}elseif ($score/$difficulty > 0){
			include plugin_dir_path( __FILE__ ) . 'assets/img/progress-2.svg';
		}else{
			include plugin_dir_path( __FILE__ ) . 'assets/img/progress-1.svg';
		}
	}

	public function practiceIcon($unpracticed) {
		if ($unpracticed < 6){
			include plugin_dir_path( __FILE__ ) . 'assets/img/practice-1.svg';
		}else{
			include plugin_dir_path( __FILE__ ) . 'assets/img/practice-2.svg';
		}
	}

	public function settingsLink( $links ) {
		$settingsLink = '<a href="tools.php?page=header-grab-options">Settings</a>';
		array_push( $links, $settingsLink );
		return $links;
	}

	function activate() {
		
		flush_rewrite_rules();
	}

	function deactivate() {
		flush_rewrite_rules();
	}

	function adminEnqueue() {
		//enqueue all of our admin panel scripts
		wp_enqueue_style( 'verse_mem_admin_style', plugins_url( '/assets/admin.css', __FILE__ ) );
		wp_enqueue_script( 'verse_mem_admin_script', plugins_url( '/assets/admin.js', __FILE__ ) );
	}

	function frontEnqueue() {
		//enqueue all of our front end scripts
		wp_enqueue_style( 'verse_mem_style', plugins_url( '/assets/main.css', __FILE__ ) );
		wp_enqueue_script( 'verse_mem_script', plugins_url( '/assets/main.js', __FILE__ ) );
	}

}

if ( class_exists( 'VerseMem' ) ) {
	$VerseMem = new VerseMem();
	$VerseMem->register();
}

require_once plugin_dir_path( __FILE__ ) . 'includes/settings.php';

// activation
register_activation_hook( __FILE__, array( $VerseMem, 'activate' ) );

// deactivation
register_deactivation_hook( __FILE__, array( $VerseMem, 'deactivate' ) );



