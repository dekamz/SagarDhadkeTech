<?php
/**
 * Admin Getting Started Page.
 *
 * @link       https://www.solwininfotech.com/
 * @since      1.0.0
 *
 * @package    Wp_Timeline_Designer_PRO
 * @subpackage Wp_Timeline_Designer_PRO/wp_timeline_templates
 */

/**
 * Getting Start of Plugin.
 *
 * @package    Wp_Timeline_Designer_PRO
 * @subpackage Wp_Timeline_Designer_PRO/admin
 * @author     Solwin Infotech <info@solwininfotech.com>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $wp_version, $wpdb, $wp_timeline_errors, $wp_timeline_success, $wtl_settings;

$active_tab                 = ( isset( $_GET['tab'] ) && '' != $_GET['tab'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_GET['tab'] ) ) ) : 'help_file';
$wp_timeline_wp_auto_update = new Wp_Timeline_Auto_Update();
$plugin_version             = WTL_VERSION;

if ( isset( $wp_timeline_errors ) ) {
	if ( is_wp_error( $wp_timeline_errors ) ) {
		?>
		<div class="error notice">
			<p><?php echo esc_html( $wp_timeline_errors->get_error_message() ); ?></p>
		</div>
		<?php
	}
}
if ( isset( $wp_timeline_success ) ) {
	?>
	<div class="updated notice">
		<p><?php echo esc_html( $wp_timeline_success ); ?></p>
	</div>
	<?php
}

if ( isset( $_GET['page'] ) && 'wtl_getting_started' === $_GET['page'] ) {
	$allsettings = get_option( 'wp_timeline_single_file_template' );
	if ( $allsettings && is_serialized( $allsettings ) ) {
		$wp_timeline_settings = maybe_unserialize( $allsettings );
	}
	$msg = '&msg=updated';
}
?>
<div class="wrap getting-started-wrap">
	<div class="intro">
		<div class="intro-content">
			<h3> <?php esc_html_e( 'Getting Started', 'wp-timeline-designer-pro' ); ?> </h3>
			<h4> <?php echo esc_html__( 'You will find everything you need to get started here. You are now equipped with arguably the most powerful WordPress', 'wp-timeline-designer-pro' ) . ' <b>' . esc_html__( 'Timeline Layouts Builder', 'wp-timeline-designer-pro' ) . '</b>. ' . esc_html__( 'To enjoy the full experience, we strongly recommend to read the help file first and register your product with codecanyon license key.', 'wp-timeline-designer-pro' ); ?> </h4>
		</div>
		<div class="intro-logo">
			<div class="intro-logo-cover">
				<img src="<?php echo esc_attr( WTL_URL ) . '/admin/images/header-logo__.png'; ?>" alt="<?php esc_html_e( 'WP Timeline Designer PRO', 'wp-timeline-designer-pro' ); ?>" />
				<span class="wp-timeline-version"><?php echo esc_html__( 'Version', 'wp-timeline-designer-pro' ) . ' ' . esc_html( $plugin_version ); ?></span>
			</div>
		</div>
	</div>
	<div class="wp-timeline-panel">
		<ul class="wp-timeline-panel-list">
			<li class="panel-item <?php echo ( 'help_file' === $active_tab ) ? 'active' : ''; ?>">
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=wtl_getting_started&tab=help_file' ) ); ?>"><?php esc_html_e( 'Read This First', 'wp-timeline-designer-pro' ); ?></a>
			</li>
			<li class="panel-item <?php echo ( 'register_product' === $active_tab ) ? 'active' : ''; ?> <?php echo ( 'correct' === $wp_timeline_wp_auto_update->get_remote_license() ) ? 'wp-timeline-reg' : 'wp-timeline-not-reg'; ?>">
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=wtl_getting_started&tab=register_product' ) ); ?>"><?php esc_html_e( 'Register Product', 'wp-timeline-designer-pro' ); ?></a>
			</li>
		</ul>
		<div class="wp-timeline-panel-wrap">
			<?php if ( 'help_file' === $active_tab ) : ?>
			<div id="wp-timeline-help-file" class="wp-timeline-help-file">
				<div class="wp-timeline-panel-left">
					<div class="wp-timeline-notification">
						<h2>
							<?php
							echo esc_html__( 'Success, The WP Timeline Designer PRO is now activated!', 'wp-timeline-designer-pro' ) . ' &#x1F60A <br><br>';
							$count_layout         = $wpdb->get_var( 'SELECT COUNT(`wtlid`) FROM ' . $wpdb->prefix . 'wtl_shortcodes' );
							$sample_layout_notice = get_option( 'wtl_admin_notice_pro_layouts_dismiss', false );
							if ( 0 == $count_layout && false == $sample_layout_notice ) {
								esc_html_e( 'Would you like to create one sample timeline page to check usage of WP Timeline Designer PRO plugin?', 'wp-timeline-designer-pro' );
								?>
								<br/><br/>
								<a class="wtl-create-layout" href="<?php echo esc_url( add_query_arg( 'sample-blog-layout', 'new', admin_url( 'admin.php?page=wtl_layouts' ) ) ); ?>"><?php esc_html_e( 'Yes, Please do it', 'wp-timeline-designer-pro' ); ?></a> | <a href="<?php echo esc_url( 'https://www.solwininfotech.com/documents/wordpress/wp-timeline-designer-pro-document/#quick_guide' ); ?>" target="_blank"> <?php esc_html_e( 'No, I will configure my self (Give me steps)', 'wp-timeline-designer-pro' ); ?> </a>
							<?php } ?>
						</h2>
						<p><?php echo esc_html__( 'To customize your timeline layouts,', 'wp-timeline-designer-pro' ) . ' <a href="admin.php?page=wtl_layouts" target="_blank">' . esc_html__( 'Go to Layouts', 'wp-timeline-designer-pro' ) . '</a>. ' . esc_html__( 'In case of doubt,', 'wp-timeline-designer-pro' ) . ' <a href="https://www.solwininfotech.com/documents/wordpress/wp-timeline-designer-pro-document" target="_blank"> ' . esc_html__( 'Read Documentation', 'wp-timeline-designer-pro' ) . ' </a> ' . esc_html__( 'or create a support ticket on our', 'wp-timeline-designer-pro' ) . ' <a href="http://support.solwininfotech.com/" target="_blank">' . esc_html__( 'support portal', 'wp-timeline-designer-pro' ) . '</a>.'; ?> </p>
					</div>

					<h3>
						<?php esc_html_e( 'Getting Started', 'wp-timeline-designer-pro' ); ?> <span>(<?php esc_html_e( 'Must Read', 'wp-timeline-designer-pro' ); ?>)</span>
					</h3>
					<p><?php esc_html_e( 'Once you’ve activated your plugin, you’ll be redirected to a Getting Started page (WP Timeline Designer PRO > Getting Started). Here, you can view the required and helpful steps to use plugin.', 'wp-timeline-designer-pro' ); ?></p>

					<hr id="#wp-timeline-important-things">
					<h3>
						<?php esc_html_e( 'Important things', 'wp-timeline-designer-pro' ); ?> <span>(<?php esc_html_e( 'Required', 'wp-timeline-designer-pro' ); ?>)</span> <a href="#wp-timeline-important-things">#</a>
						<a class="back-to-top" href="#wp-timeline-help-file"><?php esc_html_e( 'Back to Top', 'wp-timeline-designer-pro' ); ?></a>
					</h3>
					<p><?php esc_html_e( 'To use WP Timeline Designer, follow the below steps for initial setup - Correct the Reading Settings.', 'wp-timeline-designer-pro' ); ?></p>
					<ul>
						<li><?php echo esc_html__( 'To check the reading settings, click', 'wp-timeline-designer-pro' ) . ' <b><a href="options-reading.php" target="_blank">' . esc_html__( 'Settings > Reading', 'wp-timeline-designer-pro' ) . '</a></b> ' . esc_html__( 'in the WordPress admin menu.', 'wp-timeline-designer-pro' ); ?></li>
						<li><?php echo esc_html__( 'If your', 'wp-timeline-designer-pro' ) . '<b> ' . esc_html__( 'Posts page', 'wp-timeline-designer-pro' ) . ' </b> ' . esc_html__( ' is selected with the same page selection as the page you selected under WP Timeline Designer Settings, then change that selection from the dropdown to the default', 'wp-timeline-designer-pro' ) . '</b> ( <b>" — ' . esc_html__( 'Select', 'wp-timeline-designer-pro' ) . ' — "</b> )'; ?></li>
					</ul>

					<hr id="wp-timeline-shortcode-usage">
					<h3>
						<?php esc_html_e( 'How to use WP Timeline Designer Shortcode?', 'wp-timeline-designer-pro' ); ?> <span>(<?php esc_html_e( 'Optional', 'wp-timeline-designer-pro' ); ?>)</span> <a href="#wp-timeline-shortcode-usage">#</a>
						<a class="back-to-top" href="#wp-timeline-help-file"><?php esc_html_e( 'Back to Top', 'wp-timeline-designer-pro' ); ?></a>
					</h3>
					<p><?php esc_html_e( 'WP Timeline Designer is flexible to be used with any page builders like WPBakery Page Builder, Elementor, KingComposer, Page Builder by SiteOrigin, Beaver Builder and divi with shortcode.', 'wp-timeline-designer-pro' ); ?></p>
					<ul>
						<li><?php echo esc_html__( 'Use shortcode', 'wp-timeline-designer-pro' ) . ' <b>[wp_timeline_design id="xx"]</b> ' . esc_html__( 'in any WordPress post or page.', 'wp-timeline-designer-pro' ); ?></li>
						<li><?php echo esc_html__( 'Use', 'wp-timeline-designer-pro' ) . '<b> &lt;&quest;php echo do_shortcode("[wp_timeline_design id="xx"]"); &nbsp;&quest;&gt; </b>' . esc_html__( 'into a template file within your theme files.', 'wp-timeline-designer-pro' ); ?></li>
					</ul>

					<hr id="wp-timeline-dummy-posts">
					<h3>
						<?php esc_html_e( 'Import Dummy Post', 'wp-timeline-designer-pro' ); ?> <span>(<?php esc_html_e( 'Optional', 'wp-timeline-designer-pro' ); ?>)</span> <a href="#wp-timeline-dummy-posts">#</a>
						<a class="back-to-top" href="#wp-timeline-help-file"><?php esc_html_e( 'Back to Top', 'wp-timeline-designer-pro' ); ?></a>
					</h3>
					<p><?php esc_html_e( 'We have craeted a dummy set of posts for you to get started with WP Timeline Designer PRO.', 'wp-timeline-designer-pro' ); ?></p>
					<p><?php esc_html_e( 'To import the dummy posts, follow the below process:', 'wp-timeline-designer-pro' ); ?></p>
					<ul>
						<li><?php echo esc_html__( 'Go to', 'wp-timeline-designer-pro' ) . ' <b>' . esc_html__( 'Tools > Import', 'wp-timeline-designer-pro' ) . '</b> ' . esc_html__( 'in WordPress Admin panel.', 'wp-timeline-designer-pro' ); ?></li>
						<li><?php echo esc_html__( 'Run', 'wp-timeline-designer-pro' ) . '<b> ' . esc_html__( 'WordPress Importer', 'wp-timeline-designer-pro' ) . '</b> ' . esc_html__( 'at the end of the presentated list.', 'wp-timeline-designer-pro' ); ?></li>
						<li><?php echo esc_html__( 'You will be redirected on', 'wp-timeline-designer-pro' ) . ' <b>' . esc_html__( 'Import WordPress', 'wp-timeline-designer-pro' ) . '</b> ' . esc_html__( 'where we need to select actual sample posts XML file.', 'wp-timeline-designer-pro' ); ?></li>
						<li><?php echo esc_html__( 'Select', 'wp-timeline-designer-pro' ) . ' <b> import-sample_posts.xml </b> ' . esc_html__( 'from your computer. ', 'wp-timeline-designer-pro' ); ?></li>
						<li><?php echo esc_html__( 'Click on', 'wp-timeline-designer-pro' ) . ' <b>' . esc_html__( 'Upload file and import', 'wp-timeline-designer-pro' ) . '</b> ' . esc_html__( 'and with next step please select', 'wp-timeline-designer-pro' ) . ' <b>' . esc_html__( 'Download and import file attachments', 'wp-timeline-designer-pro' ) . '</b> ' . esc_html__( 'checkbox.', 'wp-timeline-designer-pro' ); ?></li>
						<li><?php esc_html_e( 'All done! Your website is ready with sample blog posts.', 'wp-timeline-designer-pro' ); ?></li>
					</ul>
				</div>
				<div class="bd-panel-right">
					<h3><?php esc_html_e( 'Other Premium Plugins', 'wp-timeline-designer-pro' ); ?></h3>
					<div class="panel-aside">
						<a href="<?php echo esc_url( 'https://www.solwininfotech.com/product/wordpress-plugins/avartan-slider/' ); ?>" target="_blank">
							<img src="https://solwincdn-79e1.kxcdn.com/wp-content/uploads/2015/10/avartan-responsive-slider.png" alt="<?php esc_html_e( 'Avartan Slider', 'wp-timeline-designer-pro' ); ?>" />
						</a>
						<div class="panel-club-inside">
							<p><?php echo '<b>' . esc_html__( 'Avartan Slider', 'wp-timeline-designer-pro' ) . '</b> ' . esc_html__( 'is a responsive WordPress plugin to create stunning image slider and video slider for your WordPress website. It has unique features like drag and drop visual slider builder, multi-media content, etc.', 'wp-timeline-designer-pro' ); ?></p>
							<a href="<?php echo esc_url( 'https://www.solwininfotech.com/product/wordpress-plugins/avartan-slider/' ); ?>" target="_blank"><?php esc_html_e( 'Read More', 'wp-timeline-designer-pro' ); ?></a>
						</div>
					</div>
					<div class="panel-aside">
						<a href="<?php echo esc_url( 'https://www.solwininfotech.com/product/wordpress-plugins/portfolio-designer/' ); ?>" target="_blank">
							<img src="https://solwincdn-79e1.kxcdn.com/wp-content/uploads/2017/02/Portfolio-Designer-WordPress-Plugin.png" alt="<?php esc_html_e( 'Portfolio Designer', 'wp-timeline-designer-pro' ); ?>" />
						</a>
						<div class="panel-club-inside">
							<p><?php echo '<b>' . esc_html__( 'Portfolio Designer', 'wp-timeline-designer-pro' ) . '</b> ' . esc_html__( 'is a WordPress plugin used to build portfolio in any desired layout. This plugin is user friendly, So no matter if you are a beginner, WordPress user, Designer or a Developer, no additional coding knowledge is required in creating portfolio layouts.', 'wp-timeline-designer-pro' ); ?></p>
							<a href="<?php echo esc_url( 'https://www.solwininfotech.com/product/wordpress-plugins/portfolio-designer/' ); ?>" target="_blank"><?php esc_html_e( 'Read More', 'wp-timeline-designer-pro' ); ?></a>
						</div>
					</div>

					<h3><?php esc_html_e( 'Other Premium Themes', 'wp-timeline-designer-pro' ); ?></h3>
					<div class="panel-aside">
						<a href="<?php echo esc_url( 'https://www.solwininfotech.com/product/wordpress-themes/foodfork/' ); ?>" target="_blank">
							<img src="https://solwincdn-79e1.kxcdn.com/wp-content/uploads/2016/06/FoodFork-Restaturant-WordPress-Theme.jpg" alt="<?php esc_html_e( 'FoodFork', 'wp-timeline-designer-pro' ); ?>" />
						</a>
						<div class="panel-club-inside">
							<p><?php echo '<b>' . esc_html__( 'FoodFork', 'wp-timeline-designer-pro' ) . '</b> ' . esc_html__( 'is a premium WordPress theme for Restaurants and food business websites. You can use this theme for your business websites like restaurant, cafe, coffee shop, fast food or pizza store.', 'wp-timeline-designer-pro' ); ?></p>
							<a href="<?php echo esc_url( 'https://www.solwininfotech.com/product/wordpress-themes/foodfork/' ); ?>" target="_blank"><?php esc_html_e( 'Read More', 'wp-timeline-designer-pro' ); ?></a>
						</div>
					</div>
					<div class="panel-aside">
						<a href="<?php echo esc_url( 'https://www.solwininfotech.com/product/wordpress-themes/jewelux/' ); ?>" target="_blank">
							<img src="https://solwincdn-79e1.kxcdn.com/wp-content/uploads/2016/02/JewelUX-WordPress-Premium-Theme.jpg" alt="<?php esc_html_e( 'JewelUX', 'wp-timeline-designer-pro' ); ?>" />
						</a>
						<div class="panel-club-inside">
							<p><?php echo '<b>' . esc_html__( 'JewelUX', 'wp-timeline-designer-pro' ) . '</b> ' . esc_html__( 'is a clean and modern jewelry WordPress theme designed for any online jewelry website. It’s a WooCommerce theme with responsive layout, fully widgetized and animated home page.', 'wp-timeline-designer-pro' ); ?></p>
							<a href="<?php echo esc_url( 'https://www.solwininfotech.com/product/wordpress-themes/jewelux/' ); ?>" target="_blank"><?php esc_html_e( 'Read More', 'wp-timeline-designer-pro' ); ?></a>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>
			<?php
			if ( 'register_product' === $active_tab ) :
				global $wp_version, $wpdb, $wtl_settings, $wp_timeline_errors, $wp_timeline_success;
				$return = '';
				if ( isset( $_POST['license_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['license_nonce'] ) ), 'license_action' ) ) {
					if ( isset( $_POST['wp_timeline_sbt_purchasecode'] ) ) {
						$sol_username  = isset( $_POST['sol_username'] ) ? sanitize_text_field( wp_unslash( $_POST['sol_username'] ) ) : '';
						$purchase_code = isset( $_POST['sol_purchase_code'] ) ? sanitize_text_field( wp_unslash( $_POST['sol_purchase_code'] ) ) : '';
						$return        = $wp_timeline_wp_auto_update->update_license( trim( $sol_username ), trim( $purchase_code ) );
					}
					if ( isset( $_POST['wp_timeline_deregister_purchasecode'] ) ) {
						$sol_username  = isset( $_POST['sol_username'] ) ? sanitize_text_field( wp_unslash( $_POST['sol_username'] ) ) : '';
						$purchase_code = isset( $_POST['sol_purchase_code'] ) ? sanitize_text_field( wp_unslash( $_POST['sol_purchase_code'] ) ) : '';
						$return        = $wp_timeline_wp_auto_update->deregister_site( trim( $sol_username ), trim( $purchase_code ) );
					}
				}
				$sol_username            = get_option( 'wp_timeline_username' );
				$purchase_code           = get_option( 'wp_timeline_purchase_code' );
				$wp_timeline_information = $wp_timeline_wp_auto_update->get_remote_information();
				?>
				<div id="wp-timeline-register-product" class="wp-timeline-register-product" >
					<?php if ( 'correct' === $return ) { ?>
						<div class="wp-timeline-updated wp-timeline-notice">
							<p><?php esc_html_e( 'License updated successfully.', 'wp-timeline-designer-pro' ); ?></p>
						</div>
						<?php
					} elseif ( 'used' === $return ) {
						?>
						<div class="wp-timeline-error wp-timeline-notice">
							<p><?php esc_html_e( 'License Key already used.', 'wp-timeline-designer-pro' ); ?></p>
						</div>
						<?php
					} elseif ( 'incorrect' === $return ) {
						?>
						<div class="wp-timeline-error wp-timeline-notice">
							<p><?php esc_html_e( 'Wrong license key.', 'wp-timeline-designer-pro' ); ?></p>
						</div>
						<?php
					} elseif ( 'unsuccess' === $return ) {
						?>
						<div class="wp-timeline-error wp-timeline-notice">
							<p><?php esc_html_e( 'Site is not registered with this license key.', 'wp-timeline-designer-pro' ); ?></p>
						</div>
						<?php
					} elseif ( 'success' === $return ) {
						?>
						<div class="wp-timeline-updated wp-timeline-notice">
							<p><?php esc_html_e( 'Site has been De-Registered successfully.', 'wp-timeline-designer-pro' ); ?></p>
						</div>
						<?php
					}
					?>
					<h3>
						<?php esc_html_e( 'Register your plugin copy', 'wp-timeline-designer-pro' ); ?>
					</h3>
					<p><?php esc_html_e( 'Verify your codecanyon item purchase key to get automatic updates, notifications on your WordPress dashboard.', 'wp-timeline-designer-pro' ); ?></p>

					<form method="post" name="wp_timeline_frm_purchasecode" id="wp_timeline_frm_purchasecode">
						<p>
							<span class="wp-timeline-label"> <b><?php esc_html_e( 'Username', 'wp-timeline-designer-pro' ); ?> : </b> </span>
							<input value="<?php echo esc_attr( $sol_username ); ?>" required="" type="text" name="sol_username" id="sol_username" />
							<i><small><?php esc_html_e( 'Username will be your registered username with', 'wp-timeline-designer-pro' ); ?>&nbsp;<a target="blank" href="https://codecanyon.net/"><?php esc_html_e( 'codecanyon', 'wp-timeline-designer-pro' ); ?></a></small></i>
						</p>
						<p>
							<span class="wp-timeline-label"> <b><?php esc_html_e( 'License Key', 'wp-timeline-designer-pro' ); ?> : </b> </span>
							<input value="<?php echo esc_attr( $purchase_code ); ?>" required="" type="password" name="sol_purchase_code" id="sol_purchase_code" />
							<i><small><a target="blank" href="<?php echo esc_url( 'https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code' ); ?>"> <?php esc_html_e( 'Click here', 'wp-timeline-designer-pro' ); ?> </a> <?php esc_html_e( 'to know how to get item purchase code.', 'wp-timeline-designer-pro' ); ?></small></i>
						</p>
						<p>
							<input class="wp-timeline-btn-success" type="submit" value="<?php echo esc_attr( '' != $sol_username ) ? esc_html__( 'Update License', 'wp-timeline-designer-pro' ) : esc_html__( 'Verify License', 'wp-timeline-designer-pro' ); ?>" name="wp_timeline_sbt_purchasecode" />
							<?php if ( '' != $sol_username ) { ?>
							<input class="wp-timeline-btn-error" type="submit" value="<?php echo esc_html__( 'De-Register Site', 'wp-timeline-designer-pro' ); ?>" name="wp-timeline_deregister_purchasecode" />
						<?php } ?>
						</p>
						<i> Note: If plugin was packed with your theme then it will update by your theme provider. </i>
						<?php wp_nonce_field( 'license_action', 'license_nonce' ); ?>
					</form>
				</div>
				<?php
			endif;
			?>
		</div>
		<?php
		if ( 'register_product' === $active_tab ) :
			?>
		<div class="wp-timeline-updatestory">
			<div class="wp-timeline-info-heading wp-timeline-panel-header">
				<h3><span class="dashicons dashicons-image-rotate"> </span> <?php esc_html_e( 'Update History', 'wp-timeline-designer-pro' ); ?> </h3>
			</div>
			<div class="wp-timeline-panel-body">
				<div class="changelog-cover">
					<?php echo wp_kses( $wp_timeline_information->sections['changelog'], Wp_Timeline_Public::args_kses() ); ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</div>
</div>
