<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/wp_timeline_templates/blog/collapsible.php.
 *
 * @author  Solwin Infotech
 * @version 1.0
 *
 * @package    Wp_Timeline_Designer_PRO
 * @subpackage Wp_Timeline_Designer_PRO/wp_timeline_templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global $post;
$image_hover_effect = '';
if ( isset( $wtl_settings['wp_timeline_image_hover_effect'] ) && 1 == $wtl_settings['wp_timeline_image_hover_effect'] ) {
	$image_hover_effect = ( isset( $wtl_settings['wp_timeline_image_hover_effect_type'] ) && '' != $wtl_settings['wp_timeline_image_hover_effect_type'] ) ? $wtl_settings['wp_timeline_image_hover_effect_type'] : '';
}
$wtl_all_post_type = array( 'product', 'download', 'post' );
$wtl_animation     = isset( $wtl_settings['timeline_animation'] ) ? $wtl_settings['timeline_animation'] : 'fade';
$display_tag       = isset( $wtl_settings['display_tag'] ) ? $wtl_settings['display_tag'] : 0;
$socialtagclass    = '';
if ( isset( $wtl_settings['display_tag'] ) && 0 == $wtl_settings['display_tag'] ) {
	$socialtagclass = 'socialtagalign';
}
?>
<div class="wtl_blog_template blog_template collapsible wtl_single_post_wrapp <?php echo esc_attr( $socialtagclass ); ?> <?php echo esc_attr( Wtl_Template_Config::get_class_category( $wtl_settings ) ); ?>">
	<?php do_action( 'wtl_before_post_content' ); ?>
	<div class="wtl-collapsible-wrap">
		<div class="wtl-collapsible-meta-content" data-aos="<?php echo esc_attr( $wtl_animation ); ?>">
			<?php
			if ( isset( $wtl_settings['display_date'] ) && 1 == $wtl_settings['display_date'] ) {
				$date_link        = ( isset( $wtl_settings['disable_link_date'] ) && 1 == $wtl_settings['disable_link_date'] ) ? false : true;
				$date_format      = ( isset( $wtl_settings['post_date_format'] ) && 'default' !== $wtl_settings['post_date_format'] ) ? $wtl_settings['post_date_format'] : get_option( 'date_format' );
				$wp_timeline_date = ( isset( $wtl_settings['display_date_from'] ) && 'modify' === $wtl_settings['display_date_from'] ) ? apply_filters( 'wtl_date_format', get_post_modified_time( $date_format, $post->ID ), $post->ID ) : apply_filters( 'wtl_date_format', get_the_time( $date_format, $post->ID ), $post->ID );
				$ar_year          = get_the_time( 'Y' );
				$ar_month         = get_the_time( 'm' );
				$ar_day           = get_the_time( 'd' );
				echo '<div class="wtl-post-date">';
				echo ( $date_link ) ? '<a class="mdate" href="' . esc_url( get_day_link( $ar_year, $ar_month, $ar_day ) ) . '">' : '';
				echo esc_html( get_the_time( 'Y' ) );
				echo ( $date_link ) ? '</a>' : '';

				echo '</div>';
			}

			?>
		</div>
		<div class="wtl-collapsible-post-content" data-aos="<?php echo esc_attr( $wtl_animation ); ?>">
			<div class="wtl-collapsible-circle"></div>
			<div class="wtl-collapsible-meta-content date-mobile-only" data-aos="<?php echo esc_attr( $wtl_animation ); ?>">
			<?php
			if ( isset( $wtl_settings['display_date'] ) && 1 == $wtl_settings['display_date'] ) {
				$date_link        = ( isset( $wtl_settings['disable_link_date'] ) && 1 == $wtl_settings['disable_link_date'] ) ? false : true;
				$date_format      = ( isset( $wtl_settings['post_date_format'] ) && 'default' !== $wtl_settings['post_date_format'] ) ? $wtl_settings['post_date_format'] : get_option( 'date_format' );
				$wp_timeline_date = ( isset( $wtl_settings['display_date_from'] ) && 'modify' === $wtl_settings['display_date_from'] ) ? apply_filters( 'wtl_date_format', get_post_modified_time( $date_format, $post->ID ), $post->ID ) : apply_filters( 'wtl_date_format', get_the_time( $date_format, $post->ID ), $post->ID );
				$ar_year          = get_the_time( 'Y' );
				$ar_month         = get_the_time( 'm' );
				$ar_day           = get_the_time( 'd' );
				echo '<div class="wtl-post-date">';
				echo ( $date_link ) ? '<a class="mdate" href="' . esc_url( get_day_link( $ar_year, $ar_month, $ar_day ) ) . '">' : '';
				echo esc_html( get_the_time( 'Y' ) );
				echo ( $date_link ) ? '</a>' : '';

				echo '</div>';
			}
			?>
		</div>
			<div class="wtl-collapsible-head-content">
			<?php
				$label_featured_post = ( isset( $wtl_settings['label_featured_post'] ) && '' != $wtl_settings['label_featured_post'] ) ? $wtl_settings['label_featured_post'] : '';
			if ( '' != $label_featured_post && is_sticky() ) {
				?>
					<div class="label_featured_post"><?php echo esc_html( $label_featured_post ); ?></div> 
					<?php
			}
				Wtl_Template_Config::get_title( $wtl_settings );
			?>
			<div class="wtl-collapsible-inner inner-first">
				<?php Wtl_Template_Collapsible_Layout::get_post_image( $wtl_settings ); ?>
				<div class="wtl-collapsible-all-post-content <?php echo empty( $thumbnail ) ? 'wtl_post_content_collapsible' : ''; ?>">
					<?php
					Wtl_Template_Config::get_category( $wtl_settings, false, true );
					if ( isset( $wtl_settings['custom_post_type'] ) && 'product' === $wtl_settings['custom_post_type'] ) {
						do_action( 'wtl_woo_product_details', $wtl_settings, $post->ID );
					}
					if ( isset( $wtl_settings['custom_post_type'] ) && 'download' === $wtl_settings['custom_post_type'] ) {
						do_action( 'wtl_edd_product_details', $wtl_settings, $post->ID );
					}
					?>
					<div class="admin-comment">
					<?php
						Wtl_Template_Config::get_author( $wtl_settings );
						Wtl_Template_Config::get_comment( $wtl_settings );
					if ( isset( $wtl_settings['display_postlike'] ) && 1 == $wtl_settings['display_postlike'] ) {

						echo do_shortcode( '[likebtn_shortcode]' );
					}
					?>
					</div>
					<?php
					if ( 'product' === $wtl_settings['custom_post_type'] ) {
						$wtl_tax_tag         = 'product_tag';
						$wtl_display_tax_tag = 'product_tag';
					} elseif ( 'download' === $wtl_settings['custom_post_type'] ) {
						$wtl_tax_tag         = 'download_tag';
						$wtl_display_tax_tag = 'download_tag';
					} elseif ( 'post' === $wtl_settings['custom_post_type'] ) {
						$wtl_tax_tag         = 'post_tag';
						$wtl_display_tax_tag = 'tag';
					}
					$social_share     = ( isset( $wtl_settings['social_share'] ) && 0 == $wtl_settings['social_share'] ) ? false : true;
					$social_share_wtl = ( isset( $wtl_settings['social_share'] ) && 0 == $wtl_settings['social_share'] ) ? 'wtl-false' : 'wtl-true';
					if ( ( isset( $wtl_settings[ 'display_' . $wtl_display_tax_tag ] ) && 1 == $wtl_settings[ 'display_' . $wtl_display_tax_tag ] ) || $social_share ) {
						?>
						<div class="tag-with-social <?php echo esc_attr( $social_share_wtl ); ?>">
							<?php
								Wtl_Template_Config::get_tags( $wtl_settings, false, true );
								Wp_Timeline_Main::wtl_get_social_icons( $wtl_settings );
							?>
						</div>
						<?php
					}
					?>
					<div class="wtl-post-content">
						<div class="wtl-post-content-inner">
							<?php Wtl_Template_Config::get_content( $wtl_settings ); ?>
						</div>
						<?php Wtl_Template_Config::get_read_more_link( $wtl_settings ); ?>
					</div>
					<div class="wtl-post-footer">
						<?php
						Wtl_Template_Config::get_read_more_link_2( $wtl_settings );
						Wtl_Template_Config::display_popup_excerpt( $wtl_settings );
						?>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
	<?php do_action( 'wtl_after_post_content' ); ?>
</div>
<?php
do_action( 'wtl_separator_after_post' );
