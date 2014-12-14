<?php

class SBModal {
	private static $_instance = null;
	private $_post_types = null;
	
	private function __construct() {}
	private function __clone() {}
	
	public static function app() {

		if ( is_null(self::$_instance) ) {
			self::$_instance = new static();
		}

		return self::$_instance;
	}
	
	public function init() {}
	
	public function post_types() {
		if ( is_null( $this->_post_types ) ) {
			$this->_post_types = new SBModalPostTypes();
		}
		
		return $this->_post_types;
	}
}

class SBModalAdmin extends SBModal {
	public function init() {
		$this->post_types()->register();
	}
}

class SBModalFront extends SBModal {
	public function init() {
		$this->post_types()->register();
	}
}