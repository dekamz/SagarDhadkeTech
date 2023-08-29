<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.solwininfotech.com/
 * @since      1.0.0
 *
 * @package    Wp_Timeline_Designer_PRO_Main
 * @subpackage Wp_Timeline_Designer_PRO_Main/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Wp_Timeline_Designer_PRO_Main
 * @subpackage Wp_Timeline_Designer_PRO_Main/includes
 * @author     Solwin Infotech <info@solwininfotech.com>
 */
class Wp_Timeline_Main {

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;
	/**
	 * The current version of the plugin.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Class Cunstruction.
	 *
	 * @since  1.0.0
	 * @param string $plugin_name plugin name.
	 * @param string $version version.
	 * @var   string    $version    The current version of the plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		add_action( 'init', array( $this, 'wtl_woocommerce_plugin' ) );
		add_action( 'wp_ajax_nopriv_wtl_get_acf_field_list', array( $this, 'wtl_get_acf_field_list' ) );
		add_action( 'wp_ajax_wtl_get_acf_field_list', array( $this, 'wtl_get_acf_field_list' ) );

		add_action( 'wp_ajax_nopriv_wtl_get_posts', array( $this, 'wtl_get_posts' ) );
		add_action( 'wp_ajax_wtl_get_posts', array( $this, 'wtl_get_posts' ) );

		add_action( 'wp_ajax_wtl_get_custom_taxonomy_terms', array( $this, 'wtl_get_custom_taxonomy_terms' ) );
		add_filter( 'wtl_hide_taxonomies', array( $this, 'wtl_hide_taxonomies' ), 10 );

		add_action( 'wp_ajax_nopriv_wtl_get_timeline_post_list', array( $this, 'wtl_get_timeline_post_list' ) );
		add_action( 'wp_ajax_wtl_get_timeline_post_list', array( $this, 'wtl_get_timeline_post_list' ) );

		add_action( 'wtl_woo_sale_tag', array( $this, 'wtl_woo_display_sale_tag' ) );
		add_action( 'wtl_woo_product_details', array( $this, 'wtl_woo_display_product_details' ), 10, 2 );
		add_action( 'wtl_edd_product_details', array( $this, 'wtl_edd_display_product_details' ), 10, 2 );

		add_action( 'wp_ajax_nopriv_get_load_onscroll_blog', array( &$this, 'wtl_load_onscroll_blog' ), 12 );
		add_action( 'wp_ajax_get_load_onscroll_blog', array( &$this, 'wtl_load_onscroll_blog' ), 12 );
		add_action( 'wp_ajax_nopriv_get_load_onscroll_date', array( &$this, 'wtl_load_onscroll_date' ), 12 );
		add_action( 'wp_ajax_get_load_onscroll_date', array( &$this, 'wtl_load_onscroll_date' ), 12 );
	}
	/**
	 * Get html of layout from layout id
	 *
	 * @param int   $layout_id layout id.
	 * @param array $wtl_settings wtl settings.
	 * @return html Timeline Layout design
	 */
	public static function wtl_layout_view_portion( $layout_id, $wtl_settings ) {
		wp_reset_postdata();
		global $wp_query;
		$template_wrapper        = '';
		$posts                   = self::wtl_get_wp_query( $wtl_settings );
		$temp_query              = $wp_query;
		$loop                    = new WP_Query( $posts );
		$wp_query                = $loop;
		$max_num_pages           = $wp_query->max_num_pages;
		$sticky_posts            = get_option( 'sticky_posts' );
		$class                   = '';
		$count_sticky            = 0;
		$wp_timeline_theme       = $wtl_settings['template_name'];
		$posts_per_page          = $wtl_settings['posts_per_page'];
		$wp_timeline_post_offset = ( isset( $wtl_settings['wp_timeline_post_offset'] ) && ! empty( $wtl_settings['wp_timeline_post_offset'] ) ) ? $wtl_settings['wp_timeline_post_offset'] : '0';
		$layout_type             = $wtl_settings['layout_type'];
		if ( isset( $wtl_settings['wp_timeline_blog_order_by'] ) ) {
			$orderby = $wtl_settings['wp_timeline_blog_order_by'];
		}
		$main_container_class = ( isset( $wtl_settings['main_container_class'] ) && '' != $wtl_settings['main_container_class'] ) ? $wtl_settings['main_container_class'] : '';
		$template             = '';
		if ( 'accordion' === $wp_timeline_theme ) {
			$template .= "<div class='wp-timeline-accordion-wrap'>";
		}
		if ( $max_num_pages > 1 && 'load_more_btn' === $wtl_settings['pagination_type'] ) {
			$template .= "<div class='wp-timeline-load-more-pre'>";
		}
		if ( $max_num_pages > 1 && 'load_onscroll_btn' === $wtl_settings['pagination_type'] ) {
			$template .= "<div class='wtl-load-onscroll-pre' id='wtl-load-onscroll-pre'>";
		}
		if ( 'cool_horizontal' === $wp_timeline_theme || 'overlay_horizontal' === $wp_timeline_theme ) {
			$template .= '<div class="logbook flatLine flatNav flatButton">';
			if ( 'cool_horizontal' === $wp_timeline_theme || 'overlay_horizontal' === $wp_timeline_theme ) {
				$template .= '<div class="lb-items-wrapper"><div class="lb-items-holder"><div class="lb-items">';
			}
		}
		if ( $loop->have_posts() ) {
			$ajax_preious_year  = '';
			$ajax_preious_month = '';
			$paged              = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$i                  = 1;
			/* Posts Loop Start here. */
			while ( have_posts() ) :
				the_post();
				if ( $wp_timeline_theme ) {
					$wp_timeline_theme_file = self::wtl_blog_file_name( $wp_timeline_theme );
					$template              .= self::wtl_get_blog_template( 'blog/' . $wp_timeline_theme_file . '.php', $wtl_settings, $paged, $count_sticky, $i );
				}

				$i++;
			endwhile;
			/* Posts Loop End here. */

		} else {
			$template .= esc_html__( 'No posts found.', 'wp-timeline-designer-pro' );
		}
		if ( 'cool_horizontal' === $wp_timeline_theme || 'overlay_horizontal' === $wp_timeline_theme ) {
			wp_reset_postdata();
			if ( 'cool_horizontal' === $wp_timeline_theme ) {
				$template .= '</div></div></div>';
			}
			$template .= '</div>';
		}
		if ( 'accordion' === $wp_timeline_theme ) {
			$template .= '</div>';
		}
		/* Filter & Sort Start */
		$slider_array    = array( 'cool_horizontal', 'overlay_horizontal' );
		$display_filter  = isset( $wtl_settings['display_filter'] ) ? $wtl_settings['display_filter'] : '0';
		$pagination_html = '';
		if ( 1 != $display_filter ) {
			if ( ! in_array( $wp_timeline_theme, $slider_array, true ) && 'no_pagination' !== $wtl_settings['pagination_type'] ) {
				if ( $max_num_pages > 1 && 'load_more_btn' === $wtl_settings['pagination_type'] ) {
					$template       .= '</div>';
					$is_loadmore_btn = '';
					if ( $max_num_pages > 1 ) {
						$is_loadmore_btn = '';
					} else {
						$is_loadmore_btn = '1';
					}
					if ( is_front_page() ) {
						$wtl_paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
					} else {
						$wtl_paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
					}
					$pagination_html .= '<form name="wtl-load-more-hidden" id="wtl-load-more-hidden">';
					$pagination_html .= '<input type="hidden" name="paged" id="paged" value="' . esc_attr( $wtl_paged ) . '" />';
					$pagination_html .= '<input type="hidden" name="posts_per_page" id="posts_per_page" value="' . esc_attr( $posts_per_page ) . '" />';
					$pagination_html .= '<input type="hidden" name="max_num_pages" id="max_num_pages" value="' . esc_attr( $max_num_pages ) . '" />';
					$pagination_html .= '<input type="hidden" name="wtl_blog_template" id="wtl_blog_template" value="' . esc_attr( $wp_timeline_theme ) . '" />';
					$pagination_html .= '<input type="hidden" name="wp_timeline_blog_layout" id="wp_timeline_blog_layout" value="wp_timeline_blog_layout" />';
					$pagination_html .= '<input type="hidden" name="wp_timeline_blog_shortcode_id" id="wp_timeline_blog_shortcode_id" value="' . esc_attr( $layout_id ) . '" />';
					$pagination_html .= self::wp_timeline_get_loader( $wtl_settings );
					$pagination_html .= '</form>';
					if ( '' == $is_loadmore_btn ) {
						$class            = isset( $wtl_settings['load_more_button_template'] ) ? $wtl_settings['load_more_button_template'] : 'template-1';
						$pagination_html .= '<div class="wp-timeline-load-more text-center" style="float:left;width:100%">';
						$pagination_html .= '<a href="javascript:void(0);" class="button wp-timeline-load-more-btn ' . esc_attr( $class ) . '">';
						if ( 'template-3' === $class ) {
							$template .= '<span class="wp-timeline-lmb-top"></span>';
						}
						$pagination_html .= ( isset( $wtl_settings['loadmore_button_text'] ) && '' != $wtl_settings['loadmore_button_text'] ) ? $wtl_settings['loadmore_button_text'] : esc_html__( 'Load More', 'wp-timeline-designer-pro' );
						if ( 'template-3' === $class ) {
							$pagination_html .= '<span class="wp-timeline-lmb-bottom"></span>';
						}
						$pagination_html .= '</a>';
						$pagination_html .= '</div>';
					}
				} elseif ( $max_num_pages > 1 && 'load_onscroll_btn' === $wtl_settings['pagination_type'] ) {
					$template            .= '</div>';
					$is_load_onscroll_btn = '';
					if ( $max_num_pages > 1 ) {
						$is_load_onscroll_btn = '';
					} else {
						$is_load_onscroll_btn = '1';
					}
					if ( is_front_page() ) {
						$wtl_paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
					} else {
						$wtl_paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
					}
					$pagination_html .= '<form name="wtl-load-more-hidden" id="wtl-load-more-hidden">';
					$pagination_html .= '<input type="hidden" name="paged" id="paged" value="' . esc_attr( $wtl_paged ) . '" />';
					$pagination_html .= '<input type="hidden" name="posts_per_page" id="posts_per_page" value="' . esc_attr( $posts_per_page ) . '" />';
					$pagination_html .= '<input type="hidden" name="max_num_pages" id="max_num_pages" value="' . esc_attr( $max_num_pages ) . '" />';
					$pagination_html .= '<input type="hidden" name="wtl_blog_template" id="wtl_blog_template" value="' . esc_attr( $wp_timeline_theme ) . '" />';
					$pagination_html .= '<input type="hidden" name="wp_timeline_blog_layout" id="wp_timeline_blog_layout" value="wp_timeline_blog_layout" />';
					$pagination_html .= '<input type="hidden" name="wp_timeline_blog_shortcode_id" id="wp_timeline_blog_shortcode_id" value="' . esc_attr( $layout_id ) . '" />';
					$pagination_html .= self::wp_timeline_get_loader( $wtl_settings );
					$pagination_html .= '</form>';
					if ( '' == $is_load_onscroll_btn ) {
						$class            = '';
						$pagination_html .= '<div class="wtl-load-onscroll text-center">';
						$pagination_html .= '<a href="javascript:void(0);" class="button wtl-load-onscroll-btn ' . esc_attr( $class ) . '">';
						$pagination_html .= esc_html__( 'Loading Posts', 'wp-timeline-designer-pro' ) . '</a>';
						$pagination_html .= '</div>';
					}
				}
				if ( 'paged' == $wtl_settings['pagination_type'] ) {
					$pagination_template = isset( $wtl_settings['pagination_template'] ) ? $wtl_settings['pagination_template'] : 'template-1';
					$pagination_html    .= '<div class="wl_pagination_box ' . esc_attr( $pagination_template ) . '">';
					$pagination_html    .= self::wp_timeline_shortcode_standard_paging_nav( $wtl_settings );
					$pagination_html    .= '</div>';
				}
				wp_reset_postdata();
				$wp_query = null;
				$wp_query = $temp_query;
			}
		}
		if ( isset( $wtl_settings['wp_timeline_display_sort_by'] ) && 1 == $wtl_settings['wp_timeline_display_sort_by'] ) {
			$wp_timeline_display_front_sortby = array();
			if ( isset( $wtl_settings['wp_timeline_display_front_sortby'] ) && ! empty( $wtl_settings['wp_timeline_display_front_sortby'] ) ) {
				$wp_timeline_display_front_sortby = $wtl_settings['wp_timeline_display_front_sortby'];
			}
			$template_wrapper .= '<div class="wp_timeline_sortby_wrap"><div class="wp_timeline_sort_by_wrapper">';
			$template_wrapper .= '<select name="wp_timeline_sort_by" id="wp_timeline_sort_by">';
			$template_wrapper .= '<option value="">' . esc_html__( 'Default Sort', 'wp-timeline-designer-pro' ) . '</option>';
			$getsortby         = '';
			if ( ! empty( $wp_timeline_display_front_sortby ) ) {
				if ( isset( $_GET['sortby'] ) && '' != $_GET['sortby'] ) {
					$getsortby = sanitize_text_field( wp_unslash( $_GET['sortby'] ) );
				}
				foreach ( $wp_timeline_display_front_sortby as $sortby ) {
					$if_selected = '';
					if ( $sortby == $getsortby ) {
						$if_selected = "selected='selected'";
					}
					if ( 'rand' === $sortby ) {
						$sortbylabel = esc_html__( 'Random', 'wp-timeline-designer-pro' );
					} elseif ( 'ID' === $sortby ) {
						$sortbylabel = esc_html__( 'Post ID', 'wp-timeline-designer-pro' );
					} elseif ( 'author' === $sortby ) {
						$sortbylabel = esc_html__( 'Author', 'wp-timeline-designer-pro' );
					} elseif ( 'title' == $sortby ) {
						$sortbylabel = esc_html__( 'Post Title', 'wp-timeline-designer-pro' );
					} elseif ( 'name' === $sortby ) {
						$sortbylabel = esc_html__( 'Post Slug', 'wp-timeline-designer-pro' );
					} elseif ( 'date' === $sortby ) {
						$sortbylabel = esc_html__( 'Publish Date', 'wp-timeline-designer-pro' );
					} elseif ( 'modified' === $sortby ) {
						$sortbylabel = esc_html__( 'Modified Date', 'wp-timeline-designer-pro' );
					} elseif ( 'meta_value_num' === $sortby ) {
						$sortbylabel = esc_html__( 'Post Likes', 'wp-timeline-designer-pro' );
					}
					$template_wrapper .= '<option value="' . esc_attr( $sortby ) . '" ' . esc_attr( $if_selected ) . '>' . $sortbylabel . '</option>';
				}
			}
			$template_wrapper .= '</select></div></div>';
		}
		/* Filter & Sort End */
		if ( 1 != $layout_type ) {
			wp_reset_postdata();
			$wp_query = null;
			$wp_query = $temp_query;
		}
		$template .= $pagination_html;
		/* --- Without HTML ---  */
		if ( 'rounded_layout' === $wp_timeline_theme || 'cover_layout' === $wp_timeline_theme || 'wise_layout' === $wp_timeline_theme || 'boxy_layout' === $wp_timeline_theme || 'glossary_layout' === $wp_timeline_theme || 'business_layout' === $wp_timeline_theme || 'timeline_graph_layout' === $wp_timeline_theme || 'milestone_layout' === $wp_timeline_theme || 'story_layout' === $wp_timeline_theme || 'year_layout' === $wp_timeline_theme || 'easy_layout' === $wp_timeline_theme || 'fullhorizontal_layout' === $wp_timeline_theme || 'attract_layout' === $wp_timeline_theme || 'processinfo_layout' === $wp_timeline_theme || 'divide_layout' === $wp_timeline_theme || 'topdivide_layout' === $wp_timeline_theme || 'hire_layout' === $wp_timeline_theme || 'curve_layout' === $wp_timeline_theme || 'advanced_layout' === $wp_timeline_theme || 'verticalblur_layout' === $wp_timeline_theme || 'fullvertical_layout' === $wp_timeline_theme || 'zigzag_layout' === $wp_timeline_theme || 'columy_layout' === $wp_timeline_theme || 'leafty_layout' == $wp_timeline_theme || 'sportking_layout' == $wp_timeline_theme || 'filledtimeline_layout' == $wp_timeline_theme || 'classictimeline_layout' == $wp_timeline_theme || 'milestonetimeline_layout' == $wp_timeline_theme ) {
			$template_wrapper .= $template;
		} else {
			/* --- With HTML --- */
			if ( 1 == $wtl_settings['wp_year_timeline_side'] && 'infographic_layout' != $wp_timeline_theme ) {
				$template_wrapper .= '<div class="wtl-bullets-container">';
				$template_wrapper .= '<ul class="section-bullets-right">';
				$template_wrapper .= Wtl_Template_Config::get_post_year( $wtl_settings );
				$template_wrapper .= '</ul>';
				$template_wrapper .= '</div>';
			}
			$template_wrapper .= '<div class="wtl_wrapper wp_timeline_post_list ' . esc_attr( $wp_timeline_theme ) . '_cover layout_id_' . esc_attr( $layout_id ) . '">';
			if ( '' != $main_container_class ) {
				$template_wrapper .= '<div class="' . esc_attr( $main_container_class ) . '">';
			}
			$template_wrapper .= $template;
			if ( '' != $main_container_class ) {
				$template_wrapper .= '</div>';
			}
			$template_wrapper .= '</div>';
		}

		if ( 'milestone_layout' === $wp_timeline_theme ) {
			return Wtl_Template_Milestone_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} elseif ( 'fullwidth_layout' === $wp_timeline_theme ) {
			return Wtl_Template_Fullwidth_Layout::render( $layout_id, $wtl_settings, $template_wrapper );

		} elseif ( 'year_layout' === $wp_timeline_theme ) {
			return Wtl_Template_Year_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} elseif ( 'cool_horizontal' === $wp_timeline_theme || 'overlay_horizontal' === $wp_timeline_theme ) {
			ob_start();
			?>
			<script type="text/javascript">
			jQuery(document).ready(function(){
				(function($){
					"use strict";
					var wtl_asssigned_slider = $('.logbook');
					var lid='<?php echo esc_attr( $layout_id ); ?>';
					if(lid != 'no_shortcode') {
						wtl_asssigned_slider =  $('.layout_id_'+lid+' .logbook')
					}
					wtl_asssigned_slider.logbook({
						levels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
						showYears: 10,del: 130,vertical: false,isPostLink: false,isYears: false,triggerWidth: 800,
						itemMargin: <?php echo ( isset( $wtl_settings['template_post_margin'] ) ) ? esc_attr( $wtl_settings['template_post_margin'] ) : 20; ?>,
						customSize: {"sheet": {"itemWidth": <?php echo ( ( isset( $wtl_settings['item_width'] ) && '' !== $wtl_settings['item_width'] ) ? esc_attr( $wtl_settings['item_width'] ) : 400 ); ?>, "itemHeight": "<?php echo ( ( isset( $wtl_settings['item_height'] ) && '' !== $wtl_settings['item_height'] ) ? esc_attr( $wtl_settings['item_height'] ) : 570 ); ?>", "margin": "<?php echo ( isset( $wtl_settings['template_post_margin'] ) && $wtl_settings['template_post_margin'] ) ? esc_attr( $wtl_settings['template_post_margin'] ) : 20; ?>"},"active": {"itemWidth": <?php echo ( ( isset( $wtl_settings['item_width'] ) && '' !== $wtl_settings['item_width'] ) ? esc_attr( $wtl_settings['item_width'] ) : 400 ); ?>, "itemHeight": "<?php echo ( ( isset( $wtl_settings['item_height'] ) && '' !== $wtl_settings['item_height'] ) ? esc_attr( $wtl_settings['item_height'] ) : 570 ); ?>", "imageHeight": "150"}},
						id: 10,
						easing: '<?php echo esc_attr( $wtl_settings['template_easing'] ); ?>',
						enableSwipe: true,
						startFrom: '<?php echo ( isset( $wtl_settings['timeline_start_from'] ) ) ? esc_attr( $wtl_settings['timeline_start_from'] ) : 'last'; ?>',
						enableYears: true,
						class: { readMore: '.lb-read-more' },
						hideLogbook: <?php echo ( 1 == $wtl_settings['display_timeline_bar'] ) ? 'true' : 'false'; ?>, hideArrows: false, closeItemOnTransition: false,
						autoplay: <?php echo ( 1 == $wtl_settings['enable_autoslide'] ) ? 'true' : 'false'; ?>,
						scrollSpeed: <?php echo isset( $wtl_settings['scroll_speed'] ) ? esc_attr( $wtl_settings['scroll_speed'] ) : 1000; ?>,
					});
				}(jQuery))
			});
			</script>
			<?php
			$out = ob_get_contents();
			ob_end_clean();
			return $template_wrapper . $out;
		} elseif ( 'advanced_layout' === $wp_timeline_theme ) {
			if ( 1 == $layout_type ) {
				$timeline_style_type = isset( $wtl_settings['timeline_style_type'] ) ? $wtl_settings['timeline_style_type'] : '0';
				$nav_posts           = Wtl_Template_Advanced_Layout::slider_nav( $wtl_settings, $wp_timeline_theme, $loop, $temp_query );
				$template_wrapper    = $nav_posts . '<div class="wtl_al_slider clayout_skin_' . esc_attr( $timeline_style_type ) . '">' . $template_wrapper . '</div>';
			}
			return Wtl_Template_Advanced_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} elseif ( 'verticalblur_layout' === $wp_timeline_theme ) {
			if ( 1 == $layout_type ) {
				$timeline_style_type = isset( $wtl_settings['timeline_style_type'] ) ? $wtl_settings['timeline_style_type'] : '0';
				$nav_posts           = apply_filters( 'wtl_before_post_loop', $wtl_settings, $wp_timeline_theme, $loop, $temp_query );
				$template_wrapper    = $nav_posts . '<div class="wtl_al_slider clayout_skin_' . esc_attr( $timeline_style_type ) . '">' . $template_wrapper . '</div>';
			}
			return Wtl_Template_Verticalblur_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} elseif ( 'hire_layout' === $wp_timeline_theme ) {
			if ( 1 == $layout_type ) {
				$nav_posts        = Wtl_Template_Hire_Layout::slider_nav( $wtl_settings, $wp_timeline_theme, $loop, $temp_query );
				$template_wrapper = $nav_posts . '<section class="wtl_al_slider">' . $template_wrapper . '</section>';
			}
			return Wtl_Template_Hire_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} elseif ( 'curve_layout' === $wp_timeline_theme ) {
			if ( 1 == $layout_type ) {
				$nav_posts        = Wtl_Template_Curve_Layout::slider_nav( $wtl_settings, $wp_timeline_theme, $loop, $temp_query );
				$template_wrapper = $nav_posts . '<div class="wtl_al_slider">' . $template_wrapper . '</div>';
			}
			return Wtl_Template_Curve_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} elseif ( 'story_layout' === $wp_timeline_theme ) {
			return Wtl_Template_Story_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} elseif ( 'glossary_layout' === $wp_timeline_theme ) {
			if ( 1 == $layout_type ) {
				$nav_posts        = Wtl_Template_Glossary_Layout::slider_nav( $wtl_settings, $wp_timeline_theme, $loop, $temp_query );
				$template_wrapper = $nav_posts . '<section class="wtl_al_slider">' . $template_wrapper . '</section>';
				// Rested query add for temp.
				wp_reset_postdata();
				$wp_query = null;
				$wp_query = $temp_query;
				// Reset ended.
			}
			return Wtl_Template_Glossary_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} elseif ( 'business_layout' === $wp_timeline_theme ) {
			if ( 1 == $layout_type ) {
				$nav_posts        = Wtl_Template_Business_Layout::slider_nav( $wtl_settings, $wp_timeline_theme, $loop, $temp_query );
				$template_wrapper = $nav_posts . '<section class="wtl_al_slider">' . $template_wrapper . '</section>';
				// Rested query add for temp.
				wp_reset_postdata();
				$wp_query = null;
				$wp_query = $temp_query;
				// Reset ended.
			}
			return Wtl_Template_Business_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} elseif ( 'timeline_graph_layout' === $wp_timeline_theme ) {
			if ( 1 == $layout_type ) {
				$nav_posts        = Wtl_Template_Timeline_Graph_Layout::slider_nav( $wtl_settings, $wp_timeline_theme, $loop, $temp_query );
				$template_wrapper = $nav_posts . '<section class="wtl_al_slider">' . $template_wrapper . '</section>';
				// Rested query add for temp.
				wp_reset_postdata();
				$wp_query = null;
				$wp_query = $temp_query;
				// Reset ended.
			}
			return Wtl_Template_Timeline_Graph_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} elseif ( 'boxy_layout' === $wp_timeline_theme ) {
			if ( 1 == $layout_type ) {
				$nav_posts        = Wtl_Template_Boxy_Layout::slider_nav( $wtl_settings, $wp_timeline_theme, $loop, $temp_query );
				$template_wrapper = $nav_posts . '<section class="wtl_al_slider">' . $template_wrapper . '</section>';
				// Rested query add for temp.
				wp_reset_postdata();
				$wp_query = null;
				$wp_query = $temp_query;
				// Reset ended.
			}
			return Wtl_Template_Boxy_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} elseif ( 'fullvertical_layout' === $wp_timeline_theme ) {
			if ( 1 == $layout_type ) {
				$nav_posts        = Wtl_Template_Fullvertical_Layout::slider_nav( $wtl_settings, $wp_timeline_theme, $loop, $temp_query );
				$template_wrapper = $nav_posts . '<div class="wtl_al_slider">' . $template_wrapper . '</div>';
			}
			return Wtl_Template_Fullvertical_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} elseif ( 'wise_layout' === $wp_timeline_theme ) {
			if ( 1 == $layout_type ) {
				$nav_posts        = Wtl_Template_Wise_Layout::slider_nav( $wtl_settings, $wp_timeline_theme, $loop, $temp_query );
				$template_wrapper = $nav_posts . '<section class="wtl_al_slider">' . $template_wrapper . '</section>';
				// Rested query add for temp.
				wp_reset_postdata();
				$wp_query = null;
				$wp_query = $temp_query;
				// Reset ended.
			}
			return Wtl_Template_Wise_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} elseif ( 'cover_layout' === $wp_timeline_theme ) {
			if ( 1 == $layout_type ) {
				$nav_posts        = Wtl_Template_Cover_Layout::slider_nav( $wtl_settings, $wp_timeline_theme, $loop, $temp_query );
				$template_wrapper = $nav_posts . '<section class="wtl_al_slider">' . $template_wrapper . '</section>';
				// Rested query add for temp.
				wp_reset_postdata();
				$wp_query = null;
				$wp_query = $temp_query;
				// Reset ended.
			}
			return Wtl_Template_Cover_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} elseif ( 'easy_layout' === $wp_timeline_theme ) {
			if ( 1 == $layout_type ) {
				$nav_posts        = Wtl_Template_Easy_Layout::slider_nav( $wtl_settings, $wp_timeline_theme, $loop, $temp_query );
				$template_wrapper = $nav_posts . '<div class="wtl_al_slider">' . $template_wrapper . '</div>';
			}
			return Wtl_Template_Easy_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} elseif ( 'fullhorizontal_layout' === $wp_timeline_theme ) {
			$template_wrapper = '<section class="wtl_al_slider">' . $template_wrapper . '</section>';
			// Rested query add for temp.
			// wp_reset_postdata();
			// $wp_query = null;
			// $wp_query = $temp_query;
			// Reset ended.

			return Wtl_Template_Fullhorizontal_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} elseif ( 'attract_layout' === $wp_timeline_theme ) {
				$count            = 1;
				$nav_posts        = Wtl_Template_Attract_Layout::slider_nav( $wtl_settings, $wp_timeline_theme, $loop, $temp_query );
				$template_wrapper = $nav_posts . '<div class="wtl_al_slider">' . $template_wrapper . '</div>';
			return Wtl_Template_Attract_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} elseif ( 'processinfo_layout' === $wp_timeline_theme ) {
			$template_wrapper = '<div class="wtl_al_slider">' . $template_wrapper . '</div>';
			return Wtl_Template_Processinfo_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} elseif ( 'divide_layout' === $wp_timeline_theme ) {
			$nav_posts        = Wtl_Template_Divide_Layout::slider_nav( $wtl_settings, $wp_timeline_theme, $loop, $temp_query );
			$template_wrapper = '<section class="wtl_al_slider">' . $template_wrapper . '</section>' . $nav_posts;
			// Rested query add for temp.
			wp_reset_postdata();
			$wp_query = null;
			$wp_query = $temp_query;
			// Reset ended.

			return Wtl_Template_Divide_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} elseif ( 'topdivide_layout' === $wp_timeline_theme ) {
			$nav_posts        = Wtl_Template_Topdivide_Layout::slider_nav( $wtl_settings, $wp_timeline_theme, $loop, $temp_query );
			$template_wrapper = $nav_posts . '<section class="wtl_al_slider">' . $template_wrapper . '</section>';
			// Rested query add for temp.
			wp_reset_postdata();
			$wp_query = null;
			$wp_query = $temp_query;
			// Reset ended.

			return Wtl_Template_Topdivide_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} elseif ( 'rounded_layout' === $wp_timeline_theme ) {
			if ( 1 == $layout_type ) {
				$nav_posts        = Wtl_Template_Rounded_Layout::slider_nav( $wtl_settings, $wp_timeline_theme, $loop, $temp_query );
				$template_wrapper = $nav_posts . '<section class="wtl_al_slider">' . $template_wrapper . '</section>';
				// Rested query add for temp.
				wp_reset_postdata();
				$wp_query = null;
				$wp_query = $temp_query;
				// Reset ended.
			}
			return Wtl_Template_Rounded_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} elseif ( 'infographic_layout' === $wp_timeline_theme ) {
			return Wtl_Template_Infographic_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} elseif ( 'zigzag_layout' === $wp_timeline_theme ) {
			wp_reset_postdata();
			return Wtl_Template_ZigZag_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} elseif ( 'columy_layout' === $wp_timeline_theme ) {
			$template_wrapper = '<div class="wtl_al_slider columy_layout">' . $template_wrapper . '</div>';
			// Rested query add for temp.
			wp_reset_postdata();
			$wp_query = null;
			$wp_query = $temp_query;
			// Reset ended.

			return Wtl_Template_Columy_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} elseif ( 'leafty_layout' === $wp_timeline_theme ) {
			if ( 1 == $layout_type ) {
				$nav_posts        = Wtl_Template_Leafty_Layout::slider_nav( $wtl_settings, $wp_timeline_theme, $loop, $temp_query );
				$template_wrapper = $nav_posts . '<div class="wtl_al_slider">' . $template_wrapper . '</div>';
			}
			return Wtl_Template_Leafty_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} elseif ( 'sportking_layout' === $wp_timeline_theme ) {
			if ( 1 == $layout_type ) {
				$template_wrapper = '<div class="wtl_al_slider">' . $template_wrapper . '</div>';
			}
			return Wtl_Template_Sportking_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} elseif ( 'filledtimeline_layout' === $wp_timeline_theme ) {
			if ( 1 == $layout_type ) {
				$nav_posts        = Wtl_Template_Filledtimeline_Layout::slider_nav( $wtl_settings, $wp_timeline_theme, $loop, $temp_query );
				$template_wrapper = $nav_posts . '<div class="wtl_al_slider">' . $template_wrapper . '</div>';
			}
			return Wtl_Template_Filledtimeline_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} elseif ( 'classictimeline_layout' === $wp_timeline_theme ) {
			return Wtl_Template_Classictimeline_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} elseif ( 'milestonetimeline_layout' === $wp_timeline_theme ) {
			$template_wrapper = '<div class="wtl_al_slider">' . $template_wrapper . '</div>';
			// Rested query add for temp.
			wp_reset_postdata();
			$wp_query = null;
			$wp_query = $temp_query;
			// Reset ended.

			return Wtl_Template_Milestonetimeline_Layout::render( $layout_id, $wtl_settings, $template_wrapper );
		} else {
			return $template_wrapper;
		}
		if ( 1 == $layout_type ) {
			wp_reset_postdata();
			$wp_query = null;
			$wp_query = $temp_query;
		}
	}
	/**
	 * WP Timeline Designer PRO Woo Commerce Plugin
	 *
	 * @since  1.0.0
	 * @return boolean
	 */
	public static function wtl_woocommerce_plugin() {
		if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Post Box Classes
	 *
	 * @param int    $id id.
	 * @param string $page page.
	 * @return array
	 */
	public static function wtl_postbox_classes( $id, $page ) {
		$closed = get_user_option( 'wptclosewptboxes_' . $page );
		if ( $closed ) {
			if ( ! is_array( $closed ) ) {
				$classes = array( '' );
			} else {
				$classes = in_array( $id, $closed, true ) ? array( 'closed' ) : array( '' );
			}
		} else {
			$classes = array( '' );
		}
		return implode( ' ', $classes );
	}

	/**
	 * Funtion to display color preset
	 *
	 * @param string $display_color color.
	 * @return void
	 */
	public static function wtl_admin_color_preset( $display_color ) {
		$color_value = explode( ',', $display_color );
		$fcolor      = $color_value[0];
		$scolor      = $color_value[1];
		$tcolor      = $color_value[2];
		$fourthcolor = $color_value[3];
		?>
		<div class="color-palette">
			<span style="background-color:<?php echo esc_attr( $fcolor ); ?>"></span>
			<span style="background-color:<?php echo esc_attr( $scolor ); ?>"></span>
			<span style="background-color:<?php echo esc_attr( $tcolor ); ?>"></span>
			<span style="background-color:<?php echo esc_attr( $fourthcolor ); ?>"></span>
		</div>
		<?php
	}

	/**
	 * Initialise an array of all recognized font faces.
	 *
	 * @return array $default
	 */
	public static function wtl_default_recognized_font_faces() {
		$google_fonts_arr = array();
		$default_fonts    = array(
			array(
				'type'    => 'websafe',
				'version' => esc_html__( 'Serif Fonts', 'wp-timeline-designer-pro' ),
				'label'   => 'Georgia, serif',
			),
			array(
				'type'    => 'websafe',
				'version' => esc_html__( 'Serif Fonts', 'wp-timeline-designer-pro' ),
				'label'   => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
			),
			array(
				'type'    => 'websafe',
				'version' => esc_html__( 'Serif Fonts', 'wp-timeline-designer-pro' ),
				'label'   => '"Times New Roman", Times, serif',
			),
			array(
				'type'    => 'websafe',
				'version' => esc_html__( 'Sans-Serif Fonts', 'wp-timeline-designer-pro' ),
				'label'   => 'Arial, Helvetica, sans-serif',
			),
			array(
				'type'    => 'websafe',
				'version' => esc_html__( 'Sans-Serif Fonts', 'wp-timeline-designer-pro' ),
				'label'   => '"Arial Black", Gadget, sans-serif',
			),
			array(
				'type'    => 'websafe',
				'version' => esc_html__( 'Sans-Serif Fonts', 'wp-timeline-designer-pro' ),
				'label'   => '"Comic Sans MS", cursive, sans-serif',
			),
			array(
				'type'    => 'websafe',
				'version' => esc_html__( 'Sans-Serif Fonts', 'wp-timeline-designer-pro' ),
				'label'   => 'Impact, Charcoal, sans-serif',
			),
			array(
				'type'    => 'websafe',
				'version' => esc_html__( 'Sans-Serif Fonts', 'wp-timeline-designer-pro' ),
				'label'   => '"Lucida Sans Unicode", "Lucida Grande", sans-serif',
			),
			array(
				'type'    => 'websafe',
				'version' => esc_html__( 'Sans-Serif Fonts', 'wp-timeline-designer-pro' ),
				'label'   => 'Tahoma, Geneva, sans-serif',
			),
			array(
				'type'    => 'websafe',
				'version' => esc_html__( 'Sans-Serif Fonts', 'wp-timeline-designer-pro' ),
				'label'   => '"Trebuchet MS", Helvetica, sans-serif',
			),
			array(
				'type'    => 'websafe',
				'version' => esc_html__( 'Sans-Serif Fonts', 'wp-timeline-designer-pro' ),
				'label'   => 'Verdana, Geneva, sans-serif',
			),
			array(
				'type'    => 'websafe',
				'version' => esc_html__( 'Monospace Fonts', 'wp-timeline-designer-pro' ),
				'label'   => '"Courier New", Courier, monospace',
			),
			array(
				'type'    => 'websafe',
				'version' => esc_html__( 'Monospace Fonts', 'wp-timeline-designer-pro' ),
				'label'   => '"Lucida Console", Monaco, monospace',
			),
		);
		include 'google-fonts.php';
		ksort( $google_fonts_arr );
		foreach ( $google_fonts_arr as $gfont => $gfont_val ) {
			$default_fonts[] = array(
				'type'     => 'googlefont',
				'version'  => esc_html__( 'Google Fonts', 'wp-timeline-designer-pro' ),
				'label'    => $gfont,
				'variants' => $gfont_val['variants'],
				'subsets'  => $gfont_val['subsets'],
			);
		}
		return $default_fonts;
	}

	/**
	 * Get setting from database from shortcode id
	 *
	 * @param int $shortcode_id shortcode_id.
	 * @return array
	 */
	public static function wtl_get_shortcode_settings( $shortcode_id ) {
		global $wpdb;
		$table_name   = $wpdb->prefix . 'wtl_shortcodes';
		$shortcode_id = intval( $shortcode_id );
		if ( is_numeric( $shortcode_id ) ) {
			$settings_val = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}wtl_shortcodes WHERE wtlid = %d", $shortcode_id ), ARRAY_A );
		}
		if ( ! $settings_val ) {
			return;
		}
		$allsettings = $settings_val[0]['wtlsettngs'];
		if ( is_serialized( $allsettings ) ) {
			$wtl_settings = maybe_unserialize( $allsettings );
			return $wtl_settings;
		}
		return false;
	}

	/**
	 * This function transforms the php.ini notation for numbers (like '2M') to an integer.
	 *
	 * @since 2.0
	 * @param int $size size.
	 * @return int $ret ret.
	 */
	public static function wtl_let_to_num( $size ) {
		$l   = substr( $size, -1 );
		$ret = substr( $size, 0, -1 );
		switch ( strtoupper( $l ) ) {
			case 'P':
				$ret *= 1024;
				// no break.
			case 'T':
				$ret *= 1024;
				// no break.
			case 'G':
				$ret *= 1024;
				// no break.
			case 'M':
				$ret *= 1024;
				// no break.
			case 'K':
				$ret *= 1024;
				// no break.
		}
		return $ret;
	}

	/**
	 * Select Acf field on change post type Ajax
	 *
	 * @since 1.0
	 * @return void
	 */
	public function wtl_get_acf_field_list() {
		ob_start();
		if ( is_plugin_active( 'advanced-custom-fields/acf.php' ) ) {
			if ( isset( $_POST['nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'ajax-nonce' ) ) {
				if ( isset( $_POST['posttype'] ) ) {
					$posttype = esc_attr( sanitize_text_field( wp_unslash( $_POST['posttype'] ) ) );
				} else {
					$posttype = '';
				}
				$post_id = get_posts(
					array(
						'fields'         => 'ids',
						'posts_per_page' => -1,
					)
				);
				$groups  = acf_get_field_groups( array( 'post_type' => $posttype ) );
			}
			?>
			<div class="wp-timeline-left">
				<span class="wp-timeline-key-title">
					<?php echo esc_html__( 'Select ACF Field', 'wp-timeline-designer-pro' ); ?>
				</span>
			</div>
			<div class="wp-timeline-right">
				<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-select"><span class="wp-timeline-tooltips"><?php esc_html__( 'Select any ACF Fields', 'wp-timeline-designer-pro' ); ?></span></span>
				<?php
				$wp_timeline_acf_field = isset( $wtl_settings['wp_timeline_acf_field'] ) ? $wtl_settings['wp_timeline_acf_field'] : array();
				?>
				<select data-placeholder="<?php esc_attr_e( 'Choose acf field', 'wp-timeline-designer-pro' ); ?>" class="chosen-select" multiple style="width:220px;" name="wp_timeline_acf_field[]" id="wp_timeline_acf_field">
					<?php
					foreach ( $groups as $group ) {
						$group_id                                 = $group['ID'];
						$group_title                              = $group['title'];
						$all_acf_data[ $group_id ]                = array();
						$all_acf_data[ $group_id ]['group_id']    = $group_id;
						$all_acf_data[ $group_id ]['group_title'] = $group_title;
						$fields                                   = acf_get_fields( $group_id );
						if ( $fields ) {
							$all_acf_data[ $group_id ]['fields'] = array();
							$val_fields                          = 0;
							foreach ( $fields as $field ) {
								$field_id    = $field['ID'];
								$field_label = $field['label'];
								$field_key   = $field['key'];
								?>
								<option value="<?php echo esc_attr( $field_id ); ?>"><?php echo esc_html( $field_label ); ?></option>
								<?php
							}
						}
					}
					?>
				</select>
			</div>
			<?php
			$data = ob_get_clean();
			echo wp_kses( $data, Wp_Timeline_Public::args_kses() );
			die();
		}
	}

	/**
	 *  Get all post Ajax
	 *
	 * @return void
	 */
	public function wtl_get_posts() {
		?>
		<div class="wp-timeline-left"><span class="wp-timeline-key-title"><?php esc_html_e( 'Select Posts', 'wp-timeline-designer-pro' ); ?></span></div>
		<div class="wp-timeline-right">
			<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-select"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select posts from available posts', 'wp-timeline-designer-pro' ); ?></span></span>
			<?php
			if ( isset( $_POST['nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'ajax-nonce' ) ) {
				$custom_post_type = isset( $_POST['custom_post_type'] ) ? sanitize_text_field( wp_unslash( $_POST['custom_post_type'] ) ) : '';
				?>
				<select id="wp_timeline_filter_post" name="wp_timeline_filter_post[]" class="chosen-select"  data-placeholder="Choose Posts" multiple="multiple">
					<?php
					$args      = array(
						'post_type'      => $custom_post_type,
						'posts_per_page' => -1,
						'parent'         => 0,
					);
					$the_query = new WP_Query( $args );
					if ( $the_query->have_posts() ) {
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							?>
							<option value="<?php echo esc_attr( get_the_ID() ); ?>"><?php echo esc_html( get_the_title() ); ?></option> 
							<?php
						}
					}
					?>
				</select>
				<div class="wp-timeline-setting-description wp-timeline-note">
					<b class="note"><?php esc_html_e( 'Note', 'wp-timeline-designer-pro' ); ?>:</b>
					<?php
					esc_html_e( 'If select post, then displays selected post. Leave blank to display all posts.', 'wp-timeline-designer-pro' );
					?>
				</div>
			<?php } ?>
		</div>
		<?php
		die();
	}

	/**
	 * Administration API: Core Ajax handlers
	 * Ajax handler to get custom post taxonomy terms
	 *
	 * @since 1.0
	 */
	public function wtl_get_custom_taxonomy_terms() {
		if ( isset( $_POST['nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'ajax-nonce' ) ) {
			if ( isset( $_POST['posttype'] ) && ! empty( $_POST['posttype'] ) ) {
				$custom_posttype = sanitize_text_field( wp_unslash( $_POST['posttype'] ) );
			}
			$taxonomy_names = get_object_taxonomies( $custom_posttype, 'objects' );
			$taxonomy_names = apply_filters( 'wtl_hide_taxonomies', $taxonomy_names );
			if ( ! empty( $taxonomy_names ) ) {
				foreach ( $taxonomy_names as $taxonomy_name ) {
					$terms = get_terms( $taxonomy_name->name, array( 'hide_empty' => false ) );
					if ( ! empty( $terms ) ) {
						?>
						<li class="wp-timeline-post-terms">
							<div class="wp-timeline-left"><span class="wp-timeline-key-title"><?php echo esc_html_e( 'Select', 'wp-timeline-designer-pro' ) . ' ' . esc_html( $taxonomy_name->label ); ?></span></div>
							<div class="wp-timeline-right">
								<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-select"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Filter post via', 'wp-timeline-designer-pro' ) . ' ' . esc_attr( $taxonomy_name->label ); ?></span></span>
								<select data-placeholder="Choose <?php echo esc_attr( $taxonomy_name->label ); ?>" multiple style="width:220px;" class="chosen-select custom_post_term" name="<?php echo esc_attr( $taxonomy_name->name ); ?>_terms[]" id="terms_<?php echo esc_attr( $taxonomy_name->name ); ?>">
									<?php foreach ( $terms as $term ) { ?>
										<option value="<?php echo esc_attr( $term->name ); ?>"><?php echo esc_attr( $term->name ); ?></option>
									<?php } ?>
								</select>
								<div class="exclude_tag_list_div">
									<label><input id="exclude_<?php echo esc_attr( $taxonomy_name->name ); ?>_list" name="exclude_<?php echo esc_attr( $taxonomy_name->name ); ?>_list" type="checkbox" value="1" /> <?php esc_html_e( 'Exclude Selected ', 'wp-timeline-designer-pro' ) . esc_attr( $taxonomy_name->label ); ?></label>
								</div>
							</div>
						</li>
						<?php
					}
				}
			}
		}
		die();
	}

	/**
	 * Hide custom taxonomy
	 *
	 * @param array $taxonomy_names taxonomy name.
	 * @return array
	 */
	public static function wtl_hide_taxonomies( $taxonomy_names ) {
		foreach ( $taxonomy_names as $taxonomy_i => $taxonomy_name ) {
			if ( ! empty( $taxonomy_name ) ) {
				if ( '1' != $taxonomy_name->show_ui ) {
					unset( $taxonomy_names[ $taxonomy_i ] );
				}
			}
		}
		return $taxonomy_names;
	}

	/**
	 * Get all posts
	 *
	 * @return void
	 */
	public function wtl_get_timeline_post_list() {
		if ( isset( $_POST['nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'ajax-nonce' ) ) {
			if ( isset( $_POST['posttype'] ) && ! empty( $_POST['posttype'] ) ) {
				$posttype = sanitize_text_field( wp_unslash( $_POST['posttype'] ) );
			} else {
				$posttype = 'post';
			}
			?>
			<span class="fas fa-question-circle wp-timeline-tooltips-icon wp-timeline-tooltips-icon-textarea"><span class="wp-timeline-tooltips"><?php esc_html_e( 'Select post to start timeline layout with some specific post', 'wp-timeline-designer-pro' ); ?></span></span> 
			<?php
			query_posts( 'showposts=-1&post_status=publish&post_type=' . $posttype );
			if ( have_posts() ) {
				echo '<select name="timeline_start_from" id="timeline_start_from">';
				while ( have_posts() ) {
					the_post();
					?>
					<option value="<?php echo get_the_date( 'd/m/Y' ); ?>"><?php echo esc_html( get_the_title() ); ?></option>
					<?php
				}
				echo '</select>';
			} else {
				echo '<p>';
				esc_html_e( 'No posts found.', 'wp-timeline-designer-pro' );
				echo '</p>';
			}
		}
		die();
	}

	/**
	 * Current page sql
	 *
	 * @return int
	 */
	public static function wtl_paged() {
		$request_url = isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';
		if ( strstr( $request_url, 'paged' ) || strstr( $request_url, 'page' ) ) {
			if ( isset( $_REQUEST['paged'] ) ) {
				$paged = intval( $_REQUEST['paged'] );
			} else {
				$uri = explode( '/', $request_url );
				$uri = array_reverse( $uri );
				if ( '' == $uri[0] ) {
					$pagged_uri = $uri[1];
				} else {
					$pagged_uri = $uri[0];
				}
				if ( isset( $_GET['sortby'] ) ) {
					$pagged_uri = 1;}
				if ( in_array( 'page', $uri, true ) ) {
					$pagged_uri = next( $uri );
				}
				$paged = $pagged_uri;
			}
		} else {
			$paged = 1;
		}
		return $paged;
	}

	/**
	 * Get parameter array for posts query
	 *
	 * @param array $wtl_settings settings.
	 * @return array
	 */
	public static function wtl_get_wp_query( $wtl_settings ) {
		$taxonomy  = '';
		$terms     = '';
		$tags      = '';
		$cats      = '';
		$author    = '';
		$orderby   = 'date';
		$order     = 'DESC';
		$post_type = 'post';
		if ( isset( $wtl_settings['custom_post_type'] ) ) {
			$post_type = $wtl_settings['custom_post_type'];
		}
		if ( isset( $wtl_settings['display_filter'] ) ) {
			$display_filter = $wtl_settings['display_filter'];
		} else {
			$display_filter = 0;
		}
		if ( isset( $wtl_settings['wp_timeline_filter_post'] ) ) {
			$wp_timeline_filter_post = $wtl_settings['wp_timeline_filter_post'];
		} else {
			$wp_timeline_filter_post = '';
		}
		if ( empty( $wp_timeline_post_categories ) ) {
			$wp_timeline_post_categories = '';
		}
		if ( isset( $wtl_settings['template_category'] ) ) {
			$cat = $wtl_settings['template_category'];
		}
		if ( isset( $wtl_settings['template_tags'] ) ) {
			$tag = $wtl_settings['template_tags'];
		}
		if ( isset( $wtl_settings['template_authors'] ) ) {
			$author = $wtl_settings['template_authors'];
		}
		if ( isset( $wtl_settings['wp_timeline_blog_order_by'] ) && '' != $wtl_settings['wp_timeline_blog_order_by'] ) {
			$orderby = $wtl_settings['wp_timeline_blog_order_by'];
		}
		if ( isset( $wtl_settings['wp_timeline_blog_order'] ) ) {
			$order = $wtl_settings['wp_timeline_blog_order'];
		}
		if ( isset( $_GET['sortby'] ) && '' != $_GET['sortby'] ) {
			$orderby = sanitize_text_field( wp_unslash( $_GET['sortby'] ) );
		}
		$taxo = get_object_taxonomies( $post_type );
		if ( empty( $cat ) ) {
			$cat = '';
		}
		if ( empty( $tag ) ) {
			$tag = '';
		}
		if ( isset( $wtl_settings['exclude_category_list'] ) && 1 == $wtl_settings['exclude_category_list'] ) {
			$exlude_category = 'NOT IN';
		} else {
			$exlude_category = 'IN';
		}
		if ( isset( $wtl_settings['exclude_tag_list'] ) && 1 == $wtl_settings['exclude_tag_list'] ) {
			$exlude_tag = 'NOT IN';
		} else {
			$exlude_tag = 'IN';
		}
		if ( isset( $wtl_settings['exclude_post_list'] ) ) {
			$exlude_post = 'post__not_in';
		} else {
			$exlude_post = 'post__in';
		}
		if ( isset( $wtl_settings['exclude_author_list'] ) ) {
			$exlude_author = 'author__not_in';
		} else {
			$exlude_author = 'author__in';
		}
		$advance_filter = ( isset( $wtl_settings['advance_filter'] ) ) ? $wtl_settings['advance_filter'] : 0;
		$relation       = 'OR';
		if ( 1 == $advance_filter ) {
			if ( isset( $wtl_settings['tax_filter_with'] ) && 1 == $wtl_settings['tax_filter_with'] ) {
				$relation = 'AND';
			}
			if ( isset( $wtl_settings['author_filter_with'] ) && 1 != $wtl_settings['author_filter_with'] ) {
				add_filter( 'posts_where', 'wp_timeline_author_filter_func' );
			}
		}
		$tax_query = array();
		if ( '' != $cat && '' != $tag ) {
			$tax_query = array(
				'relation' => $relation,
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $cat,
					'operator' => $exlude_category,
				),
				array(
					'taxonomy' => 'post_tag',
					'field'    => 'term_id',
					'terms'    => $tag,
					'operator' => $exlude_tag,
				),
			);
		} elseif ( '' != $cat ) {
			$tax_query = array(
				'relation' => $relation,
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $cat,
					'operator' => $exlude_category,
				),
			);
		} elseif ( '' != $tag ) {
			$tax_query = array(
				'relation' => $relation,
				array(
					'taxonomy' => 'post_tag',
					'field'    => 'term_id',
					'terms'    => $tag,
					'operator' => $exlude_tag,
				),
			);
		}

		$posts_per_page = $wtl_settings['posts_per_page'];
		if ( isset( $wtl_settings['paged'] ) ) {
			$paged = $wtl_settings['paged'];
		} else {
			$paged = self::wtl_paged();
		}
		$post_status             = isset( $wtl_settings['wp_timeline_post_status'] ) ? $wtl_settings['wp_timeline_post_status'] : 'publish';
		$wp_timeline_post_offset = ( isset( $wtl_settings['wp_timeline_post_offset'] ) && ! empty( $wtl_settings['wp_timeline_post_offset'] ) ) ? $wtl_settings['wp_timeline_post_offset'] : '0';
		$current_page            = intval( $paged );
		$current_page            = max( 1, $current_page );
		$offset_start            = $wp_timeline_post_offset;
		$offset                  = $wp_timeline_post_offset + ( ( $current_page - 1 ) * (int) $posts_per_page );

		if ( 'meta_value_num' === $orderby ) {
			$orderby_str = $orderby . ' date';
		} else {
			$orderby_str = $orderby;
		}
		if ( isset( $_GET['sortby'] ) && '' != $_GET['sortby'] ) {
			$orderby_str = sanitize_text_field( wp_unslash( $_GET['sortby'] ) );
			$order       = 'ASC';
		}
		if ( '' != $wp_timeline_filter_post && 1 == $display_filter ) {
			$posts = array(
				$exlude_author   => $author,
				'post_status'    => $post_status,
				'post_type'      => $post_type,
				'paged'          => $paged,
				'orderby'        => $orderby_str,
				'order'          => $order,
				$exlude_post     => $wp_timeline_filter_post,
				'posts_per_page' => -1,
				'offset'         => $offset,
			);
		} elseif ( '' == $wp_timeline_filter_post && 1 == $display_filter ) {
				$posts = array(
					$exlude_author   => $author,
					'post_status'    => $post_status,
					'post_type'      => $post_type,
					'paged'          => $paged,
					'orderby'        => $orderby_str,
					'order'          => $order,
					'tax_query'      => $tax_query,
					'posts_per_page' => -1,
					'offset'         => $offset,
				);
		} elseif ( '' != $wp_timeline_filter_post && 0 == $display_filter ) {
			$posts = array(
				$exlude_author   => $author,
				'post_status'    => $post_status,
				'post_type'      => $post_type,
				'paged'          => $paged,
				'orderby'        => $orderby_str,
				'order'          => $order,
				$exlude_post     => $wp_timeline_filter_post,
				'posts_per_page' => $posts_per_page,
				'offset'         => $offset,
			);
		} elseif ( '' == $wp_timeline_filter_post && 0 == $display_filter ) {
			$posts = array(
				$exlude_author   => $author,
				'post_status'    => $post_status,
				'post_type'      => $post_type,
				'paged'          => $paged,
				'orderby'        => $orderby_str,
				'order'          => $order,
				'tax_query'      => $tax_query,
				'posts_per_page' => $posts_per_page,
				'offset'         => $offset,
			);
		} else {
			$posts = array(
				$exlude_author   => $author,
				'post_status'    => $post_status,
				'post_type'      => $post_type,
				'posts_per_page' => $posts_per_page,
				'paged'          => $paged,
				'orderby'        => $orderby_str,
				'order'          => $order,
				'tax_query'      => $tax_query,
				'offset'         => $offset,
			);
		}
		if ( 'meta_value_num' === $orderby ) {
			$posts['meta_query'] = array(
				'relation' => 'OR',
				array(
					'key'     => '_post_like_count',
					'compare' => 'NOT EXISTS',
				),
				array(
					'key'     => '_post_like_count',
					'compare' => 'EXISTS',
				),
			);
		}
		if ( isset( $wtl_settings['paged'] ) ) {
			$posts['post_status'] = $post_status;
		}
		if ( ( 'date' === $orderby || 'modified' === $orderby ) && isset( $wtl_settings['template_name'] ) && 'story' === $wtl_settings['template_name'] ) {
			$posts['ignore_sticky_posts'] = 1;
		}
		if ( isset( $wtl_settings['display_sticky'] ) && 1 == $wtl_settings['display_sticky'] ) {
			$posts['ignore_sticky_posts'] = 0;
		} else {
			$posts['ignore_sticky_posts'] = 1;
		}
		/**
		 * Time Period Coding
		 */
		if ( isset( $wtl_settings['blog_time_period'] ) ) {
			$blog_time_period = $wtl_settings['blog_time_period'];
			if ( 'today' === $blog_time_period ) {
				$today               = getdate();
				$posts['date_query'] = array(
					array(
						'year'  => $today['year'],
						'month' => $today['mon'],
						'day'   => $today['mday'],
					),
				);
			}
			if ( 'tomorrow' === $blog_time_period ) {
				$twodayslater         = getdate( current_time( 'timestamp' ) + 1 * DAY_IN_SECONDS );
				$posts['date_query']  = array(
					array(
						'year'  => $twodayslater['year'],
						'month' => $twodayslater['mon'],
						'day'   => $twodayslater['mday'],
					),
				);
				$posts['post_status'] = array( 'future' );
			}
			if ( 'this_week' === $blog_time_period ) {
				$week                = gmdate( 'W' );
				$year                = gmdate( 'Y' );
				$posts['date_query'] = array(
					array(
						'year' => $year,
						'week' => $week,
					),
				);
			}
			if ( 'last_week' === $blog_time_period ) {
				$thisweek = gmdate( 'W' );
				if ( 1 != $thisweek ) :
					$lastweek = $thisweek - 1;
				else :
					$lastweek = 52;
				endif;
				$year = gmdate( 'Y' );
				if ( 52 != $lastweek ) :
					$year = gmdate( 'Y' );
				else :
					$year = gmdate( 'Y' ) - 1;
				endif;

				$posts['date_query'] = array(
					array(
						'year' => $year,
						'week' => $lastweek,
					),
				);
			}
			if ( 'next_week' === $blog_time_period ) {
				$thisweek = gmdate( 'W' );
				if ( 52 != $thisweek ) :
					$lastweek = $thisweek + 1;
				else :
					$lastweek = 1;
				endif;

				$year = gmdate( 'Y' );
				if ( 52 != $lastweek ) :
					$year = gmdate( 'Y' );
				else :
					$year = gmdate( 'Y' ) + 1;
				endif;
				$posts['date_query']  = array(
					array(
						'year' => $year,
						'week' => $lastweek,
					),
				);
				$posts['post_status'] = array( 'future' );
			}
			if ( 'this_month' === $blog_time_period ) {
				$today               = getdate();
				$posts['date_query'] = array(
					array(
						'year'  => $today['year'],
						'month' => $today['mon'],
					),
				);
			}
			if ( 'last_month' === $blog_time_period ) {
				$twodayslater        = getdate( current_time( 'timestamp' ) - 1 * MONTH_IN_SECONDS );
				$posts['date_query'] = array(
					array(
						'year'  => $twodayslater['year'],
						'month' => $twodayslater['mon'],
					),
				);
			}
			if ( 'next_month' === $blog_time_period ) {
				$twodayslater         = getdate( current_time( 'timestamp' ) + 1 * MONTH_IN_SECONDS );
				$posts['date_query']  = array(
					array(
						'year'  => $twodayslater['year'],
						'month' => $twodayslater['mon'],
					),
				);
				$posts['post_status'] = array( 'future' );
			}
			if ( 'last_n_days' === $blog_time_period ) {
				if ( isset( $wtl_settings['wp_timeline_time_period_day'] ) && $wtl_settings['wp_timeline_time_period_day'] ) {
					$last_n_days         = $wtl_settings['wp_timeline_time_period_day'] . ' ' . esc_html__( 'days ago', 'wp-timeline-designer-pro' );
					$posts['date_query'] = array(
						array(
							'before'    => gmdate( 'Y-m-d', strtotime( $last_n_days ) ),
							'inclusive' => true,
						),
					);
				}
			}
			if ( 'next_n_days' === $blog_time_period ) {
				if ( isset( $wtl_settings['wp_timeline_time_period_day'] ) && $wtl_settings['wp_timeline_time_period_day'] ) {
					$next_n_days          = '+' . $wtl_settings['wp_timeline_time_period_day'] . ' ' . esc_html__( 'days', 'wp-timeline-designer-pro' );
					$posts['date_query']  = array(
						array(
							'after'    => gmdate( 'Y-m-d', strtotime( $next_n_days ) ),
							'inclusive' => true,
						),
					);
					$posts['post_status'] = array( 'future' );
				}
			}
			if ( 'between_two_date' === $blog_time_period ) {
				$between_two_date_from = isset( $wtl_settings['between_two_date_from'] ) ? $wtl_settings['between_two_date_from'] : '';
				$between_two_date_to   = isset( $wtl_settings['between_two_date_to'] ) ? $wtl_settings['between_two_date_to'] : '';
				$from_format           = array();
				$after                 = array();
				if ( $between_two_date_from ) {
					$unixtime  = strtotime( $between_two_date_from );
					$from_time = gmdate( 'm-d-Y', $unixtime );
					if ( $from_time ) {
						$from_format = explode( '-', $from_time );
						$after       = array(
							'year'  => isset( $from_format[2] ) ? $from_format[2] : '',
							'month' => isset( $from_format[0] ) ? $from_format[0] : '',
							'day'   => isset( $from_format[1] ) ? $from_format[1] : '',
						);
					}
				}
				$to_format = array();
				$before    = array();
				if ( $between_two_date_to ) {
					$unixtime = strtotime( $between_two_date_to );
					$to_time  = gmdate( 'm-d-Y', $unixtime );
					if ( $to_time ) {
						$to_format = explode( '-', $to_time );
						$before    = array(
							'year'  => isset( $to_format[2] ) ? $to_format[2] : '',
							'month' => isset( $to_format[0] ) ? $to_format[0] : '',
							'day'   => isset( $to_format[1] ) ? $to_format[1] : '',
						);
					}
				}
				$posts['date_query'] = array(
					array(
						'after'     => $after,
						'before'    => $before,
						'inclusive' => true,
					),
				);
			}
		}
		/* if Post Type not Post but Custom Post Type */
		if ( 'post' !== $post_type ) {
			$tax_query = array( 'relation' => 'OR' );
			if ( isset( $wtl_settings['relation'] ) && ! empty( $wtl_settings['relation'] ) ) {
				$tax_query = $wtl_settings['relation'];
			}
			foreach ( $taxo as $taxonom ) {
				$custom_taxonom = '';
				if ( isset( $wtl_settings[ $taxonom . '_terms' ] ) ) {
					if ( ! empty( $wtl_settings[ $taxonom . '_terms' ] ) ) {
						$custom_taxonom = $wtl_settings[ $taxonom . '_terms' ];
					}
					if ( isset( $wtl_settings[ 'exclude_' . $taxonom . '_list' ] ) ) {
						$operator_value = 'NOT IN';
					} else {
						$operator_value = 'IN';
					}
					$tax_query[] = array(
						'taxonomy' => $taxonom,
						'field'    => 'name',
						'terms'    => $custom_taxonom,
						'operator' => $operator_value,
					);
				}
			}
			if ( 'meta_value_num' === $orderby ) {
				$orderby_str = $orderby . ' date';
			} else {
				$orderby_str = $orderby;
			}
			if ( isset( $_GET['sortby'] ) && '' != $_GET['sortby'] ) {
				$orderby_str = sanitize_text_field( wp_unslash( $_GET['sortby'] ) );
				$order       = 'ASC';
			}
			$wp_timeline_post_offset = ( isset( $wtl_settings['wp_timeline_post_offset'] ) && ! empty( $wtl_settings['wp_timeline_post_offset'] ) ) ? $wtl_settings['wp_timeline_post_offset'] : '0';
			$current_page            = intval( $paged );
			$current_page            = max( 1, $current_page );
			$offset_start            = $wp_timeline_post_offset;
			$offset                  = $wp_timeline_post_offset + ( ( $current_page - 1 ) * $posts_per_page );
			if ( '' == $wp_timeline_filter_post && 0 == $display_filter ) {
				$posts = array(
					'post_status'    => $post_status,
					'post_type'      => $post_type,
					'posts_per_page' => $posts_per_page,
					'paged'          => $paged,
					'orderby'        => $orderby_str,
					'order'          => $order,
					$exlude_author   => $author,
					'offset'         => $offset,
					'tax_query'      => $tax_query,

				);
			} elseif ( '' != $wp_timeline_filter_post && 0 == $display_filter ) {
				$posts = array(
					'post_status'    => $post_status,
					'post_type'      => $post_type,
					'posts_per_page' => $posts_per_page,
					'paged'          => $paged,
					'orderby'        => $orderby_str,
					'order'          => $order,
					$exlude_author   => $author,
					$exlude_post     => $wp_timeline_filter_post,
					'offset'         => $offset,
					'tax_query'      => $tax_query,
				);
			} elseif ( '' == $wp_timeline_filter_post && 1 == $display_filter ) {
				$posts = array(
					'post_status'    => $post_status,
					'post_type'      => $post_type,
					'posts_per_page' => -1,
					'paged'          => $paged,
					'orderby'        => $orderby_str,
					'order'          => $order,
					$exlude_author   => $author,
					'tax_query'      => $tax_query,
				);
			} elseif ( '' != $wp_timeline_filter_post && 1 == $display_filter ) {
				$posts = array(
					'post_status'    => $post_status,
					'post_type'      => $post_type,
					'posts_per_page' => -1,
					'paged'          => $paged,
					'orderby'        => $orderby_str,
					'order'          => $order,
					$exlude_author   => $author,
					$exlude_post     => $wp_timeline_filter_post,
					'tax_query'      => $tax_query,
				);
			} else {
				$posts = array(
					'post_status'    => $post_status,
					'post_type'      => $post_type,
					'tax_query'      => $tax_query,
					'posts_per_page' => $posts_per_page,
					'paged'          => $paged,
					'orderby'        => $orderby_str,
					'order'          => $order,
					$exlude_author   => $author,
					'offset'         => $offset,
				);
			}
			if ( 'meta_value_num' === $orderby ) {
				$posts['meta_query'] = array(
					'relation' => 'OR',
					array(
						'key'     => '_post_like_count',
						'compare' => 'NOT EXISTS',
					),
					array(
						'key'     => '_post_like_count',
						'compare' => 'EXISTS',
					),
				);
			}
			if ( ( 'date' === $orderby || 'modified' === $orderby ) && isset( $wtl_settings['template_name'] ) && ( 'timeline' === $wtl_settings['template_name'] || 'story' === $wtl_settings['template_name'] ) ) {
				$posts['ignore_sticky_posts'] = 1;
			}
			if ( isset( $wtl_settings['template_name'] ) && ( 'explore' === $wtl_settings['template_name'] || 'hoverbic' === $wtl_settings['template_name'] ) ) {
				$posts['ignore_sticky_posts'] = 1;
			}

			if ( isset( $wtl_settings['display_sticky'] ) && 1 == $wtl_settings['display_sticky'] ) {
				$posts['ignore_sticky_posts'] = 0;
			} else {
				$posts['ignore_sticky_posts'] = 1;
			}
			/**
			 * Time Period Coding
			 */
			if ( isset( $wtl_settings['blog_time_period'] ) ) {
				$blog_time_period = $wtl_settings['blog_time_period'];
				if ( 'today' === $blog_time_period ) {
					$today               = getdate();
					$posts['date_query'] = array(
						array(
							'year'  => $today['year'],
							'month' => $today['mon'],
							'day'   => $today['mday'],
						),
					);
				}
				if ( 'tomorrow' === $blog_time_period ) {
					$twodayslater         = getdate( current_time( 'timestamp' ) + 1 * DAY_IN_SECONDS );
					$posts['date_query']  = array(
						array(
							'year'  => $twodayslater['year'],
							'month' => $twodayslater['mon'],
							'day'   => $twodayslater['mday'],
						),
					);
					$posts['post_status'] = array( 'future' );
				}
				if ( 'this_week' === $blog_time_period ) {
					$week                = gmdate( 'W' );
					$year                = gmdate( 'Y' );
					$posts['date_query'] = array(
						array(
							'year' => $year,
							'week' => $week,
						),
					);
				}
				if ( 'last_week' === $blog_time_period ) {
					$thisweek = gmdate( 'W' );
					if ( 1 != $thisweek ) :
						$lastweek = $thisweek - 1;
					else :
						$lastweek = 52;
					endif;
					$year = gmdate( 'Y' );
					if ( 52 != $lastweek ) :
						$year = gmdate( 'Y' );
					else :
						$year = gmdate( 'Y' ) - 1;
					endif;
					$posts['date_query'] = array(
						array(
							'year' => $year,
							'week' => $lastweek,
						),
					);
				}
				if ( 'next_week' === $blog_time_period ) {
					$thisweek = gmdate( 'W' );
					if ( 52 != $thisweek ) :
						$lastweek = $thisweek + 1;
					else :
						$lastweek = 1;
					endif;

					$year = gmdate( 'Y' );
					if ( 52 != $lastweek ) :
						$year = gmdate( 'Y' );
					else :
						$year = gmdate( 'Y' ) + 1;
					endif;
					$posts['date_query']  = array(
						array(
							'year' => $year,
							'week' => $lastweek,
						),
					);
					$posts['post_status'] = array( 'future' );
				}
				if ( 'this_month' === $blog_time_period ) {
					$today               = getdate();
					$posts['date_query'] = array(
						array(
							'year'  => $today['year'],
							'month' => $today['mon'],
						),
					);
				}
				if ( 'last_month' === $blog_time_period ) {
					$twodayslater        = getdate( current_time( 'timestamp' ) - 1 * MONTH_IN_SECONDS );
					$posts['date_query'] = array(
						array(
							'year'  => $twodayslater['year'],
							'month' => $twodayslater['mon'],
						),
					);
				}
				if ( 'next_month' === $blog_time_period ) {
					$twodayslater         = getdate( current_time( 'timestamp' ) + 1 * MONTH_IN_SECONDS );
					$posts['date_query']  = array(
						array(
							'year'  => $twodayslater['year'],
							'month' => $twodayslater['mon'],
						),
					);
					$posts['post_status'] = array( 'future' );
				}
				if ( 'last_n_days' === $blog_time_period ) {
					if ( isset( $wtl_settings['wp_timeline_time_period_day'] ) && $wtl_settings['wp_timeline_time_period_day'] ) {
						$last_n_days         = $wtl_settings['wp_timeline_time_period_day'] . ' days ago';
						$posts['date_query'] = array(
							array(
								'before'    => gmdate( 'Y-m-d', strtotime( $last_n_days ) ),
								'inclusive' => true,
							),
						);
					}
				}
				if ( 'next_n_days' === $blog_time_period ) {
					if ( isset( $wtl_settings['wp_timeline_time_period_day'] ) && $wtl_settings['wp_timeline_time_period_day'] ) {
						$next_n_days          = '+' . $wtl_settings['wp_timeline_time_period_day'] . ' days';
						$posts['date_query']  = array(
							array(
								'after'    => gmdate( 'Y-m-d', strtotime( $next_n_days ) ),
								'inclusive' => true,
							),
						);
						$posts['post_status'] = array( 'future' );
					}
				}
				if ( 'between_two_date' === $blog_time_period ) {
					$between_two_date_from = isset( $wtl_settings['between_two_date_from'] ) ? $wtl_settings['between_two_date_from'] : '';
					$between_two_date_to   = isset( $wtl_settings['between_two_date_to'] ) ? $wtl_settings['between_two_date_to'] : '';
					$from_format           = array();
					$after                 = array();
					if ( $between_two_date_from ) {
						$unixtime  = strtotime( $between_two_date_from );
						$from_time = gmdate( 'm-d-Y', $unixtime );
						if ( $from_time ) {
							$from_format = explode( '-', $from_time );
							$after       = array(
								'year'  => isset( $from_format[2] ) ? $from_format[2] : '',
								'month' => isset( $from_format[0] ) ? $from_format[0] : '',
								'day'   => isset( $from_format[1] ) ? $from_format[1] : '',
							);
						}
					}
					$to_format = array();
					$before    = array();
					if ( $between_two_date_to ) {
						$unixtime = strtotime( $between_two_date_to );
						$to_time  = gmdate( 'm-d-Y', $unixtime );
						if ( $to_time ) {
							$to_format = explode( '-', $to_time );
							$before    = array(
								'year'  => isset( $to_format[2] ) ? $to_format[2] : '',
								'month' => isset( $to_format[0] ) ? $to_format[0] : '',
								'day'   => isset( $to_format[1] ) ? $to_format[1] : '',
							);
						}
					}
					$posts['date_query'] = array(
						array(
							'after'     => $after,
							'before'    => $before,
							'inclusive' => true,
						),
					);
				}
			}
		}
		return $posts;
	}

	/**
	 * Include Blog template
	 *
	 * @param string $wp_timeline_theme theme.
	 * @param array  $wtl_settings settings.
	 * @param int    $paged page.
	 * @param string $count_sticky count sticky.
	 * @param int    $count count.
	 * @return html
	 */
	public static function wtl_get_blog_template( $wp_timeline_theme, $wtl_settings, $paged, $count_sticky, $count ) {
		ob_start();
		$theme_path = get_stylesheet_directory() . '/wp_timeline_templates/' . $wp_timeline_theme;
		if ( ! file_exists( $theme_path ) ) {
			$theme_path = WTL_DIR . 'wp_timeline_templates/' . $wp_timeline_theme;
		}
		if ( file_exists( $theme_path ) ) {
			include $theme_path;
		}
		return ob_get_clean();
	}
	/**
	 * Get Loader
	 *
	 * @param array $wtl_settings settings.
	 * @return html
	 */
	public static function wp_timeline_get_loader( $wtl_settings ) {
		$loader  = '';
		$loaders = array(
			'circularG'               => '<div class="wtl-circularG-wrapper"><div class="wtl-circularG wtl-circularG_1"></div><div class="wtl-circularG wtl-circularG_2"></div><div class="wtl-circularG wtl-circularG_3"></div><div class="wtl-circularG wtl-circularG_4"></div><div class="wtl-circularG wtl-circularG_5"></div><div class="wtl-circularG wtl-circularG_6"></div><div class="wtl-circularG wtl-circularG_7"></div><div class="wtl-circularG wtl-circularG_8"></div></div>',
			'floatingCirclesG'        => '<div class="wtl-floatingCirclesG"><div class="wtl-f_circleG wtl-frotateG_01"></div><div class="wtl-f_circleG wtl-frotateG_02"></div><div class="wtl-f_circleG wtl-frotateG_03"></div><div class="wtl-f_circleG wtl-frotateG_04"></div><div class="wtl-f_circleG wtl-frotateG_05"></div><div class="wtl-f_circleG wtl-frotateG_06"></div><div class="wtl-frotateG_07 wtl-f_circleG"></div><div class="wtl-frotateG_08 wtl-f_circleG"></div></div>',
			'spinloader'              => '<div class="wtl-spinloader"></div>',
			'doublecircle'            => '<div class="wtl-doublec-container"><ul class="wtl-doublec-flex-container"><li><span class="wtl-doublec-loading"></span></li></ul></div>',
			'wBall'                   => '<div class="wtl-windows8"><div class="wtl-wBall wtl-wBall_1"><div class="wtl-wInnerBall"></div></div><div class="wtl-wBall wtl-wBall_2"><div class="wtl-wInnerBall"></div></div><div class="wtl-wBall wtl-wBall_3"><div class="wtl-wInnerBall"></div></div><div class="wtl-wBall wtl-wBall_4"><div class="wtl-wInnerBall"></div></div><div class="wtl-wBall_5 wtl-wBall"><div class="wtl-wInnerBall"></div></div></div>',
			'cssanim'                 => '<div class="wtl-cssload-aim"></div>',
			'thecube'                 => '<div class="wtl-cssload-thecube"><div class="wtl-cssload-cube wtl-cssload-c1"></div><div class="wtl-cssload-cube wtl-cssload-c2"></div><div class="wtl-cssload-cube wtl-cssload-c4"></div><div class="wtl-cssload-cube wtl-cssload-c3"></div></div>',
			'ballloader'              => '<div class="wtl-ballloader"><div class="wtl-loader-inner wtl-ball-grid-pulse"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>',
			'squareloader'            => '<div class="wtl-squareloader"><div class="wtl-square"></div><div class="wtl-square"></div><div class="wtl-square last"></div><div class="wtl-square clear"></div><div class="wtl-square"></div><div class="wtl-square last"></div><div class="wtl-square clear"></div><div class="wtl-square"></div><div class="wtl-square last"></div></div>',
			'loadFacebookG'           => '<div class="wtl-loadFacebookG"><div class="wtl-blockG_1 wtl-facebook_blockG"></div><div class="wtl-blockG_2 wtl-facebook_blockG"></div><div class="wtl-facebook_blockG wtl-blockG_3"></div></div>',
			'floatBarsG'              => '<div class="wtl-floatBarsG-wrapper"><div class="wtl-floatBarsG_1 wtl-floatBarsG"></div><div class="wtl-floatBarsG_2 wtl-floatBarsG"></div><div class="wtl-floatBarsG_3 wtl-floatBarsG"></div><div class="wtl-floatBarsG_4 wtl-floatBarsG"></div><div class="wtl-floatBarsG_5 wtl-floatBarsG"></div><div class="wtl-floatBarsG_6 wtl-floatBarsG"></div><div class="wtl-floatBarsG_7 wtl-floatBarsG"></div><div class="wtl-floatBarsG_8 wtl-floatBarsG"></div></div>',
			'movingBallG'             => '<div class="wtl-movingBallG-wrapper"><div class="wtl-movingBallLineG"></div><div class="wtl-movingBallG_1 wtl-movingBallG"></div></div>',
			'ballsWaveG'              => '<div class="wtl-ballsWaveG-wrapper"><div class="wtl-ballsWaveG_1 wtl-ballsWaveG"></div><div class="wtl-ballsWaveG_2 wtl-ballsWaveG"></div><div class="wtl-ballsWaveG_3 wtl-ballsWaveG"></div><div class="wtl-ballsWaveG_4 wtl-ballsWaveG"></div><div class="wtl-ballsWaveG_5 wtl-ballsWaveG"></div><div class="wtl-ballsWaveG_6 wtl-ballsWaveG"></div><div class="wtl-ballsWaveG_7 wtl-ballsWaveG"></div><div class="wtl-ballsWaveG_8 wtl-ballsWaveG"></div></div>',
			'fountainG'               => '<div class="fountainG-wrapper"><div class="wtl-fountainG_1 wtl-fountainG"></div><div class="wtl-fountainG_2 wtl-fountainG"></div><div class="wtl-fountainG_3 wtl-fountainG"></div><div class="wtl-fountainG_4 wtl-fountainG"></div><div class="wtl-fountainG_5 wtl-fountainG"></div><div class="wtl-fountainG_6 wtl-fountainG"></div><div class="wtl-fountainG_7 wtl-fountainG"></div><div class="wtl-fountainG_8 wtl-fountainG"></div></div>',
			'audio_wave'              => '<div class="wtl-audio_wave"><span></span><span></span><span></span><span></span><span></span></div>',
			'warningGradientBarLineG' => '<div class="wtl-warningGradientOuterBarG"><div class="wtl-warningGradientFrontBarG wtl-warningGradientAnimationG"><div class="wtl-warningGradientBarLineG"></div><div class="wtl-warningGradientBarLineG"></div><div class="wtl-warningGradientBarLineG"></div><div class="wtl-warningGradientBarLineG"></div><div class="wtl-warningGradientBarLineG"></div><div class="wtl-warningGradientBarLineG"></div></div></div>',
			'floatingBarsG'           => '<div class="wtl-floatingBarsG"><div class="wtl-rotateG_01 wtl-blockG"></div><div class="wtl-rotateG_02 wtl-blockG"></div><div class="wtl-rotateG_03 wtl-blockG"></div><div class="wtl-rotateG_04 wtl-blockG"></div><div class="wtl-rotateG_05 wtl-blockG"></div><div class="wtl-rotateG_06 wtl-blockG"></div><div class="wtl-rotateG_07 wtl-blockG"></div><div class="wtl-rotateG_08 wtl-blockG"></div></div>',
			'rotatecircle'            => '<div class="wtl-cssload-loader"><div class="wtl-cssload-inner wtl-cssload-one"></div><div class="wtl-cssload-inner wtl-cssload-two"></div><div class="wtl-cssload-inner wtl-cssload-three"></div></div>',
			'overlay-loader'          => '<div class="wtl-overlay-loader"><div class="wtl-loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>',
			'circlewave'              => '<div class="wtl-circlewave"></div>',
			'cssload-ball'            => '<div class="wtl-cssload-ball"></div>',
			'cssheart'                => '<div class="wtl-cssload-main"><div class="wtl-cssload-heart"><span class="wtl-cssload-heartL"></span><span class="wtl-cssload-heartR"></span><span class="wtl-cssload-square"></span></div><div class="wtl-cssload-shadow"></div></div>',
			'spinload'                => '<div class="wtl-spinload-loading"><i></i><i></i><i></i></div>',
			'bigball'                 => '<div class="wtl-bigball-container"><div class="wtl-bigball-loading"><i></i><i></i><i></i></div></div>',
			'bubblec'                 => '<div class="wtl-bubble-container"><div class="wtl-bubble-loading"><i></i><i></i></div></div>',
			'csball'                  => '<div class="wtl-csball-container"><div class="wtl-csball-loading"><i></i><i></i><i></i><i></i></div></div>',
			'ccball'                  => '<div class="wtl-ccball-container"><div class="wtl-ccball-loading"><i></i><i></i></div></div>',
			'circulardot'             => '<div class="wtl-cssload-wrap"><div class="wtl-circulardot-container"><span class="wtl-cssload-dots"></span><span class="wtl-cssload-dots"></span><span class="wtl-cssload-dots"></span><span class="wtl-cssload-dots"></span><span class="wtl-cssload-dots"></span><span class="wtl-cssload-dots"></span><span class="wtl-cssload-dots"></span><span class="wtl-cssload-dots"></span><span class="wtl-cssload-dots"></span><span class="wtl-cssload-dots"></span></div></div>',
		);
		if ( isset( $wtl_settings['loader_type'] ) ) {
			if ( 1 == $wtl_settings['loader_type'] ) {
				$loading = ( isset( $wtl_settings['wp_timeline_loader_image_src'] ) && '' != $wtl_settings['wp_timeline_loader_image_src'] ) ? $wtl_settings['wp_timeline_loader_image_src'] : WTL_URL . '/images/loading.gif';
				$loader  = '<img src="' . $loading . '" alt="' . esc_attr__( 'Loading Image', 'wp-timeline-designer-pro' ) . '" style="display: none" class="loading-image" />';
			} else {
				$loader_style_hidden = isset( $wtl_settings['loader_style_hidden'] ) ? $wtl_settings['loader_style_hidden'] : 'circularG';
				$loading             = $loaders[ $loader_style_hidden ];
				$loader              = '<div style="display: none" class="loading-image" >' . $loading . '</div>';
			}
		} else {
			$loader = '<img src="' . WTL_URL . '/images/loading.gif" alt="' . esc_attr__( 'Loading Image', 'wp-timeline-designer-pro' ) . '" style="display: none" class="loading-image" />';
		}
		return $loader;
	}

	/**
	 * Get default image
	 *
	 * @param int    $wtl_settings settings.
	 * @param string $post_thumbnail thubnail.
	 * @param int    $post_thumbnail_id thubnail id.
	 * @param int    $wtl_post_id post id.
	 * @return html
	 */
	public static function wtl_get_the_thumbnail( $wtl_settings, $post_thumbnail, $post_thumbnail_id, $wtl_post_id ) {
		$thumbnail = '';
		if ( '' == $post_thumbnail ) {
			$post_thumbnail = 'full';
		}
		if ( has_post_thumbnail( $wtl_post_id ) ) {
			if ( isset( $wtl_settings['wp_timeline_lazy_load_image'] ) && 1 == $wtl_settings['wp_timeline_lazy_load_image'] ) {
				add_filter( 'wp_get_attachment_image_attributes', 'lazyload_images_modify_post_thumbnail_attr', 10, 3 );
			}
			if ( isset( $wtl_settings['wp_timeline_media_size'] ) ) {
				if ( 'custom' == $wtl_settings['wp_timeline_media_size'] ) {
					$url           = wp_get_attachment_url( $post_thumbnail_id );
					$width         = isset( $wtl_settings['media_custom_width'] ) ? $wtl_settings['media_custom_width'] : 560;
					$height        = isset( $wtl_settings['media_custom_height'] ) ? $wtl_settings['media_custom_height'] : 350;
					$resized_image = self::wp_timeline_resize( $width, $height, $url, true, $post_thumbnail_id );
					$thumbnail     = '<img class="custom_thumbnail" src="' . esc_url( $resized_image['url'] ) . '" width="' . esc_attr( $resized_image['width'] ) . '" height="' . esc_attr( $resized_image['height'] ) . '" title="' . get_the_title( $wtl_post_id ) . '" alt="' . get_the_title( $wtl_post_id ) . '" />';
					if ( 1 == $wtl_settings['wp_timeline_lightbox'] ) {
						echo '<div class="img-overlay">
							<a rel="lightcase" data-rel="lightcase:my-slideshow" title="' . esc_attr( $post->post_title ) . '" class="open_up" href="' . esc_url( $resized_image['url'] ) . '"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
						</div>';
					}
				} else {
					$post           = get_post( $wtl_post_id );
					$post_thumbnail = $wtl_settings['wp_timeline_media_size'];
					$thumbnail      = get_the_post_thumbnail( $wtl_post_id, $post_thumbnail );
					$url            = wp_get_attachment_url( get_post_thumbnail_id() );
					$width          = isset( $wtl_settings['item_width'] ) ? $wtl_settings['item_width'] : 400;
					$height         = isset( $wtl_settings['item_height'] ) ? $wtl_settings['item_height'] : 200;
					$resize_image   = WP_Timeline_Main::wp_timeline_resize( $width, $height, $url, true, get_post_thumbnail_id() );

					if ( 1 == $wtl_settings['wp_timeline_lightbox'] ) {
						echo '<div class="img-overlay">
							<a rel="lightcase" data-rel="lightcase:my-slideshow" title="' . esc_attr( $post->post_title ) . '" class="open_up" href="' . esc_url( $resize_image['url'] ) . '"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
						</div>';
					}
				}
			} else {
				$thumbnail = get_the_post_thumbnail( $wtl_post_id, $post_thumbnail );
				if ( 1 == $wtl_settings['wp_timeline_lightbox'] ) {
					echo '<div class="img-overlay">
						<a rel="lightcase" data-rel="lightcase:my-slideshow" title="' . esc_attr( $post->post_title ) . '" class="open_up" href="' . esc_url( $resize_image['url'] ) . '"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
					</div>';
				}
			}
		} elseif ( isset( $wtl_settings['wp_timeline_default_image_id'] ) && '' != $wtl_settings['wp_timeline_default_image_id'] ) {
			if ( isset( $wtl_settings['wp_timeline_media_size'] ) ) {
				if ( 'custom' === $wtl_settings['wp_timeline_media_size'] ) {
					$post_thumbnail_id = $wtl_settings['wp_timeline_default_image_id'];
					$url               = wp_get_attachment_url( $post_thumbnail_id );
					$width             = isset( $wtl_settings['media_custom_width'] ) ? $wtl_settings['media_custom_width'] : 560;
					$height            = isset( $wtl_settings['media_custom_height'] ) ? $wtl_settings['media_custom_height'] : 350;
					$resized_image     = self::wp_timeline_resize( $width, $height, $url, true, $post_thumbnail_id );
					$thumbnail         = '<img src="' . esc_url( $resized_image['url'] ) . '" width="' . esc_attr( $resized_image['width'] ) . '" height="' . esc_attr( $resized_image['height'] ) . '" title="' . get_the_title( $wtl_post_id ) . '" alt="' . get_the_title( $wtl_post_id ) . '" />';
					if ( 1 == $wtl_settings['wp_timeline_lightbox'] ) {
						echo '<div class="img-overlay">
							<a rel="lightcase" data-rel="lightcase:my-slideshow" title="' . esc_attr( $post->post_title ) . '" class="open_up" href="' . esc_url( $resized_image['url'] ) . '"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
						</div>';
					}
				} else {
					$post_thumbnail = $wtl_settings['wp_timeline_media_size'];
					$thumbnail      = wp_get_attachment_image( $wtl_settings['wp_timeline_default_image_id'], $post_thumbnail );
					if ( 1 == $wtl_settings['wp_timeline_lightbox'] ) {
						echo '<div class="img-overlay">
							<a rel="lightcase" data-rel="lightcase:my-slideshow" title="' . esc_attr( $post->post_title ) . '" class="open_up" href="' . esc_url( $resized_image['url'] ) . '"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
						</div>';
					}
				}
			} else {
				$thumbnail = wp_get_attachment_image( $wtl_settings['wp_timeline_default_image_id'], $post_thumbnail );
				if ( 1 == $wtl_settings['wp_timeline_lightbox'] ) {
					echo '<div class="img-overlay">
						<a rel="lightcase" data-rel="lightcase:my-slideshow" title="' . esc_attr( $post->post_title ) . '" class="open_up" href="' . esc_url( $resized_image['url'] ) . '"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
					</div>';
				}
			}
		}
		return $thumbnail;
	}

	/**
	 * Get first media
	 *
	 * @param int   $post_id post id.
	 * @param array $wtl_settings settings.
	 * @return html.
	 */
	public static function wtl_get_first_embed_media( $post_id, $wtl_settings = '' ) {
		$post        = get_post( $post_id );
		$content     = $post->post_content;
		$audio_video = new WP_Embed();
		$content     = $audio_video->run_shortcode( $content );
		$content     = $audio_video->autoembed( $content );
		$content     = wpautop( $content );
		$embeds      = get_media_embedded_in_content( $content );
		$post_format = get_post_format( $post_id );
		if ( isset( $wtl_settings['wp_timeline_lazy_load_image'] ) && 1 == $wtl_settings['wp_timeline_lazy_load_image'] ) {
			add_filter( 'wp_get_attachment_image_attributes', 'lazyload_images_modify_post_thumbnail_attr', 10, 3 );
		}
		if ( 'gallery' === $post_format ) {
			$gallery_images = get_post_gallery( $post_id, false );
			ob_start();
			if ( $gallery_images ) {
				if ( ! wp_script_is( 'wp-timeline-gallery-image-script', 'enqueued' ) ) {
					wp_enqueue_script( 'wp-timeline-gallery-image-script' );
				}
				?>
				<div class="wtl-flexslider flexslider" style="margin:0">
					<ul class="wtl-slides slides">
						<?php
						if ( isset( $gallery_images['ids'] ) ) {
							$gallery_images_ids = $gallery_images['ids'];
							$gallery_images_ids = explode( ',', $gallery_images_ids );
							if ( isset( $wtl_settings['wp_timeline_media_size'] ) && 'custom' == $wtl_settings['wp_timeline_media_size'] ) {
								foreach ( $gallery_images_ids as $gallery_images_id ) {
									$url           = wp_get_attachment_url( $gallery_images_id );
									$width         = isset( $wtl_settings['media_custom_width'] ) ? $wtl_settings['media_custom_width'] : 560;
									$height        = isset( $wtl_settings['media_custom_height'] ) ? $wtl_settings['media_custom_height'] : 350;
									$resized_image = self::wp_timeline_resize( $width, $height, $url, true, $gallery_images_id );
									echo '<li style="margin:0">';
									echo '<img src="' . esc_url( $resized_image['url'] ) . '" width="' . esc_attr( $resized_image['width'] ) . '" height="' . esc_attr( $resized_image['height'] ) . '" />';
									if ( 1 == $wtl_settings['wp_timeline_lightbox'] ) {
										echo '<div class="img-overlay">
											<a rel="lightcase" data-rel="lightcase:my-slideshow" title="' . esc_attr( $post->post_title ) . '" class="open_up" href="' . esc_url( $resized_image['url'] ) . '"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
										</div>';
									}
									echo '</li>';
								}
							} elseif ( isset( $wtl_settings['wp_timeline_media_size'] ) && 'full' !== $wtl_settings['wp_timeline_media_size'] ) {
								$post_thumbnail = $wtl_settings['wp_timeline_media_size'];
								foreach ( $gallery_images_ids as $gallery_images_id ) {
									echo '<li style="margin:0">';
									echo wp_get_attachment_image( $gallery_images_id, $post_thumbnail );
									if ( 1 == $wtl_settings['wp_timeline_lightbox'] ) {
										echo '<div class="img-overlay">
											<a rel="lightcase" data-rel="lightcase:my-slideshow" title="' . esc_attr( $post->post_title ) . '" class="open_up" href="' . esc_url( $resized_image['url'] ) . '"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
										</div>';
									}
									echo '</li>';
								}
							} else {
								foreach ( $gallery_images['src'] as $gallery_images ) {
									echo '<li style="margin:0">';
									echo '<img src="' . esc_url( $gallery_images ) . '" />';
									if ( 1 == $wtl_settings['wp_timeline_lightbox'] ) {
										echo '<div class="img-overlay">
											<a rel="lightcase" data-rel="lightcase:my-slideshow" title="' . esc_attr( $post->post_title ) . '" class="open_up" href="' . esc_url( $resized_image['url'] ) . '"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
										</div>';
									}
									echo '</li>';
								}
							}
						} else {
							foreach ( $gallery_images['src'] as $gallery_images ) {
								echo '<li style="margin:0">';
								echo '<img src="' . esc_url( $gallery_images ) . '" />';
								echo '</li>';
							}
						}
						?>
					</ul>
				</div>
				<?php
			}
			$gallery_img = ob_get_clean();
			return $gallery_img;
		} elseif ( 'video' === $post_format ) {
			$pattern = get_shortcode_regex();
			if ( preg_match_all( '/' . $pattern . '/s', $content, $matches ) && array_key_exists( 2, $matches ) && in_array( 'video', $matches[2], true ) ) {
				return do_shortcode( $matches[0][0] );
			}
			if ( ! empty( $embeds ) && isset( $embeds[0] ) ) {
				return $embeds[0];
			}
		} elseif ( 'audio' === $post_format ) {
			$pattern = get_shortcode_regex();
			if ( preg_match_all( '/' . $pattern . '/s', $content, $matches ) && array_key_exists( 2, $matches ) && in_array( 'audio', $matches[2], true ) ) {
				if ( isset( $matches[0][0] ) ) {
					return do_shortcode( $matches[0][0] );
				}
			}
			if ( preg_match( '/https:\/\/[\"soundcloud.com]+\.[a-zA-Z0-9]{2,3}(\/\S*)?/', $post->post_content, $result ) ) {
				if ( isset( $result[0] ) && wp_oembed_get( $result[0] ) ) {
					return wp_oembed_get( $result[0] );
				} else {
					if ( isset( $result[0] ) ) {
						$surl = substr( $result[0], 0, strpos( $result[0], '"' ) );
						return wp_oembed_get( $surl );
					}
				}
			}
			if ( preg_match_all( '/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $post->post_content, $matches ) ) {
				if ( $matches && isset( $matches[1] ) ) {
					$iframe_round = 0;
					foreach ( $matches[1] as $single_match ) {
						if ( strpos( $single_match, 'w.soundcloud.com/player/' ) ) {
							return $matches[0][ $iframe_round ];
						}
						$iframe_round++;
					}
				}
			}
		}
		return false;
	}

	/**
	 * Get post author
	 *
	 * @since 2.0
	 * @param int   $post_id post id.
	 * @param array $wtl_settings settings.
	 * @return array.
	 */
	public static function wtl_get_post_auhtors( $post_id, $wtl_settings ) {
		$author_link = ( isset( $wtl_settings['disable_link_author'] ) && 1 == $wtl_settings['disable_link_author'] ) ? false : true;
		$authors     = '';
		if ( function_exists( 'coauthors_posts_links' ) ) {
			$authors = coauthors_posts_links( ',', ', ', null, null, false );
			$authors = ( ! $author_link ) ? wp_strip_all_tags( $authors ) : $authors;
		} else {
			$authors .= ( ( 'product' !== get_post_type( $post_id ) || 'download' !== get_post_type( $post_id ) ) && $author_link ) ? '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" >' : '';
			$authors .= get_the_author();
			$authors .= ( ( 'product' !== get_post_type( $post_id ) || 'download' !== get_post_type( $post_id ) ) && $author_link ) ? '</a>' : '';
		}
		return $authors;
	}

	/**
	 * Display Easy digital download product display.
	 *
	 * @param array $wtl_settings settings.
	 * @param int   $wtl_post_id post id.
	 * @return void
	 */
	public static function wtl_edd_display_product_details( $wtl_settings, $wtl_post_id ) {
		if ( isset( $wtl_settings['display_download_price'] ) && 1 == $wtl_settings['display_download_price'] ) {
			?>
			<div class="wp_timeline_edd_price_wrapper">
				<div itemprop="price" class="edd_price">
					<?php
					if ( edd_has_variable_prices( $wtl_post_id ) ) {
						echo wp_kses( edd_price_range( $wtl_post_id ), Wp_Timeline_Public::args_kses() );
					} else {
						edd_price( $wtl_post_id, true );
					}
					?>
				</div>
			</div>
			<?php
		}
		if ( isset( $wtl_settings['display_edd_addtocart_button'] ) && 1 == $wtl_settings['display_edd_addtocart_button'] ) {
			echo '<div class="wtl_edd_download_buy_button">';
			?>
			<div class="edd_download_buy_button"><?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?></div>
			<?php
			echo '</div>';
		}
	}

	/**
	 * Display woo product display.
	 *
	 * @param array $wtl_settings settings.
	 * @param int   $wtl_post_id post id.
	 * @return void
	 */
	public static function wtl_woo_display_product_details( $wtl_settings, $wtl_post_id ) {
		if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			if ( 1 == isset( $wtl_settings['display_product_price'] ) || 1 == isset( $wtl_settings['display_addtocart_button'] ) || class_exists( 'YITH_WCWL' ) || 1 == isset( $wtl_settings['display_product_rating'] ) ) {
				?>
				<div class="wp_timeline_woocommerce_meta_box">
					<?php
					if ( isset( $wtl_settings['display_product_price'] ) && 1 == $wtl_settings['display_product_price'] ) {
						echo '<div class="wp_timeline_woocommerce_price_wrap">';
						woocommerce_template_loop_price();
						echo '</div>';
					}
					if ( isset( $wtl_settings['display_product_rating'] ) && 1 == $wtl_settings['display_product_rating'] && get_comments_number( $wtl_post_id ) > 0 ) {
						echo '<div class="wp_timeline_woocommerce_star_wrap">';
						woocommerce_template_loop_rating();
						echo '</div>';
					}
					if ( class_exists( 'YITH_WCWL' ) ) {
						if ( isset( $wtl_settings['display_addtowishlist_button'] ) && isset( $wtl_settings['wp_timeline_wishlistbutton_on'] ) && 1 == $wtl_settings['display_addtowishlist_button'] && 1 == $wtl_settings['wp_timeline_wishlistbutton_on'] ) {
							$wp_timeline_cart_wishlistbutton_alignment = ( isset( $wtl_settings['wp_timeline_cart_wishlistbutton_alignment'] ) && ! empty( $wtl_settings['wp_timeline_cart_wishlistbutton_alignment'] ) ) ? $wtl_settings['wp_timeline_cart_wishlistbutton_alignment'] : '0';
							$wp_timeline_cartwishlist_wrapp            = '';
							if ( '' != $wp_timeline_cart_wishlistbutton_alignment ) {
								$wp_timeline_cartwishlist_wrapp = 'wp_timeline_cartwishlist_wrapp';
							}
							echo '<div class="wp_timeline_wishlistbutton_on_same_line ' . esc_attr( $wp_timeline_cartwishlist_wrapp ) . '">';
						}
					}
					if ( isset( $wtl_settings['display_addtocart_button'] ) && 1 == $wtl_settings['display_addtocart_button'] ) {
						echo '<div class="wp_timeline_woocommerce_add_to_cart_wrap">';
						woocommerce_template_loop_add_to_cart();
						echo '</div>';
					}
					if ( class_exists( 'YITH_WCWL' ) ) {
						if ( isset( $wtl_settings['display_addtowishlist_button'] ) && 1 == $wtl_settings['display_addtowishlist_button'] ) {
							echo '<div class="wp_timeline_woocommerce_add_to_wishlist_wrap">';
							echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
							echo '</div>';
						}
					}
					if ( class_exists( 'YITH_WCWL' ) ) {
						if ( isset( $wtl_settings['display_addtowishlist_button'] ) && isset( $wtl_settings['wp_timeline_wishlistbutton_on'] ) && 1 == $wtl_settings['display_addtowishlist_button'] && 1 == $wtl_settings['wp_timeline_wishlistbutton_on'] ) {
							echo '</div>';
						}
					}
					?>
			</div>
				<?php
			}
		}
	}

	/**
	 * Display sale tag
	 *
	 * @return void
	 */
	public static function wtl_woo_display_sale_tag() {
		if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			woocommerce_show_product_loop_sale_flash();
		}
	}

	/**
	 * Display sale tag
	 *
	 * @param string $html html.
	 * @return html
	 */
	public static function wtl_close_tags( $html = '' ) {
		if ( '' == $html ) {
			return;
		}
		preg_match_all( '#<([a-z]+)( .*)?(?!/)>#iU', $html, $result );
		$openedtags = $result[1];
		preg_match_all( '#</([a-z]+)>#iU', $html, $result );
		$closedtags = $result[1];
		$len_opened = count( $openedtags );
		if ( count( $closedtags ) == $len_opened ) {
			return $html;
		}
		$openedtags = array_reverse( $openedtags );
		for ( $i = 0; $i < $len_opened; $i++ ) {
			if ( ! in_array( $openedtags[ $i ], $closedtags ) ) {
				$html .= '</' . $openedtags[ $i ] . '>';
			} else {
				unset( $closedtags[ array_search( $openedtags[ $i ], $closedtags ) ] );
			}
		}
		return $html;
	}

	/**
	 * Change in exceprt content
	 *
	 * @param int     $wtl_post_id post id.
	 * @param array   $wtl_settings settings.
	 * @param boolean $rss_use_excerpt rss use excerpt.
	 * @param int     $excerpt_length excerpt lenght.
	 * @return html
	 */
	public static function wtl_get_content( $wtl_post_id, $wtl_settings, $rss_use_excerpt = 0, $excerpt_length = 20 ) {
		add_filter(
			'the_content_more_link',
			function( $link ) {
				$link = '';
				return $link;
			},
			999
		);
		if ( '' != $excerpt_length && $excerpt_length < 1 ) {
			return;
		}
		remove_all_filters( 'excerpt_more' );
		if ( 0 == $rss_use_excerpt ) :
			$content = apply_filters( 'the_content', get_the_content( $wtl_post_id ) );
			$content = apply_filters( 'wtl_content_change', $content, $wtl_post_id );
			if ( isset( $wtl_settings['firstletter_big'] ) && 1 == $wtl_settings['firstletter_big'] ) {
				return self::wtl_add_first_letter_structure( $content );
			} else {
				return $content;
			}
		else :
			$template_post_content_from = 'from_content';
			if ( isset( $wtl_settings['template_post_content_from'] ) ) {
				$template_post_content_from = $wtl_settings['template_post_content_from'];
			}
			if ( 'from_excerpt' === $template_post_content_from ) {
				if ( get_the_excerpt( $wtl_post_id ) != '' ) {
					$excerpt = get_the_excerpt( $wtl_post_id );
					$excerpt = preg_replace( '#<script(.*?)>(.*?)</script>#is', '', $excerpt );
					$excerpt = strip_shortcodes( $excerpt );
				} else {
					$excerpt = get_the_content( $wtl_post_id );
					$excerpt = preg_replace( '#<script(.*?)>(.*?)</script>#is', '', $excerpt );
					// commneted for fusion builder support.
					$excerpt = apply_filters( 'wtl_content_filter', $excerpt );
					$excerpt = apply_filters( 'the_content', $excerpt );
					$excerpt = preg_replace( '#<script(.*?)>(.*?)</script>#is', '', $excerpt );
				}
			} else {
				$excerpt = get_the_content( $wtl_post_id );
				$excerpt = preg_replace( '#<script(.*?)>(.*?)</script>#is', '', $excerpt );
				// commneted for fusion builder support.
				$excerpt = apply_filters( 'wtl_content_filter', $excerpt );
				$excerpt = apply_filters( 'the_content', $excerpt );
				$excerpt = preg_replace( '#<script(.*?)>(.*?)</script>#is', '', $excerpt );
			}
			if ( isset( $wtl_settings['display_html_tags'] ) && 1 == $wtl_settings['display_html_tags'] ) {
				$text = $excerpt;
				if ( 0 === strpos( _x( 'Words', 'Word count type. Do not translate!', 'wp-timeline-designer-pro' ), 'characters' ) && preg_match( '/^utf\-?8$/i', get_option( 'blog_charset' ) ) ) {
					$text = trim( preg_replace( "/[\n\r\t ]+/", ' ', $text ), ' ' );
					preg_match_all( '/./u', $text, $words_array );
					$words_array = array_slice( $words_array[0], 0, $excerpt_length + 1 );
					$sep         = '';
				} else {
					$words_array = preg_split( "/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY );
					$sep         = ' ';
				}
				if ( count( $words_array ) > $excerpt_length ) {
					array_pop( $words_array );
					$text             = implode( $sep, $words_array );
					$wtl_excerpt_data = $text;
				} else {
					$wtl_excerpt_data = implode( $sep, $words_array );
				}
				$first_letter = $wtl_excerpt_data;
				if ( isset( $wtl_settings['firstletter_big'] ) && 1 == $wtl_settings['firstletter_big'] ) {
					if ( preg_match( '#(>|]|^)(([A-Z]|[a-z]|[0-9]|[\p{L}])(.*\R)*(\R)*.*)#m', $first_letter, $matches ) ) {
						$top_content             = str_replace( $matches[2], '', $first_letter );
						$content_change          = ltrim( $matches[2] );
						$bp_content_first_letter = mb_substr( $content_change, 0, 1 );
						if ( ' ' === mb_substr( $content_change, 1, 1 ) ) {
							$bp_remaining_letter = ' ' . mb_substr( $content_change, 2 );
						} else {
							$bp_remaining_letter = mb_substr( $content_change, 1 );
						}
						$spanned_first_letter = '<span class="wtl-first-letter">' . esc_html( $bp_content_first_letter ) . '</span>';
						$bottom_content       = $spanned_first_letter . $bp_remaining_letter;
						$wtl_excerpt_data     = $top_content . $bottom_content;
					}
				}
				$wtl_excerpt_data = self::wtl_advance_contens( $wtl_settings, $wtl_excerpt_data );
				$wtl_excerpt_data = self::wtl_close_tags( $wtl_excerpt_data );
				if ( 'from_excerpt' === $template_post_content_from && '' != get_the_excerpt( $wtl_post_id ) ) {
					$wtl_excerpt_data = apply_filters( 'the_excerpt', $wtl_excerpt_data );
				} else {
					$wtl_excerpt_data = apply_filters( 'the_content', $wtl_excerpt_data );
				}
				return html_entity_decode( $wtl_excerpt_data );
			} else {
				if ( $excerpt_length ) {
					$text = str_replace( ']]>', ']]&gt;', $excerpt );
					$text = wp_strip_all_tags( $text );
					if ( strpos( _x( 'Word count type. Do not translate!', 'wp-timeline-designer-pro' ), 'characters' ) === 0 && preg_match( '/^utf\-?8$/i', get_option( 'blog_charset' ) ) ) {
						$text = trim( preg_replace( "/[\n\r\t ]+/", ' ', $text ), ' ' );
						preg_match_all( '/./u', $text, $words_array );
						$words_array = array_slice( $words_array[0], 0, $excerpt_length + 1 );
						$sep         = '';
					} else {
						$words_array = preg_split( "/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY );
						$sep         = ' ';
					}
					if ( count( $words_array ) > $excerpt_length ) {
						array_pop( $words_array );
						$text             = implode( $sep, $words_array );
						$wtl_excerpt_data = $text;
					} else {
						$wtl_excerpt_data = implode( $sep, $words_array );
					}
					$wtl_excerpt_data = self::wtl_advance_contens( $wtl_settings, $wtl_excerpt_data );
					$wtl_excerpt_data = wp_trim_words( $wtl_excerpt_data, $excerpt_length, '' );
					$wtl_excerpt_data = apply_filters( 'wtl_excerpt_change', $wtl_excerpt_data, $wtl_post_id );
					return $wtl_excerpt_data;
				}
			}
		endif;
	}

	/**
	 * Add First letter struture.
	 *
	 * @param type $content content.
	 * @return string
	 */
	public static function wtl_add_first_letter_structure( $content ) {
		if ( preg_match( '#(>|]|^)(([A-Z]|[a-z]|[0-9]|[\p{L}])(.*\R)*(\R)*.*)#m', $content, $matches ) ) {
			$top_content              = str_replace( $matches[2], '', $content );
			$content_change           = ltrim( $matches[2] );
			$wtl_content_first_letter = mb_substr( $content_change, 0, 1 );
			if ( ' ' === mb_substr( $content_change, 1, 1 ) ) {
				$wtl_remaining_letter = ' ' . mb_substr( $content_change, 2 );
			} else {
				$wtl_remaining_letter = mb_substr( $content_change, 1 );
			}
			$spanned_first_letter = '<span class="wp-timeline-first-letter">' . esc_html( $wtl_content_first_letter ) . '</span>';
			$bottom_content       = $spanned_first_letter . $wtl_remaining_letter;
			return $top_content . $bottom_content;
		}
		return $content;
	}

	/**
	 * Get the advance contents
	 *
	 * @since 2.0
	 * @param array  $wtl_settings settings.
	 * @param string $wtl_excerpt_data  exerpt data.
	 * @return array
	 */
	public static function wtl_advance_contens( $wtl_settings, $wtl_excerpt_data = '' ) {
		if ( '' == $wtl_excerpt_data ) {
			return $wtl_excerpt_data;
		}
		if ( isset( $wtl_settings['advance_contents'] ) && 1 == $wtl_settings['advance_contents'] ) {
			$stopage_from = isset( $wtl_settings['contents_stopage_from'] ) ? $wtl_settings['contents_stopage_from'] : 'paragraph';
			if ( isset( $wtl_settings['display_html_tags'] ) && 1 == $wtl_settings['display_html_tags'] ) {
				$stopage_from = 'paragraph';
			}
			if ( 'paragraph' == $stopage_from ) {
				$stopage_characters = array( '</p>', '</div>', '<br' );
				foreach ( $stopage_characters as $stopage_character ) {
					$strpose[] = strrpos( $wtl_excerpt_data, $stopage_character );
				}
				if ( substr( $wtl_excerpt_data, 0, max( $strpose ) ) != '' ) {
					$wtl_excerpt_data = substr( $wtl_excerpt_data, 0, max( $strpose ) );
				}
			} elseif ( 'character' == $stopage_from ) {
				$stopage_characters = isset( $wtl_settings['contents_stopage_character'] ) ? $wtl_settings['contents_stopage_character'] : array( '.' );
				foreach ( $stopage_characters as $stopage_character ) {
					$strpose[] = strrpos( $wtl_excerpt_data, $stopage_character );
				}
				if ( substr( $wtl_excerpt_data, 0, '' != max( $strpose ) + 1 ) && isset( $strpose[0] ) && ! empty( $strpose[0] ) ) {
					$wtl_excerpt_data = substr( $wtl_excerpt_data, 0, max( $strpose ) + 1 );
				}
			}
		}
		return $wtl_excerpt_data;
	}

	/**
	 *  Add social share icons
	 *
	 * @param array $wtl_settings settings.
	 * @return void
	 */
	public static function wtl_get_social_icons( $wtl_settings ) {
		global $post;
		$social_share = ( isset( $wtl_settings['social_share'] ) && 0 == $wtl_settings['social_share'] ) ? false : true;
		if ( $social_share ) {
			if ( ( 1 == $wtl_settings['facebook_link'] ) || ( 1 == $wtl_settings['twitter_link'] ) || ( 1 == $wtl_settings['linkedin_link'] ) || ( isset( $wtl_settings['email_link'] ) && 1 == $wtl_settings['email_link'] ) || ( 1 == $wtl_settings['pinterest_link'] ) || ( isset( $wtl_settings['telegram_link'] ) && 1 == $wtl_settings['telegram_link'] ) || ( isset( $wtl_settings['pocket_link'] ) && 1 == $wtl_settings['pocket_link'] ) || ( isset( $wtl_settings['skype_link'] ) && 1 == $wtl_settings['skype_link'] ) || ( isset( $wtl_settings['telegram_link'] ) && 1 == $wtl_settings['telegram_link'] ) || ( isset( $wtl_settings['reddit_link'] ) && 1 == $wtl_settings['reddit_link'] ) || ( isset( $wtl_settings['digg_link'] ) && 1 == $wtl_settings['digg_link'] ) || ( isset( $wtl_settings['tumblr_link'] ) && 1 == $wtl_settings['tumblr_link'] ) || ( isset( $wtl_settings['wordpress_link'] ) && 1 == $wtl_settings['wordpress_link'] ) || ( isset( $wtl_settings['whatsapp_link'] ) && 1 == $wtl_settings['whatsapp_link'] ) ) {
				if ( ! wp_script_is( 'wp-timeline-socialShare-script', 'enqueued' ) ) {
					wp_enqueue_script( 'wp-timeline-socialShare-script' );
				}
				$social_theme = ' default_social_style_1 ';
				if ( isset( $wtl_settings['default_icon_theme'] ) && isset( $wtl_settings['social_style'] ) && 1 == $wtl_settings['social_style'] ) {
					$social_theme = ' default_social_style_' . $wtl_settings['default_icon_theme'] . ' ';
				}
				$social_share_position = ( isset( $wtl_settings['social_share_position'] ) && '' != $wtl_settings['social_share_position'] ) ? $wtl_settings['social_share_position'] : '';
				$social_style          = ( isset( $wtl_settings['social_style'] ) && 1 == $wtl_settings['social_style'] ) ? 'wp-timeline-social-style-defult' : 'wp-timeline-social-style-custom';
				?>
				<div class="wtl_social_share_postion <?php echo esc_attr( $social_share_position ) . '_position'; ?>">
					<div class="social-component
					<?php
					echo esc_attr( $social_theme ) . ' ' . esc_attr( $social_style );
					echo ' wtl_social_count_' . esc_attr( get_the_ID() );
					if ( isset( $wtl_settings['social_style'] ) && 0 == $wtl_settings['social_style'] ) {
						if ( isset( $wtl_settings['social_icon_size'] ) && 0 == $wtl_settings['social_icon_size'] ) {
							echo ' large';
						} elseif ( isset( $wtl_settings['social_icon_size'] ) && 1 == $wtl_settings['social_icon_size'] ) {
							echo ' large_small';
						} elseif ( isset( $wtl_settings['social_icon_size'] ) && 2 == $wtl_settings['social_icon_size'] ) {
							echo ' extra_small';
						}
					}
					if ( isset( $wtl_settings['social_count_position'] ) ) {
						echo ' ';
						echo esc_attr( $wtl_settings['social_count_position'] );
					}
					?>
					">
					<?php
					if ( 1 == $wtl_settings['facebook_link'] ) {
						$facebook_token = '';
						if ( isset( $wtl_settings['facebook_token'] ) ) {
							$facebook_token = $wtl_settings['facebook_token'];
						}
						?>
						<input type="hidden" value="<?php echo esc_attr( $facebook_token ); ?>" name="fb_token" id ="fb_token">
						<?php
						if ( isset( $wtl_settings['facebook_link_with_count'] ) && 1 == $wtl_settings['facebook_link_with_count'] ) {
							if ( isset( $wtl_settings['social_style'] ) && 1 == $wtl_settings['social_style'] ) {
								?>
								<div class="social-share"><a data-share="facebook" href="https://www.facebook.com/sharer/sharer.php" data-href="https://www.facebook.com/sharer/sharer.php" data-url="<?php echo esc_url( get_the_permalink() ); ?>" class="wp-timeline-facebook-share social-share-default wp-timeline-social-share"></a></div>
							<?php } else { ?>
								<div class="social-share"><a data-share="facebook" href="https://www.facebook.com/sharer/sharer.php" data-href="https://www.facebook.com/sharer/sharer.php" data-url="<?php echo esc_url( get_the_permalink() ); ?>" class="wp-timeline-facebook-share facebook-share social-share-custom wp-timeline-social-share"><i class="fab fa-facebook-f"></i></a></div>
							<?php } ?>
						<?php } else { ?>
							<div class="social-share">
								<?php
								if ( isset( $wtl_settings['social_style'] ) && 1 == $wtl_settings['social_style'] ) {
									if ( isset( $wtl_settings['social_count_position'] ) && 'top' === $wtl_settings['social_count_position'] ) {
										?>
										<div class="count c_facebook facebook-count">0</div><?php } ?>
										<a data-share="facebook" href="https://www.facebook.com/sharer/sharer.php" data-href="https://www.facebook.com/sharer/sharer.php" data-url="<?php echo esc_url( get_the_permalink() ); ?>" class="wp-timeline-facebook-share social-share-default wp-timeline-social-share"></a>
										<?php
								} else {
									if ( isset( $wtl_settings['social_count_position'] ) && 'top' === $wtl_settings['social_count_position'] ) {
										?>
											<div class="count c_facebook facebook-count">0</div>
										<?php
									}
									?>
										<a data-share="facebook" href="https://www.facebook.com/sharer/sharer.php" data-href="https://www.facebook.com/sharer/sharer.php" data-url="<?php echo esc_url( get_the_permalink() ); ?>" class="wp-timeline-facebook-share facebook-share social-share-custom wp-timeline-social-share"><i class="fab fa-facebook-f"></i></a>
										<?php
								}
								if ( ( isset( $wtl_settings['social_count_position'] ) && 'bottom' === $wtl_settings['social_count_position'] ) || ( isset( $wtl_settings['social_count_position'] ) && 'right' === $wtl_settings['social_count_position'] ) ) {
									?>
										<div class="count c_facebook facebook-count">0</div>
									<?php } ?>
								</div>
								<?php
						}
					}
					if ( 1 == $wtl_settings['twitter_link'] ) {
						echo '<div class="social-share">';
						if ( isset( $wtl_settings['social_style'] ) && 1 == $wtl_settings['social_style'] ) {
							?>
								<a data-share="twitter" href="https://twitter.com/share" data-href="https://twitter.com/share" data-text="<?php echo esc_attr( $post->post_title ); ?>" data-url="<?php echo esc_url( get_the_permalink() ); ?>" class="wp-timeline-twitter-share social-share-default wp-timeline-social-share"></a>
							<?php } else { ?>
								<a data-share="twitter" href="https://twitter.com/share" data-href="https://twitter.com/share" data-text="<?php echo esc_attr( $post->post_title ); ?>" data-url="<?php echo esc_url( get_the_permalink() ); ?>" class="wp-timeline-twitter-share social-share-custom wp-timeline-social-share"><i class="fab fa-twitter"></i></a>
								<?php
							}
							echo '</div>';
					}
					if ( 1 == $wtl_settings['linkedin_link'] ) {
						?>
						<div class="social-share">
						<?php
						if ( isset( $wtl_settings['social_style'] ) && 1 == $wtl_settings['social_style'] ) {
							?>
							<a data-share="linkedin" href="https://www.linkedin.com/shareArticle" data-href="https://www.linkedin.com/shareArticle" data-url="<?php echo esc_url( get_the_permalink() ); ?>" class="wp-timeline-linkedin-share social-share-default wp-timeline-social-share">
							</a>
							<?php
						} else {
							?>
							<a data-share="linkedin" href="https://www.linkedin.com/shareArticle" data-href="https://www.linkedin.com/shareArticle" data-url="<?php echo esc_url( get_the_permalink() ); ?>" class="wp-timeline-linkedin-share social-share-custom wp-timeline-social-share">
								<i class="fab fa-linkedin-in"></i>
							</a>
							<?php
						}
						?>
						</div>
						<?php
					}
					if ( 1 == $wtl_settings['pinterest_link'] ) {
						// $pinterestimage = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );.
						if ( isset( $wtl_settings['pinterest_link_with_count'] ) && 1 == $wtl_settings['pinterest_link_with_count'] ) {
							?>
							<div class="social-share">
								<?php if ( isset( $wtl_settings['social_style'] ) && 1 == $wtl_settings['social_style'] ) { ?>
									<a data-share="pinterest" href="https://pinterest.com/pin/create/button/" data-href="https://pinterest.com/pin/create/button/" data-url="<?php echo esc_url( get_the_permalink() ); ?>" data-mdia="<?php // echo esc_attr( $pinterestimage[0] );. ?>" data-description="<?php echo esc_attr( $post->post_title ); ?>" class="wp-timeline-pinterest-share social-share-default wp-timeline-social-share"></a>
								<?php } else { ?>
									<a data-share="pinterest" href="https://pinterest.com/pin/create/button/" data-href="https://pinterest.com/pin/create/button/" data-url="<?php echo esc_url( get_the_permalink() ); ?>" data-mdia="<?php // echo esc_attr( $pinterestimage[0] );. ?>" data-description="<?php echo esc_attr( $post->post_title ); ?>" class="wp-timeline-pinterest-share social-share-custom wp-timeline-social-share"><i class="fab fa-pinterest"></i></a>
								<?php } ?>
							</div>
							<?php
						} else {
							?>
							<div class="social-share">
							<?php
							if ( isset( $wtl_settings['social_style'] ) && 1 == $wtl_settings['social_style'] ) {
								if ( isset( $wtl_settings['social_count_position'] ) && 'top' === $wtl_settings['social_count_position'] ) {
									?>
										<div class="count c_pinterest pinterest-count">0</div> 
									<?php
								}
								?>
									<a data-share="pinterest" href="https://pinterest.com/pin/create/button/" data-href="https://pinterest.com/pin/create/button/" data-url="<?php echo esc_url( get_the_permalink() ); ?>" data-mdia="<?php // echo esc_attr( $pinterestimage[0] );. ?>" data-description="<?php echo esc_attr( $post->post_title ); ?>" class="wp-timeline-pinterest-share social-share-default wp-timeline-social-share"></a>
									<?php
							} else {
								if ( isset( $wtl_settings['social_count_position'] ) && 'top' === $wtl_settings['social_count_position'] ) {
									?>
									<div class="count c_pinterest pinterest-count">0</div> 
									<?php
								}
								?>

									<a data-share="pinterest" href="https://pinterest.com/pin/create/button/" data-href="https://pinterest.com/pin/create/button/" data-url="<?php echo esc_url( get_the_permalink() ); ?>" data-mdia="<?php // echo esc_attr( $pinterestimage[0] );. ?>" data-description="<?php echo esc_attr( $post->post_title ); ?>" class="wp-timeline-pinterest-share social-share-custom wp-timeline-social-share">
										<i class="fab fa-pinterest"></i>
									</a>
									<?php
							}
							if ( ( isset( $wtl_settings['social_count_position'] ) && 'bottom' == $wtl_settings['social_count_position'] ) || ( isset( $wtl_settings['social_count_position'] ) && 'right' == $wtl_settings['social_count_position'] ) ) {
								?>
								<div class="count c_pinterest pinterest-count">0</div><?php } ?>
							</div>
							<?php
						}
					}
					if ( isset( $wtl_settings['skype_link'] ) && 1 == $wtl_settings['skype_link'] ) {
						echo '<div class="social-share">';
						if ( isset( $wtl_settings['social_style'] ) && 1 == $wtl_settings['social_style'] ) {
							?>
								<a data-share="skype" href="https://web.skype.com/share" data-href="https://web.skype.com/share" data-url="<?php echo esc_url( get_the_permalink() ); ?>" data-text="<?php echo esc_attr( $post->post_title ); ?>" class="wp-timeline-skype-share social-share-default wp-timeline-social-share"></a>
							<?php } else { ?>
								<a data-share="skype" href="https://web.skype.com/share" data-href="https://web.skype.com/share" data-url="<?php echo esc_url( get_the_permalink() ); ?>" data-text="<?php echo esc_attr( $post->post_title ); ?>" class="wp-timeline-telegram-share social-share-custom wp-timeline-social-share"><i class="fab fa-skype"></i></a>
								<?php
							}
							echo '</div>';
					}
					if ( isset( $wtl_settings['telegram_link'] ) && 1 == $wtl_settings['telegram_link'] ) {
						echo '<div class="social-share">';
						if ( isset( $wtl_settings['social_style'] ) && 1 == $wtl_settings['social_style'] ) {
							?>
								<a data-share="telegram" href="https://telegram.me/share/url"  data-href="https://telegram.me/share/url" data-url="<?php echo esc_url( urldecode( get_the_permalink() ) ); ?>" data-text="<?php echo esc_attr( $post->post_title ); ?>" class="wp-timeline-telegram-share social-share-default wp-timeline-social-share"></a>
							<?php } else { ?>
								<a data-share="telegram" href="https://telegram.me/share/url" data-href="https://telegram.me/share/url" data-url="<?php echo esc_url( urldecode( get_the_permalink() ) ); ?>" data-text="<?php echo esc_attr( $post->post_title ); ?>" class="wp-timeline-telegram-share social-share-custom wp-timeline-social-share"><i class="fab fa-telegram-plane"></i></a>
								<?php
							}
							echo '</div>';
					}
					if ( isset( $wtl_settings['pocket_link'] ) && 1 == $wtl_settings['pocket_link'] ) {
						echo '<div class="social-share">';
						if ( isset( $wtl_settings['social_style'] ) && 1 == $wtl_settings['social_style'] ) {
							?>
								<a data-share="pocket" href="https://getpocket.com/save" data-href="https://getpocket.com/save" data-url="<?php echo esc_url( get_the_permalink() ); ?>" data-title="<?php echo esc_attr( $post->post_title ); ?>" class="wp-timeline-pocket-share social-share-default wp-timeline-social-share"></a>
							<?php } else { ?>
								<a data-share="pocket" href="https://getpocket.com/save" data-href="https://getpocket.com/save" data-url="<?php echo esc_url( get_the_permalink() ); ?>" data-title="<?php echo esc_attr( $post->post_title ); ?>" class="wp-timeline-pocket-share social-share-custom wp-timeline-social-share"><i class="fab fa-get-pocket"></i></a>
								<?php
							}
							echo '</div>';
					}
					if ( isset( $wtl_settings['reddit_link'] ) && 1 == $wtl_settings['reddit_link'] ) {
						echo '<div class="social-share">';
						if ( isset( $wtl_settings['social_style'] ) && 1 == $wtl_settings['social_style'] ) {
							?>
								<a data-share="reddit" href="http://www.reddit.com/submit" data-href="http://www.reddit.com/submit" data-url="<?php echo esc_url( get_the_permalink() ); ?>" data-title="<?php echo esc_attr( $post->post_title ); ?>" class="wp-timeline-reddit-share social-share-default wp-timeline-social-share"></a>
							<?php } else { ?>
								<a data-share="reddit" href="http://www.reddit.com/submit" data-href="http://www.reddit.com/submit" data-url="<?php echo esc_url( get_the_permalink() ); ?>" data-title="<?php echo esc_attr( $post->post_title ); ?>" class="wp-timeline-reddit-share social-share-custom wp-timeline-social-share"><i class="fab fa-reddit-alien"></i></a>
								<?php
							}
							echo '</div>';
					}
					if ( isset( $wtl_settings['digg_link'] ) && 1 == $wtl_settings['digg_link'] ) {
						echo '<div class="social-share">';
						if ( isset( $wtl_settings['social_style'] ) && 1 == $wtl_settings['social_style'] ) {
							?>
								<a data-share="digg" href="http://digg.com/submit" data-href="http://digg.com/submit" data-url="<?php echo esc_url( get_the_permalink() ); ?>" data-title="<?php echo esc_attr( $post->post_title ); ?>" class="wp-timeline-digg-share social-share-default wp-timeline-social-share"></a>
							<?php } else { ?>
								<a data-share="digg" href="http://digg.com/submit" data-href="http://digg.com/submit" data-url="<?php echo esc_url( get_the_permalink() ); ?>" data-title="<?php echo esc_attr( $post->post_title ); ?>" class="wp-timeline-digg-share social-share-custom wp-timeline-social-share"><i class="fab fa-digg"></i></a>
								<?php
							}
							echo '</div>';
					}
					if ( isset( $wtl_settings['tumblr_link'] ) && 1 == $wtl_settings['tumblr_link'] ) {
						echo '<div class="social-share">';
						if ( isset( $wtl_settings['social_style'] ) && 1 == $wtl_settings['social_style'] ) {
							?>
								<a data-share="tumblr" href="http://tumblr.com/widgets/share/tool" data-href="http://tumblr.com/widgets/share/tool" data-url="<?php echo esc_url( get_the_permalink() ); ?>" data-title="<?php echo esc_attr( $post->post_title ); ?>" class="wp-timeline-tumblr-share social-share-default wp-timeline-social-share"></a>
							<?php } else { ?>
								<a data-share="tumblr" href="http://tumblr.com/widgets/share/tool" data-href="http://tumblr.com/widgets/share/tool" data-url="<?php echo esc_url( get_the_permalink() ); ?>" data-title="<?php echo esc_attr( $post->post_title ); ?>" class="wp-timeline-tumblr-share social-share-custom wp-timeline-social-share"><i class="fab fa-tumblr"></i></a>
								<?php
							}
							echo '</div>';
					}
					if ( isset( $wtl_settings['wordpress_link'] ) && 1 == $wtl_settings['wordpress_link'] ) {
						echo '<div class="social-share">';
						if ( isset( $wtl_settings['social_style'] ) && 1 == $wtl_settings['social_style'] ) {
							?>
								<a data-share="wordpress" href="http://wordpress.com/press-this.php" data-href="http://wordpress.com/press-this.php" data-url="<?php echo esc_url( get_the_permalink() ); ?>" data-title="<?php echo esc_attr( $post->post_title ); ?>" data-image="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" class="wp-timeline-wordpress-share social-share-default wp-timeline-social-share"></a>
							<?php } else { ?>
								<a data-share="wordpress" href="http://wordpress.com/press-this.php" data-href="http://wordpress.com/press-this.php" data-url="<?php echo esc_url( get_the_permalink() ); ?>" data-title="<?php echo esc_attr( $post->post_title ); ?>" data-image="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" class="wp-timeline-wordpress-share social-share-custom wp-timeline-social-share"><i class="fab fa-wordpress"></i></a>
								<?php
							}
							echo '</div>';
					}
					if ( isset( $wtl_settings['email_link'] ) && 1 == $wtl_settings['email_link'] ) {
						$shortcode_id = Wp_Timeline::$shortcode_id;
						if ( is_array( $shortcode_id ) && ! empty( $shortcode_id ) ) {
							$shortcode_id = intval( $shortcode_id[0] );
						}
						echo '<div class="social-share">';
						if ( isset( $wtl_settings['social_style'] ) && 1 == $wtl_settings['social_style'] ) {
							?>
								<a href="<?php echo esc_url( get_the_permalink() ); ?>" data-href="<?php echo esc_url( get_the_permalink() ); ?>" data-shortcode-id="<?php echo ( ! empty( $shortcode_id ) ) ? esc_attr( $shortcode_id ) : ''; ?>" data-id="<?php echo esc_attr( get_the_ID() ); ?>" href="javascript:void(0)" class="wp-timeline-email-share wtl-email-share social-share-default wp-timeline-social-share"></a>
							<?php } else { ?>
								<a href="<?php echo esc_url( get_the_permalink() ); ?>" data-href="<?php echo esc_url( get_the_permalink() ); ?>" data-shortcode-id="<?php echo ( ! empty( $shortcode_id ) ) ? esc_attr( $shortcode_id ) : ''; ?>" data-id="<?php echo esc_attr( get_the_ID() ); ?>" href="javascript:void(0)" class="wp-timeline-email-share wtl-email-share social-share-custom wp-timeline-social-share"><i class="far fa-envelope-open"></i></a>
								<?php
							}
							echo '</div>';
					}
					if ( isset( $wtl_settings['whatsapp_link'] ) && 1 == $wtl_settings['whatsapp_link'] ) {
						echo '<div class="social-share whatsapp_share">';
						if ( isset( $wtl_settings['social_style'] ) && 1 == $wtl_settings['social_style'] ) {
							?>
								<a href="<?php echo 'whatsapp://send?text=' . esc_attr( $post->post_title ) . ' ' . esc_url( get_the_permalink() ) . '&url=' . esc_attr( rawurlencode( get_the_permalink() ) ); ?>" data-href="<?php echo 'whatsapp://send?text=' . esc_attr( $post->post_title ) . ' ' . esc_url( get_the_permalink() ) . '&url=' . esc_attr( rawurlencode( get_the_permalink() ) ); ?>" target="_blank" class="wp-timeline-whatsapp-share social-share-default"></a>
							<?php } else { ?>
								<a href="<?php echo 'whatsapp://send?text=' . esc_attr( $post->post_title ) . ' ' . esc_url( get_the_permalink() ) . '&url=' . esc_attr( rawurlencode( get_the_permalink() ) ); ?>" data-href="<?php echo 'whatsapp://send?text=' . esc_attr( $post->post_title ) . ' ' . esc_url( get_the_permalink() ) . '&url=' . esc_attr( rawurlencode( get_the_permalink() ) ); ?>" data-action="share/whatsapp/share" target="_blank" class="wp-timeline-whatsapp-share social-share-custom"><i class="fab fa-whatsapp"></i></a>
								<?php
							}
							echo '</div>';
					}
					if ( ( ! isset( $wtl_settings['pinterest_link_with_count'] ) ) || ( ! isset( $wtl_settings['facebook_link_with_count'] ) ) ) {
						if ( '' != get_the_title() ) {
							?>
							<script type="text/javascript">"use strict";jQuery(document).ready(function(){(function($){ $('.<?php echo 'wtl_social_count_' . get_the_ID(); ?> .count').ShareCounter({ url: '<?php echo esc_attr( get_the_permalink() ); ?>' })}(jQuery))});</script>
							<?php
						}
					}
					?>
					</div>
				</div>
				<?php
			}
		}
	}

	/**
	 * WP Timeline Designer PRO Hex to RGBA convert
	 *
	 * @since  1.0.0
	 * @param  string $color color code.
	 * @param  bolean $opacity opacity.
	 * @return string
	 */
	public static function wtl_hex2rgba( $color, $opacity = false ) {
		$default = 'rgb(0,0,0)';
		// Return default if no color provided.
		if ( empty( $color ) ) {
			return $default;
		}
		// Sanitize $color if "#" is provided.
		if ( '#' === $color[0] ) {
			$color = substr( $color, 1 );
		}
		// Check if color has 6 or 3 characters and get values.
		if ( 6 == strlen( $color ) ) {
			$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		} elseif ( 3 == strlen( $color ) ) {
			$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		} else {
			return $default;
		}
		// Convert hexadec to rgb.
		$rgb = array_map( 'hexdec', $hex );
		// Check if opacity is set(rgba or rgb).
		if ( $opacity ) {
			if ( abs( $opacity ) > 1 ) {
				$opacity = 1.0;
			}
			$output = 'rgba(' . implode( ',', $rgb ) . ',' . $opacity . ')';
		} else {
			$output = 'rgb(' . implode( ',', $rgb ) . ')';
		}
		// Return rgb(a) color string.
		return $output;
	}

	/**
	 * WP Timeline Designer PRO Shortcode standard paging nav
	 *
	 * @since  1.0.0
	 * @param  array $wtl_settings settings array.
	 * @return string
	 */
	public static function wp_timeline_shortcode_standard_paging_nav( $wtl_settings ) {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}
		if ( 'cool_horizontal' === $wtl_settings['template_name'] || 'overlay_horizontal' === $wtl_settings['template_name'] ) {
			$posts_per_page = -1;
		} else {
			$posts_per_page = $wtl_settings['posts_per_page'];
		}
		$wp_timeline_post_offset = ( isset( $wtl_settings['wp_timeline_post_offset'] ) && ! empty( $wtl_settings['wp_timeline_post_offset'] ) ) ? $wtl_settings['wp_timeline_post_offset'] : '0';
		$offset_start            = $wp_timeline_post_offset;
		$total_rows              = max( 0, $GLOBALS['wp_query']->found_posts - $offset_start );
		$total_pages             = ceil( $total_rows / $posts_per_page );
		$navigation              = '';
		$paged                   = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link            = html_entity_decode( get_pagenum_link() );
		$query_args              = array();
		$url_parts               = explode( '?', $pagenum_link );
		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}
		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';
		$format       = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format      .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links(
			array(
				'base'     => $pagenum_link,
				'format'   => $format,
				'total'    => $total_pages,
				'current'  => $paged,
				'mid_size' => 1,
				'add_args' => array_map( 'urlencode', $query_args ),
				'type'     => 'list',
			)
		);
		if ( $links ) :
			$navigation .= '<nav class="navigation paging-navigation" role="navigation">';
			$navigation .= $links;
			$navigation .= '</nav>';
		endif;
		return $navigation;
	}

	/**
	 * Add pinterest button on image
	 *
	 * @param int $wp_timeline_post_id post id.
	 * @return html pinterest image.
	 */
	public static function wp_timeline_pinterest( $wp_timeline_post_id ) {
		global $post;
		ob_start();
		?>
		<div class="wp-timeline-pinterest-share-image">
			<?php
			$img_url = wp_get_attachment_url( get_post_thumbnail_id( $wp_timeline_post_id ) );
			apply_filters( 'wp_timeline_pinterest_img_url', $img_url, $wp_timeline_post_id );
			?>
			<a target="_blank" href="<?php echo esc_url( 'https://pinterest.com/pin/create/button/?url=' . get_permalink( $wp_timeline_post_id ) . '&media=' . esc_url( $img_url ) . '&description =' . esc_attr( $post->post_title ) ); ?>"><i class="fab fa-pinterest"></i></a>
		</div>
		<?php
		$pintrest = ob_get_clean();
		return $pintrest;
	}

	/**
	 * Timeline Resize.
	 *
	 * @param string $width width.
	 * @param string $height height.
	 * @param string $img_url image url.
	 * @param string $crop corp.
	 * @param string $thumbnail_id thumbnail id.
	 * @return html
	 */
	public static function wp_timeline_resize( $width, $height, $img_url = null, $crop = false, $thumbnail_id = 0 ) {
		// this is an attachment, so we have the ID.
		if ( $img_url ) {
			$file_path = wp_parse_url( $img_url );
			$file_path = isset( $_SERVER['DOCUMENT_ROOT'] ) ? sanitize_text_field( wp_unslash( $_SERVER['DOCUMENT_ROOT'] . $file_path['path'] ) ) : '';
			// Look for Multisite Path.
			if ( is_multisite() ) {
				$file_path = get_attached_file( $thumbnail_id, false );
			}
			if ( ! file_exists( $file_path ) ) {
				return;
			}
			$orig_size    = getimagesize( $file_path );
			$image_src[0] = $img_url;
			$image_src[1] = $orig_size[0];
			$image_src[2] = $orig_size[1];
			$file_info    = pathinfo( $file_path );
			$base_file    = $file_info['dirname'] . '/' . $file_info['filename'] . '.' . $file_info['extension']; // check if file exists.

			if ( ! file_exists( $base_file ) ) {
				return;
			}
			$extension = '.' . $file_info['extension'];
			// the image path without the extension.
			$no_ext_path      = $file_info['dirname'] . '/' . $file_info['filename'];
			$cropped_img_path = $no_ext_path . '-' . $width . 'x' . $height . $extension;
			// checking if the file size is larger than the target size.
			// if it is smaller or the same size, stop right here and return.
			if ( $image_src[1] > $width ) {
				// the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match).
				if ( file_exists( $cropped_img_path ) ) {
					$cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
					$wtl_images      = array(
						'url'    => $cropped_img_url,
						'width'  => $width,
						'height' => $height,
					);
					return $wtl_images;
				}
				// $crop = false or no height set.
				if ( false == $crop || ! $height ) {
					// calculate the size proportionaly.
					$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
					$resized_img_path  = $no_ext_path . '-' . $proportional_size[0] . 'x' . $proportional_size[1] . $extension;
					// checking if the file already exists.
					if ( file_exists( $resized_img_path ) ) {
						$resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );
						$wtl_images      = array(
							'url'    => $resized_img_url,
							'width'  => $proportional_size[0],
							'height' => $proportional_size[1],
						);
						return $wtl_images;
					}
				}
				// check if image width is smaller than set width.
				$img_size = getimagesize( $file_path );
				if ( $img_size[0] <= $width ) {
					$width = $img_size[0];
				}
				// Check if GD Library installed.
				if ( ! function_exists( 'imagecreatetruecolor' ) ) {
					esc_html_e( 'GD Library Error: imagecreatetruecolor does not exist - please contact your webhost and ask them to install the GD library', 'wp-timeline-designer-pro' );
					return;
				}
				// no cache files - let's finally resize it.
				$image = wp_get_image_editor( $file_path );
				if ( ! is_wp_error( $image ) ) {
					$new_file_name = $file_info['filename'] . '-' . $width . 'x' . $height . '.' . $file_info['extension'];
					$image->resize( $width, $height, $crop );
					$image->save( $file_info['dirname'] . '/' . $new_file_name );
				}
				$new_img_path = $file_info['dirname'] . '/' . $new_file_name;
				$new_img_size = getimagesize( $new_img_path );
				$new_img      = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );
				// resized output.
				$wtl_images = array(
					'url'    => $new_img,
					'width'  => $new_img_size[0],
					'height' => $new_img_size[1],
				);
				return $wtl_images;
			}
			// default output - without resizing.
			$wtl_images = array(
				'url'    => $image_src[0],
				'width'  => $width,
				'height' => $height,
			);
			return $wtl_images;
		}
	}

	/**
	 * To get posts when load more pagination is on
	 *
	 * @return void
	 */
	public function wtl_load_onscroll_blog() {
		global $wpdb;
		if ( isset( $_POST['nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'ajax-nonce' ) ) {
			$layout = isset( $_POST['wp_timeline_blog_layout'] ) ? sanitize_text_field( wp_unslash( $_POST['wp_timeline_blog_layout'] ) ) : '';
			if ( 'wp_timeline_blog_layout' === $layout ) {
				$blog_shortcode_id = isset( $_POST['wp_timeline_blog_shortcode_id'] ) ? sanitize_text_field( wp_unslash( $_POST['wp_timeline_blog_shortcode_id'] ) ) : '';
				$table_name        = $wpdb->prefix . 'wtl_shortcodes';
				if ( is_numeric( $blog_shortcode_id ) ) {
					$settings_val = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}wtl_shortcodes WHERE wtlid = %d", intval( $blog_shortcode_id ) ), ARRAY_A );
					$allsettings  = $settings_val[0]['wtlsettngs'];
				}
				$count_sticky = 0;
				if ( isset( $allsettings ) && is_serialized( $allsettings ) ) {
					$wtl_settings = maybe_unserialize( $allsettings );
				}
				$post_type         = $wtl_settings['custom_post_type'];
				$posts_per_page    = isset( $_POST['posts_per_page'] ) ? sanitize_text_field( wp_unslash( $_POST['posts_per_page'] ) ) : '';
				$int_page          = isset( $_POST['paged'] ) ? sanitize_text_field( wp_unslash( $_POST['paged'] ) ) : '';
				$paged             = ( (int) $int_page ) + 1;
				$offset            = ( $paged - 1 ) * $posts_per_page;
				$wp_timeline_theme = isset( $_POST['wtl_blog_template'] ) ? sanitize_text_field( wp_unslash( $_POST['wtl_blog_template'] ) ) : '';
				$tags              = '';
				$cats              = '';
				$author            = '';
				$order             = 'DESC';
				$orderby           = 'date';
				if ( isset( $wtl_settings['template_category'] ) ) {
					$cat = $wtl_settings['template_category'];
				}
				if ( isset( $wtl_settings['template_tags'] ) ) {
					$tag = $wtl_settings['template_tags'];
				}
				if ( isset( $wtl_settings['template_authors'] ) ) {
					$author = $wtl_settings['template_authors'];
				}
				if ( isset( $_GET['sortby'] ) && '' != $_GET['sortby'] ) {
					$orderby = sanitize_text_field( wp_unslash( $_GET['sortby'] ) );
				} elseif ( isset( $wtl_settings['wp_timeline_blog_order_by'] ) && '' != $wtl_settings['wp_timeline_blog_order_by'] ) {
					$orderby = $wtl_settings['wp_timeline_blog_order_by'];
				}
				if ( isset( $wtl_settings['wp_timeline_blog_order'] ) && isset( $wtl_settings['wp_timeline_blog_order_by'] ) && '' != $wtl_settings['wp_timeline_blog_order_by'] ) {
					$order = $wtl_settings['wp_timeline_blog_order'];
				}
				if ( empty( $cat ) ) {
					$cat = '';
				}
				if ( empty( $tag ) ) {
					$tag = '';
				}
				if ( isset( $wtl_settings['exclude_category_list'] ) ) {
					$exlude_category = 'category__not_in';
				} else {
					$exlude_category = 'category__in';
				}
				if ( isset( $wtl_settings['exclude_tag_list'] ) ) {
					$exlude_tag = 'tag__not_in';
				} else {
					$exlude_tag = 'tag__in';
				}
				if ( isset( $wtl_settings['exclude_author_list'] ) ) {
					$exlude_author = 'author__not_in';
				} else {
					$exlude_author = 'author__in';
				}
				/**
				 * Time Period
				 */
				$date_query  = array();
				$post_status = array();
				if ( isset( $wtl_settings['blog_time_period'] ) ) {
					$blog_time_period = $wtl_settings['blog_time_period'];
					if ( 'today' === $blog_time_period ) {
						$today      = getdate();
						$date_query = array(
							array(
								'year'  => $today['year'],
								'month' => $today['mon'],
								'day'   => $today['mday'],
							),
						);
					}
					if ( 'tomorrow' === $blog_time_period ) {
						$twodayslater = getdate( current_time( 'timestamp' ) + 1 * DAY_IN_SECONDS );
						$date_query   = array(
							array(
								'year'  => $twodayslater['year'],
								'month' => $twodayslater['mon'],
								'day'   => $twodayslater['mday'],
							),
						);
						$post_status  = array( 'future' );
					}
					if ( 'this_week' === $blog_time_period ) {
						$week       = gmdate( 'W' );
						$year       = gmdate( 'Y' );
						$date_query = array(
							array(
								'year' => $year,
								'week' => $week,
							),
						);
					}
					if ( 'last_week' === $blog_time_period ) {
						$thisweek = gmdate( 'W' );
						if ( 1 != $thisweek ) :
							$lastweek = $thisweek - 1;
						else :
							$lastweek = 52;
						endif;
						$year = gmdate( 'Y' );
						if ( 52 != $lastweek ) :
							$year = gmdate( 'Y' );
						else :
							$year = gmdate( 'Y' ) - 1;
						endif;
						$date_query = array(
							array(
								'year' => $year,
								'week' => $lastweek,
							),
						);
					}
					if ( 'next_week' === $blog_time_period ) {
						$thisweek = gmdate( 'W' );
						if ( 52 != $thisweek ) :
							$lastweek = $thisweek + 1;
						else :
							$lastweek = 1;
						endif;
						$year = gmdate( 'Y' );
						if ( 52 != $lastweek ) :
							$year = gmdate( 'Y' );
						else :
							$year = gmdate( 'Y' ) + 1;
						endif;
						$date_query  = array(
							array(
								'year' => $year,
								'week' => $lastweek,
							),
						);
						$post_status = array( 'future' );
					}
					if ( 'this_month' === $blog_time_period ) {
						$today      = getdate();
						$date_query = array(
							array(
								'year'  => $today['year'],
								'month' => $today['mon'],
							),
						);
					}
					if ( 'last_month' === $blog_time_period ) {
						$twodayslater = getdate( current_time( 'timestamp' ) - 1 * MONTH_IN_SECONDS );
						$date_query   = array(
							array(
								'year'  => $twodayslater['year'],
								'month' => $twodayslater['mon'],
							),
						);
					}
					if ( 'next_month' === $blog_time_period ) {
						$twodayslater = getdate( current_time( 'timestamp' ) + 1 * MONTH_IN_SECONDS );
						$date_query   = array(
							array(
								'year'  => $twodayslater['year'],
								'month' => $twodayslater['mon'],
							),
						);
						$post_status  = array( 'future' );
					}
					if ( 'last_n_days' === $blog_time_period ) {
						if ( isset( $wtl_settings['wp_timeline_time_period_day'] ) && $wtl_settings['wp_timeline_time_period_day'] ) {
							$last_n_days = $wtl_settings['wp_timeline_time_period_day'] . ' days ago';
							$date_query  = array(
								array(
									'before'    => gmdate( 'Y-m-d', strtotime( $last_n_days ) ),
									'inclusive' => true,
								),
							);
						}
					}
					if ( 'next_n_days' === $blog_time_period ) {
						if ( isset( $wtl_settings['wp_timeline_time_period_day'] ) && $wtl_settings['wp_timeline_time_period_day'] ) {
							$next_n_days = '+' . $wtl_settings['wp_timeline_time_period_day'] . ' days';
							$date_query  = array(
								array(
									'after'    => gmdate( 'Y-m-d', strtotime( $next_n_days ) ),
									'inclusive' => true,
								),
							);
							$post_status = array( 'future' );
						}
					}
					if ( 'between_two_date' === $blog_time_period ) {
						$between_two_date_from = isset( $wtl_settings['between_two_date_from'] ) ? $wtl_settings['between_two_date_from'] : '';
						$between_two_date_to   = isset( $wtl_settings['between_two_date_to'] ) ? $wtl_settings['between_two_date_to'] : '';
						$from_format           = array();
						$after                 = array();
						if ( $between_two_date_from ) {
							$unixtime  = strtotime( $between_two_date_from );
							$from_time = gmdate( 'm-d-Y', $unixtime );
							if ( $from_time ) {
								$from_format = explode( '-', $from_time );
								$after       = array(
									'year'  => isset( $from_format[2] ) ? $from_format[2] : '',
									'month' => isset( $from_format[0] ) ? $from_format[0] : '',
									'day'   => isset( $from_format[1] ) ? $from_format[1] : '',
								);
							}
						}
						$to_format = array();
						$before    = array();
						if ( $between_two_date_to ) {
							$unixtime = strtotime( $between_two_date_to );
							$to_time  = gmdate( 'm-d-Y', $unixtime );
							if ( $to_time ) {
								$to_format = explode( '-', $to_time );
								$before    = array(
									'year'  => isset( $to_format[2] ) ? $to_format[2] : '',
									'month' => isset( $to_format[0] ) ? $to_format[0] : '',
									'day'   => isset( $to_format[1] ) ? $to_format[1] : '',
								);
							}
						}
						$date_query = array(
							array(
								'after'     => $after,
								'before'    => $before,
								'inclusive' => true,
							),
						);
					}
				}
				/* if Post Type is: Post */
				if ( 'post' === $post_type ) {
					if ( 'meta_value_num' === $orderby ) {
						$more_posts = get_posts(
							array(
								$exlude_category   => $cat,
								$exlude_tag        => $tag,
								$exlude_author     => $author,
								'offset'           => $offset,
								'post_type'        => $post_type,
								'posts_per_page'   => $posts_per_page,
								'paged'            => $paged,
								'orderby'          => $orderby . ' date',
								'order'            => $order,
								'post__not_in'     => get_option( 'sticky_posts' ),
								'meta_query'       => array(
									'relation' => 'OR',
									array(
										'key'     => '_post_like_count',
										'compare' => 'NOT EXISTS',
									),
									array(
										'key'     => '_post_like_count',
										'compare' => 'EXISTS',
									),
								),
								'date_query'       => $date_query,
								'post_status'      => $post_status,
								'suppress_filters' => false,
							)
						);
					} else {
						$more_posts = get_posts(
							array(
								$exlude_category   => $cat,
								$exlude_tag        => $tag,
								$exlude_author     => $author,
								'offset'           => $offset,
								'post_type'        => $post_type,
								'posts_per_page'   => $posts_per_page,
								'paged'            => $paged,
								'orderby'          => $orderby,
								'order'            => $order,
								'post__not_in'     => get_option( 'sticky_posts' ),
								'date_query'       => $date_query,
								'post_status'      => $post_status,
								'suppress_filters' => false,
							)
						);
					}
				} else {
					/* If Post Type is: Custom Post type Ex: Product */
					$taxo      = get_object_taxonomies( $post_type );
					$tax_query = array( 'relation' => 'OR' );
					if ( isset( $wtl_settings['relation'] ) && ! empty( $wtl_settings['relation'] ) ) {
						$tax_query = $wtl_settings['relation'];
					}
					foreach ( $taxo as $taxonom ) {
						$custom_taxonom = '';
						if ( isset( $wtl_settings[ $taxonom . '_terms' ] ) ) {
							if ( isset( $wtl_settings[ $taxonom . '_terms' ] ) && ! empty( $wtl_settings[ $taxonom . '_terms' ] ) ) {
								$custom_taxonom = $wtl_settings[ $taxonom . '_terms' ];
							}
							if ( isset( $wtl_settings[ 'exclude_' . $taxonom . '_list' ] ) ) {
								$operator_value = 'NOT IN';
							} else {
								$operator_value = 'IN';
							}
							$tax_query[] = array(
								'taxonomy' => $taxonom,
								'field'    => 'name',
								'terms'    => $custom_taxonom,
								'operator' => $operator_value,
							);
						}
					}
					if ( 'meta_value_num' === $orderby ) {
						$more_posts = get_posts(
							array(
								'post_type'        => $post_type,
								'tax_query'        => $tax_query,
								'offset'           => $offset,
								'posts_per_page'   => $posts_per_page,
								'paged'            => $paged,
								'orderby'          => $orderby . ' date',
								'order'            => $order,
								'post__not_in'     => get_option( 'sticky_posts' ),
								$exlude_author     => $author,
								'meta_query'       => array(
									'relation' => 'OR',
									array(
										'key'     => '_post_like_count',
										'compare' => 'NOT EXISTS',
									),
									array(
										'key'     => '_post_like_count',
										'compare' => 'EXISTS',
									),
								),
								'date_query'       => $date_query,
								'post_status'      => $post_status,
								'suppress_filters' => false,
							)
						);
					} else {
						$more_posts = get_posts(
							array(
								'post_type'        => $post_type,
								'tax_query'        => $tax_query,
								'offset'           => $offset,
								'posts_per_page'   => $posts_per_page,
								'paged'            => $paged,
								'orderby'          => $orderby,
								'order'            => $order,
								'post__not_in'     => get_option( 'sticky_posts' ),
								$exlude_author     => $author,
								'date_query'       => $date_query,
								'post_status'      => $post_status,
								'suppress_filters' => false,
							)
						);
					}
				}
				/* Other Post Type End */
				$sticky_posts = get_option( 'sticky_posts' );
				$sticky_count = count( $sticky_posts );
				$alter_class  = '';
				$alter        = $offset + 1;
				if ( isset( $wtl_settings['display_sticky'] ) && 1 == $wtl_settings['display_sticky'] ) {
					$alter = $alter + $sticky_count;
				}
				$prev_month = isset( $_POST['timeline_previous_month'] ) ? sanitize_text_field( wp_unslash( $_POST['timeline_previous_month'] ) ) : '';
				if ( $more_posts ) {
					global $post;
					$i = 1;
					foreach ( $more_posts as $post ) :
						setup_postdata( $post );
						if ( $wp_timeline_theme ) {
							$wp_timeline_theme_file = self::wtl_blog_file_name( $wp_timeline_theme );
							echo self::wtl_get_blog_template( 'blog/' . esc_html( $wp_timeline_theme_file ) . '.php', $wtl_settings, $paged, $count_sticky, $i );
							$alter ++;
						}
						$i++;
					endforeach;
					if ( 1 != $alter % 2 && ( 'invert-grid' === $wp_timeline_theme || 'media-grid' === $wp_timeline_theme ) ) {
						echo '</div>';
					}
				}
			}
			die();
		}
	}
	/**
	 * To get posts when load more pagination is on
	 *
	 * @return void
	 */
	public function wtl_load_onscroll_date() {
		global $wpdb;
		if ( isset( $_POST['nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'ajax-nonce' ) ) {
			$layout = isset( $_POST['wp_timeline_blog_layout'] ) ? sanitize_text_field( wp_unslash( $_POST['wp_timeline_blog_layout'] ) ) : '';
			if ( 'wp_timeline_blog_layout' === $layout ) {
				$blog_shortcode_id = isset( $_POST['wp_timeline_blog_shortcode_id'] ) ? sanitize_text_field( wp_unslash( $_POST['wp_timeline_blog_shortcode_id'] ) ) : '';
				$table_name        = $wpdb->prefix . 'wtl_shortcodes';
				if ( is_numeric( $blog_shortcode_id ) ) {
					$settings_val = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}wtl_shortcodes WHERE wtlid = %d", intval( $blog_shortcode_id ) ), ARRAY_A );
					$allsettings  = $settings_val[0]['wtlsettngs'];
				}
				$count_sticky = 0;
				if ( isset( $allsettings ) && is_serialized( $allsettings ) ) {
					$wtl_settings = maybe_unserialize( $allsettings );
				}
				$post_type      = $wtl_settings['custom_post_type'];
				$posts_per_page = isset( $_POST['posts_per_page'] ) ? sanitize_text_field( wp_unslash( $_POST['posts_per_page'] ) ) : '';
				echo $posts_per_page;
				$int_page          = isset( $_POST['paged'] ) ? sanitize_text_field( wp_unslash( $_POST['paged'] ) ) : '';
				$paged             = ( (int) $int_page ) + 1;
				$offset            = ( $paged - 1 ) * $posts_per_page;
				$wp_timeline_theme = isset( $_POST['wtl_blog_template'] ) ? sanitize_text_field( wp_unslash( $_POST['wtl_blog_template'] ) ) : '';
				$tags              = '';
				$cats              = '';
				$author            = '';
				$order             = 'DESC';
				$orderby           = 'date';
				if ( isset( $wtl_settings['template_category'] ) ) {
					$cat = $wtl_settings['template_category'];
				}
				if ( isset( $wtl_settings['template_tags'] ) ) {
					$tag = $wtl_settings['template_tags'];
				}
				if ( isset( $wtl_settings['template_authors'] ) ) {
					$author = $wtl_settings['template_authors'];
				}
				if ( isset( $_GET['sortby'] ) && '' != $_GET['sortby'] ) {
					$orderby = sanitize_text_field( wp_unslash( $_GET['sortby'] ) );
				} elseif ( isset( $wtl_settings['wp_timeline_blog_order_by'] ) && '' != $wtl_settings['wp_timeline_blog_order_by'] ) {
					$orderby = $wtl_settings['wp_timeline_blog_order_by'];
				}
				if ( isset( $wtl_settings['wp_timeline_blog_order'] ) && isset( $wtl_settings['wp_timeline_blog_order_by'] ) && '' != $wtl_settings['wp_timeline_blog_order_by'] ) {
					$order = $wtl_settings['wp_timeline_blog_order'];
				}
				if ( empty( $cat ) ) {
					$cat = '';
				}
				if ( empty( $tag ) ) {
					$tag = '';
				}
				if ( isset( $wtl_settings['exclude_category_list'] ) ) {
					$exlude_category = 'category__not_in';
				} else {
					$exlude_category = 'category__in';
				}
				if ( isset( $wtl_settings['exclude_tag_list'] ) ) {
					$exlude_tag = 'tag__not_in';
				} else {
					$exlude_tag = 'tag__in';
				}
				if ( isset( $wtl_settings['exclude_author_list'] ) ) {
					$exlude_author = 'author__not_in';
				} else {
					$exlude_author = 'author__in';
				}
				/**
				 * Time Period
				 */
				$date_query  = array();
				$post_status = array();
				if ( isset( $wtl_settings['blog_time_period'] ) ) {
					$blog_time_period = $wtl_settings['blog_time_period'];
					if ( 'today' === $blog_time_period ) {
						$today      = getdate();
						$date_query = array(
							array(
								'year'  => $today['year'],
								'month' => $today['mon'],
								'day'   => $today['mday'],
							),
						);
					}
					if ( 'tomorrow' === $blog_time_period ) {
						$twodayslater = getdate( current_time( 'timestamp' ) + 1 * DAY_IN_SECONDS );
						$date_query   = array(
							array(
								'year'  => $twodayslater['year'],
								'month' => $twodayslater['mon'],
								'day'   => $twodayslater['mday'],
							),
						);
						$post_status  = array( 'future' );
					}
					if ( 'this_week' === $blog_time_period ) {
						$week       = gmdate( 'W' );
						$year       = gmdate( 'Y' );
						$date_query = array(
							array(
								'year' => $year,
								'week' => $week,
							),
						);
					}
					if ( 'last_week' === $blog_time_period ) {
						$thisweek = gmdate( 'W' );
						if ( 1 != $thisweek ) :
							$lastweek = $thisweek - 1;
						else :
							$lastweek = 52;
						endif;
						$year = gmdate( 'Y' );
						if ( 52 != $lastweek ) :
							$year = gmdate( 'Y' );
						else :
							$year = gmdate( 'Y' ) - 1;
						endif;
						$date_query = array(
							array(
								'year' => $year,
								'week' => $lastweek,
							),
						);
					}
					if ( 'next_week' === $blog_time_period ) {
						$thisweek = gmdate( 'W' );
						if ( 52 != $thisweek ) :
							$lastweek = $thisweek + 1;
						else :
							$lastweek = 1;
						endif;
						$year = gmdate( 'Y' );
						if ( 52 != $lastweek ) :
							$year = gmdate( 'Y' );
						else :
							$year = gmdate( 'Y' ) + 1;
						endif;
						$date_query  = array(
							array(
								'year' => $year,
								'week' => $lastweek,
							),
						);
						$post_status = array( 'future' );
					}
					if ( 'this_month' === $blog_time_period ) {
						$today      = getdate();
						$date_query = array(
							array(
								'year'  => $today['year'],
								'month' => $today['mon'],
							),
						);
					}
					if ( 'last_month' === $blog_time_period ) {
						$twodayslater = getdate( current_time( 'timestamp' ) - 1 * MONTH_IN_SECONDS );
						$date_query   = array(
							array(
								'year'  => $twodayslater['year'],
								'month' => $twodayslater['mon'],
							),
						);
					}
					if ( 'next_month' === $blog_time_period ) {
						$twodayslater = getdate( current_time( 'timestamp' ) + 1 * MONTH_IN_SECONDS );
						$date_query   = array(
							array(
								'year'  => $twodayslater['year'],
								'month' => $twodayslater['mon'],
							),
						);
						$post_status  = array( 'future' );
					}
					if ( 'last_n_days' === $blog_time_period ) {
						if ( isset( $wtl_settings['wp_timeline_time_period_day'] ) && $wtl_settings['wp_timeline_time_period_day'] ) {
							$last_n_days = $wtl_settings['wp_timeline_time_period_day'] . ' days ago';
							$date_query  = array(
								array(
									'before'    => gmdate( 'Y-m-d', strtotime( $last_n_days ) ),
									'inclusive' => true,
								),
							);
						}
					}
					if ( 'next_n_days' === $blog_time_period ) {
						if ( isset( $wtl_settings['wp_timeline_time_period_day'] ) && $wtl_settings['wp_timeline_time_period_day'] ) {
							$next_n_days = '+' . $wtl_settings['wp_timeline_time_period_day'] . ' days';
							$date_query  = array(
								array(
									'after'    => gmdate( 'Y-m-d', strtotime( $next_n_days ) ),
									'inclusive' => true,
								),
							);
							$post_status = array( 'future' );
						}
					}
					if ( 'between_two_date' === $blog_time_period ) {
						$between_two_date_from = isset( $wtl_settings['between_two_date_from'] ) ? $wtl_settings['between_two_date_from'] : '';
						$between_two_date_to   = isset( $wtl_settings['between_two_date_to'] ) ? $wtl_settings['between_two_date_to'] : '';
						$from_format           = array();
						$after                 = array();
						if ( $between_two_date_from ) {
							$unixtime  = strtotime( $between_two_date_from );
							$from_time = gmdate( 'm-d-Y', $unixtime );
							if ( $from_time ) {
								$from_format = explode( '-', $from_time );
								$after       = array(
									'year'  => isset( $from_format[2] ) ? $from_format[2] : '',
									'month' => isset( $from_format[0] ) ? $from_format[0] : '',
									'day'   => isset( $from_format[1] ) ? $from_format[1] : '',
								);
							}
						}
						$to_format = array();
						$before    = array();
						if ( $between_two_date_to ) {
							$unixtime = strtotime( $between_two_date_to );
							$to_time  = gmdate( 'm-d-Y', $unixtime );
							if ( $to_time ) {
								$to_format = explode( '-', $to_time );
								$before    = array(
									'year'  => isset( $to_format[2] ) ? $to_format[2] : '',
									'month' => isset( $to_format[0] ) ? $to_format[0] : '',
									'day'   => isset( $to_format[1] ) ? $to_format[1] : '',
								);
							}
						}
						$date_query = array(
							array(
								'after'     => $after,
								'before'    => $before,
								'inclusive' => true,
							),
						);
					}
				}
				$more_posts = get_posts(
					array(
						'post_type'        => $post_type,
						'offset'           => $offset,
						'posts_per_page'   => $posts_per_page,
						'paged'            => $paged,
						'orderby'          => $orderby,
						'order'            => $order,
						'post__not_in'     => get_option( 'sticky_posts' ),
						$exlude_author     => $author,
						'date_query'       => $date_query,
						'post_status'      => $post_status,
						'suppress_filters' => false,
					)
				);
				/* Other Post Type End */
				$sticky_posts = get_option( 'sticky_posts' );
				$sticky_count = count( $sticky_posts );
				$alter_class  = '';
				$alter        = $offset + 1;
				if ( isset( $wtl_settings['display_sticky'] ) && 1 == $wtl_settings['display_sticky'] ) {
					$alter = $alter + $sticky_count;
				}
				$prev_month = isset( $_POST['timeline_previous_month'] ) ? sanitize_text_field( wp_unslash( $_POST['timeline_previous_month'] ) ) : '';
				if ( $more_posts ) {
					global $post;
					$i = 1;
					foreach ( $more_posts as $post ) :
						setup_postdata( $post );
						if ( $wp_timeline_theme ) {
							if ( isset( $wtl_settings['display_date'] ) && 1 == $wtl_settings['display_date'] ) {
								$date_link        = ( isset( $wtl_settings['disable_link_date'] ) && 1 == $wtl_settings['disable_link_date'] ) ? false : true;
								$date_format      = ( isset( $wtl_settings['post_date_format'] ) && 'default' !== $wtl_settings['post_date_format'] ) ? $wtl_settings['post_date_format'] : get_option( 'date_format' );
								$wp_timeline_date = ( isset( $wtl_settings['display_date_from'] ) && 'modify' === $wtl_settings['display_date_from'] ) ? apply_filters( 'wtl_date_format', get_post_modified_time( $date_format, $post->ID ), $post->ID ) : apply_filters( 'wtl_date_format', get_the_time( $date_format, $post->ID ), $post->ID );
								$ar_year          = get_the_time( 'Y' );
								$ar_month         = get_the_time( 'm' );
								$ar_day           = get_the_time( 'd' );
								echo '<li class="wtl-post-year  year-' . esc_html( $ar_year ) . '">';
								if ( 'infographic_layout' == $wp_timeline_theme ) {
									echo ( $date_link ) ? '<a class="mdate" href="#wtl_layout_' . esc_html( get_the_ID() ) . '">' : '<div class="mdate">';
								} else {
									echo ( $date_link ) ? '<a class="mdate" href="#wtl_date_' . esc_html( $ar_day . '_' . $ar_month ) . '">' : '<div class="mdate">';
								}
								echo esc_html( $ar_year );
								echo ( $date_link ) ? '</a>' : '</div>';
								echo '</li>';
							}
							$alter ++;
						}
						$i++;
					endforeach;
				}
			}
			die();
		}
	}

	/**
	 * To return timeline layout file.
	 *
	 * @param string $wp_timeline_theme timelien theme.
	 * @return string
	 */
	public static function wtl_blog_file_name( $wp_timeline_theme ) {
		$wp_timeline_name = '';
		if ( 'cool_horizontal' === $wp_timeline_theme ) {
			$wp_timeline_name = 'cool-horizontal';
		}
		if ( 'advanced_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'advanced-layout';
		}
		if ( 'verticalblur_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'verticalblur-layout';
		}
		if ( 'curve_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'curve-layout';
		}
		if ( 'fullvertical_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'fullvertical-layout';
		}
		if ( 'easy_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'easy-layout';
		}
		if ( 'fullhorizontal_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'fullhorizontal-layout';
		}
		if ( 'attract_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'attract-layout';
		}
		if ( 'processinfo_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'processinfo-layout';
		}
		if ( 'divide_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'divide-layout';
		}
		if ( 'topdivide_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'topdivide-layout';
		}
		if ( 'fullwidth_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'fullwidth-layout';
		}
		if ( 'hire_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'hire-layout';
		}
		if ( 'milestone_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'milestone-layout';
		}
		if ( 'overlay_horizontal' === $wp_timeline_theme ) {
			$wp_timeline_name = 'overlay-horizontal';
		}
		if ( 'soft_block' === $wp_timeline_theme ) {
			$wp_timeline_name = 'soft-block';
		}
		if ( 'accordion' === $wp_timeline_theme ) {
			$wp_timeline_name = 'accordion';
		}
		if ( 'collapsible' === $wp_timeline_theme ) {
			$wp_timeline_name = 'collapsible';
		}
		if ( 'schedule' === $wp_timeline_theme ) {
			$wp_timeline_name = 'schedule';
		}
		if ( 'story_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'story-layout';
		}
		if ( 'year_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'year-layout';
		}
		if ( 'glossary_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'glossary-layout';
		}
		if ( 'business_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'business-layout';
		}
		if ( 'timeline_graph_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'timeline-graph-layout';
		}
		if ( 'boxy_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'boxy-layout';
		}
		if ( 'wise_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'wise-layout';
		}
		if ( 'cover_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'cover-layout';
		}
		if ( 'rounded_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'rounded-layout';
		}
		if ( 'infographic_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'infographic-layout';
		}
		if ( 'zigzag_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'zigzag-layout';
		}
		if ( 'columy_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'columy-layout';
		}
		if ( 'leafty_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'leafty-layout';
		}
		if ( 'sportking_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'sportking-layout';
		}
		if ( 'filledtimeline_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'filledtimeline-layout';
		}
		if ( 'classictimeline_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'classictimeline-layout';
		}
		if ( 'milestonetimeline_layout' === $wp_timeline_theme ) {
			$wp_timeline_name = 'milestonetimeline-layout';
		}
		return $wp_timeline_name;
	}
}
