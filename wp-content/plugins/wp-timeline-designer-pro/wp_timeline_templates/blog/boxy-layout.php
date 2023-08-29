<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/wp_timeline_templates/blog/boxy-layout.php.
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

global $post, $wp_query;
$no_image_post = '';
if ( ! has_post_thumbnail() || empty( $wtl_settings['wp_timeline_default_image_id'] ) ) {
	$no_image_post = 'no_image_post';
}
if ( isset( $wtl_settings['blog_unique_design'] ) && '' != $wtl_settings['blog_unique_design'] ) {
	$blog_unique_design = $wtl_settings['blog_unique_design'];
} else {
	$blog_unique_design = 0;
}
$unique_design_option = isset( $wtl_settings['unique_design_option'] ) ? $wtl_settings['unique_design_option'] : '';

$image_hover_effect = '';
if ( isset( $wtl_settings['wp_timeline_image_hover_effect'] ) && 1 == $wtl_settings['wp_timeline_image_hover_effect'] ) {
	$image_hover_effect = ( isset( $wtl_settings['wp_timeline_image_hover_effect_type'] ) && '' != $wtl_settings['wp_timeline_image_hover_effect_type'] ) ? $wtl_settings['wp_timeline_image_hover_effect_type'] : '';
}
$template_columns = ( isset( $wtl_settings['template_columns'] ) && '' != $wtl_settings['template_columns'] ) ? $wtl_settings['template_columns'] : 2;
$alter_val        = 0;
$prev_year        = 0;

$layout_type   = $wtl_settings['layout_type'];
$wtl_animation = isset( $wtl_settings['timeline_animation'] ) ? $wtl_settings['timeline_animation'] : 'fade';

if ( 1 == $layout_type ) {
	/* Horizental Layout */
	if ( 1 == $blog_unique_design && 'first_post' == $unique_design_option && 1 == $alter_val && 0 == $prev_year && 1 == $paged ) {
		echo '<div class="media-grid-wrap first_post">';
	} elseif ( 1 == $blog_unique_design && 'featured_posts' === $unique_design_option && $alter_val <= $count_sticky && 0 == $prev_year && 1 == $paged ) {
		echo '<div class="media-grid-wrap first_post">';
	} else {
		if ( 1 != $blog_unique_design && 1 == $alter_val ) {
			echo '<div class="media-grid-wrapper">';
		} elseif ( $paged > 1 && 1 == $alter_val ) {
			echo '<div class="media-grid-wrapper">';
		} elseif ( 1 == $blog_unique_design && 'first_post' === $unique_design_option && 1 == $paged ) {
			if ( 2 == $alter_val && $template_columns <= 2 ) {
				echo '<div class="media-grid-wrapper">';
			} elseif ( 3 == $alter_val && $template_columns >= 3 ) {
				echo '<div class="media-grid-wrapper">';
			}
		} elseif ( 1 == $blog_unique_design && 'featured_posts' === $unique_design_option && 1 == $paged ) {
			$count_sticky++;
			if ( $alter_val == $count_sticky ) {
				echo '<div class="media-grid-wrapper">';
			}
		}
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
	?>
	<div class="blog_template wtl_blog_template media-grid <?php echo esc_attr( get_post_format( $post->ID ) ); ?> wtl_blog_single_post_wrapp <?php echo esc_attr( $category ); ?>">
		<?php do_action( 'wtl_before_post_content' ); ?>
		<div class="post-body-div 
		<?php
		echo wp_kses( $no_image_post, Wp_Timeline_Public::args_kses() );
		if ( 'post' === $wtl_settings['custom_post_type'] && 0 == $wtl_settings['display_category'] ) {
			echo ' category-not-visible';
		}
		?>
		">
			<div class="wtl-post-image">
				<?php
				$label_featured_post = ( isset( $wtl_settings['label_featured_post'] ) && '' != $wtl_settings['label_featured_post'] ) ? $wtl_settings['label_featured_post'] : '';
				if ( '' != $label_featured_post && is_sticky() ) {
					?>
					<div class="label_featured_post"><?php echo esc_html( $label_featured_post ); ?></div> 
					<?php
				}
				/* Sale Tag */
				if ( class_exists( 'woocommerce' ) && 'product' === $wtl_settings['custom_post_type'] ) {
					if ( isset( $wtl_settings['display_sale_tag'] ) && 1 == $wtl_settings['display_sale_tag'] ) {
						$wp_timeline_sale_tagtext_alignment = ( isset( $wtl_settings['wp_timeline_sale_tagtext_alignment'] ) && '' != $wtl_settings['wp_timeline_sale_tagtext_alignment'] ) ? $wtl_settings['wp_timeline_sale_tagtext_alignment'] : 'left-top';
						echo '<div class="wtl_woocommerce_sale_wrap ' . esc_attr( $wp_timeline_sale_tagtext_alignment ) . '">';
						do_action( 'wtl_woocommerce_sale_tag' );
						echo '</div>';
					}
				}
				Wtl_Template_Config::get_post_image( $wtl_settings );
				/* Category */
				if ( 'post' === $wtl_settings['custom_post_type'] ) {
					if ( isset( $wtl_settings['display_category'] ) && 1 == $wtl_settings['display_category'] ) {
						?>
						<?php
						$categories_list = get_the_category_list( ', ' );
						$categories_link = ( isset( $wtl_settings['disable_link_category'] ) && 1 == $wtl_settings['disable_link_category'] ) ? true : false;
						if ( $categories_link ) {
							$categories_list = wp_strip_all_tags( $categories_list );
						}
						if ( $categories_list ) :
							echo '<span class="category-link">';
							echo ' ' . wp_kses( $categories_list, Wp_Timeline_Public::args_kses() );
							$show_sep = true;
							echo '</span>';
						endif;
						?>
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
							<div class="post-category">
								<span class="category-link<?php echo ( $categories_link ) ? ' categories_link' : ''; ?>">
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
							</span></div>
						<?php
					}
				}
				?>
			</div>
			<div class="content-container">
				<div class="shadow-box_1"></div>
				<div class="content-inner">
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
					<div class="wtl-post-content">
						<?php
						Wtl_Template_Config::get_content( $wtl_settings );
						Wtl_Template_Config::get_read_more_link( $wtl_settings );
						?>
					</div>
					<?php
					Wtl_Template_Config::get_read_more_link_2( $wtl_settings );
					Wtl_Template_Config::display_popup_excerpt( $wtl_settings );
					if ( 'download' !== $wtl_settings['custom_post_type'] ) {
						Wtl_Template_Config::get_post_details( $wtl_settings );
					}
					?>
					<div class="metadatabox">
						<?php
						$display_author = $wtl_settings['display_author'];
						$display_date   = $wtl_settings['display_date'];
						if ( 1 == $display_author || 1 == $display_date ) {
							?>
							<span><?php esc_html_e( 'Posted ', 'wp-timeline-designer-pro' ); ?></span>
							<?php
						}
						if ( 1 == $display_author ) {
							?>
							<span class="post-author">
								<span><?php esc_html_e( 'by', 'wp-timeline-designer-pro' ); ?>&nbsp;</span>
								<?php echo wp_kses( Wp_Timeline_Main::wtl_get_post_auhtors( $post->ID, $wtl_settings ), Wp_Timeline_Public::args_kses() ); ?>
							</span>
							<?php
						}
						if ( 1 == $display_date ) {
							$date_link   = ( isset( $wtl_settings['disable_link_date'] ) && 1 == $wtl_settings['disable_link_date'] ) ? false : true;
							$date_format = ( isset( $wtl_settings['post_date_format'] ) && 'default' !== $wtl_settings['post_date_format'] ) ? $wtl_settings['post_date_format'] : get_option( 'date_format' );
							$wtl_date    = ( isset( $wtl_settings['display_date_from'] ) && 'modify' === $wtl_settings['display_date_from'] ) ? apply_filters( 'wtl_date_format', get_post_modified_time( $date_format, $post->ID ), $post->ID ) : apply_filters( 'wtl_date_format', get_the_time( $date_format, $post->ID ), $post->ID );
							$ar_year     = get_the_time( 'Y' );
							$ar_month    = get_the_time( 'm' );
							$ar_day      = get_the_time( 'd' );
							?>
							<span class="mdate"><span><?php esc_html_e( 'on', 'wp-timeline-designer-pro' ); ?></span>
								<?php
								echo ( $date_link ) ? '<a href="' . esc_url( get_day_link( $ar_year, $ar_month, $ar_day ) ) . '">' : '';
								echo esc_html( $wtl_date );
								echo ( $date_link ) ? '</a>' : '';
								?>
							</span>
							<?php
						}
						if ( 1 == $wtl_settings['display_comment_count'] ) {
							?>
							<span class="metacomments">
								<i class="fas fa-comments"></i>
								<?php
								if ( isset( $wtl_settings['disable_link_comment'] ) && 1 == $wtl_settings['disable_link_comment'] ) {
									comments_number( '0', '1', '%' );
								} else {
									comments_popup_link( '0', '1', '%' );
								}
								?>
							</span>
							<?php
						}
						if ( isset( $wtl_settings['display_postlike'] ) && 1 == $wtl_settings['display_postlike'] ) {
							echo do_shortcode( '[likebtn_shortcode]' );
						}
						?>
						<div class="footer_meta">
							<?php
							Wtl_Template_Config::get_category( $wtl_settings, true, true );
							Wtl_Template_Config::get_tags( $wtl_settings, true, true );
							?>
						</div>
					</div>
					<?php
					Wp_Timeline_Main::wtl_get_social_icons( $wtl_settings );
					?>
				</div>
			</div>
		</div>
		<?php do_action( 'wtl_after_post_content' ); ?>
	</div>
	<?php
	if ( 1 == $blog_unique_design && 'first_post' === $unique_design_option && 0 == $prev_year && 1 == $paged ) {
		if ( $template_columns >= 3 && 2 == $alter_val ) {
			echo '</div>';
		} elseif ( $template_columns <= 2 && 1 == $alter_val ) {
			echo '</div>';
		}
	} elseif ( 1 == $blog_unique_design && 'featured_posts' === $unique_design_option && $alter_val <= $count_sticky && 0 == $prev_year && 1 == $paged ) {
		echo '</div>';
	} elseif ( 1 == $prev_year && $wp_query->post_count == $alter_val ) {
		echo '</div>';
	} elseif ( 1 != $blog_unique_design && $wp_query->post_count == $alter_val ) {
		echo '</div>';
	}
	/* Horizental Layout End */
} else {
	/* Vertical Layout */
	if ( 1 == $blog_unique_design && 'first_post' == $unique_design_option && 1 == $alter_val && 0 == $prev_year && 1 == $paged ) {
		echo '<div class="media-grid-wrap first_post">';
	} elseif ( 1 == $blog_unique_design && 'featured_posts' === $unique_design_option && $alter_val <= $count_sticky && 0 == $prev_year && 1 == $paged ) {
		echo '<div class="media-grid-wrap first_post">';
	} else {
		if ( 1 != $blog_unique_design && 1 == $alter_val ) {
			echo '<div class="media-grid-wrapper">';
		} elseif ( $paged > 1 && 1 == $alter_val ) {
			echo '<div class="media-grid-wrapper">';
		} elseif ( 1 == $blog_unique_design && 'first_post' === $unique_design_option && 1 == $paged ) {
			if ( 2 == $alter_val && $template_columns <= 2 ) {
				echo '<div class="media-grid-wrapper">';
			} elseif ( 3 == $alter_val && $template_columns >= 3 ) {
				echo '<div class="media-grid-wrapper">';
			}
		} elseif ( 1 == $blog_unique_design && 'featured_posts' === $unique_design_option && 1 == $paged ) {
			$count_sticky++;
			if ( $alter_val == $count_sticky ) {
				echo '<div class="media-grid-wrapper">';
			}
		}
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
	?>
	<div id="wtl_date_<?php echo esc_attr( get_the_time( 'd' ) ); ?>_<?php echo esc_attr( get_the_time( 'm' ) ); ?>" class="blog_template wtl_blog_template media-grid <?php echo esc_attr( get_post_format( $post->ID ) ); ?> wtl_blog_single_post_wrapp <?php echo esc_attr( $category ); ?>">
		<?php do_action( 'wtl_before_post_content' ); ?>
		<div class="post-body-div 
		<?php
		echo wp_kses( $no_image_post, Wp_Timeline_Public::args_kses() );
		if ( 'post' === $wtl_settings['custom_post_type'] && 0 == $wtl_settings['display_category'] ) {
			echo ' category-not-visible';
		}
		?>
		">
			<div class="wtl-post-image">
				<?php
				$label_featured_post = ( isset( $wtl_settings['label_featured_post'] ) && '' != $wtl_settings['label_featured_post'] ) ? $wtl_settings['label_featured_post'] : '';
				if ( '' != $label_featured_post && is_sticky() ) {
					?>
					<div class="label_featured_post"><?php echo esc_html( $label_featured_post ); ?></div> 
					<?php
				}
				/* Sale Tag */
				if ( class_exists( 'woocommerce' ) && 'product' === $wtl_settings['custom_post_type'] ) {
					if ( isset( $wtl_settings['display_sale_tag'] ) && 1 == $wtl_settings['display_sale_tag'] ) {
						$wp_timeline_sale_tagtext_alignment = ( isset( $wtl_settings['wp_timeline_sale_tagtext_alignment'] ) && '' != $wtl_settings['wp_timeline_sale_tagtext_alignment'] ) ? $wtl_settings['wp_timeline_sale_tagtext_alignment'] : 'left-top';
						echo '<div class="wtl_woocommerce_sale_wrap ' . esc_attr( $wp_timeline_sale_tagtext_alignment ) . '">';
						do_action( 'wtl_woocommerce_sale_tag' );
						echo '</div>';
					}
				}
				Wtl_Template_Config::get_post_image( $wtl_settings );
				/* Category */
				if ( 'post' === $wtl_settings['custom_post_type'] ) {
					if ( isset( $wtl_settings['display_category'] ) && 1 == $wtl_settings['display_category'] ) {
						?>
						<?php
						$categories_list = get_the_category_list( ', ' );
						$categories_link = ( isset( $wtl_settings['disable_link_category'] ) && 1 == $wtl_settings['disable_link_category'] ) ? true : false;
						if ( $categories_link ) {
							$categories_list = wp_strip_all_tags( $categories_list );
						}
						if ( $categories_list ) :
							echo '<span class="category-link">';
							echo ' ' . wp_kses( $categories_list, Wp_Timeline_Public::args_kses() );
							$show_sep = true;
							echo '</span>';
						endif;
						?>
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
							<div class="post-category">
							<span class="category-link<?php echo ( $categories_link ) ? ' categories_link' : ''; ?>">
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
							</span></div>
						<?php
					}
				}
				?>
			</div>
			<div class="content-container">
				<div class="shadow-box_1"></div>
				<div class="content-inner">
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

					<div class="wtl-post-content">
						<?php
						Wtl_Template_Config::get_content( $wtl_settings );
						Wtl_Template_Config::get_read_more_link( $wtl_settings );
						?>
					</div>
					<?php
					Wtl_Template_Config::get_read_more_link_2( $wtl_settings );
					Wtl_Template_Config::display_popup_excerpt( $wtl_settings );
					if ( 'download' !== $wtl_settings['custom_post_type'] ) {
						Wtl_Template_Config::get_post_details( $wtl_settings );
					}
					?>
					<div class="metadatabox">
						<?php
						$display_author = $wtl_settings['display_author'];
						$display_date   = $wtl_settings['display_date'];
						if ( 1 == $display_author || 1 == $display_date ) {
							?>
							<span><?php esc_html_e( 'Posted ', 'wp-timeline-designer-pro' ); ?></span>
							<?php
						}
						if ( 1 == $display_author ) {
							?>
							<span class="post-author">
								<span><?php esc_html_e( 'by', 'wp-timeline-designer-pro' ); ?>&nbsp;</span>
								<?php echo wp_kses( Wp_Timeline_Main::wtl_get_post_auhtors( $post->ID, $wtl_settings ), Wp_Timeline_Public::args_kses() ); ?>
							</span>
							<?php
						}
						if ( 1 == $display_date ) {
							$date_link   = ( isset( $wtl_settings['disable_link_date'] ) && 1 == $wtl_settings['disable_link_date'] ) ? false : true;
							$date_format = ( isset( $wtl_settings['post_date_format'] ) && 'default' !== $wtl_settings['post_date_format'] ) ? $wtl_settings['post_date_format'] : get_option( 'date_format' );
							$wtl_date    = ( isset( $wtl_settings['display_date_from'] ) && 'modify' === $wtl_settings['display_date_from'] ) ? apply_filters( 'wtl_date_format', get_post_modified_time( $date_format, $post->ID ), $post->ID ) : apply_filters( 'wtl_date_format', get_the_time( $date_format, $post->ID ), $post->ID );
							$ar_year     = get_the_time( 'Y' );
							$ar_month    = get_the_time( 'm' );
							$ar_day      = get_the_time( 'd' );
							?>
							<span class="mdate"><span><?php esc_html_e( 'on', 'wp-timeline-designer-pro' ); ?></span>
								<?php
								echo ( $date_link ) ? '<a href="' . esc_url( get_day_link( $ar_year, $ar_month, $ar_day ) ) . '">' : '';
								echo esc_html( $wtl_date );
								echo ( $date_link ) ? '</a>' : '';
								?>
							</span>
							<?php
						}
						if ( 1 == $wtl_settings['display_comment_count'] ) {
							?>
							<span class="metacomments">
								<i class="fas fa-comments"></i>
								<?php
								if ( isset( $wtl_settings['disable_link_comment'] ) && 1 == $wtl_settings['disable_link_comment'] ) {
									comments_number( '0', '1', '%' );
								} else {
									comments_popup_link( '0', '1', '%' );
								}
								?>
							</span>
							<?php
						}
						if ( isset( $wtl_settings['display_postlike'] ) && 1 == $wtl_settings['display_postlike'] ) {
							echo do_shortcode( '[likebtn_shortcode]' );
						}
						?>
						<div class="footer_meta">
							<?php
							Wtl_Template_Config::get_category( $wtl_settings, true, true );
							Wtl_Template_Config::get_tags( $wtl_settings, true, true );
							?>
						</div>
					</div>
					<?php
					Wp_Timeline_Main::wtl_get_social_icons( $wtl_settings );
					?>
				</div>
			</div>
		</div>
		<?php do_action( 'wtl_after_post_content' ); ?>
	</div>
	<?php
	if ( 1 == $blog_unique_design && 'first_post' === $unique_design_option && 0 == $prev_year && 1 == $paged ) {
		if ( $template_columns >= 3 && 2 == $alter_val ) {
			echo '</div>';
		} elseif ( $template_columns <= 2 && 1 == $alter_val ) {
			echo '</div>';
		}
	} elseif ( 1 == $blog_unique_design && 'featured_posts' === $unique_design_option && $alter_val <= $count_sticky && 0 == $prev_year && 1 == $paged ) {
		echo '</div>';
	} elseif ( 1 == $prev_year && $wp_query->post_count == $alter_val ) {
		echo '</div>';
	} elseif ( 1 != $blog_unique_design && $wp_query->post_count == $alter_val ) {
		echo '</div>';
	}
	/* Vertical Layout End */
}


