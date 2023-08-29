<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/wp_timeline_templates/blog/accordion.php.
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
?>
<div class="wtl_blog_template blog_template accordion wtl_single_post_wrapp <?php echo esc_attr( Wtl_Template_Config::get_class_category( $wtl_settings ) ); ?>">
	<?php do_action( 'wtl_before_post_content' ); ?>
	<div class="wtl-accordion-wrap">
		<div class="wtl-accordion-meta-content" data-aos="<?php echo esc_attr( $wtl_animation ); ?>">
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

			if ( isset( $wtl_settings['custom_post_type'] ) && in_array( $wtl_settings['custom_post_type'], $wtl_all_post_type, true ) ) {
				$wtl_tax_tag         = '';
				$wtl_display_tax_tag = '';
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
			}
			?>
		</div>
		<div class="wtl-accordion-post-content" data-aos="<?php echo esc_attr( $wtl_animation ); ?>">
			<div class="wtl-accordion-circle"></div>
			<div class="wtl-accordion-meta-content date-mobile-only" data-aos="<?php echo esc_attr( $wtl_animation ); ?>">
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
				echo esc_html( gmdate( 'Y' ) );
				echo ( $date_link ) ? '</a>' : '';

				echo '</div>';
			}

			if ( isset( $wtl_settings['custom_post_type'] ) && in_array( $wtl_settings['custom_post_type'], $wtl_all_post_type, true ) ) {
				$wtl_tax_tag         = '';
				$wtl_display_tax_tag = '';
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
			}
			?>
		</div>
			<div class="wtl-accordion-head-content">
			<?php
				$label_featured_post = ( isset( $wtl_settings['label_featured_post'] ) && '' != $wtl_settings['label_featured_post'] ) ? $wtl_settings['label_featured_post'] : '';
			if ( '' != $label_featured_post && is_sticky() ) {
				?>
					<div class="label_featured_post"><?php echo esc_html( $label_featured_post ); ?></div> 
					<?php
			}
				Wtl_Template_Accordion_Layout::get_title( $wtl_settings );
			?>
			<div class="wtl-accordion-inner inner-first">
				<?php
				Wtl_Template_Config::get_post_image( $wtl_settings );
				Wtl_Template_Config::get_post_details( $wtl_settings );
				?>
				<div class="wtl-accordion-all-post-content <?php echo empty( $thumbnail ) ? 'wtl_post_content_accordion' : ''; ?>">
				<div class="wtl-post-content">
						<?php
						Wtl_Template_Config::get_content( $wtl_settings );
						Wtl_Template_Config::get_read_more_link( $wtl_settings );
						?>
				</div>
					<?php echo '<div class="admin-comment">'; ?>
					<?php
						Wtl_Template_Config::get_author( $wtl_settings );
						Wtl_Template_Config::get_comment( $wtl_settings );
					if ( isset( $wtl_settings['display_postlike'] ) && 1 == $wtl_settings['display_postlike'] ) {
						echo do_shortcode( '[likebtn_shortcode]' );
					}
					?>
					<?php echo '</div>'; ?>
					<?php
					Wtl_Template_Config::get_category( $wtl_settings, true, true );
					Wtl_Template_Config::get_tags( $wtl_settings, true, true );
					?>
					<div class="tag-with-social">
						<?php
							Wp_Timeline_Main::wtl_get_social_icons( $wtl_settings );
						?>
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
