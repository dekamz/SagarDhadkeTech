<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.solwininfotech.com/
 * @since      1.0.0
 *
 * @package    Wp_Timeline_Designer_PRO
 * @subpackage Wp_Timeline_Designer_PRO/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wp_Timeline_Designer_PRO
 * @subpackage Wp_Timeline_Designer_PRO/public
 * @author     Solwin Infotech <info@solwininfotech.com>
 */
class Wp_Timeline_Public {
	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}
	/**
	 * Argument for Kses.
	 *
	 * @since    1.0.0
	 * @return  array
	 */
	public static function args_kses() {
		$common_attr = array(
			'class'            => true,
			'id'               => true,
			'style'            => true,
			'name'             => true,
			'src'              => true,
			'type'             => true,
			'for'              => true,
			'value'            => true,
			'data-placeholder' => true,
		);
		$args_kses   = array(
			'div'        => array(
				'class'    => true,
				'id'       => true,
				'style'    => true,
				'script'   => true,
				'data-aos' => true,
			),
			'span'       => array(
				'class' => true,
				'id'    => true,
				'style' => true,
			),
			'script'     => array(
				'type'    => true,
				'charset' => true,
			),
			'style'      => array(
				'type' => true,
			),
			'iframe'     => array(
				'src'         => true,
				'style'       => true,
				'scrolling'   => true,
				'frameborder' => true,
			),
			'img'        => array(
				'src'      => true,
				'class'    => true,
				'height'   => true,
				'width'    => true,
				'alt'      => true,
				'style'    => true,
				'script'   => true,
				'decoding' => true,
				'sizes'    => true,
				'srcset'   => true,
				'loading'  => true,
			),
			'a'          => array(
				'href'              => true,
				'target'            => true,
				'data-href'         => true,
				'data-share'        => true,
				'data-url'          => true,
				'data-description'  => true,
				'data-mdia'         => true,
				'data-shortcode-id' => true,
				'data-text'         => true,
				'data-title'        => true,
				'data-id'           => true,
				'style'             => true,
				'script'            => true,
				'class'             => true,
				'id'                => true,
			),
			'i'          => array(
				'class' => true,
			),
			'ul'         => array(
				'class' => true,
				'id'    => true,
				'style' => true,
			),
			'li'         => array(
				'class' => true,
				'id'    => true,
				'style' => true,
			),
			'input'      => $common_attr,
			'fieldset'   => $common_attr,
			'label'      => $common_attr,
			'select'     => $common_attr,
			'option'     => array(
				'value' => true,
			),
			'time'       => array(
				'class'    => true,
				'datetime' => true,
			),
			'h1'         => $common_attr,
			'h2'         => $common_attr,
			'h3'         => $common_attr,
			'h4'         => $common_attr,
			'h5'         => $common_attr,
			'h6'         => $common_attr,
			'p'          => true,
			'figure'     => array(
				'class' => true,
			),
			'video'      => array(
				'controls' => true,
				'src'      => true,
			),
			'audio'      => array(
				'controls' => true,
				'src'      => true,
			),
			'blockquote' => array(
				'class' => true,
			),

		);
		return $args_kses;
	}
	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		$wpt_font_icon_url = plugins_url( 'css/font-awesome.min.css', __FILE__ );
		$wpt_font_icon     = dirname( __FILE__ ) . '/css/font-awesome.min.css';
		if ( file_exists( $wpt_font_icon ) ) {
			wp_register_style( 'wp-timeline-fontawesome-stylesheets', $wpt_font_icon_url, null, '1.0' );
			wp_enqueue_style( 'wp-timeline-fontawesome-stylesheets' );
		}
		$wtl_gallery_slider_url = plugins_url( 'css/flexslider.css', __FILE__ );
		$wpt_gallery_slider     = dirname( __FILE__ ) . '/css/flexslider.css';
		if ( file_exists( $wpt_gallery_slider ) ) {
			wp_register_style( 'wp-timeline-gallery-slider-stylesheets', $wtl_gallery_slider_url, null, '1.0' );
		}
		wp_enqueue_style( 'wp-timeline-front', plugins_url( 'css/wp-timeline-public.css', __FILE__ ), null, '1.0' );
		wp_register_script( 'wp-timeline-gallery-image-script', plugins_url( 'js/jquery.flexslider-min.js', __FILE__ ), array( 'jquery' ), '1.0', false );
		wp_register_style( 'wp-timeline-cool_horizontal-template', plugins_url( 'css/layouts/cool_horizontal.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-overlay_horizontal-template', plugins_url( 'css/layouts/overlay_horizontal.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-soft_block-template', plugins_url( 'css/layouts/soft_block.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-schedule-template', plugins_url( 'css/layouts/schedule.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-accordion-template', plugins_url( 'css/layouts/accordion.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-collapsible-template', plugins_url( 'css/layouts/collapsible.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-advanced_layout-template', plugins_url( 'css/layouts/advanced_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-verticalblur_layout-template', plugins_url( 'css/layouts/verticalblur_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-year_layout-template', plugins_url( 'css/layouts/year_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-story_layout-template', plugins_url( 'css/layouts/story_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-hire_layout-template', plugins_url( 'css/layouts/hire_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-milestone_layout-template', plugins_url( 'css/layouts/milestone_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-fullwidth_layout-template', plugins_url( 'css/layouts/fullwidth_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-curve_layout-template', plugins_url( 'css/layouts/curve_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-easy_layout-template', plugins_url( 'css/layouts/easy_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-fullhorizontal_layout-template', plugins_url( 'css/layouts/fullhorizontal_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-fullvertical_layout-template', plugins_url( 'css/layouts/fullvertical_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-attract_layout-template', plugins_url( 'css/layouts/attract_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-processinfo_layout-template', plugins_url( 'css/layouts/processinfo_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-divide_layout-template', plugins_url( 'css/layouts/divide_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-topdivide_layout-template', plugins_url( 'css/layouts/topdivide_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-glossary_layout-template', plugins_url( 'css/layouts/glossary_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-business_layout-template', plugins_url( 'css/layouts/business_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-timeline_graph_layout-template', plugins_url( 'css/layouts/timeline_graph_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-boxy_layout-template', plugins_url( 'css/layouts/boxy_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-wise_layout-template', plugins_url( 'css/layouts/wise_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-cover_layout-template', plugins_url( 'css/layouts/cover_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-rounded_layout-template', plugins_url( 'css/layouts/rounded_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-infographic_layout-template', plugins_url( 'css/layouts/infographic_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-zigzag_layout-template', plugins_url( 'css/layouts/zigzag_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-columy_layout-template', plugins_url( 'css/layouts/columy_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-leafty_layout-template', plugins_url( 'css/layouts/leafty_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-sportking_layout-template', plugins_url( 'css/layouts/sportking_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-filledtimeline_layout-template', plugins_url( 'css/layouts/filledtimeline_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-classictimeline_layout-template', plugins_url( 'css/layouts/classictimeline_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-milestonetimeline_layout-template', plugins_url( 'css/layouts/milestonetimeline_layout.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'logbook', plugins_url( 'css/logbook.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'slick', plugins_url( 'css/slick.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'featherlight', plugins_url( 'css/featherlight.min.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'aos', plugins_url( 'css/aos-min.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'wp-timeline-basic-tools', plugins_url( 'css/basic-tools-min.css', __FILE__ ), null, '1.0' );
		wp_register_style( 'choosen', plugins_url( 'admin/css/chosen.min.css', __FILE__ ), null, '1.0' );
		wp_enqueue_style( 'lightcase-style', plugins_url( 'css/lightcase.css', __FILE__ ), null, '2.5.0' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'wp-timeline-ajax-script', plugins_url( 'js/wp-timeline-public.js', __FILE__ ), array( 'jquery' ), $this->version, false );
		if ( ! wp_script_is( 'jquery', 'enqueued' ) ) {
			wp_enqueue_script( 'jquery' );
		}
		wp_localize_script(
			'wp-timeline-ajax-script',
			'ajax_object',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'is_rtl'  => ( is_rtl() ) ? 1 : 0,
			)
		);
		wp_enqueue_script( 'jquery-masonry', array( 'jquery' ) );
		wp_enqueue_script( 'isotope', plugins_url( 'js/isotope.pkgd.min.js', __FILE__ ), array( 'jquery' ), '2.2.2', false );
		wp_register_script( 'mousewheel', plugins_url( 'js/jquery.mousewheel.js', __FILE__ ), array( 'jquery' ), '1.0', false );
		wp_register_script( 'logbook', plugins_url( 'js/logbook.js', __FILE__ ), array( 'jquery' ), '1.0', false );
		wp_register_script( 'slick', plugins_url( 'js/slick.min.js', __FILE__ ), array( 'jquery' ), '1.0', false );
		wp_register_script( 'featherlight', plugins_url( 'js/featherlight.min.js', __FILE__ ), array( 'jquery' ), '1.0', false );
		wp_register_script( 'aos', plugins_url( 'js/aos-min.js', __FILE__ ), array( 'jquery' ), '1.0', false );
		wp_register_script( 'easing', plugins_url( 'js/jquery.easing.js', __FILE__ ), array( 'jquery' ), '1.0', false );
		wp_register_script( 'choosen', plugins_url( 'admin/js/chosen.jquery.min.js', __FILE__ ), array( 'jquery', 'jquery-masonry' ), '1.8.3', false );
		wp_register_script( 'wp-timeline-ajax', plugins_url( 'js/ajax.js', __FILE__ ), null, '1.0', false );
		wp_localize_script(
			'wp-timeline-ajax',
			'ajax_object',
			array(
				'ajaxurl'    => admin_url( 'admin-ajax.php' ),
				'like'       => esc_html__( 'Like', 'wp-timeline-designer-pro' ),
				'unlike'     => esc_html__( 'Unlike', 'wp-timeline-designer-pro' ),
				'is_rtl'     => ( is_rtl() ) ? 1 : 0,
				'ajax_nonce' => wp_create_nonce( 'ajax-nonce' ),
			)
		);
		wp_register_script( 'wp-timeline-socialShare-script', plugins_url( 'js/SocialShare.js', __FILE__ ), null, '1.0', false );
		wp_enqueue_script( 'lazy_load_responsive_images_script-lazysizes', plugins_url( 'js/lazysizes.min.js', __FILE__ ), null, '1.0' );
		wp_enqueue_script( 'lightcase-script', plugins_url( 'js/lightcase.js', __FILE__ ), null, '2.5.0', true );
	}
}
