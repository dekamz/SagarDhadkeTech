<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/wp_timeline_templates/blog/advanced-layout.php.
 *
 * @author  Solwin Infotech
 * @version 1.0
 *
 * @package    Wp_Timeline_Designer_PRO
 * @subpackage Wp_Timeline_Designer_PRO/wp_timeline_templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global $post;

$image_hover_effect = '';
if ( isset( $wtl_settings['wp_timeline_image_hover_effect'] ) && 1 == $wtl_settings['wp_timeline_image_hover_effect'] ) {
	$image_hover_effect = ( isset( $wtl_settings['wp_timeline_image_hover_effect_type'] ) && '' != $wtl_settings['wp_timeline_image_hover_effect_type'] ) ? $wtl_settings['wp_timeline_image_hover_effect_type'] : '';
}
$wtl_details            = get_post_meta( $post->ID, '_wtl_single_details_key', true );
$wtl_all_post_type      = array( 'product', 'download', 'post' );
$post_content_color_set = isset( $wtl_details['wtl_content_color'] ) ? ' style=color:' . $wtl_details['wtl_content_color'] . '; ' : '';
$wtl_content_color      = isset( $wtl_details['wtl_content_color'] ) ? $wtl_details['wtl_content_color'] : '';
$i                      = $count;
$layout_type            = $wtl_settings['layout_type'];
$timeline_style_type    = $wtl_settings['timeline_style_type'];
$timeline_style_view    = $wtl_settings['timeline_style_view'];
$wtl_animation          = isset( $wtl_settings['timeline_animation'] ) ? $wtl_settings['timeline_animation'] : 'fade';
/* Horizontal Only */
if ( 1 == $layout_type ) {
	/*----------------------------------------------------------------------*/
	?>
	<div class="wtl-slitem <?php echo 'post_' . esc_attr( Wtl_Template_Advanced_Layout::even_odd( $i ) ); ?>" data-slick-index="<?php echo esc_attr( $i ); ?>" id="wtl_layout_<?php echo esc_attr( $post->ID ); ?>">
		<style>
			<?php
			$title_color = Wtl_Template_Advanced_Layout::post_background_color();
			if ( $title_color ) {

				if ( 0 == $timeline_style_type ) {
					?>
				.wp_timeline_post_list.wtll_style_type_0 .post_odd#wtl_layout_<?php echo esc_attr( $post->ID ); ?> .wtl-post-date, .wp_timeline_post_list.wtll_style_type_0 .post_even#wtl_layout_<?php echo esc_attr( $post->ID ); ?> .wtl-post-date {background:<?php echo esc_attr( $title_color ); ?> !important; color: <?php echo esc_attr( $wtl_content_color ); ?> !important; }


				.wp_timeline_post_list.wtll_style_type_0 .post_odd#wtl_layout_<?php echo esc_attr( $post->ID ); ?> .wtl-post-content p, .wp_timeline_post_list.wtll_style_type_0 .post_even#wtl_layout_<?php echo esc_attr( $post->ID ); ?> .wtl-post-content p {color: <?php echo esc_attr( $wtl_content_color ); ?> !important; }


				.wp_timeline_post_list.wtll_style_type_0 .post_odd#wtl_layout_<?php echo esc_attr( $post->ID ); ?> .wtl-post-date span, .wp_timeline_post_list.wtll_style_type_0 .post_even#wtl_layout_<?php echo esc_attr( $post->ID ); ?> .wtl-post-date span {color: <?php echo esc_attr( $wtl_content_color ); ?> !important; }
				.wp_timeline_post_list.wtll_style_type_0 .post_odd#wtl_layout_<?php echo esc_attr( $post->ID ); ?> .wtl-post-date:after,
				.wp_timeline_post_list.wtll_style_type_0 .post_even#wtl_layout_<?php echo esc_attr( $post->ID ); ?> .wtl-post-date:after { border-color: transparent transparent transparent <?php echo esc_attr( $title_color ); ?> !important;}
					<?php
				}
				if ( 2 == $timeline_style_type || 3 == $timeline_style_type || 6 == $timeline_style_type ) {
					?>
					#wtl_layout_<?php echo esc_attr( $post->ID ); ?> .wtl-post-title{ background: none !important }
					#wtl_layout_<?php echo esc_attr( $post->ID ); ?> .wtl-post-title a{color:<?php echo esc_attr( $title_color ); ?> !important; padding-top: 0}
					.clayout_skin_2 #wtl_layout_<?php echo esc_attr( $post->ID ); ?>.wtl-slitem{border-top-color:<?php echo esc_attr( $title_color ); ?>}
					<?php
				} elseif ( 4 == $timeline_style_type || 5 == $timeline_style_type ) {
					?>
					#wtl_layout_<?php echo esc_attr( $post->ID ); ?> .wtl-post-title{ background: none }
					<?php
				} else {
					?>
					#wtl_layout_<?php echo esc_attr( $post->ID ); ?> .wtl-post-title{background:<?php echo esc_attr( $title_color ); ?> !important}
					<?php
				}
				?>
				#wtl_layout_<?php echo esc_attr( $post->ID ); ?> .wtl-post-center-image{background:<?php echo esc_attr( $title_color ); ?> !important}
				<?php
			}
			?>
		</style>
		<?php
		if ( 2 != $timeline_style_type ) {
			if ( 3 != $timeline_style_type ) {
				if ( 4 != $timeline_style_type ) {
					if ( 5 != $timeline_style_type ) {
						if ( 6 == $timeline_style_type ) {
							echo '<span data-featherlight="#flid' . esc_attr( $post->ID ) . '">';
							echo wp_kses( Wtl_Template_Advanced_Layout::get_post_date( $wtl_settings, false ), Wp_Timeline_Public::args_kses() );
							Wtl_Template_Config::get_title( $wtl_settings );
							echo '</span>';
						} else {
							Wtl_Template_Config::get_title( $wtl_settings );
						}
					}
				}
			}
		}
		if ( 1 == $timeline_style_type || 2 == $timeline_style_type ) {
			Wtl_Template_Config::get_post_image( $wtl_settings );
		}
		if ( 6 == $timeline_style_type ) {
			?>
			<div class="lightbox wtl-fl-box" id="flid<?php echo esc_attr( $post->ID ); ?>">
				<div class="wtl-post-content" <?php echo esc_attr( $post_content_color_set ); ?>>
					<?php
					echo wp_kses( Wtl_Template_Advanced_Layout::get_post_date( $wtl_settings, false ), Wp_Timeline_Public::args_kses() );
					do_action( 'wtl_before_post_content' );
					Wtl_Template_Config::get_title( $wtl_settings );
					Wtl_Template_Config::get_post_image( $wtl_settings );
					Wtl_Template_Config::get_content( $wtl_settings );
					Wtl_Template_Config::get_read_more_link( $wtl_settings );
					Wtl_Template_Config::get_read_more_link_2( $wtl_settings );
					Wtl_Template_Config::display_popup_excerpt( $wtl_settings );
					do_action( 'wtl_after_post_content' );
					?>
				</div>
			</div>
			<?php

		} else {
			?>
			<div class="wtl-post-content" <?php echo esc_attr( $post_content_color_set ); ?>>
				<?php
				do_action( 'wtl_before_post_content' );
				if ( 2 == $timeline_style_type ) {
					Wtl_Template_Config::get_title( $wtl_settings );
				}
				if ( 1 != $timeline_style_type ) {
					if ( 2 != $timeline_style_type ) {
						Wtl_Template_Config::get_post_image( $wtl_settings );
					}
				}
				if ( 3 == $timeline_style_type || 4 == $timeline_style_type || 5 == $timeline_style_type ) {
					Wtl_Template_Config::get_title( $wtl_settings );
				}

				Wtl_Template_Config::get_content( $wtl_settings );
				Wtl_Template_Config::get_read_more_link( $wtl_settings );
				Wtl_Template_Config::get_read_more_link_2( $wtl_settings );
				Wtl_Template_Config::display_popup_excerpt( $wtl_settings );
				do_action( 'wtl_after_post_content' );
				// if ( Wtl_Template_Advanced_Layout::get_category( $wtl_settings ) || Wtl_Template_Advanced_Layout::get_tags( $wtl_settings ) || Wtl_Template_Advanced_Layout::social_icon( $wtl_settings ) ) {.
				?>
					<div class="wtl-post-footer">
						<?php
						Wtl_Template_Config::get_author( $wtl_settings );
						Wtl_Template_Config::get_comment( $wtl_settings );
						Wtl_Template_Config::get_post_details( $wtl_settings );
						echo wp_kses( Wtl_Template_Config::get_category( $wtl_settings, true, true ), Wp_Timeline_Public::args_kses() );
						echo wp_kses( Wtl_Template_Config::get_tags( $wtl_settings, true, true ), Wp_Timeline_Public::args_kses() );
						echo wp_kses( Wtl_Template_Advanced_Layout::social_icon( $wtl_settings ), Wp_Timeline_Public::args_kses() );
						?>
					</div>
					<?php
					// }
					?>
			</div>
			<?php
		}
		?>
	</div>
	<?php
	/*----------------------------------------------------------------------*/
} else {
	/* Vertical Only */
	?>
	<style>
		<?php
		$title_color  = Wtl_Template_Advanced_Layout::post_background_color();
		$title_color1 = Wtl_Template_Advanced_Layout::post_title_background_color();
		if ( $title_color || $title_color1 ) {
			if ( 0 == $timeline_style_type ) {
				?>
			.wtl_dateeicon_<?php echo esc_attr( $post->ID ); ?> .wtl-post-date {background:<?php echo esc_attr( $title_color ); ?> !important; }
			.wp_timeline_post_list.wtll_style_type_0 .wtl-schedule-post-content .wtl_dateeicon_<?php echo esc_attr( $post->ID ); ?> .wtl-post-date:after { border-color: transparent transparent transparent <?php echo esc_attr( $title_color ); ?> !important;}
				<?php
			}
			if ( 2 != $timeline_style_type ) {
				if ( 'minima' === $timeline_style_view ) {
					?>
					#wtl_layout_<?php echo esc_attr( $post->ID ); ?> .wtl-date-title{
						background:<?php echo esc_attr( $title_color ); ?> !important
					}                    
					<?php
				} else {
					?>
					#wtl_layout_<?php echo esc_attr( $post->ID ); ?> .wtl-post-title{
						background:<?php echo esc_attr( $title_color ); ?> !important
					}
					<?php
				}
			}
			if ( 1 == $timeline_style_type ) {
				?>
				.wp_timeline_post_list.wtll_style_type_1 .wtl-schedule-post-content #wtl_layout_<?php echo esc_attr( $post->ID ); ?> .wtl-post-content, .wp_timeline_post_list.wtll_style_type_1 .wtl-schedule-post-content #wtl_layout_<?php echo esc_attr( $post->ID ); ?> .schedule-image-wrapper {background:<?php echo esc_attr( $title_color ); ?> !important}
				<?php
			}
			/* Dynami Arrow */
			if ( 'center' === $timeline_style_view ) {
				?>
				/* layout veiw center */                
				.wtl_layout_even_<?php echo esc_attr( $post->ID ); ?>:before{  border-color: transparent transparent transparent <?php echo esc_attr( $title_color ); ?> !important}
				.wtl_layout_odd_<?php echo esc_attr( $post->ID ); ?>:before{  border-color: transparent <?php echo esc_attr( $title_color ); ?> transparent transparent !important}
				<?php
			} elseif ( 'left' === $timeline_style_view ) {
				?>
							 
				/* layout veiw left */
				.wtl_layout_even_<?php echo esc_attr( $post->ID ); ?>:before{  border-color: transparent transparent transparent <?php echo esc_attr( $title_color ); ?> !important}
				.wtl_layout_odd_<?php echo esc_attr( $post->ID ); ?>:before{  border-color: transparent <?php echo esc_attr( $title_color ); ?> transparent transparent !important}
				<?php
			} elseif ( 'right' === $timeline_style_view ) {
				?>
							 
				/* layout veiw right */
				.wtl_layout_odd_<?php echo esc_attr( $post->ID ); ?>:before{  border-color: transparent <?php echo esc_attr( $title_color ); ?> transparent transparent !important}
				.wtl_layout_even_<?php echo esc_attr( $post->ID ); ?>:before{  border-color: transparent transparent transparent <?php echo esc_attr( $title_color ); ?> !important}
				<?php
			} elseif ( 'minima' === $timeline_style_view ) {
				?>
				/* layout veiw minima */
				<?php if ( ! empty( $wtl_content_color ) && 2 == $timeline_style_type ) { ?>
					.post_odd .wtl_layout_odd_<?php echo esc_attr( $post->ID ); ?> h2.wtl-date-top, .post_odd .wtl_layout_odd_<?php echo esc_attr( $post->ID ); ?> h2.wtl-date-top a, .post_even .wtl_layout_even_<?php echo esc_attr( $post->ID ); ?> h2.wtl-date-top, .post_even .wtl_layout_even_<?php echo esc_attr( $post->ID ); ?> h2.wtl-date-top a {color: <?php echo esc_attr( $wtl_content_color ); ?>;border-color: <?php echo esc_attr( $wtl_content_color ); ?>;}
				<?php } ?>
				.wtl_layout_odd_<?php echo esc_attr( $post->ID ); ?>:before{  border-color: transparent <?php echo esc_attr( $title_color ); ?> transparent transparent !important}
				.wtl_layout_even_<?php echo esc_attr( $post->ID ); ?>:before{  border-color: transparent transparent transparent <?php echo esc_attr( $title_color ); ?> !important}
				<?php
			}
			?>
			.post_odd .wtl_dateeicon_<?php echo esc_attr( $post->ID ); ?> .wtl-post-date span,
			.post_odd .wtl_dateeicon_<?php echo esc_attr( $post->ID ); ?> .wtl-post-date a,
			.post_even .wtl_dateeicon_<?php echo esc_attr( $post->ID ); ?> .wtl-post-date span,
			.post_even .wtl_dateeicon_<?php echo esc_attr( $post->ID ); ?> .wtl-post-date a
			{color:<?php echo esc_attr( $title_color ); ?> !important}
			<?php
			if ( 2 == $timeline_style_type ) {
				?>
				   #wtl_layout_<?php echo esc_attr( $post->ID ); ?>{
					border-color:<?php echo esc_attr( $title_color ); ?> !important;
				}
				<?php
			}
			if ( 3 == $timeline_style_type ) {
				?>
				.wtl_dateeicon_<?php echo esc_attr( $post->ID ); ?> .wtl-post-center-image:before{ background:<?php echo esc_attr( $title_color ); ?> !important;  }
				<?php
			}
			if ( ( 4 == $timeline_style_type || 5 == $timeline_style_type ) && ! empty( $title_color ) ) {
				?>
				#wtl_layout_<?php echo esc_attr( $post->ID ); ?> .wtl-post-title{
					background: none !important;
				}
				#wtl_layout_<?php echo esc_attr( $post->ID ); ?> .wtl-post-title a {
					color:<?php echo esc_attr( $wtl_content_color ); ?> !important;
				}
				.wtl-schedule-post-content .wtl_dateeicon_<?php echo esc_attr( $post->ID ); ?> .wtl-post-center-image span i:before,
				.wtl-schedule-post-content .wtl_dateeicon_<?php echo esc_attr( $post->ID ); ?> .wtl-post-center-image span i,
				.wtl-schedule-post-content #wtl_layout_<?php echo esc_attr( $post->ID ); ?> .wtl-post-date, .wtl-schedule-post-content #wtl_layout_<?php echo esc_attr( $post->ID ); ?> .wtl-post-date a {
					color:<?php echo esc_attr( $wtl_content_color ); ?> !important;
				}
				<?php
			}
			if ( 'minima' === $timeline_style_view ) {
				?>
				.wtl-post-content h2.wtl-post-title{
					background: none !important;
				}
				<?php
			}
		}
		?>
	</style>
	<?php
	if ( 'minima' === $timeline_style_view ) {
		echo '<div class="blankdiv"></div>';
	}
	?>
	<div class="wtl-schedule-post-content <?php echo 'post_' . esc_attr( Wtl_Template_Advanced_Layout::even_odd( $i ) ); ?>">
		<?php
		if ( 'minima' !== $timeline_style_view ) {
			?>
		<div id="wtl_date_<?php echo esc_attr( get_the_time( 'd' ) ); ?>_<?php echo esc_attr( get_the_time( 'm' ) ); ?>" class="wtl_year wtl_year_<?php echo esc_attr( get_the_time( 'Y' ) ); ?>" data-post-year="<?php echo esc_attr( get_the_time( 'Y' ) ); ?>">
			<a href="<?php echo esc_url( get_year_link( get_the_time( 'Y' ) ) ); ?>"><span><?php echo esc_html( get_the_time( 'Y' ) ); ?></span></a>
		</div>
			<?php
		}
		?>

		<div class="wtl_dateeicon wtl_dateeicon_<?php echo esc_attr( $post->ID ); ?>">
		<?php
		if ( 'minima' !== $timeline_style_view ) {
			if ( 5 != $timeline_style_type ) {
				echo wp_kses( Wtl_Template_Advanced_Layout::get_post_date( $wtl_settings, false ), Wp_Timeline_Public::args_kses() );
			}
		}

		Wtl_Template_Advanced_Layout::get_timeline_icon( $wtl_settings );
		?>
		</div>

		<div data-aos="<?php echo esc_attr( $wtl_animation ); ?>" id="wtl_layout_<?php echo esc_attr( $post->ID ); ?>" class="wtl_layout_<?php echo esc_attr( Wtl_Template_Advanced_Layout::even_odd( $i ) ); ?>_<?php echo esc_attr( $post->ID ); ?> wtl-schedule-all-post-content wtl_post_content_schedule aos-init aos-animate" <?php echo esc_attr( Wtl_Template_Advanced_Layout::content_box_background_color( $wtl_settings ) ); ?>>
			<?php
			if ( 2 != $timeline_style_type ) {

				if ( 'minima' !== $timeline_style_view ) {
					if ( 5 != $timeline_style_type ) {
						Wtl_Template_Config::get_title( $wtl_settings );
					}
				} else {
					if ( 'minima' === $timeline_style_view ) {
						if ( 5 != $timeline_style_type ) {
								echo '<h2 class="wtl-post-title wtl-date-title">';
								echo wp_kses( Wtl_Template_Config::get_post_date( $wtl_settings, false ), Wp_Timeline_Public::args_kses() );
								echo '</h2>';
						}
					}
				}
			}
			if ( 5 != $timeline_style_type ) {
				Wtl_Template_Config::get_post_image( $wtl_settings );
			}
			?>
			<div class="wtl-post-content" <?php echo esc_attr( $post_content_color_set ); ?>>
				<?php
				do_action( 'wtl_before_post_content' );
				if ( 5 == $timeline_style_type ) {
					echo wp_kses( Wtl_Template_Advanced_Layout::get_post_date( $wtl_settings, false ), Wp_Timeline_Public::args_kses() );
					Wtl_Template_Config::get_post_image( $wtl_settings );
					Wtl_Template_Config::get_title( $wtl_settings );
				}
				if ( 2 == $timeline_style_type && 'minima' === $timeline_style_view ) {
					echo '<h2 class="wtl-date-top">' . wp_kses( Wtl_Template_Config::get_post_date( $wtl_settings, false ), Wp_Timeline_Public::args_kses() ) . '</h2>';
				}
				if ( 2 == $timeline_style_type || 'minima' === $timeline_style_view ) {
					if ( 5 != $timeline_style_type ) {
						Wtl_Template_Config::get_title( $wtl_settings );
					}
				}
				Wtl_Template_Config::get_content( $wtl_settings );
				Wtl_Template_Config::get_read_more_link( $wtl_settings );
				Wtl_Template_Config::get_read_more_link_2( $wtl_settings );
				Wtl_Template_Config::display_popup_excerpt( $wtl_settings );
				do_action( 'wtl_after_post_content' );
				?>
			</div>        
			<?php
			// if ( Wtl_Template_Advanced_Layout::get_category( $wtl_settings ) || Wtl_Template_Advanced_Layout::get_tags( $wtl_settings ) || Wtl_Template_Advanced_Layout::social_icon( $wtl_settings ) ) {.
			?>
				<div class="wtl-post-footer">
					<?php
					Wtl_Template_Config::get_author( $wtl_settings );
					Wtl_Template_Config::get_comment( $wtl_settings );
					Wtl_Template_Config::get_post_details( $wtl_settings );
					echo wp_kses( Wtl_Template_Config::get_category( $wtl_settings, true, true ), Wp_Timeline_Public::args_kses() );
					echo wp_kses( Wtl_Template_Config::get_tags( $wtl_settings, true, true ), Wp_Timeline_Public::args_kses() );
					echo wp_kses( Wtl_Template_Advanced_Layout::social_icon( $wtl_settings ), Wp_Timeline_Public::args_kses() );
					?>
				</div>
				<?php
				// }
				?>
		</div>
	</div>
	<?php
}
$i++;
do_action( 'wtl_separator_after_post' );
