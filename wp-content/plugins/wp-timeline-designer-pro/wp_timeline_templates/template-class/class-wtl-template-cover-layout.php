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
class Wtl_Template_Cover_Layout {
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
		$hide_timeline_icon    = isset( $wtl_settings['hide_timeline_icon'] ) ? $wtl_settings['hide_timeline_icon'] : 0;
		$wp_year_timeline_side = isset( $wtl_settings['wp_year_timeline_side'] ) ? $wtl_settings['wp_year_timeline_side'] : 0;
		if ( 1 == $hide_timeline_icon ) {
			$hide_icon_class = 'hide_timeline_icon';
		} else {
			$hide_icon_class = 'show_timeline_icon';
		}

		$layout_type = $wtl_settings['layout_type'];
		if ( 1 == $layout_type ) {
			$slider_class = 'wtl_is_horizontal';
		} else {
			$slider_class = 'wtl_is_vertical';
		}

		$out  = '';
		$out .= self::js( $wtl_settings );
		$out .= self::style( $wtl_settings );
		if ( 1 != $layout_type && 1 == $wp_year_timeline_side ) {
			$out .= '<div class="wtl-bullets-container">';
			$out .= '<ul class="section-bullets-right">';
			$out .= Wtl_Template_Config::get_post_year( $wtl_settings );
			$out .= '</ul>';
			$out .= '</div>';
		}
		$out .= '<div id="wtl_steps" class="wtl_wrapper ' . $slider_class . ' wp_timeline_post_list schedule_cover layout_id_' . $layout_id . ' ' . $hide_icon_class . '">';
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
				$out = '';
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
	 * Template Style
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return void
	 */
	public static function style( $wtl_settings ) {
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
			$noofslide            = ( isset( $wtl_settings['noof_slide'] ) && '' !== $wtl_settings['noof_slide'] ) ? $wtl_settings['noof_slide'] : '2';
			$enable_nav_to_scroll = ( isset( $wtl_settings['enable_nav_to_scroll'] ) && '' !== $wtl_settings['enable_nav_to_scroll'] ) ? $wtl_settings['enable_nav_to_scroll'] : 1;
			if ( empty( $noofslide ) ) {
				$noofslide = 2;
			}
			$noofnavit = ( isset( $wtl_settings['noof_slider_nav_itme'] ) && '' !== $wtl_settings['noof_slider_nav_itme'] ) ? $wtl_settings['noof_slider_nav_itme'] : 2;
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
				var responsive = [
					{breakpoint:960,settings:{arrows:true,centerPadding:"10px",slidesToShow:noofslide}},
					{breakpoint:768,settings:{arrows:true,centerPadding:"10px",slidesToShow:1}},
					{breakpoint:480,settings:{arrows:true,centerPadding:"10px",slidesToShow:1}},
					{breakpoint:370,settings:{arrows:true,centerPadding:"10px",slidesToShow:1}}
					];

				$(".wtl_al_slider").slick({
					dots: false,
					infinite: false,pauseOnHover:true,
					nextArrow: '',
					prevArrow: '',
					slidesToShow:noofslide,
					autoplay:autoplay,
					asNavFor:'.wtl_al_nav',
					adaptiveHeight:true,
					autoplaySpeed:scroll_speed,
					responsive: responsive
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
					responsive: responsive
				})
				}(jQuery))
			});
			</script>
			<?php
		}
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
		if ( 'cover_layout' === $wp_timeline_theme ) {
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
							$ar_year = get_the_date( 'Y' );
							echo '<span class="wtl_steps_post_year"> ' . esc_html( $ar_year ) . ' </span>';
							$defalt_icon = self::get_default_icon( $wtl_settings );
							if ( $defalt_icon ) {
								$dicon = $defalt_icon;
							} else {
								$dicon = '';
							}
							$wtl_icon = Wtl_Template_Config::get_timeline_icon();
							if ( $wtl_icon ) {
								echo wp_kses( $wtl_icon, Wp_Timeline_Public::args_kses() );
							} else {
								$hide_timeline_icon = ( isset( $wtl_settings['hide_timeline_icon'] ) ) ? $wtl_settings['hide_timeline_icon'] : 0;
								if ( $dicon ) {
									if ( 1 == $hide_timeline_icon ) {
										echo '<div class="wtl_steps_post_format">' . wp_kses( $wtl_icon, Wp_Timeline_Public::args_kses() ) . '</div>';
									} else {
										echo '<div class="wtl_steps_post_format">' . wp_kses( $dicon, Wp_Timeline_Public::args_kses() ) . '</div>';
									}
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

	}
}

$wtl_template_cover_layout = new Wtl_Template_Cover_Layout();
