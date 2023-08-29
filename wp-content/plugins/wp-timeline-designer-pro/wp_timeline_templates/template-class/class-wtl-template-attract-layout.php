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
class Wtl_Template_Attract_Layout {
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
		$hide_timeline_icon   = isset( $wtl_settings['hide_timeline_icon'] ) ? $wtl_settings['hide_timeline_icon'] : 0;
		$display_timeline_bar = isset( $wtl_settings['display_timeline_bar'] ) ? $wtl_settings['display_timeline_bar'] : 0;
		if ( 1 == $hide_timeline_icon ) {
			$hide_icon_class = 'hide_timeline_icon';
		} else {
			$hide_icon_class = 'show_timeline_icon';
		}
		if ( 1 == $display_timeline_bar ) {
			$display_timelinebar_class = 'show_timelinebar_arrow';
		} else {
			$display_timelinebar_class = 'hide_timelinebar_arrow';
		}

		$out  = '';
		$out .= self::js( $wtl_settings );
		$out .= self::style( $wtl_settings );
		$out .= '<div id="wtl_steps" class="wtl_wrapper wp_timeline_post_list attract_layout schedule_cover layout_id_' . $layout_id . ' ' . $hide_icon_class . ' ' . $display_timelinebar_class . '">';
		$out .= self::heading( $wtl_settings );
		$out .= '<div class="wtl-schedule-wrap">';
		$out .= '<div class="wtl_blog_template wtl_steps_wrap">';
		$out .= '<div class="wtl_steps" data-effect="flip-effect">';
		$out .= $template_wrapper;
		$out .= '</div>';
		$out .= '</div>';
		$out .= '</div>';
		$out .= '</div>';
		return $out;
	}

	/**
	 * Template Style
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return void
	 */
	public static function style( $wtl_settings ) {
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
			$noofslide            = ( isset( $wtl_settings['noof_slide'] ) && '' !== $wtl_settings['noof_slide'] ) ? $wtl_settings['noof_slide'] : 2;
			$noofnavit            = ( isset( $wtl_settings['noof_slider_nav_itme'] ) && '' !== $wtl_settings['noof_slider_nav_itme'] ) ? $wtl_settings['noof_slider_nav_itme'] : 2;
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
						{breakpoint:376,settings:{slidesToShow:1}},
						{breakpoint:991,settings:{slidesToShow:3}},
					];
				var responsive_nav = [
						{breakpoint: 767,settings: {slidesToShow: 1}},
						{breakpoint: 320,settings: {slidesToShow: 1}},
						{breakpoint: 991,settings: {slidesToShow: 3}},
					];

					$(".wtl_al_slider").slick({
					dots: false,
					infinite: false,arrows:true,pauseOnHover:true,
					slidesToShow:noofslide,
					autoplay:autoplay,
					asNavFor:'.wtl_al_nav',
					adaptiveHeight:false,
					autoplaySpeed:scroll_speed,
					nextArrow: '<span class="wtl-post-ss-right"><i class="fas fa-angle-right"></i></span>',
					prevArrow: '<span class="wtl-post-ss-left"><i class="fas fa-angle-left"></i></span>',
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
				//  $(".wtl_al_slider").slick({
				// 	dots: false,
				// 	infinite: false,arrows:true,pauseOnHover:true,
				// 	slidesToShow:noofslide,
				// 	autoplay:autoplay,
				// 	asNavFor:'.wtl_al_nav',
				// 	adaptiveHeight:false,
				// 	autoplaySpeed:scroll_speed,
				// 	nextArrow: '<span class="wtl-post-ss-right"><i class="fas fa-angle-right"></i></span>',
				// 	prevArrow: '<span class="wtl-post-ss-left"><i class="fas fa-angle-left"></i></span>',
				// 	responsive: responsive_slider           
				//   });
					$('.wtl_al_nav').slick({
						slidesToScroll: 1,
						asNavFor:'.wtl_al_slider',
						dots:false,
						infinite:false,
						nextArrow: '<span class="wtl-ss-right"><i class="fas fa-angle-right"></i></span>',
						prevArrow: '<span class="wtl-ss-left"><i class="fas fa-angle-left"></i></span>',
						focusOnSelect:true,
						adaptiveHeight:true,
						slidesToShow:noofnavit,
						responsive: responsive_nav,
					})
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
	 * Get Heading
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return html
	 */
	public static function heading( $wtl_settings ) {
		$heading_1 = isset( $wtl_settings['timeline_heading_1'] ) ? $wtl_settings['timeline_heading_1'] : '';
		$heading_2 = isset( $wtl_settings['timeline_heading_2'] ) ? $wtl_settings['timeline_heading_2'] : '';
		$out       = '';
		if ( $heading_1 || $heading_2 ) {
				$out .= '<div class="wtl_main_title">';
			if ( $heading_1 ) {
					$out .= '<h1>' . esc_html( $heading_1 ) . '</h1>';
			}
			if ( $heading_2 ) {
					$out .= '<h2>' . esc_html( $heading_2 ) . '</h2>';
			}
				$out .= '</div>';
		}
		return $out;
	}

	/**
	 * Get Default Icon
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return html
	 */
	public static function get_default_icon( $wtl_settings ) {
		$icon_type   = $wtl_settings['wtl_single_display_timeline_icon'];
		$icon_icon   = $wtl_settings['wtl_single_timeline_icon'];
		$icon_img    = $wtl_settings['wtl_icon_image_src'];
		$defaut_icon = '<i class="far fa-clock"></i>';
		if ( 'fontawesome' === $icon_type ) {
			if ( $icon_icon ) {
				if( 'fafa-star' == $icon_icon ) {
					$icon_icon = substr_replace($icon_icon," ", 2, -strlen($icon_icon));
				} else {
					$icon_icon = substr_replace($icon_icon," ", 3, -strlen($icon_icon));
				}
				$out = '<i class="' . esc_attr( $icon_icon ) . '"></i>';
			} else {
				$out = $defaut_icon;
			}
		} elseif ( 'image' === $icon_type ) {
			if ( $icon_img ) {
				$out = '<img src="' . esc_url( $icon_img ) . '">';
			} else {
				$out = $defaut_icon;
			}
		}
		return $out;
	}

	/**
	 * Get Content
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return void
	 */
	public static function get_content( $wtl_settings ) {
		global $post;
		echo wp_kses( Wp_Timeline_Main::wtl_get_content( $post->ID, $wtl_settings, $wtl_settings['rss_use_excerpt'], $wtl_settings['txtExcerptlength'] ), Wp_Timeline_Public::args_kses() );
	}

	/**
	 * Get post Date
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return void
	 */
	public static function get_post_date( $wtl_settings ) {
		global $post;
		if ( isset( $wtl_settings['display_date'] ) && 1 == $wtl_settings['display_date'] ) {
			$date_link        = ( isset( $wtl_settings['disable_link_date'] ) && 1 == $wtl_settings['disable_link_date'] ) ? false : true;
			$date_format      = ( isset( $wtl_settings['post_date_format'] ) && 'default' !== $wtl_settings['post_date_format'] ) ? $wtl_settings['post_date_format'] : get_option( 'date_format' );
			$wp_timeline_date = ( isset( $wtl_settings['display_date_from'] ) && 'modify' === $wtl_settings['display_date_from'] ) ? apply_filters( 'wtl_date_format', get_post_modified_time( $date_format, $post->ID ), $post->ID ) : apply_filters( 'wtl_date_format', get_the_time( $date_format, $post->ID ), $post->ID );
			$ar_year          = get_the_time( 'Y' );
			$ar_month         = get_the_time( 'm' );
			$ar_day           = get_the_time( 'd' );
			echo '<span class="wtl-post-date">';
			echo '<i class="far fa-calendar-alt"></i> ';
			echo ( $date_link ) ? '<a class="mdate" href="' . esc_url( get_day_link( $ar_year, $ar_month, $ar_day ) ) . '">' : '<div class="mdate">';
			echo esc_html( $wp_timeline_date );
			echo ( $date_link ) ? '</a>' : '</div>';
			echo '</span>';
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
		if ( 1 == $wtl_settings['display_author'] ) {
			echo '<span class="author"><span class="author-name"> <i class="fas fa-user"></i> ';
			echo wp_kses( Wp_Timeline_Main::wtl_get_post_auhtors( $post->ID, $wtl_settings ), Wp_Timeline_Public::args_kses() );
			echo '</span></span>';
		}
	}


	/**
	 * Time Circle
	 *
	 * @param array $wtl_settings settings arrray.
	 * @param array $wp_timeline_theme settings arrray.
	 * @param array $loop settings arrray.
	 * @param array $temp_query settings arrray.
	 * @return html
	 */
	public static function slider_nav( $wtl_settings, $wp_timeline_theme, $loop, $temp_query ) {
		if ( 'attract_layout' === $wp_timeline_theme ) {
			$i = 0;
				ob_start();
			if ( $loop->have_posts() ) {
				echo '<div class="wtl_al_nav">';
				while ( have_posts() ) :
					the_post();
					?>
						<div class="wtl-slitem_nav" data-date="<?php echo 'post-id_' . esc_attr( get_the_ID() ); ?>" data-slick-index="<?php echo esc_attr( $i ); ?>" id="wtl_layout_<?php echo get_the_ID(); ?>">
						<?php
						$defalt_icon = Wtl_Template_Easy_Layout::get_default_icon( $wtl_settings );
						if ( $defalt_icon ) {
							$dicon = $defalt_icon;
						} else {
							$dicon = '';
						}
						$wtl_icon = Wtl_Template_Config::get_timeline_icon();
						if ( $wtl_icon ) {
							echo wp_kses( $wtl_icon, Wp_Timeline_Public::args_kses() );
						} else {
							if ( $dicon ) {
								echo '<div class="wtl_steps_post_format">' . wp_kses( $dicon, Wp_Timeline_Public::args_kses() ) . '</div>';
							} else {
								echo '<div class="wtl_steps_post_format"><i class="' . esc_attr( $post_format ) . '"></i></div>';
							}
						}
						?>
						</div>
						<?php
						$i++;
					endwhile;
					wp_reset_postdata();
				$wp_query = null;
				$wp_query = $temp_query;
				echo '</div>';
			}
				$out = ob_get_contents();
				ob_end_clean();
				return $out;
		}

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
					<div class="wp-timeline-post-image post-image photo post-image <?php echo esc_attr( $is_aside ); ?>">
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

$wtl_template_attract_layout = new Wtl_Template_Attract_Layout();
