<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/wp_timeline_templates/blog/milestone-layout.php.
 *
 * @author  Solwin Infotech
 * @version 1.0
 *
 * @package    Wp_Timeline_Designer_PRO
 * @subpackage Wp_Timeline_Designer_PRO/wp_timeline_templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $post;
$wtl_animation      = isset( $wtl_settings['timeline_animation'] ) ? $wtl_settings['timeline_animation'] : 'fade';
$image_hover_effect = '';
if ( isset( $wtl_settings['wp_timeline_image_hover_effect'] ) && 1 == $wtl_settings['wp_timeline_image_hover_effect'] ) {
	$image_hover_effect = ( isset( $wtl_settings['wp_timeline_image_hover_effect_type'] ) && '' != $wtl_settings['wp_timeline_image_hover_effect_type'] ) ? $wtl_settings['wp_timeline_image_hover_effect_type'] : '';
}
?>
<?php do_action( 'wtl_before_post_content' ); ?>
	<div class="wtl-schedule-post-content" data-aos="<?php echo esc_attr( $wtl_animation ); ?>">
		<div class="wtl-schedule-all-post-content wtl_post_content_schedule">
			<h5><?php echo esc_html( get_the_time( 'Y' ) ); ?></h5>
			<?php Wtl_Template_Config::get_title( $wtl_settings ); ?>
			<div class="wtl-post-content">
				<?php
				Wtl_Template_Milestone_Layout::get_post_date( $wtl_settings );
				Wtl_Template_Config::get_content( $wtl_settings );
				Wtl_Template_Config::get_read_more_link( $wtl_settings );
				Wtl_Template_Config::get_read_more_link_2( $wtl_settings );
				Wtl_Template_Config::display_popup_excerpt( $wtl_settings );
				?>
			</div>
			<div class="wtl-meta-content">
				<?php
				Wtl_Template_Config::get_author( $wtl_settings );
				Wtl_Template_Config::get_comment( $wtl_settings );
				Wtl_Template_Config::get_post_details( $wtl_settings );
				Wtl_Template_Config::get_category( $wtl_settings, true, true );
				Wtl_Template_Config::get_tags( $wtl_settings, true, true );
				Wtl_Template_Config::get_social_media( $wtl_settings );
				?>
			</div>
		</div>
		<div class="milestone-border"><span></span></div>
	</div>
<?php
do_action( 'wtl_after_post_content' );
do_action( 'wtl_separator_after_post' );
