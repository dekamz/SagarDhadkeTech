<?php
/**
 * Add/Edit Timeline Layout setting page.
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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $wp_version, $wpdb, $wp_timeline_errors, $wtl_success, $wtl_settings;
$allowed_html   = array(
	'a' => array(
		'href'   => array(),
		'title'  => array(),
		'target' => array(),
	),
);
$uic_l          = 'ui-corner-left';
$uic_r          = 'ui-corner-right';
$shortcode_name = '';
if ( isset( $_GET['action'] ) && 'edit' === $_GET['action'] ) {
	$shortcode_id = '';
	if ( isset( $_GET['id'] ) && ! empty( $_GET['id'] ) ) {
		$shortcode_id = intval( $_GET['id'] );
	}
	$table_name       = $wpdb->prefix . 'wtl_shortcodes';
	$get_all_settings = $wpdb->get_results( "SELECT * FROM $table_name WHERE wtlid = $shortcode_id", ARRAY_A );
	if ( ! isset( $get_all_settings[0]['wtlsettngs'] ) ) {
		echo '<div class="updated notice notice 1">';
		wp_die( esc_html__( 'You attempted to edit an item that doesn’t exist. Perhaps it was deleted?', 'wp-timeline-designer-pro' ) );
		echo '</div>';
	}
	$all_settings   = $get_all_settings[0]['wtlsettngs'];
	$shortcode_name = $get_all_settings[0]['shortcode_name'];
	if ( is_serialized( $all_settings ) ) {
		$wtl_settings = maybe_unserialize( $all_settings );
	}
	$msg = '&msg=updated';
} else {
	$msg = '&msg=added';
}
if ( isset( $_GET['create'] ) && 'sample' === $_GET['create'] ) {
	$wtl_success  = esc_html__( 'We have created a sample timeline layout with "classical" blog template.', 'wp-timeline-designer-pro' );
	$wtl_success .= ' <a href="' . get_the_permalink( $wtl_settings['wtl_page_display'] ) . '" target="_blank">' . esc_html__( 'View blog page', 'wp-timeline-designer-pro' ) . '</a>';
}
$tempate_list = Wp_Timeline_Ajax::wtl_blog_template_list();
$loaders      = Wp_Timeline_Admin::loaders();
?>
<div class="wrap">
	<h1>
		<?php
		if ( ! ( isset( $_GET['action'] ) && 'edit' === $_GET['action'] && isset( $_GET['id'] ) ) ) {
			echo '<div class="wp-timeline-shortcode-div">';
			esc_html_e( 'Add New Layout', 'wp-timeline-designer-pro' );
			echo '</div>';
		}
		?>
	</h1>
	<?php if ( isset( $_GET['message'] ) && 'shortcode_added_msg' === $_GET['message'] ) { ?>
		<div class="updated notice notice2">
			<p>
				<?php
				echo esc_html__( 'Layout has been added successfully.', 'wp-timeline-designer-pro' );
				if ( isset( $wtl_settings['wtl_page_display'] ) && $wtl_settings['wtl_page_display'] > 0 ) {
					?>
					<a href="<?php echo esc_url( get_the_permalink( $wtl_settings['wtl_page_display'] ) ); ?>" target="_blank"><?php echo esc_html__( 'View Layout', 'wp-timeline-designer-pro' ); ?></a>
					<?php
				}
				?>
			</p>
		</div>
		<?php
	}
	if ( isset( $_GET['message'] ) && 'shortcode_duplicate_msg' === $_GET['message'] ) {
		?>
		<div class="updated notice notice3"><p><?php esc_html_e( 'Layout has been duplicated successfully.', 'wp-timeline-designer-pro' ); ?></p></div>
		<?php
	}
	if ( isset( $wp_timeline_errors ) ) {
		if ( is_wp_error( $wp_timeline_errors ) ) {
			?>
			<div class="error notice"><p><?php echo wp_kses( $wp_timeline_errors->get_error_message(), $allowed_html ); ?></p></div>
			<?php
		}
	}
	if ( isset( $wtl_success ) ) {
		?>
		<div class="updated notice notice4"><p><?php echo wp_kses( $wtl_success, $allowed_html ); ?></p></div>
		<?php
	}
	if ( 'cool_horizontal' === $wtl_settings['template_name'] || 'overlay_horizontal' === $wtl_settings['template_name'] ) {
		$wtl_settings['pagination_type'] = 'no_pagination';
	}
	$winter_category_txt = esc_html__( 'Choose Category Background Color', 'wp-timeline-designer-pro' );
	?>
	<div class="splash-screen"></div>
	<form method="post" id="edit_layout_form" action="" class="wp-timeline-form-class wp-timeline-edit-layout">
		<?php
		wp_nonce_field( 'wtl-shortcode-form-submit', 'wtl-submit-nonce' );
		$wpt_page = '';
		if ( isset( $_GET['page'] ) && '' != $_GET['page'] ) {
			$wpt_page = sanitize_text_field( wp_unslash( $_GET['page'] ) );
			?>
			<input type="hidden" name="originalpage" class="wp_timeline_originalpage" value="<?php echo esc_attr( $wpt_page ); ?>">
			<?php
		}
		?>
		<div id="poststuff">
			<?php
			if ( isset( $_GET['action'] ) && 'edit' === $_GET['action'] && isset( $_GET['id'] ) ) {
				$shortcode_id = intval( $_GET['id'] );
				?>
				<div class="wp-timeline-shortcode-div" lid="<?php echo esc_attr( $shortcode_id ); ?>">
					<div class= "pull-left wp_timeline_edit_layout"><h1><?php esc_html_e( 'Edit Layout', 'wp-timeline-designer-pro' ); ?></h1></div>
					<div class="pull-right">
						<?php
						if ( isset( $wtl_settings['wtl_page_display'] ) && ! empty( $wtl_settings['wtl_page_display'] ) ) {
							?>
							<span class="view-layout"><a title="<?php esc_attr_e( 'View this item', 'wp-timeline-designer-pro' ); ?>" href="<?php echo esc_url( get_the_permalink( $wtl_settings['wtl_page_display'] ) ); ?>" target="_blank"><?php esc_html_e( 'View Layout', 'wp-timeline-designer-pro' ); ?></a></span>
							<?php
						}
						?>
						<input type="text" readonly="" onclick="this.select()" class="copy_shortcode" title="<?php esc_attr_e( 'Copy Shortcode', 'wp-timeline-designer-pro' ); ?>" value='[wp_timeline_design id="<?php echo esc_attr( $shortcode_id ); ?>"]' />
						<a class="page-title-action wp_timeline_create_new_layout" href="?page=add_wtl_shortcode"><?php esc_html_e( 'Create New Layout', 'wp-timeline-designer-pro' ); ?></a>
					</div>
				</div>
			<?php } ?>
			<div class="postbox-container wp-timeline-settings-wrappers bd_poststuff">
				<div class="wp-timeline-preview-box" id="wp-timeline-preview-box"></div>
				<div class="wp-timeline-header-wrapper">
					<div class="wp-timeline-logo-wrapper pull-left"><h3 title="<?php esc_html_e( 'wp-timeline settings', 'wp-timeline-designer-pro' ); ?>">&nbsp;</h3></div>
					<div class="pull-right">
						<a id="wp-timeline-btn-show-preview" title="<?php esc_html_e( 'Preview', 'wp-timeline-designer-pro' ); ?>" class="show_preview button preview_fixed button-primary">
							<span><i class="fas fa-eye"></i>&nbsp;&nbsp;<?php esc_html_e( 'Preview', 'wp-timeline-designer-pro' ); ?></span>
						</a>
						<a id="wp-timeline-btn-show-submit" title="<?php esc_html_e( 'Save Changes', 'wp-timeline-designer-pro' ); ?>" class="show_preview button submit_fixed button-primary">
							<span><i class="fas fa-check"></i>&nbsp;&nbsp;<?php esc_html_e( 'Save Changes', 'wp-timeline-designer-pro' ); ?></span>
						</a>
						<input type="submit" style="display:none;" class="button-primary bloglyout_savebtn button" name="savedata" value="<?php esc_attr_e( 'Save Changes', 'wp-timeline-designer-pro' ); ?>" />
					</div>
				</div>
				<div class="wp-timeline-menu-setting">
					<?php
					$wp_timeline_general_class               = '';
					$wp_timeline_class                       = '';
					$wp_timeline_standard_class              = '';
					$wp_timeline_title_class                 = '';
					$wtl_content_class                       = '';
					$wtl_content_box_class                   = '';
					$wtl_timeline_settings_class             = '';
					$wp_timeline_media_class                 = '';
					$wp_timeline_slider_class                = '';
					$wp_timeline_filter_class                = '';
					$wp_timeline_social_class                = '';
					$wp_timeline_productsetting_class        = '';
					$wp_timeline_pagination_class            = '';
					$wp_timeline_acffieldssetting_class      = '';
					$wp_timeline_eddsetting_class            = '';
					$wp_timeline_general_class_show          = '';
					$wp_timeline_class_show                  = '';
					$wp_timeline_standard_class_show         = '';
					$wp_timeline_title_class_show            = '';
					$wtl_content_class_show                  = '';
					$wtl_content_box_class_show              = '';
					$wp_timeline_settings_class_show         = '';
					$wp_timeline_media_class_show            = '';
					$wp_timeline_slider_class_show           = '';
					$wp_timeline_filter_class_show           = '';
					$wp_timeline_social_class_show           = '';
					$wp_timeline_productsetting_class_show   = '';
					$wp_timeline_pagination_class_show       = '';
					$wp_timeline_acffieldssetting_class_show = '';
					$wp_timeline_eddsetting_class_show       = '';
					if ( Wp_Timeline_Main::wtl_postbox_classes( 'wp_timeline_general', $wpt_page ) ) {
						$wp_timeline_general_class      = 'wp-timeline-active-tab';
						$wp_timeline_general_class_show = 'display: block;';
					} elseif ( Wp_Timeline_Main::wtl_postbox_classes( 'wp_timeline_standard', $wpt_page ) ) {
						$wp_timeline_standard_class      = 'wp-timeline-active-tab';
						$wp_timeline_standard_class_show = 'display: block;';
					} elseif ( Wp_Timeline_Main::wtl_postbox_classes( 'wp_timeline_title', $wpt_page ) ) {
						$wp_timeline_title_class      = 'wp-timeline-active-tab';
						$wp_timeline_title_class_show = 'display: block;';
					} elseif ( Wp_Timeline_Main::wtl_postbox_classes( 'wp_timeline_content', $wpt_page ) ) {
						$wtl_content_class      = 'wp-timeline-active-tab';
						$wtl_content_class_show = 'display: block;';
					} elseif ( Wp_Timeline_Main::wtl_postbox_classes( 'wp_timeline_content_box', $wpt_page ) ) {
						$wtl_content_box_class      = 'wp_timeline_content_box wp-timeline-active-tab';
						$wtl_content_box_class_show = 'display: block;';
					} elseif ( Wp_Timeline_Main::wtl_postbox_classes( 'wp_timeline_settings', $wpt_page ) ) {
						$wtl_timeline_settings_class     = 'wp_timeline_settings wp-timeline-active-tab';
						$wp_timeline_settings_class_show = 'display: block;';
					} elseif ( Wp_Timeline_Main::wtl_postbox_classes( 'wp_timeline_media', $wpt_page ) ) {
						$wp_timeline_media_class      = 'wp-timeline-active-tab';
						$wp_timeline_media_class_show = 'display: block;';
					} elseif ( Wp_Timeline_Main::wtl_postbox_classes( 'wp_timeline', $wpt_page ) ) {
						$wp_timeline_class      = 'wp_timeline_horizontal wp-timeline-active-tab';
						$wp_timeline_class_show = 'display: block;';
					} elseif ( Wp_Timeline_Main::wtl_postbox_classes( 'wp_timeline_filter', $wpt_page ) ) {
						$wp_timeline_filter_class      = 'wp-timeline-active-tab';
						$wp_timeline_filter_class_show = 'display: block;';
					} elseif ( Wp_Timeline_Main::wtl_postbox_classes( 'wp_timeline_pagination', $wpt_page ) ) {
						$wp_timeline_pagination_class      = 'wp_timeline_pagination wp-timeline-active-tab';
						$wp_timeline_pagination_class_show = 'display: block;';
					} elseif ( Wp_Timeline_Main::wtl_postbox_classes( 'wp_timeline_productsetting', $wpt_page ) ) {
						$wp_timeline_productsetting_class      = 'wp-timeline-active-tab';
						$wp_timeline_productsetting_class_show = 'display: block;';
					} elseif ( Wp_Timeline_Main::wtl_postbox_classes( 'wp_timeline_acffield', $wpt_page ) ) {
						$wp_timeline_acffieldssetting_class      = 'wp-timeline-active-tab';
						$wp_timeline_acffieldssetting_class_show = 'display: block;';
					} elseif ( Wp_Timeline_Main::wtl_postbox_classes( 'wp_timeline_eddsetting', $wpt_page ) ) {
						$wp_timeline_eddsetting_class      = 'wp-timeline-active-tab';
						$wp_timeline_eddsetting_class_show = 'display: block;';
					} elseif ( Wp_Timeline_Main::wtl_postbox_classes( 'wp_timeline_social', $wpt_page ) ) {
						$wp_timeline_social_class      = 'wp-timeline-active-tab';
						$wp_timeline_social_class_show = 'display: block;';
					} else {
						$wp_timeline_general_class      = 'wp-timeline-active-tab';
						$wp_timeline_general_class_show = 'display: block;';
					}
					?>
					<ul class="wp-timeline-setting-handle">
						<li data-show="wp_timeline_general" class='<?php echo esc_attr( $wp_timeline_general_class ); ?>'><i class="fas fa-cog"></i><span><?php esc_html_e( 'General Settings', 'wp-timeline-designer-pro' ); ?></span></li>
						<li data-show="wp_timeline_standard" class='<?php echo esc_attr( $wp_timeline_standard_class ); ?>'><i class="fas fa-gavel"></i><span><?php esc_html_e( 'Standard Settings', 'wp-timeline-designer-pro' ); ?></span></li>
						<li data-show="wp_timeline_settings" class='<?php echo esc_attr( $wtl_timeline_settings_class ); ?>'><i class="fa fa-align-center"></i><span><?php esc_html_e( 'Timeline Settings', 'wp-timeline-designer-pro' ); ?></span></li>
						<li data-show="wp_timeline_title" class='<?php echo esc_html( $wp_timeline_title_class ); ?>'><i class="fas fa-text-width"></i><span><?php esc_html_e( 'Post Title Settings', 'wp-timeline-designer-pro' ); ?></span></li> 
						<li data-show="wp_timeline_content" class='<?php echo esc_html( $wtl_content_class ); ?>'><i class="far fa-file-alt"></i><span><?php esc_html_e( 'Post Content Settings', 'wp-timeline-designer-pro' ); ?></span></li>
						<li data-show="wp_timeline_content_box" class='<?php echo esc_html( $wtl_content_box_class ); ?>'><i class="far fa-square"></i><span><?php esc_html_e( 'Content Box Settings', 'wp-timeline-designer-pro' ); ?></span></li>
						<li data-show="wp_timeline_media" class='<?php echo esc_html( $wp_timeline_media_class ); ?>'><i class="far fa-image"></i><span><?php esc_html_e( 'Media Settings', 'wp-timeline-designer-pro' ); ?></span></li>
						<li data-show="wp_timeline" class='<?php echo esc_html( $wp_timeline_class ); ?>'><i class="far fa-clock"></i><span><?php esc_html_e( 'Horizontal Timeline Settings', 'wp-timeline-designer-pro' ); ?></span></li>
						<li data-show="wp_timeline_filter" class='<?php echo esc_html( $wp_timeline_filter_class ); ?>'><i class="fas fa-filter"></i><span><?php esc_html_e( 'Filter Settings', 'wp-timeline-designer-pro' ); ?></span></li>
						<li data-show="wp_timeline_pagination" class='<?php echo esc_html( $wp_timeline_pagination_class ); ?>'><i class="fas fa-angle-double-right"></i><span><?php esc_html_e( 'Pagination Settings', 'wp-timeline-designer-pro' ); ?></span></li>
						<?php
						if ( Wp_Timeline_Main::wtl_woocommerce_plugin() ) {
							?>
							<li data-show="wp_timeline_productsetting" class='<?php echo esc_attr( $wp_timeline_productsetting_class ); ?>'><i class="fas fa-shopping-cart"></i><span><?php esc_html_e( 'Product Settings', 'wp-timeline-designer-pro' ); ?></span></li>
							<?php
						}
						if ( is_plugin_active( 'advanced-custom-fields/acf.php' ) ) {
							$wp_post_id = get_posts(
								array(
									'fields'         => 'ids',
									'posts_per_page' => -1,
								)
							);
							$groups     = acf_get_field_groups();
							if ( ! empty( $groups ) ) {
								?>
								<li data-show="wp_timeline_acffieldssetting" class='<?php echo esc_attr( $wp_timeline_acffieldssetting_class ); ?>'><i class="fas fa-plus-square"></i><span><?php esc_html_e( 'ACF Field Settings', 'wp-timeline-designer-pro' ); ?></span></li>
								<?php
							}
						}
						if ( is_plugin_active( 'easy-digital-downloads/easy-digital-downloads.php' ) ) {
							?>
							<li data-show="wp_timeline_eddsetting" class='<?php echo esc_attr( $wp_timeline_eddsetting_class ); ?>'>
								<i class="fas fa-download"></i><span><?php esc_html_e( 'Easy Digital Downloads Settings', 'wp-timeline-designer-pro' ); ?></span>
							</li>
						<?php } ?>
						<li data-show="wp_timeline_social" class='<?php echo esc_attr( $wp_timeline_social_class ); ?>'>
							<i class="fas fa-share-alt"></i><span><?php esc_html_e( 'Social Share Settings', 'wp-timeline-designer-pro' ); ?></span>
						</li>
						<?php do_action( 'wtl_layout_settings', 'tab' ); ?>
					</ul>
				</div>
				<div id="wp_timeline_general" class="postbox postbox-with-fw-options" style='<?php echo esc_attr( $wp_timeline_general_class_show ); ?>'>
					<div class="inside">
						<ul class="wp-timeline-settings wp-timeline-lineheight">
							<li>
								<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Select Timeline Layout', 'wp-timeline-designer-pro' ); ?></h3>
								<div class="wp-timeline-left">
									<p class="wp-timeline-margin-bottom-50"><?php esc_html_e( 'Select your favorite layout from 36 powerful blog timeline layouts', 'wp-timeline-designer-pro' ); ?>. </p>
									<p class="wp-timeline-margin-bottom-30"><b><?php esc_html_e( 'Current Template', 'wp-timeline-designer-pro' ); ?>:</b> &nbsp;&nbsp;
										<span class="wp-timeline-template-name">
										<?php
										if ( isset( $wtl_settings['template_name'] ) ) {
											echo esc_html( $tempate_list[ $wtl_settings['template_name'] ]['template_name'] );
										} else {
											esc_html_e( 'Advanced Template', 'wp-timeline-designer-pro' );
										}
										?>
										</span>
									</p>
									<?php
									if ( isset( $_GET['page'] ) && 'add_wtl_shortcode' === $_GET['page'] && ! isset( $_GET['action'] ) ) {
										$wpt_line_create_scode = 'wp-timelinecreate-shortcode';
									} else {
										$wpt_line_create_scode = '';
									}
									if ( isset( $wtl_settings['template_name'] ) ) {
										$wtl_template_name_2 = $wtl_settings['template_name'];
									} else {
										$wtl_template_name_2 = '';
									}
									?>
									<div class="wp_timeline_select_template_button_div">
										<input type="button" class="wp_timeline_select_template" value="<?php esc_attr_e( 'Select Other Template', 'wp-timeline-designer-pro' ); ?>">
										<input type="hidden" class="wp_timeline_template_name <?php echo esc_attr( $wpt_line_create_scode ); ?>" value="<?php echo esc_attr( $wtl_template_name_2 ); ?>" name="template_name">
									</div>
									<?php
									if ( isset( $_GET['action'] ) && 'edit' === $_GET['action'] && isset( $_GET['id'] ) ) {
										?>
										<input type="submit" class="wp-timeline-reset-data" name="resetdata" value="<?php esc_attr_e( 'Reset Layout Settings', 'wp-timeline-designer-pro' ); ?>" onclick="return confirm('Do you want to reset this layout?');" />
										<?php
									}
									?>
								</div>
								<div class="wp-timeline-right">
									<div class="select_button_upper_div">
										<div class="wp_timeline_selected_template_image">
											<?php
											if ( isset( $wtl_settings['template_name'] ) && empty( $wtl_settings['template_name'] ) ) {
												$template_name_class = 'wp_timeline_no_template_found';
											} else {
												$template_name_class = '';
											}
											?>
											<div class="<?php echo esc_attr( $template_name_class ); ?>">
												<?php
												if ( isset( $wtl_settings['template_name'] ) && ! empty( $wtl_settings['template_name'] ) ) {
													$image_name = WTL_URL . '/admin/images/layouts/' . $wtl_settings['template_name'] . '.jpg';
													if ( isset( $wtl_settings['template_name'] ) ) {
														$image_alt = $tempate_list[ $wtl_settings['template_name'] ]['template_name'];
													} else {
														$image_alt = '';
													}
													if ( isset( $wtl_settings['template_name'] ) ) {
														$image_title = $tempate_list[ $wtl_settings['template_name'] ]['template_name'];
													} else {
														$image_title = '';
													}
													?>
													<img src="<?php echo esc_url( $image_name ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php echo esc_attr( $image_title ); ?>">
													<label id="template_select_name">
													<?php
													if ( isset( $wtl_settings['template_name'] ) ) {
														echo esc_html( $tempate_list[ $wtl_settings['template_name'] ]['template_name'] );
													}
													?>
													</label>
														<?php
												} else {
													esc_html_e( 'No template exist for selection', 'wp-timeline-designer-pro' );
												}
												?>
											</div>
										</div>
									</div>
								</div>
							</li>
							<li>
								<?php wtl_setting_left( esc_html__( 'Layout Name', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enter timeline layout name', 'wp-timeline-designer-pro' ); ?></span></span>
									<input type="text" name="unique_shortcode_name" id="unique_shortcode_name" value="<?php echo esc_attr( $shortcode_name ); ?>" placeholder="<?php esc_attr_e( 'Enter layout name', 'wp-timeline-designer-pro' ); ?>">
								</div>
							</li>
							<li class="wtl_heading_1">
								<?php wtl_setting_left( esc_html__( 'Timeline 1st Heading', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enter timeline name which appear top of timeline', 'wp-timeline-designer-pro' ); ?></span></span>
									<input type="text" name="timeline_heading_1" id="timeline_heading_1" value="<?php echo isset( $wtl_settings['timeline_heading_1'] ) ? esc_attr( $wtl_settings['timeline_heading_1'] ) : ''; ?>" placeholder="">
								</div>
							</li>
							<li class="wtl_heading_2">
								<?php wtl_setting_left( esc_html__( 'Timeline 2nd Heading', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enter timeline name which appear top of timeline', 'wp-timeline-designer-pro' ); ?></span></span>
									<input type="text" name="timeline_heading_2" id="timeline_heading_2" value="<?php echo isset( $wtl_settings['timeline_heading_2'] ) ? esc_attr( $wtl_settings['timeline_heading_2'] ) : ''; ?>" placeholder="">
								</div>
							</li>
							<li>
								<?php wtl_setting_left( esc_html__( 'Select Post type', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select post type for timeline layout', 'wp-timeline-designer-pro' ); ?></span></span>
									<select name="custom_post_type" id="custom_post_type" >
										<?php
										if ( ! isset( $wtl_settings['custom_post_type'] ) || empty( $wtl_settings['custom_post_type'] ) ) {
											$wtl_settings['custom_post_type'] = 'post';
										}
										$args       = array(
											'public'   => true,
											'_builtin' => false,
										);
										$post_types = get_post_types( $args, 'objects' );
										?>
										<option value="post" 
										<?php
										if ( 'post' === $wtl_settings['custom_post_type'] ) {
											echo 'selected=selected';
										}
										?>
										>
										<?php esc_html_e( 'Post', 'wp-timeline-designer-pro' ); ?>
										</option>
										<?php
										if ( $post_types ) {
											foreach ( $post_types as $post_type_list ) {
												if ( 'product' != $post_type_list ) {
													?>
													<option value="<?php echo esc_attr( $post_type_list->name ); ?>" 
														<?php
														if ( $wtl_settings['custom_post_type'] == $post_type_list->name ) {
															echo 'selected=selected';
														}
														?>
													>
													<?php echo esc_attr( $post_type_list->label ); ?>
													</option>
													<?php
												}
											}
										}
										?>
									</select>
								</div>
							</li>

							<li class="wp-timeline-caution">
								<div class="wp-timeline-setting-description">
										<b class="note"><?php esc_html_e( 'Caution', 'wp-timeline-designer-pro' ); ?>:</b> &nbsp;
										<?php
										esc_html_e( 'You are about to select the page for your layout. This will overwrite all the content on the page that you will select. Changes once lost cannot be recovered. Please be cautious.', 'wp-timeline-designer-pro' );
										?>
								</div>
								<?php wtl_setting_left( esc_html__( 'Select Page for Blog', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select page for display timeline layout', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php
									if ( ! isset( $wtl_settings['wtl_page_display'] ) ) {
										$wtl_settings['wtl_page_display'] = '';
									}
									echo wp_dropdown_pages(
										array(
											'name'     => 'wtl_page_display',
											'echo'     => 0,
											'show_option_none' => '--  ' . esc_html__( 'Select Page', 'wp-timeline-designer-pro' ) . '  --',
											'option_none_value' => '0',
											'selected' => $wtl_settings['wtl_page_display'],
											'depth'    => -1,
										)
									);
									?>
								</div>
							</li>

							<li class="wp_timeline_posts_per_page">
								<?php wtl_setting_left( esc_html__( 'Number of Posts to Display', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select number of posts to display on page', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php
									if ( ! isset( $wtl_settings['posts_per_page'] ) ) {
										$wtl_settings['posts_per_page'] = get_option( 'posts_per_page' );
									}
									?>
									<div class="input-type-number">
										<input name="posts_per_page" type="number" step="1" min="1" id="posts_per_page" value="<?php echo esc_attr( $wtl_settings['posts_per_page'] ); ?>" class=""  />
										<div class="input-type-number-nav">
											<div class="input-type-number-button input-type-number-up">+</div>
											<div class="input-type-number-button input-type-number-down">-</div>
										</div>
									</div>
								</div>
							</li>

							<li class="wp-timeline-display-settings">
								<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Display Settings', 'wp-timeline-designer-pro' ); ?></h3>

								<div class="wp-timeline-typography-wrapper wp-timeline-button-settings">
									<?php
									$custom_posttype = $wtl_settings['custom_post_type'];
									if ( 'post' !== $custom_posttype ) {
										$taxonomy_names = get_object_taxonomies( $custom_posttype, 'objects' );
										$taxonomy_names = apply_filters( 'wtl_hide_taxonomies', $taxonomy_names );
										if ( ! empty( $taxonomy_names ) ) {
											foreach ( $taxonomy_names as $taxonomy_name ) {
												if ( ! empty( $taxonomy_name ) ) {
													?>
													<div class="wp-timeline-typography-cover display-custom-taxonomy">
														<div class="wp-timeline-typography-label">
															<span class="wp-timeline-key-title"><?php echo esc_html( $taxonomy_name->label ); ?></span>
															<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable', 'wp-timeline-designer-pro' ) . ' ' . $taxonomy_name->label . ' ' . esc_html__( 'in timeline layout', 'wp-timeline-designer-pro' ); ?></span></span>
														</div>
														<div class="wp-timeline-typography-content">
															<?php
															$txname             = 'display_' . $taxonomy_name->name;
															$display_custom_tax = isset( $wtl_settings[ $txname ] ) ? $wtl_settings[ $txname ] : 0;
															?>
															<fieldset class="wp-timeline-social-options wp-timeline-display_tax buttonset ui-buttonset">
																<input id="<?php echo esc_attr( $txname ) . '_1'; ?>" name="<?php echo esc_attr( $txname ); ?>" type="radio" value="1" <?php echo checked( 1, $display_custom_tax ); ?>/>
																<label for="<?php echo esc_attr( $txname ) . '_1'; ?>" class="<?php echo esc_html( $uic_l ); ?>"><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
																<input id="<?php echo esc_attr( $txname ) . '_0'; ?>" name="<?php echo esc_attr( $txname ); ?>" type="radio" value="0" <?php echo checked( 0, $display_custom_tax ); ?> />
																<label for="<?php echo esc_attr( $txname ) . '_0'; ?>" class="<?php echo esc_html( $uic_r ); ?>"><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
															</fieldset>
															</label><label class="disable_link">
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
									} else {
										?>
										<div class="wp-timeline-typography-cover display-custom-taxonomy">
											<div class="wp-timeline-typography-label">
												<span class="wp-timeline-key-title"><?php esc_html_e( 'Post Category', 'wp-timeline-designer-pro' ); ?></span>
												<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Show post category on timeline layout', 'wp-timeline-designer-pro' ); ?></span></span>
											</div>
											<div class="wp-timeline-typography-content">
												<?php $display_category = isset( $wtl_settings['display_category'] ) ? $wtl_settings['display_category'] : 0; ?>
												<fieldset class="wp-timeline-social-options wp-timeline-display_author buttonset ui-buttonset">
													<input id="display_category_1" name="display_category" type="radio" value="1" <?php echo checked( 1, $display_category ); ?> />
													<label for="display_category_1" class="<?php echo esc_html( $uic_l ); ?>"><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
													<input id="display_category_0" name="display_category" type="radio" value="0" <?php echo checked( 0, $display_category ); ?> />
													<label for="display_category_0" class="<?php echo esc_html( $uic_r ); ?>"><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
												</fieldset>
												<label class="disable_link">
													<input id="disable_link_category" name="disable_link_category" type="checkbox" value="1" 
													<?php
													if ( isset( $wtl_settings['disable_link_category'] ) ) {
														checked( 1, $wtl_settings['disable_link_category'] );
													}
													?>
													/>
													<?php esc_html_e( 'Disable Link', 'wp-timeline-designer-pro' ); ?>
												</label>
											</div>
										</div>
										<div class="wp-timeline-typography-cover display-custom-taxonomy">
											<div class="wp-timeline-typography-label">
												<span class="wp-timeline-key-title"><?php esc_html_e( 'Post Tag', 'wp-timeline-designer-pro' ); ?></span>
												<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Show post tag on timeline layout', 'wp-timeline-designer-pro' ); ?></span></span>
											</div>
											<div class="wp-timeline-typography-content">
												<?php $display_tag = isset( $wtl_settings['display_tag'] ) ? $wtl_settings['display_tag'] : 1; ?>
												<fieldset class="wp-timeline-social-options wp-timeline-display_author buttonset ui-buttonset">
													<input id="display_tag_1" name="display_tag" type="radio" value="1" <?php checked( 1, $display_tag ); ?> />
													<label for="display_tag_1" class="<?php echo esc_html( $uic_l ); ?>"><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
													<input id="display_tag_0" name="display_tag" type="radio" value="0" <?php checked( 0, $display_tag ); ?> />
													<label for="display_tag_0" class="<?php echo esc_html( $uic_r ); ?>"><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
												</fieldset>
												<label class="disable_link">
													<input id="disable_link_tag" name="disable_link_tag" type="checkbox" value="1" 
													<?php
													if ( isset( $wtl_settings['disable_link_tag'] ) ) {
														checked( 1, $wtl_settings['disable_link_tag'] );
													}
													?>
													/>
													<?php esc_html_e( 'Disable Link', 'wp-timeline-designer-pro' ); ?>
												</label>
											</div>
										</div>
										<?php
									}
									?>
									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Post Author', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Show post author on timeline layout', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<fieldset class="wp-timeline-social-options wp-timeline-display_author buttonset ui-buttonset">
												<input id="display_author_1" name="display_author" type="radio" value="1"  <?php isset( $wtl_settings['display_author'] ) ? checked( 1, $wtl_settings['display_author'] ) : ''; ?> />
												<label for="display_author_1" class="<?php echo esc_html( $uic_l ); ?>"><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
												<input id="display_author_0" name="display_author" type="radio" value="0" <?php isset( $wtl_settings['display_author'] ) ? checked( 0, $wtl_settings['display_author'] ) : ''; ?> />
												<label for="display_author_0" class="<?php echo esc_html( $uic_r ); ?>"><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
											</fieldset>
											<label class="disable_link">
												<input id="disable_link_author" name="disable_link_author" type="checkbox" value="1" 
												<?php
												if ( isset( $wtl_settings['disable_link_author'] ) ) {
													checked( 1, $wtl_settings['disable_link_author'] );
												}
												?>
												/>
												<?php esc_html_e( 'Disable Link', 'wp-timeline-designer-pro' ); ?>
											</label>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Post Publish Date', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Show post publish date on timeline layout', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<fieldset class="wp-timeline-social-options wp-timeline-display_date buttonset buttonset-hide ui-buttonset" data-hide="1">
												<input id="display_date_1" name="display_date" type="radio" value="1" <?php checked( 1, $wtl_settings['display_date'] ); ?> />
												<label for="display_date_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $wtl_settings['display_date'] ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
												<input id="display_date_0" name="display_date" type="radio" value="0" <?php checked( 0, $wtl_settings['display_date'] ); ?> />
												<label for="display_date_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $wtl_settings['display_date'] ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
											</fieldset>
											<label class="disable_link">
												<input id="disable_link_date" name="disable_link_date" type="checkbox" value="1" 
												<?php
												if ( isset( $wtl_settings['disable_link_date'] ) ) {
													checked( 1, $wtl_settings['disable_link_date'] );
												}
												?>
												/> <?php esc_html_e( 'Disable Link', 'wp-timeline-designer-pro' ); ?>
											</label>
										</div>
									</div>

									<div class="wp-timeline-typography-cover display_comment">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title">
												<?php esc_html_e( 'Post Comment Count', 'wp-timeline-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Show post comment on timeline layout', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php $display_comment_count = isset( $wtl_settings['display_comment_count'] ) ? $wtl_settings['display_comment_count'] : '1'; ?>
											<fieldset class="wp-timeline-social-options wp-timeline-display_comment_count buttonset buttonset-hide ui-buttonset" data-hide="1">
												<input id="display_comment_count_1" name="display_comment_count" type="radio" value="1" <?php checked( 1, $display_comment_count ); ?> />
												<label for="display_comment_count_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $display_comment_count ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
												<input id="display_comment_count_0" name="display_comment_count" type="radio" value="0" <?php checked( 0, $display_comment_count ); ?> />
												<label for="display_comment_count_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $display_comment_count ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
											</fieldset>
											<label class="disable_link">
												<input id="disable_link_comment" name="disable_link_comment" type="checkbox" value="1" 
												<?php
												if ( isset( $wtl_settings['disable_link_comment'] ) ) {
													checked( 1, $wtl_settings['disable_link_comment'] );
												}
												?>
												/>
												<?php esc_html_e( 'Disable Link', 'wp-timeline-designer-pro' ); ?>
											</label>
										</div>
									</div>


									<div class="wp-timeline-typography-cover display-postlike">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Post Like', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Show post like on timeline layout', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php $display_postlike = isset( $wtl_settings['display_postlike'] ) ? $wtl_settings['display_postlike'] : '0'; ?>
											<fieldset class="buttonset ui-buttonset">
												<input id="display_postlike_1" name="display_postlike" type="radio" value="1" <?php echo checked( 1, $display_postlike ); ?> />
												<label for="display_postlike_1" class="<?php echo esc_html( $uic_l ); ?>"><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
												<input id="display_postlike_0" name="display_postlike" type="radio" value="0" <?php echo checked( 0, $display_postlike ); ?> />
												<label for="display_postlike_0" class="<?php echo esc_html( $uic_r ); ?>"><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>


								</div>
							</li>
							<li>
								<?php wtl_setting_left( esc_html__( 'Custom CSS', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-textarea"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Write a "Custom CSS" to add your additional design for blog page', 'wp-timeline-designer-pro' ); ?></span></span>
									<textarea class="widefat textarea" name="custom_css" id="custom_css" placeholder=".class_name{ color:#ffffff }">
									<?php
									if ( isset( $wtl_settings['custom_css'] ) ) {
										echo esc_textarea( wp_unslash( $wtl_settings['custom_css'] ) );}
									?>
									</textarea>
									<div class="wp-timeline-setting-description wp-timeline-note">
										<b class=""><?php esc_html_e( 'Example', 'wp-timeline-designer-pro' ); ?>:</b>
										<?php echo '.class_name{ color:#ffffff }'; ?>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<?php /* ---------- [Standard Settings] ----------*/ ?>
				<div id="wp_timeline_standard" class="postbox postbox-with-fw-options" style="<?php echo esc_attr( $wp_timeline_standard_class_show ); ?>">
					<div class="inside">
						<ul class="wp-timeline-settings wp-timeline-lineheight">
							<li class="blog-template-tr wp-timeline-back-color-blog">
								<?php wtl_setting_left( esc_html__( 'Template Background Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select template background color', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_bgcolor = ( isset( $wtl_settings['template_bgcolor'] ) && ! empty( $wtl_settings['template_bgcolor'] ) ) ? $wtl_settings['template_bgcolor'] : ''; ?>
									<input type="text" name="template_bgcolor" id="template_bgcolor" value="<?php echo esc_attr( $template_bgcolor ); ?>"/>
								</div>
							</li>
							<li class="category-bg-color-tr wp-timeline-b-l">
								<?php wtl_setting_left( esc_html__( ' Category Border Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select category Border color', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_category_border_color = isset( $wtl_settings['template_category_border_color'] ) ? $wtl_settings['template_category_border_color'] : ''; ?>
									<input type="text" name="template_category_border_color" id="template_category_border_color" value="<?php echo esc_attr( $template_category_border_color ); ?>" data-default-color="<?php echo esc_attr( $template_category_border_color ); ?>"/>
								</div>
							</li>
							<li class="category-bg-color-tr wp-timeline-b-l">
								<?php wtl_setting_left( esc_html__( ' Dots Background Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select Dots Background Color', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_category_dots_bg_color = isset( $wtl_settings['template_category_dots_bg_color'] ) ? $wtl_settings['template_category_dots_bg_color'] : ''; ?>
									<input type="text" name="template_category_dots_bg_color" id="template_category_dots_bg_color" value="<?php echo esc_attr( $template_category_dots_bg_color ); ?>" data-default-color="<?php echo esc_attr( $template_category_dots_bg_color ); ?>"/>
								</div>
							</li>
							<li class="category-bg-color-tr wp-timeline-b-l">
								<?php wtl_setting_left( esc_html__( ' Dots Line Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select Dots Line Color', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_category_dots_line_color = isset( $wtl_settings['template_category_dots_line_color'] ) ? $wtl_settings['template_category_dots_line_color'] : ''; ?>
									<input type="text" name="template_category_dots_line_color" id="template_category_dots_line_color" value="<?php echo esc_attr( $template_category_dots_line_color ); ?>" data-default-color="<?php echo esc_attr( $template_category_dots_line_color ); ?>"/>
								</div>
							</li>
							<li class="category-bg-color-tr wp-timeline-b-l">
								<?php wtl_setting_left( esc_html__( ' Dots Wave Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select Dots Wave Color', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_category_dots_wave_color = isset( $wtl_settings['template_category_dots_wave_color'] ) ? $wtl_settings['template_category_dots_wave_color'] : ''; ?>
									<input type="text" name="template_category_dots_wave_color" id="template_category_dots_wave_color" value="<?php echo esc_attr( $template_category_dots_wave_color ); ?>" data-default-color="<?php echo esc_attr( $template_category_dots_wave_color ); ?>"/>
								</div>
							</li>
							<li class="wtl-back-color-soft-block">
								<?php wtl_setting_left( esc_html__( 'Repetative Blog Background Color 1', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select repetative blog background color 1', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_bgcolor1 = ( isset( $wtl_settings['template_bgcolor1'] ) && ! empty( $wtl_settings['template_bgcolor1'] ) ) ? $wtl_settings['template_bgcolor1'] : '#4fbfc1'; ?>
									<input type="text" name="template_bgcolor1" id="template_bgcolor1" value="<?php echo esc_attr( $template_bgcolor1 ); ?>"/>
								</div>
							</li>
							<li class="wtl-back-color-soft-block">
								<?php wtl_setting_left( esc_html__( 'Repetative Blog Background Color 2', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select repetative blog background color 2', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_bgcolor2 = ( isset( $wtl_settings['template_bgcolor2'] ) && ! empty( $wtl_settings['template_bgcolor2'] ) ) ? $wtl_settings['template_bgcolor2'] : '#508FC4'; ?>
									<input type="text" name="template_bgcolor2" id="template_bgcolor2" value="<?php echo esc_attr( $template_bgcolor2 ); ?>"/>
								</div>
							</li>
							<li class="wtl-back-color-soft-block">
								<?php wtl_setting_left( esc_html__( 'Repetative Blog Background Color 3', 'wp-timeline-designer-pro' ) ); ?>                                
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select repetative blog background color 3', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_bgcolor3 = ( isset( $wtl_settings['template_bgcolor3'] ) && ! empty( $wtl_settings['template_bgcolor3'] ) ) ? $wtl_settings['template_bgcolor3'] : '#F47882'; ?>
									<input type="text" name="template_bgcolor3" id="template_bgcolor3" value="<?php echo esc_attr( $template_bgcolor3 ); ?>"/>
								</div>
							</li>
							<li class="wtl-back-color-soft-block">                                
								<?php wtl_setting_left( esc_html__( 'Repetative Blog Background Color 4', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select repetative blog background color 4', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_bgcolor4 = ( isset( $wtl_settings['template_bgcolor4'] ) && ! empty( $wtl_settings['template_bgcolor4'] ) ) ? $wtl_settings['template_bgcolor4'] : '#F0CF80'; ?>
									<input type="text" name="template_bgcolor4" id="template_bgcolor4" value="<?php echo esc_attr( $template_bgcolor4 ); ?>"/>
								</div>
							</li>
							<li class="wtl-back-color-soft-block wtl-soft-block-num wtl-soft-block5">
								<?php wtl_setting_left( esc_html__( 'Repetative Blog Background Color 5', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select repetative blog background color 5', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_bgcolor5 = ( isset( $wtl_settings['template_bgcolor5'] ) && ! empty( $wtl_settings['template_bgcolor5'] ) ) ? $wtl_settings['template_bgcolor5'] : '#75C77D'; ?>
									<input type="text" name="template_bgcolor5" id="template_bgcolor5" value="<?php echo esc_attr( $template_bgcolor5 ); ?>"/>
								</div>
							</li>
							<li class="wtl-back-color-soft-block wtl-soft-block-num wtl-soft-block6">                                
								<?php wtl_setting_left( esc_html__( 'Repetative Blog Background Color 6', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select repetative blog background color 6', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_bgcolor6 = ( isset( $wtl_settings['template_bgcolor6'] ) && ! empty( $wtl_settings['template_bgcolor6'] ) ) ? $wtl_settings['template_bgcolor6'] : '#76ABD5'; ?>
									<input type="text" name="template_bgcolor6" id="template_bgcolor6" value="<?php echo esc_attr( $template_bgcolor6 ); ?>"/>
								</div>
							</li>
							<li>
								<?php wtl_setting_left( esc_html__( 'Link Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select link color', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_ftcolor = isset( $wtl_settings['template_ftcolor'] ) ? $wtl_settings['template_ftcolor'] : ''; ?>
									<input type="text" name="template_ftcolor" id="template_ftcolor" value="<?php echo esc_attr( $template_ftcolor ); ?>" data-default-color="<?php echo esc_attr( $template_ftcolor ); ?>"/>
								</div>
							</li>
							<li class="wtl-meta-color-business">
								<?php wtl_setting_left( esc_html__( 'Meta Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select Meta Color', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_metacolor = isset( $wtl_settings['template_metacolor'] ) ? $wtl_settings['template_metacolor'] : ''; ?>
									<input type="text" name="template_metacolor" id="template_metacolor" value="<?php echo esc_attr( $template_metacolor ); ?>" data-default-color="<?php echo esc_attr( $template_metacolor ); ?>"/>
								</div>
							</li>
							<li class="wtl-arrow-back-color-infographic">
								<?php wtl_setting_left( esc_html__( 'Default Arrow Background Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select Arrow Background color', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_arrow_back_color = isset( $wtl_settings['template_arrow_back_color'] ) ? $wtl_settings['template_arrow_back_color'] : ''; ?>
									<input type="text" name="template_arrow_back_color" id="template_arrow_back_color" value="<?php echo esc_attr( $template_arrow_back_color ); ?>" data-default-color="<?php echo esc_attr( $template_arrow_back_color ); ?>"/>
								</div>
							</li>
							<li class="wtl-icon-color-milestonetimeline">
								<?php wtl_setting_left( esc_html__( 'Icon or Shape Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select Icon or Shape color', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_icon_color = isset( $wtl_settings['template_icon_color'] ) ? $wtl_settings['template_icon_color'] : ''; ?>
									<input type="text" name="template_icon_color" id="template_icon_color" value="<?php echo esc_attr( $template_icon_color ); ?>" data-default-color="<?php echo esc_attr( $template_icon_color ); ?>"/>
								</div>
							</li>
							<li class="link-hover-color-tr">
								<?php wtl_setting_left( esc_html__( 'Link Hover Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select link hover color', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $fthover = isset( $wtl_settings['template_fthovercolor'] ) ? $wtl_settings['template_fthovercolor'] : ''; ?>
									<input type="text" name="template_fthovercolor" id="template_fthovercolor" value="<?php echo esc_attr( $fthover ); ?>" data-default-color="<?php echo esc_attr( $fthover ); ?>"/>
								</div>
							</li>
							<li class="category-text-color-tr">
								<?php wtl_setting_left( esc_html__( 'Category Text Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select category text color', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_categorytextcolor = isset( $wtl_settings['template_categorytextcolor'] ) ? $wtl_settings['template_categorytextcolor'] : ''; ?>
									<input type="text" name="template_categorytextcolor" id="template_categorytextcolor" value="<?php echo esc_attr( $template_categorytextcolor ); ?>" data-default-color="<?php echo esc_attr( $template_categorytextcolor ); ?>"/>
								</div>
							</li>
							<li class="category-bg-color-tr">
								<?php wtl_setting_left( esc_html__( 'Category Background Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select category background color', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_categorybgcolor = isset( $wtl_settings['template_categorybgcolor'] ) ? $wtl_settings['template_categorybgcolor'] : ''; ?>
									<input type="text" name="template_categorybgcolor" id="template_categorybgcolor" value="<?php echo esc_attr( $template_categorybgcolor ); ?>" data-default-color="<?php echo esc_attr( $template_categorybgcolor ); ?>"/>
								</div>
							</li>

							<li class="icon-content-bg-color-tr">
								<?php wtl_setting_left( esc_html__( 'Icon or Content Background Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select icon or content background color', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $icon_content_bg_color = isset( $wtl_settings['icon_content_bg_color'] ) ? $wtl_settings['icon_content_bg_color'] : ''; ?>
									<input type="text" name="icon_content_bg_color" id="icon_content_bg_color" value="<?php echo esc_attr( $icon_content_bg_color ); ?>" data-default-color="<?php echo esc_attr( $icon_content_bg_color ); ?>"/>
								</div>
							</li>

							<li class="wp-timeline-post-offset">
								<?php wtl_setting_left( esc_html__( 'Number of Post offset', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
								<?php $wp_timeline_post_offset = ( isset( $wtl_settings['wp_timeline_post_offset'] ) && ! empty( $wtl_settings['wp_timeline_post_offset'] ) ) ? $wtl_settings['wp_timeline_post_offset'] : '0'; ?>
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select number of post offset to display on blog page', 'wp-timeline-designer-pro' ); ?></span></span>
									<div class="input-type-number">
									<input type="number" id="wp_timeline_post_offset" name="wp_timeline_post_offset" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_post_offset ); ?>" placeholder="<?php esc_attr_e( 'Enter post offset', 'wp-timeline-designer-pro' ); ?>" >
										<div class="input-type-number-nav">
											<div class="input-type-number-button input-type-number-up">+</div>
											<div class="input-type-number-button input-type-number-down">-</div>
										</div>
									</div>
								</div>
							</li>

							<?php /* Post Meta Typography. */ ?>
							<li>
								<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Post Meta Typography Settings', 'wp-timeline-designer-pro' ); ?></h3>
								<div class="wp-timeline-typography-wrapper wp-timeline-typography-wrapper1">
									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Font Family', 'wp-timeline-designer-pro' ); ?></span><span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select post meta font family', 'wp-timeline-designer-pro' ); ?></span></span></div>
										<div class="wp-timeline-typography-content">
											<?php
											if ( isset( $wtl_settings['meta_font_family'] ) && '' != $wtl_settings['meta_font_family'] ) {
												$meta_font_family = $wtl_settings['meta_font_family'];
											} else {
												$meta_font_family = '';
											}
											?>
											<div class="typo-field">
												<input type="hidden" id="meta_font_family_font_type" name="meta_font_family_font_type" value="<?php echo isset( $wtl_settings['meta_font_family_font_type'] ) ? esc_attr( $wtl_settings['meta_font_family_font_type'] ) : ''; ?>">
												<div class="select-cover">
													<select name="meta_font_family" id="meta_font_family">
														<option value=""><?php esc_html_e( 'Select Font Family', 'wp-timeline-designer-pro' ); ?></option>
														<?php
														$old_version2 = '';
														$cnt2         = 0;
														$font_family2 = Wp_Timeline_Main::wtl_default_recognized_font_faces();
														foreach ( $font_family2 as $key2 => $value2 ) {
															if ( $value2['version'] != $old_version2 ) {
																if ( $cnt2 > 0 ) {
																	echo '</optgroup>';
																}
																echo '<optgroup label="' . esc_attr( $value2['version'] ) . '">';
																$old_version2 = $value2['version'];
															}
															echo "<option value='" . esc_attr( str_replace( '"', '', $value2['label'] ) ) . "'";

															if ( '' != $meta_font_family && ( str_replace( '"', '', $meta_font_family ) == str_replace( '"', '', $value2['label'] ) ) ) {
																echo ' selected';
															}
															echo '>' . esc_html( $value2['label'] ) . '</option>';
															$cnt2++;
														}
														if ( count( $font_family2 ) == $cnt2 ) {
															echo '</optgroup>';
														}
														?>
													</select>
												</div>
											</div>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"> <?php esc_html_e( 'Font Size (px)', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select font size for post meta', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php $meta_fontsize = isset( $wtl_settings['meta_fontsize'] ) ? $wtl_settings['meta_fontsize'] : '18'; ?>
											<div class="grid_col_space range_slider_fontsize" id="content_fontsize_slider" data-value="<?php echo esc_attr( $meta_fontsize ); ?>"></div>
											<div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="meta_fontsize" id="meta_fontsize" value="<?php echo esc_attr( $meta_fontsize ); ?>"  /></div>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title">
											<?php esc_html_e( 'Font Weight', 'wp-timeline-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select font weight', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
										<?php $meta_font_weight = isset( $wtl_settings['meta_font_weight'] ) ? $wtl_settings['meta_font_weight'] : 'normal'; ?>
											<div class="select-cover">
												<select name="meta_font_weight" id="meta_font_weight">
													<option value="100" <?php selected( $meta_font_weight, 100 ); ?>>100</option>
													<option value="200" <?php selected( $meta_font_weight, 200 ); ?>>200</option>
													<option value="300" <?php selected( $meta_font_weight, 300 ); ?>>300</option>
													<option value="400" <?php selected( $meta_font_weight, 400 ); ?>>400</option>
													<option value="500" <?php selected( $meta_font_weight, 500 ); ?>>500</option>
													<option value="600" <?php selected( $meta_font_weight, 600 ); ?>>600</option>
													<option value="700" <?php selected( $meta_font_weight, 700 ); ?>>700</option>
													<option value="800" <?php selected( $meta_font_weight, 800 ); ?>>800</option>
													<option value="900" <?php selected( $meta_font_weight, 900 ); ?>>900</option>
													<option value="bold" <?php selected( $meta_font_weight, 'bold' ); ?> ><?php esc_html_e( 'Bold', 'wp-timeline-designer-pro' ); ?></option>
													<option value="normal" <?php selected( $meta_font_weight, 'normal' ); ?>><?php esc_html_e( 'Normal', 'wp-timeline-designer-pro' ); ?></option>
												</select>
											</div>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Line Height', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enter line height', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<div class="input-type-number">
												<input type="number" name="meta_font_line_height" id="meta_font_line_height" step="0.1" min="0" value="<?php echo isset( $wtl_settings['meta_font_line_height'] ) ? esc_attr( $wtl_settings['meta_font_line_height'] ) : '1.5'; ?>" >
												<div class="input-type-number-nav">
													<div class="input-type-number-button input-type-number-up">+</div>
													<div class="input-type-number-button input-type-number-down">-</div>
												</div>
											</div>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title">
											<?php esc_html_e( 'Italic Font Style', 'wp-timeline-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Display italic font style', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php $meta_font_italic = isset( $wtl_settings['meta_font_italic'] ) ? $wtl_settings['meta_font_italic'] : '0'; ?>
											<fieldset class="wp-timeline-social-options wp-timeline-display_author buttonset ui-buttonset">
												<input id="meta_font_italic_1" name="meta_font_italic" type="radio" value="1"  <?php checked( 1, $meta_font_italic ); ?> />
												<label for="meta_font_italic_1" class="<?php echo esc_html( $uic_l ); ?>"><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
												<input id="meta_font_italic_0" name="meta_font_italic" type="radio" value="0" <?php checked( 0, $meta_font_italic ); ?> />
												<label for="meta_font_italic_0" class="<?php echo esc_html( $uic_r ); ?>"><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Text Transform', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select text transform style', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
										<?php $meta_font_text_transform = isset( $wtl_settings['meta_font_text_transform'] ) ? $wtl_settings['meta_font_text_transform'] : 'none'; ?>
											<div class="select-cover">
												<select name="meta_font_text_transform" id="meta_font_text_transform">
													<option <?php selected( $meta_font_text_transform, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'wp-timeline-designer-pro' ); ?></option>
													<option <?php selected( $meta_font_text_transform, 'capitalize' ); ?> value="capitalize"><?php esc_html_e( 'Capitalize', 'wp-timeline-designer-pro' ); ?></option>
													<option <?php selected( $meta_font_text_transform, 'uppercase' ); ?> value="uppercase"><?php esc_html_e( 'Uppercase', 'wp-timeline-designer-pro' ); ?></option>
													<option <?php selected( $meta_font_text_transform, 'lowercase' ); ?> value="lowercase"><?php esc_html_e( 'Lowercase', 'wp-timeline-designer-pro' ); ?></option>
													<option <?php selected( $meta_font_text_transform, 'full-width' ); ?> value="full-width"><?php esc_html_e( 'Full Width', 'wp-timeline-designer-pro' ); ?></option>
												</select>
											</div>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Text Decoration', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select text decoration style', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php $meta_font_text_decoration = isset( $wtl_settings['meta_font_text_decoration'] ) ? $wtl_settings['meta_font_text_decoration'] : 'none'; ?>
											<div class="select-cover">
												<select name="meta_font_text_decoration" id="meta_font_text_decoration">
													<option <?php selected( $meta_font_text_decoration, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'wp-timeline-designer-pro' ); ?></option>
													<option <?php selected( $meta_font_text_decoration, 'underline' ); ?> value="underline"><?php esc_html_e( 'Underline', 'wp-timeline-designer-pro' ); ?></option>
													<option <?php selected( $meta_font_text_decoration, 'overline' ); ?> value="overline"><?php esc_html_e( 'Overline', 'wp-timeline-designer-pro' ); ?></option>
													<option <?php selected( $meta_font_text_decoration, 'line-through' ); ?> value="line-through"><?php esc_html_e( 'Line Through', 'wp-timeline-designer-pro' ); ?></option>
												</select>
											</div>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Letter Spacing (px)', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enter letter spacing', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<div class="input-type-number">
												<input type="number" name="meta_font_letter_spacing" id="meta_font_letter_spacing" step="1" min="0" value="<?php echo isset( $wtl_settings['meta_font_letter_spacing'] ) ? esc_attr( $wtl_settings['meta_font_letter_spacing'] ) : '0'; ?>" >
												<div class="input-type-number-nav">
													<div class="input-type-number-button input-type-number-up">+</div>
													<div class="input-type-number-button input-type-number-down">-</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>

							<?php /* Post Date Typography. */ ?>
							<li class="wtl_post_date_option">
								<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Date Typography Settings', 'wp-timeline-designer-pro' ); ?></h3>
								<div class="wp-timeline-typography-wrapper wp-timeline-typography-wrapper1">
									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Font Family', 'wp-timeline-designer-pro' ); ?></span><span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select post date font family', 'wp-timeline-designer-pro' ); ?></span></span></div>
										<div class="wp-timeline-typography-content">
											<?php
											if ( isset( $wtl_settings['date_font_family'] ) && '' != $wtl_settings['date_font_family'] ) {
												$date_font_family = $wtl_settings['date_font_family'];
											} else {
												$date_font_family = '';
											}
											?>
											<div class="typo-field">
												<input type="hidden" id="date_font_family_font_type" name="date_font_family_font_type" value="<?php echo isset( $wtl_settings['date_font_family_font_type'] ) ? esc_attr( $wtl_settings['date_font_family_font_type'] ) : ''; ?>">
												<div class="select-cover">
													<select name="date_font_family" id="date_font_family">
														<option value=""><?php esc_html_e( 'Select Font Family', 'wp-timeline-designer-pro' ); ?></option>
														<?php
														$old_version2 = '';
														$cnt2         = 0;
														$font_family2 = Wp_Timeline_Main::wtl_default_recognized_font_faces();
														foreach ( $font_family2 as $key2 => $value2 ) {
															if ( $value2['version'] != $old_version2 ) {
																if ( $cnt2 > 0 ) {
																	echo '</optgroup>';
																}
																echo '<optgroup label="' . esc_attr( $value2['version'] ) . '">';
																$old_version2 = $value2['version'];
															}
															echo "<option value='" . esc_attr( str_replace( '"', '', $value2['label'] ) ) . "'";

															if ( '' != $date_font_family && ( str_replace( '"', '', $date_font_family ) == str_replace( '"', '', $value2['label'] ) ) ) {
																echo ' selected';
															}
															echo '>' . esc_html( $value2['label'] ) . '</option>';
															$cnt2++;
														}
														if ( count( $font_family2 ) == $cnt2 ) {
															echo '</optgroup>';
														}
														?>
													</select>
												</div>
											</div>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"> <?php esc_html_e( 'Font Size (px)', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select font size for post date', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php $date_fontsize = isset( $wtl_settings['date_fontsize'] ) ? $wtl_settings['date_fontsize'] : '18'; ?>
											<div class="grid_col_space range_slider_fontsize" id="content_fontsize_slider" data-value="<?php echo esc_attr( $date_fontsize ); ?>"></div>
											<div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="date_fontsize" id="date_fontsize" value="<?php echo esc_attr( $date_fontsize ); ?>"  /></div>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title">
											<?php esc_html_e( 'Font Weight', 'wp-timeline-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select font weight', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
										<?php $date_font_weight = isset( $wtl_settings['date_font_weight'] ) ? $wtl_settings['date_font_weight'] : 'normal'; ?>
											<div class="select-cover">
												<select name="date_font_weight" id="date_font_weight">
													<option value="100" <?php selected( $date_font_weight, 100 ); ?>>100</option>
													<option value="200" <?php selected( $date_font_weight, 200 ); ?>>200</option>
													<option value="300" <?php selected( $date_font_weight, 300 ); ?>>300</option>
													<option value="400" <?php selected( $date_font_weight, 400 ); ?>>400</option>
													<option value="500" <?php selected( $date_font_weight, 500 ); ?>>500</option>
													<option value="600" <?php selected( $date_font_weight, 600 ); ?>>600</option>
													<option value="700" <?php selected( $date_font_weight, 700 ); ?>>700</option>
													<option value="800" <?php selected( $date_font_weight, 800 ); ?>>800</option>
													<option value="900" <?php selected( $date_font_weight, 900 ); ?>>900</option>
													<option value="bold" <?php selected( $date_font_weight, 'bold' ); ?> ><?php esc_html_e( 'Bold', 'wp-timeline-designer-pro' ); ?></option>
													<option value="normal" <?php selected( $date_font_weight, 'normal' ); ?>><?php esc_html_e( 'Normal', 'wp-timeline-designer-pro' ); ?></option>
												</select>
											</div>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Line Height', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enter line height', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<div class="input-type-number">
												<input type="number" name="date_font_line_height" id="date_font_line_height" step="0.1" min="0" value="<?php echo isset( $wtl_settings['date_font_line_height'] ) ? esc_attr( $wtl_settings['date_font_line_height'] ) : '1.5'; ?>" >
												<div class="input-type-number-nav">
													<div class="input-type-number-button input-type-number-up">+</div>
													<div class="input-type-number-button input-type-number-down">-</div>
												</div>
											</div>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title">
											<?php esc_html_e( 'Italic Font Style', 'wp-timeline-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Display italic font style', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php $date_font_italic = isset( $wtl_settings['date_font_italic'] ) ? $wtl_settings['date_font_italic'] : '0'; ?>
											<fieldset class="wp-timeline-social-options wp-timeline-display_author buttonset ui-buttonset">
												<input id="date_font_italic_1" name="date_font_italic" type="radio" value="1"  <?php checked( 1, $date_font_italic ); ?> />
												<label for="date_font_italic_1" class="<?php echo esc_html( $uic_l ); ?>"><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
												<input id="date_font_italic_0" name="date_font_italic" type="radio" value="0" <?php checked( 0, $date_font_italic ); ?> />
												<label for="date_font_italic_0" class="<?php echo esc_html( $uic_r ); ?>"><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Text Transform', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select text transform style', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
										<?php $date_font_text_transform = isset( $wtl_settings['date_font_text_transform'] ) ? $wtl_settings['date_font_text_transform'] : 'none'; ?>
											<div class="select-cover">
												<select name="date_font_text_transform" id="date_font_text_transform">
													<option <?php selected( $date_font_text_transform, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'wp-timeline-designer-pro' ); ?></option>
													<option <?php selected( $date_font_text_transform, 'capitalize' ); ?> value="capitalize"><?php esc_html_e( 'Capitalize', 'wp-timeline-designer-pro' ); ?></option>
													<option <?php selected( $date_font_text_transform, 'uppercase' ); ?> value="uppercase"><?php esc_html_e( 'Uppercase', 'wp-timeline-designer-pro' ); ?></option>
													<option <?php selected( $date_font_text_transform, 'lowercase' ); ?> value="lowercase"><?php esc_html_e( 'Lowercase', 'wp-timeline-designer-pro' ); ?></option>
													<option <?php selected( $date_font_text_transform, 'full-width' ); ?> value="full-width"><?php esc_html_e( 'Full Width', 'wp-timeline-designer-pro' ); ?></option>
												</select>
											</div>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Text Decoration', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select text decoration style', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php $date_font_text_decoration = isset( $wtl_settings['date_font_text_decoration'] ) ? $wtl_settings['date_font_text_decoration'] : 'none'; ?>
											<div class="select-cover">
												<select name="date_font_text_decoration" id="date_font_text_decoration">
													<option <?php selected( $date_font_text_decoration, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'wp-timeline-designer-pro' ); ?></option>
													<option <?php selected( $date_font_text_decoration, 'underline' ); ?> value="underline"><?php esc_html_e( 'Underline', 'wp-timeline-designer-pro' ); ?></option>
													<option <?php selected( $date_font_text_decoration, 'overline' ); ?> value="overline"><?php esc_html_e( 'Overline', 'wp-timeline-designer-pro' ); ?></option>
													<option <?php selected( $date_font_text_decoration, 'line-through' ); ?> value="line-through"><?php esc_html_e( 'Line Through', 'wp-timeline-designer-pro' ); ?></option>
												</select>
											</div>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Letter Spacing (px)', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enter letter spacing', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<div class="input-type-number">
												<input type="number" name="date_font_letter_spacing" id="date_font_letter_spacing" step="1" min="0" value="<?php echo isset( $wtl_settings['date_font_letter_spacing'] ) ? esc_attr( $wtl_settings['date_font_letter_spacing'] ) : '0'; ?>" >
												<div class="input-type-number-nav">
													<div class="input-type-number-button input-type-number-up">+</div>
													<div class="input-type-number-button input-type-number-down">-</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>


						</ul>
					</div>
				</div>
				<div id="wp_timeline_title" class="postbox postbox-with-fw-options" style='<?php echo esc_attr( $wp_timeline_title_class_show ); ?>'>
					<div class="inside">
						<ul class="wp-timeline-settings wp-timeline-lineheight wp-timeline-display-typography">
							<li>
								<?php wtl_setting_left( esc_html__( 'Post Title Link', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Display Post Title Link', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $wp_timeline_post_title_link = isset( $wtl_settings['wp_timeline_post_title_link'] ) ? $wtl_settings['wp_timeline_post_title_link'] : '1'; ?>
									<fieldset class="buttonset ui-buttonset buttonset-hide" data-hide='1'>
										<input id="wp_timeline_post_title_link_1" name="wp_timeline_post_title_link" type="radio" value="1" <?php checked( 1, $wp_timeline_post_title_link ); ?> />
										<label id="wp-timeline-options-button" class="<?php echo esc_html( $uic_l ); ?>" for="wp_timeline_post_title_link_1" <?php checked( 1, $wp_timeline_post_title_link ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
										<input id="wp_timeline_post_title_link_0" name="wp_timeline_post_title_link" type="radio" value="0" <?php checked( 0, $wp_timeline_post_title_link ); ?> />
										<label id="wp-timeline-options-button" class="<?php echo esc_html( $uic_r ); ?>" for="wp_timeline_post_title_link_0" <?php checked( 0, $wp_timeline_post_title_link ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="title_alignment_section">
								<?php wtl_setting_left( esc_html__( 'Post Title Alignment', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select post title alignment', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php
									$template_title_alignment = 'left';
									if ( isset( $wtl_settings['template_title_alignment'] ) ) {
										$template_title_alignment = $wtl_settings['template_title_alignment'];
									}
									?>
									<fieldset class="buttonset ui-buttonset green" data-hide='1'>
											<input id="template_title_alignment_left" name="template_title_alignment" type="radio" value="left" <?php checked( 'left', $template_title_alignment ); ?> />
											<label id="wp-timeline-options-button" for="template_title_alignment_left"><?php esc_html_e( 'Left', 'wp-timeline-designer-pro' ); ?></label>
											<input id="template_title_alignment_center" name="template_title_alignment" type="radio" value="center" <?php checked( 'center', $template_title_alignment ); ?> />
											<label id="wp-timeline-options-button" for="template_title_alignment_center" class="template_title_alignment_center"><?php esc_html_e( 'Center', 'wp-timeline-designer-pro' ); ?></label>
											<input id="template_title_alignment_right" name="template_title_alignment" type="radio" value="right" <?php checked( 'right', $template_title_alignment ); ?> />
											<label id="wp-timeline-options-button" for="template_title_alignment_right"><?php esc_html_e( 'Right', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="wp-timeline-gray title-link-color-tr">
								<?php wtl_setting_left( esc_html__( 'Post Title Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( ' Select post title color', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_titlecolor = isset( $wtl_settings['template_titlecolor'] ) ? $wtl_settings['template_titlecolor'] : ''; ?>
									<input type="text" name="template_titlecolor" id="template_titlecolor" value="<?php echo esc_attr( $template_titlecolor ); ?>"/>
								</div>
							</li>
							<li class="title-link-hover-color-tr">
								<?php wtl_setting_left( esc_html__( 'Post Title Link Hover Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select post title link hover color', 'wp-timeline-designer-pro' ); ?></span></span>
									<input type="text" name="template_titlehovercolor" id="template_titlehovercolor" value="
									<?php
									if ( isset( $wtl_settings['template_titlehovercolor'] ) ) {
										echo esc_attr( $wtl_settings['template_titlehovercolor'] );
									} else {
										echo '#444';
									}
									?>
									"/>
								</div>
							</li>
							<li class="wp-timeline-gray title-link-count-color-tr">
									<?php wtl_setting_left( esc_html__( 'Post Title Count Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( ' Select post title count color', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_title_count_color = isset( $wtl_settings['template_title_count_color'] ) ? $wtl_settings['template_title_count_color'] : ''; ?>
									<input type="text" name="template_title_count_color" id="template_title_count_color" value="<?php echo esc_attr( $template_title_count_color ); ?>"/>
								</div>
							</li>
							<li class="wp-timeline-typography-cover title-font-count-size">
								<?php wtl_setting_left( esc_html__( 'Post Title Count Font Size', 'wp-timeline-designer-pro' ) ); ?>
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( ' Select post title count fontsize', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php
									if ( isset( $wtl_settings['template_title_count_fontsize'] ) && '' != $wtl_settings['template_title_count_fontsize'] ) {
										$template_title_count_fontsize = $wtl_settings['template_title_count_fontsize'];
									} else {
										$template_title_count_fontsize = 24;
									}
									?>
									<div class="grid_col_space range_slider_fontsize" id="template_postTitlecountfontsizeInput" data-value="<?php echo esc_attr( $template_title_count_fontsize ); ?>"></div>
									<div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="template_title_count_fontsize" id="template_title_count_fontsize" value="<?php echo esc_attr( $template_title_count_fontsize ); ?>"  /></div>
							</li>
							<li class="titlebackcolor_tr wp-timeline-gray">
								<?php wtl_setting_left( esc_html__( 'Post Title Background Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select post title background color', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_titlebackcolor = isset( $wtl_settings['template_titlebackcolor'] ) ? $wtl_settings['template_titlebackcolor'] : ''; ?>
									<input type="text" name="template_titlebackcolor" id="template_titlebackcolor" value="<?php echo esc_attr( $template_titlebackcolor ); ?>"/>
								</div>
							</li>
							<li>
								<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Typography Settings', 'wp-timeline-designer-pro' ); ?></h3>
								<div class="wp-timeline-typography-wrapper wp-timeline-typography-wrapper1">
									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Font Family', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select font family', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php $template_titlefontface = isset( $wtl_settings['template_titlefontface'] ) ? $wtl_settings['template_titlefontface'] : ''; ?>
											<div class="typo-field">
												<input type="hidden" id="template_titlefontface_font_type" name="template_titlefontface_font_type" value="<?php echo isset( $wtl_settings['template_titlefontface_font_type'] ) ? esc_attr( $wtl_settings['template_titlefontface_font_type'] ) : ''; ?>">
												<div class='select-cover'>
													<select name="template_titlefontface" id="template_titlefontface">
														<option value=""><?php esc_html_e( 'Select Font Family', 'wp-timeline-designer-pro' ); ?></option>
														<?php
														$old_version  = '';
														$cnt          = 0;
														$font_family4 = Wp_Timeline_Main::wtl_default_recognized_font_faces();
														foreach ( $font_family4 as $key4 => $value4 ) {
															if ( $value4['version'] != $old_version ) {
																if ( $cnt > 0 ) {
																	echo '</optgroup>';
																}
																echo '<optgroup label="' . esc_attr( $value4['version'] ) . '">';
																$old_version = $value4['version'];
															}
															echo "<option value='" . esc_attr( str_replace( '"', '', $value4['label'] ) ) . "'";
															if ( '' != $template_titlefontface && ( str_replace( '"', '', $template_titlefontface ) == str_replace( '"', '', $value4['label'] ) ) ) {
																echo ' selected';
															}
															echo '>' . esc_html( $value4['label'] ) . '</option>';
															$cnt++;
														}
														if ( count( $font_family4 ) == $cnt ) {
															echo '</optgroup>';
														}
														?>
													</select>
												</div>
											</div>
										</div>

									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title">
											<?php esc_html_e( 'Font Size (px)', 'wp-timeline-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select font size', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php
											if ( isset( $wtl_settings['template_titlefontsize'] ) && '' != $wtl_settings['template_titlefontsize'] ) {
												$template_titlefontsize = $wtl_settings['template_titlefontsize'];
											} else {
												$template_titlefontsize = 14;
											}
											?>
											<div class="grid_col_space range_slider_fontsize" id="template_postTitlefontsizeInput" data-value="<?php echo esc_attr( $template_titlefontsize ); ?>"></div>
											<div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="template_titlefontsize" id="template_titlefontsize" value="<?php echo esc_attr( $template_titlefontsize ); ?>"  /></div>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title">
											<?php esc_html_e( 'Font Weight', 'wp-timeline-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select font weight', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>

										<div class="wp-timeline-typography-content">
											<?php $template_title_font_weight = isset( $wtl_settings['template_title_font_weight'] ) ? $wtl_settings['template_title_font_weight'] : 'normal'; ?>
											<div class="select-cover">
												<select name="template_title_font_weight" id="template_title_font_weight">
													<option value="100" <?php selected( $template_title_font_weight, 100 ); ?>>100</option>
													<option value="200" <?php selected( $template_title_font_weight, 200 ); ?>>200</option>
													<option value="300" <?php selected( $template_title_font_weight, 300 ); ?>>300</option>
													<option value="400" <?php selected( $template_title_font_weight, 400 ); ?>>400</option>
													<option value="500" <?php selected( $template_title_font_weight, 500 ); ?>>500</option>
													<option value="600" <?php selected( $template_title_font_weight, 600 ); ?>>600</option>
													<option value="700" <?php selected( $template_title_font_weight, 700 ); ?>>700</option>
													<option value="800" <?php selected( $template_title_font_weight, 800 ); ?>>800</option>
													<option value="900" <?php selected( $template_title_font_weight, 900 ); ?>>900</option>
													<option value="bold" <?php selected( $template_title_font_weight, 'bold' ); ?> ><?php esc_html_e( 'Bold', 'wp-timeline-designer-pro' ); ?></option>
													<option value="normal" <?php selected( $template_title_font_weight, 'normal' ); ?>><?php esc_html_e( 'Normal', 'wp-timeline-designer-pro' ); ?></option>
												</select>
											</div>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title">
											<?php esc_html_e( 'Line Height', 'wp-timeline-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enter line height', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>

										<div class="wp-timeline-typography-content">
											<div class="input-type-number">
												<input type="number" name="template_title_font_line_height" id="template_title_font_line_height" step="0.1" min="0" value="<?php echo isset( $wtl_settings['template_title_font_line_height'] ) ? esc_attr( $wtl_settings['template_title_font_line_height'] ) : '1.5'; ?>"  >
												<div class="input-type-number-nav">
													<div class="input-type-number-button input-type-number-up">+</div>
													<div class="input-type-number-button input-type-number-down">-</div>
												</div>
											</div>
										</div>
									</div>
									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title">
											<?php esc_html_e( 'Italic Font Style', 'wp-timeline-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Display italic font style', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php $template_title_font_italic = isset( $wtl_settings['template_title_font_italic'] ) ? $wtl_settings['template_title_font_italic'] : '0'; ?>
											<fieldset class="wp-timeline-social-options wp-timeline-display_author buttonset ui-buttonset">
												<input id="template_title_font_italic_1" name="template_title_font_italic" type="radio" value="1"  <?php checked( 1, $template_title_font_italic ); ?> />
												<label for="template_title_font_italic_1" class="<?php echo esc_html( $uic_l ); ?>"><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
												<input id="template_title_font_italic_0" name="template_title_font_italic" type="radio" value="0" <?php checked( 0, $template_title_font_italic ); ?> />
												<label for="template_title_font_italic_0" class="<?php echo esc_html( $uic_r ); ?>"><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title">
											<?php esc_html_e( 'Text Transform', 'wp-timeline-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select text transform style', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>

										<div class="wp-timeline-typography-content">
											<?php $template_title_font_text_transform = isset( $wtl_settings['template_title_font_text_transform'] ) ? $wtl_settings['template_title_font_text_transform'] : 'none'; ?>
											<div class="select-cover">
												<select name="template_title_font_text_transform" id="template_title_font_text_transform">
													<option <?php selected( $template_title_font_text_transform, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'wp-timeline-designer-pro' ); ?></option>
													<option <?php selected( $template_title_font_text_transform, 'capitalize' ); ?> value="capitalize"><?php esc_html_e( 'Capitalize', 'wp-timeline-designer-pro' ); ?></option>
													<option <?php selected( $template_title_font_text_transform, 'uppercase' ); ?> value="uppercase"><?php esc_html_e( 'Uppercase', 'wp-timeline-designer-pro' ); ?></option>
													<option <?php selected( $template_title_font_text_transform, 'lowercase' ); ?> value="lowercase"><?php esc_html_e( 'Lowercase', 'wp-timeline-designer-pro' ); ?></option>
													<option <?php selected( $template_title_font_text_transform, 'full-width' ); ?> value="full-width"><?php esc_html_e( 'Full Width', 'wp-timeline-designer-pro' ); ?></option>
												</select>
											</div>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title">
											<?php esc_html_e( 'Text Decoration', 'wp-timeline-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select text decoration style', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>

										<div class="wp-timeline-typography-content">
											<div class="select-cover">
												<?php $template_title_font_text_decoration = isset( $wtl_settings['template_title_font_text_decoration'] ) ? $wtl_settings['template_title_font_text_decoration'] : 'none'; ?>
												<div class="select-cover">
													<select name="template_title_font_text_decoration" id="template_title_font_text_decoration">
														<option <?php selected( $template_title_font_text_decoration, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'wp-timeline-designer-pro' ); ?></option>
														<option <?php selected( $template_title_font_text_decoration, 'underline' ); ?> value="underline"><?php esc_html_e( 'Underline', 'wp-timeline-designer-pro' ); ?></option>
														<option <?php selected( $template_title_font_text_decoration, 'overline' ); ?> value="overline"><?php esc_html_e( 'Overline', 'wp-timeline-designer-pro' ); ?></option>
														<option <?php selected( $template_title_font_text_decoration, 'line-through' ); ?> value="line-through"><?php esc_html_e( 'Line Through', 'wp-timeline-designer-pro' ); ?></option>
													</select>
												</div>
											</div>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title">
											<?php esc_html_e( 'Letter Spacing (px)', 'wp-timeline-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enter letter spacing', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>

										<div class="wp-timeline-typography-content">
											<div class="input-type-number">
												<input type="number" name="template_title_font_letter_spacing" id="template_title_font_letter_spacing" step="1" min="0" value="<?php echo isset( $wtl_settings['template_title_font_letter_spacing'] ) ? esc_attr( $wtl_settings['template_title_font_letter_spacing'] ) : '0'; ?>" >
												<div class="input-type-number-nav">
													<div class="input-type-number-button input-type-number-up">+</div>
													<div class="input-type-number-button input-type-number-down">-</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div id="wp_timeline_content" class="postbox postbox-with-fw-options wp-timeline-content-setting1" style='<?php echo esc_attr( $wtl_content_class_show ); ?>'>
					<div class="inside">
						<ul class="wp-timeline-settings wp-timeline-lineheight wp-timeline-display-typography">
							<li class="feed_excert">
								<?php wtl_setting_left( esc_html__( 'For each Article in a Feed, Show', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'To display full text for each post, select full text option, otherwise select the summary option.', 'wp-timeline-designer-pro' ); ?></span></span>
									<fieldset class="wp-timeline-rss_use_excerpt buttonset ui-buttonset buttonset-hide green" data-hide='1'>
										<input id="rss_use_excerpt_0" name="rss_use_excerpt" type="radio" value="0" <?php isset( $wtl_settings['rss_use_excerpt'] ) ? checked( 0, $wtl_settings['rss_use_excerpt'] ) : ''; ?> />
										<label id="wp-timeline-options-button" for="rss_use_excerpt_0" <?php isset( $wtl_settings['rss_use_excerpt'] ) ? checked( 0, $wtl_settings['rss_use_excerpt'] ) : ''; ?>><?php esc_html_e( 'Full Text', 'wp-timeline-designer-pro' ); ?></label>
										<input id="rss_use_excerpt_1" name="rss_use_excerpt" type="radio" value="1" <?php isset( $wtl_settings['rss_use_excerpt'] ) ? checked( 1, $wtl_settings['rss_use_excerpt'] ) : ''; ?> />
										<label id="wp-timeline-options-button" for="rss_use_excerpt_1" <?php isset( $wtl_settings['rss_use_excerpt'] ) ? checked( 1, $wtl_settings['rss_use_excerpt'] ) : ''; ?>><?php esc_html_e( 'Summary', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>

							<li class="post_content_from">
								<?php wtl_setting_left( esc_html__( 'Show Content From', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'To display text from post content or from post excerpt', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_post_content_from = isset( $wtl_settings['template_post_content_from'] ) ? $wtl_settings['template_post_content_from'] : 'from_content'; ?>
									<select name="template_post_content_from" id="template_post_content_from">
										<option value="from_content" <?php selected( $template_post_content_from, 'from_content' ); ?> ><?php esc_html_e( 'Post Content', 'wp-timeline-designer-pro' ); ?></option>
										<option value="from_excerpt" <?php selected( $template_post_content_from, 'from_excerpt' ); ?>><?php esc_html_e( 'Post Excerpt', 'wp-timeline-designer-pro' ); ?></option>
									</select>
									<div class="wp-timeline-setting-description wp-timeline-note">
										<b class="note"><?php esc_html_e( 'Note', 'wp-timeline-designer-pro' ); ?>:</b>
										<?php esc_html_e( 'If Post Excerpt is empty then Content will get automatically from Post Content.', 'wp-timeline-designer-pro' ); ?>
									</div>
								</div>
							</li>

							<li class="display_popup_tr">
								<?php wtl_setting_left( esc_html__( 'Display Popup Content Text', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Display Text on Popup or Not?', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $display_popup = ( isset( $wtl_settings['display_popup'] ) ) ? $wtl_settings['display_popup'] : 0; ?>
									<fieldset class="buttonset ui-buttonset display_popup">
										<input id="display_popup_1" name="display_popup" type="radio" value="1" <?php checked( 1, $display_popup ); ?> />
										<label for="display_popup_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $display_popup ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
										<input id="display_popup_0" name="display_popup" type="radio" value="0" <?php checked( 0, $display_popup ); ?> />
										<label for="display_popup_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $display_popup ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>

							<li class="display_html_tags_tr">
								<?php wtl_setting_left( esc_html__( 'Display HTML tags with Summary', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Show HTML tags with summary', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $display_html_tags = ( isset( $wtl_settings['display_html_tags'] ) ) ? $wtl_settings['display_html_tags'] : 0; ?>
									<fieldset class="buttonset ui-buttonset display_html_tags">
										<input id="display_html_tags_1" name="display_html_tags" type="radio" value="1" <?php checked( 1, $display_html_tags ); ?> />
										<label for="display_html_tags_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $display_html_tags ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
										<input id="display_html_tags_0" name="display_html_tags" type="radio" value="0" <?php checked( 0, $display_html_tags ); ?> />
										<label for="display_html_tags_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $display_html_tags ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>

							<li class="content-firstletter-tr">
								<?php wtl_setting_left( esc_html__( 'First letter as Dropcap', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Display first letter as dropcap', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $firstletter_big = ( isset( $wtl_settings['firstletter_big'] ) ) ? $wtl_settings['firstletter_big'] : 0; ?>
									<fieldset class="buttonset ui-buttonset firstletter_big">
										<input id="firstletter_big_1" name="firstletter_big" type="radio" value="1" <?php checked( 1, $firstletter_big ); ?> />
										<label for="firstletter_big_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $firstletter_big ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
										<input id="firstletter_big_0" name="firstletter_big" type="radio" value="0" <?php checked( 0, $firstletter_big ); ?> />
										<label for="firstletter_big_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $firstletter_big ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="firstletter-setting wp-timeline-dropcap-settings">
								<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Dropcap Settings', 'wp-timeline-designer-pro' ); ?></h3>
								<div class="wp-timeline-typography-wrapper wp-timeline-typography-wrapper1">
									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Dropcap Font Family', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select font family for dropcap', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php $firstletter_font_family = ( isset( $wtl_settings['firstletter_font_family'] ) && '' != $wtl_settings['firstletter_font_family'] ) ? $wtl_settings['firstletter_font_family'] : ''; ?>
											<div class="typo-field">
												<input type="hidden" id="firstletter_font_family_font_type" name="firstletter_font_family_font_type" value="<?php echo isset( $wtl_settings['firstletter_font_family_font_type'] ) ? esc_attr( $wtl_settings['firstletter_font_family_font_type'] ) : ''; ?>">
												<select name="firstletter_font_family" id="firstletter_font_family">
													<option value=""><?php esc_html_e( 'Select Font Family', 'wp-timeline-designer-pro' ); ?></option>
													<?php
													$old_version = '';
													$cnt         = 0;
													$font_family = Wp_Timeline_Main::wtl_default_recognized_font_faces();
													foreach ( $font_family as $key => $value ) {
														if ( $value['version'] != $old_version ) {
															if ( $cnt > 0 ) {
																echo '</optgroup>';
															}
															echo '<optgroup label="' . esc_attr( $value['version'] ) . '">';
															$old_version = $value['version'];
														}
														echo "<option value='" . esc_attr( str_replace( '"', '', $value['label'] ) ) . "'";
														if ( '' != $firstletter_font_family && ( str_replace( '"', '', $firstletter_font_family ) == str_replace( '"', '', $value['label'] ) ) ) {
															echo ' selected';
														}
														echo '>' . esc_attr( $value['label'] ) . '</option>';
														$cnt++;
													}
													if ( count( $font_family ) == $cnt ) {
														echo '</optgroup>';
													}
													?>
												</select>
											</div>
										</div>
									</div>
									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Dropcap Font Size (px)', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select font size for dropcap', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php $firstletter_fontsize = ( isset( $wtl_settings['firstletter_fontsize'] ) && '' != $wtl_settings['firstletter_fontsize'] ) ? $wtl_settings['firstletter_fontsize'] : '35'; ?>
											<div class="grid_col_space range_slider_fontsize" id="firstletter_fontsize_slider" ></div>
											<div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="firstletter_fontsize" id="firstletter_fontsize" value="<?php echo esc_attr( $firstletter_fontsize ); ?>"  /></div>
										</div>
									</div>
									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Dropcap Color', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select dropcap color', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content wp-timeline-color-picker">
											<?php
											if ( isset( $wtl_settings['firstletter_contentcolor'] ) ) {
												$firstletter_contentcolor = $wtl_settings['firstletter_contentcolor'];
											} else {
												$firstletter_contentcolor = '#000000';
											}
											?>
											<input type="text" name="firstletter_contentcolor" id="firstletter_contentcolor" value="<?php echo esc_attr( $firstletter_contentcolor ); ?>"/>
										</div>
									</div>
								</div>
							</li>
							<li class="excerpt_length">
								<?php wtl_setting_left( esc_html__( 'Enter post content length (words)', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enter post content length in number of words', 'wp-timeline-designer-pro' ); ?></span></span>
									<div class="input-type-number">
									<input type="number" id="txtExcerptlength" name="txtExcerptlength" step="1" min="0" value="<?php echo esc_attr( $wtl_settings['txtExcerptlength'] ); ?>" placeholder="<?php esc_attr_e( 'Enter content length', 'wp-timeline-designer-pro' ); ?>" >
									<div class="input-type-number-nav">
										<div class="input-type-number-button input-type-number-up">+</div>
										<div class="input-type-number-button input-type-number-down">-</div>
									</div>
									</div>
								</div>
							</li>
							<li class="advance_contents_tr">
								<?php wtl_setting_left( esc_html__( 'Advance Post Contents', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable advance blog contents', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $advance_contents = ( isset( $wtl_settings['advance_contents'] ) ) ? $wtl_settings['advance_contents'] : 0; ?>
									<fieldset class="buttonset ui-buttonset advance_contents">
										<input id="advance_contents_1" name="advance_contents" type="radio" value="1" <?php checked( 1, $advance_contents ); ?> />
										<label for="advance_contents_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $advance_contents ); ?>><?php esc_html_e( 'Enable', 'wp-timeline-designer-pro' ); ?></label>
										<input id="advance_contents_0" name="advance_contents" type="radio" value="0" <?php checked( 0, $advance_contents ); ?> />
										<label for="advance_contents_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $advance_contents ); ?>><?php esc_html_e( 'Disable', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="advance_contents_tr advance_contents_settings">
								<?php wtl_setting_left( esc_html__( 'Stoppage From', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Display content stoppage from', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $contents_stopage_from = isset( $wtl_settings['contents_stopage_from'] ) ? $wtl_settings['contents_stopage_from'] : 'paragraph'; ?>
									<select name="contents_stopage_from" id="contents_stopage_from">
										<option value="paragraph" <?php selected( $contents_stopage_from, 'paragraph' ); ?> ><?php esc_html_e( 'Last Paragraph', 'wp-timeline-designer-pro' ); ?></option>
										<option value="character" <?php selected( $contents_stopage_from, 'character' ); ?>><?php esc_html_e( 'Characters', 'wp-timeline-designer-pro' ); ?></option>
									</select>
									<div class="wp-timeline-setting-description wp-timeline-note">
										<b class="note"><?php esc_html_e( 'Note', 'wp-timeline-designer-pro' ); ?>:</b> &nbsp;
										<?php esc_html_e( 'If "Display HTML tags with Summary" is Enable then Stoppage From Characters option is disable.', 'wp-timeline-designer-pro' ); ?>
									</div>
								</div>
							</li>
							<li class="advance_contents_settings_character">
								<?php wtl_setting_left( esc_html__( 'Stoppage Characters', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-select"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select display content stoppage characters', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $contents_stopage_character = isset( $wtl_settings['contents_stopage_character'] ) ? $wtl_settings['contents_stopage_character'] : array( '.' ); ?>
									<select data-placeholder="<?php esc_attr_e( 'Choose stoppage characters', 'wp-timeline-designer-pro' ); ?>" class="chosen-select" multiple style="width:220px;" name="contents_stopage_character[]" id="contents_stopage_character">
										<option value="." <?php echo ( in_array( '.', $contents_stopage_character, true ) ) ? 'selected="selected"' : ''; ?>> . </option>
										<option value="?" <?php echo ( in_array( '?', $contents_stopage_character, true ) ) ? 'selected="selected"' : ''; ?>> ? </option>
										<option value="," <?php echo ( in_array( ',', $contents_stopage_character, true ) ) ? 'selected="selected"' : ''; ?>> , </option>
										<option value=";" <?php echo ( in_array( ';', $contents_stopage_character, true ) ) ? 'selected="selected"' : ''; ?>> ; </option>
										<option value=":" <?php echo ( in_array( ':', $contents_stopage_character, true ) ) ? 'selected="selected"' : ''; ?>> : </option>
									</select>
								</div>
							</li>
							<li class="contentcolor_tr">
								<?php wtl_setting_left( esc_html__( 'Post Content Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select post content color', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_contentcolor = isset( $wtl_settings['template_contentcolor'] ) ? $wtl_settings['template_contentcolor'] : ''; ?>
									<input type="text" name="template_contentcolor" id="template_contentcolor" value="<?php echo esc_attr( $template_contentcolor ); ?>"/>
								</div>
							</li>
							<li>
								<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Post Content Typography Settings', 'wp-timeline-designer-pro' ); ?></h3>
								<div class="wp-timeline-typography-wrapper wp-timeline-typography-wrapper1">
									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Font Family', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select post content font family', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php
											if ( isset( $wtl_settings['content_font_family'] ) && '' != $wtl_settings['content_font_family'] ) {
												$content_font_family = $wtl_settings['content_font_family'];
											} else {
												$content_font_family = '';
											}
											?>
											<div class="typo-field">
												<input type="hidden" id="content_font_family_font_type" name="content_font_family_font_type" value="<?php echo isset( $wtl_settings['content_font_family_font_type'] ) ? esc_attr( $wtl_settings['content_font_family_font_type'] ) : ''; ?>">
												<div class="select-cover">
													<select name="content_font_family" id="content_font_family">
														<option value=""><?php esc_html_e( 'Select Font Family', 'wp-timeline-designer-pro' ); ?></option>
														<?php
														$old_version = '';
														$cnt         = 0;
														$font_family = Wp_Timeline_Main::wtl_default_recognized_font_faces();
														foreach ( $font_family as $key => $value ) {
															if ( $value['version'] != $old_version ) {
																if ( $cnt > 0 ) {
																	echo '</optgroup>';
																}
																echo '<optgroup label="' . esc_attr( $value['version'] ) . '">';
																$old_version = $value['version'];
															}
															echo "<option value='" . esc_attr( str_replace( '"', '', $value['label'] ) ) . "'";
															if ( '' != $content_font_family && ( str_replace( '"', '', $content_font_family ) == str_replace( '"', '', $value['label'] ) ) ) {
																echo ' selected';
															}
															echo '>' . esc_attr( $value['label'] ) . '</option>';
															$cnt++;
														}
														if ( count( $font_family ) == $cnt ) {
															echo '</optgroup>';
														}
														?>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Font Size (px)', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select font size for post content', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<div class="grid_col_space range_slider_fontsize" id="post_content_fontsize_slider" data-value="<?php echo esc_attr( $wtl_settings['content_fontsize'] ); ?>"></div>
											<div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="content_fontsize" id="content_fontsize" value="<?php echo esc_attr( $wtl_settings['content_fontsize'] ); ?>"  /></div>
										</div>
									</div>
									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Font Weight', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select font weight', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php $content_font_weight = isset( $wtl_settings['content_font_weight'] ) ? $wtl_settings['content_font_weight'] : 'normal'; ?>
											<div class="select-cover">
												<select name="content_font_weight" id="content_font_weight">
													<option value="100" <?php selected( $content_font_weight, 100 ); ?>>100</option>
													<option value="200" <?php selected( $content_font_weight, 200 ); ?>>200</option>
													<option value="300" <?php selected( $content_font_weight, 300 ); ?>>300</option>
													<option value="400" <?php selected( $content_font_weight, 400 ); ?>>400</option>
													<option value="500" <?php selected( $content_font_weight, 500 ); ?>>500</option>
													<option value="600" <?php selected( $content_font_weight, 600 ); ?>>600</option>
													<option value="700" <?php selected( $content_font_weight, 700 ); ?>>700</option>
													<option value="800" <?php selected( $content_font_weight, 800 ); ?>>800</option>
													<option value="900" <?php selected( $content_font_weight, 900 ); ?>>900</option>
													<option value="bold" <?php selected( $content_font_weight, 'bold' ); ?> ><?php esc_html_e( 'Bold', 'wp-timeline-designer-pro' ); ?></option>
													<option value="normal" <?php selected( $content_font_weight, 'normal' ); ?>><?php esc_html_e( 'Normal', 'wp-timeline-designer-pro' ); ?></option>
												</select>
											</div>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Line Height', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enter line height', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content"><div class="input-type-number"><input type="number" name="content_font_line_height" id="content_font_line_height" step="0.1" min="0" value="<?php echo isset( $wtl_settings['content_font_line_height'] ) ? esc_attr( $wtl_settings['content_font_line_height'] ) : '1.5'; ?>" ><div class="input-type-number-nav">
											<div class="input-type-number-button input-type-number-up">+</div>
											<div class="input-type-number-button input-type-number-down">-</div>
										</div></div></div>
									</div>
									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Italic Font Style', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Display italic font style', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php $content_font_italic = isset( $wtl_settings['content_font_italic'] ) ? $wtl_settings['content_font_italic'] : '0'; ?>
											<fieldset class="wp-timeline-social-options wp-timeline-display_author buttonset ui-buttonset">
												<input id="content_font_italic_1" name="content_font_italic" type="radio" value="1"  <?php checked( 1, $content_font_italic ); ?> />
												<label for="content_font_italic_1" class="<?php echo esc_html( $uic_l ); ?>"><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
												<input id="content_font_italic_0" name="content_font_italic" type="radio" value="0" <?php checked( 0, $content_font_italic ); ?> />
												<label for="content_font_italic_0" class="<?php echo esc_html( $uic_r ); ?>"><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Text Transform', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select text transform style', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php $content_font_text_transform = isset( $wtl_settings['content_font_text_transform'] ) ? $wtl_settings['content_font_text_transform'] : 'none'; ?>
												<div class="select-cover">
													<select name="content_font_text_transform" id="content_font_text_transform">
														<option <?php selected( $content_font_text_transform, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'wp-timeline-designer-pro' ); ?></option>
														<option <?php selected( $content_font_text_transform, 'capitalize' ); ?> value="capitalize"><?php esc_html_e( 'Capitalize', 'wp-timeline-designer-pro' ); ?></option>
														<option <?php selected( $content_font_text_transform, 'uppercase' ); ?> value="uppercase"><?php esc_html_e( 'Uppercase', 'wp-timeline-designer-pro' ); ?></option>
														<option <?php selected( $content_font_text_transform, 'lowercase' ); ?> value="lowercase"><?php esc_html_e( 'Lowercase', 'wp-timeline-designer-pro' ); ?></option>
														<option <?php selected( $content_font_text_transform, 'full-width' ); ?> value="full-width"><?php esc_html_e( 'Full Width', 'wp-timeline-designer-pro' ); ?></option>
													</select>
												</div>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Text Decoration', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select text decoration style', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php $content_font_text_decoration = isset( $wtl_settings['content_font_text_decoration'] ) ? $wtl_settings['content_font_text_decoration'] : 'none'; ?>
											<div class="select-cover">
												<select name="content_font_text_decoration" id="content_font_text_decoration">
													<option <?php selected( $content_font_text_decoration, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'wp-timeline-designer-pro' ); ?></option>
													<option <?php selected( $content_font_text_decoration, 'underline' ); ?> value="underline"><?php esc_html_e( 'Underline', 'wp-timeline-designer-pro' ); ?></option>
													<option <?php selected( $content_font_text_decoration, 'overline' ); ?> value="overline"><?php esc_html_e( 'Overline', 'wp-timeline-designer-pro' ); ?></option>
													<option <?php selected( $content_font_text_decoration, 'line-through' ); ?> value="line-through"><?php esc_html_e( 'Line Through', 'wp-timeline-designer-pro' ); ?></option>
												</select>
											</div>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Letter Spacing (px)', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enter letter spacing', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content"><div class="input-type-number"><input type="number" name="content_font_letter_spacing" id="content_font_letter_spacing" step="1" min="0" value="<?php echo isset( $wtl_settings['content_font_letter_spacing'] ) ? esc_attr( $wtl_settings['content_font_letter_spacing'] ) : '0'; ?>" >
										<div class="input-type-number-nav">
											<div class="input-type-number-button input-type-number-up">+</div>
											<div class="input-type-number-button input-type-number-down">-</div>
										</div></div></div>
									</div>
								</div>
							</li>



							<li class="display_read_more_link">
								<?php wtl_setting_left( esc_html__( 'Display Read More Link', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable to show read more post link', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $read_more_link = isset( $wtl_settings['read_more_link'] ) ? $wtl_settings['read_more_link'] : '1'; ?>
									<fieldset class="wp-timeline-social-options wp-timeline-read_more_link buttonset buttonset-hide ui-buttonset">
										<input id="read_more_link_1" name="read_more_link" type="radio" value="1" <?php checked( 1, $read_more_link ); ?> />
										<label for="read_more_link_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $read_more_link ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
										<input id="read_more_link_0" name="read_more_link" type="radio" value="0" <?php checked( 0, $read_more_link ); ?> />
										<label for="read_more_link_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $read_more_link ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="display_read_more_on read_more_wrap">
								<?php wtl_setting_left( esc_html__( 'Display Read More On', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select option for display read more button where to display', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $read_more_on = isset( $wtl_settings['read_more_on'] ) ? $wtl_settings['read_more_on'] : '2'; ?>
									<fieldset class="wp-timeline-social-options wp-timeline-read_more_on buttonset ui-buttonset buttonset-hide green">
										<input id="read_more_on_1" name="read_more_on" type="radio" value="1" <?php checked( 1, $read_more_on ); ?> />
										<label id="wp-timeline-options-button" for="read_more_on_1" <?php checked( 1, $read_more_on ); ?>><?php esc_html_e( 'Same Line', 'wp-timeline-designer-pro' ); ?></label>
										<input id="read_more_on_2" name="read_more_on" type="radio" value="2" <?php checked( 2, $read_more_on ); ?> />
										<label id="wp-timeline-options-button" for="read_more_on_2" <?php checked( 2, $read_more_on ); ?>><?php esc_html_e( 'Next Line', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="read_more_text read_more_wrap">
								<?php wtl_setting_left( esc_html__( 'Read More Text', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enter read more text label', 'wp-timeline-designer-pro' ); ?></span></span>
									<input type="text" name="txtReadmoretext" id="txtReadmoretext" value="<?php echo esc_attr( $wtl_settings['txtReadmoretext'] ); ?>" placeholder="Enter read more text">
								</div>
							</li>

							<li class="read_more_wrap">
								<?php wtl_setting_left( esc_html__( 'Read More Link', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select read more link type.', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $post_link_type = isset( $wtl_settings['post_link_type'] ) ? $wtl_settings['post_link_type'] : '0'; ?>
									<fieldset class="wp-timeline-post_link_type buttonset ui-buttonset buttonset-hide green" data-hide='1'>
										<input id="post_link_type_0" name="post_link_type" type="radio" value="0" <?php checked( 0, $post_link_type ); ?> />
										<label id="wp-timeline-options-button" for="post_link_type_0" <?php checked( 0, $post_link_type ); ?>><?php esc_html_e( 'Post Link', 'wp-timeline-designer-pro' ); ?></label>
										<input id="post_link_type_1" name="post_link_type" type="radio" value="1" <?php checked( 1, $post_link_type ); ?> />
										<label id="wp-timeline-options-button" for="post_link_type_1" <?php checked( 1, $post_link_type ); ?>><?php esc_html_e( 'Custom Link', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="read_more_wrap custom_link_url">
								<?php wtl_setting_left( esc_html__( 'Custom Link URL', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enter custom link url.', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $custom_link_url = isset( $wtl_settings['custom_link_url'] ) ? $wtl_settings['custom_link_url'] : ''; ?>
									<input type="url" name="custom_link_url" id="custom_link_url" value="<?php echo esc_attr( $custom_link_url ); ?>" placeholder="<?php esc_html_e( 'eg.', 'wp-timeline-designer-pro' ) . ' ' . get_site_url(); ?>" />
								</div>
							</li>
							<li class="read_more_wrap read_more_button_alignment_setting">
								<?php wtl_setting_left( esc_html__( 'Read More Button Alignment', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select read more button alignment', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php
									$readmore_button_alignment = 'left';
									if ( isset( $wtl_settings['readmore_button_alignment'] ) ) {
										$readmore_button_alignment = $wtl_settings['readmore_button_alignment'];
									}
									?>
									<fieldset class="buttonset ui-buttonset green" data-hide='1'>
										<input id="readmore_button_alignment_left" name="readmore_button_alignment" type="radio" value="left" <?php checked( 'left', $readmore_button_alignment ); ?> />
										<label id="wp-timeline-options-button" for="readmore_button_alignment_left"><?php esc_html_e( 'Left', 'wp-timeline-designer-pro' ); ?></label>
										<input id="readmore_button_alignment_center" name="readmore_button_alignment" type="radio" value="center" <?php checked( 'center', $readmore_button_alignment ); ?> />
										<label id="wp-timeline-options-button" for="readmore_button_alignment_center" class="readmore_button_alignment_center"><?php esc_html_e( 'Center', 'wp-timeline-designer-pro' ); ?></label>
										<input id="readmore_button_alignment_right" name="readmore_button_alignment" type="radio" value="right" <?php checked( 'right', $readmore_button_alignment ); ?> />
										<label id="wp-timeline-options-button" for="readmore_button_alignment_right"><?php esc_html_e( 'Right', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="read_more_wrap read_more_text_color">
								<?php wtl_setting_left( esc_html__( 'Read More Text Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select read more text color', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_readmorecolor = isset( $wtl_settings['template_readmorecolor'] ) ? $wtl_settings['template_readmorecolor'] : ''; ?>
									<input type="text" name="template_readmorecolor" id="template_readmorecolor" value="<?php echo esc_attr( $template_readmorecolor ); ?>"/>
								</div>
							</li>
							<li class="read_more_wrap read_more_hover_text_color">
								<?php wtl_setting_left( esc_html__( 'Read More Hover Text Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
								<?php $template_readmorehovercolor = isset( $wtl_settings['template_readmorehovercolor'] ) ? $wtl_settings['template_readmorehovercolor'] : ''; ?>
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select read more hover text color', 'wp-timeline-designer-pro' ); ?></span></span>
									<input type="text" name="template_readmorehovercolor" id="template_readmorehovercolor" value="<?php echo esc_attr( $template_readmorehovercolor ); ?>"/>
								</div>
							</li>
							<li class="read_more_wrap read_more_text_background">
								<?php wtl_setting_left( esc_html__( 'Read More Text Background Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select read more text background color', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_readmorebackcolor = isset( $wtl_settings['template_readmorebackcolor'] ) ? $wtl_settings['template_readmorebackcolor'] : ''; ?>
									<input type="text" name="template_readmorebackcolor" id="template_readmorebackcolor" value="<?php echo esc_attr( $template_readmorebackcolor ); ?>"/>
								</div>
							</li>
							<li class="read_more_wrap read_more_text_hover_background">
								<?php wtl_setting_left( esc_html__( 'Read More Text Hover Background Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select read more text hover background color', 'wp-timeline-designer-pro' ); ?></span></span>
									<input type="text" name="template_readmore_hover_backcolor" id="template_readmore_hover_backcolor" value="<?php echo ( isset( $wtl_settings['template_readmore_hover_backcolor'] ) && '' != $wtl_settings['template_readmore_hover_backcolor'] ) ? esc_attr( $wtl_settings['template_readmore_hover_backcolor'] ) : ''; ?>"/>
								</div>
							</li>
							<li class="read_more_wrap read_more_button_border_setting">
								<?php wtl_setting_left( esc_html__( 'Read More Button Border Style', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select read more button border type', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $read_more_button_border_style = isset( $wtl_settings['read_more_button_border_style'] ) ? $wtl_settings['read_more_button_border_style'] : 'solid'; ?>
									<select name="read_more_button_border_style" id="read_more_button_border_style">
										<option value="none" <?php selected( $read_more_button_border_style, 'none' ); ?>><?php esc_html_e( 'None', 'wp-timeline-designer-pro' ); ?></option>
										<option value="dotted" <?php selected( $read_more_button_border_style, 'dotted' ); ?>><?php esc_html_e( 'Dotted', 'wp-timeline-designer-pro' ); ?></option>
										<option value="dashed" <?php selected( $read_more_button_border_style, 'dashed' ); ?>><?php esc_html_e( 'Dashed', 'wp-timeline-designer-pro' ); ?></option>
										<option value="solid" <?php selected( $read_more_button_border_style, 'solid' ); ?>><?php esc_html_e( 'Solid', 'wp-timeline-designer-pro' ); ?></option>
										<option value="double" <?php selected( $read_more_button_border_style, 'double' ); ?>><?php esc_html_e( 'Double', 'wp-timeline-designer-pro' ); ?></option>
										<option value="groove" <?php selected( $read_more_button_border_style, 'groove' ); ?>><?php esc_html_e( 'Groove', 'wp-timeline-designer-pro' ); ?></option>
										<option value="ridge" <?php selected( $read_more_button_border_style, 'ridge' ); ?>><?php esc_html_e( 'Ridge', 'wp-timeline-designer-pro' ); ?></option>
										<option value="inset" <?php selected( $read_more_button_border_style, 'inset' ); ?>><?php esc_html_e( 'Inset', 'wp-timeline-designer-pro' ); ?></option>
										<option value="outset" <?php selected( $read_more_button_border_style, 'outset' ); ?> ><?php esc_html_e( 'Outset', 'wp-timeline-designer-pro' ); ?></option>
									</select>
								</div>
							</li>
							<li class="read_more_wrap read_more_button_border_radius_setting">
								<?php wtl_setting_left( esc_html__( 'Read More Button Border Radius(px)', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select read more button border radius', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $readmore_button_border_radius = isset( $wtl_settings['readmore_button_border_radius'] ) ? $wtl_settings['readmore_button_border_radius'] : '0'; ?>
									<div class="input-type-number">
										<input type="number" id="readmore_button_border_radius" name="readmore_button_border_radius" step="1" min="0" value="<?php echo esc_attr( $readmore_button_border_radius ); ?>" >
										<div class="input-type-number-nav">
											<div class="input-type-number-button input-type-number-up">+</div>
											<div class="input-type-number-button input-type-number-down">-</div>
										</div>
									</div>
								</div>
							</li>
							<li class="read_more_wrap read_more_button_border_setting">
								<?php wtl_setting_left( esc_html__( 'Read More Button Border', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-border-cover">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select read more button border', 'wp-timeline-designer-pro' ); ?></span></span>
									<div class="wp-timeline-border-wrap">
										<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
											<div class="wp-timeline-border-cover wp-timeline-border-label">
													<span class="wp-timeline-key-title"><?php esc_html_e( 'Left (px)', 'wp-timeline-designer-pro' ); ?></span>
												</div>
											<div class="wp-timeline-border-cover">
												<div class="wp-timeline-border-content">
													<?php $wp_timeline_readmore_button_borderleft = isset( $wtl_settings['wp_timeline_readmore_button_borderleft'] ) ? $wtl_settings['wp_timeline_readmore_button_borderleft'] : '0'; ?>
													<div class="input-type-number">
														<input type="number" id="wp_timeline_readmore_button_borderleft" name="wp_timeline_readmore_button_borderleft" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_readmore_button_borderleft ); ?>"  >
														<div class="input-type-number-nav">
															<div class="input-type-number-button input-type-number-up">+</div>
															<div class="input-type-number-button input-type-number-down">-</div>
														</div>
													</div>
												</div>
											</div>
											<div class="wp-timeline-border-cover wp-timeline-color-picker">
												<div class="wp-timeline-border-content">
													<?php $wp_timeline_readmore_button_borderleftcolor = isset( $wtl_settings['wp_timeline_readmore_button_borderleftcolor'] ) ? $wtl_settings['wp_timeline_readmore_button_borderleftcolor'] : ''; ?>
													<input type="text" name="wp_timeline_readmore_button_borderleftcolor" id="wp_timeline_readmore_button_borderleftcolor" value="<?php echo esc_attr( $wp_timeline_readmore_button_borderleftcolor ); ?>"/>
												</div>
											</div>
										</div> 
										<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
											<div class="wp-timeline-border-cover wp-timeline-border-label">
													<span class="wp-timeline-key-title"><?php esc_html_e( 'Right (px)', 'wp-timeline-designer-pro' ); ?></span>
												</div>
											<div class="wp-timeline-border-cover">
												<div class="wp-timeline-border-content">
													<?php $wp_timeline_readmore_button_borderright = isset( $wtl_settings['wp_timeline_readmore_button_borderright'] ) ? $wtl_settings['wp_timeline_readmore_button_borderright'] : '0'; ?>
													<div class="input-type-number">
														<input type="number" id="wp_timeline_readmore_button_borderright" name="wp_timeline_readmore_button_borderright" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_readmore_button_borderright ); ?>" >
														<div class="input-type-number-nav">
															<div class="input-type-number-button input-type-number-up">+</div>
															<div class="input-type-number-button input-type-number-down">-</div>
														</div>
													</div>
												</div>
											</div>
											<div class="wp-timeline-border-cover wp-timeline-color-picker">
												<div class="wp-timeline-border-content">
												<?php $wp_timeline_readmore_button_borderrightcolor = isset( $wtl_settings['wp_timeline_readmore_button_borderrightcolor'] ) ? $wtl_settings['wp_timeline_readmore_button_borderrightcolor'] : ''; ?>
													<input type="text" name="wp_timeline_readmore_button_borderrightcolor" id="wp_timeline_readmore_button_borderrightcolor" value="<?php echo esc_attr( $wp_timeline_readmore_button_borderrightcolor ); ?>"/>
												</div>
											</div>
										</div>
										<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
											<div class="wp-timeline-border-cover wp-timeline-border-label">
													<span class="wp-timeline-key-title"><?php esc_html_e( 'Top (px)', 'wp-timeline-designer-pro' ); ?></span>
												</div>
											<div class="wp-timeline-border-cover">
												<div class="wp-timeline-border-content">
													<?php $wp_timeline_readmore_button_bordertop = isset( $wtl_settings['wp_timeline_readmore_button_bordertop'] ) ? $wtl_settings['wp_timeline_readmore_button_bordertop'] : '0'; ?>
													<div class="input-type-number">
														<input type="number" id="wp_timeline_readmore_button_bordertop" name="wp_timeline_readmore_button_bordertop" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_readmore_button_bordertop ); ?>" >
														<div class="input-type-number-nav">
															<div class="input-type-number-button input-type-number-up">+</div>
															<div class="input-type-number-button input-type-number-down">-</div>
														</div>
													</div>
												</div>
											</div>
											<div class="wp-timeline-border-cover wp-timeline-color-picker">
												<div class="wp-timeline-border-content">
													<?php $wp_timeline_readmore_button_bordertopcolor = isset( $wtl_settings['wp_timeline_readmore_button_bordertopcolor'] ) ? $wtl_settings['wp_timeline_readmore_button_bordertopcolor'] : ''; ?>
													<input type="text" name="wp_timeline_readmore_button_bordertopcolor" id="wp_timeline_readmore_button_bordertopcolor" value="<?php echo esc_attr( $wp_timeline_readmore_button_bordertopcolor ); ?>"/>
												</div>
											</div>
										</div>
										<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
											<div class="wp-timeline-border-cover wp-timeline-border-label">
													<span class="wp-timeline-key-title"><?php esc_html_e( 'Bottom(px)', 'wp-timeline-designer-pro' ); ?></span>
												</div>
											<div class="wp-timeline-border-cover">
												<div class="wp-timeline-border-content">
													<?php $wp_timeline_readmore_button_borderbottom = isset( $wtl_settings['wp_timeline_readmore_button_borderbottom'] ) ? $wtl_settings['wp_timeline_readmore_button_borderbottom'] : '0'; ?>
													<div class="input-type-number">
														<input type="number" id="wp_timeline_readmore_button_borderbottom" name="wp_timeline_readmore_button_borderbottom" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_readmore_button_borderbottom ); ?>" >
														<div class="input-type-number-nav">
															<div class="input-type-number-button input-type-number-up">+</div>
															<div class="input-type-number-button input-type-number-down">-</div>
														</div>
													</div>
												</div>
											</div>
											<div class="wp-timeline-border-cover wp-timeline-color-picker">
												<div class="wp-timeline-border-content">
												<?php $wp_timeline_readmore_button_borderbottomcolor = isset( $wtl_settings['wp_timeline_readmore_button_borderbottomcolor'] ) ? $wtl_settings['wp_timeline_readmore_button_borderbottomcolor'] : ''; ?>
												<input type="text" name="wp_timeline_readmore_button_borderbottomcolor" id="wp_timeline_readmore_button_borderbottomcolor" value="<?php echo esc_attr( $wp_timeline_readmore_button_borderbottomcolor ); ?>"/>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
							<li class="read_more_wrap read_more_button_border_setting">
								<?php wtl_setting_left( esc_html__( 'Read More Button Hover Border Style', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select read more button hover border type', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $read_more_button_hover_border_style = isset( $wtl_settings['read_more_button_hover_border_style'] ) ? $wtl_settings['read_more_button_hover_border_style'] : 'solid'; ?>
									<select name="read_more_button_hover_border_style" id="read_more_button_hover_border_style">
										<option value="none" <?php selected( $read_more_button_hover_border_style, 'none' ); ?>><?php esc_html_e( 'None', 'wp-timeline-designer-pro' ); ?></option>
										<option value="dotted" <?php selected( $read_more_button_hover_border_style, 'dotted' ); ?>><?php esc_html_e( 'Dotted', 'wp-timeline-designer-pro' ); ?></option>
										<option value="dashed" <?php selected( $read_more_button_hover_border_style, 'dashed' ); ?>><?php esc_html_e( 'Dashed', 'wp-timeline-designer-pro' ); ?></option>
										<option value="solid" <?php selected( $read_more_button_hover_border_style, 'solid' ); ?>><?php esc_html_e( 'Solid', 'wp-timeline-designer-pro' ); ?></option>
										<option value="double" <?php selected( $read_more_button_hover_border_style, 'double' ); ?>><?php esc_html_e( 'Double', 'wp-timeline-designer-pro' ); ?></option>
										<option value="groove" <?php selected( $read_more_button_hover_border_style, 'groove' ); ?>><?php esc_html_e( 'Groove', 'wp-timeline-designer-pro' ); ?></option>
										<option value="ridge" <?php selected( $read_more_button_hover_border_style, 'ridge' ); ?>><?php esc_html_e( 'Ridge', 'wp-timeline-designer-pro' ); ?></option>
										<option value="inset" <?php selected( $read_more_button_hover_border_style, 'inset' ); ?>><?php esc_html_e( 'Inset', 'wp-timeline-designer-pro' ); ?></option>
										<option value="outset" <?php selected( $read_more_button_hover_border_style, 'outset' ); ?> ><?php esc_html_e( 'Outset', 'wp-timeline-designer-pro' ); ?></option>
									</select>
								</div>
							</li>
							<li class="read_more_wrap read_more_button_border_radius_setting">
								<?php wtl_setting_left( esc_html__( 'Read More Hover Button Border Radius(px)', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select read more hover button border radius', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $readmore_button_hover_border_radius = isset( $wtl_settings['readmore_button_hover_border_radius'] ) ? $wtl_settings['readmore_button_hover_border_radius'] : '0'; ?>
									<div class="input-type-number">
										<input type="number" id="readmore_button_hover_border_radius" name="readmore_button_hover_border_radius" step="1" min="0" value="<?php echo esc_attr( $readmore_button_hover_border_radius ); ?>" >
										<div class="input-type-number-nav">
											<div class="input-type-number-button input-type-number-up">+</div>
											<div class="input-type-number-button input-type-number-down">-</div>
										</div>
									</div>
								</div>
							</li>
							<li class="read_more_wrap read_more_button_border_setting">
								<?php wtl_setting_left( esc_html__( 'Read More Hover Button Border', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-border-cover">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select read more hover button border', 'wp-timeline-designer-pro' ); ?></span></span>
									<div class="wp-timeline-border-wrap">
										<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
											<div class="wp-timeline-border-cover wp-timeline-border-label">
													<span class="wp-timeline-key-title">
														<?php esc_html_e( 'Left (px)', 'wp-timeline-designer-pro' ); ?>
													</span>
												</div>
											<div class="wp-timeline-border-cover">
												<div class="wp-timeline-border-content">
													<?php $wp_timeline_readmore_button_hover_borderleft = isset( $wtl_settings['wp_timeline_readmore_button_hover_borderleft'] ) ? $wtl_settings['wp_timeline_readmore_button_hover_borderleft'] : '0'; ?>
													<div class="input-type-number">
														<input type="number" id="wp_timeline_readmore_button_hover_borderleft" name="wp_timeline_readmore_button_hover_borderleft" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_readmore_button_hover_borderleft ); ?>"  >
														<div class="input-type-number-nav">
															<div class="input-type-number-button input-type-number-up">+</div>
															<div class="input-type-number-button input-type-number-down">-</div>
														</div>
													</div>
												</div>
											</div>
											<div class="wp-timeline-border-cover wp-timeline-color-picker">
												<div class="wp-timeline-border-content">
													<?php $wp_timeline_readmore_button_hover_borderleftcolor = isset( $wtl_settings['wp_timeline_readmore_button_hover_borderleftcolor'] ) ? $wtl_settings['wp_timeline_readmore_button_hover_borderleftcolor'] : ''; ?>
													<input type="text" name="wp_timeline_readmore_button_hover_borderleftcolor" id="wp_timeline_readmore_button_hover_borderleftcolor" value="<?php echo esc_attr( $wp_timeline_readmore_button_hover_borderleftcolor ); ?>"/>
												</div>
											</div>
										</div> 
										<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
											<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Right (px)', 'wp-timeline-designer-pro' ); ?></span></div>
											<div class="wp-timeline-border-cover">
												<div class="wp-timeline-border-content">
													<?php $wp_timeline_readmore_button_hover_borderright = isset( $wtl_settings['wp_timeline_readmore_button_hover_borderright'] ) ? $wtl_settings['wp_timeline_readmore_button_hover_borderright'] : '0'; ?>
													<div class="input-type-number">
														<input type="number" id="wp_timeline_readmore_button_hover_borderright" name="wp_timeline_readmore_button_hover_borderright" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_readmore_button_hover_borderright ); ?>" >
														<div class="input-type-number-nav">
															<div class="input-type-number-button input-type-number-up">+</div>
															<div class="input-type-number-button input-type-number-down">-</div>
														</div>
													</div>
												</div>
											</div>
											<div class="wp-timeline-border-cover wp-timeline-color-picker">
												<div class="wp-timeline-border-content">
												<?php $wp_timeline_readmore_button_hover_borderrightcolor = isset( $wtl_settings['wp_timeline_readmore_button_hover_borderrightcolor'] ) ? $wtl_settings['wp_timeline_readmore_button_hover_borderrightcolor'] : ''; ?>
													<input type="text" name="wp_timeline_readmore_button_hover_borderrightcolor" id="wp_timeline_readmore_button_hover_borderrightcolor" value="<?php echo esc_attr( $wp_timeline_readmore_button_hover_borderrightcolor ); ?>"/>
												</div>
											</div>
										</div>
										<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
											<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Top (px)', 'wp-timeline-designer-pro' ); ?></span></div>
											<div class="wp-timeline-border-cover">
												<div class="wp-timeline-border-content">
													<?php $wp_timeline_readmore_button_hover_bordertop = isset( $wtl_settings['wp_timeline_readmore_button_hover_bordertop'] ) ? $wtl_settings['wp_timeline_readmore_button_hover_bordertop'] : '0'; ?>
													<div class="input-type-number">
														<input type="number" id="wp_timeline_readmore_button_hover_bordertop" name="wp_timeline_readmore_button_hover_bordertop" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_readmore_button_hover_bordertop ); ?>" >
														<div class="input-type-number-nav">
															<div class="input-type-number-button input-type-number-up">+</div>
															<div class="input-type-number-button input-type-number-down">-</div>
														</div>
													</div>
												</div>
											</div>
											<div class="wp-timeline-border-cover wp-timeline-color-picker">
												<div class="wp-timeline-border-content">
													<?php $wp_timeline_readmore_button_hover_bordertopcolor = isset( $wtl_settings['wp_timeline_readmore_button_hover_bordertopcolor'] ) ? $wtl_settings['wp_timeline_readmore_button_hover_bordertopcolor'] : ''; ?>
													<input type="text" name="wp_timeline_readmore_button_hover_bordertopcolor" id="wp_timeline_readmore_button_hover_bordertopcolor" value="<?php echo esc_attr( $wp_timeline_readmore_button_hover_bordertopcolor ); ?>"/>
												</div>
											</div>
										</div>
										<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
											<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Bottom(px)', 'wp-timeline-designer-pro' ); ?></span></div>
											<div class="wp-timeline-border-cover">
												<div class="wp-timeline-border-content">
													<?php $wp_timeline_readmore_button_hover_borderbottom = isset( $wtl_settings['wp_timeline_readmore_button_hover_borderbottom'] ) ? $wtl_settings['wp_timeline_readmore_button_hover_borderbottom'] : '0'; ?>
													<div class="input-type-number">
														<input type="number" id="wp_timeline_readmore_button_hover_borderbottom" name="wp_timeline_readmore_button_hover_borderbottom" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_readmore_button_hover_borderbottom ); ?>" >
														<div class="input-type-number-nav">
															<div class="input-type-number-button input-type-number-up">+</div>
															<div class="input-type-number-button input-type-number-down">-</div>
														</div>
													</div>
												</div>
											</div>
											<div class="wp-timeline-border-cover wp-timeline-color-picker">
												<div class="wp-timeline-border-content">
												<?php $wp_timeline_readmore_button_hover_borderbottomcolor = isset( $wtl_settings['wp_timeline_readmore_button_hover_borderbottomcolor'] ) ? $wtl_settings['wp_timeline_readmore_button_hover_borderbottomcolor'] : ''; ?>
												<input type="text" name="wp_timeline_readmore_button_hover_borderbottomcolor" id="wp_timeline_readmore_button_hover_borderbottomcolor" value="<?php echo esc_attr( $wp_timeline_readmore_button_hover_borderbottomcolor ); ?>"/>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>							
							<li class="read_more_wrap read_more_button_border_setting">
								<?php wtl_setting_left( esc_html__( 'Read More Button padding', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-border-cover">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Set read more button padding', 'wp-timeline-designer-pro' ); ?></span></span>
									<div class="wp-timeline-padding-wrapper wp-timeline-padding-wrapper1 wp-timeline-border-wrap">
										<div class="wp-timeline-padding-cover">
											<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Left (px)', 'wp-timeline-designer-pro' ); ?></span></div>
											<div class="wp-timeline-padding-content">
												<?php $readmore_button_paddingleft = isset( $wtl_settings['readmore_button_paddingleft'] ) ? $wtl_settings['readmore_button_paddingleft'] : '10'; ?>
												<div class="input-type-number">
													<input type="number" id="readmore_button_paddingleft" name="readmore_button_paddingleft" step="1" min="0" value="<?php echo esc_attr( $readmore_button_paddingleft ); ?>" >
													<div class="input-type-number-nav">
														<div class="input-type-number-button input-type-number-up">+</div>
														<div class="input-type-number-button input-type-number-down">-</div>
													</div>
												</div>
											</div>
										</div>
										<div class="wp-timeline-padding-cover">
											<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Right (px)', 'wp-timeline-designer-pro' ); ?></span></div>
											<div class="wp-timeline-padding-content">
												<?php $readmore_button_paddingright = isset( $wtl_settings['readmore_button_paddingright'] ) ? $wtl_settings['readmore_button_paddingright'] : '10'; ?>
												<div class="input-type-number">
													<input type="number" id="readmore_button_paddingright" name="readmore_button_paddingright" step="1" min="0" value="<?php echo esc_attr( $readmore_button_paddingright ); ?>" >
													<div class="input-type-number-nav">
														<div class="input-type-number-button input-type-number-up">+</div>
														<div class="input-type-number-button input-type-number-down">-</div>
													</div>
												</div>
											</div>
										</div>
										<div class="wp-timeline-padding-cover">
											<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Top (px)', 'wp-timeline-designer-pro' ); ?></span></div>
											<div class="wp-timeline-padding-content">
												<?php $readmore_button_paddingtop = isset( $wtl_settings['readmore_button_paddingtop'] ) ? $wtl_settings['readmore_button_paddingtop'] : '10'; ?>
												<div class="input-type-number">
													<input type="number" id="readmore_button_paddingtop" name="readmore_button_paddingtop" step="1" min="0" value="<?php echo esc_attr( $readmore_button_paddingtop ); ?>"  >
													<div class="input-type-number-nav">
														<div class="input-type-number-button input-type-number-up">+</div>
														<div class="input-type-number-button input-type-number-down">-</div>
													</div>
												</div>
											</div>
										</div>
										<div class="wp-timeline-padding-cover">
											<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Bottom (px)', 'wp-timeline-designer-pro' ); ?></span></div>
											<div class="wp-timeline-padding-content">
												<?php $readmore_button_paddingbottom = isset( $wtl_settings['readmore_button_paddingbottom'] ) ? $wtl_settings['readmore_button_paddingbottom'] : '10'; ?>
												<div class="input-type-number">
													<input type="number" id="readmore_button_paddingbottom" name="readmore_button_paddingbottom" step="1" min="0" value="<?php echo esc_attr( $readmore_button_paddingbottom ); ?>" >
													<div class="input-type-number-nav">
														<div class="input-type-number-button input-type-number-up">+</div>
														<div class="input-type-number-button input-type-number-down">-</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
							<li class="read_more_wrap read_more_button_border_setting">
								<?php wtl_setting_left( esc_html__( 'Read More Button Margin', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-border-cover">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Set read more button margin', 'wp-timeline-designer-pro' ); ?></span></span>
									<div class="wp-timeline-padding-wrapper wp-timeline-padding-wrapper1 wp-timeline-border-wrap">
										<div class="wp-timeline-padding-cover">
											<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Left (px)', 'wp-timeline-designer-pro' ); ?></span></div>
											<div class="wp-timeline-padding-content">
												<?php $readmore_button_marginleft = isset( $wtl_settings['readmore_button_marginleft'] ) ? $wtl_settings['readmore_button_marginleft'] : 0; ?>
												<div class="input-type-number">
													<input type="number" id="readmore_button_marginleft" name="readmore_button_marginleft" step="1" value="<?php echo esc_attr( $readmore_button_marginleft ); ?>" >
													<div class="input-type-number-nav">
														<div class="input-type-number-button input-type-number-up">+</div>
														<div class="input-type-number-button input-type-number-down">-</div>
													</div>
												</div>
											</div>
										</div>
										<div class="wp-timeline-padding-cover">
											<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Right (px)', 'wp-timeline-designer-pro' ); ?></span></div>
											<div class="wp-timeline-padding-content">
												<?php $readmore_button_marginright = isset( $wtl_settings['readmore_button_marginright'] ) ? $wtl_settings['readmore_button_marginright'] : 0; ?>
												<div class="input-type-number">
													<input type="number" id="readmore_button_marginright" name="readmore_button_marginright" step="1" value="<?php echo esc_attr( $readmore_button_marginright ); ?>" >
													<div class="input-type-number-nav">
														<div class="input-type-number-button input-type-number-up">+</div>
														<div class="input-type-number-button input-type-number-down">-</div>
													</div>
												</div>
											</div>
										</div>
										<div class="wp-timeline-padding-cover">
											<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Top (px)', 'wp-timeline-designer-pro' ); ?></span></div>
											<div class="wp-timeline-padding-content">
												<?php $readmore_button_margintop = isset( $wtl_settings['readmore_button_margintop'] ) ? $wtl_settings['readmore_button_margintop'] : 0; ?>
												<div class="input-type-number">
													<input type="number" id="readmore_button_margintop" name="readmore_button_margintop" step="1" value="<?php echo esc_attr( $readmore_button_margintop ); ?>"  >
													<div class="input-type-number-nav">
														<div class="input-type-number-button input-type-number-up">+</div>
														<div class="input-type-number-button input-type-number-down">-</div>
													</div>
												</div>
											</div>
										</div>
										<div class="wp-timeline-padding-cover">
											<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Bottom (px)', 'wp-timeline-designer-pro' ); ?></span></div>
											<div class="wp-timeline-padding-content">
												<?php $readmore_button_marginbottom = isset( $wtl_settings['readmore_button_marginbottom'] ) ? $wtl_settings['readmore_button_marginbottom'] : 0; ?>
												<div class="input-type-number">
													<input type="number" id="readmore_button_marginbottom" name="readmore_button_marginbottom" step="1" value="<?php echo esc_attr( $readmore_button_marginbottom ); ?>" >
													<div class="input-type-number-nav">
														<div class="input-type-number-button input-type-number-up">+</div>
														<div class="input-type-number-button input-type-number-down">-</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>

							<li class="read_more_wrap read_more_text_typography_setting">
								<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Read More Typography Settings', 'wp-timeline-designer-pro' ); ?></h3>
								<div class="wp-timeline-typography-wrapper wp-timeline-typography-wrapper1">
									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title">
											<?php esc_html_e( 'Font Family', 'wp-timeline-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select read more button font family', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php
											if ( isset( $wtl_settings['readmore_font_family'] ) && '' != $wtl_settings['readmore_font_family'] ) {
												$readmore_font_family = $wtl_settings['readmore_font_family'];
											} else {
												$readmore_font_family = '';
											}
											?>
											<div class="typo-field">
												<input type="hidden" id="readmore_font_family_font_type" name="readmore_font_family_font_type" value="<?php echo isset( $wtl_settings['readmore_font_family_font_type'] ) ? esc_attr( $wtl_settings['readmore_font_family_font_type'] ) : ''; ?>">
												<div class="select-cover">
													<select name="readmore_font_family" id="readmore_font_family">
														<option value=""><?php esc_html_e( 'Select Font Family', 'wp-timeline-designer-pro' ); ?></option>
														<?php
														$old_version = '';
														$cnt         = 0;
														$font_family = Wp_Timeline_Main::wtl_default_recognized_font_faces();
														foreach ( $font_family as $key => $value ) {
															if ( $value['version'] != $old_version ) {
																if ( $cnt > 0 ) {
																	echo '</optgroup>';
																}
																echo '<optgroup label="' . esc_attr( $value['version'] ) . '">';
																$old_version = $value['version'];
															}
															echo "<option value='" . esc_attr( str_replace( '"', '', $value['label'] ) ) . "'";

															if ( '' != $readmore_font_family && ( str_replace( '"', '', $readmore_font_family ) == str_replace( '"', '', $value['label'] ) ) ) {
																echo ' selected';
															}
															echo '>' . esc_attr( $value['label'] ) . '</option>';
															$cnt++;
														}
														if ( count( $font_family ) == $cnt ) {
															echo '</optgroup>';
														}
														?>
													</select>
												</div>
											</div>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Font Size (px)', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select font size for read more button', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
										<?php $readmore_fontsize = isset( $wtl_settings['readmore_fontsize'] ) ? $wtl_settings['readmore_fontsize'] : '14'; ?>
											<div class="grid_col_space range_slider_fontsize" id="readmore_fontsize_slider" data-value="<?php echo esc_attr( $readmore_fontsize ); ?>"></div>
											<div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="readmore_fontsize" id="readmore_fontsize" value="<?php echo esc_attr( $readmore_fontsize ); ?>"  /></div>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Font Weight', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select font weight', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php $readmore_font_weight = isset( $wtl_settings['readmore_font_weight'] ) ? $wtl_settings['readmore_font_weight'] : 'normal'; ?>
											<div class="select-cover">
												<select name="readmore_font_weight" id="readmore_font_weight">
													<option value="100" <?php selected( $readmore_font_weight, 100 ); ?>>100</option>
													<option value="200" <?php selected( $readmore_font_weight, 200 ); ?>>200</option>
													<option value="300" <?php selected( $readmore_font_weight, 300 ); ?>>300</option>
													<option value="400" <?php selected( $readmore_font_weight, 400 ); ?>>400</option>
													<option value="500" <?php selected( $readmore_font_weight, 500 ); ?>>500</option>
													<option value="600" <?php selected( $readmore_font_weight, 600 ); ?>>600</option>
													<option value="700" <?php selected( $readmore_font_weight, 700 ); ?>>700</option>
													<option value="800" <?php selected( $readmore_font_weight, 800 ); ?>>800</option>
													<option value="900" <?php selected( $readmore_font_weight, 900 ); ?>>900</option>
													<option value="bold" <?php selected( $readmore_font_weight, 'bold' ); ?> ><?php esc_html_e( 'Bold', 'wp-timeline-designer-pro' ); ?></option>
													<option value="normal" <?php selected( $readmore_font_weight, 'normal' ); ?>><?php esc_html_e( 'Normal', 'wp-timeline-designer-pro' ); ?></option>
												</select>
											</div>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Line Height', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enter line height', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<div class="input-type-number"><input type="number" name="readmore_font_line_height" id="readmore_font_line_height" step="0.1" min="0" value="<?php echo isset( $wtl_settings['readmore_font_line_height'] ) ? esc_attr( $wtl_settings['readmore_font_line_height'] ) : '1.5'; ?>" >
											<div class="input-type-number-nav">
												<div class="input-type-number-button input-type-number-up">+</div>
												<div class="input-type-number-button input-type-number-down">-</div>
											</div>
											</div>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title">
											<?php esc_html_e( 'Italic Font Style', 'wp-timeline-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Display italic font style', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php $readmore_font_italic = isset( $wtl_settings['readmore_font_italic'] ) ? $wtl_settings['readmore_font_italic'] : '0'; ?>
											<fieldset class="wp-timeline-social-options wp-timeline-display_author buttonset ui-buttonset">
												<input id="readmore_font_italic_1" name="readmore_font_italic" type="radio" value="1"  <?php checked( 1, $readmore_font_italic ); ?> />
												<label for="readmore_font_italic_1" class="<?php echo esc_html( $uic_l ); ?>"><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
												<input id="readmore_font_italic_0" name="readmore_font_italic" type="radio" value="0" <?php checked( 0, $readmore_font_italic ); ?> />
												<label for="readmore_font_italic_0" class="<?php echo esc_html( $uic_r ); ?>"><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title">
											<?php esc_html_e( 'Text Transform', 'wp-timeline-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select text transform style', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php $readmore_font_text_transform = isset( $wtl_settings['readmore_font_text_transform'] ) ? $wtl_settings['readmore_font_text_transform'] : 'none'; ?>
											<div class="select-cover">
												<select name="readmore_font_text_transform" id="readmore_font_text_transform">
													<option <?php selected( $readmore_font_text_transform, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'wp-timeline-designer-pro' ); ?></option>
													<option <?php selected( $readmore_font_text_transform, 'capitalize' ); ?> value="capitalize"><?php esc_html_e( 'Capitalize', 'wp-timeline-designer-pro' ); ?></option>
													<option <?php selected( $readmore_font_text_transform, 'uppercase' ); ?> value="uppercase"><?php esc_html_e( 'Uppercase', 'wp-timeline-designer-pro' ); ?></option>
													<option <?php selected( $readmore_font_text_transform, 'lowercase' ); ?> value="lowercase"><?php esc_html_e( 'Lowercase', 'wp-timeline-designer-pro' ); ?></option>
													<option <?php selected( $readmore_font_text_transform, 'full-width' ); ?> value="full-width"><?php esc_html_e( 'Full Width', 'wp-timeline-designer-pro' ); ?></option>
												</select>
											</div>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Text Decoration', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select text decoration style', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php $readmore_font_text_decoration = isset( $wtl_settings['readmore_font_text_decoration'] ) ? $wtl_settings['readmore_font_text_decoration'] : 'none'; ?>
											<div class="select-cover">
												<select name="readmore_font_text_decoration" id="readmore_font_text_decoration">
													<option <?php selected( $readmore_font_text_decoration, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'wp-timeline-designer-pro' ); ?></option>
													<option <?php selected( $readmore_font_text_decoration, 'underline' ); ?> value="underline"><?php esc_html_e( 'Underline', 'wp-timeline-designer-pro' ); ?></option>
													<option <?php selected( $readmore_font_text_decoration, 'overline' ); ?> value="overline"><?php esc_html_e( 'Overline', 'wp-timeline-designer-pro' ); ?></option>
													<option <?php selected( $readmore_font_text_decoration, 'line-through' ); ?> value="line-through"><?php esc_html_e( 'Line Through', 'wp-timeline-designer-pro' ); ?></option>
												</select>
											</div>
										</div>
									</div>

									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Letter Spacing (px)', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enter letter spacing', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<div class="input-type-number"><input type="number" name="readmore_font_letter_spacing" id="readmore_font_letter_spacing" step="1" min="0" value="<?php echo isset( $wtl_settings['readmore_font_letter_spacing'] ) ? esc_attr( $wtl_settings['readmore_font_letter_spacing'] ) : '0'; ?>" >
											<div class="input-type-number-nav">
												<div class="input-type-number-button input-type-number-up">+</div>
												<div class="input-type-number-button input-type-number-down">-</div>
											</div>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div id="wp_timeline_content_box" class="postbox postbox-with-fw-options wp-timeline-content-setting1" style='<?php echo esc_attr( $wtl_content_box_class_show ); ?>'>
					<div class="inside">
						<ul class="wp-timeline-settings wp-timeline-lineheight wp-timeline-display-typography">
							<li class="wp-timeline-post-border">
								<?php wtl_setting_left( esc_html__( 'Content Box border', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
								<?php
								$wp_timeline_content_border_width = ( isset( $wtl_settings['wp_timeline_content_border_width'] ) && ! empty( $wtl_settings['wp_timeline_content_border_width'] ) ) ? $wtl_settings['wp_timeline_content_border_width'] : '0';
								$wp_timeline_content_border_style = ( isset( $wtl_settings['wp_timeline_content_border_style'] ) && ! empty( $wtl_settings['wp_timeline_content_border_style'] ) ) ? $wtl_settings['wp_timeline_content_border_style'] : 'normal';
								$wp_timeline_content_border_color = ( isset( $wtl_settings['wp_timeline_content_border_color'] ) && ! empty( $wtl_settings['wp_timeline_content_border_color'] ) ) ? $wtl_settings['wp_timeline_content_border_color'] : '#ffffff';
								?>
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enter content box border', 'wp-timeline-designer-pro' ); ?></span></span>
									<div class="input-type-number">
										<input type="number" id="wp_timeline_content_border_width" name="wp_timeline_content_border_width" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_content_border_width ); ?>" placeholder="<?php esc_attr_e( 'Enter Border', 'wp-timeline-designer-pro' ); ?>" >
										<div class="input-type-number-nav">
											<div class="input-type-number-button input-type-number-up">+</div>
											<div class="input-type-number-button input-type-number-down">-</div>
										</div>
									</div>
									<select name="wp_timeline_content_border_style" id="wp_timeline_content_border_style">
										<option value="none" <?php selected( $wp_timeline_content_border_style, 'none' ); ?>><?php esc_html_e( 'None', 'wp-timeline-designer-pro' ); ?></option>
										<option value="dotted" <?php selected( $wp_timeline_content_border_style, 'dotted' ); ?>><?php esc_html_e( 'Dotted', 'wp-timeline-designer-pro' ); ?></option>
										<option value="dashed" <?php selected( $wp_timeline_content_border_style, 'dashed' ); ?>><?php esc_html_e( 'Dashed', 'wp-timeline-designer-pro' ); ?></option>
										<option value="solid" <?php selected( $wp_timeline_content_border_style, 'solid' ); ?>><?php esc_html_e( 'Solid', 'wp-timeline-designer-pro' ); ?></option>
										<option value="double" <?php selected( $wp_timeline_content_border_style, 'double' ); ?>><?php esc_html_e( 'Double', 'wp-timeline-designer-pro' ); ?></option>
										<option value="groove" <?php selected( $wp_timeline_content_border_style, 'groove' ); ?>><?php esc_html_e( 'Groove', 'wp-timeline-designer-pro' ); ?></option>
										<option value="ridge" <?php selected( $wp_timeline_content_border_style, 'ridge' ); ?>><?php esc_html_e( 'Ridge', 'wp-timeline-designer-pro' ); ?></option>
										<option value="inset" <?php selected( $wp_timeline_content_border_style, 'inset' ); ?>><?php esc_html_e( 'Inset', 'wp-timeline-designer-pro' ); ?></option>
										<option value="outset" <?php selected( $wp_timeline_content_border_style, 'outset' ); ?> ><?php esc_html_e( 'Outset', 'wp-timeline-designer-pro' ); ?></option>
									</select>
									<input type="text" name="wp_timeline_content_border_color" id="wp_timeline_content_border_color" value="<?php echo esc_attr( $wp_timeline_content_border_color ); ?>" data-default-color="<?php echo esc_attr( $wp_timeline_content_border_color ); ?>"/>
								</div>
							</li>


							<li class="wp-timeline-post-border-radius">
								<?php wtl_setting_left( esc_html__( 'Content Box Border Radius', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
								<?php $wp_timeline_content_border_radius = ( isset( $wtl_settings['wp_timeline_content_border_radius'] ) && ! empty( $wtl_settings['wp_timeline_content_border_radius'] ) ) ? $wtl_settings['wp_timeline_content_border_radius'] : '0'; ?>
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select content box border radius', 'wp-timeline-designer-pro' ); ?></span></span>
									<div class="input-type-number">
										<input type="number" id="wp_timeline_content_border_radius" name="wp_timeline_content_border_radius" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_content_border_radius ); ?>" placeholder="<?php esc_attr_e( 'Enter post offset', 'wp-timeline-designer-pro' ); ?>" >
										<div class="input-type-number-nav">
											<div class="input-type-number-button input-type-number-up">+</div>
											<div class="input-type-number-button input-type-number-down">-</div>
										</div>
									</div>
								</div>
							</li>
							<li class="blog-templatebgcolor-tr">
								<?php wtl_setting_left( esc_html__( 'Content Box Background Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Content Box Background Color', 'wp-timeline-designer-pro' ); ?></span></span>
									<input type="text" name="template_content_box_bg_color" id="content_box_bg_color" value="<?php echo isset( $wtl_settings['template_content_box_bg_color'] ) ? esc_attr( $wtl_settings['template_content_box_bg_color'] ) : '#ffffff'; ?>"/>
								</div>
							</li>
							<li class="addtocart_button_hover_box_shadow_setting">
								<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Content Box Shadow Settings', 'wp-timeline-designer-pro' ); ?></h3>
								<div class="wp-timeline-boxshadow-wrapper wp-timeline-boxshadow-wrapper1">
									<div class="wp-timeline-boxshadow-cover">
										<div class="wp-timeline-boxshadow-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'H-offset (px)', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select horizontal offset value', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-boxshadow-content">
											<?php $wp_timeline_top_content_box_shadow = isset( $wtl_settings['wp_timeline_top_content_box_shadow'] ) ? $wtl_settings['wp_timeline_top_content_box_shadow'] : '0'; ?>
											<div class="input-type-number">
												<input type="number" id="wp_timeline_top_content_box_shadow" name="wp_timeline_top_content_box_shadow" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_top_content_box_shadow ); ?>"  >
												<div class="input-type-number-nav">
													<div class="input-type-number-button input-type-number-up">+</div>
													<div class="input-type-number-button input-type-number-down">-</div>
												</div>
											</div>
										</div>
									</div>
									<div class="wp-timeline-boxshadow-cover">
										<div class="wp-timeline-boxshadow-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'V-offset (px)', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select vertical offset value', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-boxshadow-content">
											<?php $wp_timeline_right_content_box_shadow = isset( $wtl_settings['wp_timeline_right_content_box_shadow'] ) ? $wtl_settings['wp_timeline_right_content_box_shadow'] : '0'; ?>
											<div class="input-type-number">
												<input type="number" id="wp_timeline_right_content_box_shadow" name="wp_timeline_right_content_box_shadow" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_right_content_box_shadow ); ?>"  >
												<div class="input-type-number-nav">
													<div class="input-type-number-button input-type-number-up">+</div>
													<div class="input-type-number-button input-type-number-down">-</div>
												</div>
											</div>
										</div>
									</div>
									<div class="wp-timeline-boxshadow-cover">
										<div class="wp-timeline-boxshadow-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Blur (px)', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select blur value', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-boxshadow-content">
											<?php $wp_timeline_bottom_content_box_shadow = isset( $wtl_settings['wp_timeline_bottom_content_box_shadow'] ) ? $wtl_settings['wp_timeline_bottom_content_box_shadow'] : '0'; ?>
											<div class="input-type-number">
												<input type="number" id="wp_timeline_bottom_content_box_shadow" name="wp_timeline_bottom_content_box_shadow" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_bottom_content_box_shadow ); ?>"  >
												<div class="input-type-number-nav">
													<div class="input-type-number-button input-type-number-up">+</div>
													<div class="input-type-number-button input-type-number-down">-</div>
												</div>
											</div>
										</div>
									</div>
									<div class="wp-timeline-boxshadow-cover">
										<div class="wp-timeline-boxshadow-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Spread (px)', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select spread value', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-boxshadow-content">
											<?php $wp_timeline_left_content_box_shadow = isset( $wtl_settings['wp_timeline_left_content_box_shadow'] ) ? $wtl_settings['wp_timeline_left_content_box_shadow'] : '0'; ?>
											<div class="input-type-number">
												<input type="number" id="wp_timeline_left_content_box_shadow" name="wp_timeline_left_content_box_shadow" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_left_content_box_shadow ); ?>"  >
												<div class="input-type-number-nav">
													<div class="input-type-number-button input-type-number-up">+</div>
													<div class="input-type-number-button input-type-number-down">-</div>
												</div>
											</div>
										</div>
									</div>
									<div class="wp-timeline-boxshadow-cover wp-timeline-boxshadow-color">
										<div class="wp-timeline-boxshadow-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Color', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select box shadow color', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-boxshadow-content wp-timeline-color-picker">
											<?php $wp_timeline_content_box_shadow_color = isset( $wtl_settings['wp_timeline_content_box_shadow_color'] ) ? $wtl_settings['wp_timeline_content_box_shadow_color'] : ''; ?>
											<input type="text" name="wp_timeline_content_box_shadow_color" id="wp_timeline_content_box_shadow_color" value="<?php echo esc_attr( $wp_timeline_content_box_shadow_color ); ?>"/>
										</div>
									</div>
								</div>
							</li>
							<li class="">
								<?php wtl_setting_left( esc_html__( 'Padding', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-border-cover">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Set box padding', 'wp-timeline-designer-pro' ); ?></span></span>
									<div class="wp-timeline-padding-wrapper wp-timeline-padding-wrapper1 wp-timeline-border-wrap">
										<div class="wp-timeline-padding-cover">
											<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Left-Right (px)', 'wp-timeline-designer-pro' ); ?></span></div>
											<div class="wp-timeline-padding-content">
												<?php $wp_timeline_content_padding_leftright = isset( $wtl_settings['wp_timeline_content_padding_leftright'] ) ? $wtl_settings['wp_timeline_content_padding_leftright'] : '0'; ?>
												<div class="input-type-number">
													<input type="number" id="wp_timeline_content_padding_leftright" name="wp_timeline_content_padding_leftright" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_content_padding_leftright ); ?>" >
													<div class="input-type-number-nav">
														<div class="input-type-number-button input-type-number-up">+</div>
														<div class="input-type-number-button input-type-number-down">-</div>
													</div>
												</div>
											</div>
										</div>
										<div class="wp-timeline-padding-cover">
											<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Top-Bottom (px)', 'wp-timeline-designer-pro' ); ?></span></div>
											<div class="wp-timeline-padding-content">
												<?php $wp_timeline_content_padding_topbottom = isset( $wtl_settings['wp_timeline_content_padding_topbottom'] ) ? $wtl_settings['wp_timeline_content_padding_topbottom'] : '0'; ?>
												<div class="input-type-number">
													<input type="number" id="wp_timeline_content_padding_topbottom" name="wp_timeline_content_padding_topbottom" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_content_padding_topbottom ); ?>"  >
													<div class="input-type-number-nav">
														<div class="input-type-number-button input-type-number-up">+</div>
														<div class="input-type-number-button input-type-number-down">-</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div id="wp_timeline_settings" class="postbox postbox-with-fw-options wp-timeline-content-setting1" style='<?php echo esc_attr( $wp_timeline_settings_class_show ); ?>'>
					<div class="inside">
						<ul class="wp-timeline-settings wp-timeline-lineheight wp-timeline-display-typography">                         
							<li class="timeline-icon-border-radious">
								<?php wtl_setting_left( esc_html__( 'Timeline Icons Border Radius (%)', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Set Timeline Border Radious', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_icon_border_radious = ( isset( $wtl_settings['template_icon_border_radious'] ) && '' != $wtl_settings['template_icon_border_radious'] ) ? $wtl_settings['template_icon_border_radious'] : 50; ?>
									<div class="grid_col_space range_slider_fontsize" id="template_icon_border_radiousInput" data-value="<?php echo esc_attr( $template_icon_border_radious ); ?>" ></div>
									<div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="template_icon_border_radious" id="template_icon_border_radious" value="<?php echo esc_attr( $template_icon_border_radious ); ?>" /></div>
								</div>
							</li>

							<li class="timeline_line_width">
								<?php wtl_setting_left( esc_html__( 'Timeline Line Width', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
								<?php $timeline_line_width = ( isset( $wtl_settings['timeline_line_width'] ) && ! empty( $wtl_settings['timeline_line_width'] ) ) ? $wtl_settings['timeline_line_width'] : '4'; ?>
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Set Timeline Line width', 'wp-timeline-designer-pro' ); ?></span></span>
									<div class="input-type-number">
										<input type="number" id="timeline_line_width" name="timeline_line_width" step="1" min="0" value="<?php echo esc_attr( $timeline_line_width ); ?>" placeholder="<?php esc_attr_e( 'Enter Line width', 'wp-timeline-designer-pro' ); ?>" >
										<div class="input-type-number-nav">
											<div class="input-type-number-button input-type-number-up">+</div>
											<div class="input-type-number-button input-type-number-down">-</div>
										</div>
									</div>
								</div>
							</li>

							<li class="timeline_style_type timeline_style">
								<?php wtl_setting_left( esc_html__( 'Timeline Style', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select Timeline Style', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $post_status = isset( $wtl_settings['timeline_style_type'] ) ? $wtl_settings['timeline_style_type'] : 'publish'; ?>
									<select id="timeline_style_type" name="timeline_style_type">
										<option value="0" <?php echo selected( '0', $post_status ); ?>><?php esc_html_e( 'Default Design', 'wp-timeline-designer-pro' ); ?></option>
										<option value="1" <?php echo selected( '1', $post_status ); ?>><?php esc_html_e( 'Flex Design', 'wp-timeline-designer-pro' ); ?></option>
										<option value="2" <?php echo selected( '2', $post_status ); ?>><?php esc_html_e( 'Classic Design', 'wp-timeline-designer-pro' ); ?></option>
										<option value="3" <?php echo selected( '3', $post_status ); ?>><?php esc_html_e( 'Artistic Design', 'wp-timeline-designer-pro' ); ?></option>
										<option value="4" <?php echo selected( '4', $post_status ); ?>><?php esc_html_e( 'Relaxed Design', 'wp-timeline-designer-pro' ); ?></option>
										<option value="5" <?php echo selected( '5', $post_status ); ?>><?php esc_html_e( 'Trending Design', 'wp-timeline-designer-pro' ); ?></option>
									</select>
								</div>
							</li>
							<li class="timeline_style_view timeline_style">
								<?php wtl_setting_left( esc_html__( 'Timeline Style View', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Timeline Layout View', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $timeline_style_view = isset( $wtl_settings['timeline_style_view'] ) ? $wtl_settings['timeline_style_view'] : 'center'; ?>
									<fieldset class="buttonset ui-buttonset green" data-hide='1'>
											<input id="timeline_style_view_center" name="timeline_style_view" type="radio" value="center" <?php checked( 'center', $timeline_style_view ); ?> />
											<label id="wp-timeline-options-button" for="timeline_style_view_center" class="timeline_style_view_center"><?php esc_html_e( 'Center', 'wp-timeline-designer-pro' ); ?></label>
											<input id="timeline_style_view_minima" name="timeline_style_view" type="radio" value="minima" <?php checked( 'minima', $timeline_style_view ); ?> />
											<label id="wp-timeline-options-button" for="timeline_style_view_minima" class="timeline_style_view_minima"><?php esc_html_e( 'Minima', 'wp-timeline-designer-pro' ); ?></label>
											<input id="timeline_style_view_left" name="timeline_style_view" type="radio" value="left" <?php checked( 'left', $timeline_style_view ); ?> />
											<label id="wp-timeline-options-button" for="timeline_style_view_left"><?php esc_html_e( 'Left', 'wp-timeline-designer-pro' ); ?></label>
											<input id="timeline_style_view_right" name="timeline_style_view" type="radio" value="right" <?php checked( 'right', $timeline_style_view ); ?> />
											<label id="wp-timeline-options-button" for="timeline_style_view_right"><?php esc_html_e( 'Right', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>

							<li class="timeline_animation timeline_style">
								<?php wtl_setting_left( esc_html__( 'Timeline Animation', 'wp-timeline-designer-pro' ) ); ?>                                
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Animation on timeline style', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $post_status = isset( $wtl_settings['timeline_animation'] ) ? $wtl_settings['timeline_animation'] : 'fade'; ?>
									<select id="timeline_animation" name="timeline_animation">
										<option value="none" <?php echo selected( 'none', $post_status ); ?>><?php esc_html_e( 'None', 'wp-timeline-designer-pro' ); ?></option>
										<optgroup label="Fade Animations">
											<option value="fade" <?php echo selected( 'fade', $post_status ); ?>><?php esc_html_e( 'Fade', 'wp-timeline-designer-pro' ); ?></option>
											<option value="fade-up" <?php echo selected( 'fade-up', $post_status ); ?>><?php esc_html_e( 'Fade Up', 'wp-timeline-designer-pro' ); ?></option>
											<option value="fade-down" <?php echo selected( 'fade-down', $post_status ); ?>><?php esc_html_e( 'Fade Down', 'wp-timeline-designer-pro' ); ?></option>
											<option value="fade-left" <?php echo selected( 'fade-left', $post_status ); ?>><?php esc_html_e( 'Fade Left', 'wp-timeline-designer-pro' ); ?></option>
											<option value="fade-right" <?php echo selected( 'fade-right', $post_status ); ?>><?php esc_html_e( 'Fade Right', 'wp-timeline-designer-pro' ); ?></option>
											<option value="fade-up-right" <?php echo selected( 'fade-up-right', $post_status ); ?>><?php esc_html_e( 'Fade Up Right', 'wp-timeline-designer-pro' ); ?></option>
											<option value="fade-up-left" <?php echo selected( 'fade-up-left', $post_status ); ?>><?php esc_html_e( 'Fade Up Left', 'wp-timeline-designer-pro' ); ?></option>
											<option value="fade-down-right" <?php echo selected( 'fade-down-right', $post_status ); ?>><?php esc_html_e( 'Fade Down Left', 'wp-timeline-designer-pro' ); ?></option>
											<option value="fade-down-left" <?php echo selected( 'fade-down-left', $post_status ); ?>><?php esc_html_e( 'Fade Down Right', 'wp-timeline-designer-pro' ); ?></option>
										</optgroup>

										<optgroup label="Flip Animations">
											<option value="flip-up" <?php echo selected( 'flip-up', $post_status ); ?>><?php esc_html_e( 'Flip Up', 'wp-timeline-designer-pro' ); ?></option>
											<option value="flip-down" <?php echo selected( 'flip-down', $post_status ); ?>><?php esc_html_e( 'Flip Down', 'wp-timeline-designer-pro' ); ?></option>
											<option value="flip-left" <?php echo selected( 'flip-left', $post_status ); ?>><?php esc_html_e( 'Flip Left', 'wp-timeline-designer-pro' ); ?></option>
											<option value="flip-right" <?php echo selected( 'flip-right', $post_status ); ?>><?php esc_html_e( 'Flip Right', 'wp-timeline-designer-pro' ); ?></option>
										</optgroup>

										<optgroup label="Slide Animations">
											<option value="slide-up" <?php echo selected( 'slide-up', $post_status ); ?>><?php esc_html_e( 'Slide Up', 'wp-timeline-designer-pro' ); ?></option>
											<option value="slide-down" <?php echo selected( 'slide-down', $post_status ); ?>><?php esc_html_e( 'Slide Down', 'wp-timeline-designer-pro' ); ?></option>
											<option value="slide-left" <?php echo selected( 'slide-left', $post_status ); ?>><?php esc_html_e( 'Slide Left', 'wp-timeline-designer-pro' ); ?></option>
											<option value="slide-right" <?php echo selected( 'slide-right', $post_status ); ?>><?php esc_html_e( 'Slide Right', 'wp-timeline-designer-pro' ); ?></option>
										</optgroup>
										<optgroup label="Zoom Animations">
											<option value="zoom-in" <?php echo selected( 'zoom-in', $post_status ); ?>><?php esc_html_e( 'Zoom In', 'wp-timeline-designer-pro' ); ?></option>
											<option value="zoom-in-up" <?php echo selected( 'zoom-in-up', $post_status ); ?>><?php esc_html_e( 'Zoom In Up', 'wp-timeline-designer-pro' ); ?></option>
											<option value="zoom-in-down" <?php echo selected( 'zoom-in-down', $post_status ); ?>><?php esc_html_e( 'Zoom In Down', 'wp-timeline-designer-pro' ); ?></option>
											<option value="zoom-in-left" <?php echo selected( 'zoom-in-left', $post_status ); ?>><?php esc_html_e( 'Zoom In Left', 'wp-timeline-designer-pro' ); ?></option>
											<option value="zoom-in-right" <?php echo selected( 'zoom-in-right', $post_status ); ?>><?php esc_html_e( 'Zoom In Right', 'wp-timeline-designer-pro' ); ?></option>
											<option value="zoom-out" <?php echo selected( 'zoom-out', $post_status ); ?>><?php esc_html_e( 'Zoom Out', 'wp-timeline-designer-pro' ); ?></option>
											<option value="zoom-out-up" <?php echo selected( 'zoom-out-up', $post_status ); ?>><?php esc_html_e( 'Zoom Out Up', 'wp-timeline-designer-pro' ); ?></option>
											<option value="zoom-out-down" <?php echo selected( 'zoom-out-down', $post_status ); ?>><?php esc_html_e( 'Zoom Out Down', 'wp-timeline-designer-pro' ); ?></option>
											<option value="zoom-out-left" <?php echo selected( 'zoom-out-left', $post_status ); ?>><?php esc_html_e( 'Zoom Out Left', 'wp-timeline-designer-pro' ); ?></option>
											<option value="zoom-out-right" <?php echo selected( 'zoom-out-right', $post_status ); ?>><?php esc_html_e( 'Zoom Out Right', 'wp-timeline-designer-pro' ); ?></option>
										</optgroup>
										<optgroup label="Other Animations">
											<option value="scale" <?php echo selected( 'scale', $post_status ); ?>><?php esc_html_e( 'Scale', 'wp-timeline-designer-pro' ); ?></option>
											<option value="skew" <?php echo selected( 'skew', $post_status ); ?>><?php esc_html_e( 'Skew', 'wp-timeline-designer-pro' ); ?></option>
											<option value="rotate" <?php echo selected( 'rotate', $post_status ); ?>><?php esc_html_e( 'Rotate', 'wp-timeline-designer-pro' ); ?></option>
										</optgroup>
									</select>
								</div>
							</li>

							<li class="template-color">
								<?php wtl_setting_left( esc_html__( 'Template Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select post template color', 'wp-timeline-designer-pro' ); ?></span></span>
									<input type="text" name="template_color" id="template_color" value="<?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?>"/>
								</div>
							</li>

							<li class="ad-background-color">
								<?php wtl_setting_left( esc_html__( 'Date Background Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select date and arrows background color', 'wp-timeline-designer-pro' ); ?></span></span>
									<input type="text" name="ad_background_color" id="ad_background_color" value="<?php echo isset( $wtl_settings['ad_background_color'] ) ? esc_attr( $wtl_settings['ad_background_color'] ) : '#c87f76'; ?>"/>
								</div>
							</li>

							<li class="hire-pbar-color">
								<?php wtl_setting_left( esc_html__( 'Progress Bar Background Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select Progress Bar Background Color', 'wp-timeline-designer-pro' ); ?></span></span>
									<input type="text" name="pbar_bg_color" id="pbar_bg_color" value="<?php echo isset( $wtl_settings['pbar_bg_color'] ) ? esc_attr( $wtl_settings['pbar_bg_color'] ) : '#fff'; ?>"/>
								</div>
							</li>

							<li class="hire-pbar-color">
								<?php wtl_setting_left( esc_html__( 'Progress Bar Track Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select Progress Bar Track Color', 'wp-timeline-designer-pro' ); ?></span></span>
									<input type="text" name="pbar_track_color" id="pbar_track_color" value="<?php echo isset( $wtl_settings['pbar_track_color'] ) ? esc_attr( $wtl_settings['pbar_track_color'] ) : '#000000'; ?>"/>
								</div>
							</li>

							<li class="wtl-line-color-zigzag">
								<?php wtl_setting_left( esc_html__( 'Line Color', 'wp-timeline-designer-pro' ) ); ?>                                
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select Line color', 'wp-timeline-designer-pro' ); ?></span></span>
									<input type="text" name="template_line_color" id="template_line_color" value="<?php echo isset( $wtl_settings['template_line_color'] ) ? esc_attr( $wtl_settings['template_line_color'] ) : '#2d3033'; ?>"/>
								</div>
							</li>

							<li class="wtl-repetative-line-color1">
								<?php wtl_setting_left( esc_html__( 'Repetative Line Color 1', 'wp-timeline-designer-pro' ) ); ?>                                
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select Repetative Line color 1', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_repetative_line_color1 = ( isset( $wtl_settings['template_repetative_line_color1'] ) && ! empty( $wtl_settings['template_repetative_line_color1'] ) ) ? $wtl_settings['template_repetative_line_color1'] : '#9AA92A'; ?>
									<input type="text" name="template_repetative_line_color1" id="template_repetative_line_color1" value="<?php echo esc_attr( $template_repetative_line_color1 ); ?>"/>
								</div>
							</li>

							<li class="wtl-repetative-line-color2">
								<?php wtl_setting_left( esc_html__( 'Repetative Line Color 2', 'wp-timeline-designer-pro' ) ); ?>                                
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select Repetative Line color 2', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_repetative_line_color2 = ( isset( $wtl_settings['template_repetative_line_color2'] ) && ! empty( $wtl_settings['template_repetative_line_color2'] ) ) ? $wtl_settings['template_repetative_line_color2'] : '#35A3BE'; ?>
									<input type="text" name="template_repetative_line_color2" id="template_repetative_line_color2" value="<?php echo esc_attr( $template_repetative_line_color2 ); ?>"/>
								</div>
							</li>

							<li class="wtl-repetative-line-color3">
								<?php wtl_setting_left( esc_html__( 'Repetative Line Color 3', 'wp-timeline-designer-pro' ) ); ?>                                
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select Repetative Line color 3', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_repetative_line_color3 = ( isset( $wtl_settings['template_repetative_line_color3'] ) && ! empty( $wtl_settings['template_repetative_line_color3'] ) ) ? $wtl_settings['template_repetative_line_color3'] : '#913fe2'; ?>
									<input type="text" name="template_repetative_line_color3" id="template_repetative_line_color3" value="<?php echo esc_attr( $template_repetative_line_color3 ); ?>"/>
								</div>
							</li>

							<li class="wtl-repetative-line-color4">
								<?php wtl_setting_left( esc_html__( 'Repetative Line Color 4', 'wp-timeline-designer-pro' ) ); ?>                                
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select Repetative Line color 4', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_repetative_line_color4 = ( isset( $wtl_settings['template_repetative_line_color4'] ) && ! empty( $wtl_settings['template_repetative_line_color4'] ) ) ? $wtl_settings['template_repetative_line_color4'] : '#29a823'; ?>
									<input type="text" name="template_repetative_line_color4" id="template_repetative_line_color4" value="<?php echo esc_attr( $template_repetative_line_color4 ); ?>"/>
								</div>
							</li>

							<li class="wtl-repetative-line-color5">
								<?php wtl_setting_left( esc_html__( 'Repetative Line Color 5', 'wp-timeline-designer-pro' ) ); ?>                                
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select Repetative Line color 5', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_repetative_line_color5 = ( isset( $wtl_settings['template_repetative_line_color5'] ) && ! empty( $wtl_settings['template_repetative_line_color5'] ) ) ? $wtl_settings['template_repetative_line_color5'] : '#dd3333'; ?>
									<input type="text" name="template_repetative_line_color5" id="template_repetative_line_color5" value="<?php echo esc_attr( $template_repetative_line_color5 ); ?>"/>
								</div>
							</li>

							<li class="wp_timeline_shape_pl">
								<?php wtl_setting_left( esc_html__( 'Select Shape', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select Shape', 'wp-timeline-designer-pro' ); ?></span></span>
									<select id="wp_timeline_shape" name="wp_timeline_shape">
										<option value="round" <?php echo ( isset( $wtl_settings['wp_timeline_shape'] ) && 'round' == $wtl_settings['wp_timeline_shape'] ) ? 'selected="selected"' : ''; ?> ><?php esc_html_e( 'Round', 'wp-timeline-designer-pro' ); ?></option>
										<option value="square" <?php echo ( isset( $wtl_settings['wp_timeline_shape'] ) && 'square' === $wtl_settings['wp_timeline_shape'] ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Square', 'wp-timeline-designer-pro' ); ?></option>
									</select>
								</div>
							</li>
							<li class="wtl-navigation-background-color1">
								<?php wtl_setting_left( esc_html__( 'Navigation Background Color 1', 'wp-timeline-designer-pro' ) ); ?>                                
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select Navigation Background Color 1', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_navigation_background_color1 = ( isset( $wtl_settings['template_navigation_background_color1'] ) && ! empty( $wtl_settings['template_navigation_background_color1'] ) ) ? $wtl_settings['template_navigation_background_color1'] : '#39ACBD'; ?>
									<input type="text" name="template_navigation_background_color1" id="template_navigation_background_color1" value="<?php echo esc_attr( $template_navigation_background_color1 ); ?>"/>
								</div>
							</li>
							<li class="wtl-navigation-background-color2">
								<?php wtl_setting_left( esc_html__( 'Navigation Background Color 2', 'wp-timeline-designer-pro' ) ); ?>                                
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select Navigation Background Color 2', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_navigation_background_color2 = ( isset( $wtl_settings['template_navigation_background_color2'] ) && ! empty( $wtl_settings['template_navigation_background_color2'] ) ) ? $wtl_settings['template_navigation_background_color2'] : '#E9E566'; ?>
									<input type="text" name="template_navigation_background_color2" id="template_navigation_background_color2" value="<?php echo esc_attr( $template_navigation_background_color2 ); ?>"/>
								</div>
							</li>
							<li class="wtl-navigation-background-color3">
								<?php wtl_setting_left( esc_html__( 'Navigation Background Color 3', 'wp-timeline-designer-pro' ) ); ?>                                
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select Navigation Background Color 3', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_navigation_background_color3 = ( isset( $wtl_settings['template_navigation_background_color3'] ) && ! empty( $wtl_settings['template_navigation_background_color3'] ) ) ? $wtl_settings['template_navigation_background_color3'] : '#FFFFFF'; ?>
									<input type="text" name="template_navigation_background_color3" id="template_navigation_background_color3" value="<?php echo esc_attr( $template_navigation_background_color3 ); ?>"/>
								</div>
							</li>
							<li class="wtl-default-icon-bar-color">
								<?php wtl_setting_left( esc_html__( 'Default Icon & Bar Color', 'wp-timeline-designer-pro' ) ); ?>                                
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select Default Icon & Bar Color', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $default_icon_bar_color = ( isset( $wtl_settings['default_icon_bar_color'] ) && ! empty( $wtl_settings['default_icon_bar_color'] ) ) ? $wtl_settings['default_icon_bar_color'] : '#1e4f56'; ?>
									<input type="text" name="default_icon_bar_color" id="default_icon_bar_color" value="<?php echo esc_attr( $default_icon_bar_color ); ?>"/>
								</div>
							</li>
							<li class="wtl-navigation-color">
								<?php wtl_setting_left( esc_html__( 'Navigation Color', 'wp-timeline-designer-pro' ) ); ?>                                
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select Navigation Color', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $navigation_color = ( isset( $wtl_settings['navigation_color'] ) && ! empty( $wtl_settings['navigation_color'] ) ) ? $wtl_settings['navigation_color'] : '#1e4f56'; ?>
									<input type="text" name="navigation_color" id="navigation_color" value="<?php echo esc_attr( $navigation_color ); ?>"/>
								</div>
							</li>
							<li class="wtl-navigation-bg-color">
								<?php wtl_setting_left( esc_html__( 'Navigation Background Color', 'wp-timeline-designer-pro' ) ); ?>                                
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select Navigation Background Color', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $navigation_bg_color = ( isset( $wtl_settings['navigation_bg_color'] ) && ! empty( $wtl_settings['navigation_bg_color'] ) ) ? $wtl_settings['navigation_bg_color'] : '#1e4f56'; ?>
									<input type="text" name="navigation_bg_color" id="navigation_bg_color" value="<?php echo esc_attr( $navigation_bg_color ); ?>"/>
								</div>
							</li>
							<li class="wtl-navigation-arrow-size">
								<?php wtl_setting_left( esc_html__( 'Navigation Arrow Size (px)', 'wp-timeline-designer-pro' ) ); ?>								
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select Navigation Arrow Size', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php
									if ( isset( $wtl_settings['navigation_arrow_size'] ) && '' != $wtl_settings['navigation_arrow_size'] ) {
										$navigation_arrow_size = $wtl_settings['navigation_arrow_size'];
									} else {
										$navigation_arrow_size = 14;
									}
									?>
									<div class="grid_col_space range_slider_fontsize" id="template_navarrowsizeInput" data-value="<?php echo esc_attr( $navigation_arrow_size ); ?>"></div>
									<div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="navigation_arrow_size" id="navigation_arrow_size" value="<?php echo esc_attr( $navigation_arrow_size ); ?>"  /></div>
								</div>
							</li>

							<li class="display_year_timeline_side">
								<?php wtl_setting_left( esc_html__( 'Display Year Timeline on Side', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Display Year Timeline on Side', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $wp_year_timeline_side = isset( $wtl_settings['wp_year_timeline_side'] ) ? $wtl_settings['wp_year_timeline_side'] : '0'; ?>
									<fieldset class="buttonset ui-buttonset buttonset-hide" data-hide='1'>
										<input id="wp_year_timeline_side_1" name="wp_year_timeline_side" type="radio" value="1" <?php checked( 1, $wp_year_timeline_side ); ?> />
										<label id="wp-timeline-options-button" class="<?php echo esc_html( $uic_l ); ?>" for="wp_year_timeline_side_1" <?php checked( 1, $wp_year_timeline_side ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
										<input id="wp_year_timeline_side_0" name="wp_year_timeline_side" type="radio" value="0" <?php checked( 0, $wp_year_timeline_side ); ?> />
										<label id="wp-timeline-options-button" class="<?php echo esc_html( $uic_r ); ?>" for="wp_year_timeline_side_0" <?php checked( 0, $wp_year_timeline_side ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li> 
							<li class="display_year_timeline_left_right_side">
								<?php wtl_setting_left( esc_html__( 'Display Year Timeline on Left/Right Side', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Display Year Timeline on Left/Right Side', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $wp_year_timeline_left_right_side = isset( $wtl_settings['wp_year_timeline_left_right_side'] ) ? $wtl_settings['wp_year_timeline_left_right_side'] : '0'; ?>
									<fieldset class="buttonset ui-buttonset buttonset-hide" data-hide='1'>
										<input id="wp_year_timeline_left_right_side_1" name="wp_year_timeline_left_right_side" type="radio" value="1" <?php checked( 1, $wp_year_timeline_left_right_side ); ?> />
										<label id="wp-timeline-options-button" class="<?php echo esc_html( $uic_l ); ?>" for="wp_year_timeline_left_right_side_1" <?php checked( 1, $wp_year_timeline_left_right_side ); ?>><?php esc_html_e( 'Left', 'wp-timeline-designer-pro' ); ?></label>
										<input id="wp_year_timeline_left_right_side_0" name="wp_year_timeline_left_right_side" type="radio" value="0" <?php checked( 0, $wp_year_timeline_left_right_side ); ?> />
										<label id="wp-timeline-options-button" class="<?php echo esc_html( $uic_r ); ?>" for="wp_year_timeline_left_right_side_0" <?php checked( 0, $wp_year_timeline_left_right_side ); ?>><?php esc_html_e( 'Right', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>     

							<!-- Template Timeline Color -->
							<li class="temp-even-bg-color">
								<?php wtl_setting_left( esc_html__( 'Template Even Background Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select post template even background color', 'wp-timeline-designer-pro' ); ?></span></span>
									<input type="text" name="template_color2" id="template_color2" value="<?php echo isset( $wtl_settings['template_color2'] ) ? esc_attr( $wtl_settings['template_color2'] ) : '#2d3033'; ?>"/>
								</div>
							</li>

							<li class="temp-sportik-bg-color">
								<?php wtl_setting_left( esc_html__( 'Template Even Background Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select post template even background color', 'wp-timeline-designer-pro' ); ?></span></span>
									<input type="text" name="template_color2" id="template_color2" value="<?php echo isset( $wtl_settings['template_color2'] ) ? esc_attr( $wtl_settings['template_color2'] ) : '#2d3033'; ?>"/>
								</div>
							</li>

							<li class="temp-odd-bg-color">
								<?php wtl_setting_left( esc_html__( 'Template Odd Background Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select post template odd background color', 'wp-timeline-designer-pro' ); ?></span></span>
									<input type="text" name="template_color3" id="template_color3" value="<?php echo isset( $wtl_settings['template_color3'] ) ? esc_attr( $wtl_settings['template_color3'] ) : '#338754'; ?>"/>
								</div>
							</li>


							<li class="temp-even-color">
								<?php wtl_setting_left( esc_html__( 'Template Even Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select post template even color', 'wp-timeline-designer-pro' ); ?></span></span>
									<input type="text" name="template_color4" id="template_color4" value="<?php echo isset( $wtl_settings['template_color4'] ) ? esc_attr( $wtl_settings['template_color4'] ) : '#338754'; ?>"/>
								</div>
							</li>

							<li class="temp-odd-color">
								<?php wtl_setting_left( esc_html__( 'Template Odd Color', 'wp-timeline-designer-pro' ) ); ?>                                
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select post template odd color', 'wp-timeline-designer-pro' ); ?></span></span>
									<input type="text" name="template_color5" id="template_color5" value="<?php echo isset( $wtl_settings['template_color5'] ) ? esc_attr( $wtl_settings['template_color5'] ) : '#2d3033'; ?>"/>
								</div>
							</li>

							<li class="story-s-text">
								<?php wtl_setting_left( esc_html__( 'Story Startup Text', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enter timeline startup text', 'wp-timeline-designer-pro' ); ?></span></span>
									<input type="text" name="story_startup_text" id="story_startup_text" value="<?php echo isset( $wtl_settings['story_startup_text'] ) ? esc_attr( $wtl_settings['story_startup_text'] ) : ''; ?>" placeholder="<?php esc_attr_e( 'Timeline Startup Text', 'wp-timeline-designer-pro' ); ?>">
								</div>
							</li>
							<li class="story-e-text">
								<?php wtl_setting_left( esc_html__( 'Story Ending Text', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enter timeline ending text', 'wp-timeline-designer-pro' ); ?></span></span>
									<input type="text" name="story_ending_text" id="story_ending_text" value="<?php echo isset( $wtl_settings['story_ending_text'] ) ? esc_attr( $wtl_settings['story_ending_text'] ) : ''; ?>" placeholder="<?php esc_attr_e( 'Timeline Ending Text', 'wp-timeline-designer-pro' ); ?>">
								</div>
							</li>
							<li class="story-s-bg-color">
								<?php wtl_setting_left( esc_html__( 'Story Startup Background Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Story Startup Backgrund Color', 'wp-timeline-designer-pro' ); ?></span></span>
									<input type="text" name="story_start_bg_color" id="story_start_bg_color" value="<?php echo isset( $wtl_settings['story_start_bg_color'] ) ? esc_attr( $wtl_settings['story_start_bg_color'] ) : '#f75454'; ?>"/>
								</div>
							</li>

							<li class="story-s-text-color">
								<?php wtl_setting_left( esc_html__( 'Story Startup Text Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
										<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Story Startup Text Color', 'wp-timeline-designer-pro' ); ?></span></span>
										<input type="text" name="story_start_text_color" id="story_start_text_color" value="<?php echo isset( $wtl_settings['story_start_text_color'] ) ? esc_attr( $wtl_settings['story_start_text_color'] ) : '#ffffff'; ?>"/>
								</div>
							</li>
							<li class="story-end-bg-color">
								<?php wtl_setting_left( esc_html__( 'Story Ending Background Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Story Ending Background Color', 'wp-timeline-designer-pro' ); ?></span></span>
									<input type="text" name="story_ending_bg_color" id="story_ending_bg_color" value="<?php echo isset( $wtl_settings['story_ending_bg_color'] ) ? esc_attr( $wtl_settings['story_ending_bg_color'] ) : '#71a405'; ?>"/>
								</div>
							</li>

							<li class="story-end-text-color">
								<?php wtl_setting_left( esc_html__( 'Story Ending Text Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Story Ending Text Color', 'wp-timeline-designer-pro' ); ?></span></span>
									<input type="text" name="story_ending_text_color" id="story_ending_text_color" value="<?php echo isset( $wtl_settings['story_ending_text_color'] ) ? esc_attr( $wtl_settings['story_ending_text_color'] ) : '#ffffff'; ?>"/>
								</div>
							</li>

							<li class="hide_timeline_icon_tr">
								<?php wtl_setting_left( esc_html__( 'Hide Timeline Icon', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Show/Hide Timeline Icon', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $hide_timeline_icon = ( isset( $wtl_settings['hide_timeline_icon'] ) ) ? $wtl_settings['hide_timeline_icon'] : 0; ?>
									<fieldset class="buttonset ui-buttonset hide_timeline_icon">
										<input id="hide_timeline_icon_1" name="hide_timeline_icon" type="radio" value="1" <?php checked( 1, $hide_timeline_icon ); ?> />
										<label for="hide_timeline_icon_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $hide_timeline_icon ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
										<input id="hide_timeline_icon_0" name="hide_timeline_icon" type="radio" value="0" <?php checked( 0, $hide_timeline_icon ); ?> />
										<label for="hide_timeline_icon_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $hide_timeline_icon ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>

							<li class="wtl-post-timeline-icon">
								<div class="wtl-post-timeline-icon">
									<div class="wp-timeline-left"><label class="wp-timeline-key-title"> <?php esc_html_e( 'Post Timeline Icon Type', 'wp-timeline-designer-pro' ); ?></label></div>
									<div class="wp-timeline-right">
										<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Set Post Timeline Icon Type (Image or Font Icon)', 'wp-timeline-designer-pro' ); ?></span></span>
										<select name="wtl_single_display_timeline_icon" class="wtl_single_display_timeline_icon">
											<option value="fontawesome" 
											<?php
											$wtl_single_display_timeline_icon = isset( $wtl_settings['wtl_single_display_timeline_icon'] ) ? $wtl_settings['wtl_single_display_timeline_icon'] : '';
											if ( 'fontawesome' === $wtl_single_display_timeline_icon ) {
												echo 'selected=selected';
											}
											?>
											><?php esc_html_e( 'Font Awesome', 'wp-timeline-designer-pro' ); ?></option>
											<option value="image" 
											<?php
											if ( 'image' === $wtl_single_display_timeline_icon ) {
												echo 'selected=selected'; }
											?>
											><?php esc_html_e( 'Image', 'wp-timeline-designer-pro' ); ?></option>
										</select>
									</div>
								</div>
							</li>
							<li class="wtl-post-timeline-icon">
								<div class="wtl-option-timeline-icon-fontawesome">
									<div class="wp-timeline-left"><label class="wp-timeline-key-title"> <?php esc_html_e( 'Post Timeline Icon', 'wp-timeline-designer-pro' ); ?></label></div>
									<div class="wp-timeline-right wtl_single_icon_wrap">
										<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Set Post Timeline Icon', 'wp-timeline-designer-pro' ); ?></span></span>
										<?php $wtl_single_timeline_icon = isset( $wtl_settings['wtl_single_timeline_icon'] ) ? $wtl_settings['wtl_single_timeline_icon'] : ''; ?>
										<input class="icon-input" id="wtl_single_timeline_icon" name="wtl_single_timeline_icon" type="text" value="<?php echo esc_attr( $wtl_single_timeline_icon ); ?>">
										<a id="" class="open button button-primary"><?php esc_html_e( 'Select icon', 'wp-timeline-designer-pro' ); ?></a>
										<div id="dialogbox" class="dialogbox" title="<?php esc_html_e( 'Select Icon', 'wp-timeline-designer-pro' ); ?>" style="display:none">
											<input type="hidden" value="" name="" class="hidden_input_val"/>
											<input type="text" id="icon_search" placeholder="<?php esc_attr_e( 'Search icon', 'wp-timeline-designer-pro' ); ?>" style="margin-bottom:5px;">
											<div class="wtl_single_icon_div" id="wtl_single_icon_div"></div>
										</div>
									</div>
								</div>
								<div class="wtl-option-wrap wtl-option-timeline-icon-image">
									<div class="wtl-option-label"><label class="wtl-single-label"><?php esc_attr_e( 'Timeline Icon Image', 'wp-timeline-designer-pro' ); ?></label></div>
									<div class="wtl_option_wrap wtl-option-input">
										<span class="wtl_default_image_holder wtl_icon_image">
											<?php
											$wtl_icon_image_src = isset( $wtl_settings['wtl_icon_image_src'] ) ? $wtl_settings['wtl_icon_image_src'] : '';
											$wtl_icon_image_id  = isset( $wtl_settings['wtl_icon_image_id'] ) ? $wtl_settings['wtl_icon_image_id'] : '';
											if ( isset( $wtl_icon_image_src ) && '' !== $wtl_icon_image_src ) {
												echo '<img src="' . esc_attr( $wtl_icon_image_src ) . '"/>';
											}
											?>
										</span>
										<?php if ( isset( $wtl_icon_image_src ) && '' !== $wtl_icon_image_src ) { ?>
											<input id="wtl-image-action-button" class="button wtl_remove_image_button wtl_icon_image" type="button" value="<?php esc_attr_e( 'Remove Image', 'wp-timeline-designer-pro' ); ?>">
										<?php } else { ?>
											<input class="button wtl_single_upload_image_button wtl_icon_image" type="button" value="<?php esc_attr_e( 'Upload Image', 'wp-timeline-designer-pro' ); ?>">
										<?php } ?>
										<input type="hidden" value="<?php echo esc_attr( $wtl_icon_image_id ); ?>" name="wtl_icon_image_id" id="wtl_icon_image_id">
										<input type="hidden" value="<?php echo esc_attr( $wtl_icon_image_src ); ?>" name="wtl_icon_image_src" id="wtl_icon_image_src">
									</div>
								</div>
							</li>
							<li class="display_layout_type">
								<?php wtl_setting_left( esc_html__( 'Layout Type', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select Layout View Horizontal or Vertical', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $layout_type = isset( $wtl_settings['layout_type'] ) ? $wtl_settings['layout_type'] : '2'; ?>
									<fieldset class="wp-timeline-social-options wp-timeline-layout_type buttonset buttonset-hide ui-buttonset green">
										<input id="layout_type_1" name="layout_type" type="radio" value="1" <?php checked( 1, $layout_type ); ?> />
										<label id="wp-timeline-options-button" for="layout_type_1" <?php checked( 1, $layout_type ); ?>><?php esc_html_e( 'Horizontal Layout', 'wp-timeline-designer-pro' ); ?></label>
										<input id="layout_type_2" name="layout_type" type="radio" value="2" <?php checked( 2, $layout_type ); ?> />
										<label id="wp-timeline-options-button" for="layout_type_2" <?php checked( 2, $layout_type ); ?>><?php esc_html_e( 'Vertical Layout', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>                            
						</ul>
					</div>
				</div>
				<div id="wp_timeline_media" class="postbox postbox-with-fw-options" style='<?php echo esc_attr( $wp_timeline_media_class_show ); ?>'>
					<div class="inside">
						<ul class="wp-timeline-settings wp-timeline-lineheight">
							<li class="display_image_tr">
								<?php wtl_setting_left( esc_html__( 'Enable Media', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable post media', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $wp_timeline_enable_media = isset( $wtl_settings['wp_timeline_enable_media'] ) ? $wtl_settings['wp_timeline_enable_media'] : '1'; ?>
									<fieldset class="buttonset ui-buttonset buttonset-hide" data-hide='1'>
										<input id="wp_timeline_enable_media_1" name="wp_timeline_enable_media" type="radio" value="1" <?php checked( 1, $wp_timeline_enable_media ); ?> />
										<label id="wp-timeline-options-button" for="wp_timeline_enable_media_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $wp_timeline_enable_media ); ?>><?php esc_html_e( 'Enable', 'wp-timeline-designer-pro' ); ?></label>
										<input id="wp_timeline_enable_media_0" name="wp_timeline_enable_media" type="radio" value="0" <?php checked( 0, $wp_timeline_enable_media ); ?> />
										<label id="wp-timeline-options-button" for="wp_timeline_enable_media_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $wp_timeline_enable_media ); ?>><?php esc_html_e( 'Disable', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="display_image_tr wtl_mdsfild post_image_link_section_li">
								<?php wtl_setting_left( esc_html__( 'Post Image Link', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Show post image link', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $wp_timeline_post_image_link = isset( $wtl_settings['wp_timeline_post_image_link'] ) ? $wtl_settings['wp_timeline_post_image_link'] : '1'; ?>
									<fieldset class="buttonset ui-buttonset buttonset-hide" data-hide='1'>
										<input id="wp_timeline_post_image_link_1" name="wp_timeline_post_image_link" type="radio" value="1" <?php checked( 1, $wp_timeline_post_image_link ); ?> />
										<label id="wp-timeline-options-button" for="wp_timeline_post_image_link_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $wp_timeline_post_image_link ); ?>><?php esc_html_e( 'Enable', 'wp-timeline-designer-pro' ); ?></label>
										<input id="wp_timeline_post_image_link_0" name="wp_timeline_post_image_link" type="radio" value="0" <?php checked( 0, $wp_timeline_post_image_link ); ?> />
										<label id="wp-timeline-options-button" for="wp_timeline_post_image_link_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $wp_timeline_post_image_link ); ?>><?php esc_html_e( 'Disable', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="wp-timeline-image-hover-effect display_image_tr  wtl_mdsfild">
								<?php wtl_setting_left( esc_html__( 'Post Image Hover Effect', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable image hover effect', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $wp_timeline_image_hover_effect = isset( $wtl_settings['wp_timeline_image_hover_effect'] ) ? $wtl_settings['wp_timeline_image_hover_effect'] : '0'; ?>
									<fieldset class="buttonset ui-buttonset buttonset-hide" data-hide='1'>
										<input id="wp_timeline_image_hover_effect_1" name="wp_timeline_image_hover_effect" type="radio" value="1" <?php checked( 1, $wp_timeline_image_hover_effect ); ?> />
										<label id="wp-timeline-options-button" for="wp_timeline_image_hover_effect_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $wp_timeline_image_hover_effect ); ?>><?php esc_html_e( 'Enable', 'wp-timeline-designer-pro' ); ?></label>
										<input id="wp_timeline_image_hover_effect_0" name="wp_timeline_image_hover_effect" type="radio" value="0" <?php checked( 0, $wp_timeline_image_hover_effect ); ?> />
										<label id="wp-timeline-options-button" for="wp_timeline_image_hover_effect_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $wp_timeline_image_hover_effect ); ?>><?php esc_html_e( 'Disable', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="wp-timeline-image-hover-effect-tr wp-timeline-image-hover-effect display_image_tr wtl_mdsfild">
								<?php wtl_setting_left( esc_html__( 'Select Post Image Hover Effect', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select image hover effect', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $wp_timeline_image_hover_effect_type = isset( $wtl_settings['wp_timeline_image_hover_effect_type'] ) ? $wtl_settings['wp_timeline_image_hover_effect_type'] : 'zoom_in'; ?>
									<select name="wp_timeline_image_hover_effect_type" id="wp_timeline_image_hover_effect_type">
										<option value="blur" <?php echo ( 'blur' === $wp_timeline_image_hover_effect_type ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Blur', 'wp-timeline-designer-pro' ); ?></option>
										<option value="flashing" <?php echo ( 'flashing' === $wp_timeline_image_hover_effect_type ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Flashing', 'wp-timeline-designer-pro' ); ?></option>
										<option value="gray_scale" <?php echo ( 'gray_scale' === $wp_timeline_image_hover_effect_type ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Gray Scale', 'wp-timeline-designer-pro' ); ?></option>
										<option value="opacity" <?php echo ( 'opacity' === $wp_timeline_image_hover_effect_type ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Opacity', 'wp-timeline-designer-pro' ); ?></option>
										<option value="sepia" <?php echo ( 'sepia' === $wp_timeline_image_hover_effect_type ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Sepia', 'wp-timeline-designer-pro' ); ?></option>
										<option value="slide" <?php echo ( 'slide' === $wp_timeline_image_hover_effect_type ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Slide', 'wp-timeline-designer-pro' ); ?></option>
										<option value="shine" <?php echo ( 'shine' === $wp_timeline_image_hover_effect_type ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Shine', 'wp-timeline-designer-pro' ); ?></option>
										<option value="shine_circle" <?php echo ( 'shine_circle' === $wp_timeline_image_hover_effect_type ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Shine Circle', 'wp-timeline-designer-pro' ); ?></option>
										<option value="zoom_in" <?php echo ( 'zoom_in' === $wp_timeline_image_hover_effect_type ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Zoom In', 'wp-timeline-designer-pro' ); ?></option>
										<option value="zoom_out" <?php echo ( 'zoom_out' === $wp_timeline_image_hover_effect_type ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Zoom Out', 'wp-timeline-designer-pro' ); ?></option>
									</select>
								</div>
							</li>
							<li class="display_image_tr wtl_mdsfild">
								<?php wtl_setting_left( esc_html__( 'Select Post Default Image', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select post default image', 'wp-timeline-designer-pro' ); ?></span></span>
									<span class="wp_timeline_default_image_holder">
										<?php
										if ( isset( $wtl_settings['wp_timeline_default_image_src'] ) && '' != $wtl_settings['wp_timeline_default_image_src'] ) {
											echo '<img src="' . esc_url( $wtl_settings['wp_timeline_default_image_src'] ) . '"/>';
										}
										?>
									</span>
									<?php if ( isset( $wtl_settings['wp_timeline_default_image_src'] ) && '' != $wtl_settings['wp_timeline_default_image_src'] ) { ?>
										<input id="wp-timeline-image-action-button" class="button wp-timeline-remove_image_button" type="button" value="<?php esc_attr_e( 'Remove Image', 'wp-timeline-designer-pro' ); ?>">
									<?php } else { ?>
										<input class="button wp-timeline-upload_image_button" type="button" value="<?php esc_attr_e( 'Upload Image', 'wp-timeline-designer-pro' ); ?>">
									<?php } ?>
									<input type="hidden" value="<?php echo isset( $wtl_settings['wp_timeline_default_image_id'] ) ? esc_attr( $wtl_settings['wp_timeline_default_image_id'] ) : ''; ?>" name="wp_timeline_default_image_id" id="wp_timeline_default_image_id">
									<input type="hidden" value="<?php echo isset( $wtl_settings['wp_timeline_default_image_src'] ) ? esc_attr( $wtl_settings['wp_timeline_default_image_src'] ) : ''; ?>" name="wp_timeline_default_image_src" id="wp_timeline_default_image_src">
								</div>
							</li>
							<li class="wp_timeline_media_size_tr display_image_tr wtl_mdsfild">
								<?php wtl_setting_left( esc_html__( 'Select Post Media Size', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select size of post media', 'wp-timeline-designer-pro' ); ?></span></span>
									<select id="wp_timeline_media_size" name="wp_timeline_media_size">
										<option value="full" <?php echo ( isset( $wtl_settings['wp_timeline_media_size'] ) && 'full' == $wtl_settings['wp_timeline_media_size'] ) ? 'selected="selected"' : ''; ?> ><?php esc_html_e( 'Original Resolution', 'wp-timeline-designer-pro' ); ?></option>
										<?php
										global $_wp_additional_image_sizes;
										$thumb_sizes = array();
										$image_size  = get_intermediate_image_sizes();
										foreach ( $image_size as $img_s ) {
											$thumb_sizes [ $img_s ] = array( 0, 0 );
											if ( in_array( $img_s, array( 'thumbnail', 'medium', 'large' ), true ) ) {
												?>
												<option value="<?php echo esc_attr( $img_s ); ?>" <?php echo ( isset( $wtl_settings['wp_timeline_media_size'] ) && $wtl_settings['wp_timeline_media_size'] == $img_s ) ? 'selected="selected"' : ''; ?>> <?php echo esc_attr( $img_s ) . ' (' . esc_html( get_option( $img_s . '_size_w' ) ) . 'x' . esc_html( get_option( $img_s . '_size_h' ) ) . ')'; ?> </option>
												<?php
											} else {
												if ( isset( $_wp_additional_image_sizes ) && isset( $_wp_additional_image_sizes[ $img_s ] ) ) {
													?>
													<option value="<?php echo esc_attr( $img_s ); ?>" <?php echo ( isset( $wtl_settings['wp_timeline_media_size'] ) && $wtl_settings['wp_timeline_media_size'] == $img_s ) ? 'selected="selected"' : ''; ?>> <?php echo esc_html( $img_s ) . ' (' . esc_html( $_wp_additional_image_sizes[ $img_s ]['width'] ) . 'x' . esc_html( $_wp_additional_image_sizes[ $img_s ]['height'] ) . ')'; ?> </option>
													<?php
												}
											}
										}
										?>
										<option value="custom" <?php echo ( isset( $wtl_settings['wp_timeline_media_size'] ) && 'custom' === $wtl_settings['wp_timeline_media_size'] ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Custom Size', 'wp-timeline-designer-pro' ); ?></option>
									</select>
								</div>
							</li>
							<li class="wp_timeline_image_shape_zigzag">
								<?php wtl_setting_left( esc_html__( 'Select Image Shape', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select Shape of the Image', 'wp-timeline-designer-pro' ); ?></span></span>
									<select id="wp_timeline_image_shape" name="wp_timeline_image_shape">
										<option value="round" <?php echo ( isset( $wtl_settings['wp_timeline_image_shape'] ) && 'round' == $wtl_settings['wp_timeline_image_shape'] ) ? 'selected="selected"' : ''; ?> ><?php esc_html_e( 'Round', 'wp-timeline-designer-pro' ); ?></option>
										<option value="square" <?php echo ( isset( $wtl_settings['wp_timeline_image_shape'] ) && 'square' === $wtl_settings['wp_timeline_image_shape'] ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Square', 'wp-timeline-designer-pro' ); ?></option>
									</select>
								</div>
							</li>
							<li class="wp_timeline_media_custom_size_tr display_image_tr wtl_mdsfild">
								<?php wtl_setting_left( esc_html__( 'Add Custom Size', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enter custom size for post media', 'wp-timeline-designer-pro' ); ?></span></span>
									<div class="wp_timeline_media_custom_size_tbl">
										<p>
											<span class="wp_timeline_custom_media_size_title">
												<?php
												esc_html_e( 'Width', 'wp-timeline-designer-pro' );
												echo ' (px)';
												?>
											</span>
											<div class="input-type-number">
												<input type="number" min="1" name="media_custom_width" class="media_custom_width" id="media_custom_width" value="<?php echo ( isset( $wtl_settings['media_custom_width'] ) && '' != $wtl_settings['media_custom_width'] ) ? esc_attr( $wtl_settings['media_custom_width'] ) : ''; ?>" />
												<div class="input-type-number-nav">
													<div class="input-type-number-button input-type-number-up">+</div>
													<div class="input-type-number-button input-type-number-down">-</div>
												</div>
											</div>
										</p>
											<p>
												<span class="wp_timeline_custom_media_size_title">
													<?php
													esc_html_e( 'Height', 'wp-timeline-designer-pro' );
													echo ' (px)';
													?>
												</span>
												<div class="input-type-number">
													<input type="number" min="1" name="media_custom_height" class="media_custom_height" id="media_custom_height" value="<?php echo ( isset( $wtl_settings['media_custom_height'] ) && '' != $wtl_settings['media_custom_height'] ) ? esc_attr( $wtl_settings['media_custom_height'] ) : ''; ?>"/>
													<div class="input-type-number-nav">
														<div class="input-type-number-button input-type-number-up">+</div>
														<div class="input-type-number-button input-type-number-down">-</div>
													</div>
												</div>
											</p>
									</div>
								</div>
							</li>
							<li class="lazy_load_tr lazy_load_section_li">
								<?php wtl_setting_left( esc_html__( 'Enable Lazy Load Image', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable Lazy Load Image', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $wp_timeline_lazy_load_image = isset( $wtl_settings['wp_timeline_lazy_load_image'] ) ? $wtl_settings['wp_timeline_lazy_load_image'] : '1'; ?>
									<fieldset class="buttonset ui-buttonset buttonset-hide" data-hide='1'>
										<input id="wp_timeline_lazy_load_image_1" name="wp_timeline_lazy_load_image" type="radio" value="1" <?php checked( 1, $wp_timeline_lazy_load_image ); ?> />
										<label id="wp-timeline-options-button" for="wp_timeline_lazy_load_image_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $wp_timeline_lazy_load_image ); ?>><?php esc_html_e( 'Enable', 'wp-timeline-designer-pro' ); ?></label>
										<input id="wp_timeline_lazy_load_image_0" name="wp_timeline_lazy_load_image" type="radio" value="0" <?php checked( 0, $wp_timeline_lazy_load_image ); ?> />
										<label id="wp-timeline-options-button" for="wp_timeline_lazy_load_image_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $wp_timeline_lazy_load_image ); ?>><?php esc_html_e( 'Disable', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="lazy_load_blurred_tr lazy_load_blurred_section_li">
								<?php wtl_setting_left( esc_html__( 'Enable Lazy Load Blurred Image', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable Lazy Load Blurred Image', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $wp_timeline_lazy_load_blurred_image = isset( $wtl_settings['wp_timeline_lazy_load_blurred_image'] ) ? $wtl_settings['wp_timeline_lazy_load_blurred_image'] : '1'; ?>
									<fieldset class="buttonset ui-buttonset buttonset-hide" data-hide='1'>
										<input id="wp_timeline_lazy_load_blurred_image_1" name="wp_timeline_lazy_load_blurred_image" type="radio" value="1" <?php checked( 1, $wp_timeline_lazy_load_blurred_image ); ?> />
										<label id="wp-timeline-options-button" for="wp_timeline_lazy_load_blurred_image_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $wp_timeline_lazy_load_blurred_image ); ?>><?php esc_html_e( 'Enable', 'wp-timeline-designer-pro' ); ?></label>
										<input id="wp_timeline_lazy_load_blurred_image_0" name="wp_timeline_lazy_load_blurred_image" type="radio" value="0" <?php checked( 0, $wp_timeline_lazy_load_blurred_image ); ?> />
										<label id="wp-timeline-options-button" for="wp_timeline_lazy_load_blurred_image_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $wp_timeline_lazy_load_blurred_image ); ?>><?php esc_html_e( 'Disable', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="lazy_load_color_tr lazy_load_color_section_li">
								<?php wtl_setting_left( esc_html__( 'Select Lazy Load Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select lazy load color', 'wp-timeline-designer-pro' ); ?></span></span>
									<input type="text" name="template_lazyload_color" id="template_lazyload_color" value="
									<?php
									if ( isset( $wtl_settings['template_lazyload_color'] ) ) {
										echo esc_attr( $wtl_settings['template_lazyload_color'] );
									} else {
										echo '#000';
									}
									?>
									"/>
								</div>
							</li>
							<li class="lightbox_tr lightbox_section_li">
								<?php wtl_setting_left( esc_html__( 'Enable Lightbox', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable Lightbox', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $wp_timeline_lightbox = isset( $wtl_settings['wp_timeline_lightbox'] ) ? $wtl_settings['wp_timeline_lightbox'] : '1'; ?>
									<fieldset class="buttonset ui-buttonset buttonset-hide" data-hide='1'>
										<input id="wp_timeline_lightbox_1" name="wp_timeline_lightbox" type="radio" value="1" <?php checked( 1, $wp_timeline_lightbox ); ?> />
										<label id="wp-timeline-options-button" for="wp_timeline_lightbox_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $wp_timeline_lightbox ); ?>><?php esc_html_e( 'Enable', 'wp-timeline-designer-pro' ); ?></label>
										<input id="wp_timeline_lightbox_0" name="wp_timeline_lightbox" type="radio" value="0" <?php checked( 0, $wp_timeline_lightbox ); ?> />
										<label id="wp-timeline-options-button" for="wp_timeline_lightbox_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $wp_timeline_lightbox ); ?>><?php esc_html_e( 'Disable', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div id="wp_timeline_filter" class="postbox postbox-with-fw-options" style='<?php echo esc_attr( $wp_timeline_filter_class_show ); ?>'>
					<div class="inside">
						<ul class="wp-timeline-settings wp-timeline-lineheight">
							<li>
								<?php wtl_setting_left( esc_html__( 'Blog Posts within Time Period', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select time period of blog posts', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php
									$blog_time_period = 'all';
									if ( isset( $wtl_settings['blog_time_period'] ) ) {
										$blog_time_period = $wtl_settings['blog_time_period'];
									}
									?>
									<select id="blog_time_period" name="blog_time_period">
										<option value="all" <?php echo selected( 'all', $blog_time_period ); ?>><?php esc_html_e( 'All Dates', 'wp-timeline-designer-pro' ); ?></option>
										<option value="today" <?php echo selected( 'today', $blog_time_period ); ?>><?php esc_html_e( 'Today', 'wp-timeline-designer-pro' ); ?></option>
										<option value="tomorrow" <?php echo selected( 'tomorrow', $blog_time_period ); ?>><?php esc_html_e( 'Tomorrow', 'wp-timeline-designer-pro' ); ?></option>
										<option value="this_week" <?php echo selected( 'this_week', $blog_time_period ); ?>><?php esc_html_e( 'This Week', 'wp-timeline-designer-pro' ); ?></option>
										<option value="last_week" <?php echo selected( 'last_week', $blog_time_period ); ?>><?php esc_html_e( 'Last Week', 'wp-timeline-designer-pro' ); ?></option>
										<option value="next_week" <?php echo selected( 'next_week', $blog_time_period ); ?>><?php esc_html_e( 'Next Week', 'wp-timeline-designer-pro' ); ?></option>
										<option value="this_month" <?php echo selected( 'this_month', $blog_time_period ); ?>><?php esc_html_e( 'This Month', 'wp-timeline-designer-pro' ); ?></option>
										<option value="last_month" <?php echo selected( 'last_month', $blog_time_period ); ?>><?php esc_html_e( 'Last Month', 'wp-timeline-designer-pro' ); ?></option>
										<option value="next_month" <?php echo selected( 'next_month', $blog_time_period ); ?>><?php esc_html_e( 'Next Month', 'wp-timeline-designer-pro' ); ?></option>
										<option value="between_two_date" <?php echo selected( 'between_two_date', $blog_time_period ); ?>><?php esc_html_e( 'Between Two Dates', 'wp-timeline-designer-pro' ); ?></option>
										<option value="last_n_days" <?php echo selected( 'last_n_days', $blog_time_period ); ?>><?php esc_html_e( 'Last N Days', 'wp-timeline-designer-pro' ); ?></option>
										<option value="next_n_days" <?php echo selected( 'next_n_days', $blog_time_period ); ?>><?php esc_html_e( 'Next N Days', 'wp-timeline-designer-pro' ); ?></option>
									</select>
								</div>
							</li>

							<li class="wp_timeline_between_two_date">
								<?php wtl_setting_left( esc_html__( 'Select Date', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select date for timeline layout', 'wp-timeline-designer-pro' ); ?></span></span>
									<div>
										<div style="width:10%;display:inline-block;padding:24px 27px 21px 0"><?php esc_html_e( 'From', 'wp-timeline-designer-pro' ); ?></div>
										<div style="width:50%;display:inline-block;padding:24px 27px 21px 0">
											<input type="text"  name="between_two_date_from" id="between_two_date_from" value="<?php echo ( isset( $wtl_settings['between_two_date_from'] ) ) ? esc_attr( $wtl_settings['between_two_date_from'] ) : ''; ?>" />
										</div>
									</div>
									<div>
										<div style="width:10%;display:inline-block;padding:24px 27px 21px 0"><?php esc_html_e( 'To', 'wp-timeline-designer-pro' ); ?></div>
										<div style="width:50%;display:inline-block;padding:24px 27px 21px 0">
											<input type="text"  name="between_two_date_to" id="between_two_date_to" value="<?php echo ( isset( $wtl_settings['between_two_date_to'] ) ) ? esc_attr( $wtl_settings['between_two_date_to'] ) : ''; ?>"/>
										</div>
									</div>
								</div>
							</li>
							<li class="wp_timeline_time_period_days">
								<?php wtl_setting_left( esc_html__( 'Number of Days', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select number of days', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php
									if ( isset( $wtl_settings['wp_timeline_time_period_day'] ) ) {
										$wp_timeline_time_period_day = $wtl_settings['wp_timeline_time_period_day'];
									} else {
										$wp_timeline_time_period_day = 15;
									}
									?>
									<div class="grid_col_space range_slider_days" id="wp_timeline_time_period_dayInput" data-value="<?php echo esc_attr( $wp_timeline_time_period_day ); ?>"></div>
									<div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value_day" name="wp_timeline_time_period_day" id="wp_timeline_time_period_day" value="<?php echo esc_attr( $wp_timeline_time_period_day ); ?>"  /></div>
									<div class="wp-timeline-setting-description wp-timeline-note">
										<b class="note"><?php esc_html_e( 'Note', 'wp-timeline-designer-pro' ); ?>:</b>
										<?php esc_html_e( 'N Days will indicate the days after or before days.', 'wp-timeline-designer-pro' ); ?>
									</div>
								</div>
							</li>
							<li class="date_from_tr">
								<?php wtl_setting_left( esc_html__( 'Display Date', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select display post date', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php
									$display_date_from = isset( $wtl_settings['display_date_from'] ) ? $wtl_settings['display_date_from'] : 'publish';
									?>

									<select name="display_date_from" id="display_date_from">
										<option value="publish"  <?php echo selected( 'publish', $display_date_from ); ?>><?php esc_html_e( 'Publish Date', 'wp-timeline-designer-pro' ); ?></option>
										<option value="modify"  <?php echo selected( 'modify', $display_date_from ); ?>><?php esc_html_e( 'Last Modify Date', 'wp-timeline-designer-pro' ); ?></option>
									</select>
								</div>
							</li>
							<li class="post_date_format_tr">
								<?php wtl_setting_left( esc_html__( 'Date Format', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select post date format', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $post_date_format = isset( $wtl_settings['post_date_format'] ) ? $wtl_settings['post_date_format'] : 'default'; ?>
									<select name="post_date_format" id="post_date_format">
										<option value="default"  <?php echo esc_attr( selected( 'default', $post_date_format ) ); ?>>             <?php esc_html_e( 'Default', 'wp-timeline-designer-pro' ); ?></option>
										<option value="F j, Y g:i a" <?php echo esc_attr( selected( 'F j, Y g:i a', $post_date_format ) ); ?>>    <?php echo esc_html( gmdate( 'F j, Y g:i a' ) ); ?></option>
										<option value="F j, Y" <?php echo esc_attr( selected( 'F j, Y', $post_date_format ) ); ?>>                <?php echo esc_html( gmdate( 'F j, Y' ) ); ?></option>
										<option value="F, Y" <?php echo esc_attr( selected( 'F, Y', $post_date_format ) ); ?>>                    <?php echo esc_html( gmdate( 'F, Y' ) ); ?></option>                                        
										<option value="j F  Y" <?php echo esc_attr( selected( 'j F  Y', $post_date_format ) ); ?>>                <?php echo esc_html( gmdate( 'j F  Y' ) ); ?></option>
										<option value="j M, Y" <?php echo esc_attr( selected( 'j M, Y', $post_date_format ) ); ?>>                <?php echo esc_html( gmdate( 'j M, Y' ) ); ?></option>
										<option value="g:i a" <?php echo esc_attr( selected( 'g:i a', $post_date_format ) ); ?>>                  <?php echo esc_html( gmdate( 'g:i a' ) ); ?></option>
										<option value="g:i:s a" <?php echo esc_attr( selected( 'g:i:s a', $post_date_format ) ); ?>>              <?php echo esc_html( gmdate( 'g:i:s a' ) ); ?></option>
										<option value="l, F jS, Y" <?php echo esc_attr( selected( 'l, F jS, Y', $post_date_format ) ); ?>>        <?php echo esc_html( gmdate( 'l, F jS, Y' ) ); ?></option>
										<option value="M j, Y @ G:i" <?php echo esc_attr( selected( 'M j, Y @ G:i', $post_date_format ) ); ?>>    <?php echo esc_html( gmdate( 'M j, Y @ G:i' ) ); ?></option>
										<option value="Y/m/d g:i:s A" <?php echo esc_attr( selected( 'Y/m/d g:i:s A', $post_date_format ) ); ?>>  <?php echo esc_html( gmdate( 'Y/m/d g:i:s A' ) ); ?></option>
										<option value="Y/m/d" <?php echo esc_attr( selected( 'Y/m/d', $post_date_format ) ); ?>>                  <?php echo esc_html( gmdate( 'Y/m/d' ) ); ?></option>
										<option value="d.m.Y" <?php echo esc_attr( selected( 'd.m.Y', $post_date_format ) ); ?>>                  <?php echo esc_html( gmdate( 'd.m.Y' ) ); ?></option>
										<option value="d-m-Y" <?php echo esc_attr( selected( 'd-m-Y', $post_date_format ) ); ?>>                 <?php echo esc_html( gmdate( 'd-m-Y' ) ); ?></option>
										<option value="d M Y" <?php echo esc_attr( selected( 'd M Y', $post_date_format ) ); ?>>                 <?php echo esc_html( gmdate( 'd M Y' ) ); ?></option>
									</select>
								</div>
							</li>

							<li class="wtl_blog_order_by">
								<?php wtl_setting_left( esc_html__( 'Blog Order by', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select order for blog', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php
									$blog_orderby = '';
									if ( isset( $wtl_settings['wp_timeline_blog_order_by'] ) ) {
										$blog_orderby = $wtl_settings['wp_timeline_blog_order_by'];
									}
									?>
									<select id="wp_timeline_blog_order_by" name="wp_timeline_blog_order_by">
										<option value="rand" <?php echo selected( 'rand', $blog_orderby ); ?>><?php esc_html_e( 'Random', 'wp-timeline-designer-pro' ); ?></option>
										<option value="ID" <?php echo selected( 'ID', $blog_orderby ); ?>><?php esc_html_e( 'Post ID', 'wp-timeline-designer-pro' ); ?></option>
										<option value="author" <?php echo selected( 'author', $blog_orderby ); ?>><?php esc_html_e( 'Author', 'wp-timeline-designer-pro' ); ?></option>
										<option value="title" <?php echo selected( 'title', $blog_orderby ); ?>><?php esc_html_e( 'Post Title', 'wp-timeline-designer-pro' ); ?></option>
										<option value="name" <?php echo selected( 'name', $blog_orderby ); ?>><?php esc_html_e( 'Post Slug', 'wp-timeline-designer-pro' ); ?></option>
										<option value="date" <?php echo selected( 'date', $blog_orderby ); ?>><?php esc_html_e( 'Publish Date', 'wp-timeline-designer-pro' ); ?></option>
										<option value="modified" <?php echo selected( 'modified', $blog_orderby ); ?>><?php esc_html_e( 'Modified Date', 'wp-timeline-designer-pro' ); ?></option>
									</select>
									<div class="blg_order">
										<?php
										$blog_order = 'DESC';
										if ( isset( $wtl_settings['wp_timeline_blog_order'] ) ) {
											$blog_order = $wtl_settings['wp_timeline_blog_order'];
										}
										?>
										<fieldset class="buttonset ui-buttonset green" data-hide='1'>
											<input id="wp_timeline_blog_order_asc" name="wp_timeline_blog_order" type="radio" value="ASC" <?php checked( 'ASC', $blog_order ); ?> />
											<label id="wp-timeline-options-button" for="wp_timeline_blog_order_asc"><?php esc_html_e( 'Ascending', 'wp-timeline-designer-pro' ); ?></label>
											<input id="wp_timeline_blog_order_desc" name="wp_timeline_blog_order" type="radio" value="DESC" <?php checked( 'DESC', $blog_order ); ?> />
											<label id="wp-timeline-options-button" for="wp_timeline_blog_order_desc"><?php esc_html_e( 'Descending', 'wp-timeline-designer-pro' ); ?></label>
										</fieldset>
									</div>
								</div>
							</li>
							<li class="wp_timeline_post_status">
								<?php wtl_setting_left( esc_html__( 'Post Status', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select post status blog', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $post_status = isset( $wtl_settings['wp_timeline_post_status'] ) ? $wtl_settings['wp_timeline_post_status'] : 'publish'; ?>
									<select id="wp_timeline_post_status" name="wp_timeline_post_status">
										<option value="publish" <?php echo selected( 'publish', $post_status ); ?>><?php esc_html_e( 'Publish', 'wp-timeline-designer-pro' ); ?></option>
										<option value="pending" <?php echo selected( 'pending', $post_status ); ?>><?php esc_html_e( 'Pending', 'wp-timeline-designer-pro' ); ?></option>
										<option value="draft" <?php echo selected( 'draft', $post_status ); ?>><?php esc_html_e( 'Draft', 'wp-timeline-designer-pro' ); ?></option>
										<option value="auto-draft" <?php echo selected( 'auto-draft', $post_status ); ?>><?php esc_html_e( 'Auto Draft', 'wp-timeline-designer-pro' ); ?></option>
										<option value="future" <?php echo selected( 'future', $post_status ); ?>><?php esc_html_e( 'Future', 'wp-timeline-designer-pro' ); ?></option>
										<option value="private" <?php echo selected( 'private', $post_status ); ?>><?php esc_html_e( 'Private', 'wp-timeline-designer-pro' ); ?></option>
										<option value="inherit" <?php echo selected( 'inherit', $post_status ); ?>><?php esc_html_e( 'Inherit', 'wp-timeline-designer-pro' ); ?></option>
										<option value="trash" <?php echo selected( 'trash', $post_status ); ?>><?php esc_html_e( 'Trash', 'wp-timeline-designer-pro' ); ?></option>
									</select>
								</div>
							</li>
							<li class="wtl-post-category">
								<?php wtl_setting_left( esc_html__( 'Select Post Categories', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-select"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Filter post via category', 'wp-timeline-designer-pro' ); ?></span></span>                                    
									<?php
									$categories = get_categories(
										array(
											'child_of'   => '',
											'hide_empty' => 1,
										)
									);
									?>
									<select data-placeholder="<?php esc_attr_e( 'Choose Post Categories', 'wp-timeline-designer-pro' ); ?>" class="chosen-select" multiple style="width:220px;" name="template_category[]" id="template_category">
										<?php foreach ( $categories as $category_object ) : ?>
											<option value="<?php echo esc_attr( $category_object->term_id ); ?>" 
												<?php
												if ( isset( $wtl_settings['template_category'] ) ) {
													if ( in_array( $category_object->term_id, $wtl_settings['template_category'] ) ) {
														echo 'selected="selected"';
													}
												}
												?>
											>
											<?php echo esc_html( $category_object->name ); ?>
										</option>
									<?php endforeach; ?>
									</select>
									<div class="exclude_category_list_div">
										<label>
											<input id="exclude_category_list" name="exclude_category_list" type="checkbox" value="1" 
											<?php
											if ( isset( $wtl_settings['exclude_category_list'] ) ) {
												checked( 1, $wtl_settings['exclude_category_list'] );
											}
											?>
											/> <?php esc_html_e( 'Exclude Selected Category', 'wp-timeline-designer-pro' ); ?>
										</label>
									</div>
								</div>
							</li>
							<li class="post-tag wtl-post-tag-settings">
								<?php wtl_setting_left( esc_html__( 'Select Post Tags', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-select"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Filter post via tags', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $tags = get_tags(); ?>
									<select data-placeholder="<?php esc_attr_e( 'Choose Post Tags', 'wp-timeline-designer-pro' ); ?>" class="chosen-select" multiple style="width:220px;" name="template_tags[]" id="template_tags">
										<?php foreach ( $tags as $tag_data ) : ?>
											<option value="<?php echo esc_attr( $tag_data->term_id ); ?>" 
												<?php
												if ( isset( $wtl_settings['template_tags'] ) ) {
													if ( in_array( $tag_data->term_id, $wtl_settings['template_tags'] ) ) {
														echo 'selected="selected"';
													}
												}
												?>
											><?php echo esc_html( $tag_data->name ); ?></option>
												<?php endforeach; ?>
									</select>
									<div class="exclude_tag_list_div">
										<label>
											<input id="exclude_tag_list" name="exclude_tag_list" type="checkbox" value="1" 
											<?php
											if ( isset( $wtl_settings['exclude_tag_list'] ) ) {
												checked( 1, $wtl_settings['exclude_tag_list'] );
											}
											?>
											/> <?php esc_html_e( 'Exclude Selected Tag', 'wp-timeline-designer-pro' ); ?>
										</label>
									</div>
								</div>
							</li>
							<?php
							$custom_posttype = $wtl_settings['custom_post_type'];
							if ( 'post' !== $custom_posttype ) {
								$taxonomy_names = get_object_taxonomies( $custom_posttype, 'objects' );
								$taxonomy_names = apply_filters( 'wp_timeline_hide_taxonomies', $taxonomy_names );
								if ( ! empty( $taxonomy_names ) ) {
									foreach ( $taxonomy_names as $taxonomy_name ) {
										$terms = get_terms(
											$taxonomy_name->name,
											array(
												'hide_empty' => false,
											)
										);
										if ( ! empty( $terms ) ) {
											?>
											<li class="wp-timeline-post-terms">
												<div class="wp-timeline-left"><span class="wp-timeline-key-title">
												<?php
												echo esc_html__( 'Select', 'wp-timeline-designer-pro' ) . ' ' . esc_html( $taxonomy_name->label );
												?>
												</span></div>
												<div class="wp-timeline-right">
													<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-select"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Filter post via', 'wp-timeline-designer-pro' ) . ' ' . $taxonomy_name->label; ?></span></span>
													<select data-placeholder="Choose <?php echo esc_attr( $taxonomy_name->label ); ?>" multiple style="width:220px;" class="chosen-select custom_post_term" name="<?php echo esc_attr( $taxonomy_name->name ); ?>_terms[]" id="terms_<?php echo esc_attr( $taxonomy_name->name ); ?>" data-name="<?php echo esc_attr( $taxonomy_name->name ); ?>">
													<?php
													foreach ( $terms as $tterm ) {
														if ( isset( $wtl_settings[ $taxonomy_name->name . '_terms' ] ) ) {
															$tax_name_count = count( $wtl_settings[ $taxonomy_name->name . '_terms' ] );
															for ( $i = 0; $i < $tax_name_count; $i++ ) {
																if ( $tterm->name == $wtl_settings[ $taxonomy_name->name . '_terms' ][ $i ] ) {
																	$selected_tax = 'selected=selected';
																} else {
																	$selected_tax = '';
																}
															}
														} else {
															$selected_tax = '';
														}
														echo '<option value="' . esc_attr( $tterm->name ) . '" ' . esc_attr( $selected_tax ) . '>' . esc_html( $tterm->name ) . '</option>';
													}
													?>
													</select>
													<div class="exclude_tag_list_div">
														<label>
															<input id="exclude_<?php echo esc_attr( $taxonomy_name->name ); ?>_list" name="exclude_<?php echo esc_attr( $taxonomy_name->name ); ?>_list" type="checkbox" value="1" 
															<?php
															if ( isset( $wtl_settings[ 'exclude_' . $taxonomy_name->name . '_list' ] ) ) {
																checked( 1, $wtl_settings[ 'exclude_' . $taxonomy_name->name . '_list' ] );
															}
															?>
															/>
															<?php esc_html_e( 'Exclude Selected ', 'wp-timeline-designer-pro' ) . $taxonomy_name->label; ?>
														</label>
													</div>
												</div>
											</li>
											<?php
										}
									}
								}
							}
							?>
							<li class="wp_timeline_post_li">
								<?php wtl_setting_left( esc_html__( 'Select Posts', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-select"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select posts from available posts', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $custom_posttype = $wtl_settings['custom_post_type']; ?>
									<select name="wp_timeline_filter_post[]" id="wp_timeline_filter_post" class="chosen-select" data-placeholder="Choose Posts" multiple>
										<?php
										$args      = array(
											'post_type' => $custom_posttype,
											'posts_per_page' => -1,
										);
										$the_query = new WP_Query( $args );
										if ( $the_query->have_posts() ) {
											while ( $the_query->have_posts() ) {
												$the_query->the_post();
												?>
												<option value="<?php echo esc_attr( get_the_ID() ); ?>" <?php echo ( ! empty( $wtl_settings['wp_timeline_filter_post'] ) && in_array( get_the_ID(), $wtl_settings['wp_timeline_filter_post'] ) ) ? 'selected="selected"' : ''; ?>><?php echo esc_html( get_the_title() ); ?></option> 
												<?php
											}
										}
										?>
									</select>
									<div class="exclude_tag_list_div">
										<label>
											<input id="exclude_post_list" name="exclude_post_list" type="checkbox" value="1" 
											<?php
											if ( isset( $wtl_settings['exclude_post_list'] ) ) {
												checked( 1, $wtl_settings['exclude_post_list'] );
											}
											?>
											/>
											<?php esc_html_e( 'Exclude Selected Post', 'wp-timeline-designer-pro' ); ?>
										</label>
									</div>
									<div class="wp-timeline-setting-description wp-timeline-note">
										<b class="note"><?php esc_html_e( 'Note', 'wp-timeline-designer-pro' ); ?>:</b>
										<?php esc_html_e( 'If select post, then displays selected post. Leave blank to display all posts.', 'wp-timeline-designer-pro' ); ?>
									</div>
								</div>
							</li>
							<li class="wp-timeline-post-authors-list">
								<?php wtl_setting_left( esc_html__( 'Select Post Authors', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-select"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Filter post via authors', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $blogusers = get_users( 'orderby=nicename&order=asc' ); ?>
									<select data-placeholder="<?php esc_attr_e( 'Choose Post authors', 'wp-timeline-designer-pro' ); ?>" class="chosen-select" multiple style="width:220px;" name="template_authors[]" id="template_authors">
										<?php foreach ( $blogusers as $user ) : ?>
											<option value="<?php echo esc_attr( $user->ID ); ?>" 
												<?php
												if ( isset( $wtl_settings['template_authors'] ) ) {
													if ( in_array( $user->ID, $wtl_settings['template_authors'] ) ) {
														echo 'selected="selected"';
													}
												}

												?>
											><?php echo esc_html( $user->display_name );
											?></option>
												<?php endforeach; ?>
									</select>
									<div class="exclude_tag_list_div">
										<label>
											<input id="exclude_author_list" name="exclude_author_list" type="checkbox" value="1" 
											<?php
											if ( isset( $wtl_settings['exclude_author_list'] ) ) {
												checked( 1, $wtl_settings['exclude_author_list'] );
											}
											?>
											/> <?php esc_html_e( 'Exclude Selected Author', 'wp-timeline-designer-pro' ); ?>
										</label>
									</div>
								</div>
							</li>
							<li class="wp-timeline-post-sortby">
								<?php wtl_setting_left( esc_html__( 'Display Sort-by', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable sort-by option in front side', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php
									$wp_timeline_display_sort_by = 0;
									if ( isset( $wtl_settings['wp_timeline_display_sort_by'] ) ) {
										$wp_timeline_display_sort_by = $wtl_settings['wp_timeline_display_sort_by'];
									}
									?>
									<fieldset class="wp-timeline-social-options buttonset ui-buttonset">
										<input id="wp_timeline_display_sort_by_1" name="wp_timeline_display_sort_by" type="radio" value="1" <?php echo checked( 1, $wp_timeline_display_sort_by ); ?> />
										<label for="wp_timeline_display_sort_by_1" class="<?php echo esc_html( $uic_l ); ?>"><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
										<input id="wp_timeline_display_sort_by_0" name="wp_timeline_display_sort_by" type="radio" value="0" <?php echo checked( 0, $wp_timeline_display_sort_by ); ?> />
										<label for="wp_timeline_display_sort_by_0" class="<?php echo esc_html( $uic_r ); ?>"><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="wp_timeline_sort_by_front">
								<?php wtl_setting_left( esc_html__( 'Select Sort By', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-select"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select parameter to sort posts for display front side.', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php
									$wp_timeline_display_front_sortby = array();
									if ( isset( $wtl_settings['wp_timeline_display_front_sortby'] ) ) {
										$wp_timeline_display_front_sortby = $wtl_settings['wp_timeline_display_front_sortby'];
									}
									?>
									<select id="wp_timeline_display_front_sortby" name="wp_timeline_display_front_sortby[]" multiple style="width:220px">
										<option value="rand" <?php echo ( in_array( 'rand', $wp_timeline_display_front_sortby, true ) ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Random', 'wp-timeline-designer-pro' ); ?></option>
										<option value="ID" <?php echo ( in_array( 'ID', $wp_timeline_display_front_sortby, true ) ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Post ID', 'wp-timeline-designer-pro' ); ?></option>
										<option value="author" <?php echo ( in_array( 'author', $wp_timeline_display_front_sortby, true ) ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Author', 'wp-timeline-designer-pro' ); ?></option>
										<option value="title" <?php echo ( in_array( 'title', $wp_timeline_display_front_sortby, true ) ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Post Title', 'wp-timeline-designer-pro' ); ?></option>
										<option value="name" <?php echo ( in_array( 'name', $wp_timeline_display_front_sortby, true ) ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Post Slug', 'wp-timeline-designer-pro' ); ?></option>
										<option value="date" <?php echo ( in_array( 'date', $wp_timeline_display_front_sortby, true ) ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Publish Date', 'wp-timeline-designer-pro' ); ?></option>
										<option value="modified" <?php echo ( in_array( 'modified', $wp_timeline_display_front_sortby, true ) ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Modified Date', 'wp-timeline-designer-pro' ); ?></option>
									</select>
								</div>
							</li>
							<li class="advance_filter_settings">
								<?php wtl_setting_left( esc_html__( 'Advance Post Filter?', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable advance post filter option', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php
									$advance_filter = 0;
									if ( isset( $wtl_settings['advance_filter'] ) ) {
										$advance_filter = $wtl_settings['advance_filter'];
									}
									?>
									<fieldset class="wp-timeline-social-options buttonset ui-buttonset">
										<input id="advance_filter_1" name="advance_filter" type="radio" value="1" <?php echo checked( 1, $advance_filter ); ?> />
										<label for="advance_filter_1" class="<?php echo esc_html( $uic_l ); ?>"><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
										<input id="advance_filter_0" name="advance_filter" type="radio" value="0" <?php echo checked( 0, $advance_filter ); ?> />
										<label for="advance_filter_0" class="<?php echo esc_html( $uic_r ); ?>"><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="advance_filter_option">
								<div class="wp-timeline-left">
									<span class="wp-timeline-key-title">
										<?php esc_html_e( 'Post Filter between', 'wp-timeline-designer-pro' ); ?>
										<br/>
										<?php esc_html_e( 'Categories and Tags', 'wp-timeline-designer-pro' ); ?>
									</span>
								</div>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select post filter between categories and tags', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php
									$tax_filter_with = 0;
									if ( isset( $wtl_settings['tax_filter_with'] ) ) {
										$tax_filter_with = $wtl_settings['tax_filter_with'];
									}
									?>
									<fieldset class="buttonset ui-buttonset green">
										<input id="tax_filter_with_0" name="tax_filter_with" type="radio" value="0" <?php echo checked( 0, $tax_filter_with ); ?> />
										<label id="wp-timeline-options-button" for="tax_filter_with_0"><?php esc_html_e( 'Categories OR Tags', 'wp-timeline-designer-pro' ); ?></label>
										<input id="tax_filter_with_1" name="tax_filter_with" type="radio" value="1" <?php echo checked( 1, $tax_filter_with ); ?> />
										<label id="wp-timeline-options-button" for="tax_filter_with_1"><?php esc_html_e( 'Categories AND Tags', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="advance_filter_option">
								<?php wtl_setting_left( esc_html__( 'Post Filter Author by', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select post filter author by ', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php
									$author_filter_with = 0;
									if ( isset( $wtl_settings['author_filter_with'] ) ) {
										$author_filter_with = $wtl_settings['author_filter_with'];
									}
									?>
									<fieldset class="buttonset ui-buttonset green">
										<input id="author_filter_with_0" name="author_filter_with" type="radio" value="0" <?php echo checked( 0, $author_filter_with ); ?> />
										<label id="wp-timeline-options-button" for="author_filter_with_0"><?php esc_html_e( 'OR Author', 'wp-timeline-designer-pro' ); ?></label>
										<input id="author_filter_with_1" name="author_filter_with" type="radio" value="1" <?php echo checked( 1, $author_filter_with ); ?> />
										<label id="wp-timeline-options-button" for="author_filter_with_1"><?php esc_html_e( 'AND Author', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="wp-timeline-post-sticky">
								<?php wtl_setting_left( esc_html__( 'Show Sticky Post', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Show sticky post', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php
									$display_sticky = 0;
									if ( isset( $wtl_settings['display_sticky'] ) ) {
										$display_sticky = $wtl_settings['display_sticky'];
									}
									?>
									<fieldset class="wp-timeline-social-options wp-timeline-display_sticky buttonset ui-buttonset">
										<input id="display_sticky_1" name="display_sticky" type="radio" value="1" <?php echo checked( 1, $display_sticky ); ?> />
										<label for="display_sticky_1" class="<?php echo esc_html( $uic_l ); ?>"><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
										<input id="display_sticky_0" name="display_sticky" type="radio" value="0" <?php echo checked( 0, $display_sticky ); ?> />
										<label for="display_sticky_0" class="<?php echo esc_html( $uic_r ); ?>"><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
									<div class="wp-timeline-setting-description wp-timeline-note">
										<b class="note"><?php esc_html_e( 'Note', 'wp-timeline-designer-pro' ); ?>:</b>
										<?php esc_html_e( 'Sticky Post not count in the number of post to be displayed in timeline layout page.', 'wp-timeline-designer-pro' ); ?>
									</div>
								</div>
							</li>
							<li class="wp-timeline-post-sticky">
								<?php wtl_setting_left( esc_html__( 'Label for featured posts', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enter text for featured post label', 'wp-timeline-designer-pro' ); ?></span></span>
									<input type="text" name="label_featured_post" id="label_featured_post" value="<?php echo ( isset( $wtl_settings['label_featured_post'] ) ? esc_attr( $wtl_settings['label_featured_post'] ) : '' ); ?>" placeholder="<?php esc_attr_e( 'Enter Label Text', 'wp-timeline-designer-pro' ); ?>">
									<div class="wp-timeline-setting-description wp-timeline-note">
										<b class="note"><?php esc_html_e( 'Note', 'wp-timeline-designer-pro' ); ?>:</b>
										<?php esc_html_e( 'Leave blank for disable label.', 'wp-timeline-designer-pro' ); ?>
									</div>
								</div>
							</li>

						</ul>
					</div>
				</div>
				<div id="wp_timeline" class="postbox postbox-with-fw-options" style='<?php echo esc_attr( $wp_timeline_class_show ); ?>'>
					<div class="inside">
						<ul class="wp-timeline-settings">
							<li class="wtl_hz_ts wtl_hz_ts_1">
								<?php wtl_setting_left( esc_html__( 'Display Timeline Bar', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Display timeline bar on timeline layout', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $display_timeline_bar = isset( $wtl_settings['display_timeline_bar'] ) ? $wtl_settings['display_timeline_bar'] : ''; ?>
									<fieldset class="wp-timeline-social-options wp-timeline-display_timeline_bar buttonset buttonset-hide ui-buttonset" data-hide="1">
										<input id="display_timeline_bar_0" name="display_timeline_bar" class="display_timeline_bar" type="radio" value="0" <?php checked( 0, $display_timeline_bar ); ?> />
										<label for="display_timeline_bar_0" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 0, $display_timeline_bar ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
										<input id="display_timeline_bar_1" name="display_timeline_bar" class="display_timeline_bar" type="radio" value="1" <?php checked( 1, $display_timeline_bar ); ?> />
										<label for="display_timeline_bar_1" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 1, $display_timeline_bar ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="wtl_hz_ts wtl_hz_ts_2">
								<?php wtl_setting_left( esc_html__( 'Active Post', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right active_post_list">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select post to start timeline layout with some specific post', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php
									$timeline_start_from = ( isset( $wtl_settings['timeline_start_from'] ) && '' != $wtl_settings['timeline_start_from'] ) ? $wtl_settings['timeline_start_from'] : '';
									$post_type_hori      = isset( $wtl_settings['custom_post_type'] ) ? $wtl_settings['custom_post_type'] : 'post';
									global $post;
									$wtl_timeline_args      = array(
										'cache_results' => false,
										'no_found_rows' => true,
										'showposts'     => '-1',
										'orderby'       => 'post_date',
										'order'         => 'ASC',
										'post_status'   => 'publish',
										'post_type'     => $post_type_hori,
									);
									$wtl_timeline_the_query = get_posts( $wtl_timeline_args );
									if ( $wtl_timeline_the_query ) {
										echo '<select name="timeline_start_from" id="timeline_start_from">';
										foreach ( $wtl_timeline_the_query as $post_qry ) {
											setup_postdata( $post_qry );
											$post__id = $post_qry->ID;
											?>
											<option value="<?php echo esc_attr( get_the_date( 'd/m/Y', $post__id ) ); ?>" <?php echo ( get_the_date( 'd/m/Y', $post__id ) ) == $timeline_start_from ? 'selected="selected"' : ''; ?>><?php echo esc_html( $post_qry->post_title ); ?></option>
											<?php
										}
										wp_reset_postdata();
										echo '</select>';
									} else {
										echo '<p>';
										esc_html__( 'No posts found', 'wp-timeline-designer-pro' );
										echo '</p>';
									}
									?>
								</div>
							</li>
							<li class="wtl_hz_ts wtl_hz_ts_3">
								<?php wtl_setting_left( esc_html__( 'Posts Effect', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select the transition effect for timeline layout', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_easing = isset( $wtl_settings['template_easing'] ) ? $wtl_settings['template_easing'] : 'easeInQuad'; ?>
									<select name="template_easing" id="template_easing">
										<option value="easeInQuad" <?php echo 'easeInQuad' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInQuad', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeOutQuad" <?php echo 'easeOutQuad' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeOutQuad', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeInOutQuad" <?php echo 'easeInOutQuad' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInOutQuad', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeInCubic" <?php echo 'easeInCubic' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInCubic', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeOutCubic" <?php echo 'easeInCubic' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInCubic', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeInOutCubic" <?php echo 'easeInOutCubic' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInOutCubic', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeInQuart" <?php echo 'easeInQuart' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInQuart', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeOutQuart" <?php echo 'easeOutQuart' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeOutQuart', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeInOutQuart" <?php echo 'easeInOutQuart' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInOutQuart', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeInQuint" <?php echo 'easeInQuint' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInQuint', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeOutQuint" <?php echo 'easeOutQuint' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeOutQuint', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeInOutQuint" <?php echo 'easeInOutQuint' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInOutQuint', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeInSine" <?php echo 'easeInSine' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInSine', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeOutSine" <?php echo 'easeOutSine' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeOutSine', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeInOutSine" <?php echo 'easeInOutSine' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInOutSine', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeInExpo" <?php echo 'easeInExpo' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInExpo', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeOutExpo" <?php echo 'easeOutExpo' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeOutExpo', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeInOutExpo" <?php echo 'easeInOutExpo' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInOutExpo', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeInCirc" <?php echo 'easeInCirc' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInCirc', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeOutCirc" <?php echo 'easeOutCirc' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeOutCirc', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeInOutCirc" <?php echo 'easeInOutCirc' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInOutCirc', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeOutCirc" <?php echo 'easeOutCirc' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeOutCirc', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeInOutCirc" <?php echo 'easeInOutCirc' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInOutCirc', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeInElastic" <?php echo 'easeInElastic' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInElastic', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeOutElastic" <?php echo 'easeOutElastic' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeOutElastic', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeInOutElastic" <?php echo 'easeInOutElastic' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInOutElastic', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeInBack" <?php echo 'easeInBack' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInBack', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeOutBack" <?php echo 'easeOutBack' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeOutBack', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeInOutBack" <?php echo 'easeInOutBack' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInOutBack', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeInBounce" <?php echo 'easeInBounce' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInBounce', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeOutBounce" <?php echo 'easeOutBounce' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeOutBounce', 'wp-timeline-designer-pro' ); ?></option>
										<option value="easeInOutBounce" <?php echo 'easeInOutBounce' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInOutBounce', 'wp-timeline-designer-pro' ); ?></option>
									</select>
								</div>
							</li>
							<li class="wtl_hz_ts wtl_hz_ts_4">
								<?php wtl_setting_left( esc_html__( 'Post Width (px)', 'wp-timeline-designer-pro' ) ); ?>                                
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select the width of the post', 'wp-timeline-designer-pro' ); ?></span></span>
									<div class="input-type-number">
										<input type="number" name="item_width" id="item_width" min="100" max="1100" step="1" onblur="if (this.value <= 100)(this.value = 100)" value="<?php echo ( isset( $wtl_settings['item_width'] ) ? esc_attr( $wtl_settings['item_width'] ) : 400 ); ?>">
										<div class="input-type-number-nav">
											<div class="input-type-number-button input-type-number-up">+</div>
											<div class="input-type-number-button input-type-number-down">-</div>
										</div>
									</div>
								</div>
							</li>
							<li class="wtl_hz_ts wtl_hz_ts_5">
								<?php wtl_setting_left( esc_html__( 'Item Height (px)', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select the height of the post', 'wp-timeline-designer-pro' ); ?></span></span>
									<div class="input-type-number">
										<input type="number" name="item_height" id="item_height" min="100" max="1100" step="1" onblur="if (this.value <= 100)(this.value = 100)" value="<?php echo ( isset( $wtl_settings['item_height'] ) ? esc_attr( $wtl_settings['item_height'] ) : 570 ); ?>">
										<div class="input-type-number-nav">
											<div class="input-type-number-button input-type-number-up">+</div>
											<div class="input-type-number-button input-type-number-down">-</div>
										</div>
									</div>
								</div>
							</li>
							<li class="wtl_hz_ts wtl_hz_ts_6">
								<?php wtl_setting_left( esc_html__( 'Margin between Blog Post (px)', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select the margin for post', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $template_post_margin = ( isset( $wtl_settings['template_post_margin'] ) && '' != $wtl_settings['template_post_margin'] ) ? $wtl_settings['template_post_margin'] : 20; ?>
									<div class="grid_col_space range_slider_fontsize" id="template_template_post_marginInput" data-value="<?php echo esc_attr( $template_post_margin ); ?>" ></div>
									<div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="template_post_margin" id="template_post_margin" value="<?php echo esc_attr( $template_post_margin ); ?>" /></div>
								</div>
							</li>
							<li class="wtl_hz_ts wtl_hz_ts_7">
								<?php wtl_setting_left( esc_html__( 'Enable Autoslide', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable autoslide', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $enable_autoslide = ( ( isset( $wtl_settings['enable_autoslide'] ) && '' != $wtl_settings['enable_autoslide'] ) ) ? $wtl_settings['enable_autoslide'] : 1; ?>
									<fieldset class="wp-timeline-social-options wp-timeline-enable_autoslide buttonset buttonset-hide ui-buttonset" data-hide="1">
										<input id="enable_autoslide_1" name="enable_autoslide" class="enable_autoslide" type="radio" value="1" <?php checked( 1, $enable_autoslide ); ?> />
										<label for="enable_autoslide_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $enable_autoslide ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
										<input id="enable_autoslide_0" name="enable_autoslide" class="enable_autoslide" type="radio" value="0" <?php checked( 0, $enable_autoslide ); ?> />
										<label for="enable_autoslide_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $enable_autoslide ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="wtl_hz_ts wtl_hz_ts_8 scroll_speed_tr">
								<?php wtl_setting_left( esc_html__( 'Scrolling Speed(ms)', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select the slide speed', 'wp-timeline-designer-pro' ); ?></span></span>
									<div class="input-type-number">
										<input type="number" name="scroll_speed" id="scroll_speed" min="500" step="100" onblur="if (this.value <= 500) (this.value = 500)" value="<?php echo ( isset( $wtl_settings['scroll_speed'] ) ? esc_attr( $wtl_settings['scroll_speed'] ) : 1000 ); ?>">
										<div class="input-type-number-nav">
											<div class="input-type-number-button input-type-number-up">+</div>
											<div class="input-type-number-button input-type-number-down">-</div>
										</div>
									</div>
								</div>
							</li>
							<li class="wtl_hz_ts wtl_hz_ts_9">
								<?php wtl_setting_left( esc_html__( 'Number of Navigation Item', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Number of Navigation Item', 'wp-timeline-designer-pro' ); ?></span></span>
									<div class="input-type-number">
										<input type="number" name="noof_slider_nav_itme" id="noof_slider_nav_itme" min="2" max="12" step="1" onblur="if (this.value <= 2)(this.value = 2)" value="<?php echo ( isset( $wtl_settings['noof_slider_nav_itme'] ) ? esc_attr( $wtl_settings['noof_slider_nav_itme'] ) : 2 ); ?>">
										<div class="input-type-number-nav">
											<div class="input-type-number-button input-type-number-up">+</div>
											<div class="input-type-number-button input-type-number-down">-</div>
										</div>
									</div>
								</div>
							</li>
							<li class="wtl_hz_ts wtl_hz_ts_10">
								<?php wtl_setting_left( esc_html__( 'Number of Slide', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Number of Slides', 'wp-timeline-designer-pro' ); ?></span></span>
									<div class="input-type-number">
										<input type="number" name="noof_slide" id="noof_slide" min="1" max="4" step="1" onblur="if (this.value <= 1)(this.value = 1)" value="<?php echo ( isset( $wtl_settings['noof_slide'] ) ? esc_attr( $wtl_settings['noof_slide'] ) : 1 ); ?>">
										<div class="input-type-number-nav">
											<div class="input-type-number-button input-type-number-up">+</div>
											<div class="input-type-number-button input-type-number-down">-</div>
										</div>
									</div>
								</div>
							</li>
							<li class="wtl_hz_ts wtl_hz_ts_11">
								<?php wtl_setting_left( esc_html__( 'Enable Navigate to Scroll', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable Navigate to Scroll', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $enable_nav_to_scroll = ( ( isset( $wtl_settings['enable_nav_to_scroll'] ) && '' != $wtl_settings['enable_nav_to_scroll'] ) ) ? $wtl_settings['enable_nav_to_scroll'] : 1; ?>
									<fieldset class="wp-timeline-social-options wp-timeline-enable_nav_to_scroll buttonset buttonset-hide ui-buttonset" data-hide="1">
										<input id="enable_nav_to_scroll_1" name="enable_nav_to_scroll" class="enable_nav_to_scroll" type="radio" value="1" <?php checked( 1, $enable_nav_to_scroll ); ?> />
										<label for="enable_nav_to_scroll_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $enable_nav_to_scroll ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
										<input id="enable_nav_to_scroll_0" name="enable_nav_to_scroll" class="enable_nav_to_scroll" type="radio" value="0" <?php checked( 0, $enable_nav_to_scroll ); ?> />
										<label for="enable_nav_to_scroll_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $enable_nav_to_scroll ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<!-- Pagination Section -->
				<div id="wp_timeline_pagination" class="postbox postbox-with-fw-options" style='<?php echo esc_attr( $wp_timeline_pagination_class_show ); ?>'>
					<div class="inside">
						<ul class="wp-timeline-settings wp-timeline-lineheight">
							<li class="wp_timeline_pagination_type">
								<?php wtl_setting_left( esc_html__( 'Pagination Type', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select pagination type', 'wp-timeline-designer-pro' ); ?></span></span>
									<select name="pagination_type" id="pagination_type">
										<option value="no_pagination" <?php echo selected( 'no_pagination', $wtl_settings['pagination_type'] ); ?>><?php esc_html_e( 'No Pagination', 'wp-timeline-designer-pro' ); ?></option>
										<option value="paged" <?php echo selected( 'paged', $wtl_settings['pagination_type'] ); ?>><?php esc_html_e( 'Paged', 'wp-timeline-designer-pro' ); ?></option>
										<option value="load_more_btn" <?php echo selected( 'load_more_btn', $wtl_settings['pagination_type'] ); ?>><?php esc_html_e( 'Load More Button', 'wp-timeline-designer-pro' ); ?></option>
										<option value="load_onscroll_btn" <?php echo selected( 'load_onscroll_btn', $wtl_settings['pagination_type'] ); ?>><?php esc_html_e( 'Load On Page Scroll', 'wp-timeline-designer-pro' ); ?></option>
									</select>
								</div>
							</li>
							<li class="wp_template_pagination_template">
								<?php wtl_setting_left( esc_html__( 'Pagination Template', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select pagination template', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $pagination_template = isset( $wtl_settings['pagination_template'] ) ? $wtl_settings['pagination_template'] : 'template-1'; ?>
									<select name="pagination_template" id="pagination_template">
										<option value="template-1" <?php echo selected( 'template-1', $pagination_template ); ?>><?php esc_html_e( 'Template 1', 'wp-timeline-designer-pro' ); ?></option>
										<option value="template-2" <?php echo selected( 'template-2', $pagination_template ); ?>><?php esc_html_e( 'Template 2', 'wp-timeline-designer-pro' ); ?></option>
										<option value="template-3" <?php echo selected( 'template-3', $pagination_template ); ?>><?php esc_html_e( 'Template 3', 'wp-timeline-designer-pro' ); ?></option>
										<option value="template-4" <?php echo selected( 'template-4', $pagination_template ); ?>><?php esc_html_e( 'Template 4', 'wp-timeline-designer-pro' ); ?></option>
									</select>
									<div class="wp-timeline-setting-description wp-timeline-setting-pagination">
										<img class="pagination_template_images"src="<?php echo esc_url( WTL_URL ) . '/images/pagination/' . esc_attr( $pagination_template ) . '.png'; ?>">
									</div>
								</div>
							</li>
							<li class="wp_template_pagination_template">
								<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Pagination Color Settings', 'wp-timeline-designer-pro' ); ?></h3>
								<div class="wp-timeline-pagination-wrapper wp-timeline-pagination-wrapper1">
									<div class="wp-timeline-pagination-cover">
										<div class="wp-timeline-pagination-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Text Color', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select text color', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-pagination-content wp-timeline-color-picker">
											<?php $pagination_text_color = isset( $wtl_settings['pagination_text_color'] ) ? $wtl_settings['pagination_text_color'] : '#ffffff'; ?>
											<input type="text" name="pagination_text_color" id="pagination_text_color" value="<?php echo esc_attr( $pagination_text_color ); ?>" data-default-color="<?php echo esc_attr( $pagination_text_color ); ?>"/>
										</div>
									</div>
									<div class="wp-timeline-pagination-cover wp-timeline-pagination-background-color">
										<div class="wp-timeline-pagination-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Background Color', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select background color', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-pagination-content wp-timeline-color-picker">
											<?php $pagination_background_color = isset( $wtl_settings['pagination_background_color'] ) ? $wtl_settings['pagination_background_color'] : '#777'; ?>
											<input type="text" name="pagination_background_color" id="pagination_background_color" value="<?php echo esc_attr( $pagination_background_color ); ?>" data-default-color="<?php echo esc_attr( $pagination_background_color ); ?>"/>
										</div>
									</div>
									<div class="wp-timeline-pagination-cover">
										<div class="wp-timeline-pagination-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Text Hover Color', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select text hover color', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-pagination-content wp-timeline-color-picker">
											<?php $pagination_text_hover_color = isset( $wtl_settings['pagination_text_hover_color'] ) ? $wtl_settings['pagination_text_hover_color'] : ''; ?>
											<input type="text" name="pagination_text_hover_color" id="pagination_text_hover_color" value="<?php echo esc_attr( $pagination_text_hover_color ); ?>" data-default-color="<?php echo esc_attr( $pagination_text_hover_color ); ?>"/>
										</div>
									</div>
									<div class="wp-timeline-pagination-cover wp-timeline-pagination-hover-background-color">
										<div class="wp-timeline-pagination-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Hover Background Color', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select hover background color', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-pagination-content wp-timeline-color-picker">
											<?php $pagination_background_hover_color = isset( $wtl_settings['pagination_background_hover_color'] ) ? $wtl_settings['pagination_background_hover_color'] : ''; ?>
											<input type="text" name="pagination_background_hover_color" id="pagination_background_hover_color" value="<?php echo esc_attr( $pagination_background_hover_color ); ?>" data-default-color="<?php echo esc_attr( $pagination_background_hover_color ); ?>"/>
										</div>
									</div>
									<div class="wp-timeline-pagination-cover">
										<div class="wp-timeline-pagination-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Active Text Color', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select active text color', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-pagination-content wp-timeline-color-picker">
											<?php $pagination_text_active_color = isset( $wtl_settings['pagination_text_active_color'] ) ? $wtl_settings['pagination_text_active_color'] : ''; ?>
											<input type="text" name="pagination_text_active_color" id="pagination_text_active_color" value="<?php echo esc_attr( $pagination_text_active_color ); ?>" data-default-color="<?php echo esc_attr( $pagination_text_active_color ); ?>"/>
										</div>
									</div>
									<div class="wp-timeline-pagination-cover">
										<div class="wp-timeline-pagination-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Active Background Color', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select active background color', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-pagination-content wp-timeline-color-picker">
											<?php $pagination_active_background_color = isset( $wtl_settings['pagination_active_background_color'] ) ? $wtl_settings['pagination_active_background_color'] : ''; ?>
											<input type="text" name="pagination_active_background_color" id="pagination_active_background_color" value="<?php echo esc_attr( $pagination_active_background_color ); ?>" data-default-color="<?php echo esc_attr( $pagination_active_background_color ); ?>"/>
										</div>
									</div>
									<div class="wp-timeline-pagination-cover wp-timeline-pagination-border-wrap ">
										<div class="wp-timeline-pagination-label">
											<span class="wp-timeline-key-title"> <?php esc_html_e( 'Border Color', 'wp-timeline-designer-pro' ); ?> </span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select border color', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-pagination-content wp-timeline-color-picker">
											<?php $pagination_border_color = isset( $wtl_settings['pagination_border_color'] ) ? $wtl_settings['pagination_border_color'] : '#b2b2b2'; ?>
											<input type="text" name="pagination_border_color" id="pagination_border_color" value="<?php echo esc_attr( $pagination_border_color ); ?>" data-default-color="<?php echo esc_attr( $pagination_border_color ); ?>"/>
										</div>
									</div>
									<div class="wp-timeline-pagination-cover wp-timeline-pagination-active-border-wrap">
										<div class="wp-timeline-pagination-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Active Border Color', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select active border color', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-pagination-content wp-timeline-color-picker">
											<?php $pagination_active_border_color = isset( $wtl_settings['pagination_active_border_color'] ) ? $wtl_settings['pagination_active_border_color'] : '#007acc'; ?>
											<input type="text" name="pagination_active_border_color" id="pagination_active_border_color" value="<?php echo esc_attr( $pagination_active_border_color ); ?>" data-default-color="<?php echo esc_attr( $pagination_active_border_color ); ?>"/>
										</div>
									</div>
								</div>
							</li>
							<li class="loadmore_btn_option archive_loadmore_btn_template">
								<?php wtl_setting_left( esc_html__( 'Button Template', 'wp-timeline-designer-pro' ) ); ?>  
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select load more button template', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $load_more_button_template = isset( $wtl_settings['load_more_button_template'] ) ? $wtl_settings['load_more_button_template'] : 'template-1'; ?>
									<select name="load_more_button_template" id="load_more_button_template">
										<option value="template-1" <?php echo selected( 'template-1', $load_more_button_template ); ?>><?php esc_html_e( 'Template 1', 'wp-timeline-designer-pro' ); ?></option>
										<option value="template-2" <?php echo selected( 'template-2', $load_more_button_template ); ?>><?php esc_html_e( 'Template 2', 'wp-timeline-designer-pro' ); ?></option>
										<option value="template-3" <?php echo selected( 'template-3', $load_more_button_template ); ?>><?php esc_html_e( 'Template 3', 'wp-timeline-designer-pro' ); ?></option>
									</select>
									<div class="wp-timeline-setting-description button-loadmore">
										<img class="load_more_button_template_images"src="<?php echo esc_url( WTL_URL ) . '/images/buttons/' . esc_attr( $load_more_button_template ) . '.png'; ?>">
									</div>
								</div>
							</li>
							<li class="loadmore_btn_option">
								<?php wtl_setting_left( esc_html__( 'Load More Button Text', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enter load more button text', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $loadmore_button_text = ( isset( $wtl_settings['loadmore_button_text'] ) && '' != $wtl_settings['loadmore_button_text'] ) ? $wtl_settings['loadmore_button_text'] : esc_html__( 'Load More', 'wp-timeline-designer-pro' ); ?>
									<input type="text" name="loadmore_button_text" id="loadmore_button_text" value="<?php echo esc_attr( $loadmore_button_text ); ?>" placeholder="<?php esc_attr_e( 'Enter load more button text', 'wp-timeline-designer-pro' ); ?>">
								</div>
							</li>
							<li class="loadmore_btn_option">
								<?php wtl_setting_left( esc_html__( 'Load More Text Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select load more text color', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $loadmore_button_color = ( isset( $wtl_settings['loadmore_button_color'] ) && '' != $wtl_settings['loadmore_button_color'] ) ? $wtl_settings['loadmore_button_color'] : '#ffffff'; ?>
									<input type="text" name="loadmore_button_color" id="loadmore_button_color" value="<?php echo esc_attr( $loadmore_button_color ); ?>"/>
								</div>
							</li>
							<li class="loadmore_btn_option">
								<?php wtl_setting_left( esc_html__( 'Load More Text Hover Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select load more hover text color', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $loadmore_button_hover_color = ( isset( $wtl_settings['loadmore_button_hover_color'] ) && '' != $wtl_settings['loadmore_button_hover_color'] ) ? $wtl_settings['loadmore_button_hover_color'] : '#ffffff'; ?>
									<input type="text" name="loadmore_button_hover_color" id="loadmore_button_hover_color" value="<?php echo esc_attr( $loadmore_button_hover_color ); ?>"/>
								</div>
							</li>
							<li class="loadmore_btn_option">
								<?php wtl_setting_left( esc_html__( 'Load More Button Background Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select load more button background color', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $loadmore_button_bg_color = ( isset( $wtl_settings['loadmore_button_bg_color'] ) && '' != $wtl_settings['loadmore_button_bg_color'] ) ? $wtl_settings['loadmore_button_bg_color'] : '#444444'; ?>
									<input type="text" name="loadmore_button_bg_color" id="loadmore_button_bg_color" value="<?php echo esc_attr( $loadmore_button_bg_color ); ?>"/>
								</div>
							</li>
							<li class="loadmore_btn_option">
								<?php wtl_setting_left( esc_html__( 'Load More Button Background Hover Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select load more button background hover color', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $loadmore_button_bg_hover_color = ( isset( $wtl_settings['loadmore_button_bg_hover_color'] ) && '' != $wtl_settings['loadmore_button_bg_hover_color'] ) ? $wtl_settings['loadmore_button_bg_hover_color'] : '#444444'; ?>
									<input type="text" name="loadmore_button_bg_hover_color" id="loadmore_button_bg_hover_color" value="<?php echo esc_attr( $loadmore_button_bg_hover_color ); ?>"/>
								</div>
							</li>
							<li class="loadmore_btn_option">
								<?php wtl_setting_left( esc_html__( 'Load More Button Border Style', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select load more button border type', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $load_more_button_border_style = isset( $wtl_settings['load_more_button_border_style'] ) ? $wtl_settings['load_more_button_border_style'] : 'solid'; ?>
									<select name="load_more_button_border_style" id="load_more_button_border_style">
										<option value="none" <?php selected( $load_more_button_border_style, 'none' ); ?>><?php esc_html_e( 'None', 'wp-timeline-designer-pro' ); ?></option>
										<option value="dotted" <?php selected( $load_more_button_border_style, 'dotted' ); ?>><?php esc_html_e( 'Dotted', 'wp-timeline-designer-pro' ); ?></option>
										<option value="dashed" <?php selected( $load_more_button_border_style, 'dashed' ); ?>><?php esc_html_e( 'Dashed', 'wp-timeline-designer-pro' ); ?></option>
										<option value="solid" <?php selected( $load_more_button_border_style, 'solid' ); ?>><?php esc_html_e( 'Solid', 'wp-timeline-designer-pro' ); ?></option>
										<option value="double" <?php selected( $load_more_button_border_style, 'double' ); ?>><?php esc_html_e( 'Double', 'wp-timeline-designer-pro' ); ?></option>
										<option value="groove" <?php selected( $load_more_button_border_style, 'groove' ); ?>><?php esc_html_e( 'Groove', 'wp-timeline-designer-pro' ); ?></option>
										<option value="ridge" <?php selected( $load_more_button_border_style, 'ridge' ); ?>><?php esc_html_e( 'Ridge', 'wp-timeline-designer-pro' ); ?></option>
										<option value="inset" <?php selected( $load_more_button_border_style, 'inset' ); ?>><?php esc_html_e( 'Inset', 'wp-timeline-designer-pro' ); ?></option>
										<option value="outset" <?php selected( $load_more_button_border_style, 'outset' ); ?> ><?php esc_html_e( 'Outset', 'wp-timeline-designer-pro' ); ?></option>
									</select>
								</div>
							</li>
							<li class="loadmore_btn_option load_more_btn_border">
								<?php wtl_setting_left( esc_html__( 'Load More Button Border', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-border-cover">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select read more button border', 'wp-timeline-designer-pro' ); ?></span></span>
									<div class="wp-timeline-border-wrap">
										<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
											<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Left (px)', 'wp-timeline-designer-pro' ); ?></span></div>
											<div class="wp-timeline-border-cover">
												<div class="wp-timeline-border-content">
													<?php $wtl_loadmore_btn_borderleft = isset( $wtl_settings['wtl_loadmore_btn_borderleft'] ) ? $wtl_settings['wtl_loadmore_btn_borderleft'] : '0'; ?>
													<div class="input-type-number">
														<input type="number" id="wtl_loadmore_btn_borderleft" name="wtl_loadmore_btn_borderleft" step="1" min="0" value="<?php echo esc_attr( $wtl_loadmore_btn_borderleft ); ?>"  >
														<div class="input-type-number-nav">
															<div class="input-type-number-button input-type-number-up">+</div>
															<div class="input-type-number-button input-type-number-down">-</div>
														</div>
													</div>
												</div>
											</div>
											<div class="wp-timeline-border-cover wp-timeline-color-picker">
												<div class="wp-timeline-border-content">
													<?php $wtl_loadmore_btn_borderleftcolor = isset( $wtl_settings['wtl_loadmore_btn_borderleftcolor'] ) ? $wtl_settings['wtl_loadmore_btn_borderleftcolor'] : ''; ?>
													<input type="text" name="wtl_loadmore_btn_borderleftcolor" id="wtl_loadmore_btn_borderleftcolor" value="<?php echo esc_attr( $wtl_loadmore_btn_borderleftcolor ); ?>"/>
												</div>
											</div>
										</div> 
										<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
											<div class="wp-timeline-border-cover wp-timeline-border-label">
													<span class="wp-timeline-key-title"><?php esc_html_e( 'Right (px)', 'wp-timeline-designer-pro' ); ?></span>
												</div>
											<div class="wp-timeline-border-cover">
												<div class="wp-timeline-border-content">
													<?php $wtl_loadmore_btn_borderright = isset( $wtl_settings['wtl_loadmore_btn_borderright'] ) ? $wtl_settings['wtl_loadmore_btn_borderright'] : '0'; ?>
													<div class="input-type-number">
														<input type="number" id="wtl_loadmore_btn_borderright" name="wtl_loadmore_btn_borderright" step="1" min="0" value="<?php echo esc_attr( $wtl_loadmore_btn_borderright ); ?>" >
														<div class="input-type-number-nav">
															<div class="input-type-number-button input-type-number-up">+</div>
															<div class="input-type-number-button input-type-number-down">-</div>
														</div>
													</div>
												</div>
											</div>
											<div class="wp-timeline-border-cover wp-timeline-color-picker">
												<div class="wp-timeline-border-content">
												<?php $wtl_loadmore_btn_borderrightcolor = isset( $wtl_settings['wtl_loadmore_btn_borderrightcolor'] ) ? $wtl_settings['wtl_loadmore_btn_borderrightcolor'] : ''; ?>
													<input type="text" name="wtl_loadmore_btn_borderrightcolor" id="wtl_loadmore_btn_borderrightcolor" value="<?php echo esc_attr( $wtl_loadmore_btn_borderrightcolor ); ?>"/>
												</div>
											</div>
										</div>
										<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
											<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Top (px)', 'wp-timeline-designer-pro' ); ?></span></div>
											<div class="wp-timeline-border-cover">
												<div class="wp-timeline-border-content">
													<?php $wtl_loadmore_btn_bordertop = isset( $wtl_settings['wtl_loadmore_btn_bordertop'] ) ? $wtl_settings['wtl_loadmore_btn_bordertop'] : '0'; ?>
													<div class="input-type-number">
														<input type="number" id="wtl_loadmore_btn_bordertop" name="wtl_loadmore_btn_bordertop" step="1" min="0" value="<?php echo esc_attr( $wtl_loadmore_btn_bordertop ); ?>" >
														<div class="input-type-number-nav">
															<div class="input-type-number-button input-type-number-up">+</div>
															<div class="input-type-number-button input-type-number-down">-</div>
														</div>
													</div>
												</div>
											</div>
											<div class="wp-timeline-border-cover wp-timeline-color-picker">
												<div class="wp-timeline-border-content">
													<?php $wtl_loadmore_btn_bordertopcolor = isset( $wtl_settings['wtl_loadmore_btn_bordertopcolor'] ) ? $wtl_settings['wtl_loadmore_btn_bordertopcolor'] : ''; ?>
													<input type="text" name="wtl_loadmore_btn_bordertopcolor" id="wtl_loadmore_btn_bordertopcolor" value="<?php echo esc_attr( $wtl_loadmore_btn_bordertopcolor ); ?>"/>
												</div>
											</div>
										</div>
										<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
											<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Bottom(px)', 'wp-timeline-designer-pro' ); ?></span></div>
											<div class="wp-timeline-border-cover">
												<div class="wp-timeline-border-content">
													<?php $wtl_loadmore_btn_borderbottom = isset( $wtl_settings['wtl_loadmore_btn_borderbottom'] ) ? $wtl_settings['wtl_loadmore_btn_borderbottom'] : '0'; ?>
													<div class="input-type-number">
														<input type="number" id="wtl_loadmore_btn_borderbottom" name="wtl_loadmore_btn_borderbottom" step="1" min="0" value="<?php echo esc_attr( $wtl_loadmore_btn_borderbottom ); ?>" >
														<div class="input-type-number-nav">
															<div class="input-type-number-button input-type-number-up">+</div>
															<div class="input-type-number-button input-type-number-down">-</div>
														</div>
													</div>
												</div>
											</div>
											<div class="wp-timeline-border-cover wp-timeline-color-picker">
												<div class="wp-timeline-border-content">
												<?php $wtl_loadmore_btn_borderbottomcolor = isset( $wtl_settings['wtl_loadmore_btn_borderbottomcolor'] ) ? $wtl_settings['wtl_loadmore_btn_borderbottomcolor'] : ''; ?>
												<input type="text" name="wtl_loadmore_btn_borderbottomcolor" id="wtl_loadmore_btn_borderbottomcolor" value="<?php echo esc_attr( $wtl_loadmore_btn_borderbottomcolor ); ?>"/>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
							<li class="wp_template_loader_template">
								<?php wtl_setting_left( esc_html__( 'Loader Type', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select loader type', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $loader_type = isset( $wtl_settings['loader_type'] ) ? $wtl_settings['loader_type'] : 0; ?>
									<select name="loader_type" id="pagination_template">
										<option value="0" <?php echo selected( '0', $loader_type ); ?>><?php esc_html_e( 'Select Default Loader', 'wp-timeline-designer-pro' ); ?></option>
										<option value="1" <?php echo selected( '1', $loader_type ); ?>><?php esc_html_e( 'Upload New Loader Image', 'wp-timeline-designer-pro' ); ?></option>
									</select>
								</div>
							</li>
							<li class="wp_template_loader_template default_loader">
								<?php wtl_setting_left( esc_html__( 'Loader Icon', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select loader', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $loader_style_hidden = isset( $wtl_settings['loader_style_hidden'] ) ? $wtl_settings['loader_style_hidden'] : 'circularG'; ?>
									<div class="select_button_upper_div ">
										<div class="wp_timeline_select_template_button_div">
											<input type="button" class="button wp_timeline_select_loader" value="<?php esc_attr_e( 'Select Loader Icon', 'wp-timeline-designer-pro' ); ?>">
											<input style="visibility: hidden;" type="hidden" id="loader_style_hidden" class="loader_style_hidden" name="loader_style_hidden" value="<?php echo esc_attr( $loader_style_hidden ); ?>"/>
										</div>
										<div class="wp_timeline_selected_loader_image"><div class="wp-timelinedialog-loader-style"><span class="wp_timeline_loader_image_holder loader_hidden">
											<?php
											$allowed_html = array(
												'div' => array(
													'class' => array(),
												),
											);
											echo wp_kses( $loaders[ $loader_style_hidden ], $allowed_html );
											?>
											</span></div></div>
									</div>
								</div>
							</li>
							<li class="wp_template_loader_template upload_loader">
								<?php wtl_setting_left( esc_html__( 'Loader Image', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_attr_e( 'Select loader image', 'wp-timeline-designer-pro' ); ?></span></span>
									<div class="select_button_upper_div ">
										<div class="wp_timeline_select_template_button_div">
											<?php $loader_image_src = ( isset( $wtl_settings['wp_timeline_loader_image_src'] ) && '' != $wtl_settings['wp_timeline_loader_image_src'] ) ? esc_attr( $wtl_settings['wp_timeline_loader_image_src'] ) : esc_url( WTL_URL ) . '/images/loading.gif'; ?>
											<?php if ( '' != $loader_image_src ) { ?>
												<input class="button wp-timeline-remove_upload_image_button" type="button" value="<?php esc_attr_e( 'Remove Image', 'wp-timeline-designer-pro' ); ?>">
											<?php } else { ?>
												<input class="button wp-timeline-loader_upload_image_button " type="button" value="<?php esc_attr_e( 'Upload Image', 'wp-timeline-designer-pro' ); ?>">
											<?php } ?>
											<input type="hidden" value="<?php echo isset( $wtl_settings['wp_timeline_loader_image_id'] ) ? esc_attr( $wtl_settings['wp_timeline_loader_image_id'] ) : ''; ?>" name="wp_timeline_loader_image_id" id="wp_timeline_loader_image_id">
											<input type="hidden" value="<?php echo esc_attr( $loader_image_src ); ?>" name="wp_timeline_loader_image_src" id="wp_timeline_loader_image_src">
										</div>
										<div class="wp_timeline_selected_loader_image">
											<span class="wp_timeline_loader_image_holder">
												<?php
												if ( '' != $loader_image_src ) {
													echo '<img src="' . esc_url( $loader_image_src ) . '"/>';
												}
												?>
											</span>
										</div>
									</div>
								</div>
							</li>
							<li class="wp_template_loader_template default_loader">
								<?php wtl_setting_left( esc_html__( 'Choose Loader Icon Color', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right wp-timeline-color-picker">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select loader icon color', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $loader_color = isset( $wtl_settings['loader_color'] ) ? $wtl_settings['loader_color'] : ''; ?>
									<input type="text" name="loader_color" id="loader_color" value="<?php echo esc_attr( $loader_color ); ?>" data-default-color="<?php echo esc_attr( $loader_color ); ?>"/>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<?php
				if ( Wp_Timeline_Main::wtl_woocommerce_plugin() ) {
					?>
					<div id="wp_timeline_productsetting" class="postbox postbox-with-fw-options" style='<?php echo esc_attr( $wp_timeline_productsetting_class_show ); ?>'>
						<div class="inside">
							<ul class="wp-timeline-settings wp-timeline-lineheight">
								<li>
									<?php wtl_setting_left( esc_html__( 'Display Sale Tag', 'wp-timeline-designer-pro' ) ); ?>
									<div class="wp-timeline-right">
										<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable sale tag', 'wp-timeline-designer-pro' ); ?></span></span>
										<?php
										$display_sale_tag = '1';
										if ( isset( $wtl_settings['display_sale_tag'] ) ) {
											$display_sale_tag = $wtl_settings['display_sale_tag'];
										}
										?>
										<fieldset class="wp-timeline-social-style buttonset ui-buttonset buttonset-hide" data-hide='1'>
											<input id="display_sale_tag_1" name="display_sale_tag" type="radio" value="1" <?php checked( 1, $display_sale_tag ); ?> />
											<label id="wp-timeline-options-button" for="display_sale_tag_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $display_sale_tag ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
											<input id="display_sale_tag_0" name="display_sale_tag" type="radio" value="0" <?php checked( 0, $display_sale_tag ); ?> />
											<label id="wp-timeline-options-button" for="display_sale_tag_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 1, $display_sale_tag ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
										</fieldset>
									</div>
								</li>
								<li class="wp_timeline_sale_setting">
									<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Sale Tag Settings', 'wp-timeline-designer-pro' ); ?></h3>
									<ul>
										<li class="wp_timeline_sale_tagtext_tr">
											<?php wtl_setting_left( esc_html__( 'Text Color', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right wp-timeline-color-picker">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select sale tag text color', 'wp-timeline-designer-pro' ); ?></span></span>
												<?php $wp_timeline_sale_tagtextcolor = ( isset( $wtl_settings['wp_timeline_sale_tagtextcolor'] ) && '' != $wtl_settings['wp_timeline_sale_tagtextcolor'] ) ? $wtl_settings['wp_timeline_sale_tagtextcolor'] : ''; ?>
												<input type="text" name="wp_timeline_sale_tagtextcolor" id="wp_timeline_sale_tagtextcolor" value="<?php echo esc_attr( $wp_timeline_sale_tagtextcolor ); ?>"/>
											</div>
										</li>
										<li class="wp_timeline_sale_tagtext_tr">
											<?php wtl_setting_left( esc_html__( 'Background Color', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right wp-timeline-color-picker">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select sale tag background color', 'wp-timeline-designer-pro' ); ?></span></span>
												<?php $wp_timeline_sale_tagbgcolor = ( isset( $wtl_settings['wp_timeline_sale_tagbgcolor'] ) && '' != $wtl_settings['wp_timeline_sale_tagbgcolor'] ) ? $wtl_settings['wp_timeline_sale_tagbgcolor'] : ''; ?>
												<input type="text" name="wp_timeline_sale_tagbgcolor" id="wp_timeline_sale_tagbgcolor" value="<?php echo esc_attr( $wp_timeline_sale_tagbgcolor ); ?>"/>
											</div>
										</li>
										<li class="wp_timeline_sale_tagtext_tr wp_timeline_sale_tagtext_alignment_tr">
											<?php wtl_setting_left( esc_html__( 'Alignment', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select sale tag alignment', 'wp-timeline-designer-pro' ); ?></span></span>
												<?php
												$wp_timeline_sale_tagtext_alignment = 'left';
												if ( isset( $wtl_settings['wp_timeline_sale_tagtext_alignment'] ) ) {
													$wp_timeline_sale_tagtext_alignment = $wtl_settings['wp_timeline_sale_tagtext_alignment'];
												}
												?>
												<select name="wp_timeline_sale_tagtext_alignment" id="wp_timeline_sale_tagtext_alignment">
													<option value="left-top" <?php echo selected( 'left-top', $wp_timeline_sale_tagtext_alignment ); ?>><?php esc_html_e( 'Left Top', 'wp-timeline-designer-pro' ); ?></option>
													<option value="left-bottom" <?php echo selected( 'left-bottom', $wp_timeline_sale_tagtext_alignment ); ?>><?php esc_html_e( 'Left Bottom', 'wp-timeline-designer-pro' ); ?></option>
													<option value="right-top" <?php echo selected( 'right-top', $wp_timeline_sale_tagtext_alignment ); ?>><?php esc_html_e( 'Right Top', 'wp-timeline-designer-pro' ); ?></option>
													<option value="right-bottom" <?php echo selected( 'right-bottom', $wp_timeline_sale_tagtext_alignment ); ?>><?php esc_html_e( 'Right Bottom', 'wp-timeline-designer-pro' ); ?></option>
												</select>
											</div>
										</li>
										<li class="wp_timeline_sale_tagtext_tr wp_timeline_sale_tagtext_alignment_tr">
											<?php wtl_setting_left( esc_html__( 'Angle(0-360 deg)', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select sale tag angle', 'wp-timeline-designer-pro' ); ?></span></span>
												<?php $wp_timeline_sale_tag_angle = isset( $wtl_settings['wp_timeline_sale_tag_angle'] ) ? $wtl_settings['wp_timeline_sale_tag_angle'] : '0'; ?>
												<div class="input-type-number">
													<input type="number" id="wp_timeline_sale_tag_angle" name="wp_timeline_sale_tag_angle" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_sale_tag_angle ); ?>" >
													<div class="input-type-number-nav">
														<div class="input-type-number-button input-type-number-up">+</div>
														<div class="input-type-number-button input-type-number-down">-</div>
													</div>
												</div>
											</div>
										</li>
										<li class="wp_timeline_sale_tagtext_tr wp_timeline_sale_tagtext_alignment_tr">
											<?php wtl_setting_left( esc_html__( 'Border Radius(%)', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select sale tag border radius', 'wp-timeline-designer-pro' ); ?></span></span>
												<?php $wp_timeline_sale_tag_border_radius = isset( $wtl_settings['wp_timeline_sale_tag_border_radius'] ) ? $wtl_settings['wp_timeline_sale_tag_border_radius'] : '0'; ?>
												<div class="input-type-number">
													<input type="number" id="wp_timeline_sale_tag_border_radius" name="wp_timeline_sale_tag_border_radius" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_sale_tag_border_radius ); ?>" >
													<div class="input-type-number-nav">
														<div class="input-type-number-button input-type-number-up">+</div>
														<div class="input-type-number-button input-type-number-down">-</div>
													</div>
												</div>
											</div>
										</li>
										<li class="wp_timeline_sale_tagtext_tr wp_timeline_sale_tagtext_padding_setting_tr">
											<?php wtl_setting_left( esc_html__( 'Padding', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right wp-timeline-border-cover">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select sale tag padding', 'wp-timeline-designer-pro' ); ?></span></span>
												<div class="wp-timeline-padding-wrapper wp-timeline-padding-wrapper1 wp-timeline-border-wrap">
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Left (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_sale_tagtext_paddingleft = isset( $wtl_settings['wp_timeline_sale_tagtext_paddingleft'] ) ? $wtl_settings['wp_timeline_sale_tagtext_paddingleft'] : '5'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_sale_tagtext_paddingleft" name="wp_timeline_sale_tagtext_paddingleft" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_sale_tagtext_paddingleft ); ?>" >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Right (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_sale_tagtext_paddingright = isset( $wtl_settings['wp_timeline_sale_tagtext_paddingright'] ) ? $wtl_settings['wp_timeline_sale_tagtext_paddingright'] : '5'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_sale_tagtext_paddingright" name="wp_timeline_sale_tagtext_paddingright" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_sale_tagtext_paddingright ); ?>" >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Top (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_sale_tagtext_paddingtop = isset( $wtl_settings['wp_timeline_sale_tagtext_paddingtop'] ) ? $wtl_settings['wp_timeline_sale_tagtext_paddingtop'] : '5'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_sale_tagtext_paddingtop" name="wp_timeline_sale_tagtext_paddingtop" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_sale_tagtext_paddingtop ); ?>"  >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Bottom (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_sale_tagtext_paddingbottom = isset( $wtl_settings['wp_timeline_sale_tagtext_paddingbottom'] ) ? $wtl_settings['wp_timeline_sale_tagtext_paddingbottom'] : '5'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_sale_tagtext_paddingbottom" name="wp_timeline_sale_tagtext_paddingbottom" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_sale_tagtext_paddingbottom ); ?>" >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li class="wp_timeline_sale_tagtext_tr wp_timeline_sale_tagtext_marging_setting_tr">
											<?php wtl_setting_left( esc_html__( 'Margin', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right wp-timeline-border-cover">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select sale tag margin', 'wp-timeline-designer-pro' ); ?></span></span>
												<div class="wp-timeline-padding-wrapper wp-timeline-padding-wrapper1 wp-timeline-border-wrap">
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Left (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_sale_tagtext_marginleft = isset( $wtl_settings['wp_timeline_sale_tagtext_marginleft'] ) ? $wtl_settings['wp_timeline_sale_tagtext_marginleft'] : '5'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_sale_tagtext_marginleft" name="wp_timeline_sale_tagtext_marginleft" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_sale_tagtext_marginleft ); ?>" >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Right (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_sale_tagtext_marginright = isset( $wtl_settings['wp_timeline_sale_tagtext_marginright'] ) ? $wtl_settings['wp_timeline_sale_tagtext_marginright'] : '5'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_sale_tagtext_marginright" name="wp_timeline_sale_tagtext_marginright" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_sale_tagtext_marginright ); ?>" >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Top (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_sale_tagtext_margintop = isset( $wtl_settings['wp_timeline_sale_tagtext_margintop'] ) ? $wtl_settings['wp_timeline_sale_tagtext_margintop'] : '5'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_sale_tagtext_margintop" name="wp_timeline_sale_tagtext_margintop" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_sale_tagtext_margintop ); ?>"  >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Bottom (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_sale_tagtext_marginbottom = isset( $wtl_settings['wp_timeline_sale_tagtext_marginbottom'] ) ? $wtl_settings['wp_timeline_sale_tagtext_marginbottom'] : '5'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_sale_tagtext_marginbottom" name="wp_timeline_sale_tagtext_marginbottom" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_sale_tagtext_marginbottom ); ?>" >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li class="wp_timeline_sale_tagtext_tr">
											<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Typography Settings', 'wp-timeline-designer-pro' ); ?></h3>
											<div class="wp-timeline-typography-wrapper wp-timeline-typography-wrapper1">
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Font Family', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select sale tag font family', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content">
														<?php
														if ( isset( $wtl_settings['wp_timeline_sale_tagfontface'] ) && '' != $wtl_settings['wp_timeline_sale_tagfontface'] ) {
															$wp_timeline_sale_tagfontface = $wtl_settings['wp_timeline_sale_tagfontface'];
														} else {
															$wp_timeline_sale_tagfontface = '';
														}
														?>
														<div class="typo-field">
															<input type="hidden" id="wp_timeline_sale_tagfontface_font_type" name="wp_timeline_sale_tagfontface_font_type" value="<?php echo isset( $wtl_settings['wp_timeline_sale_tagfontface_font_type'] ) ? esc_attr( $wtl_settings['wp_timeline_sale_tagfontface_font_type'] ) : ''; ?>">
															<div class="select-cover">
																<select name="wp_timeline_sale_tagfontface" id="wp_timeline_sale_tagfontface">
																	<option value=""><?php esc_html_e( 'Select Font Family', 'wp-timeline-designer-pro' ); ?></option>
																	<?php
																	$old_version   = '';
																	$cnt           = 0;
																	$font_family_3 = Wp_Timeline_Main::wtl_default_recognized_font_faces();
																	if ( $font_family_3 ) {
																		foreach ( $font_family_3 as $key3 => $value3 ) {
																			if ( $value3['version'] != $old_version ) {
																				if ( $cnt > 0 ) {
																					echo '</optgroup>';
																				}
																				echo '<optgroup label="' . esc_attr( $value3['version'] ) . '">';
																				$old_version = $value3['version'];
																			}
																			echo "<option value='" . esc_attr( str_replace( '"', '', $value3['label'] ) ) . "'";
																			if ( '' != $wp_timeline_sale_tagfontface && ( str_replace( '"', '', $wp_timeline_sale_tagfontface ) == str_replace( '"', '', $value3['label'] ) ) ) {
																				echo ' selected';
																			}
																			echo '>' . esc_html( $value3['label'] ) . '</option>';
																			$cnt++;
																		}
																	}
																	if ( count( $font_family_3 ) == $cnt ) {
																		echo '</optgroup>';
																	}
																	?>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Font Size (px)', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select sale tag font size', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content">
														<?php
														if ( isset( $wtl_settings['wp_timeline_sale_tagfontsize'] ) && '' != $wtl_settings['wp_timeline_sale_tagfontsize'] ) {
															$wp_timeline_sale_tagfontsize = $wtl_settings['wp_timeline_sale_tagfontsize'];
														} else {
															$wp_timeline_sale_tagfontsize = 14;
														}
														?>
														<div class="grid_col_space range_slider_fontsize" id="wp_timeline_sale_tagfontsizeInput" ></div>
														<div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="wp_timeline_sale_tagfontsize" id="wp_timeline_sale_tagfontsize" value="<?php echo esc_attr( $wp_timeline_sale_tagfontsize ); ?>"  /></div>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Font Weight', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select sale tag font weight', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content">
														<?php $wp_timeline_sale_tag_font_weight = isset( $wtl_settings['wp_timeline_sale_tag_font_weight'] ) ? $wtl_settings['wp_timeline_sale_tag_font_weight'] : 'normal'; ?>
														<div class="select-cover">
															<select name="wp_timeline_sale_tag_font_weight" id="wp_timeline_sale_tag_font_weight">
																<option value="100" <?php selected( $wp_timeline_sale_tag_font_weight, 100 ); ?>>100</option>
																<option value="200" <?php selected( $wp_timeline_sale_tag_font_weight, 200 ); ?>>200</option>
																<option value="300" <?php selected( $wp_timeline_sale_tag_font_weight, 300 ); ?>>300</option>
																<option value="400" <?php selected( $wp_timeline_sale_tag_font_weight, 400 ); ?>>400</option>
																<option value="500" <?php selected( $wp_timeline_sale_tag_font_weight, 500 ); ?>>500</option>
																<option value="600" <?php selected( $wp_timeline_sale_tag_font_weight, 600 ); ?>>600</option>
																<option value="700" <?php selected( $wp_timeline_sale_tag_font_weight, 700 ); ?>>700</option>
																<option value="800" <?php selected( $wp_timeline_sale_tag_font_weight, 800 ); ?>>800</option>
																<option value="900" <?php selected( $wp_timeline_sale_tag_font_weight, 900 ); ?>>900</option>
																<option value="bold" <?php selected( $wp_timeline_sale_tag_font_weight, 'bold' ); ?> ><?php esc_html_e( 'Bold', 'wp-timeline-designer-pro' ); ?></option>
																<option value="normal" <?php selected( $wp_timeline_sale_tag_font_weight, 'normal' ); ?>><?php esc_html_e( 'Normal', 'wp-timeline-designer-pro' ); ?></option>
															</select>
														</div>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Line Height', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select sale tag line height', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content"><div class="input-type-number"><input type="number" name="wp_timeline_sale_tag_font_line_height" id="wp_timeline_sale_tag_font_line_height" step="0.1" min="0" value="<?php echo isset( $wtl_settings['wp_timeline_sale_tag_font_line_height'] ) ? esc_attr( $wtl_settings['wp_timeline_sale_tag_font_line_height'] ) : '1.5'; ?>"  >
													<div class="input-type-number-nav">
														<div class="input-type-number-button input-type-number-up">+</div>
														<div class="input-type-number-button input-type-number-down">-</div>
													</div></div></div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Italic Font Style', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Display sale tag italic font style', 'wp-timeline-designer-pro' ); ?></span></span><?php $wp_timeline_sale_tag_font_italic = isset( $wtl_settings['wp_timeline_sale_tag_font_italic'] ) ? $wtl_settings['wp_timeline_sale_tag_font_italic'] : '0'; ?>
													</div>
													<div class="wp-timeline-typography-content">
														<fieldset class="wp-timeline-social-options wp-timeline-display_author buttonset ui-buttonset">
															<input id="wp_timeline_sale_tag_font_italic_1" name="wp_timeline_sale_tag_font_italic" type="radio" value="1"  <?php checked( 1, $wp_timeline_sale_tag_font_italic ); ?> />
															<label for="wp_timeline_sale_tag_font_italic_1" class="<?php echo esc_html( $uic_l ); ?>"><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
															<input id="wp_timeline_sale_tag_font_italic_0" name="wp_timeline_sale_tag_font_italic" type="radio" value="0" <?php checked( 0, $wp_timeline_sale_tag_font_italic ); ?> />
															<label for="wp_timeline_sale_tag_font_italic_0" class="<?php echo esc_html( $uic_r ); ?>"><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
														</fieldset>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title">
														<?php esc_html_e( 'Text Transform', 'wp-timeline-designer-pro' ); ?>
														</span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select sale tag text transform style', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content">
														<?php $wp_timeline_sale_tag_font_text_transform = isset( $wtl_settings['wp_timeline_sale_tag_font_text_transform'] ) ? $wtl_settings['wp_timeline_sale_tag_font_text_transform'] : 'none'; ?>
															<div class="select-cover">
																<select name="wp_timeline_sale_tag_font_text_transform" id="wp_timeline_sale_tag_font_text_transform">
																	<option <?php selected( $wp_timeline_sale_tag_font_text_transform, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'wp-timeline-designer-pro' ); ?></option>
																	<option <?php selected( $wp_timeline_sale_tag_font_text_transform, 'capitalize' ); ?> value="capitalize"><?php esc_html_e( 'Capitalize', 'wp-timeline-designer-pro' ); ?></option>
																	<option <?php selected( $wp_timeline_sale_tag_font_text_transform, 'uppercase' ); ?> value="uppercase"><?php esc_html_e( 'Uppercase', 'wp-timeline-designer-pro' ); ?></option>
																	<option <?php selected( $wp_timeline_sale_tag_font_text_transform, 'lowercase' ); ?> value="lowercase"><?php esc_html_e( 'Lowercase', 'wp-timeline-designer-pro' ); ?></option>
																	<option <?php selected( $wp_timeline_sale_tag_font_text_transform, 'full-width' ); ?> value="full-width"><?php esc_html_e( 'Full Width', 'wp-timeline-designer-pro' ); ?></option>
																</select>
															</div>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Text Decoration', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select sale tag text decoration style', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content">
														<?php $wp_timeline_sale_tag_font_text_decoration = isset( $wtl_settings['wp_timeline_sale_tag_font_text_decoration'] ) ? $wtl_settings['wp_timeline_sale_tag_font_text_decoration'] : 'none'; ?>
														<div class="select-cover">
															<select name="wp_timeline_sale_tag_font_text_decoration" id="wp_timeline_sale_tag_font_text_decoration">
																<option <?php selected( $wp_timeline_sale_tag_font_text_decoration, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'wp-timeline-designer-pro' ); ?></option>
																<option <?php selected( $wp_timeline_sale_tag_font_text_decoration, 'underline' ); ?> value="underline"><?php esc_html_e( 'Underline', 'wp-timeline-designer-pro' ); ?></option>
																<option <?php selected( $wp_timeline_sale_tag_font_text_decoration, 'overline' ); ?> value="overline"><?php esc_html_e( 'Overline', 'wp-timeline-designer-pro' ); ?></option>
																<option <?php selected( $wp_timeline_sale_tag_font_text_decoration, 'line-through' ); ?> value="line-through"><?php esc_html_e( 'Line Through', 'wp-timeline-designer-pro' ); ?></option>
															</select>
														</div>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Letter Spacing (px)', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enter sale tag letter spacing', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content"><div class="input-type-number"><input type="number" name="wp_timeline_sale_tag_font_letter_spacing" id="wp_timeline_sale_tag_font_letter_spacing" step="1" min="0" value="<?php echo isset( $wtl_settings['wp_timeline_sale_tag_font_letter_spacing'] ) ? esc_attr( $wtl_settings['wp_timeline_sale_tag_font_letter_spacing'] ) : '0'; ?>" >
													<div class="input-type-number-nav">
														<div class="input-type-number-button input-type-number-up">+</div>
														<div class="input-type-number-button input-type-number-down">-</div>
													</div></div></div>
												</div>
											</div>
										</li>
									</ul>
								</li>
								<li>
									<?php wtl_setting_left( esc_html__( 'Display Product Rating', 'wp-timeline-designer-pro' ) ); ?>
									<div class="wp-timeline-right">
										<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable product rating', 'wp-timeline-designer-pro' ); ?></span></span>
										<?php
										$display_product_rating = '0';
										if ( isset( $wtl_settings['display_product_rating'] ) ) {
											$display_product_rating = $wtl_settings['display_product_rating'];
										}
										?>
										<fieldset class="wp-timeline-social-style buttonset ui-buttonset buttonset-hide" data-hide='1'>
											<input id="display_product_rating_1" name="display_product_rating" type="radio" value="1" <?php checked( 1, $display_product_rating ); ?> />
											<label id="wp-timeline-options-button" for="display_product_rating_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $display_product_rating ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
											<input id="display_product_rating_0" name="display_product_rating" type="radio" value="0" <?php checked( 0, $display_product_rating ); ?> />
											<label id="wp-timeline-options-button" for="display_product_rating_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 1, $display_product_rating ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
										</fieldset>
									</div>
								</li>
								<li class="wp_timeline_star_rating_setting">
									<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Star Rating Settings', 'wp-timeline-designer-pro' ); ?></h3>
									<ul>
										<li class="wp_timeline_star_rating_tr">
											<?php wtl_setting_left( esc_html__( 'Star Color', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right wp-timeline-color-picker">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select star rating color', 'wp-timeline-designer-pro' ); ?></span></span>
												<?php $wp_timeline_star_rating_color = ( isset( $wtl_settings['wp_timeline_star_rating_color'] ) && '' != $wtl_settings['wp_timeline_star_rating_color'] ) ? $wtl_settings['wp_timeline_star_rating_color'] : ''; ?>
												<input type="text" name="wp_timeline_star_rating_color" id="wp_timeline_star_rating_color" value="<?php echo esc_attr( $wp_timeline_star_rating_color ); ?>"/>
											</div>
										</li>
										<li class="wp_timeline_star_rating_tr">
											<?php wtl_setting_left( esc_html__( 'Background Color', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right wp-timeline-color-picker">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select star background color', 'wp-timeline-designer-pro' ); ?></span></span>
												<?php $wp_timeline_star_rating_bg_color = ( isset( $wtl_settings['wp_timeline_star_rating_bg_color'] ) && '' != $wtl_settings['wp_timeline_star_rating_bg_color'] ) ? $wtl_settings['wp_timeline_star_rating_bg_color'] : ''; ?>
												<input type="text" name="wp_timeline_star_rating_bg_color" id="wp_timeline_star_rating_bg_color" value="<?php echo esc_attr( $wp_timeline_star_rating_bg_color ); ?>"/>
											</div>
										</li>
										<li class="wp_timeline_star_rating_tr wp_timeline_saletag_alignment_tr">
											<?php wtl_setting_left( esc_html__( 'Alignment', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon "><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select star rating alignment', 'wp-timeline-designer-pro' ); ?></span></span>
												<?php
												$wp_timeline_star_rating_alignment = 'left';
												if ( isset( $wtl_settings['wp_timeline_star_rating_alignment'] ) ) {
													$wp_timeline_star_rating_alignment = $wtl_settings['wp_timeline_star_rating_alignment'];
												}
												?>
												<fieldset class="buttonset ui-buttonset green" data-hide='1'>
													<input id="wp_timeline_star_rating_alignment_left" name="wp_timeline_star_rating_alignment" type="radio" value="left" <?php checked( 'left', $wp_timeline_star_rating_alignment ); ?> />
													<label id="wp-timeline-options-button" for="wp_timeline_star_rating_alignment_left"><?php esc_html_e( 'Left', 'wp-timeline-designer-pro' ); ?></label>
													<input id="wp_timeline_star_rating_alignment_center" name="wp_timeline_star_rating_alignment" type="radio" value="center" <?php checked( 'center', $wp_timeline_star_rating_alignment ); ?> />
													<label id="wp-timeline-options-button" for="wp_timeline_star_rating_alignment_center" class="wp_timeline_star_rating_alignment_center"><?php esc_html_e( 'Center', 'wp-timeline-designer-pro' ); ?></label>
													<input id="wp_timeline_star_rating_alignment_right" name="wp_timeline_star_rating_alignment" type="radio" value="right" <?php checked( 'right', $wp_timeline_star_rating_alignment ); ?> />
													<label id="wp-timeline-options-button" for="wp_timeline_star_rating_alignment_right"><?php esc_html_e( 'Right', 'wp-timeline-designer-pro' ); ?></label>
												</fieldset>
											</div>
										</li>
										<li class="wp_timeline_star_rating_tr">
											<?php wtl_setting_left( esc_html__( 'Padding', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right wp-timeline-border-cover">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select star rating padding', 'wp-timeline-designer-pro' ); ?></span></span>
												<div class="wp-timeline-padding-wrapper wp-timeline-padding-wrapper1 wp-timeline-border-wrap">
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Left (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_star_rating_paddingleft = isset( $wtl_settings['wp_timeline_star_rating_paddingleft'] ) ? $wtl_settings['wp_timeline_star_rating_paddingleft'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_star_rating_paddingleft" name="wp_timeline_star_rating_paddingleft" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_star_rating_paddingleft ); ?>"  >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Right (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_star_rating_paddingright = isset( $wtl_settings['wp_timeline_star_rating_paddingright'] ) ? $wtl_settings['wp_timeline_star_rating_paddingright'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_star_rating_paddingright" name="wp_timeline_star_rating_paddingright" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_star_rating_paddingright ); ?>" >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Top (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_star_rating_paddingtop = isset( $wtl_settings['wp_timeline_star_rating_paddingtop'] ) ? $wtl_settings['wp_timeline_star_rating_paddingtop'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_star_rating_paddingtop" name="wp_timeline_star_rating_paddingtop" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_star_rating_paddingtop ); ?>"  >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Bottom (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_star_rating_paddingbottom = isset( $wtl_settings['wp_timeline_star_rating_paddingbottom'] ) ? $wtl_settings['wp_timeline_star_rating_paddingbottom'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_star_rating_paddingbottom" name="wp_timeline_star_rating_paddingbottom" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_star_rating_paddingbottom ); ?>" >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li class="wp_timeline_star_rating_tr">
											<?php wtl_setting_left( esc_html__( 'Margin', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right wp-timeline-border-cover">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select star rating margin', 'wp-timeline-designer-pro' ); ?></span></span>
												<div class="wp-timeline-padding-wrapper wp-timeline-padding-wrapper1 wp-timeline-border-wrap">
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Left (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_star_rating_marginleft = isset( $wtl_settings['wp_timeline_star_rating_marginleft'] ) ? $wtl_settings['wp_timeline_star_rating_marginleft'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_star_rating_marginleft" name="wp_timeline_star_rating_marginleft" step="1" value="<?php echo esc_attr( $wp_timeline_star_rating_marginleft ); ?>" >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Right (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_star_rating_marginright = isset( $wtl_settings['wp_timeline_star_rating_marginright'] ) ? $wtl_settings['wp_timeline_star_rating_marginright'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_star_rating_marginright" name="wp_timeline_star_rating_marginright" step="1" value="<?php echo esc_attr( $wp_timeline_star_rating_marginright ); ?>" >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Top (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_star_rating_margintop = isset( $wtl_settings['wp_timeline_star_rating_margintop'] ) ? $wtl_settings['wp_timeline_star_rating_margintop'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_star_rating_margintop" name="wp_timeline_star_rating_margintop" step="1" value="<?php echo esc_attr( $wp_timeline_star_rating_margintop ); ?>"  >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Bottom (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_star_rating_marginbottom = isset( $wtl_settings['wp_timeline_star_rating_marginbottom'] ) ? $wtl_settings['wp_timeline_star_rating_marginbottom'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_star_rating_marginbottom" name="wp_timeline_star_rating_marginbottom" step="1" value="<?php echo esc_attr( $wp_timeline_star_rating_marginbottom ); ?>" >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</li>
									</ul>
								</li>
								<li>
									<?php wtl_setting_left( esc_html__( 'Display Price', 'wp-timeline-designer-pro' ) ); ?>
									<div class="wp-timeline-right">
										<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable price', 'wp-timeline-designer-pro' ); ?></span></span>
										<?php
										$display_product_price = '1';
										if ( isset( $wtl_settings['display_product_price'] ) ) {
											$display_product_price = $wtl_settings['display_product_price'];
										}
										?>
										<fieldset class="wp-timeline-social-style buttonset ui-buttonset buttonset-hide" data-hide='1'>
											<input id="display_product_price_1" name="display_product_price" type="radio" value="1" <?php checked( 1, $display_product_price ); ?> />
											<label id="wp-timeline-options-button" for="display_product_price_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $display_product_price ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
											<input id="display_product_price_0" name="display_product_price" type="radio" value="0" <?php checked( 0, $display_product_price ); ?> />
											<label id="wp-timeline-options-button" for="display_product_price_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 1, $display_product_price ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
										</fieldset>
									</div>
								</li>
								<li class="wp_timeline_price_setting">
									<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Price Settings', 'wp-timeline-designer-pro' ); ?></h3>
									<ul>
										<li class="wp_timeline_pricetext_tr">
											<?php wtl_setting_left( esc_html__( 'Text Color', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right wp-timeline-color-picker">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select price text color', 'wp-timeline-designer-pro' ); ?></span></span>
												<?php $wp_timeline_pricetextcolor = ( isset( $wtl_settings['wp_timeline_pricetextcolor'] ) && '' != $wtl_settings['wp_timeline_pricetextcolor'] ) ? $wtl_settings['wp_timeline_pricetextcolor'] : ''; ?>
												<input type="text" name="wp_timeline_pricetextcolor" id="wp_timeline_pricetextcolor" value="<?php echo esc_attr( $wp_timeline_pricetextcolor ); ?>"/>
											</div>
										</li>
										<li class="wp_timeline_pricetext_tr wp_timeline_pricetext_alignment_tr">
											<?php wtl_setting_left( esc_html__( 'Alignment', 'wp-timeline-designer-pro' ) ); ?>                                            
											<div class="wp-timeline-right">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select price text alignment', 'wp-timeline-designer-pro' ); ?></span></span>
												<?php
												$wp_timeline_pricetext_alignment = 'left';
												if ( isset( $wtl_settings['wp_timeline_pricetext_alignment'] ) ) {
													$wp_timeline_pricetext_alignment = $wtl_settings['wp_timeline_pricetext_alignment'];
												}
												?>
												<fieldset class="buttonset ui-buttonset green" data-hide='1'>
													<input id="wp_timeline_pricetext_alignment_left" name="wp_timeline_pricetext_alignment" type="radio" value="left" <?php checked( 'left', $wp_timeline_pricetext_alignment ); ?> />
													<label id="wp-timeline-options-button" for="wp_timeline_pricetext_alignment_left"><?php esc_html_e( 'Left', 'wp-timeline-designer-pro' ); ?></label>
													<input id="wp_timeline_pricetext_alignment_center" name="wp_timeline_pricetext_alignment" type="radio" value="center" <?php checked( 'center', $wp_timeline_pricetext_alignment ); ?> />
													<label id="wp-timeline-options-button" for="wp_timeline_pricetext_alignment_center" class="wp_timeline_pricetext_alignment_center"><?php esc_html_e( 'Center', 'wp-timeline-designer-pro' ); ?></label>
													<input id="wp_timeline_pricetext_alignment_right" name="wp_timeline_pricetext_alignment" type="radio" value="right" <?php checked( 'right', $wp_timeline_pricetext_alignment ); ?> />
													<label id="wp-timeline-options-button" for="wp_timeline_pricetext_alignment_right"><?php esc_html_e( 'Right', 'wp-timeline-designer-pro' ); ?></label>
												</fieldset>
											</div>
										</li>
										<li class="wp_timeline_pricetext_tr wp_timeline_pricetext_padding_setting_tr">
											<?php wtl_setting_left( esc_html__( 'Padding', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right wp-timeline-border-cover">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Set price text padding', 'wp-timeline-designer-pro' ); ?></span></span>
												<div class="wp-timeline-padding-wrapper wp-timeline-padding-wrapper1 wp-timeline-border-wrap">
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Left (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_pricetext_paddingleft = isset( $wtl_settings['wp_timeline_pricetext_paddingleft'] ) ? $wtl_settings['wp_timeline_pricetext_paddingleft'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_pricetext_paddingleft" name="wp_timeline_pricetext_paddingleft" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_pricetext_paddingleft ); ?>"  >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Right (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_pricetext_paddingright = isset( $wtl_settings['wp_timeline_pricetext_paddingright'] ) ? $wtl_settings['wp_timeline_pricetext_paddingright'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_pricetext_paddingright" name="wp_timeline_pricetext_paddingright" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_pricetext_paddingright ); ?>" >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Top (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_pricetext_paddingtop = isset( $wtl_settings['wp_timeline_pricetext_paddingtop'] ) ? $wtl_settings['wp_timeline_pricetext_paddingtop'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_pricetext_paddingtop" name="wp_timeline_pricetext_paddingtop" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_pricetext_paddingtop ); ?>"  >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Bottom (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_pricetext_paddingbottom = isset( $wtl_settings['wp_timeline_pricetext_paddingbottom'] ) ? $wtl_settings['wp_timeline_pricetext_paddingbottom'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_pricetext_paddingbottom" name="wp_timeline_pricetext_paddingbottom" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_pricetext_paddingbottom ); ?>" >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li class="wp_timeline_pricetext_tr wp_timeline_pricetext_marging_setting_tr">
											<?php wtl_setting_left( esc_html__( 'Margin', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right wp-timeline-border-cover">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select price text margin', 'wp-timeline-designer-pro' ); ?></span></span>
												<div class="wp-timeline-padding-wrapper wp-timeline-padding-wrapper1 wp-timeline-border-wrap">
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Left (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_pricetext_marginleft = isset( $wtl_settings['wp_timeline_pricetext_marginleft'] ) ? $wtl_settings['wp_timeline_pricetext_marginleft'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_pricetext_marginleft" name="wp_timeline_pricetext_marginleft" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_pricetext_marginleft ); ?>" >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Right (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_pricetext_marginright = isset( $wtl_settings['wp_timeline_pricetext_marginright'] ) ? $wtl_settings['wp_timeline_pricetext_marginright'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_pricetext_marginright" name="wp_timeline_pricetext_marginright" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_pricetext_marginright ); ?>" >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Top (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_pricetext_margintop = isset( $wtl_settings['wp_timeline_pricetext_margintop'] ) ? $wtl_settings['wp_timeline_pricetext_margintop'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_pricetext_margintop" name="wp_timeline_pricetext_margintop" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_pricetext_margintop ); ?>"  >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Bottom (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_pricetext_marginbottom = isset( $wtl_settings['wp_timeline_pricetext_marginbottom'] ) ? $wtl_settings['wp_timeline_pricetext_marginbottom'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_pricetext_marginbottom" name="wp_timeline_pricetext_marginbottom" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_pricetext_marginbottom ); ?>" >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li class="wp_timeline_pricetext_tr wp_timeline_pricetext_typography_setting_tr">
											<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Typography Settings', 'wp-timeline-designer-pro' ); ?></h3>
											<div class="wp-timeline-typography-wrapper wp-timeline-typography-wrapper1">
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Font Family', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select price text font family', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content">
														<?php
														if ( isset( $wtl_settings['wp_timeline_pricefontface'] ) && '' != $wtl_settings['wp_timeline_pricefontface'] ) {
															$wp_timeline_pricefontface = $wtl_settings['wp_timeline_pricefontface'];
														} else {
															$wp_timeline_pricefontface = '';
														}
														?>
														<div class="typo-field">
															<input type="hidden" id="wp_timeline_pricefontface_font_type" name="wp_timeline_pricefontface_font_type" value="<?php echo isset( $wtl_settings['wp_timeline_pricefontface_font_type'] ) ? esc_attr( $wtl_settings['wp_timeline_pricefontface_font_type'] ) : ''; ?>">
															<div class="select-cover">
																<select name="wp_timeline_pricefontface" id="wp_timeline_pricefontface">
																	<option value=""><?php esc_html_e( 'Select Font Family', 'wp-timeline-designer-pro' ); ?></option>
																	<?php
																	$old_version = '';
																	$cnt         = 0;
																	$font_family = Wp_Timeline_Main::wtl_default_recognized_font_faces();
																	foreach ( $font_family as $key => $value ) {
																		if ( $value['version'] != $old_version ) {
																			if ( $cnt > 0 ) {
																				echo '</optgroup>';
																			}
																			echo '<optgroup label="' . esc_attr( $value['version'] ) . '">';
																			$old_version = $value['version'];
																		}
																		echo "<option value='" . esc_attr( str_replace( '"', '', $value['label'] ) ) . "'";
																		if ( '' != $wp_timeline_pricefontface && ( str_replace( '"', '', $wp_timeline_pricefontface ) == str_replace( '"', '', $value['label'] ) ) ) {
																			echo ' selected';
																		}
																		echo '>' . esc_attr( $value['label'] ) . '</option>';
																		$cnt++;
																	}
																	if ( count( $font_family ) == $cnt ) {
																		echo '</optgroup>';
																	}
																	?>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Font Size (px)', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select price text font size', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content">
														<?php
														if ( isset( $wtl_settings['wp_timeline_pricefontsize'] ) && '' != $wtl_settings['wp_timeline_pricefontsize'] ) {
															$wp_timeline_pricefontsize = $wtl_settings['wp_timeline_pricefontsize'];
														} else {
															$wp_timeline_pricefontsize = 14;
														}
														?>
														<div class="grid_col_space range_slider_fontsize" id="wp_timeline_pricefontsizeInput" ></div>
														<div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="wp_timeline_pricefontsize" id="wp_timeline_pricefontsize" value="<?php echo esc_attr( $wp_timeline_pricefontsize ); ?>"  /></div>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Font Weight', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select price text font weight', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content">
														<?php $wp_timeline_price_font_weight = isset( $wtl_settings['wp_timeline_price_font_weight'] ) ? $wtl_settings['wp_timeline_price_font_weight'] : 'normal'; ?>
														<div class="select-cover">
															<select name="wp_timeline_price_font_weight" id="wp_timeline_price_font_weight">
																<option value="100" <?php selected( $wp_timeline_price_font_weight, 100 ); ?>>100</option>
																<option value="200" <?php selected( $wp_timeline_price_font_weight, 200 ); ?>>200</option>
																<option value="300" <?php selected( $wp_timeline_price_font_weight, 300 ); ?>>300</option>
																<option value="400" <?php selected( $wp_timeline_price_font_weight, 400 ); ?>>400</option>
																<option value="500" <?php selected( $wp_timeline_price_font_weight, 500 ); ?>>500</option>
																<option value="600" <?php selected( $wp_timeline_price_font_weight, 600 ); ?>>600</option>
																<option value="700" <?php selected( $wp_timeline_price_font_weight, 700 ); ?>>700</option>
																<option value="800" <?php selected( $wp_timeline_price_font_weight, 800 ); ?>>800</option>
																<option value="900" <?php selected( $wp_timeline_price_font_weight, 900 ); ?>>900</option>
																<option value="bold" <?php selected( $wp_timeline_price_font_weight, 'bold' ); ?> ><?php esc_html_e( 'Bold', 'wp-timeline-designer-pro' ); ?></option>
																<option value="normal" <?php selected( $wp_timeline_price_font_weight, 'normal' ); ?>><?php esc_html_e( 'Normal', 'wp-timeline-designer-pro' ); ?></option>
															</select>
														</div>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Line Height', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select price text line height', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content"><div class="input-type-number"><input type="number" name="wp_timeline_price_font_line_height" id="wp_timeline_price_font_line_height" step="0.1" min="0" value="<?php echo isset( $wtl_settings['wp_timeline_price_font_line_height'] ) ? esc_attr( $wtl_settings['wp_timeline_price_font_line_height'] ) : '1.5'; ?>"  >
													<div class="input-type-number-nav">
														<div class="input-type-number-button input-type-number-up">+</div>
														<div class="input-type-number-button input-type-number-down">-</div>
													</div></div></div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Italic Font Style', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Display price text italic font style', 'wp-timeline-designer-pro' ); ?></span></span><?php $wp_timeline_price_font_italic = isset( $wtl_settings['wp_timeline_price_font_italic'] ) ? $wtl_settings['wp_timeline_price_font_italic'] : '0'; ?>
													</div>
													<div class="wp-timeline-typography-content">
														<fieldset class="wp-timeline-social-options wp-timeline-display_author buttonset ui-buttonset">
															<input id="wp_timeline_price_font_italic_1" name="wp_timeline_price_font_italic" type="radio" value="1"  <?php checked( 1, $wp_timeline_price_font_italic ); ?> />
															<label for="wp_timeline_price_font_italic_1" class="<?php echo esc_html( $uic_l ); ?>"><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
															<input id="wp_timeline_price_font_italic_0" name="wp_timeline_price_font_italic" type="radio" value="0" <?php checked( 0, $wp_timeline_price_font_italic ); ?> />
															<label for="wp_timeline_price_font_italic_0" class="<?php echo esc_html( $uic_r ); ?>"><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
														</fieldset>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Text Transform', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select price text transform style', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content">
														<?php $wp_timeline_price_font_text_transform = isset( $wtl_settings['wp_timeline_price_font_text_transform'] ) ? $wtl_settings['wp_timeline_price_font_text_transform'] : 'none'; ?>
															<div class="select-cover">
																<select name="wp_timeline_price_font_text_transform" id="wp_timeline_price_font_text_transform">
																	<option <?php selected( $wp_timeline_price_font_text_transform, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'wp-timeline-designer-pro' ); ?></option>
																	<option <?php selected( $wp_timeline_price_font_text_transform, 'capitalize' ); ?> value="capitalize"><?php esc_html_e( 'Capitalize', 'wp-timeline-designer-pro' ); ?></option>
																	<option <?php selected( $wp_timeline_price_font_text_transform, 'uppercase' ); ?> value="uppercase"><?php esc_html_e( 'Uppercase', 'wp-timeline-designer-pro' ); ?></option>
																	<option <?php selected( $wp_timeline_price_font_text_transform, 'lowercase' ); ?> value="lowercase"><?php esc_html_e( 'Lowercase', 'wp-timeline-designer-pro' ); ?></option>
																	<option <?php selected( $wp_timeline_price_font_text_transform, 'full-width' ); ?> value="full-width"><?php esc_html_e( 'Full Width', 'wp-timeline-designer-pro' ); ?></option>
																</select>
															</div>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Text Decoration', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select price text decoration style', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content">
														<?php $wp_timeline_price_font_text_decoration = isset( $wtl_settings['wp_timeline_price_font_text_decoration'] ) ? $wtl_settings['wp_timeline_price_font_text_decoration'] : 'none'; ?>
														<div class="select-cover">
															<select name="wp_timeline_price_font_text_decoration" id="wp_timeline_price_font_text_decoration">
																<option <?php selected( $wp_timeline_price_font_text_decoration, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'wp-timeline-designer-pro' ); ?></option>
																<option <?php selected( $wp_timeline_price_font_text_decoration, 'underline' ); ?> value="underline"><?php esc_html_e( 'Underline', 'wp-timeline-designer-pro' ); ?></option>
																<option <?php selected( $wp_timeline_price_font_text_decoration, 'overline' ); ?> value="overline"><?php esc_html_e( 'Overline', 'wp-timeline-designer-pro' ); ?></option>
																<option <?php selected( $wp_timeline_price_font_text_decoration, 'line-through' ); ?> value="line-through"><?php esc_html_e( 'Line Through', 'wp-timeline-designer-pro' ); ?></option>
															</select>
														</div>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Letter Spacing (px)', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enter price text letter spacing', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content"><div class="input-type-number"><input type="number" name="wp_timeline_price_font_letter_spacing" id="wp_timeline_price_font_letter_spacing" step="1" min="0" value="<?php echo isset( $wtl_settings['wp_timeline_price_font_letter_spacing'] ) ? esc_attr( $wtl_settings['wp_timeline_price_font_letter_spacing'] ) : '0'; ?>" >
													<div class="input-type-number-nav">
														<div class="input-type-number-button input-type-number-up">+</div>
														<div class="input-type-number-button input-type-number-down">-</div>
													</div></div></div>
												</div>
											</div>
										</li>
									</ul>
								</li>
								<li>
									<?php wtl_setting_left( esc_html__( 'Display Add To Cart Button', 'wp-timeline-designer-pro' ) ); ?>
									<div class="wp-timeline-right">
										<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable add to cart button', 'wp-timeline-designer-pro' ); ?></span></span>
										<?php
										$display_addtocart_button = '1';
										if ( isset( $wtl_settings['display_addtocart_button'] ) ) {
											$display_addtocart_button = $wtl_settings['display_addtocart_button'];
										}
										?>
										<fieldset class="wp-timeline-social-style buttonset ui-buttonset buttonset-hide" data-hide='1'>
											<input id="display_addtocart_button_1" name="display_addtocart_button" type="radio" value="1" <?php checked( 1, $display_addtocart_button ); ?> />
											<label id="wp-timeline-options-button" for="display_addtocart_button_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $display_addtocart_button ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
											<input id="display_addtocart_button_0" name="display_addtocart_button" type="radio" value="0" <?php checked( 0, $display_addtocart_button ); ?> />
											<label id="wp-timeline-options-button" for="display_addtocart_button_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $display_addtocart_button ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
										</fieldset>
									</div>
								</li>
								<li class="wp_timeline_cart_button_setting">
									<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Cart Button Settings', 'wp-timeline-designer-pro' ); ?></h3>
									<ul>
										<li class="wp_timeline_add_to_cart_tr cart_button_alignment">
											<?php wtl_setting_left( esc_html__( 'Alignment', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select cart button alignment', 'wp-timeline-designer-pro' ); ?></span></span>
												<?php
												$wp_timeline_addtocartbutton_alignment = 'left';
												if ( isset( $wtl_settings['wp_timeline_addtocartbutton_alignment'] ) ) {
													$wp_timeline_addtocartbutton_alignment = $wtl_settings['wp_timeline_addtocartbutton_alignment'];
												}
												?>
												<fieldset class="buttonset ui-buttonset green" data-hide='1'>
													<input id="wp_timeline_addtocartbutton_alignment_left" name="wp_timeline_addtocartbutton_alignment" type="radio" value="left" <?php checked( 'left', $wp_timeline_addtocartbutton_alignment ); ?> />
													<label id="wp-timeline-options-button" for="wp_timeline_addtocartbutton_alignment_left"><?php esc_html_e( 'Left', 'wp-timeline-designer-pro' ); ?></label>
													<input id="wp_timeline_addtocartbutton_alignment_center" name="wp_timeline_addtocartbutton_alignment" type="radio" value="center" <?php checked( 'center', $wp_timeline_addtocartbutton_alignment ); ?> />
													<label id="wp-timeline-options-button" for="wp_timeline_addtocartbutton_alignment_center" class="wp_timeline_addtocartbutton_alignment_center"><?php esc_html_e( 'Center', 'wp-timeline-designer-pro' ); ?></label>
													<input id="wp_timeline_addtocartbutton_alignment_right" name="wp_timeline_addtocartbutton_alignment" type="radio" value="right" <?php checked( 'right', $wp_timeline_addtocartbutton_alignment ); ?> />
													<label id="wp-timeline-options-button" for="wp_timeline_addtocartbutton_alignment_right"><?php esc_html_e( 'Right', 'wp-timeline-designer-pro' ); ?></label>
												</fieldset>
											</div>
										</li>
										<li class="wp_timeline_add_to_cart_tr">
											<?php wtl_setting_left( esc_html__( 'Text Color', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right wp-timeline-color-picker">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select cart button text color', 'wp-timeline-designer-pro' ); ?></span></span>
												<?php
												if ( isset( $wtl_settings['wp_timeline_addtocart_textcolor'] ) ) {
													$wp_timeline_addtocart_textcolor = $wtl_settings['wp_timeline_addtocart_textcolor'];
												} else {
													$wp_timeline_addtocart_textcolor = '';
												}
												?>
												<input type="text" name="wp_timeline_addtocart_textcolor" id="wp_timeline_addtocart_textcolor" value="<?php echo esc_attr( $wp_timeline_addtocart_textcolor ); ?>"/>
											</div>
										</li>
										<li class="wp_timeline_add_to_cart_tr">
											<?php wtl_setting_left( esc_html__( 'Hover Text Color', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right wp-timeline-color-picker">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select cart button text hover color', 'wp-timeline-designer-pro' ); ?></span></span>
												<?php $wp_timeline_addtocart_text_hover_color = isset( $wtl_settings['wp_timeline_addtocart_text_hover_color'] ) ? $wtl_settings['wp_timeline_addtocart_text_hover_color'] : ''; ?>
												<input type="text" name="wp_timeline_addtocart_text_hover_color" id="wp_timeline_addtocart_text_hover_color" value="<?php echo esc_attr( $wp_timeline_addtocart_text_hover_color ); ?>"/>
											</div>
										</li>
										<li class="wp_timeline_add_to_cart_tr">
											<?php wtl_setting_left( esc_html__( 'Background Color', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right wp-timeline-color-picker">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select cart button background color', 'wp-timeline-designer-pro' ); ?></span></span>
												<?php $wp_timeline_addtocart_backgroundcolor = isset( $wtl_settings['wp_timeline_addtocart_backgroundcolor'] ) ? $wtl_settings['wp_timeline_addtocart_backgroundcolor'] : ''; ?>
												<input type="text" name="wp_timeline_addtocart_backgroundcolor" id="wp_timeline_addtocart_backgroundcolor" value="<?php echo esc_attr( $wp_timeline_addtocart_backgroundcolor ); ?>"/>
											</div>
										</li>
										<li class="wp_timeline_add_to_cart_tr">
											<?php wtl_setting_left( esc_html__( 'Hover Background Color', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right wp-timeline-color-picker">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select cart button hover background color', 'wp-timeline-designer-pro' ); ?></span></span>
												<?php $wp_timeline_addtocart_hover_backgroundcolor = isset( $wtl_settings['wp_timeline_addtocart_hover_backgroundcolor'] ) ? $wtl_settings['wp_timeline_addtocart_hover_backgroundcolor'] : ''; ?>
												<input type="text" name="wp_timeline_addtocart_hover_backgroundcolor" id="wp_timeline_addtocart_hover_backgroundcolor" value="<?php echo esc_attr( $wp_timeline_addtocart_hover_backgroundcolor ); ?>"/>
											</div>
										</li>
										<li class="wp_timeline_addtocart_button_border_setting wp_timeline_add_to_cart_tr">
											<?php wtl_setting_left( esc_html__( 'Border Radius(px)', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select cart button border radius', 'wp-timeline-designer-pro' ); ?></span></span>
												<?php
												$display_addtocart_button_border_radius = '0';
												if ( isset( $wtl_settings['display_addtocart_button_border_radius'] ) ) {
													$display_addtocart_button_border_radius = $wtl_settings['display_addtocart_button_border_radius'];
												}
												?>
												<div class="input-type-number">
													<input type="number" id="display_addtocart_button_border_radius" name="display_addtocart_button_border_radius" step="1" min="0" value="<?php echo esc_attr( $display_addtocart_button_border_radius ); ?>" >
													<div class="input-type-number-nav">
														<div class="input-type-number-button input-type-number-up">+</div>
														<div class="input-type-number-button input-type-number-down">-</div>
													</div>
												</div>
											</div>
										</li>
										<li class="wp_timeline_addtocart_button_border_setting wp_timeline_add_to_cart_tr">
											<?php wtl_setting_left( esc_html__( 'Border', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right wp-timeline-border-cover">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select cart button border', 'wp-timeline-designer-pro' ); ?></span></span>
												<div class="wp-timeline-border-wrap">
													<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
														<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Left (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-border-cover">
															<div class="wp-timeline-border-content">
																<?php $wp_timeline_addtocartbutton_borderleft = isset( $wtl_settings['wp_timeline_addtocartbutton_borderleft'] ) ? $wtl_settings['wp_timeline_addtocartbutton_borderleft'] : '0'; ?>
																<div class="input-type-number">
																	<input type="number" id="wp_timeline_addtocartbutton_borderleft" name="wp_timeline_addtocartbutton_borderleft" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_addtocartbutton_borderleft ); ?>"  >
																	<div class="input-type-number-nav">
																		<div class="input-type-number-button input-type-number-up">+</div>
																		<div class="input-type-number-button input-type-number-down">-</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="wp-timeline-border-cover wp-timeline-color-picker">
															<div class="wp-timeline-border-content">
																<?php $wp_timeline_addtocartbutton_borderleftcolor = isset( $wtl_settings['wp_timeline_addtocartbutton_borderleftcolor'] ) ? $wtl_settings['wp_timeline_addtocartbutton_borderleftcolor'] : ''; ?>
																<input type="text" name="wp_timeline_addtocartbutton_borderleftcolor" id="wp_timeline_addtocartbutton_borderleftcolor" value="<?php echo esc_attr( $wp_timeline_addtocartbutton_borderleftcolor ); ?>"/>
															</div>
														</div>
													</div> 
													<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
														<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Right (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-border-cover">
															<div class="wp-timeline-border-content">
																<?php $wp_timeline_addtocartbutton_borderright = isset( $wtl_settings['wp_timeline_addtocartbutton_borderright'] ) ? $wtl_settings['wp_timeline_addtocartbutton_borderright'] : '0'; ?>
																<div class="input-type-number">
																	<input type="number" id="wp_timeline_addtocartbutton_borderright" name="wp_timeline_addtocartbutton_borderright" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_addtocartbutton_borderright ); ?>" >
																	<div class="input-type-number-nav">
																		<div class="input-type-number-button input-type-number-up">+</div>
																		<div class="input-type-number-button input-type-number-down">-</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="wp-timeline-border-cover">
															<div class="wp-timeline-border-content wp-timeline-color-picker">
															<?php $wp_timeline_addtocartbutton_borderrightcolor = isset( $wtl_settings['wp_timeline_addtocartbutton_borderrightcolor'] ) ? $wtl_settings['wp_timeline_addtocartbutton_borderrightcolor'] : ''; ?>
																<input type="text" name="wp_timeline_addtocartbutton_borderrightcolor" id="wp_timeline_addtocartbutton_borderrightcolor" value="<?php echo esc_attr( $wp_timeline_addtocartbutton_borderrightcolor ); ?>"/>
															</div>
														</div>
													</div>
													<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
														<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Top (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-border-cover">
															<div class="wp-timeline-border-content">
																<?php $wp_timeline_addtocartbutton_bordertop = isset( $wtl_settings['wp_timeline_addtocartbutton_bordertop'] ) ? $wtl_settings['wp_timeline_addtocartbutton_bordertop'] : '0'; ?>
																<div class="input-type-number">
																	<input type="number" id="wp_timeline_addtocartbutton_bordertop" name="wp_timeline_addtocartbutton_bordertop" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_addtocartbutton_bordertop ); ?>" >
																	<div class="input-type-number-nav">
																		<div class="input-type-number-button input-type-number-up">+</div>
																		<div class="input-type-number-button input-type-number-down">-</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="wp-timeline-border-cover">
															<div class="wp-timeline-border-content wp-timeline-color-picker">
																<?php $wp_timeline_addtocartbutton_bordertopcolor = isset( $wtl_settings['wp_timeline_addtocartbutton_bordertopcolor'] ) ? $wtl_settings['wp_timeline_addtocartbutton_bordertopcolor'] : ''; ?>
																<input type="text" name="wp_timeline_addtocartbutton_bordertopcolor" id="wp_timeline_addtocartbutton_bordertopcolor" value="<?php echo esc_attr( $wp_timeline_addtocartbutton_bordertopcolor ); ?>"/>
															</div>
														</div>
													</div>
													<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
														<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Bottom(px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-border-cover">
															<div class="wp-timeline-border-content">
																<?php $wp_timeline_addtocartbutton_borderbuttom = isset( $wtl_settings['wp_timeline_addtocartbutton_borderbuttom'] ) ? $wtl_settings['wp_timeline_addtocartbutton_borderbuttom'] : '0'; ?>
																<div class="input-type-number">
																	<input type="number" id="wp_timeline_addtocartbutton_borderbuttom" name="wp_timeline_addtocartbutton_borderbuttom" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_addtocartbutton_borderbuttom ); ?>" >
																	<div class="input-type-number-nav">
																		<div class="input-type-number-button input-type-number-up">+</div>
																		<div class="input-type-number-button input-type-number-down">-</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="wp-timeline-border-cover wp-timeline-color-picker">
															<div class="wp-timeline-border-content">
															<?php $wp_timeline_addtocartbutton_borderbottomcolor = isset( $wtl_settings['wp_timeline_addtocartbutton_borderbottomcolor'] ) ? $wtl_settings['wp_timeline_addtocartbutton_borderbottomcolor'] : ''; ?>
															<input type="text" name="wp_timeline_addtocartbutton_borderbottomcolor" id="wp_timeline_addtocartbutton_borderbottomcolor" value="<?php echo esc_attr( $wp_timeline_addtocartbutton_borderbottomcolor ); ?>"/>
															</div>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li class="wp_timeline_addtocart_button_border_hover_setting wp_timeline_add_to_cart_tr">
											<?php wtl_setting_left( esc_html__( 'Hover Border Radius(px)', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select cart button hover border radius', 'wp-timeline-designer-pro' ); ?></span></span>
												<?php
												$display_addtocart_button_border_hover_radius = '0';
												if ( isset( $wtl_settings['display_addtocart_button_border_hover_radius'] ) ) {
													$display_addtocart_button_border_hover_radius = $wtl_settings['display_addtocart_button_border_hover_radius'];
												}
												?>
												<div class="input-type-number">
													<input type="number" id="display_addtocart_button_border_hover_radius" name="display_addtocart_button_border_hover_radius" step="1" min="0" value="<?php echo esc_attr( $display_addtocart_button_border_hover_radius ); ?>" >
													<div class="input-type-number-nav">
														<div class="input-type-number-button input-type-number-up">+</div>
														<div class="input-type-number-button input-type-number-down">-</div>
													</div>
												</div>
											</div>
										</li>
										<li class="wp_timeline_addtocart_button_border_hover_setting wp_timeline_add_to_cart_tr">
											<?php wtl_setting_left( esc_html__( 'Hover Border', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right wp-timeline-border-cover">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select cart button hover border', 'wp-timeline-designer-pro' ); ?></span></span>
												<div class="wp-timeline-border-wrap">
													<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
														<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Left (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-border-cover">
															<div class="wp-timeline-border-content">
																<?php $wp_timeline_addtocartbutton_hover_borderleft = isset( $wtl_settings['wp_timeline_addtocartbutton_hover_borderleft'] ) ? $wtl_settings['wp_timeline_addtocartbutton_hover_borderleft'] : '0'; ?>
																<div class="input-type-number">
																	<input type="number" id="wp_timeline_addtocartbutton_hover_borderleft" name="wp_timeline_addtocartbutton_hover_borderleft" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_addtocartbutton_hover_borderleft ); ?>"  >
																	<div class="input-type-number-nav">
																		<div class="input-type-number-button input-type-number-up">+</div>
																		<div class="input-type-number-button input-type-number-down">-</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="wp-timeline-border-cover wp-timeline-color-picker">
															<div class="wp-timeline-border-content">
																<?php $wp_timeline_addtocartbutton_hover_borderleftcolor = isset( $wtl_settings['wp_timeline_addtocartbutton_hover_borderleftcolor'] ) ? $wtl_settings['wp_timeline_addtocartbutton_hover_borderleftcolor'] : ''; ?>
																<input type="text" name="wp_timeline_addtocartbutton_hover_borderleftcolor" id="wp_timeline_addtocartbutton_hover_borderleftcolor" value="<?php echo esc_attr( $wp_timeline_addtocartbutton_hover_borderleftcolor ); ?>"/>
															</div>
														</div>
													</div> 
													<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
														<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Right (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-border-cover">
															<div class="wp-timeline-border-content">
																<?php $wp_timeline_addtocartbutton_hover_borderright = isset( $wtl_settings['wp_timeline_addtocartbutton_hover_borderright'] ) ? $wtl_settings['wp_timeline_addtocartbutton_hover_borderright'] : '0'; ?>
																<div class="input-type-number">
																	<input type="number" id="wp_timeline_addtocartbutton_hover_borderright" name="wp_timeline_addtocartbutton_hover_borderright" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_addtocartbutton_hover_borderright ); ?>" >
																	<div class="input-type-number-nav">
																		<div class="input-type-number-button input-type-number-up">+</div>
																		<div class="input-type-number-button input-type-number-down">-</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="wp-timeline-border-cover wp-timeline-color-picker">
															<div class="wp-timeline-border-content">
																<?php $wp_timeline_addtocartbutton_hover_borderrightcolor = isset( $wtl_settings['wp_timeline_addtocartbutton_hover_borderrightcolor'] ) ? $wtl_settings['wp_timeline_addtocartbutton_hover_borderrightcolor'] : ''; ?>
																<input type="text" name="wp_timeline_addtocartbutton_hover_borderrightcolor" id="wp_timeline_addtocartbutton_hover_borderrightcolor" value="<?php echo esc_attr( $wp_timeline_addtocartbutton_hover_borderrightcolor ); ?>"/>
															</div>
														</div>
													</div>
													<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
														<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Top (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-border-cover">
															<div class="wp-timeline-border-content">
																<?php $wp_timeline_addtocartbutton_hover_bordertop = isset( $wtl_settings['wp_timeline_addtocartbutton_hover_bordertop'] ) ? $wtl_settings['wp_timeline_addtocartbutton_hover_bordertop'] : '0'; ?>
																<div class="input-type-number">
																	<input type="number" id="wp_timeline_addtocartbutton_hover_bordertop" name="wp_timeline_addtocartbutton_hover_bordertop" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_addtocartbutton_hover_bordertop ); ?>" >
																	<div class="input-type-number-nav">
																		<div class="input-type-number-button input-type-number-up">+</div>
																		<div class="input-type-number-button input-type-number-down">-</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="wp-timeline-border-cover wp-timeline-color-picker">
															<div class="wp-timeline-border-content">
																<?php $wp_timeline_addtocartbutton_hover_bordertopcolor = isset( $wtl_settings['wp_timeline_addtocartbutton_hover_bordertopcolor'] ) ? $wtl_settings['wp_timeline_addtocartbutton_hover_bordertopcolor'] : ''; ?>
																<input type="text" name="wp_timeline_addtocartbutton_hover_bordertopcolor" id="wp_timeline_addtocartbutton_hover_bordertopcolor" value="<?php echo esc_attr( $wp_timeline_addtocartbutton_hover_bordertopcolor ); ?>"/>
															</div>
														</div>
													</div>
													<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
														<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Bottom(px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-border-cover">
															<div class="wp-timeline-border-content">
																<?php $wp_timeline_addtocartbutton_hover_borderbuttom = isset( $wtl_settings['wp_timeline_addtocartbutton_hover_borderbuttom'] ) ? $wtl_settings['wp_timeline_addtocartbutton_hover_borderbuttom'] : '0'; ?>
																<div class="input-type-number">
																	<input type="number" id="wp_timeline_addtocartbutton_hover_borderbuttom" name="wp_timeline_addtocartbutton_hover_borderbuttom" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_addtocartbutton_hover_borderbuttom ); ?>" >
																	<div class="input-type-number-nav">
																		<div class="input-type-number-button input-type-number-up">+</div>
																		<div class="input-type-number-button input-type-number-down">-</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="wp-timeline-border-cover wp-timeline-color-picker">
															<div class="wp-timeline-border-content">
																<?php $wp_timeline_addtocartbutton_hover_borderbottomcolor = isset( $wtl_settings['wp_timeline_addtocartbutton_hover_borderbottomcolor'] ) ? $wtl_settings['wp_timeline_addtocartbutton_hover_borderbottomcolor'] : ''; ?>
																<input type="text" name="wp_timeline_addtocartbutton_hover_borderbottomcolor" id="wp_timeline_addtocartbutton_hover_borderbottomcolor" value="<?php echo esc_attr( $wp_timeline_addtocartbutton_hover_borderbottomcolor ); ?>"/>
															</div>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li class="wp_timeline_add_to_cart_tr">
											<?php wtl_setting_left( esc_html__( 'Padding', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right wp-timeline-border-cover">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Set cart button padding', 'wp-timeline-designer-pro' ); ?></span></span>
												<div class="wp-timeline-padding-wrapper wp-timeline-padding-wrapper1 wp-timeline-border-wrap">
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Left-Right (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_addtocartbutton_padding_leftright = isset( $wtl_settings['wp_timeline_addtocartbutton_padding_leftright'] ) ? $wtl_settings['wp_timeline_addtocartbutton_padding_leftright'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_addtocartbutton_padding_leftright" name="wp_timeline_addtocartbutton_padding_leftright" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_addtocartbutton_padding_leftright ); ?>" >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Top-Bottom (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_addtocartbutton_padding_topbottom = isset( $wtl_settings['wp_timeline_addtocartbutton_padding_topbottom'] ) ? $wtl_settings['wp_timeline_addtocartbutton_padding_topbottom'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_addtocartbutton_padding_topbottom" name="wp_timeline_addtocartbutton_padding_topbottom" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_addtocartbutton_padding_topbottom ); ?>"  >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li class="wp_timeline_add_to_cart_tr">
											<?php wtl_setting_left( esc_html__( 'Margin', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right wp-timeline-border-cover">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Set cart button margin', 'wp-timeline-designer-pro' ); ?></span></span>
												<div class="wp-timeline-padding-wrapper wp-timeline-padding-wrapper1 wp-timeline-border-wrap">
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Left-Right (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_addtocartbutton_margin_leftright = isset( $wtl_settings['wp_timeline_addtocartbutton_margin_leftright'] ) ? $wtl_settings['wp_timeline_addtocartbutton_margin_leftright'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_addtocartbutton_margin_leftright" name="wp_timeline_addtocartbutton_margin_leftright" step="1" value="<?php echo esc_attr( $wp_timeline_addtocartbutton_margin_leftright ); ?>"  >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Top-Bottom (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_addtocartbutton_margin_topbottom = isset( $wtl_settings['wp_timeline_addtocartbutton_margin_topbottom'] ) ? $wtl_settings['wp_timeline_addtocartbutton_margin_topbottom'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_addtocartbutton_margin_topbottom" name="wp_timeline_addtocartbutton_margin_topbottom" step="1" value="<?php echo esc_attr( $wp_timeline_addtocartbutton_margin_topbottom ); ?>"  >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li class="wp_timeline_add_to_cart_tr addtocart_button_box_shadow_setting">
											<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Box Shadow Settings', 'wp-timeline-designer-pro' ); ?></h3>
											<div class="wp-timeline-boxshadow-wrapper wp-timeline-boxshadow-wrapper1">
												<div class="wp-timeline-boxshadow-cover">
													<div class="wp-timeline-boxshadow-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'H-offset (px)', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select horizontal offset value', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-boxshadow-content">
														<?php $wp_timeline_addtocart_button_top_box_shadow = isset( $wtl_settings['wp_timeline_addtocart_button_top_box_shadow'] ) ? $wtl_settings['wp_timeline_addtocart_button_top_box_shadow'] : '0'; ?>
														<div class="input-type-number">
															<input type="number" id="wp_timeline_addtocart_button_top_box_shadow" name="wp_timeline_addtocart_button_top_box_shadow" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_addtocart_button_top_box_shadow ); ?>"  >
															<div class="input-type-number-nav">
																<div class="input-type-number-button input-type-number-up">+</div>
																<div class="input-type-number-button input-type-number-down">-</div>
															</div>
														</div>
													</div>
												</div>
												<div class="wp-timeline-boxshadow-cover">
													<div class="wp-timeline-boxshadow-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'V-offset (px)', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select vertical offset value', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-boxshadow-content">
														<?php $wp_timeline_addtocart_button_right_box_shadow = isset( $wtl_settings['wp_timeline_addtocart_button_right_box_shadow'] ) ? $wtl_settings['wp_timeline_addtocart_button_right_box_shadow'] : '0'; ?>
														<div class="input-type-number">
															<input type="number" id="wp_timeline_addtocart_button_right_box_shadow" name="wp_timeline_addtocart_button_right_box_shadow" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_addtocart_button_right_box_shadow ); ?>"  >
															<div class="input-type-number-nav">
																<div class="input-type-number-button input-type-number-up">+</div>
																<div class="input-type-number-button input-type-number-down">-</div>
															</div>
														</div>
													</div>
												</div>
												<div class="wp-timeline-boxshadow-cover">
													<div class="wp-timeline-boxshadow-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Blur (px)', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select blur value', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-boxshadow-content">
														<?php $wp_timeline_addtocart_button_bottom_box_shadow = isset( $wtl_settings['wp_timeline_addtocart_button_bottom_box_shadow'] ) ? $wtl_settings['wp_timeline_addtocart_button_bottom_box_shadow'] : '0'; ?>
														<div class="input-type-number">
															<input type="number" id="wp_timeline_addtocart_button_bottom_box_shadow" name="wp_timeline_addtocart_button_bottom_box_shadow" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_addtocart_button_bottom_box_shadow ); ?>"  >
															<div class="input-type-number-nav">
																<div class="input-type-number-button input-type-number-up">+</div>
																<div class="input-type-number-button input-type-number-down">-</div>
															</div>
														</div>
													</div>
												</div>
												<div class="wp-timeline-boxshadow-cover">
													<div class="wp-timeline-boxshadow-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Spread (px)', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select spread value', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-boxshadow-content">
														<?php $wp_timeline_addtocart_button_left_box_shadow = isset( $wtl_settings['wp_timeline_addtocart_button_left_box_shadow'] ) ? $wtl_settings['wp_timeline_addtocart_button_left_box_shadow'] : '0'; ?>
														<div class="input-type-number">
															<input type="number" id="wp_timeline_addtocart_button_left_box_shadow" name="wp_timeline_addtocart_button_left_box_shadow" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_addtocart_button_left_box_shadow ); ?>"  >
															<div class="input-type-number-nav">
																<div class="input-type-number-button input-type-number-up">+</div>
																<div class="input-type-number-button input-type-number-down">-</div>
															</div>
														</div>
													</div>
												</div>
												<div class="wp-timeline-boxshadow-cover wp-timeline-boxshadow-color">
													<div class="wp-timeline-boxshadow-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Color', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select box shadow color', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-boxshadow-content wp-timeline-color-picker">
														<?php $wp_timeline_addtocart_button_box_shadow_color = isset( $wtl_settings['wp_timeline_addtocart_button_box_shadow_color'] ) ? $wtl_settings['wp_timeline_addtocart_button_box_shadow_color'] : ''; ?>
														<input type="text" name="wp_timeline_addtocart_button_box_shadow_color" id="wp_timeline_addtocart_button_box_shadow_color" value="<?php echo esc_attr( $wp_timeline_addtocart_button_box_shadow_color ); ?>"/>
													</div>
												</div>
											</div>
										</li>
										<li class="wp_timeline_add_to_cart_tr addtocart_button_hover_box_shadow_setting">
											<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Hover Box Shadow Settings', 'wp-timeline-designer-pro' ); ?></h3>
											<div class="wp-timeline-boxshadow-wrapper wp-timeline-boxshadow-wrapper1">
												<div class="wp-timeline-boxshadow-cover">
													<div class="wp-timeline-boxshadow-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'H-offset (px)', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select horizontal offset value', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-boxshadow-content">
														<?php $wp_timeline_addtocart_button_hover_top_box_shadow = isset( $wtl_settings['wp_timeline_addtocart_button_hover_top_box_shadow'] ) ? $wtl_settings['wp_timeline_addtocart_button_hover_top_box_shadow'] : '0'; ?>
														<div class="input-type-number">
															<input type="number" id="wp_timeline_addtocart_button_hover_top_box_shadow" name="wp_timeline_addtocart_button_hover_top_box_shadow" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_addtocart_button_hover_top_box_shadow ); ?>"  >
															<div class="input-type-number-nav">
																<div class="input-type-number-button input-type-number-up">+</div>
																<div class="input-type-number-button input-type-number-down">-</div>
															</div>
														</div>
													</div>
												</div>
												<div class="wp-timeline-boxshadow-cover">
													<div class="wp-timeline-boxshadow-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'V-offset (px)', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select vertical offset value', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-boxshadow-content">
														<?php $wp_timeline_addtocart_button_hover_right_box_shadow = isset( $wtl_settings['wp_timeline_addtocart_button_hover_right_box_shadow'] ) ? $wtl_settings['wp_timeline_addtocart_button_hover_right_box_shadow'] : '0'; ?>
														<div class="input-type-number">
															<input type="number" id="wp_timeline_addtocart_button_hover_right_box_shadow" name="wp_timeline_addtocart_button_hover_right_box_shadow" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_addtocart_button_hover_right_box_shadow ); ?>"  >
															<div class="input-type-number-nav">
																<div class="input-type-number-button input-type-number-up">+</div>
																<div class="input-type-number-button input-type-number-down">-</div>
															</div>
														</div>
													</div>
												</div>
												<div class="wp-timeline-boxshadow-cover">
													<div class="wp-timeline-boxshadow-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Blur (px)', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select blur value', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-boxshadow-content">
														<?php $wp_timeline_addtocart_button_hover_bottom_box_shadow = isset( $wtl_settings['wp_timeline_addtocart_button_hover_bottom_box_shadow'] ) ? $wtl_settings['wp_timeline_addtocart_button_hover_bottom_box_shadow'] : '0'; ?>
														<div class="input-type-number">
															<input type="number" id="wp_timeline_addtocart_button_hover_bottom_box_shadow" name="wp_timeline_addtocart_button_hover_bottom_box_shadow" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_addtocart_button_hover_bottom_box_shadow ); ?>"  >
															<div class="input-type-number-nav">
																<div class="input-type-number-button input-type-number-up">+</div>
																<div class="input-type-number-button input-type-number-down">-</div>
															</div>
														</div>
													</div>
												</div>
												<div class="wp-timeline-boxshadow-cover">
													<div class="wp-timeline-boxshadow-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Spread (px)', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select spread value', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-boxshadow-content">
														<?php $wp_timeline_addtocart_button_hover_left_box_shadow = isset( $wtl_settings['wp_timeline_addtocart_button_hover_left_box_shadow'] ) ? $wtl_settings['wp_timeline_addtocart_button_hover_left_box_shadow'] : '0'; ?>
														<div class="input-type-number">
															<input type="number" id="wp_timeline_addtocart_button_hover_left_box_shadow" name="wp_timeline_addtocart_button_hover_left_box_shadow" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_addtocart_button_hover_left_box_shadow ); ?>"  >
															<div class="input-type-number-nav">
																<div class="input-type-number-button input-type-number-up">+</div>
																<div class="input-type-number-button input-type-number-down">-</div>
															</div>
														</div>
													</div>
												</div>
												<div class="wp-timeline-boxshadow-cover wp-timeline-boxshadow-color">
													<div class="wp-timeline-boxshadow-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Color', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select box shadow color', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-boxshadow-content wp-timeline-color-picker">
														<?php $wp_timeline_addtocart_button_hover_box_shadow_color = isset( $wtl_settings['wp_timeline_addtocart_button_hover_box_shadow_color'] ) ? $wtl_settings['wp_timeline_addtocart_button_hover_box_shadow_color'] : ''; ?>
														<input type="text" name="wp_timeline_addtocart_button_hover_box_shadow_color" id="wp_timeline_addtocart_button_hover_box_shadow_color" value="<?php echo esc_attr( $wp_timeline_addtocart_button_hover_box_shadow_color ); ?>"/>
													</div>
												</div>
											</div>
										</li>
										<li class="wp_timeline_add_to_cart_tr">
											<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Typography Settings', 'wp-timeline-designer-pro' ); ?></h3>
											<div class="wp-timeline-typography-wrapper wp-timeline-typography-wrapper1">
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Font Family', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select cart button font family', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content">
														<?php
														if ( isset( $wtl_settings['wp_timeline_addtocart_button_fontface'] ) && '' != $wtl_settings['wp_timeline_addtocart_button_fontface'] ) {
															$wp_timeline_addtocart_button_fontface = $wtl_settings['wp_timeline_addtocart_button_fontface'];
														} else {
															$wp_timeline_addtocart_button_fontface = '';
														}
														?>
														<div class="typo-field">
															<input type="hidden" id="wp_timeline_addtocart_button_fontface_font_type" name="wp_timeline_addtocart_button_fontface_font_type" value="<?php echo isset( $wtl_settings['wp_timeline_addtocart_button_fontface_font_type'] ) ? esc_attr( $wtl_settings['wp_timeline_addtocart_button_fontface_font_type'] ) : ''; ?>">
															<div class="select-cover">
																<select name="wp_timeline_addtocart_button_fontface" id="wp_timeline_addtocart_button_fontface">
																	<option value=""><?php esc_html_e( 'Select Font Family', 'wp-timeline-designer-pro' ); ?></option>
																	<?php
																	$old_version = '';
																	$cnt         = 0;
																	$font_family = Wp_Timeline_Main::wtl_default_recognized_font_faces();
																	foreach ( $font_family as $key => $value ) {
																		if ( $value['version'] != $old_version ) {
																			if ( $cnt > 0 ) {
																				echo '</optgroup>';
																			}
																			echo '<optgroup label="' . esc_attr( $value['version'] ) . '">';
																			$old_version = $value['version'];
																		}
																		echo "<option value='" . esc_attr( str_replace( '"', '', $value['label'] ) ) . "'";
																		if ( '' != $wp_timeline_addtocart_button_fontface && ( str_replace( '"', '', $wp_timeline_addtocart_button_fontface ) == str_replace( '"', '', $value['label'] ) ) ) {
																			echo ' selected';
																		}
																		echo '>' . esc_attr( $value['label'] ) . '</option>';
																		$cnt++;
																	}
																	if ( count( $font_family ) == $cnt ) {
																		echo '</optgroup>';
																	}
																	?>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Font Size (px)', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select cart button font size', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content">
														<?php
														if ( isset( $wtl_settings['wp_timeline_addtocart_button_fontsize'] ) && '' != $wtl_settings['wp_timeline_addtocart_button_fontsize'] ) {
															$wp_timeline_addtocart_button_fontsize = $wtl_settings['wp_timeline_addtocart_button_fontsize'];
														} else {
															$wp_timeline_addtocart_button_fontsize = 14;
														}
														?>
														<div class="grid_col_space range_slider_fontsize" id="wp_timeline_addtocart_button_fontsizeInput" ></div>
														<div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="wp_timeline_addtocart_button_fontsize" id="wp_timeline_addtocart_button_fontsize" value="<?php echo esc_attr( $wp_timeline_addtocart_button_fontsize ); ?>"  /></div>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Font Weight', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select cart button font weight', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content">
														<?php $wp_timeline_addtocart_button_font_weight = isset( $wtl_settings['wp_timeline_addtocart_button_font_weight'] ) ? $wtl_settings['wp_timeline_addtocart_button_font_weight'] : 'normal'; ?>
														<div class="select-cover">
															<select name="wp_timeline_addtocart_button_font_weight" id="wp_timeline_addtocart_button_font_weight">
																<option value="100" <?php selected( $wp_timeline_addtocart_button_font_weight, 100 ); ?>>100</option>
																<option value="200" <?php selected( $wp_timeline_addtocart_button_font_weight, 200 ); ?>>200</option>
																<option value="300" <?php selected( $wp_timeline_addtocart_button_font_weight, 300 ); ?>>300</option>
																<option value="400" <?php selected( $wp_timeline_addtocart_button_font_weight, 400 ); ?>>400</option>
																<option value="500" <?php selected( $wp_timeline_addtocart_button_font_weight, 500 ); ?>>500</option>
																<option value="600" <?php selected( $wp_timeline_addtocart_button_font_weight, 600 ); ?>>600</option>
																<option value="700" <?php selected( $wp_timeline_addtocart_button_font_weight, 700 ); ?>>700</option>
																<option value="800" <?php selected( $wp_timeline_addtocart_button_font_weight, 800 ); ?>>800</option>
																<option value="900" <?php selected( $wp_timeline_addtocart_button_font_weight, 900 ); ?>>900</option>
																<option value="bold" <?php selected( $wp_timeline_addtocart_button_font_weight, 'bold' ); ?> ><?php esc_html_e( 'Bold', 'wp-timeline-designer-pro' ); ?></option>
																<option value="normal" <?php selected( $wp_timeline_addtocart_button_font_weight, 'normal' ); ?>><?php esc_html_e( 'Normal', 'wp-timeline-designer-pro' ); ?></option>
															</select>
														</div>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Line Height', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select cart button line height', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content">
														<div class="input-type-number">
														<?php
															$display_addtocart_button_line_height = '1.5';
														if ( isset( $wtl_settings['display_addtocart_button_line_height'] ) ) {
															$display_addtocart_button_line_height = $wtl_settings['display_addtocart_button_line_height'];
														}
														?>
														<div class="input-type-number">
															<input type="number" id="display_addtocart_button_line_height" name="display_addtocart_button_line_height" step="1" min="1.5" value="<?php echo esc_attr( $display_addtocart_button_line_height ); ?>" placeholder="<?php esc_attr_e( 'Enter line height', 'wp-timeline-designer-pro' ); ?>" >
															<div class="input-type-number-nav">
																<div class="input-type-number-button input-type-number-up">+</div>
																<div class="input-type-number-button input-type-number-down">-</div>
															</div>
														</div>
														</div>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Italic Font Style', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Display cart button italic font style', 'wp-timeline-designer-pro' ); ?></span></span><?php $wp_timeline_addtocart_button_font_italic = isset( $wtl_settings['wp_timeline_addtocart_button_font_italic'] ) ? $wtl_settings['wp_timeline_addtocart_button_font_italic'] : '0'; ?>
													</div>
													<div class="wp-timeline-typography-content">
														<fieldset class="wp-timeline-social-options wp-timeline-display_author buttonset ui-buttonset">
															<input id="wp_timeline_addtocart_button_font_italic_1" name="wp_timeline_addtocart_button_font_italic" type="radio" value="1"  <?php checked( 1, $wp_timeline_addtocart_button_font_italic ); ?> />
															<label for="wp_timeline_addtocart_button_font_italic_1" class="<?php echo esc_html( $uic_l ); ?>"><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
															<input id="wp_timeline_addtocart_button_font_italic_0" name="wp_timeline_addtocart_button_font_italic" type="radio" value="0" <?php checked( 0, $wp_timeline_addtocart_button_font_italic ); ?> />
															<label for="wp_timeline_addtocart_button_font_italic_0" class="<?php echo esc_html( $uic_r ); ?>"><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
														</fieldset>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Text Transform', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select cart button text transform style', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content">
														<?php $wp_timeline_addtocart_button_font_text_transform = isset( $wtl_settings['wp_timeline_addtocart_button_font_text_transform'] ) ? $wtl_settings['wp_timeline_addtocart_button_font_text_transform'] : 'none'; ?>
															<div class="select-cover">
																<select name="wp_timeline_addtocart_button_font_text_transform" id="wp_timeline_addtocart_button_font_text_transform">
																	<option <?php selected( $wp_timeline_addtocart_button_font_text_transform, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'wp-timeline-designer-pro' ); ?></option>
																	<option <?php selected( $wp_timeline_addtocart_button_font_text_transform, 'capitalize' ); ?> value="capitalize"><?php esc_html_e( 'Capitalize', 'wp-timeline-designer-pro' ); ?></option>
																	<option <?php selected( $wp_timeline_addtocart_button_font_text_transform, 'uppercase' ); ?> value="uppercase"><?php esc_html_e( 'Uppercase', 'wp-timeline-designer-pro' ); ?></option>
																	<option <?php selected( $wp_timeline_addtocart_button_font_text_transform, 'lowercase' ); ?> value="lowercase"><?php esc_html_e( 'Lowercase', 'wp-timeline-designer-pro' ); ?></option>
																	<option <?php selected( $wp_timeline_addtocart_button_font_text_transform, 'full-width' ); ?> value="full-width"><?php esc_html_e( 'Full Width', 'wp-timeline-designer-pro' ); ?></option>
																</select>
															</div>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Text Decoration', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select cart button text decoration style', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content">
														<?php $wp_timeline_addtocart_button_font_text_decoration = isset( $wtl_settings['wp_timeline_addtocart_button_font_text_decoration'] ) ? $wtl_settings['wp_timeline_addtocart_button_font_text_decoration'] : 'none'; ?>
														<div class="select-cover">
															<select name="wp_timeline_addtocart_button_font_text_decoration" id="wp_timeline_addtocart_button_font_text_decoration">
																<option <?php selected( $wp_timeline_addtocart_button_font_text_decoration, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'wp-timeline-designer-pro' ); ?></option>
																<option <?php selected( $wp_timeline_addtocart_button_font_text_decoration, 'underline' ); ?> value="underline"><?php esc_html_e( 'Underline', 'wp-timeline-designer-pro' ); ?></option>
																<option <?php selected( $wp_timeline_addtocart_button_font_text_decoration, 'overline' ); ?> value="overline"><?php esc_html_e( 'Overline', 'wp-timeline-designer-pro' ); ?></option>
																<option <?php selected( $wp_timeline_addtocart_button_font_text_decoration, 'line-through' ); ?> value="line-through"><?php esc_html_e( 'Line Through', 'wp-timeline-designer-pro' ); ?></option>
															</select>
														</div>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Letter Spacing (px)', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enter cart button letter spacing', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content"><div class="input-type-number"><input type="number" name="wp_timeline_addtocart_button_letter_spacing" id="wp_timeline_addtocart_button_letter_spacing" step="1" min="0" value="<?php echo isset( $wtl_settings['wp_timeline_addtocart_button_letter_spacing'] ) ? esc_attr( $wtl_settings['wp_timeline_addtocart_button_letter_spacing'] ) : '0'; ?>" >
													<div class="input-type-number-nav">
														<div class="input-type-number-button input-type-number-up">+</div>
														<div class="input-type-number-button input-type-number-down">-</div>
													</div></div></div>
												</div>
											</div>
										</li>
									</ul>
								</li>
								<?php
								/* YITH WCWL */
								if ( class_exists( 'YITH_WCWL' ) ) {
									?>
																								
									<li>
										<?php wtl_setting_left( esc_html__( 'Display Add To Wishlist Button', 'wp-timeline-designer-pro' ) ); ?>
										<div class="wp-timeline-right">
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable add to wishlist button', 'wp-timeline-designer-pro' ); ?></span></span>
											<?php
											$display_addtowishlist_button = '0';
											if ( isset( $wtl_settings['display_addtowishlist_button'] ) ) {
												$display_addtowishlist_button = $wtl_settings['display_addtowishlist_button'];
											}
											?>
											<fieldset class="wp-timeline-social-style buttonset ui-buttonset buttonset-hide" data-hide='1'>
												<input id="display_addtowishlist_button_1" name="display_addtowishlist_button" type="radio" value="1" <?php checked( 1, $display_addtowishlist_button ); ?> />
												<label id="wp-timeline-options-button" for="display_addtowishlist_button_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $display_addtowishlist_button ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
												<input id="display_addtowishlist_button_0" name="display_addtowishlist_button" type="radio" value="0" <?php checked( 0, $display_addtowishlist_button ); ?> />
												<label id="wp-timeline-options-button" for="display_addtowishlist_button_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $display_addtowishlist_button ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</li>
									<li class="wp_timeline_wishlist_button_setting">
										<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Wishlist Button Settings', 'wp-timeline-designer-pro' ); ?></h3>
										<ul>
											<li class="wp_timeline_add_to_wishlist_tr">
												<?php wtl_setting_left( esc_html__( 'DisplayButton on', 'wp-timeline-designer-pro' ) ); ?>
												<div class="wp-timeline-right">
													<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Show wishlist button on', 'wp-timeline-designer-pro' ); ?></span></span>
													<?php
													$wp_timeline_wishlistbutton_on = '1';
													if ( isset( $wtl_settings['wp_timeline_wishlistbutton_on'] ) ) {
														$wp_timeline_wishlistbutton_on = $wtl_settings['wp_timeline_wishlistbutton_on'];
													}
													?>
													<fieldset class="buttonset ui-buttonset green" data-hide='1'>
														<input id="wp_timeline_wishlistbutton_on_same_line" name="wp_timeline_wishlistbutton_on" type="radio" value="1" <?php checked( '1', $wp_timeline_wishlistbutton_on ); ?> />
														<label id="wp-timeline-options-button" for="wp_timeline_wishlistbutton_on_same_line"><?php esc_html_e( 'Same Line', 'wp-timeline-designer-pro' ); ?></label>
														<input id="wp_timeline_wishlistbutton_on_next_line" name="wp_timeline_wishlistbutton_on" type="radio" value="2" <?php checked( '2', $wp_timeline_wishlistbutton_on ); ?> />
														<label id="wp-timeline-options-button" for="wp_timeline_wishlistbutton_on_next_line"><?php esc_html_e( 'Next Line', 'wp-timeline-designer-pro' ); ?></label>												
													</fieldset>
												</div>
											</li>
											<li class="wp_timeline_add_to_wishlist_tr cart_wishlist_button_alignment">
												<?php wtl_setting_left( esc_html__( 'Wrapper Alignment', 'wp-timeline-designer-pro' ) ); ?>
												<div class="wp-timeline-right">
													<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select cart button & wishlist button alignment', 'wp-timeline-designer-pro' ); ?></span></span>
													<?php
													$wp_timeline_cart_wishlistbutton_alignment = 'left';
													if ( isset( $wtl_settings['wp_timeline_cart_wishlistbutton_alignment'] ) ) {
														$wp_timeline_cart_wishlistbutton_alignment = $wtl_settings['wp_timeline_cart_wishlistbutton_alignment'];
													}
													?>
													<fieldset class="buttonset ui-buttonset green" data-hide='1'>
														<input id="wp_timeline_cart_wishlistbutton_alignment_left" name="wp_timeline_cart_wishlistbutton_alignment" type="radio" value="left" <?php checked( 'left', $wp_timeline_cart_wishlistbutton_alignment ); ?> />
														<label id="wp-timeline-options-button" for="wp_timeline_cart_wishlistbutton_alignment_left"><?php esc_html_e( 'Left', 'wp-timeline-designer-pro' ); ?></label>
														<input id="wp_timeline_cart_wishlistbutton_alignment_center" name="wp_timeline_cart_wishlistbutton_alignment" type="radio" value="center" <?php checked( 'center', $wp_timeline_cart_wishlistbutton_alignment ); ?> />
														<label id="wp-timeline-options-button" class="wp_timeline_cart_wishlistbutton_alignment_center" for="wp_timeline_cart_wishlistbutton_alignment_center"><?php esc_html_e( 'Center', 'wp-timeline-designer-pro' ); ?></label>
														<input id="wp_timeline_cart_wishlistbutton_alignment_right" name="wp_timeline_cart_wishlistbutton_alignment" type="radio" value="right" <?php checked( 'right', $wp_timeline_cart_wishlistbutton_alignment ); ?> />
														<label id="wp-timeline-options-button" for="wp_timeline_cart_wishlistbutton_alignment_right"><?php esc_html_e( 'Right', 'wp-timeline-designer-pro' ); ?></label>
													</fieldset>
												</div>
											</li>
											<li class="wp_timeline_add_to_wishlist_tr wishlist_button_alignment">
												<?php wtl_setting_left( esc_html__( 'Alignment', 'wp-timeline-designer-pro' ) ); ?>
												<div class="wp-timeline-right">
													<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select wishlist button alignment', 'wp-timeline-designer-pro' ); ?></span></span>
													<?php
													$wp_timeline_wishlistbutton_alignment = 'left';
													if ( isset( $wtl_settings['wp_timeline_wishlistbutton_alignment'] ) ) {
														$wp_timeline_wishlistbutton_alignment = $wtl_settings['wp_timeline_wishlistbutton_alignment'];
													}
													?>
													<fieldset class="buttonset ui-buttonset green" data-hide='1'>
														<input id="wp_timeline_wishlistbutton_alignment_left" name="wp_timeline_wishlistbutton_alignment" type="radio" value="left" <?php checked( 'left', $wp_timeline_wishlistbutton_alignment ); ?> />
														<label id="wp-timeline-options-button" for="wp_timeline_wishlistbutton_alignment_left"><?php esc_html_e( 'Left', 'wp-timeline-designer-pro' ); ?></label>
														<input id="wp_timeline_wishlistbutton_alignment_center" name="wp_timeline_wishlistbutton_alignment" type="radio" value="center" <?php checked( 'center', $wp_timeline_wishlistbutton_alignment ); ?> />
														<label id="wp-timeline-options-button" class="wp_timeline_wishlistbutton_alignment_center" for="wp_timeline_wishlistbutton_alignment_center"><?php esc_html_e( 'Center', 'wp-timeline-designer-pro' ); ?></label>
														<input id="wp_timeline_wishlistbutton_alignment_right" name="wp_timeline_wishlistbutton_alignment" type="radio" value="right" <?php checked( 'right', $wp_timeline_wishlistbutton_alignment ); ?> />
														<label id="wp-timeline-options-button" for="wp_timeline_wishlistbutton_alignment_right"><?php esc_html_e( 'Right', 'wp-timeline-designer-pro' ); ?></label>
													</fieldset>
												</div>
											</li>
											<li class="wp_timeline_add_to_wishlist_tr">
												<?php wtl_setting_left( esc_html__( 'Text Color', 'wp-timeline-designer-pro' ) ); ?>
												<div class="wp-timeline-right wp-timeline-color-picker">
													<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select wishlist button text color', 'wp-timeline-designer-pro' ); ?></span></span>
													<?php
													if ( isset( $wtl_settings['wp_timeline_wishlist_textcolor'] ) ) {
														$wp_timeline_wishlist_textcolor = $wtl_settings['wp_timeline_wishlist_textcolor'];
													} else {
														$wp_timeline_wishlist_textcolor = '';
													}
													?>
													<input type="text" name="wp_timeline_wishlist_textcolor" id="wp_timeline_wishlist_textcolor" value="<?php echo esc_attr( $wp_timeline_wishlist_textcolor ); ?>"/>
												</div>
											</li>
											<li class="wp_timeline_add_to_wishlist_tr">
												<?php wtl_setting_left( esc_html__( 'Hover Text Color', 'wp-timeline-designer-pro' ) ); ?>
												<div class="wp-timeline-right wp-timeline-color-picker">
													<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select wishlist text hover color', 'wp-timeline-designer-pro' ); ?></span></span>
													<?php $wp_timeline_wishlist_text_hover_color = isset( $wtl_settings['wp_timeline_wishlist_text_hover_color'] ) ? $wtl_settings['wp_timeline_wishlist_text_hover_color'] : ''; ?>
													<input type="text" name="wp_timeline_wishlist_text_hover_color" id="wp_timeline_wishlist_text_hover_color" value="<?php echo esc_attr( $wp_timeline_wishlist_text_hover_color ); ?>"/>
												</div>
											</li>
											<li class="wp_timeline_add_to_wishlist_tr">
												<?php wtl_setting_left( esc_html__( 'Background Color', 'wp-timeline-designer-pro' ) ); ?>
												<div class="wp-timeline-right wp-timeline-color-picker">
													<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select wishlist button background color', 'wp-timeline-designer-pro' ); ?></span></span>
													<?php $wp_timeline_wishlist_backgroundcolor = isset( $wtl_settings['wp_timeline_wishlist_backgroundcolor'] ) ? $wtl_settings['wp_timeline_wishlist_backgroundcolor'] : ''; ?>
													<input type="text" name="wp_timeline_wishlist_backgroundcolor" id="wp_timeline_wishlist_backgroundcolor" value="<?php echo esc_attr( $wp_timeline_wishlist_backgroundcolor ); ?>"/>
												</div>
											</li>
											<li class="wp_timeline_add_to_wishlist_tr">
												<?php wtl_setting_left( esc_html__( 'Hover Background Color', 'wp-timeline-designer-pro' ) ); ?>
												<div class="wp-timeline-right wp-timeline-color-picker">
													<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select wishlist button hover background color', 'wp-timeline-designer-pro' ); ?></span></span>
													<?php $wp_timeline_wishlist_hover_backgroundcolor = isset( $wtl_settings['wp_timeline_wishlist_hover_backgroundcolor'] ) ? $wtl_settings['wp_timeline_wishlist_hover_backgroundcolor'] : ''; ?>
													<input type="text" name="wp_timeline_wishlist_hover_backgroundcolor" id="wp_timeline_wishlist_hover_backgroundcolor" value="<?php echo esc_attr( $wp_timeline_wishlist_hover_backgroundcolor ); ?>"/>
												</div>
											</li>
											<li class="wp_timeline_wishlist_button_border_setting wp_timeline_add_to_wishlist_tr">
												<?php wtl_setting_left( esc_html__( 'Border Radius(px)', 'wp-timeline-designer-pro' ) ); ?>
												<div class="wp-timeline-right">
													<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select wishlist button border radius', 'wp-timeline-designer-pro' ); ?></span></span>
													<?php
													$display_wishlist_button_border_radius = '0';
													if ( isset( $wtl_settings['display_wishlist_button_border_radius'] ) ) {
														$display_wishlist_button_border_radius = $wtl_settings['display_wishlist_button_border_radius'];
													}
													?>
													<div class="input-type-number">
														<input type="number" id="display_wishlist_button_border_radius" name="display_wishlist_button_border_radius" step="1" min="0" value="<?php echo esc_attr( $display_wishlist_button_border_radius ); ?>" >
														<div class="input-type-number-nav">
															<div class="input-type-number-button input-type-number-up">+</div>
															<div class="input-type-number-button input-type-number-down">-</div>
														</div>
													</div>
												</div>
											</li>
											<li class="wp_timeline_wishlist_button_border_setting wp_timeline_add_to_wishlist_tr">
												<?php wtl_setting_left( esc_html__( 'Border', 'wp-timeline-designer-pro' ) ); ?>
												<div class="wp-timeline-right wp-timeline-border-cover">
													<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select wishlist button border', 'wp-timeline-designer-pro' ); ?></span></span>
													<div class="wp-timeline-border-wrap">
														<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
															<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Left (px)', 'wp-timeline-designer-pro' ); ?></span></div>
															<div class="wp-timeline-border-cover">
																<div class="wp-timeline-border-content">
																	<?php $wp_timeline_wishlistbutton_borderleft = isset( $wtl_settings['wp_timeline_wishlistbutton_borderleft'] ) ? $wtl_settings['wp_timeline_wishlistbutton_borderleft'] : '0'; ?>
																	<div class="input-type-number">
																		<input type="number" id="wp_timeline_wishlistbutton_borderleft" name="wp_timeline_wishlistbutton_borderleft" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_wishlistbutton_borderleft ); ?>"  >
																		<div class="input-type-number-nav">
																			<div class="input-type-number-button input-type-number-up">+</div>
																			<div class="input-type-number-button input-type-number-down">-</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="wp-timeline-border-cover wp-timeline-color-picker">
																<div class="wp-timeline-border-content">
																	<?php $wp_timeline_wishlistbutton_borderleftcolor = isset( $wtl_settings['wp_timeline_wishlistbutton_borderleftcolor'] ) ? $wtl_settings['wp_timeline_wishlistbutton_borderleftcolor'] : ''; ?>
																	<input type="text" name="wp_timeline_wishlistbutton_borderleftcolor" id="wp_timeline_wishlistbutton_borderleftcolor" value="<?php echo esc_attr( $wp_timeline_wishlistbutton_borderleftcolor ); ?>"/>
																</div>
															</div>
														</div> 
														<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
															<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Right (px)', 'wp-timeline-designer-pro' ); ?></span></div>
															<div class="wp-timeline-border-cover">
																<div class="wp-timeline-border-content">
																	<?php $wp_timeline_wishlistbutton_borderright = isset( $wtl_settings['wp_timeline_wishlistbutton_borderright'] ) ? $wtl_settings['wp_timeline_wishlistbutton_borderright'] : '0'; ?>
																	<div class="input-type-number">
																		<input type="number" id="wp_timeline_wishlistbutton_borderright" name="wp_timeline_wishlistbutton_borderright" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_wishlistbutton_borderright ); ?>"  >
																		<div class="input-type-number-nav">
																			<div class="input-type-number-button input-type-number-up">+</div>
																			<div class="input-type-number-button input-type-number-down">-</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="wp-timeline-border-cover wp-timeline-color-picker">
																<div class="wp-timeline-border-content">
																	<?php $wp_timeline_wishlistbutton_borderrightcolor = isset( $wtl_settings['wp_timeline_wishlistbutton_borderrightcolor'] ) ? $wtl_settings['wp_timeline_wishlistbutton_borderrightcolor'] : ''; ?>
																	<input type="text" name="wp_timeline_wishlistbutton_borderrightcolor" id="wp_timeline_wishlistbutton_borderrightcolor" value="<?php echo esc_attr( $wp_timeline_wishlistbutton_borderrightcolor ); ?>"/>
																</div>
															</div>
														</div>
														<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
															<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Top (px)', 'wp-timeline-designer-pro' ); ?></span></div>
															<div class="wp-timeline-border-cover">
																<div class="wp-timeline-border-content">
																	<?php $wp_timeline_wishlistbutton_bordertop = isset( $wtl_settings['wp_timeline_wishlistbutton_bordertop'] ) ? $wtl_settings['wp_timeline_wishlistbutton_bordertop'] : '0'; ?>
																	<div class="input-type-number">
																		<input type="number" id="wp_timeline_wishlistbutton_bordertop" name="wp_timeline_wishlistbutton_bordertop" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_wishlistbutton_bordertop ); ?>"  >
																		<div class="input-type-number-nav">
																			<div class="input-type-number-button input-type-number-up">+</div>
																			<div class="input-type-number-button input-type-number-down">-</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="wp-timeline-border-cover wp-timeline-color-picker">
																<div class="wp-timeline-border-content">
																	<?php $wp_timeline_wishlistbutton_bordertopcolor = isset( $wtl_settings['wp_timeline_wishlistbutton_bordertopcolor'] ) ? $wtl_settings['wp_timeline_wishlistbutton_bordertopcolor'] : ''; ?>
																	<input type="text" name="wp_timeline_wishlistbutton_bordertopcolor" id="wp_timeline_wishlistbutton_bordertopcolor" value="<?php echo esc_attr( $wp_timeline_wishlistbutton_bordertopcolor ); ?>"/>
																</div>
															</div>
														</div>
														<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
															<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Bottom(px)', 'wp-timeline-designer-pro' ); ?></span></div>
															<div class="wp-timeline-border-cover">
																<div class="wp-timeline-border-content">
																	<?php $wp_timeline_wishlistbutton_borderbuttom = isset( $wtl_settings['wp_timeline_wishlistbutton_borderbuttom'] ) ? $wtl_settings['wp_timeline_wishlistbutton_borderbuttom'] : '0'; ?>
																	<div class="input-type-number">
																		<input type="number" id="wp_timeline_wishlistbutton_borderbuttom" name="wp_timeline_wishlistbutton_borderbuttom" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_wishlistbutton_borderbuttom ); ?>"  >
																		<div class="input-type-number-nav">
																			<div class="input-type-number-button input-type-number-up">+</div>
																			<div class="input-type-number-button input-type-number-down">-</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="wp-timeline-border-cover wp-timeline-color-picker">
																<div class="wp-timeline-border-content">
																	<?php $wp_timeline_wishlistbutton_borderbottomcolor = isset( $wtl_settings['wp_timeline_wishlistbutton_borderbottomcolor'] ) ? $wtl_settings['wp_timeline_wishlistbutton_borderbottomcolor'] : ''; ?>
																	<input type="text" name="wp_timeline_wishlistbutton_borderbottomcolor" id="wp_timeline_wishlistbutton_borderbottomcolor" value="<?php echo esc_attr( $wp_timeline_wishlistbutton_borderbottomcolor ); ?>"/>
																</div>
															</div>
														</div>
													</div>
												</div>
											</li>
											<li class="wp_timeline_wishlist_button_border_hover_setting wp_timeline_add_to_wishlist_tr">
												<?php wtl_setting_left( esc_html__( 'Hover Border Radius', 'wp-timeline-designer-pro' ) ); ?>
												<div class="wp-timeline-right">
													<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select wishlist button hover border radius', 'wp-timeline-designer-pro' ); ?></span></span>
													<?php
													$display_wishlist_button_border_hover_radius = '0';
													if ( isset( $wtl_settings['display_wishlist_button_border_hover_radius'] ) ) {
														$display_wishlist_button_border_hover_radius = $wtl_settings['display_wishlist_button_border_hover_radius'];
													}
													?>
													<div class="input-type-number">
														<input type="number" id="display_wishlist_button_border_hover_radius" name="display_wishlist_button_border_hover_radius" step="1" min="0" value="<?php echo esc_attr( $display_wishlist_button_border_hover_radius ); ?>" >
														<div class="input-type-number-nav">
															<div class="input-type-number-button input-type-number-up">+</div>
															<div class="input-type-number-button input-type-number-down">-</div>
														</div>
													</div>
												</div>
											</li>
											<li class="wp_timeline_wishlist_button_border_hover_setting wp_timeline_add_to_wishlist_tr">
												<?php wtl_setting_left( esc_html__( 'Hover Border', 'wp-timeline-designer-pro' ) ); ?>
												<div class="wp-timeline-right wp-timeline-border-cover">
													<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select wishlist button border', 'wp-timeline-designer-pro' ); ?></span></span>
													<div class="wp-timeline-border-wrap">
														<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
															<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Left (px)', 'wp-timeline-designer-pro' ); ?></span></div>
															<div class="wp-timeline-border-cover">
																<div class="wp-timeline-border-content">
																	<?php $wp_timeline_wishlistbutton_hover_borderleft = isset( $wtl_settings['wp_timeline_wishlistbutton_hover_borderleft'] ) ? $wtl_settings['wp_timeline_wishlistbutton_hover_borderleft'] : '0'; ?>
																	<div class="input-type-number">
																		<input type="number" id="wp_timeline_wishlistbutton_hover_borderleft" name="wp_timeline_wishlistbutton_hover_borderleft" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_wishlistbutton_hover_borderleft ); ?>"  >
																		<div class="input-type-number-nav">
																			<div class="input-type-number-button input-type-number-up">+</div>
																			<div class="input-type-number-button input-type-number-down">-</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="wp-timeline-border-cover wp-timeline-color-picker">
																<div class="wp-timeline-border-content">
																	<?php $wp_timeline_wishlistbutton_hover_borderleftcolor = isset( $wtl_settings['wp_timeline_wishlistbutton_hover_borderleftcolor'] ) ? $wtl_settings['wp_timeline_wishlistbutton_hover_borderleftcolor'] : ''; ?>
																	<input type="text" name="wp_timeline_wishlistbutton_hover_borderleftcolor" id="wp_timeline_wishlistbutton_hover_borderleftcolor" value="<?php echo esc_attr( $wp_timeline_wishlistbutton_hover_borderleftcolor ); ?>"/>
																</div>
															</div>
														</div> 
														<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
															<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Right (px)', 'wp-timeline-designer-pro' ); ?></span></div>
															<div class="wp-timeline-border-cover">
																<div class="wp-timeline-border-content">
																	<?php $wp_timeline_wishlistbutton_hover_borderright = isset( $wtl_settings['wp_timeline_wishlistbutton_hover_borderright'] ) ? $wtl_settings['wp_timeline_wishlistbutton_hover_borderright'] : '0'; ?>
																	<div class="input-type-number">
																		<input type="number" id="wp_timeline_wishlistbutton_hover_borderright" name="wp_timeline_wishlistbutton_hover_borderright" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_wishlistbutton_hover_borderright ); ?>"  >
																		<div class="input-type-number-nav">
																			<div class="input-type-number-button input-type-number-up">+</div>
																			<div class="input-type-number-button input-type-number-down">-</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="wp-timeline-border-cover wp-timeline-color-picker">
																<div class="wp-timeline-border-content">
																	<?php $wp_timeline_wishlistbutton_hover_borderrightcolor = isset( $wtl_settings['wp_timeline_wishlistbutton_hover_borderrightcolor'] ) ? $wtl_settings['wp_timeline_wishlistbutton_hover_borderrightcolor'] : ''; ?>
																	<input type="text" name="wp_timeline_wishlistbutton_hover_borderrightcolor" id="wp_timeline_wishlistbutton_hover_borderrightcolor" value="<?php echo esc_attr( $wp_timeline_wishlistbutton_hover_borderrightcolor ); ?>"/>
																</div>
															</div>
														</div>
														<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
															<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Top (px)', 'wp-timeline-designer-pro' ); ?></span></div>
															<div class="wp-timeline-border-cover">
																<div class="wp-timeline-border-content">
																	<?php $wp_timeline_wishlistbutton_hover_bordertop = isset( $wtl_settings['wp_timeline_wishlistbutton_hover_bordertop'] ) ? $wtl_settings['wp_timeline_wishlistbutton_hover_bordertop'] : '0'; ?>
																	<div class="input-type-number">
																		<input type="number" id="wp_timeline_wishlistbutton_hover_bordertop" name="wp_timeline_wishlistbutton_hover_bordertop" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_wishlistbutton_hover_bordertop ); ?>"  >
																		<div class="input-type-number-nav">
																			<div class="input-type-number-button input-type-number-up">+</div>
																			<div class="input-type-number-button input-type-number-down">-</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="wp-timeline-border-cover wp-timeline-color-picker">
																<div class="wp-timeline-border-content">
																	<?php $wp_timeline_wishlistbutton_hover_bordertopcolor = isset( $wtl_settings['wp_timeline_wishlistbutton_hover_bordertopcolor'] ) ? $wtl_settings['wp_timeline_wishlistbutton_hover_bordertopcolor'] : ''; ?>
																	<input type="text" name="wp_timeline_wishlistbutton_hover_bordertopcolor" id="wp_timeline_wishlistbutton_hover_bordertopcolor" value="<?php echo esc_attr( $wp_timeline_wishlistbutton_hover_bordertopcolor ); ?>"/>
																</div>
															</div>
														</div>
														<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
															<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Bottom(px)', 'wp-timeline-designer-pro' ); ?></span></div>
															<div class="wp-timeline-border-cover">
																<div class="wp-timeline-border-content">
																	<?php $wp_timeline_wishlistbutton_hover_borderbuttom = isset( $wtl_settings['wp_timeline_wishlistbutton_hover_borderbuttom'] ) ? $wtl_settings['wp_timeline_wishlistbutton_hover_borderbuttom'] : '0'; ?>
																	<div class="input-type-number">
																		<input type="number" id="wp_timeline_wishlistbutton_hover_borderbuttom" name="wp_timeline_wishlistbutton_hover_borderbuttom" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_wishlistbutton_hover_borderbuttom ); ?>"  >
																		<div class="input-type-number-nav">
																			<div class="input-type-number-button input-type-number-up">+</div>
																			<div class="input-type-number-button input-type-number-down">-</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="wp-timeline-border-cover wp-timeline-color-picker">
																<div class="wp-timeline-border-content">
																	<?php $wp_timeline_wishlistbutton_hover_borderbottomcolor = isset( $wtl_settings['wp_timeline_wishlistbutton_hover_borderbottomcolor'] ) ? $wtl_settings['wp_timeline_wishlistbutton_hover_borderbottomcolor'] : ''; ?>
																	<input type="text" name="wp_timeline_wishlistbutton_hover_borderbottomcolor" id="wp_timeline_wishlistbutton_hover_borderbottomcolor" value="<?php echo esc_attr( $wp_timeline_wishlistbutton_hover_borderbottomcolor ); ?>"/>
																</div>
															</div>
														</div>
													</div>
												</div>
											</li>
											<li class="wp_timeline_add_to_wishlist_tr">
												<?php wtl_setting_left( esc_html__( 'Padding', 'wp-timeline-designer-pro' ) ); ?>
												<div class="wp-timeline-right wp-timeline-border-cover">
													<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Set wishlist button padding', 'wp-timeline-designer-pro' ); ?></span></span>
													<div class="wp-timeline-padding-wrapper wp-timeline-padding-wrapper1 wp-timeline-border-wrap">
														<div class="wp-timeline-padding-cover">
															<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Left-Right (px)', 'wp-timeline-designer-pro' ); ?></span></div>
															<div class="wp-timeline-padding-content">
																<?php $wp_timeline_wishlistbutton_padding_leftright = isset( $wtl_settings['wp_timeline_wishlistbutton_padding_leftright'] ) ? $wtl_settings['wp_timeline_wishlistbutton_padding_leftright'] : '10'; ?>
																<div class="input-type-number">
																	<input type="number" id="wp_timeline_wishlistbutton_padding_leftright" name="wp_timeline_wishlistbutton_padding_leftright" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_wishlistbutton_padding_leftright ); ?>"  >
																	<div class="input-type-number-nav">
																		<div class="input-type-number-button input-type-number-up">+</div>
																		<div class="input-type-number-button input-type-number-down">-</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="wp-timeline-padding-cover">
															<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Top-Bottom (px)', 'wp-timeline-designer-pro' ); ?></span></div>
															<div class="wp-timeline-padding-content">
																<?php $wp_timeline_wishlistbutton_padding_topbottom = isset( $wtl_settings['wp_timeline_wishlistbutton_padding_topbottom'] ) ? $wtl_settings['wp_timeline_wishlistbutton_padding_topbottom'] : '10'; ?>
																<div class="input-type-number">
																	<input type="number" id="wp_timeline_wishlistbutton_padding_topbottom" name="wp_timeline_wishlistbutton_padding_topbottom" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_wishlistbutton_padding_topbottom ); ?>"  >
																	<div class="input-type-number-nav">
																		<div class="input-type-number-button input-type-number-up">+</div>
																		<div class="input-type-number-button input-type-number-down">-</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</li>
											<li class="wp_timeline_add_to_wishlist_tr">
												<?php wtl_setting_left( esc_html__( 'Margin', 'wp-timeline-designer-pro' ) ); ?>
												<div class="wp-timeline-right wp-timeline-border-cover">
													<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Set wishlist button margin', 'wp-timeline-designer-pro' ); ?></span></span>
													<div class="wp-timeline-padding-wrapper wp-timeline-padding-wrapper1 wp-timeline-border-wrap">
														<div class="wp-timeline-padding-cover">
															<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Left-Right (px)', 'wp-timeline-designer-pro' ); ?></span></div>
															<div class="wp-timeline-padding-content">
																<?php $wp_timeline_wishlistbutton_margin_leftright = isset( $wtl_settings['wp_timeline_wishlistbutton_margin_leftright'] ) ? $wtl_settings['wp_timeline_wishlistbutton_margin_leftright'] : '10'; ?>
																<div class="input-type-number">
																	<input type="number" id="wp_timeline_wishlistbutton_margin_leftright" name="wp_timeline_wishlistbutton_margin_leftright" step="1" value="<?php echo esc_attr( $wp_timeline_wishlistbutton_margin_leftright ); ?>"  >
																	<div class="input-type-number-nav">
																		<div class="input-type-number-button input-type-number-up">+</div>
																		<div class="input-type-number-button input-type-number-down">-</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="wp-timeline-padding-cover">
															<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Top-Bottom (px)', 'wp-timeline-designer-pro' ); ?></span></div>
															<div class="wp-timeline-padding-content">
																<?php $wp_timeline_wishlistbutton_margin_topbottom = isset( $wtl_settings['wp_timeline_wishlistbutton_margin_topbottom'] ) ? $wtl_settings['wp_timeline_wishlistbutton_margin_topbottom'] : '10'; ?>
																<div class="input-type-number">
																	<input type="number" id="wp_timeline_wishlistbutton_margin_topbottom" name="wp_timeline_wishlistbutton_margin_topbottom" step="1" value="<?php echo esc_attr( $wp_timeline_wishlistbutton_margin_topbottom ); ?>"  >
																	<div class="input-type-number-nav">
																		<div class="input-type-number-button input-type-number-up">+</div>
																		<div class="input-type-number-button input-type-number-down">-</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</li>
											<li class="wp_timeline_add_to_wishlist_tr wishlist_button_box_shadow_setting">
												<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Box Shadow Settings', 'wp-timeline-designer-pro' ); ?></h3>
												<div class="wp-timeline-boxshadow-wrapper wp-timeline-boxshadow-wrapper1">
													<div class="wp-timeline-boxshadow-cover">
														<div class="wp-timeline-boxshadow-label">
															<span class="wp-timeline-key-title"><?php esc_html_e( 'H-offset (px)', 'wp-timeline-designer-pro' ); ?></span>
															<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select horizontal offset value', 'wp-timeline-designer-pro' ); ?></span></span>
														</div>
														<div class="wp-timeline-boxshadow-content">
															<?php $wp_timeline_wishlist_button_top_box_shadow = isset( $wtl_settings['wp_timeline_wishlist_button_top_box_shadow'] ) ? $wtl_settings['wp_timeline_wishlist_button_top_box_shadow'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_wishlist_button_top_box_shadow" name="wp_timeline_wishlist_button_top_box_shadow" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_wishlist_button_top_box_shadow ); ?>"  >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-boxshadow-cover">
														<div class="wp-timeline-boxshadow-label">
															<span class="wp-timeline-key-title"><?php esc_html_e( 'V-offset (px)', 'wp-timeline-designer-pro' ); ?></span>
															<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select vertical offset value', 'wp-timeline-designer-pro' ); ?></span></span>
														</div>
														<div class="wp-timeline-boxshadow-content">
															<?php $wp_timeline_wishlist_button_right_box_shadow = isset( $wtl_settings['wp_timeline_wishlist_button_right_box_shadow'] ) ? $wtl_settings['wp_timeline_wishlist_button_right_box_shadow'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_wishlist_button_right_box_shadow" name="wp_timeline_wishlist_button_right_box_shadow" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_wishlist_button_right_box_shadow ); ?>"  >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-boxshadow-cover">
														<div class="wp-timeline-boxshadow-label">
															<span class="wp-timeline-key-title"><?php esc_html_e( 'Blur (px)', 'wp-timeline-designer-pro' ); ?></span>
															<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select blur value', 'wp-timeline-designer-pro' ); ?></span></span>
														</div>
														<div class="wp-timeline-boxshadow-content">
															<?php $wp_timeline_wishlist_button_bottom_box_shadow = isset( $wtl_settings['wp_timeline_wishlist_button_bottom_box_shadow'] ) ? $wtl_settings['wp_timeline_wishlist_button_bottom_box_shadow'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_wishlist_button_bottom_box_shadow" name="wp_timeline_wishlist_button_bottom_box_shadow" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_wishlist_button_bottom_box_shadow ); ?>"  >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-boxshadow-cover">
														<div class="wp-timeline-boxshadow-label">
															<span class="wp-timeline-key-title"><?php esc_html_e( 'Spread (px)', 'wp-timeline-designer-pro' ); ?></span>
															<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select spread value', 'wp-timeline-designer-pro' ); ?></span></span>
														</div>
														<div class="wp-timeline-boxshadow-content">
															<?php $wp_timeline_wishlist_button_left_box_shadow = isset( $wtl_settings['wp_timeline_wishlist_button_left_box_shadow'] ) ? $wtl_settings['wp_timeline_wishlist_button_left_box_shadow'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_wishlist_button_left_box_shadow" name="wp_timeline_wishlist_button_left_box_shadow" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_wishlist_button_left_box_shadow ); ?>"  >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-boxshadow-cover wp-timeline-boxshadow-color">
														<div class="wp-timeline-boxshadow-label">
															<span class="wp-timeline-key-title"><?php esc_html_e( 'Color', 'wp-timeline-designer-pro' ); ?></span>
															<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select box shadow color', 'wp-timeline-designer-pro' ); ?></span></span>
														</div>
														<div class="wp-timeline-boxshadow-content wp-timeline-color-picker">
															<?php $wp_timeline_wishlist_button_box_shadow_color = isset( $wtl_settings['wp_timeline_wishlist_button_box_shadow_color'] ) ? $wtl_settings['wp_timeline_wishlist_button_box_shadow_color'] : ''; ?>
															<input type="text" name="wp_timeline_wishlist_button_box_shadow_color" id="wp_timeline_wishlist_button_box_shadow_color" value="<?php echo esc_attr( $wp_timeline_wishlist_button_box_shadow_color ); ?>"/>
														</div>
													</div>
												</div>
											</li>
											<li class="wp_timeline_add_to_wishlist_tr wishlist_button_box_hover_shadow_setting">
												<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Hover Box Shadow Settings', 'wp-timeline-designer-pro' ); ?></h3>
												<div class="wp-timeline-boxshadow-wrapper wp-timeline-boxshadow-wrapper1">
													<div class="wp-timeline-boxshadow-cover">
														<div class="wp-timeline-boxshadow-label">
															<span class="wp-timeline-key-title"><?php esc_html_e( 'H-offset (px)', 'wp-timeline-designer-pro' ); ?></span>
															<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select horizontal offset value', 'wp-timeline-designer-pro' ); ?></span></span>
														</div>
														<div class="wp-timeline-boxshadow-content">
															<?php $wp_timeline_wishlist_button_hover_top_box_shadow = isset( $wtl_settings['wp_timeline_wishlist_button_hover_top_box_shadow'] ) ? $wtl_settings['wp_timeline_wishlist_button_hover_top_box_shadow'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_wishlist_button_hover_top_box_shadow" name="wp_timeline_wishlist_button_hover_top_box_shadow" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_wishlist_button_hover_top_box_shadow ); ?>"  >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-boxshadow-cover">
														<div class="wp-timeline-boxshadow-label">
															<span class="wp-timeline-key-title"><?php esc_html_e( 'V-offset (px)', 'wp-timeline-designer-pro' ); ?></span>
															<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select vertical side value', 'wp-timeline-designer-pro' ); ?></span></span>
														</div>
														<div class="wp-timeline-boxshadow-content">
															<?php $wp_timeline_wishlist_button_hover_right_box_shadow = isset( $wtl_settings['wp_timeline_wishlist_button_hover_right_box_shadow'] ) ? $wtl_settings['wp_timeline_wishlist_button_hover_right_box_shadow'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_wishlist_button_hover_right_box_shadow" name="wp_timeline_wishlist_button_hover_right_box_shadow" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_wishlist_button_hover_right_box_shadow ); ?>"  >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-boxshadow-cover">
														<div class="wp-timeline-boxshadow-label">
															<span class="wp-timeline-key-title"><?php esc_html_e( 'Blur (px)', 'wp-timeline-designer-pro' ); ?></span>
															<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select blur value', 'wp-timeline-designer-pro' ); ?></span></span>
														</div>
														<div class="wp-timeline-boxshadow-content">
															<?php $wp_timeline_wishlist_button_hover_bottom_box_shadow = isset( $wtl_settings['wp_timeline_wishlist_button_hover_bottom_box_shadow'] ) ? $wtl_settings['wp_timeline_wishlist_button_hover_bottom_box_shadow'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_wishlist_button_hover_bottom_box_shadow" name="wp_timeline_wishlist_button_hover_bottom_box_shadow" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_wishlist_button_hover_bottom_box_shadow ); ?>"  >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-boxshadow-cover">
														<div class="wp-timeline-boxshadow-label">
															<span class="wp-timeline-key-title"><?php esc_html_e( 'Spread (px)', 'wp-timeline-designer-pro' ); ?></span>
															<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select spread value', 'wp-timeline-designer-pro' ); ?></span></span>
														</div>
														<div class="wp-timeline-boxshadow-content">
															<?php $wp_timeline_wishlist_button_hover_left_box_shadow = isset( $wtl_settings['wp_timeline_wishlist_button_hover_left_box_shadow'] ) ? $wtl_settings['wp_timeline_wishlist_button_hover_left_box_shadow'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_wishlist_button_hover_left_box_shadow" name="wp_timeline_wishlist_button_hover_left_box_shadow" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_wishlist_button_hover_left_box_shadow ); ?>"  >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-boxshadow-cover wp-timeline-boxshadow-color">
														<div class="wp-timeline-boxshadow-label">
															<span class="wp-timeline-key-title"><?php esc_html_e( 'Color', 'wp-timeline-designer-pro' ); ?></span>
															<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select box shadow color', 'wp-timeline-designer-pro' ); ?></span></span>
														</div>
														<div class="wp-timeline-boxshadow-content wp-timeline-color-picker">
															<?php $wp_timeline_wishlist_button_hover_box_shadow_color = isset( $wtl_settings['wp_timeline_wishlist_button_hover_box_shadow_color'] ) ? $wtl_settings['wp_timeline_wishlist_button_hover_box_shadow_color'] : ''; ?>
															<input type="text" name="wp_timeline_wishlist_button_hover_box_shadow_color" id="wp_timeline_wishlist_button_hover_box_shadow_color" value="<?php echo esc_attr( $wp_timeline_wishlist_button_hover_box_shadow_color ); ?>"/>
														</div>
													</div>
												</div>
											</li>
											<li class="wp_timeline_add_to_wishlist_tr">
												<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Typography Settings', 'wp-timeline-designer-pro' ); ?></h3>
												<div class="wp-timeline-typography-wrapper wp-timeline-typography-wrapper1">
													<div class="wp-timeline-typography-cover">
														<div class="wp-timeline-typography-label">
															<span class="wp-timeline-key-title"><?php esc_html_e( 'Font Family', 'wp-timeline-designer-pro' ); ?></span>
															<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select wishlist button font family', 'wp-timeline-designer-pro' ); ?></span></span>
														</div>
														<div class="wp-timeline-typography-content">
															<?php $wp_timeline_addtowishlist_button_fontface = isset( $wtl_settings['wp_timeline_addtowishlist_button_fontface'] ) ? $wtl_settings['wp_timeline_addtowishlist_button_fontface'] : ''; ?>
															<div class="typo-field">
																<input type="hidden" id="wp_timeline_addtowishlist_button_fontface_font_type" name="wp_timeline_addtowishlist_button_fontface_font_type" value="<?php echo isset( $wtl_settings['wp_timeline_addtowishlist_button_fontface_font_type'] ) ? esc_attr( $wtl_settings['wp_timeline_addtowishlist_button_fontface_font_type'] ) : ''; ?>">
																<div class="select-cover">
																	<select name="wp_timeline_addtowishlist_button_fontface" id="wp_timeline_addtowishlist_button_fontface">
																		<option value=""><?php esc_html_e( 'Select Font Family', 'wp-timeline-designer-pro' ); ?></option>
																		<?php
																		$old_version = '';
																		$cnt         = 0;
																		$font_family = Wp_Timeline_Main::wtl_default_recognized_font_faces();
																		foreach ( $font_family as $key => $value ) {
																			if ( $value['version'] != $old_version ) {
																				if ( $cnt > 0 ) {
																					echo '</optgroup>';
																				}
																				echo '<optgroup label="' . esc_attr( $value['version'] ) . '">';
																				$old_version = esc_attr( $value['version'] );
																			}
																			echo "<option value='" . esc_attr( str_replace( '"', '', $value['label'] ) ) . "'";
																			if ( '' != $wp_timeline_addtowishlist_button_fontface && ( str_replace( '"', '', $wp_timeline_addtowishlist_button_fontface ) == str_replace( '"', '', $value['label'] ) ) ) {
																				echo ' selected';
																			}
																			echo '>' . esc_attr( $value['label'] ) . '</option>';
																			$cnt++;
																		}
																		if ( count( $font_family ) == $cnt ) {
																			echo '</optgroup>';
																		}
																		?>
																	</select>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-typography-cover">
														<div class="wp-timeline-typography-label">
															<span class="wp-timeline-key-title"><?php esc_html_e( 'Font Size (px)', 'wp-timeline-designer-pro' ); ?></span>
															<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select wishlist button font size', 'wp-timeline-designer-pro' ); ?></span></span>
														</div>
														<div class="wp-timeline-typography-content">
															<?php
															if ( isset( $wtl_settings['wp_timeline_addtowishlist_button_fontsize'] ) && '' != $wtl_settings['wp_timeline_addtowishlist_button_fontsize'] ) {
																$wp_timeline_addtowishlist_button_fontsize = $wtl_settings['wp_timeline_addtowishlist_button_fontsize'];
															} else {
																$wp_timeline_addtowishlist_button_fontsize = 14;
															}
															?>
															<div class="grid_col_space range_slider_fontsize" id="wp_timeline_addtowishlist_button_fontsizeInput" ></div>
															<div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="wp_timeline_addtowishlist_button_fontsize" id="wp_timeline_addtowishlist_button_fontsize" value="<?php echo esc_attr( $wp_timeline_addtowishlist_button_fontsize ); ?>"  /></div>
														</div>
													</div>
													<div class="wp-timeline-typography-cover">
														<div class="wp-timeline-typography-label">
															<span class="wp-timeline-key-title"><?php esc_html_e( 'Font Weight', 'wp-timeline-designer-pro' ); ?></span>
															<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select wishlist button font weight', 'wp-timeline-designer-pro' ); ?></span></span>
														</div>
														<div class="wp-timeline-typography-content">
															<?php $wp_timeline_addtowishlist_button_font_weight = isset( $wtl_settings['wp_timeline_addtowishlist_button_font_weight'] ) ? $wtl_settings['wp_timeline_addtowishlist_button_font_weight'] : 'normal'; ?>
															<div class="select-cover">
																<select name="wp_timeline_addtowishlist_button_font_weight" id="wp_timeline_addtowishlist_button_font_weight">
																	<option value="100" <?php selected( $wp_timeline_addtowishlist_button_font_weight, 100 ); ?>>100</option>
																	<option value="200" <?php selected( $wp_timeline_addtowishlist_button_font_weight, 200 ); ?>>200</option>
																	<option value="300" <?php selected( $wp_timeline_addtowishlist_button_font_weight, 300 ); ?>>300</option>
																	<option value="400" <?php selected( $wp_timeline_addtowishlist_button_font_weight, 400 ); ?>>400</option>
																	<option value="500" <?php selected( $wp_timeline_addtowishlist_button_font_weight, 500 ); ?>>500</option>
																	<option value="600" <?php selected( $wp_timeline_addtowishlist_button_font_weight, 600 ); ?>>600</option>
																	<option value="700" <?php selected( $wp_timeline_addtowishlist_button_font_weight, 700 ); ?>>700</option>
																	<option value="800" <?php selected( $wp_timeline_addtowishlist_button_font_weight, 800 ); ?>>800</option>
																	<option value="900" <?php selected( $wp_timeline_addtowishlist_button_font_weight, 900 ); ?>>900</option>
																	<option value="bold" <?php selected( $wp_timeline_addtowishlist_button_font_weight, 'bold' ); ?> ><?php esc_html_e( 'Bold', 'wp-timeline-designer-pro' ); ?></option>
																	<option value="normal" <?php selected( $wp_timeline_addtowishlist_button_font_weight, 'normal' ); ?>><?php esc_html_e( 'Normal', 'wp-timeline-designer-pro' ); ?></option>
																</select>
															</div>
														</div>
													</div>
													<div class="wp-timeline-typography-cover">
														<div class="wp-timeline-typography-label">
															<span class="wp-timeline-key-title"><?php esc_html_e( 'Line Height', 'wp-timeline-designer-pro' ); ?></span>
															<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select wishlist button line height', 'wp-timeline-designer-pro' ); ?></span></span>
														</div>
														<div class="wp-timeline-typography-content">
															<div class="input-type-number">
															<?php
															$display_wishlist_button_line_height = '1.5';
															if ( isset( $wtl_settings['display_wishlist_button_line_height'] ) ) {
																$display_wishlist_button_line_height = $wtl_settings['display_wishlist_button_line_height'];
															}
															?>
															<div class="input-type-number">
																<input type="number" id="display_wishlist_button_line_height" name="display_wishlist_button_line_height" step="1" min="1.5" value="<?php echo esc_attr( $display_wishlist_button_line_height ); ?>" placeholder="<?php esc_attr_e( 'Enter line height', 'wp-timeline-designer-pro' ); ?>" >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-typography-cover">
														<div class="wp-timeline-typography-label">
															<span class="wp-timeline-key-title"><?php esc_html_e( 'Italic Font Style', 'wp-timeline-designer-pro' ); ?></span>
															<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Display wishlist button italic font style', 'wp-timeline-designer-pro' ); ?></span></span><?php $wp_timeline_addtowishlist_button_font_italic = isset( $wtl_settings['wp_timeline_addtowishlist_button_font_italic'] ) ? $wtl_settings['wp_timeline_addtowishlist_button_font_italic'] : '0'; ?>
														</div>
														<div class="wp-timeline-typography-content">
															<fieldset class="wp-timeline-social-options wp-timeline-display_author buttonset ui-buttonset">
																<input id="wp_timeline_addtowishlist_button_font_italic_1" name="wp_timeline_addtowishlist_button_font_italic" type="radio" value="1"  <?php checked( 1, $wp_timeline_addtowishlist_button_font_italic ); ?> />
																<label for="wp_timeline_addtowishlist_button_font_italic_1" class="<?php echo esc_html( $uic_l ); ?>"><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
																<input id="wp_timeline_addtowishlist_button_font_italic_0" name="wp_timeline_addtowishlist_button_font_italic" type="radio" value="0" <?php checked( 0, $wp_timeline_addtowishlist_button_font_italic ); ?> />
																<label for="wp_timeline_addtowishlist_button_font_italic_0" class="<?php echo esc_html( $uic_r ); ?>"><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
															</fieldset>
														</div>
													</div>
													<div class="wp-timeline-typography-cover">
														<div class="wp-timeline-typography-label">
															<span class="wp-timeline-key-title"><?php esc_html_e( 'Text Transform', 'wp-timeline-designer-pro' ); ?></span>
															<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select wishlist button text transform style', 'wp-timeline-designer-pro' ); ?></span></span>
														</div>
														<div class="wp-timeline-typography-content">
															<?php $wp_timeline_addtowishlist_button_font_text_transform = isset( $wtl_settings['wp_timeline_addtowishlist_button_font_text_transform'] ) ? $wtl_settings['wp_timeline_addtowishlist_button_font_text_transform'] : 'none'; ?>
															<div class="select-cover">
																<select name="wp_timeline_addtowishlist_button_font_text_transform" id="wp_timeline_addtowishlist_button_font_text_transform">
																	<option <?php selected( $wp_timeline_addtowishlist_button_font_text_transform, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'wp-timeline-designer-pro' ); ?></option>
																	<option <?php selected( $wp_timeline_addtowishlist_button_font_text_transform, 'capitalize' ); ?> value="capitalize"><?php esc_html_e( 'Capitalize', 'wp-timeline-designer-pro' ); ?></option>
																	<option <?php selected( $wp_timeline_addtowishlist_button_font_text_transform, 'uppercase' ); ?> value="uppercase"><?php esc_html_e( 'Uppercase', 'wp-timeline-designer-pro' ); ?></option>
																	<option <?php selected( $wp_timeline_addtowishlist_button_font_text_transform, 'lowercase' ); ?> value="lowercase"><?php esc_html_e( 'Lowercase', 'wp-timeline-designer-pro' ); ?></option>
																	<option <?php selected( $wp_timeline_addtowishlist_button_font_text_transform, 'full-width' ); ?> value="full-width"><?php esc_html_e( 'Full Width', 'wp-timeline-designer-pro' ); ?></option>
																</select>
															</div>
														</div>
													</div>
													<div class="wp-timeline-typography-cover">
														<div class="wp-timeline-typography-label">
															<span class="wp-timeline-key-title"><?php esc_html_e( 'Text Decoration', 'wp-timeline-designer-pro' ); ?></span>
															<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select wishlist button text decoration style', 'wp-timeline-designer-pro' ); ?></span></span>
														</div>
														<div class="wp-timeline-typography-content">
															<?php $wp_timeline_addtowishlist_button_font_text_decoration = isset( $wtl_settings['wp_timeline_addtowishlist_button_font_text_decoration'] ) ? $wtl_settings['wp_timeline_addtowishlist_button_font_text_decoration'] : 'none'; ?>
															<div class="select-cover">
																<select name="wp_timeline_addtowishlist_button_font_text_decoration" id="wp_timeline_addtowishlist_button_font_text_decoration">
																	<option <?php selected( $wp_timeline_addtowishlist_button_font_text_decoration, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'wp-timeline-designer-pro' ); ?></option>
																	<option <?php selected( $wp_timeline_addtowishlist_button_font_text_decoration, 'underline' ); ?> value="underline"><?php esc_html_e( 'Underline', 'wp-timeline-designer-pro' ); ?></option>
																	<option <?php selected( $wp_timeline_addtowishlist_button_font_text_decoration, 'overline' ); ?> value="overline"><?php esc_html_e( 'Overline', 'wp-timeline-designer-pro' ); ?></option>
																	<option <?php selected( $wp_timeline_addtowishlist_button_font_text_decoration, 'line-through' ); ?> value="line-through"><?php esc_html_e( 'Line Through', 'wp-timeline-designer-pro' ); ?></option>
																</select>
															</div>
														</div>
													</div>
													<div class="wp-timeline-typography-cover">
														<div class="wp-timeline-typography-label">
															<span class="wp-timeline-key-title"><?php esc_html_e( 'Letter Spacing (px)', 'wp-timeline-designer-pro' ); ?></span>
															<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enter wishlist button letter spacing', 'wp-timeline-designer-pro' ); ?></span></span>
														</div>
														<div class="wp-timeline-typography-content"><div class="input-type-number"><input type="number" name="wp_timeline_addtowishlist_button_letter_spacing" id="wp_timeline_addtowishlist_button_letter_spacing" step="1" min="0" value="<?php echo isset( $wtl_settings['wp_timeline_addtowishlist_button_letter_spacing'] ) ? esc_attr( $wtl_settings['wp_timeline_addtowishlist_button_letter_spacing'] ) : '0'; ?>" >
														<div class="input-type-number-nav">
															<div class="input-type-number-button input-type-number-up">+</div>
															<div class="input-type-number-button input-type-number-down">-</div>
														</div></div></div>
													</div>
												</div>
											</li>
										</ul>
									</li>
								<?php } ?>
							</ul>
						</div>
					</div>
					<?php
				}
				if ( 'easy-digital-downloads/easy-digital-downloads.php' ) {
					?>
					<div id="wp_timeline_eddsetting" class="postbox postbox-with-fw-options" style='<?php echo esc_attr( $wp_timeline_eddsetting_class_show ); ?>'>
						<div class="inside">
							<ul class="wp-timeline-settings wp-timeline-lineheight">
								<li>
									<?php wtl_setting_left( esc_html__( 'Display Price', 'wp-timeline-designer-pro' ) ); ?>
									<div class="wp-timeline-right">
										<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable product price', 'wp-timeline-designer-pro' ); ?></span></span>
										<?php
										$display_download_price = '1';
										if ( isset( $wtl_settings['display_download_price'] ) ) {
											$display_download_price = $wtl_settings['display_download_price'];
										}
										?>
										<fieldset class="wp-timeline-social-style buttonset ui-buttonset buttonset-hide" data-hide='1'>
											<input id="display_download_price_1" name="display_download_price" type="radio" value="1" <?php checked( 1, $display_download_price ); ?> />
											<label id="wp-timeline-options-button" for="display_download_price_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $display_download_price ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
											<input id="display_download_price_0" name="display_download_price" type="radio" value="0" <?php checked( 0, $display_download_price ); ?> />
											<label id="wp-timeline-options-button" for="display_download_price_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 1, $display_download_price ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
										</fieldset>
									</div>
								</li>
								<li class="wp_timeline_edd_price_setting">
									<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Product Price Settings', 'wp-timeline-designer-pro' ); ?></h3>
									<ul>
										<li class="wp_timeline_pricetext_tr">
											<?php wtl_setting_left( esc_html__( 'Text Color', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right wp-timeline-color-picker">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select price text color', 'wp-timeline-designer-pro' ); ?></span></span>
												<?php $wp_timeline_edd_price_color = ( isset( $wtl_settings['wp_timeline_edd_price_color'] ) && '' != $wtl_settings['wp_timeline_edd_price_color'] ) ? $wtl_settings['wp_timeline_edd_price_color'] : '#444444'; ?>
												<input type="text" name="wp_timeline_edd_price_color" id="wp_timeline_edd_price_color" value="<?php echo esc_attr( $wp_timeline_edd_price_color ); ?>"/>
											</div>
										</li>
										<li class="wp_timeline_edd_pricetext_tr wp_timeline_edd_pricetext_alignment_tr">
											<?php wtl_setting_left( esc_html__( 'Alignment', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select price text alignment', 'wp-timeline-designer-pro' ); ?></span></span>
												<?php
												$wp_timeline_edd_price_alignment = 'left';
												if ( isset( $wtl_settings['wp_timeline_edd_price_alignment'] ) ) {
													$wp_timeline_edd_price_alignment = $wtl_settings['wp_timeline_edd_price_alignment'];
												}
												?>
												<fieldset class="buttonset ui-buttonset green" data-hide='1'>
													<input id="wp_timeline_edd_price_alignment_left" name="wp_timeline_edd_price_alignment" type="radio" value="left" <?php checked( 'left', $wp_timeline_edd_price_alignment ); ?> />
													<label id="wp-timeline-options-button" for="wp_timeline_edd_price_alignment_left"><?php esc_html_e( 'Left', 'wp-timeline-designer-pro' ); ?></label>
													<input id="wp_timeline_edd_price_alignment_center" name="wp_timeline_edd_price_alignment" type="radio" value="center" <?php checked( 'center', $wp_timeline_edd_price_alignment ); ?> />
													<label id="wp-timeline-options-button" for="wp_timeline_edd_price_alignment_center" class="wp_timeline_edd_price_alignment_center"><?php esc_html_e( 'Center', 'wp-timeline-designer-pro' ); ?></label>
													<input id="wp_timeline_edd_price_alignment_right" name="wp_timeline_edd_price_alignment" type="radio" value="right" <?php checked( 'right', $wp_timeline_edd_price_alignment ); ?> />
													<label id="wp-timeline-options-button" for="wp_timeline_edd_price_alignment_right"><?php esc_html_e( 'Right', 'wp-timeline-designer-pro' ); ?></label>
												</fieldset>
											</div>
										</li>
										<li class="wp_timeline_edd_pricetext_tr wp_timeline_edd_pricetext_padding_setting_tr">
											<?php wtl_setting_left( esc_html__( 'Padding', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right wp-timeline-border-cover">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Set price text padding', 'wp-timeline-designer-pro' ); ?></span></span>
												<div class="wp-timeline-padding-wrapper wp-timeline-padding-wrapper1 wp-timeline-border-wrap">
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Left (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_edd_price_paddingleft = isset( $wtl_settings['wp_timeline_edd_price_paddingleft'] ) ? $wtl_settings['wp_timeline_edd_price_paddingleft'] : '10'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_edd_price_paddingleft" name="wp_timeline_edd_price_paddingleft" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_edd_price_paddingleft ); ?>"  >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Right (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_edd_price_paddingright = isset( $wtl_settings['wp_timeline_edd_price_paddingright'] ) ? $wtl_settings['wp_timeline_edd_price_paddingright'] : '10'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_edd_price_paddingright" name="wp_timeline_edd_price_paddingright" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_edd_price_paddingright ); ?>" >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Top (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_edd_price_paddingtop = isset( $wtl_settings['wp_timeline_edd_price_paddingtop'] ) ? $wtl_settings['wp_timeline_edd_price_paddingtop'] : '10'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_edd_price_paddingtop" name="wp_timeline_edd_price_paddingtop" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_edd_price_paddingtop ); ?>"  >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Bottom (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_edd_price_paddingbottom = isset( $wtl_settings['wp_timeline_edd_price_paddingbottom'] ) ? $wtl_settings['wp_timeline_edd_price_paddingbottom'] : '10'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_edd_price_paddingbottom" name="wp_timeline_edd_price_paddingbottom" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_edd_price_paddingbottom ); ?>" >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li class="wp_timeline_edd_pricetext_tr wp_timeline_edd_pricetext_typography_setting_tr">
											<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Typography Settings', 'wp-timeline-designer-pro' ); ?></h3>
											<div class="wp-timeline-typography-wrapper wp-timeline-typography-wrapper1">
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Font Family', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select price text font family', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content">
														<?php
														if ( isset( $wtl_settings['wp_timeline_edd_pricefontface'] ) && '' != $wtl_settings['wp_timeline_edd_pricefontface'] ) {
															$wp_timeline_edd_pricefontface = $wtl_settings['wp_timeline_edd_pricefontface'];
														} else {
															$wp_timeline_edd_pricefontface = '';
														}
														?>
														<div class="typo-field">
															<input type="hidden" id="wp_timeline_edd_pricefontface_font_type" name="wp_timeline_edd_pricefontface_font_type" value="<?php echo isset( $wtl_settings['wp_timeline_edd_pricefontface_font_type'] ) ? esc_attr( $wtl_settings['wp_timeline_edd_pricefontface_font_type'] ) : ''; ?>">
															<div class="select-cover">
																<select name="wp_timeline_edd_pricefontface" id="wp_timeline_edd_pricefontface">
																	<option value=""><?php esc_html_e( 'Select Font Family', 'wp-timeline-designer-pro' ); ?></option>
																	<?php
																	$old_version = '';
																	$cnt         = 0;
																	$font_family = Wp_Timeline_Main::wtl_default_recognized_font_faces();
																	foreach ( $font_family as $key => $value ) {
																		if ( $value['version'] != $old_version ) {
																			if ( $cnt > 0 ) {
																				echo '</optgroup>';
																			}
																			echo '<optgroup label="' . esc_attr( $value['version'] ) . '">';
																			$old_version = $value['version'];
																		}
																		echo "<option value='" . esc_attr( str_replace( '"', '', $value['label'] ) ) . "'";
																		if ( '' != $wp_timeline_edd_pricefontface && ( str_replace( '"', '', $wp_timeline_edd_pricefontface ) == str_replace( '"', '', $value['label'] ) ) ) {
																			echo ' selected';
																		}
																		echo '>' . esc_html( $value['label'] ) . '</option>';
																		$cnt++;
																	}
																	if ( count( $font_family ) == $cnt ) {
																		echo '</optgroup>';
																	}
																	?>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Font Size (px)', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select price text font size', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content">
														<?php
														if ( isset( $wtl_settings['wp_timeline_edd_pricefontsize'] ) && '' != $wtl_settings['wp_timeline_edd_pricefontsize'] ) {
															$wp_timeline_edd_pricefontsize = $wtl_settings['wp_timeline_edd_pricefontsize'];
														} else {
															$wp_timeline_edd_pricefontsize = 14;
														}
														?>
														<div class="grid_col_space range_slider_fontsize" id="wp_timeline_edd_pricefontsizeInput"></div>
														<div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="wp_timeline_edd_pricefontsize" id="wp_timeline_edd_pricefontsize" value="<?php echo esc_attr( $wp_timeline_edd_pricefontsize ); ?>"  /></div>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Font Weight', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select price text font weight', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content">
														<?php $wp_timeline_edd_price_font_weight = isset( $wtl_settings['wp_timeline_edd_price_font_weight'] ) ? $wtl_settings['wp_timeline_edd_price_font_weight'] : 'normal'; ?>
														<div class="select-cover">
															<select name="wp_timeline_edd_price_font_weight" id="wp_timeline_edd_price_font_weight">
																<option value="100" <?php selected( $wp_timeline_edd_price_font_weight, 100 ); ?>>100</option>
																<option value="200" <?php selected( $wp_timeline_edd_price_font_weight, 200 ); ?>>200</option>
																<option value="300" <?php selected( $wp_timeline_edd_price_font_weight, 300 ); ?>>300</option>
																<option value="400" <?php selected( $wp_timeline_edd_price_font_weight, 400 ); ?>>400</option>
																<option value="500" <?php selected( $wp_timeline_edd_price_font_weight, 500 ); ?>>500</option>
																<option value="600" <?php selected( $wp_timeline_edd_price_font_weight, 600 ); ?>>600</option>
																<option value="700" <?php selected( $wp_timeline_edd_price_font_weight, 700 ); ?>>700</option>
																<option value="800" <?php selected( $wp_timeline_edd_price_font_weight, 800 ); ?>>800</option>
																<option value="900" <?php selected( $wp_timeline_edd_price_font_weight, 900 ); ?>>900</option>
																<option value="bold" <?php selected( $wp_timeline_edd_price_font_weight, 'bold' ); ?> ><?php esc_html_e( 'Bold', 'wp-timeline-designer-pro' ); ?></option>
																<option value="normal" <?php selected( $wp_timeline_edd_price_font_weight, 'normal' ); ?>><?php esc_html_e( 'Normal', 'wp-timeline-designer-pro' ); ?></option>
															</select>
														</div>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Line Height', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select price text line height', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content"><div class="input-type-number"><input type="number" name="wp_timeline_edd_price_font_line_height" id="wp_timeline_edd_price_font_line_height" step="0.1" min="0" value="<?php echo isset( $wtl_settings['wp_timeline_edd_price_font_line_height'] ) ? esc_attr( $wtl_settings['wp_timeline_edd_price_font_line_height'] ) : '1.5'; ?>"  >
													<div class="input-type-number-nav">
														<div class="input-type-number-button input-type-number-up">+</div>
														<div class="input-type-number-button input-type-number-down">-</div>
													</div></div></div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Italic Font Style', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Display price text italic font style', 'wp-timeline-designer-pro' ); ?></span></span><?php $wp_timeline_edd_price_font_italic = isset( $wtl_settings['wp_timeline_edd_price_font_italic'] ) ? $wtl_settings['wp_timeline_edd_price_font_italic'] : '0'; ?>
													</div>
													<div class="wp-timeline-typography-content">
														<fieldset class="wp-timeline-social-options wp-timeline-display_author buttonset ui-buttonset">
															<input id="wp_timeline_edd_price_font_italic_1" name="wp_timeline_edd_price_font_italic" type="radio" value="1"  <?php checked( 1, $wp_timeline_edd_price_font_italic ); ?> />
															<label for="wp_timeline_edd_price_font_italic_1" class="<?php echo esc_html( $uic_l ); ?>"><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
															<input id="wp_timeline_edd_price_font_italic_0" name="wp_timeline_edd_price_font_italic" type="radio" value="0" <?php checked( 0, $wp_timeline_edd_price_font_italic ); ?> />
															<label for="wp_timeline_edd_price_font_italic_0" class="<?php echo esc_html( $uic_r ); ?>"><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
														</fieldset>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Text Decoration', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select price text decoration style', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content">
														<?php $wp_timeline_edd_price_font_text_decoration = isset( $wtl_settings['wp_timeline_edd_price_font_text_decoration'] ) ? $wtl_settings['wp_timeline_edd_price_font_text_decoration'] : 'none'; ?>
														<div class="select-cover">
															<select name="wp_timeline_edd_price_font_text_decoration" id="wp_timeline_edd_price_font_text_decoration">
																<option <?php selected( $wp_timeline_edd_price_font_text_decoration, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'wp-timeline-designer-pro' ); ?></option>
																<option <?php selected( $wp_timeline_edd_price_font_text_decoration, 'underline' ); ?> value="underline"><?php esc_html_e( 'Underline', 'wp-timeline-designer-pro' ); ?></option>
																<option <?php selected( $wp_timeline_edd_price_font_text_decoration, 'overline' ); ?> value="overline"><?php esc_html_e( 'Overline', 'wp-timeline-designer-pro' ); ?></option>
																<option <?php selected( $wp_timeline_edd_price_font_text_decoration, 'line-through' ); ?> value="line-through"><?php esc_html_e( 'Line Through', 'wp-timeline-designer-pro' ); ?></option>
															</select>
														</div>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Letter Spacing (px)', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enter price text letter spacing', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content"><div class="input-type-number"><input type="number" name="wp_timeline_edd_price_font_letter_spacing" id="wp_timeline_edd_price_font_letter_spacing" step="1" min="0" value="<?php echo isset( $wtl_settings['wp_timeline_edd_price_font_letter_spacing'] ) ? esc_attr( $wtl_settings['wp_timeline_edd_price_font_letter_spacing'] ) : '0'; ?>" >
													<div class="input-type-number-nav">
														<div class="input-type-number-button input-type-number-up">+</div>
														<div class="input-type-number-button input-type-number-down">-</div>
													</div></div></div>
												</div>
											</div>
										</li>
									</ul>
								</li>
								<li>
									<?php wtl_setting_left( esc_html__( 'Display Purchase Button', 'wp-timeline-designer-pro' ) ); ?>
									<div class="wp-timeline-right">
										<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable purchase button', 'wp-timeline-designer-pro' ); ?></span></span>
										<?php
										$display_edd_addtocart_button = '1';
										if ( isset( $wtl_settings['display_edd_addtocart_button'] ) ) {
											$display_edd_addtocart_button = $wtl_settings['display_edd_addtocart_button'];
										}
										?>
										<fieldset class="wp-timeline-social-style buttonset ui-buttonset buttonset-hide" data-hide='1'>
											<input id="display_edd_addtocart_button_1" name="display_edd_addtocart_button" type="radio" value="1" <?php checked( 1, $display_edd_addtocart_button ); ?> />
											<label id="wp-timeline-options-button" for="display_edd_addtocart_button_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $display_edd_addtocart_button ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
											<input id="display_edd_addtocart_button_0" name="display_edd_addtocart_button" type="radio" value="0" <?php checked( 0, $display_edd_addtocart_button ); ?> />
											<label id="wp-timeline-options-button" for="display_edd_addtocart_button_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $display_edd_addtocart_button ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
										</fieldset>
									</div>
								</li>
								<li class="wp_timeline_edd_cart_button_setting">
									<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Purchase Button Settings', 'wp-timeline-designer-pro' ); ?></h3>
									<ul>
										<li class="wp_timeline_edd_add_to_cart_tr edd_cart_button_alignment">
											<?php wtl_setting_left( esc_html__( 'Alignment', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select cart button alignment', 'wp-timeline-designer-pro' ); ?></span></span>
												<?php
												$wp_timeline_edd_addtocartbutton_alignment = 'left';
												if ( isset( $wtl_settings['wp_timeline_edd_addtocartbutton_alignment'] ) ) {
													$wp_timeline_edd_addtocartbutton_alignment = $wtl_settings['wp_timeline_edd_addtocartbutton_alignment'];
												}
												?>
												<fieldset class="buttonset ui-buttonset green" data-hide='1'>
													<input id="wp_timeline_edd_addtocartbutton_alignment_left" name="wp_timeline_edd_addtocartbutton_alignment" type="radio" value="left" <?php checked( 'left', $wp_timeline_edd_addtocartbutton_alignment ); ?> />
													<label id="wp-timeline-options-button" for="wp_timeline_edd_addtocartbutton_alignment_left"><?php esc_html_e( 'Left', 'wp-timeline-designer-pro' ); ?></label>
													<input id="wp_timeline_edd_addtocartbutton_alignment_center" name="wp_timeline_edd_addtocartbutton_alignment" type="radio" value="center" <?php checked( 'center', $wp_timeline_edd_addtocartbutton_alignment ); ?> />
													<label id="wp-timeline-options-button" for="wp_timeline_edd_addtocartbutton_alignment_center" class="wp_timeline_edd_addtocartbutton_alignment_center"><?php esc_html_e( 'Center', 'wp-timeline-designer-pro' ); ?></label>
													<input id="wp_timeline_edd_addtocartbutton_alignment_right" name="wp_timeline_edd_addtocartbutton_alignment" type="radio" value="right" <?php checked( 'right', $wp_timeline_edd_addtocartbutton_alignment ); ?> />
													<label id="wp-timeline-options-button" for="wp_timeline_edd_addtocartbutton_alignment_right"><?php esc_html_e( 'Right', 'wp-timeline-designer-pro' ); ?></label>
												</fieldset>
											</div>
										</li>
										<li class="wp_timeline_edd_add_to_cart_tr">
											<?php wtl_setting_left( esc_html__( 'Text Color', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right wp-timeline-color-picker">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select cart button text color', 'wp-timeline-designer-pro' ); ?></span></span>
												<?php
												if ( isset( $wtl_settings['wp_timeline_edd_addtocart_textcolor'] ) ) {
													$wp_timeline_edd_addtocart_textcolor = $wtl_settings['wp_timeline_edd_addtocart_textcolor'];
												} else {
													$wp_timeline_edd_addtocart_textcolor = '';
												}
												?>
												<input type="text" name="wp_timeline_edd_addtocart_textcolor" id="wp_timeline_edd_addtocart_textcolor" value="<?php echo esc_attr( $wp_timeline_edd_addtocart_textcolor ); ?>"/>
											</div>
										</li>
										<li class="wp_timeline_edd_add_to_cart_tr">
											<?php wtl_setting_left( esc_html__( 'Hover Text Color', 'wp-timeline-designer-pro' ) ); ?>                                       
											<div class="wp-timeline-right wp-timeline-color-picker">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select cart button text hover color', 'wp-timeline-designer-pro' ); ?></span></span>
												<?php $wp_timeline_edd_addtocart_text_hover_color = isset( $wtl_settings['wp_timeline_edd_addtocart_text_hover_color'] ) ? $wtl_settings['wp_timeline_edd_addtocart_text_hover_color'] : ''; ?>
												<input type="text" name="wp_timeline_edd_addtocart_text_hover_color" id="wp_timeline_edd_addtocart_text_hover_color" value="<?php echo esc_attr( $wp_timeline_edd_addtocart_text_hover_color ); ?>"/>
											</div>
										</li>
										<li class="wp_timeline_edd_add_to_cart_tr">
											<?php wtl_setting_left( esc_html__( 'Background Color', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right wp-timeline-color-picker">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select cart button background color', 'wp-timeline-designer-pro' ); ?></span></span>
												<?php $wp_timeline_edd_addtocart_backgroundcolor = isset( $wtl_settings['wp_timeline_edd_addtocart_backgroundcolor'] ) ? $wtl_settings['wp_timeline_edd_addtocart_backgroundcolor'] : ''; ?>
												<input type="text" name="wp_timeline_edd_addtocart_backgroundcolor" id="wp_timeline_edd_addtocart_backgroundcolor" value="<?php echo esc_attr( $wp_timeline_edd_addtocart_backgroundcolor ); ?>"/>
											</div>
										</li>
										<li class="wp_timeline_edd_add_to_cart_tr">
											<?php wtl_setting_left( esc_html__( 'Hover Background Color', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right wp-timeline-color-picker">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select cart button hover background color', 'wp-timeline-designer-pro' ); ?></span></span>
												<?php $wp_timeline_edd_addtocart_hover_backgroundcolor = isset( $wtl_settings['wp_timeline_edd_addtocart_hover_backgroundcolor'] ) ? $wtl_settings['wp_timeline_edd_addtocart_hover_backgroundcolor'] : ''; ?>
												<input type="text" name="wp_timeline_edd_addtocart_hover_backgroundcolor" id="wp_timeline_edd_addtocart_hover_backgroundcolor" value="<?php echo esc_attr( $wp_timeline_edd_addtocart_hover_backgroundcolor ); ?>"/>
											</div>
										</li>
										<li class="wp_timeline_edd_addtocart_button_border_setting wp_timeline_edd_add_to_cart_tr">
											<?php wtl_setting_left( esc_html__( 'Border Radius(px)', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select cart button border radius', 'wp-timeline-designer-pro' ); ?></span></span>
												<?php
												$display_edd_addtocart_button_border_radius = '0';
												if ( isset( $wtl_settings['display_edd_addtocart_button_border_radius'] ) ) {
													$display_edd_addtocart_button_border_radius = $wtl_settings['display_edd_addtocart_button_border_radius'];
												}
												?>
												<div class="input-type-number">
													<input type="number" id="display_edd_addtocart_button_border_radius" name="display_edd_addtocart_button_border_radius" step="1" min="0" value="<?php echo esc_attr( $display_edd_addtocart_button_border_radius ); ?>" >
													<div class="input-type-number-nav">
														<div class="input-type-number-button input-type-number-up">+</div>
														<div class="input-type-number-button input-type-number-down">-</div>
													</div>
												</div>
											</div>
										</li>
										<li class="wp_timeline_edd_addtocart_button_border_setting wp_timeline_edd_add_to_cart_tr">
											<?php wtl_setting_left( esc_html__( 'Border', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right wp-timeline-border-cover">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select cart button border', 'wp-timeline-designer-pro' ); ?></span></span>
												<div class="wp-timeline-border-wrap">
													<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
														<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Left (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-border-cover">
															<div class="wp-timeline-border-content">
																<?php $wp_timeline_edd_addtocartbutton_borderleft = isset( $wtl_settings['wp_timeline_edd_addtocartbutton_borderleft'] ) ? $wtl_settings['wp_timeline_edd_addtocartbutton_borderleft'] : '0'; ?>
																<div class="input-type-number">
																	<input type="number" id="wp_timeline_edd_addtocartbutton_borderleft" name="wp_timeline_edd_addtocartbutton_borderleft" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_borderleft ); ?>"  >
																	<div class="input-type-number-nav">
																		<div class="input-type-number-button input-type-number-up">+</div>
																		<div class="input-type-number-button input-type-number-down">-</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="wp-timeline-border-cover wp-timeline-color-picker">
															<div class="wp-timeline-border-content">
																<?php $wp_timeline_edd_addtocartbutton_borderleftcolor = isset( $wtl_settings['wp_timeline_edd_addtocartbutton_borderleftcolor'] ) ? $wtl_settings['wp_timeline_edd_addtocartbutton_borderleftcolor'] : ''; ?>
																<input type="text" name="wp_timeline_edd_addtocartbutton_borderleftcolor" id="wp_timeline_edd_addtocartbutton_borderleftcolor" value="<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_borderleftcolor ); ?>"/>
															</div>
														</div>
													</div> 
													<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
														<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Right (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-border-cover">
															<div class="wp-timeline-border-content">
																<?php $wp_timeline_edd_addtocartbutton_borderright = isset( $wtl_settings['wp_timeline_edd_addtocartbutton_borderright'] ) ? $wtl_settings['wp_timeline_edd_addtocartbutton_borderright'] : '0'; ?>
																<div class="input-type-number">
																	<input type="number" id="wp_timeline_edd_addtocartbutton_borderright" name="wp_timeline_edd_addtocartbutton_borderright" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_borderright ); ?>" >
																	<div class="input-type-number-nav">
																		<div class="input-type-number-button input-type-number-up">+</div>
																		<div class="input-type-number-button input-type-number-down">-</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="wp-timeline-border-cover wp-timeline-color-picker">
															<div class="wp-timeline-border-content">
															<?php $wp_timeline_edd_addtocartbutton_borderrightcolor = isset( $wtl_settings['wp_timeline_edd_addtocartbutton_borderrightcolor'] ) ? $wtl_settings['wp_timeline_edd_addtocartbutton_borderrightcolor'] : ''; ?>
																<input type="text" name="wp_timeline_edd_addtocartbutton_borderrightcolor" id="wp_timeline_edd_addtocartbutton_borderrightcolor" value="<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_borderrightcolor ); ?>"/>
															</div>
														</div>
													</div>
													<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
														<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Top (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-border-cover">
															<div class="wp-timeline-border-content">
																<?php $wp_timeline_edd_addtocartbutton_bordertop = isset( $wtl_settings['wp_timeline_edd_addtocartbutton_bordertop'] ) ? $wtl_settings['wp_timeline_edd_addtocartbutton_bordertop'] : '0'; ?>
																<div class="input-type-number">
																	<input type="number" id="wp_timeline_edd_addtocartbutton_bordertop" name="wp_timeline_edd_addtocartbutton_bordertop" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_bordertop ); ?>" >
																	<div class="input-type-number-nav">
																		<div class="input-type-number-button input-type-number-up">+</div>
																		<div class="input-type-number-button input-type-number-down">-</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="wp-timeline-border-cover wp-timeline-color-picker">
															<div class="wp-timeline-border-content">
																<?php $wp_timeline_edd_addtocartbutton_bordertopcolor = isset( $wtl_settings['wp_timeline_edd_addtocartbutton_bordertopcolor'] ) ? $wtl_settings['wp_timeline_edd_addtocartbutton_bordertopcolor'] : ''; ?>
																<input type="text" name="wp_timeline_edd_addtocartbutton_bordertopcolor" id="wp_timeline_edd_addtocartbutton_bordertopcolor" value="<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_bordertopcolor ); ?>"/>
															</div>
														</div>
													</div>
													<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
														<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Bottom(px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-border-cover">
															<div class="wp-timeline-border-content">
																<?php $wp_timeline_edd_addtocartbutton_borderbuttom = isset( $wtl_settings['wp_timeline_edd_addtocartbutton_borderbuttom'] ) ? $wtl_settings['wp_timeline_edd_addtocartbutton_borderbuttom'] : '0'; ?>
																<div class="input-type-number">
																	<input type="number" id="wp_timeline_edd_addtocartbutton_borderbuttom" name="wp_timeline_edd_addtocartbutton_borderbuttom" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_borderbuttom ); ?>" >
																	<div class="input-type-number-nav">
																		<div class="input-type-number-button input-type-number-up">+</div>
																		<div class="input-type-number-button input-type-number-down">-</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="wp-timeline-border-cover wp-timeline-color-picker">
															<div class="wp-timeline-border-content">
															<?php $wp_timeline_edd_addtocartbutton_borderbottomcolor = isset( $wtl_settings['wp_timeline_edd_addtocartbutton_borderbottomcolor'] ) ? $wtl_settings['wp_timeline_edd_addtocartbutton_borderbottomcolor'] : ''; ?>
															<input type="text" name="wp_timeline_edd_addtocartbutton_borderbottomcolor" id="wp_timeline_edd_addtocartbutton_borderbottomcolor" value="<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_borderbottomcolor ); ?>"/>
															</div>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li class="wp_timeline_edd_addtocart_button_border_hover_setting wp_timeline_edd_add_to_cart_tr">
											<?php wtl_setting_left( esc_html__( 'Hover Border Radius(px)', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select cart button hover border radius', 'wp-timeline-designer-pro' ); ?></span></span>
												<?php
												$display_edd_addtocart_button_border_hover_radius = '0';
												if ( isset( $wtl_settings['display_edd_addtocart_button_border_hover_radius'] ) ) {
													$display_edd_addtocart_button_border_hover_radius = $wtl_settings['display_edd_addtocart_button_border_hover_radius'];
												}
												?>
												<div class="input-type-number">
													<input type="number" id="display_edd_addtocart_button_border_hover_radius" name="display_edd_addtocart_button_border_hover_radius" step="1" min="0" value="<?php echo esc_attr( $display_edd_addtocart_button_border_hover_radius ); ?>" >
													<div class="input-type-number-nav">
														<div class="input-type-number-button input-type-number-up">+</div>
														<div class="input-type-number-button input-type-number-down">-</div>
													</div>
												</div>
											</div>
										</li>
										<li class="wp_timeline_edd_addtocart_button_border_hover_setting wp_timeline_edd_add_to_cart_tr">
											<?php wtl_setting_left( esc_html__( 'Hover Border', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right wp-timeline-border-cover">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select cart button hover border', 'wp-timeline-designer-pro' ); ?></span></span>
												<div class="wp-timeline-border-wrap">
													<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
														<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Left (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-border-cover">
															<div class="wp-timeline-border-content">
																<?php $wp_timeline_edd_addtocartbutton_hover_borderleft = isset( $wtl_settings['wp_timeline_edd_addtocartbutton_hover_borderleft'] ) ? $wtl_settings['wp_timeline_edd_addtocartbutton_hover_borderleft'] : '0'; ?>
																<div class="input-type-number">
																	<input type="number" id="wp_timeline_edd_addtocartbutton_hover_borderleft" name="wp_timeline_edd_addtocartbutton_hover_borderleft" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_hover_borderleft ); ?>"  >
																	<div class="input-type-number-nav">
																		<div class="input-type-number-button input-type-number-up">+</div>
																		<div class="input-type-number-button input-type-number-down">-</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="wp-timeline-border-cover wp-timeline-color-picker">
															<div class="wp-timeline-border-content">
																<?php $wp_timeline_edd_addtocartbutton_hover_borderleftcolor = isset( $wtl_settings['wp_timeline_edd_addtocartbutton_hover_borderleftcolor'] ) ? $wtl_settings['wp_timeline_edd_addtocartbutton_hover_borderleftcolor'] : ''; ?>
																<input type="text" name="wp_timeline_edd_addtocartbutton_hover_borderleftcolor" id="wp_timeline_edd_addtocartbutton_hover_borderleftcolor" value="<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_hover_borderleftcolor ); ?>"/>
															</div>
														</div>
													</div> 
													<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
														<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Right (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-border-cover">
															<div class="wp-timeline-border-content">
																<?php $wp_timeline_edd_addtocartbutton_hover_borderright = isset( $wtl_settings['wp_timeline_edd_addtocartbutton_hover_borderright'] ) ? $wtl_settings['wp_timeline_edd_addtocartbutton_hover_borderright'] : '0'; ?>
																<div class="input-type-number">
																	<input type="number" id="wp_timeline_edd_addtocartbutton_hover_borderright" name="wp_timeline_edd_addtocartbutton_hover_borderright" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_hover_borderright ); ?>" >
																	<div class="input-type-number-nav">
																		<div class="input-type-number-button input-type-number-up">+</div>
																		<div class="input-type-number-button input-type-number-down">-</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="wp-timeline-border-cover wp-timeline-color-picker">
															<div class="wp-timeline-border-content">
																<?php $wp_timeline_edd_addtocartbutton_hover_borderrightcolor = isset( $wtl_settings['wp_timeline_edd_addtocartbutton_hover_borderrightcolor'] ) ? $wtl_settings['wp_timeline_edd_addtocartbutton_hover_borderrightcolor'] : ''; ?>
																<input type="text" name="wp_timeline_edd_addtocartbutton_hover_borderrightcolor" id="wp_timeline_edd_addtocartbutton_hover_borderrightcolor" value="<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_hover_borderrightcolor ); ?>"/>
															</div>
														</div>
													</div>
													<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
														<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Top (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-border-cover">
															<div class="wp-timeline-border-content">
																<?php $wp_timeline_edd_addtocartbutton_hover_bordertop = isset( $wtl_settings['wp_timeline_edd_addtocartbutton_hover_bordertop'] ) ? $wtl_settings['wp_timeline_edd_addtocartbutton_hover_bordertop'] : '0'; ?>
																<div class="input-type-number">
																	<input type="number" id="wp_timeline_edd_addtocartbutton_hover_bordertop" name="wp_timeline_edd_addtocartbutton_hover_bordertop" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_hover_bordertop ); ?>" >
																	<div class="input-type-number-nav">
																		<div class="input-type-number-button input-type-number-up">+</div>
																		<div class="input-type-number-button input-type-number-down">-</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="wp-timeline-border-cover wp-timeline-color-picker">
															<div class="wp-timeline-border-content">
																<?php $wp_timeline_edd_addtocartbutton_hover_bordertopcolor = isset( $wtl_settings['wp_timeline_edd_addtocartbutton_hover_bordertopcolor'] ) ? $wtl_settings['wp_timeline_edd_addtocartbutton_hover_bordertopcolor'] : ''; ?>
																<input type="text" name="wp_timeline_edd_addtocartbutton_hover_bordertopcolor" id="wp_timeline_edd_addtocartbutton_hover_bordertopcolor" value="<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_hover_bordertopcolor ); ?>"/>
															</div>
														</div>
													</div>
													<div class="wp-timeline-border-wrapper wp-timeline-border-wrapper1">
														<div class="wp-timeline-border-cover wp-timeline-border-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Bottom(px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-border-cover">
															<div class="wp-timeline-border-content">
																<?php $wp_timeline_edd_addtocartbutton_hover_borderbuttom = isset( $wtl_settings['wp_timeline_edd_addtocartbutton_hover_borderbuttom'] ) ? $wtl_settings['wp_timeline_edd_addtocartbutton_hover_borderbuttom'] : '0'; ?>
																<div class="input-type-number">
																	<input type="number" id="wp_timeline_edd_addtocartbutton_hover_borderbuttom" name="wp_timeline_edd_addtocartbutton_hover_borderbuttom" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_hover_borderbuttom ); ?>" >
																	<div class="input-type-number-nav">
																		<div class="input-type-number-button input-type-number-up">+</div>
																		<div class="input-type-number-button input-type-number-down">-</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="wp-timeline-border-cover wp-timeline-color-picker">
															<div class="wp-timeline-border-content">
																<?php $wp_timeline_edd_addtocartbutton_hover_borderbottomcolor = isset( $wtl_settings['wp_timeline_edd_addtocartbutton_hover_borderbottomcolor'] ) ? $wtl_settings['wp_timeline_edd_addtocartbutton_hover_borderbottomcolor'] : ''; ?>
																<input type="text" name="wp_timeline_edd_addtocartbutton_hover_borderbottomcolor" id="wp_timeline_edd_addtocartbutton_hover_borderbottomcolor" value="<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_hover_borderbottomcolor ); ?>"/>
															</div>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li class="wp_timeline_edd_add_to_cart_tr">
											<?php wtl_setting_left( esc_html__( 'Padding', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right wp-timeline-border-cover">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Set purchase button padding', 'wp-timeline-designer-pro' ); ?></span></span>
												<div class="wp-timeline-padding-wrapper wp-timeline-padding-wrapper1 wp-timeline-border-wrap">
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Left-Right (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_edd_addtocartbutton_padding_leftright = isset( $wtl_settings['wp_timeline_edd_addtocartbutton_padding_leftright'] ) ? $wtl_settings['wp_timeline_edd_addtocartbutton_padding_leftright'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_edd_addtocartbutton_padding_leftright" name="wp_timeline_edd_addtocartbutton_padding_leftright" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_padding_leftright ); ?>" >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Top-Bottom (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_edd_addtocartbutton_padding_topbottom = isset( $wtl_settings['wp_timeline_edd_addtocartbutton_padding_topbottom'] ) ? $wtl_settings['wp_timeline_edd_addtocartbutton_padding_topbottom'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_edd_addtocartbutton_padding_topbottom" name="wp_timeline_edd_addtocartbutton_padding_topbottom" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_padding_topbottom ); ?>"  >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li class="wp_timeline_edd_add_to_cart_tr">
											<?php wtl_setting_left( esc_html__( 'Margin', 'wp-timeline-designer-pro' ) ); ?>
											<div class="wp-timeline-right wp-timeline-border-cover">
												<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-color"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Set purchase button margin', 'wp-timeline-designer-pro' ); ?></span></span>
												<div class="wp-timeline-padding-wrapper wp-timeline-padding-wrapper1 wp-timeline-border-wrap">
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Left-Right (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_edd_addtocartbutton_margin_leftright = isset( $wtl_settings['wp_timeline_edd_addtocartbutton_margin_leftright'] ) ? $wtl_settings['wp_timeline_edd_addtocartbutton_margin_leftright'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_edd_addtocartbutton_margin_leftright" name="wp_timeline_edd_addtocartbutton_margin_leftright" step="1" value="<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_margin_leftright ); ?>"  >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-timeline-padding-cover">
														<div class="wp-timeline-padding-label"><span class="wp-timeline-key-title"><?php esc_html_e( 'Top-Bottom (px)', 'wp-timeline-designer-pro' ); ?></span></div>
														<div class="wp-timeline-padding-content">
															<?php $wp_timeline_edd_addtocartbutton_margin_topbottom = isset( $wtl_settings['wp_timeline_edd_addtocartbutton_margin_topbottom'] ) ? $wtl_settings['wp_timeline_edd_addtocartbutton_margin_topbottom'] : '0'; ?>
															<div class="input-type-number">
																<input type="number" id="wp_timeline_edd_addtocartbutton_margin_topbottom" name="wp_timeline_edd_addtocartbutton_margin_topbottom" step="1" value="<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_margin_topbottom ); ?>"  >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li class="wp_timeline_edd_add_to_cart_tr edd_addtocart_button_box_shadow_setting">
											<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Box Shadow Settings', 'wp-timeline-designer-pro' ); ?></h3>
											<div class="wp-timeline-boxshadow-wrapper wp-timeline-boxshadow-wrapper1">
												<div class="wp-timeline-boxshadow-cover">
													<div class="wp-timeline-boxshadow-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'H-offset (px)', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select horizontal offset value', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-boxshadow-content">
														<?php $wp_timeline_edd_addtocart_button_top_box_shadow = isset( $wtl_settings['wp_timeline_edd_addtocart_button_top_box_shadow'] ) ? $wtl_settings['wp_timeline_edd_addtocart_button_top_box_shadow'] : '0'; ?>
														<div class="input-type-number">
															<input type="number" id="wp_timeline_edd_addtocart_button_top_box_shadow" name="wp_timeline_edd_addtocart_button_top_box_shadow" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_edd_addtocart_button_top_box_shadow ); ?>"  >
															<div class="input-type-number-nav">
																<div class="input-type-number-button input-type-number-up">+</div>
																<div class="input-type-number-button input-type-number-down">-</div>
															</div>
														</div>
													</div>
												</div>
												<div class="wp-timeline-boxshadow-cover">
													<div class="wp-timeline-boxshadow-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'V-offset (px)', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select vertical offset value', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-boxshadow-content">
														<?php $wp_timeline_edd_addtocart_button_right_box_shadow = isset( $wtl_settings['wp_timeline_edd_addtocart_button_right_box_shadow'] ) ? $wtl_settings['wp_timeline_edd_addtocart_button_right_box_shadow'] : '0'; ?>
														<div class="input-type-number">
															<input type="number" id="wp_timeline_edd_addtocart_button_right_box_shadow" name="wp_timeline_edd_addtocart_button_right_box_shadow" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_edd_addtocart_button_right_box_shadow ); ?>"  >
															<div class="input-type-number-nav">
																<div class="input-type-number-button input-type-number-up">+</div>
																<div class="input-type-number-button input-type-number-down">-</div>
															</div>
														</div>
													</div>
												</div>
												<div class="wp-timeline-boxshadow-cover">
													<div class="wp-timeline-boxshadow-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Blur (px)', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select blur value', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-boxshadow-content">
														<?php $wp_timeline_edd_addtocart_button_bottom_box_shadow = isset( $wtl_settings['wp_timeline_edd_addtocart_button_bottom_box_shadow'] ) ? $wtl_settings['wp_timeline_edd_addtocart_button_bottom_box_shadow'] : '0'; ?>
														<div class="input-type-number">
															<input type="number" id="wp_timeline_edd_addtocart_button_bottom_box_shadow" name="wp_timeline_edd_addtocart_button_bottom_box_shadow" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_edd_addtocart_button_bottom_box_shadow ); ?>"  >
															<div class="input-type-number-nav">
																<div class="input-type-number-button input-type-number-up">+</div>
																<div class="input-type-number-button input-type-number-down">-</div>
															</div>
														</div>
													</div>
												</div>
												<div class="wp-timeline-boxshadow-cover">
													<div class="wp-timeline-boxshadow-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Spread (px)', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select spread value', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-boxshadow-content">
														<?php $wp_timeline_edd_addtocart_button_left_box_shadow = isset( $wtl_settings['wp_timeline_edd_addtocart_button_left_box_shadow'] ) ? $wtl_settings['wp_timeline_edd_addtocart_button_left_box_shadow'] : '0'; ?>
														<div class="input-type-number">
															<input type="number" id="wp_timeline_edd_addtocart_button_left_box_shadow" name="wp_timeline_edd_addtocart_button_left_box_shadow" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_edd_addtocart_button_left_box_shadow ); ?>"  >
															<div class="input-type-number-nav">
																<div class="input-type-number-button input-type-number-up">+</div>
																<div class="input-type-number-button input-type-number-down">-</div>
															</div>
														</div>
													</div>
												</div>
												<div class="wp-timeline-boxshadow-cover wp-timeline-boxshadow-color">
													<div class="wp-timeline-boxshadow-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Color', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select box shadow color', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-boxshadow-content wp-timeline-color-picker">
														<?php $wp_timeline_edd_addtocart_button_box_shadow_color = isset( $wtl_settings['wp_timeline_edd_addtocart_button_box_shadow_color'] ) ? $wtl_settings['wp_timeline_edd_addtocart_button_box_shadow_color'] : ''; ?>
														<input type="text" name="wp_timeline_edd_addtocart_button_box_shadow_color" id="wp_timeline_edd_addtocart_button_box_shadow_color" value="<?php echo esc_attr( $wp_timeline_edd_addtocart_button_box_shadow_color ); ?>"/>
													</div>
												</div>
											</div>
										</li>
										<li class="wp_timeline_edd_add_to_cart_tr edd_addtocart_button_hover_box_shadow_setting">
											<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Hover Box Shadow Settings', 'wp-timeline-designer-pro' ); ?></h3>
											<div class="wp-timeline-boxshadow-wrapper wp-timeline-boxshadow-wrapper1">
												<div class="wp-timeline-boxshadow-cover">
													<div class="wp-timeline-boxshadow-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'H-offset (px)', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select horizontal offset value', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-boxshadow-content">
														<?php $wp_timeline_edd_addtocart_button_hover_top_box_shadow = isset( $wtl_settings['wp_timeline_edd_addtocart_button_hover_top_box_shadow'] ) ? $wtl_settings['wp_timeline_edd_addtocart_button_hover_top_box_shadow'] : '0'; ?>
														<div class="input-type-number">
															<input type="number" id="wp_timeline_edd_addtocart_button_hover_top_box_shadow" name="wp_timeline_edd_addtocart_button_hover_top_box_shadow" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_edd_addtocart_button_hover_top_box_shadow ); ?>"  >
															<div class="input-type-number-nav">
																<div class="input-type-number-button input-type-number-up">+</div>
																<div class="input-type-number-button input-type-number-down">-</div>
															</div>
														</div>
													</div>
												</div>
												<div class="wp-timeline-boxshadow-cover">
													<div class="wp-timeline-boxshadow-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'V-offset (px)', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select vertical offset value', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-boxshadow-content">
														<?php $wp_timeline_edd_addtocart_button_hover_right_box_shadow = isset( $wtl_settings['wp_timeline_edd_addtocart_button_hover_right_box_shadow'] ) ? $wtl_settings['wp_timeline_edd_addtocart_button_hover_right_box_shadow'] : '0'; ?>
														<div class="input-type-number">
															<input type="number" id="wp_timeline_edd_addtocart_button_hover_right_box_shadow" name="wp_timeline_edd_addtocart_button_hover_right_box_shadow" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_edd_addtocart_button_hover_right_box_shadow ); ?>"  >
															<div class="input-type-number-nav">
																<div class="input-type-number-button input-type-number-up">+</div>
																<div class="input-type-number-button input-type-number-down">-</div>
															</div>
														</div>
													</div>
												</div>
												<div class="wp-timeline-boxshadow-cover">
													<div class="wp-timeline-boxshadow-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Blur (px)', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select blur value', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-boxshadow-content">
														<?php $wp_timeline_edd_addtocart_button_hover_bottom_box_shadow = isset( $wtl_settings['wp_timeline_edd_addtocart_button_hover_bottom_box_shadow'] ) ? $wtl_settings['wp_timeline_edd_addtocart_button_hover_bottom_box_shadow'] : '0'; ?>
														<div class="input-type-number">
															<input type="number" id="wp_timeline_edd_addtocart_button_hover_bottom_box_shadow" name="wp_timeline_edd_addtocart_button_hover_bottom_box_shadow" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_edd_addtocart_button_hover_bottom_box_shadow ); ?>"  >
															<div class="input-type-number-nav">
																<div class="input-type-number-button input-type-number-up">+</div>
																<div class="input-type-number-button input-type-number-down">-</div>
															</div>
														</div>
													</div>
												</div>
												<div class="wp-timeline-boxshadow-cover">
													<div class="wp-timeline-boxshadow-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Spread (px)', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select spread value', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-boxshadow-content">
														<?php $wp_timeline_edd_addtocart_button_hover_left_box_shadow = isset( $wtl_settings['wp_timeline_edd_addtocart_button_hover_left_box_shadow'] ) ? $wtl_settings['wp_timeline_edd_addtocart_button_hover_left_box_shadow'] : '0'; ?>
														<div class="input-type-number">
															<input type="number" id="wp_timeline_edd_addtocart_button_hover_left_box_shadow" name="wp_timeline_edd_addtocart_button_hover_left_box_shadow" step="1" min="0" value="<?php echo esc_attr( $wp_timeline_edd_addtocart_button_hover_left_box_shadow ); ?>"  >
															<div class="input-type-number-nav">
																<div class="input-type-number-button input-type-number-up">+</div>
																<div class="input-type-number-button input-type-number-down">-</div>
															</div>
														</div>
													</div>
												</div>
												<div class="wp-timeline-boxshadow-cover wp-timeline-boxshadow-color">
													<div class="wp-timeline-boxshadow-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Color', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select box shadow color', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-boxshadow-content wp-timeline-color-picker">
														<?php $wp_timeline_edd_addtocart_button_hover_box_shadow_color = isset( $wtl_settings['wp_timeline_edd_addtocart_button_hover_box_shadow_color'] ) ? $wtl_settings['wp_timeline_edd_addtocart_button_hover_box_shadow_color'] : ''; ?>
														<input type="text" name="wp_timeline_edd_addtocart_button_hover_box_shadow_color" id="wp_timeline_edd_addtocart_button_hover_box_shadow_color" value="<?php echo esc_attr( $wp_timeline_edd_addtocart_button_hover_box_shadow_color ); ?>"/>
													</div>
												</div>
											</div>
										</li>
										<li class="wp_timeline_edd_add_to_cart_tr">
											<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Typography Settings', 'wp-timeline-designer-pro' ); ?></h3>
											<div class="wp-timeline-typography-wrapper wp-timeline-typography-wrapper1">
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Font Family', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select cart button font family', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content">
														<?php
														if ( isset( $wtl_settings['wp_timeline_edd_addtocart_button_fontface'] ) && '' != $wtl_settings['wp_timeline_edd_addtocart_button_fontface'] ) {
															$wp_timeline_edd_addtocart_button_fontface = $wtl_settings['wp_timeline_edd_addtocart_button_fontface'];
														} else {
															$wp_timeline_edd_addtocart_button_fontface = '';
														}
														?>
														<div class="typo-field">
															<input type="hidden" id="wp_timeline_edd_addtocart_button_fontface_font_type" name="wp_timeline_edd_addtocart_button_fontface_font_type" value="<?php echo isset( $wtl_settings['wp_timeline_edd_addtocart_button_fontface_font_type'] ) ? esc_attr( $wtl_settings['wp_timeline_edd_addtocart_button_fontface_font_type'] ) : ''; ?>">
															<div class="select-cover">
																<select name="wp_timeline_edd_addtocart_button_fontface" id="wp_timeline_edd_addtocart_button_fontface">
																	<option value=""><?php esc_html_e( 'Select Font Family', 'wp-timeline-designer-pro' ); ?></option>
																	<?php
																	$old_version = '';
																	$cnt         = 0;
																	$font_family = Wp_Timeline_Main::wtl_default_recognized_font_faces();
																	foreach ( $font_family as $key => $value ) {
																		if ( $value['version'] != $old_version ) {
																			if ( $cnt > 0 ) {
																				echo '</optgroup>';
																			}
																			echo '<optgroup label="' . esc_attr( $value['version'] ) . '">';
																			$old_version = $value['version'];
																		}
																		echo "<option value='" . esc_attr( str_replace( '"', '', $value['label'] ) ) . "'";
																		if ( '' != $wp_timeline_edd_addtocart_button_fontface && ( str_replace( '"', '', $wp_timeline_edd_addtocart_button_fontface ) == str_replace( '"', '', $value['label'] ) ) ) {
																			echo ' selected';
																		}
																		echo '>' . esc_html( $value['label'] ) . '</option>';
																		$cnt++;
																	}
																	if ( count( $font_family ) == $cnt ) {
																		echo '</optgroup>';
																	}
																	?>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Font Size (px)', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select purchase button font size', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content">
														<?php
														if ( isset( $wtl_settings['wp_timeline_edd_addtocart_button_fontsize'] ) && '' != $wtl_settings['wp_timeline_edd_addtocart_button_fontsize'] ) {
															$wp_timeline_edd_addtocart_button_fontsize = $wtl_settings['wp_timeline_edd_addtocart_button_fontsize'];
														} else {
															$wp_timeline_edd_addtocart_button_fontsize = 14;
														}
														?>
														<div class="grid_col_space range_slider_fontsize" id="wp_timeline_edd_addtocart_button_fontsizeInput" ></div>
														<div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="wp_timeline_edd_addtocart_button_fontsize" id="wp_timeline_edd_addtocart_button_fontsize" value="<?php echo esc_attr( $wp_timeline_edd_addtocart_button_fontsize ); ?>"  /></div>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Font Weight', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select purchase button font weight', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content">
														<?php $wp_timeline_edd_addtocart_button_font_weight = isset( $wtl_settings['wp_timeline_edd_addtocart_button_font_weight'] ) ? $wtl_settings['wp_timeline_edd_addtocart_button_font_weight'] : 'normal'; ?>
														<div class="select-cover">
															<select name="wp_timeline_edd_addtocart_button_font_weight" id="wp_timeline_edd_addtocart_button_font_weight">
																<option value="100" <?php selected( $wp_timeline_edd_addtocart_button_font_weight, 100 ); ?>>100</option>
																<option value="200" <?php selected( $wp_timeline_edd_addtocart_button_font_weight, 200 ); ?>>200</option>
																<option value="300" <?php selected( $wp_timeline_edd_addtocart_button_font_weight, 300 ); ?>>300</option>
																<option value="400" <?php selected( $wp_timeline_edd_addtocart_button_font_weight, 400 ); ?>>400</option>
																<option value="500" <?php selected( $wp_timeline_edd_addtocart_button_font_weight, 500 ); ?>>500</option>
																<option value="600" <?php selected( $wp_timeline_edd_addtocart_button_font_weight, 600 ); ?>>600</option>
																<option value="700" <?php selected( $wp_timeline_edd_addtocart_button_font_weight, 700 ); ?>>700</option>
																<option value="800" <?php selected( $wp_timeline_edd_addtocart_button_font_weight, 800 ); ?>>800</option>
																<option value="900" <?php selected( $wp_timeline_edd_addtocart_button_font_weight, 900 ); ?>>900</option>
																<option value="bold" <?php selected( $wp_timeline_edd_addtocart_button_font_weight, 'bold' ); ?> ><?php esc_html_e( 'Bold', 'wp-timeline-designer-pro' ); ?></option>
																<option value="normal" <?php selected( $wp_timeline_edd_addtocart_button_font_weight, 'normal' ); ?>><?php esc_html_e( 'Normal', 'wp-timeline-designer-pro' ); ?></option>
															</select>
														</div>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Line Height', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select purchase button line height', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content">
														<div class="input-type-number">
															<?php
															$display_edd_addtocart_button_line_height = '1.5';
															if ( isset( $wtl_settings['display_edd_addtocart_button_line_height'] ) ) {
																$display_edd_addtocart_button_line_height = $wtl_settings['display_edd_addtocart_button_line_height'];
															}
															?>
															<div class="input-type-number">
																<input type="number" id="display_edd_addtocart_button_line_height" name="display_edd_addtocart_button_line_height" step="1" min="1.5" value="<?php echo esc_attr( $display_edd_addtocart_button_line_height ); ?>" placeholder="<?php esc_attr_e( 'Enter line height', 'wp-timeline-designer-pro' ); ?>" >
																<div class="input-type-number-nav">
																	<div class="input-type-number-button input-type-number-up">+</div>
																	<div class="input-type-number-button input-type-number-down">-</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Italic Font Style', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Display purchase button italic font style', 'wp-timeline-designer-pro' ); ?></span></span><?php $wp_timeline_edd_addtocart_button_font_italic = isset( $wtl_settings['wp_timeline_edd_addtocart_button_font_italic'] ) ? $wtl_settings['wp_timeline_edd_addtocart_button_font_italic'] : '0'; ?>
													</div>
													<div class="wp-timeline-typography-content">
														<fieldset class="wp-timeline-social-options wp-timeline-display_author buttonset ui-buttonset">
															<input id="wp_timeline_edd_addtocart_button_font_italic_1" name="wp_timeline_edd_addtocart_button_font_italic" type="radio" value="1"  <?php checked( 1, $wp_timeline_edd_addtocart_button_font_italic ); ?> />
															<label for="wp_timeline_edd_addtocart_button_font_italic_1" class="<?php echo esc_html( $uic_l ); ?>"><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
															<input id="wp_timeline_edd_addtocart_button_font_italic_0" name="wp_timeline_edd_addtocart_button_font_italic" type="radio" value="0" <?php checked( 0, $wp_timeline_edd_addtocart_button_font_italic ); ?> />
															<label for="wp_timeline_edd_addtocart_button_font_italic_0" class="<?php echo esc_html( $uic_r ); ?>"><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
														</fieldset>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Text Transform', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select purchase button text transform style', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content">
														<?php $wp_timeline_edd_addtocart_button_font_text_transform = isset( $wtl_settings['wp_timeline_edd_addtocart_button_font_text_transform'] ) ? $wtl_settings['wp_timeline_edd_addtocart_button_font_text_transform'] : 'none'; ?>
														<div class="select-cover">
															<select name="wp_timeline_edd_addtocart_button_font_text_transform" id="wp_timeline_edd_addtocart_button_font_text_transform">
																<option <?php selected( $wp_timeline_edd_addtocart_button_font_text_transform, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'wp-timeline-designer-pro' ); ?></option>
																<option <?php selected( $wp_timeline_edd_addtocart_button_font_text_transform, 'capitalize' ); ?> value="capitalize"><?php esc_html_e( 'Capitalize', 'wp-timeline-designer-pro' ); ?></option>
																<option <?php selected( $wp_timeline_edd_addtocart_button_font_text_transform, 'uppercase' ); ?> value="uppercase"><?php esc_html_e( 'Uppercase', 'wp-timeline-designer-pro' ); ?></option>
																<option <?php selected( $wp_timeline_edd_addtocart_button_font_text_transform, 'lowercase' ); ?> value="lowercase"><?php esc_html_e( 'Lowercase', 'wp-timeline-designer-pro' ); ?></option>
																<option <?php selected( $wp_timeline_edd_addtocart_button_font_text_transform, 'full-width' ); ?> value="full-width"><?php esc_html_e( 'Full Width', 'wp-timeline-designer-pro' ); ?></option>
															</select>
														</div>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Text Decoration', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select purchase button text decoration style', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content">
														<?php $wp_timeline_edd_addtocart_button_font_text_decoration = isset( $wtl_settings['wp_timeline_edd_addtocart_button_font_text_decoration'] ) ? $wtl_settings['wp_timeline_edd_addtocart_button_font_text_decoration'] : 'none'; ?>
														<div class="select-cover">
															<select name="wp_timeline_edd_addtocart_button_font_text_decoration" id="wp_timeline_edd_addtocart_button_font_text_decoration">
																<option <?php selected( $wp_timeline_edd_addtocart_button_font_text_decoration, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'wp-timeline-designer-pro' ); ?></option>
																<option <?php selected( $wp_timeline_edd_addtocart_button_font_text_decoration, 'underline' ); ?> value="underline"><?php esc_html_e( 'Underline', 'wp-timeline-designer-pro' ); ?></option>
																<option <?php selected( $wp_timeline_edd_addtocart_button_font_text_decoration, 'overline' ); ?> value="overline"><?php esc_html_e( 'Overline', 'wp-timeline-designer-pro' ); ?></option>
																<option <?php selected( $wp_timeline_edd_addtocart_button_font_text_decoration, 'line-through' ); ?> value="line-through"><?php esc_html_e( 'Line Through', 'wp-timeline-designer-pro' ); ?></option>
															</select>
														</div>
													</div>
												</div>
												<div class="wp-timeline-typography-cover">
													<div class="wp-timeline-typography-label">
														<span class="wp-timeline-key-title"><?php esc_html_e( 'Letter Spacing (px)', 'wp-timeline-designer-pro' ); ?></span>
														<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enter purchase button letter spacing', 'wp-timeline-designer-pro' ); ?></span></span>
													</div>
													<div class="wp-timeline-typography-content">
														<div class="input-type-number"><input type="number" name="wp_timeline_edd_addtocart_button_letter_spacing" id="wp_timeline_edd_addtocart_button_letter_spacing" step="1" min="0" value="<?php echo isset( $wtl_settings['wp_timeline_edd_addtocart_button_letter_spacing'] ) ? esc_attr( $wtl_settings['wp_timeline_edd_addtocart_button_letter_spacing'] ) : '0'; ?>" >
														<div class="input-type-number-nav">
															<div class="input-type-number-button input-type-number-up">+</div>
															<div class="input-type-number-button input-type-number-down">-</div>
														</div></div>
													</div>
												</div>
											</div>
										</li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
					<?php
				}
				?>
				<?php if ( is_plugin_active( 'advanced-custom-fields/acf.php' ) ) { ?>
				<div id="wp_timeline_acffieldssetting" class="postbox postbox-with-fw-options" <?php echo esc_attr( $wp_timeline_acffieldssetting_class_show ); ?>>
					<div class="inside">
						<ul class="wp-timeline-settings wp-timeline-lineheight">
							<li>
								<?php wtl_setting_left( esc_html__( 'Display Acf Field', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Show ACF field', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php
									$display_acf_field = '0';
									if ( isset( $wtl_settings['display_acf_field'] ) ) {
										$display_acf_field = $wtl_settings['display_acf_field'];
									}
									?>
									<fieldset class="wp-timeline-social-style buttonset ui-buttonset buttonset-hide" data-hide='1'>
										<input id="display_acf_field_1" name="display_acf_field" type="radio" value="1" <?php checked( 1, $display_acf_field ); ?> />
										<label id="wp-timeline-options-button" for="display_acf_field_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $display_acf_field ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
										<input id="display_acf_field_0" name="display_acf_field" type="radio" value="0" <?php checked( 0, $display_acf_field ); ?> />
										<label id="wp-timeline-options-button" for="display_acf_field_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 1, $display_acf_field ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="wp_timeline_setting_acf_field">
								<?php
								$custom_post_type = isset( $wtl_settings['custom_post_type'] ) ? $wtl_settings['custom_post_type'] : 'post';
								$post_ids         = get_posts(
									array(
										'fields'         => 'ids',
										'posts_per_page' => -1,
									)
								);
								$groups           = acf_get_field_groups(
									array(
										'post_id'   => $post_ids,
										'post_type' => $custom_post_type,
									)
								);
								if ( ! empty( $groups ) ) {
									wtl_setting_left( esc_html__( 'Select ACF Field', 'wp-timeline-designer-pro' ) );
									?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-select"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Filter post via category', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $wp_timeline_acf_field = isset( $wtl_settings['wp_timeline_acf_field'] ) ? $wtl_settings['wp_timeline_acf_field'] : array(); ?>
									<select data-placeholder="<?php esc_attr_e( 'Choose acf field', 'wp-timeline-designer-pro' ); ?>" class="chosen-select" multiple style="width:220px;" name="wp_timeline_acf_field[]" id="wp_timeline_acf_field">
										<?php
										foreach ( $groups as $group ) {
											$group_id                                 = $group['ID'];
											$group_title                              = $group['title'];
											$all_acf_data[ $group_id ]                = array();
											$all_acf_data[ $group_id ]['group_id']    = $group_id;
											$all_acf_data[ $group_id ]['group_title'] = $group_title;
											$fields                                   = acf_get_fields( $group_id );
											if ( $fields ) {
												$all_acf_data[ $group_id ]['fields'] = array();
												$val_fields                          = 0;
												foreach ( $fields as $field ) {
													$field_id    = $field['ID'];
													$field_label = $field['label'];
													$field_key   = $field['key'];
													?>
													<option value="<?php echo esc_attr( $field_id ); ?>" 
														<?php
														if ( in_array( $field_id, $wp_timeline_acf_field, true ) ) {
															echo 'selected="selected"';
														}
														?>
													><?php echo esc_html( $field_label ); ?></option>
													<?php
												}
											}
										}
										?>
									</select>
								</div>
								<?php } ?>
							</li>
						</ul>
					</div>
				</div>
				<?php } ?>
				<div id="wp_timeline_social" class="postbox postbox-with-fw-options" style='<?php echo esc_attr( $wp_timeline_social_class_show ); ?>'>
					<div class="inside">
						<ul class="wp-timeline-settings wp-timeline-lineheight">
							<li>
								<?php wtl_setting_left( esc_html__( 'Social Share', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable social share link', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $social_share = isset( $wtl_settings['social_share'] ) ? $wtl_settings['social_share'] : 1; ?>
									<fieldset class="wp-timeline-social-options buttonset ui-buttonset buttonset-hide" data-hide='1'>
										<input id="social_share_1" name="social_share" type="radio" value="1" <?php checked( 1, $social_share ); ?> />
										<label id="" for="social_share_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $social_share ); ?>><?php esc_html_e( 'Enable', 'wp-timeline-designer-pro' ); ?></label>
										<input id="social_share_0" name="social_share" type="radio" value="0" <?php checked( 0, $social_share ); ?> />
										<label id="" for="social_share_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $social_share ); ?>> <?php esc_html_e( 'Disable', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class ="social_share_options">
								<?php wtl_setting_left( esc_html__( 'Social Share Style', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select social share style', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php
									$social_style = '1';
									if ( isset( $wtl_settings['social_style'] ) ) {
										$social_style = $wtl_settings['social_style'];
									}
									?>
									<fieldset class="wp-timeline-social-style buttonset ui-buttonset buttonset-hide green" data-hide='1'>
										<input id="social_style_0" name="social_style" type="radio" value="0" <?php checked( 0, $social_style ); ?> />
										<label id="wp-timeline-options-button" for="social_style_0" <?php checked( 0, $social_style ); ?>><?php esc_html_e( 'Default', 'wp-timeline-designer-pro' ); ?></label>
										<input id="social_style_1" name="social_style" type="radio" value="1" <?php checked( 1, $social_style ); ?> />
										<label id="wp-timeline-options-button" for="social_style_1" <?php checked( 1, $social_style ); ?>><?php esc_html_e( 'Custom', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class ="social_share_options shape_social_icon">
								<?php wtl_setting_left( esc_html__( 'Shape of Social Icon', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select shape of social icon', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $social_icon_style = isset( $wtl_settings['social_icon_style'] ) ? $wtl_settings['social_icon_style'] : 1; ?>
									<fieldset class="wp-timeline-social-shape buttonset ui-buttonset buttonset-hide green" data-hide='1'>
										<input id="social_icon_style_0" name="social_icon_style" type="radio" value="0" nhp-opts-button-hide-below <?php checked( 0, $social_icon_style ); ?> />
										<label id="wp-timeline-options-button" for="social_icon_style_0" <?php checked( 0, $social_icon_style ); ?>><?php esc_html_e( 'Circle', 'wp-timeline-designer-pro' ); ?></label>
										<input id="social_icon_style_1" name="social_icon_style" type="radio" value="1" nhp-opts-button-hide-below <?php checked( 1, $social_icon_style ); ?> />
										<label id="wp-timeline-options-button" for="social_icon_style_1" <?php checked( 1, $social_icon_style ); ?>><?php esc_html_e( 'Square', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class ="social_share_options size_social_icon">
								<?php wtl_setting_left( esc_html__( 'Size of Social Icon', 'wp-timeline-designer-pro' ) ); ?>                               
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select size of social icon', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $social_icon_size = isset( $wtl_settings['social_icon_size'] ) ? $wtl_settings['social_icon_size'] : '0'; ?>
									<fieldset class="wp-timeline-social-size buttonset ui-buttonset buttonset-hide green wp-timeline-social-icon-size" data-hide='1'>
										<input id="social_icon_size_2" name="social_icon_size" type="radio" value="2" <?php checked( 2, $social_icon_size ); ?> />
										<label id="wp-timeline-options-button" for="social_icon_size_2" <?php checked( 2, $social_icon_size ); ?>><?php esc_html_e( 'Extra Small', 'wp-timeline-designer-pro' ); ?></label>
										<input id="social_icon_size_1" name="social_icon_size" type="radio" value="1" <?php checked( 1, $social_icon_size ); ?> />
										<label id="wp-timeline-options-button" for="social_icon_size_1" <?php checked( 1, $social_icon_size ); ?>><?php esc_html_e( 'Small', 'wp-timeline-designer-pro' ); ?></label>
										<input id="social_icon_size_0" name="social_icon_size" type="radio" value="0" <?php checked( 0, $social_icon_size ); ?> />
										<label id="wp-timeline-options-button" for="social_icon_size_0" <?php checked( 0, $social_icon_size ); ?>><?php esc_html_e( 'Large', 'wp-timeline-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class ="social_share_options default_icon_layouts">
								<?php wtl_setting_left( esc_html__( 'Available Icon Themes', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-social"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select icon theme from available icon theme', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php
									$default_icon_theme = 1;
									if ( isset( $wtl_settings['default_icon_theme'] ) ) {
										$default_icon_theme = $wtl_settings['default_icon_theme'];
									}
									?>
									<div class="social-share-theme">
										<?php
										for ( $i = 1; $i <= 10; $i++ ) {
											?>
											<div class="social-cover social_share_theme_<?php echo esc_attr( $i ); ?>">
												<label>
													<input type="radio" id="default_icon_theme_<?php echo esc_attr( $i ); ?>" value="<?php echo esc_attr( $i ); ?>" name="default_icon_theme" <?php checked( $i, $default_icon_theme ); ?> />
													<span class="wp-timeline-social-icons facebook-icon wp_timeline_theme_wrapper"></span>
													<span class="wp-timeline-social-icons twitter-icon wp_timeline_theme_wrapper"></span>
													<span class="wp-timeline-social-icons linkdin-icon wp_timeline_theme_wrapper"></span>
													<span class="wp-timeline-social-icons pin-icon wp_timeline_theme_wrapper"></span>
													<span class="wp-timeline-social-icons whatsup-icon wp_timeline_theme_wrapper"></span>
													<span class="wp-timeline-social-icons telegram-icon wp_timeline_theme_wrapper"></span>
													<span class="wp-timeline-social-icons pocket-icon wp_timeline_theme_wrapper"></span>
													<span class="wp-timeline-social-icons mail-icon wp_timeline_theme_wrapper"></span>
													<span class="wp-timeline-social-icons reddit-icon wp_timeline_theme_wrapper"></span>
													<span class="wp-timeline-social-icons digg-icon wp_timeline_theme_wrapper"></span>
													<span class="wp-timeline-social-icons tumblr-icon wp_timeline_theme_wrapper"></span>
													<span class="wp-timeline-social-icons skype-icon wp_timeline_theme_wrapper"></span>
													<span class="wp-timeline-social-icons wordpress-icon wp_timeline_theme_wrapper"></span>
												</label>
											</div>
											<?php
										}
										?>
									</div>
								</div>
							</li>
							<li class ="social_share_options wp-timeline-display-settings wp-timeline-social-share-options">
								<h3 class="wp-timeline-table-title"><?php esc_html_e( 'Social Share Links Settings', 'wp-timeline-designer-pro' ); ?></h3>
								<div class="wp-timeline-typography-wrapper">
									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Facebook Share Link', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable facebook share link', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php $facebook_link = isset( $wtl_settings['facebook_link'] ) ? $wtl_settings['facebook_link'] : 1; ?>
											<fieldset class="wp-timeline-social-options wp-timeline-facebook_link buttonset ui-buttonset buttonset-hide" data-hide='1'>
												<input id="facebook_link_1" name="facebook_link" type="radio" value="1" <?php checked( 1, $facebook_link ); ?> />
												<label id=""for="facebook_link_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $facebook_link ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
												<input id="facebook_link_0" name="facebook_link" type="radio" value="0" <?php checked( 0, $facebook_link ); ?> />
												<label id="" for="facebook_link_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $facebook_link ); ?>> <?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
											</fieldset>
											<label class="social_link_with_count">
												<input id="facebook_link_with_count" name="facebook_link_with_count" type="checkbox" value="1" 
												<?php
												if ( isset( $wtl_settings['facebook_link_with_count'] ) ) {
													checked( 1, $wtl_settings['facebook_link_with_count'] );
												}
												?>
												/><?php esc_html_e( 'Hide Facebook Share Count', 'wp-timeline-designer-pro' ); ?>
											</label>
										</div>
									</div>
									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Twitter Share Link', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable twitter share link', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php $twitter_link = isset( $wtl_settings['twitter_link'] ) ? $wtl_settings['twitter_link'] : 1; ?>
											<fieldset class="wp-timeline-social-options wp-timeline-twitter_link buttonset ui-buttonset buttonset-hide" data-hide='1'>
												<input id="twitter_link_1" name="twitter_link" type="radio" value="1" <?php checked( 1, $twitter_link ); ?> />
												<label for="twitter_link_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $twitter_link ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
												<input id="twitter_link_0" name="twitter_link" type="radio" value="0" <?php checked( 0, $twitter_link ); ?> />
												<label for="twitter_link_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $twitter_link ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>
									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Linkedin Share Link', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable linkedin share link', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php $linkedin_link = isset( $wtl_settings['linkedin_link'] ) ? $wtl_settings['linkedin_link'] : 1; ?>
											<fieldset class="wp-timeline-social-options wp-timeline-linkedin_link buttonset ui-buttonset buttonset-hide" data-hide='1'>
												<input id="linkedin_link_1" name="linkedin_link" type="radio" value="1" <?php checked( 1, $linkedin_link ); ?> />
												<label for="linkedin_link_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $linkedin_link ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
												<input id="linkedin_link_0" name="linkedin_link" type="radio" value="0" <?php checked( 0, $linkedin_link ); ?> />
												<label for="linkedin_link_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $linkedin_link ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>
									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Pinterest Share link', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable pinterest share link', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php $pinterest_link = isset( $wtl_settings['pinterest_link'] ) ? $wtl_settings['pinterest_link'] : 1; ?>
											<fieldset class="wp-timeline-social-options wp-timeline-linkedin_link buttonset ui-buttonset buttonset-hide" data-hide='1'>
												<input id="pinterest_link_1" name="pinterest_link" type="radio" value="1" <?php checked( 1, $pinterest_link ); ?> />
												<label for="pinterest_link_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $pinterest_link ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
												<input id="pinterest_link_0" name="pinterest_link" type="radio" value="0" <?php checked( 0, $pinterest_link ); ?> />
												<label for="pinterest_link_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $pinterest_link ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
											</fieldset>
											<label class="social_link_with_count">
												<input id="pinterest_link_with_count" name="pinterest_link_with_count" type="checkbox" value="1" 
												<?php
												if ( isset( $wtl_settings['pinterest_link_with_count'] ) ) {
													checked( 1, $wtl_settings['pinterest_link_with_count'] );
												}
												?>
												/>
												<?php esc_html_e( 'Hide Pinterest Share Count', 'wp-timeline-designer-pro' ); ?>
											</label>
										</div>
									</div>
									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Show Pinterest on Featured Image', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable pinterest share button on feature image', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php $pinterest_image_share = isset( $wtl_settings['pinterest_image_share'] ) ? $wtl_settings['pinterest_image_share'] : 1; ?>
											<fieldset class="wp-timeline-social-options wp-timeline-linkedin_link buttonset ui-buttonset buttonset-hide" data-hide='1'>
												<input id="pinterest_image_share_1" name="pinterest_image_share" type="radio" value="1" <?php checked( 1, $pinterest_image_share ); ?> />
												<label for="pinterest_image_share_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $pinterest_image_share ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
												<input id="pinterest_image_share_0" name="pinterest_image_share" type="radio" value="0" <?php checked( 0, $pinterest_image_share ); ?> />
												<label for="pinterest_image_share_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $pinterest_image_share ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>
									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Skype Share Link', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable skype share link', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php $skype_link = isset( $wtl_settings['skype_link'] ) ? $wtl_settings['skype_link'] : '0'; ?>
											<fieldset class="wp-timeline-social-options wp-timeline-twitter_link buttonset ui-buttonset buttonset-hide" data-hide='1'>
												<input id="skype_link_1" name="skype_link" type="radio" value="1" <?php checked( 1, $skype_link ); ?> />
												<label for="skype_link_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $skype_link ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
												<input id="skype_link_0" name="skype_link" type="radio" value="0" <?php checked( 0, $skype_link ); ?> />
												<label for="skype_link_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $skype_link ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>
									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Pocket Share Link', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable pocket share link', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<?php $pocket_link = isset( $wtl_settings['pocket_link'] ) ? $wtl_settings['pocket_link'] : '0'; ?>
										<div class="wp-timeline-typography-content">
											<fieldset class="wp-timeline-social-options wp-timeline-pocket_link buttonset ui-buttonset buttonset-hide" data-hide='1'>
												<input id="pocket_link_1" name="pocket_link" type="radio" value="1" <?php checked( 1, $pocket_link ); ?> />
												<label for="pocket_link_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $pocket_link ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
												<input id="pocket_link_0" name="pocket_link" type="radio" value="0" <?php checked( 0, $pocket_link ); ?> />
												<label for="pocket_link_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $pocket_link ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>
									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Telegram Share Link', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable telegram share link', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<?php $telegram_link = isset( $wtl_settings['telegram_link'] ) ? $wtl_settings['telegram_link'] : '0'; ?>
										<div class="wp-timeline-typography-content">
											<fieldset class="wp-timeline-social-options wp-timeline-telegram_link buttonset ui-buttonset buttonset-hide" data-hide='1'>
												<input id="telegram_link_1" name="telegram_link" type="radio" value="1" <?php checked( 1, $telegram_link ); ?> />
												<label for="telegram_link_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $telegram_link ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
												<input id="telegram_link_0" name="telegram_link" type="radio" value="0" <?php checked( 0, $telegram_link ); ?> />
												<label for="telegram_link_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $telegram_link ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>
									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Reddit Share Link', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable reddit share link', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<?php $reddit_link = isset( $wtl_settings['reddit_link'] ) ? $wtl_settings['reddit_link'] : '0'; ?>
										<div class="wp-timeline-typography-content">
											<fieldset class="wp-timeline-social-options wp-timeline-reddit_link buttonset ui-buttonset buttonset-hide" data-hide='1'>
												<input id="reddit_link_1" name="reddit_link" type="radio" value="1" <?php checked( 1, $reddit_link ); ?> />
												<label for="reddit_link_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $reddit_link ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
												<input id="reddit_link_0" name="reddit_link" type="radio" value="0" <?php checked( 0, $reddit_link ); ?> />
												<label for="reddit_link_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $reddit_link ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>
									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Digg Share Link', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable digg share link', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<?php $digg_link = isset( $wtl_settings['digg_link'] ) ? $wtl_settings['digg_link'] : '0'; ?>
										<div class="wp-timeline-typography-content">
											<fieldset class="wp-timeline-social-options wp-timeline-reddit_link buttonset ui-buttonset buttonset-hide" data-hide='1'>
												<input id="digg_link_1" name="digg_link" type="radio" value="1" <?php checked( 1, $digg_link ); ?> />
												<label for="digg_link_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $digg_link ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
												<input id="digg_link_0" name="digg_link" type="radio" value="0" <?php checked( 0, $digg_link ); ?> />
												<label for="digg_link_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $digg_link ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>
									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Tumblr Share Link', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable tumblr share link', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<?php $tumblr_link = isset( $wtl_settings['tumblr_link'] ) ? $wtl_settings['tumblr_link'] : '0'; ?>
										<div class="wp-timeline-typography-content">
											<fieldset class="wp-timeline-social-options wp-timeline-tumblr_link buttonset ui-buttonset buttonset-hide" data-hide='1'>
												<input id="tumblr_link_1" name="tumblr_link" type="radio" value="1" <?php checked( 1, $tumblr_link ); ?> />
												<label for="tumblr_link_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $tumblr_link ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
												<input id="tumblr_link_0" name="tumblr_link" type="radio" value="0" <?php checked( 0, $tumblr_link ); ?> />
												<label for="tumblr_link_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $tumblr_link ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>
									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'WordPress Share Link', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable WordPress share link', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<?php $wordpress_link = isset( $wtl_settings['wordpress_link'] ) ? $wtl_settings['wordpress_link'] : '0'; ?>
										<div class="wp-timeline-typography-content">
											<fieldset class="wp-timeline-social-options wp-timeline-wordpress_link buttonset ui-buttonset buttonset-hide" data-hide='1'>
												<input id="wordpress_link_1" name="wordpress_link" type="radio" value="1" <?php checked( 1, $wordpress_link ); ?> />
												<label for="wordpress_link_1" class="<?php echo esc_html( $uic_l ); ?>" <?php checked( 1, $wordpress_link ); ?>><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
												<input id="wordpress_link_0" name="wordpress_link" type="radio" value="0" <?php checked( 0, $wordpress_link ); ?> />
												<label for="wordpress_link_0" class="<?php echo esc_html( $uic_r ); ?>" <?php checked( 0, $wordpress_link ); ?>><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>
									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'Share via Mail', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable mail share link', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php $email_link = isset( $wtl_settings['email_link'] ) ? $wtl_settings['email_link'] : 0; ?>
											<fieldset class="wp-timeline-social-options wp-timeline-linkedin_link buttonset ui-buttonset">
												<input id="email_link_1" class="wp-timeline-opts-button" name="email_link" type="radio" value="1" <?php checked( 1, $email_link ); ?> />
												<label id="wp-timeline-opts-button" for="email_link_1" class="<?php echo esc_html( $uic_l ); ?>"><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>												
												<input id="email_link_0" class="wp-timeline-opts-button" name="email_link" type="radio" value="0" <?php checked( 0, $email_link ); ?> />
												<label id="wp-timeline-opts-button" for="email_link_0" class="<?php echo esc_html( $uic_r ); ?>"><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>
									<div class="wp-timeline-typography-cover">
										<div class="wp-timeline-typography-label">
											<span class="wp-timeline-key-title"><?php esc_html_e( 'WhatsApp Share Link', 'wp-timeline-designer-pro' ); ?></span>
											<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Enable/Disable whatsapp share link', 'wp-timeline-designer-pro' ); ?></span></span>
										</div>
										<div class="wp-timeline-typography-content">
											<?php $whatsapp_link = isset( $wtl_settings['whatsapp_link'] ) ? $wtl_settings['whatsapp_link'] : '0'; ?>
											<fieldset class="wp-timeline-social-options wp-timeline-whatsapp_link buttonset ui-buttonset">
												<input id="whatsapp_link_1" class="wp-timeline-opts-button" name="whatsapp_link" type="radio" value="1" <?php checked( 1, $whatsapp_link ); ?> />
												<label id="wp-timeline-opts-button" for="whatsapp_link_1" class="<?php echo esc_html( $uic_l ); ?>"><?php esc_html_e( 'Yes', 'wp-timeline-designer-pro' ); ?></label>
												<input id="whatsapp_link_0" class="wp-timeline-opts-button" name="whatsapp_link" type="radio" value="0" <?php checked( 0, $whatsapp_link ); ?> />
												<label id="wp-timeline-opts-button" for="whatsapp_link_0" class="<?php echo esc_html( $uic_r ); ?>"><?php esc_html_e( 'No', 'wp-timeline-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>
								</div>
							</li>
							<li class="social_share_options fb_access_token_div">
								<?php wtl_setting_left( esc_html__( 'Facebook Access Token', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Facebook access token', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php
									$facebook_token = '';
									if ( isset( $wtl_settings['facebook_token'] ) ) {
										$facebook_token = $wtl_settings['facebook_token'];
									}
									?>
									<input type="text" name="facebook_token" id="facebook_token" value="<?php echo esc_attr( $facebook_token ); ?>" >
								</div>
							</li>
							<li class ="social_share_options mail_share_content">
								<?php wtl_setting_left( esc_html__( 'Mail Share Content', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right">
									<span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Mail share content', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php $mail_subject = ( isset( $wtl_settings['mail_subject'] ) && '' != $wtl_settings['mail_subject'] ) ? $wtl_settings['mail_subject'] : '[post_title]'; ?>
									<input type="text" name="mail_subject" id="mail_subject" value="<?php echo esc_attr( $mail_subject ); ?>" placeholder="<?php esc_attr_e( 'Enter Mail Subject', 'wp-timeline-designer-pro' ); ?>">
									<?php
									$settings = array(
										'wpautop'       => true,
										'media_buttons' => true,
										'textarea_name' => 'mail_content',
										'textarea_rows' => 10,
										'tabindex'      => '',
										'editor_css'    => '',
										'editor_class'  => '',
										'teeny'         => false,
										'dfw'           => false,
										'tinymce'       => true,
										'quicktags'     => true,
									);
									if ( isset( $wtl_settings['mail_content'] ) && '' != $wtl_settings['mail_content'] ) {
										$contents = $wtl_settings['mail_content'];
									} else {
										$contents = esc_html__( 'My Dear friends, ', 'wp-timeline-designer-pro' ) . '<br/><br/>' . esc_html__( 'I read one good blog link and I would like to share that same link for you. That might useful for you', 'wp-timeline-designer-pro' ) . '<br/><br/>[post_link]<br/><br/>' . esc_html__( 'Best Regards', 'wp-timeline-designer-pro' ) . ',<br/>' . esc_html__( 'WP Timeline Designer PRO', 'wp-timeline-designer-pro' );
									}
									wp_editor( html_entity_decode( $contents ), 'mail_content', $settings );
									?>
									<div class="div-pre">
										<p> [post_title] => <?php esc_html_e( 'Post Title', 'wp-timeline-designer-pro' ); ?> </p>
										<p> [post_link] => <?php esc_html_e( 'Post Link', 'wp-timeline-designer-pro' ); ?> </p>
										<p> [post_thumbnail] => <?php esc_html_e( 'Post Featured Image', 'wp-timeline-designer-pro' ); ?> </p>
										<p> [sender_name] => <?php esc_html_e( 'Mail Sender Name', 'wp-timeline-designer-pro' ); ?> </p>
										<p> [sender_email] => <?php esc_html_e( 'Mail Sender Email Address', 'wp-timeline-designer-pro' ); ?> </p>
									</div>
								</div>
							</li>

							<li class ="social_share_options">
								<?php wtl_setting_left( esc_html__( 'Social Share Count Position', 'wp-timeline-designer-pro' ) ); ?>

								<div class="wp-timeline-right"><span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select social share count position', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php
									$social_count_position = 'bottom';
									if ( isset( $wtl_settings['social_count_position'] ) ) {
										$social_count_position = $wtl_settings['social_count_position'];
									}
									?>
									<div class="typo-field">
										<select name="social_count_position" id="social_sharecount">
											<option value="bottom" <?php echo selected( 'bottom', $social_count_position ); ?>><?php esc_html_e( 'Bottom', 'wp-timeline-designer-pro' ); ?></option>
											<option value="right" <?php echo selected( 'right', $social_count_position ); ?>><?php esc_html_e( 'Right', 'wp-timeline-designer-pro' ); ?></option>
											<option value="top" <?php echo selected( 'top', $social_count_position ); ?>><?php esc_html_e( 'Top', 'wp-timeline-designer-pro' ); ?></option>
										</select>
									</div>
								</div>
							</li>
							<li class="social_share_options social_share_position_option">
								<?php wtl_setting_left( esc_html__( 'Social Share Position', 'wp-timeline-designer-pro' ) ); ?>
								<div class="wp-timeline-right"><span class="fas fa-question-circle wp-timeline-tooltips-icon"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select social share position', 'wp-timeline-designer-pro' ); ?></span></span>
									<?php
									$social_share_position = 'left';
									if ( isset( $wtl_settings['social_share_position'] ) ) {
										$social_share_position = $wtl_settings['social_share_position'];
									}
									?>
									<div class="typo-field">
										<select name="social_share_position" id="social_share_position">
											<option value="left" <?php echo selected( 'left', $social_share_position ); ?>><?php esc_html_e( 'Left', 'wp-timeline-designer-pro' ); ?></option>
											<option value="center" <?php echo selected( 'center', $social_share_position ); ?>><?php esc_html_e( 'Center', 'wp-timeline-designer-pro' ); ?></option>
											<option value="right" <?php echo selected( 'right', $social_share_position ); ?>><?php esc_html_e( 'Right', 'wp-timeline-designer-pro' ); ?></option>
										</select>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<?php do_action( 'wtl_layout_settings', 'tab_content' ); ?>
			</div>
		</div>
	</form>
	<div id="popupdiv" class="wp-timeline-template-popupdiv" style="display: none;">
		<?php
		foreach ( $tempate_list as $key => $value ) {
			$classes = explode( ' ', $value['class'] );
			foreach ( $classes as $class ) {
				$all_class[] = $class;
			}
		}
		$count = array_count_values( $all_class );
		?>
		<ul class="wp_timeline_template_tab">
			<div class="wp-timeline-blog-template-search-cover">
				<input type="text" class="wp-timeline-template-search" id="wp-timeline-template-search" placeholder="<?php esc_html_e( 'Search Template', 'wp-timeline-designer-pro' ); ?>" />
				<span class="wp-timeline-template-search-clear"></span>
			</div>
		</ul>
		<?php
		echo '<div class="wp-timeline-blog-template-cover">';
		foreach ( $tempate_list as $key => $value ) {
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
				<span class="wp-timeline-span-template-name"><?php echo esc_html( $value['template_name'] ); ?></span>
			</div>
			<?php
		}
		echo '</div>';
		echo '<h3 class="no-template" style="display: none;">' . esc_html__( 'No template found. Please try again', 'wp-timeline-designer-pro' ) . '</h3>';
		?>
	</div>
	<div id="popuploaderdiv" class="wp-timeline-loader-popupdiv wp-timeline-wrapper" style="display: none;">
		<div class="wp-timeline-loader-style-box">
			<?php
			$total_bullets = count( $loaders );
			$allowed_html  = array(
				'div'  => array(
					'class' => array(),
				),
				'ul'   => array(
					'class' => array(),
				),
				'li'   => array(
					'class' => array(),
				),
				'span' => array(
					'class' => array(),
				),
				'i'    => array(
					'class' => array(),
				),
			);
			if ( $total_bullets > 0 ) {
				foreach ( $loaders as $key => $loader_html ) {
					?>
					<div class="wp-timeline-dialog-loader-style <?php echo esc_attr( $key ); ?>">
						<input type="hidden" class="wp-timeline-loader-style-hidden" value="<?php echo esc_attr( $key ); ?>" />
						<div class="wp-timeline-loader-style-html"><?php echo wp_kses( $loader_html, $allowed_html ); ?></div>
					</div>
					<?php
				}
			}
			?>
		</div>
	</div>
	<div id="popupnavifationdiv" class="wp-timeline-navigation-popupdiv wp-timeline-wrapper" style="display: none;">
		<div class="wp-timeline-navigation-style-box">
			<?php
			for ( $i = 1; $i <= 9; $i++ ) {
				?>
				<div class="wp-timeline-navigation-cover navigation<?php echo esc_attr( $i ); ?>">
					<input type="hidden" class="wp-timeline-navigation-style-hidden" value="navigation<?php echo esc_attr( $i ); ?>" />
					<img src="<?php echo esc_url( WTL_URL ) . '/images/navigation/navigation' . esc_attr( $i ) . '.png'; ?>">
				</div>
				<?php
			}
			?>
		</div>
	</div>
	<div id="popuparrowdiv" class="wp-timeline-arrow-popupdiv wp-timeline-wrapper" style="display: none;">
		<div class="wp-timeline-arrow-style-box">
			<?php
			for ( $i = 1; $i <= 6; $i++ ) {
				?>
				<div class="wp-timeline-arrow-cover arrow<?php echo esc_attr( $i ); ?>">
					<input type="hidden" class="wp-timeline-arrow-style-hidden" value="arrow<?php echo esc_attr( $i ); ?>" />
					<img src="<?php echo esc_url( WTL_URL ) . '/images/arrow/arrow' . esc_attr( $i ) . '.png'; ?>">
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
