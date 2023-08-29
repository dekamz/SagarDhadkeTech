<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/wp_timeline_templates/blog/glossary-layout.php.
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
$col_class  = wtl_Template_Config::get_class_category( $wtl_settings );
$class_name = 'two_column blog_template glossary blog_masonry_item ';

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

$layout_type   = $wtl_settings['layout_type'];
$wtl_animation = isset( $wtl_settings['timeline_animation'] ) ? $wtl_settings['timeline_animation'] : 'fade';

if ( 1 == $layout_type ) {
	?>
	<div class="<?php echo esc_attr( $class_name ); ?> wtl_blog_single_post_wrapp <?php echo esc_attr( $category ); ?>">
		<?php do_action( 'wtl_before_post_content' ); ?> 
		<div class="blog_item">
			<div class="blog_header">
			<?php
				$display_date   = $wtl_settings['display_date'];
				$display_author = $wtl_settings['display_author'];
				$date_format    = ( isset( $wtl_settings['post_date_format'] ) && 'default' !== $wtl_settings['post_date_format'] ) ? $wtl_settings['post_date_format'] : get_option( 'date_format' );
				$wtl_date       = ( isset( $wtl_settings['display_date_from'] ) && 'modify' === $wtl_settings['display_date_from'] ) ? apply_filters( 'post_date_format', get_post_modified_time( $date_format, $post->ID ), $post->ID ) : apply_filters( 'post_date_format', get_the_time( $date_format, $post->ID ), $post->ID );
				$comment_cnt    = $wtl_settings['display_comment_count'];
				$ar_year        = get_the_time( 'Y' );
				$ar_month       = get_the_time( 'm' );
				$ar_day         = get_the_time( 'd' );
			if ( 1 == $display_author || 1 == $display_date || 1 == $comment_cnt || 1 == $wtl_settings['display_postlike'] ) {
				?>
					<div class="posted_by">
					<?php
					if ( 1 == $display_author && 1 == $display_date || 1 == $wtl_settings['display_postlike'] ) {
						$date_link   = ( isset( $wtl_settings['disable_link_date'] ) && 1 == $wtl_settings['disable_link_date'] ) ? false : true;
						$author_link = ( isset( $wtl_settings['disable_link_author'] ) && 1 == $wtl_settings['disable_link_author'] ) ? false : true;
						echo '<span class="wtl-post-date">';
						echo ( $date_link ) ? '<a href="' . esc_url( get_day_link( $ar_year, $ar_month, $ar_day ) ) . '">' : '';
						?>
						<time datetime="" class="datetime"><?php echo esc_html( $wtl_date ); ?></time>
						<?php
						echo ( $date_link ) ? '</a>' : '';
						echo '</span>';
						?>
						<span class="post-author <?php echo ( ! $author_link ) ? 'wp_timeline_no_links' : ''; ?>">&nbsp; | &nbsp;
							<?php
							echo '<span class="link-lable">' . esc_html__( 'By ', 'wp-timeline-designer-pro' ) . '</span>';
							echo wp_kses( Wtl_Template_Config::get_author( $wtl_settings ), Wp_Timeline_Public::args_kses() );
							?>
							</span>
							<?php
					} elseif ( 1 == $display_author ) {
						$author_link = ( isset( $wtl_settings['disable_link_author'] ) && 1 == $wtl_settings['disable_link_author'] ) ? false : true;
						?>
						<div class="icon-date"></div>
						<span class="post-author <?php echo ( ! $author_link ) ? 'wp_timeline_no_links' : ''; ?>">
							<?php
							echo '<span class="link-lable">' . esc_html__( 'By ', 'wp-timeline-designer-pro' ) . '</span>';
							echo wp_kses( Wtl_Template_Config::get_author( $wtl_settings ), Wp_Timeline_Public::args_kses() );
							?>
						</span>
						<?php
					} elseif ( 1 == $display_date ) {
						$date_link = ( isset( $wtl_settings['disable_link_date'] ) && 1 == $wtl_settings['disable_link_date'] ) ? false : true;
						echo ( $date_link ) ? '<a href="' . esc_url( get_day_link( $ar_year, $ar_month, $ar_day ) ) . '">' : '';
						?>
						<time datetime="" class="datetime">
							<?php echo esc_html( apply_filters( 'post_date_format', get_the_time( $date_format, $post->ID ), $post->ID ) ); ?>
						</time>
						<?php
						echo ( $date_link ) ? '</a>' : '';
					}
					if ( 1 == $comment_cnt ) {
						if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
							?>
						<span class="wtl-comment comment">
							<?php
							echo ( ( 1 == $display_author && 1 == $display_date ) || ( 1 == $display_author || 1 == $display_date ) ) ? ' | ' : '';
							$comment_link = ( isset( $wtl_settings['disable_link_comment'] ) && 1 == $wtl_settings['disable_link_comment'] ) ? false : true;
							echo wp_kses( Wtl_Template_Config::comment_count( $wtl_settings ), Wp_Timeline_Public::args_kses() );
							?>
						</span>
							<?php
					endif;
					}
					if ( isset( $wtl_settings['display_postlike'] ) && 1 == $wtl_settings['display_postlike'] ) {
						echo '|' . do_shortcode( '[likebtn_shortcode]' );
					}
					?>
					</div>
					<?php
			}
			?>
				<?php
				Wtl_Template_Config::get_title( $wtl_settings );
				?>
			</div>
			<div class="post_summary_outer">
				<?php
				Wtl_Template_Config::get_post_image( $wtl_settings );
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
					<div class="post_content-inner">
						<?php if ( 0 == $wtl_settings['rss_use_excerpt'] ) : ?>
							<div class="content_upper_div">
								<?php
								$content = apply_filters( 'the_content', get_the_content( $post->ID ) );
								$content = apply_filters( 'wtl_content_change', $content, $post->ID );
								if ( isset( $wtl_settings['firstletter_big'] ) && 1 == $wtl_settings['firstletter_big'] ) {
									echo Wp_Timeline_Main::wtl_add_first_letter_structure( $content );
								} else {
									echo wp_kses( $content, Wp_Timeline_Public::args_kses() );
								}
								?>
							</div>
							<?php
						else :
							$template_post_content_from = 'from_content';
							if ( isset( $wtl_settings['template_post_content_from'] ) ) {
								$template_post_content_from = $wtl_settings['template_post_content_from'];
							}
							if ( 'from_excerpt' === $template_post_content_from ) {
								if ( get_the_excerpt() != '' ) {
									$wtl_excerpt_data = get_the_excerpt( get_the_ID() );
								} else {
									$excerpt          = get_the_content( $post->ID );
									$excerpt_length   = $wtl_settings['txtExcerptlength'];
									$text             = strip_shortcodes( $excerpt );
									$text             = apply_filters( 'the_content', $text );
									$text             = str_replace( ']]>', ']]&gt;', $text );
									$wtl_excerpt_data = wp_trim_words( $text, $excerpt_length, '' );
									$wtl_excerpt_data = apply_filters( 'wtl_excerpt_change', $wtl_excerpt_data, $post->ID );
								}
							} else {
								$excerpt          = get_the_content( $post->ID );
								$excerpt_length   = $wtl_settings['txtExcerptlength'];
								$text             = strip_shortcodes( $excerpt );
								$text             = apply_filters( 'the_content', $text );
								$text             = str_replace( ']]>', ']]&gt;', $text );
								$wtl_excerpt_data = wp_trim_words( $text, $excerpt_length, '' );
								$wtl_excerpt_data = apply_filters( 'wtl_excerpt_change', $wtl_excerpt_data, $post->ID );
							}
							if ( '' != $wtl_excerpt_data ) {
								?>
								<p><?php echo esc_html( $wtl_excerpt_data ); ?></p>
								<?php
								$read_more_link = isset( $wtl_settings['read_more_link'] ) ? $wtl_settings['read_more_link'] : 1;
								if ( 1 == $read_more_link && 0 != $wtl_settings['rss_use_excerpt'] ) {
									$readmoretxt = '' != $wtl_settings['txtReadmoretext'] ? $wtl_settings['txtReadmoretext'] : esc_html__( 'Read More', 'wp-timeline-designer-pro' );
									$post_link   = get_permalink( $post->ID );
									if ( isset( $wtl_settings['post_link_type'] ) && 1 == $wtl_settings['post_link_type'] ) {
										$post_link = ( isset( $wtl_settings['custom_link_url'] ) && '' != $wtl_settings['custom_link_url'] ) ? $wtl_settings['custom_link_url'] : get_permalink( $post->ID );
									}
									?>
									<div class="overlay" style="background:<?php echo esc_attr( Wp_Timeline_Main::wtl_hex2rgba( $wtl_settings['template_readmore_hover_backcolor'], 0.9 ) ); ?>">
										<div class="read-more-class">
											<?php echo '<a class="more-tag" href="' . esc_url( $post_link ) . '"><i class="fas fa-link"></i>' . esc_html( $readmoretxt ) . ' </a>'; ?>
										</div>
									</div>
									<?php
								}
							}
						endif;
						?>
					</div>
				</div>
			</div>

			<?php
			if ( 'download' !== $wtl_settings['custom_post_type'] ) {
				Wtl_Template_Config::get_post_details( $wtl_settings );
			}
			?>
			<div class="blog_footer">
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
		<?php do_action( 'wtl_after_post_content' ); ?>
	</div>
	<?php
} else {
	?>
	<div id="wtl_date_<?php echo esc_attr( get_the_time( 'd' ) ); ?>_<?php echo esc_attr( get_the_time( 'm' ) ); ?>"   class="<?php echo esc_attr( $class_name ); ?> wtl_blog_single_post_wrapp <?php echo esc_attr( $category ); ?>  two_column two_column_ipad one_column_tablet one_column_mobile" data-aos="<?php echo esc_attr( $wtl_animation ); ?>">
		<?php do_action( 'wtl_before_post_content' ); ?>
		<div class="blog_item">
			<div class="blog_header">
			<?php
				$display_date   = $wtl_settings['display_date'];
				$display_author = $wtl_settings['display_author'];
				$date_format    = ( isset( $wtl_settings['post_date_format'] ) && 'default' !== $wtl_settings['post_date_format'] ) ? $wtl_settings['post_date_format'] : get_option( 'date_format' );
				$wtl_date       = ( isset( $wtl_settings['display_date_from'] ) && 'modify' === $wtl_settings['display_date_from'] ) ? apply_filters( 'post_date_format', get_post_modified_time( $date_format, $post->ID ), $post->ID ) : apply_filters( 'post_date_format', get_the_time( $date_format, $post->ID ), $post->ID );
				$comment_cnt    = $wtl_settings['display_comment_count'];
				$ar_year        = get_the_time( 'Y' );
				$ar_month       = get_the_time( 'm' );
				$ar_day         = get_the_time( 'd' );
			if ( 1 == $display_author || 1 == $display_date || 1 == $comment_cnt || 1 == $wtl_settings['display_postlike'] ) {
				?>
					<div class="posted_by">
					<?php
					if ( 1 == $display_author && 1 == $display_date || 1 == $wtl_settings['display_postlike'] ) {
						$date_link   = ( isset( $wtl_settings['disable_link_date'] ) && 1 == $wtl_settings['disable_link_date'] ) ? false : true;
						$author_link = ( isset( $wtl_settings['disable_link_author'] ) && 1 == $wtl_settings['disable_link_author'] ) ? false : true;
						echo '<span class="wtl-post-date">';
						echo ( $date_link ) ? '<a href="' . esc_url( get_day_link( $ar_year, $ar_month, $ar_day ) ) . '">' : '';
						?>
						<time datetime="" class="datetime"><?php echo esc_html( $wtl_date ); ?></time>
						<?php
						echo ( $date_link ) ? '</a>' : '';
						echo '</span>';
						?>
						<span class="post-author <?php echo ( ! $author_link ) ? 'wp_timeline_no_links' : ''; ?>">
						<?php
						echo ' | <span class="link-lable">' . esc_html__( 'By ', 'wp-timeline-designer-pro' ) . '</span>';
						echo wp_kses( Wtl_Template_Config::get_author( $wtl_settings ), Wp_Timeline_Public::args_kses() );
						?>
						</span>
						<?php
					} elseif ( 1 == $display_author ) {
						$author_link = ( isset( $wtl_settings['disable_link_author'] ) && 1 == $wtl_settings['disable_link_author'] ) ? false : true;
						?>
						<div class="icon-date"></div>
						<span class="post-author <?php echo ( ! $author_link ) ? 'wp_timeline_no_links' : ''; ?>">
							<?php
							echo '<span class="link-lable">' . esc_html__( 'By ', 'wp-timeline-designer-pro' ) . '</span>';
							echo wp_kses( Wtl_Template_Config::get_author( $wtl_settings ), Wp_Timeline_Public::args_kses() );
							?>
						</span>
						<?php
					} elseif ( 1 == $display_date ) {
						$date_link = ( isset( $wtl_settings['disable_link_date'] ) && 1 == $wtl_settings['disable_link_date'] ) ? false : true;
						echo ( $date_link ) ? '<a href="' . esc_url( get_day_link( $ar_year, $ar_month, $ar_day ) ) . '">' : '';
						?>
						<time datetime="" class="datetime">
							<?php echo esc_html( apply_filters( 'post_date_format', get_the_time( $date_format, $post->ID ), $post->ID ) ); ?>
						</time>
						<?php
						echo ( $date_link ) ? '</a>' : '';
					}
					if ( 1 == $comment_cnt ) {
						if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
							?>
						<span class="wtl-comment comment">
							<?php
							echo ( ( 1 == $display_author && 1 == $display_date ) || ( 1 == $display_author || 1 == $display_date ) ) ? ' | &nbsp;&nbsp;' : '';
							$comment_link = ( isset( $wtl_settings['disable_link_comment'] ) && 1 == $wtl_settings['disable_link_comment'] ) ? false : true;
							echo wp_kses( Wtl_Template_Config::comment_count( $wtl_settings ), Wp_Timeline_Public::args_kses() );
							?>
						</span>
							<?php
						endif;
					}
					if ( isset( $wtl_settings['display_postlike'] ) && 1 == $wtl_settings['display_postlike'] ) {
						echo '|' . do_shortcode( '[likebtn_shortcode]' );
					}
					?>
					</div>
					<?php
			}
			?>
				<?php
				Wtl_Template_Config::get_title( $wtl_settings );
				?>
			</div>
			<div class="post_summary_outer">
				<?php
				Wtl_Template_Config::get_post_image( $wtl_settings );
				if ( isset( $wtl_settings['custom_post_type'] ) && 'download' === $wtl_settings['custom_post_type'] ) {
					do_action( 'wtl_easy_digital_download_product_details_function', $wtl_settings, $post->ID );
				}
				if ( isset( $wtl_settings['custom_post_type'] ) && 'download' === $wtl_settings['custom_post_type'] ) {
					do_action( 'wtl_edd_product_details', $wtl_settings, $post->ID );
				}
				if ( isset( $wtl_settings['custom_post_type'] ) && 'product' === $wtl_settings['custom_post_type'] ) {
					do_action( 'wtl_woocommerce_product_details_function', $wtl_settings, $post->ID );
				}
				?>
				<div class="wtl-post-content">
					<div class="post_content-inner">
						<?php if ( 0 == $wtl_settings['rss_use_excerpt'] ) : ?>
							<div class="content_upper_div">
								<?php
								$content = apply_filters( 'the_content', get_the_content( $post->ID ) );
								$content = apply_filters( 'wtl_content_change', $content, $post->ID );
								if ( isset( $wtl_settings['firstletter_big'] ) && 1 == $wtl_settings['firstletter_big'] ) {
									echo Wp_Timeline_Main::wtl_add_first_letter_structure( $content );
								} else {
									echo wp_kses( $content, Wp_Timeline_Public::args_kses() );
								}
								?>
							</div>
							<?php
						else :
							$template_post_content_from = 'from_content';
							if ( isset( $wtl_settings['template_post_content_from'] ) ) {
								$template_post_content_from = $wtl_settings['template_post_content_from'];
							}
							if ( 'from_excerpt' === $template_post_content_from ) {
								if ( get_the_excerpt() != '' ) {
									$wtl_excerpt_data = get_the_excerpt( get_the_ID() );
								} else {
									$excerpt          = get_the_content( $post->ID );
									$excerpt_length   = $wtl_settings['txtExcerptlength'];
									$text             = strip_shortcodes( $excerpt );
									$text             = apply_filters( 'the_content', $text );
									$text             = str_replace( ']]>', ']]&gt;', $text );
									$wtl_excerpt_data = wp_trim_words( $text, $excerpt_length, '' );
									$wtl_excerpt_data = apply_filters( 'wtl_excerpt_change', $wtl_excerpt_data, $post->ID );
								}
							} else {
								$excerpt          = get_the_content( $post->ID );
								$excerpt_length   = $wtl_settings['txtExcerptlength'];
								$text             = strip_shortcodes( $excerpt );
								$text             = apply_filters( 'the_content', $text );
								$text             = str_replace( ']]>', ']]&gt;', $text );
								$wtl_excerpt_data = wp_trim_words( $text, $excerpt_length, '' );
								$wtl_excerpt_data = apply_filters( 'wtl_excerpt_change', $wtl_excerpt_data, $post->ID );
							}
							if ( '' != $wtl_excerpt_data ) {
								?>
								<p><?php echo esc_html( $wtl_excerpt_data ); ?></p>

								<?php
								$read_more_link = isset( $wtl_settings['read_more_link'] ) ? $wtl_settings['read_more_link'] : 1;
								if ( 1 == $read_more_link && 0 != $wtl_settings['rss_use_excerpt'] ) {
									$readmoretxt = '' != $wtl_settings['txtReadmoretext'] ? $wtl_settings['txtReadmoretext'] : esc_html__( 'Read More', 'wp-timeline-designer-pro' );
									$post_link   = get_permalink( $post->ID );
									if ( isset( $wtl_settings['post_link_type'] ) && 1 == $wtl_settings['post_link_type'] ) {
										$post_link = ( isset( $wtl_settings['custom_link_url'] ) && '' != $wtl_settings['custom_link_url'] ) ? $wtl_settings['custom_link_url'] : get_permalink( $post->ID );
									}
									?>
									<div class="overlay" style="background:<?php echo esc_attr( Wp_Timeline_Main::wtl_hex2rgba( $wtl_settings['template_readmore_hover_backcolor'], 0.9 ) ); ?>">
										<div class="read-more-class">
											<?php echo '<a class="more-tag" href="' . esc_url( $post_link ) . '"><i class="fas fa-link"></i>' . esc_html( $readmoretxt ) . ' </a>'; ?>
										</div>
									</div>
									<?php
								}
							}
						endif;
						?>
					</div>
				</div>
			</div>

			<?php
			if ( 'download' !== $wtl_settings['custom_post_type'] ) {
				Wtl_Template_Config::get_post_details( $wtl_settings );
			}
			?>
			<div class="blog_footer">
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
		<?php do_action( 'wtl_after_post_content' ); ?>
	</div>
	<?php
}

do_action( 'wtl_separator_after_post' );
