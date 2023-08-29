<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/wp_timeline_templates/blog/wise-layout.php.
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
$col_class = wp_timeline_column_class( $wtl_settings );
$col_class = $col_class;

$format      = get_post_format( $post->ID );
$post_format = '';
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

$class_name = 'two_column blog_template wtl_blog_template wise_block_blog';
if ( '' != $col_class ) {
	$class_name .= ' ' . $col_class;
}
$image_hover_effect = '';
if ( isset( $wtl_settings['wp_timeline_image_hover_effect'] ) && 1 == $wtl_settings['wp_timeline_image_hover_effect'] ) {
	$image_hover_effect = ( isset( $wtl_settings['wp_timeline_image_hover_effect_type'] ) && '' != $wtl_settings['wp_timeline_image_hover_effect_type'] ) ? $wtl_settings['wp_timeline_image_hover_effect_type'] : '';
}
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
$wtl_all_post_type = array( 'product', 'download' );

$layout_type   = $wtl_settings['layout_type'];
$wtl_animation = isset( $wtl_settings['timeline_animation'] ) ? $wtl_settings['timeline_animation'] : 'fade';

?>
<div id="wtl_date_<?php echo esc_attr( get_the_time( 'd' ) ); ?>_<?php echo esc_attr( get_the_time( 'm' ) ); ?>" class="<?php echo esc_attr( $class_name ); ?> wtl_blog_single_post_wrapp <?php echo esc_attr( $category ); ?>" 
	<?php
	if ( 1 != $layout_type ) {
		?>
		data-aos="<?php echo esc_attr( $wtl_animation ); ?>"
		<?php
	}
	?>
	>
	<?php do_action( 'wtl_before_post_content' ); ?>
	<div class="wtl_blog_wraper">
		<div class="quote-icon bdp-mb-15">
			<i class="<?php echo esc_attr( $post_format ); ?>"></i>
		</div>
		<?php
		if ( 'post' === $wtl_settings['custom_post_type'] ) {
			if ( isset( $wtl_settings['display_category'] ) && 1 == $wtl_settings['display_category'] ) {
				$categories_list = get_the_category_list( ' , ' );
				$categories_link = ( isset( $wtl_settings['disable_link_category'] ) && 1 == $wtl_settings['disable_link_category'] ) ? true : false;
				?>
				<span class="post-category bdp-mb-15 <?php echo ( $categories_link ) ? 'wtl-no-link' : 'wtl-has-links'; ?>">
					<?php
					if ( $categories_link ) {
						$categories_list = wp_strip_all_tags( $categories_list );
					}
					if ( $categories_list ) :
						echo wp_kses( $categories_list, Wp_Timeline_Public::args_kses() );
						$show_sep = true;
					endif;
					?>
				</span>
				<?php
			}
		} elseif ( isset( $wtl_settings['custom_post_type'] ) && in_array( $wtl_settings['custom_post_type'], $wtl_all_post_type, true ) ) {
			$wtl_tax_cat = '';
			if ( 'product' === $wtl_settings['custom_post_type'] ) {
				$wtl_tax_cat = 'product_cat';
			} elseif ( 'download' === $wtl_settings['custom_post_type'] ) {
				$wtl_tax_cat = 'download_category';
			}
			if ( '' != $wtl_tax_cat && isset( $wtl_settings[ 'display_taxonomy_' . $wtl_tax_cat ] ) && 1 == $wtl_settings[ 'display_taxonomy_' . $wtl_tax_cat ] ) {
				$categories_link    = ( isset( $wtl_settings[ 'disable_link_taxonomy_' . $wtl_tax_cat ] ) && 1 == $wtl_settings[ 'disable_link_taxonomy_' . $wtl_tax_cat ] ) ? false : true;
				$product_categories = wp_get_post_terms( $post->ID, $wtl_tax_cat, array( 'hide_empty' => 'false' ) );
				$sep                = 1;
				?>
				<span class="post-category bdp-mb-15 <?php echo ( $categories_link ) ? ' wtl-no-link' : 'wtl-has-links'; ?>">
					<?php
					foreach ( $product_categories as $category ) {
						if ( 1 != $sep ) {
							?>
							<span class="seperater"><?php echo ', '; ?></span>
							<?php
						}
						echo ( $categories_link ) ? '<a href="' . esc_url( get_term_link( $category->term_id ) ) . '">' : '';
						echo esc_html( $category->name );
						echo ( $categories_link ) ? '</a>' : '';
						$sep++;
					}
					?>
				</span>
				<?php
			}
		}
		?>
		<div class="image_wrapper">
			<?php
			Wtl_Template_Config::get_post_image( $wtl_settings );
			?>
		</div>
		<?php
		Wtl_Template_Config::get_title( $wtl_settings );
		if ( isset( $wtl_settings['custom_post_type'] ) && 'product' === $wtl_settings['custom_post_type'] ) {
			do_action( 'wtl_woocommerce_product_details_function', $wtl_settings, $post->ID );
		}
		if ( isset( $wtl_settings['custom_post_type'] ) && 'download' === $wtl_settings['custom_post_type'] ) {
			do_action( 'wtl_easy_digital_download_product_details_function', $wtl_settings, $post->ID );
		}
		if ( isset( $wtl_settings['custom_post_type'] ) && 'download' === $wtl_settings['custom_post_type'] ) {
			do_action( 'wtl_edd_product_details', $wtl_settings, $post->ID );
		}
		?>
		<div class="wtl-post-content bdp-mb-15">
			<?php
			echo wp_kses( Wp_Timeline_Main::wtl_get_content( $post->ID, $wtl_settings, $wtl_settings['rss_use_excerpt'], $wtl_settings['txtExcerptlength'] ), Wp_Timeline_Public::args_kses() );
			Wtl_Template_Config::get_read_more_link( $wtl_settings );
			Wtl_Template_Config::get_read_more_link_2( $wtl_settings );
			Wtl_Template_Config::display_popup_excerpt( $wtl_settings );
			if ( 'download' !== $wtl_settings['custom_post_type'] ) {
				Wtl_Template_Config::get_post_details( $wtl_settings );
			}
			?>
		</div>
		<ul class="metadatabox bdp-mb-15">
			<?php
			$display_postlike = isset( $wtl_settings['display_postlike'] ) ? $wtl_settings['display_postlike'] : 1;
			if ( 0 == $display_postlike ) {
				$comment_class = 'comment_text_center';
			} else {
				$comment_class = '';
			}
			$display_comment_count = $wtl_settings['display_comment_count'];
			if ( 1 == $display_comment_count ) {
				?>
			<li class="metacomments <?php echo esc_attr( $comment_class ); ?>">
				<span><i class="fas fa-comment"></i></span>
				<span>
					<?php
					if ( isset( $wtl_settings['disable_link_comment'] ) && 1 == $wtl_settings['disable_link_comment'] ) {
						comments_number( esc_html__( 'Leave a Comment', 'wp-timeline-designer-pro' ), 1, '%' );
					} else {
						comments_popup_link( esc_html__( 'Leave a Comment', 'wp-timeline-designer-pro' ), esc_html__( '1 comment', 'wp-timeline-designer-pro' ), '% ' . esc_html__( 'comments', 'wp-timeline-designer-pro' ), 'comments-link', esc_html__( 'Comments are off', 'wp-timeline-designer-pro' ) );
					}
					?>
				</span>
			</li>
				<?php
			}
			if ( 0 == $display_comment_count ) {
				$like_class = 'like_text_center';
			} else {
				$like_class = '';
			}
			if ( isset( $wtl_settings['display_postlike'] ) && 1 == $wtl_settings['display_postlike'] ) {
				echo '<li class="' . esc_attr( $like_class ) . '">' . do_shortcode( '[likebtn_shortcode]' ) . '</li>';
			}
			?>
		</ul>
		<?php $display_author = isset( $wtl_settings['display_author'] ) ? $wtl_settings['display_author'] : 1; ?>
		<div class="wtl-wise-block-author 
		<?php
		if ( 1 == $display_author ) {
			?>
			display_author_block bdp-mb-15 
			<?php
		} else {
			?>
			hide_author_block <?php } ?>">
			<?php if ( 1 == $display_author ) { ?>
				<div class="wise-block-avtar">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
				</div>
			<?php } ?>
			<div class="postmetabox 
			<?php
			if ( 1 == $display_author ) {
				?>
				display_author_block  
				<?php
			} else {
				?>
				hide_author_block <?php } ?>">
				<?php
				if ( 1 == $display_author ) {
					$author_link  = ( isset( $wtl_settings['disable_link_author'] ) && 1 == $wtl_settings['disable_link_author'] ) ? false : true;
					$author_class = ( $author_link ) ? 'wtl_has_links' : 'wtl_no_links';
					echo '<p><span class="post-author ' . esc_attr( $author_class ) . '">';
					echo wp_kses( Wp_Timeline_Main::wtl_get_post_auhtors( $post->ID, $wtl_settings ), Wp_Timeline_Public::args_kses() );
					echo '</span></p>';
				}
				$display_date = isset( $wtl_settings['display_date'] ) ? $wtl_settings['display_date'] : 1;
				if ( 1 == $display_date ) {
					$date_link   = ( isset( $wtl_settings['disable_link_date'] ) && 1 == $wtl_settings['disable_link_date'] ) ? false : true;
					$date_format = ( isset( $wtl_settings['post_date_format'] ) && 'default' !== $wtl_settings['post_date_format'] ) ? $wtl_settings['post_date_format'] : get_option( 'date_format' );
					$wtl_date    = ( isset( $wtl_settings['display_date_from'] ) && 'modify' === $wtl_settings['display_date_from'] ) ? apply_filters( 'wtl_date_format', get_post_modified_time( $date_format, $post->ID ), $post->ID ) : apply_filters( 'wtl_date_format', get_the_time( $date_format, $post->ID ), $post->ID );
					$ar_year     = get_the_time( 'Y' );
					$ar_month    = get_the_time( 'm' );
					$ar_day      = get_the_time( 'd' );
					$date_class  = ( $date_link ) ? 'wtl_has_links' : 'wtl_no_links';
					echo '<p><span class="post-date ' . esc_attr( $date_class ) . '">';
					echo ( $date_link ) ? '<a class="mdate" href="' . esc_url( get_day_link( $ar_year, $ar_month, $ar_day ) ) . '">' : '';
					echo esc_html( $wtl_date );
					echo ( $date_link ) ? '</a>' : '';
					echo '</span></p>';
				}

				?>
			</div>
		</div>
		<?php
		Wtl_Template_Config::get_category( $wtl_settings, true, true );
		Wtl_Template_Config::get_tags( $wtl_settings, true, true );
		Wp_Timeline_Main::wtl_get_social_icons( $wtl_settings );
		?>
	</div>
	<?php do_action( 'wtl_after_post_content' ); ?>
</div>
<?php
do_action( 'wtl_separator_after_post' );
