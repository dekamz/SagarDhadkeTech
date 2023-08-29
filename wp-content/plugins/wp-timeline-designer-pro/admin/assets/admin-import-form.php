<?php
/**
 * Admin Import Form.
 *
 * @link       https://www.solwininfotech.com/
 * @since      1.0.0
 *
 * @package    Wp_Timeline_Designer_PRO
 * @subpackage Wp_Timeline_Designer_PRO/wp_timeline_templates
 */

/**
 * To Import Layout.
 *
 * @package    Wp_Timeline_Designer_PRO
 * @subpackage Wp_Timeline_Designer_PRO/admin
 * @author     Solwin Infotech <info@solwininfotech.com>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $import_success, $import_error;
?>
<div class="wrap">
	<h2><?php esc_html_e( 'Import Timeline Layouts', 'wp-timeline-designer-pro' ); ?></h2>
	<?php
	if ( isset( $import_error ) ) {
		?>
		<div class="error notice"><p><?php echo esc_html( $import_error ); ?></p></div>
		<?php
	}
	if ( isset( $import_success ) ) {
		?>
		<div class="updated notice">
			<p><?php echo esc_html( $import_success ); ?></p>
		</div>
		<?php
	}
	?>
	<div class="narrow">
		<p>
			<?php esc_html_e( 'Select import type and Choose a .txt file to upload, then click Upload file and import', 'wp-timeline-designer-pro' ); ?>
		</p>
		<form method="post" id="wp-timeline-import-upload-form" class="wp-timeline-upload-form" enctype="multipart/form-data" name="wp-timeline-import-upload-form">
			<p>
				<?php wp_nonce_field( 'wtl_import', 'wtl_import_nonce' ); ?>
				<label><?php esc_html_e( 'Import Type', 'wp-timeline-designer-pro' ); ?> : </label>
				<select id="wtl_layout_import_types" name="wtl_layout_import_types">
					<option value=""><?php esc_html_e( 'Please Select', 'wp-timeline-designer-pro' ); ?></option>
					<option value="wp_timeline_blog_layouts"><?php esc_html_e( 'Timeline Layouts', 'wp-timeline-designer-pro' ); ?></option>
					<option value="wp_timeline_cpt"><?php esc_html_e( 'Timeline Custom Post Type', 'wp-timeline-designer-pro' ); ?></option>
				</select>
			</p>
			<p>
				<label for="wtl_import_layout"><?php esc_html_e( 'Choose a file from your computer', 'wp-timeline-designer-pro' ); ?> : </label>
				<input type="file" id="wtl_import_layout" name="wtl_import">
			</p>
			<p>
				<strong><?php esc_html_e( 'Note', 'wp-timeline-designer-pro' ); ?>:</strong> <?php esc_html_e( 'If you have an query or face any issue while importing layout, please refer', 'wp-timeline-designer-pro' ); ?> <a href="<?php echo esc_url( 'https://wptimeline.solwininfotech.com/docs-category/export-and-import/' ); ?>" target="_blank"><?php esc_html_e( 'WP Timeline Designer PRO Document', 'wp-timeline-designer-pro' ); ?></a>
			</p>
			<p class="submit">
				<input id="submit" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Upload file and import', 'wp-timeline-designer-pro' ); ?>" name="submit">
			</p>

		</form>
	</div>
</div>
