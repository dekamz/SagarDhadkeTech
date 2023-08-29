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
	die( '-1' );
}

/**
 * Add-on for Visual Composer plugins.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Timeline_Designer_PRO
 * @subpackage Wp_Timeline_Designer_PRO/admin
 * @author     Solwin Infotech <info@solwininfotech.com>
 */
class Wp_Timeline_Designer_Pro_VC_Extend_Add_On {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		// We safely integrate with VC with this hook.
		add_action( 'init', array( $this, 'integrate_with_vc' ) );
		// Use this when creating a shortcode addon.
		add_shortcode( 'bartag', array( $this, 'render_my_bar_tag' ) );
	}

	/**
	 * Integrate with VC
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function integrate_with_vc() {
		if ( ! defined( 'WPB_VC_VERSION' ) ) {
			return;
		}
		global $wpdb;
		$shortcodes = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'wtl_shortcodes ' );
		$scode_id   = array();
		if ( $shortcodes ) {
			foreach ( $shortcodes as $shortcode ) {
				$shortcode_name              = $shortcode->shortcode_name;
				$sid                         = strval( $shortcode->wtlid );
				$scode_id[ $shortcode_name ] = $sid;

			}
		}
		vc_map(
			array(
				'name'        => esc_html__( 'WP Timeline Designer PRO', 'vc_extend' ),
				'description' => esc_html__( 'Show posts of WP Timeline Designer Pro. Please use this widget only for full width container area.', 'wp-timeline-designer-pro' ),
				'base'        => 'bartag',
				'class'       => '',
				'controls'    => 'full',
				'icon'        => plugins_url( 'images/wp-timeline.png', __FILE__ ),
				'category'    => esc_html__( 'WordPress Widgets', 'js_composer' ),
				'params'      => array(
					array(
						'type'        => 'dropdown',
						'holder'      => 'div',
						'class'       => '',
						'heading'     => esc_html__( 'Select Timeline Layout', 'wp-timeline-designer-pro' ),
						'param_name'  => 'scode',
						'value'       => $scode_id,
						'std'         => '0',
						'description' => esc_html__( 'Select Timeline Layout', 'wp-timeline-designer-pro' ),
					),
				),
			)
		);
	}

	/**
	 * Shortcode logic how it should be rendered
	 *
	 * @since 1.0.0
	 * @param array  $atts atts.
	 * @param string $content content.
	 * @return html
	 */
	public function render_my_bar_tag( $atts, $content = null ) {
		extract( shortcode_atts( array( 'scode' => '' ), $atts ) );
		$wtl_designer_pro_shortcode_list = $scode;
		ob_start();
		$wtl_settings = Wp_Timeline_Main::wtl_get_shortcode_settings( $scode );
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
		require_once WP_PLUGIN_DIR . '/wp-timeline-designer-pro/public/css/layout-dynamic-style.php';
		echo do_shortcode( '[wp_timeline_design id=' . "$wtl_designer_pro_shortcode_list" . ']' );
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}
new Wp_Timeline_Designer_Pro_VC_Extend_Add_On();
