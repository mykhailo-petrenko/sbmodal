<?php
defined('ABSPATH') or die("No script kiddies please!");

class SBModalFrontView {

	public function __construct() {
		add_action( 'wp_footer', array($this, 'print_modals'), 20 );
	}

	public function print_modals() {
		$script_buff = '';

		# Load modals visible in global scope
		$query_args = array(
			'post_type' => 'sb_modals',
			'meta_query' => array(
				'relation' => 'OR',
				array(
					'key' => 'sb_modals__load_condition',
					'value' => 'custom',
					'compare' => 'NOT LIKE',
				),
				array(
					'key' => 'sb_modals__load_condition',
					'compare' => 'NOT EXISTS',
				),
			),
			'posts_per_page' => 0,
			'nopaging' => true,
		);
		$the_query = new WP_Query( $query_args );
		
		if ( $the_query->have_posts() ) {

			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				
				$script_buff .= $this->appendModal();
			}

		}
		
		wp_reset_query();
		wp_reset_postdata();

		# Load modals with custom visibility
		$current_modals = get_post_meta(get_the_ID(), SBModalPostMeta::$CUSTOM_MODALS_FIELD, true);

		if(!empty($current_modals)) {
			$query_args = array(
				'post_type' => 'sb_modals',
				'post__in' => $current_modals,
				'posts_per_page' => 0,
				'nopaging' => true,
			);
			$the_query = new WP_Query( $query_args );

			if ( $the_query->have_posts() ) {

				while ( $the_query->have_posts() ) {
					$the_query->the_post();

					$script_buff .= $this->appendModal();
				}

			}

			wp_reset_query();
			wp_reset_postdata();
		}
?>
<script type="text/javascript">
(function($) {
	"use strict";
	$(document).on('ready', function(){
<?php echo $script_buff; ?>
	});
})(jQuery);
</script>
<?php
	}

	private function appendModal() {
		$script_buff = '';

		$modal_id = get_the_ID();
		$id = get_post_meta($modal_id, 'sb_modals__id', true);

		if ( empty($id) ) {
			$id = uniqid('sbmodal_');
		}

		$call_selector = get_post_meta($modal_id, 'sb_modals__call_selector', true);
		$call_selector = str_replace('"', '\\"', $call_selector);

		$show_custom_url = get_post_meta($modal_id, 'sb_modals__show_custom_url', true);
		$custom_url = get_post_meta($modal_id, 'sb_modals__custom_url', true);

		if ( !$show_custom_url ) {
			$custom_url = false;
		}

		$script_buff .= $this->generate_javascript('[href=\'#' . $id . '\']', $id);

		if ( !empty($call_selector) ) {
			$script_buff .= $this->generate_javascript( $call_selector, $id );
		}

		if ( !empty( $custom_url ) ) {
			$script_buff .= $this->generate_javascript_for_custom_url( $custom_url, $id );
		}

		$template = get_post_meta($modal_id, 'sb_modals__template', true);
		
		$width = get_post_meta($modal_id, 'sb_modals__width', true);
		$max_width = get_post_meta($modal_id, 'sb_modals__max_width', true);
		
		$class = get_post_meta($modal_id, 'sb_modals__class', true);

		$modal_footer = get_post_meta($modal_id, 'sb_modals__footer', true);
		
		$modal_title = get_the_title();
		$modal_content = apply_filters('the_content', get_the_content());
		
		$this->render( $template, array(
			'width' => $width,
			'max_width' => $max_width,
			'class' => $class,
			'id' => $id,
			'modal_title' => $modal_title,
			'modal_content' => $modal_content,
			'modal_footer' => $modal_footer,
		) );

		return $script_buff;
	}

	private function render( $template, $args ) {
		extract( $args );
		
		$style = '';
		
		if ( !empty( $max_width ) ) {
			$max_width = intval( $max_width );
			
			if ( $max_width > 0 ) {
				$style = "max-width: {$max_width}px; ";
			}
		}

		$args['style'] = $style;
		
		$this->renderTemplate( $template, $args );
	}
	
	public function renderTemplate( $template, $args ) {
		$template_path = SBModalFront::app()->getTemplatePath() . $template . '.php';
		$client_template_path = SBModalFront::app()->getClientTemplatePath() . $template . '.php';
		
		extract($args);
		
		if ( is_file( $client_template_path ) ) {
			require $client_template_path;
		} else if ( is_file( $template_path ) ) {
			require $template_path;
		} else {
			throw new Exception( sprintf(__('Template "%s" is not exists!', 'sbmodal'), $template) );
		}
	}
	
	private function generate_javascript( $call_selector, $modal_id ) {
		ob_start();
?>
		$("<?php echo $call_selector; ?>").click(function(e){ e.preventDefault(); jQuery('#<?php echo $modal_id; ?>').modal('show'); });
<?php
		return ob_get_clean();
	}

  private function generate_javascript_for_custom_url( $custom_url, $modal_id ) {
    ob_start();
?>
    jQuery('#<?php echo $modal_id; ?>')
      .on('show.bs.modal', function (e) {
        window.sb_modal__prev_hash = window.location.hash;
        window.location.hash = '<?php echo $custom_url; ?>';
      })
      .on('hide.bs.modal', function (e) {
        window.location.hash = window.sb_modal__prev_hash || '';
      })
<?php
    return ob_get_clean();
  }
}