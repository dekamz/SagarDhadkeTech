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
class Wtl_Template_Hire_Layout {
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
	}

	/**
	 * Time Circle
	 *
	 * @param array $layout_id settings arrray.
	 * @param array $wtl_settings settings arrray.
	 * @param array $template_wrapper settings arrray.
	 * @return html
	 */
	public static function render( $layout_id, $wtl_settings, $template_wrapper ) {
		$layout_type           = $wtl_settings['layout_type'];
		$wp_year_timeline_side = isset( $wtl_settings['wp_year_timeline_side'] ) ? $wtl_settings['wp_year_timeline_side'] : 0;
		if ( 1 == $layout_type ) {
			$slider_class = 'wtl_is_horizontal';
		} else {
			$slider_class = '';
		}
		$out  = self::js( $wtl_settings );
		$out .= self::style( $wtl_settings );
		if ( 1 != $layout_type && 1 == $wp_year_timeline_side ) {
			$out .= '<div class="wtl-bullets-container">';
			$out .= '<ul class="section-bullets-right">';
			$out .= Wtl_Template_Config::get_post_year( $wtl_settings );
			$out .= '</ul>';
			$out .= '</div>';
		}
		$out .= '<div class="wtl_wrapper wp_timeline_post_list schedule_cover ' . $slider_class . ' layout_id_' . $layout_id . '">';
		$out .= self::heading( $wtl_settings );
		$out .= '<div class="wtl_blog_template blog_template schedule wtl_single_post_wrapp" id="wtl_hire_lt">';
		$out .= '<div class="wtl-schedule-wrap">';
		$out .= $template_wrapper;
		$out .= '</div>';
		$out .= '</div>';
		return $out;
	}

	/**
	 * Template Heading
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
					$out .= '<h3>' . esc_html( $heading_1 ) . '</h3>';
			}
			if ( $heading_2 ) {
					$out .= '<h1>' . esc_html( $heading_2 ) . '</h1>';
			}
				$out .= '</div>';
		}
		return $out;
	}

	/**
	 * Template Style
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return void
	 */
	public static function style( $wtl_settings ) {
		?>
		<style>
			.wtl-progress.wtl_blue .wtl_fill,
			.wtl_is_horizontal  .wtl-progress .wtl_fill{
			<?php echo isset( $wtl_settings['template_color'] ) ? 'stroke:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;' : '#fff'; ?>
		}
		</style>
		<?php
	}

	/**
	 * Java Script
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return string
	 */
	public static function js( $wtl_settings ) {
		ob_start();
		$layout_type = $wtl_settings['layout_type'];
		if ( 1 == $layout_type ) {
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
					{breakpoint: 768,settings: {arrows:true,centerPadding: "10px",slidesToShow: 1}},
					{breakpoint: 480,settings: {arrows:true,centerPadding: "10px",slidesToShow: 1}}
				];
				var responsive_nav = [
					{breakpoint: 768,settings: {arrows:true,centerPadding: "10px",slidesToShow: 1}},
					{breakpoint: 480,settings: {arrows:true,centerPadding: "10px",slidesToShow: 1}}
				];
				$(".wtl_al_slider").slick({
					dots: false,
					infinite: false,arrows:false,mobileFirst:true,pauseOnHover:true,
					slidesToShow:noofslide,
					autoplay:autoplay,
					asNavFor:'.wtl_al_nav',
					adaptiveHeight:true,
					autoplaySpeed:scroll_speed,
					nextArrow:'',prevArrow:'',
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
				$('.wtl_al_nav').slick({
					slidesToShow:noofnavit,
					slidesToScroll: 1,
					asNavFor:'.wtl_al_slider',
					dots:false,
					infinite:false,
					nextArrow: '<span class="wtl-ss-right"><i class="fas fa-angle-right"></i></span>',
					prevArrow: '<span class="wtl-ss-left"><i class="fas fa-angle-left"></i></span>',
					focusOnSelect:true,
					adaptiveHeight:true,
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
				var percent = value.getAttribute('data-progress');
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
	 * Time Circle
	 *
	 * @param array $wtl_settings settings arrray.
	 * @param array $wp_timeline_theme settings arrray.
	 * @param array $loop settings arrray.
	 * @param array $temp_query settings arrray.
	 * @return html
	 */
	public static function slider_nav( $wtl_settings, $wp_timeline_theme, $loop, $temp_query ) {
		if ( 'hire_layout' === $wp_timeline_theme ) {
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
							<?php self::time_circle( $wtl_settings ); ?>
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

	/**
	 * Time Circle
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
				$out = '<i class="' . $icon_icon . '"></i>';
			} else {
				$out = $defaut_icon;
			}
		} elseif ( 'image' === $icon_type ) {
			if ( $icon_img ) {
				$out = '<img src="' . $icon_img . '">';
			} else {
				$out = $defaut_icon;
			}
		}
		return '<foreignObject x="0" y="0" width="80" height="80"><div class="wtlcircle" xmlns="http://www.w3.org/1999/xhtml">' . $out . '</div></foreignobject>';
	}

	/**
	 * Time Circle
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return void
	 */
	public static function time_circle( $wtl_settings ) {
		global $post;
		$wtl_post_settings = get_post_meta( $post->ID, '_wtl_single_details_key', true );
		$time              = isset( $wtl_post_settings['wtl_timeline_time'] ) ? $wtl_post_settings['wtl_timeline_time'] : '';
		$time_format       = isset( $wtl_post_settings['wtl_timeline_time_format'] ) ? $wtl_post_settings['wtl_timeline_time_format'] : '';
		if ( '12hour' === $time_format ) {
			$time_text = $time;
		} else {
			if ( '1 pm' === $time ) {
				$time_text = '13:00';
			} elseif ( '2 pm' === $time ) {
				$time_text = '14:00';
			} elseif ( '3 pm' === $time ) {
				$time_text = '15:00';
			} elseif ( '4 pm' === $time ) {
				$time_text = '16:00';
			} elseif ( '5 pm' === $time ) {
				$time_text = '17:00';
			} elseif ( '6 pm' === $time ) {
				$time_text = '18:00';
			} elseif ( '7 pm' === $time ) {
				$time_text = '19:00';
			} elseif ( '8 pm' === $time ) {
				$time_text = '20:00';
			} elseif ( '9 pm' === $time ) {
				$time_text = '21:00';
			} elseif ( '10 pm' === $time ) {
				$time_text = '22:00';
			} elseif ( '11 pm' === $time ) {
				$time_text = '23:00';
			} elseif ( '12 pm' === $time ) {
				$time_text = '24:00';
			} else {
				$time_text = $time;
			}
		}
		if ( '1 am' === $time || '1 pm' === $time ) {
			$progress = '5';
		} elseif ( '2 am' === $time || '2 pm' === $time ) {
			$progress = '15';
		} elseif ( '3 am' === $time || '3 pm' === $time ) {
			$progress = '25';
		} elseif ( '4 am' === $time || '4 pm' === $time ) {
			$progress = '40';
		} elseif ( '5 am' === $time || '5 pm' === $time ) {
			$progress = '45';
		} elseif ( '6 am' === $time || '6 pm' === $time ) {
			$progress = '50';
		} elseif ( '7 am' === $time || '7 pm' === $time ) {
			$progress = '60';
		} elseif ( '8 am' === $time || '8 pm' === $time ) {
			$progress = '65';
		} elseif ( '9 am' === $time || '9 pm' === $time ) {
			$progress = '74';
		} elseif ( '10 am' === $time || '10 pm' === $time ) {
			$progress = '85';
		} elseif ( '11 am' === $time || '11 pm' === $time ) {
			$progress = '95';
		} elseif ( '12 am' === $time || '12 pm' === $time ) {
			$progress = '99';
		} else {
			$progress = '1';
		}
		?>
		<div class="wtl_progress-circle">
			<svg class="wtl-progress wtl_blue wtl_noselect" data-progress="<?php echo esc_attr( $progress ); ?>" x="0px" y="0px" viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg">
				<path class="wtl_track" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0"/>
				<path class="wtl_fill" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0"/>
				<?php
				if ( $time ) {
					?>
					<text class="wtl_time_value" x="50%" y="55%"><?php echo esc_html( $time_text ); ?></text>
					<?php

				} else {
					echo wp_kses( self::get_default_icon( $wtl_settings ), Wp_Timeline_Public::args_kses() );
				}
				?>
			</svg>
		</div>
		<?php
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
	 * Get Post Date
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
			echo '<div class="wtl-post-date">';
			echo ( $date_link ) ? '<a class="mdate" href="' . esc_url( get_day_link( $ar_year, $ar_month, $ar_day ) ) . '">' : '';
			echo '<span>';
			echo esc_html( $wp_timeline_date );
			echo '</span>';
			echo ( $date_link ) ? '</a>' : '';
			echo '</div>';
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
			echo '<span class="author"><span class="author-name">';
			echo wp_kses( Wp_Timeline_Main::wtl_get_post_auhtors( $post->ID, $wtl_settings ), Wp_Timeline_Public::args_kses() );
			echo '</span></span>';
		}
	}

	/**
	 * Get Category
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return html
	 */
	public static function get_category( $wtl_settings ) {
		global $post;
		ob_start();
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
							<?php
							foreach ( $term_list as $term_nm ) {
								$term_link             = get_term_link( $term_nm );
								$disable_link_category = isset( $wtl_settings['disable_link_category'] ) ? $wtl_settings['disable_link_category'] : '';
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
		$out = ob_get_contents();
		ob_end_clean();
		return $out;
	}

	/**
	 * Get Post Tag
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return html
	 */
	public static function get_tags( $wtl_settings ) {
		ob_start();
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
						<?php
						$disable_link_tag = isset( $wtl_settings['disable_link_tag'] ) ? $wtl_settings['disable_link_tag'] : '';
						foreach ( $post_tags as $tag ) {
							echo '<span class="wp-timeline-custom-tag">';
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
		$out = ob_get_contents();
		ob_end_clean();
		return $out;
	}
}

$wtl_template_hire_layout = new Wtl_Template_Hire_Layout();
