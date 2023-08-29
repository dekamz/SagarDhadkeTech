<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.solwininfotech.com/
 * @since      1.0.0
 *
 * @package    Wp_Timeline_Designer_PRO_Support
 * @subpackage Wp_Timeline_Designer_PRO_Support/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Wp_Timeline_Designer_PRO_Support
 * @subpackage Wp_Timeline_Designer_PRO_Support/includes
 * @author     Solwin Infotech <info@solwininfotech.com>
 */
class Wp_Timeline_Support {
	/**
	 * The unique identifier of this plugin.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;
	/**
	 * The current version of the plugin.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string    $version    The current version of the plugin.
	 */
	protected $version;
	/**
	 * Class Cunstructor.
	 *
	 * @since  1.0.0
	 */
	public function __construct() {
		include_once ABSPATH . 'wp-admin/includes/plugin.php';
		/* Beaver Builder Lite */
		if ( is_plugin_active( 'beaver-builder-lite-version/fl-builder.php' ) ) {
			add_action( 'fl_builder_ui_panel_after_modules', array( $this, 'add_wtl_widget' ) );
		}
		/* Page Builder by SiteOrigin */
		if ( is_plugin_active( 'siteorigin-panels/siteorigin-panels.php' ) ) {
			add_filter( 'siteorigin_panels_widget_dialog_tabs', array( $this, 'wtl_siteorigin_panels_add_widgets_dialog_tabs_fun' ), 20 );
			add_filter( 'siteorigin_panels_widgets', array( $this, 'wtl_siteorigin_panels_add_recommended_widgets_fun' ) );
		}
		if ( is_plugin_active( 'siteorigin-panels/siteorigin-panels.php' ) ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'wtl_timeline_support_script' ) );
		}
		/* Fusion Builder */
		if ( is_plugin_active( 'fusion-builder/fusion-builder.php' ) ) {
			add_action( 'fusion_builder_before_init', array( $this, 'wtl_fusion_element' ) );
		}
		/* Fusion Page Builder */
		if ( is_plugin_active( 'fusion/fusion-core.php' ) ) {
			add_action( 'init', array( $this, 'wtl_fsn_init' ), 12 );
			add_shortcode( 'fsn_wp_timeline', array( $this, 'wtl_fsn_shortcode' ) );
		}
	}

	/**
	 * Wtl Widget.
	 *
	 * @return void
	 */
	public function add_wtl_widget() {
		?>
		<div id="fl-builder-blocks-wp-timeline-widget" class="fl-builder-blocks-section">
			<span class="fl-builder-blocks-section-title">
				<?php esc_html_e( 'WP Timeline Designer PRO', 'wp-timeline-designer-pro' ); ?>
				<i class="fas fa-chevron-down"></i>
			</span>
			<div class="fl-builder-blocks-section-content fl-builder-modules">
				<span class="fl-builder-block fl-builder-block-module" data-widget="WPT_Widget_WPTIMELINE" data-type="widget">
					<span class="fl-builder-block-title"><?php esc_html_e( 'WP Timeline Designer PRO', 'wp-timeline-designer-pro' ); ?></span>
				</span>
			</div>
		</div>
		<?php
	}

	/**
	 * Site Origin panel wdidget.
	 *
	 * @param string $tabs tabs.
	 * @return html
	 */
	public function wtl_siteorigin_panels_add_widgets_dialog_tabs_fun( $tabs ) {
		$tabs['wp_timeline_designer_pro'] = array(
			'title'  => 'WP Timeline Designer PRO',
			'filter' => array(
				'groups' => array( 'wp_timeline_designer_pro' ),
			),
		);
		return $tabs;
	}

	/**
	 * Site origin panels.
	 *
	 * @param string $widgets widgets.
	 * @return html
	 */
	public function wtl_siteorigin_panels_add_recommended_widgets_fun( $widgets ) {
		foreach ( $widgets as $widget_id => &$widget ) {
			if ( strpos( $widget_id, 'WPT_Widget_' ) === 0 || strpos( $widget_id, 'wp_timeline_widget' ) !== false ) {
				$widget['groups'][] = 'wp_timeline_designer_pro';
				$widget['icon']     = 'wp_timeline_icon';
			}
		}
		return $widgets;
	}

	/**
	 * Supoort Script.
	 *
	 * @return void
	 */
	public function wtl_timeline_support_script() {
		wp_enqueue_style( 'wp-timeline-support', plugins_url( 'wp-timeline/admin/css/wp_timeline_support.css' ), null, '1.0' );
	}

	/**
	 * Fusion Element.
	 *
	 * @return void
	 */
	public function wtl_fusion_element() {
		global $wpdb;
		$shortcodes  = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'wtl_shortcodes ' );
		$wtl_layouts = array();
		if ( $shortcodes ) {
			foreach ( $shortcodes as $shortcode ) {
				$wtl_layouts[ $shortcode->shortcode_name ] = $shortcode->wtlid;
			}
		}
		fusion_builder_map(
			array(
				'name'      => 'WP Timeline Designer PRO',
				'shortcode' => 'wp_timeline',
				'icon'      => 'wp_timeline_icon',
				'params'    => array(
					array(
						'type'       => 'select',
						'heading'    => esc_html__( 'Select Layout', 'wp-timeline-designer-pro' ),
						'param_name' => 'id',
						'default'    => '',
						'value'      => $wtl_layouts,
					),
				),
			)
		);
	}

	/**
	 * Inin Function.
	 *
	 * @return void
	 */
	public function wtl_fsn_init() {
		if ( function_exists( 'fsn_map' ) ) {
			global $wpdb;
			$shortcodes  = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'wtl_shortcodes ' );
			$wtl_layouts = array();
			if ( $shortcodes ) {
				foreach ( $shortcodes as $shortcode ) {
					$wtl_layouts[ $shortcode->wtlid ] = $shortcode->shortcode_name;
				}
			}
			fsn_map(
				array(
					'name'          => 'WP Timeline Designer PRO',
					'shortcode_tag' => 'fsn_wp_timeline',
					'description'   => esc_html__( 'WP Timeline Designer PRO is a step ahead wordpress plugin that allows you to modify blog page, single page and archive page layouts and design.', 'wp-timeline-designer-pro' ),
					'icon'          => 'fsn_blog',
					'params'        => array(
						array(
							'type'       => 'select',
							'param_name' => 'id',
							'label'      => esc_html__( 'Select WP Timeline Designer PRO Layout', 'wp-timeline-designer-pro' ),
							'options'    => $wtl_layouts,
						),
					),
				)
			);
		}
	}
	/**
	 * Shortcode function.
	 *
	 * @param array  $atts attribute.
	 * @param string $content content.
	 *
	 * @return html
	 */
	public function wtl_fsn_shortcode( $atts, $content ) {
		ob_start();
		?>
		<div class="fsn-wp_timeline_<?php echo esc_attr( fsn_style_params_class( $atts ) ); ?>">
			<?php echo do_shortcode( '[wp_timeline_design id="' . intval( $atts['id'] ) . '"]' ); ?>
		</div>
		<?php
		$output = ob_get_clean();
		return $output;
	}
}
$wp_timeline_support = new Wp_Timeline_Support();
