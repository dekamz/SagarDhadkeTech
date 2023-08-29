<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/wp_timeline_templates/blog/filledtimeline-layout.php.
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
$wtl_animation = isset( $wtl_settings['timeline_animation'] ) ? $wtl_settings['timeline_animation'] : 'fade';
$format        = get_post_format( $post->ID );
$i             = $count;
$post_format   = '';
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
$post_content_color_set = isset( $wtl_details['wtl_content_color'] ) ? ' style="color:' . $wtl_details['wtl_content_color'] . ';" ' : '';
$layout_type            = $wtl_settings['layout_type'];

/* Horizontal Only */
if ( 1 == $layout_type ) {
	?>
	<div class="wtl-schedule-post-content <?php echo 'post_' . esc_attr( Wtl_Template_Filledtimeline_Layout::even_odd( $i ) ); ?>" data-aos="<?php echo esc_attr( $wtl_animation ); ?>">
		<?php
			$label_featured_post = ( isset( $wtl_settings['label_featured_post'] ) && '' != $wtl_settings['label_featured_post'] ) ? $wtl_settings['label_featured_post'] : '';
		if ( '' != $label_featured_post && is_sticky() ) {
			?>
				<div class="label_featured_post"><span><?php echo esc_html( $label_featured_post ); ?></span></div> 
				<?php
		}
		?>
			<div class="wtl-schedule-all-post-content wtl_post_content_schedule">
				<?php
				echo wp_kses( Wtl_Template_Filledtimeline_Layout::get_post_date( $wtl_settings, true ), Wp_Timeline_Public::args_kses() );
				Wtl_Template_Config::get_title( $wtl_settings );
				?>
				<?php $wp_timeline_enable_media = isset( $wtl_settings['wp_timeline_enable_media'] ) ? $wtl_settings['wp_timeline_enable_media'] : '1'; ?>
				<?php if ( 1 == $wp_timeline_enable_media ) { ?>
					<?php
					$post_thumbnail = 'full';
					$thumbnail      = Wp_Timeline_Main::wtl_get_the_thumbnail( $wtl_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID );
					if ( isset( $thumbnail ) && ! empty( $thumbnail ) ) {
						echo '<div class="schedule-image-wrapper wtl-post-thumbnail">';
						if ( Wp_Timeline_Main::wtl_get_first_embed_media( $post->ID, $wtl_settings ) && 1 == $wtl_settings['rss_use_excerpt'] ) {
							echo '<div class="wp-timeline-post-image post-video wp-timeline-video">';
							if ( 'quote' === get_post_format() ) {
								if ( has_post_thumbnail() ) {
									$post_thumbnail = 'full';
									$thumbnail      = Wp_Timeline_Main::wtl_get_the_thumbnail( $wtl_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID );
									echo wp_kses( apply_filters( 'wp_timeline_post_thumbnail_filter', $thumbnail, $post->ID ), Wp_Timeline_Public::args_kses() );
									echo '<div class="upper_image_wrapper">';
									echo wp_kses( Wp_Timeline_Main::wtl_get_first_embed_media( $post->ID, $wtl_settings ), Wp_Timeline_Public::args_kses() );
									echo '</div>';
								}
							} elseif ( 'link' === get_post_format() ) {
								if ( has_post_thumbnail() ) {
									$post_thumbnail = 'full';
									$thumbnail      = Wp_Timeline_Main::wtl_get_the_thumbnail( $wtl_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID );
									echo wp_kses( apply_filters( 'wp_timeline_post_thumbnail_filter', $thumbnail, $post->ID ), Wp_Timeline_Public::args_kses() );
									echo '<div class="upper_image_wrapper wp_timeline_link_post_format">';
									echo wp_kses( Wp_Timeline_Main::wtl_get_first_embed_media( $post->ID, $wtl_settings ), Wp_Timeline_Public::args_kses() );
									echo '</div>';
								}
							} else {
								echo wp_kses( Wp_Timeline_Main::wtl_get_first_embed_media( $post->ID, $wtl_settings ), Wp_Timeline_Public::args_kses() );
							}
							echo '</div>';
						} else {
							$wtl_post_image_link = ( isset( $wtl_settings['wp_timeline_post_image_link'] ) && 0 == $wtl_settings['wp_timeline_post_image_link'] ) ? false : true;
							$image_hover_effect  = '';
							if ( isset( $wtl_settings['wp_timeline_image_hover_effect'] ) && 1 == $wtl_settings['wp_timeline_image_hover_effect'] ) {
								$image_hover_effect = ( isset( $wtl_settings['wp_timeline_image_hover_effect_type'] ) && '' != $wtl_settings['wp_timeline_image_hover_effect_type'] ) ? $wtl_settings['wp_timeline_image_hover_effect_type'] : '';
							}
							echo '<figure class="' . esc_attr( $image_hover_effect ) . '">';
							echo ( $wtl_post_image_link ) ? '<a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="deport-img-link">' : '';
							echo wp_kses( apply_filters( 'wp_timeline_post_thumbnail_filter', $thumbnail, $post->ID ), Wp_Timeline_Public::args_kses() );
							echo ( $wtl_post_image_link ) ? '</a>' : '';
							if ( isset( $wtl_settings['social_share'] ) && 1 == $wtl_settings['social_share'] && isset( $wtl_settings['pinterest_image_share'] ) && 1 == $wtl_settings['pinterest_image_share'] ) {
								echo wp_kses( Wp_Timeline_Main::wp_timeline_pinterest( $post->ID ), Wp_Timeline_Public::args_kses() );
							}
							if ( class_exists( 'woocommerce' ) && 'product' === $wtl_settings['custom_post_type'] ) {
								if ( isset( $wtl_settings['display_sale_tag'] ) && 1 == $wtl_settings['display_sale_tag'] ) {
									$wtl_sale_tagtext_alignment = ( isset( $wtl_settings['wp_timeline_sale_tagtext_alignment'] ) && '' != $wtl_settings['wp_timeline_sale_tagtext_alignment'] ) ? $wtl_settings['wp_timeline_sale_tagtext_alignment'] : 'left-top';
									echo '<div class="wtl_woo_sale_wrap ' . esc_attr( $wtl_sale_tagtext_alignment ) . '">';
									do_action( 'wtl_woo_sale_tag' );
									echo '</div>';
								}
							}
							echo '</figure>';
						}
						echo '</div>';
					}
				}
				Wtl_Template_Config::get_post_details( $wtl_settings );
				?>
					<div class="wtl-post-content">
						<?php
						Wtl_Template_Config::get_content( $wtl_settings );
						Wtl_Template_Config::get_read_more_link( $wtl_settings );
						Wtl_Template_Config::get_read_more_link_2( $wtl_settings );
						Wtl_Template_Config::display_popup_excerpt( $wtl_settings );
						?>
					</div>
					<div class="wtl-meta-content">
						<?php
						Wtl_Template_Config::get_author( $wtl_settings );
						Wtl_Template_Config::get_comment( $wtl_settings );
						if ( isset( $wtl_settings['display_postlike'] ) && 1 == $wtl_settings['display_postlike'] ) {

							echo do_shortcode( '[likebtn_shortcode]' );
						}

						Wtl_Template_Config::get_category( $wtl_settings, true, true );
						Wtl_Template_Config::get_tags( $wtl_settings, true, true );
						Wtl_Template_Config::get_social_media( $wtl_settings );
						?>
					</div>
			</div>
	</div>
	<?php
} else {
	$color_array = array( 'white', 'green', 'yellow' );
	$class       = $color_array[ $i % 3 ];
	?>
	<div id="wtl_date_<?php echo esc_attr( get_the_time( 'd' ) ); ?>_<?php echo esc_attr( get_the_time( 'm' ) ); ?>" class="wtl-schedule-post-content <?php echo 'post_' . esc_attr( Wtl_Template_Filledtimeline_Layout::even_odd( $i ) ); ?>" data-aos="<?php echo esc_attr( $wtl_animation ); ?>" data-stem-color="<?php echo esc_attr( $class ); ?>">
		<?php
		$defalt_icon = Wtl_Template_Filledtimeline_Layout::get_default_icon( $wtl_settings );
		if ( $defalt_icon ) {
			$dicon = $defalt_icon;
		} else {
			$dicon = '';
		}
		$wtl_icon     = Wtl_Template_Filledtimeline_Layout::get_timeline_icon();
		$allowed_html = array(
			'div' => array(
				'class' => array(),
				'title' => array(),
			),
			'img' => array(
				'src' => array(),
			),
			'i'   => array(
				'class' => array(),
			),
		);
		if ( $wtl_icon ) {
			echo wp_kses( $wtl_icon, $allowed_html );
		} else {
			if ( $dicon ) {
				echo '<div class="wtl-post-center-image"> <div class="stem-wrappericon " data-stem-color="">' . wp_kses( $dicon, $allowed_html ) . '</div></div>';
			} else {
				echo '<div class="wtl-post-center-image ' . esc_attr( $post_format ) . '"></div>';
			}
		}
		$label_featured_post = ( isset( $wtl_settings['label_featured_post'] ) && '' != $wtl_settings['label_featured_post'] ) ? $wtl_settings['label_featured_post'] : '';
		if ( '' != $label_featured_post && is_sticky() ) {
			?>
			<div class="label_featured_post"><span><?php echo esc_html( $label_featured_post ); ?></span></div> 
			<?php
		}
		?>
		<div class="wtl-schedule-all-post-content wtl_post_content_schedule">
			<?php
			Wtl_Template_Filledtimeline_Layout::get_post_date( $wtl_settings, true );
			Wtl_Template_Config::get_title( $wtl_settings );
			Wtl_Template_Config::get_post_image( $wtl_settings );
			Wtl_Template_Config::get_post_details( $wtl_settings );
			?>
			<div class="wtl-post-content" <?php echo esc_attr( $post_content_color_set ); ?>>
				<?php
				do_action( 'wtl_before_post_content' );
				Wtl_Template_Config::get_content( $wtl_settings );
				Wtl_Template_Config::get_read_more_link( $wtl_settings );
				Wtl_Template_Config::get_read_more_link_2( $wtl_settings );
				Wtl_Template_Config::display_popup_excerpt( $wtl_settings );
				do_action( 'wtl_after_post_content' );
				?>
			</div>
			<div class="wtl-post-meta">
				<?php
				Wtl_Template_Filledtimeline_Layout::get_author( $wtl_settings );
				Wtl_Template_Config::get_comment( $wtl_settings );
				if ( isset( $wtl_settings['display_postlike'] ) && 1 == $wtl_settings['display_postlike'] ) {

					echo do_shortcode( '[likebtn_shortcode]' );
				}

				Wtl_Template_Config::get_category( $wtl_settings, true, true );
				Wtl_Template_Config::get_tags( $wtl_settings, true, true );
				Wtl_Template_Config::get_social_media( $wtl_settings );
				?>
			</div>
		</div>    
	</div>
	<?php
}

do_action( 'wtl_separator_after_post' );
