<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/wp_timeline_templates/blog/overlay-horizontal.php.
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
?>
<div class="blog_template wtl_blog_template overlay_horizontal blog-wrap lb-item" data-id="<?php echo get_the_date( 'd/m/Y' ); ?>" data-description="<?php echo esc_attr( get_the_title() ); ?>">
	<?php do_action( 'wtl_before_post_content' ); ?>
	<div class="post_hentry">
		<div class="post_content_wrap">
			<?php
			$label_featured_post = ( isset( $wtl_settings['label_featured_post'] ) && '' != $wtl_settings['label_featured_post'] ) ? $wtl_settings['label_featured_post'] : '';
			if ( '' != $label_featured_post && is_sticky() ) {
				?>
				<div class="label_featured_post"><?php echo esc_html( $label_featured_post ); ?></div> 
				<?php
			}
			if ( class_exists( 'woocommerce' ) && 'product' === $wtl_settings['custom_post_type'] ) {
				if ( isset( $wtl_settings['display_sale_tag'] ) && 1 == $wtl_settings['display_sale_tag'] ) {
					$wp_timeline_sale_tagtext_alignment = ( isset( $wtl_settings['wp_timeline_sale_tagtext_alignment'] ) && '' != $wtl_settings['wp_timeline_sale_tagtext_alignment'] ) ? $wtl_settings['wp_timeline_sale_tagtext_alignment'] : 'left-top';
					echo '<div class="wtl_woo_sale_wrap ' . esc_attr( $wp_timeline_sale_tagtext_alignment ) . '">';
					do_action( 'wtl_woo_sale_tag' );
					echo '</div>';
				}
			}
			?>
			<div class="photo post-image">
				<?php
				if ( Wp_Timeline_Main::wtl_get_first_embed_media( $post->ID, $wtl_settings ) && 1 == $wtl_settings['rss_use_excerpt'] ) {
					?>
					<div class="wp-timeline-post-image post-video">
						<?php
						if ( 'quote' === get_post_format() ) {
							if ( has_post_thumbnail() ) {
								$post_thumbnail = 'full';
								$thumbnail      = Wp_Timeline_Main::wtl_get_the_thumbnail( $wtl_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID );
								echo wp_kses( apply_filters( 'wp_timeline_post_thumbnail_filter', $thumbnail, $post->ID ), Wp_Timeline_Public::args_kses() );
								echo '<div class="upper_image_wrapper">';
								echo wp_kses( Wp_Timeline_Main::wtl_get_first_embed_media( $post->ID, $wtl_settings ), Wp_Timeline_Public::args_kses() );
								echo '</div>';
							}
						} elseif ( 'link' === get_post_format() ) {
							if ( has_post_thumbnail() ) {
								$post_thumbnail = 'full';
								$thumbnail      = Wp_Timeline_Main::wtl_get_the_thumbnail( $wtl_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID );
								echo wp_kses( apply_filters( 'wp_timeline_post_thumbnail_filter', $thumbnail, $post->ID ), Wp_Timeline_Public::args_kses() );
								echo '<div class="upper_image_wrapper wtl_link_post_format">';
								echo wp_kses( Wp_Timeline_Main::wtl_get_first_embed_media( $post->ID, $wtl_settings ), Wp_Timeline_Public::args_kses() );
								echo '</div>';
							}
						} else {
							echo wp_kses( Wp_Timeline_Main::wtl_get_first_embed_media( $post->ID, $wtl_settings ), Wp_Timeline_Public::args_kses() );
						}
						?>
					</div>
					<?php
				} else {
					if ( has_post_thumbnail() ) {
						?>
						<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>">
							<?php
							$url          = wp_get_attachment_url( get_post_thumbnail_id() );
							$width        = isset( $wtl_settings['item_width'] ) ? $wtl_settings['item_width'] : 400;
							$height       = isset( $wtl_settings['item_height'] ) ? $wtl_settings['item_height'] : 570;
							$resize_image = Wp_Timeline_Main::wp_timeline_resize( $width, $height, $url, true, get_post_thumbnail_id() );
							echo '<img src="' . esc_url( $resize_image['url'] ) . '" width="' . esc_attr( $resize_image['width'] ) . '" height="' . esc_attr( $resize_image['height'] ) . '" title="' . esc_attr( $post->post_title ) . '" alt="' . esc_attr( $post->post_title ) . '" />';
							?>
						</a>
						<?php
						if ( isset( $wtl_settings['pinterest_image_share'] ) && 1 == $wtl_settings['pinterest_image_share'] && isset( $wtl_settings['social_share'] ) && 1 == $wtl_settings['social_share'] ) {
							echo wp_kses( Wp_Timeline_Main::wp_timeline_pinterest( $post->ID ), Wp_Timeline_Public::args_kses() );
						}
						?>
						<?php
					} elseif ( isset( $wtl_settings['wp_timeline_default_image_id'] ) && '' != $wtl_settings['wp_timeline_default_image_id'] ) {
						?>
						<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>">
							<?php
							$url          = wp_get_attachment_url( $wtl_settings['wp_timeline_default_image_id'] );
							$width        = isset( $wtl_settings['item_width'] ) ? $wtl_settings['item_width'] : 400;
							$height       = isset( $wtl_settings['item_height'] ) ? $wtl_settings['item_height'] : 570;
							$resize_image = Wp_Timeline_Main::wp_timeline_resize( $width, $height, $url, true, $wtl_settings['wp_timeline_default_image_id'] );
							echo '<img src="' . esc_url( $resize_image['url'] ) . '" width="' . esc_attr( $resize_image['width'] ) . '" height="' . esc_attr( $resize_image['height'] ) . '" title="' . esc_attr( $post->post_title ) . '" alt="' . esc_attr( $post->post_title ) . '" />';
							?>
						</a>
						<?php
					}else{
						?>
						<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>">
							<?php
							$url          = WTL_URL . '/images/no_available_image_900.gif';
							$width        = isset( $wtl_settings['item_width'] ) ? $wtl_settings['item_width'] : 400;
							$height       = isset( $wtl_settings['item_height'] ) ? $wtl_settings['item_height'] : 570;
							$resize_image = Wp_Timeline_Main::wp_timeline_resize( $width, $height, $url, true, get_post_thumbnail_id() );
							echo '<img src="' . esc_url( $resize_image['url'] ) . '" width="' . esc_attr( $resize_image['width'] ) . '" height="' . esc_attr( $resize_image['height'] ) . '" title="' . esc_attr( $post->post_title ) . '" alt="' . esc_attr( $post->post_title ) . '" />';
							?>
						</a>
						<?php
						if ( isset( $wtl_settings['pinterest_image_share'] ) && 1 == $wtl_settings['pinterest_image_share'] && isset( $wtl_settings['social_share'] ) && 1 == $wtl_settings['social_share'] ) {
							echo wp_kses( Wp_Timeline_Main::wp_timeline_pinterest( $post->ID ), Wp_Timeline_Public::args_kses() );
						}
						?>
						<?php
					}
					if ( 1 == $wtl_settings['wp_timeline_lightbox'] ) {
						echo '<div class="img-overlay">
							<a rel="lightcase" data-rel="lightcase:my-slideshow" title="' . esc_attr( $post->post_title ) . '" class="open_up" href="' . esc_url( $resize_image['url'] ) . '"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
						</div>';
					}
				}
				?>
			</div>
			<div class="lb-overlay"> </div>
			<div class="post-content-area">
				<div class="metadatabox">
					<?php
					$display_date = $wtl_settings['display_date'];
					if ( 1 == $display_date ) {
						$date_link   = ( isset( $wtl_settings['disable_link_date'] ) && 1 == $wtl_settings['disable_link_date'] ) ? false : true;
						$date_format = ( isset( $wtl_settings['post_date_format'] ) && 'default' !== $wtl_settings['post_date_format'] ) ? $wtl_settings['post_date_format'] : get_option( 'date_format' );
						$wtl_date    = ( isset( $wtl_settings['display_date_from'] ) && 'modify' === $wtl_settings['display_date_from'] ) ? apply_filters( 'wtl_date_format', get_post_modified_time( $date_format, $post->ID ), $post->ID ) : apply_filters( 'wtl_date_format', get_the_time( $date_format, $post->ID ), $post->ID );
						$ar_year     = get_the_time( 'Y' );
						$ar_month    = get_the_time( 'm' );
						$ar_day      = get_the_time( 'd' );
						?>
						<span class="mdate">
							<?php
							echo ( $date_link ) ? '<a href="' . esc_url( get_day_link( $ar_year, $ar_month, $ar_day ) ) . '">' : '';
							echo '<i class="far fa-calendar-alt"></i>';
							echo esc_html( $wtl_date );
							echo ( $date_link ) ? '</a>' : '';
							?>
						</span>
						<?php
					}
					Wtl_Template_Config::get_author( $wtl_settings );
					Wtl_Template_Config::get_comment( $wtl_settings );
					if ( isset( $wtl_settings['display_postlike'] ) && 1 == $wtl_settings['display_postlike'] ) {
						echo do_shortcode( '[likebtn_shortcode]' );
					}
					?>
				</div>
				<?php
				Wtl_Template_Config::get_title( $wtl_settings );
				?>
				<div class="wtl-post-content">
					<?php
					Wtl_Template_Config::get_content( $wtl_settings );
					Wtl_Template_Config::get_read_more_link( $wtl_settings );
					Wtl_Template_Config::get_read_more_link_2( $wtl_settings );
					Wtl_Template_Config::display_popup_excerpt( $wtl_settings );
					Wtl_Template_Config::get_post_details( $wtl_settings );
					?>
				</div>
				<div class="wtl-post-footer">
					<?php
					Wtl_Template_Config::get_category( $wtl_settings, true, true );
					Wtl_Template_Config::get_tags( $wtl_settings, true, true );
					Wp_Timeline_Main::wtl_get_social_icons( $wtl_settings );
					?>
				</div>
			</div>
		</div>
	</div>
<?php do_action( 'wtl_after_post_content' ); ?>
</div>
<?php
do_action( 'wtl_separator_after_post' );
