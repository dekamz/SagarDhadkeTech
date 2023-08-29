<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/wp_timeline_templates/blog/story-layout.php.
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
$alter_class     = $count;
$prev_year1      = null;
$format          = get_post_format( $post->ID );
$line_col_bottom = 'line-col-bottom-secound';
$date_class      = 'date-icon-rights';
$entity_content  = 'entity-content-right';
$curv_line       = 'line-col-left';
$year_class      = 'right-year';
$eding_class     = 'right_ending';
$wtl_animation   = isset( $wtl_settings['timeline_animation'] ) ? $wtl_settings['timeline_animation'] : 'fade';

if ( 0 != $alter_class % 2 ) {
	$line_col_bottom = 'line-col-top';
	$date_class      = 'date-icon-left';
	$entity_content  = 'entity-content-left';
	$curv_line       = 'line-col-right';
	$year_class      = 'left-year';
	$eding_class     = 'left_ending';
}
$order_by = $wtl_settings ['wp_timeline_blog_order_by'];
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
$image_hover_effect = '';
$category           = Wtl_Template_Config::get_class_category( $wtl_settings );
if ( isset( $wtl_settings['wp_timeline_image_hover_effect'] ) && 1 == $wtl_settings['wp_timeline_image_hover_effect'] ) {
	$image_hover_effect = ( isset( $wtl_settings['wp_timeline_image_hover_effect_type'] ) && '' != $wtl_settings['wp_timeline_image_hover_effect_type'] ) ? $wtl_settings['wp_timeline_image_hover_effect_type'] : '';
}
?>
<div id="wtl_date_<?php echo esc_attr( get_the_time( 'd' ) ); ?>_<?php echo esc_attr( get_the_time( 'm' ) ); ?>" data-aos="<?php echo esc_attr( $wtl_animation ); ?>" class="blog_template wtl_blog_template story blog-wrap yearly-info wtl_blog_single_post_wrapp <?php echo esc_attr( $category ); ?>">
	<?php
	do_action( 'wtl_before_post_content' );
	$this_year = get_the_date( 'Y' );
	if ( 0 == $prev_year || $prev_year == $this_year ) {
		$prev_year = $this_year;
	} else {
		$prev_year = '';
	}
	?>
	<div class="<?php echo esc_attr( $line_col_bottom ); ?>">
		<?php
		$display_story_year = isset( $wtl_settings['display_story_year'] ) ? $wtl_settings['display_story_year'] : 1;
		if ( 1 == $display_story_year ) {
			if ( 0 != $prev_year ) {
				?>
				<span class="year-number <?php echo esc_attr( $year_class ); ?>">
					<?php echo esc_html( $prev_year ); ?>
				</span>
				<?php
			}
		}
		?>
	</div>
	<?php
	global $wp_query;
	$story_ending_text = isset( $wtl_settings['story_ending_text'] ) ? $wtl_settings['story_ending_text'] : '';
	$story_ending_link = isset( $wtl_settings['story_ending_link'] ) ? $wtl_settings['story_ending_link'] : '';
	if ( $wp_query->current_post + 1 == $wp_query->post_count && '' != $story_ending_text && 'no_pagination' === $wtl_settings['pagination_type'] ) {
		?>
		<span class="startup ending <?php echo esc_html( $eding_class ); ?>">
			<span>
				<?php if ( '' != $story_ending_link ) { ?>
					<a href="<?php echo esc_url( $story_ending_link ); ?>"><?php echo esc_html( $story_ending_text ); ?></a>
					<?php
				} else {
					echo esc_html( $story_ending_text );
				}
				?>
			</span>
		</span>
	<?php } ?>
	<?php
	$story_startup_text = isset( $wtl_settings['story_startup_text'] ) ? $wtl_settings['story_startup_text'] : '';
	if ( 1 == $alter_class && '' != $story_startup_text ) {
		?>
		<span class="startup"><span><?php echo esc_html( $story_startup_text ); ?></span></span>
		<?php
	}
	?>
	<div class="post_hentry">
		<?php
		$display_date = isset( $wtl_settings['display_date'] ) ? $wtl_settings['display_date'] : 1;
		$ar_year      = get_the_time( 'Y' );
		$ar_month     = get_the_time( 'm' );
		$ar_day       = get_the_time( 'd' );
		if ( 1 == $display_date ) {
			?>
			<div class="date-icon date-icon-arrow-bottom <?php echo esc_attr( $date_class ); ?>">
				<?php echo get_the_date( 'n/j' ); ?>
				<div class="dote dote-bottom">
					<span></span><span></span><span></span>
				</div>
			</div>
		<?php } ?>
		<div class="entity-content animateblock 
		<?php
		echo esc_html( $entity_content );
		echo ' ';
		echo ( isset( $wtl_settings['post_loop_alignment'] ) && '' != $wtl_settings['post_loop_alignment'] ) ? esc_attr( $wtl_settings['post_loop_alignment'] ) : 'default';
		?>
		">
			<?php
			$label_featured_post = ( isset( $wtl_settings['label_featured_post'] ) && '' != $wtl_settings['label_featured_post'] ) ? $wtl_settings['label_featured_post'] : '';
			if ( '' != $label_featured_post && is_sticky() ) {
				?>
				<div class="label_featured_post"><?php echo esc_html( $label_featured_post ); ?></div> 
				<?php
			}
			?>
			<div class="blog_post_wrap default">
				<?php
				Wtl_Template_Config::get_title( $wtl_settings );
				Wtl_Template_Config::get_post_image( $wtl_settings );
				?>
				<div class="wtl-post-content">
					<?php
					Wtl_Template_Config::get_content( $wtl_settings );
					Wtl_Template_Config::get_read_more_link( $wtl_settings );
					Wtl_Template_Config::get_read_more_link_2( $wtl_settings );
					Wtl_Template_Config::display_popup_excerpt( $wtl_settings );
					?>
				</div>
				<?php
				$display_author        = $wtl_settings['display_author'];
				$display_comment_count = $wtl_settings['display_comment_count'];
				if ( 1 == $display_author || 1 == $display_comment_count || ( isset( $wtl_settings['display_postlike'] ) && 1 == $wtl_settings['display_postlike'] ) ) {
					?>
					<div class="wtl-meta-content">
						<?php
						if ( 1 == $display_author ) {
							$author_link = ( isset( $wtl_settings['disable_link_author'] ) && 1 == $wtl_settings['disable_link_author'] ) ? false : true;
							?>
							<span class="author">
								<i class="fas fa-user"></i>
								<span class="link-lable"><?php esc_html_e( 'Written by', 'wp-timeline-designer-pro' ); ?></span>
								<?php
								echo ( ! $author_link ) ? '<span class="author-inner">' : '';
								echo wp_kses( Wp_Timeline_Main::wtl_get_post_auhtors( $post->ID, $wtl_settings ), Wp_Timeline_Public::args_kses() );
								echo ( ! $author_link ) ? '</span>' : '';
								?>
							</span>
							<?php
						}
						if ( 1 == $wtl_settings['display_comment_count'] ) {
							?>
							<span class="post-comment">
								<?php
								if ( isset( $wtl_settings['disable_link_comment'] ) && 1 == $wtl_settings['disable_link_comment'] ) {
									comments_number( esc_html__( 'No Comments', 'wp-timeline-designer-pro' ), '1 ' . esc_html__( 'comment', 'wp-timeline-designer-pro' ), '% ' . esc_html__( 'comments', 'wp-timeline-designer-pro' ) );
								} else {
									comments_popup_link( esc_html__( 'Leave a Comment', 'wp-timeline-designer-pro' ), esc_html__( '1 comment', 'wp-timeline-designer-pro' ), '% ' . esc_html__( 'comments', 'wp-timeline-designer-pro' ), 'comments-link', esc_html__( 'Comments are off', 'wp-timeline-designer-pro' ) );
								}
								?>
							</span>
							<?php
						}
						if ( isset( $wtl_settings['display_postlike'] ) && 1 == $wtl_settings['display_postlike'] ) {
							echo do_shortcode( '[likebtn_shortcode]' );
						}
						?>
					</div>
					<?php
				}
				?>
				<div class="wtl-post-footer">
					<div class="footer_meta">
						<?php
							Wtl_Template_Config::get_post_details( $wtl_settings );
							Wtl_Template_Config::get_category( $wtl_settings, true, true );
							Wtl_Template_Config::get_tags( $wtl_settings, true, true );
						?>
					</div>
					<?php Wp_Timeline_Main::wtl_get_social_icons( $wtl_settings ); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="<?php echo esc_attr( $curv_line ); ?>"></div>
	<?php do_action( 'wtl_after_post_content' ); ?>
</div>
<?php
do_action( 'wtl_separator_after_post' );
