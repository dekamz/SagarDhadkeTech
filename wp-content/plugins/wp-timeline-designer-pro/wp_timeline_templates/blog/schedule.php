<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/wp_timeline_templates/blog/schedule.php.
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
$wtl_all_post_type = array( 'product', 'download', 'post' );
$wtl_animation     = isset( $wtl_settings['timeline_animation'] ) ? $wtl_settings['timeline_animation'] : 'fade';
?>
<div id="wtl_date_<?php echo esc_attr( get_the_time( 'd' ) ); ?>_<?php echo esc_attr( get_the_time( 'm' ) ); ?>" class="wtl_blog_template blog_template schedule wtl_single_post_wrapp <?php echo esc_attr( Wtl_Template_Config::get_class_category( $wtl_settings ) ); ?>">
	<?php do_action( 'wtl_before_post_content' ); ?>
	<div class="wtl-schedule-wrap">
		<div class="wtl-schedule-meta-content" data-aos="<?php echo esc_attr( $wtl_animation ); ?>">
			<?php
			if ( isset( $wtl_settings['display_date'] ) && 1 == $wtl_settings['display_date'] ) {
				$date_link        = ( isset( $wtl_settings['disable_link_date'] ) && 1 == $wtl_settings['disable_link_date'] ) ? false : true;
				$date_format      = ( isset( $wtl_settings['post_date_format'] ) && 'default' !== $wtl_settings['post_date_format'] ) ? $wtl_settings['post_date_format'] : get_option( 'date_format' );
				$wp_timeline_date = ( isset( $wtl_settings['display_date_from'] ) && 'modify' === $wtl_settings['display_date_from'] ) ? apply_filters( 'wtl_date_format', get_post_modified_time( $date_format, $post->ID ), $post->ID ) : apply_filters( 'wtl_date_format', get_the_time( $date_format, $post->ID ), $post->ID );
				$ar_year          = get_the_time( 'Y' );
				$ar_month         = get_the_time( 'm' );
				$ar_day           = get_the_time( 'd' );
				echo '<div class="wtl-post-date">';
				echo ( $date_link ) ? '<a class="mdate" href="' . esc_url( get_day_link( $ar_year, $ar_month, $ar_day ) ) . '">' : '';
				echo esc_html( $wp_timeline_date );
				echo ( $date_link ) ? '</a>' : '';
				echo '</div>';
			}
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
			}
			?>
			<div class="tag-with-social">
				<?php
				if ( isset( $wtl_settings[ 'display_' . $wtl_display_tax_tag ] ) && 1 == $wtl_settings[ 'display_' . $wtl_display_tax_tag ] ) {
					$tags_link = ( isset( $wtl_settings[ 'disable_link_taxonomy_' . $wtl_display_tax_tag ] ) && 1 == $wtl_settings[ 'disable_link_taxonomy_' . $wtl_display_tax_tag ] ) ? false : true;
					$post_tags = wp_get_post_terms( $post->ID, $wtl_tax_tag, array( 'hide_empty' => 'false' ) );
					$sep       = 1;
					if ( $post_tags ) {
						?>
					<div class="tags <?php echo ( $tags_link ) ? 'wp_timeline_no_links' : 'wp_timeline_has_link'; ?>">
						<?php
						foreach ( $post_tags as $tag ) {
								echo '<span class="wp-timeline-custom-tag">';
								echo ( $tags_link ) ? '<a href="' . esc_url( get_term_link( $tag->term_id ) ) . '">' : '';
								echo esc_html( $tag->name );
								echo ( $tags_link ) ? '</a>' : '';
								echo '</span>';
								$sep++;
						}
						?>
					</div>
						<?php
					}
				}
				?>
			</div>
			<?php
			if ( isset( $wtl_settings['display_author'] ) && 1 == $wtl_settings['display_author'] ) {
				echo '<div class="wtl-author-avatar">';
				echo get_avatar( get_the_author_meta( 'ID' ), 75 );
				$author_link  = ( isset( $wtl_settings['disable_link_author'] ) && 1 == $wtl_settings['disable_link_author'] ) ? false : true;
				$author_data  = '<span class="author">';
				$author_data .= '<span class="author-name">';
				$author_data .= ( $author_link ) ? '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" >' : '';
				$author_data .= Wp_Timeline_Main::wtl_get_post_auhtors( $post->ID, $wtl_settings );

				$author_data .= ( $author_link ) ? '</a>' : '';
				$author_data .= '</span>';
				echo wp_kses( apply_filters( 'wtl_existing_authors', $author_data, get_the_author_meta( 'ID' ) ), Wp_Timeline_Public::args_kses() );
				do_action( 'wtl_extra_authors', $author_link );
				$author_data .= '</span>';
				echo '</div>';
			}

			if ( isset( $wtl_settings['display_comment_count'] ) && 1 == $wtl_settings['display_comment_count'] ) {
				?>
			<div class="wtl-meta-comment">
				<span class="metacomments" 
				<?php
				if ( ! has_post_thumbnail() && '' == $wtl_settings['wp_timeline_default_image_id'] ) {
					echo 'style="margin-right:0"';}
				?>
				>
					<i class="fas fa-comments"></i>
					<?php
					if ( isset( $wtl_settings['disable_link_comment'] ) && 1 == $wtl_settings['disable_link_comment'] ) {
						comments_number( esc_html__( 'No Comments', 'wp-timeline-designer-pro' ), '1 ' . esc_html__( 'comment', 'wp-timeline-designer-pro' ), '% ' . esc_html__( 'comments', 'wp-timeline-designer-pro' ) );
					} else {
						comments_popup_link( esc_html__( 'Leave a Comment', 'wp-timeline-designer-pro' ), esc_html__( '1 comment', 'wp-timeline-designer-pro' ), '% ' . esc_html__( 'comments', 'wp-timeline-designer-pro' ), 'comments-link', esc_html__( 'Comments are off', 'wp-timeline-designer-pro' ) );
					}
					?>
				</span>
			</div>
				<?php
			}
			?>
		</div>
		<div class="wtl-schedule-post-content" data-aos="<?php echo esc_attr( $wtl_animation ); ?>">
			<div class="wtl-schedule-circle"></div>
			<?php
				Wtl_Template_Config::get_title( $wtl_settings );
			?>
			<div class="wtl-schedule-inner inner-first">
				<?php Wtl_Template_Config::get_post_image( $wtl_settings ); ?>
				<div class="wtl-schedule-all-post-content <?php echo empty( $thumbnail ) ? 'wtl_post_content_schedule' : ''; ?>">
					<?php
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
											foreach ( $term_list as $term_nm ) {
												if ( 1 != $sep ) {
													echo ',&nbsp';
												}
												$term_link = get_term_link( $term_nm );
												echo ( $taxonomy_link ) ? '<a href="' . esc_url( $term_link ) . '">' : '';
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
					?>
					<div class="wtl-post-content">
						<?php
						Wtl_Template_Config::get_content( $wtl_settings );
						Wtl_Template_Config::get_read_more_link( $wtl_settings );
						Wp_Timeline_Main::wtl_get_social_icons( $wtl_settings );
						?>
					</div>
					<div class="wtl-post-footer">
					<?php
					Wtl_Template_Config::get_read_more_link_2( $wtl_settings );
					Wtl_Template_Config::display_popup_excerpt( $wtl_settings );
					?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php do_action( 'wtl_after_post_content' ); ?>
</div>
<?php
do_action( 'wtl_separator_after_post' );
