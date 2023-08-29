<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/wp_timeline_templates/blog/soft-block.php.
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
$category            = Wtl_Template_Config::get_class_category( $wtl_settings );
$wtl_animation       = isset( $wtl_settings['timeline_animation'] ) ? $wtl_settings['timeline_animation'] : 'fade';
$wp_timeline_post_id = $post->ID;
$image_hover_effect  = '';
if ( isset( $wtl_settings['wp_timeline_image_hover_effect'] ) && 1 == $wtl_settings['wp_timeline_image_hover_effect'] ) {
	$image_hover_effect = ( isset( $wtl_settings['wp_timeline_image_hover_effect_type'] ) && '' != $wtl_settings['wp_timeline_image_hover_effect_type'] ) ? $wtl_settings['wp_timeline_image_hover_effect_type'] : '';
}
$post_thumbnail = 'full';
$thumbnail      = Wp_Timeline_Main::wtl_get_the_thumbnail( $wtl_settings, $post_thumbnail, get_post_thumbnail_id( $wp_timeline_post_id ), $wp_timeline_post_id );
$class          = '';
if ( empty( $thumbnail ) ) {
	$post_video_thumbnail = Wp_Timeline_Main::wtl_get_first_embed_media( $post->ID, $wtl_settings );
	if ( '' == $post_video_thumbnail ) {
		$class = 'content-full-width';
	}
}
?>
<div id="wtl_date_<?php echo esc_attr( get_the_time( 'd' ) ); ?>_<?php echo esc_attr( get_the_time( 'm' ) ); ?>"  class="wtl_blog_template soft-block-post-wrapper wtl_single_post_wrapp <?php echo esc_attr( $category ); ?>" data-aos="<?php echo esc_attr( $wtl_animation ); ?>">
	<div class="soft_block_wrapper wp_timeline_wrap">
		<div class="soft-block-flex">
			<?php do_action( 'wtl_before_post_content' ); ?>
			<div class="post-content-area <?php echo esc_attr( $class ); ?>">
				<?php
				$wp_timeline_post_title_link = isset( $wtl_settings['wp_timeline_post_title_link'] ) ? $wtl_settings['wp_timeline_post_title_link'] : 1;
				if ( 1 == $wp_timeline_post_title_link ) {
					echo '<a href="' . esc_url( get_the_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">';
				}
				?>
				<h2 class="wtl-post-title"><?php echo esc_html( get_the_title() ); ?></h2>
				<?php
				if ( 1 == $wp_timeline_post_title_link ) {
					echo '</a>';
				}
				?>
				<div class="wtl-post-meta">
					<?php
					Wtl_Template_Config::get_author( $wtl_settings );
					if ( 1 == $wtl_settings['display_date'] ) {
						$date_link = ( isset( $wtl_settings['disable_link_date'] ) && 1 == $wtl_settings['disable_link_date'] ) ? false : true;
						?>
						<span class="wtl-date-meta">
							<?php
							$date_format      = ( isset( $wtl_settings['post_date_format'] ) && 'default' !== $wtl_settings['post_date_format'] ) ? $wtl_settings['post_date_format'] : get_option( 'date_format' );
							$wp_timeline_date = ( isset( $wtl_settings['display_date_from'] ) && 'modify' === $wtl_settings['display_date_from'] ) ? apply_filters( 'wtl_date_format', get_post_modified_time( $date_format, $post->ID ), $post->ID ) : apply_filters( 'wtl_date_format', get_the_time( $date_format, $post->ID ), $post->ID );
							$ar_year          = get_the_time( 'Y' );
							$ar_month         = get_the_time( 'm' );
							$ar_day           = get_the_time( 'd' );

							echo ' <i class="far fa-calendar-alt"></i> ';
							echo ( $date_link ) ? ' <a class="mdate" href="' . esc_url( get_day_link( $ar_year, $ar_month, $ar_day ) ) . '">' : '';
							echo esc_attr( $wp_timeline_date );
							echo ( $date_link ) ? '</a>' : '';
							?>
						</span>
						<?php
					}
					Wtl_Template_Config::get_comment( $wtl_settings );
					?>
					<div class="meeting-day">
						<?php $ar_day = get_the_time( 'd' ); ?>
						<p class="day-inner"><?php echo esc_attr( $ar_day ); ?></p>
					</div>
				</div>
				<div class="wtl-post-footer">
					<div class="footer_meta">
						<?php
						echo wp_kses( Wtl_Template_Config::get_category( $wtl_settings, true, true ), Wp_Timeline_Public::args_kses() );
						echo wp_kses( Wtl_Template_Config::get_tags( $wtl_settings, true, true ), Wp_Timeline_Public::args_kses() );
						?>
					</div>
				</div>
				<div class="post_content">
					<?php
					echo wp_kses( Wp_Timeline_Main::wtl_get_content( $post->ID, $wtl_settings, $wtl_settings['rss_use_excerpt'], $wtl_settings['txtExcerptlength'] ), Wp_Timeline_Public::args_kses() );
					Wtl_Template_Config::get_read_more_link( $wtl_settings );
					Wtl_Template_Config::get_post_details( $wtl_settings );
					?>
				</div>
				<?php
				Wtl_Template_Config::get_read_more_link_2( $wtl_settings );
				Wtl_Template_Config::display_popup_excerpt( $wtl_settings );
				Wp_Timeline_Main::wtl_get_social_icons( $wtl_settings );
				?>
			</div>
				<?php Wtl_Template_Config::get_post_image( $wtl_settings ); ?>
				<?php do_action( 'wtl_after_post_content' ); ?>
		</div>
	</div>
</div>
<?php
do_action( 'wtl_separator_after_post' );
