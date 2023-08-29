<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/wp_timeline_templates/blog/curve-layout.php.
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

$i             = $count;
$layout_type   = $wtl_settings['layout_type'];
$wtl_animation = isset( $wtl_settings['timeline_animation'] ) ? $wtl_settings['timeline_animation'] : 'fade';
if ( 1 == $layout_type ) {
	?>
	<div class="wtl-schedule-post-content">
		<?php
		Wtl_Template_Config::get_title( $wtl_settings );
		Wtl_Template_Config::get_author( $wtl_settings );
		Wtl_Template_Config::get_comment( $wtl_settings );
		echo wp_kses( Wtl_Template_Config::get_post_date( $wtl_settings, true ), Wp_Timeline_Public::args_kses() );
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
			Wtl_Template_Config::get_post_details( $wtl_settings );
			Wtl_Template_Config::get_category( $wtl_settings, true, false );
			Wtl_Template_Config::get_tags( $wtl_settings, true, false );
			Wtl_Template_Config::get_social_media( $wtl_settings );
			?>
		</div>
	</div>
	<?php
} else {
	?>
	<li id="wtl_date_<?php echo esc_attr( get_the_time( 'd' ) ); ?>_<?php echo esc_attr( get_the_time( 'm' ) ); ?>" class="wtl-schedule-post-content" data-aos="<?php echo esc_attr( $wtl_animation ); ?>">
		<div class="wtl-blog-img">
		<?php
			Wtl_Template_Curve_Layout::get_post_image_no_link( $wtl_settings );
			Wtl_Template_Curve_Layout::get_post_counter( $wtl_settings );
		?>
		</div>
		<div class="wtl-schedule-all-post-content wtl_post_content_schedule" <?php echo esc_attr( Wtl_Template_Config::post_background_color() ); ?>>
				<?php
				Wtl_Template_Config::get_title( $wtl_settings );

				echo '<div class="wtl-post-content">';
				do_action( 'wtl_before_post_content' );
				Wtl_Template_Config::get_content( $wtl_settings );
				Wtl_Template_Config::get_read_more_link( $wtl_settings );
				Wtl_Template_Config::get_read_more_link_2( $wtl_settings );
				Wtl_Template_Config::display_popup_excerpt( $wtl_settings );
				do_action( 'wtl_after_post_content' );
				echo '</div>';

				echo '<div class="wtl-meta-content">';
				echo wp_kses( Wtl_Template_Config::get_post_date( $wtl_settings, true ), Wp_Timeline_Public::args_kses() );
				Wtl_Template_Config::get_post_details( $wtl_settings );
				Wtl_Template_Config::get_category( $wtl_settings, true, false );
				Wtl_Template_Curve_Layout::get_tags( $wtl_settings, true, false );
				Wtl_Template_Config::get_author( $wtl_settings );
				Wtl_Template_Config::get_comment( $wtl_settings );
				Wtl_Template_Config::get_social_media( $wtl_settings );

				echo '</div>';
				?>
			</div>
		<?php do_action( 'wtl_separator_after_post' ); ?>
	</li>
<?php } ?>
