<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/wp_timeline_templates/blog/zigzag-layout.php.
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
$prev_year1  = null;
$i           = $count;
$wtl_details = get_post_meta( $post->ID, '_wtl_single_details_key', true );

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
$wtl_animation = isset( $wtl_settings['timeline_animation'] ) ? $wtl_settings['timeline_animation'] : 'fade';
do_action( 'wtl_before_post_content' );
$this_year = get_the_date( 'Y' );
if ( 0 == $prev_year || $prev_year == $this_year ) {
	$prev_year = $this_year;
} else {
	$prev_year = '';
}
?>
	<div id="wtl_date_<?php echo esc_attr( get_the_time( 'd' ) ); ?>_<?php echo esc_attr( get_the_time( 'm' ) ); ?>"  class="wtl-schedule-post-content <?php echo 'post_' . esc_attr( Wtl_Template_ZigZag_Layout::even_odd( $i ) ); ?>" data-aos="<?php echo esc_attr( $wtl_animation ); ?>">
		<?php echo wp_kses( Wtl_Template_ZigZag_Layout::get_post_image( $wtl_settings ), Wp_Timeline_Public::args_kses() ); ?>
		<div id="wtl_layout_<?php echo esc_attr( $post->ID ); ?>" class="wtl-schedule-all-post-content wtl_post_content_schedule">
			<div class="content-main">
				<?php echo wp_kses( Wtl_Template_Config::get_post_date( $wtl_settings, true ), Wp_Timeline_Public::args_kses() ); ?>
				<?php echo wp_kses( Wtl_Template_Config::get_title( $wtl_settings ), Wtl_Template_Config::param_kses() ); ?>
				<div class="wtl-schedule-meta-content">
					<?php
					Wtl_Template_Config::get_author( $wtl_settings );
					Wtl_Template_Config::get_comment( $wtl_settings );
					?>
				</div>
				<div class="wtl-post-content">
					<?php
					echo wp_kses( Wtl_Template_Config::get_content( $wtl_settings ), Wp_Timeline_Public::args_kses() );
					echo wp_kses( Wtl_Template_Config::get_read_more_link( $wtl_settings ), Wp_Timeline_Public::args_kses() );
					?>
				</div>
				<div class="wtl-post-footer">
					<?php
					echo wp_kses( Wtl_Template_Config::get_read_more_link_2( $wtl_settings ), Wp_Timeline_Public::args_kses() );
					Wtl_Template_Config::display_popup_excerpt( $wtl_settings );
					echo wp_kses( Wtl_Template_Config::get_category( $wtl_settings, true, true ), Wp_Timeline_Public::args_kses() );
					echo wp_kses( Wtl_Template_Config::get_tags( $wtl_settings, true, true ), Wp_Timeline_Public::args_kses() );
					Wtl_Template_Config::get_post_details( $wtl_settings );
					Wp_Timeline_Main::wtl_get_social_icons( $wtl_settings );
					?>
				</div>
			</div>
			<div class="cross-line"></div>
		</div>
	</div>
<?php
do_action( 'wtl_after_post_content' );
do_action( 'wtl_separator_after_post' );
