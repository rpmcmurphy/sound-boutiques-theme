<?php

// Theme Settings
if ( ! class_exists('WordPress_SimpleSettings') ) require('wordpress-simple-settings.php');

class SoundBoutiqueSettings extends WordPress_SimpleSettings {
	var $prefix = 'soundboutiques';

	function __construct() {
		parent::__construct();
		add_action('admin_menu', array($this, 'menu') );
		register_activation_hook(__FILE__, array($this, 'activate') );
	}

	function menu () {
		add_options_page("SoundBoutiques", "SoundBoutiques", 'manage_options', "soundboutiques-settings", array($this, 'admin_page') );
	}

	function admin_page () {
		include 'soundboutiques-settings-admin.php';
	}

	function activate() {
		$this->add_setting('templates_page_header_title', ''); // string
		$this->add_setting('templates_page_header_subtitle', ''); // string
		$this->add_setting('social_links', ''); // element 1;element 2;element 3;
	}
}

$SoundBoutiqueSettings = new SoundBoutiqueSettings();
// $SoundBoutiqueSettings->get_setting('favorite_array', 'array');
