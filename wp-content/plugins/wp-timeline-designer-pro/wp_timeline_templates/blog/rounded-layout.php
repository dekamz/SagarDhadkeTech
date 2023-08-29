<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/wp_timeline_templates/blog/easy-layout.php.
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
if ( 1 == $layout_type ) {
	/* Horizental Layout */
	?>
	<div class="wtl_blog_single_post_wrapp <?php echo wp_kses( Wtl_Template_Config::get_class_category( $wtl_settings ), Wp_Timeline_Public::args_kses() ); ?>">
		<?php
		$defalt_icon = Wtl_Template_Easy_Layout::get_default_icon( $wtl_settings );
		if ( $defalt_icon ) {
			$dicon = $defalt_icon;
		} else {
			$dicon = '';
		}
		$wtl_icon     = Wtl_Template_Config::get_timeline_icon();
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
				echo '<div class="wtl_steps_post_format">' . wp_kses( $dicon, $allowed_html ) . '</div>';
			} else {
				echo '<div class="wtl_steps_post_format"><i class="' . esc_attr( $post_format ) . '"></i></div>';
			}
		}
		$ar_year = get_the_time( 'Y' );
		// No need this code for now may be use later echo '<span class="wtl_steps_post_year"> ' . esc_html( $ar_year ) . ' </span>';.
		$label_featured_post = ( isset( $wtl_settings['label_featured_post'] ) && '' != $wtl_settings['label_featured_post'] ) ? $wtl_settings['label_featured_post'] : '';
		if ( '' != $label_featured_post && is_sticky() ) {
			?>
			<div class="label_featured_post"><span><?php echo esc_html( $label_featured_post ); ?></span></div> 
			<?php
		}
		echo wp_kses( Wtl_Template_Config::get_post_date( $wtl_settings, true ), Wp_Timeline_Public::args_kses() );
		?>
		<div class="wtl_cover_layout_inner">
			<div class="wtl_cover_layout_inner_deep">
				<div class="wtl_clid_left">
					<?php
					Wtl_Template_Config::get_post_image( $wtl_settings );
					Wtl_Template_Config::get_social_media( $wtl_settings );
					?>
				</div>
				<div class="wtl_clid_right">
					<?php
					Wtl_Template_Config::get_category( $wtl_settings, true, true );
					Wtl_Template_Config::get_title( $wtl_settings );
					if ( 1 == $wtl_settings['display_author'] || 1 == $wtl_settings['display_comment_count'] ) {
						?>
						<div class="wtl-post-meta">
							<?php
							Wtl_Template_Easy_Layout::get_author( $wtl_settings );
							if ( 1 == $wtl_settings['display_comment_count'] ) {
								echo '&nbsp;-&nbsp;' . wp_kses( Wtl_Template_Config::comment_count( $wtl_settings ), $allowed_html );
							}
							?>
						</div>
						<?php
					}
					?>
					<div class="wtl-post-content" <?php echo esc_attr( $post_content_color_set ); ?>>
						<?php
						do_action( 'wtl_before_post_content' );
						if ( isset( $wtl_settings['custom_post_type'] ) && 'download' === $wtl_settings['custom_post_type'] ) {
							do_action( 'wtl_easy_digital_download_product_details_function', $wtl_settings, $post->ID );
						}
						if ( isset( $wtl_settings['custom_post_type'] ) && 'download' === $wtl_settings['custom_post_type'] ) {
							do_action( 'wtl_edd_product_details', $wtl_settings, $post->ID );
						}
						Wtl_Template_Config::get_content( $wtl_settings );
						Wtl_Template_Config::get_read_more_link( $wtl_settings );
						Wtl_Template_Config::get_read_more_link_2( $wtl_settings );
						Wtl_Template_Config::display_popup_excerpt( $wtl_settings );
						if ( 'download' !== $wtl_settings['custom_post_type'] ) {
							Wtl_Template_Config::get_post_details( $wtl_settings );
						}
						do_action( 'wtl_after_post_content' );
						?>
					</div>
					<?php Wtl_Template_Config::get_tags( $wtl_settings, false, false ); ?>				
				</div>
			</div>
		</div>
	</div>
	<?php
} else {
	/* Vertical Layout */
	?>
	<div id="wtl_date_<?php echo esc_attr( get_the_time( 'd' ) ); ?>_<?php echo esc_attr( get_the_time( 'm' ) ); ?>"  data-aos="<?php echo esc_attr( $wtl_animation ); ?>" class="wtl_blog_single_post_wrapp <?php echo esc_attr( Wtl_Template_Config::get_class_category( $wtl_settings ) ); ?>">
		<?php
		$defalt_icon = Wtl_Template_Easy_Layout::get_default_icon( $wtl_settings );
		if ( $defalt_icon ) {
			$dicon = $defalt_icon;
		} else {
			$dicon = '';
		}
		$wtl_icon     = Wtl_Template_Config::get_timeline_icon();
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
				echo '<div class="wtl_steps_post_format">' . wp_kses( $dicon, $allowed_html ) . '</div>';
			} else {
				echo '<div class="wtl_steps_post_format"><i class="' . esc_attr( $post_format ) . '"></i></div>';
			}
		}
		$ar_year = get_the_time( 'Y' );
		echo '<span class="wtl_steps_post_year"> ' . esc_html( $ar_year ) . ' </span>';
		$label_featured_post = ( isset( $wtl_settings['label_featured_post'] ) && '' != $wtl_settings['label_featured_post'] ) ? $wtl_settings['label_featured_post'] : '';
		if ( '' != $label_featured_post && is_sticky() ) {
			?>
			<div class="label_featured_post"><span><?php echo esc_html( $label_featured_post ); ?></span></div> 
			<?php
		}
		echo wp_kses( Wtl_Template_Config::get_post_date( $wtl_settings, true ), Wp_Timeline_Public::args_kses() );
		?>
		<div class="wtl_cover_layout_inner">
			<div class="wtl_cover_layout_inner_deep">
				<div class="wtl_clid_left">
					<?php
					Wtl_Template_Config::get_post_image( $wtl_settings );
					Wtl_Template_Config::get_social_media( $wtl_settings );
					?>
				</div>
				<div class="wtl_clid_right">
					<?php
					Wtl_Template_Config::get_category( $wtl_settings, true, true );
					Wtl_Template_Config::get_title( $wtl_settings );
					if ( 1 == $wtl_settings['display_author'] || 1 == $wtl_settings['display_comment_count'] ) {
						?>
						<div class="wtl-post-meta">
							<?php
							Wtl_Template_Easy_Layout::get_author( $wtl_settings );
							if ( 1 == $wtl_settings['display_comment_count'] ) {
								echo '&nbsp;-&nbsp;' . wp_kses( Wtl_Template_Config::comment_count( $wtl_settings ), $allowed_html );
							}
							?>
						</div>
						<?php
					}
					?>
					<div class="wtl-post-content" <?php echo esc_attr( $post_content_color_set ); ?>>
						<?php
						do_action( 'wtl_before_post_content' );
						if ( isset( $wtl_settings['custom_post_type'] ) && 'download' === $wtl_settings['custom_post_type'] ) {
							do_action( 'wtl_easy_digital_download_product_details_function', $wtl_settings, $post->ID );
						}
						if ( isset( $wtl_settings['custom_post_type'] ) && 'download' === $wtl_settings['custom_post_type'] ) {
							do_action( 'wtl_edd_product_details', $wtl_settings, $post->ID );
						}
						Wtl_Template_Config::get_content( $wtl_settings );
						Wtl_Template_Config::get_read_more_link( $wtl_settings );
						Wtl_Template_Config::get_read_more_link_2( $wtl_settings );
						Wtl_Template_Config::display_popup_excerpt( $wtl_settings );
						if ( 'download' !== $wtl_settings['custom_post_type'] ) {
							Wtl_Template_Config::get_post_details( $wtl_settings );
						}
						do_action( 'wtl_after_post_content' );
						?>
					</div>
					<?php Wtl_Template_Config::get_tags( $wtl_settings, false, false ); ?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
do_action( 'wtl_separator_after_post' );
