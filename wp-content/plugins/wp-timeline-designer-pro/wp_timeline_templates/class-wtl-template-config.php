<?php
/**
 * Template Day Layout Config File
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
class Wtl_Template_Config {
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );
		add_filter( 'get_post_gallery', array( $this, 'wp_add_on_get_post_gallery' ), 10, 2 );
	}

	/**
	 * To fix wp_kses html for non escape tag.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	public static function param_kses() {
		$common_attr  = '';
		$allowed_html = array(
			'h2' => array(
				'id'    => array(),
				'class' => array(),
				'style' => array(),
			),
			'a'  => array(
				'href'  => array(),
				'title' => array(),
			),
		);
		return $allowed_html;
	}

	/**
	 * Get first image from post if post feature image not set.
	 *
	 * @return array
	 */
	public static function catch_that_image() {
		global $post, $posts;
		$first_img = '';
		ob_start();
		ob_end_clean();
		$output    = preg_match_all( '/<img.+?src=[\'"]([^\'"]+)[\'"].*?>/i', $post->post_content, $matches );
		$first_img = $matches[1][0];
		if ( empty( $first_img ) ) {
			$first_img = '';
		}
		return $first_img;
	}

	/**
	 * Addon to fix Gutenberg issue, get gallery from block in array.
	 *
	 * @param string $gallery gallery html.
	 * @param string $post content from posts.
	 * @return array
	 */
	public static function wp_add_on_get_post_gallery( $gallery, $post ) {
		// If a gallery already exist.
		if ( $gallery ) {
			return $gallery;
		}
		// Confirm exit.
		$post = get_post( $post );
		if ( ! $post ) {
			return $gallery;
		}
		// If no Gutenberg found becuase gallery already work with old code.
		if ( ! function_exists( 'has_blocks' ) ) {
			return $gallery;
		}
		// If block disabled.
		if ( ! has_blocks( $post->post_content ) ) {
			return $gallery;
		}
		// format for wp gallery block of gutenberg.
		$pattern = '/<!--\ wp:gallery.*-->([\s\S]*?)<!--\ \/wp:gallery -->/i';
		preg_match_all( $pattern, $post->post_content, $the_galleries );
		// Check a gallery was found and if so change the gallery html.
		if ( ! empty( $the_galleries[1] ) ) {
			$gallery = reset( $the_galleries[1] );
		}
		if ( $gallery ) {
			preg_match_all( '/<img[^>]+>/i', $gallery, $img_tags );
			$all_images = count( $img_tags[0] );
			for ( $i = 0; $i < $all_images; $i++ ) {
				preg_match( '/src="([^"]+)/i', $img_tags[0][ $i ], $imgage );
				$gallery_src['src'][] = str_ireplace( 'src="', '', $imgage[0] );
			}
		}
		return $gallery_src;
	}

	/**
	 * Get Class Category.
	 *
	 * @param array $wtl_settings wtll settings array.
	 * @return html
	 */
	public static function get_class_category( $wtl_settings ) {
		global $post;
		$display_filter_by = ( isset( $wtl_settings['display_filter_by'] ) && ! empty( $wtl_settings['display_filter_by'] ) ) ? $wtl_settings['display_filter_by'] : '';
		$category          = '';
		if ( ! empty( $display_filter_by ) ) {
			$category_detail = wp_get_post_terms( $post->ID, $display_filter_by );
			if ( ! empty( $category_detail ) ) {
				foreach ( $category_detail as $cd ) {
					$category .= $cd->slug . ' ';
				}
			}
		}
		if ( $category ) {
			return $category;
		}
	}

	/**
	 * Get Timeline Icon.
	 *
	 * @return string
	 */
	public static function get_timeline_icon() {
		global $post;
		$wtl_sdk = get_post_meta( $post->ID, '_wtl_single_details_key', true );
		if ( ! empty( $wtl_sdk ) ) {
			$type = $wtl_sdk['wtl_single_display_timeline_icon'];
			if ( 'image' === $type ) {
				$img_src = $wtl_sdk['wtl_icon_image_src'];
				if ( $img_src ) {
					return '<div class="wtl_steps_post_format wtl-post-center-image"><img src="' . esc_url( $img_src ) . '"></div>';
				}
			} elseif ( 'fontawesome' === $type ) {
				$img_src = $wtl_sdk['wtl_single_timeline_icon'];
				if ( $img_src ) {
					return '<div class="wtl_steps_post_format"><i class="' . esc_attr( $img_src ) . '"></i></div>';
				}
			}
		}
	}

	/**
	 *  Content Box Bg Color
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return html
	 */
	public static function content_box_bg_color( $wtl_settings ) {
		return isset( $wtl_settings['template_content_box_bg_color'] ) ? 'background-color:' . esc_attr( $wtl_settings['template_content_box_bg_color'] ) . ';' : '';
	}

	/**
	 * Content Box Border
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return html
	 */
	public static function content_box_border( $wtl_settings ) {
		$border_width = isset( $wtl_settings['wp_timeline_content_border_width'] ) ? $wtl_settings['wp_timeline_content_border_width'] : '';
		$border_style = isset( $wtl_settings['wp_timeline_content_border_style'] ) ? $wtl_settings['wp_timeline_content_border_style'] : '';
		$border_color = isset( $wtl_settings['wp_timeline_content_border_color'] ) ? $wtl_settings['wp_timeline_content_border_color'] : '';
		if ( $border_width > 0 ) {
			return 'border:' . esc_attr( $border_width ) . 'px ' . esc_attr( $border_style ) . ' ' . esc_attr( $border_color ) . ';';
		}
	}

	/**
	 * Content Box Border Radius
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return html
	 */
	public static function content_box_border_radius( $wtl_settings ) {
		$border_radius = isset( $wtl_settings['wp_timeline_content_border_radius'] ) ? $wtl_settings['wp_timeline_content_border_radius'] : '';
		if ( $border_radius || 0 == $border_radius ) {
			return 'border-radius:' . esc_attr( $border_radius ) . 'px;';
		}
	}

	/**
	 * Content Box Shadow
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return html
	 */
	public static function content_box_shadow( $wtl_settings ) {
		$h_offset = isset( $wtl_settings['wp_timeline_top_content_box_shadow'] ) ? $wtl_settings['wp_timeline_top_content_box_shadow'] : '';
		$v_offset = isset( $wtl_settings['wp_timeline_right_content_box_shadow'] ) ? $wtl_settings['wp_timeline_right_content_box_shadow'] : '';
		$blur     = isset( $wtl_settings['wp_timeline_bottom_content_box_shadow'] ) ? $wtl_settings['wp_timeline_bottom_content_box_shadow'] : '';
		$spread   = isset( $wtl_settings['wp_timeline_left_content_box_shadow'] ) ? $wtl_settings['wp_timeline_left_content_box_shadow'] : '';
		$color    = isset( $wtl_settings['wp_timeline_content_box_shadow_color'] ) ? $wtl_settings['wp_timeline_content_box_shadow_color'] : '';

		if ( $h_offset && $v_offset && $blur && $spread && $color ) {
			$out  = '-webkit-box-shadow:' . esc_attr( $h_offset ) . 'px ' . esc_attr( $v_offset ) . 'px ' . esc_attr( $blur ) . 'px ' . esc_attr( $spread ) . 'px ' . esc_attr( $color ) . ';';
			$out .= '-moz-box-shadow:' . esc_attr( $h_offset ) . 'px ' . esc_attr( $v_offset ) . 'px ' . esc_attr( $blur ) . 'px ' . esc_attr( $spread ) . 'px ' . esc_attr( $color ) . ';';
			$out .= 'box-shadow:' . esc_attr( $h_offset ) . 'px ' . esc_attr( $v_offset ) . 'px ' . esc_attr( $blur ) . 'px ' . esc_attr( $spread ) . 'px ' . esc_attr( $color ) . ';';
			return $out;
		}
	}

	/**
	 * Content Box Padding
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return html
	 */
	public static function content_box_padding( $wtl_settings ) {
		$top_bottom = isset( $wtl_settings['wp_timeline_content_padding_topbottom'] ) ? $wtl_settings['wp_timeline_content_padding_topbottom'] : '';
		$left_right = isset( $wtl_settings['wp_timeline_content_padding_leftright'] ) ? $wtl_settings['wp_timeline_content_padding_leftright'] : '';
		if ( $left_right || $top_bottom ) {
			$out = 'padding:' . esc_attr( $top_bottom ) . 'px ' . esc_attr( $left_right ) . 'px !important;';
			return $out;
		}
	}

	/**
	 * Dropcap
	 *
	 * @param array  $wtl_settings settings arrray.
	 * @param string $layout_id layout id.
	 * @return html
	 */
	public static function dropcap( $wtl_settings, $layout_id ) {
		$firstletter_big = isset( $wtl_settings['firstletter_big'] ) ? $wtl_settings['firstletter_big'] : '';
		$font_type       = isset( $wtl_settings['firstletter_font_family_font_type'] ) ? $wtl_settings['firstletter_font_family_font_type'] : '';
		$font_family     = isset( $wtl_settings['firstletter_font_family'] ) ? $wtl_settings['firstletter_font_family'] : '';
		$font_size       = isset( $wtl_settings['firstletter_fontsize'] ) ? $wtl_settings['firstletter_fontsize'] : '';
		$color           = isset( $wtl_settings['firstletter_contentcolor'] ) ? $wtl_settings['firstletter_contentcolor'] : '';
		if ( 1 == $firstletter_big ) {

			$out  = '';
			$out .= $layout_id . ' .wtl-post-content .post_content-inner > *:first-child:first-letter,';
			$out .= $layout_id . ' .wtl-post-content .post_content-inner > p:first-child:first-letter,';
			$out .= $layout_id . ' .wtl-post-content .post_content-inner:first-letter,';
			$out .= $layout_id . ' .wtl-post-content .post_content-inner > *:first-child:first-letter,';
			$out .= $layout_id . ' .wtl-post-content .post_content-inner > p:first-child:first-letter,';
			$out .= $layout_id . ' .wtl-post-content:first-letter{';
			$out .= 'font-family:' . esc_attr( $font_family ) . ';';
			$out .= 'font-size:' . esc_attr( $font_size ) . 'px;';
			$out .= 'color:' . esc_attr( $color ) . ';';
			$out .= '';
			$out .= '}';
			return $out;
		}
	}

	/**
	 * Post Content Color and Post Content Section Hover Background
	 *
	 * @param array  $wtl_settings settings arrray.
	 * @param string $layout_id layout id.
	 * @return html
	 */
	public static function post_content_color( $wtl_settings, $layout_id ) {
		$content_color            = isset( $wtl_settings['template_contentcolor'] ) ? $wtl_settings['template_contentcolor'] : '';
		$content_hover_color      = isset( $wtl_settings['content_hover_color'] ) ? $wtl_settings['content_hover_color'] : '';
		$content_link_color       = isset( $wtl_settings['template_ftcolor'] ) ? $wtl_settings['template_ftcolor'] : '';
		$content_link_color_hover = isset( $wtl_settings['template_fthovercolor'] ) ? $wtl_settings['template_fthovercolor'] : '';
		$out                      = '';
		if ( $content_color || $content_hover_color ) {
			$out .= esc_attr( $layout_id ) . ' .wtl-post-content,.wtl-post-content p{';
			$out .= 'color:' . esc_attr( $content_color ) . ';';
			$out .= '}';
		}
		if ( $content_link_color || $content_link_color_hover ) {
			$out .= esc_attr( $layout_id ) . ' .wtl-post-content a{';
			$out .= 'color:' . esc_attr( $content_link_color ) . ';';
			$out .= '}';
			$out .= esc_attr( $layout_id ) . ' .wtl-post-content a:hover{';
			$out .= 'color:' . esc_attr( $content_link_color_hover ) . ';';
			$out .= '}';
		}
		return $out;
	}

	/**
	 * Get Read More Link
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return void
	 */
	public static function get_read_more_link( $wtl_settings ) {
		global $post;
		$read_more_link = isset( $wtl_settings['read_more_link'] ) ? $wtl_settings['read_more_link'] : 1;
		$read_more_on   = isset( $wtl_settings['read_more_on'] ) ? $wtl_settings['read_more_on'] : 1;
		if ( isset( $wtl_settings['rss_use_excerpt'] ) ) {
			if ( 1 == $wtl_settings['rss_use_excerpt'] && 1 == $read_more_link ) :
				$readmoretxt = '' != $wtl_settings['txtReadmoretext'] ? $wtl_settings['txtReadmoretext'] : esc_html__( 'Read More', 'wp-timeline-designer-pro' );
				$post_link   = get_permalink( $post->ID );
				if ( isset( $wtl_settings['post_link_type'] ) && 1 == $wtl_settings['post_link_type'] ) {
					$post_link = ( isset( $wtl_settings['custom_link_url'] ) && '' != $wtl_settings['custom_link_url'] ) ? $wtl_settings['custom_link_url'] : get_permalink( $post->ID );
				}
				if ( 1 == $read_more_on ) {
					echo '<a class="wtl-read-more" href="' . esc_url( $post_link ) . '">' . esc_html( $readmoretxt ) . ' </a>';
				}
			endif;
		}
	}

	/**
	 * Get Read More Button 2
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return void
	 */
	public static function get_read_more_link_2( $wtl_settings ) {
		global $post;
		$read_more_link = isset( $wtl_settings['read_more_link'] ) ? $wtl_settings['read_more_link'] : 1;
		$read_more_on   = isset( $wtl_settings['read_more_on'] ) ? $wtl_settings['read_more_on'] : 1;
		if ( isset( $wtl_settings['rss_use_excerpt'] ) && 1 == $wtl_settings['rss_use_excerpt'] && 1 == $read_more_link ) :
			$readmoretxt = '' != $wtl_settings['txtReadmoretext'] ? $wtl_settings['txtReadmoretext'] : esc_html__( 'Read More', 'wp-timeline-designer-pro' );
			$post_link   = get_permalink( $post->ID );
			if ( isset( $wtl_settings['post_link_type'] ) && 1 == $wtl_settings['post_link_type'] ) {
				$post_link = ( isset( $wtl_settings['custom_link_url'] ) && '' != $wtl_settings['custom_link_url'] ) ? $wtl_settings['custom_link_url'] : get_permalink( $post->ID );
			}
			if ( 2 == $read_more_on && 1 == $wtl_settings['rss_use_excerpt'] && 1 == $read_more_link ) {
				echo '<div class="wtl-read-more-div" style="clear:both;display:block">';
				echo '<a class="wtl-read-more" href="' . esc_url( $post_link ) . '">' . esc_html( $readmoretxt ) . ' </a>';
				echo '</div>';
			}
		endif;
	}

	/**
	 * Read More Style
	 *
	 * @param array  $wtl_settings settings arrray.
	 * @param string $layout_id layout id.
	 * @return html
	 */
	public static function read_more_style( $wtl_settings, $layout_id ) {
		/* background color */
		$background_color       = isset( $wtl_settings['template_readmorebackcolor'] ) ? $wtl_settings['template_readmorebackcolor'] : '';
		$background_hover_color = isset( $wtl_settings['template_readmore_hover_backcolor'] ) ? $wtl_settings['template_readmore_hover_backcolor'] : '';
		$alignment              = isset( $wtl_settings['readmore_button_alignment'] ) ? $wtl_settings['readmore_button_alignment'] : '';
		/* border style */
		$border_style       = isset( $wtl_settings['read_more_button_border_style'] ) ? $wtl_settings['read_more_button_border_style'] : '';
		$border_style_hover = isset( $wtl_settings['read_more_button_hover_border_style'] ) ? $wtl_settings['read_more_button_hover_border_style'] : '';

		/*border radious */
		$border_radious       = isset( $wtl_settings['readmore_button_border_radius'] ) ? $wtl_settings['readmore_button_border_radius'] : '';
		$border_radious_hover = isset( $wtl_settings['readmore_button_hover_border_radius'] ) ? $wtl_settings['readmore_button_hover_border_radius'] : '';

		/* border-size */
		$border_size_left   = isset( $wtl_settings['wp_timeline_readmore_button_borderleft'] ) ? $wtl_settings['wp_timeline_readmore_button_borderleft'] : '';
		$border_size_right  = isset( $wtl_settings['wp_timeline_readmore_button_borderright'] ) ? $wtl_settings['wp_timeline_readmore_button_borderright'] : '';
		$border_size_top    = isset( $wtl_settings['wp_timeline_readmore_button_bordertop'] ) ? $wtl_settings['wp_timeline_readmore_button_bordertop'] : '';
		$border_size_bottom = isset( $wtl_settings['wp_timeline_readmore_button_borderbottom'] ) ? $wtl_settings['wp_timeline_readmore_button_borderbottom'] : '';

		/* border-size on hover */
		$border_size_left_hover   = isset( $wtl_settings['wp_timeline_readmore_button_hover_borderleft'] ) ? $wtl_settings['wp_timeline_readmore_button_hover_borderleft'] : '';
		$border_size_right_hover  = isset( $wtl_settings['wp_timeline_readmore_button_hover_borderright'] ) ? $wtl_settings['wp_timeline_readmore_button_hover_borderright'] : '';
		$border_size_top_hover    = isset( $wtl_settings['wp_timeline_readmore_button_hover_bordertop'] ) ? $wtl_settings['wp_timeline_readmore_button_hover_bordertop'] : '';
		$border_size_bottom_hover = isset( $wtl_settings['wp_timeline_readmore_button_hover_borderbottom'] ) ? $wtl_settings['wp_timeline_readmore_button_hover_borderbottom'] : '';

		$border_color_left   = isset( $wtl_settings['wp_timeline_readmore_button_borderleftcolor'] ) ? $wtl_settings['wp_timeline_readmore_button_borderleftcolor'] : '';
		$border_color_right  = isset( $wtl_settings['wp_timeline_readmore_button_borderrightcolor'] ) ? $wtl_settings['wp_timeline_readmore_button_borderrightcolor'] : '';
		$border_color_top    = isset( $wtl_settings['wp_timeline_readmore_button_bordertopcolor'] ) ? $wtl_settings['wp_timeline_readmore_button_bordertopcolor'] : '';
		$border_color_bottom = isset( $wtl_settings['wp_timeline_readmore_button_borderbottomcolor'] ) ? $wtl_settings['wp_timeline_readmore_button_borderbottomcolor'] : '';

		/* Border Color on Hover */
		$border_color_left_hover   = isset( $wtl_settings['wp_timeline_readmore_button_hover_borderleftcolor'] ) ? $wtl_settings['wp_timeline_readmore_button_hover_borderleftcolor'] : '';
		$border_color_right_hover  = isset( $wtl_settings['wp_timeline_readmore_button_hover_borderrightcolor'] ) ? $wtl_settings['wp_timeline_readmore_button_hover_borderrightcolor'] : '';
		$border_color_top_hover    = isset( $wtl_settings['wp_timeline_readmore_button_hover_bordertopcolor'] ) ? $wtl_settings['wp_timeline_readmore_button_hover_bordertopcolor'] : '';
		$border_color_bottom_hover = isset( $wtl_settings['wp_timeline_readmore_button_hover_borderbottomcolor'] ) ? $wtl_settings['wp_timeline_readmore_button_hover_borderbottomcolor'] : '';

		$padding_left   = isset( $wtl_settings['readmore_button_paddingleft'] ) ? $wtl_settings['readmore_button_paddingleft'] : '';
		$padding_right  = isset( $wtl_settings['readmore_button_paddingright'] ) ? $wtl_settings['readmore_button_paddingright'] : '';
		$padding_top    = isset( $wtl_settings['readmore_button_paddingtop'] ) ? $wtl_settings['readmore_button_paddingtop'] : '';
		$padding_bottom = isset( $wtl_settings['readmore_button_paddingbottom'] ) ? $wtl_settings['readmore_button_paddingbottom'] : '';

		$margin_left   = isset( $wtl_settings['readmore_button_marginleft'] ) ? $wtl_settings['readmore_button_marginleft'] : '';
		$margin_right  = isset( $wtl_settings['readmore_button_marginright'] ) ? $wtl_settings['readmore_button_marginright'] : '';
		$margin_top    = isset( $wtl_settings['readmore_button_margintop'] ) ? $wtl_settings['readmore_button_margintop'] : '';
		$margin_bottom = isset( $wtl_settings['readmore_button_marginbottom'] ) ? $wtl_settings['readmore_button_marginbottom'] : '';

		$font_family     = isset( $wtl_settings['readmore_font_family'] ) ? $wtl_settings['readmore_font_family'] : '';
		$font_size       = isset( $wtl_settings['readmore_fontsize'] ) ? $wtl_settings['readmore_fontsize'] : '';
		$font_weight     = isset( $wtl_settings['readmore_font_weight'] ) ? $wtl_settings['readmore_font_weight'] : '';
		$line_height     = isset( $wtl_settings['readmore_font_line_height'] ) ? $wtl_settings['readmore_font_line_height'] : '';
		$font_italic     = isset( $wtl_settings['readmore_font_italic'] ) ? $wtl_settings['readmore_font_italic'] : '';
		$text_transform  = isset( $wtl_settings['readmore_font_text_transform'] ) ? $wtl_settings['readmore_font_text_transform'] : '';
		$text_decoration = isset( $wtl_settings['readmore_font_text_decoration'] ) ? $wtl_settings['readmore_font_text_decoration'] : '';
		$letter_spacing  = isset( $wtl_settings['readmore_font_letter_spacing'] ) ? $wtl_settings['readmore_font_letter_spacing'] : '';

		$out  = esc_attr( $layout_id ) . ' .wtl-read-more-div a.wtl-read-more{';
		$out .= 'background:' . esc_attr( $background_color ) . ' !important;';
		if ( 'center' !== $alignment ) {
			$out .= 'float:' . esc_attr( $alignment ) . ';';
		}
		$out .= 'border-style:' . esc_attr( $border_style ) . ' !important;';
		$out .= 'border-radius:' . esc_attr( $border_radious ) . 'px;';

		$out .= 'border-left:' . esc_attr( $border_size_left ) . 'px;';
		$out .= 'border-right:' . esc_attr( $border_size_right ) . 'px;';
		$out .= 'border-top:' . esc_attr( $border_size_top ) . 'px;';
		$out .= 'border-bottom:' . esc_attr( $border_size_bottom ) . 'px;';

		$out .= 'border-left-color: ' . esc_attr( $border_color_left ) . ';';
		$out .= 'border-right-color: ' . esc_attr( $border_color_right ) . ';';
		$out .= 'border-top-color: ' . esc_attr( $border_color_top ) . ';';
		$out .= 'border-bottom-color:' . esc_attr( $border_color_bottom ) . ';';

		/* Padding */
		$out .= 'padding-left:' . esc_attr( $padding_left ) . 'px;';
		$out .= 'padding-right:' . esc_attr( $padding_right ) . 'px;';
		$out .= 'padding-top:' . esc_attr( $padding_top ) . 'px;';
		$out .= 'padding-bottom:' . esc_attr( $padding_bottom ) . 'px;';
		/* Margin */
		$out .= 'margin-left:' . esc_attr( $margin_left ) . 'px;';
		$out .= 'margin-right:' . esc_attr( $margin_right ) . 'px;';
		$out .= 'margin-top:' . esc_attr( $margin_top ) . 'px;';
		$out .= 'margin-bottom:' . esc_attr( $margin_bottom ) . 'px;';

		if ( $font_family ) {
				$out .= 'font-family:' . esc_attr( $font_family ) . ' !important;';
		}
		$out .= 'font-size:' . esc_attr( $font_size ) . 'px;';
		$out .= 'font-weight:' . esc_attr( $font_weight ) . ';';
		$out .= 'line-height:' . esc_attr( $line_height ) . ';';
		if ( 1 == $font_italic ) {
			$out .= 'font-style:italic;';
		} else {
			$out .= 'font-style:normal;';
		}
		$out .= 'text-transform:' . esc_attr( $text_transform ) . ';';
		$out .= 'text-decoration:' . esc_attr( $text_decoration ) . ';';
		$out .= 'letter-spacing:' . esc_attr( $letter_spacing ) . 'px;';

		$out .= '}';
		/* On Hover */
		$out .= $layout_id . ' .wtl-read-more-div a.wtl-read-more:hover{';
		$out .= 'background:' . esc_attr( $background_hover_color ) . ' !important;';
		$out .= 'border-style:' . esc_attr( $border_style_hover ) . ' !important;';
		$out .= 'border-radius:' . esc_attr( $border_radious_hover ) . 'px;';

		$out .= 'border-left:' . esc_attr( $border_size_left_hover ) . 'px;';
		$out .= 'border-right:' . esc_attr( $border_size_right_hover ) . 'px;';
		$out .= 'border-top:' . esc_attr( $border_size_top_hover ) . 'px;';
		$out .= 'border-bottom:' . esc_attr( $border_size_bottom_hover ) . 'px;';

		$out .= 'border-left-color: ' . esc_attr( $border_color_left_hover ) . ';';
		$out .= 'border-right-color: ' . esc_attr( $border_color_right_hover ) . ';';
		$out .= 'border-top-color: ' . esc_attr( $border_color_top_hover ) . ';';
		$out .= 'border-bottom-color:' . esc_attr( $border_color_bottom_hover ) . ';';

		$out .= '}';

		return $out;
	}

	/**
	 * Load More Button
	 *
	 * @param array  $wtl_settings settings arrray.
	 * @param string $layout_id layout id.
	 * @return html
	 */
	public static function load_more_button( $wtl_settings, $layout_id ) {
		$background_color       = isset( $wtl_settings['loadmore_button_bg_color'] ) ? $wtl_settings['loadmore_button_bg_color'] : '';
		$background_hover_color = isset( $wtl_settings['loadmore_button_bg_hover_color'] ) ? $wtl_settings['loadmore_button_bg_hover_color'] : '';
		$color                  = isset( $wtl_settings['loadmore_button_color'] ) ? $wtl_settings['loadmore_button_color'] : '';
		$hover_color            = isset( $wtl_settings['loadmore_button_hover_color'] ) ? $wtl_settings['loadmore_button_hover_color'] : '';
		$border_style           = isset( $wtl_settings['load_more_button_border_style'] ) ? $wtl_settings['load_more_button_border_style'] : '';

		$border_size_left   = isset( $wtl_settings['wtl_loadmore_btn_borderleft'] ) ? $wtl_settings['wtl_loadmore_btn_borderleft'] : '';
		$border_size_right  = isset( $wtl_settings['wtl_loadmore_btn_borderright'] ) ? $wtl_settings['wtl_loadmore_btn_borderright'] : '';
		$border_size_top    = isset( $wtl_settings['wtl_loadmore_btn_bordertop'] ) ? $wtl_settings['wtl_loadmore_btn_bordertop'] : '';
		$border_size_bottom = isset( $wtl_settings['wtl_loadmore_btn_borderbottom'] ) ? $wtl_settings['wtl_loadmore_btn_borderbottom'] : '';

		$border_color_left   = isset( $wtl_settings['wtl_loadmore_btn_borderleftcolor'] ) ? $wtl_settings['wtl_loadmore_btn_borderleftcolor'] : '';
		$border_color_right  = isset( $wtl_settings['wtl_loadmore_btn_borderrightcolor'] ) ? $wtl_settings['wtl_loadmore_btn_borderrightcolor'] : '';
		$border_color_top    = isset( $wtl_settings['wtl_loadmore_btn_bordertopcolor'] ) ? $wtl_settings['wtl_loadmore_btn_bordertopcolor'] : '';
		$border_color_bottom = isset( $wtl_settings['wtl_loadmore_btn_borderbottomcolor'] ) ? $wtl_settings['wtl_loadmore_btn_borderbottomcolor'] : '';

		$o  = '';
		$o .= $layout_id . ' a.wp-timeline-load-more-btn{';
		if ( $background_color ) {
			$o .= 'background:' . esc_attr( $background_color ) . ' !important;';
		}
		if ( $color ) {
			$o .= 'color:' . esc_attr( $color ) . ' !important;';
		}
		if ( $border_style ) {
			$o .= 'border-style:' . esc_attr( $border_style ) . ' !important;';
		}

		if ( $border_size_left ) {
			$o .= 'border-left-width:' . esc_attr( $border_size_left ) . 'px !important;';
		}
		if ( $border_size_right ) {
			$o .= 'border-right-width:' . esc_attr( $border_size_right ) . 'px !important;';
		}
		if ( $border_size_top ) {
			$o .= 'border-top-width:' . esc_attr( $border_size_top ) . 'px !important;';
		}
		if ( $border_size_bottom ) {
			$o .= 'border-bottom-width:' . esc_attr( $border_size_bottom ) . 'px !important;';
		}

		if ( $border_color_left ) {
			$o .= 'border-left-color: ' . esc_attr( $border_color_left ) . ' !important;';
		}
		if ( $border_color_right ) {
			$o .= 'border-right-color: ' . esc_attr( $border_color_right ) . ' !important;';
		}
		if ( $border_color_top ) {
			$o .= 'border-top-color: ' . esc_attr( $border_color_top ) . ' !important;';
		}
		if ( $border_color_bottom ) {
			$o .= 'border-bottom-color:' . esc_attr( $border_color_bottom ) . ' !important;';
		}
		$o .= '}';
		/* Hover */
		$o .= $layout_id . ' a.wp-timeline-load-more-btn:hover{';
		if ( $background_hover_color ) {
			$o .= 'background:' . esc_attr( $background_hover_color ) . ' !important;';
		}
		if ( $hover_color ) {
			$o .= 'color:' . esc_attr( $hover_color ) . ' !important;';
		}
		$o .= '}';
		return $o;
	}

	/**
	 * Get Post Date Typography
	 *
	 * @param array  $wtl_settings settings arrray.
	 * @param string $layout_id layout id.
	 * @return html
	 */
	public static function post_date_typography( $wtl_settings, $layout_id ) {
		$font_family     = isset( $wtl_settings['date_font_family'] ) ? $wtl_settings['date_font_family'] : '';
		$font_size       = isset( $wtl_settings['date_fontsize'] ) ? $wtl_settings['date_fontsize'] : '';
		$font_weight     = isset( $wtl_settings['date_font_weight'] ) ? $wtl_settings['date_font_weight'] : '';
		$line_height     = isset( $wtl_settings['date_font_line_height'] ) ? $wtl_settings['date_font_line_height'] : '';
		$font_italic     = isset( $wtl_settings['date_font_italic'] ) ? $wtl_settings['date_font_italic'] : '';
		$text_transform  = isset( $wtl_settings['date_font_text_transform'] ) ? $wtl_settings['date_font_text_transform'] : '';
		$text_decoration = isset( $wtl_settings['date_font_text_decoration'] ) ? $wtl_settings['date_font_text_decoration'] : '';
		$letter_spacing  = isset( $wtl_settings['date_font_letter_spacing'] ) ? $wtl_settings['date_font_letter_spacing'] : '';
		$o               = '';
		$o              .= esc_attr( $layout_id ) . ' .date-meta a.mdate,';
		$o              .= esc_attr( $layout_id ) . ' .wtl-date-top,';
		$o              .= esc_attr( $layout_id ) . ' .wtl-date-top a,';
		$o              .= esc_attr( $layout_id ) . ' .wtl-date-title,';
		$o              .= esc_attr( $layout_id ) . ' .wtl-date-title a,';
		$o              .= esc_attr( $layout_id ) . ' .wtl-post-date,';
		$o              .= esc_attr( $layout_id ) . ' .wtl-post-date a,';
		$o              .= esc_attr( $layout_id ) . ' .wtl-post-date time,';
		$o              .= esc_attr( $layout_id ) . ' .wtl-post-date a.mdate,';
		$o              .= esc_attr( $layout_id ) . ' .wtl-post-date span{';
		if ( $font_family ) {
			$o .= 'font-family:' . esc_attr( $font_family ) . ' !important;';
		}
		$o .= 'font-size:' . esc_attr( $font_size ) . 'px !important;';
		$o .= 'font-weight:' . esc_attr( $font_weight ) . ' !important;';
		$o .= 'line-height:' . esc_attr( $line_height ) . ' !important;';
		if ( 1 == $font_italic ) {
			$o .= 'font-style:italic;';
		} else {
			$o .= 'font-style:normal;';
		}
		$o .= 'text-transform:' . esc_attr( $text_transform ) . ';';
		$o .= 'text-decoration:' . esc_attr( $text_decoration ) . ' !important;';
		$o .= 'letter-spacing:' . esc_attr( $letter_spacing ) . 'px;';
		$o .= '}';
		return $o;
	}

	/**
	 * Get Post Meta Typography
	 *
	 * @param array  $wtl_settings settings arrray.
	 * @param string $layout_id layout id.
	 * @return html
	 */
	public static function post_meta_typography( $wtl_settings, $layout_id ) {
		$template_ftcolor           = isset( $wtl_settings['template_ftcolor'] ) ? $wtl_settings['template_ftcolor'] : '';         
		$template_metacolor           = isset( $wtl_settings['template_metacolor'] ) ? $wtl_settings['template_metacolor'] : '';
		$template_fthovercolor      = isset( $wtl_settings['template_fthovercolor'] ) ? $wtl_settings['template_fthovercolor'] : '';
		$template_categorybgcolor   = isset( $wtl_settings['template_categorybgcolor'] ) ? $wtl_settings['template_categorybgcolor'] : '';
		$template_categorytextcolor = isset( $wtl_settings['template_categorytextcolor'] ) ? $wtl_settings['template_categorytextcolor'] : '';
		$font_family                = isset( $wtl_settings['meta_font_family'] ) ? $wtl_settings['meta_font_family'] : '';
		$font_size                  = isset( $wtl_settings['meta_fontsize'] ) ? $wtl_settings['meta_fontsize'] : '';
		$font_weight                = isset( $wtl_settings['meta_font_weight'] ) ? $wtl_settings['meta_font_weight'] : '';
		$line_height                = isset( $wtl_settings['meta_font_line_height'] ) ? $wtl_settings['meta_font_line_height'] : '';
		$font_italic                = isset( $wtl_settings['meta_font_italic'] ) ? $wtl_settings['meta_font_italic'] : '';
		$text_transform             = isset( $wtl_settings['meta_font_text_transform'] ) ? $wtl_settings['meta_font_text_transform'] : '';
		$text_decoration            = isset( $wtl_settings['meta_font_text_decoration'] ) ? $wtl_settings['meta_font_text_decoration'] : '';
		$letter_spacing             = isset( $wtl_settings['meta_font_letter_spacing'] ) ? $wtl_settings['meta_font_letter_spacing'] : '';

		$o = '';

		$o .= esc_attr( $layout_id ) . ' .horizontal .wtl-mdate,';
		$o .= esc_attr( $layout_id ) . ' .horizontal .wtl-mdate a,';
		$o .= esc_attr( $layout_id ) . ' .horizontal .wtl-post-title .mdate a,';
		$o .= esc_attr( $layout_id ) . ' .horizontal .wtl-post-title .mdate i,';
		$o .= esc_attr( $layout_id ) . ' .horizontal .blog_footer .tags.tag_link,';
		$o .= esc_attr( $layout_id ) . ' .horizontal .blog_footer .tags a,';
		$o .= esc_attr( $layout_id ) . ' .horizontal .blog_footer .categories a,';
		$o .= esc_attr( $layout_id ) . ' .horizontal .mauthor,';
		$o .= esc_attr( $layout_id ) . ' .horizontal .mdate i,';
		$o .= esc_attr( $layout_id ) . ' .horizontal .mauthor i,';
		$o .= esc_attr( $layout_id ) . ' .horizontal .mcomments i,';
		$o .= esc_attr( $layout_id ) . ' .horizontal .wtl-post-title .mdate a,';
		$o .= esc_attr( $layout_id ) . ' .horizontal .mdate i,';
		$o .= esc_attr( $layout_id ) . ' .horizontal .mauthor i,';
		$o .= esc_attr( $layout_id ) . ' .horizontal .mcomments i,';
		$o .= esc_attr( $layout_id ) . ' .horizontal .tags,';
		$o .= esc_attr( $layout_id ) . ' .horizontal .categories i,';
		$o .= esc_attr( $layout_id ) . ' .horizontal .wtl-post-title .mdate,';
		$o .= esc_attr( $layout_id ) . ' .horizontal .metadatabox,';
		$o .= esc_attr( $layout_id ) . ' .horizontal .blog_footer,';
		$o .= esc_attr( $layout_id ) . ' .metadatabox,';
		$o .= esc_attr( $layout_id ) . ' .metadatabox a,';
		$o .= esc_attr( $layout_id ) . ' .wtl-schedule-meta-content,';
		$o .= esc_attr( $layout_id ) . ' .wtl-schedule-meta-content a,';
		$o .= esc_attr( $layout_id ) . ' .wtl-post-date,';
		$o .= esc_attr( $layout_id ) . '.top_divide_layout span.wtl-comment,';
		$o .= esc_attr( $layout_id ) . ' .wtl-post-date a.mdate,';
		$o .= esc_attr( $layout_id ) . ' .wtl-post-date a,';
		$o .= esc_attr( $layout_id ) . ' .wtl-post-date time,';
		$o .= esc_attr( $layout_id ) . ' .wtl-post-category,';
		$o .= esc_attr( $layout_id ) . ' .wtl-post-category a,';
		$o .= esc_attr( $layout_id ) . ' .wtl-post-tags,';
		$o .= esc_attr( $layout_id ) . ' .wtl-post-tags span,';
		$o .= esc_attr( $layout_id ) . ' .wtl-post-tags a,';
		$o .= esc_attr( $layout_id ) . ' .mcomments i,';
		$o .= esc_attr( $layout_id ) . ' .comments-link,';
		$o .= esc_attr( $layout_id ) . ' .author-name,';
		$o .= esc_attr( $layout_id ) . ' .wtl-author,';
		$o .= esc_attr( $layout_id ) . ' .author-name,';
		$o .= esc_attr( $layout_id ) . ' .author-name a,';
		$o .= esc_attr( $layout_id ) . ' .wtl_comment_count,';
		$o .= esc_attr( $layout_id ) . ' .wtl_comment_count a,';
		$o .= esc_attr( $layout_id ) . ' .wtl_blog_template .link-lable,';
		$o .= esc_attr( $layout_id ) . ' .wtl-author a{';

		if ( $font_family ) {
			$o .= 'font-family:' . esc_attr( $font_family ) . ';';
		}
		$o .= 'color:' . esc_attr( $template_ftcolor ) . ';';
		$o .= 'font-size:' . esc_attr( $font_size ) . 'px;';
		$o .= 'font-weight:' . esc_attr( $font_weight ) . ';';
		$o .= 'line-height:' . esc_attr( $line_height ) . ';';
		if ( 1 == $font_italic ) {
			$o .= 'font-style:italic;';
		} else {
			$o .= 'font-style:normal;';
		}
		$o .= 'text-transform:' . esc_attr( $text_transform ) . ';';
		$o .= 'text-decoration:' . esc_attr( $text_decoration ) . ' !important;';
		$o .= 'letter-spacing:' . esc_attr( $letter_spacing ) . 'px;';
		$o .= '}';
		$o .= esc_attr( $layout_id ) . ' .wtl-comment i,';
		$o .= esc_attr( $layout_id ) . ' .wtl-author i,';
		$o .= esc_attr( $layout_id ) . ' .wtl-comment i,';
		$o .= esc_attr( $layout_id ) . ' .wtl_comment_count a,';
		$o .= esc_attr( $layout_id ) . ' .fa-comments:before{';
		$o .= 'color:' . esc_attr( $template_ftcolor ) . ';';
		$o .= '}';
		/* Hover */
		$o .= esc_attr( $layout_id ) . ' .wtl-comment i:hover,';
		$o .= esc_attr( $layout_id ) . ' .fa-comments:before>hover,';
		$o .= esc_attr( $layout_id ) . ' .wtl-author i:hover,';
		$o .= esc_attr( $layout_id ) . ' .wtl_comment_count a:hover,';
		$o .= esc_attr( $layout_id ) . ' .horizontal .wtl-mdate:hover,';
		$o .= esc_attr( $layout_id ) . ' .wtl_comment_count:hover,';
		$o .= esc_attr( $layout_id ) . ' .wtl_comment_count a:hover,';
		$o .= esc_attr( $layout_id ) . ' .horizontal .wtl-mdate a:hover{';
		$o .= 'color:' . esc_attr( $template_fthovercolor ) . ' !important;';
		$o .= '}';

		return $o;
	}

	/**
	 * Get Year
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return html
	 */
	public static function get_post_year( $wtl_settings ) {
		global $post;
		$posts                   = Wp_Timeline_Main::wtl_get_wp_query( $wtl_settings );
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
		if ( $loop->have_posts() ) {
			$ajax_preious_year  = '';
			$ajax_preious_month = '';
			$paged              = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$i                  = 1;
			$out                = '';
			/* Posts Loop Start here. */
			while ( $loop->have_posts() ) :
				$loop->the_post();
				if ( $wp_timeline_theme ) {
					if ( isset( $wtl_settings['display_date'] ) && 1 == $wtl_settings['display_date'] ) {
						$date_format      = ( isset( $wtl_settings['post_date_format'] ) && 'default' !== $wtl_settings['post_date_format'] ) ? $wtl_settings['post_date_format'] : get_option( 'date_format' );
						$wp_timeline_date = ( isset( $wtl_settings['display_date_from'] ) && 'modify' === $wtl_settings['display_date_from'] ) ? apply_filters( 'wtl_date_format', get_post_modified_time( $date_format, $post->ID ), $post->ID ) : apply_filters( 'wtl_date_format', get_the_time( $date_format, $post->ID ), $post->ID );
						$ar_year          = get_the_time( 'Y' );
						$ar_month         = get_the_time( 'm' );
						$ar_day           = get_the_time( 'd' );
						$out             .= '<li class="wtl-post-year  year-' . esc_html( $ar_year ) . '">';
						if ( 'infographic_layout' == $wp_timeline_theme ) {
							$out .= '<a class="mdate" href="#wtl_layout_' . esc_html( get_the_ID() ) . '"><div class="mdate">';
						} else {
							$out .= '<a class="mdate" href="#wtl_date_' . esc_html( $ar_day . '_' . $ar_month ) . '"><div class="mdate">';
						}
						$out .= esc_html( $ar_year );
						$out .= '</div></a>';
						$out .= '</li>';
					}
				}
				$i++;
			endwhile;
			return $out;
			/* Posts Loop End here. */
		}
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
			$ar_year          = get_the_time( 'Y' );
			$ar_month         = get_the_time( 'm' );
			$ar_day           = get_the_time( 'd' );
			$out              = '';
			$out             .= '<span class="wtl-post-date">';
			if ( $show_icon ) {
				$out .= '<i class="far fa-calendar-alt"></i> ';
			}
			$out .= ( $date_link ) ? '<a class="mdate" href="' . esc_url( get_day_link( $ar_year, $ar_month, $ar_day ) ) . '">' : '<div class="mdate">';
			$out .= esc_html( $wp_timeline_date );
			$out .= ( $date_link ) ? '</a>' : '</div>';
			$out .= '</span>';
			return $out;
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
			echo '<span class="wtl-author author"><span class="author-name"> <i class="fas fa-user"></i>';
			echo wp_kses( Wp_Timeline_Main::wtl_get_post_auhtors( $post->ID, $wtl_settings ), Wp_Timeline_Public::args_kses() );
			echo '</span></span>';
		}
	}

	/**
	 * Get Scoial Media Icons
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return void
	 */
	public static function get_social_media( $wtl_settings ) {
		?>
		<div class="wtl-post-social"><div class="wtl-post-social-links"><?php Wp_Timeline_Main::wtl_get_social_icons( $wtl_settings ); ?></div></div>
		<?php
	}

	/**
	 * Get Post Background Color
	 *
	 * @return html
	 */
	public static function post_background_color() {
		global $post;
		$wtl_details            = get_post_meta( $post->ID, '_wtl_single_details_key', true );
		$post_bg_color          = isset( $wtl_details['wtl_background_color'] ) ? $wtl_details['wtl_background_color'] : '';
		$post_bg_only_for_title = isset( $wtl_details['wtl_background_color_opt'] ) ? $wtl_details['wtl_background_color_opt'] : 1;
		if ( $post_bg_color ) {
			if ( 1 != $post_bg_only_for_title ) {
				return 'style="background:' . esc_attr( $post_bg_color ) . '"';
			}
		}
	}

	/**
	 * Get Title Background
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return html
	 */
	public static function post_title_background_color( $wtl_settings ) {
		global $post;
		$wtl_details            = get_post_meta( $post->ID, '_wtl_single_details_key', true );
		$post_bg_color          = isset( $wtl_details['wtl_background_color'] ) ? $wtl_details['wtl_background_color'] : '';
		$post_bg_only_for_title = isset( $wtl_details['wtl_background_color_opt'] ) ? $wtl_details['wtl_background_color_opt'] : 1;
		if ( $post_bg_color ) {
			if ( 1 == $post_bg_only_for_title ) {
				if ( 'verticalblur_layout' === $wtl_settings['template_name'] || 'advanced_layout' === $wtl_settings['template_name'] ) {
					return 'style="background:' . esc_attr( $post_bg_color ) . '"';
				}
			}
		}
	}

	/**
	 * Get Title
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return void
	 */
	public static function get_title( $wtl_settings ) {
		global $post;
		echo '<h2 class="wtl-post-title" ' . esc_attr( self::post_title_background_color( $wtl_settings ) ) . '>';
		$wtl_details   = get_post_meta( $post->ID, '_wtl_single_details_key', true );
		if( isset( $wtl_details['wtl_display_post_custom_link'] ) && 1 == $wtl_details['wtl_display_post_custom_link'] ) {
			if( isset( $wtl_details['wtl_post_custom_link'] ) ) {
				echo '<a href="' . esc_url( $wtl_details['wtl_post_custom_link'] ) . '">';
				echo esc_html( get_the_title() );
				echo '</a>';
			}
		} else {
			$wtl_post_title_link = isset( $wtl_settings['wp_timeline_post_title_link'] ) ? $wtl_settings['wp_timeline_post_title_link'] : 1;
			echo ( $wtl_post_title_link ) ? '<a href="' . esc_url( get_the_permalink() ) . '">' : '';
			echo esc_html( get_the_title() );
			echo ( $wtl_post_title_link ) ? '</a>' : '';
		}
		echo '</h2>';
	}

	/**
	 * Get Post Content
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return void
	 */
	public static function get_content( $wtl_settings ) {
		global $post;
		if ( isset( $wtl_settings['rss_use_excerpt'] ) ) {
			add_action(
				'wtl_content_filter',
				function( $excerpt ) {
					return preg_replace( '/\[gallery.*\]/', '', $excerpt );
				}
			);
			if ( 'gallery' === get_post_format() ) {
				echo '<p>' .wp_kses( Wp_Timeline_Main::wtl_get_content( $post->ID, $wtl_settings, $wtl_settings['rss_use_excerpt'], $wtl_settings['txtExcerptlength'] ), Wp_Timeline_Public::args_kses() ) .'</p>';
			} else {
				echo '<p>' .wp_kses( Wp_Timeline_Main::wtl_get_content( $post->ID, $wtl_settings, $wtl_settings['rss_use_excerpt'], $wtl_settings['txtExcerptlength'] ), Wp_Timeline_Public::args_kses() ) .'</p>';
			}
		}
	}

	/**
	 * Display popup
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return void
	 */
	public static function display_popup_excerpt( $wtl_settings ) {
		global $post;
		$excerpt = get_the_excerpt( $post->ID );
		if ( 1 == $wtl_settings['display_popup'] ) {
			echo '<span class="popup_story">';
			echo '<a href="#" class="popup_id" data-id="popup_' . esc_attr( $post->ID ) . '">View More</a>';
			echo '</span>';
		}
		?>
		<input type="hidden" id="post_id" name="post_id" value="<?php echo esc_attr( $post->ID ); ?>">
		<div id="popup_<?php echo esc_attr( $post->ID ); ?>" class="modal-box">
			<a href="#" class="js-modal-close close"><i class="fas fa-window-close"></i></a>
			<div class="modal-body">
				<p><?php echo esc_html( $excerpt ); ?></p>
			</div>
		</div>
		<?php
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
						echo '<iframe src="' . esc_url( $first_value ) . '" data-src="' . esc_url( $first_value ) . '" width="100%" height="100%" ></iframe>';
					} elseif ( 'audio' == $thumbnail_type && 'mixcloud' == $audio_type ) {
						$first_value = 'https://www.mixcloud.com/widget/iframe/?feed=' . $audio_id;
						echo '<iframe src="' . esc_url( $first_value ) . '" data-src="' . esc_url( $first_value ) . '" width="100%" height="100%" ></iframe>';
					} elseif ( 'audio' == $thumbnail_type && 'beatport' == $audio_type ) {
						$first_value = 'https://embed.beatport.com/?id=' . $audio_id . '&type=track';
						echo '<iframe src="' . esc_url( $first_value ) . '" data-src="' . esc_url( $first_value ) . '" width="100%" height="100%" ></iframe>';
					}
				}
				echo '</div>';
			} elseif ( empty( $thumbnail_type ) ) {
				if ( isset( $thumbnail ) && ! empty( $thumbnail ) ) {
					echo '<div class="schedule-image-wrapper wtl-post-thumbnail">';
					/* [1] Check if Embed Media ---------- */
					if ( 0 == $wtl_settings['rss_use_excerpt'] ) {
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
					if ( 'image' === get_post_format() ) {
						$image_url = self::catch_that_image();
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
	 * Get Comment
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return void
	 */
	public static function get_comment( $wtl_settings ) {
		if ( 1 == $wtl_settings['display_comment_count'] ) {
			if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
				$disable_link_comment = isset( $wtl_settings['disable_link_comment'] ) ? $wtl_settings['disable_link_comment'] : '';
				?><span class="wtl-comment <?php echo ( $disable_link_comment ) ? 'wtl-no-links' : ''; ?>"><i class="fas fa-comments"></i><?php
					if ( isset( $wtl_settings['disable_link_comment'] ) && 1 == $wtl_settings['disable_link_comment'] ) {
						comments_number( '0', '1', '%' );
					} else {
						comments_popup_link( esc_html__( 'Leave a Comment', 'wp-timeline-designer-pro' ), esc_html__( '1 comment', 'wp-timeline-designer-pro' ), '% ' . esc_html__( 'comments', 'wp-timeline-designer-pro' ), 'comments-link', esc_html__( 'Comments are off', 'wp-timeline-designer-pro' ) );
					}
					?>
				</span>
				<?php
			endif;
		}
	}

	/**
	 * Get Comment Count
	 *
	 * @param array $wtl_settings settings arrray.
	 * @return string
	 */
	public static function comment_count( $wtl_settings ) {
		$comment_link   = ( isset( $wtl_settings['disable_link_comment'] ) && 1 == $wtl_settings['disable_link_comment'] ) ? false : true;
		$num_comments   = get_comments_number( get_the_ID() );
		$write_comments = '';
		if ( comments_open() ) {
			if ( 0 == $num_comments ) {
				$comments = esc_html__( 'No Comments', 'wp-timeline-designer-pro' );
			} elseif ( $num_comments > 1 ) {
				$comments = $num_comments . ' ' . esc_html__( 'Comments', 'wp-timeline-designer-pro' );
			} else {
				$comments = '1 ' . esc_html__( 'Comment', 'wp-timeline-designer-pro' );
			}
			if ( $comment_link ) {
				$write_comments = '<a href="' . get_comments_link() . '">' . esc_html( $comments ) . '</a>';
			} else {
				$write_comments = $comments;
			}
		} else {
			$write_comments = esc_html__( 'Comments are closed', 'wp-timeline-designer-pro' );
		}
		return '<span class="wtl_comment_count"><i class="fas fa-comments" style="user-select: none;"></i> ' . $write_comments . '</span>';
	}

	/**
	 * Get Category
	 *
	 * @param array   $wtl_settings settings arrray.
	 * @param boolean $show_label show label.
	 * @param boolean $divd show divider.
	 * @return void
	 */
	public static function get_category( $wtl_settings, $show_label, $divd ) {
		global $post;
		if ( 'post' === $wtl_settings['custom_post_type'] ) {
			if ( isset( $wtl_settings['display_category'] ) && 1 == $wtl_settings['display_category'] ) {
				$categories_link = ( isset( $wtl_settings['disable_link_category'] ) && 1 == $wtl_settings['disable_link_category'] ) ? true : false;
				?>
				<div class="wtl-post-category">
					<span class="category-link<?php echo ( $categories_link ) ? ' categories_link' : ''; ?>">
						<?php
						if ( true == $show_label ) {
							?>
							<span class="link-lable"> <i class="fas fa-folder"></i> <?php esc_html_e( 'Category', 'wp-timeline-designer-pro' ); ?>:&nbsp; </span>
							<?php
						}
						if ( true == $divd ) {
							$categories_list = get_the_category_list( ', ' );
						} else {
							$categories_list = get_the_category_list( ' ' );
						}

						if ( $categories_link ) {
							$categories_list = wp_strip_all_tags( $categories_list );
						}
						if ( $categories_list ) :
							echo ' ' . wp_kses( $categories_list, self::param_kses() );
							$show_sep = true;
						endif;
						?>
					</span>
				</div>
				<?php
			}
		} else {
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
								if ( true == $show_label ) {
									?>
									<span class="link-lable"> <i class="fas fa-folder-open"></i> <?php echo esc_html( $taxonomy_single->label ); ?>:&nbsp; </span>
									<?php
								}
								foreach ( $term_list as $term_nm ) {
									$term_link             = get_term_link( $term_nm );
									$disable_link_category = isset( $wtl_settings['disable_link_category'] ) ? $wtl_settings['disable_link_category'] : '';
									if ( 1 != $sep ) {
										if ( true == $divd ) {
											echo ', ';
										}
									}

									echo ( $taxonomy_link ) ? '<a href="' . esc_url( $term_link ) . '">' : '<a href="javascript:void(0)">';
									echo esc_html( $term_nm->name );
									echo ( $taxonomy_link ) ? '</a>' : '</a>';
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
				$tags_link        = ( isset( $wtl_settings[ 'disable_link_taxonomy_' . $wtl_display_tax_tag ] ) && 1 == $wtl_settings[ 'disable_link_taxonomy_' . $wtl_display_tax_tag ] ) ? false : true;
				$disable_link_tag = ( isset( $wtl_settings['disable_link_tag'] ) && 1 == $wtl_settings['disable_link_tag'] ) ? 1 : 0;
				$post_tags        = wp_get_post_terms( $post->ID, $wtl_tax_tag, array( 'hide_empty' => 'false' ) );
				$sep              = 1;
				if ( isset( $post_tags ) && ! empty( $post_tags ) ) {
					?>
					<div class="wtl-post-tags">
						<span class="tags <?php echo ( $tags_link ) ? 'wp_timeline_no_links' : 'wp_timeline_has_link'; ?>">
							<?php
							if ( true == $show_label ) {
								?>
								<span class="link-lable"> <i class="fas fa-bookmark"></i> <?php esc_html_e( 'Tags', 'wp-timeline-designer-pro' ); ?>:&nbsp; </span>
								<?php
							}
							foreach ( $post_tags as $tag ) {
								echo '<span class="wp-timeline-custom-tag">';
								if ( 1 != $sep ) {
									if ( true == $divd ) {
										echo ', ';
									}
								}
								if ( 1 == $tags_link && 0 == $disable_link_tag ) {
									echo esc_url( $tags_link ) ? '<a href="' . esc_url( get_term_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) : esc_html( $tag->name );
								} else {
									echo esc_attr( $tag->name );
								}
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
	 * Get Post detail: if post is product then it will show price,rating etc.
	 *
	 * @param array $wtl_settings setings array.
	 * @return void
	 */
	public static function get_post_details( $wtl_settings ) {
		global $post;
		if ( isset( $wtl_settings['custom_post_type'] ) && 'product' === $wtl_settings['custom_post_type'] ) {
			do_action( 'wtl_woo_product_details', $wtl_settings, $post->ID );
		}
		if ( isset( $wtl_settings['custom_post_type'] ) && 'download' === $wtl_settings['custom_post_type'] ) {
			do_action( 'wtl_edd_product_details', $wtl_settings, $post->ID );
		}
	}
}
$wtl_template_config = new Wtl_Template_Config();
require_once 'class-wtl-like-post.php';
require_once 'template-reset/class-wtl-template-reset.php';
require_once 'template-class/class-wtl-template-hire-layout.php';
require_once 'template-class/class-wtl-template-curve-layout.php';
require_once 'template-class/class-wtl-template-advanced-layout.php';
require_once 'template-class/class-wtl-template-easy-layout.php';
require_once 'template-class/class-wtl-template-fullvertical-layout.php';
require_once 'template-class/class-wtl-template-year-layout.php';
require_once 'template-class/class-wtl-template-story-layout.php';
require_once 'template-class/class-wtl-template-overlay-layout.php';
require_once 'template-class/class-wtl-template-schedule-layout.php';
require_once 'template-class/class-wtl-template-fullwidth-layout.php';
require_once 'template-class/class-wtl-template-milestone-layout.php';
require_once 'template-class/class-wtl-template-glossary-layout.php';
require_once 'template-class/class-wtl-template-business-layout.php';
require_once 'template-class/class-wtl-template-timeline-graph-layout.php';
require_once 'template-class/class-wtl-template-boxy-layout.php';
require_once 'template-class/class-wtl-template-wise-layout.php';
require_once 'template-class/class-wtl-template-cover-layout.php';
require_once 'template-class/class-wtl-template-rounded-layout.php';
require_once 'template-class/class-wtl-template-divide-layout.php';
require_once 'template-class/class-wtl-template-topdivide-layout.php';
require_once 'template-class/class-wtl-template-attract-layout.php';
require_once 'template-class/class-wtl-template-processinfo-layout.php';
require_once 'template-class/class-wtl-template-verticalblur-layout.php';
require_once 'template-class/class-wtl-template-accordion-layout.php';
require_once 'template-class/class-wtl-template-collapsible-layout.php';
require_once 'template-class/class-wtl-template-fullhorizontal-layout.php';
require_once 'template-class/class-wtl-template-infographic-layout.php';
require_once 'template-class/class-wtl-template-zigzag-layout.php';
require_once 'template-class/class-wtl-template-columy-layout.php';
require_once 'template-class/class-wtl-template-leafty-layout.php';
require_once 'template-class/class-wtl-template-sportking-layout.php';
require_once 'template-class/class-wtl-template-filledtimeline-layout.php';
require_once 'template-class/class-wtl-template-classictimeline-layout.php';
require_once 'template-class/class-wtl-template-milestonetimeline-layout.php';
