<?php
/**
 * The template-config functionality of the plugin.
 *
 * @link       https://www.solwininfotech.com/
 * @since      1.0.0
 *
 * @package    Wp_Timeline_Designer_PRO
 * @subpackage Wp_Timeline_Designer_PRO/wp_timeline_templates
 */

/**
 * This class contain template configuration of template.
 *
 * @package    Wp_Timeline_Designer_PRO
 * @subpackage Wp_Timeline_Designer_PRO/wp_timeline_templates
 * @author     Solwin Infotech <info@solwininfotech.com>
 */
class Wtl_Template_Collapsible_Layout {
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
	}

	/**
	 * Template Render
	 *
	 * @param array $layout_id settings arrray.
	 * @param array $wtl_settings settings arrray.
	 * @param array $template_wrapper settings arrray.
	 * @return html
	 */
	public static function render( $layout_id, $wtl_settings, $template_wrapper ) {
		$out  = '';
		$out .= '<div class="wtl_wrapper wp_timeline_post_list schedule_cover collapsible_layout layout_id_' . $layout_id . ' wtl_story_layout" id="wtl_story_layout" >';
		$out .= '<div class="wtl_template story story_wrapper">';
		$out .= $template_wrapper;
		$out .= '</div>';
		$out .= '</div>';
		return $out;
	}

	/**
	 * Get Post Image
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return void
	 */
	public static function get_post_image( $wtl_settings ) {
		global $post;
		$post_type    = get_post_type( $post->ID );
		$format       = get_post_format( $post->ID );
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
		if ( isset( $wtl_settings['wp_timeline_lazy_load_image'] ) && 1 == $wtl_settings['wp_timeline_lazy_load_image'] ) {
			add_filter( 'wp_get_attachment_image_attributes', 'lazyload_images_modify_post_thumbnail_attr', 10, 3 );
		}
		$is_aside = 'aside' === $format ? 'wtl_post_aside' : '';
		if ( isset( $wtl_settings['wp_timeline_enable_media'] ) ? $wtl_settings['wp_timeline_enable_media'] : '' ) {
			if ( isset( $wtl_settings['wp_timeline_image_hover_effect'] ) && 1 == $wtl_settings['wp_timeline_image_hover_effect'] ) {
				$image_hover_effect = ( isset( $wtl_settings['wp_timeline_image_hover_effect_type'] ) && '' != $wtl_settings['wp_timeline_image_hover_effect_type'] ) ? $wtl_settings['wp_timeline_image_hover_effect_type'] : '';
			} else {
				$image_hover_effect = '';
			}
			$thumbnail            = Wp_Timeline_Main::wtl_get_the_thumbnail( $wtl_settings, 'full', get_post_thumbnail_id(), $post->ID );
			$wp_timeline_lightbox = isset( $wtl_settings['wp_timeline_lightbox'] ) ? $wtl_settings['wp_timeline_lightbox'] : '';
			$single_settings      = get_post_meta( $post->ID, '_wtl_single_details_key', true );
			$thumbnail_type       = isset( $single_settings['wtl_thumbnail_type'] ) ? $single_settings['wtl_thumbnail_type'] : '';
			$video_type           = isset( $single_settings['wtl_single_video_type'] ) ? $single_settings['wtl_single_video_type'] : '';
			$video_id             = isset( $single_settings['wtl_single_video_id'] ) ? $single_settings['wtl_single_video_id'] : '';
			$audio_type           = isset( $single_settings['wtl_single_audio_type'] ) ? $single_settings['wtl_single_audio_type'] : '';
			$audio_id             = isset( $single_settings['wtl_single_audio_id'] ) ? $single_settings['wtl_single_audio_id'] : '';
			if ( ! empty( $thumbnail_type ) ) {
				echo '<div class="schedule-image-wrapper wtl-post-thumbnail">';
				if ( ! empty( $thumbnail_type ) ) {
					if ( 'video' == $thumbnail_type && 'youtube' == $video_type ) {
						$first_value = $video_id;
						echo '<iframe src="https://www.youtube.com/embed/' . esc_attr( $first_value ) . '"></iframe>';
					} elseif ( 'video' == $thumbnail_type && 'html5' == $video_type ) {
						$first_value = $video_id;
						echo '<iframe src="' . esc_url( $first_value ) . '"></iframe>';
					} elseif ( 'video' == $thumbnail_type && 'vimeo' == $video_type ) {
						$first_value = $video_id;
						echo '<iframe src="https://player.vimeo.com/video/' . esc_attr( $first_value ) . '"></iframe>';
					} elseif ( 'video' == $thumbnail_type && 'screenr' == $video_type ) {
						$first_value = $video_id;
						echo '<iframe src="https://www.screenr.com/embed/' . esc_attr( $first_value ) . '"></iframe>';
					} elseif ( 'video' == $thumbnail_type && 'dailymotion' == $video_type ) {
						$first_value = $video_id;
						echo '<iframe src="https://www.dailymotion.com/embed/video/' . esc_attr( $first_value ) . '"></iframe>';
					} elseif ( 'video' == $thumbnail_type && 'metacafe' == $video_type ) {
						$first_value = $video_id;
						echo '<iframe src="https://www.metacafe.com/embed/' . esc_attr( $first_value ) . '"></iframe>';
					} elseif ( 'audio' == $thumbnail_type && 'soundcloud' == $audio_type ) {
						$first_value = 'https://w.soundcloud.com/player/?url=http://api.soundcloud.com/tracks/' . $audio_id;
						echo '<iframe src="' . esc_url( $first_value ) . '" data-src="' . esc_attr( $first_value ) . '" width="100%" height="100%" ></iframe>';
					} elseif ( 'audio' == $thumbnail_type && 'mixcloud' == $audio_type ) {
						$first_value = 'https://www.mixcloud.com/widget/iframe/?feed=' . $audio_id;
						echo '<iframe src="' . esc_url( $first_value ) . '" data-src="' . esc_attr( $first_value ) . '" width="100%" height="100%" ></iframe>';
					} elseif ( 'audio' == $thumbnail_type && 'beatport' == $audio_type ) {
						$first_value = 'https://embed.beatport.com/?id=' . $audio_id . '&type=track';
						echo '<iframe src="' . esc_url( $first_value ) . '" data-src="' . esc_attr( $first_value ) . '" width="100%" height="100%" ></iframe>';
					}
				}
				echo '</div>';
			} elseif ( empty( $thumbnail_type ) ) {
				if ( isset( $thumbnail ) && ! empty( $thumbnail ) ) {
					echo '<div class="schedule-image-wrapper wtl-post-thumbnail">';
					/* [1] Check if Embed Media ---------- */
					if ( Wp_Timeline_Main::wtl_get_first_embed_media( $post->ID, $wtl_settings ) && 1 == $wtl_settings['rss_use_excerpt'] ) {
						echo '<div class="wp-timeline-post-image post-image post-video wp-timeline-video">';
						if ( 'quote' === get_post_format() ) {
							if ( has_post_thumbnail() ) {
								echo wp_kses( apply_filters( 'wp_timeline_post_thumbnail_filter', $thumbnail, $post->ID ), Wp_Timeline_Public::args_kses() );
								echo '<div class="upper_image_wrapper">';
								echo wp_kses( Wp_Timeline_Main::wtl_get_first_embed_media( $post->ID, $wtl_settings ), Wp_Timeline_Public::args_kses() );
								echo '</div>';
							}
						} elseif ( 'link' === get_post_format() ) {
							if ( has_post_thumbnail() ) {
								echo wp_kses( apply_filters( 'wp_timeline_post_thumbnail_filter', $thumbnail, $post->ID ), Wp_Timeline_Public::args_kses() );
								echo '<div class="upper_image_wrapper wp_timeline_link_post_format">';
								echo wp_kses( Wp_Timeline_Main::wtl_get_first_embed_media( $post->ID, $wtl_settings ), Wp_Timeline_Public::args_kses() );
								echo '</div>';
							}
						} else {
							echo wp_kses( Wp_Timeline_Main::wtl_get_first_embed_media( $post->ID, $wtl_settings ), Wp_Timeline_Public::args_kses() );
						}
						echo '</div>';
						/* [2] If there is thumbnail ---------- */
					} elseif ( has_post_thumbnail() ) {
						$wp_timeline_post_image_link = ( isset( $wtl_settings['wp_timeline_post_image_link'] ) && 0 == $wtl_settings['wp_timeline_post_image_link'] ) ? false : true;
						?>
					<div class="wp-timeline-post-image post-image photo post-image <?php echo esc_attr( $is_aside ); ?>">
						<?php
						echo '<figure class="' . esc_attr( $image_hover_effect ) . '">';
						echo ( $wp_timeline_post_image_link ) ? '<a href="' . esc_url( get_permalink( $post->ID ) ) . '">' : '';
						$url          = wp_get_attachment_url( get_post_thumbnail_id() );
						$width        = isset( $wtl_settings['item_width'] ) ? $wtl_settings['item_width'] : 400;
						$height       = isset( $wtl_settings['item_height'] ) ? $wtl_settings['item_height'] : 200;
						$resize_image = WP_Timeline_Main::wp_timeline_resize( $width, $height, $url, true, get_post_thumbnail_id() );
						if ( $thumbnail ) {
							echo wp_kses( $thumbnail, $allowed_html );
						} else {
							echo '<img src="' . esc_url( $resize_image['url'] ) . '" width="' . esc_attr( $resize_image['width'] ) . '" height="' . esc_attr( $resize_image['height'] ) . '" title="' . esc_attr( $post->post_title ) . '" alt="' . esc_attr( $post->post_title ) . '" />';
						}

						echo ( $wp_timeline_post_image_link ) ? '</a>' : '';
						// check if pintereset enabled.
						if ( isset( $wtl_settings['pinterest_image_share'] ) && 1 == $wtl_settings['pinterest_image_share'] && isset( $wtl_settings['social_share'] ) && 1 == $wtl_settings['social_share'] ) {
							echo wp_kses( Wp_Timeline_Main::wp_timeline_pinterest( $post->ID ), Wp_Timeline_Public::args_kses() );
						}
						if ( 'product' === $post_type && isset( $wtl_settings['display_sale_tag'] ) && 1 == $wtl_settings['display_sale_tag'] ) {
							$wp_timeline_sale_tagtext_alignment = ( isset( $wtl_settings['wp_timeline_sale_tagtext_alignment'] ) && '' != $wtl_settings['wp_timeline_sale_tagtext_alignment'] ) ? $wtl_settings['wp_timeline_sale_tagtext_alignment'] : 'left-top';
							echo '<div class="wtl_woo_sale_wrap ' . esc_attr( $wp_timeline_sale_tagtext_alignment ) . '">';
							do_action( 'wtl_woo_sale_tag' );
							echo '</div>';
						}
						if ( 1 == $wp_timeline_lightbox ) {
							echo '<div class="img-overlay">
								<a rel="lightcase" data-rel="lightcase:my-slideshow" title="' . esc_attr( $post->post_title ) . '" class="open_up" href="' . esc_url( $resize_image['url'] ) . '"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
							</div>';
						}
						echo '</figure>';
						?>
					</div>
						<?php
						/* [3] check if is it default image ---------- */
					} elseif ( isset( $wtl_settings['wp_timeline_default_image_id'] ) && '' != $wtl_settings['wp_timeline_default_image_id'] ) {
						$wp_timeline_post_image_link = ( isset( $wtl_settings['wp_timeline_post_image_link'] ) && 0 == $wtl_settings['wp_timeline_post_image_link'] ) ? false : true;
						?>
					<div class="wp-timeline-post-image post-image photo <?php echo esc_attr( $is_aside ); ?>">
						<?php
							echo ( $wp_timeline_post_image_link ) ? '<a href="' . esc_url( get_permalink( $post->ID ) ) . '">' : '';
							$url            = wp_get_attachment_url( $wtl_settings['wp_timeline_default_image_id'] );
							$width          = isset( $wtl_settings['item_width'] ) ? $wtl_settings['item_width'] : 400;
							$height         = isset( $wtl_settings['item_height'] ) ? $wtl_settings['item_height'] : 200;
							$resize_image   = WP_Timeline_Main::wp_timeline_resize( $width, $height, $url, true, $wtl_settings['wp_timeline_default_image_id'] );
							$post_thumbnail = $wtl_settings['wp_timeline_media_size'];
							$thumbnail      = wp_get_attachment_image( $wtl_settings['wp_timeline_default_image_id'], $post_thumbnail );
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
						if ( 1 == $wp_timeline_lightbox ) {
							echo '<div class="img-overlay">
								<a rel="lightcase" data-rel="lightcase:my-slideshow" title="' . esc_attr( $post->post_title ) . '" class="open_up" href="' . esc_url( $resize_image['url'] ) . '"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
							</div>';
						}
						?>
					</div>
						<?php
					} else {
						$wp_timeline_post_image_link = ( isset( $wtl_settings['wp_timeline_post_image_link'] ) && 0 == $wtl_settings['wp_timeline_post_image_link'] ) ? false : true;
						?>
					<div class="wp-timeline-post-image post-image photo post-image <?php echo esc_attr( $is_aside ); ?>">
						<?php
						echo ( $wp_timeline_post_image_link ) ? '<a href="' . esc_url( get_permalink( $post->ID ) ) . '">' : '';
						$url          = WTL_URL . '/images/no_available_image_900.gif';
						$width        = isset( $wtl_settings['item_width'] ) ? $wtl_settings['item_width'] : 400;
						$height       = isset( $wtl_settings['item_height'] ) ? $wtl_settings['item_height'] : 200;
						$resize_image = WP_Timeline_Main::wp_timeline_resize( $width, $height, $url, true );
						echo '<img src="' . esc_url( $resize_image['url'] ) . '" width="' . esc_attr( $resize_image['width'] ) . '" height="' . esc_attr( $resize_image['height'] ) . '" title="' . esc_attr( $post->post_title ) . '" alt="' . esc_attr( $post->post_title ) . '" />';
						echo ( $wp_timeline_post_image_link ) ? '</a>' : '';
						if ( isset( $wtl_settings['pinterest_image_share'] ) && 1 == $wtl_settings['pinterest_image_share'] && isset( $wtl_settings['social_share'] ) && 1 == $wtl_settings['social_share'] ) {
							echo wp_kses( Wp_Timeline_Main::wp_timeline_pinterest( $post->ID ), Wp_Timeline_Public::args_kses() );
						}
						if ( 1 == $wp_timeline_lightbox ) {
							echo '<div class="img-overlay">
								<a rel="lightcase" data-rel="lightcase:my-slideshow" title="' . esc_attr( $post->post_title ) . '" class="open_up" href="' . esc_url( $resize_image['url'] ) . '"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
							</div>';
						}
						?>
					</div>
						<?php
					}
					echo '</div>';
				} else {
					$wp_timeline_post_image_link = ( isset( $wtl_settings['wp_timeline_post_image_link'] ) && 0 == $wtl_settings['wp_timeline_post_image_link'] ) ? false : true;
					$wp_timeline_enable_media    = ( isset( $wtl_settings['wp_timeline_enable_media'] ) && 0 == $wtl_settings['wp_timeline_enable_media'] ) ? false : true;
					if ( isset( $wp_timeline_enable_media ) && 1 == $wp_timeline_enable_media ) {
						echo '<div class="schedule-image-wrapper wtl-post-thumbnail">';
						$wp_timeline_post_image_link = ( isset( $wtl_settings['wp_timeline_post_image_link'] ) && 0 == $wtl_settings['wp_timeline_post_image_link'] ) ? false : true;
						?>
					<div class="wp-timeline-post-image post-image photo post-image <?php echo esc_attr( $is_aside ); ?>">
						<figure class="<?php esc_attr( $image_hover_effect ); ?>">
							<?php
							echo ( $wp_timeline_post_image_link ) ? '<a href="' . esc_url( get_permalink( $post->ID ) ) . '">' : '';
							$url          = WTL_URL . '/images/no_available_image_900.gif';
							$width        = isset( $wtl_settings['item_width'] ) ? $wtl_settings['item_width'] : 400;
							$height       = isset( $wtl_settings['item_height'] ) ? $wtl_settings['item_height'] : 200;
							$resize_image = WP_Timeline_Main::wp_timeline_resize( $width, $height, $url, true );
							echo '<img src="' . esc_url( $resize_image['url'] ) . '" width="' . esc_attr( $resize_image['width'] ) . '" height="' . esc_attr( $resize_image['height'] ) . '" title="' . esc_attr( $post->post_title ) . '" alt="' . esc_attr( $post->post_title ) . '" />';
							echo ( $wp_timeline_post_image_link ) ? '</a>' : '';
							if ( isset( $wtl_settings['pinterest_image_share'] ) && 1 == $wtl_settings['pinterest_image_share'] && isset( $wtl_settings['social_share'] ) && 1 == $wtl_settings['social_share'] ) {
								echo wp_kses( Wp_Timeline_Main::wp_timeline_pinterest( $post->ID ), Wp_Timeline_Public::args_kses() );
							}
							if ( 1 == $wp_timeline_lightbox ) {
								echo '<div class="img-overlay">
									<a rel="lightcase" data-rel="lightcase:my-slideshow" title="' . esc_attr( $post->post_title ) . '" class="open_up" href="' . esc_url( $resize_image['url'] ) . '"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
								</div>';
							}
							?>
						</figure>
					</div>
						<?php
						echo '</div>';
					}
				}
			}
		}
	}
}

$wtl_template_collapsible_layout = new Wtl_Template_Collapsible_Layout();
