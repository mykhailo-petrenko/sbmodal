<?php
defined('ABSPATH') or die("No script kiddies please!");

class SBModalPostMeta {
    private $_nonce_action = 'post_options_meta_box';
	private $_nonce_name = 'post_options_meta_box_nonce';

    public static $CUSTOM_MODALS_FIELD = 'sbmodal_custom_modals';

    public function register() {
		add_action('init', array($this, 'init'));
	}

    public function init() {
        add_action( 'add_meta_boxes', array($this, 'add_meta_boxes') );
        add_action( 'save_post', array($this, 'save_meta_boxes_data') );
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

    public function post_options_meta_box_cb($object) {
        wp_nonce_field( $this->_nonce_action, $this->_nonce_name );

        $query_args = array(
			'post_type' => 'sb_modals',
            'meta_key' => 'sb_modals__load_condition',
            'meta_value' => 'custom',
            'meta_compare' => '=',
			'posts_per_page' => 0,
			'nopaging' => true,
		);
		
		$the_query = new WP_Query( $query_args );
		
		if ( !$the_query->have_posts() ) {
?>
            <em>No modals to select.</em>
<?php
			return;
		}
		
        $current_modals = get_post_meta($object->ID, self::$CUSTOM_MODALS_FIELD, true);
?>
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <label><?php _e('Select modals to load', 'sbmodal' );?></label>
                    </th>
                    <td>
                        <div class="scrollable-checkboxes" style="padding:5px 10px;border:1px solid #eee;max-height:200px;overflow-y:scroll;">
                            <?php while ($the_query->have_posts()):
                                    $the_query->the_post();
                                    $modal_id = get_the_ID();

                                    $is_checked = is_array($current_modals) && in_array($modal_id, $current_modals);
                            ?>
                                <label class="selectit">
                                    <input
                                        type="checkbox"
                                        name="<?php echo self::$CUSTOM_MODALS_FIELD; ?>[]"
                                        value="<?php esc_attr_e($modal_id); ?>"
                                        <?php esc_attr_e($is_checked ? ' checked="checked"' : ''); ?>
                                    >
                                        <?php the_title(); ?>
                                    </label>
                                    <br/>
                            <?php endwhile;
                                wp_reset_query();
                                wp_reset_postdata();
                            ?>
                        </div>
                        <p class="description"><?php _e('Choose witch modal will be loaded on this page.', 'easy-modal' )?></p>
                    </td>
                </tr>
            </tbody>
        </table>
<?php
    }
    
    function save_meta_boxes_data($post_id) {
        
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		
		# Check if our nonce is set.
		if ( ! isset( $_POST[ $this->_nonce_name ] ) ) {
			return;
		}
		
		# Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST[ $this->_nonce_name ], $this->_nonce_action ) ) {
			return;
		}

		# Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}

		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}

        $name = self::$CUSTOM_MODALS_FIELD;
        $value = null;

        if ( isset($_POST[$name]) ) {
            $value = $_POST[$name];

            update_post_meta($post_id, $name, $value);    
        } else {
            delete_post_meta($post_id, $name);
        }
    }
}