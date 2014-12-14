<?php
class SBModalPostTypes {
	
	public function register() {
		add_action('init', array($this, '_modal'));
	}
	
	public function _modal() {
		global $wp_rewrite;
		$labels = array(
			'name' => _x('Modals', 'post type general name', 'sbuilder'),
			'singular_name' => _x('Modal', 'post type singular name', 'sbuilder'),
			'menu_name' => _x('Modals', 'admin menu', 'sbuilder'),
			'name_admin_bar' => _x('Modal', 'add new on admin bar', 'sbuilder'),
			'add_new' => _x('Add New', 'book', 'sbuilder'),
			'add_new_item' => __('Add New Modal', 'sbuilder'),
			'new_item' => __('New Modal', 'sbuilder'),
			'edit_item' => __('Edit Modal', 'sbuilder'),
			'view_item' => __('View Modal', 'sbuilder'),
			'all_items' => __('All Modal', 'sbuilder'),
			'search_items' => __('Search Modals', 'sbuilder'),
			'parent_item_colon' => __('Parent Modals:', 'sbuilder'),
			'not_found' => __('No Modals found.', 'sbuilder'),
			'not_found_in_trash' => __('No Modals found in Trash.', 'sbuilder')
		);

		$args = array(
			'labels' => $labels,
			'public' => false,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => array(
				'slug' => 'sb_modals'
			),
			'capability_type' => 'page',
			'hierarchical' => false,
			'menu_position' => 26,
			'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'page-attributes',),
		);
		register_post_type('sb_modals', $args);
		
//		add_action( 'add_meta_boxes', array($this, 'sb_modals_add_meta_box') );
//		add_action( 'save_post', array($this, 'sb_modals_save_meta_box_data') );
	}
}
