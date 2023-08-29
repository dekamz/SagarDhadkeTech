<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/wp_timeline_templates/blog/leafty-layout.php.
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
$wtl_animation = isset( $wtl_settings['timeline_animation'] ) ? $wtl_settings['timeline_animation'] : 'fade';
$i             = $count;
$format        = get_post_format( $post->ID );
$post_format   = '';
if ( 'status' === $format ) {
	$post_format = 'fas fa-comment';
} elseif ( 'aside' === $format ) {
	$post_format = 'far fa-file-alt';
} elseif ( 'image' === $format ) {
	$post_format = 'far fa-file-image';
} elseif ( 'gallery' === $format ) {
	$post_format = 'far fa-file-image';
} elseif ( 'link' === $format ) {
	$post_format = 'fas fa-link';
} elseif ( 'quote' === $format ) {
	$post_format = 'fas fa-quote-left';
} elseif ( 'audio' === $format ) {
	$post_format = 'fas fa-music';
} elseif ( 'video' === $format ) {
	$post_format = 'fas fa-video';
} elseif ( 'chat' === $format ) {
	$post_format = 'fab fa-weixin';
} else {
	$post_format = 'fas fa-thumbtack';
}
$post_content_color_set = isset( $wtl_details['wtl_content_color'] ) ? ' style="color:' . $wtl_details['wtl_content_color'] . ';" ' : '';
?>
	<div class="wtl-schedule-post-content <?php echo 'post_' . esc_attr( Wtl_Template_Leafty_Layout::even_odd( $i ) ); ?>" data-aos="<?php echo esc_attr( $wtl_animation ); ?>">
		<div class="post_tag taxonomies">
			<div class="post-tag-inner">
				<?php echo wp_kses( Wtl_Template_Leafty_Layout::get_tags( $wtl_settings, true, true ), Wp_Timeline_Public::args_kses() ); ?>
			</div>
		</div>
		<div class="wtl_title_cat">
			<?php
			Wtl_Template_Config::get_title( $wtl_settings );
			Wtl_Template_Leafty_Layout::get_category( $wtl_settings, true, true );
			?>
		</div>
		<?php Wtl_Template_Config::get_post_image( $wtl_settings ); ?>
		<div class="wtl-meta-content">
			<div class="wtl-meta-content-left">
				<?php
				Wtl_Template_Leafty_Layout::get_author( $wtl_settings );
				Wtl_Template_Config::get_comment( $wtl_settings );
				if ( isset( $wtl_settings['display_postlike'] ) && 1 == $wtl_settings['display_postlike'] ) {

					echo do_shortcode( '[likebtn_shortcode]' );
				}
				?>
			</div>
			<?php

			Wtl_Template_Config::get_social_media( $wtl_settings );
			?>
		</div>
		<?php
		Wtl_Template_Config::get_post_details( $wtl_settings );
		?>
		<div class="wtl-post-content">
			<div class="post-content-inner">
				<?php
				Wtl_Template_Leafty_Layout::get_content( $wtl_settings );
				Wtl_Template_Config::get_read_more_link( $wtl_settings );
				Wtl_Template_Config::get_read_more_link_2( $wtl_settings );
				Wtl_Template_Config::display_popup_excerpt( $wtl_settings );
				?>
			</div>
		</div>
	</div>
