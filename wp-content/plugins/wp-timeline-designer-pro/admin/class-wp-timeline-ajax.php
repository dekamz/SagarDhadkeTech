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
 * @package    Wp_Timeline_Designer_PRO_Ajax
 * @subpackage Wp_Timeline_Designer_PRO_Ajax/includes
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
 * @package    Wp_Timeline_Designer_PRO_Ajax
 * @subpackage Wp_Timeline_Designer_PRO_Ajax/includes
 * @author     Solwin Infotech <info@solwininfotech.com>
 */
class Wp_Timeline_Ajax {

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
	 * Template Name
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    array    $template_name  template name.
	 */
	public static $template_name = array();
	/**
	 * Shortcode ID
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    array    $shortcode_id   Shortcode ID.
	 */
	public static $shortcode_id = array();
	/**
	 * Template Stylesheet added
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    boolean  $template_stylesheet_added  template stylesheet added.
	 */
	public static $template_stylesheet_added = 0;
	/**
	 * Template dynamic stylesheet added
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    boolean  $template_dynamic_stylesheet_added  template dynamic stylesheet added.
	 */
	public static $template_dynamic_stylesheet_added = 0;
	/**
	 * Class Constructor.
	 *
	 * @since  1.0.0
	 */
	public function __construct() {
		add_action( 'wp_ajax_wtl_custom_post_taxonomy_display_settings', array( $this, 'wtl_custom_post_taxonomy_display_settings' ) );
		add_action( 'wp_ajax_wtl_closed_boxes', array( $this, 'wtl_closed_boxes' ) );
		add_action( 'wp_ajax_wtl_preview_request', array( $this, 'wtl_preview_request' ) );
		add_action( 'wp_head', array( $this, 'wtl_template_dynamic_css' ) );
		add_action( 'wp_footer', array( $this, 'wtl_template_dynamic_css' ) );
	}

	/**
	 * Blog Template List
	 *
	 * @since  1.0.0
	 * @return array
	 */
	public static function wtl_blog_template_list() {
		$tempate_list = array(
			'cool_horizontal'          => array(
				'template_name' => esc_html__( 'Cool Horizontal Template', 'wp-timeline-designer-pro' ),
				'class'         => 'timeline slider',
				'image_name'    => 'cool_horizontal.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/cool-horizontal-template/' ),
			),
			'overlay_horizontal'       => array(
				'template_name' => esc_html__( 'Overlay Horizontal Template', 'wp-timeline-designer-pro' ),
				'class'         => 'timeline slider',
				'image_name'    => 'overlay_horizontal.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/overlay-horizontal-template/' ),
			),
			'soft_block'               => array(
				'template_name' => esc_html__( 'Soft Block Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'soft_block.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/soft-block-template/' ),
			),
			'schedule'                 => array(
				'template_name' => esc_html__( 'Schedule Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'schedule.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/schedule-template/' ),
			),
			'advanced_layout'          => array(
				'template_name' => esc_html__( 'Advanced Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'advanced_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/advanced-layout-template-defualt/' ),
			),
			'verticalblur_layout'      => array(
				'template_name' => esc_html__( 'Vertical Blur Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'verticalblur_layout.jpg',
				'demo_link'     => esc_url( 'https://timeline.themesawesome.com/vertical-4/' ),
			),
			'accordion'                => array(
				'template_name' => esc_html__( 'Accordion Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'accordion.jpg',
				'demo_link'     => esc_url( 'https://timeline.themesawesome.com/vertical-9/' ),
			),
			'collapsible'              => array(
				'template_name' => esc_html__( 'Collapsible Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'collapsible.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/collapsible-layout/' ),
			),
			'fullhorizontal_layout'    => array(
				'template_name' => esc_html__( 'Full Horizontal Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'fullhorizontal_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/full-horizontal-layout/' ),
			),
			'year_layout'              => array(
				'template_name' => esc_html__( 'Year Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'year_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/year-layout-template/' ),
			),
			'hire_layout'              => array(
				'template_name' => esc_html__( 'Hire Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'hire_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/hire-layout-template/' ),
			),
			'milestone_layout'         => array(
				'template_name' => esc_html__( 'Milestone Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'milestone_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/milestone-layout-template/' ),
			),
			'fullwidth_layout'         => array(
				'template_name' => esc_html__( 'Full Width Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'fullwidth_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/full-width-layout-template/' ),
			),
			'curve_layout'             => array(
				'template_name' => esc_html__( 'Curve Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'curve_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/curve-layout-template/' ),
			),
			'easy_layout'              => array(
				'template_name' => esc_html__( 'Easy Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'easy_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/easy-layout-template/' ),
			),
			'fullvertical_layout'      => array(
				'template_name' => esc_html__( 'Full Vertical Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'fullvertical_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/full-vertical-layout/' ),
			),
			'attract_layout'           => array(
				'template_name' => esc_html__( 'Attract Timeline Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'attract_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/attract-timeline-layout/' ),
			),
			'processinfo_layout'       => array(
				'template_name' => esc_html__( 'Processinfo Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'processinfo_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/processinfo-timeline-layout/' ),
			),
			'divide_layout'            => array(
				'template_name' => esc_html__( 'Divide Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'divide_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/divide-timeline-layout/' ),
			),
			'topdivide_layout'         => array(
				'template_name' => esc_html__( 'Top Divide Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'topdivide_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/divided-top-timeline-layout/' ),
			),
			'story_layout'             => array(
				'template_name' => esc_html__( 'Story Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'story_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/story-layout-template/' ),
			),
			'timeline_graph_layout'    => array(
				'template_name' => esc_html__( 'Timeline Graph Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'masonry',
				'data'          => 'NEW',
				'image_name'    => 'timeline_graph_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/timeline-graph-layout/' ),
			),
			'business_layout'          => array(
				'template_name' => esc_html__( 'Business Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'masonry',
				'data'          => 'NEW',
				'image_name'    => 'business_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/business-timeline-layout/' ),
			),
			'glossary_layout'          => array(
				'template_name' => esc_html__( 'Glossary Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'masonry',
				'data'          => 'NEW',
				'image_name'    => 'glossary_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/glossary-layout/' ),
			),
			'boxy_layout'              => array(
				'template_name' => esc_html__( 'Boxy Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'masonry',
				'data'          => 'NEW',
				'image_name'    => 'boxy_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/boxy-layout/' ),
			),
			'wise_layout'              => array(
				'template_name' => esc_html__( 'Wise Block Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'masonry',
				'data'          => 'NEW',
				'image_name'    => 'wise_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/wise-layout/' ),
			),
			'cover_layout'             => array(
				'template_name' => esc_html__( 'Cover Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'cover_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/cover-layout/' ),
			),
			'rounded_layout'           => array(
				'template_name' => esc_html__( 'Rounded Timeline Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'rounded_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/rounded-layout/' ),
			),
			'infographic_layout'       => array(
				'template_name' => esc_html__( 'Infographic Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'infographic_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/infographic-layout/' ),
			),
			'zigzag_layout'            => array(
				'template_name' => esc_html__( 'Zig Zag Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'zigzag_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/zig-zag-layout/' ),
			),

			'columy_layout'            => array(
				'template_name' => esc_html__( 'Columy Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'columy_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/columy-layout/' ),
			),
			'leafty_layout'            => array(
				'template_name' => esc_html__( 'Leafty Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'leafty_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/leafty-layout/' ),
			),
			'sportking_layout'         => array(
				'template_name' => esc_html__( 'Sportking Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'sportking_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/sportking-layout/' ),
			),
			'filledtimeline_layout'    => array(
				'template_name' => esc_html__( 'Filled Timeline Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'filledtimeline_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/filled-timeline-layout/' ),
			),
			'classictimeline_layout'   => array(
				'template_name' => esc_html__( 'Classic Timeline Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'classictimeline_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/classic-timeline-layout/' ),
			),
			'milestonetimeline_layout' => array(
				'template_name' => esc_html__( 'Milestone Timeline Layout Template', 'wp-timeline-designer-pro' ),
				'class'         => 'full-width',
				'data'          => 'NEW',
				'image_name'    => 'milestonetimeline_layout.jpg',
				'demo_link'     => esc_url( 'https://wptimeline.solwininfotech.com/milestone-timeline-layout/' ),
			),
		);
		ksort( $tempate_list );
		return $tempate_list;
	}

	/**
	 * Ajax handler to get custom post taxonomy display settings
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function wtl_custom_post_taxonomy_display_settings() {
		ob_start();
		if ( isset( $_POST['nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'ajax-nonce' ) ) {
			if ( isset( $_POST['posttype'] ) && ! empty( $_POST['posttype'] ) ) {
				$custom_posttype = esc_attr( sanitize_text_field( wp_unslash( $_POST['posttype'] ) ) );
			}
		}
		$taxonomy_names = get_object_taxonomies( $custom_posttype, 'objects' );
		$taxonomy_names = apply_filters( 'wtl_hide_taxonomies', $taxonomy_names );
		if ( 'post' === $custom_posttype ) {
			?>
			<div class="wp-timeline-typography-cover display-custom-taxonomy">
				<div class="wp-timeline-typography-label">
					<span class="wp-timeline-key-title"><?php esc_html_e( 'Post Category', 'wp-timeline-designer-pro' ); ?></span>
					<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Show post category on timeline layout', 'wp-timeline-designer-pro' ); ?></span></span>
				</div>
				<div class="wp-timeline-typography-content">
					<fieldset class="wp-timeline-social-options wp-timeline-display_author buttonset">
						<input id="display_category_1" name="display_category" type="radio" value="1" checked="checked" />
						<label for="display_category_1"><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
						<input id="display_category_0" name="display_category" type="radio" value="0" />
						<label for="display_category_0"><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
					</fieldset>
					<label class="disable_link"><input id="disable_link_category" name="disable_link_category" type="checkbox" value="1" /> <?php esc_html_e( 'Disable Link', 'wp-timeline-designer-pro' ); ?></label>					
				</div>
			</div>
			<div class="wp-timeline-typography-cover display-custom-taxonomy">
				<div class="wp-timeline-typography-label">
					<span class="wp-timeline-key-title"><?php esc_html_e( 'Post Tag', 'wp-timeline-designer-pro' ); ?></span>
					<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Show post tag on timeline layout', 'wp-timeline-designer-pro' ); ?></span></span>
				</div>
				<div class="wp-timeline-typography-content">
					<fieldset class="wp-timeline-social-options wp-timeline-display_author buttonset">
						<input id="display_tag_1" name="display_tag" type="radio" value="1" checked="checked" />
						<label for="display_tag_1"><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
						<input id="display_tag_0" name="display_tag" type="radio" value="0" />
						<label for="display_tag_0"><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
					</fieldset>
					<label class="disable_link">
						<input id="disable_link_tag" name="disable_link_tag" type="checkbox" value="1" /> <?php esc_html_e( 'Disable Link', 'wp-timeline-designer-pro' ); ?>
					</label>
				</div>
			</div>
			<?php
		} elseif ( ! empty( $taxonomy_names ) ) {
			foreach ( $taxonomy_names as $taxonomy_name ) {
				if ( ! empty( $taxonomy_name ) ) {
					?>
					<div class="wp-timeline-typography-cover display-custom-taxonomy">
						<div class="wp-timeline-typography-label">
							<span class="wp-timeline-key-title"><?php echo esc_html( $taxonomy_name->label ); ?></span>
							<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php echo esc_html_e( 'Enable/Disable', 'wp-timeline-designer-pro' ) . ' ' . esc_attr( $taxonomy_name->label ) . ' ' . esc_html_e( 'in timeline layout', 'wp-timeline-designer-pro' ); ?></span></span>
						</div>
						<div class="wp-timeline-typography-content">
							<fieldset class="wp-timeline-display_tax buttonset">
								<input id="display_<?php echo esc_attr( $taxonomy_name->name ); ?>_1" name="display_<?php echo esc_attr( $taxonomy_name->name ); ?>" type="radio" value="1" />
								<label for="display_<?php echo esc_attr( $taxonomy_name->name ); ?>_1"><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
								<input id="display_<?php echo esc_attr( $taxonomy_name->name ); ?>_0" name="display_<?php echo esc_attr( $taxonomy_name->name ); ?>" type="radio" value="0" checked="checked"/>
								<label for="display_<?php echo esc_attr( $taxonomy_name->name ); ?>_0"><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
							</fieldset>
							<label class="disable_link">
								<input id="disable_link_taxonomy_<?php echo esc_attr( $taxonomy_name->name ); ?>" name="disable_link_taxonomy_<?php echo esc_attr( $taxonomy_name->name ); ?>" type="checkbox" value="1" 
								<?php
								if ( isset( $wtl_settings[ 'disable_link_taxonomy_' . $taxonomy_name->name ] ) ) {
									checked( 1, $wtl_settings[ 'disable_link_taxonomy_' . $taxonomy_name->name ] );
								}
								?>
								/>
								<?php esc_html_e( 'Disable Link', 'wp-timeline-designer-pro' ); ?>
							</label>
						</div>
					</div>
					<?php
				}
			}
		}
		$data = ob_get_clean();
		echo wp_kses( $data, Wp_Timeline_Public::args_kses() );
		die();
	}

	/**
	 * Ajax handler for Store closed box id
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function wtl_closed_boxes() {
		if ( isset( $_POST['nonce'] ) ) {
			$nonce = sanitize_text_field( wp_unslash( $_POST['nonce'] ) );
			if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {
				wp_send_json_error( array( 'status' => 'Nonce error' ) );
				die();
			}
		}
		$closed = isset( $_POST['closed'] ) ? explode( ',', sanitize_text_field( wp_unslash( $_POST['closed'] ) ) ) : array();
		$closed = array_filter( $closed );
		$page   = isset( $_POST['page'] ) ? sanitize_text_field( wp_unslash( $_POST['page'] ) ) : '';
		if ( sanitize_key( $page ) !== $page ) {
			wp_die( 0 );
		}
		$user = wp_get_current_user();
		if ( ! $user ) {
			wp_die( -1 );
		}
		if ( is_array( $closed ) ) {
			update_user_option( $user->ID, "wptclosewptboxes_$page", $closed, true );
		}
		wp_die( 1 );
	}

	/**
	 * Ajax handler for preview.
	 */
	public function wtl_preview_request() {
		self::wtl_template_dynamic_css();
		if ( isset( $_REQUEST['settings'] ) && isset( $_REQUEST['wtlid'] ) ) {
			$wtl_settings = array();
			parse_str( sanitize_text_field( wp_unslash( $_REQUEST['settings'] ) ), $wtl_settings );
			$wtl_id = sanitize_text_field( wp_unslash( $_REQUEST['wtlid'] ) );
			echo Wp_Timeline_Main::wtl_layout_view_portion( $wtl_id, $wtl_settings );
			exit();
		}

	}

	/**
	 * WP Timeline Designer PRO Shortcode REGEX
	 *
	 * @since  1.0.0
	 * @return string
	 */
	public static function wtl_shortcode_regex() {

		// WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcode_tag().
		// Also, see shortcode_unautop() and shortcode.js.
		return '\\['                   // Opening bracket.
				. '(\\[?)'              // 1: Optional second opening bracket for escaping shortcodes: [[tag]].
				. '(wp_timeline_design)'  // 2: Shortcode name.
				. '(?![\\w-])'          // Not followed by word character or hyphen.
				. '('                   // 3: Unroll the loop: Inside the opening shortcode tag.
				. '[^\\]\\/]*'          // Not a closing bracket or forward slash.
				. '(?:'
				. '\\/(?!\\])'          // A forward slash not followed by a closing bracket.
				. '[^\\]\\/]*'          // Not a closing bracket or forward slash.
				. ')*?'
				. ')'
				. '(?:'
				. '(\\/)'               // 4: Self closing tag ...
				. '\\]'                 // ... and closing bracket.
				. '|'
				. '\\]'                 // Closing bracket.
				. '(?:'
				. '('                   // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags.
				. '[^\\[]*+'            // Not an opening bracket.
				. '(?:'
				. '\\[(?!\\/\\2\\])'    // An opening bracket not followed by the closing shortcode tag.
				. '[^\\[]*+'            // Not an opening bracket.
				. ')*+'
				. ')'
				. '\\[\\/\\2\\]'        // Closing shortcode tag.
				. ')?'
				. ')'
				. '(\\]?)';             // 6: Optional second closing brocket for escaping shortcodes: [[tag]].
	}

	/**
	 * WP Timeline Designer PRO Template Dynamic CSS
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public static function wtl_template_dynamic_css() {
		global $post, $wpdb;
		$shortcode_id_array                = array();
		$wtl_settings_array                = array();
		$template_dynamic_stylesheet_added = self::$template_dynamic_stylesheet_added;
		$wtlid                             = isset( $_REQUEST['wtlid'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['wtlid'] ) ) : '';
		if ( 0 == $template_dynamic_stylesheet_added ) {
			if ( ! empty( $post ) ) {
				$wp_shortcode = $post->post_content;
			} else {
				$wp_shortcode = '[wp_timeline_design id="' . $wtlid . '"]';
			}
			if ( isset( $wp_shortcode ) && has_shortcode( $wp_shortcode, 'wp_timeline_design' ) ) {
				$shortcode_id = '';
				$pattern      = self::wtl_shortcode_regex();
				if ( preg_match_all( '/' . $pattern . '/s', $wp_shortcode, $matches ) ) {
					foreach ( $matches[3] as $block ) {
						$attr = shortcode_parse_atts( $block );
						if ( isset( $attr['id'] ) ) {
							$shortcode_id = intval( $attr['id'] );
						}
						if ( '' != $shortcode_id ) {
							$shortcode_id_array[]                = $shortcode_id;
							$wtl_settings                        = Wp_Timeline_Main::wtl_get_shortcode_settings( $shortcode_id );
							$wtl_settings_array[ $shortcode_id ] = $wtl_settings;
						}
					}
				}
			} else {
				$wp_timeline_shortcode_ids = self::$shortcode_id;
				if ( is_array( $wp_timeline_shortcode_ids ) && count( $wp_timeline_shortcode_ids ) > 0 ) {
					foreach ( $wp_timeline_shortcode_ids as $wp_timeline_shortcode_id ) {
						if ( '' != $wp_timeline_shortcode_id ) {
							$shortcode_id_array[]                            = $wp_timeline_shortcode_id;
							$wtl_settings                                    = Wp_Timeline_Main::wtl_get_shortcode_settings( $wp_timeline_shortcode_id );
							$wtl_settings_array[ $wp_timeline_shortcode_id ] = $wtl_settings;
						}
					}
				}
			}
			if ( isset( $wtl_settings_array ) && is_array( $wtl_settings_array ) && ! empty( $wtl_settings_array ) ) {
				self::$template_dynamic_stylesheet_added = 1;
				foreach ( $wtl_settings_array as $bd_shortcode_id => $wtl_settings ) {
					$shortcode_id = $bd_shortcode_id;
					foreach ( $wtl_settings as $key => $val ) {
						if ( ! is_array( $val ) ) {
							${$key} = $val;
						}
					}
					$wp_timeline_theme      = isset( $wtl_settings['template_name'] ) ? $wtl_settings['template_name'] : '';
					$wp_timeline_theme      = apply_filters( 'wp_timeline_filter_template', $wp_timeline_theme );
					$template_titlefontface = ( isset( $wtl_settings['template_titlefontface'] ) && '' != $wtl_settings['template_titlefontface'] ) ? $wtl_settings['template_titlefontface'] : '';
					$load_goog_font_blog    = array();
					if ( isset( $wtl_settings['template_titlefontface_font_type'] ) && 'Google Fonts' === $wtl_settings['template_titlefontface_font_type'] ) {
						$load_goog_font_blog[] = $template_titlefontface;
					}

					$firstletter_font_family = ( isset( $wtl_settings['firstletter_font_family'] ) && '' != $wtl_settings['firstletter_font_family'] ) ? $wtl_settings['firstletter_font_family'] : 'inherit';
					if ( isset( $wtl_settings['firstletter_font_family_font_type'] ) && 'Google Fonts' === $wtl_settings['firstletter_font_family_font_type'] ) {
						$load_goog_font_blog[] = $firstletter_font_family;
					}

					$content_font_family = ( isset( $wtl_settings['content_font_family'] ) && '' != $wtl_settings['content_font_family'] ) ? $wtl_settings['content_font_family'] : '';
					if ( isset( $wtl_settings['content_font_family_font_type'] ) && 'Google Fonts' === $wtl_settings['content_font_family_font_type'] ) {
						$load_goog_font_blog[] = $content_font_family;
					}

					$meta_font_family = ( isset( $wtl_settings['meta_font_family'] ) && '' != $wtl_settings['meta_font_family'] ) ? $wtl_settings['meta_font_family'] : '';
					if ( isset( $wtl_settings['meta_font_family_font_type'] ) && 'Google Fonts' === $wtl_settings['meta_font_family_font_type'] ) {
						$load_goog_font_blog[] = $meta_font_family;
					}

					$date_font_family = ( isset( $wtl_settings['date_font_family'] ) && '' != $wtl_settings['date_font_family'] ) ? $wtl_settings['date_font_family'] : '';
					if ( isset( $wtl_settings['date_font_family_font_type'] ) && 'Google Fonts' === $wtl_settings['date_font_family_font_type'] ) {
						$load_goog_font_blog[] = $date_font_family;
					}

					$readmore_font_family = ( isset( $wtl_settings['readmore_font_family'] ) && '' != $wtl_settings['readmore_font_family'] ) ? $wtl_settings['readmore_font_family'] : '';
					if ( isset( $wtl_settings['readmore_font_family_font_type'] ) && 'Google Fonts' === $wtl_settings['readmore_font_family_font_type'] ) {
						$load_goog_font_blog[] = $readmore_font_family;
					}

					$wp_timeline_sale_tagfontface = ( isset( $wtl_settings['wp_timeline_sale_tagfontface'] ) && '' != $wtl_settings['wp_timeline_sale_tagfontface'] ) ? $wtl_settings['wp_timeline_sale_tagfontface'] : '';
					if ( isset( $wtl_settings['wp_timeline_sale_tagfontface_font_type'] ) && 'Google Fonts' === $wtl_settings['wp_timeline_sale_tagfontface_font_type'] ) {
						$load_goog_font_blog[] = $wp_timeline_sale_tagfontface;
					}

					$wp_timeline_pricefontface = ( isset( $wtl_settings['wp_timeline_pricefontface'] ) && '' != $wtl_settings['wp_timeline_pricefontface'] ) ? $wtl_settings['wp_timeline_pricefontface'] : '';
					if ( isset( $wtl_settings['wp_timeline_pricefontface_font_type'] ) && 'Google Fonts' === $wtl_settings['wp_timeline_pricefontface_font_type'] ) {
						$load_goog_font_blog[] = $wp_timeline_pricefontface;
					}

					$wp_timeline_addtocart_button_fontface = ( isset( $wtl_settings['wp_timeline_addtocart_button_fontface'] ) && '' != $wtl_settings['wp_timeline_addtocart_button_fontface'] ) ? $wtl_settings['wp_timeline_addtocart_button_fontface'] : '';
					if ( isset( $wtl_settings['wp_timeline_addtocart_button_fontface_font_type'] ) && 'Google Fonts' === $wtl_settings['wp_timeline_addtocart_button_fontface_font_type'] ) {
						$load_goog_font_blog[] = $wp_timeline_addtocart_button_fontface;
					}

					$wp_timeline_addtowishlist_button_fontface = ( isset( $wtl_settings['wp_timeline_addtowishlist_button_fontface'] ) && '' != $wtl_settings['wp_timeline_addtowishlist_button_fontface'] ) ? $wtl_settings['wp_timeline_addtowishlist_button_fontface'] : '';
					if ( isset( $wtl_settings['wp_timeline_addtowishlist_button_fontface_font_type'] ) && 'Google Fonts' === $wtl_settings['wp_timeline_addtowishlist_button_fontface_font_type'] ) {
						$load_goog_font_blog[] = $wp_timeline_addtowishlist_button_fontface;
					}

					$wp_timeline_edd_pricefontface = ( isset( $wtl_settings['wp_timeline_edd_pricefontface'] ) && '' != $wtl_settings['wp_timeline_edd_pricefontface'] ) ? $wtl_settings['wp_timeline_edd_pricefontface'] : '';
					if ( isset( $wtl_settings['wp_timeline_edd_pricefontface_font_type'] ) && 'Google Fonts' === $wtl_settings['wp_timeline_edd_pricefontface_font_type'] ) {
						$load_goog_font_blog[] = $wp_timeline_edd_pricefontface;
					}

					$wp_timeline_edd_addtocart_button_fontface = ( isset( $wtl_settings['wp_timeline_edd_addtocart_button_fontface'] ) && '' != $wtl_settings['wp_timeline_edd_addtocart_button_fontface'] ) ? $wtl_settings['wp_timeline_edd_addtocart_button_fontface'] : '';
					if ( isset( $wtl_settings['wp_timeline_edd_addtocart_button_fontface_font_type'] ) && 'Google Fonts' === $wtl_settings['wp_timeline_edd_addtocart_button_fontface_font_type'] ) {
						$load_goog_font_blog[] = $wp_timeline_edd_addtocart_button_fontface;
					}
					include WP_PLUGIN_DIR . '/wp-timeline-designer-pro/public/css/layout-dynamic-style.php';
					if ( ! empty( $load_goog_font_blog ) ) {
						$load_font_arr = array_values( array_unique( $load_goog_font_blog ) );
						foreach ( $load_font_arr as $font_family ) {
							if ( '' != $font_family && 'inherit' != $font_family ) {
								$set_base  = ( is_ssl() ) ? 'https://' : 'http://';
								$font_href = $set_base . 'fonts.googleapis.com/css?family=' . $font_family;

								wp_enqueue_style( 'wp-timeline-google-fonts-' . $font_family, $font_href, array(), null, null );
								?>
								<script type="text/javascript">
									"use strict";
									var gfont    = document.createElement("link"),
										before   = document.getElementsByTagName("link")[0],
										loadHref = true;
									jQuery('head').find('*').each(function(){
										if (jQuery(this).attr('href') == '<?php echo esc_url( $font_href ); ?>'){loadHref = false}
									});
									if (loadHref) {
										gfont.href  = '<?php echo esc_attr( $font_href ); ?>';
										gfont.rel   = 'stylesheet';
										// gfont.type  = 'text/css';
										// gfont.media = 'all';
										before.parentNode.insertBefore(gfont, before);
									}
								</script>
								<?php
							}
						}
					}
				}
			}
		}
	}

}
$wp_timeline_ajax = new Wp_Timeline_Ajax();
