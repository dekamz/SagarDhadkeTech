<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/wp_timeline_templates/blog/cool-horizontal.php.
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
$post_type         = get_post_type( $post->ID );
do_action( 'wtl_before_post_content' ); ?>
<div class="wtl_blog_template wtl_blog_template horizontal blog-wrap lb-item" data-id="<?php echo get_the_date( 'd/m/Y' ); ?>" data-description="<?php echo esc_attr( get_the_title() ); ?>">
	<div class="post_hentry">
		<div class="post_content_wrap">
			<?php
			$label_featured_post = ( isset( $wtl_settings['label_featured_post'] ) && '' != $wtl_settings['label_featured_post'] ) ? $wtl_settings['label_featured_post'] : '';
			if ( '' != $label_featured_post && is_sticky() ) {
				?>
				<div class="label_featured_post"><span><?php echo esc_html( $label_featured_post ); ?></span></div> 
				<?php
			}
			Wtl_Template_Config::get_title( $wtl_settings );
			$display_date = $wtl_settings['display_date'];
			if ( 1 == $display_date ) {
				$date_link   = ( isset( $wtl_settings['disable_link_date'] ) && 1 == $wtl_settings['disable_link_date'] ) ? false : true;
				$date_format = ( isset( $wtl_settings['post_date_format'] ) && 'default' !== $wtl_settings['post_date_format'] ) ? $wtl_settings['post_date_format'] : get_option( 'date_format' );
				$wtl_date    = ( isset( $wtl_settings['display_date_from'] ) && 'modify' === $wtl_settings['display_date_from'] ) ? apply_filters( 'wtl_date_format', get_post_modified_time( $date_format, $post->ID ), $post->ID ) : apply_filters( 'wtl_date_format', get_the_time( $date_format, $post->ID ), $post->ID );
				$ar_year     = get_the_time( 'Y' );
				$ar_month    = get_the_time( 'm' );
				$ar_day      = get_the_time( 'd' );
				?>
				<div class="wtl-mdate">
					<i class="far fa-calendar-alt"></i>&nbsp;&nbsp;
					<?php
						echo ( $date_link ) ? '<a href="' . esc_url( get_day_link( $ar_year, $ar_month, $ar_day ) ) . '">' : '';
						echo esc_html( $wtl_date );
						echo ( $date_link ) ? '</a>' : '';
					?>
				</div>
				<?php
			}
			?>
		</div>
		<div class="post_wrapper box-blog">
			<?php
			$allowed_html = array(
				'img' => array(
					'class'   => array(),
					'id'      => array(),
					'src'     => array(),
					'title'   => array(),
					'alt'     => array(),
					'width'   => array(),
					'height'  => array(),
					'loading' => array(),
				),
			);
			if ( Wp_Timeline_Main::wtl_get_first_embed_media( $post->ID, $wtl_settings ) && 1 == $wtl_settings['rss_use_excerpt'] ) {
				?>
				<div class="post-image post-video">
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
			} elseif ( has_post_thumbnail() ) {
				$wp_timeline_post_image_link = ( isset( $wtl_settings['wp_timeline_post_image_link'] ) && 0 == $wtl_settings['wp_timeline_post_image_link'] ) ? false : true;
				$wp_timeline_enable_media    = ( isset( $wtl_settings['wp_timeline_enable_media'] ) && 0 == $wtl_settings['wp_timeline_enable_media'] ) ? false : true;
				if ( isset( $wp_timeline_enable_media ) && 1 == $wp_timeline_enable_media ) {
					?>
				<div class="photo post-image">
					<?php
					echo '<figure class="' . esc_attr( $image_hover_effect ) . '">';
					echo ( $wp_timeline_post_image_link ) ? '<a href="' . esc_url( get_permalink( $post->ID ) ) . '">' : '';
					$url          = wp_get_attachment_url( get_post_thumbnail_id() );
					$width        = isset( $wtl_settings['media_custom_width'] ) ? $wtl_settings['media_custom_width'] : 400;
					$height       = isset( $wtl_settings['media_custom_height'] ) ? $wtl_settings['media_custom_height'] : 200;
					$resize_image = WP_Timeline_Main::wp_timeline_resize( $width, $height, $url, true, get_post_thumbnail_id() );
					$post_thumbnail = $wtl_settings['wp_timeline_media_size'];
					$thumbnail      = wp_get_attachment_image( get_post_thumbnail_id(), $post_thumbnail );
					if ( $thumbnail ) {
						echo wp_kses( $thumbnail, $allowed_html );
					} else {
						echo '<img src="' . esc_url( $resize_image['url'] ) . '" width="' . esc_attr( $resize_image['width'] ) . '" height="' . esc_attr( $resize_image['height'] ) . '" title="' . esc_attr( $post->post_title ) . '" alt="' . esc_attr( $post->post_title ) . '" />';
					}
					echo ( $wp_timeline_post_image_link ) ? '</a>' : '';
					if ( isset( $wtl_settings['pinterest_image_share'] ) && 1 == $wtl_settings['pinterest_image_share'] && isset( $wtl_settings['social_share'] ) && 1 == $wtl_settings['social_share'] ) {
						echo wp_kses( Wp_Timeline_Main::wp_timeline_pinterest( $post->ID ), Wp_Timeline_Public::args_kses() );
					}
					if ( 'product' === $post_type && isset( $wtl_settings['display_sale_tag'] ) && 1 == $wtl_settings['display_sale_tag'] ) {
						$wp_timeline_sale_tagtext_alignment = ( isset( $wtl_settings['wp_timeline_sale_tagtext_alignment'] ) && '' != $wtl_settings['wp_timeline_sale_tagtext_alignment'] ) ? $wtl_settings['wp_timeline_sale_tagtext_alignment'] : 'left-top';
						echo '<div class="wtl_woo_sale_wrap ' . esc_attr( $wp_timeline_sale_tagtext_alignment ) . '">';
						do_action( 'wtl_woo_sale_tag' );
						echo '</div>';
					}
					if ( 1 == $wtl_settings['wp_timeline_lightbox'] ) {
						echo '<div class="img-overlay">
							<a rel="lightcase" data-rel="lightcase:my-slideshow" title="' . esc_attr( $post->post_title ) . '" class="open_up" href="' . esc_url( $resize_image['url'] ) . '"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
						</div>';
					}
					echo '</figure>';
					?>
				</div>
					<?php
				}
			} elseif ( isset( $wtl_settings['wp_timeline_default_image_id'] ) && '' != $wtl_settings['wp_timeline_default_image_id'] ) {
				$wp_timeline_post_image_link = ( isset( $wtl_settings['wp_timeline_post_image_link'] ) && 0 == $wtl_settings['wp_timeline_post_image_link'] ) ? false : true;
				?>
				<div class="photo post-image">
					<?php
						echo ( $wp_timeline_post_image_link ) ? '<a href="' . esc_url( get_permalink( $post->ID ) ) . '">' : '';
						$url          = wp_get_attachment_url( $wtl_settings['wp_timeline_default_image_id'] );
						$width        = isset( $wtl_settings['media_custom_width'] ) ? $wtl_settings['media_custom_width'] : 400;
						$height       = isset( $wtl_settings['media_custom_height'] ) ? $wtl_settings['media_custom_height'] : 200;
						$resize_image = WP_Timeline_Main::wp_timeline_resize( $width, $height, $url, true, $wtl_settings['wp_timeline_default_image_id'] );
						echo '<img  src="' . esc_url( $resize_image['url'] ) . '" width="' . esc_attr( $resize_image['width'] ) . '" height="' . esc_attr( $resize_image['height'] ) . '" title="' . esc_attr( $post->post_title ) . '" alt="' . esc_attr( $post->post_title ) . '" />';
						echo ( $wp_timeline_post_image_link ) ? '</a>' : '';

					if ( isset( $wtl_settings['pinterest_image_share'] ) && 1 == $wtl_settings['pinterest_image_share'] && isset( $wtl_settings['social_share'] ) && 1 == $wtl_settings['social_share'] ) {
						echo wp_kses( Wp_Timeline_Main::wp_timeline_pinterest( $post->ID ), Wp_Timeline_Public::args_kses() );
					}
					if ( 'product' === $post_type && isset( $wtl_settings['display_sale_tag'] ) && 1 == $wtl_settings['display_sale_tag'] ) {
						$wp_timeline_sale_tagtext_alignment = ( isset( $wtl_settings['wp_timeline_sale_tagtext_alignment'] ) && '' != $wtl_settings['wp_timeline_sale_tagtext_alignment'] ) ? $wtl_settings['wp_timeline_sale_tagtext_alignment'] : 'left-top';
						echo '<div class="wtl_woo_sale_wrap ' . esc_attr( $wp_timeline_sale_tagtext_alignment ) . '">';
						do_action( 'wtl_woo_sale_tag' );
						echo '</div>';
					}
					if ( 1 == $wtl_settings['wp_timeline_lightbox'] ) {
						echo '<div class="img-overlay">
							<a rel="lightcase" data-rel="lightcase:my-slideshow" title="' . esc_attr( $post->post_title ) . '" class="open_up" href="' . esc_url( $resize_image['url'] ) . '"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
						</div>';
					}
					?>
				</div>
				<?php
			} else {
				$wp_timeline_post_image_link = ( isset( $wtl_settings['wp_timeline_post_image_link'] ) && 0 == $wtl_settings['wp_timeline_post_image_link'] ) ? false : true;
				$wp_timeline_enable_media    = ( isset( $wtl_settings['wp_timeline_enable_media'] ) && 0 == $wtl_settings['wp_timeline_enable_media'] ) ? false : true;
				if ( isset( $wp_timeline_enable_media ) && 1 == $wp_timeline_enable_media ) {
					?>
				<div class="photo post-image">
					<?php
					echo ( $wp_timeline_post_image_link ) ? '<a href="' . esc_url( get_permalink( $post->ID ) ) . '">' : '';
					$url          = WTL_URL . '/images/no_available_image_900.gif';
					$width        = isset( $wtl_settings['item_width'] ) ? $wtl_settings['item_width'] : 400;
					$height       = isset( $wtl_settings['item_height'] ) ? $wtl_settings['item_height'] : 200;
					$resize_image = WP_Timeline_Main::wp_timeline_resize( $width, $height, $url, true );
					echo '<img  src="' . esc_url( $resize_image['url'] ) . '" width="' . esc_attr( $resize_image['width'] ) . '" height="' . esc_attr( $resize_image['height'] ) . '" title="' . esc_attr( $post->post_title ) . '" alt="' . esc_attr( $post->post_title ) . '" />';
					echo ( $wp_timeline_post_image_link ) ? '</a>' : '';
					if ( isset( $wtl_settings['pinterest_image_share'] ) && 1 == $wtl_settings['pinterest_image_share'] && isset( $wtl_settings['social_share'] ) && 1 == $wtl_settings['social_share'] ) {
						echo wp_kses( Wp_Timeline_Main::wp_timeline_pinterest( $post->ID ), Wp_Timeline_Public::args_kses() );
					}
					if ( 1 == $wtl_settings['wp_timeline_lightbox'] ) {
						echo '<div class="img-overlay">
							<a rel="lightcase" data-rel="lightcase:my-slideshow" title="' . esc_attr( $post->post_title ) . '" class="open_up" href="' . esc_url( $resize_image['url'] ) . '"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
						</div>';
					}
					?>
				</div>
					<?php
				}
			}
			?>
			<div class="post-content-area">
				<div class="metadatabox">
					<?php
					if ( 1 == $wtl_settings['display_author'] ) {
						$author_link = ( isset( $wtl_settings['disable_link_author'] ) && 1 == $wtl_settings['disable_link_author'] ) ? false : true;
						?>
						<span class="wtl-author <?php echo ( $author_link ) ? 'wtl_has_link' : 'wtl_no_link'; ?>">
							<span class="wtl-author-name">
								<i class="fas fa-user"></i><?php echo wp_kses( Wp_Timeline_Main::wtl_get_post_auhtors( $post->ID, $wtl_settings ), Wp_Timeline_Public::args_kses() ); ?>
							</span>
						</span>
						<?php
					}
					Wtl_Template_Config::get_comment( $wtl_settings );
					if ( isset( $wtl_settings['display_postlike'] ) && 1 == $wtl_settings['display_postlike'] ) {
						echo do_shortcode( '[likebtn_shortcode]' );
					}
					?>
				</div>
			<div class="wtl-post_content">
				<?php
				echo wp_kses( Wp_Timeline_Main::wtl_get_content( $post->ID, $wtl_settings, $wtl_settings['rss_use_excerpt'], $wtl_settings['txtExcerptlength'] ), Wp_Timeline_Public::args_kses() );
				$read_more_link = isset( $wtl_settings['read_more_link'] ) ? $wtl_settings['read_more_link'] : 1;
				$read_more_on   = isset( $wtl_settings['read_more_on'] ) ? $wtl_settings['read_more_on'] : 2;
				if ( 1 == $read_more_link && 1 == $wtl_settings['rss_use_excerpt'] ) {
					$readmoretxt = '' != $wtl_settings['txtReadmoretext'] ? $wtl_settings['txtReadmoretext'] : esc_html__( 'Read More', 'wp-timeline-designer-pro' );
					$post_link   = get_permalink( $post->ID );
					if ( isset( $wtl_settings['post_link_type'] ) && 1 == $wtl_settings['post_link_type'] ) {
						$post_link = ( isset( $wtl_settings['custom_link_url'] ) && '' != $wtl_settings['custom_link_url'] ) ? $wtl_settings['custom_link_url'] : get_permalink( $post->ID );
					}
					if ( 1 == $read_more_on ) {
						echo '<div class="wtl-read-more-div"><a class="wtl-read-more" href="' . esc_url( $post_link ) . '">' . esc_html( $readmoretxt ) . ' </a></div>';
					}
				}
				?>
			</div>
			<?php
			if ( 2 == $read_more_on && 1 == $read_more_link && 1 == $wtl_settings['rss_use_excerpt'] ) {
				echo '<div class="wtl-read-more-div"><a class="wtl-read-more" href="' . esc_url( $post_link ) . '">' . esc_html( $readmoretxt ) . ' </a></div>';
			}
			Wtl_Template_Config::get_post_details( $wtl_settings );
			?>
			<div class="wtl-post-footer">
				<?php
				echo wp_kses( Wtl_Template_Config::get_category( $wtl_settings, true, true ), Wp_Timeline_Public::args_kses() );
				Wtl_Template_Config::get_tags( $wtl_settings, true, true );
				Wp_Timeline_Main::wtl_get_social_icons( $wtl_settings );
				?>
			</div>
		</div>
	</div>
</div>
</div>
<?php do_action( 'wtl_after_post_content' ); ?>
<?php do_action( 'wtl_separator_after_post' ); ?>
