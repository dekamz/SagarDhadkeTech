<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/wp_timeline_templates/blog/year-layout.php.
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
?>
<div id="wtl_date_<?php echo esc_attr( get_the_time( 'd' ) ); ?>_<?php echo esc_attr( get_the_time( 'm' ) ); ?>" class="wtl_blog_single_post_wrapp <?php echo esc_attr( Wtl_Template_Config::get_class_category( $wtl_settings ) ); ?>">
	<div data-aos="<?php echo esc_attr( $wtl_animation ); ?>" class="wtl_year wtl_year_<?php echo esc_attr( get_the_time( 'Y' ) ); ?>" data-post-year="<?php echo esc_attr( get_the_time( 'Y' ) ); ?>">
		<a href="<?php echo esc_url( get_year_link( get_the_time( 'Y' ) ) ); ?>"><span><?php echo esc_html( get_the_time( 'Y' ) ); ?></span></a>
	</div>
	<div class="wtl-post-inner-content">
		<div class="wtl-schedule-all-post-content wtl_post_content_schedule">
			<?php
			if ( isset( $wtl_settings['display_date'] ) && 1 == $wtl_settings['display_date'] ) {
				$date_link        = ( isset( $wtl_settings['disable_link_date'] ) && 1 == $wtl_settings['disable_link_date'] ) ? false : true;
				$date_format      = ( isset( $wtl_settings['post_date_format'] ) && 'default' !== $wtl_settings['post_date_format'] ) ? $wtl_settings['post_date_format'] : get_option( 'date_format' );
				$wp_timeline_date = ( isset( $wtl_settings['display_date_from'] ) && 'modify' === $wtl_settings['display_date_from'] ) ? apply_filters( 'wtl_date_format', get_post_modified_time( $date_format, $post->ID ), $post->ID ) : apply_filters( 'wtl_date_format', get_the_time( $date_format, $post->ID ), $post->ID );
				$ar_year          = get_the_time( 'Y' );
				$ar_month         = get_the_time( 'm' );
				$ar_day           = get_the_time( 'd' );
				echo '<div class="wtl-post-date" data-aos="' . esc_attr( $wtl_animation ) . '">';
				echo ( $date_link ) ? '<a class="mdate" href="' . esc_url( get_day_link( $ar_year, $ar_month, $ar_day ) ) . '">' : '';
				echo '<span><strong>' . esc_html( $ar_day ) . '</strong></span><span>' . esc_html( gmdate( 'M', mktime( 0, 0, 0, $ar_month, 10 ) ) ) . '</span>';
				echo ( $date_link ) ? '</a>' : '';
				echo '</div>';
			}
			?>
			<div class="wtl-post-content" data-aos="<?php echo esc_attr( $wtl_animation ); ?>">
				<?php do_action( 'wtl_before_post_content' ); ?>
				<?php
				Wtl_Template_Config::get_post_image( $wtl_settings );
				Wtl_Template_Config::get_title( $wtl_settings );
				Wtl_Template_Config::get_content( $wtl_settings );
				Wtl_Template_Config::get_read_more_link( $wtl_settings );
				?>
				<div class="wtl-post-footer">
				<?php
				Wtl_Template_Config::get_read_more_link_2( $wtl_settings );
				Wtl_Template_Config::display_popup_excerpt( $wtl_settings );
				Wtl_Template_Config::get_post_details( $wtl_settings );
				?>
				</div>
				<div class="wtl-post-meta">
					<?php
					Wtl_Template_Easy_Layout::get_author( $wtl_settings );
					Wtl_Template_Config::get_category( $wtl_settings, true, true );
					Wtl_Template_Config::get_tags( $wtl_settings, true, true );
					Wp_Timeline_Main::wtl_get_social_icons( $wtl_settings );
					?>
				</div>
				<?php do_action( 'wtl_after_post_content' ); ?>
			</div>
		</div>
	</div>
</div>
<?php
do_action( 'wtl_separator_after_post' );
