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
class Wtl_Template_Columy_Layout {
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
	}

	/**
	 * Get Heading
	 *
	 * @param array $layout_id settings arrray.
	 * @param array $wtl_settings settings arrray.
	 * @param array $template_wrapper settings arrray.
	 * @return html
	 */
	public static function render( $layout_id, $wtl_settings, $template_wrapper ) {
		$hide_timeline_icon = isset( $wtl_settings['hide_timeline_icon'] ) ? $wtl_settings['hide_timeline_icon'] : 0;
		$slider_class       = 'wtl_is_horizontal';

		$out  = '';
		$out .= self::js( $wtl_settings );
		$out .= '<div class="wtl_wrapper wp_timeline_post_list columy_layout layout_id_' . $layout_id . ' ' . $slider_class . '">';
		$out .= '<div class="wtl_blog_template blog_template schedule wtl_single_post_wrapp">';
		$out .= '<div class="wtl-schedule-wrap">';
		$out .= $template_wrapper;
		$out .= '</div>';
		$out .= '</div>';
		$out .= '</div>';
		return $out;
	}

	/**
	 * Get Post Date
	 *
	 * @param array   $wtl_settings settings arrray.
	 * @param boolean $show_icon show icon.
	 * @return html
	 */
	public static function get_post_date( $wtl_settings, $show_icon ) {
		global $post;
		if ( isset( $wtl_settings['display_date'] ) && 1 == $wtl_settings['display_date'] ) {
			$date_link        = ( isset( $wtl_settings['disable_link_date'] ) && 1 == $wtl_settings['disable_link_date'] ) ? false : true;
			$date_format      = ( isset( $wtl_settings['post_date_format'] ) && 'default' !== $wtl_settings['post_date_format'] ) ? $wtl_settings['post_date_format'] : get_option( 'date_format' );
			$wp_timeline_date = ( isset( $wtl_settings['display_date_from'] ) && 'modify' === $wtl_settings['display_date_from'] ) ? apply_filters( 'wtl_date_format', get_post_modified_time( $date_format, $post->ID ), $post->ID ) : apply_filters( 'wtl_date_format', get_the_time( $date_format, $post->ID ), $post->ID );
			$date_split       = explode( ' ', $wp_timeline_date );
			$day              = $date_split[0];
			$month            = $date_split[1];
			$year             = $date_split[2];
			$ar_year          = get_the_time( 'Y' );
			$ar_month         = get_the_time( 'm' );
			$ar_day           = get_the_time( 'd' );
			$out              = '';
			$out             .= '<span class="wtl-post-date">';
			$out             .= ( $date_link ) ? '<a class="mdate" href="' . esc_url( get_day_link( $ar_year, $ar_month, $ar_day ) ) . '">' : '<span class="mdate">';
			$out             .= '<span class="month-date">' . esc_html( $day ) . ' <span>' . esc_html( $month ) . '</span></span> <span class="year">' . esc_html( $year ) . '</span>';
			$out             .= ( $date_link ) ? '</a>' : '</span>';
			$out             .= '</span>';
			return $out;
		}
	}

	/**
	 * Get Tags
	 *
	 * @param array   $wtl_settings settings arrray.
	 * @param boolean $show_label show label.
	 * @param boolean $divd show divider.
	 * @return void
	 */
	public static function get_tags( $wtl_settings, $show_label, $divd ) {
		global $post;
		$wtl_all_post_type = array( 'product', 'download', 'post' );
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
			if ( isset( $wtl_settings[ 'display_' . $wtl_display_tax_tag ] ) && 1 == $wtl_settings[ 'display_' . $wtl_display_tax_tag ] ) {
				$tags_link = ( isset( $wtl_settings[ 'disable_link_taxonomy_' . $wtl_display_tax_tag ] ) && 1 == $wtl_settings[ 'disable_link_taxonomy_' . $wtl_display_tax_tag ] ) ? false : true;
				$post_tags = wp_get_post_terms( $post->ID, $wtl_tax_tag, array( 'hide_empty' => 'false' ) );
				$sep       = 1;
				if ( $post_tags ) {
					?>
					<div class="post_tag taxonomies">
						<div class="post-tag-inner">
					<div class="wtl-post-tags">
						<span class="tags <?php echo ( $tags_link ) ? 'wp_timeline_no_links' : 'wp_timeline_has_link'; ?>">
							<?php
							if ( true == $show_label ) {
								?>
								<span class="link-lable"> <i class="fa fa-tag"></i> &nbsp; </span>
								<?php
							}
							$disable_link_tag = isset( $wtl_settings['disable_link_tag'] ) ? $wtl_settings['disable_link_tag'] : '';
							foreach ( $post_tags as $tag ) {
								echo '<span class="wp-timeline-custom-tag">';
								if ( 1 != $sep ) {
									if ( true == $divd ) {
										echo ', ';
									}
								}

								echo ( $tags_link ) ? '<a href="' . esc_url( get_term_link( $tag->term_id ) ) . '">' . $tag->name : $tag->name;
								echo ( $tags_link ) ? '</a>' : '';
								echo '</span>';
								$sep++;
							}
							?>
						</span>
					</div>
					</div>
					</div>
					<?php
				}
			}
		}
	}

	/**
	 * Get Author
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return void
	 */
	public static function get_author( $wtl_settings ) {
		global $post;
		if ( isset( $wtl_settings['display_author'] ) && 1 == $wtl_settings['display_author'] ) {
			echo '<span class="wtl-author author"><span class="author-name"> <i class="fas fa-edit"></i>';
			echo wp_kses( Wp_Timeline_Main::wtl_get_post_auhtors( $post->ID, $wtl_settings ), Wp_Timeline_Public::args_kses() );
			echo '</span></span>';
		}
	}

	/**
	 * Even and Odd
	 *
	 * @param string $n Number.
	 * @return html
	 */
	public static function even_odd( $n ) {
		if ( 0 == $n % 2 ) {
			return 'even';
		} else {
			return 'odd';
		}
	}

	/**
	 * Java script
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return html
	 */
	public static function js( $wtl_settings ) {
		ob_start();
			$enable_autoslide     = ( isset( $wtl_settings['enable_autoslide'] ) && '' !== $wtl_settings['enable_autoslide'] ) ? $wtl_settings['enable_autoslide'] : 1;
			$scroll_speed         = isset( $wtl_settings['scroll_speed'] ) ? $wtl_settings['scroll_speed'] : '5000';
			$noofslide            = ( isset( $wtl_settings['noof_slide'] ) && '' !== $wtl_settings['noof_slide'] ) ? $wtl_settings['noof_slide'] : 4;
			$noofnavit            = ( isset( $wtl_settings['noof_slider_nav_itme'] ) && '' !== $wtl_settings['noof_slider_nav_itme'] ) ? $wtl_settings['noof_slider_nav_itme'] : 4;
			$enable_nav_to_scroll = ( isset( $wtl_settings['enable_nav_to_scroll'] ) && '' !== $wtl_settings['enable_nav_to_scroll'] ) ? $wtl_settings['enable_nav_to_scroll'] : 1;
		if ( 1 == $enable_autoslide ) {
			$autoplay = 'true';
		} else {
			$autoplay = 'false';
		}
		?>
			<script type="text/javascript">
			jQuery(document).ready(function(){
				(function($){
					"use strict";
				var autoplay = <?php echo esc_attr( $autoplay ); ?>;
				var scroll_speed = <?php echo esc_attr( $scroll_speed ); ?>;
				var noofslide = <?php echo esc_attr( $noofslide ); ?>;
				var noofnavit = <?php echo esc_attr( $noofnavit ); ?>;
				var responsive_slider = [
					{breakpoint:767,settings:{slidesToShow:1}},
					{breakpoint:320,settings:{slidesToShow:1}},
				];
				$(".wtl_al_slider").slick({
					dots: false,
					infinite: false,arrows:true,pauseOnHover:true,
					slidesToShow:noofslide,
					autoplay:autoplay,
					adaptiveHeight:true,
					autoplaySpeed:scroll_speed,
					nextArrow: '<span class="wtl-ss-right"><i class="fas fa-angle-right"></i></span>',
					prevArrow: '<span class="wtl-ss-left"><i class="fas fa-angle-left"></i></span>', 
					responsive: responsive_slider                  
				});
				<?php if ( 1 == $enable_nav_to_scroll ) { ?>
				$(".wtl_al_slider").on('wheel', (function(e) {
					e.preventDefault();

					if (e.originalEvent.deltaY < 0) {
						$(this).slick('slickPrev');
					} else {
						$(this).slick('slickNext');
					}
					}));
				<?php } ?>
				}(jQuery))
			});
			</script>

		<script type="text/javascript">
			"use strict";
			var forEach = function (array, callback, scope) {for (var i = 0; i < array.length; i++) {callback.call(scope, i, array[i])}};
			window.onload = function(){
				var max = -219.99078369140625;
				forEach(document.querySelectorAll('.wtl-progress'), function (index, value) {
				percent = value.getAttribute('data-progress');
				value.querySelector('.wtl_fill').setAttribute('style', 'stroke-dashoffset: ' + ((100 - percent) / 100) * max);
				});
			}
		</script>
		<?php
		$contents = ob_get_contents();
		ob_end_clean();
		return $contents;
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
		if ( isset( $wtl_settings['wp_timeline_image_hover_effect'] ) && 1 == $wtl_settings['wp_timeline_image_hover_effect'] ) {
			$image_hover_effect = ( isset( $wtl_settings['wp_timeline_image_hover_effect_type'] ) && '' != $wtl_settings['wp_timeline_image_hover_effect_type'] ) ? $wtl_settings['wp_timeline_image_hover_effect_type'] : '';
		} else {
			$image_hover_effect = '';
		}
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
					$width        = isset( $wtl_settings['item_width'] ) ? $wtl_settings['item_width'] : 400;
					$height       = isset( $wtl_settings['item_height'] ) ? $wtl_settings['item_height'] : 200;
					$resize_image = WP_Timeline_Main::wp_timeline_resize( $width, $height, $url, true, get_post_thumbnail_id() );
					if ( isset( $thumbnail ) ) {
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
						$width        = isset( $wtl_settings['item_width'] ) ? $wtl_settings['item_width'] : 400;
						$height       = isset( $wtl_settings['item_height'] ) ? $wtl_settings['item_height'] : 200;
						$resize_image = WP_Timeline_Main::wp_timeline_resize( $width, $height, $url, true, $wtl_settings['wp_timeline_default_image_id'] );
						echo '<img src="' . esc_url( $resize_image['url'] ) . '" width="' . esc_attr( $resize_image['width'] ) . '" height="' . esc_attr( $resize_image['height'] ) . '" title="' . esc_attr( $post->post_title ) . '" alt="' . esc_attr( $post->post_title ) . '" />';
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
				$wp_timeline_enable_media    = ( isset( $wtl_settings['wp_timeline_enable_media'] ) && 0 == $wtl_settings['wp_timeline_enable_media'] ) ? false : true;
				if ( isset( $wp_timeline_enable_media ) && 1 == $wp_timeline_enable_media ) {
					?>
		<div class="photo post-image">
			<figure class="">
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
				}
			}
		}
	}

}

$wtl_template_columy_layout = new Wtl_Template_Columy_Layout();
