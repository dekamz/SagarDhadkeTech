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
class Wtl_Template_Advanced_Layout {
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_filter( 'wtl_before_post_loop', array( $this, 'slider_nav' ), 10, 4 );
	}

	/**
	 * Render Template
	 *
	 * @param string $layout_id layout id.
	 * @param array  $wtl_settings settings arrray.
	 * @param string $template_wrapper template wrapp.
	 * @return html
	 */
	public static function render( $layout_id, $wtl_settings, $template_wrapper ) {
		$layout_type           = $wtl_settings['layout_type'];
		$timeline_style_type   = isset( $wtl_settings['timeline_style_type'] ) ? $wtl_settings['timeline_style_type'] : '';
		$timeline_style_view   = isset( $wtl_settings['timeline_style_view'] ) ? $wtl_settings['timeline_style_view'] : '';
		$wp_year_timeline_side = isset( $wtl_settings['wp_year_timeline_side'] ) ? $wtl_settings['wp_year_timeline_side'] : 0;
		if ( 1 == $layout_type ) {
			$slider_class = 'wtl_is_horizontal';
		} else {
			$slider_class = '';
		}
		$out  = '';
		$out .= self::js( $wtl_settings );
		if ( 1 != $layout_type && 1 == $wp_year_timeline_side ) {
			$out .= '<div class="wtl-bullets-container">';
			$out .= '<ul class="section-bullets-right">';
			$out .= Wtl_Template_Config::get_post_year( $wtl_settings );
			$out .= '</ul>';
			$out .= '</div>';
		}
		$out .= '<div class="wtl_wrapper wp_timeline_post_list schedule_cover ' . $slider_class . ' layout_id_' . $layout_id . ' wtll_style_view_' . $timeline_style_view . ' wtll_style_type_' . $timeline_style_type . '">';
		$out .= '<div class="wtl_blog_template blog_template schedule wtl_single_post_wrapp">';
		$out .= self::heading( $wtl_settings );
		$out .= '<div class="wtl-schedule-wrap">';
		$out .= $template_wrapper;
		$out .= '</div>';
		$out .= '</div>';
		$out .= '</div>';
		return $out;
	}

	/**
	 * Slider Navigation
	 *
	 * @param array $wtl_settings settings arrray.
	 * @param array $wp_timeline_theme timeline theme.
	 * @param array $loop loop.
	 * @param array $temp_query temp query.
	 * @return html
	 */
	public static function slider_nav( $wtl_settings, $wp_timeline_theme, $loop, $temp_query ) {
		if ( 'advanced_layout' === $wp_timeline_theme ) {
			$layout_type         = $wtl_settings['layout_type'];
			$timeline_style_type = isset( $wtl_settings['timeline_style_type'] ) ? $wtl_settings['timeline_style_type'] : '';
			$i                   = 1;
			if ( 1 == $layout_type ) {
				ob_start();
				if ( $loop->have_posts() ) {
					?>
					<style>
					<?php
					while ( have_posts() ) :
						the_post();
						$title_color = self::post_background_color();
						if ( $title_color ) {
							?>
							.layout_skin_1 #wtl_layout_<?php echo esc_attr( get_the_ID() ); ?>.slick-active:after,
							#wtl_layout_<?php echo esc_attr( get_the_ID() ); ?>.slick-current:after{border-bottom-color:<?php echo esc_attr( $title_color ); ?> !important}
							<?php
							if ( 2 == $timeline_style_type || 5 == $timeline_style_type || 6 == $timeline_style_type ) {
								?>
								#wtl_layout_<?php echo esc_attr( get_the_ID() ); ?> .wtl-post-date *{ color:#fff;}
								.layout_skin_2 #wtl_layout_<?php echo esc_attr( get_the_ID() ); ?>.slick-active .wtl_icon_top:after,
								.layout_skin_5 #wtl_layout_<?php echo esc_attr( get_the_ID() ); ?>.slick-current .wtl_icon_top:after
								{
									border-color:<?php echo esc_attr( $title_color ); ?>
								}
								<?php
							} else {
								?>
								#wtl_layout_<?php echo esc_attr( get_the_ID() ); ?> .wtl-post-date,
								#wtl_layout_<?php echo esc_attr( get_the_ID() ); ?> .wtl-post-date a{color:<?php echo esc_attr( $title_color ); ?> !important}
								#wtl_layout_<?php echo esc_attr( get_the_ID() ); ?> .wtl_icon_top *{ color:<?php echo esc_attr( $title_color ); ?> !important}
								<?php
							}
							if ( 6 == $timeline_style_type ) {
								?>
								.layout_skin_6 #wtl_layout_<?php echo esc_attr( get_the_ID() ); ?>.slick-slide:after{
									background:linear-gradient(to bottom,<?php echo esc_attr( $title_color ); ?> 0, rgba(229,229,229,0) 65%); !important
								}                                
								<?php
							}
							?>
							.layout_skin_2 #wtl_layout_<?php echo esc_attr( get_the_ID() ); ?>.slick-active .wtl-post-date,
							.layout_skin_5 #wtl_layout_<?php echo esc_attr( get_the_ID() ); ?>.slick-current .wtl-post-date,
							.layout_skin_2 #wtl_layout_<?php echo esc_attr( get_the_ID() ); ?>.slick-active:after{background:<?php echo esc_attr( $title_color ); ?> !important}							
							.clayout_skin_6 #wtl_layout_<?php echo esc_attr( get_the_ID() ); ?> .wtl-post-date span,
							.clayout_skin_6 #wtl_layout_<?php echo esc_attr( get_the_ID() ); ?> .wtl-post-date a{ color:<?php echo esc_attr( $title_color ); ?> !important}
							<?php
						}
					endwhile;
					?>
					</style>
					<?php
					echo '<div class="wtl_al_nav layout_skin_' . esc_attr( $timeline_style_type ) . '">';
					while ( have_posts() ) :
						the_post();
						?>
						<div class="wtl-slitem_nav <?php echo 'post_' . esc_attr( self::even_odd( $i ) ); ?>" data-date="<?php echo 'post-id_' . get_the_ID(); ?>" data-slick-index="<?php echo esc_attr( $i ); ?>" id="wtl_layout_<?php echo get_the_ID(); ?>">
							<?php
							if ( 6 != $timeline_style_type ) {
								echo '<span class="wtl_icon_top">';
								self::get_post_date( $wtl_settings );
								echo '</span>';
							}
							self::get_timeline_icon( $wtl_settings );
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

	/**
	 * Java Script
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return html
	 */
	public static function js( $wtl_settings ) {
		$layout_type         = $wtl_settings['layout_type'];
		$timeline_style_type = isset( $wtl_settings['timeline_style_type'] ) ? $wtl_settings['timeline_style_type'] : '';
		if ( 1 == $layout_type ) {
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
				var responsive = [{breakpoint: 768,settings: {arrows:true,centerPadding: "10px",slidesToShow: 1}},{breakpoint: 480,settings: {arrows:true,centerPadding: "10px",slidesToShow: 1}}];
				$(".wtl_al_slider").slick({
					dots: false,
					infinite: false,
					pauseOnHover:true,
					slidesToShow:noofslide,
					autoplay:autoplay,
					asNavFor:'.wtl_al_nav',
					adaptiveHeight:true,
					autoplaySpeed:scroll_speed,
					<?php
					if ( 3 == $timeline_style_type ) {
						?>
							nextArrow:'<span class="wtl-ss-right"><i class="fas fa-angle-right"></i></span>',
							prevArrow:'<span class="wtl-ss-left"><i class="fas fa-angle-left"></i></span>',
							arrows:true,
							<?php
					} else {
						?>
						nextArrow:'',prevArrow:'',arrows:false,
						<?php
					}
					?>
													
					focusOnSelect:true,
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
					$(".wtl_al_nav").slick({
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
			$out = ob_get_contents();
			ob_end_clean();
			return $out;
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
	 * Get Post Date
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return void
	 */
	public static function get_timeline_icon( $wtl_settings ) {
		global $post;
		$wtl_details   = get_post_meta( $post->ID, '_wtl_single_details_key', true );
		$post_bg_color = isset( $wtl_details['wtl_background_color'] ) ? $wtl_details['wtl_background_color'] : '';
		$wtl_animation = isset( $wtl_settings['timeline_animation'] ) ? $wtl_settings['timeline_animation'] : 'fade';
		if ( $post_bg_color ) {
			$post_bg_color_set = 'style="background:' . $post_bg_color . ';"';
		} else {
			$post_bg_color_set = '';
		}
		$format = get_post_format( $post->ID );
		if ( 'status' === $format ) {
			$post_format = 'fas fa-comment';
		} elseif ( 'aside' === $format ) {
			$post_format = 'far fa-file-alt';
		} elseif ( 'image' === $format ) {
			$post_format = 'far fa-file-image';
		} elseif ( 'gallery' === $format ) {
			$post_format = 'far fa-file-image';
		} elseif ( 'link' === $format ) {
			$post_format = 'fas fa-link';
		} elseif ( 'quote' === $format ) {
			$post_format = 'fas fa-quote-left';
		} elseif ( 'audio' === $format ) {
			$post_format = 'fas fa-music';
		} elseif ( 'video' === $format ) {
			$post_format = 'fas fa-video';
		} elseif ( 'chat' === $format ) {
			$post_format = 'fab fa-weixin';
		} else {
			$post_format = 'fas fa-thumbtack';
		}
		?>
		<div class="wtl-post-center-image" data-aos="<?php echo esc_attr( $wtl_animation ); ?>">
			<?php
			// print_r($wtl_details['wtl_single_timeline_icon']);
			if ( ! empty( $wtl_details ) ) {
				$type = $wtl_details['wtl_single_display_timeline_icon'];
				if ( 'image' === $type ) {
					$img_src = $wtl_details['wtl_icon_image_src'];
					if ( $img_src ) {
						echo '<span ' . esc_attr( $post_bg_color_set ) . '><img src="' . esc_url( $img_src ) . '"></span>';
					} else {
						echo '<span  ' . esc_attr( $post_bg_color_set ) . '><i class="' . esc_attr( $post_format ) . '"></i> </span>';
					}
				} elseif ( 'fontawesome' === $type ) {
					$img_src = $wtl_details['wtl_single_timeline_icon'];
					if ( $img_src ) {
						echo '<span ' . esc_attr( $post_bg_color_set ) . '><i class="' . esc_attr( $img_src ) . '"></i> </span>';
					} else {
						echo '<span ' . esc_attr( $post_bg_color_set ) . '><i class="' . esc_attr( $post_format ) . '"></i> </span>';
					}
				} else {
					echo '<span ' . esc_attr( $post_bg_color_set ) . '><i class="' . esc_attr( $post_format ) . '"></i> </span>';
				}
			} else {
				echo '<span ' . esc_attr( $post_bg_color_set ) . '><i class="' . esc_attr( $post_format ) . '"></i> </span>';
			}
			?>
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
						<span class="link-lable"><?php esc_html_e( 'Category', 'wp-timeline-designer-pro' ); ?>: </span>
						<span class="post-category taxonomies<?php echo ( $taxonomy_link ) ? ' wp_timeline_no_links' : ' wp_timeline_has_link'; ?>">
							<?php
							foreach ( $term_list as $term_nm ) {
								$term_link = get_term_link( $term_nm );
								if ( 1 != $sep ) {
									echo ',&nbsp';
								}
								$disable_link_category = isset( $wtl_settings['disable_link_category'] ) ? $wtl_settings['disable_link_category'] : '';
								if ( 1 != $disable_link_category ) {
									echo ( $taxonomy_link ) ? '<a href="' . esc_url( $term_link ) . '">' : '';
								}
								echo esc_html( $term_nm->name );
								if ( 1 != $disable_link_category ) {
									echo ( $taxonomy_link ) ? '</a>' : '';
								}
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
						<span class="link-lable"><?php esc_html_e( 'Tag', 'wp-timeline-designer-pro' ); ?>: </span>
						<span class="tags <?php echo ( $tags_link ) ? 'wp_timeline_no_links' : 'wp_timeline_has_link'; ?>">
						<?php
						$disable_link_tag = isset( $wtl_settings['disable_link_tag'] ) ? $wtl_settings['disable_link_tag'] : '';
						foreach ( $post_tags as $tag ) {
							echo '<span class="wp-timeline-custom-tag">';
							if ( 1 != $sep ) {
								echo ',&nbsp';
							}
							if ( 1 != $disable_link_tag ) {
								echo ( $tags_link ) ? '<a href="' . esc_url( get_term_link( $tag->term_id ) ) . '">' : '';
							}
							echo esc_html( $tag->name );
							if ( 1 != $disable_link_tag ) {
								echo ( $tags_link ) ? '</a>' : '';
							}
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

	/**
	 * Get Social Icon
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return html
	 */
	public static function social_icon( $wtl_settings ) {
		ob_start();
		Wp_Timeline_Main::wtl_get_social_icons( $wtl_settings );
		$out = ob_get_contents();
		ob_end_clean();
		return $out;
	}

	/**
	 * Get Post Author
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return void
	 */
	public static function get_author( $wtl_settings ) {
		global $post;
		if ( isset( $wtl_settings['display_author'] ) && 1 == $wtl_settings['display_author'] ) {
			echo '<span class="wtl-author"><span class="link-lable">Author:</span> <span class="wtl-author-name">';
			echo wp_kses( Wp_Timeline_Main::wtl_get_post_auhtors( $post->ID, $wtl_settings ), Wp_Timeline_Public::args_kses() );
			echo '</span></span>';
		}
	}

	/**
	 * Get Post Date
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
					$out .= '<h1>' . $heading_1 . '</h1>';
			}
			if ( $heading_2 ) {
					$out .= '<h2>' . $heading_2 . '</h2>';
			}
				$out .= '</div>';
		}
		return $out;
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
			$wtl_animation       = isset( $wtl_settings['timeline_animation'] ) ? $wtl_settings['timeline_animation'] : 'fade';
			$timeline_style_type = isset( $wtl_settings['timeline_style_type'] ) ? $wtl_settings['timeline_style_type'] : '';
			$date_link           = ( isset( $wtl_settings['disable_link_date'] ) && 1 == $wtl_settings['disable_link_date'] ) ? false : true;
			$date_format         = ( isset( $wtl_settings['post_date_format'] ) && 'default' !== $wtl_settings['post_date_format'] ) ? $wtl_settings['post_date_format'] : get_option( 'date_format' );
			$wp_timeline_date    = ( isset( $wtl_settings['display_date_from'] ) && 'modify' === $wtl_settings['display_date_from'] ) ? apply_filters( 'wtl_date_format', get_post_modified_time( $date_format, $post->ID ), $post->ID ) : apply_filters( 'wtl_date_format', get_the_time( $date_format, $post->ID ), $post->ID );
			$ar_year             = get_the_time( 'Y' );
			$ar_month            = get_the_time( 'm' );
			$ar_day              = get_the_time( 'd' );
			$aos                 = '';
			if ( 4 == $timeline_style_type ) {
				$aos = 'data-aos="' . esc_attr( $wtl_animation ) . '"';
			}
			echo '<div class="wtl-post-date" ' . esc_attr( $aos ) . '>';
			echo ( $date_link ) ? '<a class="mdate" href="' . esc_url( get_day_link( $ar_year, $ar_month, $ar_day ) ) . '">' : '';
			echo '<span>';
			echo esc_html( $wp_timeline_date );
			echo '</span>';
			echo ( $date_link ) ? '</a>' : '';
			echo '</div>';
		}
	}

	/**
	 * Get Post title Background Color
	 *
	 * @return html
	 */
	public static function post_title_background_color() {
		global $post;
		$wtl_details            = get_post_meta( $post->ID, '_wtl_single_details_key', true );
		$post_bg_color          = isset( $wtl_details['wtl_background_color'] ) ? $wtl_details['wtl_background_color'] : '';
		$post_bg_only_for_title = isset( $wtl_details['wtl_background_color_opt'] ) ? $wtl_details['wtl_background_color_opt'] : 1;
		if ( $post_bg_color ) {
			if ( 1 == $post_bg_only_for_title ) {
				return $post_bg_color;
			}
		}
	}

	/**
	 * Get Post Background Color
	 *
	 * @return html
	 */
	public static function post_background_color() {
		global $post;
		$wtl_details        = get_post_meta( $post->ID, '_wtl_single_details_key', true );
		$post_content_color = isset( $wtl_details['wtl_background_color'] ) ? $wtl_details['wtl_background_color'] : '';
		if ( $post_content_color ) {
			return $post_content_color;
		}
	}

	/**
	 * Content Box Backgroudn Color
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return html
	 */
	public static function content_box_background_color( $wtl_settings ) {
		global $post;
		$wtl_details                        = get_post_meta( $post->ID, '_wtl_single_details_key', true );
		$post_bg_color                      = isset( $wtl_details['wtl_background_color'] ) ? $wtl_details['wtl_background_color'] : '';
		$post_bg_only_for_title             = isset( $wtl_details['wtl_background_color_opt'] ) ? $wtl_details['wtl_background_color_opt'] : 1;
		$template_content_box_bg_color = isset( $wtl_settings['template_content_box_bg_color'] ) ? $wtl_settings['template_content_box_bg_color'] : '';
		$post_bg_color                      = isset( $post_bg_color ) ? $post_bg_color : '';
		$template_box_bg_color              = isset( $template_content_box_bg_color ) ? $template_content_box_bg_color : '';
		if ( $post_bg_color ) {
			if ( 0 == $post_bg_only_for_title ) {
				$post_bg_color_set = 'style="background:' . $post_bg_color . ' !important;"';
			} else {
				if ( $template_box_bg_color ) {
					$post_bg_color_set = 'style="background:' . $template_box_bg_color . ' !important;"';
				} else {
					$post_bg_color_set = '';
				}
			}
		} else {
			if ( $template_box_bg_color ) {
				$post_bg_color_set = 'style="background:' . $template_box_bg_color . ' !important;"';
			} else {
				$post_bg_color_set = '';
			}
		}
		return $post_bg_color_set;
	}
	/**
	 * Get Box Border Radious Title
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return html
	 */
	public static function content_box_border_radious_title( $wtl_settings ) {
		$border_radius = isset( $wtl_settings['wp_timeline_content_border_radius'] ) ? $wtl_settings['wp_timeline_content_border_radius'] : '';
		if ( $border_radius || 0 == $border_radius ) {
			return 'border-top-left-radius:' . $border_radius . 'px !important; border-top-right-radius:' . $border_radius . 'px !important;';
		}
	}
}

$wtl_template_advanced_layout = new Wtl_Template_Advanced_Layout();
