<?php

require_once (SBMODAL_PATH . 'core/sbmodal.php');
require_once (SBMODAL_PATH . 'core/post_type.php');

if ( is_admin() ) {
	SBModalAdmin::app()->init();
} else {
	SBModalFront::app()->init();
}