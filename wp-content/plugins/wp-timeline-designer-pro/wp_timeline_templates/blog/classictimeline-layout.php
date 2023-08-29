<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/wp_timeline_templates/blog/classictimeline-layout.php.
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
<div id="wtl_date_<?php echo esc_attr( get_the_time( 'd' ) ); ?>_<?php echo esc_attr( get_the_time( 'm' ) ); ?>" class="wtl_blog_single_post_wrapp">
	<div class="wtl-post-schedule-content">
		<div class="wtl_year">
			<a href="<?php echo esc_url( get_year_link( get_the_time( 'Y' ) ) ); ?>"><span><?php echo esc_html( get_the_time( 'Y' ) ); ?></span></a>
		</div>
	</div>
	<div class="wtl-image-date">
		<div class="wtl-blog-image">
			<?php Wtl_Template_Classictimeline_Layout::get_post_image( $wtl_settings ); ?>
		</div>
		<?php Wtl_Template_Classictimeline_Layout::get_post_date( $wtl_settings ); ?>
	</div>
	<div class="wtl-post-inner-content">
		<div class="wtl-schedule-all-post-content wtl_post_content_schedule">
			<?php
				$defalt_icon = Wtl_Template_Filledtimeline_Layout::get_default_icon( $wtl_settings );
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
						echo '<div class="wtl-post-center-image">' . wp_kses( $dicon, $allowed_html ) . '</div>';
					} else {
						echo '<div class="wtl-post-center-image ' . esc_attr( $post_format ) . '"></div>';
					}
				}
				?>
			<div class="wtl-post-content">
				<?php do_action( 'wtl_before_post_content' ); ?>
				<?php
				Wtl_Template_Config::get_title( $wtl_settings );
				?>
				<div class="wtl-post-footer">
				<?php
				Wtl_Template_Config::get_post_details( $wtl_settings );
				?>
				<div class="wtl-post-content-inner">
					<?php
					Wtl_Template_Config::get_content( $wtl_settings );
					Wtl_Template_Config::get_read_more_link( $wtl_settings );
					?>
				</div>
				<div class="read-more-section">
					<?php
					Wtl_Template_Classictimeline_Layout::get_read_more_link_2( $wtl_settings );
					Wtl_Template_Config::display_popup_excerpt( $wtl_settings );
					?>
				</div>
				</div>
				<div class="wtl-post-meta">
					<?php
					Wtl_Template_Config::get_author( $wtl_settings );
					Wtl_Template_Config::get_category( $wtl_settings, true, true );
					Wtl_Template_Config::get_tags( $wtl_settings, true, true );
					if ( isset( $wtl_settings['display_postlike'] ) && 1 == $wtl_settings['display_postlike'] ) {

						echo do_shortcode( '[likebtn_shortcode]' );
					}
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
