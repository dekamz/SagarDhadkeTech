<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/wp_timeline_templates/blog/fullwidth-layout.php.
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
do_action( 'wtl_before_post_content' ); ?>
	<div id="wtl_date_<?php echo esc_attr( get_the_time( 'd' ) ); ?>_<?php echo esc_attr( get_the_time( 'm' ) ); ?>"  class="wtl-schedule-post-content" data-aos="<?php echo esc_attr( $wtl_animation ); ?>">
		<?php Wtl_Template_Config::get_post_image( $wtl_settings ); ?>
		<div class="wtl-schedule-all-post-content wtl_post_content_schedule">
			<?php echo wp_kses( Wtl_Template_Config::get_title( $wtl_settings ), Wtl_Template_Config::param_kses() ); ?>
			<div class="wtl-schedule-meta-content">
				<?php
				if ( isset( $wtl_settings['display_author'] ) && 1 == $wtl_settings['display_author'] ) {
					echo '<div class="wtl-author-avatar">';
					echo get_avatar( get_the_author_meta( 'ID' ), 75 );
					$author_link  = ( isset( $wtl_settings['disable_link_author'] ) && 1 == $wtl_settings['disable_link_author'] ) ? false : true;
					$author_data  = '<span class="wtl-author">';
					$author_data .= '<span class="wtl-author-name">';
					$author_data .= ( $author_link ) ? '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" >' : '';
					$author_data .= Wp_Timeline_Main::wtl_get_post_auhtors( $post->ID, $wtl_settings );
					$author_data .= ( $author_link ) ? '</a>' : '';
					$author_data .= '</span>';
					echo wp_kses( apply_filters( 'wtl_existing_authors', $author_data, get_the_author_meta( 'ID' ) ), Wp_Timeline_Public::args_kses() );
					do_action( 'wtl_extra_authors', $author_link );
					$author_data .= '</span>';
					echo '</div>';
				}
				echo wp_kses( Wtl_Template_Config::get_post_date( $wtl_settings, true ), Wp_Timeline_Public::args_kses() );

				if ( isset( $wtl_settings['display_comment_count'] ) && 1 == $wtl_settings['display_comment_count'] ) {
					?>
					<div class="wtl-meta-comment">
						<span class="metacomments" 
						<?php
						if ( ! has_post_thumbnail() && '' == $wtl_settings['wp_timeline_default_image_id'] ) {
							echo 'style="margin-right:0"';}
						?>
						>
							<i class="fas fa-comment"></i>
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
	</div>
<?php
do_action( 'wtl_after_post_content' );
do_action( 'wtl_separator_after_post' );
