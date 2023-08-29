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
class Wtl_Template_Fullvertical_Layout {
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
		$layout_type        = $wtl_settings['layout_type'];
		if ( 1 == $hide_timeline_icon ) {
			$hide_icon_class = 'hide_timeline_icon';
		} else {
			$hide_icon_class = 'show_timeline_icon';
		}
		if ( 1 == $layout_type ) {
			$slider_class = 'wtl_is_horizontal';
		} else {
			$slider_class = 'wtl_is_vertical';
		}

		$out  = '';
		$out .= self::js( $wtl_settings );
		$out .= self::style( $wtl_settings );
		$out .= '<div id="wtl_steps" class="wtl_wrapper wp_timeline_post_list schedule_cover full_vertical_layout layout_id_' . $layout_id . ' ' . $hide_icon_class . ' ' . $slider_class . '">';
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
		$layout_type = $wtl_settings['layout_type'];
		if ( 1 == $layout_type ) {
			$enable_autoslide = ( isset( $wtl_settings['enable_autoslide'] ) && '' !== $wtl_settings['enable_autoslide'] ) ? $wtl_settings['enable_autoslide'] : 1;
			$scroll_speed     = isset( $wtl_settings['scroll_speed'] ) ? $wtl_settings['scroll_speed'] : '5000';
			$noofslide        = ( isset( $wtl_settings['noof_slide'] ) && '' !== $wtl_settings['noof_slide'] ) ? $wtl_settings['noof_slide'] : 2;
			$noofnavit        = ( isset( $wtl_settings['noof_slider_nav_itme'] ) && '' !== $wtl_settings['noof_slider_nav_itme'] ) ? $wtl_settings['noof_slider_nav_itme'] : 2;
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
					{breakpoint:767,settings:{slidesToShow:noofslide, vertical:false}},
					{breakpoint:320,settings:{slidesToShow:1, vertical:false}},
				];
				var responsive_nav = [
					{breakpoint: 767,settings: {slidesToShow: 1}},
					{breakpoint: 320,settings: {slidesToShow: 1, vertical:false}}
				];
				$(".wtl_al_slider").slick({
					dots: false,
					infinite: false,arrows:false,pauseOnHover:true,
					slidesToShow:1,
					autoplay:autoplay,
					asNavFor:'.wtl_al_nav',
					adaptiveHeight:true,
					vertical:true,
					autoplaySpeed:scroll_speed,
					nextArrow:'',prevArrow:'', 
					responsive: responsive_slider,
				});
				$('.wtl_al_nav').slick({
					slidesToShow:noofnavit,
					slidesToScroll: 1,
					asNavFor:'.wtl_al_slider',
					dots:false,
					infinite:false,
					nextArrow: '<span class="wtl-ss-right"><i class="fas fa-angle-down"></i></span>',
					prevArrow: '<span class="wtl-ss-left"><i class="fas fa-angle-up"></i></span>',
					focusOnSelect:true,
					adaptiveHeight:false,
					vertical:true,
					responsive: responsive_nav
				})
				}(jQuery))
			});
			</script>
			<?php
		}
		?>
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
	 * Get Category
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return void
	 */
	public static function get_category( $wtl_settings ) {
		global $post;
		$taxonomy_names = get_object_taxonomies( $wtl_settings['custom_post_type'], 'objects' );
		$taxonomy_names = apply_filters( 'wp_timeline_hide_taxonomies', $taxonomy_names );
		foreach ( $taxonomy_names as $taxonomy_single ) {
			$taxonomy = $taxonomy_single->name;
			$sep      = 1;
			if ( isset( $wtl_settings[ 'display_' . $taxonomy ] ) && 1 == $wtl_settings[ 'display_' . $taxonomy ] ) {
				$term_list            = wp_get_post_terms( get_the_ID(), $taxonomy, array( 'fields' => 'all' ) );
				$taxonomy_link        = ( isset( $wtl_settings[ 'disable_link_taxonomy_' . $taxonomy ] ) && 1 == $wtl_settings[ 'disable_link_taxonomy_' . $taxonomy ] ) ? false : true;
				$wtl_exclude_taxonomy = array( 'product_tag', 'download_tag', 'tag' );
				$wtl_include_taxonomy = array( 'product_cat', 'download_category', 'category' );
				if ( isset( $taxonomy ) && ! in_array( $taxonomy, $wtl_exclude_taxonomy, true ) ) {
					if ( isset( $term_list ) && ! empty( $term_list ) ) {
						echo '<div class="wtl-post-category">';
						?>
						<span class="post-category taxonomies<?php echo ( $taxonomy_link ) ? ' wp_timeline_no_links' : ' wp_timeline_has_link'; ?>">
							<span class="link-lable"> <i class="fas fa-folder-open"></i> <?php echo esc_html( $taxonomy_single->label ); ?>:&nbsp; </span>
							<?php
							foreach ( $term_list as $term_nm ) {
								$term_link             = get_term_link( $term_nm );
								$disable_link_category = isset( $wtl_settings['disable_link_category'] ) ? $wtl_settings['disable_link_category'] : '';
								if ( 1 != $sep ) {
									echo ', ';}
								if ( 1 != $disable_link_category ) {
									echo ( $taxonomy_link ) ? '<a href="' . esc_url( $term_link ) . '">' : '';
								} else {
									echo '<a href="javascript:void(0)">';
								}
								echo esc_html( $term_nm->name );
								echo ( $taxonomy_link ) ? '</a>' : '';
								$sep++;
							}
							?>
						</span>
							<?php
							echo '</div>';
					}
				}
			}
		}
		if ( isset( $wtl_settings['custom_post_type'] ) && 'product' === $wtl_settings['custom_post_type'] ) {
			do_action( 'wtl_woo_product_details', $wtl_settings, $post->ID );
		}
		if ( isset( $wtl_settings['custom_post_type'] ) && 'download' === $wtl_settings['custom_post_type'] ) {
			do_action( 'wtl_edd_product_details', $wtl_settings, $post->ID );
		}
	}

	/**
	 * Get Tags
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return void
	 */
	public static function get_tags( $wtl_settings ) {
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
					<div class="wtl-post-tags">
						<span class="tags <?php echo ( $tags_link ) ? 'wp_timeline_no_links' : 'wp_timeline_has_link'; ?>">
							<span class="link-lable"> <i class="fas fa-bookmark"></i> <?php esc_html_e( 'Tags', 'wp-timeline-designer-pro' ); ?>:&nbsp; </span>
						<?php
						$disable_link_tag = isset( $wtl_settings['disable_link_tag'] ) ? $wtl_settings['disable_link_tag'] : '';
						foreach ( $post_tags as $tag ) {
							echo '<span class="wp-timeline-custom-tag">';
							if ( 1 != $sep ) {
								echo ', ';
							}
							if ( 1 != $disable_link_tag ) {
								echo ( $tags_link ) ? '<a href="' . esc_url( get_term_link( $tag->term_id ) ) . '">' : '';
							} else {
								echo ( $tags_link ) ? '<a href="javascript:void(0)">' : '';
							}
							echo esc_html( $tag->name );
							echo ( $tags_link ) ? '</a>' : '';
							echo '</span>';
							$sep++;
						}
						?>
						</span>
					</div>
					<?php
				}
			}
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
			$thumbnail       = Wp_Timeline_Main::wtl_get_the_thumbnail( $wtl_settings, 'full', get_post_thumbnail_id(), $post->ID );
			$single_settings = get_post_meta( $post->ID, '_wtl_single_details_key', true );
			$thumbnail_type  = isset( $single_settings['wtl_thumbnail_type'] ) ? $single_settings['wtl_thumbnail_type'] : '';
			$video_type      = isset( $single_settings['wtl_single_video_type'] ) ? $single_settings['wtl_single_video_type'] : '';
			$video_id        = isset( $single_settings['wtl_single_video_id'] ) ? $single_settings['wtl_single_video_id'] : '';
			$audio_type      = isset( $single_settings['wtl_single_audio_type'] ) ? $single_settings['wtl_single_audio_type'] : '';
			$audio_id        = isset( $single_settings['wtl_single_audio_id'] ) ? $single_settings['wtl_single_audio_id'] : '';
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
						echo '</figure>';
						?>
					</div>
						<?php
						/* [3] check if is it default image ---------- */
					} elseif ( isset( $wtl_settings['wp_timeline_default_image_id'] ) && '' != $wtl_settings['wp_timeline_default_image_id'] ) {
						$wp_timeline_post_image_link = ( isset( $wtl_settings['wp_timeline_post_image_link'] ) && 0 == $wtl_settings['wp_timeline_post_image_link'] ) ? false : true;
						?>
					<figure class="">;
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
							?>
						</div>
					</figure>
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
						?>
					</div>
						<?php
					}
					echo '</div>';
				} else {
					$wp_timeline_post_image_link = ( isset( $wtl_settings['wp_timeline_post_image_link'] ) && 0 == $wtl_settings['wp_timeline_post_image_link'] ) ? false : true;
					?>
				<div class="wp-timeline-post-image post-image photo post-image <?php echo esc_attr( $is_aside ); ?>">
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
						?>
					</figure>
				</div>
					<?php
					if ( 'image' === get_post_format() ) {
						$image_url = Wtl_Template_Config::catch_that_image();
						if ( $image_url ) {
							echo '<div class="schedule-image-wrapper wtl-post-thumbnail">';
							$wp_timeline_post_image_link = ( isset( $wtl_settings['wp_timeline_post_image_link'] ) && 0 == $wtl_settings['wp_timeline_post_image_link'] ) ? false : true;
							?>
						<div class="wp-timeline-post-image post-image photo post-image <?php echo esc_attr( $is_aside ); ?>">
							<?php
							echo ( $wp_timeline_post_image_link ) ? '<a href="' . esc_url( get_permalink( $post->ID ) ) . '">' : '';
							$url          = $image_url;
							$width        = isset( $wtl_settings['item_width'] ) ? $wtl_settings['item_width'] : 400;
							$height       = isset( $wtl_settings['item_height'] ) ? $wtl_settings['item_height'] : 200;
							$resize_image = WP_Timeline_Main::wp_timeline_resize( $width, $height, $url, true );
							echo '<img src="' . esc_url( $resize_image['url'] ) . '" width="' . esc_attr( $resize_image['width'] ) . '" height="' . esc_attr( $resize_image['height'] ) . '" title="' . esc_attr( $post->post_title ) . '" alt="' . esc_attr( $post->post_title ) . '" />';
							echo ( $wp_timeline_post_image_link ) ? '</a>' : '';
							if ( isset( $wtl_settings['pinterest_image_share'] ) && 1 == $wtl_settings['pinterest_image_share'] && isset( $wtl_settings['social_share'] ) && 1 == $wtl_settings['social_share'] ) {
								echo wp_kses( Wp_Timeline_Main::wp_timeline_pinterest( $post->ID ), Wp_Timeline_Public::args_kses() );
							}
							?>
						</div>
							<?php
							echo '</div>';
						}
					} elseif ( 'video' === get_post_format() ) {
						if ( Wp_Timeline_Main::wtl_get_first_embed_media( $post->ID, $wtl_settings ) ) {
							echo wp_kses( Wp_Timeline_Main::wtl_get_first_embed_media( $post->ID, $wtl_settings ), Wp_Timeline_Public::args_kses() );
						}
					} elseif ( 'audio' === get_post_format() ) {
						if ( Wp_Timeline_Main::wtl_get_first_embed_media( $post->ID, $wtl_settings ) ) {
							echo wp_kses( Wp_Timeline_Main::wtl_get_first_embed_media( $post->ID, $wtl_settings ), Wp_Timeline_Public::args_kses() );
						}
					} elseif ( 'gallery' === get_post_format() ) {
						if ( Wp_Timeline_Main::wtl_get_first_embed_media( $post->ID, $wtl_settings ) ) {
							echo wp_kses( Wp_Timeline_Main::wtl_get_first_embed_media( $post->ID, $wtl_settings ), Wp_Timeline_Public::args_kses() );
						}
					}
				}
			}
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
		if ( 'fullvertical_layout' === $wp_timeline_theme ) {
			$layout_type = $wtl_settings['layout_type'];
			$i           = 0;
			if ( 1 == $layout_type ) {
				ob_start();
				if ( $loop->have_posts() ) {
					echo '<div class="wtl_al_nav">';
					while ( have_posts() ) :
						the_post();
						?>
						<div class="wtl-slitem_nav" data-date="<?php echo 'post-id_' . esc_attr( get_the_ID() ); ?>" data-slick-index="<?php echo esc_attr( $i ); ?>" id="wtl_layout_<?php echo get_the_ID(); ?>">
							<?php
							$ar_year = get_the_time( 'Y' );
							echo '<span class="wtl_steps_post_year"> ' . esc_html( $ar_year ) . ' </span>';

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

	}
}

$wtl_template_fullvertical_layout = new Wtl_Template_Fullvertical_Layout();
