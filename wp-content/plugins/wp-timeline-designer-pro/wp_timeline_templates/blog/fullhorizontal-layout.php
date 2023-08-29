<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/wp_timeline_templates/blog/fullhorizontal-layout.php.
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
	<div class="wtl-fullhorizontal-post-content " data-aos="<?php echo esc_attr( $wtl_animation ); ?>">
		<?php Wtl_Template_Fullhorizontal_Layout::get_post_image( $wtl_settings ); ?>
		<div class="wtl-content-fullhorizontal">
			<div class="wtl-post-content">
				<?php
				if ( class_exists( 'woocommerce' ) && 'product' === $wtl_settings['custom_post_type'] ) {
					if ( isset( $wtl_settings['display_sale_tag'] ) && 1 == $wtl_settings['display_sale_tag'] ) {
						$wtl_sale_tagtext_alignment = ( isset( $wtl_settings['wp_timeline_sale_tagtext_alignment'] ) && '' != $wtl_settings['wp_timeline_sale_tagtext_alignment'] ) ? $wtl_settings['wp_timeline_sale_tagtext_alignment'] : 'left-top';
						echo '<div class="wtl_woo_sale_wrap ' . esc_attr( $wtl_sale_tagtext_alignment ) . '">';
						do_action( 'wtl_woo_sale_tag' );
						echo '</div>';
					}
				}
				$label_featured_post = ( isset( $wtl_settings['label_featured_post'] ) && '' != $wtl_settings['label_featured_post'] ) ? $wtl_settings['label_featured_post'] : '';
				if ( '' != $label_featured_post && is_sticky() ) {
					?>
					<div class="label_featured_post"><?php echo esc_html( $label_featured_post ); ?></div> 
					<?php
				}
				echo wp_kses( Wtl_Template_Config::get_post_date( $wtl_settings, true ), Wp_Timeline_Public::args_kses() );
				?>
				<div class="get_date_and_title">
					<?php
					Wtl_Template_Config::get_title( $wtl_settings );
					?>
					<div class="post-content-inner">
						<?php
						Wtl_Template_Config::get_content( $wtl_settings );
						Wtl_Template_Config::get_read_more_link( $wtl_settings );
						Wtl_Template_Config::get_read_more_link_2( $wtl_settings );
						Wtl_Template_Config::display_popup_excerpt( $wtl_settings );
						?>
					</div>
				</div>
			</div>
			<div class="wtl-meta-content">
				<?php
				Wtl_Template_Config::get_author( $wtl_settings );
				Wtl_Template_Config::get_comment( $wtl_settings );
				if ( isset( $wtl_settings['display_postlike'] ) && 1 == $wtl_settings['display_postlike'] ) {

					echo do_shortcode( '[likebtn_shortcode]' );
				}
				Wtl_Template_Config::get_post_details( $wtl_settings );
				Wtl_Template_Config::get_category( $wtl_settings, true, true );
				Wtl_Template_Config::get_tags( $wtl_settings, true, true );
				Wtl_Template_Config::get_social_media( $wtl_settings );

				?>
			</div>
		</div>
	</div>
