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
class Wp_Timeline_Admin {
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
	 * Wp-timeline plugin error
	 *
	 * @var string
	 */
	public $wp_timeline_errors;
	/**
	 * Wp-timeline layout setting
	 *
	 * @var array
	 */
	public $wtl_settings;
	/**
	 * Wp-timeline shortcode plugin table
	 *
	 * @var string
	 */
	public $wtl_table_name;
	/**
	 * Success message
	 *
	 * @var string
	 */
	public $wtl_success;
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
		global $wpdb, $wtl_table_name, $wtl_errors, $import_success, $font_success, $template_base, $pagenow;
		$wtl_table_name  = $wpdb->prefix . 'wp_timeline_shortcodes';
		$wtl_admin_page  = false;
		$wtl_admin_pages = array( 'wtl_layouts', 'add_wtl_shortcode', 'wtl_export', 'designer_welcome_page' );
		require_once ABSPATH . 'wp-includes/pluggable.php';
		if ( isset( $_GET['page'] ) && ( in_array( $_GET['page'], $wtl_admin_pages, true ) ) ) {
			$wtl_admin_page = true;
		}
		add_action( 'admin_menu', array( &$this, 'wtl_add_menu' ) );
		add_action( 'admin_init', array( &$this, 'wtl_default_settings_function' ), 1 );
		add_action( 'admin_init', array( &$this, 'wtl_table_status' ), 2 );
		add_action( 'admin_init', array( &$this, 'wtl_save_layouts' ), 3 );
		add_action( 'admin_init', array( &$this, 'wtl_delete_layout' ), 4 );
		add_action( 'admin_init', array( &$this, 'wtl_multiple_delete_layouts' ), 5 );
		add_action( 'admin_init', array( &$this, 'wtl_duplicate_layout' ), 6 );
		add_action( 'admin_init', array( &$this, 'wtl_multiple_export_layouts' ), 7 );
		add_action( 'admin_init', array( &$this, 'wtl_upload_import_file' ), 8 );
		add_action( 'admin_head', array( &$this, 'wtl_plugin_path_js' ), 9 );
		add_action( 'add_meta_boxes', array( &$this, 'wtl_details_meta_box' ), 11 );
		add_action( 'save_post', array( &$this, 'wtl_details_save' ), 12 );
		add_action( 'wp_ajax_nopriv_wtl_template_search_result', array( &$this, 'wtl_template_search_result' ), 13 );
		add_action( 'wp_ajax_wtl_template_search_result', array( &$this, 'wtl_template_search_result' ), 14 );
		add_filter( 'set-screen-option', array( &$this, 'wtl_set_screen_option' ), 10, 3 );
		add_action( 'admin_init', array( $this, 'wtl_create_sample_layout' ) );
	}
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		$wpt_font_icon_url = WTL_URL . '/public/css/font-awesome.min.css';
		wp_register_style( 'font-awesome', $wpt_font_icon_url, array(), '4.1' );
		wp_enqueue_style( 'font-awesome' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-timeline-admin.css', array(), $this->version, 'all' );
		$wtl_admin_pages = array( 'wtl_layouts', 'add_wtl_shortcode', 'wtl_export', 'wp-timeline-ads-license' );
		if ( isset( $_GET['page'] ) && ( in_array( $_GET['page'], $wtl_admin_pages, true ) ) ) {
			$admin_rtl_css_url = plugins_url( 'css/admin-rtl.css', __FILE__ );
			if ( is_rtl() ) {
				wp_register_style( 'wp-timeline-rtl-stylesheets', $admin_rtl_css_url, null, '1.0' );
				wp_enqueue_style( 'wp-timeline-rtl-stylesheets' );
			}
			wp_enqueue_script( 'jquery' );
			if ( function_exists( 'wp_enqueue_code_editor' ) ) {
				wp_enqueue_code_editor( array( 'type' => 'text/css' ) );
			}
			wp_register_style( 'wp-timeline-basic-tools-min', WTL_URL . '/public/css/basic-tools-min.css', null, '1.0' );
			wp_enqueue_style( 'wp-timeline-basic-tools-min' );
			wp_register_script( 'wp-timeline-front-social', WTL_URL . '/public/js/SocialShare.js', null, '1.0', false );
			wp_enqueue_script( 'wp-timeline-front-social' );
		}
		wp_register_style( 'wp-timeline-arsto', WTL_URL . '/admin/css/aristo.css', null, '1.0' );
		wp_enqueue_style( 'wp-timeline-arsto' );
		wp_register_style( 'wp-timeline-admin-cpts', WTL_URL . '/admin/css/admin-cpts.css', null, '1.0' );
		wp_enqueue_style( 'wp-timeline-admin-cpts' );
		wp_register_style( 'wp-timeline-admin', WTL_URL . '/admin/css/admin.css', null, '1.0' );
		wp_enqueue_style( 'wp-timeline-admin' );
		wp_register_style( 'slick', plugins_url( 'css/slick.css', __FILE__ ), null, '1.0' );
		wp_enqueue_style( 'slick' );
		wp_register_style( 'logbook', plugins_url( 'css/logbook.css', __FILE__ ), null, '1.0' );
		wp_enqueue_style( 'logbook' );
	}
	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		global $wp_version;
		wp_enqueue_style( 'wp-timeline-support', plugins_url( 'css/wp_timeline_support.css', __FILE__ ), null, '1.0' );
		$wtl_admin_pages = array( 'wtl_layouts', 'add_wtl_shortcode', 'wtl_export', 'designer_welcome_page', 'add_wtl_cpt' );
		if ( isset( $_GET['page'] ) && ( in_array( $_GET['page'], $wtl_admin_pages, true ) ) ) {
			wp_enqueue_style( 'wp-color-picker' );
			if ( function_exists( 'wp_enqueue_media' ) ) {
				wp_enqueue_media();
			}
			if ( isset( $_GET['page'] ) && ( 'add_wtl_shortcode' === $_GET['page'] ) ) {
				wp_enqueue_script( 'jquery-ui-datepicker' );
			}
			wp_enqueue_script( 'jquery-ui-dialog' );
			wp_enqueue_script( 'wp-timeline-admin', plugins_url( 'js/wp-timeline-admin.js', __FILE__ ), array( 'jquery', 'wp-color-picker', 'jquery-ui-core', 'jquery-ui-dialog', 'jquery-ui-datepicker' ), $this->version, false );
			wp_localize_script(
				'wp-timeline-admin',
				'wp_timeline_js',
				array(
					'wp_version'                  => $wp_version,
					'nothing_found'               => esc_html__( 'Oops, nothing found!', 'wp-timeline-designer-pro' ),
					'default_style_template'      => esc_html__( 'Apply default style of this selected template', 'wp-timeline-designer-pro' ),
					'no_template_exist'           => esc_html__( 'No template exist for selection', 'wp-timeline-designer-pro' ),
					'close'                       => esc_html__( 'Close', 'wp-timeline-designer-pro' ),
					'choose_blog_template'        => esc_html__( 'Choose the timeline template you love', 'wp-timeline-designer-pro' ),
					'set_blog_template'           => esc_html__( 'Set Timeline Template', 'wp-timeline-designer-pro' ),
					'select_arrow'                => esc_html__( 'Select Arrow', 'wp-timeline-designer-pro' ),
					'choose_single_post_template' => esc_html__( 'Choose the template you love for your single post', 'wp-timeline-pro' ),
					'reset_data'                  => esc_html__( 'Do you want to reset data?', 'wp-timeline-designer-pro' ),
					'enter_font_url'              => esc_html__( 'Please enter font URL', 'wp-timeline-designer-pro' ),
					'please_enter_font_url'       => esc_html__( 'Please enter a valid font URL', 'wp-timeline-designer-pro' ),
					'remove'                      => esc_html__( 'Remove', 'wp-timeline-designer-pro' ),
					'template_preview'            => esc_html__( 'Your template preview', 'wp-timeline-designer-pro' ),
					'remove_font'                 => esc_html__( 'Remove Font', 'wp-timeline-designer-pro' ),
					'font_added'                  => esc_html__( 'Font added successfully.', 'wp-timeline-designer-pro' ),
					'font_not_added'              => esc_html__( 'Font not added successfully.', 'wp-timeline-designer-pro' ),
					'delete_google_font'          => esc_html__( 'Are you sure want to delete google font?', 'wp-timeline-designer-pro' ),
					'font_deleted'                => esc_html__( 'Font deleted successfully.', 'wp-timeline-designer-pro' ),
					'font_not_deleted'            => esc_html__( 'Font not deleted successfully.', 'wp-timeline-designer-pro' ),
					'readmore'                    => esc_html__( 'Read More', 'wp-timeline-designer-pro' ),
					'loadmore'                    => esc_html__( 'Load More', 'wp-timeline-designer-pro' ),
					'info'                        => esc_html__( 'info.', 'wp-timeline-designer-pro' ),
					'information'                 => esc_html__( 'information', 'wp-timeline-designer-pro' ),
					'about'                       => esc_html__( 'About', 'wp-timeline-designer-pro' ),
					'learn_more'                  => esc_html__( 'Learn More', 'wp-timeline-designer-pro' ),
					'view_more'                   => esc_html__( 'View More', 'wp-timeline-designer-pro' ),
					'info_about'                  => esc_html__( 'Information about', 'wp-timeline-designer-pro' ),
					'read_more_hover'             => esc_html__( 'Read More Link Hover Color', 'wp-timeline-designer-pro' ),
					'wp_timeline_font_base'       => ( is_ssl() ) ? 'https://' : 'http://',
					'startup_text'                => esc_html__( 'STARTUP', 'wp-timeline-designer-pro' ),
					'is_rtl'                      => ( is_rtl() ) ? 1 : 0,
					'copied'                      => esc_html__( 'Copied', 'wp-timeline-designer-pro' ),
					'copy_for_support'            => esc_html__( 'Copy for Support', 'wp-timeline-designer-pro' ),
					'ajaxurl'                     => admin_url( 'admin-ajax.php' ),
					'ajax_nonce'                  => wp_create_nonce( 'ajax-nonce' ),
				)
			);
			wp_enqueue_script( 'choosen', plugins_url( 'js/chosen.jquery.min.js', __FILE__ ), null, '1.0', false );
			wp_enqueue_style( 'choosen', plugins_url( 'css/chosen.min.css', __FILE__ ), null, '1.0' );
		}
		wp_enqueue_script( 'wp-timeline-cpts', plugins_url( 'js/wp-timeline-cpts.js', __FILE__ ), array( 'jquery', 'wp-color-picker', 'jquery-ui-core', 'jquery-ui-dialog' ), '1.0', false );
		$wtl_cpts_translations = array(
			'select_gallery'      => esc_html__( 'Select Images for Gallery', 'wp-timeline-designer-pro' ),
			'custom_field_remove' => esc_html__( 'Require atleast one field', 'wp-timeline-designer-pro' ),
			'conformation'        => esc_html__( 'Are you sure you want to remove image?', 'wp-timeline-designer-pro' ),
		);
		wp_localize_script( 'wp-timeline-cpts', 'wtl_admin_cpts_translations', $wtl_cpts_translations );
		wp_enqueue_script( 'slick', plugins_url( 'js/slick.min.js', __FILE__ ), array( 'jquery' ), '1.0', false );
		wp_enqueue_script( 'logbook', plugins_url( 'js/logbook.js', __FILE__ ), array( 'jquery' ), '1.0', false );
		wp_register_script( 'easing', plugins_url( 'js/jquery.easing.js', __FILE__ ), array( 'jquery' ), '1.0', false );
		wp_enqueue_script( 'easing' );
		wp_register_style( 'aos', plugins_url( 'css/aos-min.css', __FILE__ ), null, '1.0' );
		wp_register_script( 'aos', plugins_url( 'js/aos-min.js', __FILE__ ), array( 'jquery' ), '1.0', false );
		wp_enqueue_script( 'aos' );
	}

	/**
	 * Add menu at admin panel.
	 *
	 * @global string $wtl_screen_option_page
	 */
	public function wtl_add_menu() {
		global $wtl_screen_option_page,$wtl_screen_option_page2;
		$manage_blog_designs    = $this->wtl_manage();
		$wtl_screen_option_page = add_menu_page( esc_html__( 'WP Timeline Designer PRO', 'wp-timeline-designer-pro' ), esc_html__( 'WP Timeline Designer PRO', 'wp-timeline-designer-pro' ), $manage_blog_designs, 'wtl_layouts', array( $this, 'wtl_display_shortcode_list' ), WTL_URL . '/images/wp-timeline.png' );
		add_action( "load-$wtl_screen_option_page", array( $this, 'wtl_screen_options' ) );
		add_submenu_page( 'wtl_layouts', esc_html__( 'Timeline Layouts', 'wp-timeline-designer-pro' ), esc_html__( 'Timeline Layouts', 'wp-timeline-designer-pro' ), $manage_blog_designs, 'wtl_layouts', array( $this, 'wtl_display_shortcode_list' ) );
		add_submenu_page( null, esc_html__( 'Timeline Layout Settings', 'wp-timeline-designer-pro' ), esc_html__( 'Add Timeline Layout', 'wp-timeline-designer-pro' ), $manage_blog_designs, 'add_wtl_shortcode', array( $this, 'wtl_edit_shortcode_layout' ) );
		$wtl_screen_option_page2 = add_submenu_page( 'wtl_layouts', esc_html__( 'Custom Post Type', 'wp-timeline-designer-pro' ), esc_html__( 'Custom Post Type', 'wp-timeline-designer-pro' ), $manage_blog_designs, 'wtl_cpts', array( $this, 'wtl_display_cpts_list' ) );
		add_action( "load-$wtl_screen_option_page2", array( $this, 'wtl_screen_options2' ) );
		add_submenu_page( null, esc_html__( 'Add Custom Post Type', 'wp-timeline-designer-pro' ), esc_html__( 'Add Custom Post Type', 'wp-timeline-designer-pro' ), $manage_blog_designs, 'add_wtl_cpt', array( $this, 'wtl_custom_post_type' ) );
		add_submenu_page( 'wtl_layouts', esc_html__( 'Import Layouts', 'wp-timeline-designer-pro' ), esc_html__( 'Import Layouts', 'wp-timeline-designer-pro' ), $manage_blog_designs, 'wtl_export', array( $this, 'wtl_import_layouts' ) );
		add_submenu_page( 'wtl_layouts', esc_html__( 'Getting Started', 'wp-timeline-designer-pro' ), esc_html__( 'Getting Started', 'wp-timeline-designer-pro' ), $manage_blog_designs, 'wtl_getting_started', array( $this, 'wtl_getting_started' ) );
	}

	/**
	 * Capability to admin menu.
	 *
	 * @return capability
	 */
	private function wtl_manage() {
		$manage_options_cap = apply_filters( 'wtl_manage_capability', 'manage_options' );
		return $manage_options_cap;
	}

	/**
	 * Add per page option in screen option in Timeline Layout templates list
	 *
	 * @global string $wtl_screen_option_page
	 */
	public function wtl_screen_options() {
		global $wtl_screen_option_page;
		$screen = get_current_screen();
		// get out of here if we are not on our settings page.
		if ( ! is_object( $screen ) || $screen->id != $wtl_screen_option_page ) {
			return;
		}
		$args = array(
			'label'   => esc_html__( 'Number of items per page:', 'wp-timeline-designer-pro' ),
			'default' => 10,
			'option'  => 'wtl_per_page',
		);
		add_screen_option( 'per_page', $args );
	}
	/**
	 * Add per page option in screen option in Timeline Layout templates list 2nd
	 *
	 * @global string $wtl_screen_option_page
	 */
	public function wtl_screen_options2() {
		global $wtl_screen_option_page2;
		$screen = get_current_screen();
		// get out of here if we are not on our settings page.
		if ( ! is_object( $screen ) || $screen->id != $wtl_screen_option_page2 ) {
			return;
		}
		$args = array(
			'label'   => esc_html__( 'Number of items per page:', 'wp-timeline-designer-pro' ),
			'default' => 10,
			'option'  => 'wtl_per_page',
		);
		add_screen_option( 'per_page', $args );
	}

	/**
	 * Validate Timeline Layout templates list screen options on update.
	 *
	 * @param bool   $status   Whether to save or skip saving the screen option value. Default false.
	 * @param string $option The option name.
	 * @param int    $value  The number of rows to use.
	 * @return type
	 */
	public function wtl_set_screen_option( $status, $option, $value ) {
		if ( 'wtl_per_page' == $option ) {
			return $value;
		}
	}

	/**
	 * Include admin Timeline Layout list page
	 *
	 * @return void
	 */
	public static function wtl_display_shortcode_list() {
		include_once 'assets/admin-shortcode-list.php';
	}

	/**
	 * Include admin edit form.
	 *
	 * @return void
	 */
	public static function wtl_edit_shortcode_layout() {
		include_once 'assets/admin-layout-settings.php';
	}

	/**
	 * Include admin Timeline Custom Post Type list page.
	 *
	 * @return void
	 */
	public static function wtl_display_cpts_list() {
		include_once 'assets/admin-custom-post-type-list.php';
	}

	/**
	 * Add Custom Post Type.
	 *
	 * @return void
	 */
	public static function wtl_custom_post_type() {
		include_once 'assets/add-custom-post-type.php';
	}

	/**
	 * Include Import data form Page.
	 *
	 * @return void
	 */
	public static function wtl_import_layouts() {
		include_once 'assets/admin-import-form.php';
	}

	/**
	 * Include License Settings Page.
	 *
	 * @return void
	 */
	public static function wtl_getting_started() {
		include_once 'assets/admin-getting-started.php';
	}

	/**
	 * Search template.
	 *
	 * @return void
	 */
	public function wtl_template_search_result() {
		if ( isset( $_POST['nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'ajax-nonce' ) ) {
			$template_name = isset( $_POST['temlate_name'] ) ? strtolower( sanitize_text_field( wp_unslash( $_POST['temlate_name'] ) ) ) : '';
			$tempate_list  = Wp_Timeline_Ajax::wtl_blog_template_list();
			foreach ( $tempate_list as $key => $value ) {
				if ( '' === $template_name ) {
					?>
					<div class="template-thumbnail <?php echo esc_attr( $value['class'] ); ?>" <?php echo ( isset( $value['data'] ) && '' != $value['data'] ) ? 'data-value="' . esc_attr( $value['data'] ) . '"' : ''; ?>>
						<div class="template-thumbnail-inner">
							<img src="<?php echo esc_url( WTL_URL ) . '/admin/images/layouts/' . esc_attr( $value['image_name'] ); ?>" data-value="<?php echo esc_attr( $key ); ?>" alt="<?php echo esc_attr( $value['template_name'] ); ?>" title="<?php echo esc_attr( $value['template_name'] ); ?>">
							<div class="hover_overlay">
								<div class="popup-template-name">
									<div class="popup-select"><a href="#"><?php esc_html_e( 'Select Template', 'wp-timeline-designer-pro' ); ?></a></div>
									<div class="popup-view"><a href="<?php echo esc_attr( $value['demo_link'] ); ?>" target="_blank"><?php esc_html_e( 'Live Demo', 'wp-timeline-designer-pro' ); ?></a></div>
								</div>
							</div>
						</div>
						<span class="wp-timeline-span-template-name"><?php echo esc_attr( $value['template_name'] ); ?></span>
					</div>
					<?php
				} elseif ( preg_match( '/' . trim( $template_name ) . '/', $key ) ) {
					?>
					<div class="template-thumbnail <?php echo esc_attr( $value['class'] ); ?>" <?php echo ( isset( $value['data'] ) && '' != $value['data'] ) ? 'data-value="' . esc_attr( $value['data'] ) . '"' : ''; ?>>
						<div class="template-thumbnail-inner">
							<img src="<?php echo esc_url( WTL_URL ) . '/admin/images/layouts/' . esc_attr( $value['image_name'] ); ?>" data-value="<?php echo esc_attr( $key ); ?>" alt="<?php echo esc_attr( $value['template_name'] ); ?>" title="<?php echo esc_attr( $value['template_name'] ); ?>">
							<div class="hover_overlay">
								<div class="popup-template-name">
									<div class="popup-select"><a href="#"><?php esc_html_e( 'Select Template', 'wp-timeline-designer-pro' ); ?></a></div>
									<div class="popup-view"><a href="<?php echo esc_attr( $value['demo_link'] ); ?>" target="_blank"><?php esc_html_e( 'Live Demo', 'wp-timeline-designer-pro' ); ?></a></div>
								</div>
							</div>
						</div>
						<span class="wp-timeline-span-template-name"><?php echo esc_attr( $value['template_name'] ); ?></span>
					</div>
					<?php
				}
			}
			exit();
		}
	}
	/**
	 *
	 * Set default value
	 *
	 * @global array $wtl_settings
	 */
	public function wtl_default_settings_function() {
		global $wtl_settings, $wpdb;
		if ( empty( $wtl_settings ) ) {
			$wtl_settings = array(
				'pagination_type'                          => 'paged',
				'pagination_text_color'                    => '#ffffff',
				'pagination_background_color'              => '#777777',
				'pagination_text_hover_color'              => '',
				'pagination_background_hover_color'        => '',
				'pagination_text_active_color'             => '',
				'pagination_active_background_color'       => '',
				'pagination_border_color'                  => '#b2b2b2',
				'pagination_active_border_color'           => '#007acc',
				'display_category'                         => '0',
				'display_tag'                              => '0',
				'display_author'                           => '0',
				'display_author_data'                      => '0',
				'display_author_biography'                 => '0',
				'display_date'                             => '0',
				'display_story_year'                       => '1',
				'display_thumbnail'                        => '0',
				'display_comment_count'                    => '0',
				'display_comment'                          => '0',
				'display_navigation'                       => '0',
				'template_name'                            => 'cool_horizontal',
				'template_alternativebackground'           => '0',
				'rss_use_excerpt'                          => '1',
				'social_share'                             => '1',
				'social_style'                             => '1',
				'social_icon_style'                        => '1',
				'social_icon_size'                         => '1',
				'facebook_link'                            => '1',
				'twitter_link'                             => '1',
				'linkedin_link'                            => '1',
				'email_link'                               => '1',
				'whatsapp_link'                            => '1',
				'pinterest_link'                           => '1',
				'facebook_link_with_count'                 => '0',
				'pinterest_link_with_count'                => '0',
				'social_count_position'                    => 'bottom',
				'wp_timeline_post_offset'                  => '0',
				'template_bgcolor'                         => '#ffffff',
				'template_category_border_color'           => '#02a6af',
				'template_category_dots_bg_color'          => '#02a6af',
				'template_category_dots_line_color'        => '#02a6af',
				'template_category_dots_wave_color'        => '#90e6e3',
				'template_metacolor'                       => '#02a6af',
				'template_color'                           => '#000',
				'template_ftcolor'                         => '#2376ad',
				'template_fthovercolor'                    => '#2b2b2b',
				'template_title_alignment'                 => 'left',
				'template_titlecolor'                      => '#222222',
				'template_titlehovercolor'                 => '#666666',
				'template_titlebackcolor'                  => '',
				'template_titlefontsize'                   => '30',
				'template_titlefontface'                   => '',
				'template_contentfontface'                 => '',
				'related_post_by'                          => 'category',
				'wp_timeline_related_post_order_by'        => 'date',
				'wp_timeline_related_post_order'           => 'DESC',
				'txtExcerptlength'                         => '50',
				'content_fontsize'                         => '14',
				'firstletter_fontsize'                     => '20',
				'firstletter_contentcolor'                 => '#000000',
				'template_contentcolor'                    => '#7b95a6',
				'txtReadmoretext'                          => 'Read More',
				'readmore_font_family_font_type'           => '',
				'readmore_font_family'                     => '',
				'readmore_fontsize'                        => '14',
				'readmore_font_weight'                     => 'normal',
				'readmore_font_line_height'                => '1.5',
				'readmore_font_text_transform'             => 'none',
				'readmore_font_text_decoration'            => 'none',
				'readmore_font_letter_spacing'             => '0',
				'read_more_on'                             => '2',
				'template_readmorecolor'                   => '#2376ad',
				'template_readmorehovercolor'              => '#2376ad',
				'template_readmorebackcolor'               => '#dcdee0',
				'readmore_button_border_radius'            => '0',
				'readmore_button_alignment'                => 'left',
				'readmore_button_paddingleft'              => '10',
				'readmore_button_paddingright'             => '10',
				'readmore_button_paddingtop'               => '3',
				'readmore_button_paddingbottom'            => '3',
				'readmore_button_marginleft'               => '0',
				'readmore_button_marginright'              => '0',
				'readmore_button_margintop'                => '0',
				'readmore_button_marginbottom'             => '0',
				'read_more_button_border_style'            => 'solid',
				'read_more_button_hover_border_style'      => 'solid',
				'readmore_button_hover_border_radius'      => '0',
				'wp_timeline_readmore_button_hover_borderleft' => '0',
				'wp_timeline_readmore_button_hover_borderleftcolor' => '',
				'wp_timeline_readmore_button_hover_borderright' => '0',
				'wp_timeline_readmore_button_hover_borderrightcolor' => '',
				'wp_timeline_readmore_button_hover_bordertop' => '0',
				'wp_timeline_readmore_button_hover_bordertopcolor' => '',
				'wp_timeline_readmore_button_hover_borderbottom' => '0',
				'wp_timeline_readmore_button_hover_borderbottomcolor' => '',
				'wp_timeline_readmore_button_borderleft'   => '0',
				'wp_timeline_readmore_button_borderleftcolor' => '',
				'wp_timeline_readmore_button_borderright'  => '0',
				'wp_timeline_readmore_button_borderrightcolor' => '',
				'wp_timeline_readmore_button_bordertop'    => '0',
				'wp_timeline_readmore_button_bordertopcolor' => '',
				'wp_timeline_readmore_button_borderbottom' => '0',
				'wp_timeline_readmore_button_borderbottomcolor' => '',
				'template_columns'                         => '2',
				'template_grid_skin'                       => 'default',
				'template_grid_height'                     => '300',
				'wp_timeline_blog_order_by'                => '',
				'wp_timeline_blog_order'                   => 'DESC',
				'related_post_title'                       => esc_html__( 'Related Posts', 'wp-timeline-designer-pro' ),
				'date_color_of_readmore'                   => '0',
				'template_easing'                          => 'easeOutSine',
				'display_timeline_bar'                     => '0',
				'item_width'                               => '400',
				'item_height'                              => '570',
				'display_arrows'                           => '1',
				'enable_autoslide'                         => '0',
				'enable_nav_to_scroll'                     => '0',
				'scroll_speed'                             => '1000',
				'easy_timeline_effect'                     => 'flip-effect',
				'display_feature_image'                    => '0',
				'thumbnail_skin'                           => '0',
				'display_sale_tag'                         => '0',
				'wp_timeline_sale_tagtext_alignment'       => 'left-top',
				'wp_timeline_sale_tagtext_marginleft'      => '5',
				'wp_timeline_sale_tagtext_marginright'     => '5',
				'wp_timeline_sale_tagtext_margintop'       => '5',
				'wp_timeline_sale_tagtext_marginbottom'    => '5',
				'wp_timeline_sale_tagtext_paddingleft'     => '5',
				'wp_timeline_sale_tagtext_paddingright'    => '5',
				'wp_timeline_sale_tagtext_paddingtop'      => '5',
				'wp_timeline_sale_tagtext_paddingbottom'   => '5',
				'wp_timeline_sale_tagtextcolor'            => '#ffffff',
				'wp_timeline_sale_tagbgcolor'              => '#777777',
				'wp_timeline_sale_tag_angle'               => '0',
				'wp_timeline_sale_tag_border_radius'       => '0',
				'wp_timeline_sale_tagfontface'             => '',
				'wp_timeline_sale_tagfontsize'             => '18',
				'wp_timeline_sale_tag_font_weight'         => '700',
				'wp_timeline_sale_tag_font_line_height'    => '1.5',
				'wp_timeline_sale_tag_font_italic'         => '0',
				'wp_timeline_sale_tag_font_text_transform' => 'none',
				'wp_timeline_sale_tag_font_text_decoration' => 'none',
				'display_product_rating'                   => '0',
				'wp_timeline_star_rating_bg_color'         => '#000000',
				'wp_timeline_star_rating_color'            => '#d3ced2',
				'wp_timeline_star_rating_alignment'        => 'left',
				'wp_timeline_star_rating_paddingleft'      => '5',
				'wp_timeline_star_rating_paddingright'     => '5',
				'wp_timeline_star_rating_paddingtop'       => '5',
				'wp_timeline_star_rating_paddingbottom'    => '5',
				'wp_timeline_star_rating_marginleft'       => '5',
				'wp_timeline_star_rating_marginright'      => '5',
				'wp_timeline_star_rating_margintop'        => '5',
				'wp_timeline_star_rating_marginbottom'     => '5',
				'display_product_price'                    => '0',
				'wp_timeline_pricetext_alignment'          => 'left',
				'wp_timeline_pricetext_paddingleft'        => '5',
				'wp_timeline_pricetext_paddingright'       => '5',
				'wp_timeline_pricetext_paddingtop'         => '5',
				'wp_timeline_pricetext_paddingbottom'      => '5',
				'wp_timeline_pricetext_marginleft'         => '5',
				'wp_timeline_pricetext_marginright'        => '5',
				'wp_timeline_pricetext_margintop'          => '5',
				'wp_timeline_pricetext_marginbottom'       => '5',
				'wp_timeline_pricetextcolor'               => '#444444',
				'wp_timeline_pricefontface_font_type'      => '',
				'wp_timeline_pricefontface'                => '',
				'wp_timeline_pricefontsize'                => '18',
				'wp_timeline_price_font_weight'            => '700',
				'wp_timeline_price_font_line_height'       => '1.5',
				'wp_timeline_price_font_italic'            => '0',
				'wp_timeline_price_font_letter_spacing'    => '0',
				'wp_timeline_price_font_text_transform'    => 'none',
				'wp_timeline_price_font_text_decoration'   => 'none',
				'wp_timeline_addtocart_button_font_text_transform' => 'none',
				'wp_timeline_addtocart_button_font_text_decoration' => 'none',
				'wp_timeline_addtowishlist_button_font_text_transform' => 'none',
				'wp_timeline_addtowishlist_button_font_text_decoration' => 'none',
				'display_addtocart_button'                 => '0',
				'wp_timeline_addtocart_button_fontface_font_type' => '',
				'wp_timeline_addtocart_button_fontface'    => '',
				'wp_timeline_addtocart_button_fontsize'    => '14',
				'wp_timeline_addtocart_button_font_weight' => 'normal',
				'wp_timeline_addtocart_button_font_italic' => '0',
				'wp_timeline_addtocart_button_letter_spacing' => '0',
				'display_addtocart_button_line_height'     => '1.5',
				'wp_timeline_addtocart_textcolor'          => '#ffffff',
				'wp_timeline_addtocart_backgroundcolor'    => '#777777',
				'wp_timeline_addtocart_text_hover_color'   => '#ffffff',
				'wp_timeline_addtocart_hover_backgroundcolor' => '#333333',
				'wp_timeline_addtocartbutton_borderleft'   => '0',
				'wp_timeline_addtocartbutton_borderleftcolor' => '',
				'wp_timeline_addtocartbutton_borderright'  => '0',
				'wp_timeline_addtocartbutton_borderrightcolor' => '',
				'wp_timeline_addtocartbutton_bordertop'    => '0',
				'wp_timeline_addtocartbutton_bordertopcolor' => '',
				'wp_timeline_addtocartbutton_borderbottom' => '0',
				'wp_timeline_addtocartbutton_borderbottomcolor' => '',
				'wp_timeline_addtocartbutton_hover_borderleft' => '0',
				'wp_timeline_addtocartbutton_hover_borderleftcolor' => '',
				'wp_timeline_addtocartbutton_hover_borderright' => '0',
				'wp_timeline_addtocartbutton_hover_borderrightcolor' => '',
				'wp_timeline_addtocartbutton_hover_bordertop' => '0',
				'wp_timeline_addtocartbutton_hover_bordertopcolor' => '',
				'wp_timeline_addtocartbutton_hover_borderbottom' => '0',
				'wp_timeline_addtocartbutton_hover_borderbottomcolor' => '',
				'display_addtocart_button_border_hover_radius' => '0',
				'wp_timeline_addtocartbutton_hover_padding_leftright' => '0',
				'wp_timeline_addtocartbutton_hover_padding_topbottom' => '0',
				'wp_timeline_addtocartbutton_hover_margin_topbottom' => '0',
				'wp_timeline_addtocartbutton_hover_margin_leftright' => '0',
				'wp_timeline_addtocartbutton_padding_leftright' => '10',
				'wp_timeline_addtocartbutton_padding_topbottom' => '10',
				'wp_timeline_addtocartbutton_margin_leftright' => '15',
				'wp_timeline_addtocartbutton_margin_topbottom' => '10',
				'wp_timeline_addtocartbutton_alignment'    => 'left',
				'display_addtocart_button_border_radius'   => '0',
				'wp_timeline_addtocart_button_left_box_shadow' => '0',
				'wp_timeline_addtocart_button_right_box_shadow' => '0',
				'wp_timeline_addtocart_button_top_box_shadow' => '0',
				'wp_timeline_addtocart_button_bottom_box_shadow' => '0',
				'wp_timeline_addtocart_button_box_shadow_color' => '',
				'wp_timeline_addtocart_button_hover_left_box_shadow' => '0',
				'wp_timeline_addtocart_button_hover_right_box_shadow' => '0',
				'wp_timeline_addtocart_button_hover_top_box_shadow' => '0',
				'wp_timeline_addtocart_button_hover_bottom_box_shadow' => '0',
				'wp_timeline_addtocart_button_hover_box_shadow_color' => '',
				'display_addtowishlist_button'             => '0',
				'wp_timeline_wishlistbutton_alignment'     => 'left',
				'wp_timeline_cart_wishlistbutton_alignment' => 'left',
				'wp_timeline_wishlistbutton_on'            => '1',
				'wp_timeline_addtowishlist_button_fontface_font_type' => '',
				'wp_timeline_addtowishlist_button_fontface' => '',
				'wp_timeline_addtowishlist_button_fontsize' => '14',
				'wp_timeline_addtowishlist_button_font_weight' => 'normal',
				'wp_timeline_addtowishlist_button_font_italic' => '0',
				'wp_timeline_addtowishlist_button_letter_spacing' => '0',
				'display_wishlist_button_line_height'      => '1.5',
				'wp_timeline_wishlist_textcolor'           => '#ffffff',
				'wp_timeline_wishlist_text_hover_color'    => '#ffffff',
				'wp_timeline_wishlist_backgroundcolor'     => '#777777',
				'wp_timeline_wishlist_hover_backgroundcolor' => '#333333',
				'display_wishlist_button_border_radius'    => '0',
				'wp_timeline_wishlistbutton_borderleft'    => '0',
				'wp_timeline_wishlistbutton_borderleftcolor' => '',
				'wp_timeline_wishlistbutton_borderright'   => '0',
				'wp_timeline_wishlistbutton_borderrightcolor' => '',
				'wp_timeline_wishlistbutton_bordertop'     => '0',
				'wp_timeline_wishlistbutton_bordertopcolor' => '',
				'wp_timeline_wishlistbutton_borderbuttom'  => '0',
				'wp_timeline_wishlistbutton_borderbottomcolor' => '',
				'wp_timeline_wishlistbutton_hover_borderleft' => '0',
				'wp_timeline_wishlistbutton_hover_borderleftcolor' => '',
				'wp_timeline_wishlistbutton_hover_borderright' => '0',
				'wp_timeline_wishlistbutton_hover_borderrightcolor' => '',
				'wp_timeline_wishlistbutton_hover_bordertop' => '0',
				'wp_timeline_wishlistbutton_hover_bordertopcolor' => '',
				'wp_timeline_wishlistbutton_hover_borderbuttom' => '0',
				'wp_timeline_wishlistbutton_hover_borderbottomcolor' => '',
				'wp_timeline_wishlistbutton_padding_leftright' => '10',
				'wp_timeline_wishlistbutton_padding_topbottom' => '10',
				'wp_timeline_wishlistbutton_margin_leftright' => '10',
				'wp_timeline_wishlistbutton_margin_topbottom' => '10',
				'wp_timeline_wishlistbutton_hover_margin_topbottom' => '5',
				'wp_timeline_wishlistbutton_hover_margin_leftright' => '5',
				'display_acf_field'                        => '0',
				'wp_timeline_acf_field'                    => '',
				'display_download_price'                   => '0',
				'wp_timeline_edd_price_alignment'          => 'left',
				'wp_timeline_edd_price_paddingleft'        => '5',
				'wp_timeline_edd_price_paddingright'       => '5',
				'wp_timeline_edd_price_paddingtop'         => '5',
				'wp_timeline_edd_price_paddingbottom'      => '5',
				'wp_timeline_edd_price_color'              => '#444444',
				'wp_timeline_edd_pricefontface_font_type'  => '',
				'wp_timeline_edd_pricefontface'            => '',
				'wp_timeline_edd_pricefontsize'            => '18',
				'wp_timeline_edd_price_font_weight'        => '700',
				'wp_timeline_edd_price_font_line_height'   => '1.5',
				'wp_timeline_edd_price_font_italic'        => '0',
				'wp_timeline_edd_price_font_letter_spacing' => '0',
				'wp_timeline_edd_price_font_text_decoration' => 'none',
				'display_edd_addtocart_button'             => '0',
				'wp_timeline_edd_addtocart_button_fontface_font_type' => '',
				'wp_timeline_edd_addtocart_button_fontface' => '',
				'wp_timeline_edd_addtocart_button_fontsize' => '14',
				'wp_timeline_edd_addtocart_button_font_weight' => 'normal',
				'wp_timeline_edd_addtocart_button_font_italic' => '0',
				'wp_timeline_edd_addtocart_button_letter_spacing' => '0',
				'display_edd_addtocart_button_line_height' => '1.5',
				'wp_timeline_edd_addtocart_textcolor'      => '#ffffff',
				'wp_timeline_edd_addtocart_backgroundcolor' => '#777777',
				'wp_timeline_edd_addtocart_text_hover_color' => '#ffffff',
				'wp_timeline_edd_addtocart_hover_backgroundcolor' => '#333333',
				'wp_timeline_edd_addtocartbutton_borderleft' => '0',
				'wp_timeline_edd_addtocartbutton_borderleftcolor' => '',
				'wp_timeline_edd_addtocartbutton_borderright' => '0',
				'wp_timeline_edd_addtocartbutton_borderrightcolor' => '',
				'wp_timeline_edd_addtocartbutton_bordertop' => '0',
				'wp_timeline_edd_addtocartbutton_bordertopcolor' => '',
				'wp_timeline_edd_addtocartbutton_borderbottom' => '0',
				'wp_timeline_edd_addtocartbutton_borderbottomcolor' => '',
				'wp_timeline_edd_addtocartbutton_hover_borderleft' => '0',
				'wp_timeline_edd_addtocartbutton_hover_borderleftcolor' => '',
				'wp_timeline_edd_addtocartbutton_hover_borderright' => '0',
				'wp_timeline_edd_addtocartbutton_hover_borderrightcolor' => '',
				'wp_timeline_edd_addtocartbutton_hover_bordertop' => '0',
				'wp_timeline_edd_addtocartbutton_hover_bordertopcolor' => '',
				'wp_timeline_edd_addtocartbutton_hover_borderbottom' => '0',
				'wp_timeline_edd_addtocartbutton_hover_borderbottomcolor' => '',
				'display_edd_addtocart_button_border_hover_radius' => '0',
				'wp_timeline_edd_addtocartbutton_hover_padding_leftright' => '0',
				'wp_timeline_edd_addtocartbutton_hover_padding_topbottom' => '0',
				'wp_timeline_edd_addtocartbutton_hover_margin_topbottom' => '0',
				'wp_timeline_edd_addtocartbutton_hover_margin_leftright' => '0',
				'wp_timeline_edd_addtocartbutton_padding_leftright' => '10',
				'wp_timeline_edd_addtocartbutton_padding_topbottom' => '10',
				'wp_timeline_edd_addtocartbutton_margin_leftright' => '15',
				'wp_timeline_edd_addtocartbutton_margin_topbottom' => '10',
				'wp_timeline_edd_addtocartbutton_alignment' => 'left',
				'display_edd_addtocart_button_border_radius' => '0',
				'wp_timeline_edd_addtocart_button_left_box_shadow' => '0',
				'wp_timeline_edd_addtocart_button_right_box_shadow' => '0',
				'wp_timeline_edd_addtocart_button_top_box_shadow' => '0',
				'wp_timeline_edd_addtocart_button_bottom_box_shadow' => '0',
				'wp_timeline_edd_addtocart_button_box_shadow_color' => '',
				'wp_timeline_edd_addtocart_button_hover_left_box_shadow' => '0',
				'wp_timeline_edd_addtocart_button_hover_right_box_shadow' => '0',
				'wp_timeline_edd_addtocart_button_hover_top_box_shadow' => '0',
				'wp_timeline_edd_addtocart_button_hover_bottom_box_shadow' => '0',
				'wp_timeline_edd_addtocart_button_hover_box_shadow_color' => '',
			);
			$wtl_settings = apply_filters( 'wp_timeline_change_default_settings', $wtl_settings );
		}
	}

	/**
	 *
	 * Create table if table not found when plugin is active
	 *
	 * @global object $wpdb
	 */
	public function wtl_table_status() {
		global $wpdb;
		if ( is_plugin_active( 'wp-timeline-designer-pro/wp-timeline-designer-pro.php' ) ) {
			$wp_timeline_ro_shortcode = $wpdb->prefix . 'wtl_shortcodes';
			if ( $wpdb->get_var( "SHOW TABLES LIKE '$wp_timeline_ro_shortcode'" ) != $wp_timeline_ro_shortcode ) {
				$this->wtl_create_shortcodes_table();
			}
			$wp_timeline_ro_cpts = $wpdb->prefix . 'wtl_cpts';
			if ( $wpdb->get_var( "SHOW TABLES LIKE '$wp_timeline_ro_cpts'" ) != $wp_timeline_ro_cpts ) {
				$this->wtl_create_cpts_table();
			}
		}
	}

	/**
	 * Create Table for Shortcode
	 */
	public function wtl_create_shortcodes_table() {
		global $wpdb;
		$table_name      = $wpdb->prefix . 'wtl_shortcodes';
		$charset_collate = '';
		if ( ! empty( $wpdb->charset ) ) {
			$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
		}
		if ( ! empty( $wpdb->collate ) ) {
			$charset_collate .= " COLLATE $wpdb->collate";
		}
		$sql = "CREATE TABLE $table_name (
			wtlid int(9) NOT NULL AUTO_INCREMENT,
			shortcode_name tinytext NOT NULL,
			wtlsettngs text NOT NULL,
			UNIQUE KEY wtlid (wtlid)
		) $charset_collate;";
		// reference to upgrade.php file.
		include_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );
	}

	/**
	 * Create Custom post type table.
	 *
	 * @return void;
	 */
	public function wtl_create_cpts_table() {
		global $wpdb;
		$table_name      = $wpdb->prefix . 'wtl_cpts';
		$charset_collate = '';
		if ( ! empty( $wpdb->charset ) ) {
			$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
		}
		if ( ! empty( $wpdb->collate ) ) {
			$charset_collate .= " COLLATE $wpdb->collate";
		}
		$sql = "CREATE TABLE  $table_name (id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,name varchar(191) NOT NULL,slug varchar(191) NOT NULL,setting longtext NULL) $charset_collate;";
		include_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );
	}

	/**
	 * Save template at admin side
	 *
	 * @global object $wpdb
	 * @global array $wtl_settings
	 * @global WP_Error $wtl_errors
	 * @global string $wtl_success
	 */
	public function wtl_save_layouts() {
		global $wpdb, $wtl_settings, $wp_timeline_errors, $wtl_success;
		$table_name = $wpdb->prefix . 'wtl_shortcodes';
		if ( isset( $_GET['page'] ) && ( 'wtl_layouts' === $_GET['page'] || 'add_wtl_shortcode' === $_GET['page'] ) ) {
			$user   = wp_get_current_user();
			$closed = array( 'wp_timeline_general' );
			$closed = array_filter( $closed );
			if ( 'wtl_layouts' === $_GET['page'] ) {
				update_user_option( $user->ID, 'wptclosewptboxes_add_wtl_shortcode', $closed, true );
			}
		}
		/** Save Timeline Layout Template */
		if ( isset( $_GET['page'] ) && 'add_wtl_shortcode' === $_GET['page'] ) {
			if ( ! isset( $_GET['action'] ) || '' === $_GET['action'] ) {
				$user   = wp_get_current_user();
				$closed = array( 'wp_timeline_general' );
				$closed = array_filter( $closed );
				update_user_option( $user->ID, 'wptclosewptboxes_add_wtl_shortcode', $closed, true );
			}
			if ( isset( $_POST['savedata'] ) || ( isset( $_POST['resetdata'] ) && '' !== $_POST['resetdata'] ) ) {
				if ( isset( $_POST['wtl-submit-nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wtl-submit-nonce'] ) ), 'wtl-shortcode-form-submit' ) ) {
					$wtl_settings = isset( $_POST ) ? $_POST : '';
					if ( isset( $wtl_settings ) && ! empty( $wtl_settings ) ) {
						foreach ( $wtl_settings as $single_key => $single_val ) {
							if ( is_array( $single_val ) ) {
								foreach ( $single_val as $s_key => $s_val ) {
									$wtl_settings[ $single_key ][ $s_key ] = sanitize_text_field( $s_val );
								}
							} else {
								if ( 'custom_css' === $single_key ) {
									$wtl_settings[ $single_key ] = wp_strip_all_tags( $single_val );
								} else {
									$wtl_settings[ $single_key ] = sanitize_text_field( $single_val );
								}
							}
						}
					}
				}
				$templates = array();
				if ( isset( $_POST['wtl-submit-nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wtl-submit-nonce'] ) ), 'wtl-shortcode-form-submit' ) ) {
					if ( isset( $_GET['action'] ) && 'edit' === $_GET['action'] ) {

						if ( isset( $_GET['id'] ) && ! empty( $_GET['id'] ) ) {
							$shortcode_id = intval( $_GET['id'] );
						} else {
							$shortcode_id = '';
						}
						$wtl_settings   = apply_filters( 'wtl_update_blog_layout_settings', $wtl_settings );
						$unique_sc_name = isset( $_POST['unique_shortcode_name'] ) ? sanitize_text_field( wp_unslash( $_POST['unique_shortcode_name'] ) ) : '';
						$save           = $wpdb->update(
							$table_name,
							array(
								'shortcode_name' => $unique_sc_name,
								'wtlsettngs'     => maybe_serialize( $wtl_settings ),
							),
							array( 'wtlid' => $shortcode_id ),
							array( '%s', '%s' ),
							array( '%d' )
						);
						if ( isset( $save ) && false == $save ) {
							$wp_timeline_errors = new WP_Error( 'save_error', esc_html__( 'No Changes Found.', 'wp-timeline-designer-pro' ) );
						} else {
							$templates['ID']           = isset( $_POST['wtl_page_display'] ) ? sanitize_text_field( wp_unslash( $_POST['wtl_page_display'] ) ) : '';
							$templates['post_content'] = '[wp_timeline_design id="' . $shortcode_id . '"]';
							wp_update_post( $templates );
							if ( isset( $_POST['resetdata'] ) && '' !== $_POST['resetdata'] ) {
								$wtl_success = esc_html__( 'Layout reset successfully.', 'wp-timeline-designer-pro' );
								do_action( 'wp_timeline_reset_shortcode', $shortcode_id );
							} else {
								$wtl_success = esc_html__( 'Layout updated successfully. ', 'wp-timeline-designer-pro' );
								do_action( 'wp_timeline_update_shortcode', $shortcode_id );
							}
							if ( isset( $_POST['wtl_page_display'] ) && $_POST['wtl_page_display'] > 0 ) {
								$wtl_success .= ' <a href="' . esc_url( get_the_permalink( sanitize_text_field( wp_unslash( $_POST['wtl_page_display'] ) ) ) ) . '" target="_blank">' . esc_html__( 'View Layout', 'wp-timeline-designer-pro' ) . '</a>';
							}
						}
					} else {
						$wtl_settings = apply_filters( 'wtl_add_blog_layout_settings', $wtl_settings );
						$shortcode_id = wtl_insert_layout( sanitize_text_field( wp_unslash( $_POST['unique_shortcode_name'] ) ), $wtl_settings );
						$shortcode_id = intval( $shortcode_id );
						if ( $shortcode_id > 0 ) {
							$message = 'shortcode_added_msg';
						} else {
							wp_die( esc_html__( 'Error in Adding shortcode.', 'wp-timeline-designer-pro' ) );
						}
						$templates['ID']           = sanitize_text_field( wp_unslash( $_POST['wtl_page_display'] ) );
						$templates['post_content'] = '[wp_timeline_design id="' . $shortcode_id . '"]';
						wp_update_post( $templates );
						$send = admin_url( 'admin.php?page=add_wtl_shortcode&action=edit&id=' . $shortcode_id );
						$send = add_query_arg( 'message', $message, $send );
						do_action( 'wtl_add_blog_shortcode', $shortcode_id );
						wp_safe_redirect( $send );
						exit();
					}
				} else {
					wp_safe_redirect( '?page=wtl_layouts' );
				}
			}
		}
		/** Save Getting Started Page options */
		if ( isset( $_GET['page'] ) && 'wtl_getting_started' === $_GET['page'] ) {
			if ( isset( $_POST['savedata'] ) ) {
				$wptimeline_settings = $_POST;
				if ( isset( $_POST['wp-timeline-singlefile-submit-nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wp-timeline-singlefile-submit-nonce'] ) ), 'wp-timeline-singlefile-form-submit' ) ) {
					$template            = 'bdp_templates/single/single.php';
					$wptimeline_settings = apply_filters( 'wp_timeline_update_single_file_settings', $wtl_settings );
					$save                = update_option( 'wp_timeline_single_file_template', maybe_serialize( $wtl_settings ) );
					$singlefilehtml      = isset( $_POST['singlefile_html'] ) ? sanitize_text_field( wp_unslash( $_POST['singlefile_html'] ) ) : '';
					self::singlefile_save_template( $singlefilehtml, $template );
					$wp_timeline_success = esc_html__( 'Single file updated successfully.', 'wp-timeline-designer-pro' );
					do_action( 'wp_timeline_update_single_file' );
				}
			}
		}
	}

	/**
	 * Save the single templates.
	 *
	 * @param string $template_code code.
	 * @param string $template_path path.
	 * @return void
	 */
	public static function singlefile_save_template( $template_code, $template_path ) {
		if ( current_user_can( 'edit_themes' ) && ! empty( $template_code ) && ! empty( $template_path ) ) {
			$saved = false;
			$file  = get_stylesheet_directory() . '/' . $template_path;
			$code  = stripslashes( $template_code );
			WP_Filesystem();
			global $wp_filesystem;
			if ( is_writeable( $file ) ) {
				$f = $wp_filesystem->get_contents( $file );
				if ( false != $f ) {
					$wp_filesystem->put_contents( $f, $code );
					$saved = true;
				}
			}
			if ( ! $saved ) {
				$redirect = add_query_arg( 'wp_timeline_errors', rawurlencode( esc_html__( 'Could not write to template file.', 'wp-timeline-designer-pro' ) ) );
				wp_safe_redirect( $redirect );
				exit;
			}
		}
	}

	/**
	 * Duplicate Layout
	 */
	public function wtl_duplicate_layout() {
		/** Duplicate Timeline Layout */
		if ( isset( $_GET['wtl_duplicate_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['wtl_duplicate_nonce'] ) ), 'wtl_duplicate_nonce' ) ) {
			echo 'dsdk';
			if ( ( isset( $_GET['wplayout'] ) && '' !== $_GET['wplayout'] ) && ( isset( $_GET['action'] ) && 'duplicate_post_in_edit' === $_GET['action'] ) ) {
				$user   = wp_get_current_user();
				$closed = array( 'wp_timeline_general' );
				$closed = array_filter( $closed );
				update_user_option( $user->ID, 'wptclosewptboxes_add_wtl_shortcode', $closed, true );
				$layout_setting = Wp_Timeline_Main::wtl_get_shortcode_settings( sanitize_text_field( wp_unslash( $_GET['wplayout'] ) ) );
				if ( $layout_setting ) {
					$layout_setting['wtl_page_display'] = 0;
					$shortcode_name                     = $layout_setting['unique_shortcode_name'] . ' ' . esc_html__( 'Copy', 'wp-timeline-designer-pro' );
					$shortcode_id                       = wtl_insert_layout( $shortcode_name, $layout_setting );
					if ( $shortcode_id > 0 ) {
						$message = 'shortcode_duplicate_msg';
					} else {
						wp_die( esc_html__( 'Error in Adding shortcode.', 'wp-timeline-designer-pro' ) );
					}
					do_action( 'wtl_duplicate_layout_settings', $shortcode_id );
					$send = admin_url( 'admin.php?page=add_wtl_shortcode&action=edit&id=' . $shortcode_id );
					$send = add_query_arg( 'message', $message, $send );
					wp_safe_redirect( $send );
					exit();
				} else {
					wp_die( esc_html__( 'No layout to duplicate has been supplied!', 'wp-timeline-designer-pro' ) );
				}
			}
		}
	}

	/**
	 * Delete Layout
	 *
	 * @global object $wpdb
	 */
	public function wtl_delete_layout() {
		global $wpdb;
		if ( isset( $_GET['page'] ) && 'wtl_layouts' === $_GET['page'] && isset( $_GET['action'] ) && 'delete' === $_GET['action'] && isset( $_GET['_wpnonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ) ) ) {
			if ( isset( $_GET['id'] ) && ! empty( $_GET['id'] ) ) {
				$shortcode_id = intval( $_GET['id'] );
			} else {
				$shortcode_id = '';
			}
			do_action( 'wtl_delete_shortcode', $shortcode_id );
			$wtl_table_name        = $wpdb->prefix . 'wtl_shortcodes';
			$wp_timeline_is_delete = $wpdb->delete( $wtl_table_name, array( 'wtlid' => $shortcode_id ) );
		}
	}
	/**
	 * Multiple Deletion of shortcode
	 *
	 * @global object $wpdb
	 */
	public function wtl_multiple_delete_layouts() {
		global $wpdb;
		$wtl_table_name = $wpdb->prefix . 'wtl_shortcodes';
		if ( isset( $_POST['wtl_take_action_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wtl_take_action_nonce'] ) ), 'wtl_take_action' ) ) {
			if ( isset( $_POST['take_action'] ) && isset( $_GET['page'] ) && 'wtl_layouts' == $_GET['page'] ) {
				if ( ( isset( $_POST['wtl-action-top'] ) && esc_html( sanitize_text_field( wp_unslash( $_POST['wtl-action-top'] ) ) ) == 'delete_pr' ) || ( isset( $_POST['wtl-action-top2'] ) && esc_html( sanitize_text_field( wp_unslash( $_POST['wtl-action-top2'] ) ) ) == 'delete_pr' ) ) {
					if ( isset( $_POST['chk_remove_all'] ) && ! empty( $_POST['chk_remove_all'] ) ) {
						$shortcodes = array_map( 'sanitize_text_field', wp_unslash( $_POST['chk_remove_all'] ) );
						if ( isset( $_GET['page'] ) ) {
							$result = wp_cache_get( 'wtl_wtl_shortcodes' );
							if ( false == $result ) {
								wp_cache_set( 'wtl_wtl_shortcodes', $result );
							}
							foreach ( $shortcodes as $shortcode ) {
								$shortcode = intval( $shortcode );
								do_action( 'wtl_delete_shortcode', $shortcode );
								$wpdb->delete( $wtl_table_name, array( 'wtlid' => $shortcode ) );
							}
						}
					}
				}
			}
		}
	}


	/**
	 * Export Layout
	 *
	 * @since 1.0
	 */
	public function wtl_multiple_export_layouts() {
		global $wpdb;
		if ( isset( $_POST['wtl_take_action_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wtl_take_action_nonce'] ) ), 'wtl_take_action' ) ) {
			if ( isset( $_POST['take_action'] ) && isset( $_GET['page'] ) && 'wtl_layouts' === $_GET['page'] ) {
				if ( ( isset( $_POST['wtl-action-top'] ) && 'wtl_export' === esc_html( sanitize_text_field( wp_unslash( $_POST['wtl-action-top'] ) ) ) ) || ( isset( $_POST['wtl-action-top2'] ) && 'wtl_export' === esc_html( sanitize_text_field( wp_unslash( $_POST['wtl-action-top2'] ) ) ) ) ) {
					if ( isset( $_POST['chk_remove_all'] ) && ! empty( $_POST['chk_remove_all'] ) && isset( $_GET['page'] ) && 'wtl_layouts' === $_GET['page'] ) {
						$wp_timeline_table = $wpdb->prefix . 'wtl_shortcodes';
						$export_layout     = array();
						$shortcodes        = array_map( 'sanitize_text_field', wp_unslash( $_POST['chk_remove_all'] ) );
						foreach ( $shortcodes as $shortcode ) {
							$shortcode = intval( $shortcode );
							$get_data  = '';
							if ( is_numeric( $shortcode ) ) {
								$get_data = $wpdb->get_row( "SELECT * FROM $wp_timeline_table WHERE wtlid = $shortcode", ARRAY_A );
							}
							do_action( 'wtl_export_blog_layout_settings', $shortcode );
							if ( ! empty( $get_data ) ) {
								$wptsettings                     = maybe_unserialize( $get_data['wtlsettngs'] );
								$wptsettings['wtl_page_display'] = '0';
								$get_data['wtlsettngs']          = maybe_serialize( $wptsettings );
								$export_layout[]                 = $get_data;
							}
						}
						if ( count( $export_layout ) > 0 ) {
							$output = base64_encode( maybe_serialize( $export_layout ) );
							$this->save_as_txt_file( 'wp_timeline_layouts.txt', $output );
						}
					}
				}
			}
		}
	}
	/**
	 * Save Text file.
	 *
	 * @param string $file_name file name.
	 * @param string $output output.
	 * @return void
	 */
	public function save_as_txt_file( $file_name, $output ) {
		header( 'Content-type: application/text', true, 200 );
		header( "Content-Disposition: attachment; filename=$file_name" );
		header( 'Pragma: no-cache' );
		header( 'Expires: 0' );
		echo esc_html( $output );
		exit;
	}

	/**
	 * Import layouts.
	 *
	 * @global string $import_success
	 * @global object $wpdb
	 * @global string $import_error
	 */
	public function wtl_upload_import_file() {
		if ( ! empty( $_POST ) && ! empty( $_FILES['wtl_import'] ) && check_admin_referer( 'wtl_import', 'wtl_import_nonce' ) ) {
			// check_admin_referer prints fail page and dies.
			global $import_success, $wpdb, $import_error;
			// Uploaded file.
			$uploaded_file = array_map( 'sanitize_text_field', wp_unslash( $_FILES['wtl_import'] ) );
			if ( isset( $_POST['wtl_layout_import_types'] ) && '' === $_POST['wtl_layout_import_types'] ) {
				$import_error = esc_html__( 'You must have to select import type', 'wp-timeline-designer-pro' );
				return;
			}
			// Check file type.
			$mimes                = array(
				'txt' => 'text/plain',
			);
			$wp_timeline_filetype = wp_check_filetype( $uploaded_file['name'], $mimes );
			if ( 'txt' !== $wp_timeline_filetype['ext'] && ! wp_match_mime_types( 'txt', $wp_timeline_filetype['type'] ) ) {
				$import_error = esc_html__( 'You must upload a .txt file generated by this plugin.', 'wp-timeline-designer-pro' );
				return;
			}
			// Upload file and check uploading error.
			$file_data = wp_handle_upload(
				$uploaded_file,
				array(
					'test_type' => false,
					'test_form' => false,
				)
			);
			if ( isset( $file_data['error'] ) ) {
				$import_error = $file_data['error'];
				return;
			}
			// Check file exists or not.
			if ( ! file_exists( $file_data['file'] ) ) {
				$import_error = esc_html__( 'Import file could not be found. Please try again.', 'wp-timeline-designer-pro' );
				return;
			}
			$content = $this->import_layouts( $file_data['file'] );
			if ( $content ) {
				/** Import Timeline Layout */
				if ( isset( $_POST['wtl_layout_import_types'] ) && 'wp_timeline_blog_layouts' === $_POST['wtl_layout_import_types'] ) {
					$wtl_table_name = $wpdb->prefix . 'wtl_shortcodes';
					if ( $wpdb->get_var( "SHOW TABLES LIKE '$wtl_table_name'" ) == $wtl_table_name ) {
						foreach ( $content as $single_content ) {
							$shortcode_name = isset( $single_content['shortcode_name'] ) ? $single_content['shortcode_name'] : '';
							$wtlsettngs     = isset( $single_content['wtlsettngs'] ) ? maybe_unserialize( $single_content['wtlsettngs'] ) : '';
							if ( isset( $wtlsettngs ) && ! empty( $wtl_settings ) ) {
								foreach ( $wtlsettngs as $single_key => $single_val ) {
									if ( is_array( $single_val ) ) {
										foreach ( $single_val as $s_key => $s_val ) {
											$wtlsettngs[ $single_key ][ $s_key ] = sanitize_text_field( $s_val );
										}
									} else {
										if ( 'custom_css' === $single_key ) {
											$wtlsettngs[ $single_key ] = wp_strip_all_tags( $single_val );
										} else {
											$wtlsettngs[ $single_key ] = sanitize_text_field( $single_val );
										}
									}
								}
							}
							$blog_layout_id = $wpdb->insert(
								$wtl_table_name,
								array(
									'shortcode_name' => sanitize_text_field( $shortcode_name ),
									'wtlsettngs'     => maybe_serialize( $wtlsettngs ),
								)
							);
							do_action( 'wtl_import_blog_layout_settings', $shortcode_name );
						}
						$import_success = esc_html__( 'Timeline Layout imported successfully.', 'wp-timeline-designer-pro' );
					} else {
						$import_error = esc_html__( 'Table not found. Please try again.', 'wp-timeline-designer-pro' );
						return;
					}
				}
				/** Import Custom Post Type */
				if ( isset( $_POST['wtl_layout_import_types'] ) && 'wp_timeline_cpt' === $_POST['wtl_layout_import_types'] ) {
					$wtl_table_name = $wpdb->prefix . 'wtl_cpts';
					if ( $wpdb->get_var( "SHOW TABLES LIKE '$wtl_table_name'" ) == $wtl_table_name ) {
						foreach ( $content as $single_content ) {
							$shortcode_name = isset( $single_content['name'] ) ? $single_content['name'] : '';
							$slug           = isset( $single_content['slug'] ) ? $single_content['slug'] : '';
							$wtlsettngs     = isset( $single_content['setting'] ) ? maybe_unserialize( $single_content['setting'] ) : '';
							if ( isset( $wtlsettngs ) && ! empty( $wtl_settings ) ) {
								foreach ( $wtlsettngs as $single_key => $single_val ) {
									if ( is_array( $single_val ) ) {
										foreach ( $single_val as $s_key => $s_val ) {
											$wtlsettngs[ $single_key ][ $s_key ] = sanitize_text_field( $s_val );
										}
									}
								}
							}
							$blog_layout_id = $wpdb->insert(
								$wtl_table_name,
								array(
									'name'    => sanitize_text_field( $shortcode_name ),
									'slug'    => sanitize_text_field( $slug ),
									'setting' => maybe_serialize( $wtlsettngs ),
								)
							);
						}
						$import_success = esc_html__( 'Timeline Custom Post Type imported successfully', 'wp-timeline-designer-pro' );
					} else {
						$import_error = esc_html__( 'Table not found. Please try again.', 'wp-timeline-designer-pro' );
						return;
					}
				}
			}
		}
	}

	/**
	 * Import layouts.
	 *
	 * @param string $file file.
	 * @return unserialized content
	 */
	public function import_layouts( $file ) {
		global $import_error;
		if ( isset( $_POST['wtl_import_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wtl_import_nonce'] ) ), 'wtl_import' ) ) {
			if ( file_exists( $file ) ) {
				$file_content = $this->wtl_file_contents( $file );
				if ( is_serialized( base64_decode( $file_content ) ) ) {
					$unserialized_content = maybe_unserialize( base64_decode( $file_content ) );
					if ( isset( $_POST['wtl_layout_import_types'] ) && $unserialized_content && 'wp_timeline_blog_layouts' == $_POST['wtl_layout_import_types'] && ! empty( $unserialized_content[0]['wtlid'] ) ) {
						return $unserialized_content;
					} elseif ( isset( $_POST['wtl_layout_import_types'] ) && $unserialized_content && 'wp_timeline_cpt' == $_POST['wtl_layout_import_types'] && ! empty( $unserialized_content[0]['id'] ) ) {
						return $unserialized_content;
					} else {
						$import_error = esc_html__( 'Please check your file format or import type.', 'wp-timeline-designer-pro' );
						return;
					}
				} else {
					$import_error = esc_html__( 'Import file is empty. Please try again.', 'wp-timeline-designer-pro' );
					return;
				}
			} else {
				$import_error = esc_html__( 'Import file could not be found. Please try again.', 'wp-timeline-designer-pro' );
				return;
			}
		}
	}

	/**
	 * File Contents.
	 *
	 * @param string $path path.
	 * @return string $wtl_content
	 */
	public function wtl_file_contents( $path ) {
		global $wp_filesystem;
		$wtl_content = '';
		if ( function_exists( 'realpath' ) ) {
			$filepath = realpath( $path );
		}
		if ( ! $filepath || ! is_file( $filepath ) ) {
			return '';
		}
		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();
		}
		return $wp_filesystem->get_contents( $filepath );
	}

	/**
	 * Set style path, home page path and plugin path for js use
	 */
	public function wtl_plugin_path_js() {
		?>
		<script type="text/javascript">
			"use strict";
			var plugin_path = '<?php echo esc_url( WTL_URL ); ?>';
			var style_path = '<?php echo esc_url( bloginfo( 'stylesheet_url' ) ); ?>';
			var home_path = '<?php echo esc_url( get_home_url() ); ?>';
		</script>
		<?php
	}

	/**
	 * Details Meta Box
	 *
	 * @return void
	 */
	public function wtl_details_meta_box() {
		add_meta_box( 'wtl_single_settings', esc_html__( 'Single Post Settings', 'wp-timeline-designer-pro' ), 'wtl_details_callback', 'post' );
		global $wpdb;
		$result = wp_cache_get( 'wtl_wtl_cpts' );
		if ( false == $result ) {
			wp_cache_set( 'wtl_wtl_cpts', $result );
		}
		$datas = $wpdb->get_results( "SELECT * FROM `{$wpdb->prefix}wtl_cpts`", ARRAY_A );
		if ( ! empty( $datas ) ) {
			foreach ( $datas as $data ) {
				$slug = $data['slug'];
				add_meta_box( 'wtl_single_settings', 'Single Post settings', 'wtl_details_callback', $slug );
			}
		}
	}

	/**
	 * Save Details.
	 *
	 * @param int $post_id post id.
	 * @return void
	 */
	public function wtl_details_save( $post_id ) {
		if ( ! isset( $_POST['wtl_single_details_meta_box_nonce'] ) ) {
			return;
		}
		if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wtl_single_details_meta_box_nonce'] ) ), 'wtl_details_save' ) ) {
			return;
		}
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		$personal_details = array(
			'wtl_thumbnail_type'                => isset( $_POST['wtl_thumbnail_type'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['wtl_thumbnail_type'] ) ) ) : '',
			'wtl_post_slideshow_images'         => isset( $_POST['wtl_gallery_images'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['wtl_gallery_images'] ) ) ) : '',
			'wtl_single_video_type'             => isset( $_POST['wtl_single_video_type'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['wtl_single_video_type'] ) ) ) : '',
			'wtl_single_video_id'               => isset( $_POST['wtl_single_video_id'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['wtl_single_video_id'] ) ) ) : '',
			'wtl_single_audio_type'             => isset( $_POST['wtl_single_audio_type'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['wtl_single_audio_type'] ) ) ) : '',
			'wtl_single_audio_id'               => isset( $_POST['wtl_single_audio_id'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['wtl_single_audio_id'] ) ) ) : '',
			'wtl_post_quote_text'               => isset( $_POST['wtl_post_quote_text'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['wtl_post_quote_text'] ) ) ) : '',
			'wtl_display_post_custom_link'      => isset( $_POST['wtl_display_post_custom_link'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['wtl_display_post_custom_link'] ) ) ) : '',
			'wtl_post_custom_link'              => isset( $_POST['wtl_post_custom_link'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['wtl_post_custom_link'] ) ) ) : '',
			'wtl_single_display_timeline_icon'  => isset( $_POST['wtl_single_display_timeline_icon'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['wtl_single_display_timeline_icon'] ) ) ) : '',
			'wtl_single_timeline_icon'          => isset( $_POST['wtl_single_timeline_icon'] ) ? esc_attr( $_POST['wtl_single_timeline_icon'] ) : '',
			'wtl_icon_image_src'                => isset( $_POST['wtl_icon_image_src'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['wtl_icon_image_src'] ) ) ) : '',
			'wtl_icon_image_id'                 => isset( $_POST['wtl_icon_image_id'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['wtl_icon_image_id'] ) ) ) : '',
			'wtl_single_step_timeline_title'    => isset( $_POST['wtl_single_step_timeline_title'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['wtl_single_step_timeline_title'] ) ) ) : '',
			'wtl_single_step_timeline_subtitle' => isset( $_POST['wtl_single_step_timeline_subtitle'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['wtl_single_step_timeline_subtitle'] ) ) ) : '',
			'wtl_background_color'              => isset( $_POST['wtl_background_color'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['wtl_background_color'] ) ) ) : '',
			'wtl_background_color_opt'          => isset( $_POST['wtl_background_color_opt'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['wtl_background_color_opt'] ) ) ) : '',
			'wtl_content_color'                 => isset( $_POST['wtl_content_color'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['wtl_content_color'] ) ) ) : '',
			'wtl_timeline_time'                 => isset( $_POST['wtl_timeline_time'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['wtl_timeline_time'] ) ) ) : '',
			'wtl_timeline_time_format'          => isset( $_POST['wtl_timeline_time_format'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['wtl_timeline_time_format'] ) ) ) : '',
			'wtl_arrow_background_color'        => isset( $_POST['wtl_arrow_background_color'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['wtl_arrow_background_color'] ) ) ) : '',
		);
		update_post_meta( $post_id, '_wtl_single_details_key', $personal_details );
	}
	/**
	 * Animation Loader Icons
	 *
	 * @return array
	 */
	public static function loaders() {
		$loaders = array(
			'circularG'               => '<div class="wtl-circularG-wrapper"><div class="wtl-circularG wtl-circularG_1"></div><div class="wtl-circularG wtl-circularG_2"></div><div class="wtl-circularG wtl-circularG_3"></div><div class="wtl-circularG wtl-circularG_4"></div><div class="wtl-circularG wtl-circularG_5"></div><div class="wtl-circularG wtl-circularG_6"></div><div class="wtl-circularG wtl-circularG_7"></div><div class="wtl-circularG wtl-circularG_8"></div></div>',
			'floatingCirclesG'        => '<div class="wtl-floatingCirclesG"><div class="wtl-f_circleG wtl-frotateG_01"></div><div class="wtl-f_circleG wtl-frotateG_02"></div><div class="wtl-f_circleG wtl-frotateG_03"></div><div class="wtl-f_circleG wtl-frotateG_04"></div><div class="wtl-f_circleG wtl-frotateG_05"></div><div class="wtl-f_circleG wtl-frotateG_06"></div><div class="wtl-frotateG_07 wtl-f_circleG"></div><div class="wtl-frotateG_08 wtl-f_circleG"></div></div>',
			'spinloader'              => '<div class="wtl-spinloader"></div>',
			'doublecircle'            => '<div class="wtl-doublec-container"><ul class="wtl-doublec-flex-container"><li><span class="wtl-doublec-loading"></span></li></ul></div>',
			'wBall'                   => '<div class="wtl-windows8"><div class="wtl-wBall wtl-wBall_1"><div class="wtl-wInnerBall"></div></div><div class="wtl-wBall wtl-wBall_2"><div class="wtl-wInnerBall"></div></div><div class="wtl-wBall wtl-wBall_3"><div class="wtl-wInnerBall"></div></div><div class="wtl-wBall wtl-wBall_4"><div class="wtl-wInnerBall"></div></div><div class="wtl-wBall_5 wtl-wBall"><div class="wtl-wInnerBall"></div></div></div>',
			'cssanim'                 => '<div class="wtl-cssload-aim"></div>',
			'thecube'                 => '<div class="wtl-cssload-thecube"><div class="wtl-cssload-cube wtl-cssload-c1"></div><div class="wtl-cssload-cube wtl-cssload-c2"></div><div class="wtl-cssload-cube wtl-cssload-c4"></div><div class="wtl-cssload-cube wtl-cssload-c3"></div></div>',
			'ballloader'              => '<div class="wtl-ballloader"><div class="wtl-loader-inner wtl-ball-grid-pulse"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>',
			'squareloader'            => '<div class="wtl-squareloader"><div class="wtl-square"></div><div class="wtl-square"></div><div class="wtl-square last"></div><div class="wtl-square clear"></div><div class="wtl-square"></div><div class="wtl-square last"></div><div class="wtl-square clear"></div><div class="wtl-square"></div><div class="wtl-square last"></div></div>',
			'loadFacebookG'           => '<div class="wtl-loadFacebookG"><div class="wtl-blockG_1 wtl-facebook_blockG"></div><div class="wtl-blockG_2 wtl-facebook_blockG"></div><div class="wtl-facebook_blockG wtl-blockG_3"></div></div>',
			'floatBarsG'              => '<div class="wtl-floatBarsG-wrapper"><div class="wtl-floatBarsG_1 wtl-floatBarsG"></div><div class="wtl-floatBarsG_2 wtl-floatBarsG"></div><div class="wtl-floatBarsG_3 wtl-floatBarsG"></div><div class="wtl-floatBarsG_4 wtl-floatBarsG"></div><div class="wtl-floatBarsG_5 wtl-floatBarsG"></div><div class="wtl-floatBarsG_6 wtl-floatBarsG"></div><div class="wtl-floatBarsG_7 wtl-floatBarsG"></div><div class="wtl-floatBarsG_8 wtl-floatBarsG"></div></div>',
			'movingBallG'             => '<div class="wtl-movingBallG-wrapper"><div class="wtl-movingBallLineG"></div><div class="wtl-movingBallG_1 wtl-movingBallG"></div></div>',
			'ballsWaveG'              => '<div class="wtl-ballsWaveG-wrapper"><div class="wtl-ballsWaveG_1 wtl-ballsWaveG"></div><div class="wtl-ballsWaveG_2 wtl-ballsWaveG"></div><div class="wtl-ballsWaveG_3 wtl-ballsWaveG"></div><div class="wtl-ballsWaveG_4 wtl-ballsWaveG"></div><div class="wtl-ballsWaveG_5 wtl-ballsWaveG"></div><div class="wtl-ballsWaveG_6 wtl-ballsWaveG"></div><div class="wtl-ballsWaveG_7 wtl-ballsWaveG"></div><div class="wtl-ballsWaveG_8 wtl-ballsWaveG"></div></div>',
			'fountainG'               => '<div class="fountainG-wrapper"><div class="wtl-fountainG_1 wtl-fountainG"></div><div class="wtl-fountainG_2 wtl-fountainG"></div><div class="wtl-fountainG_3 wtl-fountainG"></div><div class="wtl-fountainG_4 wtl-fountainG"></div><div class="wtl-fountainG_5 wtl-fountainG"></div><div class="wtl-fountainG_6 wtl-fountainG"></div><div class="wtl-fountainG_7 wtl-fountainG"></div><div class="wtl-fountainG_8 wtl-fountainG"></div></div>',
			'audio_wave'              => '<div class="wtl-audio_wave"><span></span><span></span><span></span><span></span><span></span></div>',
			'warningGradientBarLineG' => '<div class="wtl-warningGradientOuterBarG"><div class="wtl-warningGradientFrontBarG wtl-warningGradientAnimationG"><div class="wtl-warningGradientBarLineG"></div><div class="wtl-warningGradientBarLineG"></div><div class="wtl-warningGradientBarLineG"></div><div class="wtl-warningGradientBarLineG"></div><div class="wtl-warningGradientBarLineG"></div><div class="wtl-warningGradientBarLineG"></div></div></div>',
			'floatingBarsG'           => '<div class="wtl-floatingBarsG"><div class="wtl-rotateG_01 wtl-blockG"></div><div class="wtl-rotateG_02 wtl-blockG"></div><div class="wtl-rotateG_03 wtl-blockG"></div><div class="wtl-rotateG_04 wtl-blockG"></div><div class="wtl-rotateG_05 wtl-blockG"></div><div class="wtl-rotateG_06 wtl-blockG"></div><div class="wtl-rotateG_07 wtl-blockG"></div><div class="wtl-rotateG_08 wtl-blockG"></div></div>',
			'rotatecircle'            => '<div class="wtl-cssload-loader"><div class="wtl-cssload-inner wtl-cssload-one"></div><div class="wtl-cssload-inner wtl-cssload-two"></div><div class="wtl-cssload-inner wtl-cssload-three"></div></div>',
			'overlay-loader'          => '<div class="wtl-overlay-loader"><div class="wtl-loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>',
			'circlewave'              => '<div class="wtl-circlewave"></div>',
			'cssload-ball'            => '<div class="wtl-cssload-ball"></div>',
			'cssheart'                => '<div class="wtl-cssload-main"><div class="wtl-cssload-heart"><span class="wtl-cssload-heartL"></span><span class="wtl-cssload-heartR"></span><span class="wtl-cssload-square"></span></div><div class="wtl-cssload-shadow"></div></div>',
			'spinload'                => '<div class="wtl-spinload-loading"><i></i><i></i><i></i></div>',
			'bigball'                 => '<div class="wtl-bigball-container"><div class="wtl-bigball-loading"><i></i><i></i><i></i></div></div>',
			'bubblec'                 => '<div class="wtl-bubble-container"><div class="wtl-bubble-loading"><i></i><i></i></div></div>',
			'csball'                  => '<div class="wtl-csball-container"><div class="wtl-csball-loading"><i></i><i></i><i></i><i></i></div></div>',
			'ccball'                  => '<div class="wtl-ccball-container"><div class="wtl-ccball-loading"><i></i><i></i></div></div>',
			'circulardot'             => '<div class="wtl-cssload-wrap"><div class="wtl-circulardot-container"><span class="wtl-cssload-dots"></span><span class="wtl-cssload-dots"></span><span class="wtl-cssload-dots"></span><span class="wtl-cssload-dots"></span><span class="wtl-cssload-dots"></span><span class="wtl-cssload-dots"></span><span class="wtl-cssload-dots"></span><span class="wtl-cssload-dots"></span><span class="wtl-cssload-dots"></span><span class="wtl-cssload-dots"></span></div></div>',
		);
		return $loaders;
	}

	/**
	 * Create sample timeline layout
	 *
	 * @global type $wpdb
	 */
	public function wtl_create_sample_layout() {
		if ( isset( $_GET['sample-blog-layout'] ) && 'new' === $_GET['sample-blog-layout'] ) {
			global $wpdb;
			$count_layout = $wpdb->get_var( 'SELECT COUNT(`wtlid`) FROM ' . $wpdb->prefix . 'wtl_shortcodes' );
			$page_id      = '';
			$blog_page_id = wp_insert_post(
				array(
					'post_title'   => esc_html__( 'Sample Blog', 'wp-timeline-designer-pro' ),
					'post_type'    => 'page',
					'post_status'  => 'publish',
					'post_content' => '',
				)
			);
			if ( $blog_page_id ) {
				$page_id = $blog_page_id;
			} 
			/* Array for sample timeline layout create */
			$sample_blog_settings = array(
				'wtl_page_display'                         => $page_id,
				'pagination_type'                          => 'paged',
				'pagination_text_color'                    => '#ffffff',
				'pagination_background_color'              => '#777777',
				'pagination_text_hover_color'              => '',
				'pagination_background_hover_color'        => '',
				'pagination_text_active_color'             => '',
				'pagination_active_background_color'       => '',
				'pagination_border_color'                  => '#b2b2b2',
				'pagination_active_border_color'           => '#007acc',
				'display_category'                         => '0',
				'display_tag'                              => '0',
				'display_author'                           => '0',
				'display_author_data'                      => '0',
				'display_author_biography'                 => '0',
				'display_date'                             => '0',
				'display_story_year'                       => '1',
				'display_thumbnail'                        => '0',
				'display_comment_count'                    => '0',
				'display_comment'                          => '0',
				'display_navigation'                       => '0',
				'template_name'                            => 'cool_horizontal',
				'template_alternativebackground'           => '0',
				'rss_use_excerpt'                          => '1',
				'social_share'                             => '1',
				'social_style'                             => '1',
				'social_icon_style'                        => '1',
				'social_icon_size'                         => '1',
				'facebook_link'                            => '1',
				'twitter_link'                             => '1',
				'linkedin_link'                            => '1',
				'email_link'                               => '1',
				'whatsapp_link'                            => '1',
				'pinterest_link'                           => '1',
				'facebook_link_with_count'                 => '0',
				'pinterest_link_with_count'                => '0',
				'social_count_position'                    => 'bottom',
				'wp_timeline_post_offset'                  => '0',
				'template_bgcolor'                         => '#ffffff',
				'template_category_border_color'           => '#02a6af',
				'template_category_dots_bg_color'          => '#02a6af',
				'template_category_dots_line_color'        => '#02a6af',
				'template_category_dots_wave_color'        => '#90e6e3',
				'template_metacolor'                       => '#02a6af',
				'template_color'                           => '#000',
				'template_ftcolor'                         => '#2376ad',
				'template_fthovercolor'                    => '#2b2b2b',
				'template_title_alignment'                 => 'left',
				'template_titlecolor'                      => '#222222',
				'template_titlehovercolor'                 => '#666666',
				'template_titlebackcolor'                  => '',
				'template_titlefontsize'                   => '30',
				'template_titlefontface'                   => '',
				'template_contentfontface'                 => '',
				'related_post_by'                          => 'category',
				'wp_timeline_related_post_order_by'        => 'date',
				'wp_timeline_related_post_order'           => 'DESC',
				'txtExcerptlength'                         => '50',
				'content_fontsize'                         => '14',
				'firstletter_fontsize'                     => '20',
				'firstletter_contentcolor'                 => '#000000',
				'template_contentcolor'                    => '#7b95a6',
				'txtReadmoretext'                          => 'Read More',
				'readmore_font_family_font_type'           => '',
				'readmore_font_family'                     => '',
				'readmore_fontsize'                        => '14',
				'readmore_font_weight'                     => 'normal',
				'readmore_font_line_height'                => '1.5',
				'readmore_font_text_transform'             => 'none',
				'readmore_font_text_decoration'            => 'none',
				'readmore_font_letter_spacing'             => '0',
				'read_more_on'                             => '2',
				'template_readmorecolor'                   => '#2376ad',
				'template_readmorehovercolor'              => '#2376ad',
				'template_readmorebackcolor'               => '#dcdee0',
				'readmore_button_border_radius'            => '0',
				'readmore_button_alignment'                => 'left',
				'readmore_button_paddingleft'              => '10',
				'readmore_button_paddingright'             => '10',
				'readmore_button_paddingtop'               => '3',
				'readmore_button_paddingbottom'            => '3',
				'readmore_button_marginleft'               => '0',
				'readmore_button_marginright'              => '0',
				'readmore_button_margintop'                => '0',
				'readmore_button_marginbottom'             => '0',
				'read_more_button_border_style'            => 'solid',
				'read_more_button_hover_border_style'      => 'solid',
				'readmore_button_hover_border_radius'      => '0',
				'wp_timeline_readmore_button_hover_borderleft' => '0',
				'wp_timeline_readmore_button_hover_borderleftcolor' => '',
				'wp_timeline_readmore_button_hover_borderright' => '0',
				'wp_timeline_readmore_button_hover_borderrightcolor' => '',
				'wp_timeline_readmore_button_hover_bordertop' => '0',
				'wp_timeline_readmore_button_hover_bordertopcolor' => '',
				'wp_timeline_readmore_button_hover_borderbottom' => '0',
				'wp_timeline_readmore_button_hover_borderbottomcolor' => '',
				'wp_timeline_readmore_button_borderleft'   => '0',
				'wp_timeline_readmore_button_borderleftcolor' => '',
				'wp_timeline_readmore_button_borderright'  => '0',
				'wp_timeline_readmore_button_borderrightcolor' => '',
				'wp_timeline_readmore_button_bordertop'    => '0',
				'wp_timeline_readmore_button_bordertopcolor' => '',
				'wp_timeline_readmore_button_borderbottom' => '0',
				'wp_timeline_readmore_button_borderbottomcolor' => '',
				'template_columns'                         => '2',
				'template_grid_skin'                       => 'default',
				'template_grid_height'                     => '300',
				'wp_timeline_blog_order_by'                => '',
				'wp_timeline_blog_order'                   => 'DESC',
				'related_post_title'                       => esc_html__( 'Related Posts', 'wp-timeline-designer-pro' ),
				'date_color_of_readmore'                   => '0',
				'template_easing'                          => 'easeOutSine',
				'display_timeline_bar'                     => '0',
				'item_width'                               => '400',
				'item_height'                              => '570',
				'display_arrows'                           => '1',
				'enable_autoslide'                         => '0',
				'enable_nav_to_scroll'                     => '0',
				'scroll_speed'                             => '1000',
				'easy_timeline_effect'                     => 'flip-effect',
				'display_feature_image'                    => '0',
				'thumbnail_skin'                           => '0',
				'display_sale_tag'                         => '0',
				'wp_timeline_sale_tagtext_alignment'       => 'left-top',
				'wp_timeline_sale_tagtext_marginleft'      => '5',
				'wp_timeline_sale_tagtext_marginright'     => '5',
				'wp_timeline_sale_tagtext_margintop'       => '5',
				'wp_timeline_sale_tagtext_marginbottom'    => '5',
				'wp_timeline_sale_tagtext_paddingleft'     => '5',
				'wp_timeline_sale_tagtext_paddingright'    => '5',
				'wp_timeline_sale_tagtext_paddingtop'      => '5',
				'wp_timeline_sale_tagtext_paddingbottom'   => '5',
				'wp_timeline_sale_tagtextcolor'            => '#ffffff',
				'wp_timeline_sale_tagbgcolor'              => '#777777',
				'wp_timeline_sale_tag_angle'               => '0',
				'wp_timeline_sale_tag_border_radius'       => '0',
				'wp_timeline_sale_tagfontface'             => '',
				'wp_timeline_sale_tagfontsize'             => '18',
				'wp_timeline_sale_tag_font_weight'         => '700',
				'wp_timeline_sale_tag_font_line_height'    => '1.5',
				'wp_timeline_sale_tag_font_italic'         => '0',
				'wp_timeline_sale_tag_font_text_transform' => 'none',
				'wp_timeline_sale_tag_font_text_decoration' => 'none',
				'display_product_rating'                   => '0',
				'wp_timeline_star_rating_bg_color'         => '#000000',
				'wp_timeline_star_rating_color'            => '#d3ced2',
				'wp_timeline_star_rating_alignment'        => 'left',
				'wp_timeline_star_rating_paddingleft'      => '5',
				'wp_timeline_star_rating_paddingright'     => '5',
				'wp_timeline_star_rating_paddingtop'       => '5',
				'wp_timeline_star_rating_paddingbottom'    => '5',
				'wp_timeline_star_rating_marginleft'       => '5',
				'wp_timeline_star_rating_marginright'      => '5',
				'wp_timeline_star_rating_margintop'        => '5',
				'wp_timeline_star_rating_marginbottom'     => '5',
				'display_product_price'                    => '0',
				'wp_timeline_pricetext_alignment'          => 'left',
				'wp_timeline_pricetext_paddingleft'        => '5',
				'wp_timeline_pricetext_paddingright'       => '5',
				'wp_timeline_pricetext_paddingtop'         => '5',
				'wp_timeline_pricetext_paddingbottom'      => '5',
				'wp_timeline_pricetext_marginleft'         => '5',
				'wp_timeline_pricetext_marginright'        => '5',
				'wp_timeline_pricetext_margintop'          => '5',
				'wp_timeline_pricetext_marginbottom'       => '5',
				'wp_timeline_pricetextcolor'               => '#444444',
				'wp_timeline_pricefontface_font_type'      => '',
				'wp_timeline_pricefontface'                => '',
				'wp_timeline_pricefontsize'                => '18',
				'wp_timeline_price_font_weight'            => '700',
				'wp_timeline_price_font_line_height'       => '1.5',
				'wp_timeline_price_font_italic'            => '0',
				'wp_timeline_price_font_letter_spacing'    => '0',
				'wp_timeline_price_font_text_transform'    => 'none',
				'wp_timeline_price_font_text_decoration'   => 'none',
				'wp_timeline_addtocart_button_font_text_transform' => 'none',
				'wp_timeline_addtocart_button_font_text_decoration' => 'none',
				'wp_timeline_addtowishlist_button_font_text_transform' => 'none',
				'wp_timeline_addtowishlist_button_font_text_decoration' => 'none',
				'display_addtocart_button'                 => '0',
				'wp_timeline_addtocart_button_fontface_font_type' => '',
				'wp_timeline_addtocart_button_fontface'    => '',
				'wp_timeline_addtocart_button_fontsize'    => '14',
				'wp_timeline_addtocart_button_font_weight' => 'normal',
				'wp_timeline_addtocart_button_font_italic' => '0',
				'wp_timeline_addtocart_button_letter_spacing' => '0',
				'display_addtocart_button_line_height'     => '1.5',
				'wp_timeline_addtocart_textcolor'          => '#ffffff',
				'wp_timeline_addtocart_backgroundcolor'    => '#777777',
				'wp_timeline_addtocart_text_hover_color'   => '#ffffff',
				'wp_timeline_addtocart_hover_backgroundcolor' => '#333333',
				'wp_timeline_addtocartbutton_borderleft'   => '0',
				'wp_timeline_addtocartbutton_borderleftcolor' => '',
				'wp_timeline_addtocartbutton_borderright'  => '0',
				'wp_timeline_addtocartbutton_borderrightcolor' => '',
				'wp_timeline_addtocartbutton_bordertop'    => '0',
				'wp_timeline_addtocartbutton_bordertopcolor' => '',
				'wp_timeline_addtocartbutton_borderbottom' => '0',
				'wp_timeline_addtocartbutton_borderbottomcolor' => '',
				'wp_timeline_addtocartbutton_hover_borderleft' => '0',
				'wp_timeline_addtocartbutton_hover_borderleftcolor' => '',
				'wp_timeline_addtocartbutton_hover_borderright' => '0',
				'wp_timeline_addtocartbutton_hover_borderrightcolor' => '',
				'wp_timeline_addtocartbutton_hover_bordertop' => '0',
				'wp_timeline_addtocartbutton_hover_bordertopcolor' => '',
				'wp_timeline_addtocartbutton_hover_borderbottom' => '0',
				'wp_timeline_addtocartbutton_hover_borderbottomcolor' => '',
				'display_addtocart_button_border_hover_radius' => '0',
				'wp_timeline_addtocartbutton_hover_padding_leftright' => '0',
				'wp_timeline_addtocartbutton_hover_padding_topbottom' => '0',
				'wp_timeline_addtocartbutton_hover_margin_topbottom' => '0',
				'wp_timeline_addtocartbutton_hover_margin_leftright' => '0',
				'wp_timeline_addtocartbutton_padding_leftright' => '10',
				'wp_timeline_addtocartbutton_padding_topbottom' => '10',
				'wp_timeline_addtocartbutton_margin_leftright' => '15',
				'wp_timeline_addtocartbutton_margin_topbottom' => '10',
				'wp_timeline_addtocartbutton_alignment'    => 'left',
				'display_addtocart_button_border_radius'   => '0',
				'wp_timeline_addtocart_button_left_box_shadow' => '0',
				'wp_timeline_addtocart_button_right_box_shadow' => '0',
				'wp_timeline_addtocart_button_top_box_shadow' => '0',
				'wp_timeline_addtocart_button_bottom_box_shadow' => '0',
				'wp_timeline_addtocart_button_box_shadow_color' => '',
				'wp_timeline_addtocart_button_hover_left_box_shadow' => '0',
				'wp_timeline_addtocart_button_hover_right_box_shadow' => '0',
				'wp_timeline_addtocart_button_hover_top_box_shadow' => '0',
				'wp_timeline_addtocart_button_hover_bottom_box_shadow' => '0',
				'wp_timeline_addtocart_button_hover_box_shadow_color' => '',
				'display_addtowishlist_button'             => '0',
				'wp_timeline_wishlistbutton_alignment'     => 'left',
				'wp_timeline_cart_wishlistbutton_alignment' => 'left',
				'wp_timeline_wishlistbutton_on'            => '1',
				'wp_timeline_addtowishlist_button_fontface_font_type' => '',
				'wp_timeline_addtowishlist_button_fontface' => '',
				'wp_timeline_addtowishlist_button_fontsize' => '14',
				'wp_timeline_addtowishlist_button_font_weight' => 'normal',
				'wp_timeline_addtowishlist_button_font_italic' => '0',
				'wp_timeline_addtowishlist_button_letter_spacing' => '0',
				'display_wishlist_button_line_height'      => '1.5',
				'wp_timeline_wishlist_textcolor'           => '#ffffff',
				'wp_timeline_wishlist_text_hover_color'    => '#ffffff',
				'wp_timeline_wishlist_backgroundcolor'     => '#777777',
				'wp_timeline_wishlist_hover_backgroundcolor' => '#333333',
				'display_wishlist_button_border_radius'    => '0',
				'wp_timeline_wishlistbutton_borderleft'    => '0',
				'wp_timeline_wishlistbutton_borderleftcolor' => '',
				'wp_timeline_wishlistbutton_borderright'   => '0',
				'wp_timeline_wishlistbutton_borderrightcolor' => '',
				'wp_timeline_wishlistbutton_bordertop'     => '0',
				'wp_timeline_wishlistbutton_bordertopcolor' => '',
				'wp_timeline_wishlistbutton_borderbuttom'  => '0',
				'wp_timeline_wishlistbutton_borderbottomcolor' => '',
				'wp_timeline_wishlistbutton_hover_borderleft' => '0',
				'wp_timeline_wishlistbutton_hover_borderleftcolor' => '',
				'wp_timeline_wishlistbutton_hover_borderright' => '0',
				'wp_timeline_wishlistbutton_hover_borderrightcolor' => '',
				'wp_timeline_wishlistbutton_hover_bordertop' => '0',
				'wp_timeline_wishlistbutton_hover_bordertopcolor' => '',
				'wp_timeline_wishlistbutton_hover_borderbuttom' => '0',
				'wp_timeline_wishlistbutton_hover_borderbottomcolor' => '',
				'wp_timeline_wishlistbutton_padding_leftright' => '10',
				'wp_timeline_wishlistbutton_padding_topbottom' => '10',
				'wp_timeline_wishlistbutton_margin_leftright' => '10',
				'wp_timeline_wishlistbutton_margin_topbottom' => '10',
				'wp_timeline_wishlistbutton_hover_margin_topbottom' => '5',
				'wp_timeline_wishlistbutton_hover_margin_leftright' => '5',
				'display_acf_field'                        => '0',
				'wp_timeline_acf_field'                    => '',
				'display_download_price'                   => '0',
				'wp_timeline_edd_price_alignment'          => 'left',
				'wp_timeline_edd_price_paddingleft'        => '5',
				'wp_timeline_edd_price_paddingright'       => '5',
				'wp_timeline_edd_price_paddingtop'         => '5',
				'wp_timeline_edd_price_paddingbottom'      => '5',
				'wp_timeline_edd_price_color'              => '#444444',
				'wp_timeline_edd_pricefontface_font_type'  => '',
				'wp_timeline_edd_pricefontface'            => '',
				'wp_timeline_edd_pricefontsize'            => '18',
				'wp_timeline_edd_price_font_weight'        => '700',
				'wp_timeline_edd_price_font_line_height'   => '1.5',
				'wp_timeline_edd_price_font_italic'        => '0',
				'wp_timeline_edd_price_font_letter_spacing' => '0',
				'wp_timeline_edd_price_font_text_decoration' => 'none',
				'display_edd_addtocart_button'             => '0',
				'wp_timeline_edd_addtocart_button_fontface_font_type' => '',
				'wp_timeline_edd_addtocart_button_fontface' => '',
				'wp_timeline_edd_addtocart_button_fontsize' => '14',
				'wp_timeline_edd_addtocart_button_font_weight' => 'normal',
				'wp_timeline_edd_addtocart_button_font_italic' => '0',
				'wp_timeline_edd_addtocart_button_letter_spacing' => '0',
				'display_edd_addtocart_button_line_height' => '1.5',
				'wp_timeline_edd_addtocart_textcolor'      => '#ffffff',
				'wp_timeline_edd_addtocart_backgroundcolor' => '#777777',
				'wp_timeline_edd_addtocart_text_hover_color' => '#ffffff',
				'wp_timeline_edd_addtocart_hover_backgroundcolor' => '#333333',
				'wp_timeline_edd_addtocartbutton_borderleft' => '0',
				'wp_timeline_edd_addtocartbutton_borderleftcolor' => '',
				'wp_timeline_edd_addtocartbutton_borderright' => '0',
				'wp_timeline_edd_addtocartbutton_borderrightcolor' => '',
				'wp_timeline_edd_addtocartbutton_bordertop' => '0',
				'wp_timeline_edd_addtocartbutton_bordertopcolor' => '',
				'wp_timeline_edd_addtocartbutton_borderbottom' => '0',
				'wp_timeline_edd_addtocartbutton_borderbottomcolor' => '',
				'wp_timeline_edd_addtocartbutton_hover_borderleft' => '0',
				'wp_timeline_edd_addtocartbutton_hover_borderleftcolor' => '',
				'wp_timeline_edd_addtocartbutton_hover_borderright' => '0',
				'wp_timeline_edd_addtocartbutton_hover_borderrightcolor' => '',
				'wp_timeline_edd_addtocartbutton_hover_bordertop' => '0',
				'wp_timeline_edd_addtocartbutton_hover_bordertopcolor' => '',
				'wp_timeline_edd_addtocartbutton_hover_borderbottom' => '0',
				'wp_timeline_edd_addtocartbutton_hover_borderbottomcolor' => '',
				'display_edd_addtocart_button_border_hover_radius' => '0',
				'wp_timeline_edd_addtocartbutton_hover_padding_leftright' => '0',
				'wp_timeline_edd_addtocartbutton_hover_padding_topbottom' => '0',
				'wp_timeline_edd_addtocartbutton_hover_margin_topbottom' => '0',
				'wp_timeline_edd_addtocartbutton_hover_margin_leftright' => '0',
				'wp_timeline_edd_addtocartbutton_padding_leftright' => '10',
				'wp_timeline_edd_addtocartbutton_padding_topbottom' => '10',
				'wp_timeline_edd_addtocartbutton_margin_leftright' => '15',
				'wp_timeline_edd_addtocartbutton_margin_topbottom' => '10',
				'wp_timeline_edd_addtocartbutton_alignment' => 'left',
				'display_edd_addtocart_button_border_radius' => '0',
				'wp_timeline_edd_addtocart_button_left_box_shadow' => '0',
				'wp_timeline_edd_addtocart_button_right_box_shadow' => '0',
				'wp_timeline_edd_addtocart_button_top_box_shadow' => '0',
				'wp_timeline_edd_addtocart_button_bottom_box_shadow' => '0',
				'wp_timeline_edd_addtocart_button_box_shadow_color' => '',
				'wp_timeline_edd_addtocart_button_hover_left_box_shadow' => '0',
				'wp_timeline_edd_addtocart_button_hover_right_box_shadow' => '0',
				'wp_timeline_edd_addtocart_button_hover_top_box_shadow' => '0',
				'wp_timeline_edd_addtocart_button_hover_bottom_box_shadow' => '0',
				'wp_timeline_edd_addtocart_button_hover_box_shadow_color' => '',
			);
			$table_name           = $wpdb->prefix . 'wtl_shortcodes';
			if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) == $table_name ) {
				$insert_shortcode = $wpdb->insert(
					$table_name,
					array(
						'shortcode_name' => esc_html__( 'Sample Timeline Layout', 'wp-timeline-designer-pro' ),
						'wtlsettngs'     => maybe_serialize( $sample_blog_settings ),
					)
				);
				if ( false == $insert_shortcode ) {
					wp_die( esc_html__( 'Sample Timeline Layout not created.', 'wp-timeline-designer-pro' ) );
				} else {
					$layout_id       = $wpdb->insert_id;
					$blog_args       = array(
						'ID'           => $page_id,
						'post_content' => '[wp_timeline_design id="' . $layout_id . '"]',
					);
					$layout_inserted = wp_update_post( $blog_args );
					self::wtl_admin_notice_pro_layouts_dismiss();
					if ( $layout_inserted ) {
						$blog_url = get_permalink( $page_id );
						$edit_url = admin_url() . 'admin.php?page=add_wtl_shortcode&action=edit&id=' . $layout_id;
						echo wp_kses( "<script type=\"text/javascript\">window.open('$blog_url', '_blank'); </script>", Wp_Timeline_Public::args_kses() );
					}
				}
			} else {
				wp_die( esc_html__( 'Table not found. Please try again.', 'wp-timeline-designer-pro' ) );
			}
		}
	}

	/**
	 * Admin notice layouts notice dismiss
	 *
	 * @since 1.6
	 */
	public static function wtl_admin_notice_pro_layouts_dismiss() {
		update_option( 'wtl_admin_notice_pro_layouts_dismiss', true );
	}
}
