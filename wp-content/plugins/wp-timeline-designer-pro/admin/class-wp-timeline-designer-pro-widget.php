<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.solwininfotech.com/
 * @since      1.0.0
 *
 * @package    Wp_Timeline_Designer_PRO
 * @subpackage Wp_Timeline_Designer_PRO/admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
add_action( 'widgets_init', 'register_wtl_timeline_widget' );

/**
 * Register Timeline Wdiget Function
 *
 * @since 1.0.0
 * @return void
 */
function register_wtl_timeline_widget() {
	register_widget( 'Wp_Timeline_Designer_Pro_Widget' );
}

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Timeline_Designer_PRO
 * @subpackage Wp_Timeline_Designer_PRO/admin
 * @author     Solwin Infotech <info@solwininfotech.com>
 */
class Wp_Timeline_Designer_Pro_Widget extends WP_Widget {
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		parent::__construct(
			'blog_designer_pro_widget',
			esc_html__( 'WP Timeline Designer PRO', 'wp-timeline-designer-pro' ),
			array(
				'classname'   => 'widgte_wtl_designer_pro_shortcode_list',
				'description' => esc_html__( 'Show posts of WP Timeline Designer Pro. Please use this widget only for full width container area.', 'wp-timeline-designer-pro' ),
			)
		);
		$this->alt_option_name = 'widgte_wtl_designer_pro_shortcode_list';
		add_action( 'save_post', array( $this, 'flush_widget_timeline_designer_pro_shortocde_list' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_timeline_designer_pro_shortocde_list' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_timeline_designer_pro_shortocde_list' ) );
		add_action( 'init', array( &$this, 'flush_widget_timeline_designer_pro_css' ) );
	}

	/**
	 * Flush widget tiemleine designer pro css.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function flush_widget_timeline_designer_pro_css() {
		if ( ! is_admin() ) {
			$font_awesome_icon_url = plugins_url() . '/wp-timeline-designer-pro/public/css/font-awesome.min.css';
			wp_enqueue_style( 'bdp-widget-fontawesome-stylesheets', $font_awesome_icon_url, array(), '5.0', 'all' );
		}
	}

	/**
	 * Flush widget tiemleine designer pro css.
	 *
	 * @since 1.0.0
	 * @param array  $args argument.
	 * @param string $instance instance.
	 * @return void
	 */
	public function widget( $args, $instance ) {
		$wtl_designer_pro_shortcode_list = ( isset( $instance['wtl_designer_pro_shortcode_list'] ) && '' != $instance['wtl_designer_pro_shortcode_list'] ) ? (int) ( $instance['wtl_designer_pro_shortcode_list'] ) : '';
		$title                           = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$before_widget                   = $args['before_widget'];
		$after_widget                    = $args['after_widget'];
		if ( $wtl_designer_pro_shortcode_list ) {
			$wtl_settings = Wp_Timeline_Main::wtl_get_shortcode_settings( $wtl_designer_pro_shortcode_list );
			$wtl_theme    = $wtl_settings['template_name'];
			$style_name   = 'wp-timeline-' . $wtl_theme . '-template';
			wp_enqueue_style( 'wp-timeline-basic-tools' );
			wp_enqueue_style( 'wp-timeline-front' );
			wp_enqueue_script( 'aos' );
			wp_enqueue_style( 'aos' );
			wp_enqueue_script( 'mousewheel' );
			wp_enqueue_script( 'logbook' );
			wp_enqueue_script( 'easing' );
			wp_enqueue_style( 'logbook' );
			wp_enqueue_script( 'slick' );
			wp_enqueue_style( 'slick' );
			wp_enqueue_script( 'featherlight' );
			wp_enqueue_style( 'featherlight' );
			wp_enqueue_style( $style_name );
			$style_file = WP_PLUGIN_DIR . '/wp-timeline-designer-pro/public/css/layouts/' . $wtl_theme . '.css';
			echo '<style type="text/css">';
			echo esc_attr( wp_remote_get( $style_file ) );
			echo '</style>';
			?>
			<script type="text/javascript">
				;(function($) {$(window).load(function(){if(typeof AOS!="undefined"){AOS.init({startEvent:'DOMContentLoaded'})}});})(jQuery);
				jQuery(document).ready(function(){(function($){if (typeof AOS!="undefined"){AOS.init()}}(jQuery))});
			</script>
			<?php
			$wp_timeline_theme = isset( $wtl_settings['template_name'] ) ? $wtl_settings['template_name'] : '';
			$wp_timeline_theme = apply_filters( 'wp_timeline_filter_template', $wp_timeline_theme );
			require_once WP_PLUGIN_DIR . '/wp-timeline-designer-pro/public/css/layout-dynamic-style.php';
		}
		echo wp_kses( $before_widget, Wp_Timeline_Public::args_kses() );
		echo '<h2 class="widget-title">' . esc_html( $title ) . '</h2>';
		echo do_shortcode( '[wp_timeline_design id=' . "$wtl_designer_pro_shortcode_list" . ']' );
		echo wp_kses( $after_widget, Wp_Timeline_Public::args_kses() );
	}

	/**
	 * Shortcode form.
	 *
	 * @since 1.0.0
	 * @param string $instance instance.
	 * @return void
	 */
	public function form( $instance ) {
		$wtl_designer_pro_shortcode_list = isset( $instance['wtl_designer_pro_shortcode_list'] ) ? $instance['wtl_designer_pro_shortcode_list'] : '';
		$title                           = ! empty( $instance['title'] ) ? $instance['title'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'wp-timeline-designer-pro' ); ?>:</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( esc_attr( $title ) ); ?>">
		</p>
		<p>
			<label for="wtl_designer_pro_shortcode_list"><?php esc_html_e( 'Select Timeline Layout', 'wp-timeline-designer-pro' ); ?>:</label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'wtl_designer_pro_shortcode_list' ) ); ?>" class="wtl_designer_pro_shortcode_list" id="wtl_designer_pro_shortcode_list" style="width:100%">
				<option value="">-- <?php esc_html_e( 'Select Timeline Layout', 'wp-timeline-designer-pro' ); ?> --</option>
				<?php
				global $wpdb;
				$shortcodes = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'wtl_shortcodes ' );
				if ( $shortcodes ) {
					foreach ( $shortcodes as $shortcode ) {
						$shortcode_name = $shortcode->shortcode_name;
						?>
						<option value="<?php echo esc_attr( $shortcode->wtlid ); ?>" 
							<?php
							if ( $wtl_designer_pro_shortcode_list == $shortcode->wtlid ) {
								echo 'selected=selected';
							}
							?>
						>
						<?php
						if ( $shortcode_name ) {
							echo wp_kses( $shortcode_name, Wp_Timeline_Public::args_kses() );
						} else {
							esc_html_e( 'No title', 'wp-timeline-designer-pro' );
						}
						?>
						</option>
						<?php
					}
				}
				?>
			</select>
		</p>
		<?php
	}

	/**
	 * Shortcode form update.
	 *
	 * @since 1.0.0
	 * @param string $new_instance instance.
	 * @param string $old_instance instance.
	 * @return string
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                                    = array();
		$instance['title']                           = ( ! empty( $new_instance['title'] ) ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
		$instance['wtl_designer_pro_shortcode_list'] = ( ! empty( $new_instance['wtl_designer_pro_shortcode_list'] ) ) ? (int) ( $new_instance['wtl_designer_pro_shortcode_list'] ) : '';
		$alloptions                                  = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['widgte_wtl_designer_pro_shortcode_list'] ) ) {
			delete_option( 'widgte_wtl_designer_pro_shortcode_list' );
		}
		return $instance;
	}

	/**
	 * Shortcode List.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function flush_widget_timeline_designer_pro_shortocde_list() {
		wp_cache_delete( 'widgte_wtl_designer_pro_shortcode_list', 'widget' );
	}
}

require_once 'class-wp-timeline-designer-pro-vc-extend-add-on.php';
