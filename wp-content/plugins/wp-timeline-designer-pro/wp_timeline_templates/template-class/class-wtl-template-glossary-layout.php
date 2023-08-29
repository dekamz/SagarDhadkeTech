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
class Wtl_Template_Glossary_Layout {
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
		$layout_type           = $wtl_settings['layout_type'];
		$wp_year_timeline_side = isset( $wtl_settings['wp_year_timeline_side'] ) ? $wtl_settings['wp_year_timeline_side'] : 0;
		if ( 1 == $layout_type && 1 == $wp_year_timeline_side ) {
			$slider_class = 'wtl_is_horizontal';
		} else {
			$slider_class = '';
		}

		$layout_type = $wtl_settings['layout_type'];
		if ( 1 == $layout_type ) {
			$slider_class2 = 'wtl_is_horizontal';
		} else {
			$slider_class2 = 'wtl_is_vertical';
			$slider_class3 = 'masonry';
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
		$out .= '<div id="wtl_glossary_layout" class="wtl_wrapper wp_timeline_post_list schedule_cover ' . $slider_class . ' ' . $slider_class2 . ' layout_id_' . $layout_id . '">';
		$out .= self::heading( $wtl_settings );
		$out .= '<div class="wtl-schedule-wrap">';
		$out .= '<div class="wtl_blog_template '. $slider_class3 .'">';
		$out .= $template_wrapper;
		$out .= '</div></div></div>';
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
					$out .= '<h1>' . esc_html( $heading_1 ) . '</h1>';
			}
			if ( $heading_2 ) {
					$out .= '<h3>' . esc_html( $heading_2 ) . '</h3>';
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
					responsive: responsive,
					dots: false,
					infinite: false,mobileFirst:true,pauseOnHover:true,
					nextArrow: '<span class="wtl-ss-right"><i class="fas fa-angle-right"></i></span>',
					prevArrow: '<span class="wtl-ss-left"><i class="fas fa-angle-left"></i></span>',
					slidesToShow:noofslide,
					autoplay:autoplay,
					//asNavFor:'.wtl_al_nav',
					adaptiveHeight:true,
					autoplaySpeed:scroll_speed,
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
				/*$('.wtl_al_nav').slick({
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
				})*/
				}(jQuery))
			});
			</script>
			<?php
		} else {
			?>
			<script type="text/javascript">
				jQuery(document).ready(function(){
					(function($){
						setTimeout(function() {
							// $('.wtl_blog_template .blog_template').each(function(){
							// 	left = $(this).css('left');
							// 	if(left=='0px'){
							// 		$(this).addClass('wtl_left_side');
							// 	} else{
							// 		$(this).addClass('wtl_right_side');
							// 	}
							// });
							$('.wtl_blog_template .blog_template:nth-child(odd)').addClass('wtl_left_side');
							$('.wtl_blog_template .blog_template:nth-child(even)').addClass('wtl_right_side');
						}, 3000);
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
	 * @return void
	 */
	public static function slider_nav( $wtl_settings, $wp_timeline_theme, $loop, $temp_query ) {
		if ( 'glossary_layout' === $wp_timeline_theme ) {
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
			}
		}

	}

}
$wtl_template_glossary_layout = new Wtl_Template_Glossary_Layout();
