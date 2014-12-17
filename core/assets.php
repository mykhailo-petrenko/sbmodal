<?php
class SBModalAssets {
	public function __construct() {
		add_action('wp_enqueue_scripts', array($this, 'register_frontend_assets'));
	}
	
	public function getAssetsUrl() {
		return SBMODAL_URL . 'assets/';
	}
	
	public function register_frontend_assets() {
		wp_enqueue_script('jquery');
		wp_enqueue_script('bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js', array('jquery'), '3.3.1', true);
		
		wp_enqueue_style('bootstrap',  '//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css', null, '3.3.1');
		wp_enqueue_style('sbmodal_front',  $this->getAssetsUrl() . 'css/front.css');
	}
}