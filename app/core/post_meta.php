<?php
defined('ABSPATH') or die("No script kiddies please!");

class SBModalPostMeta {
    public function register() {
		add_action('init', array($this, 'init'));
	}

    public function init() {
        add_action( 'add_meta_boxes', array($this, 'add_meta_boxes') );
    }

    public function add_meta_boxes() {
        $screens = array( 'post', 'page' );
        // @TODO: Add WP Filter for $screens list

        foreach ($screens as $screen) {
            add_meta_box(
				'sb_modals__post_options',
				__( 'SBModal Options', 'sbmodal' ),
				array( $this, 'post_options_meta_box_cb' ),
				$screen
			);
        }
    }

    public function post_options_meta_box_cb() {
?>
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <label><?php _e('Select modals to load', 'sbmodal' );?></label>
                    </th>
                    <td>

                    </td>
                </tr>
            </tbody>
        </table>
<?php
    }
}