<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/wp_timeline_templates/blog/infographic-layout.php.
 *
 * @author  Solwin Infotech
 * @version 1.0
 *
 * @package    Wp_Timeline_Designer_PRO
 * @subpackage Wp_Timeline_Designer_PRO/wp_timeline_templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $post;
$prev_year1               = null;
$i                        = $count;
$wtl_details              = get_post_meta( $post->ID, '_wtl_single_details_key', true );
$arrow_back_color         = isset( $wtl_details['wtl_arrow_background_color'] ) ? $wtl_details['wtl_arrow_background_color'] : '';
$order_by                 = $wtl_settings ['wp_timeline_blog_order_by'];
$default_arrow_back_color = isset( $wtl_settings['template_arrow_back_color'] ) ? $wtl_settings['template_arrow_back_color'] : '';
if ( 'date' === $order_by || 'modified' === $order_by ) {
	$this_year = get_the_date( 'Y' );
	if ( $prev_year1 != $this_year ) {
		$prev_year1 = $this_year;
		$prev_year  = 0;
	} elseif ( $prev_year1 == $this_year ) {
		$prev_year = 1;
	}
} else {
	$prev_year = get_the_date( 'Y' );
}
$wtl_animation = isset( $wtl_settings['timeline_animation'] ) ? $wtl_settings['timeline_animation'] : 'fade';
do_action( 'wtl_before_post_content' );
$this_year = get_the_date( 'Y' );
if ( 0 == $prev_year || $prev_year == $this_year ) {
	$prev_year = $this_year;
} else {
	$prev_year = '';
}
?>
	<div  id="wtl_layout_<?php echo esc_attr( $post->ID ); ?>"  class="wtl-schedule-post-content <?php echo 'post_' . esc_attr( Wtl_Template_Infographic_Layout::even_odd( $i ) ); ?>" data-aos="<?php echo esc_attr( $wtl_animation ); ?>">
		<div class="wtl-arrow">
			<div class="wtl-post-date" data-post-year="<?php echo esc_attr( get_the_time( 'Y' ) ); ?>">
				<?php
				$display_story_year = isset( $wtl_settings['display_story_year'] ) ? $wtl_settings['display_story_year'] : 1;
				if ( 1 == $display_story_year ) {
					if ( 0 != $prev_year ) {
						?>
					<a class="mdate" href="<?php echo esc_url( get_year_link( get_the_time( 'Y' ) ) ); ?>"><span><?php echo esc_html( $prev_year ); ?></span></a>
						<?php
					}
				}
				?>
			</div>
			<div class="wtl-arrow-left">
			</div>
			<div class="wtl-arrow-right">
			</div>
			<div class="wtl-side-arrow">
				<i class="fa fa-chevron-right" aria-hidden="true"></i>
			</div>
		</div>
		<div class="wtl-schedule-all-post-content wtl_post_content_schedule">
			<?php echo wp_kses( Wtl_Template_Config::get_title( $wtl_settings ), Wtl_Template_Config::param_kses() ); ?>
			<?php Wtl_Template_Config::get_post_image( $wtl_settings ); ?>
			<div class="wtl-schedule-meta-content">
				<?php
				Wtl_Template_Config::get_author( $wtl_settings );
				echo wp_kses( Wtl_Template_Config::get_post_date( $wtl_settings, true ), Wp_Timeline_Public::args_kses() );
				Wtl_Template_Config::get_comment( $wtl_settings );
				if ( isset( $wtl_settings['display_postlike'] ) && 1 == $wtl_settings['display_postlike'] ) {
					echo do_shortcode( '[likebtn_shortcode]' );
				}
				?>
			</div>
			<?php Wtl_Template_Config::get_post_details( $wtl_settings ); ?>
			<div class="wtl-post-content">
				<?php
				echo wp_kses( Wtl_Template_Config::get_content( $wtl_settings ), Wp_Timeline_Public::args_kses() );
				echo wp_kses( Wtl_Template_Config::get_read_more_link( $wtl_settings ), Wp_Timeline_Public::args_kses() );
				?>
			</div>
			<div class="wtl-post-footer">
				<?php
				echo wp_kses( Wtl_Template_Config::get_read_more_link_2( $wtl_settings ), Wp_Timeline_Public::args_kses() );
				Wtl_Template_Config::display_popup_excerpt( $wtl_settings );
				echo wp_kses( Wtl_Template_Config::get_category( $wtl_settings, true, true ), Wp_Timeline_Public::args_kses() );
				echo wp_kses( Wtl_Template_Config::get_tags( $wtl_settings, true, true ), Wp_Timeline_Public::args_kses() );

				Wp_Timeline_Main::wtl_get_social_icons( $wtl_settings );
				?>
			</div>
		</div>
		<style>
			<?php
				$odd_or_even      = Wtl_Template_Infographic_Layout::even_odd( $i );
				$arrow_back_color = Wtl_Template_Infographic_Layout::arrow_background_color();
			if ( 'odd' == $odd_or_even ) {
				if ( $arrow_back_color ) {
					?>
						#wtl_layout_<?php echo esc_attr( $post->ID ); ?> .wtl-arrow-left {  
							background-color: <?php echo esc_attr( $arrow_back_color ); ?> !important;
						}
						#wtl_layout_<?php echo esc_attr( $post->ID ); ?> .wtl-arrow-right {  
							background-color: <?php echo esc_attr( $arrow_back_color ); ?> !important;
							opacity: 0.8;
						}
					<?php } else { ?>
						#wtl_layout_<?php echo esc_attr( $post->ID ); ?>.wtl-schedule-post-content .wtl-arrow-left {  
							background-color: <?php echo esc_attr( $default_arrow_back_color ); ?>;
						}
						#wtl_layout_<?php echo esc_attr( $post->ID ); ?>.wtl-schedule-post-content .wtl-arrow-right {  
							background-color: <?php echo esc_attr( $default_arrow_back_color ); ?>;
							opacity: 0.8;
						}
						#wtl_layout_<?php echo esc_attr( $post->ID ); ?>.wtl-schedule-post-content .wtl-side-arrow i {  
							background-color: <?php echo esc_attr( $default_arrow_back_color ); ?>;
						}
						#wtl_layout_<?php echo esc_attr( $post->ID ); ?>.wtl-schedule-post-content .wtl-arrow > .wtl-post-date {  
							background-color: <?php echo esc_attr( $default_arrow_back_color ); ?>;
							opacity: 0.8;
						}
					<?php
					}
			} else {
				if ( $arrow_back_color ) {
					?>
					#wtl_layout_<?php echo esc_attr( $post->ID ); ?> .wtl-arrow-left {  
						background-color: <?php echo esc_attr( $arrow_back_color ); ?> !important;
						opacity: 0.7;
					}
					#wtl_layout_<?php echo esc_attr( $post->ID ); ?> .wtl-arrow-right {  
						background-color: <?php echo esc_attr( $arrow_back_color ); ?> !important;
					}
				<?php } else { ?>
					#wtl_layout_<?php echo esc_attr( $post->ID ); ?>.wtl-schedule-post-content .wtl-arrow-left {  
						background-color: <?php echo esc_attr( $default_arrow_back_color ); ?>;
						opacity: 0.7;
					}
					#wtl_layout_<?php echo esc_attr( $post->ID ); ?>.wtl-schedule-post-content .wtl-arrow-right {  
						background-color: <?php echo esc_attr( $default_arrow_back_color ); ?>;
					}
					#wtl_layout_<?php echo esc_attr( $post->ID ); ?>.wtl-schedule-post-content .wtl-side-arrow i {  
						background-color: <?php echo esc_attr( $default_arrow_back_color ); ?>;
					}
					#wtl_layout_<?php echo esc_attr( $post->ID ); ?>.wtl-schedule-post-content .wtl-arrow > .wtl-post-date {  
						background-color: <?php echo esc_attr( $default_arrow_back_color ); ?>;
						opacity: 0.7;
					}
					<?php
				}
			}
			?>
			#wtl_layout_<?php echo esc_attr( $post->ID ); ?> .wtl-side-arrow i {  
				background-color: <?php echo esc_attr( $arrow_back_color ); ?> !important;
			}
			#wtl_layout_<?php echo esc_attr( $post->ID ); ?> .wtl-arrow > .wtl-post-date {  
				background-color: <?php echo esc_attr( $arrow_back_color ); ?> !important;
				opacity: 0.8;
			}
		</style>
	</div>
<?php
do_action( 'wtl_after_post_content' );
do_action( 'wtl_separator_after_post' );
