<?php
/**
 * Layout Templates Dynamic Style Start.
 *
 * @link       https://www.solwininfotech.com/
 * @since      1.0.0
 *
 * @package    Wp_Timeline_Designer_PRO
 * @subpackage Wp_Timeline_Designer_PRO/public
 */
?>
<style id="wtl_dynamic_style_<?php echo esc_attr( $shortcode_id ); ?>">
<?php

foreach ( $wtl_settings as $key => $val ) {
	if ( ! is_array( $val ) ) {
		${$key} = $val;
	}
}

$layout_id        = '.layout_id_' . esc_attr( $shortcode_id );
$layout_filter_id = '.layout_filter_id_' . esc_attr( $shortcode_id );

if ( 1 == $wtl_settings['display_timeline_bar'] ) { 
	echo esc_attr( $layout_id );
	?>
	.wtl_al_nav{display: none !important; opacity: 0 !important}
	<?php
}
$template_color                             = isset( $wtl_settings['template_color'] ) ? $wtl_settings['template_color'] : '';
$wp_timeline_filter_borderleftstyle         = isset( $wtl_settings['wp_timeline_filter_borderleftstyle'] ) ? $wtl_settings['wp_timeline_filter_borderleftstyle'] : '';
$wp_timeline_filter_borderright             = isset( $wtl_settings['wp_timeline_filter_borderright'] ) ? $wtl_settings['wp_timeline_filter_borderright'] : '';
$wp_timeline_filter_bordertopcolor          = isset( $wtl_settings['wp_timeline_filter_bordertopcolor'] ) ? $wtl_settings['wp_timeline_filter_bordertopcolor'] : '';
$wp_timeline_filter_borderbottomstyle       = isset( $wtl_settings['wp_timeline_filter_borderbottomstyle'] ) ? $wtl_settings['wp_timeline_filter_borderbottomstyle'] : '';
$wp_timeline_filter_borderbottomcolor       = isset( $wtl_settings['wp_timeline_filter_borderbottomcolor'] ) ? $wtl_settings['wp_timeline_filter_borderbottomcolor'] : '';
$filter_color                               = isset( $wtl_settings['filter_color'] ) ? $wtl_settings['filter_color'] : '';
$filter_background_color                    = isset( $wtl_settings['filter_background_color'] ) ? $wtl_settings['filter_background_color'] : '';
$wp_timeline_filter_hover_borderleft        = isset( $wtl_settings['wp_timeline_filter_hover_borderleft'] ) ? $wtl_settings['wp_timeline_filter_hover_borderleft'] : '';
$wp_timeline_filter_hover_borderleftstyle   = isset( $wtl_settings['wp_timeline_filter_hover_borderleftstyle'] ) ? $wtl_settings['wp_timeline_filter_hover_borderleftstyle'] : '';
$wp_timeline_filter_hover_borderleftcolor   = isset( $wtl_settings['wp_timeline_filter_hover_borderleftcolor'] ) ? $wtl_settings['wp_timeline_filter_hover_borderleftcolor'] : '';
$wp_timeline_filter_hover_borderright       = isset( $wtl_settings['wp_timeline_filter_hover_borderright'] ) ? $wtl_settings['wp_timeline_filter_hover_borderright'] : '';
$wp_timeline_filter_hover_borderrightstyle  = isset( $wtl_settings['wp_timeline_filter_hover_borderrightstyle'] ) ? $wtl_settings['wp_timeline_filter_hover_borderrightstyle'] : '';
$wp_timeline_filter_hover_borderrightcolor  = isset( $wtl_settings['wp_timeline_filter_hover_borderrightcolor'] ) ? $wtl_settings['wp_timeline_filter_hover_borderrightcolor'] : '';
$wp_timeline_filter_hover_bordertop         = isset( $wtl_settings['wp_timeline_filter_hover_bordertop'] ) ? $wtl_settings['wp_timeline_filter_hover_bordertop'] : '';
$wp_timeline_filter_hover_bordertopstyle    = isset( $wtl_settings['wp_timeline_filter_hover_bordertopstyle'] ) ? $wtl_settings['wp_timeline_filter_hover_bordertopstyle'] : '';
$wp_timeline_filter_hover_bordertopcolor    = isset( $wtl_settings['wp_timeline_filter_hover_bordertopcolor'] ) ? $wtl_settings['wp_timeline_filter_hover_bordertopcolor'] : '';
$wp_timeline_filter_hover_borderbottom      = isset( $wtl_settings['wp_timeline_filter_hover_borderbottom'] ) ? $wtl_settings['wp_timeline_filter_hover_borderbottom'] : '';
$wp_timeline_filter_hover_borderbottomstyle = isset( $wtl_settings['wp_timeline_filter_hover_borderbottomstyle'] ) ? $wtl_settings['wp_timeline_filter_hover_borderbottomstyle'] : '';
$wp_timeline_filter_hover_borderbottomcolor = isset( $wtl_settings['wp_timeline_filter_hover_borderbottomcolor'] ) ? $wtl_settings['wp_timeline_filter_hover_borderbottomcolor'] : '';
$filter_hover_color                         = isset( $wtl_settings['filter_hover_color'] ) ? $wtl_settings['filter_hover_color'] : '';
$filter_paddingtop                          = isset( $wtl_settings['filter_paddingtop'] ) ? $wtl_settings['filter_paddingtop'] : '';
$filter_paddingright                        = isset( $wtl_settings['filter_paddingright'] ) ? $wtl_settings['filter_paddingright'] : '';
$filter_paddingbottom                       = isset( $wtl_settings['filter_paddingbottom'] ) ? $wtl_settings['filter_paddingbottom'] : '';
$filter_paddingleft                         = isset( $wtl_settings['filter_paddingleft'] ) ? $wtl_settings['filter_paddingleft'] : '';
$filter_margintop                           = isset( $wtl_settings['filter_margintop'] ) ? $wtl_settings['filter_margintop'] : '';
$filter_marginright                         = isset( $wtl_settings['filter_marginright'] ) ? $wtl_settings['filter_marginright'] : '';
$filter_marginbottom                        = isset( $wtl_settings['filter_marginbottom'] ) ? $wtl_settings['filter_marginbottom'] : '';
$filter_marginleft                          = isset( $wtl_settings['filter_marginleft'] ) ? $wtl_settings['filter_marginleft'] : '';
$wp_timeline_filter_borderleft              = isset( $wtl_settings['wp_timeline_filter_borderleft'] ) ? $wtl_settings['wp_timeline_filter_borderleft'] : '';
$wp_timeline_star_rating_alignment          = isset( $wtl_settings['wp_timeline_star_rating_alignment'] ) ? $wtl_settings['wp_timeline_star_rating_alignment'] : '';
$wp_timeline_lazy_load_image 				= isset( $wtl_settings['wp_timeline_lazy_load_image'] ) ? $wtl_settings['wp_timeline_lazy_load_image'] : 0;
$wp_timeline_lazy_load_blurred_image 		= isset( $wtl_settings['wp_timeline_lazy_load_blurred_image'] ) ? $wtl_settings['wp_timeline_lazy_load_blurred_image'] : 0;
$template_lazyload_color 					= isset( $wtl_settings['template_lazyload_color'] ) ? $wtl_settings['template_lazyload_color'] : '#000';
$template_contentcolor 						= isset($wtl_settings['template_contentcolor']) ? $wtl_settings['template_contentcolor'] : '';
$wp_year_timeline_side	 					= isset( $wtl_settings['wp_year_timeline_side'] ) ? $wtl_settings['wp_year_timeline_side'] : '';
$wp_year_timeline_left_right_side 			= isset($wtl_settings['wp_year_timeline_left_right_side']) ? $wtl_settings['wp_year_timeline_left_right_side'] : '';
$wp_timeline_template_name 					= isset($wtl_settings['template_name']) ? $wtl_settings['template_name'] : '';

if($wp_year_timeline_side == 1) {
	if($wp_year_timeline_left_right_side == 0) { ?>
		.wtl-bullets-container {
			right: 0;
		}
		#wp-timeline-preview-box .wtl-bullets-container {
			right: 90px;
		}
<?php
	} else { ?>
		.wtl-bullets-container {
			left: -50px;
		}
		.theme-twentytwentythree .wtl-bullets-container {
			left: -40px;
		}
		#wp-timeline-preview-box .wtl-bullets-container {
			left: 120px;
		}
	<?php
	}
	if( 'business_layout' == $wp_timeline_template_name ) {
		if($wp_year_timeline_left_right_side == 0) { ?>
			.wtl-bullets-container {
				right: 25px !important;
				margin: 5vh auto !important;
			}
	<?php
		} else { ?>
			.wtl-bullets-container {
				left: -10px !important;
				margin: 5vh auto !important;
			}
		<?php
		}
	}
}

if($wp_timeline_lazy_load_image == 1) {
	if($wp_timeline_lazy_load_blurred_image == 1) { ?>
	<?php echo esc_attr( $layout_id ); ?> .wp-timeline-post-image .lazyload,
	<?php echo esc_attr( $layout_id ); ?> .wp-timeline-post-image .lazyloading,
	<?php echo esc_attr( $layout_id ); ?> .post-image .lazyload,
	<?php echo esc_attr( $layout_id ); ?> .post-image .lazyloading {
		-webkit-filter: blur(10px);
		filter: blur(10px);
		transition: filter 6000ms, -webkit-filter 6000ms;
	}
	<?php }
	if(!empty($template_lazyload_color)) { ?>
	<?php echo esc_attr( $layout_id ); ?> .wp-timeline-post-image .lazyload,
	<?php echo esc_attr( $layout_id ); ?> .wp-timeline-post-image .lazyloading,
	<?php echo esc_attr( $layout_id ); ?> .post-image .lazyload,
	<?php echo esc_attr( $layout_id ); ?> .post-image .lazyloading {
		background-color: <?php echo $template_lazyload_color; ?>;
	}
	<?php }
}
/* ------------------------- Load More Button ------------------------- */
if ( isset( $pagination_type ) && ( 'load_more_btn' === $pagination_type || 'load_onscroll_btn' === $pagination_type ) ) {
	if ( isset( $loadmore_button_color ) && '' !== $loadmore_button_color ) {
		?>
		<?php echo esc_attr( $layout_id ); ?> .wtl-load-more .button.wtl-load-more-btn:hover {
			background: <?php echo esc_attr( $loadmore_button_color ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-load-more a.button.wtl-load-more-btn.template-3,
		<?php echo esc_attr( $layout_id ); ?> .wtl-load-more a.button.wtl-load-more-btn:not(.template-3) {
			color: <?php echo esc_attr( $loadmore_button_color ); ?>;
		}
		<?php
	}
	if ( isset( $loadmore_button_bg_color ) && '' !== $loadmore_button_bg_color ) {
		?>
		<?php echo esc_attr( $layout_id ); ?> .wtl-load-more a.button.wtl-load-more-btn.template-3:hover,
		<?php echo esc_attr( $layout_id ); ?> .wtl-load-more .button.wtl-load-more-btn:hover {
			color: <?php echo esc_attr( $loadmore_button_bg_color ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-load-more a.button.wtl-load-more-btn.template-3 span:before,
		<?php echo esc_attr( $layout_id ); ?> .wtl-load-more a.button.wtl-load-more-btn.template-3 span:after,
		<?php echo esc_attr( $layout_id ); ?> .wtl-load-more a.button.wtl-load-more-btn:not(.template-3) {
			background: <?php echo esc_attr( $loadmore_button_bg_color ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-load-more a.button.wtl-load-more-btn,
		<?php echo esc_attr( $layout_id ); ?> .wtl-load-more a.button.wtl-load-more-btn.template-3:before,
		<?php echo esc_attr( $layout_id ); ?> .wtl-load-more a.button.wtl-load-more-btn.template-3:after {
			border-color: <?php echo esc_attr( $loadmore_button_bg_color ); ?>;
		}
		<?php
	}
}
if ( isset( $pagination_type ) && ( 'load_more_btn' === $pagination_type || 'load_onscroll_btn' === $pagination_type ) && isset( $loader_color ) && '' !== $loader_color ) {
	?>
	<?php echo esc_attr( $layout_id ); ?> .wtl-circularG, <?php echo esc_attr( $layout_id ); ?> .wtl-windows8 .wtl-wBall .wtl-wInnerBall, <?php echo esc_attr( $layout_id ); ?> .wtl-cssload-thecube .wtl-cssload-cube:before,<?php echo esc_attr( $layout_id ); ?>.wtl-ball-grid-pulse > div,<?php echo esc_attr( $layout_id ); ?> .wtl-square,<?php echo esc_attr( $layout_id ); ?> .wtl-floatBarsG,<?php echo esc_attr( $layout_id ); ?> .wtl-movingBallLineG,<?php echo esc_attr( $layout_id ); ?> .wtl-movingBallG,<?php echo esc_attr( $layout_id ); ?> .wtl-cssload-ball:after,<?php echo esc_attr( $layout_id ); ?> .wtl-spinload-loading i:first-child,<?php echo esc_attr( $layout_id ); ?> .wtl-csball-loading i:nth-child(1),<?php echo esc_attr( $layout_id ); ?> .wtl-csball-loading i:nth-child(1):before,<?php echo esc_attr( $layout_id ); ?> .wtl-csball-loading i:nth-child(1):after,<?php echo esc_attr( $layout_id ); ?> .wtl-bigball-loading i,<?php echo esc_attr( $layout_id ); ?> .wtl-bubble-loading i,<?php echo esc_attr( $layout_id ); ?> .wtl-ccball-loading i:nth-child(1),<?php echo esc_attr( $layout_id ); ?> .wtl-ccball-loading i:nth-child(2):before,<?php echo esc_attr( $layout_id ); ?> .wtl-cssload-dots:nth-child(n):before,<?php echo esc_attr( $layout_id ); ?> .wtl-circlewave {
		background-color: <?php echo esc_attr( $loader_color ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-square:nth-child(3),<?php echo esc_attr( $layout_id ); ?> .wtl-spinload-loading i,<?php echo esc_attr( $layout_id ); ?> .wtl-bigball-loading i:nth-child(2),<?php echo esc_attr( $layout_id ); ?> .wtl-bubble-loading i:nth-child(2),<?php echo esc_attr( $layout_id ); ?> .wtl-csball-loading i:nth-child(2),<?php echo esc_attr( $layout_id ); ?> .wtl-csball-loading i:nth-child(2):before,<?php echo esc_attr( $layout_id ); ?> .wtl-csball-loading i:nth-child(2):after,<?php echo esc_attr( $layout_id ); ?> .wtl-ccball-loading i:nth-child(2),<?php echo esc_attr( $layout_id ); ?> .wtl-ccball-loading i:nth-child(1):before,<?php echo esc_attr( $layout_id ); ?> .wtl-cssload-dots:nth-child(n):after {background-color: <?php echo esc_attr( $template_ftcolor ); ?>;}
	.wtl-circlewave:after,<?php echo esc_attr( $layout_id ); ?> .wtl-doublec-loading:before,<?php echo esc_attr( $layout_id ); ?> .wtl-spinloader,<?php echo esc_attr( $layout_id ); ?> .wtl-cssload-inner.wtl-cssload-three {border-top-color: <?php echo esc_attr( $loader_color ); ?>;}
	.wtl-circlewave:after,<?php echo esc_attr( $layout_id ); ?> .wtl-doublec-loading,<?php echo esc_attr( $layout_id ); ?> .wtl-cssload-inner.wtl-cssload-one {border-bottom-color: <?php echo esc_attr( $loader_color ); ?>;}
	.wtl-doublec-loading:before,<?php echo esc_attr( $layout_id ); ?> .wtl-cssload-aim,<?php echo esc_attr( $layout_id ); ?> .wtl-cssload-inner.wtl-cssload-two {border-right-color: <?php echo esc_attr( $loader_color ); ?>}
	.wtl-doublec-loading,<?php echo esc_attr( $layout_id ); ?> .wtl-cssload-aim {border-left-color: <?php echo esc_attr( $loader_color ); ?>;}
	.wtl-doublec-loading:after,<?php echo esc_attr( $layout_id ); ?> .wtl-facebook_blockG,<?php echo esc_attr( $layout_id ); ?> .wtl-loader div,<?php echo esc_attr( $layout_id ); ?> .wtl-cssload-ball {border-color: <?php echo esc_attr( $loader_color ); ?>;}
	.wtl-warningGradientOuterBarG {
		border-color: <?php echo esc_attr( $loader_color ); ?>;
		background: -moz-gradient(linear,0% 0%,0% 100%,from(#fff),to(<?php echo esc_attr( $loader_color ); ?>));
		background: linear-gradient(top,#fff,<?php echo esc_attr( $loader_color ); ?>);
		background: -o-linear-gradient(top,#fff,<?php echo esc_attr( $loader_color ); ?>);
		background: -ms-linear-gradient(top,#fff,<?php echo esc_attr( $loader_color ); ?>);
		background: -webkit-linear-gradient(top,#fff,<?php echo esc_attr( $loader_color ); ?>);
		background: -moz-linear-gradient(top,#fff,<?php echo esc_attr( $loader_color ); ?>);
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-cssload-heartL, <?php echo esc_attr( $layout_id ); ?> .wtl-cssload-heartR, <?php echo esc_attr( $layout_id ); ?> .wtl-cssload-square {
		border-color: <?php echo esc_attr( $loader_color ); ?>;
		background-color: <?php echo esc_attr( $loader_color ); ?>;
	}
	<?php if ( isset( $template_fthovercolor ) && '' !== $template_fthovercolor ) { ?>
		<?php echo esc_attr( $layout_id ); ?> .wtl-spinload-loading i:last-child,<?php echo esc_attr( $layout_id ); ?> .wtl-csball-loading i:nth-child(3),<?php echo esc_attr( $layout_id ); ?> .wtl-csball-loading i:nth-child(3):before,<?php echo esc_attr( $layout_id ); ?> .wtl-csball-loading i:nth-child(3):after {
			background-color: <?php echo esc_attr( $template_fthovercolor ); ?>;
		}
	<?php } ?>
	@keyframes audio_wave {
		0% {height:5px;transform:translateY(0px);background:<?php echo esc_attr( $loader_color ); ?>}
		25% {height:30px;transform:translateY(15px);background:<?php echo esc_attr( $template_ftcolor ); ?>}
		50% {height:5px;transform:translateY(0px);background:<?php echo esc_attr( $loader_color ); ?>}
		100% {height:5px;transform:translateY(0px);background:<?php echo esc_attr( $template_ftcolor ); ?>}
	}
	@keyframes fadeG {0%{background-color:<?php echo esc_attr( $loader_color ); ?>}100%{background-color:rgb(255,255,255)}}
	@keyframes circlewave {0% {transform: rotate(0deg)}50% {transform: rotate(180deg);background:<?php echo esc_attr( $template_ftcolor ); ?>;}100% {transform: rotate(360deg)}}
	@keyframes circlewave_after {0% {border-top:10px solid #9b59b6;border-bottom:10px solid <?php echo esc_attr( $template_ftcolor ); ?>}50% {border-top:10px solid #3498db;border-bottom:10px solid <?php echo esc_attr( $loader_color ); ?>}100% {border-top:10px solid #9b59b6;border-bottom:10px solid <?php echo esc_attr( $template_ftcolor ); ?>}}
	@keyframes f_fadeG{0%{background-color:<?php echo esc_attr( $loader_color ); ?>}100%{background-color:rgb(255,255,255)}}
	@keyframes ballsWaveG{0%{background-color:<?php echo esc_attr( $loader_color ); ?>}100%{background-color:rgb(255,255,255)}}
	@keyframes bounce_floatBarsG{0%{transform:scale(1);background-color:<?php echo esc_attr( $loader_color ); ?>}100%{transform:scale(.3);background-color:rgb(255,255,255)}}
	@keyframes bounce_fountainG{0%{transform:scale(1);background-color:<?php echo esc_attr( $loader_color ); ?>}100%{transform:scale(.3);background-color:rgb(255,255,255)}}
	<?php
}
if ( isset( $social_icon_style ) && isset( $social_style ) && 0 == $social_icon_style && 0 == $social_style ) { 
	?>
	<?php echo esc_attr( $layout_id ); ?> .social-component a {border-radius: 100%}
	<?php
}
if ( isset( $read_more_link ) && isset( $read_more_on ) && 1 == $read_more_link && '2' === $read_more_on ) { 
	?>
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl-read-more-div a.more-tag {
		<?php
		if ( isset( $readmore_font_family ) && '' !== $readmore_font_family ) {
			?>
			font-family: <?php echo esc_attr( $readmore_font_family ); ?><?php } ?>
		<?php
		if ( isset( $wp_timeline_readmore_button_borderleft ) && '' !== $wp_timeline_readmore_button_borderleft ) {
			?>
			border-left:<?php echo esc_attr( $wp_timeline_readmore_button_borderleft ) . 'px'; ?> <?php echo esc_attr( $read_more_button_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_borderleftcolor ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_readmore_button_borderright ) && '' !== $wp_timeline_readmore_button_borderright ) {
			?>
			border-right:<?php echo esc_attr( $wp_timeline_readmore_button_borderright ) . 'px'; ?> <?php echo esc_attr( $read_more_button_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_borderrightcolor ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_readmore_button_bordertop ) && '' !== $wp_timeline_readmore_button_bordertop ) {
			?>
			border-top:<?php echo esc_attr( $wp_timeline_readmore_button_bordertop ) . 'px'; ?> <?php echo esc_attr( $read_more_button_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_bordertopcolor ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_readmore_button_borderbottom ) && '' !== $wp_timeline_readmore_button_borderbottom ) {
			?>
			border-bottom:<?php echo esc_attr( $wp_timeline_readmore_button_borderbottom ) . 'px'; ?> <?php echo esc_attr( $read_more_button_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_borderbottomcolor ); ?>;<?php } ?>
		<?php
		if ( isset( $readmore_button_border_radius ) && '' !== $readmore_button_border_radius ) {
			?>
			border-radius: <?php echo esc_attr( $readmore_button_border_radius ) . 'px'; ?>;<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl-read-more-div a.wtl-read-more:hover {
		<?php
		if ( isset( $wp_timeline_readmore_button_hover_borderleft ) && '' !== $wp_timeline_readmore_button_hover_borderleft ) {
			?>
			border-left:<?php echo esc_attr( $wp_timeline_readmore_button_hover_borderleft ) . 'px'; ?> <?php echo esc_attr( $read_more_button_hover_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_hover_borderleftcolor ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_readmore_button_hover_borderright ) && '' !== $wp_timeline_readmore_button_hover_borderright ) {
			?>
			border-right:<?php echo esc_attr( $wp_timeline_readmore_button_hover_borderright ) . 'px'; ?> <?php echo esc_attr( $read_more_button_hover_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_hover_borderrightcolor ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_readmore_button_hover_bordertop ) && '' !== $wp_timeline_readmore_button_hover_bordertop ) {
			?>
			border-top:<?php echo esc_attr( $wp_timeline_readmore_button_hover_bordertop ) . 'px'; ?> <?php echo esc_attr( $read_more_button_hover_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_hover_bordertopcolor ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_readmore_button_hover_borderbottom ) && '' !== $wp_timeline_readmore_button_hover_borderbottom ) {
			?>
			border-bottom:<?php echo esc_attr( $wp_timeline_readmore_button_hover_borderbottom ) . 'px'; ?> <?php echo esc_attr( $read_more_button_hover_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_hover_borderbottomcolor ); ?>;<?php } ?>
		<?php
		if ( isset( $readmore_button_hover_border_radius ) && '' !== $readmore_button_hover_border_radius ) {
			?>
			border-radius: <?php echo esc_attr( $readmore_button_hover_border_radius ) . 'px'; ?>;<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl-read-more-div {
		<?php
		if ( isset( $readmore_button_margintop ) && '' !== $readmore_button_margintop ) {
			?>
			margin-top:<?php echo esc_attr( $readmore_button_margintop ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $readmore_button_marginright ) && '' !== $readmore_button_marginright ) {
			?>
			margin-right:<?php echo esc_attr( $readmore_button_marginright ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $readmore_button_marginbottom ) && '' !== $readmore_button_marginbottom ) {
			?>
			margin-bottom:<?php echo esc_attr( $readmore_button_marginbottom ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $readmore_button_marginleft ) && '' !== $readmore_button_marginleft ) {
			?>
			margin-left:<?php echo esc_attr( $readmore_button_marginleft ) . 'px'; ?>;<?php } ?>
		display: block;
	}
	<?php
		/* Read More Padding */
	?>
		<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl-read-more-div a.wtl-read-more,
		<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl-read-more-div a.more-tag {
		<?php
		if ( isset( $readmore_button_paddingtop ) && '' !== $readmore_button_paddingtop ) {
			?>
			padding-top: <?php echo esc_attr( $readmore_button_paddingtop ) . 'px'; ?>; <?php } ?>
		<?php
		if ( isset( $readmore_button_paddingbottom ) && '' !== $readmore_button_paddingbottom ) {
			?>
			padding-bottom: <?php echo esc_attr( $readmore_button_paddingbottom ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $readmore_button_paddingright ) && '' !== $readmore_button_paddingright ) {
			?>
			padding-right: <?php echo esc_attr( $readmore_button_paddingright ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $readmore_button_paddingleft ) && '' !== $readmore_button_paddingleft ) {
			?>
			padding-left: <?php echo esc_attr( $readmore_button_paddingleft ) . 'px'; ?>;<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-read-more-div {
		<?php
		if ( isset( $readmore_button_alignment ) && '' !== $readmore_button_alignment ) {
			?>
			text-align: <?php echo esc_attr( $readmore_button_alignment ); ?>; <?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-read-more-div .wtl-read-more{
		display: inline-block;
	}
<?php } ?>
<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template a.wtl-read-more,
<?php echo esc_attr( $layout_id ); ?> .wtl-read-more-div a.more-tag {
	<?php
	if ( isset( $readmore_fontsize ) && '' !== $readmore_fontsize ) {
		?>
		font-size: <?php echo esc_attr( $readmore_fontsize ) . 'px'; ?>; <?php } ?>
	<?php
	if ( isset( $template_readmorecolor ) && '' !== $template_readmorecolor ) {
		?>
		color:<?php echo esc_attr( $template_readmorecolor ); ?> !important;<?php } ?>
	<?php
	if ( isset( $readmore_font_weight ) && '' !== $readmore_font_weight ) {
		?>
		font-weight: <?php echo esc_attr( $readmore_font_weight ); ?>;<?php } ?>
	<?php
	if ( isset( $readmore_font_line_height ) && '' !== $readmore_font_line_height ) {
		?>
		line-height: <?php echo esc_attr( $readmore_font_line_height ); ?>;<?php } ?>
	<?php
	if ( isset( $readmore_font_italic ) && 1 == $readmore_font_italic ) { 
		?>
		font-style: <?php echo 'italic'; ?>;<?php } ?>
	<?php
	if ( isset( $readmore_font_text_transform ) && '' !== $readmore_font_text_transform ) {
		?>
		text-transform: <?php echo esc_attr( $readmore_font_text_transform ); ?>;<?php } ?>
	<?php
	if ( isset( $readmore_font_text_decoration ) && '' !== $readmore_font_text_decoration ) {
		?>
		text-decoration: <?php echo esc_attr( $readmore_font_text_decoration ); ?>;<?php } ?>
	<?php
	if ( isset( $readmore_font_letter_spacing ) && '' !== $readmore_font_letter_spacing ) {
		?>
		letter-spacing: <?php echo esc_attr( $readmore_font_letter_spacing ) . 'px'; ?>;<?php } ?>
} 
<?php
// if ( !isset( $template_readmorehovercolor ) && '' !== $template_readmorehovercolor ) {
	?>
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template a.wtl-read-more:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl-read-more-div a.wtl-read-more:hover {
		color:<?php echo esc_attr( $template_readmorehovercolor ); ?> !important;
	}
	<?php
// }
?>

/** Next Line Read more button css */
<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl-pinterest-share-image a {background-image: url("<?php echo esc_url( plugins_url() ); ?>/wp-timeline-designer-pro/images/pinterest.png")}
<?php
// Same line read more button css.
if ( isset( $read_more_link ) && isset( $read_more_on ) && 1 == $read_more_link && 1 == $read_more_on ) { 
	?>
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template a.more-tag {margin-left: 5px;padding: 0;border: none;background:none}
	<?php
}
/** Easy Digital Download Setting Css */
if ( 'easy-digital-downloads/easy-digital-downloads.php' ) {
	?>
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_edd_price_wrapper {
		<?php
		if ( isset( $wp_timeline_edd_price_alignment ) && '' !== $wp_timeline_edd_price_alignment ) {
			?>
			text-align: <?php echo esc_attr( $wp_timeline_edd_price_alignment ); ?>;<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_edd_price_wrapper .edd_price {
		<?php
		if ( isset( $wp_timeline_edd_price_paddingleft ) && '' !== $wp_timeline_edd_price_paddingleft ) {
			?>
			padding-left: <?php echo esc_attr( $wp_timeline_edd_price_paddingleft ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_price_paddingright ) && '' !== $wp_timeline_edd_price_paddingright ) {
			?>
			padding-right: <?php echo esc_attr( $wp_timeline_edd_price_paddingright ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_price_paddingtop ) && '' !== $wp_timeline_edd_price_paddingtop ) {
			?>
			padding-top: <?php echo esc_attr( $wp_timeline_edd_price_paddingtop ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_price_paddingbottom ) && '' !== $wp_timeline_edd_price_paddingbottom ) {
			?>
			padding-bottom: <?php echo esc_attr( $wp_timeline_edd_price_paddingbottom ) . 'px'; ?>;<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_edd_price_wrapper .edd_price span {padding:0}
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_edd_price_wrapper .edd_price,
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_edd_price_wrapper .edd_price span {
		<?php
		if ( isset( $wp_timeline_edd_price_color ) && '' !== $wp_timeline_edd_price_color ) {
			?>
			color: <?php echo esc_attr( $wp_timeline_edd_price_color ); ?> !important; <?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_pricefontsize ) && '' !== $wp_timeline_edd_pricefontsize ) {
			?>
			font-size: <?php echo esc_attr( $wp_timeline_edd_pricefontsize ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_pricefontface ) && '' !== $wp_timeline_edd_pricefontface ) {
			?>
			font-family: <?php echo esc_attr( $wp_timeline_edd_pricefontface ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_price_font_weight ) && '' !== $wp_timeline_edd_price_font_weight ) {
			?>
			font-weight: <?php echo esc_attr( $wp_timeline_edd_price_font_weight ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_price_font_line_height ) && '' !== $wp_timeline_edd_price_font_line_height ) {
			?>
			line-height: <?php echo esc_attr( $wp_timeline_edd_price_font_line_height ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_price_font_italic ) && 1 == $wp_timeline_edd_price_font_italic ) { 
			?>
			font-style: <?php echo 'italic'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_price_font_letter_spacing ) && '' !== $wp_timeline_edd_price_font_letter_spacing ) {
			?>
			letter-spacing: <?php echo esc_attr( $wp_timeline_edd_price_font_letter_spacing ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_price_font_text_decoration ) && '' !== $wp_timeline_edd_price_font_text_decoration ) {
			?>
			text-decoration: <?php echo esc_attr( $wp_timeline_edd_price_font_text_decoration ); ?>;<?php } ?>
		width: auto;word-break: break-all;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_edd_download_buy_button {
		<?php
		if ( isset( $wp_timeline_edd_addtocart_button_fontface ) && '' !== $wp_timeline_edd_addtocart_button_fontface ) {
			?>
			font-family: <?php echo esc_attr( $wp_timeline_edd_addtocart_button_fontface ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_addtocart_button_fontsize ) && '' !== $wp_timeline_edd_addtocart_button_fontsize ) {
			?>
			font-size: <?php echo esc_attr( $wp_timeline_edd_addtocart_button_fontsize ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_addtocart_button_font_weight ) && '' !== $wp_timeline_edd_addtocart_button_font_weight ) {
			?>
			font-weight: <?php echo esc_attr( $wp_timeline_edd_addtocart_button_font_weight ); ?>;<?php } ?>
		<?php
		if ( isset( $display_edd_addtocart_button_line_height ) && '' !== $display_edd_addtocart_button_line_height ) {
			?>
			line-height: <?php echo esc_attr( $display_edd_addtocart_button_line_height ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_addtocart_button_font_italic ) && 1 == $wp_timeline_edd_addtocart_button_font_italic ) { 
			?>
			font-style: <?php echo 'italic'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_addtocart_button_letter_spacing ) && '' !== $wp_timeline_edd_addtocart_button_letter_spacing ) {
			?>
			letter-spacing: <?php echo esc_attr( $wp_timeline_edd_addtocart_button_letter_spacing ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_addtocart_button_font_text_transform ) && '' !== $wp_timeline_edd_addtocart_button_font_text_transform ) {
			?>
			text-transform: <?php echo esc_attr( $wp_timeline_edd_addtocart_button_font_text_transform ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_addtocart_button_font_text_decoration ) && '' !== $wp_timeline_edd_addtocart_button_font_text_decoration ) {
			?>
			text-decoration: <?php echo esc_attr( $wp_timeline_edd_addtocart_button_font_text_decoration ); ?> !important;<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_edd_download_buy_button a.wp_timeline_edd_view_button,
	<?php echo esc_attr( $layout_id ); ?> .wtl_edd_download_buy_button .edd_go_to_checkout,
	<?php echo esc_attr( $layout_id ); ?> .wtl_edd_download_buy_button .edd-add-to-cart-label,
	<?php echo esc_attr( $layout_id ); ?> .wtl_edd_download_buy_button .edd-add-to-cart {
		<?php
		if ( isset( $wp_timeline_edd_addtocart_button_fontface ) && '' !== $wp_timeline_edd_addtocart_button_fontface ) {
			?>
			font-family: <?php echo esc_attr( $wp_timeline_edd_addtocart_button_fontface ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_addtocart_button_fontsize ) && '' !== $wp_timeline_edd_addtocart_button_fontsize ) {
			?>
			font-size: <?php echo esc_attr( $wp_timeline_edd_addtocart_button_fontsize ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_addtocart_button_font_weight ) && '' !== $wp_timeline_edd_addtocart_button_font_weight ) {
			?>
			font-weight: <?php echo esc_attr( $wp_timeline_edd_addtocart_button_font_weight ); ?>;<?php } ?>
		<?php
		if ( isset( $display_edd_addtocart_button_line_height ) && '' !== $display_edd_addtocart_button_line_height ) {
			?>
			line-height: <?php echo esc_attr( $display_edd_addtocart_button_line_height ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_addtocart_button_font_italic ) && 1 == $wp_timeline_edd_addtocart_button_font_italic ) { 
			?>
			font-style: <?php echo 'italic'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_addtocart_button_letter_spacing ) && '' !== $wp_timeline_edd_addtocart_button_letter_spacing ) {
			?>
			letter-spacing: <?php echo esc_attr( $wp_timeline_edd_addtocart_button_letter_spacing ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_addtocart_button_font_text_transform ) && '' !== $wp_timeline_edd_addtocart_button_font_text_transform ) {
			?>
			text-transform: <?php echo esc_attr( $wp_timeline_edd_addtocart_button_font_text_transform ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_addtocart_button_font_text_decoration ) && '' !== $wp_timeline_edd_addtocart_button_font_text_decoration ) {
			?>
			text-decoration: <?php echo esc_attr( $wp_timeline_edd_addtocart_button_font_text_decoration ); ?> !important;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_addtocart_textcolor ) && '' !== $wp_timeline_edd_addtocart_textcolor ) {
			?>
			color: <?php echo esc_attr( $wp_timeline_edd_addtocart_textcolor ); ?> !important;<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_edd_download_buy_button a.wp_timeline_edd_view_button,
	<?php echo esc_attr( $layout_id ); ?> .wtl_edd_download_buy_button .edd_go_to_checkout,
	<?php echo esc_attr( $layout_id ); ?> .wtl_edd_download_buy_button .edd-add-to-cart { 
		<?php
		if ( isset( $wp_timeline_edd_addtocart_backgroundcolor ) && '' !== $wp_timeline_edd_addtocart_backgroundcolor ) {
			?>
			background-color: <?php echo esc_attr( $wp_timeline_edd_addtocart_backgroundcolor ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_addtocartbutton_borderleft ) && '' !== $wp_timeline_edd_addtocartbutton_borderleft ) {
			?>
			border-left:<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_borderleft ) . 'px'; ?> solid <?php echo esc_attr( $wp_timeline_edd_addtocartbutton_borderleftcolor ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_addtocartbutton_borderright ) && '' !== $wp_timeline_edd_addtocartbutton_borderright ) {
			?>
			border-right:<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_borderright ) . 'px'; ?> solid <?php echo esc_attr( $wp_timeline_edd_addtocartbutton_borderrightcolor ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_addtocartbutton_bordertop ) && '' !== $wp_timeline_edd_addtocartbutton_bordertop ) {
			?>
			border-top:<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_bordertop ) . 'px'; ?> solid <?php echo esc_attr( $wp_timeline_edd_addtocartbutton_bordertopcolor ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_addtocartbutton_borderbuttom ) && '' !== $wp_timeline_edd_addtocartbutton_borderbuttom ) {
			?>
			border-bottom:<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_borderbuttom ) . 'px'; ?> solid <?php echo esc_attr( $wp_timeline_edd_addtocartbutton_borderbottomcolor ); ?>;<?php } ?>
		<?php
		if ( isset( $display_edd_addtocart_button_border_radius ) && '' !== $display_edd_addtocart_button_border_radius ) {
			?>
			border-radius:<?php echo esc_attr( $display_edd_addtocart_button_border_radius ) . 'px'; ?>;<?php } ?>
		<?php if ( isset( $wp_timeline_edd_addtocartbutton_padding_topbottom ) && '' !== $wp_timeline_edd_addtocartbutton_padding_topbottom ) { ?>
			padding-top: <?php echo esc_attr( $wp_timeline_edd_addtocartbutton_padding_topbottom ) . 'px'; ?>;
			padding-bottom: <?php echo esc_attr( $wp_timeline_edd_addtocartbutton_padding_topbottom ) . 'px'; ?>;
		<?php } ?>
		<?php if ( isset( $wp_timeline_edd_addtocartbutton_padding_leftright ) && '' !== $wp_timeline_edd_addtocartbutton_padding_leftright ) { ?>
			padding-left: <?php echo esc_attr( $wp_timeline_edd_addtocartbutton_padding_leftright ) . 'px'; ?>;
			padding-right: <?php echo esc_attr( $wp_timeline_edd_addtocartbutton_padding_leftright ) . 'px'; ?>;
		<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_addtocart_button_box_shadow_color ) && '' !== $wp_timeline_edd_addtocart_button_box_shadow_color ) {
			?>
			box-shadow: <?php echo esc_attr( $wp_timeline_edd_addtocart_button_top_box_shadow ) . 'px'; ?> <?php echo esc_attr( $wp_timeline_edd_addtocart_button_right_box_shadow ) . 'px'; ?> <?php echo esc_attr( $wp_timeline_edd_addtocart_button_bottom_box_shadow ) . 'px'; ?> <?php echo esc_attr( $wp_timeline_edd_addtocart_button_left_box_shadow ) . 'px'; ?> <?php echo esc_attr( $wp_timeline_edd_addtocart_button_box_shadow_color ); ?>; <?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_edd_download_buy_button {
		<?php
		if ( isset( $wp_timeline_edd_addtocartbutton_alignment ) && '' !== $wp_timeline_edd_addtocartbutton_alignment ) {
			?>
			text-align: <?php echo esc_attr( $wp_timeline_edd_addtocartbutton_alignment ); ?>;<?php } ?>
		<?php if ( isset( $wp_timeline_edd_addtocartbutton_margin_topbottom ) && '' !== $wp_timeline_edd_addtocartbutton_margin_topbottom ) { ?>
			margin-top: <?php echo esc_attr( $wp_timeline_edd_addtocartbutton_margin_topbottom ) . 'px'; ?>;
			margin-bottom: <?php echo esc_attr( $wp_timeline_edd_addtocartbutton_margin_topbottom ) . 'px'; ?>;
		<?php } ?>
		<?php if ( isset( $wp_timeline_edd_addtocartbutton_margin_leftright ) && '' !== $wp_timeline_edd_addtocartbutton_margin_leftright ) { ?>
			margin-left: <?php echo esc_attr( $wp_timeline_edd_addtocartbutton_margin_leftright ) . 'px'; ?>;
			margin-right:<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_margin_leftright ) . 'px'; ?>
		<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_edd_download_buy_button a.wp_timeline_edd_view_button:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl_edd_download_buy_button .edd_go_to_checkout:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl_edd_download_buy_button .edd-add-to-cart:hover {
		<?php
		if ( isset( $wp_timeline_edd_addtocart_hover_backgroundcolor ) && '' !== $wp_timeline_edd_addtocart_hover_backgroundcolor ) {
			?>
			background-color: <?php echo esc_attr( $wp_timeline_edd_addtocart_hover_backgroundcolor ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_addtocartbutton_hover_borderleft ) && '' !== $wp_timeline_edd_addtocartbutton_hover_borderleft ) {
			?>
			border-left:<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_hover_borderleft ) . 'px'; ?> solid <?php echo esc_attr( $wp_timeline_edd_addtocartbutton_hover_borderleftcolor ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_addtocartbutton_hover_borderright ) && '' !== $wp_timeline_edd_addtocartbutton_hover_borderright ) {
			?>
			border-right:<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_hover_borderright ) . 'px'; ?> solid <?php echo esc_attr( $wp_timeline_edd_addtocartbutton_hover_borderrightcolor ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_addtocartbutton_hover_bordertop ) && '' !== $wp_timeline_edd_addtocartbutton_hover_bordertop ) {
			?>
			border-top:<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_hover_bordertop ) . 'px'; ?> solid <?php echo esc_attr( $wp_timeline_edd_addtocartbutton_hover_bordertopcolor ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_addtocartbutton_hover_borderbuttom ) && '' !== $wp_timeline_edd_addtocartbutton_hover_borderbuttom ) {
			?>
			border-bottom:<?php echo esc_attr( $wp_timeline_edd_addtocartbutton_hover_borderbuttom ) . 'px'; ?> solid <?php echo esc_attr( $wp_timeline_edd_addtocartbutton_hover_borderbottomcolor ); ?>;<?php } ?>
		<?php
		if ( isset( $display_edd_addtocart_button_border_hover_radius ) && '' !== $display_edd_addtocart_button_border_hover_radius ) {
			?>
			border-radius:<?php echo esc_attr( $display_edd_addtocart_button_border_hover_radius ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_edd_addtocart_button_hover_box_shadow_color ) && '' !== $wp_timeline_edd_addtocart_button_hover_box_shadow_color ) {
			?>
			box-shadow: <?php echo esc_attr( $wp_timeline_edd_addtocart_button_hover_top_box_shadow ) . 'px'; ?> <?php echo esc_attr( $wp_timeline_edd_addtocart_button_hover_right_box_shadow ) . 'px'; ?> <?php echo esc_attr( $wp_timeline_edd_addtocart_button_hover_bottom_box_shadow ) . 'px'; ?> <?php echo esc_attr( $wp_timeline_edd_addtocart_button_hover_left_box_shadow ) . 'px'; ?> <?php echo esc_attr( $wp_timeline_edd_addtocart_button_hover_box_shadow_color ); ?>; <?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_edd_download_buy_button .edd-add-to-cart:hover .edd-add-to-cart-label,
	<?php echo esc_attr( $layout_id ); ?> .wtl_edd_download_buy_button a.wp_timeline_edd_view_button:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl_edd_download_buy_button .edd_go_to_checkout:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl_edd_download_buy_button .edd-add-to-cart:hover {
		<?php
		if ( isset( $wp_timeline_edd_addtocart_text_hover_color ) && '' !== $wp_timeline_edd_addtocart_text_hover_color ) {
			?>
			color: <?php echo esc_attr( $wp_timeline_edd_addtocart_text_hover_color ); ?> !important;<?php } ?>
	}
	<?php
}

/** Pagination Css */
if ( isset( $pagination_type ) && 'paged' === $pagination_type ) {
	?>
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box.template-1 .paging-navigation ul.page-numbers li a.next:before{
		content: '<?php echo esc_html__( 'Next →', 'wp-timeline-designer-pro' ); ?>';    
	}
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box.template-1 .paging-navigation ul.page-numbers li a.prev:after{
		content: '<?php echo esc_html__( '← Prev', 'wp-timeline-designer-pro' ); ?>';
	}
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box.template-1 .paging-navigation ul.page-numbers li a.prev:after,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box.template-1 .paging-navigation ul.page-numbers li a.next:before {
		visibility: visible;
		padding: 6px 11px;
	}

	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box.template-4 .paging-navigation ul.page-numbers li a.next:before{
		content: '<?php echo esc_html__( 'Next →', 'wp-timeline-designer-pro' ); ?>';    
	}
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box.template-4 .paging-navigation ul.page-numbers li a.prev:after{
		content: '<?php echo esc_html__( '← Previous', 'wp-timeline-designer-pro' ); ?>';
	}
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box.template-4 .paging-navigation ul.page-numbers li a.prev:after,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box.template-4 .paging-navigation ul.page-numbers li a.next:before {
		visibility: visible;
		padding: 6px 11px;
	}


	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box.template-2 .paging-navigation ul.page-numbers li a.next:before{
		content: '<?php echo esc_html__( 'Next', 'wp-timeline-designer-pro' ); ?>';    
	}
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box.template-2 .paging-navigation ul.page-numbers li a.prev:after{
		content: '<?php echo esc_html__( 'Prev', 'wp-timeline-designer-pro' ); ?>';
	}
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box.template-2 .paging-navigation ul.page-numbers li a.prev:after,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box.template-2 .paging-navigation ul.page-numbers li a.next:before {
		visibility: visible;
		padding: 6px 11px;
	}
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box.template-3 .paging-navigation ul.page-numbers li a.next:before {
		content: '<?php echo esc_html__( 'Next', 'wp-timeline-designer-pro' ); ?>'; visibility: visible;padding: 7px;
	}
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box.template-3 .paging-navigation ul.page-numbers li a.prev:after
	{
		content: '<?php echo esc_html__( 'Prev', 'wp-timeline-designer-pro' ); ?>'; visibility: visible;padding: 7px;
	}
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box.template-3 .paging-navigation ul.page-numbers li a.prev:after
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box.template-3 .paging-navigation ul.page-numbers li a.next:before {
		visibility: visible;padding: 7px;top: 2px;
	}
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box .paging-navigation ul.page-numbers li span.current{
		<?php
		if ( isset( $pagination_active_background_color ) && '' !== $pagination_active_background_color ) {
			?>
			background: <?php echo esc_attr( $pagination_active_background_color ); ?>;<?php } ?>
		<?php
		if ( isset( $pagination_text_active_color ) && '' !== $pagination_text_active_color ) {
			?>
			color: <?php echo esc_attr( $pagination_text_active_color ); ?>;<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box:not(.template-2) .paging-navigation ul.page-numbers li a.next,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box:not(.template-2) .paging-navigation ul.page-numbers li a.prev,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box:not(.template-2) .paging-navigation ul.page-numbers li a.next:before,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box:not(.template-2) .paging-navigation ul.page-numbers li a.next:after {
		<?php
		if ( isset( $pagination_background_color ) && '' !== $pagination_background_color ) {
			?>
			background: <?php echo esc_attr( $pagination_background_color ); ?>;<?php } ?>
		<?php
		if ( isset( $pagination_text_color ) && '' !== $pagination_text_color ) {
			?>
			color: <?php echo esc_attr( $pagination_text_color ); ?>;<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box .paging-navigation ul.page-numbers li a.page-numbers,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box .paging-navigation ul.page-numbers li a.prev:after,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box .paging-navigation ul.page-numbers li a.prev:before
	{
		<?php
		if ( isset( $pagination_background_color ) && '' !== $pagination_background_color ) {
			?>
			background: <?php echo esc_attr( $pagination_background_color ); ?>;<?php } ?>
		<?php
		if ( isset( $pagination_text_color ) && '' !== $pagination_text_color ) {
			?>
			color: <?php echo esc_attr( $pagination_text_color ); ?>;<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box .paging-navigation ul.page-numbers li a.next:hover:before,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box .paging-navigation ul.page-numbers li a.prev:hover:after,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box .paging-navigation ul.page-numbers li a.page-numbers:hover,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box .paging-navigation ul.page-numbers li a.page-numbers:focus,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box .paging-navigation ul.page-numbers li a.next:hover,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box .paging-navigation ul.page-numbers li a.next:focus,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box .paging-navigation ul.page-numbers li a.prev:hover,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box .paging-navigation ul.page-numbers li a.prev:focus{
		<?php
		if ( isset( $pagination_text_hover_color ) && '' !== $pagination_text_hover_color ) {
			?>
			color: <?php echo esc_attr( $pagination_text_hover_color ); ?>;<?php } ?>
		<?php
		if ( isset( $pagination_background_hover_color ) && '' !== $pagination_background_hover_color ) {
			?>
			background: <?php echo esc_attr( $pagination_background_hover_color ); ?>;<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box.template-1 .paging-navigation ul.page-numbers li a,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box.template-1 .paging-navigation ul.page-numbers li span.current{
		border: none;
	}
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box.template-3 .paging-navigation ul.page-numbers li span.current,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box.template-4 .paging-navigation ul.page-numbers li span.current,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box .paging-navigation ul.page-numbers li a,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box .paging-navigation ul.page-numbers li span.current,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box.template-3 .paging-navigation ul.page-numbers li a.next:before,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box.template-3 .paging-navigation ul.page-numbers li a.prev:after,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box.template-3 .paging-navigation ul.page-numbers li a.page-numbers{
		<?php
		if ( isset( $pagination_border_color ) && '' !== $pagination_border_color ) {
			?>
			border:1px solid <?php echo esc_attr( $pagination_border_color ); ?>;<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box.template-4 .paging-navigation ul.page-numbers li span.current:after,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box.template-4 .paging-navigation ul.page-numbers li span.current:before{
		<?php
		if ( isset( $pagination_active_border_color ) && '' !== $pagination_active_border_color ) {
			?>
			border-top:2px solid <?php echo esc_attr( $pagination_active_border_color ); ?>;<?php } ?>
		<?php
		if ( isset( $pagination_active_border_color ) && '' !== $pagination_active_border_color ) {
			?>
			border-left:1px solid <?php esc_attr( $pagination_active_border_color ); ?>;<?php } ?>
		<?php
		if ( isset( $pagination_active_border_color ) && '' !== $pagination_active_border_color ) {
			?>
			border-right:1px solid <?php esc_attr( $pagination_active_border_color ); ?>;<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box.template-4 .paging-navigation ul.page-numbers li span.current{
		<?php
		if ( isset( $pagination_active_border_color ) && '' !== $pagination_active_border_color ) {
			?>
			border-top:2px solid <?php esc_attr( $pagination_active_border_color ); ?>;<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wl_pagination_box.template-4 .paging-navigation ul.page-numbers li a.page-numbers{
		<?php
		if ( isset( $pagination_border_color ) && '' !== $pagination_border_color ) {
			?>
			border:1px solid <?php echo esc_attr( $pagination_border_color ); ?> !important;<?php } ?>
	} 
	<?php
}
?>
<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component .social-share a {
		<?php
		echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ';' : ''; ?>
	}
<?php
/* Social Share Style Css  */
if ( isset( $social_style ) && 1 == $social_style ) { 
	?>
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component a.social-share-default{
		padding: 0;border:0;box-shadow: none;
	}
	
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component.large a.social-share-default{
		padding: 0;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component{
		margin-top: 10px;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component .social-share,
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template .social-component > a {
		margin: 10px 8px 0 0;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component.left_position .social-share {float: left;}
	<?php
} elseif ( isset( $social_style ) && 2 == $social_style ) { 
	?>
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component.extra_small .social-share {display: inline-block;margin: 10px 0 0;}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component.extra_small a {font-size: 13px;height: 27px;line-height: 20px;margin: 0px 2px 0 !important;padding: 7px 0;width: 27px;}
	<?php
}
/** Social Share count position */
if ( isset( $social_count_position ) && 'bottom' === $social_count_position ) {
	?>
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component .social-share .count {
		<?php
		if ( isset( $template_contentcolor ) && '' !== $template_contentcolor ) {
			?>
			color: <?php echo esc_attr( $template_contentcolor ); ?>;<?php } ?>
		background-color: transparent;border: 1px solid #ddd;border-radius: 5px;clear: both;float: left;line-height: 1;margin: 10px 0 0;padding: 5px 4%;text-align: center;width: 38px;position: relative;word-wrap: break-word;height: auto;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component.large .social-share .count {
		width: 45px;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component .social-share .count:before {
		border-bottom: 8px solid #ddd;border-left: 8px solid rgba(0,0,0,0);border-right: 8px dashed rgba(0,0,0,0);content: "";left: 0;margin: 0 auto;position: absolute;right: 0;top: -8px;width: 0;
	}
	<?php
} elseif ( isset( $social_count_position ) && 'top' === $social_count_position ) {
	?>
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component .social-share .count {
		<?php
		if ( isset( $template_contentcolor ) && '' !== $template_contentcolor ) {
			?>
			color: <?php echo esc_attr( $template_contentcolor ); ?>;<?php } ?>
		background-color: transparent;border: 1px solid #dddddd;border-radius: 5px;clear: both;float: none;line-height: 1;margin: 0 0 10px 0;padding: 5px 4%;text-align: center;width: 38px;position: relative;height: auto;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component.large .social-share .count {
		width: 45px;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template.even_class .social-component .social-share .count{
		float: none;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component .social-share .count:before {
		border-top: 8px solid #ddd;border-left: 8px solid rgba(0, 0, 0, 0);border-right: 8px dashed rgba(0, 0, 0, 0);content: "";left: 0;margin: 0 auto;position: absolute;right: 0;bottom: -9px;width: 0;
	}
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template .social-component > a{
		display: inline-block;margin-bottom: 0;float:none;vertical-align: bottom;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component .social-share {
		display: inline-block;float: none;
	}
	<?php
} else {
	?>
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component .social-share .count {
		<?php
		if ( isset( $template_contentcolor ) && '' !== $template_contentcolor ) {
			?>
			color: <?php echo esc_attr( $template_contentcolor ); ?>;<?php } ?>
		background-color: transparent;border: 1px solid #ddd;border-radius: 5px;float: right;line-height: 20px;margin: 0 0 0 10px;padding: 8px 0;text-align: center;width: 38px;height: 38px;position: relative;box-sizing: border-box;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component.large .social-share .count {
		margin: 0 0 0 7px;padding: 12px 0;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component.large .social-share .count:before {
		top: 30%;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component .social-share .count:before {
		border-top: 8px solid rgba(0,0,0,0);border-bottom:8px dashed rgba(0,0,0,0);border-right: 8px solid #ddd;content: "";margin: 0 auto;position: absolute;left: -8px;top: 27%;width: 0;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component.extra_small .social-share .count:before {
		border-top: 6px solid rgba(0,0,0,0);border-bottom:8px dashed rgba(0,0,0,0);border-right: 6px solid #ddd;content: "";left: -33px;margin: 0 auto;position: absolute;right: 0;top: 27%;width: 0;
	}
	<?php
}
?>
<?php echo esc_attr( $layout_id ); ?> .wtl-post-category {
	<?php if ( isset( $template_categorybgcolor ) && '' !== $template_categorybgcolor ) { ?>
		background: <?php echo esc_attr( $template_categorybgcolor ); 
	} ?>
}
/* ------------------------- Post Title ------------------------- */
<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl-post-title {
	<?php
	if ( isset( $template_title_alignment ) && '' !== $template_title_alignment ) {
		?>
		text-align: <?php echo esc_attr( $template_title_alignment ); ?>;<?php } ?>
}
<?php echo esc_attr( $layout_id ); ?> .wtl-post-title a,
<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl-post-title a,
<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl-post-title,
<?php echo esc_attr( $layout_id ); ?> .wtl-fl-box .wtl-post-title a,
<?php echo esc_attr( $layout_id ); ?> .wtl-fl-box .wtl-post-title{
	<?php
	if ( isset( $template_titlecolor ) && '' !== $template_titlecolor ) {
		?>
		color: <?php echo esc_attr( $template_titlecolor ); ?> !important;<?php } ?>
	<?php
	if ( isset( $template_titlefontsize ) && '' !== $template_titlefontsize ) {
		?>
		font-size: <?php echo esc_attr( $template_titlefontsize ) . 'px'; ?>;<?php } ?>
	<?php
	if ( isset( $template_titlefontface ) && '' !== $template_titlefontface ) {
		?>
		font-family: <?php echo esc_attr( $template_titlefontface ); ?>;<?php } ?>
	<?php
	if ( isset( $template_title_font_weight ) && '' !== $template_title_font_weight ) {
		?>
		font-weight: <?php echo esc_attr( $template_title_font_weight ); ?>;<?php } ?>
	<?php
	if ( isset( $template_title_font_line_height ) && '' !== $template_title_font_line_height ) {
		?>
		line-height: <?php echo esc_attr( $template_title_font_line_height ); ?>;<?php } ?>
	<?php
	if ( isset( $template_title_font_italic ) && 1 == $template_title_font_italic ) { 
		?>
		font-style: <?php echo 'italic'; ?>;<?php } ?>
	<?php
	if ( isset( $template_title_font_text_transform ) && '' !== $template_title_font_text_transform ) {
		?>
		text-transform: <?php echo esc_attr( $template_title_font_text_transform ); ?>;<?php } ?>
	<?php
	if ( isset( $template_title_font_text_decoration ) && '' !== $template_title_font_text_decoration ) {
		?>
		text-decoration: <?php echo esc_attr( $template_title_font_text_decoration ); ?>;<?php } ?>
	<?php
	if ( isset( $template_title_font_letter_spacing ) && '' !== $template_title_font_letter_spacing ) {
		?>
		letter-spacing: <?php echo esc_attr( $template_title_font_letter_spacing ) . 'px'; ?>;<?php } ?>
}
<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl-post-title a:hover {
	<?php
	if ( isset( $template_titlehovercolor ) && '' !== $template_titlehovercolor ) {
		?>
		color:<?php echo esc_attr( $template_titlehovercolor ); ?> !important;<?php } ?>
}
/** Apply content Font Family */
<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl-post-content,
<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl-post-content p,
<?php echo esc_attr( $layout_id ); ?> .wtl-fl-box .wtl-post-content,
<?php echo esc_attr( $layout_id ); ?> .wtl-fl-box .wtl-post-content p{
	<?php
	if ( isset( $template_contentcolor ) && '' !== $template_contentcolor ) {
		?>
		color: <?php echo esc_attr( $template_contentcolor ); ?>;<?php } ?>
	<?php
	if ( isset( $content_font_family ) && '' !== $content_font_family ) {
		?>
		font-family: <?php echo esc_attr( $content_font_family ); ?> !important; <?php } ?>
}   
/** Font Awesome apply */
<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .post_hentry.fas {font-family: 'Font Awesome 5 Free';}
<?php if ( isset( $template_ftcolor ) && '' !== $template_ftcolor ) { ?>       
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .metacomments a,
	<?php echo esc_attr( $layout_id ); ?> .blog_template .social-component a,
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .post_content a {
		color:<?php echo esc_attr( $template_ftcolor ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .blog_template .social-component a {
		border-color:<?php echo esc_attr( $template_ftcolor ); ?>;
	}
<?php } ?>
<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl-post-title {
<?php
if ( isset( $template_titlebackcolor ) && '' !== $template_titlebackcolor ) {
	?>
	background: <?php echo esc_attr( $template_titlebackcolor ); ?>;<?php } ?>
}
/* --------------------------- Meta Link Color --------------------------- */
<?php echo esc_attr( $layout_id ); ?> .wtl-author a,
<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a,
<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a,
<?php echo esc_attr( $layout_id ); ?> .wtl-comment a,
<?php echo esc_attr( $layout_id ); ?> .mcomments a {
	<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) : ''; ?>
}
<?php echo esc_attr( $layout_id ); ?> .wtl-author a:hover,
<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a:hover,
<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a:hover,
<?php echo esc_attr( $layout_id ); ?> .wtl-comment a:hover,
<?php echo esc_attr( $layout_id ); ?> .mcomments a:hover{
	<?php echo isset( $wtl_settings['template_fthovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_fthovercolor'] ) . ' !important' : ''; ?>
}
/** Apply Link Hover Color */
<?php
if ( isset( $template_ftcolor ) && '' !== $template_ftcolor ) {
	echo esc_attr( $layout_id );
	?>
	.blog_template .upper_image_wrapper.wp_timeline_link_post_format a:hover{
		color: <?php echo esc_attr( $template_ftcolor ); ?>;
	}
<?php } ?>
/** Apply Content Setting */
<?php echo esc_attr( $layout_id ); ?> .wtl-post-content,
<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl-post-content,
<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .label_featured_post,
<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .label_featured_post span,
<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl-post-content p,
<?php echo esc_attr( $layout_id ); ?> .wtl-fl-box .wtl-post-content,
<?php echo esc_attr( $layout_id ); ?> .wtl-fl-box .wtl-post-content p{
	<?php
	if ( isset( $content_fontsize ) && '' !== $content_fontsize ) {
		?>
		font-size: <?php echo esc_attr( $content_fontsize ) . 'px'; ?>;<?php } ?>
	<?php
	if ( isset( $content_font_weight ) && '' !== $content_font_weight ) {
		?>
		font-weight: <?php echo esc_attr( $content_font_weight ); ?>;<?php } ?>
	<?php
	if ( isset( $content_font_line_height ) && '' !== $content_font_line_height ) {
		?>
		line-height: <?php echo esc_attr( $content_font_line_height ); ?>;<?php } ?>
	<?php
	if ( isset( $content_font_italic ) && 1 == $content_font_italic ) { 
		?>
		font-style: <?php echo 'italic'; ?>;<?php } ?>
	<?php
	if ( isset( $content_font_text_transform ) && '' !== $content_font_text_transform ) {
		?>
		text-transform: <?php echo esc_attr( $content_font_text_transform ); ?>;<?php } ?>
	<?php
	if ( isset( $content_font_text_decoration ) && '' !== $content_font_text_decoration ) {
		?>
		text-decoration: <?php echo esc_attr( $content_font_text_decoration ); ?>;<?php } ?>
	<?php
	if ( isset( $content_font_letter_spacing ) && '' !== $content_font_letter_spacing ) {
		?>
		letter-spacing: <?php echo esc_attr( $content_font_letter_spacing ) . 'px'; ?>;<?php } ?>
}
<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .upper_image_wrapper blockquote,
<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .upper_image_wrapper blockquote p{
	<?php
	if ( isset( $content_fontsize ) && '' !== $content_fontsize ) {
		?>
		font-size: <?php echo esc_attr( $content_fontsize ) + 3 . 'px'; ?>;<?php } ?>
	<?php
	if ( isset( $content_font_family ) && '' !== $content_font_family ) {
		?>
		font-family: <?php echo esc_attr( $content_font_family ); ?>;<?php } ?>
	<?php
	if ( isset( $template_contentcolor ) && '' !== $template_contentcolor ) {
		?>
		color: <?php echo esc_attr( $template_contentcolor ); ?>;<?php } ?>
}
<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .upper_image_wrapper blockquote:before{
	<?php
	if ( isset( $content_fontsize ) && '' !== $content_fontsize ) {
		?>
		font-size: <?php echo esc_attr( $content_fontsize ) + 5 . 'px'; ?>;<?php } ?>
	<?php
	if ( isset( $template_contentcolor ) && '' !== $template_contentcolor ) {
		?>
		color: <?php echo esc_attr( $template_contentcolor ); ?><?php } ?>
}
<?php echo esc_attr( $layout_id ); ?> .blog_template .upper_image_wrapper.wp_timeline_link_post_format a{
	<?php
	if ( isset( $content_fontsize ) && '' !== $content_fontsize ) {
		?>
		font-size: <?php echo esc_attr( $content_fontsize ) + 5 . 'px'; ?>;<?php } ?>
	<?php
	if ( isset( $content_font_family ) && '' !== $content_font_family ) {
		?>
		font-family: <?php echo esc_attr( $content_font_family ); ?>;<?php } ?>
	<?php
	if ( isset( $template_bgcolor ) && '' !== $template_bgcolor ) {
		?>
		background: <?php echo esc_attr( Wp_Timeline_Main::wtl_hex2rgba( $template_bgcolor, 0.9 ) ); ?>;<?php } ?>
	<?php
	if ( isset( $template_ftcolor ) && '' !== $template_ftcolor ) {
		?>
		color: <?php echo esc_attr( $template_ftcolor ); ?>;<?php } ?>
}
/** Woocommerce Layout Settings */
<?php
if ( ( Wp_Timeline_Main::wtl_woocommerce_plugin() || class_exists( 'woocommerce' ) ) && ( ! is_archive() || is_product_tag() || is_product_category() ) ) {
	echo esc_attr( $layout_id );
	?>
	.wp_timeline_woocommerce_price_wrap {
		<?php
		if ( isset( $wp_timeline_pricetext_paddingleft ) && '' !== $wp_timeline_pricetext_paddingleft ) {
			?>
			padding-left: <?php echo esc_attr( $wp_timeline_pricetext_paddingleft ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_pricetext_paddingright ) && '' !== $wp_timeline_pricetext_paddingright ) {
			?>
			padding-right: <?php echo esc_attr( $wp_timeline_pricetext_paddingright ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_pricetext_paddingtop ) && '' !== $wp_timeline_pricetext_paddingtop ) {
			?>
			padding-top: <?php echo esc_attr( $wp_timeline_pricetext_paddingtop ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_pricetext_paddingbottom ) && '' !== $wp_timeline_pricetext_paddingbottom ) {
			?>
			padding-bottom: <?php echo esc_attr( $wp_timeline_pricetext_paddingbottom ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_pricetext_marginleft ) && '' !== $wp_timeline_pricetext_marginleft ) {
			?>
			margin-left:<?php echo esc_attr( $wp_timeline_pricetext_marginleft ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_pricetext_marginright ) && '' !== $wp_timeline_pricetext_marginright ) {
			?>
			margin-right:<?php echo esc_attr( $wp_timeline_pricetext_marginright ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_pricetext_margintop ) && '' !== $wp_timeline_pricetext_margintop ) {
			?>
			margin-top: <?php echo esc_attr( $wp_timeline_pricetext_margintop ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_pricetext_marginbottom ) && '' !== $wp_timeline_pricetext_marginbottom ) {
			?>
			margin-bottom: <?php echo esc_attr( $wp_timeline_pricetext_marginbottom ) . 'px'; ?>;<?php } ?>

		<?php
		if ( isset( $wp_timeline_pricetext_alignment ) && ! empty( $wp_timeline_pricetext_alignment ) ) {
			?>
			text-align: <?php echo esc_attr( $wp_timeline_pricetext_alignment ); ?>;<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_woo_sale_wrap.right-top span.onsale{
		right: 0;left: auto !important;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_woo_sale_wrap.left-bottom span.onsale{
		top: auto !important;bottom: 0;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_woo_sale_wrap.right-bottom span.onsale{
		right: 0;left: auto !important;bottom: 0;top: auto !important;
	}
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_price_wrap .price del .woocommerce-Price-amount {
		text-decoration: line-through;
	}  
	<?php echo esc_attr( $layout_id ); ?> .wtl_woo_sale_wrap.right-top span.onsale{
		top: 0;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_woo_sale_wrap.left-top span.onsale {
		left: 0;top: 0;
	}   
	<?php echo esc_attr( $layout_id ); ?> .wtl_woo_sale_wrap span.onsale:before,
	<?php echo esc_attr( $layout_id ); ?> .wtl_woo_sale_wrap span.onsale:after {content: '' !important;border: none !important;}
	body:not(.woocommerce) <?php echo esc_attr( $layout_id ); ?> .star-rating {overflow: hidden;position: relative;height: 1em;line-height: 1;font-size: 1em;width: 5.4em;font-family: star;}
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_star_wrap {
		float: left; width: 100%;
		<?php
		if ( isset( $wp_timeline_star_rating_paddingleft ) && '' !== $wp_timeline_star_rating_paddingleft ) {
			?>
			padding-left: <?php echo esc_attr( $wp_timeline_star_rating_paddingleft ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_star_rating_paddingright ) && '' !== $wp_timeline_star_rating_paddingright ) {
			?>
			padding-right: <?php echo esc_attr( $wp_timeline_star_rating_paddingright ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_star_rating_paddingtop ) && '' !== $wp_timeline_star_rating_paddingtop ) {
			?>
			padding-top: <?php echo esc_attr( $wp_timeline_star_rating_paddingtop ) . 'px'; ?>;
			<?php
		}
		if ( isset( $wp_timeline_star_rating_paddingbottom ) && '' !== $wp_timeline_star_rating_paddingbottom ) {
			?>
			padding-bottom: <?php echo esc_attr( $wp_timeline_star_rating_paddingbottom ) . 'px'; ?>;
			<?php
		}
		if ( isset( $wp_timeline_star_rating_marginleft ) && '' !== $wp_timeline_star_rating_marginleft ) {
			?>
			margin-left: <?php echo esc_attr( $wp_timeline_star_rating_marginleft ) . 'px'; ?>;
			<?php
		}
		if ( isset( $wp_timeline_star_rating_marginright ) && '' !== $wp_timeline_star_rating_marginright ) {
			?>
			margin-right: <?php echo esc_attr( $wp_timeline_star_rating_marginright ) . 'px'; ?>;
			<?php
		}
		if ( isset( $wp_timeline_star_rating_margintop ) && '' !== $wp_timeline_star_rating_margintop ) {
			?>
			margin-top: <?php echo esc_attr( $wp_timeline_star_rating_margintop ) . 'px'; ?>;
			<?php
		}
		if ( isset( $wp_timeline_star_rating_marginbottom ) && '' !== $wp_timeline_star_rating_marginbottom ) {
			?>
			margin-bottom: <?php echo esc_attr( $wp_timeline_star_rating_marginbottom ) . 'px'; ?>;
		<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_star_wrap .star-rating {
		<?php
		if ( 'center' === $wp_timeline_star_rating_alignment ) {
			?>
			margin:0 auto !important;
			<?php
		} elseif ( 'right' === $wp_timeline_star_rating_alignment ) {
			?>
			float: right;
			<?php
		}
		?>
	}
	body:not(.woocommerce) <?php echo esc_attr( $layout_id ); ?> .star-rating {line-height: 1;font-size: 1em;font-family: star;}
	<?php echo esc_attr( $layout_id ); ?> .star-rating {float: none;}
	<?php echo esc_attr( $layout_id ); ?> .star-rating:before {
		color: 
		<?php
		if ( isset( $wp_timeline_star_rating_color ) && '' != $wp_timeline_star_rating_color ) { 
			echo esc_attr( $wp_timeline_star_rating_color );
		} else {
			echo esc_attr( $template_contentcolor );
		}
		?>
		;
	}
	<?php echo esc_attr( $layout_id ); ?> .star-rating span {
		color: 
		<?php
		if ( isset( $wp_timeline_star_rating_bg_color ) && '' != $wp_timeline_star_rating_bg_color ) { 
			echo esc_attr( $wp_timeline_star_rating_bg_color );
		} else {
			echo esc_attr( $template_ftcolor ); }
		?>
		;
	}
	body:not(.woocommerce) <?php echo esc_attr( $layout_id ); ?> .star-rating:before {
		content: '\73\73\73\73\73';float: left;top: 0;left: 0;position: absolute;
	}
	body:not(.woocommerce) <?php echo esc_attr( $layout_id ); ?> .star-rating span {
		overflow: hidden;float: left;top: 0;left: 0;position: absolute;padding-top: 1.5em;
	}
	body:not(.woocommerce) <?php echo esc_attr( $layout_id ); ?> .star-rating span:before {
		content: '\53\53\53\53\53';top: 0;position: absolute;left: 0;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_woo_sale_wrap span.onsale {
		z-index: 1 !important;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_woo_sale_wrap span.onsale {
		min-height: 0;min-width: 0;
	}
	body:not(.woocommerce) <?php echo esc_attr( $layout_id ); ?> .wtl_woo_sale_wrap span.onsale{
		position: absolute;
		text-align: center;
		left: 0;
		z-index: 1 !important;
		color: #fff;
		width: auto;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_woo_sale_wrap span.onsale {
		<?php
		if ( isset( $wp_timeline_sale_tagtextcolor ) && '' !== $wp_timeline_sale_tagtextcolor ) {
			?>
			color: <?php echo esc_attr( $wp_timeline_sale_tagtextcolor ); ?> !important;<?php } ?>
		<?php
		if ( isset( $wp_timeline_sale_tagfontsize ) && '' !== $wp_timeline_sale_tagfontsize ) {
			?>
			font-size: <?php echo esc_attr( $wp_timeline_sale_tagfontsize ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_sale_tagfontface ) && '' !== $wp_timeline_sale_tagfontface ) {
			?>
			font-family: <?php echo esc_attr( $wp_timeline_sale_tagfontface ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_sale_tag_font_weight ) && '' !== $wp_timeline_sale_tag_font_weight ) {
			?>
			font-weight: <?php echo esc_attr( $wp_timeline_sale_tag_font_weight ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_sale_tag_font_line_height ) && '' !== $wp_timeline_sale_tag_font_line_height ) {
			?>
			line-height: <?php echo esc_attr( $wp_timeline_sale_tag_font_line_height ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_sale_tag_font_italic ) && 1 == $wp_timeline_sale_tag_font_italic ) { 
			?>
			font-style: <?php echo 'italic'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_sale_tag_font_letter_spacing ) && '' !== $wp_timeline_sale_tag_font_letter_spacing ) {
			?>
			letter-spacing: <?php echo esc_attr( $wp_timeline_sale_tag_font_letter_spacing ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_sale_tag_font_text_transform ) && '' !== $wp_timeline_sale_tag_font_text_transform ) {
			?>
			text-transform: <?php echo esc_attr( $wp_timeline_sale_tag_font_text_transform ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_sale_tag_font_text_decoration ) && '' !== $wp_timeline_sale_tag_font_text_decoration ) {
			?>
			text-decoration: <?php echo esc_attr( $wp_timeline_sale_tag_font_text_decoration ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_sale_tagbgcolor ) && '' !== $wp_timeline_sale_tagbgcolor ) {
			?>
			background-color: <?php echo esc_attr( $wp_timeline_sale_tagbgcolor ); ?>; <?php } ?>
		<?php
		if ( isset( $wp_timeline_sale_tagtext_marginleft ) && '' !== $wp_timeline_sale_tagtext_marginleft ) {
			?>
			margin-left: <?php echo esc_attr( $wp_timeline_sale_tagtext_marginleft ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_sale_tagtext_marginright ) && '' !== $wp_timeline_sale_tagtext_marginright ) {
			?>
			margin-right: <?php echo esc_attr( $wp_timeline_sale_tagtext_marginright ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_sale_tagtext_margintop ) && '' !== $wp_timeline_sale_tagtext_margintop ) {
			?>
			margin-top: <?php echo esc_attr( $wp_timeline_sale_tagtext_margintop ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_sale_tagtext_marginbottom ) && '' !== $wp_timeline_sale_tagtext_marginbottom ) {
			?>
			margin-bottom: <?php echo esc_attr( $wp_timeline_sale_tagtext_marginbottom ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_sale_tagtext_paddingleft ) && '' !== $wp_timeline_sale_tagtext_paddingleft ) {
			?>
			padding-left: <?php echo esc_attr( $wp_timeline_sale_tagtext_paddingleft ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_sale_tagtext_paddingright ) && '' !== $wp_timeline_sale_tagtext_paddingright ) {
			?>
			padding-right: <?php echo esc_attr( $wp_timeline_sale_tagtext_paddingright ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_sale_tagtext_paddingtop ) && '' !== $wp_timeline_sale_tagtext_paddingtop ) {
			?>
			padding-top: <?php echo esc_attr( $wp_timeline_sale_tagtext_paddingtop ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_sale_tagtext_paddingbottom ) && '' !== $wp_timeline_sale_tagtext_paddingbottom ) {
			?>
			padding-bottom: <?php echo esc_attr( $wp_timeline_sale_tagtext_paddingbottom ) . 'px'; ?>;<?php } ?>
		width: auto;
		<?php
		if ( isset( $wp_timeline_sale_tag_angle ) && '' !== $wp_timeline_sale_tag_angle ) {
			?>
			transform: rotate(<?php echo esc_attr( $wp_timeline_sale_tag_angle ); ?>deg); <?php } ?>
		<?php
		if ( isset( $wp_timeline_sale_tag_border_radius ) && '' !== $wp_timeline_sale_tag_border_radius ) {
			?>
			border-radius: <?php echo esc_attr( $wp_timeline_sale_tag_border_radius ); ?>%; <?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_price_wrap .price .woocommerce-Price-amount span {
		<?php
		if ( isset( $wp_timeline_pricetextcolor ) && '' !== $wp_timeline_pricetextcolor ) {
			?>
			color: <?php echo esc_attr( $wp_timeline_pricetextcolor ); ?> !important;<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_price_wrap,
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_price_wrap .price .woocommerce-Price-amount {
		<?php
		if ( isset( $wp_timeline_pricetextcolor ) && '' !== $wp_timeline_pricetextcolor ) {
			?>
			color: <?php echo esc_attr( $wp_timeline_pricetextcolor ); ?> !important;<?php } ?>
		<?php
		if ( isset( $wp_timeline_pricefontsize ) && '' !== $wp_timeline_pricefontsize ) {
			?>
			font-size: <?php echo esc_attr( $wp_timeline_pricefontsize ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_pricefontface ) && '' !== $wp_timeline_pricefontface ) {
			?>
			font-family: <?php echo esc_attr( $wp_timeline_pricefontface ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_price_font_weight ) && '' !== $wp_timeline_price_font_weight ) {
			?>
			font-weight: <?php echo esc_attr( $wp_timeline_price_font_weight ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_price_font_line_height ) && '' !== $wp_timeline_price_font_line_height ) {
			?>
			line-height: <?php echo esc_attr( $wp_timeline_price_font_line_height ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_price_font_italic ) && 1 == $wp_timeline_price_font_italic ) { 
			?>
			font-style: <?php echo 'italic'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_price_font_letter_spacing ) && '' !== $wp_timeline_price_font_letter_spacing ) {
			?>
			letter-spacing: <?php echo esc_attr( $wp_timeline_price_font_letter_spacing ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_price_font_text_transform ) && '' !== $wp_timeline_price_font_text_transform ) {
			?>
			text-transform: <?php echo esc_attr( $wp_timeline_price_font_text_transform ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_price_font_text_decoration ) && '' !== $wp_timeline_price_font_text_decoration ) {
			?>
			text-decoration: <?php echo esc_attr( $wp_timeline_price_font_text_decoration ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_pricetext_alignment ) && '' !== $wp_timeline_pricetext_alignment ) {
			?>
			text-align: <?php echo esc_attr( $wp_timeline_pricetext_alignment ); ?>;<?php } ?>
		width: auto;
		word-break: break-all;
	}
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_cart_wrap .add_to_cart_button,
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_cart_wrap .add_to_cart_button .wpbm-span,
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_cart_wrap .product_type_external,
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_cart_wrap .product_type_grouped,
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_cart_wrap .product_type_simple {
		<?php
		if ( isset( $wp_timeline_addtocart_button_fontsize ) && '' !== $wp_timeline_addtocart_button_fontsize ) {
			?>
			font-size: <?php echo esc_attr( $wp_timeline_addtocart_button_fontsize ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_addtocart_button_fontface ) && '' !== $wp_timeline_addtocart_button_fontface ) {
			?>
			font-family: <?php echo esc_attr( $wp_timeline_addtocart_button_fontface ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_addtocart_button_font_weight ) && '' !== $wp_timeline_addtocart_button_font_weight ) {
			?>
			font-weight: <?php echo esc_attr( $wp_timeline_addtocart_button_font_weight ); ?>;<?php } ?>
		<?php
		if ( isset( $display_addtocart_button_line_height ) && '' !== $display_addtocart_button_line_height ) {
			?>
			line-height: <?php echo esc_attr( $display_addtocart_button_line_height ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_addtocart_button_font_italic ) && 1 == $wp_timeline_addtocart_button_font_italic ) { 
			?>
			font-style: <?php echo 'italic'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_addtocart_button_letter_spacing ) && '' !== $wp_timeline_addtocart_button_letter_spacing ) {
			?>
			letter-spacing: <?php echo esc_attr( $wp_timeline_addtocart_button_letter_spacing ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_addtocart_button_font_text_transform ) && '' !== $wp_timeline_addtocart_button_font_text_transform ) {
			?>
			text-transform: <?php echo esc_attr( $wp_timeline_addtocart_button_font_text_transform ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_addtocart_button_font_text_decoration ) && '' !== $wp_timeline_addtocart_button_font_text_decoration ) {
			?>
			text-decoration: <?php echo esc_attr( $wp_timeline_addtocart_button_font_text_decoration ); ?> !important;<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_cart_wrap .added_to_cart {
		display: inline-block;
		<?php if ( isset( $wp_timeline_addtocartbutton_padding_topbottom ) && '' !== $wp_timeline_addtocartbutton_padding_topbottom ) { ?>
			padding-top: <?php echo esc_attr( $wp_timeline_addtocartbutton_padding_topbottom ) . 'px'; ?>;
			padding-bottom: <?php echo esc_attr( $wp_timeline_addtocartbutton_padding_topbottom ) . 'px'; ?>;
		<?php } ?>
		<?php if ( isset( $wp_timeline_addtocartbutton_padding_leftright ) && '' !== $wp_timeline_addtocartbutton_padding_leftright ) { ?>
			padding-left: <?php echo esc_attr( $wp_timeline_addtocartbutton_padding_leftright ) . 'px'; ?>;
			padding-right: <?php echo esc_attr( $wp_timeline_addtocartbutton_padding_leftright ) . 'px'; ?>;
		<?php } ?>
		<?php
		if ( isset( $wp_timeline_addtocart_button_fontface ) && '' !== $wp_timeline_addtocart_button_fontface ) {
			?>
			font-family: <?php echo esc_attr( $wp_timeline_addtocart_button_fontface ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_addtocart_button_font_weight ) && '' !== $wp_timeline_addtocart_button_font_weight ) {
			?>
			font-weight: <?php echo esc_attr( $wp_timeline_addtocart_button_font_weight ); ?>;<?php } ?>
		<?php
		if ( isset( $display_addtocart_button_line_height ) && '' !== $display_addtocart_button_line_height ) {
			?>
			line-height: <?php echo esc_attr( $display_addtocart_button_line_height ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_addtocart_button_font_italic ) && 1 == $wp_timeline_addtocart_button_font_italic ) { 
			?>
			font-style: <?php echo 'italic'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_addtocart_button_letter_spacing ) && '' !== $wp_timeline_addtocart_button_letter_spacing ) {
			?>
			letter-spacing: <?php echo esc_attr( $wp_timeline_addtocart_button_letter_spacing ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_addtocart_button_font_text_transform ) && '' !== $wp_timeline_addtocart_button_font_text_transform ) {
			?>
			text-transform: <?php echo esc_attr( $wp_timeline_addtocart_button_font_text_transform ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_addtocart_button_font_text_decoration ) && '' !== $wp_timeline_addtocart_button_font_text_decoration ) {
			?>
			text-decoration: <?php echo esc_html( $wp_timeline_addtocart_button_font_text_decoration ); ?> !important;<?php } ?>
		<?php
		if ( isset( $wp_timeline_addtocart_button_fontsize ) && '' !== $wp_timeline_addtocart_button_fontsize ) {
			?>
			font-size: <?php echo esc_attr( $wp_timeline_addtocart_button_fontsize ) . 'px'; ?>;<?php } ?>
	}
	/* Cart Buttion Setting*/
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_cart_wrap .add_to_cart_button,
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_cart_wrap .product_type_external,
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_cart_wrap .product_type_grouped,
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_cart_wrap .product_type_simple  {
		<?php
		if ( isset( $wp_timeline_addtocart_textcolor ) && '' !== $wp_timeline_addtocart_textcolor ) {
			?>
			color: <?php echo esc_html( $wp_timeline_addtocart_textcolor ); ?> !important;<?php } ?>
		<?php
		if ( isset( $wp_timeline_addtocart_backgroundcolor ) && '' !== $wp_timeline_addtocart_backgroundcolor ) {
			?>
			background: <?php echo esc_html( $wp_timeline_addtocart_backgroundcolor ); ?> !important;<?php } ?>
		<?php
		if ( isset( $wp_timeline_addtocartbutton_borderleft ) && '' !== $wp_timeline_addtocartbutton_borderleft ) {
			?>
			border-left:<?php echo esc_html( $wp_timeline_addtocartbutton_borderleft ) . 'px'; ?> solid <?php echo esc_attr( $wp_timeline_addtocartbutton_borderleftcolor ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_addtocartbutton_borderright ) && '' !== $wp_timeline_addtocartbutton_borderright ) {
			?>
			border-right:<?php echo esc_attr( $wp_timeline_addtocartbutton_borderright ) . 'px'; ?> solid <?php echo esc_attr( $wp_timeline_addtocartbutton_borderrightcolor ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_addtocartbutton_bordertop ) && '' !== $wp_timeline_addtocartbutton_bordertop ) {
			?>
			border-top:<?php echo esc_attr( $wp_timeline_addtocartbutton_bordertop ) . 'px'; ?> solid <?php echo esc_attr( $wp_timeline_addtocartbutton_bordertopcolor ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_addtocartbutton_borderbuttom ) && '' !== $wp_timeline_addtocartbutton_borderbuttom ) {
			?>
			border-bottom:<?php echo esc_attr( $wp_timeline_addtocartbutton_borderbuttom ) . 'px'; ?> solid <?php echo esc_attr( $wp_timeline_addtocartbutton_borderbottomcolor ); ?>;<?php } ?>
		<?php
		if ( isset( $display_addtocart_button_border_radius ) && '' !== $display_addtocart_button_border_radius ) {
			?>
			border-radius:<?php echo esc_attr( $display_addtocart_button_border_radius ) . 'px'; ?>;<?php } ?>
		<?php if ( isset( $wp_timeline_addtocartbutton_padding_topbottom ) && '' !== $wp_timeline_addtocartbutton_padding_topbottom ) { ?>
			padding-top: <?php echo esc_attr( $wp_timeline_addtocartbutton_padding_topbottom ) . 'px'; ?>;
			padding-bottom: <?php echo esc_attr( $wp_timeline_addtocartbutton_padding_topbottom ) . 'px'; ?>;
		<?php } ?>
		<?php if ( isset( $wp_timeline_addtocartbutton_padding_leftright ) && '' !== $wp_timeline_addtocartbutton_padding_leftright ) { ?>
			padding-left: <?php echo esc_attr( $wp_timeline_addtocartbutton_padding_leftright ) . 'px'; ?>;
			padding-right: <?php echo esc_attr( $wp_timeline_addtocartbutton_padding_leftright ) . 'px'; ?>;
		<?php } ?>
		<?php if ( isset( $wp_timeline_addtocartbutton_margin_topbottom ) && '' !== $wp_timeline_addtocartbutton_margin_topbottom ) { ?>
			margin-top: <?php echo esc_attr( $wp_timeline_addtocartbutton_margin_topbottom ) . 'px'; ?>;
			margin-bottom: <?php echo esc_attr( $wp_timeline_addtocartbutton_margin_topbottom ) . 'px'; ?>;
		<?php } ?>
		<?php if ( isset( $wp_timeline_addtocartbutton_margin_leftright ) && '' !== $wp_timeline_addtocartbutton_margin_leftright ) { ?>
			margin-left: <?php echo esc_attr( $wp_timeline_addtocartbutton_margin_leftright ) . 'px'; ?>;
			margin-right:<?php echo esc_attr( $wp_timeline_addtocartbutton_margin_leftright ) . 'px'; ?>;
		<?php } ?>
		<?php
		if ( isset( $wp_timeline_addtocart_button_box_shadow_color ) && '' !== $wp_timeline_addtocart_button_box_shadow_color ) {
			?>
			box-shadow: <?php echo esc_attr( $wp_timeline_addtocart_button_top_box_shadow ) . 'px'; ?> <?php echo esc_attr( $wp_timeline_addtocart_button_right_box_shadow ) . 'px'; ?> <?php echo esc_attr( $wp_timeline_addtocart_button_bottom_box_shadow ) . 'px'; ?> <?php echo esc_attr( $wp_timeline_addtocart_button_left_box_shadow ) . 'px'; ?> <?php echo esc_attr( $wp_timeline_addtocart_button_box_shadow_color ); ?> !important; <?php } ?>
		display: inline-block;
	}

	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_cart_wrap .add_to_cart_button:hover,
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_cart_wrap .add_to_cart_button:focus,
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_cart_wrap .product_type_external:hover,
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_cart_wrap .product_type_external:focus,
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_cart_wrap .product_type_grouped:hover,
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_cart_wrap .product_type_grouped:focus,
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_cart_wrap .product_type_simple:hover,
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_cart_wrap .product_type_simple:focus  {
		<?php
		if ( isset( $wp_timeline_addtocart_text_hover_color ) && '' !== $wp_timeline_addtocart_text_hover_color ) {
			?>
			color: <?php echo esc_attr( $wp_timeline_addtocart_text_hover_color ); ?> !important;<?php } ?>
		<?php
		if ( isset( $wp_timeline_addtocart_hover_backgroundcolor ) && '' !== $wp_timeline_addtocart_hover_backgroundcolor ) {
			?>
			background: <?php echo esc_attr( $wp_timeline_addtocart_hover_backgroundcolor ); ?> !important;<?php } ?>
		<?php
		if ( isset( $wp_timeline_addtocartbutton_hover_borderleft ) && '' !== $wp_timeline_addtocartbutton_hover_borderleft ) {
			?>
			border-left:<?php echo esc_attr( $wp_timeline_addtocartbutton_hover_borderleft ) . 'px'; ?> solid <?php echo esc_attr( $wp_timeline_addtocartbutton_hover_borderleftcolor ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_addtocartbutton_hover_borderright ) && '' !== $wp_timeline_addtocartbutton_hover_borderright ) {
			?>
			border-right:<?php echo esc_attr( $wp_timeline_addtocartbutton_hover_borderright ) . 'px'; ?> solid <?php echo esc_attr( $wp_timeline_addtocartbutton_hover_borderrightcolor ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_addtocartbutton_hover_bordertop ) && '' !== $wp_timeline_addtocartbutton_hover_bordertop ) {
			?>
			border-top:<?php echo esc_attr( $wp_timeline_addtocartbutton_hover_bordertop ) . 'px'; ?> solid <?php echo esc_attr( $wp_timeline_addtocartbutton_hover_bordertopcolor ); ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_addtocartbutton_hover_borderbuttom ) && '' !== $wp_timeline_addtocartbutton_hover_borderbuttom ) {
			?>
			border-bottom:<?php echo esc_attr( $wp_timeline_addtocartbutton_hover_borderbuttom ) . 'px'; ?> solid <?php echo esc_attr( $wp_timeline_addtocartbutton_hover_borderbottomcolor ); ?>;<?php } ?>
		<?php
		if ( isset( $display_addtocart_button_border_hover_radius ) && '' !== $display_addtocart_button_border_hover_radius ) {
			?>
			border-radius:<?php echo esc_attr( $display_addtocart_button_border_hover_radius ) . 'px'; ?>;<?php } ?>
		<?php
		if ( isset( $wp_timeline_addtocart_button_hover_box_shadow_color ) && '' !== $wp_timeline_addtocart_button_hover_box_shadow_color ) {
			?>
			box-shadow: <?php echo esc_attr( $wp_timeline_addtocart_button_hover_top_box_shadow ) . 'px'; ?> <?php echo esc_attr( $wp_timeline_addtocart_button_hover_right_box_shadow ) . 'px'; ?> <?php echo esc_attr( $wp_timeline_addtocart_button_hover_bottom_box_shadow ) . 'px'; ?> <?php echo esc_attr( $wp_timeline_addtocart_button_hover_left_box_shadow ) . 'px'; ?> <?php echo esc_attr( $wp_timeline_addtocart_button_hover_box_shadow_color ); ?> !important;<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .yith-wcwl-add-to-wishlist{ margin-top: 0 }
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_wishlistbutton_on_same_line.wp_timeline_cartwishlist_wrapp {
		<?php
		if ( isset( $wp_timeline_cart_wishlistbutton_alignment ) && '' !== $wp_timeline_cart_wishlistbutton_alignment ) {
			?>
			text-align : <?php echo esc_attr( $wp_timeline_cart_wishlistbutton_alignment ); ?>;<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_wishlistbutton_on_same_line .wp_timeline_woocommerce_add_to_wishlist_wrap ,
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_wishlistbutton_on_same_line .wp_timeline_woocommerce_add_to_cart_wrap {
		display : inline-block;
	}
	<?php if ( isset( $wp_timeline_wishlistbutton_on ) && isset( $display_addtowishlist_button ) && 1 == $wp_timeline_wishlistbutton_on && 1 == $display_addtowishlist_button ) {  ?>
		<?php echo esc_attr( $layout_id ); ?> .wp_timeline_wishlistbutton_on_same_line.wp_timeline_cartwishlist_wrapp{
			<?php
			if ( isset( $wp_timeline_cart_wishlistbutton_alignment ) && '' !== $wp_timeline_cart_wishlistbutton_alignment ) {
				?>
				text-align : <?php echo esc_attr( $wp_timeline_cart_wishlistbutton_alignment ); ?>;<?php } ?>
		}
	<?php } else { ?>
		<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_cart_wrap {
			<?php
			if ( isset( $wp_timeline_addtocartbutton_alignment ) && '' !== $wp_timeline_addtocartbutton_alignment ) {
				?>
				text-align:<?php echo esc_attr( $wp_timeline_addtocartbutton_alignment ); ?>;<?php } ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_wishlist_wrap .yith-wcwl-add-button,
		<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_wishlist_wrap .yith-wcwl-wishlistexistsbrowse ,
		<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_wishlist_wrap .yith-wcwl-wishlistaddedbrowse{
			<?php
			if ( isset( $wp_timeline_wishlistbutton_alignment ) && '' !== $wp_timeline_wishlistbutton_alignment ) {
				?>
				text-align:<?php echo esc_attr( $wp_timeline_wishlistbutton_alignment ); ?>;<?php } ?>
		}
	<?php } ?>
	<?php if ( class_exists( 'YITH_WCWL' ) ) { ?>
		<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_wishlist_wrap .yith-wcwl-wishlistexistsbrowse .feedback,
		<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_wishlist_wrap .yith-wcwl-wishlistaddedbrowse .feedback{ 
			display: none !important; 
		}
		<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_wishlist_wrap .add_to_wishlist,
		<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_wishlist_wrap .yith-wcwl-wishlistexistsbrowse a,
		<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_wishlist_wrap .yith-wcwl-wishlistaddedbrowse a {
			<?php
			if ( isset( $wp_timeline_addtowishlist_button_fontsize ) && '' !== $wp_timeline_addtowishlist_button_fontsize ) {
				?>
				font-size: <?php echo esc_attr( $wp_timeline_addtowishlist_button_fontsize ) . 'px'; ?>;<?php } ?>
			<?php
			if ( isset( $wp_timeline_addtowishlist_button_fontface ) && '' !== $wp_timeline_addtowishlist_button_fontface ) {
				?>
				font-family: <?php echo esc_attr( $wp_timeline_addtowishlist_button_fontface ); ?>;<?php } ?>
			<?php
			if ( isset( $wp_timeline_addtowishlist_button_font_weight ) && '' !== $wp_timeline_addtowishlist_button_font_weight ) {
				?>
				font-weight: <?php echo esc_attr( $wp_timeline_addtowishlist_button_font_weight ); ?>;<?php } ?>
			<?php
			if ( isset( $display_wishlist_button_line_height ) && '' !== $display_wishlist_button_line_height ) {
				?>
				line-height: <?php echo esc_attr( $display_wishlist_button_line_height ); ?>;<?php } ?>
			<?php
			if ( isset( $wp_timeline_addtowishlist_button_font_italic ) && 1 == $wp_timeline_addtowishlist_button_font_italic ) { 
				?>
				font-style: <?php echo 'italic'; ?>;<?php } ?>
			<?php
			if ( isset( $wp_timeline_addtowishlist_button_letter_spacing ) && '' !== $wp_timeline_addtowishlist_button_letter_spacing ) {
				?>
				letter-spacing: <?php echo esc_attr( $wp_timeline_addtowishlist_button_letter_spacing ) . 'px'; ?>; <?php } ?>
			<?php
			if ( isset( $wp_timeline_addtowishlist_button_font_text_transform ) && '' !== $wp_timeline_addtowishlist_button_font_text_transform ) {
				?>
				text-transform: <?php echo esc_attr( $wp_timeline_addtowishlist_button_font_text_transform ); ?>;<?php } ?>
			<?php
			if ( isset( $wp_timeline_addtowishlist_button_font_text_decoration ) && '' !== $wp_timeline_addtowishlist_button_font_text_decoration ) {
				?>
				text-decoration: <?php echo esc_attr( $wp_timeline_addtowishlist_button_font_text_decoration ); ?> !important;<?php } ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_wishlist_wrap .add_to_wishlist,
		<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_wishlist_wrap .yith-wcwl-wishlistexistsbrowse a,
		<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_wishlist_wrap .yith-wcwl-wishlistaddedbrowse a{
			<?php
			if ( isset( $wp_timeline_wishlist_textcolor ) && '' !== $wp_timeline_wishlist_textcolor ) {
				?>
				color: <?php echo esc_attr( $wp_timeline_wishlist_textcolor ); ?> !important;<?php } ?>
			<?php
			if ( isset( $wp_timeline_wishlist_backgroundcolor ) && '' !== $wp_timeline_wishlist_backgroundcolor ) {
				?>
				background: <?php echo esc_attr( $wp_timeline_wishlist_backgroundcolor ); ?>;<?php } ?>
			<?php
			if ( isset( $wp_timeline_wishlistbutton_borderleft ) && '' !== $wp_timeline_wishlistbutton_borderleft ) {
				?>
				border-left:<?php echo esc_attr( $wp_timeline_wishlistbutton_borderleft ) . 'px'; ?> solid <?php echo esc_attr( $wp_timeline_wishlistbutton_borderleftcolor ); ?>;<?php } ?>
			<?php
			if ( isset( $wp_timeline_wishlistbutton_borderright ) && '' !== $wp_timeline_wishlistbutton_borderright ) {
				?>
				border-right:<?php echo esc_attr( $wp_timeline_wishlistbutton_borderright ) . 'px'; ?> solid <?php echo esc_attr( $wp_timeline_wishlistbutton_borderrightcolor ); ?>;<?php } ?>
			<?php
			if ( isset( $wp_timeline_wishlistbutton_bordertop ) && '' !== $wp_timeline_wishlistbutton_bordertop ) {
				?>
				border-top:<?php echo esc_attr( $wp_timeline_wishlistbutton_bordertop ) . 'px'; ?> solid <?php echo esc_attr( $wp_timeline_wishlistbutton_bordertopcolor ); ?>;<?php } ?>
			<?php
			if ( isset( $wp_timeline_wishlistbutton_borderbuttom ) && '' !== $wp_timeline_wishlistbutton_borderbuttom ) {
				?>
				border-bottom:<?php echo esc_attr( $wp_timeline_wishlistbutton_borderbuttom ) . 'px'; ?> solid <?php echo esc_attr( $wp_timeline_wishlistbutton_borderbottomcolor ); ?>;<?php } ?>
			<?php
			if ( isset( $display_wishlist_button_border_radius ) && '' !== $display_wishlist_button_border_radius ) {
				?>
				border-radius:<?php echo esc_attr( $display_wishlist_button_border_radius ) . 'px'; ?>;<?php } ?>
			<?php if ( isset( $wp_timeline_wishlistbutton_padding_topbottom ) && '' !== $wp_timeline_wishlistbutton_padding_topbottom ) { ?>
				padding-top: <?php echo esc_attr( $wp_timeline_wishlistbutton_padding_topbottom ) . 'px'; ?>;
				padding-bottom: <?php echo esc_attr( $wp_timeline_wishlistbutton_padding_topbottom ) . 'px'; ?>;
			<?php } ?>
			<?php if ( isset( $wp_timeline_wishlistbutton_padding_leftright ) && '' !== $wp_timeline_wishlistbutton_padding_leftright ) { ?>
				padding-left: <?php echo esc_attr( $wp_timeline_wishlistbutton_padding_leftright ) . 'px'; ?>;
				padding-right: <?php echo esc_attr( $wp_timeline_wishlistbutton_padding_leftright ) . 'px'; ?>;
			<?php } ?>
			<?php if ( isset( $wp_timeline_wishlistbutton_padding_topbottom ) && '' !== $wp_timeline_wishlistbutton_padding_topbottom ) { ?>
				padding-top: <?php echo esc_attr( $wp_timeline_wishlistbutton_padding_topbottom ) . 'px'; ?>;
				padding-bottom: <?php echo esc_attr( $wp_timeline_wishlistbutton_padding_topbottom ) . 'px'; ?>;
			<?php } ?>
			<?php if ( isset( $wp_timeline_wishlistbutton_margin_topbottom ) && '' !== $wp_timeline_wishlistbutton_margin_topbottom ) { ?>
				margin-left: <?php echo esc_attr( $wp_timeline_wishlistbutton_margin_topbottom ) . 'px'; ?>;
				margin-right: <?php echo esc_attr( $wp_timeline_wishlistbutton_margin_topbottom ) . 'px'; ?>;
			<?php } ?>
			<?php if ( isset( $wp_timeline_wishlistbutton_margin_leftright ) && '' !== $wp_timeline_wishlistbutton_margin_leftright ) { ?>
				margin-top: <?php echo esc_attr( $wp_timeline_wishlistbutton_margin_leftright ) . 'px'; ?>;
				margin-bottom: <?php echo esc_attr( $wp_timeline_wishlistbutton_margin_leftright ) . 'px'; ?>;
			<?php } ?>
			<?php
			if ( isset( $wp_timeline_wishlist_button_box_shadow_color ) && $wp_timeline_wishlist_button_box_shadow_color ) {
				?>
				box-shadow: <?php echo esc_attr( $wp_timeline_wishlist_button_top_box_shadow ) . 'px'; ?> <?php echo esc_attr( $wp_timeline_wishlist_button_right_box_shadow ) . 'px'; ?> <?php echo esc_attr( $wp_timeline_wishlist_button_bottom_box_shadow ) . 'px'; ?> <?php echo esc_attr( $wp_timeline_wishlist_button_left_box_shadow ) . 'px'; ?> <?php echo esc_attr( $wp_timeline_wishlist_button_box_shadow_color ); ?> !important;<?php } ?>
			display: inline-block;
		}
		<?php echo esc_attr( $layout_id ); ?> .add_to_wishlist:before {
			content: "\f08a";
			font-family: fontawesome;
			<?php
			if ( isset( $wp_timeline_addtowishlist_button_font_weight ) && '' !== $wp_timeline_addtowishlist_button_font_weight ) {
				?>
				font-weight: <?php echo esc_attr( $wp_timeline_addtowishlist_button_font_weight ); ?>;<?php } ?>
			vertical-align: middle;
			<?php
			if ( isset( $wp_timeline_addtowishlist_button_font_italic ) && 1 == $wp_timeline_addtowishlist_button_font_italic ) { 
				?>
				font-style: <?php echo 'italic'; ?>;<?php } ?>
			<?php
			if ( isset( $wp_timeline_addtowishlist_button_fontsize ) && '' !== $wp_timeline_addtowishlist_button_fontsize ) {
				?>
				font-size: <?php echo esc_attr( $wp_timeline_addtowishlist_button_fontsize ) . 'px'; ?>;<?php } ?>
			<?php
			if ( isset( $display_wishlist_button_line_height ) && '' !== $display_wishlist_button_line_height ) {
				?>
				line-height: <?php echo esc_attr( $display_wishlist_button_line_height ); ?>;<?php } ?>
			<?php
			if ( isset( $wp_timeline_addtowishlist_button_letter_spacing ) && '' !== $wp_timeline_addtowishlist_button_letter_spacing ) {
				?>
				letter-spacing: <?php echo esc_attr( $wp_timeline_addtowishlist_button_letter_spacing ) . 'px'; ?>;<?php } ?>
			<?php
			if ( isset( $wp_timeline_addtowishlist_button_font_text_transform ) && '' !== $wp_timeline_addtowishlist_button_font_text_transform ) {
				?>
				text-transform: <?php echo esc_attr( $wp_timeline_addtowishlist_button_font_text_transform ); ?>;<?php } ?>
			<?php
			if ( isset( $wp_timeline_addtowishlist_button_font_text_decoration ) && '' !== $wp_timeline_addtowishlist_button_font_text_decoration ) {
				?>
				text-decoration: <?php echo esc_attr( $wp_timeline_addtowishlist_button_font_text_decoration ); ?>;<?php } ?>
		}
		<?php if ( isset( $wp_timeline_wishlistbutton_on ) && isset( $display_addtowishlist_button ) && 1 == $wp_timeline_wishlistbutton_on && 1 == $display_addtowishlist_button ) {  ?>
			<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_meta_box .wp_timeline_wishlistbutton_on_same_line {
				padding: 3px;
			}
			<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_meta_box .wp_timeline_wishlistbutton_on_same_line .wp_timeline_woocommerce_add_to_cart_wrap {
				display: inline-block;width: auto;vertical-align: top;
			}
			<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_meta_box .wp_timeline_wishlistbutton_on_same_line .wp_timeline_woocommerce_add_to_wishlist_wrap {
				display: inline-block;width: auto;vertical-align: top;
			}
		<?php } ?>
		<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_wishlist_wrap .add_to_wishlist:hover,
		<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_wishlist_wrap .add_to_wishlist:focus,
		<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_wishlist_wrap .yith-wcwl-wishlistexistsbrowse a:hover,
		<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_wishlist_wrap .yith-wcwl-wishlistexistsbrowse a:focus,
		<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_wishlist_wrap .yith-wcwl-wishlistaddedbrowse a:hover,
		<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_add_to_wishlist_wrap .yith-wcwl-wishlistaddedbrowse a:focus {
			<?php
			if ( isset( $wp_timeline_wishlist_text_hover_color ) && '' !== $wp_timeline_wishlist_text_hover_color ) {
				?>
				color: <?php echo esc_attr( $wp_timeline_wishlist_text_hover_color ); ?>;<?php } ?>
			<?php
			if ( isset( $wp_timeline_wishlist_hover_backgroundcolor ) && '' !== $wp_timeline_wishlist_hover_backgroundcolor ) {
				?>
				background: <?php echo esc_attr( $wp_timeline_wishlist_hover_backgroundcolor ); ?>;<?php } ?>
			<?php
			if ( isset( $wp_timeline_wishlistbutton_hover_borderleft ) && '' !== $wp_timeline_wishlistbutton_hover_borderleft ) {
				?>
				border-left:<?php echo esc_attr( $wp_timeline_wishlistbutton_hover_borderleft ) . 'px'; ?> solid <?php echo esc_attr( $wp_timeline_wishlistbutton_hover_borderleftcolor ); ?>;<?php } ?>
			<?php
			if ( isset( $wp_timeline_wishlistbutton_hover_borderright ) && '' !== $wp_timeline_wishlistbutton_hover_borderright ) {
				?>
				border-right:<?php echo esc_attr( $wp_timeline_wishlistbutton_hover_borderright ) . 'px'; ?> solid <?php echo esc_attr( $wp_timeline_wishlistbutton_hover_borderrightcolor ); ?>;<?php } ?>
			<?php
			if ( isset( $wp_timeline_wishlistbutton_hover_bordertop ) && '' !== $wp_timeline_wishlistbutton_hover_bordertop ) {
				?>
				border-top:<?php echo esc_attr( $wp_timeline_wishlistbutton_hover_bordertop ) . 'px'; ?> solid <?php echo esc_attr( $wp_timeline_wishlistbutton_hover_bordertopcolor ); ?>;<?php } ?>
			<?php
			if ( isset( $wp_timeline_wishlistbutton_hover_borderbuttom ) && '' !== $wp_timeline_wishlistbutton_hover_borderbuttom ) {
				?>
				border-bottom:<?php echo esc_attr( $wp_timeline_wishlistbutton_hover_borderbuttom ) . 'px'; ?> solid <?php echo esc_attr( $wp_timeline_wishlistbutton_hover_borderbottomcolor ); ?>;<?php } ?>
			<?php
			if ( isset( $display_wishlist_button_border_hover_radius ) && '' !== $display_wishlist_button_border_hover_radius ) {
				?>
				border-radius:<?php echo esc_attr( $display_wishlist_button_border_hover_radius ) . 'px'; ?>;<?php } ?>
			<?php
			if ( isset( $wp_timeline_wishlist_button_hover_box_shadow_color ) && '' !== $wp_timeline_wishlist_button_hover_box_shadow_color ) {
				?>
				box-shadow: <?php echo esc_attr( $wp_timeline_wishlist_button_hover_top_box_shadow ) . 'px'; ?> <?php echo esc_attr( $wp_timeline_wishlist_button_hover_right_box_shadow ) . 'px'; ?> <?php echo esc_attr( $wp_timeline_wishlist_button_hover_bottom_box_shadow ) . 'px'; ?> <?php echo esc_attr( $wp_timeline_wishlist_button_hover_left_box_shadow ) . 'px'; ?> <?php echo esc_attr( $wp_timeline_wishlist_button_hover_box_shadow_color ); ?>;<?php } ?>;
		}
	<?php } ?>
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_price_wrap .price ins {
		background: none;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template img.ajax-loading {
		display: none !important;
	}
<?php } ?>
/** End Woocommerce Layout settingd */

/** Link label css */
<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl-comment i,
<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .link-lable {
	color : <?php echo esc_attr( $template_contentcolor ); ?>;
}
<?php echo esc_attr( $layout_id ); ?> .blog_template .wtl-read-more-div a.wtl-read-more,
<?php echo esc_attr( $layout_id ); ?> .blog_template .wtl-read-more-div a.more-tag{
	<?php
	if ( isset( $read_more_on ) && isset( $template_readmorebackcolor ) && 2 == $read_more_on && '' !== $template_readmorebackcolor ) { 
		?>
		background: <?php echo esc_attr( $template_readmorebackcolor ); ?>;<?php } ?>
	<?php
	if ( isset( $template_readmorecolor ) && '' == $template_readmorecolor ) { 
		?>
		color:<?php echo esc_attr( $template_readmorecolor ); ?>;<?php } ?>
	<?php
	if ( isset( $read_more_on ) && 1 == $read_more_on ) { 
		?>
		border: none;<?php } ?>
}
<?php if ( isset( $read_more_on ) && 2 == $read_more_on ) {  ?>
		<?php echo esc_attr( $layout_id ); ?> .blog_template .wtl-read-more-div a.more-tag:hover {
			background: <?php echo esc_attr( $template_readmore_hover_backcolor ); ?>;
		}
	<?php } ?>
<?php
if ( 'timeline' === $wp_timeline_theme ) {
	?>
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template.timeline.blog-wrap.odd_class .post_content_wrap:before,
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template.timeline.blog-wrap.odd_class .post_content_wrap:after {
		border-right-color : <?php echo esc_attr( $template_color ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .timeline.blog-wrap .datetime,
	<?php echo esc_attr( $layout_id ); ?> .timeline_bg_wrap:before {
		background: none repeat scroll 0 0 <?php echo esc_attr( $template_color ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline.blog-wrap .post_hentry:before,
	<?php echo esc_attr( $layout_id ); ?> .blog_template.timeline .timeline_bg_wrap:before{
		background:<?php echo esc_attr( $template_color ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline.blog-wrap.odd_class .post_content_wrap:before,
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline.blog-wrap.odd_class .post_content_wrap:after {
		border-left: 8px solid <?php echo esc_attr( $template_color ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline.blog-wrap.even_class .post_content_wrap:before,
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline.blog-wrap.even_class .post_content_wrap:after {
		border-right: 8px solid <?php echo esc_attr( $template_color ); ?>;
	}
	/* left side design */
	<?php echo esc_attr( $layout_id ); ?> .timeline_bg_wrap.right_side .blog_template.wtl_blog_template.timeline.blog-wrap.odd_class .post_content_wrap:before,
	<?php echo esc_attr( $layout_id ); ?> .timeline_bg_wrap.right_side .blog_template.wtl_blog_template.timeline.blog-wrap.odd_class .post_content_wrap:after {
		border-right: 8px solid <?php echo esc_attr( $template_color ); ?>;
		border-left: none;
	}
	<?php echo esc_attr( $layout_id ); ?> .timeline_bg_wrap.right_side .blog_template.wtl_blog_template.timeline.blog-wrap.even_class .post_content_wrap:before,
	<?php echo esc_attr( $layout_id ); ?> .timeline_bg_wrap.right_side .blog_template.wtl_blog_template.timeline.blog-wrap.even_class .post_content_wrap:after {
		border-right: 8px solid <?php echo esc_attr( $template_color ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .timeline_bg_wrap.right_side .wtl_blog_template.timeline.blog-wrap.odd_class .post_content_wrap:before,
	<?php echo esc_attr( $layout_id ); ?> .timeline_bg_wrap.right_side .wtl_blog_template.timeline.blog-wrap.odd_class .post_content_wrap:after {
		border-left-color : <?php echo esc_attr( $template_color ); ?>;
	}
	/* right side design */
	<?php echo esc_attr( $layout_id ); ?> .timeline_bg_wrap.left_side .blog_template.wtl_blog_template.timeline.blog-wrap.odd_class .post_content_wrap:before,
	<?php echo esc_attr( $layout_id ); ?> .timeline_bg_wrap.left_side .blog_template.wtl_blog_template.timeline.blog-wrap.odd_class .post_content_wrap:after {
		border-left: 8px solid <?php echo esc_attr( $template_color ); ?>;
		border-right: none;
	}
	<?php echo esc_attr( $layout_id ); ?> .timeline_bg_wrap.left_side .blog_template.wtl_blog_template.timeline.blog-wrap.even_class .post_content_wrap:before,
	<?php echo esc_attr( $layout_id ); ?> .timeline_bg_wrap.left_side .blog_template.wtl_blog_template.timeline.blog-wrap.even_class .post_content_wrap:after {
		border-left: 8px solid <?php echo esc_attr( $template_color ); ?>;
		border-right: none;
	}
	<?php echo esc_attr( $layout_id ); ?> .timeline_bg_wrap.left_side .wtl_blog_template.timeline.blog-wrap.odd_class .post_content_wrap:before,
	<?php echo esc_attr( $layout_id ); ?> .timeline_bg_wrap.left_side .wtl_blog_template.timeline.blog-wrap.odd_class .post_content_wrap:after {
		border-right-color : <?php echo esc_attr( $template_color ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline.blog-wrap .post_content_wrap {
		border:1px solid <?php echo esc_attr( $template_color ); ?>;
		background: <?php echo esc_attr( $template_bgcolor ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline.blog-wrap .post_content_wrap .blog_footer,
	<?php echo esc_attr( $layout_id ); ?>.wp_timeline_archive.timeline .author-avatar-div .avtar-img img.avatar{
		border-top: 1px solid <?php echo esc_attr( $template_color ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline .label_featured_post span{
		background: <?php echo esc_attr( $template_readmorebackcolor ); ?>;
		color:<?php echo esc_attr( $template_readmorecolor ); ?>;
		border-color: <?php echo esc_attr( $template_readmorebackcolor ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline .label_featured_post span{
		<?php
		if ( isset( $template_titlefontface ) && $template_titlefontface ) {
			?>
			font-family: <?php echo esc_attr( $template_titlefontface ); ?>;<?php } ?>
		<?php
		if ( isset( $template_title_font_weight ) && $template_title_font_weight ) {
			?>
			font-weight: <?php echo esc_attr( $template_title_font_weight ); ?>;<?php } ?>
		<?php
		if ( isset( $template_title_font_line_height ) && $template_title_font_line_height ) {
			?>
			line-height: <?php echo esc_attr( $template_title_font_line_height ); ?>;<?php } ?>
		<?php
		if ( isset( $template_title_font_italic ) && 1 == $template_title_font_italic ) { 
			?>
			font-style: <?php echo 'italic'; ?>;<?php } ?>
		<?php
		if ( isset( $template_title_font_text_transform ) && $template_title_font_text_transform ) {
			?>
			text-transform: <?php echo esc_attr( $template_title_font_text_transform ); ?>;<?php } ?>
		<?php
		if ( isset( $template_title_font_text_decoration ) && $template_title_font_text_decoration ) {
			?>
			text-decoration: <?php echo esc_attr( $template_title_font_text_decoration ); ?>;<?php } ?>
		<?php
		if ( isset( $template_title_font_letter_spacing ) && $template_title_font_letter_spacing ) {
			?>
			letter-spacing: <?php echo esc_attr( $template_title_font_letter_spacing ) . 'px'; ?>;<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .post-icon {
		background:<?php echo esc_attr( $template_color ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline.blog-wrap .date_wrap .posted_by.wp_timeline_has_links,
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline.blog-wrap .date_wrap .posted_by a,
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline.blog-wrap .categories.wp_timeline_has_links,
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline.blog-wrap .tags.wp_timeline_has_links,
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline.blog-wrap .tags a,
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline.blog-wrap .categories a {
		color:<?php echo esc_attr( $template_ftcolor ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline.blog-wrap .date_wrap .posted_by a:hover,
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline.blog-wrap .tags a:hover,
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline.blog-wrap .categories a:hover {
		color:<?php echo esc_attr( $template_fthovercolor ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline .desc h3 {
		color:<?php echo esc_attr( $template_titlecolor ); ?>;
		background:<?php echo esc_attr( $template_titlebackcolor ); ?>;
		font-size: <?php echo esc_attr( $template_titlefontsize ) . 'px'; ?>;
		<?php
		if ( isset( $template_titlefontface ) && $template_titlefontface ) {
			?>
			font-family: <?php echo esc_attr( $template_titlefontface ); ?>;
		<?php } ?>
		margin: 0;
		<?php
		if ( isset( $template_title_font_weight ) && $template_title_font_weight ) {
			?>
			font-weight: <?php echo esc_attr( $template_title_font_weight ); ?>;<?php } ?>
		<?php
		if ( isset( $template_title_font_line_height ) && $template_title_font_line_height ) {
			?>
			line-height: <?php echo esc_attr( $template_title_font_line_height ); ?>;<?php } ?>
		<?php
		if ( isset( $template_title_font_italic ) && 1 == $template_title_font_italic ) { 
			?>
			font-style: <?php echo 'italic'; ?>;<?php } ?>
		<?php
		if ( isset( $template_title_font_text_transform ) && $template_title_font_text_transform ) {
			?>
			text-transform: <?php echo esc_attr( $template_title_font_text_transform ); ?>;<?php } ?>
		<?php
		if ( isset( $template_title_font_text_decoration ) && $template_title_font_text_decoration ) {
			?>
			text-decoration: <?php echo esc_attr( $template_title_font_text_decoration ); ?>;
		<?php } ?>
		<?php
		if ( isset( $template_title_font_letter_spacing ) && $template_title_font_letter_spacing ) {
			?>
			letter-spacing: <?php echo esc_attr( $template_title_font_letter_spacing ) . 'px'; ?>;
		<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline .desc h3:hover a {
		color:<?php echo esc_attr( $template_titlehovercolor ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline .desc h3 a{
		color:<?php echo esc_attr( $template_titlecolor ); ?>;
		font-size:  <?php echo esc_attr( $template_titlefontsize ) . 'px'; ?>;
		<?php
		if ( isset( $template_titlefontface ) && $template_titlefontface ) {
			?>
			font-family: <?php echo esc_attr( $template_titlefontface ); ?>;
		<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?>.wp_timeline_archive .author-avatar-div .author_content .author{
		color:<?php echo esc_attr( $template_titlecolor ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template.timeline a.more-tag {
		<?php
		if ( isset( $read_more_on ) && 2 == $read_more_on ) { 
			?>
			background:<?php echo esc_attr( $template_readmorebackcolor ); ?>;<?php } ?>
			color:<?php echo esc_attr( $template_readmorecolor ); ?>;
		<?php
		if ( isset( $content_font_family ) && '' != $content_font_family ) { 
			?>
			font-family: <?php echo esc_attr( $content_font_family ); ?>; <?php } ?>
	}
	<?php if ( isset( $read_more_on ) && 2 == $read_more_on ) {  ?>
		<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template.media-grid a.more-tag:hover {
			background:<?php echo esc_attr( $template_readmore_hover_backcolor ); ?>;
		}
	<?php } ?>
	<?php echo esc_attr( $layout_id ); ?> .timeline a{
		color: <?php echo esc_attr( $template_ftcolor ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .timeline a:hover{
		color: <?php echo esc_attr( $template_fthovercolor ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline.blog-wrap .date_wrap .posted_by,
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline.blog-wrap .tags,
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline.blog-wrap .tags .link-lable,
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline.blog-wrap .categories,
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline.blog-wrap .categories .link-lable,
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline .post_content {
		font-size: <?php echo esc_attr( $content_fontsize ) . 'px;'; ?>;
		color: <?php echo esc_attr( $template_contentcolor ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline .label_featured_post span {
		font-size: <?php echo esc_attr( $content_fontsize ) . 'px;'; ?>;
	}
	<?php echo esc_attr( $layout_id ); ?>.wp_timeline_archive.timeline .author-avatar-div{
		border: 1px solid <?php echo esc_attr( $template_color ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline.blog-wrap .date_wrap .posted_by i,
	<?php echo esc_attr( $layout_id ); ?> .blog_footer span,.date_wrap{
		color: <?php echo esc_attr( $template_contentcolor ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .timeline .read_more a.more-tag {
		<?php
		if ( isset( $wp_timeline_readmore_button_borderleft ) ) {
			?>
			border-left:<?php echo esc_attr( $wp_timeline_readmore_button_borderleft ) . 'px'; ?> <?php echo esc_attr( $read_more_button_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_borderleftcolor ); ?> !important;<?php } ?>
		<?php
		if ( isset( $wp_timeline_readmore_button_borderright ) ) {
			?>
			border-right:<?php echo esc_attr( $wp_timeline_readmore_button_borderright ) . 'px'; ?> <?php echo esc_attr( $read_more_button_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_borderrightcolor ); ?> !important;<?php } ?>
		<?php
		if ( isset( $wp_timeline_readmore_button_bordertop ) ) {
			?>
			border-top:<?php echo esc_attr( $wp_timeline_readmore_button_bordertop ) . 'px'; ?> <?php echo esc_attr( $read_more_button_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_bordertopcolor ); ?> !important;<?php } ?>
		<?php
		if ( isset( $wp_timeline_readmore_button_borderbottom ) ) {
			?>
			border-bottom:<?php echo esc_attr( $wp_timeline_readmore_button_borderbottom ) . 'px'; ?> <?php echo esc_attr( $read_more_button_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_borderbottomcolor ); ?> !important;
		<?php } ?>
		padding-top: <?php echo esc_attr( $readmore_button_paddingtop ) . 'px'; ?>;
		padding-bottom: <?php echo esc_attr( $readmore_button_paddingbottom ) . 'px'; ?>;
		padding-right: <?php echo esc_attr( $readmore_button_paddingright ) . 'px'; ?>;
		padding-left: <?php echo esc_attr( $readmore_button_paddingleft ) . 'px'; ?>;
		<?php
		if ( isset( $readmore_button_border_radius ) ) {
			?>
			border-radius: <?php echo esc_attr( $readmore_button_border_radius ) . 'px'; ?> !important;
		<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl-read-more a.more-tag:hover{
		<?php
		if ( isset( $wp_timeline_readmore_button_hover_borderleft ) ) {
			?>
			border-left:<?php echo esc_attr( $wp_timeline_readmore_button_hover_borderleft ) . 'px'; ?> <?php echo esc_attr( $read_more_button_hover_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_hover_borderleftcolor ); ?> !important;<?php } ?>
		<?php
		if ( isset( $wp_timeline_readmore_button_hover_borderright ) ) {
			?>
			border-right:<?php echo esc_attr( $wp_timeline_readmore_button_hover_borderright ) . 'px'; ?> <?php echo esc_attr( $read_more_button_hover_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_hover_borderrightcolor ); ?> !important;<?php } ?>
		<?php
		if ( isset( $wp_timeline_readmore_button_hover_bordertop ) ) {
			?>
			border-top:<?php echo esc_attr( $wp_timeline_readmore_button_hover_bordertop ) . 'px'; ?> <?php echo esc_attr( $read_more_button_hover_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_hover_bordertopcolor ); ?> !important;<?php } ?>
		<?php
		if ( isset( $wp_timeline_readmore_button_hover_borderbottom ) ) {
			?>
			border-bottom:<?php echo esc_attr( $wp_timeline_readmore_button_hover_borderbottom ) . 'px'; ?> <?php echo esc_attr( $read_more_button_hover_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_hover_borderbottomcolor ); ?> !important;<?php } ?>
		<?php
		if ( isset( $readmore_button_hover_border_radius ) ) {
			?>
			border-radius: <?php echo esc_attr( $readmore_button_hover_border_radius ) . 'px'; ?> !important;<?php } ?>
	}
	<?php if ( isset( $read_more_on ) && 2 == $read_more_on ) {  ?>
		<?php echo esc_attr( $layout_id ); ?> .blog_template.wtl_blog_template.timeline a.more-tag:hover {
			background: <?php echo esc_attr( $template_readmore_hover_backcolor ); ?>;
			border: 1px solid <?php echo esc_attr( $template_readmore_hover_backcolor ); ?>;
		}
	<?php } ?>
	<?php
}
/*------------------ Template: Cool Layout --------------- */
if ( 'cool_horizontal' === $wp_timeline_theme ) {
	?>
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper{
		<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) . ';' : ''; ?>
	}
	/* Title*/
	<?php
	echo esc_attr( $layout_id );
	?>
	.horizontal .wtl-post-title {
		background: <?php echo esc_attr( $template_titlebackcolor ); ?>;
		color: <?php echo esc_attr( $template_titlecolor ); ?>;
		font-size: <?php echo esc_attr( $template_titlefontsize ) . 'px'; ?>;
		<?php
		if ( isset( $template_titlefontface ) && $template_titlefontface ) {
			?>
			font-family: <?php echo esc_attr( $template_titlefontface ); ?>;<?php } ?>
		<?php
		if ( isset( $template_title_font_weight ) && $template_title_font_weight ) {
			?>
			font-weight: <?php echo esc_attr( $template_title_font_weight ); ?>;<?php } ?>
		<?php
		if ( isset( $template_title_font_line_height ) && $template_title_font_line_height ) {
			?>
			line-height: <?php echo esc_attr( $template_title_font_line_height ); ?>;<?php } ?>
		<?php
		if ( isset( $template_title_font_italic ) && 1 == $template_title_font_italic ) { 
			?>
			font-style: <?php echo 'italic'; ?>;<?php } ?>
		<?php
		if ( isset( $template_title_font_text_transform ) && $template_title_font_text_transform ) {
			?>
			text-transform: <?php echo esc_attr( $template_title_font_text_transform ); ?>;<?php } ?>
		<?php
		if ( isset( $template_title_font_text_decoration ) && $template_title_font_text_decoration ) {
			?>
			text-decoration: <?php echo esc_attr( $template_title_font_text_decoration ); ?>;<?php } ?>
		<?php
		if ( isset( $template_title_font_letter_spacing ) && $template_title_font_letter_spacing ) {
			?>
			letter-spacing: <?php echo esc_attr( $template_title_font_letter_spacing ) . 'px'; ?>;<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .horizontal .wtl-post-title > a {
		color: <?php echo esc_attr( $template_titlecolor ); ?>;
		font-size: <?php echo esc_attr( $template_titlefontsize ) . 'px'; ?>;
		<?php
		if ( isset( $template_titlefontface ) && $template_titlefontface ) {
			?>
			font-family: <?php echo esc_attr( $template_titlefontface ); ?>;<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .horizontal .wtl-post-title > a:hover {
		color: <?php echo esc_attr( $template_titlehovercolor ); ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .logbook.flatLine .lb-node-desc span,
	<?php echo esc_attr( $layout_id ); ?> .logbook.flatLine a.lb-line-node:after,
	<?php echo esc_attr( $layout_id ); ?> .logbook.flatLine .lb-item.lb-node-hover:before,
	<?php echo esc_attr( $layout_id ); ?> #content .logbook.flatLine .lb-item.lb-node-hover:before,
	<?php echo esc_attr( $layout_id ); ?> #content .logbook.flatLine .lb-node-desc span,
	<?php echo esc_attr( $layout_id ); ?> #content .logbook.flatLine a.lb-line-node:after{
		background-color: <?php echo esc_attr( $template_color ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .logbook.flatLine a.lb-line-node.active:after,
	<?php echo esc_attr( $layout_id ); ?> #content .logbook.flatLine a.lb-line-node.active:after  {
		border-color: <?php echo esc_attr( $template_color ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .logbook.flatLine .lb-item.lb-node-hover:after,
	<?php echo esc_attr( $layout_id ); ?> #content .logbook.flatLine .lb-item.lb-node-hover:after {
		border-top-color: <?php echo esc_attr( $template_color ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .logbook.flatLine a.lb-line-node.active,
	<?php echo esc_attr( $layout_id ); ?> #content .logbook.flatLine a.lb-line-node.active {
		color: <?php echo esc_attr( $template_titlehovercolor ); ?>
	}

	<?php echo esc_attr( $layout_id ); ?> .horizontal .blog_footer .tags,
	<?php echo esc_attr( $layout_id ); ?> .horizontal .blog_footer .categories {
		color: <?php echo esc_attr( $template_ftcolor ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .horizontal .mauthor.wp_timeline_no_link,
	<?php echo esc_attr( $layout_id ); ?> .horizontal .wp_timeline_no_link i,
	<?php echo esc_attr( $layout_id ); ?> .horizontal .blog_footer .tags,
	<?php echo esc_attr( $layout_id ); ?> .horizontal .blog_footer .tags .link-lable,
	<?php echo esc_attr( $layout_id ); ?> .horizontal .blog_footer .categories .link-lable,
	<?php echo esc_attr( $layout_id ); ?> .horizontal .blog_footer .categories.categories_link {
		color: <?php echo esc_attr( $template_contentcolor ); ?>;
	}
	<?php
	echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
	?>

	<?php echo esc_attr( $layout_id ); ?> .logbook .lb-line div#lb_line_left:after, <?php echo esc_attr( $layout_id ); ?> .logbook .lb-line #lb_line_right:after { 
		<?php
			 if ( isset( $wtl_settings['navigation_arrow_size'] ) ) 
			 { echo 'font-size:' . esc_attr( $wtl_settings['navigation_arrow_size'] ) . 'px ;'; } 
			 if ( isset( $wtl_settings['navigation_color'] ) ) { echo 'color:' . esc_attr( $wtl_settings['navigation_color'] ) . ' !important;'; } ?> 
			 } 
	
	<?php echo esc_attr( $layout_id ); ?> .logbook .lb-line div#lb_line_left:after, <?php echo esc_attr( $layout_id ); ?> .logbook .lb-line #lb_line_right:after{ <?php if ( isset( $wtl_settings['navigation_bg_color'] ) ) { echo 'background:' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ' !important;'; } ?> }
	/* Content */
	<?php echo esc_attr( $layout_id ); ?> .horizontal .post-content-area .wtl-post_content {
		color: <?php echo esc_attr( $template_contentcolor ); ?>;
		font-size: <?php echo esc_attr( $content_fontsize ) . 'px;'; ?>;
		<?php
		if ( isset( $content_font_family ) && '' != $content_font_family ) { 
			?>
			font-family: <?php echo esc_attr( $content_font_family ); ?>;  <?php } ?>
		<?php
		if ( isset( $content_font_weight ) && $content_font_weight ) {
			?>
			font-weight: <?php echo esc_attr( $content_font_weight ); ?>;<?php } ?>
		<?php
		if ( isset( $content_font_line_height ) && $content_font_line_height ) {
			?>
			line-height: <?php echo esc_attr( $content_font_line_height ); ?>;
		<?php } ?>
		<?php
		if ( isset( $content_font_italic ) && 1 == $content_font_italic ) { 
			?>
			font-style: <?php echo 'italic'; ?>;<?php } ?>
		<?php
		if ( isset( $content_font_text_transform ) && $content_font_text_transform ) {
			?>
			text-transform: <?php echo esc_attr( $content_font_text_transform ); ?>;<?php } ?>
		<?php
		if ( isset( $content_font_text_decoration ) && $content_font_text_decoration ) {
			?>
			text-decoration: <?php echo esc_attr( $content_font_text_decoration ); ?>;<?php } ?>
		<?php
		if ( isset( $content_font_letter_spacing ) && $content_font_letter_spacing ) {
			?>
			letter-spacing: <?php echo esc_attr( $content_font_letter_spacing ) . 'px'; ?>;<?php } ?>
		<?php echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) ); ?>
	}
	/* Read More */
	<?php echo esc_attr( $layout_id ); ?> .horizontal a.wtl-read-more {
		color:<?php echo esc_attr( $template_readmorecolor ); ?>;
		<?php if ( isset( $read_more_on ) && 2 == $read_more_on ) {  ?>
			background: <?php echo esc_attr( $template_readmorebackcolor ); ?>;
			border-color: <?php echo esc_attr( $template_readmorecolor ); ?>;
		<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl-read-more-div a.wtl-read-more {
		<?php
		if ( isset( $wp_timeline_readmore_button_borderleft ) ) {
			?>
			border-left:<?php echo esc_attr( $wp_timeline_readmore_button_borderleft ) . 'px'; ?> <?php echo esc_attr( $read_more_button_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_borderleftcolor ); ?> !important;<?php } ?>
		<?php
		if ( isset( $wp_timeline_readmore_button_borderright ) ) {
			?>
			border-right:<?php echo esc_attr( $wp_timeline_readmore_button_borderright ) . 'px'; ?> <?php echo esc_attr( $read_more_button_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_borderrightcolor ); ?> !important;<?php } ?>
		<?php
		if ( isset( $wp_timeline_readmore_button_bordertop ) ) {
			?>
			border-top:<?php echo esc_attr( $wp_timeline_readmore_button_bordertop ) . 'px'; ?> <?php echo esc_attr( $read_more_button_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_bordertopcolor ); ?> !important;<?php } ?>
		<?php
		if ( isset( $wp_timeline_readmore_button_borderbottom ) ) {
			?>
			border-bottom:<?php echo esc_attr( $wp_timeline_readmore_button_borderbottom ) . 'px'; ?> <?php echo esc_attr( $read_more_button_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_borderbottomcolor ); ?> !important;
		<?php } ?>
		padding-top: <?php echo esc_attr( $readmore_button_paddingtop ) . 'px'; ?>;
		padding-bottom: <?php echo esc_attr( $readmore_button_paddingbottom ) . 'px'; ?>;
		padding-right: <?php echo esc_attr( $readmore_button_paddingright ) . 'px'; ?>;
		padding-left: <?php echo esc_attr( $readmore_button_paddingleft ) . 'px'; ?>;
		<?php
		if ( isset( $readmore_button_border_radius ) ) {
			?>
			border-radius: <?php echo esc_attr( $readmore_button_border_radius ) . 'px'; ?> !important;
		<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl-read-more-div a.wtl-read-more:hover{
		<?php
		if ( isset( $wp_timeline_readmore_button_hover_borderleft ) ) {
			?>
			border-left:<?php echo esc_attr( $wp_timeline_readmore_button_hover_borderleft ) . 'px'; ?> <?php echo esc_attr( $read_more_button_hover_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_hover_borderleftcolor ); ?> !important;<?php } ?>
		<?php
		if ( isset( $wp_timeline_readmore_button_hover_borderright ) ) {
			?>
			border-right:<?php echo esc_attr( $wp_timeline_readmore_button_hover_borderright ) . 'px'; ?> <?php echo esc_attr( $read_more_button_hover_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_hover_borderrightcolor ); ?> !important;<?php } ?>
		<?php
		if ( isset( $wp_timeline_readmore_button_hover_bordertop ) ) {
			?>
			border-top:<?php echo esc_attr( $wp_timeline_readmore_button_hover_bordertop ) . 'px'; ?> <?php echo esc_attr( $read_more_button_hover_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_hover_bordertopcolor ); ?> !important;
		<?php } ?>
		<?php
		if ( isset( $wp_timeline_readmore_button_hover_borderbottom ) ) {
			?>
			border-bottom:<?php echo esc_attr( $wp_timeline_readmore_button_hover_borderbottom ) . 'px'; ?> <?php echo esc_attr( $read_more_button_hover_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_hover_borderbottomcolor ); ?> !important;<?php } ?>
		<?php
		if ( isset( $readmore_button_hover_border_radius ) ) {
			?>
			border-radius: <?php echo esc_attr( $readmore_button_hover_border_radius ) . 'px'; ?> !important;<?php } ?>
	}
	<?php if ( isset( $read_more_on ) && 2 == $read_more_on ) {  ?>
		<?php echo esc_attr( $layout_id ); ?> .horizontal a.wtl-read-more:hover {
			background:<?php echo esc_attr( $template_readmore_hover_backcolor ); ?>;
		}
	<?php } ?>
	<?php echo esc_attr( $layout_id ); ?> #content .logbook .lb-node-desc > span:after {
		border-color: #dd5555 transparent transparent;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template.horizontal .wtl-post_content,
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template.horizontal .wtl-post_content p{
		font-size: <?php echo esc_attr( $content_fontsize ) . 'px;'; ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .horizontal .label_featured_post span {
		background: <?php echo esc_attr( $template_readmorebackcolor ); ?>;
		color:<?php echo esc_attr( $template_readmorecolor ); ?>;
		border-color: <?php echo esc_attr( $template_readmorecolor ); ?>;
		font-size: <?php echo esc_attr( $content_fontsize ) . 'px;'; ?>;
		<?php
		if ( isset( $content_font_family ) && '' != $content_font_family ) { 
			?>
			font-family: <?php echo esc_attr( $content_font_family ); ?>;  <?php } ?>
		<?php
		if ( isset( $content_font_weight ) && $content_font_weight ) {
			?>
			font-weight: <?php echo esc_attr( $content_font_weight ); ?>;<?php } ?>
		<?php
		if ( isset( $content_font_line_height ) && $content_font_line_height ) {
			?>
			line-height: <?php echo esc_attr( $content_font_line_height ); ?>;<?php } ?>
		<?php
		if ( isset( $content_font_italic ) && 1 == $content_font_italic ) { 
			?>
			font-style: <?php echo 'italic'; ?>;<?php } ?>
		<?php
		if ( isset( $content_font_text_transform ) && $content_font_text_transform ) {
			?>
			text-transform: <?php echo esc_attr( $content_font_text_transform ); ?>;<?php } ?>
		<?php
		if ( isset( $content_font_text_decoration ) && $content_font_text_decoration ) {
			?>
			text-decoration: <?php echo esc_attr( $content_font_text_decoration ); ?>;<?php } ?>
		<?php
		if ( isset( $content_font_letter_spacing ) && $content_font_letter_spacing ) {
			?>
			letter-spacing: <?php echo esc_attr( $content_font_letter_spacing ) . 'px'; ?>;<?php } ?>
	}

	<?php echo esc_attr( $layout_id ); ?> .horizontal a,
	<?php echo esc_attr( $layout_id ); ?> .horizontal .wtl-post-title .mdate a,
	<?php echo esc_attr( $layout_id ); ?> .horizontal .wtl-post-tags a,
	<?php echo esc_attr( $layout_id ); ?> .horizontal .categories a,
	<?php echo esc_attr( $layout_id ); ?> .horizontal .mdate i,
	<?php echo esc_attr( $layout_id ); ?> .wtl-author i{
		color: <?php echo esc_attr( $template_ftcolor ); ?> !important;
	}	
	<?php echo esc_attr( $layout_id ); ?> .horizontal a:hover,
	<?php echo esc_attr( $layout_id ); ?> .horizontal .wtl-post-title .mdate a:hover,
	<?php echo esc_attr( $layout_id ); ?> .horizontal .wtl-post-tags a:hover,
	<?php echo esc_attr( $layout_id ); ?> .horizontal .categories a:hover {
		color: <?php echo esc_attr( $template_fthovercolor ); ?> !important;
	}

	/* Content Box */
	<?php echo esc_attr( $layout_id ); ?> .logbook .lb-item{
		<?php
		echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
		?>
		overflow: hidden;
	}
	<?php
}
/*------------------ Template: Overlay Layout --------------- */
if ( 'overlay_horizontal' === $wp_timeline_theme ) {
	?>
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper{
		<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) . ' !important;' : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .overlay_horizontal .post-content-area .wtl-post-title{
		padding: 0 2px;
		<?php
		if ( isset( $template_title_font_weight ) && $template_title_font_weight ) {
			?>
			font-weight: <?php echo esc_attr( $template_title_font_weight ); ?>;<?php } ?>
		<?php
		if ( isset( $template_title_font_line_height ) && $template_title_font_line_height ) {
			?>
			line-height: <?php echo esc_attr( $template_title_font_line_height ); ?>;<?php } ?>
		<?php
		if ( isset( $template_title_font_italic ) && 1 == $template_title_font_italic ) { 
			?>
			font-style: <?php echo 'italic'; ?>;<?php } ?>
		<?php
		if ( isset( $template_title_font_text_transform ) && $template_title_font_text_transform ) {
			?>
			text-transform: <?php echo esc_attr( $template_title_font_text_transform ); ?>;<?php } ?>
		<?php
		if ( isset( $template_title_font_text_decoration ) && $template_title_font_text_decoration ) {
			?>
			text-decoration: <?php echo esc_attr( $template_title_font_text_decoration ); ?>;<?php } ?>
		<?php
		if ( isset( $template_title_font_letter_spacing ) && $template_title_font_letter_spacing ) {
			?>
			letter-spacing: <?php echo esc_attr( $template_title_font_letter_spacing ) . 'px'; ?>;<?php } ?>
			color: <?php echo esc_attr( $template_titlecolor ); ?>;
			font-size: <?php echo esc_attr( $template_titlefontsize ) . 'px'; ?>;
		<?php
		if ( isset( $template_titlefontface ) && $template_titlefontface ) {
			?>
			font-family: <?php echo esc_attr( $template_titlefontface ); ?>;<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .overlay_horizontal .wtl-post-title a {
		color: <?php echo esc_attr( $template_titlecolor ); ?>;
		font-size: <?php echo esc_attr( $template_titlefontsize ) . 'px'; ?>;
		<?php
		if ( isset( $template_titlefontface ) && $template_titlefontface ) {
			?>
			font-family: <?php echo esc_attr( $template_titlefontface ); ?>;<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .overlay_horizontal .wtl-post-title a:hover {
		color: <?php echo esc_attr( $template_titlehovercolor ); ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .post-content-area .wtl-post-content {
		color: <?php echo esc_attr( $template_contentcolor ); ?> !important;
		font-size: <?php echo esc_attr( $content_fontsize ) . 'px;'; ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .overlay_horizontal a.more-tag {
		color:<?php echo esc_attr( $template_readmorecolor ); ?>;
	}
	<?php if ( isset( $read_more_on ) && 2 == $read_more_on ) {  ?>
		<?php echo esc_attr( $layout_id ); ?> .overlay_horizontal a.more-tag:hover {
			background-color: <?php echo esc_attr( $template_readmore_hover_backcolor ); ?>;
			color:<?php echo esc_attr( $template_readmorehovercolor ); ?>;
		}
	<?php } ?>
	<?php echo esc_attr( $layout_id ); ?> .overlay_horizontal a,
	<?php echo esc_attr( $layout_id ); ?> .overlay_horizontal .wtl-post-title .mdate a,
	<?php echo esc_attr( $layout_id ); ?> .overlay_horizontal .blog_footer .tags a,
	<?php echo esc_attr( $layout_id ); ?> .overlay_horizontal .blog_footer .categories a,
	<?php echo esc_attr( $layout_id ); ?> .overlay_horizontal .mdate i,
	<?php echo esc_attr( $layout_id ); ?> .wtl-author i{
		color: <?php echo esc_attr( $template_ftcolor ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .overlay_horizontal .post-content-area .blog_footer .categories,
	<?php echo esc_attr( $layout_id ); ?> .overlay_horizontal .post-content-area .blog_footer .tags {
		color: <?php echo esc_attr( $template_contentcolor ); ?>;
		font-size: <?php echo esc_attr( $content_fontsize ) . 'px;'; ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .overlay_horizontal a:hover,
	<?php echo esc_attr( $layout_id ); ?> .overlay_horizontal .wtl-post-title .mdate a:hover,
	<?php echo esc_attr( $layout_id ); ?> .overlay_horizontal .blog_footer .tags a:hover,
	<?php echo esc_attr( $layout_id ); ?> .overlay_horizontal .blog_footer .categories a:hover {
		color: <?php echo esc_attr( $template_fthovercolor ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .logbook.flatLine a.lb-line-node.active, #content .logbook.flatLine a.lb-line-node.active{
		color: <?php echo esc_attr( $template_color ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .logbook.flatLine .lb-item.lb-node-hover:after, #content .logbook.flatLine .lb-item.lb-node-hover:after{
		border-color: <?php echo esc_attr( $template_color ); ?> rgba(0, 0, 0, 0) rgba(0, 0, 0, 0);
	}
	<?php echo esc_attr( $layout_id ); ?> .logbook.flatLine a.lb-line-node.active:after, #content .logbook.flatLine a.lb-line-node.active:after{
		border-color: <?php echo esc_attr( $template_color ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .logbook.flatLine .lb-node-desc span, #content .logbook.flatLine .lb-node-desc span,
	<?php echo esc_attr( $layout_id ); ?> .logbook.flatLine .lb-item.lb-node-hover:before, #content .logbook.flatLine .lb-item.lb-node-hover:before,
	<?php echo esc_attr( $layout_id ); ?> .logbook.flatLine a.lb-line-node:after, #content .logbook.flatLine a.lb-line-node:after{
		background: <?php echo esc_attr( $template_color ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .overlay_horizontal .post_content_wrap .label_featured_post {
		background: <?php echo esc_attr( $template_color ); ?>;
		color: <?php echo esc_attr( $template_contentcolor ); ?>;
		font-size: <?php echo esc_attr( $content_fontsize ) . 'px;'; ?>;
		<?php
		if ( isset( $content_font_family ) && '' != $content_font_family ) { 
			?>
			font-family: <?php echo esc_attr( $content_font_family ); ?>;  <?php } ?>
		<?php
		if ( isset( $content_font_weight ) && $content_font_weight ) {
			?>
			font-weight: <?php echo esc_attr( $content_font_weight ); ?>;<?php } ?>
		<?php
		if ( isset( $content_font_line_height ) && $content_font_line_height ) {
			?>
			line-height: <?php echo esc_attr( $content_font_line_height ); ?>;<?php } ?>
		<?php
		if ( isset( $content_font_italic ) && 1 == $content_font_italic ) { 
			?>
			font-style: <?php echo 'italic'; ?>;<?php } ?>
		<?php
		if ( isset( $content_font_text_transform ) && $content_font_text_transform ) {
			?>
			text-transform: <?php echo esc_attr( $content_font_text_transform ); ?>;<?php } ?>
		<?php
		if ( isset( $content_font_text_decoration ) && $content_font_text_decoration ) {
			?>
			text-decoration: <?php echo esc_attr( $content_font_text_decoration ); ?>;<?php } ?>
		<?php
		if ( isset( $content_font_letter_spacing ) && $content_font_letter_spacing ) {
			?>
			letter-spacing: <?php echo esc_attr( $content_font_letter_spacing ) . 'px'; ?>;<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .overlay_horizontal .wtl-read-more-div a.more-tag{
		<?php
		if ( isset( $wp_timeline_readmore_button_borderleft ) ) {
			?>
			border-left:<?php echo esc_attr( $wp_timeline_readmore_button_borderleft ) . 'px'; ?> <?php echo esc_attr( $read_more_button_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_borderleftcolor ); ?> !important;<?php } ?>
		<?php
		if ( isset( $wp_timeline_readmore_button_borderright ) ) {
			?>
			border-right:<?php echo esc_attr( $wp_timeline_readmore_button_borderright ) . 'px'; ?> <?php echo esc_attr( $read_more_button_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_borderrightcolor ); ?> !important;<?php } ?>
		<?php
		if ( isset( $wp_timeline_readmore_button_bordertop ) ) {
			?>
			border-top:<?php echo esc_attr( $wp_timeline_readmore_button_bordertop ) . 'px'; ?> <?php echo esc_attr( $read_more_button_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_bordertopcolor ); ?> !important;<?php } ?>
		<?php
		if ( isset( $wp_timeline_readmore_button_borderbottom ) ) {
			?>
			border-bottom:<?php echo esc_attr( $wp_timeline_readmore_button_borderbottom ) . 'px'; ?> <?php echo esc_attr( $read_more_button_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_borderbottomcolor ); ?> !important;
		<?php } ?>
			padding-top: <?php echo esc_attr( $readmore_button_paddingtop ) . 'px'; ?>;
			padding-bottom: <?php echo esc_attr( $readmore_button_paddingbottom ) . 'px'; ?>;
			padding-right: <?php echo esc_attr( $readmore_button_paddingright ) . 'px'; ?>;
			padding-left: <?php echo esc_attr( $readmore_button_paddingleft ) . 'px'; ?>;
		<?php
		if ( isset( $readmore_button_border_radius ) ) {
			?>
			border-radius: <?php echo esc_attr( $readmore_button_border_radius ) . 'px'; ?> !important;<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl-read-more-div a.more-tag:hover{
		<?php
		if ( isset( $wp_timeline_readmore_button_hover_borderleft ) ) {
			?>
			border-left:<?php echo esc_attr( $wp_timeline_readmore_button_hover_borderleft ) . 'px'; ?> <?php echo esc_attr( $read_more_button_hover_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_hover_borderleftcolor ); ?> !important;<?php } ?>
		<?php
		if ( isset( $wp_timeline_readmore_button_hover_borderright ) ) {
			?>
			border-right:<?php echo esc_attr( $wp_timeline_readmore_button_hover_borderright ) . 'px'; ?> <?php echo esc_attr( $read_more_button_hover_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_hover_borderrightcolor ); ?> !important;<?php } ?>
		<?php
		if ( isset( $wp_timeline_readmore_button_hover_bordertop ) ) {
			?>
			border-top:<?php echo esc_attr( $wp_timeline_readmore_button_hover_bordertop ) . 'px'; ?> <?php echo esc_attr( $read_more_button_hover_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_hover_bordertopcolor ); ?> !important;<?php } ?>
		<?php
		if ( isset( $wp_timeline_readmore_button_hover_borderbottom ) ) {
			?>
			border-bottom:<?php echo esc_attr( $wp_timeline_readmore_button_hover_borderbottom ) . 'px'; ?> <?php echo esc_attr( $read_more_button_hover_border_style ); ?> <?php echo esc_attr( $wp_timeline_readmore_button_hover_borderbottomcolor ); ?> !important;<?php } ?>
		<?php
		if ( isset( $readmore_button_hover_border_radius ) ) {
			?>
			border-radius: <?php echo esc_attr( $readmore_button_hover_border_radius ) . 'px'; ?> !important;<?php } ?>
	}
	/* Content Box */
	<?php echo esc_attr( $layout_id ); ?> .logbook .lb-item{
		<?php
		echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
		?>
		overflow: hidden;
	}
	<?php
	echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
}
/*------------------ Template: Sportking Layout --------------- */
if ( 'sportking_layout' === $wp_timeline_theme ) {

?>
	<?php if ( ! empty( $template_bgcolor1 ) && empty( $template_bgcolor2 ) && empty( $template_bgcolor3 ) && empty( $template_bgcolor4 ) && empty( $template_bgcolor5 ) && empty( $template_bgcolor6 ) ) { ?>
		<?php echo esc_attr( $layout_id ); ?>.sportking_layout .wtl_al_slider .wtl-schedule-post-content{
			<?php echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) ); ?>
		}
	<?php }
}
/*------------------ Template: Soft Layout --------------- */
if ( 'soft_block' === $wp_timeline_theme ) {
	?>
	<?php if ( ! empty( $template_bgcolor1 ) && empty( $template_bgcolor2 ) && empty( $template_bgcolor3 ) && empty( $template_bgcolor4 ) && empty( $template_bgcolor5 ) && empty( $template_bgcolor6 ) ) { ?>
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper{
			background: <?php echo esc_attr( $template_bgcolor1 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper .meeting-day .day-inner{
			color: <?php echo esc_attr( $template_bgcolor1 ); ?>;
		}
	<?php } ?>
	<?php if ( empty( $template_bgcolor1 ) && ! empty( $template_bgcolor2 ) && empty( $template_bgcolor3 ) && empty( $template_bgcolor4 ) && empty( $template_bgcolor5 ) && empty( $template_bgcolor6 ) ) { ?>
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper{
			background: <?php echo esc_attr( $template_bgcolor2 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper .meeting-day .day-inner{
			color: <?php echo esc_attr( $template_bgcolor2 ); ?>;
		}
	<?php } ?>
	<?php if ( empty( $template_bgcolor1 ) && empty( $template_bgcolor2 ) && ! empty( $template_bgcolor3 ) && empty( $template_bgcolor4 ) && empty( $template_bgcolor5 ) && empty( $template_bgcolor6 ) ) { ?>
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper{
			background: <?php echo esc_attr( $template_bgcolor3 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper .meeting-day .day-inner{
			color: <?php echo esc_attr( $template_bgcolor3 ); ?>;
		}
	<?php } ?>
	<?php if ( empty( $template_bgcolor1 ) && empty( $template_bgcolor2 ) && empty( $template_bgcolor3 ) && ! empty( $template_bgcolor4 ) && empty( $template_bgcolor5 ) && empty( $template_bgcolor6 ) ) { ?>
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper{
			background: <?php echo esc_attr( $template_bgcolor4 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper .meeting-day .day-inner{
			color: <?php echo esc_attr( $template_bgcolor4 ); ?>;
		}
	<?php } ?>
	<?php if ( empty( $template_bgcolor1 ) && empty( $template_bgcolor2 ) && empty( $template_bgcolor3 ) && empty( $template_bgcolor4 ) && ! empty( $template_bgcolor5 ) && empty( $template_bgcolor6 ) ) { ?>
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper{
			background: <?php echo esc_attr( $template_bgcolor5 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper .meeting-day .day-inner{
			color: <?php echo esc_attr( $template_bgcolor5 ); ?>;
		}
	<?php } ?>
	<?php if ( empty( $template_bgcolor1 ) && empty( $template_bgcolor2 ) && empty( $template_bgcolor3 ) && empty( $template_bgcolor4 ) && empty( $template_bgcolor5 ) && ! empty( $template_bgcolor6 ) ) { ?>
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper{
			background: <?php echo esc_attr( $template_bgcolor6 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper .meeting-day .day-inner{
			color: <?php echo esc_attr( $template_bgcolor6 ); ?>;
		}
	<?php } ?>
	<?php if ( ! empty( $template_bgcolor1 ) && ! empty( $template_bgcolor2 ) && empty( $template_bgcolor3 ) && empty( $template_bgcolor4 ) && empty( $template_bgcolor5 ) && empty( $template_bgcolor6 ) ) { ?>
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(2n+1){
			background: <?php echo esc_attr( $template_bgcolor1 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(2n+2){
			background: <?php echo esc_attr( $template_bgcolor2 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(2n+1) .meeting-day .day-inner{
			color: <?php echo esc_attr( $template_bgcolor1 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(2n+2) .meeting-day .day-inner{
			color: <?php echo esc_attr( $template_bgcolor2 ); ?>;
		}
	<?php } ?>
	<?php if ( ! empty( $template_bgcolor1 ) && ! empty( $template_bgcolor2 ) && ! empty( $template_bgcolor3 ) && empty( $template_bgcolor4 ) && empty( $template_bgcolor5 ) && empty( $template_bgcolor6 ) ) { ?>
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(3n+1){
			background: <?php echo esc_attr( $template_bgcolor1 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(3n+2){
			background: <?php echo esc_attr( $template_bgcolor2 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(3n+3){
			background: <?php echo esc_attr( $template_bgcolor3 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(3n+1) .meeting-day .day-inner{
			color: <?php echo esc_attr( $template_bgcolor1 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(3n+2) .meeting-day .day-inner{
			color: <?php echo esc_attr( $template_bgcolor2 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(3n+3) .meeting-day .day-inner{
			color: <?php echo esc_attr( $template_bgcolor3 ); ?>;
		}
	<?php } ?>
	<?php if ( ! empty( $template_bgcolor1 ) && ! empty( $template_bgcolor2 ) && ! empty( $template_bgcolor3 ) && ! empty( $template_bgcolor4 ) && empty( $template_bgcolor5 ) && empty( $template_bgcolor6 ) ) { ?>
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(4n+1){
			background: <?php echo esc_attr( $template_bgcolor1 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(4n+2){
			background: <?php echo esc_attr( $template_bgcolor2 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(4n+3){
			background: <?php echo esc_attr( $template_bgcolor3 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(4n+4){
			background: <?php echo esc_attr( $template_bgcolor4 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(4n+1) .meeting-day .day-inner{
			color: <?php echo esc_attr( $template_bgcolor1 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(4n+2) .meeting-day .day-inner{
			color: <?php echo esc_attr( $template_bgcolor2 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(4n+3) .meeting-day .day-inner{
			color: <?php esc_attr( $template_bgcolor3 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(4n+4) .meeting-day .day-inner{
			color: <?php echo esc_attr( $template_bgcolor4 ); ?>;
		}
	<?php } ?>
	<?php if ( ! empty( $template_bgcolor1 ) && ! empty( $template_bgcolor2 ) && ! empty( $template_bgcolor3 ) && ! empty( $template_bgcolor4 ) && ! empty( $template_bgcolor5 ) && empty( $template_bgcolor6 ) ) { ?>
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(5n+1){
			background: <?php echo esc_attr( $template_bgcolor1 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(5n+2){
			background: <?php echo esc_attr( $template_bgcolor2 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(5n+3){
			background: <?php echo esc_attr( $template_bgcolor3 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(5n+4){
			background: <?php echo esc_attr( $template_bgcolor4 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(5n+5){
			background: <?php echo esc_attr( $template_bgcolor5 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(5n+1) .meeting-day .day-inner{
			color: <?php echo esc_attr( $template_bgcolor1 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(5n+2) .meeting-day .day-inner{
			color: <?php echo esc_attr( $template_bgcolor2 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(5n+3) .meeting-day .day-inner{
			color: <?php echo esc_attr( $template_bgcolor3 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(5n+4) .meeting-day .day-inner{
			color: <?php echo esc_attr( $template_bgcolor4 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(5n+5) .meeting-day .day-inner{
			color: <?php echo esc_attr( $template_bgcolor5 ); ?>;
		}
	<?php } ?>
	<?php
	if ( ! empty( $template_bgcolor1 ) && ! empty( $template_bgcolor2 ) && ! empty( $template_bgcolor3 ) && ! empty( $template_bgcolor4 ) && ! empty( $template_bgcolor5 ) && ! empty( $template_bgcolor6 ) ) {
		?>
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(6n+1){
			background: <?php echo esc_attr( $template_bgcolor1 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(6n+2){
			background: <?php echo esc_attr( $template_bgcolor2 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(6n+3){
			background: <?php echo esc_attr( $template_bgcolor3 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(6n+4){
			background: <?php echo esc_attr( $template_bgcolor4 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(6n+5){
			background: <?php echo esc_attr( $template_bgcolor5 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(6n+6){
			background: <?php echo esc_attr( $template_bgcolor6 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(6n+1) .meeting-day .day-inner{
			color: <?php echo esc_attr( $template_bgcolor1 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(6n+2) .meeting-day .day-inner{
			color: <?php echo esc_attr( $template_bgcolor2 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(6n+3) .meeting-day .day-inner{
			color: <?php echo esc_attr( $template_bgcolor3 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(6n+4) .meeting-day .day-inner{
			color: <?php echo esc_attr( $template_bgcolor4 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(6n+5) .meeting-day .day-inner{
			color: <?php echo esc_attr( $template_bgcolor5 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.soft_block_cover .soft-block-post-wrapper:nth-of-type(6n+6) .meeting-day .day-inner{
			color: <?php echo esc_attr( $template_bgcolor6 ); ?>;
		}
	<?php } ?>
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .meeting-day .day-inner,
	<?php echo esc_attr( $layout_id ); ?> .soft-block-post-wrapper .soft_block_wrapper:before {
		background: <?php echo esc_attr( $template_contentcolor ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .post_content{  color: <?php echo esc_attr( $template_contentcolor ); ?>; }
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .tags,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .tags a,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .wtl-post-meta a,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .category-link,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .category-link a,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .tags a,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .wtl-has-links a,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .post-author a,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .date-meta a,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .footer_meta a,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .footer_meta .seperater,
	<?php echo esc_attr( $layout_id ); ?>.soft_block_cover .wtl-post-meta .comments-link{
		color: <?php echo esc_attr( $template_ftcolor ); ?>;
		font-size: <?php echo esc_attr( $content_fontsize ) . 'px'; ?>;
		<?php
		if ( isset( $content_font_family ) && '' != $content_font_family ) { 
			?>
			font-family: <?php echo esc_attr( $content_font_family ); ?>; <?php } ?>
		<?php
		if ( isset( $content_font_weight ) && $content_font_weight ) {
			?>
			font-weight: <?php echo esc_attr( $content_font_weight ); ?>;<?php } ?>
		<?php
		if ( isset( $content_font_line_height ) && $content_font_line_height ) {
			?>
			line-height: <?php echo esc_attr( $content_font_line_height ); ?>;<?php } ?>
		<?php
		if ( isset( $content_font_letter_spacing ) && $content_font_letter_spacing ) {
			?>
			letter-spacing: <?php echo esc_attr( $content_font_letter_spacing ) . 'px'; ?>;<?php } ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .wtl-post-meta span i,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .link-lable,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .wtl-wrapper-like a i {
		color: <?php echo esc_attr( $template_contentcolor ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .wtl-post-title{
		background: <?php echo esc_attr( $template_titlebackcolor ); ?>;
	}

	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .wtl-post-meta a,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .category-link a,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .category-link i,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .wtl-post-category,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .wtl-post-category span,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .wtl-post-category a,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .wtl-post-category i,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .tags span,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .tags a,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .tags i,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .wtl-has-links a,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .post-author a,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .wtl-author a,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .wtl-author i,	
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .wtl-date-meta a,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .wtl-date-meta i,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .wtl-comment i
	{
		<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ' !important' : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .wtl-post-meta a:hover,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .category-link a:hover,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .category-link i:hover,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .wtl-post-category:hover,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .wtl-post-category span:hover,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .wtl-post-category a:hover,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .wtl-post-category i:hover,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .tags span:hover,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .tags a:hover,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .tags i:hover,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .wtl-has-links a:hover,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .post-author a:hover,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .wtl-author a:hover,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .wtl-author i:hover,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .wtl-date-meta a:hover,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .wtl-date-meta i:hover,
	<?php echo esc_attr( $layout_id ); ?> .soft_block_wrapper .wtl-comment i:hover{
		color: <?php echo esc_attr( $template_fthovercolor ); ?> !important;
	}
	<?php
	echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_date_typography( $wtl_settings, $layout_id ) );
}
/*------------------ Template: Schedule  Layout --------------- */
if ( 'schedule' === $wp_timeline_theme ) {
	echo esc_attr( $layout_id );
	?>
	.wtl_wrapper{
		<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) . ';' : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?>  .blog_template.schedule .tags a:after {
		<?php echo isset( $wtl_settings['template_color'] ) ? 'border-color: transparent ' . esc_attr( $wtl_settings['template_color'] ) . '  transparent transparent !important;' : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .blog_template.schedule .tags a,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-schedule-circle:after{
		<?php echo isset( $wtl_settings['template_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;' : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?>  .wtl-schedule-post-content:after{
		<?php echo isset( $wtl_settings['template_color'] ) ? 'border-color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;' : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?>.schedule_cover .schedule-content-wrap:after{
		border-color: <?php echo esc_attr( $template_color ); ?>;
	}
	<?php
	if ( isset( $read_more_on ) && 2 == $read_more_on ) { 
		echo esc_attr( $layout_id );
		?>
		.wtl_blog_template.schedule a.more-tag:focus,
		<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template.schedule a.more-tag:hover {
			background: <?php echo esc_attr( $template_readmore_hover_backcolor ); ?>;
		}
	<?php } ?>
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template.schedule a.more-tag{
		color: <?php echo esc_attr( $template_readmorecolor ); ?>;
		<?php
		if ( isset( $read_more_on ) && 2 == $read_more_on ) { 
			?>
			background: <?php echo esc_attr( $template_readmorebackcolor ); ?>;
		<?php } ?>
		<?php
		if ( isset( $content_font_family ) && '' != $content_font_family ) { 
			?>
			font-family: <?php echo esc_attr( $content_font_family ); ?>;
		<?php } ?>
	}
	@media screen and (max-width: 480px) {
		<?php echo esc_attr( $layout_id ); ?>.schedule_cover .wtl-post-meta {
			box-shadow: 0px 0px 5px <?php echo esc_attr( $template_color ); ?>;
		}
	}
	/* meta */
	<?php echo esc_attr( $layout_id ); ?>.schedule_cover .meta-archive a,
	<?php echo esc_attr( $layout_id ); ?>.schedule_cover .schedule-circle:after {
		background: <?php echo esc_attr( $template_color ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .schedule_wrapper .post-meta a:hover,
	<?php echo esc_attr( $layout_id ); ?> .schedule_wrapper .wtl-post-category a:hover,
	<?php echo esc_attr( $layout_id ); ?> .schedule_wrapper .tags a:hover,
	<?php echo esc_attr( $layout_id ); ?> .schedule_wrapper .wtl-has-links a:hover,
	<?php echo esc_attr( $layout_id ); ?> .schedule_wrapper .post-author a:hover,
	<?php echo esc_attr( $layout_id ); ?> .schedule_wrapper .date-meta a:hover,
	<?php echo esc_attr( $layout_id ); ?> .author-name a:hover,
	<?php echo esc_attr( $layout_id ); ?> .metacomments a.comments-link:hover{
		color: <?php echo esc_attr( $template_fthovercolor ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .schedule_wrapper .wtl-read-more .more-tag:hover,
	<?php echo esc_attr( $layout_id ); ?> .schedule_wrapper .wtl-post-title a:hover {
		color:<?php echo esc_attr( $template_titlehovercolor ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .schedule_wrapper .tags a {
		color: #fff;
	}
	<?php echo esc_attr( $layout_id ); ?>  .meta-comment span,
	<?php echo esc_attr( $layout_id ); ?>  .meta-comment span a,
	<?php echo esc_attr( $layout_id ); ?>  .meta-comment span i,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-author-name a,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-author-name {
		color: <?php echo esc_attr( $template_ftcolor ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-button{
		background: <?php echo esc_attr( $template_ftcolor ); ?> !important;    
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-button:hover{
		background: <?php echo esc_attr( $template_fthovercolor ); ?> !important;
	}
	<?php echo esc_attr( $layout_id ); ?>  .label_featured_post span,
	<?php echo esc_attr( $layout_id ); ?>  .meta-archive a,
	<?php echo esc_attr( $layout_id ); ?>  .meta-archive,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-author-name a,
	<?php echo esc_attr( $layout_id ); ?>  .meta-comment a,
	<?php echo esc_attr( $layout_id ); ?>  .post-meta,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-author,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-author-name,
	<?php echo esc_attr( $layout_id ); ?>  .meta-comment,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-wrapper-like .wtl-count,
	<?php echo esc_attr( $layout_id ); ?>  .schedule-time,
	<?php echo esc_attr( $layout_id ); ?>  .schedule-time a,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-post-category,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-post-category a,
	<?php echo esc_attr( $layout_id ); ?> .author-name a{
		font-size: <?php echo esc_attr( $content_fontsize ) . 'px'; ?>;
		<?php
		if ( isset( $content_font_family ) && '' != $content_font_family ) { 
			?>
			font-family: <?php echo esc_attr( $content_font_family ); ?>; <?php } ?>
		<?php
		if ( isset( $content_font_weight ) && $content_font_weight ) {
			?>
			font-weight: <?php echo esc_attr( $content_font_weight ); ?>;<?php } ?>
		<?php
		if ( isset( $content_font_line_height ) && $content_font_line_height ) {
			?>
			line-height: <?php echo esc_attr( $content_font_line_height ); ?>;<?php } ?>
		<?php
		if ( isset( $content_font_letter_spacing ) && $content_font_letter_spacing ) {
			?>
			letter-spacing: <?php echo esc_attr( $content_font_letter_spacing ) . 'px'; ?>;<?php } ?>
			<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-meta-comment i{
			<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?>  .label_featured_post span:hover,
		<?php echo esc_attr( $layout_id ); ?>  .meta-archive a:hover,
		<?php echo esc_attr( $layout_id ); ?>  .meta-archive:hover,
		<?php echo esc_attr( $layout_id ); ?>  .wtl-author-name a:hover,
		<?php echo esc_attr( $layout_id ); ?>  .meta-comment a:hover,
		<?php echo esc_attr( $layout_id ); ?>  .post-meta:hover,
		<?php echo esc_attr( $layout_id ); ?>  .wtl-author:hover,
		<?php echo esc_attr( $layout_id ); ?>  .wtl-author-name:hover,
		<?php echo esc_attr( $layout_id ); ?>  .meta-comment:hover,
		<?php echo esc_attr( $layout_id ); ?>  .wtl-wrapper-like .wtl-count:hover,
		<?php echo esc_attr( $layout_id ); ?>  .schedule-time:hover,
		<?php echo esc_attr( $layout_id ); ?>  .schedule-time a:hover,
		<?php echo esc_attr( $layout_id ); ?>  .wtl-post-category:hover,
		<?php echo esc_attr( $layout_id ); ?>  .wtl-post-category a:hover,
		<?php echo esc_attr( $layout_id ); ?> .wtl-meta-comment i:hover{
			<?php echo isset( $wtl_settings['template_fthovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_fthovercolor'] ) : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?>  .tags .link-lable,
		<?php echo esc_attr( $layout_id ); ?>  .tags a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a{
			<?php
			if ( isset( $content_font_family ) && '' != $content_font_family ) { 
				?>
				font-family: <?php echo esc_attr( $content_font_family ); ?>; <?php } ?>
			<?php
			if ( isset( $content_font_weight ) && $content_font_weight ) {
				?>
				font-weight: <?php echo esc_attr( $content_font_weight ); ?>;<?php } ?>
		}
	<?php
	echo esc_attr( Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_content_color( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
	?>
	<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content{
		<?php
		echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
		?>
	}
	<?php
	echo esc_attr( Wtl_Template_Config::post_date_typography( $wtl_settings, $layout_id ) );
}
if ( isset( $firstletter_big ) && 1 == $firstletter_big ) { 
	$first_letter_line_height = $firstletter_fontsize * 75 / 100;
	?>
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template div.post-content > *:first-child:first-letter,
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template div.post-content > p:first-child:first-letter,
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template div.post-content:first-letter,
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template div.post_content > *:first-child:first-letter,
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template div.post_content > p:first-child:first-letter,
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template div.post_content:first-letter ,
	<?php echo esc_attr( $layout_id ); ?> .wtl-first-letter,
	<?php echo esc_attr( $layout_id ); ?> .wp-timeline-first-letter {
		<?php
		if ( isset( $firstletter_font_family ) && $firstletter_font_family ) {
			?>
			font-family:<?php echo esc_attr( $firstletter_font_family ); ?>; <?php } ?>
		font-size:<?php echo esc_attr( $firstletter_fontsize ) . 'px'; ?>;
		color: <?php echo esc_attr( $firstletter_contentcolor ); ?>;
		margin-right:5px;
		line-height: <?php echo esc_attr( $first_letter_line_height ) . 'px'; ?>;
		display: inline-block;
		<?php
		if ( isset( $content_font_text_decoration ) && $content_font_text_decoration ) {
			?>
			text-decoration: <?php echo esc_attr( $content_font_text_decoration ); ?>;
		<?php } ?>
	}
	<?php
}
$filter_background_hover_color = isset( $wtl_settings['filter_background_hover_color'] ) ? $wtl_settings['filter_background_hover_color'] : '';
echo esc_attr( $layout_filter_id );
?>
.wp_timeline_filter_post_ul li a {
	padding: <?php echo esc_attr( $filter_paddingtop ) . 'px'; ?> <?php echo esc_attr( $filter_paddingright ) . 'px'; ?> <?php echo esc_attr( $filter_paddingbottom ) . 'px'; ?> <?php echo esc_attr( $filter_paddingleft ) . 'px'; ?>;
	margin: <?php echo esc_attr( $filter_margintop ) . 'px'; ?> <?php echo esc_attr( $filter_marginright ) . 'px'; ?> <?php echo esc_attr( $filter_marginbottom ) . 'px'; ?> <?php echo esc_attr( $filter_marginleft ) . 'px'; ?>;
	border-left: <?php echo esc_attr( $wp_timeline_filter_borderleft ) . 'px'; ?> <?php echo isset( $wtl_settings['wp_timeline_filter_borderleftstyle'] ) ? esc_attr( $wtl_settings['wp_timeline_filter_borderleftstyle'] ) : ''; ?> <?php echo isset( $wtl_settings['wp_timeline_filter_borderleftcolor'] ) ? esc_attr( $wtl_settings['wp_timeline_filter_borderleftcolor'] ) : ''; ?>;
	border-right: <?php echo esc_attr( $wp_timeline_filter_borderright ) . 'px'; ?> <?php echo isset( $wtl_settings['wp_timeline_filter_borderrightstyle'] ) ? esc_attr( $wp_timeline_filter_borderrightstyle ) : ''; ?> <?php echo isset( $wtl_settings['wp_timeline_filter_borderrightcolor'] ) ? esc_attr( $wp_timeline_filter_borderrightcolor ) : ''; ?>;
	border-top: <?php echo isset( $wtl_settings['wp_timeline_filter_bordertop'] ) ? esc_attr( $wp_timeline_filter_bordertop ) . 'px' : ''; ?> <?php echo isset( $wtl_settings['wp_timeline_filter_bordertopstyle'] ) ? esc_attr( $wp_timeline_filter_bordertopstyle ) : ''; ?> <?php echo esc_attr( $wp_timeline_filter_bordertopcolor ); ?>;
	border-bottom: <?php echo isset( $wtl_settings['wp_timeline_filter_borderbottom'] ) ? esc_attr( $wp_timeline_filter_borderbottom ) . 'px' : ''; ?> <?php echo esc_attr( $wp_timeline_filter_borderbottomstyle ); ?> <?php echo esc_attr( $wp_timeline_filter_borderbottomcolor ); ?>;
	color: <?php echo esc_attr( $filter_color ); ?> !important;
	background-color: <?php echo esc_attr( $filter_background_color ); ?> !important;
}
<?php echo esc_attr( $layout_filter_id ); ?> .wp_timeline_filter_post_ul li a.wp_timeline_post_selected,
<?php echo esc_attr( $layout_filter_id ); ?> .wp_timeline_filter_post_ul li a:hover {
	border-left: <?php echo esc_attr( $wp_timeline_filter_hover_borderleft ) . 'px'; ?> <?php echo esc_attr( $wp_timeline_filter_hover_borderleftstyle ); ?> <?php echo esc_attr( $wp_timeline_filter_hover_borderleftcolor ); ?>;
	border-right: <?php echo esc_attr( $wp_timeline_filter_hover_borderright ) . 'px'; ?> <?php echo esc_attr( $wp_timeline_filter_hover_borderrightstyle ); ?> <?php echo esc_attr( $wp_timeline_filter_hover_borderrightcolor ); ?>;
	border-top: <?php echo esc_attr( $wp_timeline_filter_hover_bordertop ) . 'px'; ?> <?php echo esc_attr( $wp_timeline_filter_hover_bordertopstyle ); ?> <?php echo esc_attr( $wp_timeline_filter_hover_bordertopcolor ); ?>;
	border-bottom: <?php echo esc_attr( $wp_timeline_filter_hover_borderbottom ) . 'px'; ?> <?php echo esc_attr( $wp_timeline_filter_hover_borderbottomstyle ); ?> <?php echo esc_attr( $wp_timeline_filter_hover_borderbottomcolor ); ?>;
	transition: border-color 0.6s ease;
	transition: background-color 0.6s ease;
	transition: color 0.6s ease;
}
<?php echo esc_attr( $layout_filter_id ); ?> .wp_timeline_filter_post_ul li a.wp_timeline_post_selected,
<?php echo esc_attr( $layout_filter_id ); ?> .wp_timeline_filter_post_ul li a:hover,
<?php echo esc_attr( $layout_filter_id ); ?> .wp_timeline_filter_post_ul li span {
	color: <?php echo esc_attr( $filter_hover_color ); ?> !important;
	background-color: <?php echo esc_attr( $filter_background_hover_color ); ?> !important;
}
<?php echo esc_attr( $layout_filter_id ); ?> .wp_timeline_filter_post_ul li span:before {
	border-top: 5px solid <?php echo esc_attr( $filter_background_hover_color ); ?> !important;
}
<?php
/* ------------------ Template: Hire Layout --------------- */
if ( 'hire_layout' === $wp_timeline_theme ) {
	$template_color                     = isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#fff';
	$template_content_box_bg_color = isset( $wtl_settings['template_content_box_bg_color'] ) ? $wtl_settings['template_content_box_bg_color'] : '#fff';
	/* background color */
	echo esc_attr( $layout_id );
	?>
	.wtl_wrapper{ <?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) . ';' : ''; ?> }
	?>
	/* Progress bar color */
	<?php echo esc_attr( $layout_id ); ?> .wtl-progress.wtl_blue  .wtl_fill,
	<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal  .wtl-progress .wtl_fill{
		<?php
		if ( $template_color ) {
			echo 'stroke:' . esc_attr( $template_color ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtlcircle i,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-date,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-date span,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a,
	<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtl_al_nav .wtl-ss-right,
	<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtl_al_nav .wtl-ss-left,
	<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtlcircle i,
	<?php echo esc_attr( $layout_id ); ?> .wtl_main_title h1,
	<?php echo esc_attr( $layout_id ); ?> .wtl_main_title h2{
		<?php
		if ( $template_color ) {
			echo 'color:' . esc_attr( $template_color ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-progress .wtl_time_value{
		<?php
		if ( $template_color ) {
			echo 'fill:' . esc_attr( $template_color );
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtl_progress-circle::before{
		<?php
		if ( isset( $wtl_settings['navigation_bg_color'] ) ) {
			echo 'border-left-color:' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ';';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtl_al_nav .wtl-slitem_nav::after{
		<?php
		if ( isset( $wtl_settings['navigation_bg_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ';';
		}
		?>
	}
	.wtl_is_horizontal .wtl-ss-right i, .wtl_is_horizontal .wtl-ss-left i {
		<?php
		if ( isset( $wtl_settings['navigation_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['navigation_color'] ) . ';';
		}
		if ( isset( $wtl_settings['navigation_arrow_size'] ) ) {
			echo 'font-size:' . esc_attr( $wtl_settings['navigation_arrow_size'] ) . 'px;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtl_progress-circle:after{
		<?php
		if ( isset( $wtl_settings['navigation_bg_color'] ) ) {
			echo 'border-color:' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ';';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-all-post-content{
		<?php
		if ( $template_content_box_bg_color ) {
			echo 'background:' . esc_attr( $template_content_box_bg_color ) . ';';
		}
		echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
		?>
	}
	<?php
	echo esc_attr( Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_content_color( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
	?>
	<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap:before{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a,
	<?php echo esc_attr( $layout_id ); ?> .author-name a{
		<?php
		if ( $template_ftcolor ) {
			echo 'color:' . esc_attr( $template_ftcolor ) . ';';
			echo 'border-color:' . esc_attr( $template_ftcolor );
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a:hover,
	<?php echo esc_attr( $layout_id ); ?> .author-name a:hover{
		<?php
		if ( $template_fthovercolor ) {
			echo 'color:' . esc_attr( $template_fthovercolor ) . ';';
			echo 'border-color:' . esc_attr( $template_fthovercolor );
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_progress-circle{
		<?php echo isset( $wtl_settings['pbar_bg_color'] ) ? 'background:' . esc_attr( $wtl_settings['pbar_bg_color'] ) . ' !important;' : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-progress .wtl_track{
		<?php echo isset( $wtl_settings['pbar_track_color'] ) ? 'stroke:' . esc_attr( $wtl_settings['pbar_track_color'] ) . ' !important;' : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_progress-circle:after{
		<?php echo isset( $wtl_settings['pbar_track_color'] ) ? 'color:' . esc_attr( $wtl_settings['pbar_track_color'] ) . ' !important;' : ''; ?>   
	}
	<?php
	echo esc_attr( Wtl_Template_Config::post_date_typography( $wtl_settings, $layout_id ) );

	$enable_media = isset( $wtl_settings['wp_timeline_enable_media'] ) ? $wtl_settings['wp_timeline_enable_media'] : '';
	if ( !$enable_media ) { ?>
		.wtl-schedule-post-content:nth-child(even) .wtl_progress-circle:after,
		.wtl-schedule-post-content:nth-child(odd) .wtl_progress-circle:after {
			display: none;
		}
	<?php }
}
/* ------------------ Template: Curve Layout --------------- */
if ( 'curve_layout' === $wp_timeline_theme ) {
	/* background color */
	?>
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper{
		<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) . ' !important;' : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-all-post-content, <?php echo esc_attr( $layout_id ); ?> .slick-track .wtl-schedule-post-content{
		<?php
		echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
		?>
	}
	<?php
	echo esc_attr( Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_content_color( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
	?>
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a,
	<?php echo esc_attr( $layout_id ); ?> .wtl-author a{
		<?php
		$template_ftcolor = isset( $wtl_settings['template_ftcolor'] ) ? esc_attr( $wtl_settings['template_ftcolor'] ) : '';
		if ( $template_ftcolor ) {
			echo 'color:' . esc_attr( $template_ftcolor ) . ' !important;';
			echo 'border-color:' . esc_attr( $template_ftcolor ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl-author a:hover{
		<?php
		$template_fthovercolor = isset( $wtl_settings['template_fthovercolor'] ) ? esc_attr( $wtl_settings['template_fthovercolor'] ) : '';
		if ( $template_fthovercolor ) {
			echo 'color:' . esc_attr( $template_fthovercolor ) . ' !important;';
			echo 'border-color:' . esc_attr( $template_fthovercolor ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .blog_template .social-component a{ color:#fff !important; }
	<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtl_al_nav .wtl-blog-img img,
	<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtl_al_nav .wtl-slitem_nav .wtl-blog-img::after,
	<?php echo esc_attr( $layout_id ); ?> .wtl-border-top,
	<?php echo esc_attr( $layout_id ); ?> .wtl-border-bottom{
		<?php echo isset( $wtl_settings['template_color'] ) ? 'border-color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;' : ''; ?>
	}

	<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtl-ss-right i,
	<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtl-ss-left i{
		<?php echo isset( $wtl_settings['navigation_color'] ) ? 'color:' . esc_attr( $wtl_settings['navigation_color'] ) . ';' : ''; ?>
		<?php echo isset( $wtl_settings['navigation_arrow_size'] ) ? 'font-size:' . esc_attr( $wtl_settings['navigation_arrow_size'] ) . 'px;' : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtl_al_nav .wtl-blog-img img{
		<?php echo isset( $wtl_settings['template_icon_border_radious'] ) ? 'border-radius:' . esc_attr( $wtl_settings['template_icon_border_radious'] ) . '% !important' : ''; ?>
	}
	/* odd  */
	<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtl_al_nav .wtl-slitem_nav:nth-child(odd) .wtl-blog-img:before,
	<?php echo esc_attr( $layout_id ); ?> .wtl-blog-curve-timeline li:nth-child(odd) .wtl-blog-number:before {
		<?php
		if ( isset( $wtl_settings['template_color2'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_color2'] ) . ' !important;';
		}
		if ( isset( $wtl_settings['template_color4'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['template_color4'] ) . ' !important;';
		}
		?>
	}
	/* even */
	<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtl_al_nav .wtl-slitem_nav:nth-child(even) .wtl-blog-img:before,
	<?php echo esc_attr( $layout_id ); ?> .wtl-blog-curve-timeline li:nth-child(even) .wtl-blog-number:before {
		<?php
		if ( isset( $wtl_settings['template_color3'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_color3'] ) . ' !important;';
		}
		if ( isset( $wtl_settings['template_color5'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['template_color5'] ) . ' !important;';
		}
		?>
	}
	<?php
}
/*------------------ Template: Advanced Layout --------------- */
if ( 'advanced_layout' === $wp_timeline_theme ) {
	$timeline_style_type = isset( $wtl_settings['timeline_style_type'] ) ? $wtl_settings['timeline_style_type'] : '';
	$timeline_style_view = isset( $wtl_settings['timeline_style_view'] ) ? $wtl_settings['timeline_style_view'] : '';
	?>
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper{
		<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) . ' !important;' : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_main_title h1,
	<?php echo esc_attr( $layout_id ); ?> .wtl_main_title h2{
		<?php echo isset( $wtl_settings['template_color'] ) ? 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;' : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-all-post-content{
		<?php
		echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) );
		?>
	}
	/* Title*/
	<?php echo esc_attr( $layout_id ); ?> h2.wtl-post-title{
		<?php echo esc_attr( Wtl_Template_Advanced_Layout::content_box_border_radious_title( $wtl_settings ) ); ?>
	}
	<?php
	echo esc_attr( Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_content_color( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
	?>
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-content,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-footer{
		<?php echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) ); ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-footer{
		padding-top: 0 !important;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-post-center-image span i {
		<?php
		if ( isset( $template_titlecolor ) && '' !== $template_titlecolor ) {
			?>
			color: <?php echo esc_attr( $template_titlecolor ); ?> !important;<?php } ?>
			font-size: 22px;
		}
		/* Template Color */
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap:after,
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap:before,
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl_year,
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl_year:before,
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl_year span
		<?php
		if ( 0 != $timeline_style_type ) { 
			?>
			,<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image
			<?php
		}
		?>
		{
			<?php echo isset( $wtl_settings['template_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtl-ss-right i, 
		<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtl-ss-left i {
			<?php echo isset( $wtl_settings['navigation_bg_color'] ) ? 'background:' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ';' : ''; ?>
			<?php echo isset( $wtl_settings['navigation_color'] ) ? 'color:' . esc_attr( $wtl_settings['navigation_color'] ) . ' !important;' : ''; ?>
			<?php echo isset( $wtl_settings['navigation_arrow_size'] ) ? 'font-size:' . esc_attr( $wtl_settings['navigation_arrow_size'] ) . 'px !important;' : ''; ?>
		}
		<?php
		if ( 0 == $timeline_style_type || 1 == $timeline_style_type || 4 == $timeline_style_type || 5 == $timeline_style_type ) { 
			?>
			<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl-post-content p { margin-bottom: 0; }
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image { height: auto; }
			<?php
		}
		if ( 0 == $timeline_style_type ) { 
			?>
			<?php echo esc_attr( $layout_id ); ?>.wp_timeline_post_list.wtll_style_type_0 .wtl-schedule-post-content .wtl-post-date span,<?php echo esc_attr( $layout_id ); ?>.wp_timeline_post_list.wtll_style_type_0 .wtl_single_post_wrapp .wtl-post-date span {
				<?php
				if ( isset( $template_titlecolor ) && '' !== $template_titlecolor ) {
					?>
					color: <?php echo esc_attr( $template_titlecolor ); ?> !important;
				<?php } ?>
			}
			<?php
		}
		if ( 4 == $timeline_style_type ) { 
			?>
			<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl-post-date:before, <?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl-post-date:after {content: '';position: absolute;width: 7%;height: 50%;}
			<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl-post-date:before { top: 0; }
			<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl-post-date:after { bottom: 0; }
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-date { <?php echo isset( $wtl_settings['template_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;' : ''; ?> padding: 5px 10px; }
			@media only screen and (max-width:767px) {
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl-post-date:before, <?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl-post-date:after { left: -7%; }
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl-post-date:before { background: linear-gradient(to bottom right, #fff 0%, #fff 48%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 50%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 100%); }
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl-post-date:after { background: linear-gradient(to top right, #fff 0%, #fff 48%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 50%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 100%); }
			}
			<?php if ( 'left' === $timeline_style_view ) { ?> 
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-title a ,<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-schedule-all-post-content { text-align: left; }
				@media only screen and (min-width:768px) {
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-date:before, <?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-date:after,<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-date:before, <?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-date:after { left: -7%; }
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-date:before,
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-date:before { background: linear-gradient(to bottom right, <?php echo isset( $wtl_settings['template_bgcolor'] ) ? esc_attr( $wtl_settings['template_bgcolor'] ) : '#000000'; ?> 0%, <?php echo isset( $wtl_settings['template_bgcolor'] ) ? esc_attr( $wtl_settings['template_bgcolor'] ) : '#000000'; ?> 48%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 50%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 100%); }
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-date:after,
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-date:after { background: linear-gradient(to top right, <?php echo isset( $wtl_settings['template_bgcolor'] ) ? esc_attr( $wtl_settings['template_bgcolor'] ) : '#000000'; ?> 0%, <?php echo isset( $wtl_settings['template_bgcolor'] ) ? esc_attr( $wtl_settings['template_bgcolor'] ) : '#000000'; ?> 48%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 50%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 100%); }
			}
			<?php } elseif ( 'right' === $timeline_style_view ) { ?>
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-title a ,<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-schedule-all-post-content { text-align: right; }
				@media only screen and (min-width:768px) {
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-date:before, <?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-date:after,<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-date:before, <?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-date:after { right: -7%; }
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-date:before,
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-date:before { background: linear-gradient(to bottom left, <?php echo isset( $wtl_settings['template_bgcolor'] ) ? esc_attr( $wtl_settings['template_bgcolor'] ) : '#000000'; ?> 0%, <?php echo isset( $wtl_settings['template_bgcolor'] ) ? esc_attr( $wtl_settings['template_bgcolor'] ) : '#000000'; ?> 48%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 50%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 100%);  }
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-date:after,
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-date:after { background: linear-gradient(to top left, <?php echo isset( $wtl_settings['template_bgcolor'] ) ? esc_attr( $wtl_settings['template_bgcolor'] ) : '#000000'; ?> 0%, <?php echo isset( $wtl_settings['template_bgcolor'] ) ? esc_attr( $wtl_settings['template_bgcolor'] ) : '#000000'; ?> 48%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 50%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 100%); }
			}
			<?php } else { ?>
				@media only screen and (min-width:768px) {
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-date:before, <?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-date:after { right: -7%; }
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-date:before, <?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-date:after { left: -7%; }
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-date:before { background: linear-gradient(to bottom left, <?php echo isset( $wtl_settings['template_bgcolor'] ) ? esc_attr( $wtl_settings['template_bgcolor'] ) : '#000000'; ?> 0%, <?php echo isset( $wtl_settings['template_bgcolor'] ) ? esc_attr( $wtl_settings['template_bgcolor'] ) : '#000000'; ?> 48%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 50%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 100%); }
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-date:after { background: linear-gradient(to top left, <?php echo isset( $wtl_settings['template_bgcolor'] ) ? esc_attr( $wtl_settings['template_bgcolor'] ) : '#000000'; ?> 0%, <?php echo isset( $wtl_settings['template_bgcolor'] ) ? esc_attr( $wtl_settings['template_bgcolor'] ) : '#000000'; ?> 48%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 50%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 100%); }
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-date:before { background: linear-gradient(to bottom right, <?php echo isset( $wtl_settings['template_bgcolor'] ) ? esc_attr( $wtl_settings['template_bgcolor'] ) : '#000000'; ?> 0%, <?php echo isset( $wtl_settings['template_bgcolor'] ) ? esc_attr( $wtl_settings['template_bgcolor'] ) : '#000000'; ?> 48%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 50%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 100%); }
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-date:after { background: linear-gradient(to top right, <?php echo isset( $wtl_settings['template_bgcolor'] ) ? esc_attr( $wtl_settings['template_bgcolor'] ) : '#000000'; ?> 0%, <?php echo isset( $wtl_settings['template_bgcolor'] ) ? esc_attr( $wtl_settings['template_bgcolor'] ) : '#000000'; ?> 48%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 50%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 100%); }
				}
				<?php
			}
		}
		?>
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a{
			<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a:hover,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a:hover{
			<?php echo isset( $wtl_settings['template_fthovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_fthovercolor'] ) : ''; ?>
		}
		/* Timeline Icon Settings */
		<?php echo esc_attr( $layout_id ); ?> .wtl_year,
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl_year span{
			<?php
			$icon_border_radious = isset( $wtl_settings['template_icon_border_radious'] ) ? esc_attr( $wtl_settings['template_icon_border_radious'] ) : '';
			if ( $icon_border_radious < 50 ) {
				echo 'border-radius:' . esc_attr( $icon_border_radious ) . '% !important;';
				?>
				line-height: unset;
				height: unset;
				<?php
			}
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image span {
			<?php echo isset( $wtl_settings['template_icon_border_radious'] ) ? 'border-radius:' . esc_attr( $wtl_settings['template_icon_border_radious'] ) . '% !important' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl_year,
		<?php echo esc_attr( $layout_id ); ?> .wtl_year span,
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap::after {
			<?php echo isset( $wtl_settings['timeline_border_color'] ) ? 'background:' . esc_attr( $wtl_settings['timeline_border_color'] ) . ' !important' : ''; ?>
		}
		/* Line */
		<?php echo esc_attr( $layout_id ); ?> .wtl_year,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image
		{
			<?php echo isset( $wtl_settings['template_color'] ) ? 'border-color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image{
			<?php echo isset( $wtl_settings['template_color'] ) ? 'background-color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap::after{
			<?php echo isset( $wtl_settings['timeline_line_width'] ) ? 'width:' . esc_attr( $wtl_settings['timeline_line_width'] ) . 'px !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl_year::before{
			<?php echo isset( $wtl_settings['timeline_line_width'] ) ? 'height:' . esc_attr( $wtl_settings['timeline_line_width'] ) . 'px !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl_year,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image{
			<?php echo isset( $wtl_settings['timeline_line_width'] ) ? 'border-width:' . esc_attr( $wtl_settings['timeline_line_width'] ) . 'px !important;' : ''; ?>
		}
		<?php
		/* Style Dependency Start --- Check if vertifcle */
		if ( 2 == $wtl_settings['layout_type'] ) { 
			/* ------------------ Style Left ------------------ */
			if ( 'left' === $timeline_style_view ) {
				?>
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap:after{right: unset;left: 30px;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl_year{right: unset;margin: unset;left: 70px;position: relative;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl_year:before{content: '';position: absolute;width: 100%;height: 4px;z-index: 0;border: none;top: 0;bottom: 0;margin: auto 0;left: -40px;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-date{left: 80px !important; margin-bottom: 20px;position: relative;text-align: left}
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image{right: unset;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-all-post-content{float: left !important;margin-left: 80px;}
				<?php echo esc_attr( $layout_id ); ?> .post_even .wtl_post_content_schedule:before{left: -20px;transform: rotate(180deg)}
				<?php if ( 5 == $timeline_style_type ) {  ?>
				@media only screen and (max-width:768px) {
					<?php echo esc_attr( $layout_id ); ?> .wtl-post-date{left:  0 !important; }
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-post-center-image span i {left:0 !important;}
				}
					<?php
				}
			}
			/* ------------------ Style Right ------------------ */
			if ( 'right' === $timeline_style_view ) {
				?>
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap:after{left: unset;right: 30px;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl_year{left: unset;margin: unset;right: 70px;position: relative;float: right;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl_year:before{content: '';position: absolute;width: 100%;height: 4px;z-index: 0;border: none;top: 0;bottom: 0;margin: auto 0;right: -40px;}
				<?php echo esc_attr( $layout_id ); ?> .wtl_dateeicon{text-align: right;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-date{right:  80px !important; margin-bottom: 20px;position: relative;text-align: right;left: unset !important;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image{left: unset;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-all-post-content{float: right !important;margin-right: 80px;}
				<?php echo esc_attr( $layout_id ); ?> .post_even .wtl_post_content_schedule:before{right: -20px;}
				<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl_post_content_schedule:before{left: unset;right: -20px;transform: rotate(180deg)}
				<?php if ( 5 == $timeline_style_type ) {  ?>
					@media only screen and (max-width:768px) {
						<?php echo esc_attr( $layout_id ); ?> .wtl-post-date{right:  0 !important; }
						<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-post-center-image span i {left:0 !important;}
					}
					<?php
				}
			}
			?>
			<?php if ( 'center' === $timeline_style_view ) { ?>
				<?php if ( 4 == $timeline_style_type || 5 == $timeline_style_type ) {  ?>
					<?php if ( isset( $readmore_button_alignment ) && 'left' === $readmore_button_alignment ) { ?>
						<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .post_even .wtl-read-more-div a.wtl-read-more {float: right;}
				<?php } ?>
					<?php if ( isset( $readmore_button_alignment ) && 'right' === $readmore_button_alignment ) { ?>
						<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .post_even .wtl-read-more-div a.wtl-read-more {float: left;}
				<?php } ?>
			<?php } ?>
				<?php
			}
			/* ------------------ Style Compact ------------------ */
			if ( 'minima' === $timeline_style_view ) {
				?>
				<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper {display:flex}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content {overflow:inherit}
				body .wtl-schedule-post-content .wtl-schedule-all-post-content {width: 100%}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap {float:left}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl-post-center-image{
					<?php echo isset( $wtl_settings['timeline_line_width'] ) ? 'border:' . esc_attr( $wtl_settings['timeline_line_width'] ) . 'px  solid !important;' : ''; ?>
				}
				<?php
				if ( 4 == $timeline_style_type || 5 == $timeline_style_type ) { 
					if ( isset( $readmore_button_alignment ) && 'left' === $readmore_button_alignment ) {
						?>
						<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .post_even .wtl-read-more-div a.wtl-read-more {float: right;}
						<?php
					}
					if ( isset( $readmore_button_alignment ) && 'right' === $readmore_button_alignment ) {
						?>
						<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .post_even .wtl-read-more-div a.wtl-read-more {float: left;}
				<?php } ?>
			<?php } ?>
			@media only screen and (max-width: 639px) {
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap:after {margin-left: 0px;}
			}
			@media only screen and (min-width: 640px) {
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content {display: block;position: relative;float: left;clear: left;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even {float: right;clear: right;}
				<?php echo esc_attr( $layout_id ); ?> .blankdiv {float: right;height: 100px;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-center-image {right: -80px;left: unset;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-center-image {left: -80px;right: unset;}
			}
			@media only screen and (min-width: 640px) and (max-width: 767px) {
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content {width: 42%;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-center-image {left: calc(100% - -9%);right: unset;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-center-image {right: calc(100% - -9%);left: unset;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl-schedule-all-post-content {margin-left: 0px !important;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap:after {left: 0px;}
			}
			@media only screen and (min-width: 768px) and (max-width: 991px) {
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-center-image {left: calc(100% - -0%);}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-center-image {right: calc(100% - -0%);}
			}
			@media only screen and (min-width: 640px) and (max-width: 991px) {
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl-schedule-all-post-content {width: 100% !important;}
				<?php echo esc_attr( $layout_id ); ?> .blankdiv {height: 80px;}
			}
			@media only screen and (min-width: 640px) {
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content {width: 45%;}
			}
			/*Fix title in minima mode */
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-content .wtl-post-title{ background:none !important; <?php echo isset( $wtl_settings['template_titlecolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_titlecolor'] ) . ' !important' : ''; ?>}
			h2.wtl-date-title{
				margin:0 !important;
			}
				<?php /* fix Dot line */ ?>
				<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl-post-center-image:before{
				left: -25px !important; right: unset !important;
			}
			<?php if ( 3 == $timeline_style_type ) {  ?>
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-center-image:before{
					right: -25px; left: unset !important;
				}
			<?php } ?>
				<?php /* Fix arrow issue */ ?>
				<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl_post_content_schedule:before{ right: -20px; left: unset; transform:rotate(180deg)}
				<?php echo esc_attr( $layout_id ); ?> .post_even .wtl_post_content_schedule:before{ left: -20px; right: unset; transform:rotate(180deg)}
				<?php
			}
			if ( 1 == $timeline_style_type ) { 
				?>
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-title, <?php echo esc_attr( $layout_id ); ?> .wtl-post-title a{
					<?php echo isset( $wtl_settings['template_titlecolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_titlecolor'] ) . ' !important' : ''; ?>
				}
				<?php echo esc_attr( $layout_id ); ?> h2.wtl-date-title,
				<?php echo esc_attr( $layout_id ); ?> h2.wtl-date-title a{
					color: #fff !important
				}
				<?php
			}
			/* ------ Classic ------ */
			if ( 2 == $timeline_style_type || 3 == $timeline_style_type ) { 
				?>
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image{ background: none !important }
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image span img,
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image span i {display: none !important;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image span{
					width:20px;height: 20px;border:none;display: block;left: 0;right: 0;top: 0; bottom: 0; margin: auto; position: absolute;
				}
				<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl-post-content p { margin-bottom: 0; }
				<?php
				if ( 2 == $timeline_style_type ) { 
					?>
					<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image { height: auto;<?php echo isset( $wtl_settings['timeline_line_width'] ) ? 'border:' . esc_attr( $wtl_settings['timeline_line_width'] ) . 'px solid;' : ''; ?>}
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content wtl-schedule-all-post-content
					<?php echo esc_attr( $layout_id ); ?> .wtl-post-content .wtl-post-title { margin-bottom: 10px; }
					<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl_post_content_schedule:before {left: -22px;right:unset;}
					<?php echo esc_attr( $layout_id ); ?> .post_even .wtl_post_content_schedule:before {right: -22px;left:unset; }
					<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl-schedule-all-post-content, <?php echo esc_attr( $layout_id ); ?> .post_even .wtl-schedule-all-post-content {border-right: 0px;}
					<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl-schedule-all-post-content { border-top: 5px solid #02c5be;  }
					<?php echo esc_attr( $layout_id ); ?> .post_even .wtl-schedule-all-post-content { border-top: 5px solid #f12945; }
					<?php echo esc_attr( $layout_id ); ?> .post_even .wtl_post_content_schedule:before { border-color: transparent transparent transparent <?php echo isset( $wtl_settings['template_content_box_bg_color'] ) ? esc_attr( $wtl_settings['template_content_box_bg_color'] ) : '#ffffff'; ?>; }
					<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl_post_content_schedule:before { border-color: transparent <?php echo isset( $wtl_settings['template_content_box_bg_color'] ) ? esc_attr( $wtl_settings['template_content_box_bg_color'] ) : '#ffffff'; ?> transparent transparent; }
					<?php echo esc_attr( $layout_id ); ?> .post_even .wtl_post_content_schedule:before{
						<?php
						if ( 'left' === $timeline_style_view ) {
							echo 'left:-22px;right:unset;';
						} else {
							if ( 2 == $timeline_style_type && 'minima' === $timeline_style_view ) { 
								echo 'left:-22px;right:unset;';
							} else {
								echo 'right:-22px;left:unset;';
							}
						}
						?>
					}
					<?php
					if ( 2 == $timeline_style_type && 'minima' === $timeline_style_view ) { 
						echo esc_attr( $layout_id );
						?>
						.post_odd .wtl_post_content_schedule:before{ right:-22px;left:unset;   }
						<?php
					} else {
						if ( 'right' === $timeline_style_view ) {
							echo esc_attr( $layout_id );
							?>
							.post_odd .wtl_post_content_schedule:before{ right:-22px;left:unset; }
							<?php
						} else {
							echo esc_attr( $layout_id );
							?>
							.post_odd .wtl_post_content_schedule:before{ left:-22px;right:unset;   }
							<?php
						}
					}
					echo esc_attr( $layout_id );
					?>
					.wtl-post-content .wtl-post-title{ background:none !important; <?php echo isset( $wtl_settings['template_titlecolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_titlecolor'] ) . ' !important' : ''; ?>}
					<?php
				}
			}
			/* ------ Elegant ------ */
			if ( 3 == $timeline_style_type || 4 == $timeline_style_type || 5 == $timeline_style_type ) { 
				?>
				<?php echo esc_attr( $layout_id ); ?> .wtl_post_content_schedule:before{display: none !important}
				<?php
				if ( 3 == $timeline_style_type ) { 
					echo esc_attr( $layout_id );
					?>
			.wtl-post-center-image { height: auto;<?php echo isset( $wtl_settings['timeline_line_width'] ) ? 'border:' . esc_attr( $wtl_settings['timeline_line_width'] ) . 'px solid;' : ''; ?>}
					<?php
					if ( 'left' === $timeline_style_view ) {
						?>
				.wtl-post-center-image:before{ right: -24px !important; left: unset !important; }
						<?php
					} elseif ( 'right' === $timeline_style_view ) {
						?>
				.wtl-post-center-image:before{ left: -24px !important; right: unset !important; }
						<?php
					} else {
						echo esc_attr( $layout_id );
						?>
				.post_even .wtl-post-center-image:before{ left: -25px; right: unset;}
						<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl-post-center-image:before{right: -25px; left: unset; }
						<?php
					}
					echo esc_attr( $layout_id );
					?>
			.wtl-post-center-image:before{content:'';position: absolute;width:100%;height: 4px;z-index: 0;border: none;top: 0;margin: auto;bottom: 0;}
					<?php
				}
			}
			/* ------ Clean ------ */
			if ( 4 == $timeline_style_type || 5 == $timeline_style_type ) { 
				?>
				<?php echo esc_attr( $layout_id ); ?> .post_even .wtl-post-title{ color: #f12945 !important; background: none !important;}
				<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl-post-title{ color: #f12945 !important; background: none !important; }
				<?php echo esc_attr( $layout_id ); ?> .post_even .wtl-post-title a{ color: #f12945 !important; text-align: right;}
				<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl-post-title a{ color: #02c5be !important}
				<?php echo esc_attr( $layout_id ); ?> .post_even .wtl-schedule-all-post-content{
					text-align: right;
				}
				<?php
				if ( 5 == $timeline_style_type ) {  ?>
					<?php echo esc_attr( $layout_id ); ?> .post_even .wtl-post-title a,<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl-post-title a{
						padding-left: 0; padding-right: 0;
					}
					<?php
				}
				if ( 4 == $timeline_style_type ) { 
					?>
					@media only screen and (max-width:767px) {
						<?php echo esc_attr( $layout_id ); ?> .wtl_dateeicon {margin-bottom: 30px;}
					}
					<?php
				}
			}
			/* ------ Modern ------ */
			if ( 5 == $timeline_style_type ) { 
				?>
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image span{
			width:20px;height: 20px;border:none;display: block;
			left:auto;right: auto;top: calc(50% - 10px); margin: auto;bottom: 0;
		}
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image{
			background: none !important;
		}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-center-image,
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-center-image {border:solid;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image img,
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image i{
			top:30px;padding: 10px; min-width: 50px; min-height: 50px;
		}
		/* Image / Icons */
				<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl-post-center-image img,
				<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl-post-center-image i{
				<?php
				if ( 'minima' === $timeline_style_view ) {
					echo 'margin-right:0 !important; border: 0px !important;';
				} elseif ( 'left' === $timeline_style_view || 'right' === $timeline_style_view ) {
					echo 'margin-right:0 !important;';
				} else {
					echo 'margin-right:40px !important';
				}
				?>
		}
				<?php echo esc_attr( $layout_id ); ?> .post_even .wtl-post-center-image img,
				<?php echo esc_attr( $layout_id ); ?> .post_even .wtl-post-center-image i{
				<?php
				if ( 'minima' === $timeline_style_view ) {
					echo 'margin-left:0 !important;  border: 0px !important;';
				} else {
					echo 'margin-left:40px !important;';
				}
				?>
		}
		/* Images */
				<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl-post-center-image img{
			background: #02c5be;
		}
				<?php echo esc_attr( $layout_id ); ?> .post_even .wtl-post-center-image img{
			background: #f12945;
		}
				<?php if ( 'minima' === $timeline_style_view ) { ?>
			/* Icons */
					<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl-post-center-image i{
				top:4px !important;
				margin-left: 6px;
			}
					<?php echo esc_attr( $layout_id ); ?> .post_even .wtl-post-center-image i{
				top:4px !important;
			}
		<?php } ?>
				<?php echo esc_attr( $layout_id ); ?>.wtll_style_view_center.wtll_style_type_5 .wtl-schedule-wrap .wtl-post-center-image span i:before {
					left: 9px;top: -7px;
				}
				<?php echo esc_attr( $layout_id ); ?>.wtll_style_type_5 .wtl-post-center-image span {
					width: 50px;
					height: 50px;
					top: calc(50% - 20px);
				}
				<?php echo esc_attr( $layout_id ); ?>.wtll_style_type_5 .wtl-schedule-post-content.post_odd .wtl-post-center-image {right: -80px;}
				<?php echo esc_attr( $layout_id ); ?>.wtll_style_type_5 .wtl-schedule-post-content.post_even .wtl-post-center-image {left: -80px;}
				<?php echo esc_attr( $layout_id ); ?>.wtll_style_type_5 .post_odd .wtl-post-center-image i {
					top: 9px;
					margin-left: 11px;
				}
				<?php echo esc_attr( $layout_id ); ?>.wtll_style_type_5 .post_even .wtl-post-center-image i {
					top: 9px;
				}
				<?php if ( 'center' === $timeline_style_view || 'right' === $timeline_style_view ) { ?>
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-post-center-image span i {
				left: -9px;top: -3px;position: relative;
				}
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-post-center-image span i:before {
					left: 4px;top: -2px;font-size: 22px;position: relative;
				}
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .post_even .wtl-post-center-image img, <?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .post_even .wtl-post-center-image i {
					margin-left: 0 !important;
				}
			<?php } ?>
				<?php if ( 'left' === $timeline_style_view ) { ?>
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-post-center-image span i {
					left: 4px;top: -3px !important;position: relative;
					}
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-post-center-image span i:before {
						left: -8px;top: -2px;font-size: 22px;position: relative;
					}
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .post_even .wtl-post-center-image img, <?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .post_even .wtl-post-center-image i {
						margin-left: 0 !important;
					}
				<?php } ?>
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image span i:before{
					<?php
					if ( 'minima' === $timeline_style_view ) {
						?>
						font-size: 20px;
						<?php
					} elseif ( 'center' === $timeline_style_view || 'right' === $timeline_style_view ) {
						?>
						line-height:50px;font-size:20px;background: none !important;<?php echo isset( $wtl_settings['template_color'] ) ? 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;' : ''; ?>
						<?php
					} else {
						?>
						line-height:50px;font-size:40px;background: none !important;<?php echo isset( $wtl_settings['template_color'] ) ? 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;' : ''; ?>
						<?php
					}
					?>
				}
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-date, <?php echo esc_attr( $layout_id ); ?> .wtl-post-date a{
					position: unset;
					<?php echo isset( $wtl_settings['template_color'] ) ? 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;' : ''; ?>
				}
						<?php
						if ( 'minima' === $timeline_style_view ) {
							?>
							<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image img,
							<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image i{
						min-width: 28px; min-height: 28px;
						border:2px solid;
						top: 50px !important; padding: 3px; line-height: 2px;
					}
							<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl-post-center-image img,
							<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl-post-center-image i{
						margin-right:15px !important;
					}
							<?php
						}
						if ( 'left' === $timeline_style_view ) {
							?>
							<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-post-center-image span i {top: 34px;right: -10px;}
							<?php echo esc_attr( $layout_id ); ?> .post_even.wtl-schedule-post-content .wtl-schedule-all-post-content,<?php echo esc_attr( $layout_id ); ?> .post_even.wtl-schedule-post-content .wtl-post-title a {text-align: left;}
							<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .post_even.wtl-schedule-post-content .wtl-post-title {text-align: left !important;}
					@media only screen and (max-width:767px) {
							<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-post-center-image span i {top: 0;right: -10px;}
							<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-post-center-image span i:before { position:relative;left:6px !important; top:0 !important;}
					}
						<?php } elseif ( 'right' === $timeline_style_view ) { ?>
							<?php echo esc_attr( $layout_id ); ?> .post_odd.wtl-schedule-post-content .wtl-schedule-all-post-content,<?php echo esc_attr( $layout_id ); ?> .post_odd.wtl-schedule-post-content .wtl-post-title a {text-align: right;}
							<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .post_odd.wtl-schedule-post-content .wtl-post-title {text-align: right !important;}
				<?php } else { ?>
							<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-post-center-image span i {position: relative;}
				<?php } ?>
				@media only screen and (max-width:767px) {
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-post-center-image span i {left: 0;}
				}
						<?php
			}
			/*------ Minimal ------ */
			if ( 6 == $timeline_style_type ) { 
				?>
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap{ width: 100%; display: block; clear: both; float: left; }
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image{ background: none !important }
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image span img,
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image span i {display: none !important;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image span{
					width:20px;height: 20px;border:none;display: block;
					left:auto;right: auto;top: calc(50% - 10px); margin: auto;bottom: 0;
				}
				<?php echo esc_attr( $layout_id ); ?>  h2.wtl-post-title{
					<?php echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) ); ?>
				}
				<?php
			}
			/* Style Dependency End ------------------------------------*/
		}
		/* if Horizental selected */
		if ( 1 == $wtl_settings['layout_type'] ) { 
			if ( 0 == $timeline_style_type ) { 
				?>
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-content, .wtl-post-content p {
					padding: 15px 0 0 0;
				}
			<?php } ?>
			<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtl-ss-right i,
			<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtl-ss-left i{
				<?php echo isset( $wtl_settings['template_color'] ) ? 'color:' . esc_attr( $wtl_settings['template_color'] ) . ';' : ''; ?>
				border:2px solid;width: 25px;height: 25px;text-align: center;vertical-align: middle;line-height: 23px;margin-top: -20px;
			}
			<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .slick-track:before{
				<?php echo isset( $wtl_settings['template_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_color'] ) . '' : ''; ?>
			}
			<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtl-slitem{
				<?php echo isset( $wtl_settings['wp_timeline_content_border_radius'] ) ? 'border-radius:' . esc_attr( $wtl_settings['wp_timeline_content_border_radius'] ) . 'px !important;' : ''; ?>
			}
			<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtl-slitem{
				<?php
				echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
				echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
				echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
				echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
				?>
			}
			<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtl-post-content{
				<?php echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) ); ?>
			}
			<?php
			/* if Default */
			if ( 0 == $timeline_style_type || 1 == $timeline_style_type || 2 == $timeline_style_type || 4 == $timeline_style_type || 5 == $timeline_style_type || 6 == $timeline_style_type ) { 
				?>
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image{ background:none !important;padding:0;width:50px;height:50px; }
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image span{ border:none !important; }
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image span i{ line-height: 30px; }
				<?php
			}
			if ( 4 == $timeline_style_type ) { 
				?>
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image,
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image span{max-width: 30px; max-height: 30px;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image span i:before{ top: 0 }

				<?php echo esc_attr( $layout_id ); ?> .slick-current .wtl-post-center-image,
				<?php echo esc_attr( $layout_id ); ?> .slick-current .wtl-post-center-image span{max-width:unset; max-height:unset;}
				<?php echo esc_attr( $layout_id ); ?> .slick-current .wtl-post-center-image span i:before{ top: 10px }
				<?php
			}
			if ( 6 == $timeline_style_type ) { 
				?>
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-content .wtl-post-title{ background:none !important; <?php echo isset( $wtl_settings['template_titlecolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_titlecolor'] ) . ' !important' : ''; ?>}
				<?php echo esc_attr( $layout_id ); ?>  .clayout_skin_6 .post_odd .wtl-post-title a{color: #02c5be}
				<?php echo esc_attr( $layout_id ); ?> .clayout_skin_6 .post_even .wtl-post-title a{color: #f12945}
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-date{
					position: relative !important;text-align: center;right: unset !important;left: unset !important;margin: 0 auto;display: block;width: 100%;top: unset;bottom: unset;
				}
				<?php
			}
		}
		/* fix random issues */
		echo esc_attr( $layout_id );
		?>
		.wtl-post-title{
			<?php echo 0 == $wtl_settings['wp_timeline_post_title_link'] ? 'padding:15px' : '';  ?>
		}
		<?php
		/* --- End Horizental --- */
		echo esc_attr( Wtl_Template_Config::post_date_typography( $wtl_settings, $layout_id ) );
}

/*------------------ Template: Accordion  Layout --------------- */
if ( 'accordion' === $wp_timeline_theme ) {?>
	<?php echo esc_attr( $layout_id ); ?>  .label_featured_post {
		<?php echo isset( $wtl_settings['template_contentcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_contentcolor'] ) . '!important;' : ''; 
		?>
	}
	<?php 
		if ( isset( $firstletter_big ) && 1 == $firstletter_big ) { 
			$first_letter_line_height = $firstletter_fontsize * 75 / 100;
			?>
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-content:first-letter {
				<?php
				if ( isset( $firstletter_font_family ) && $firstletter_font_family ) {
					?>
					font-family :<?php echo esc_attr( $firstletter_font_family ); ?>; <?php } ?>
					font-size   : <?php echo esc_attr( $firstletter_fontsize ) . 'px'; ?>;
					color       : <?php echo esc_attr( $firstletter_contentcolor ); ?>;
					margin-right: 5px;
					line-height : <?php echo esc_attr( $first_letter_line_height ) . 'px'; ?>;
					display     : inline-block;
					<?php
					if ( isset( $content_font_text_decoration ) && $content_font_text_decoration ) {
						?>
						text-decoration: <?php echo esc_attr( $content_font_text_decoration ); ?>;
					<?php } ?>
				}
	<?php } ?>
	.wtl_wrapper.wp_timeline_post_list.accordion_cover {
		<?php echo isset( $wtl_settings['template_content_box_bg_color'] ) ? 'background-color:' . esc_attr( $wtl_settings['template_content_box_bg_color'] ) . '!important;' : '#222225'; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-accordion-post-content,.blog_template.accordion .wtl-accordion-circle:after{
		<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background-color:' . esc_attr( $wtl_settings['template_bgcolor'] ) . '!important;' : '#161616'; 
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_wrapper{
		<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) . ';' : '#fff'; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .blog_template.accordion .tags a:after {
		<?php echo isset( $wtl_settings['template_color'] ) ? 'border-color: transparent ' . esc_attr( $wtl_settings['template_color'] ) . '  transparent transparent !important;' : ''; ?>
	}
	
	<?php echo esc_attr( $layout_id ); ?> .blog_template.accordion h2.wtl-post-title:after{
		<?php echo isset( $wtl_settings['template_color'] ) ? 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;' : ''; ?>
	}

	<?php echo esc_attr( $layout_id ); ?> .blog_template.accordion h2.wtl-post-title{
		<?php echo isset( $wtl_settings['template_color'] ) ? 'border-bottom:1px solid ' . esc_attr( $wtl_settings['template_color'] ) . ' !important;' : ''; ?>
	}

	<?php echo esc_attr( $layout_id ); ?> .blog_template.accordion .wtl-accordion-circle:before {
		<?php echo isset( $wtl_settings['template_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;' : ''; ?>
	}

	<?php echo esc_attr( $layout_id ); ?> .blog_template.accordion .wtl-accordion-post-content:after{
		<?php echo isset( $wtl_settings['template_color'] ) ? 'border: 2px solid' . esc_attr( $wtl_settings['template_color'] ) . ' !important;' : ''; ?>
	}

	<?php echo esc_attr( $layout_id ); ?> .accordion_cover .accordion-content-wrap:after{
		border-color: <?php echo esc_attr( $template_color ); ?>;
	}
	<?php
	if ( isset( $read_more_on ) && 2 == $read_more_on ) { 
		echo esc_attr( $layout_id );
		?>
		.wtl_blog_template.accordion a.more-tag:focus,
		<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template.accordion a.more-tag:hover {
			background: <?php echo esc_attr( $template_readmore_hover_backcolor ); ?>;
		}
	<?php } ?>
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template.accordion a.more-tag{
		color: <?php echo esc_attr( $template_readmorecolor ); ?>;
		<?php
		if ( isset( $read_more_on ) && 2 == $read_more_on ) { 
			?>
			background: <?php echo esc_attr( $template_readmorebackcolor ); ?>;
		<?php } ?>
		<?php
		if ( isset( $content_font_family ) && '' != $content_font_family ) { 
			?>
			font-family: <?php echo esc_attr( $content_font_family ); ?>;
		<?php } ?>
	}
	@media screen and (max-width: 480px) {
		<?php echo esc_attr( $layout_id ); ?>.accordion_cover .wtl-post-meta {
			box-shadow: 0px 0px 5px <?php echo esc_attr( $template_color ); ?>;
		}
	}
	/* meta */
	<?php echo esc_attr( $layout_id ); ?>.accordion_cover .meta-archive a,
	<?php echo esc_attr( $layout_id ); ?>.accordion_cover .accordion-circle:after {
		background: <?php echo esc_attr( $template_color ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .accordion_wrapper .post-meta a:hover,
	<?php echo esc_attr( $layout_id ); ?> .accordion_wrapper .wtl-post-category a:hover,
	<?php echo esc_attr( $layout_id ); ?> .accordion_wrapper .tags a:hover,
	<?php echo esc_attr( $layout_id ); ?> .accordion_wrapper .wtl-has-links a:hover,
	<?php echo esc_attr( $layout_id ); ?> .accordion_wrapper .post-author a:hover,
	<?php echo esc_attr( $layout_id ); ?> .accordion_wrapper .date-meta a:hover,
	<?php echo esc_attr( $layout_id ); ?> .author-name a:hover,
	<?php echo esc_attr( $layout_id ); ?> .metacomments a.comments-link:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a:hover {
		color: <?php echo esc_attr( $template_fthovercolor ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .accordion_wrapper .wtl-read-more .more-tag:hover,
	<?php echo esc_attr( $layout_id ); ?> .accordion_wrapper .wtl-post-title a:hover {
		color:<?php echo esc_attr( $template_titlehovercolor ); ?>;
	}

	<?php echo esc_attr( $layout_id ); ?>  .meta-comment span,
	<?php echo esc_attr( $layout_id ); ?>  .meta-comment span a,
	<?php echo esc_attr( $layout_id ); ?>  .meta-comment span i,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-author-name a,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-author-name,
	<?php echo esc_attr( $layout_id ); ?>  span.tags.wp_timeline_no_links,
	<?php echo esc_attr( $layout_id ); ?>  span.category-link,
	<?php echo esc_attr( $layout_id ); ?>  span.wtl-comment.wtl-no-links,
	<?php echo esc_attr( $layout_id ); ?>  .admin-comment .author-name i:before,
	<?php echo esc_attr( $layout_id ); ?>  span.post-category a,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-wrapper-like a {
		color: <?php echo esc_attr( $template_ftcolor ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?>  i.fas.fa-comments:before {
		<?php echo isset( $wtl_settings['meta_fontsize'] ) ? 'font-size:' . esc_attr( $wtl_settings['meta_fontsize'] ) . 'px;' : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-accordion-button {
		background: <?php echo esc_attr( $template_ftcolor ); ?> !important;    
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-accordion-button:hover{
		background: <?php echo esc_attr( $template_fthovercolor ); ?> !important;
	}
	<?php
	if ( isset( $content_font_family ) && '' != $content_font_family ) { 
		?>
		font-family: <?php echo esc_attr( $content_font_family ); ?>; <?php } ?>
	<?php
	if ( isset( $content_font_weight ) && $content_font_weight ) {
		?>
		font-weight: <?php echo esc_attr( $content_font_weight ); ?>;<?php } ?>
	<?php
	if ( isset( $content_font_line_height ) && $content_font_line_height ) {
		?>
		line-height: <?php echo esc_attr( $content_font_line_height ); ?>;<?php } ?>
	<?php
	if ( isset( $content_font_letter_spacing ) && $content_font_letter_spacing ) {
		?>
		letter-spacing: <?php echo esc_attr( $content_font_letter_spacing ) . 'px'; ?>;<?php } ?>
		<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-meta-comment i{
		<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?>  .label_featured_post span:hover,
	<?php echo esc_attr( $layout_id ); ?>  .meta-archive a:hover,
	<?php echo esc_attr( $layout_id ); ?>  .meta-archive:hover,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-author-name a:hover,
	<?php echo esc_attr( $layout_id ); ?>  .meta-comment a:hover,
	<?php echo esc_attr( $layout_id ); ?>  .post-meta:hover,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-author:hover,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-author-name:hover,
	<?php echo esc_attr( $layout_id ); ?>  .meta-comment:hover,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-wrapper-like a:hover,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-wrapper-like .wtl-count:hover,
	<?php echo esc_attr( $layout_id ); ?>  .accordion-time:hover,
	<?php echo esc_attr( $layout_id ); ?>  .accordion-time a:hover,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-post-category:hover,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-post-category a:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl-meta-comment i:hover {
		<?php echo isset( $wtl_settings['template_fthovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_fthovercolor'] ) : ''; ?>
	}
	
	<?php echo esc_attr( $layout_id ); ?> .wtl-wrapper-like a {
		<?php
		echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ';' : '';
		echo isset( $wtl_settings['meta_font_family'] ) ? 'font-family:' . esc_attr( $wtl_settings['meta_font_family'] ) . ';' : '';
		echo isset( $wtl_settings['meta_fontsize'] ) ? 'font-size:' . esc_attr( $wtl_settings['meta_fontsize'] ) . 'px;' : '';
		echo isset( $wtl_settings['meta_font_weight'] ) ? 'font-weight:' . esc_attr( $wtl_settings['meta_font_weight'] ) . ';' : '';
		echo isset( $wtl_settings['meta_font_line_height'] ) ? 'line-height:' . esc_attr( $wtl_settings['meta_font_line_height'] ) . ';' : '';
		if ( 1 == $meta_font_italic ) { 
			echo 'font-style:italic;';
		} else {
			echo 'font-style:normal;';
		}

		echo isset( $wtl_settings['meta_font_text_transform'] ) ? 'text-transform:' . esc_attr( $wtl_settings['meta_font_text_transform'] ) . ';' : '';
		echo isset( $wtl_settings['meta_font_text_decoration'] ) ? 'text-decoration:' . esc_attr( $wtl_settings['meta_font_text_decoration'] ) . ';' : '';
		echo isset( $wtl_settings['meta_font_letter_spacing'] ) ? 'letter-spacing:' . esc_attr( $wtl_settings['meta_font_letter_spacing'] ) . 'px;' : '';
		?>
	}
	<?php
	echo esc_attr( Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_content_color( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
	?>
	<?php echo esc_attr( $layout_id ); ?> .wtl-accordion-post-content{
		<?php
		echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) );
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_price_wrap {
		<?php
		if ( isset( $wp_timeline_pricetextcolor ) && '' !== $wp_timeline_pricetextcolor ) { ?>
			color: <?php echo esc_attr( $wp_timeline_pricetextcolor ); ?> !important;<?php } ?>
	}
	<?php
	echo esc_attr( Wtl_Template_Config::post_date_typography( $wtl_settings, $layout_id ) );
}

/*------------------ Template: Collapsible  Layout --------------- */
if ( 'collapsible' === $wp_timeline_theme ) { ?>
	<?php 
		if ( isset( $firstletter_big ) && 1 == $firstletter_big ) { 
			$first_letter_line_height = $firstletter_fontsize * 75 / 100;
			?>
			<?php echo esc_attr( $layout_id ); ?> .collapsible .wtl-post-content-inner:first-letter {
				<?php
				if ( isset( $firstletter_font_family ) && $firstletter_font_family ) {
					?>
					font-family :<?php echo esc_attr( $firstletter_font_family ); ?>; <?php } ?>
					font-size   : <?php echo esc_attr( $firstletter_fontsize ) . 'px'; ?>;
					color       : <?php echo esc_attr( $firstletter_contentcolor ); ?>;
					margin-right: 5px;
					line-height : <?php echo esc_attr( $first_letter_line_height ) . 'px'; ?>;
					display     : inline-block;
					<?php
					if ( isset( $content_font_text_decoration ) && $content_font_text_decoration ) {
						?>
						text-decoration: <?php echo esc_attr( $content_font_text_decoration ); ?>;
					<?php } ?>
				}
	<?php } ?>
	<?php echo esc_attr( $layout_id ); ?> .wtl-comment i:before {
		<?php echo isset( $wtl_settings['meta_fontsize'] ) ? 'font-size:' . esc_attr( $wtl_settings['meta_fontsize'] ) . 'px;' : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .collapsible .wtl-wrapper-like a {
		<?php
		echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ';' : '';
		echo isset( $wtl_settings['meta_font_family'] ) ? 'font-family:' . esc_attr( $wtl_settings['meta_font_family'] ) . ';' : '';
		echo isset( $wtl_settings['meta_fontsize'] ) ? 'font-size:' . esc_attr( $wtl_settings['meta_fontsize'] ) . 'px;' : '';
		echo isset( $wtl_settings['meta_font_weight'] ) ? 'font-weight:' . esc_attr( $wtl_settings['meta_font_weight'] ) . ';' : '';
		echo isset( $wtl_settings['meta_font_line_height'] ) ? 'line-height:' . esc_attr( $wtl_settings['meta_font_line_height'] ) . ';' : '';
		if ( 1 == $meta_font_italic ) { 
			echo 'font-style:italic;';
		} else {
			echo 'font-style:normal;';
		}
		echo isset( $wtl_settings['meta_font_text_transform'] ) ? 'text-transform:' . esc_attr( $wtl_settings['meta_font_text_transform'] ) . ';' : '';
		echo isset( $wtl_settings['meta_font_text_decoration'] ) ? 'text-decoration:' . esc_attr( $wtl_settings['meta_font_text_decoration'] ) . ';' : '';
		echo isset( $wtl_settings['meta_font_letter_spacing'] ) ? 'letter-spacing:' . esc_attr( $wtl_settings['meta_font_letter_spacing'] ) . 'px;' : '';
		?>
	}
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper {
		<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) . ';' : ''; ?>
		
	}
	<?php echo esc_attr( $layout_id ); ?> .blog_template.collapsible span.category-link,
	<?php echo esc_attr( $layout_id ); ?> .blog_template.collapsible .wtl-post-category span a {
		<?php
		if ( isset( $wtl_settings['template_categorytextcolor'] ) ) { ?>
			color: <?php echo esc_attr( $template_categorytextcolor ); ?> !important;
		<?php }
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-collapsible-inner.inner-first {
		<?php echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) ); ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .blog_template.collapsible .wtl-collapsible-post-content:after {
		border: 1px solid <?php echo esc_attr( $template_color ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .blog_template.collapsible .wtl-collapsible-circle:before {
		background: <?php echo esc_attr( $template_color ); ?>;
	}
	<?php
	if ( isset( $read_more_on ) && 2 == $read_more_on ) { 
		echo esc_attr( $layout_id );
		?>
		.wtl_blog_template.collapsible a.more-tag:focus,
		<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template.collapsible a.more-tag:hover {
			background: <?php echo esc_attr( $template_readmore_hover_backcolor ); ?>;
		}
	<?php } ?>
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template.collapsible a.more-tag{
		color: <?php echo esc_attr( $template_readmorecolor ); ?>;
		<?php
		if ( isset( $read_more_on ) && 2 == $read_more_on ) { 
			?>
			background: <?php echo esc_attr( $template_readmorebackcolor ); ?>;
		<?php } ?>
		<?php
		if ( isset( $content_font_family ) && '' != $content_font_family ) { 
			?>
			font-family: <?php echo esc_attr( $content_font_family ); ?>;
		<?php } ?>
	}
	@media screen and (max-width: 480px) {
		<?php echo esc_attr( $layout_id ); ?>.collapsible_cover .wtl-post-meta {
			box-shadow: 0px 0px 5px <?php echo esc_attr( $template_color ); ?>;
		}
	}
	<?php echo esc_attr( $layout_id ); ?> h2.wtl-post-title {
		border-bottom:1px solid <?php echo esc_attr( $template_color ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .collapsible_cover .meta-archive a,
	<?php echo esc_attr( $layout_id ); ?> .collapsible_cover .collapsible-circle:after {
		background: <?php echo esc_attr( $template_color ); ?>;
	}
	
	<?php echo esc_attr( $layout_id ); ?> .collapsible .tag-with-social {
		<?php if ( 1 == $wtl_settings[ 'display_tag'] || 1 == $wtl_settings[ 'social_share'] ) { ?>
			background: <?php echo esc_attr( $template_categorybgcolor ); ?>;
		<?php } ?>
	}

	<?php echo esc_attr( $layout_id ); ?> .blog_template.collapsible span.category-link,
	<?php echo esc_attr( $layout_id ); ?> .blog_template.collapsible .wtl-collapsible-circle:after,
	<?php echo esc_attr( $layout_id ); ?> .blog_template.collapsible .wtl-post-category span {
		background: <?php echo esc_attr( $template_categorybgcolor ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .collapsible_wrapper .post-meta a:hover,
	<?php echo esc_attr( $layout_id ); ?> .collapsible_wrapper .wtl-post-category a:hover,
	<?php echo esc_attr( $layout_id ); ?> .collapsible_wrapper .tags a:hover,
	<?php echo esc_attr( $layout_id ); ?> .collapsible_wrapper .wtl-has-links a:hover,
	<?php echo esc_attr( $layout_id ); ?> .collapsible_wrapper .post-author a:hover,
	<?php echo esc_attr( $layout_id ); ?> .collapsible_wrapper .date-meta a:hover,
	<?php echo esc_attr( $layout_id ); ?> .author-name a:hover,
	<?php echo esc_attr( $layout_id ); ?> .metacomments a.comments-link:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl-wrapper-like a:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a:hover,
	<?php echo esc_attr( $layout_id ); ?> .blog_template.collapsible span.category-link a:hover {
		color: <?php echo esc_attr( $template_fthovercolor ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .collapsible_wrapper .wtl-read-more .more-tag:hover,
	<?php echo esc_attr( $layout_id ); ?> .collapsible_wrapper .wtl-post-title a:hover {
		color:<?php echo esc_attr( $template_titlehovercolor ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .collapsible_wrapper .tags a {
		color: #fff;
	}
	<?php echo esc_attr( $layout_id ); ?>  .meta-comment span,
	<?php echo esc_attr( $layout_id ); ?>  .meta-comment span a,
	<?php echo esc_attr( $layout_id ); ?>  .meta-comment span i,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-author-name a,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-author-name,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-wrapper-like a,
	<?php echo esc_attr( $layout_id ); ?> .blog_template.collapsible span.category-link a {
		color: <?php echo esc_attr( $template_ftcolor ); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-collapsible-button{
		background: <?php echo esc_attr( $template_ftcolor ); ?> !important;    
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-collapsible-button:hover{
		background: <?php echo esc_attr( $template_fthovercolor ); ?> !important;
	}
	<?php echo esc_attr( $layout_id ); ?>  .label_featured_post,
	<?php echo esc_attr( $layout_id ); ?>  .meta-archive a,
	<?php echo esc_attr( $layout_id ); ?>  .meta-archive,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-author-name a,
	<?php echo esc_attr( $layout_id ); ?>  .meta-comment a,
	<?php echo esc_attr( $layout_id ); ?>  .post-meta,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-author,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-author-name,
	<?php echo esc_attr( $layout_id ); ?>  .meta-comment,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-wrapper-like .wtl-count,
	<?php echo esc_attr( $layout_id ); ?>  .collapsible-time,
	<?php echo esc_attr( $layout_id ); ?>  .collapsible-time a,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-post-category,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-post-category a,
	<?php echo esc_attr( $layout_id ); ?> .author-name a{
		font-size: <?php echo esc_attr( $content_fontsize ) . 'px'; ?>;
		<?php
		if ( isset( $content_font_family ) && '' != $content_font_family ) { 
			?>
			font-family: <?php echo esc_attr( $content_font_family ); ?>; <?php } ?>
		<?php
		if ( isset( $content_font_weight ) && $content_font_weight ) {
			?>
			font-weight: <?php echo esc_attr( $content_font_weight ); ?>;<?php } ?>
		<?php
		if ( isset( $content_font_line_height ) && $content_font_line_height ) {
			?>
			line-height: <?php echo esc_attr( $content_font_line_height ); ?>;<?php } ?>
		<?php
		if ( isset( $content_font_letter_spacing ) && $content_font_letter_spacing ) {
			?>
			letter-spacing: <?php echo esc_attr( $content_font_letter_spacing ) . 'px'; ?>;<?php } ?>
			<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-meta-comment i{
			<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?>  .label_featured_post:hover,
		<?php echo esc_attr( $layout_id ); ?>  .meta-archive a:hover,
		<?php echo esc_attr( $layout_id ); ?>  .meta-archive:hover,
		<?php echo esc_attr( $layout_id ); ?>  .wtl-author-name a:hover,
		<?php echo esc_attr( $layout_id ); ?>  .meta-comment a:hover,
		<?php echo esc_attr( $layout_id ); ?>  .post-meta:hover,
		<?php echo esc_attr( $layout_id ); ?>  .wtl-author:hover,
		<?php echo esc_attr( $layout_id ); ?>  .wtl-author-name:hover,
		<?php echo esc_attr( $layout_id ); ?>  .meta-comment:hover,
		<?php echo esc_attr( $layout_id ); ?>  .wtl-wrapper-like .wtl-count:hover,
		<?php echo esc_attr( $layout_id ); ?>  .collapsible-time:hover,
		<?php echo esc_attr( $layout_id ); ?>  .collapsible-time a:hover,
		<?php echo esc_attr( $layout_id ); ?>  .wtl-post-category:hover,
		<?php echo esc_attr( $layout_id ); ?>  .wtl-post-category a:hover,
		<?php echo esc_attr( $layout_id ); ?> .wtl-meta-comment i:hover{
			<?php echo isset( $wtl_settings['template_fthovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_fthovercolor'] ) : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?>  .tags .link-lable,
		<?php echo esc_attr( $layout_id ); ?>  .tags a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a{
			<?php
			if ( isset( $content_font_family ) && '' != $content_font_family ) { 
				?>
				font-family: <?php echo esc_attr( $content_font_family ); ?>; <?php } ?>
			<?php
			if ( isset( $content_font_weight ) && $content_font_weight ) {
				?>
				font-weight: <?php echo esc_attr( $content_font_weight ); ?>;<?php } ?>
		}
	<?php
	echo esc_attr( Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_content_color( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
	?>
	
	<?php
	echo esc_attr( Wtl_Template_Config::post_date_typography( $wtl_settings, $layout_id ) );
}

/*------------------ Template: Verticalblur Layout --------------- */
if ( 'verticalblur_layout' === $wp_timeline_theme ) {
	$timeline_style_type = isset( $wtl_settings['timeline_style_type'] ) ? $wtl_settings['timeline_style_type'] : '';
	$timeline_style_view = isset( $wtl_settings['timeline_style_view'] ) ? $wtl_settings['timeline_style_view'] : '';
	?>

	<?php 
	if ( isset( $firstletter_big ) && 1 == $firstletter_big ) { 
		$first_letter_line_height = $firstletter_fontsize * 75 / 100;
		?>
		<?php echo esc_attr( $layout_id ); ?> .wp-timeline-first-letter {
			<?php
			if ( isset( $firstletter_font_family ) && $firstletter_font_family ) {
				?>
				font-family :<?php echo esc_attr( $firstletter_font_family ); ?>; <?php } ?>
				font-size   : <?php echo esc_attr( $firstletter_fontsize ) . 'px'; ?>;
				color       : <?php echo esc_attr( $firstletter_contentcolor ); ?>;
				margin-right: 5px;
				line-height : <?php echo esc_attr( $first_letter_line_height ) . 'px'; ?>;
				display     : inline-block;
				<?php
				if ( isset( $content_font_text_decoration ) && $content_font_text_decoration ) {
					?>
					text-decoration: <?php echo esc_attr( $content_font_text_decoration ); ?>;
				<?php } ?>
			}
	<?php } ?>

	<?php echo esc_attr( $layout_id ); ?> .wtl-wrapper-like a:hover {
			<?php echo isset( $wtl_settings['template_fthovercolor'] ) ? 'color:'. esc_attr( $wtl_settings['template_fthovercolor'] ) . ' !important;' : ''; ?>
	}

	<?php echo esc_attr( $layout_id ); ?> .label_featured_post {
			<?php echo isset( $wtl_settings['template_contentcolor'] ) ? 'color:'. esc_attr( $wtl_settings['template_contentcolor'] ) . ' !important;' : ''; ?>
	}

	

	<?php echo esc_attr( $layout_id ); ?> .wtl-wrapper-like a {
			<?php
			echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_family'] ) ? 'font-family:' . esc_attr( $wtl_settings['meta_font_family'] ) . ';' : '';
			echo isset( $wtl_settings['meta_fontsize'] ) ? 'font-size:' . esc_attr( $wtl_settings['meta_fontsize'] ) . 'px;' : '';
			echo isset( $wtl_settings['meta_font_weight'] ) ? 'font-weight:' . esc_attr( $wtl_settings['meta_font_weight'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_line_height'] ) ? 'line-height:' . esc_attr( $wtl_settings['meta_font_line_height'] ) . ';' : '';
			if ( 1 == $meta_font_italic ) { 
				echo 'font-style:italic;';
			} else {
				echo 'font-style:normal;';
			}
			echo isset( $wtl_settings['meta_font_text_transform'] ) ? 'text-transform:' . esc_attr( $wtl_settings['meta_font_text_transform'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_text_decoration'] ) ? 'text-decoration:' . esc_attr( $wtl_settings['meta_font_text_decoration'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_letter_spacing'] ) ? 'letter-spacing:' . esc_attr( $wtl_settings['meta_font_letter_spacing'] ) . 'px;' : '';
			?>
		}
	@media only screen and (min-width:768px) {
		<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .post_odd .wtl-post-title{
			<?php echo isset( $wtl_settings['template_color'] ) ? 'border-right: 5px solid '. esc_attr( $wtl_settings['template_color'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .post_even .wtl-post-title {
			<?php echo isset( $wtl_settings['template_color'] ) ? 'border-left: 5px solid '. esc_attr( $wtl_settings['template_color'] ) . ' !important;' : ''; ?>
		}
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_main_title h1,
	<?php echo esc_attr( $layout_id ); ?> .wtl_main_title h2 {
		<?php echo isset( $wtl_settings['template_color'] ) ? 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;' : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-all-post-content{
		<?php
		echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) );
		?>
	}
	/* Title*/
	<?php echo esc_attr( $layout_id ); ?> h2.wtl-post-title{
		<?php echo esc_attr( Wtl_Template_Verticalblur_Layout::content_box_border_radious_title( $wtl_settings ) ); ?>
	}
	<?php
	echo esc_attr( Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_content_color( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
	?>
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-content,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-footer{
		<?php echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) ); ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-footer{
		padding-top: 0 !important;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-post-center-image span i {
		<?php
		if ( isset( $template_titlecolor ) && '' !== $template_titlecolor ) {
			?>
			color: <?php echo esc_attr( $template_titlecolor ); ?> !important;<?php } ?>
			font-size: 22px;
		}
		/* Template Color */
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap:after,
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap:before,
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl_year,
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl_year:before,
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl_year span
		<?php
		if ( 0 != $timeline_style_type ) { 
			?>
			,<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image
			<?php
		}
		?>
		<?php
		if ( 0 == $timeline_style_type || 1 == $timeline_style_type || 4 == $timeline_style_type || 5 == $timeline_style_type ) { 
			?>
			<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl-post-content p { margin-bottom: 0; }
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image { height: auto; width: auto; }
			<?php
		}
		if ( 0 == $timeline_style_type ) { 
			?>
			<?php echo esc_attr( $layout_id ); ?>.wp_timeline_post_list.wtll_style_type_0 .wtl-schedule-post-content .wtl-post-date span,<?php echo esc_attr( $layout_id ); ?>.wp_timeline_post_list.wtll_style_type_0 .wtl_single_post_wrapp .wtl-post-date span {
				<?php
				if ( isset( $template_titlecolor ) && '' !== $template_titlecolor ) {
					?>
					color: <?php echo esc_attr( $template_titlecolor ); ?> !important;
				<?php } ?>
			}
			<?php
		}
		if ( 4 == $timeline_style_type ) { 
			?>
			<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl-post-date:before, <?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl-post-date:after {content: '';position: absolute;width: 7%;height: 50%;}
			<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl-post-date:before { top: 0; }
			<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl-post-date:after { bottom: 0; }
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-date { <?php echo isset( $wtl_settings['template_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;' : ''; ?> padding: 5px 10px; }
			@media only screen and (max-width:767px) {
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl-post-date:before, <?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl-post-date:after { left: -7%; }
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl-post-date:before { background: linear-gradient(to bottom right, #fff 0%, #fff 48%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 50%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 100%); }
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl-post-date:after { background: linear-gradient(to top right, #fff 0%, #fff 48%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 50%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 100%); }
			}
			<?php if ( 'left' === $timeline_style_view ) { ?> 
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-title a ,<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-schedule-all-post-content { text-align: left; }
				@media only screen and (min-width:768px) {
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-date:before, <?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-date:after,<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-date:before, <?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-date:after { left: -7%; }
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-date:before,
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-date:before { background: linear-gradient(to bottom right, #fff 0%, #fff 48%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 50%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 100%); }
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-date:after,
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-date:after { background: linear-gradient(to top right, #fff 0%, #fff 48%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 50%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 100%); }
			}
			<?php } elseif ( 'right' === $timeline_style_view ) { ?>
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-title a ,<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-schedule-all-post-content { text-align: right; }
				@media only screen and (min-width:768px) {
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-date:before, <?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-date:after,<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-date:before, <?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-date:after { right: -7%; }
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-date:before,
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-date:before { background: linear-gradient(to bottom left, #fff 0%, #fff 48%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 50%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 100%);  }
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-date:after,
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-date:after { background: linear-gradient(to top left, #fff 0%, #fff 48%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 50%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 100%); }
			}
			<?php } else { ?>
				@media only screen and (min-width:768px) {
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-date:before, <?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-date:after { right: -7%; }
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-date:before, <?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-date:after { left: -7%; }
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-date:before { background: linear-gradient(to bottom left, #fff 0%, #fff 48%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 50%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 100%); }
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-date:after { background: linear-gradient(to top left, #fff 0%, #fff 48%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 50%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 100%); }
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-date:before { background: linear-gradient(to bottom right, #fff 0%, #fff 48%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 50%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 100%); }
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-date:after { background: linear-gradient(to top right, #fff 0%, #fff 48%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 50%, <?php echo isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#000000'; ?> 100%); }
				}
				<?php
			}
		}
		?>
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a{
			<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a:hover,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a:hover{
			<?php echo isset( $wtl_settings['template_fthovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_fthovercolor'] ) : ''; ?>
		}
		/* Timeline Icon Settings */
		<?php echo esc_attr( $layout_id ); ?> .wtl_year,
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl_year span{
			<?php
			$icon_border_radious = isset( $wtl_settings['template_icon_border_radious'] ) ? esc_attr( $wtl_settings['template_icon_border_radious'] ) : '';
			if ( $icon_border_radious < 50 ) {
				echo 'border-radius:' . esc_attr( $icon_border_radious ) . '% !important;';
				?>
				line-height: unset;
				height: unset;
				<?php
			}
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image span {
			<?php echo isset( $wtl_settings['template_icon_border_radious'] ) ? 'border-radius:' . esc_attr( $wtl_settings['template_icon_border_radious'] ) . '% !important' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl_year,
		<?php echo esc_attr( $layout_id ); ?> .wtl_year span,
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap::after {
			<?php echo isset( $wtl_settings['timeline_border_color'] ) ? 'background:' . esc_attr( $wtl_settings['timeline_border_color'] ) . ' !important' : ''; ?>
		}
		/* Line */
		<?php echo esc_attr( $layout_id ); ?> .wtl_year,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image
		{
			<?php echo isset( $wtl_settings['template_color'] ) ? 'border-color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image{
			<?php echo isset( $wtl_settings['template_color'] ) ? 'background-color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap::after{
			<?php echo isset( $wtl_settings['timeline_line_width'] ) ? 'width:' . esc_attr( $wtl_settings['timeline_line_width'] ) . 'px !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl_year::before{
			<?php echo isset( $wtl_settings['timeline_line_width'] ) ? 'height:' . esc_attr( $wtl_settings['timeline_line_width'] ) . 'px !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl_year,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image{
			<?php echo isset( $wtl_settings['timeline_line_width'] ) ? 'border-width:' . esc_attr( $wtl_settings['timeline_line_width'] ) . 'px !important;' : ''; ?>
		}
		<?php
		/* Style Dependency Start --- Check if vertifcle */
		if ( 2 == $wtl_settings['layout_type'] ) { 
			/* ------------------ Style Left ------------------ */
			if ( 'left' === $timeline_style_view ) {
				?>
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap:after{right: unset;left: 30px;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl_year{right: unset;margin: unset;left: 70px;position: relative;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl_year:before{content: '';position: absolute;width: 100%;height: 4px;z-index: 0;border: none;top: 0;bottom: 0;margin: auto 0;left: -40px;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-date{left: 80px !important; margin-bottom: 20px;position: relative;text-align: left}
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image{right: unset;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-all-post-content{float: left !important;margin-left: 80px;}
				<?php echo esc_attr( $layout_id ); ?> .post_even .wtl_post_content_schedule:before{left: -20px;transform: rotate(180deg)}
				<?php if ( 5 == $timeline_style_type ) {  ?>
				@media only screen and (max-width:768px) {
					<?php echo esc_attr( $layout_id ); ?> .wtl-post-date{left:  0 !important; }
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-post-center-image span i {left:0 !important;}
				}
					<?php
				}
			}
			/* ------------------ Style Right ------------------ */
			if ( 'right' === $timeline_style_view ) {
				?>
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap:after{left: unset;right: 30px;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl_year{left: unset;margin: unset;right: 70px;position: relative;float: right;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl_year:before{content: '';position: absolute;width: 100%;height: 4px;z-index: 0;border: none;top: 0;bottom: 0;margin: auto 0;right: -40px;}
				<?php echo esc_attr( $layout_id ); ?> .wtl_dateeicon{text-align: right;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-date{right:  80px !important; margin-bottom: 20px;position: relative;text-align: right;left: unset !important;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image{left: unset;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-all-post-content{float: right !important;margin-right: 80px;}
				<?php echo esc_attr( $layout_id ); ?> .post_even .wtl_post_content_schedule:before{right: -20px;}
				<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl_post_content_schedule:before{left: unset;right: -20px;transform: rotate(180deg)}
				<?php if ( 5 == $timeline_style_type ) {  ?>
					@media only screen and (max-width:768px) {
						<?php echo esc_attr( $layout_id ); ?> .wtl-post-date{right:  0 !important; }
						<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-post-center-image span i {left:0 !important;}
					}
					<?php
				}
			}
			?>
			<?php if ( 'center' === $timeline_style_view ) { ?>
				<?php if ( 4 == $timeline_style_type || 5 == $timeline_style_type ) {  ?>
					<?php if ( isset( $readmore_button_alignment ) && 'left' === $readmore_button_alignment ) { ?>
						<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .post_even .wtl-read-more-div a.wtl-read-more {float: right;}
				<?php } ?>
					<?php if ( isset( $readmore_button_alignment ) && 'right' === $readmore_button_alignment ) { ?>
						<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .post_even .wtl-read-more-div a.wtl-read-more {float: left;}
				<?php } ?>
			<?php } ?>
				<?php
			}
			/* ------------------ Style Compact ------------------ */
			if ( 'minima' === $timeline_style_view ) {
				?>
				<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper {display:flex}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content {overflow:inherit}
				body .wtl-schedule-post-content .wtl-schedule-all-post-content {width: 100%}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap {float:left}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl-post-center-image{
					<?php echo isset( $wtl_settings['timeline_line_width'] ) ? 'border:' . esc_attr( $wtl_settings['timeline_line_width'] ) . 'px  solid !important;' : ''; ?>
				}
				<?php
				if ( 4 == $timeline_style_type || 5 == $timeline_style_type ) { 
					if ( isset( $readmore_button_alignment ) && 'left' === $readmore_button_alignment ) {
						?>
						<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .post_even .wtl-read-more-div a.wtl-read-more {float: right;}
						<?php
					}
					if ( isset( $readmore_button_alignment ) && 'right' === $readmore_button_alignment ) {
						?>
						<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .post_even .wtl-read-more-div a.wtl-read-more {float: left;}
				<?php } ?>
			<?php } ?>
			@media only screen and (max-width: 639px) {
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap:after {margin-left: 0px;}
			}
			@media only screen and (min-width: 640px) {
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content {display: block;position: relative;float: left;clear: left;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even {float: right;clear: right;}
				<?php echo esc_attr( $layout_id ); ?> .blankdiv {float: right;height: 100px;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-center-image {right: -70px;left: unset;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-center-image {left: -70px;right: unset;}
			}
			@media only screen and (min-width: 640px) and (max-width: 767px) {
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content {width: 42%;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-center-image {left: calc(100% - -9%);right: unset;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-center-image {right: calc(100% - -9%);left: unset;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl-schedule-all-post-content {margin-left: 0px !important;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap:after {left: 0px;}
			}
			@media only screen and (min-width: 768px) and (max-width: 991px) {
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-center-image {left: calc(100% - -0%);}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-center-image {right: calc(100% - -0%);}
			}
			@media only screen and (min-width: 640px) and (max-width: 991px) {
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content .wtl-schedule-all-post-content {width: 100% !important;}
				<?php echo esc_attr( $layout_id ); ?> .blankdiv {height: 80px;}
			}
			@media only screen and (min-width: 640px) {
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content {width: 45%;}
			}
			/*Fix title in minima mode */
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-content .wtl-post-title{ background:none !important; <?php echo isset( $wtl_settings['template_titlecolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_titlecolor'] ) . ' !important' : ''; ?>}
			h2.wtl-date-title{
				margin:0 !important;
			}
				<?php /* fix Dot line */ ?>
				<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl-post-center-image:before{
				left: -25px !important; right: unset !important;
			}
			<?php if ( 3 == $timeline_style_type ) {  ?>
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-center-image:before{
					right: -25px; left: unset !important;
				}
			<?php } ?>
				<?php /* Fix arrow issue */ ?>
				<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl_post_content_schedule:before{ right: -20px; left: unset; transform:rotate(180deg)}
				<?php echo esc_attr( $layout_id ); ?> .post_even .wtl_post_content_schedule:before{ left: -20px; right: unset; transform:rotate(180deg)}
				<?php
			}
			if ( 1 == $timeline_style_type ) { 
				?>
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-title, <?php echo esc_attr( $layout_id ); ?> .wtl-post-title a{
					<?php echo isset( $wtl_settings['template_titlecolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_titlecolor'] ) . ' !important' : ''; ?>
				}
				<?php echo esc_attr( $layout_id ); ?> h2.wtl-date-title,
				<?php echo esc_attr( $layout_id ); ?> h2.wtl-date-title a{
					color: #fff !important
				}
				<?php
			}
			/* ------ Classic ------ */
			if ( 2 == $timeline_style_type || 3 == $timeline_style_type ) { 
				?>
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image{ background: none !important }
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image span img,
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image span i {display: none !important;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image span{
					width:20px;height: 20px;border:none;display: block;left: 0;right: 0;top: 0; bottom: 0; margin: auto; position: absolute;
				}
				<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl-post-content p { margin-bottom: 0; }
				<?php
				if ( 2 == $timeline_style_type ) { 
					?>
					<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image { height: auto;<?php echo isset( $wtl_settings['timeline_line_width'] ) ? 'border:' . esc_attr( $wtl_settings['timeline_line_width'] ) . 'px solid;' : ''; ?>}
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content wtl-schedule-all-post-content
					<?php echo esc_attr( $layout_id ); ?> .wtl-post-content .wtl-post-title { margin-bottom: 10px; }
					<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl_post_content_schedule:before {left: -22px;right:unset;}
					<?php echo esc_attr( $layout_id ); ?> .post_even .wtl_post_content_schedule:before {right: -22px;left:unset; }
					<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl-schedule-all-post-content, <?php echo esc_attr( $layout_id ); ?> .post_even .wtl-schedule-all-post-content {border-right: 0px;}
					<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl-schedule-all-post-content { border-top: 5px solid #cd1018;  }
					<?php echo esc_attr( $layout_id ); ?> .post_even .wtl-schedule-all-post-content { border-top: 5px solid #26a61a; }
					<?php echo esc_attr( $layout_id ); ?> .post_even .wtl_post_content_schedule:before { border-color: transparent transparent transparent <?php echo isset( $wtl_settings['template_content_box_bg_color'] ) ? esc_attr( $wtl_settings['template_content_box_bg_color'] ) : '#ffffff'; ?>; }
					<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl_post_content_schedule:before { border-color: transparent <?php echo isset( $wtl_settings['template_content_box_bg_color'] ) ? esc_attr( $wtl_settings['template_content_box_bg_color'] ) : '#ffffff'; ?> transparent transparent; }
					<?php echo esc_attr( $layout_id ); ?> .post_even .wtl_post_content_schedule:before{
						<?php
						if ( 'left' === $timeline_style_view ) {
							echo 'left:-22px;right:unset;';
						} else {
							if ( 2 == $timeline_style_type && 'minima' === $timeline_style_view ) { 
								echo 'left:-22px;right:unset;';
							} else {
								echo 'right:-22px;left:unset;';
							}
						}
						?>
					}
					<?php
					if ( 2 == $timeline_style_type && 'minima' === $timeline_style_view ) { 
						echo esc_attr( $layout_id );
						?>
						.post_odd .wtl_post_content_schedule:before{ right:-22px;left:unset;   }
						<?php
					} else {
						if ( 'right' === $timeline_style_view ) {
							echo esc_attr( $layout_id );
							?>
							.post_odd .wtl_post_content_schedule:before{ right:-22px;left:unset; }
							<?php
						} else {
							echo esc_attr( $layout_id );
							?>
							.post_odd .wtl_post_content_schedule:before{ left:-22px;right:unset;   }
							<?php
						}
					}
					echo esc_attr( $layout_id );
					?>
					.wtl-post-content .wtl-post-title{ background:none !important; <?php echo isset( $wtl_settings['template_titlecolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_titlecolor'] ) . ' !important' : ''; ?>}
					<?php
				}
			}
			/* ------ Elegant ------ */
			if ( 3 == $timeline_style_type || 4 == $timeline_style_type || 5 == $timeline_style_type ) { 
				?>
				<?php echo esc_attr( $layout_id ); ?> .wtl_post_content_schedule:before{display: none !important}
				<?php
				if ( 3 == $timeline_style_type ) { 
					echo esc_attr( $layout_id );
					?>
			.wtl-post-center-image { height: auto;<?php echo isset( $wtl_settings['timeline_line_width'] ) ? 'border:' . esc_attr( $wtl_settings['timeline_line_width'] ) . 'px solid;' : ''; ?>}
					<?php
					if ( 'left' === $timeline_style_view ) {
						?>
				.wtl-post-center-image:before{ right: -24px !important; left: unset !important; }
						<?php
					} elseif ( 'right' === $timeline_style_view ) {
						?>
				.wtl-post-center-image:before{ left: -24px !important; right: unset !important; }
						<?php
					} else {
						echo esc_attr( $layout_id );
						?>
				.post_even .wtl-post-center-image:before{ left: -25px; right: unset;}
						<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl-post-center-image:before{right: -25px; left: unset; }
						<?php
					}
					echo esc_attr( $layout_id );
					?>
			.wtl-post-center-image:before{content:'';position: absolute;width:100%;height: 4px;z-index: 0;border: none;top: 0;margin: auto;bottom: 0;}
					<?php
				}
			}
			/* ------ Clean ------ */
			if ( 4 == $timeline_style_type || 5 == $timeline_style_type ) { 
				?>
				<?php echo esc_attr( $layout_id ); ?> .post_even .wtl-post-title{ color: #f12945 !important; background: none !important;}
				<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl-post-title{ color: #f12945 !important; background: none !important; }
				<?php echo esc_attr( $layout_id ); ?> .post_even .wtl-post-title a{ color: #f12945 !important; text-align: right;}
				<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl-post-title a{ color: #02c5be !important}
				<?php echo esc_attr( $layout_id ); ?> .post_even .wtl-schedule-all-post-content{
					text-align: right;
				}
				<?php
				if ( 5 == $timeline_style_type ) {  ?>
					<?php echo esc_attr( $layout_id ); ?> .post_even .wtl-post-title a,<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl-post-title a{
						padding-left: 0; padding-right: 0;
					}
					<?php
				}
				if ( 4 == $timeline_style_type ) { 
					?>
					@media only screen and (max-width:767px) {
						<?php echo esc_attr( $layout_id ); ?> .wtl_dateeicon {margin-bottom: 30px;}
					}
					<?php
				}
			}
			/* ------ Modern ------ */
			if ( 5 == $timeline_style_type ) { 
				?>
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image span{
			width:20px;height: 20px;border:none;display: block;
			left:auto;right: auto;top: calc(50% - 10px); margin: auto;bottom: 0;
		}
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image{
			background: none !important;
		}
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_even .wtl-post-center-image,
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content.post_odd .wtl-post-center-image {border:solid;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image img,
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image i{
			top:30px;padding: 10px; min-width: 50px; min-height: 50px;
		}
		/* Image / Icons */
				<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl-post-center-image img,
				<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl-post-center-image i{
				<?php
				if ( 'minima' === $timeline_style_view ) {
					echo 'margin-right:0 !important; border: 0px !important;';
				} elseif ( 'left' === $timeline_style_view || 'right' === $timeline_style_view ) {
					echo 'margin-right:0 !important;';
				} else {
					echo 'margin-right:40px !important';
				}
				?>
		}
				<?php echo esc_attr( $layout_id ); ?> .post_even .wtl-post-center-image img,
				<?php echo esc_attr( $layout_id ); ?> .post_even .wtl-post-center-image i{
				<?php
				if ( 'minima' === $timeline_style_view ) {
					echo 'margin-left:0 !important;  border: 0px !important;';
				} else {
					echo 'margin-left:40px !important;';
				}
				?>
		}
		/* Images */
				<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl-post-center-image img{
			background: #02c5be;
		}
				<?php echo esc_attr( $layout_id ); ?> .post_even .wtl-post-center-image img{
			background: #f12945;
		}
				<?php if ( 'minima' === $timeline_style_view ) { ?>
			/* Icons */
					<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl-post-center-image i{
				top:4px !important;
				margin-left: 6px;
			}
					<?php echo esc_attr( $layout_id ); ?> .post_even .wtl-post-center-image i{
				top:4px !important;
			}
		<?php } ?>
				<?php if ( 'center' === $timeline_style_view || 'right' === $timeline_style_view ) { ?>
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-post-center-image span i {
				left: -9px;top: -3px;position: relative;
				}
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-post-center-image span i:before {
					left: 4px;top: -2px;font-size: 22px;position: relative;
				}
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .post_even .wtl-post-center-image img, <?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .post_even .wtl-post-center-image i {
					margin-left: 0 !important;
				}
			<?php } ?>
				<?php if ( 'left' === $timeline_style_view ) { ?>
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-post-center-image span i {
					left: 4px;top: -3px !important;position: relative;
					}
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-post-center-image span i:before {
						left: -8px;top: -2px;font-size: 22px;position: relative;
					}
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .post_even .wtl-post-center-image img, <?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .post_even .wtl-post-center-image i {
						margin-left: 0 !important;
					}
				<?php } ?>
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image span i:before{
					<?php
					if ( 'minima' === $timeline_style_view ) {
						?>
						font-size: 20px;
						<?php
					} elseif ( 'center' === $timeline_style_view || 'right' === $timeline_style_view ) {
						?>
						line-height:50px;font-size:20px;background: none !important;<?php echo isset( $wtl_settings['template_color'] ) ? 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;' : ''; ?>
						<?php
					} else {
						?>
						line-height:50px;font-size:40px;background: none !important;<?php echo isset( $wtl_settings['template_color'] ) ? 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;' : ''; ?>
						<?php
					}
					?>
				}
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-date, <?php echo esc_attr( $layout_id ); ?> .wtl-post-date a{
					position: unset;
					<?php echo isset( $wtl_settings['template_color'] ) ? 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;' : ''; ?>
				}
						<?php
						if ( 'minima' === $timeline_style_view ) {
							?>
							<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image img,
							<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image i{
						min-width: 28px; min-height: 28px;
						border:2px solid;
						top: 50px !important; padding: 3px; line-height: 2px;
					}
							<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl-post-center-image img,
							<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl-post-center-image i{
						margin-right:15px !important;
					}
							<?php
						}
						if ( 'left' === $timeline_style_view ) {
							?>
							<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-post-center-image span i {top: 34px;right: -10px;}
							<?php echo esc_attr( $layout_id ); ?> .post_even.wtl-schedule-post-content .wtl-schedule-all-post-content,<?php echo esc_attr( $layout_id ); ?> .post_even.wtl-schedule-post-content .wtl-post-title a {text-align: left;}
							<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .post_even.wtl-schedule-post-content .wtl-post-title {text-align: left !important;}
					@media only screen and (max-width:767px) {
							<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-post-center-image span i {top: 0;right: -10px;}
							<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-post-center-image span i:before { position:relative;left:6px !important; top:0 !important;}
					}
						<?php } elseif ( 'right' === $timeline_style_view ) { ?>
							<?php echo esc_attr( $layout_id ); ?> .post_odd.wtl-schedule-post-content .wtl-schedule-all-post-content,<?php echo esc_attr( $layout_id ); ?> .post_odd.wtl-schedule-post-content .wtl-post-title a {text-align: right;}
							<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .post_odd.wtl-schedule-post-content .wtl-post-title {text-align: right !important;}
				<?php } else { ?>
							<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-post-center-image span i {position: relative;}
				<?php } ?>
				@media only screen and (max-width:767px) {
					<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-post-center-image span i {left: 0;}
				}
						<?php
			}
			/*------ Minimal ------ */
			if ( 6 == $timeline_style_type ) { 
				?>
				<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap{ width: 100%; display: block; clear: both; float: left; }
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image{ background: none !important }
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image span img,
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image span i {display: none !important;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image span{
					width:20px;height: 20px;border:none;display: block;
					left:auto;right: auto;top: calc(50% - 10px); margin: auto;bottom: 0;
				}
				<?php echo esc_attr( $layout_id ); ?>  h2.wtl-post-title{
					<?php echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) ); ?>
				}
				<?php
			}
			/* Style Dependency End ------------------------------------*/
		}
		/* if Horizental selected */
		if ( 1 == $wtl_settings['layout_type'] ) { 
			if ( 0 == $timeline_style_type ) { 
				?>
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-content, .wtl-post-content p {
					padding: 15px 0 0 0;
				}
			<?php } ?>
			<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtl-ss-right i,
			<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtl-ss-left i{
				<?php echo isset( $wtl_settings['template_color'] ) ? 'color:' . esc_attr( $wtl_settings['template_color'] ) . ';' : ''; ?>
				border:2px solid;width: 25px;height: 25px;text-align: center;vertical-align: middle;line-height: 23px;margin-top: -20px;
			}
			<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .slick-track:before{
				<?php echo isset( $wtl_settings['template_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_color'] ) . '' : ''; ?>
			}
			<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtl-slitem{
				<?php echo isset( $wtl_settings['wp_timeline_content_border_radius'] ) ? 'border-radius:' . esc_attr( $wtl_settings['wp_timeline_content_border_radius'] ) . 'px !important;' : ''; ?>
			}
			<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtl-slitem{
				<?php
				echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
				echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
				echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
				echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
				?>
			}
			<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtl-post-content{
				<?php echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) ); ?>
			}
			<?php
			/* if Default */
			if ( 0 == $timeline_style_type || 1 == $timeline_style_type || 2 == $timeline_style_type || 4 == $timeline_style_type || 5 == $timeline_style_type || 6 == $timeline_style_type ) { 
				?>
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image{ background:none !important;padding:0;width:50px;height:50px; }
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image span{ border:none !important; }
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image span i{ line-height: 30px; }
				<?php
			}
			if ( 4 == $timeline_style_type ) { 
				?>
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image,
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image span{max-width: 30px; max-height: 30px;}
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image span i:before{ top: 0 }

				<?php echo esc_attr( $layout_id ); ?> .slick-current .wtl-post-center-image,
				<?php echo esc_attr( $layout_id ); ?> .slick-current .wtl-post-center-image span{max-width:unset; max-height:unset;}
				<?php echo esc_attr( $layout_id ); ?> .slick-current .wtl-post-center-image span i:before{ top: 10px }
				<?php
			}
			if ( 6 == $timeline_style_type ) { 
				?>
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-content .wtl-post-title{ background:none !important; <?php echo isset( $wtl_settings['template_titlecolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_titlecolor'] ) . ' !important' : ''; ?>}
				<?php echo esc_attr( $layout_id ); ?>  .clayout_skin_6 .post_odd .wtl-post-title a{color: #02c5be}
				<?php echo esc_attr( $layout_id ); ?> .clayout_skin_6 .post_even .wtl-post-title a{color: #f12945}
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-date{
					position: relative !important;text-align: center;right: unset !important;left: unset !important;margin: 0 auto;display: block;width: 100%;top: unset;bottom: unset;
				}
				<?php
			}
		}
		/* fix random issues */
		echo esc_attr( $layout_id );
		?>
		.wtl-post-title{
			<?php echo 0 == $wtl_settings['wp_timeline_post_title_link'] ? 'padding:15px' : '';  ?>
		}
		<?php
		/* --- End Horizental --- */
		echo esc_attr( Wtl_Template_Config::post_date_typography( $wtl_settings, $layout_id ) );
}

/*------------------ Template: Fullhorizontal Layout --------------- */
if ( 'fullhorizontal_layout' === $wp_timeline_theme ) {
	?>
	<?php echo esc_attr( $layout_id ); ?> .wtl-content-fullhorizontal .wtl-post-title 
	{
		<?php if ( isset( $template_title_font_italic ) && 1 == $template_title_font_italic ) { 
				?>
				font-style: <?php echo 'italic !important'; ?>;<?php } 
		else{ ?>
				font-style: <?php echo 'normal !important'; ?>;<?php } ?>
	}

	/* Meta */
	<?php echo esc_attr( $layout_id ); ?> .footer_meta .wtl-post-category span,
		<?php echo esc_attr( $layout_id ); ?> .footer_meta .wtl-post-tags span,
		<?php echo esc_attr( $layout_id ); ?> .post-bottom .post-by span,
		<?php echo esc_attr( $layout_id ); ?> .footer_meta .category-link a,
		<?php echo esc_attr( $layout_id ); ?> .footer_meta .tags a,
		<?php echo esc_attr( $layout_id ); ?> .post-author,
		<?php echo esc_attr( $layout_id ); ?> .post-author a,
		<?php echo esc_attr( $layout_id ); ?> .comment a,
		<?php echo esc_attr( $layout_id ); ?> span.wtl-comment,
		<?php echo esc_attr( $layout_id ); ?> span.wtl-wrapper-like, 
		<?php echo esc_attr( $layout_id ); ?> .posted_by a,
		<?php echo esc_attr( $layout_id ); ?> .post-author .link-lable,
		<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component a ,
		<?php echo esc_attr( $layout_id ); ?> .posted_by a .datetime {
			<?php if ( isset( $meta_font_italic ) && 1 == $meta_font_italic ) { 
				?>
				font-style: <?php echo 'italic !important'; ?>;<?php } 
			else { ?>
				font-style: <?php echo 'normal !important'; ?>;<?php } ?>
			<?php
			echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_family'] ) ? 'font-family:' . esc_attr( $wtl_settings['meta_font_family'] ) . ';' : '';
			echo isset( $wtl_settings['meta_fontsize'] ) ? 'font-size:' . esc_attr( $wtl_settings['meta_fontsize'] ) . 'px;' : '';
			echo isset( $wtl_settings['meta_font_weight'] ) ? 'font-weight:' . esc_attr( $wtl_settings['meta_font_weight'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_line_height'] ) ? 'line-height:' . esc_attr( $wtl_settings['meta_font_line_height'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_text_transform'] ) ? 'text-transform:' . esc_attr( $wtl_settings['meta_font_text_transform'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_text_decoration'] ) ? 'text-decoration:' . esc_attr( $wtl_settings['meta_font_text_decoration'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_letter_spacing'] ) ? 'letter-spacing:' . esc_attr( $wtl_settings['meta_font_letter_spacing'] ) . ';' : '';
			?>
		}
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper{
		<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) : '#fff'; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl_steps_wrap{
		<?php echo isset( $wtl_settings['template_titlecolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_titlecolor'] ) . ' !important;' : ''; ?>
	}
	/* Box */
	<?php echo esc_attr( $layout_id ); ?>  .wtl_steps .wtl_al_slider{
		<?php
		echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> h2.wtl-post-title{
		<?php echo esc_attr( Wtl_Template_Advanced_Layout::content_box_border_radious_title( $wtl_settings ) ); ?>
	}
	<?php
	echo esc_attr( Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_content_color( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
	?>
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_wrap .wtl_steps::before,
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_wrap .wtl_steps:after{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_wrap:before{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_post_format{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'border-color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl_steps .wtl_blog_single_post_wrapp .wtl_steps_post_format:before{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?>.hide_timeline_icon .wtl_steps_post_format:after,
	<?php echo esc_attr( $layout_id ); ?>.hide_timeline_icon .wtl_steps_post_format:before{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	div .wtl_is_horizontal .wtl-ss-right, div .wtl_is_horizontal .wtl-ss-left {
		<?php
		if ( isset( $wtl_settings['navigation_bg_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ' !important;';
		}
		?>
	}
	.wtl_is_horizontal .wtl-ss-right i, .wtl_is_horizontal .wtl-ss-left i {
		<?php
		if ( isset( $wtl_settings['navigation_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['navigation_color'] ) . ';';
		}
		if ( isset( $wtl_settings['navigation_arrow_size'] ) ) {
			echo 'font-size:' . esc_attr( $wtl_settings['navigation_arrow_size'] ) . 'px;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl_steps .wtl_blog_single_post_wrapp .wtl_steps_post_format{
		<?php
		if ( isset( $wtl_settings['template_icon_border_radious'] ) ) {
			echo 'border-radius:' . esc_attr( $wtl_settings['template_icon_border_radious'] ) . '% !important';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a{
		<?php
		$template_ftcolor = isset( $wtl_settings['template_ftcolor'] ) ? $wtl_settings['template_ftcolor'] : '';
		if ( $template_ftcolor ) {
			echo 'color:' . esc_attr( $template_ftcolor ) . ';';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a:hover{
		<?php
		$template_fthovercolor = isset( $wtl_settings['template_fthovercolor'] ) ? $wtl_settings['template_fthovercolor'] : '';
		if ( $template_fthovercolor ) {
			echo 'color:' . esc_attr( $template_fthovercolor ) . ';';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .author a,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a,
	<?php echo esc_attr( $layout_id ); ?> .comments-link,
	<?php echo esc_attr( $layout_id ); ?> .wtl-wrapper-like a{
		<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ' !important;' : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .author a:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a:hover,
	<?php echo esc_attr( $layout_id ); ?> .comments-link:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl-wrapper-like a:hover{
		<?php echo isset( $wtl_settings['template_fthovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_fthovercolor'] ) . ' !important;' : ''; ?>
	}
	<?php
	$border_width = isset( $wtl_settings['wp_timeline_content_border_width'] ) ? $wtl_settings['wp_timeline_content_border_width'] : '';
	$border_style = isset( $wtl_settings['wp_timeline_content_border_style'] ) ? $wtl_settings['wp_timeline_content_border_style'] : '';
	$border_color = isset( $wtl_settings['wp_timeline_content_border_color'] ) ? $wtl_settings['wp_timeline_content_border_color'] : '';
	?>
	<?php echo esc_attr( $layout_id ); ?> #wtl_steps .wtl_blog_template .wtl_blog_single_post_wrapp:before{
		border-top: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
		border-right: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
		<?php echo isset( $wtl_settings['template_content_box_bg_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_content_box_bg_color'] ) : '#fff'; ?>
	}
	<?php
	if ( 1 == $wtl_settings['display_timeline_bar'] ) {?>
		.wtl_is_horizontal .wtl_steps_wrap:before {
			display:none !important;
		}
	<?php } ?>
	<?php 
		if ( isset( $firstletter_big ) && 1 == $firstletter_big ) { 
			$first_letter_line_height = $firstletter_fontsize * 75 / 100;
			?>
			<?php echo esc_attr( $layout_id ); ?> .wtl-content-fullhorizontal .post-content-inner:first-letter {
				<?php
				if ( isset( $firstletter_font_family ) && $firstletter_font_family ) {
					?>
					font-family :<?php echo esc_attr( $firstletter_font_family ); ?>; <?php } ?>
					font-size   : <?php echo esc_attr( $firstletter_fontsize ) . 'px'; ?>;
					color       : <?php echo esc_attr( $firstletter_contentcolor ); ?>;
					margin-right: 5px;
					line-height : <?php echo esc_attr( $first_letter_line_height ) . 'px'; ?>;
					display     : inline-block;
					<?php
					if ( isset( $content_font_text_decoration ) && $content_font_text_decoration ) {
						?>
						text-decoration: <?php echo esc_attr( $content_font_text_decoration ); ?>;
					<?php } ?>
				}
		<?php } 
}


/*------------------ Template: Easy Layout --------------- */
if ( 'easy_layout' === $wp_timeline_theme ) {
	?>
	/* Meta */
	<?php echo esc_attr( $layout_id ); ?> .footer_meta .wtl-post-category span,
		<?php echo esc_attr( $layout_id ); ?> .footer_meta .wtl-post-tags span,
		<?php echo esc_attr( $layout_id ); ?> .post-bottom .post-by span,
		<?php echo esc_attr( $layout_id ); ?> .footer_meta .category-link a,
		<?php echo esc_attr( $layout_id ); ?> .footer_meta .tags a,
		<?php echo esc_attr( $layout_id ); ?> .post-author,<?php echo esc_attr( $layout_id ); ?> .post-author a,<?php echo esc_attr( $layout_id ); ?> .comment a,<?php echo esc_attr( $layout_id ); ?> span.wtl-comment,<?php echo esc_attr( $layout_id ); ?> span.wtl-wrapper-like,<?php echo esc_attr( $layout_id ); ?> .posted_by a,<?php echo esc_attr( $layout_id ); ?> .post-author .link-lable,
		<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component a ,
		<?php echo esc_attr( $layout_id ); ?> .posted_by a .datetime {
			<?php
			echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_family'] ) ? 'font-family:' . esc_attr( $wtl_settings['meta_font_family'] ) . ';' : '';
			echo isset( $wtl_settings['meta_fontsize'] ) ? 'font-size:' . esc_attr( $wtl_settings['meta_fontsize'] ) . 'px;' : '';
			echo isset( $wtl_settings['meta_font_weight'] ) ? 'font-weight:' . esc_attr( $wtl_settings['meta_font_weight'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_line_height'] ) ? 'line-height:' . esc_attr( $wtl_settings['meta_font_line_height'] ) . ';' : '';
			if ( isset($meta_font_italic) && 1 == $meta_font_italic ) { 
				echo 'font-style:italic;';
			} else {
				echo 'font-style:normal;';
			}
			echo isset( $wtl_settings['meta_font_text_transform'] ) ? 'text-transform:' . esc_attr( $wtl_settings['meta_font_text_transform'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_text_decoration'] ) ? 'text-decoration:' . esc_attr( $wtl_settings['meta_font_text_decoration'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_letter_spacing'] ) ? 'letter-spacing:' . esc_attr( $wtl_settings['meta_font_letter_spacing'] ) . ';' : '';
			?>
		}
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper{
		<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) : '#fff'; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl_steps_wrap{
		<?php echo isset( $wtl_settings['template_titlecolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_titlecolor'] ) . ' !important;' : ''; ?>
	}
	/* Box */
	<?php echo esc_attr( $layout_id ); ?>  .wtl_steps .wtl_al_slider{
		<?php
		echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> h2.wtl-post-title{
		<?php echo esc_attr( Wtl_Template_Advanced_Layout::content_box_border_radious_title( $wtl_settings ) ); ?>
	}
	<?php
	echo esc_attr( Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_content_color( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
	?>
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_wrap .wtl_steps::before,
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_wrap .wtl_steps:after{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_wrap:before{
		<?php
		if ( isset( $wtl_settings['navigation_bg_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ' !important;';
		}
		?>
	}
	.wtl_is_horizontal .wtl-ss-right i, .wtl_is_horizontal .wtl-ss-left i {
		<?php
		if ( isset( $wtl_settings['navigation_arrow_size'] ) ) {
			echo 'font-size:' . esc_attr( $wtl_settings['navigation_arrow_size'] ) . 'px;';
		}
		if ( isset( $wtl_settings['navigation_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['navigation_color'] ) . ';';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_post_format{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'border-color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl_steps .wtl_blog_single_post_wrapp .wtl_steps_post_format:before{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?>.hide_timeline_icon .wtl_steps_post_format:after,
	<?php echo esc_attr( $layout_id ); ?>.hide_timeline_icon .wtl_steps_post_format:before{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl_steps .wtl_blog_single_post_wrapp .wtl_steps_post_format{
		<?php
		if ( isset( $wtl_settings['template_icon_border_radious'] ) ) {
			echo 'border-radius:' . esc_attr( $wtl_settings['template_icon_border_radious'] ) . '% !important';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a{
		<?php
		$template_ftcolor = isset( $wtl_settings['template_ftcolor'] ) ? $wtl_settings['template_ftcolor'] : '';
		if ( $template_ftcolor ) {
			echo 'color:' . esc_attr( $template_ftcolor ) . ';';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a:hover{
		<?php
		$template_fthovercolor = isset( $wtl_settings['template_fthovercolor'] ) ? $wtl_settings['template_fthovercolor'] : '';
		if ( $template_fthovercolor ) {
			echo 'color:' . esc_attr( $template_fthovercolor ) . ';';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .author a,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a,
	<?php echo esc_attr( $layout_id ); ?> .comments-link,
	<?php echo esc_attr( $layout_id ); ?> .wtl-wrapper-like a{
		<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ' !important;' : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .author a:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a:hover,
	<?php echo esc_attr( $layout_id ); ?> .comments-link:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl-wrapper-like a:hover{
		<?php echo isset( $wtl_settings['template_fthovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_fthovercolor'] ) . ' !important;' : ''; ?>
	}
	<?php
	$border_width = isset( $wtl_settings['wp_timeline_content_border_width'] ) ? $wtl_settings['wp_timeline_content_border_width'] : '';
	$border_style = isset( $wtl_settings['wp_timeline_content_border_style'] ) ? $wtl_settings['wp_timeline_content_border_style'] : '';
	$border_color = isset( $wtl_settings['wp_timeline_content_border_color'] ) ? $wtl_settings['wp_timeline_content_border_color'] : '';
	?>
	<?php echo esc_attr( $layout_id ); ?> #wtl_steps .wtl_blog_template .wtl_blog_single_post_wrapp:before{
		border-top: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
		border-right: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
		<?php echo isset( $wtl_settings['template_content_box_bg_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_content_box_bg_color'] ) : '#fff'; ?>
	}
	<?php
	if ( 1 == $wtl_settings['display_timeline_bar'] ) {?>
		.wtl_is_horizontal .wtl_steps_wrap:before {
			display:none !important;
		}
	<?php } ?>
	<?php 
		if ( isset( $firstletter_big ) && 1 == $firstletter_big ) { 
			$first_letter_line_height = $firstletter_fontsize * 75 / 100;
			?>
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-content:first-letter {
				<?php
				if ( isset( $firstletter_font_family ) && $firstletter_font_family ) {
					?>
					font-family :<?php echo esc_attr( $firstletter_font_family ); ?>; <?php } ?>
					font-size   : <?php echo esc_attr( $firstletter_fontsize ) . 'px'; ?>;
					color       : <?php echo esc_attr( $firstletter_contentcolor ); ?>;
					margin-right: 5px;
					line-height : <?php echo esc_attr( $first_letter_line_height ) . 'px'; ?>;
					display     : inline-block;
					<?php
					if ( isset( $content_font_text_decoration ) && $content_font_text_decoration ) {
						?>
						text-decoration: <?php echo esc_attr( $content_font_text_decoration ); ?>;
					<?php } ?>
				}
		<?php } 
}

/*------------------ Template: Fullvertical Layout --------------- */
if ( 'fullvertical_layout' === $wp_timeline_theme ) {
	?>
	<?php 
	if ( isset( $firstletter_big ) && 1 == $firstletter_big ) { 
		$first_letter_line_height = $firstletter_fontsize * 75 / 100;
		?>
		<?php echo esc_attr( $layout_id ); ?> .wtl-content-inner:first-letter {
			<?php
			if ( isset( $firstletter_font_family ) && $firstletter_font_family ) {
				?>
				font-family :<?php echo esc_attr( $firstletter_font_family ); ?>; <?php } ?>
				font-size   : <?php echo esc_attr( $firstletter_fontsize ) . 'px'; ?>;
				color       : <?php echo esc_attr( $firstletter_contentcolor ); ?>;
				margin-right: 5px;
				line-height : <?php echo esc_attr( $first_letter_line_height ) . 'px'; ?>;
				display     : inline-block;
				<?php
				if ( isset( $content_font_text_decoration ) && $content_font_text_decoration ) {
					?>
					text-decoration: <?php echo esc_attr( $content_font_text_decoration ); ?>;
				<?php } ?>
			}
	<?php } ?>
	<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl_steps_wrap{
		<?php echo isset( $wtl_settings['template_titlecolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_titlecolor'] ) . ' !important;' : ''; ?>
	}
	/* Box */
	<?php echo esc_attr( $layout_id ); ?>  .wtl_steps .wtl_al_slider{
		<?php
		echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> h2.wtl-post-title{
		<?php echo esc_attr( Wtl_Template_Advanced_Layout::content_box_border_radious_title( $wtl_settings ) ); ?>
	}
	<?php
	echo esc_attr( Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_content_color( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
	?>
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_post_year,
	<?php echo esc_attr( $layout_id ); ?> i.fas.fa-angle-left,
	<?php echo esc_attr( $layout_id ); ?> i.fas.fa-angle-right{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl_steps .wtl_blog_single_post_wrapp .wtl_steps_post_format{
		<?php
		if ( isset( $wtl_settings['template_icon_border_radious'] ) ) {
			echo 'border-radius:' . esc_attr( $wtl_settings['template_icon_border_radious'] ) . '% !important';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a,
	<?php echo esc_attr( $layout_id ); ?> .wtl-wrapper-like a,.bdp-count{
		<?php
		echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ';' : '';
		echo isset( $wtl_settings['meta_font_family'] ) ? 'font-family:' . esc_attr( $wtl_settings['meta_font_family'] ) . ';' : '';
		echo isset( $wtl_settings['meta_fontsize'] ) ? 'font-size:' . esc_attr( $wtl_settings['meta_fontsize'] ) . 'px;' : '';
		echo isset( $wtl_settings['meta_font_weight'] ) ? 'font-weight:' . esc_attr( $wtl_settings['meta_font_weight'] ) . '!important;' : '';
		echo isset( $wtl_settings['meta_font_line_height'] ) ? 'line-height:' . esc_attr( $wtl_settings['meta_font_line_height'] ) . ';' : '';
		if ( isset($meta_font_italic) && 1 == $meta_font_italic ) { 
			echo 'font-style:italic;';
		} else {
			echo 'font-style:normal;';
		}
		echo isset( $wtl_settings['meta_font_text_transform'] ) ? 'text-transform:' . esc_attr( $wtl_settings['meta_font_text_transform'] ) . ';' : '';
		echo isset( $wtl_settings['meta_font_text_decoration'] ) ? 'text-decoration:' . esc_attr( $wtl_settings['meta_font_text_decoration'] ) . ';' : '';
		echo isset( $wtl_settings['meta_font_letter_spacing'] ) ? 'letter-spacing:' . esc_attr( $wtl_settings['meta_font_letter_spacing'] ) . 'px;' : '';
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .fa-comments:before {
		<?php
		$template_ftcolor = isset( $wtl_settings['template_ftcolor'] ) ? $wtl_settings['template_ftcolor'] : '';
		if ( $template_ftcolor ) {
			echo isset( $wtl_settings['meta_fontsize'] ) ? 'font-size:' . esc_attr( $wtl_settings['meta_fontsize'] ) . 'px;' : '';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl-wrapper-like a:hover {
		<?php
		$template_fthovercolor = isset( $wtl_settings['template_fthovercolor'] ) ? $wtl_settings['template_fthovercolor'] : '';
		if ( $template_fthovercolor ) {
			echo 'color:' . esc_attr( $template_fthovercolor ) . ';';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .author a,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a,
	<?php echo esc_attr( $layout_id ); ?> .comments-link{
		<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ' !important;' : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .author a:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a:hover,
	<?php echo esc_attr( $layout_id ); ?> .comments-link:hover{
		<?php echo isset( $wtl_settings['template_fthovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_fthovercolor'] ) . ' !important;' : ''; ?>
	}
	<?php
	$border_width = isset( $wtl_settings['wp_timeline_content_border_width'] ) ? $wtl_settings['wp_timeline_content_border_width'] : '';
	$border_style = isset( $wtl_settings['wp_timeline_content_border_style'] ) ? $wtl_settings['wp_timeline_content_border_style'] : '';
	$border_color = isset( $wtl_settings['wp_timeline_content_border_color'] ) ? $wtl_settings['wp_timeline_content_border_color'] : '';
	?>
	<?php echo esc_attr( $layout_id ); ?> #wtl_steps .wtl_blog_template .wtl_blog_single_post_wrapp:before{
		border-top: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
		border-right: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
		<?php echo isset( $wtl_settings['template_content_box_bg_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_content_box_bg_color'] ) : '#fff'; ?>
	}
	<?php
	if ( 1 == $wtl_settings['display_timeline_bar'] ) {?>
		.wtl_is_horizontal .wtl_steps_wrap:before {
			display:none !important;
		}
	<?php }
}

/*------------------ Template: Attract Layout --------------- */
if ( 'attract_layout' === $wp_timeline_theme ) {
	?>
	/* Meta */
	<?php echo esc_attr( $layout_id ); ?> .footer_meta .wtl-post-category span,
		<?php echo esc_attr( $layout_id ); ?> .footer_meta .wtl-post-tags span,
		<?php echo esc_attr( $layout_id ); ?> .post-bottom .post-by span,
		<?php echo esc_attr( $layout_id ); ?> .footer_meta .category-link a,
		<?php echo esc_attr( $layout_id ); ?> .footer_meta .tags a,
		<?php echo esc_attr( $layout_id ); ?> .post-author,<?php echo esc_attr( $layout_id ); ?> .post-author a,<?php echo esc_attr( $layout_id ); ?> .comment a,<?php echo esc_attr( $layout_id ); ?> span.wtl-comment,<?php echo esc_attr( $layout_id ); ?> span.wtl-wrapper-like,<?php echo esc_attr( $layout_id ); ?> .posted_by a,<?php echo esc_attr( $layout_id ); ?> .post-author .link-lable,
		<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component a ,
		<?php echo esc_attr( $layout_id ); ?> .posted_by a .datetime {
			<?php
			echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_family'] ) ? 'font-family:' . esc_attr( $wtl_settings['meta_font_family'] ) . ';' : '';
			echo isset( $wtl_settings['meta_fontsize'] ) ? 'font-size:' . esc_attr( $wtl_settings['meta_fontsize'] ) . 'px;' : '';
			echo isset( $wtl_settings['meta_font_weight'] ) ? 'font-weight:' . esc_attr( $wtl_settings['meta_font_weight'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_line_height'] ) ? 'line-height:' . esc_attr( $wtl_settings['meta_font_line_height'] ) . ';' : '';
			if ( isset($meta_font_italic) && 1 == $meta_font_italic ) { 
				echo 'font-style:italic;';
			} else {
				echo 'font-style:normal;';
			}
			echo isset( $wtl_settings['meta_font_text_transform'] ) ? 'text-transform:' . esc_attr( $wtl_settings['meta_font_text_transform'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_text_decoration'] ) ? 'text-decoration:' . esc_attr( $wtl_settings['meta_font_text_decoration'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_letter_spacing'] ) ? 'letter-spacing:' . esc_attr( $wtl_settings['meta_font_letter_spacing'] ) . ';' : '';
			?>
		}
	<?php echo esc_attr( $layout_id ); ?> .wtl-attract-post-content span.category-link{
		<?php
		if ( isset( $wtl_settings['template_categorybgcolor'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_categorybgcolor'] );
		}
		?>
	}
	<?php 
	if ( isset( $firstletter_big ) && 1 == $firstletter_big ) { 
		$first_letter_line_height = $firstletter_fontsize * 75 / 100;
		?>
		<?php echo esc_attr( $layout_id ); ?> .wtl-content:first-letter {
			<?php
			if ( isset( $firstletter_font_family ) && $firstletter_font_family ) {
				?>
				font-family :<?php echo esc_attr( $firstletter_font_family ); ?>; <?php } ?>
				font-size   : <?php echo esc_attr( $firstletter_fontsize ) . 'px'; ?>;
				color       : <?php echo esc_attr( $firstletter_contentcolor ); ?>;
				margin-right: 5px;
				line-height : <?php echo esc_attr( $first_letter_line_height ) . 'px'; ?>;
				display     : inline-block;
				<?php
				if ( isset( $content_font_text_decoration ) && $content_font_text_decoration ) {
					?>
					text-decoration: <?php echo esc_attr( $content_font_text_decoration ); ?>;
				<?php } ?>
			}
	<?php } ?>
	/* Box */
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps .wtl_al_slider
	{
		<?php
		echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> span.wtl-post-date{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
    <?php echo esc_attr( $layout_id ); ?> .wtl_steps_post_format{
		<?php
		if ( isset( $wtl_settings['navigation_bg_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-ss-left i:before{
		<?php
		if ( isset( $wtl_settings['navigation_bg_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ' !important;';
		}
		?>
	}
    <?php echo esc_attr( $layout_id ); ?> .wtl-ss-right i:before{
		<?php
		if ( isset( $wtl_settings['navigation_bg_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ' !important;';
		}
		?>
	}
	<?php
	if ( 1 == $wtl_settings['display_timeline_bar'] ) {?>
		.wtl_is_horizontal .wtl_steps_wrap:before {
			display:none !important;
		}
	<?php } ?>
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper{
		<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) : '#fff'; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl_steps_wrap{
		<?php echo isset( $wtl_settings['template_titlecolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_titlecolor'] ) . ' !important;' : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> h2.wtl-post-title{
		<?php echo esc_attr( Wtl_Template_Advanced_Layout::content_box_border_radious_title( $wtl_settings ) ); ?>
	}
	<?php
	echo esc_attr( Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_content_color( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
	?>
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_wrap .wtl_steps::before,
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_wrap .wtl_steps:after{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_wrap:before{
		<?php
		if ( isset( $wtl_settings['navigation_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['navigation_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-ss-right i, 
	<?php echo esc_attr( $layout_id ); ?> .wtl-ss-left i {
		<?php
		if ( isset( $wtl_settings['navigation_arrow_size'] ) ) {
			echo 'font-size:' . esc_attr( $wtl_settings['navigation_arrow_size'] ) . 'px;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-ss-right i:before, 
	<?php echo esc_attr( $layout_id ); ?> .wtl-ss-left i:before {
		<?php
		if ( isset( $wtl_settings['navigation_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['navigation_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_post_format{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'border-color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl_steps .wtl_blog_single_post_wrapp .wtl_steps_post_format:before{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?>.hide_timeline_icon .wtl_steps_post_format:after,
	<?php echo esc_attr( $layout_id ); ?>.hide_timeline_icon .wtl_steps_post_format:before{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl_steps .wtl_blog_single_post_wrapp .wtl_steps_post_format{
		<?php
		if ( isset( $wtl_settings['template_icon_border_radious'] ) ) {
			echo 'border-radius:' . esc_attr( $wtl_settings['template_icon_border_radious'] ) . '% !important';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a{
		<?php
		$template_ftcolor = isset( $wtl_settings['template_ftcolor'] ) ? $wtl_settings['template_ftcolor'] : '';
		if ( $template_ftcolor ) {
			echo 'color:' . esc_attr( $template_ftcolor ) . ';';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a:hover{
		<?php
		$template_fthovercolor = isset( $wtl_settings['template_fthovercolor'] ) ? $wtl_settings['template_fthovercolor'] : '';
		if ( $template_fthovercolor ) {
			echo 'color:' . esc_attr( $template_fthovercolor ) . ';';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .author a,
	<?php echo esc_attr( $layout_id ); ?> .comments-link{
		<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ' !important;' : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .author a:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a:hover,
	<?php echo esc_attr( $layout_id ); ?> .comments-link:hover{
		<?php echo isset( $wtl_settings['template_fthovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_fthovercolor'] ) . ' !important;' : ''; ?>
	}
	<?php
	$border_width = isset( $wtl_settings['wp_timeline_content_border_width'] ) ? $wtl_settings['wp_timeline_content_border_width'] : '';
	$border_style = isset( $wtl_settings['wp_timeline_content_border_style'] ) ? $wtl_settings['wp_timeline_content_border_style'] : '';
	$border_color = isset( $wtl_settings['wp_timeline_content_border_color'] ) ? $wtl_settings['wp_timeline_content_border_color'] : '';
	?>
	<?php echo esc_attr( $layout_id ); ?> #wtl_steps .wtl_blog_template .wtl_blog_single_post_wrapp:before{
		border-top: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
		border-right: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
		<?php echo isset( $wtl_settings['template_content_box_bg_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_content_box_bg_color'] ) : '#fff'; ?>
	}
	<?php
	if ( 1 == $wtl_settings['display_timeline_bar'] ) {?>
		<?php echo esc_attr( $layout_id ); ?> .wtl_is_horizontal .wtl_steps_wrap:before {
			display:none !important;
		}
	<?php }
}

/* Process Info Layout */

if ( 'processinfo_layout' === $wp_timeline_theme ) {
	?>
	<?php echo esc_attr( $layout_id ); ?>.processinfo_layout .wtl-content .wtl-content-inner{
		background-color: <?php echo esc_attr($template_bgcolor); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?>.processinfo_layout .wtl_al_slider .wtl-attract-post-content.slick-slide:nth-child(4n+1){
		background-color: <?php echo esc_attr($template_bgcolor1); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?>.processinfo_layout .wtl_al_slider .wtl-attract-post-content.slick-slide:nth-child(4n+1)::after{
		border-left: 50px solid <?php echo esc_attr($template_bgcolor1); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?>.processinfo_layout .wtl_al_slider .wtl-attract-post-content.slick-slide:nth-child(4n+2)::after{
		border-left: 50px solid <?php echo esc_attr($template_bgcolor2); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?>.processinfo_layout .wtl_al_slider .wtl-attract-post-content.slick-slide:nth-child(4n+3)::after{
		border-left: 50px solid <?php echo esc_attr($template_bgcolor3); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?>.processinfo_layout .wtl_al_slider .wtl-attract-post-content.slick-slide:nth-child(4n+4)::after{
		border-left: 50px solid <?php echo esc_attr($template_bgcolor4); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?>.processinfo_layout .wtl_al_slider .wtl-attract-post-content.slick-slide:nth-child(4n+2){
		background-color: <?php echo esc_attr($template_bgcolor2); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?>.processinfo_layout .wtl_al_slider .wtl-attract-post-content.slick-slide:nth-child(4n+3){
		background-color: <?php echo esc_attr($template_bgcolor3); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?>.processinfo_layout .wtl_al_slider .wtl-attract-post-content.slick-slide:nth-child(4n+4){
		background-color: <?php echo esc_attr($template_bgcolor4); ?>;
	}
	<?php echo esc_attr( $layout_id ); ?>.processinfo_layout .wtl_blog_template .wtl-count {
		color: <?php echo esc_attr($template_title_count_color); ?>;
		font-size: <?php echo esc_attr( $template_title_count_fontsize ) . 'px;' ?>;
	}
	/* Meta */
	<?php echo esc_attr( $layout_id ); ?> .footer_meta .wtl-post-category span,
		<?php echo esc_attr( $layout_id ); ?> .footer_meta .wtl-post-tags span,
		<?php echo esc_attr( $layout_id ); ?> .post-bottom .post-by span,
		<?php echo esc_attr( $layout_id ); ?> .footer_meta .category-link a,
		<?php echo esc_attr( $layout_id ); ?> .footer_meta .tags a,
		<?php echo esc_attr( $layout_id ); ?> .post-author,<?php echo esc_attr( $layout_id ); ?> .post-author a,<?php echo esc_attr( $layout_id ); ?> .comment a,<?php echo esc_attr( $layout_id ); ?> span.wtl-comment,<?php echo esc_attr( $layout_id ); ?> span.wtl-wrapper-like,<?php echo esc_attr( $layout_id ); ?> .posted_by a,<?php echo esc_attr( $layout_id ); ?> .post-author .link-lable,
		<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component a ,
		<?php echo esc_attr( $layout_id ); ?> .posted_by a .datetime {
			<?php
			echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_family'] ) ? 'font-family:' . esc_attr( $wtl_settings['meta_font_family'] ) . ';' : '';
			echo isset( $wtl_settings['meta_fontsize'] ) ? 'font-size:' . esc_attr( $wtl_settings['meta_fontsize'] ) . 'px;' : '';
			echo isset( $wtl_settings['meta_font_weight'] ) ? 'font-weight:' . esc_attr( $wtl_settings['meta_font_weight'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_line_height'] ) ? 'line-height:' . esc_attr( $wtl_settings['meta_font_line_height'] ) . ';' : '';
			if ( isset($meta_font_italic) && 1 == $meta_font_italic ) { 
				echo 'font-style:italic;';
			} else {
				echo 'font-style:normal;';
			}
			echo isset( $wtl_settings['meta_font_text_transform'] ) ? 'text-transform:' . esc_attr( $wtl_settings['meta_font_text_transform'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_text_decoration'] ) ? 'text-decoration:' . esc_attr( $wtl_settings['meta_font_text_decoration'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_letter_spacing'] ) ? 'letter-spacing:' . esc_attr( $wtl_settings['meta_font_letter_spacing'] ) . ';' : '';
			?>
		}
	<?php echo esc_attr( $layout_id ); ?> .wtl-attract-post-content span.category-link{
		<?php
		if ( isset( $wtl_settings['template_categorybgcolor'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_categorybgcolor'] );
		}
		?>
	}
	<?php 
	if ( isset( $firstletter_big ) && 1 == $firstletter_big ) { 
		$first_letter_line_height = $firstletter_fontsize * 75 / 100;
		?>
		<?php echo esc_attr( $layout_id ); ?> .wtl-content:first-letter {
			<?php
			if ( isset( $firstletter_font_family ) && $firstletter_font_family ) {
				?>
				font-family :<?php echo esc_attr( $firstletter_font_family ); ?>; <?php } ?>
				font-size   : <?php echo esc_attr( $firstletter_fontsize ) . 'px'; ?>;
				color       : <?php echo esc_attr( $firstletter_contentcolor ); ?>;
				margin-right: 5px;
				line-height : <?php echo esc_attr( $first_letter_line_height ) . 'px'; ?>;
				display     : inline-block;
				<?php
				if ( isset( $content_font_text_decoration ) && $content_font_text_decoration ) {
					?>
					text-decoration: <?php echo esc_attr( $content_font_text_decoration ); ?>;
				<?php } ?>
			}
	<?php } ?>
	<?php echo esc_attr( $layout_id ); ?> span.wtl-post-date{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
    <?php echo esc_attr( $layout_id ); ?> .wtl_steps_post_format{
		<?php
		if ( isset( $wtl_settings['navigation_bg_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-ss-left i:before{
		<?php
		if ( isset( $wtl_settings['navigation_bg_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ' !important;';
		}
		?>
	}
    <?php echo esc_attr( $layout_id ); ?> .wtl-ss-right i:before{
		<?php
		if ( isset( $wtl_settings['navigation_bg_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ' !important;';
		}
		?>
	}
	<?php
	if ( 1 == $wtl_settings['display_timeline_bar'] ) {?>
		.wtl_is_horizontal .wtl_steps_wrap:before {
			display:none !important;
		}
	<?php } ?>
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper{
		<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) : '#fff'; ?>;
		<?php
		echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl_steps_wrap{
		<?php echo isset( $wtl_settings['template_titlecolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_titlecolor'] ) . ' !important;' : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> h2.wtl-post-title{
		<?php echo esc_attr( Wtl_Template_Advanced_Layout::content_box_border_radious_title( $wtl_settings ) ); ?>
	}
	<?php
	echo esc_attr( Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_content_color( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
	?>
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_wrap .wtl_steps::before,
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_wrap .wtl_steps:after{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_wrap:before{
		<?php
		if ( isset( $wtl_settings['navigation_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['navigation_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-ss-right i, 
	<?php echo esc_attr( $layout_id ); ?> .wtl-ss-left i {
		<?php
		if ( isset( $wtl_settings['navigation_arrow_size'] ) ) {
			echo 'font-size:' . esc_attr( $wtl_settings['navigation_arrow_size'] ) . 'px;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-ss-right i:before, 
	<?php echo esc_attr( $layout_id ); ?> .wtl-ss-left i:before {
		<?php
		if ( isset( $wtl_settings['navigation_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['navigation_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_post_format{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'border-color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl_steps .wtl_blog_single_post_wrapp .wtl_steps_post_format:before{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?>.hide_timeline_icon .wtl_steps_post_format:after,
	<?php echo esc_attr( $layout_id ); ?>.hide_timeline_icon .wtl_steps_post_format:before{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl_steps .wtl_blog_single_post_wrapp .wtl_steps_post_format{
		<?php
		if ( isset( $wtl_settings['template_icon_border_radious'] ) ) {
			echo 'border-radius:' . esc_attr( $wtl_settings['template_icon_border_radious'] ) . '% !important';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a{
		<?php
		$template_ftcolor = isset( $wtl_settings['template_ftcolor'] ) ? $wtl_settings['template_ftcolor'] : '';
		if ( $template_ftcolor ) {
			echo 'color:' . esc_attr( $template_ftcolor ) . ';';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a:hover{
		<?php
		$template_fthovercolor = isset( $wtl_settings['template_fthovercolor'] ) ? $wtl_settings['template_fthovercolor'] : '';
		if ( $template_fthovercolor ) {
			echo 'color:' . esc_attr( $template_fthovercolor ) . ';';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .author a,
	<?php echo esc_attr( $layout_id ); ?> .comments-link{
		<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ' !important;' : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .author a:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a:hover,
	<?php echo esc_attr( $layout_id ); ?> .comments-link:hover{
		<?php echo isset( $wtl_settings['template_fthovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_fthovercolor'] ) . ' !important;' : ''; ?>
	}
	<?php
	$border_width = isset( $wtl_settings['wp_timeline_content_border_width'] ) ? $wtl_settings['wp_timeline_content_border_width'] : '';
	$border_style = isset( $wtl_settings['wp_timeline_content_border_style'] ) ? $wtl_settings['wp_timeline_content_border_style'] : '';
	$border_color = isset( $wtl_settings['wp_timeline_content_border_color'] ) ? $wtl_settings['wp_timeline_content_border_color'] : '';
	?>
	<?php echo esc_attr( $layout_id ); ?> #wtl_steps .wtl_blog_template .wtl_blog_single_post_wrapp:before{
		border-top: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
		border-right: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
		<?php echo isset( $wtl_settings['template_content_box_bg_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_content_box_bg_color'] ) : '#fff'; ?>
	}
	<?php
	if ( 1 == $wtl_settings['display_timeline_bar'] ) {?>
		<?php echo esc_attr( $layout_id ); ?> .wtl_is_horizontal .wtl_steps_wrap:before {
			display:none !important;
		}
	<?php }
}


/*------------------ Template: Divide Layout --------------- */
if ( 'divide_layout' === $wp_timeline_theme ) {
	if ( 1 == $wtl_settings['display_timeline_bar'] ) {?>
		<?php echo esc_attr( $layout_id ); ?> .wtl_steps_wrap:before {
			display:none !important;
		}
	<?php }
	?>
	<?php echo esc_attr( $layout_id ); ?>.divide_layout .wtl-ss-left i,
	<?php echo esc_attr( $layout_id ); ?>.divide_layout .wtl-ss-right i {
		<?php if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?>.divide_layout span.wtl-post-content-ss-right i,
	<?php echo esc_attr( $layout_id ); ?>.divide_layout span.wtl-post-content-ss-left i {
		<?php
		if ( isset( $wtl_settings['navigation_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['navigation_color'] ) . ' !important;';
		}
		if ( isset( $wtl_settings['navigation_bg_color'] ) ) {
			echo 'background-color:' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ' !important;';
		}
		if ( isset( $wtl_settings['navigation_arrow_size'] ) ) {
			echo 'font-size:' . esc_attr( $wtl_settings['navigation_arrow_size'] ) . 'px;';
		}
		?>
	}
	/* Meta */
	<?php echo esc_attr( $layout_id ); ?> .wtl-meta-content,
	<?php echo esc_attr( $layout_id ); ?> .footer_meta .wtl-post-category span,
		<?php echo esc_attr( $layout_id ); ?> .footer_meta .wtl-post-tags span,
		<?php echo esc_attr( $layout_id ); ?> .post-bottom .post-by span,
		<?php echo esc_attr( $layout_id ); ?> .footer_meta .category-link a,
		<?php echo esc_attr( $layout_id ); ?> .footer_meta .tags a,
		<?php echo esc_attr( $layout_id ); ?> .post-author, <?php echo esc_attr( $layout_id ); ?> .post-author a,<?php echo esc_attr( $layout_id ); ?> .comment a,<?php echo esc_attr( $layout_id ); ?> span.wtl-comment,<?php echo esc_attr( $layout_id ); ?> span.wtl-wrapper-like,<?php echo esc_attr( $layout_id ); ?> .posted_by a,<?php echo esc_attr( $layout_id ); ?> .post-author .link-lable,
		<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component a ,
		<?php echo esc_attr( $layout_id ); ?> .posted_by a .datetime {
			<?php
			echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_family'] ) ? 'font-family:' . esc_attr( $wtl_settings['meta_font_family'] ) . ';' : '';
			echo isset( $wtl_settings['meta_fontsize'] ) ? 'font-size:' . esc_attr( $wtl_settings['meta_fontsize'] ) . 'px;' : '';
			echo isset( $wtl_settings['meta_font_weight'] ) ? 'font-weight:' . esc_attr( $wtl_settings['meta_font_weight'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_line_height'] ) ? 'line-height:' . esc_attr( $wtl_settings['meta_font_line_height'] ) . ';' : '';
			if ( isset($meta_font_italic) && 1 == $meta_font_italic ) { 
				echo 'font-style:italic;';
			} else {
				echo 'font-style:normal;';
			}
			echo isset( $wtl_settings['meta_font_text_transform'] ) ? 'text-transform:' . esc_attr( $wtl_settings['meta_font_text_transform'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_text_decoration'] ) ? 'text-decoration:' . esc_attr( $wtl_settings['meta_font_text_decoration'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_letter_spacing'] ) ? 'letter-spacing:' . esc_attr( $wtl_settings['meta_font_letter_spacing'] ) . ';' : '';
			?>
		}
	<?php echo esc_attr( $layout_id ); ?> .wtl-divide-post-content .wtl-post-title 
	{
		<?php if ( isset( $template_title_font_italic ) && 1 == $template_title_font_italic ) { 
				?>
				font-style: <?php echo 'italic !important'; ?>;<?php } 
		else{ ?>
				font-style: <?php echo 'normal !important'; ?>;<?php } ?>
	}
	<?php 
	if ( isset( $firstletter_big ) && 1 == $firstletter_big ) { 
		$first_letter_line_height = $firstletter_fontsize * 75 / 100;
		?>
		<?php echo esc_attr( $layout_id ); ?> .wtl-divide-content:first-letter {
			<?php
			if ( isset( $firstletter_font_family ) && $firstletter_font_family ) {
				?>
				font-family :<?php echo esc_attr( $firstletter_font_family ); ?>; <?php } ?>
				font-size   : <?php echo esc_attr( $firstletter_fontsize ) . 'px'; ?>;
				color       : <?php echo esc_attr( $firstletter_contentcolor ); ?>;
				margin-right: 5px;
				line-height : <?php echo esc_attr( $first_letter_line_height ) . 'px'; ?>;
				display     : inline-block;
				<?php
				if ( isset( $content_font_text_decoration ) && $content_font_text_decoration ) {
					?>
					text-decoration: <?php echo esc_attr( $content_font_text_decoration ); ?>;
				<?php } ?>
			}
	<?php } ?>
	<?php echo esc_attr( $layout_id ); ?> .wtl-divide-post-content.slick-slide.slick-current.slick-active {
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_post_format i:before {
			<?php echo isset( $wtl_settings['template_icon_border_radious'] ) ? 'border-radius:' . esc_attr( $wtl_settings['template_icon_border_radious'] ) . '% !important' : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_wrap:before{
		<?php
		if ( isset( $wtl_settings['navigation_bg_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_post_format i:before{
		<?php
		if ( isset( $wtl_settings['navigation_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['navigation_color'] ) . ' !important;';
		}if ( isset( $wtl_settings['navigation_bg_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> span.wtl_steps_post_year:hover{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-content:after{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'border-color: transparent' . esc_attr( $wtl_settings['template_bgcolor'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> span.wtl-post-content-ss-left i:hover,
    <?php echo esc_attr( $layout_id ); ?> span.wtl-post-content-ss-right i:hover{
		<?php
		if ( isset( $wtl_settings['navigation_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['navigation_color'] ) . ' !important;';
		}
		if ( isset( $wtl_settings['navigation_bg_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-ss-right i{
		<?php
		if ( isset( $wtl_settings['navigation_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['navigation_color'] ) . ' !important;';
		}
		if ( isset( $wtl_settings['navigation_arrow_size'] ) ) {
			echo 'font-size:' . esc_attr( $wtl_settings['navigation_arrow_size'] ) . 'px;';
		}
		?>
	}
    <?php echo esc_attr( $layout_id ); ?> .wtl-ss-left i{
		<?php
		if ( isset( $wtl_settings['navigation_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['navigation_color'] ) . ' !important;';
		}
		if ( isset( $wtl_settings['navigation_arrow_size'] ) ) {
			echo 'font-size:' . esc_attr( $wtl_settings['navigation_arrow_size'] ) . 'px;';
		}
		?>
	}
    <?php echo esc_attr( $layout_id ); ?> span.wtl-post-content-ss-right i:hover{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			//echo 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
    <?php echo esc_attr( $layout_id ); ?> span.wtl-post-content-ss-left i:hover {
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			//echo 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> span.wtl-ss-right.slick-arrow,span.wtl-ss-left.slick-arrow{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
    <?php echo esc_attr( $layout_id ); ?> span.wtl-ss-left.slick-arrow{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wtl-post-content{
		<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) : '#fff'; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl_steps_wrap{
		<?php echo isset( $wtl_settings['template_titlecolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_titlecolor'] ) . ' !important;' : ''; ?>
	}
	/* Box */
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps .wtl_al_slider
	{
		<?php
		echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> h2.wtl-post-title{
		<?php echo esc_attr( Wtl_Template_Advanced_Layout::content_box_border_radious_title( $wtl_settings ) ); ?>
	}
	<?php
	echo esc_attr( Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_content_color( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
	?>
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_wrap .wtl_steps::before,
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_wrap .wtl_steps:after{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl_steps .wtl_blog_single_post_wrapp .wtl_steps_post_format:before{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl_steps .wtl_blog_single_post_wrapp .wtl_steps_post_format{
		<?php
		if ( isset( $wtl_settings['template_icon_border_radious'] ) ) {
			echo 'border-radius:' . esc_attr( $wtl_settings['template_icon_border_radious'] ) . '% !important';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a{
		<?php
		$template_ftcolor = isset( $wtl_settings['template_ftcolor'] ) ? $wtl_settings['template_ftcolor'] : '';
		if ( $template_ftcolor ) {
			echo 'color:' . esc_attr( $template_ftcolor ) . ';';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a:hover{
		<?php
		$template_fthovercolor = isset( $wtl_settings['template_fthovercolor'] ) ? $wtl_settings['template_fthovercolor'] : '';
		if ( $template_fthovercolor ) {
			echo 'color:' . esc_attr( $template_fthovercolor ) . ';';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .author a,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a,
	<?php echo esc_attr( $layout_id ); ?> .comments-link{
		<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ' !important;' : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .author a:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a:hover,
	<?php echo esc_attr( $layout_id ); ?> .comments-link:hover{
		<?php echo isset( $wtl_settings['template_fthovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_fthovercolor'] ) . ' !important;' : ''; ?>
	}
	<?php
	$border_width = isset( $wtl_settings['wp_timeline_content_border_width'] ) ? $wtl_settings['wp_timeline_content_border_width'] : '';
	$border_style = isset( $wtl_settings['wp_timeline_content_border_style'] ) ? $wtl_settings['wp_timeline_content_border_style'] : '';
	$border_color = isset( $wtl_settings['wp_timeline_content_border_color'] ) ? $wtl_settings['wp_timeline_content_border_color'] : '';
	?>
	<?php echo esc_attr( $layout_id ); ?> #wtl_steps .wtl_blog_template .wtl_blog_single_post_wrapp:before{
		border-top: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
		border-right: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
		<?php echo isset( $wtl_settings['template_content_box_bg_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_content_box_bg_color'] ) : '#fff'; ?>
	}
	<?php
}
/*------------------ Template: Divide Top Layout --------------- */
if ( 'topdivide_layout' === $wp_timeline_theme ) {
	if ( 1 == $wtl_settings['display_timeline_bar'] ) {?>
		.wtl_steps_wrap:before {
			display:none !important;
		}
	<?php }
	?>
	<?php echo esc_attr( $layout_id ); ?>.top_divide_layout .wtl-ss-right i,
	<?php echo esc_attr( $layout_id ); ?>.top_divide_layout .wtl-ss-left i {
		<?php
		if ( isset( $wtl_settings['navigation_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['navigation_color'] ) . ' !important;';
		}
		if ( isset( $wtl_settings['navigation_arrow_size'] ) ) {
			echo 'font-size:' . esc_attr( $wtl_settings['navigation_arrow_size'] ) . 'px;';
		}
		?>
	}
    
	/* Meta */
	<?php echo esc_attr( $layout_id ); ?> .footer_meta .wtl-post-category span,
		<?php echo esc_attr( $layout_id ); ?> .footer_meta .wtl-post-tags span,
		<?php echo esc_attr( $layout_id ); ?> .post-bottom .post-by span,
		<?php echo esc_attr( $layout_id ); ?> .footer_meta .category-link a,
		<?php echo esc_attr( $layout_id ); ?> .footer_meta .tags a,
		<?php echo esc_attr( $layout_id ); ?> .post-author,.post-author a,.comment a,span.wtl-comment,span.wtl-wrapper-like,.posted_by a, .post-author .link-lable,
		<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component a ,
		<?php echo esc_attr( $layout_id ); ?> .posted_by a .datetime {
			<?php
			echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_family'] ) ? 'font-family:' . esc_attr( $wtl_settings['meta_font_family'] ) . ';' : '';
			echo isset( $wtl_settings['meta_fontsize'] ) ? 'font-size:' . esc_attr( $wtl_settings['meta_fontsize'] ) . 'px;' : '';
			echo isset( $wtl_settings['meta_font_weight'] ) ? 'font-weight:' . esc_attr( $wtl_settings['meta_font_weight'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_line_height'] ) ? 'line-height:' . esc_attr( $wtl_settings['meta_font_line_height'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_text_transform'] ) ? 'text-transform:' . esc_attr( $wtl_settings['meta_font_text_transform'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_text_decoration'] ) ? 'text-decoration:' . esc_attr( $wtl_settings['meta_font_text_decoration'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_letter_spacing'] ) ? 'letter-spacing:' . esc_attr( $wtl_settings['meta_font_letter_spacing'] ) . ';' : '';
			?>
		}

	<?php echo esc_attr( $layout_id ); ?> .wtl-meta-content
	{
		<?php if ( 1 == $wtl_settings[ 'meta_font_italic'] ) 
		{ ?>
			<?php echo 'font-style: italic !important;'; ?>
		<?php } 
		else{?>
			<?php echo 'font-style: normal !important;'; ?>
		<?php }?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-main-social-cat-content {
		<?php if ( 1 == $wtl_settings[ 'display_category'] || 1 == $wtl_settings[ 'social_share'] ) { ?>
			<?php echo 'background:' . esc_attr( $template_categorybgcolor ) . ' !important;'; ?>
		<?php } ?>
    }
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_post_format i:before {
			<?php echo isset( $wtl_settings['template_icon_border_radious'] ) ? 'border-radius:' . esc_attr( $wtl_settings['template_icon_border_radious'] ) . '% !important' : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_wrap:before{
		<?php
		if ( isset( $wtl_settings['navigation_bg_color'] ) ) {
			echo 'border: 2px dotted ' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_post_format i:before{
		<?php
		if ( isset( $wtl_settings['navigation_bg_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ' !important;';
		}
		if ( isset( $wtl_settings['navigation_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['navigation_color'] ) . ';';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> span.wtl_steps_post_year:hover{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> span.wtl-post-content-ss-left i {
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
    <?php echo esc_attr( $layout_id ); ?> span.wtl-post-content-ss-right i{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-comment i,
	<?php echo esc_attr( $layout_id ); ?> .wtl-author i, 
	<?php echo esc_attr( $layout_id ); ?> .wtl-comment i, 
	<?php echo esc_attr( $layout_id ); ?> .wtl_comment_count a,
	<?php echo esc_attr( $layout_id ); ?> span.wtl-post-date i:before {
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
   
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a {
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-ss-right i {
		<?php
		if ( isset( $wtl_settings['navigation_bg_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ' !important;';
		}
		if ( isset( $wtl_settings['navigation_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['navigation_color'] ) . ';';
		}
		if ( isset( $wtl_settings['navigation_arrow_size'] ) ) {
			echo 'font-size:' . esc_attr( $wtl_settings['navigation_arrow_size'] ) . 'px;';
		}
		?>
	}
    <?php echo esc_attr( $layout_id ); ?> .wtl-ss-left i {
		<?php
		if ( isset( $wtl_settings['navigation_bg_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ' !important;';
		}
		if ( isset( $wtl_settings['navigation_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['navigation_color'] ) . ';';
		}
		if ( isset( $wtl_settings['navigation_arrow_size'] ) ) {
			echo 'font-size:' . esc_attr( $wtl_settings['navigation_arrow_size'] ) . 'px;';
		}
		?>
	}
	
	<?php echo esc_attr( $layout_id ); ?> span.wtl-ss-right.slick-arrow {
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
			
		}
		?>
	}
    <?php echo esc_attr( $layout_id ); ?> span.wtl-ss-left.slick-arrow{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
			
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wtl-divide-post-content{
		<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) : '#fff'; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl_steps_wrap{
		<?php echo isset( $wtl_settings['template_titlecolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_titlecolor'] ) . ' !important;' : ''; ?>
	}
	/* Box */
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps .wtl_al_slider
	{
		<?php
		echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> h2.wtl-post-title{
		<?php echo esc_attr( Wtl_Template_Advanced_Layout::content_box_border_radious_title( $wtl_settings ) ); ?>
	}
	<?php
	echo esc_attr( Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_content_color( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
	?>
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_wrap .wtl_steps::before,
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_wrap .wtl_steps:after{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl_steps .wtl_blog_single_post_wrapp .wtl_steps_post_format:before{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl_steps .wtl_blog_single_post_wrapp .wtl_steps_post_format{
		<?php
		if ( isset( $wtl_settings['template_icon_border_radious'] ) ) {
			echo 'border-radius:' . esc_attr( $wtl_settings['template_icon_border_radious'] ) . '% !important';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a{
		<?php
		$template_ftcolor = isset( $wtl_settings['template_ftcolor'] ) ? $wtl_settings['template_ftcolor'] : '';
		if ( $template_ftcolor ) {
			echo 'color:' . esc_attr( $template_ftcolor ) . ';';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a:hover{
		<?php
		$template_fthovercolor = isset( $wtl_settings['template_fthovercolor'] ) ? $wtl_settings['template_fthovercolor'] : '';
		if ( $template_fthovercolor ) {
			echo 'color:' . esc_attr( $template_fthovercolor ) . ';';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .author a,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a,
	<?php echo esc_attr( $layout_id ); ?> .comments-link{
		<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ' !important;' : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .author a:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a:hover,
	<?php echo esc_attr( $layout_id ); ?> .comments-link:hover{
		<?php echo isset( $wtl_settings['template_fthovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_fthovercolor'] ) . ' !important;' : ''; ?>
	}
	<?php
	$border_width = isset( $wtl_settings['wp_timeline_content_border_width'] ) ? $wtl_settings['wp_timeline_content_border_width'] : '';
	$border_style = isset( $wtl_settings['wp_timeline_content_border_style'] ) ? $wtl_settings['wp_timeline_content_border_style'] : '';
	$border_color = isset( $wtl_settings['wp_timeline_content_border_color'] ) ? $wtl_settings['wp_timeline_content_border_color'] : '';
	?>
	<?php echo esc_attr( $layout_id ); ?> #wtl_steps .wtl_blog_template .wtl_blog_single_post_wrapp:before{
		border-top: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
		border-right: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
		<?php echo isset( $wtl_settings['template_content_box_bg_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_content_box_bg_color'] ) : '#fff'; ?>
	}
	<?php
}
/*------------------ Template: Year Layout --------------- */
if ( 'year_layout' === $wp_timeline_theme ) {
	$template_content_box_bg_color = isset( $wtl_settings['template_content_box_bg_color'] ) ? $wtl_settings['template_content_box_bg_color'] : '#fff';
	?>
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper{
		<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) . ' !important' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .wtl_blog_single_post_wrapp:after{
			<?php
			if ( $template_color ) {
				echo 'background:' . esc_attr( $template_color ) . ' !important';  }
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl_year span,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-date:after,
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap:after,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-date span{
			<?php echo isset( $wtl_settings['template_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-content{
			<?php echo isset( $wtl_settings['template_color'] ) ? 'border-left-color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl_blog_single_post_wrapp:nth-child(odd) .wtl-post-inner-content .wtl-post-content{
			<?php echo isset( $wtl_settings['template_color'] ) ? 'border-right-color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-read-more-div{overflow:hidden;}
		<?php echo esc_attr( $layout_id ); ?> .wp-timeline-load-more-pre,
		<?php echo esc_attr( $layout_id ); ?> .wp-timeline-load-more{z-index: 3;position: relative}
		<?php echo esc_attr( $layout_id ); ?> #wtl-load-more-hidden{ float:none; }
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl_steps_wrap{
		<?php
		if ( isset( $wtl_settings['template_titlecolor'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['template_titlecolor'] ) . ' !important;';
		}
		?>
		}
	   
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-content{
		<?php
		echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
		?>
		}
		<?php
		echo esc_attr( Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::post_content_color( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
		?>
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-content{
		<?php
		echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) );
		?>
		}

		<?php echo esc_attr( $layout_id ); ?> #wtl_year_layout .wtl_year span,
		<?php echo esc_attr( $layout_id ); ?> #wtl_year_layout .wtl-post-date span,
		<?php echo esc_attr( $layout_id ); ?> #wtl_year_layout .wtl-schedule-wrap .wtl-post-date::after,
		<?php echo esc_attr( $layout_id ); ?> #wtl_year_layout .wtl-schedule-wrap:after
		{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
		}
		<?php echo esc_attr( $layout_id ); ?> #wtl_year_layout .wtl-post-content{
			<?php
			if ( isset( $wtl_settings['template_color'] ) ) {
				echo 'border-color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
			}
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a{
		<?php
		$template_ftcolor = isset( $wtl_settings['template_ftcolor'] ) ? $wtl_settings['template_ftcolor'] : '';
		if ( $template_ftcolor ) {
			echo 'color:' . esc_attr( $template_ftcolor ) . ';';
		}
		?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a:hover,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a:hover{
		<?php
		$template_fthovercolor = isset( $wtl_settings['template_fthovercolor'] ) ? $wtl_settings['template_fthovercolor'] : '';
		if ( $template_fthovercolor ) {
			echo 'color:' . esc_attr( $template_fthovercolor ) . ';';
		}
		?>
		}
		<?php echo esc_attr( $layout_id ); ?> #wtl_year_layout .wtl-post-content{
			<?php
			if ( $template_content_box_bg_color ) {
				echo 'background:' . esc_attr( $template_content_box_bg_color ) . ';';
			}
			echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
			?>
		}
		<?php
		echo esc_attr( Wtl_Template_Config::post_date_typography( $wtl_settings, $layout_id ) );
}

/* ------------------ Template: Story Layout --------------- */
if ( 'story_layout' === $wp_timeline_theme ) {
	$template_color                     = isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#fff';
	$template_bgcolor                   = isset( $wtl_settings['template_bgcolor'] ) ? $wtl_settings['template_bgcolor'] : '#fff';
	$template_content_box_bg_color = isset( $wtl_settings['template_content_box_bg_color'] ) ? $wtl_settings['template_content_box_bg_color'] : '#fff';
	?>
	<?php echo esc_attr( $layout_id ); ?>{
		<?php
		if ( $template_bgcolor ) {
			echo 'background:' . esc_attr( $template_bgcolor ) . ';';
		}
		?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-read-more-div{overflow:hidden;}
		<?php echo esc_attr( $layout_id ); ?> .wp-timeline-load-more-pre,
		<?php echo esc_attr( $layout_id ); ?> .wp-timeline-load-more{z-index: 3;position: relative}
		<?php echo esc_attr( $layout_id ); ?> #wtl-load-more-hidden{ float:none; }

		<?php if ( isset( $template_title_alignment ) && 'left' === $template_title_alignment ) { ?>
			<?php echo esc_attr( $layout_id ); ?> .story .entity-content-right .wtl-post-title {
				text-align: right !important;
			}
		<?php } ?>
		<?php if ( isset( $template_title_alignment ) && 'right' === $template_title_alignment ) { ?>
			<?php echo esc_attr( $layout_id ); ?> .story .entity-content-right .wtl-post-title {
				text-align: left !important;
			}
			<?php
		}
		if ( isset( $read_more_on ) && isset( $readmore_button_alignment ) && 2 == $read_more_on && 'right' === $readmore_button_alignment ) { 
			?>
			<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .entity-content-right .wtl-read-more-div a.wtl-read-more {
				float: left;
			}
			<?php
		}
		if ( isset( $read_more_on ) && isset( $readmore_button_alignment ) && 2 == $read_more_on && 'left' === $readmore_button_alignment ) { 
			?>
			<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .entity-content-right .wtl-read-more-div a.wtl-read-more {
				float: right;
			}
			<?php
		}
		?>
	   
		<?php
		echo esc_attr( Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::post_content_color( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
		?>
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-content{
		<?php
		echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) );
		?>
		}
		<?php echo esc_attr( $layout_id ); ?>  .wtl-post-content{
			<?php
			if ( isset( $wtl_settings['template_color'] ) ) {
				echo 'border-color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
			}
			?>
		} 
		#wtl_story_layout<?php echo esc_attr( $layout_id ); ?>  .author a,
		#wtl_story_layout<?php echo esc_attr( $layout_id ); ?>  .post-comment a,
		#wtl_story_layout<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a,
		#wtl_story_layout<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a{
		<?php
		echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) : '';
		?>

		}
		#wtl_story_layout<?php echo esc_attr( $layout_id ); ?> .author a:hover,
		#wtl_story_layout<?php echo esc_attr( $layout_id ); ?>  .post-comment a:hover,
		#wtl_story_layout<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a:hover,
		#wtl_story_layout<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a:hover{
		<?php
		echo isset( $wtl_settings['template_fthovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_fthovercolor'] ) : '';
		?>
		}
		<?php echo esc_attr( $layout_id ); ?>  .wtl-post-content{
			<?php
			if ( $template_content_box_bg_color ) {
				echo 'background:' . esc_attr( $template_content_box_bg_color ) . ';';
			}
			echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
			?>
		}

		/* Timeline Color */
		/*odd*/
		<?php echo esc_attr( $layout_id ); ?> .line-col-top, <?php echo esc_attr( $layout_id ); ?> .date-icon-rights {
			<?php echo isset( $wtl_settings['template_color2'] ) ? 'background:' . esc_attr( $wtl_settings['template_color2'] ) . ' !important;' : ' '; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .line-col-right{
			<?php echo isset( $wtl_settings['template_color2'] ) ? 'border-color:' . esc_attr( $wtl_settings['template_color2'] ) . ' !important;' : ' '; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .date-icon-rights:after{
			<?php echo isset( $wtl_settings['template_color2'] ) ? 'border-top-color:' . esc_attr( $wtl_settings['template_color2'] ) . ' !important;' : ' '; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> span.left-year, <?php echo esc_attr( $layout_id ); ?> .date-icon-rights{
			<?php echo isset( $wtl_settings['template_color4'] ) ? 'color:' . esc_attr( $wtl_settings['template_color4'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> span.startup{
			<?php echo isset( $wtl_settings['story_start_bg_color'] ) ? 'background:' . esc_attr( $wtl_settings['story_start_bg_color'] ) . ' !important;' : ''; ?>
			<?php echo isset( $wtl_settings['story_start_text_color'] ) ? 'color:' . esc_attr( $wtl_settings['story_start_text_color'] ) . ' !important;' : ''; ?>
		}
		/*even*/
		<?php echo esc_attr( $layout_id ); ?> .line-col-bottom-secound, <?php echo esc_attr( $layout_id ); ?> .date-icon-left{
			<?php echo isset( $wtl_settings['template_color3'] ) ? 'background:' . esc_attr( $wtl_settings['template_color3'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .line-col-left{
			<?php echo isset( $wtl_settings['template_color3'] ) ? 'border-color:' . esc_attr( $wtl_settings['template_color3'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .date-icon-left:after{
			<?php echo isset( $wtl_settings['template_color3'] ) ? 'border-top-color:' . esc_attr( $wtl_settings['template_color3'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> span.right-year, <?php echo esc_attr( $layout_id ); ?> .date-icon-left{
			<?php echo isset( $wtl_settings['template_color5'] ) ? 'color:' . esc_attr( $wtl_settings['template_color5'] ) . ' !important' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> span.right_ending{
			<?php echo isset( $wtl_settings['story_ending_bg_color'] ) ? 'background:' . esc_attr( $wtl_settings['story_ending_bg_color'] ) . ' !important;' : ''; ?>
			<?php echo isset( $wtl_settings['story_ending_text_color'] ) ? 'color:' . esc_attr( $wtl_settings['story_ending_text_color'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category .category-link .link-lable,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category .category-link a {
			background: <?php echo $template_categorybgcolor; ?> !important;
			padding: 4px 10px;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category {
			background: transparent !important;
		}
		<?php
}

/* ------------------ Template: Full Width Layout --------------- */
if ( 'fullwidth_layout' === $wp_timeline_theme ) {
	$template_color                     = isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#fff';
	$template_content_box_bg_color = isset( $wtl_settings['template_content_box_bg_color'] ) ? $wtl_settings['template_content_box_bg_color'] : '#fff';
	?>
	<?php echo esc_attr( $layout_id ); ?>{
		<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) : '#fff'; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-read-more-div{overflow:hidden;}
		<?php echo esc_attr( $layout_id ); ?> .wp-timeline-load-more-pre,
		<?php echo esc_attr( $layout_id ); ?> .wp-timeline-load-more{z-index: 3;position: relative}
		<?php echo esc_attr( $layout_id ); ?> #wtl-load-more-hidden{ float:none; }
		<?php
		echo esc_attr( Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::post_content_color( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
		?>
		<?php echo esc_attr( $layout_id ); ?> .wtl-author a,
		<?php echo esc_attr( $layout_id ); ?> .post-comment a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-meta-comment i,
		<?php echo esc_attr( $layout_id ); ?> a.comments-link
		{
		<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-author a:hover,
		<?php echo esc_attr( $layout_id ); ?> .post-comment a:hover,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a:hover,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a:hover,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a:hover,
		<?php echo esc_attr( $layout_id ); ?> .wtl-meta-comment i:hover,
		<?php echo esc_attr( $layout_id ); ?> a.comments-link:hover
		{
		<?php echo isset( $wtl_settings['template_fthovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_fthovercolor'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-content{
		<?php echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) ); ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-content{
		<?php
		if ( $template_content_box_bg_color ) {
			echo 'background:' . esc_attr( $template_content_box_bg_color ) . ';';
		}
		?>
		}
		/* Box */
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-schedule-post-content{
			<?php
			echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
			?>
		}
		/* BG Color -------------- */
		<?php if ( ! empty( $template_bgcolor1 ) && ! empty( $template_bgcolor2 ) && empty( $template_bgcolor3 ) && empty( $template_bgcolor4 ) && empty( $template_bgcolor5 ) && empty( $template_bgcolor6 ) ) { ?>
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-schedule-post-content:nth-child(2n+1){
			background: <?php echo esc_attr( $template_bgcolor1 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-schedule-post-content:nth-child(2n+2){
			background: <?php echo esc_attr( $template_bgcolor2 ); ?>;
		}
	<?php } ?>
	<?php if ( ! empty( $template_bgcolor1 ) && ! empty( $template_bgcolor2 ) && ! empty( $template_bgcolor3 ) && empty( $template_bgcolor4 ) && empty( $template_bgcolor5 ) && empty( $template_bgcolor6 ) ) { ?>
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-schedule-post-content:nth-child(3n+1){
			background: <?php echo esc_attr( $template_bgcolor1 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-schedule-post-content:nth-child(3n+2){
			background: <?php echo esc_attr( $template_bgcolor2 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-schedule-post-content:nth-child(3n+3){
			background: <?php echo esc_attr( $template_bgcolor3 ); ?>;
		}
	<?php } ?>
	<?php if ( ! empty( $template_bgcolor1 ) && ! empty( $template_bgcolor2 ) && ! empty( $template_bgcolor3 ) && ! empty( $template_bgcolor4 ) && empty( $template_bgcolor5 ) && empty( $template_bgcolor6 ) ) { ?>
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-schedule-post-content:nth-child(4n+1){
			background: <?php echo esc_attr( $template_bgcolor1 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-schedule-post-content:nth-child(4n+2){
			background: <?php echo esc_attr( $template_bgcolor2 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-schedule-post-content:nth-child(4n+3){
			background: <?php echo esc_attr( $template_bgcolor3 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-schedule-post-content:nth-child(4n+4){
			background: <?php echo esc_attr( $template_bgcolor4 ); ?>;
		}
	<?php } ?>
	<?php if ( ! empty( $template_bgcolor1 ) && ! empty( $template_bgcolor2 ) && ! empty( $template_bgcolor3 ) && ! empty( $template_bgcolor4 ) && ! empty( $template_bgcolor5 ) && empty( $template_bgcolor6 ) ) { ?>
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-schedule-post-content:nth-child(5n+1){
			background: <?php echo esc_attr( $template_bgcolor1 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-schedule-post-content:nth-child(5n+2){
			background: <?php echo esc_attr( $template_bgcolor2 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-schedule-post-content:nth-child(5n+3){
			background: <?php echo esc_attr( $template_bgcolor3 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-schedule-post-content:nth-child(5n+4){
			background: <?php echo esc_attr( $template_bgcolor4 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-schedule-post-content:nth-child(5n+5){
			background: <?php echo esc_attr( $template_bgcolor5 ); ?>;
		}
	<?php } ?>
	<?php
	if ( ! empty( $template_bgcolor1 ) && ! empty( $template_bgcolor2 ) && ! empty( $template_bgcolor3 ) && ! empty( $template_bgcolor4 ) && ! empty( $template_bgcolor5 ) && ! empty( $template_bgcolor6 ) ) {
		?>
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-schedule-post-content:nth-child(6n+1){
			background: <?php echo esc_attr( $template_bgcolor1 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-schedule-post-content:nth-child(6n+2){
			background: <?php echo esc_attr( $template_bgcolor2 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-schedule-post-content:nth-child(6n+3){
			background: <?php echo esc_attr( $template_bgcolor3 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-schedule-post-content:nth-child(6n+4){
			background: <?php echo esc_attr( $template_bgcolor4 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-schedule-post-content:nth-child(6n+5){
			background: <?php echo esc_attr( $template_bgcolor5 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-schedule-post-content:nth-child(6n+6){
			background: <?php echo esc_attr( $template_bgcolor6 ); ?>;
		}
	<?php } ?>
		.wp-timeline-post-image figure {width: 100px;height: 100px;background: #fff;padding: 12px;border-radius: 50%;}
		.wp-timeline-post-image figure img{max-height: 100%;position: absolute;display: block;width: 70%;height: 60%;top: 50% !important;bottom: 0;margin: auto;transform: translateY(-50%);}
		/* Post Date */
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-date,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a{
			<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-date:hover,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a:hover{
			<?php echo isset( $wtl_settings['template_fthovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_fthovercolor'] ) . ' !important;' : ''; ?>
		}
		<?php
		echo esc_attr( Wtl_Template_Config::post_date_typography( $wtl_settings, $layout_id ) );
}
/* ------------------ Template: Milestone  Layout ----------- */
if ( 'milestone_layout' === $wp_timeline_theme ) {
	$template_color                     = isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#fff';
	$template_bgcolor                   = isset( $wtl_settings['template_bgcolor'] ) ? $wtl_settings['template_bgcolor'] : '#fff';
	$template_content_box_bg_color = isset( $wtl_settings['template_content_box_bg_color'] ) ? $wtl_settings['template_content_box_bg_color'] : '#fff';
	?>
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper{
		<?php
		if ( $template_bgcolor ) {
			echo 'background:' . esc_attr( $template_bgcolor ) . ';';
		}
		?>
		}
		<?php echo esc_attr( $layout_id ); ?> .milestone-main-inner:before{
		<?php echo isset( $wtl_settings['template_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-read-more-div{overflow:hidden;}
		<?php echo esc_attr( $layout_id ); ?> .wp-timeline-load-more-pre,
		<?php echo esc_attr( $layout_id ); ?> .wp-timeline-load-more{z-index: 3;position: relative}
		<?php echo esc_attr( $layout_id ); ?> #wtl-load-more-hidden{ float:none; }
		<?php
		echo esc_attr( Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::post_content_color( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
		?>
		<?php echo esc_attr( $layout_id ); ?> .wtl-author a,
		<?php echo esc_attr( $layout_id ); ?> .post-comment a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-meta-comment i,
		<?php echo esc_attr( $layout_id ); ?> .comments-link
		{
		<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-author a:hover,
		<?php echo esc_attr( $layout_id ); ?> .post-comment a:hover,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a:hover,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a:hover,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a:hover,
		<?php echo esc_attr( $layout_id ); ?> .wtl-meta-comment i:hover,
		<?php echo esc_attr( $layout_id ); ?> a.comments-link:hover
		{
		<?php echo isset( $wtl_settings['template_fthovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_fthovercolor'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-content{
		<?php echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) ); ?>
		}
		<?php echo esc_attr( $layout_id ); ?>  .wtl-post-content{
			<?php
			if ( $template_content_box_bg_color ) {
				echo 'background:' . esc_attr( $template_content_box_bg_color ) . ';';
			}
			echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
			?>
		}

		/* BG Color -------------- */
		<?php if ( ! empty( $template_bgcolor1 ) && ! empty( $template_bgcolor2 ) && empty( $template_bgcolor3 ) && empty( $template_bgcolor4 ) && empty( $template_bgcolor5 ) && empty( $template_bgcolor6 ) ) { ?>
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(2n+1) .milestone-border:before {
			background: <?php echo esc_attr( $template_bgcolor1 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(2n+1) .wtl-schedule-all-post-content h5 {
			color: <?php echo esc_attr( $template_bgcolor1 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(2n+2) .milestone-border:before{
			background: <?php echo esc_attr( $template_bgcolor2 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(2n+2) .wtl-schedule-all-post-content h5 {
			color: <?php echo esc_attr( $template_bgcolor1 ); ?>;
		}
	<?php } ?>
	<?php if ( ! empty( $template_bgcolor1 ) && ! empty( $template_bgcolor2 ) && ! empty( $template_bgcolor3 ) && empty( $template_bgcolor4 ) && empty( $template_bgcolor5 ) && empty( $template_bgcolor6 ) ) { ?>
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(3n+1) .milestone-border:before{
			background: <?php echo esc_attr( $template_bgcolor1 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(3n+1) .wtl-schedule-all-post-content h5 {
			color: <?php echo esc_attr( $template_bgcolor1 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(3n+2) .milestone-border:before{
			background: <?php echo esc_attr( $template_bgcolor2 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(3n+2) .wtl-schedule-all-post-content h5 {
			color: <?php echo esc_attr( $template_bgcolor2 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(3n+3) .milestone-border:before{
			background: <?php echo esc_attr( $template_bgcolor3 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(3n+3) .wtl-schedule-all-post-content h5 {
			color: <?php echo esc_attr( $template_bgcolor3 ); ?>;
		}
	<?php } ?>
	<?php if ( ! empty( $template_bgcolor1 ) && ! empty( $template_bgcolor2 ) && ! empty( $template_bgcolor3 ) && ! empty( $template_bgcolor4 ) && empty( $template_bgcolor5 ) && empty( $template_bgcolor6 ) ) { ?>
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(4n+1) .milestone-border:before{
			background: <?php echo esc_attr( $template_bgcolor1 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(4n+1) .wtl-schedule-all-post-content h5 {
			color: <?php echo esc_attr( $template_bgcolor1 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(4n+2) .milestone-border:before{
			background: <?php echo esc_attr( $template_bgcolor2 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(4n+2) .wtl-schedule-all-post-content h5 {
			color: <?php echo esc_attr( $template_bgcolor2 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(4n+3) .milestone-border:before{
			background: <?php echo esc_attr( $template_bgcolor3 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(4n+3) .wtl-schedule-all-post-content h5 {
			color: <?php echo esc_attr( $template_bgcolor3 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(4n+4) .milestone-border:before{
			background: <?php echo esc_attr( $template_bgcolor4 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(4n+4) .wtl-schedule-all-post-content h5 {
			color: <?php echo esc_attr( $template_bgcolor4 ); ?>;
		}
	<?php } ?>
	<?php if ( ! empty( $template_bgcolor1 ) && ! empty( $template_bgcolor2 ) && ! empty( $template_bgcolor3 ) && ! empty( $template_bgcolor4 ) && ! empty( $template_bgcolor5 ) && empty( $template_bgcolor6 ) ) { ?>
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(5n+1) .milestone-border:before{
			background: <?php echo esc_attr( $template_bgcolor1 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(5n+1) .wtl-schedule-all-post-content h5 {
			color: <?php echo esc_attr( $template_bgcolor1 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(5n+2) .milestone-border:before{
			background: <?php echo esc_attr( $template_bgcolor2 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(5n+2) .wtl-schedule-all-post-content h5 {
			color: <?php echo esc_attr( $template_bgcolor2 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(5n+3) .milestone-border:before{
			background: <?php echo esc_attr( $template_bgcolor3 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(5n+3) .wtl-schedule-all-post-content h5 {
			color: <?php echo esc_attr( $template_bgcolor3 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(5n+4) .milestone-border:before{
			background: <?php echo esc_attr( $template_bgcolor4 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(5n+4) .wtl-schedule-all-post-content h5 {
			color: <?php echo esc_attr( $template_bgcolor4 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(5n+5) .milestone-border:before{
			background: <?php echo esc_attr( $template_bgcolor5 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(5n+5) .wtl-schedule-all-post-content h5 {
			color: <?php echo esc_attr( $template_bgcolor5 ); ?>;
		}
	<?php } ?>
	<?php
	if ( ! empty( $template_bgcolor1 ) && ! empty( $template_bgcolor2 ) && ! empty( $template_bgcolor3 ) && ! empty( $template_bgcolor4 ) && ! empty( $template_bgcolor5 ) && ! empty( $template_bgcolor6 ) ) {
		?>
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(6n+1) .milestone-border:before{
			background: <?php echo esc_attr( $template_bgcolor1 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(6n+1) .wtl-schedule-all-post-content h5 {
			color: <?php echo esc_attr( $template_bgcolor1 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(6n+2) .milestone-border:before{
			background: <?php echo esc_attr( $template_bgcolor2 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(6n+2) .wtl-schedule-all-post-content h5 {
			color: <?php echo esc_attr( $template_bgcolor2 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(6n+3) .milestone-border:before{
			background: <?php echo esc_attr( $template_bgcolor3 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(6n+3) .wtl-schedule-all-post-content h5 {
			color: <?php echo esc_attr( $template_bgcolor3 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(6n+4) .milestone-border:before{
			background: <?php echo esc_attr( $template_bgcolor4 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(6n+4) .wtl-schedule-all-post-content h5 {
			color: <?php echo esc_attr( $template_bgcolor4 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(6n+5) .milestone-border:before{
			background: <?php echo esc_attr( $template_bgcolor5 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(6n+5) .wtl-schedule-all-post-content h5 {
			color: <?php echo esc_attr( $template_bgcolor5 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(6n+6) .milestone-border:before{
			background: <?php echo esc_attr( $template_bgcolor6 ); ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(6n+6) .wtl-schedule-all-post-content h5 {
			color: <?php echo esc_attr( $template_bgcolor6 ); ?>;
		}
	<?php } ?>
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(1) .wtl-schedule-all-post-content h5{
			<?php echo isset( $wtl_settings['template_bgcolor1'] ) ? 'color:' . esc_attr( $wtl_settings['template_bgcolor1'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(2) .wtl-schedule-all-post-content h5{
			<?php echo isset( $wtl_settings['template_bgcolor2'] ) ? 'color:' . esc_attr( $wtl_settings['template_bgcolor2'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(3) .wtl-schedule-all-post-content h5{
			<?php echo isset( $wtl_settings['template_bgcolor3'] ) ? 'color:' . esc_attr( $wtl_settings['template_bgcolor3'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(4) .wtl-schedule-all-post-content h5{
			<?php echo isset( $wtl_settings['template_bgcolor4'] ) ? 'color:' . esc_attr( $wtl_settings['template_bgcolor4'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(5) .wtl-schedule-all-post-content h5{
			<?php echo isset( $wtl_settings['template_bgcolor5'] ) ? 'color:' . esc_attr( $wtl_settings['template_bgcolor5'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(6) .wtl-schedule-all-post-content h5{
			<?php echo isset( $wtl_settings['template_bgcolor6'] ) ? 'color:' . esc_attr( $wtl_settings['template_bgcolor6'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(1) .milestone-border:before{
			<?php echo isset( $wtl_settings['template_bgcolor1'] ) ? 'background-color:' . esc_attr( $wtl_settings['template_bgcolor1'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(2) .milestone-border:before{
			<?php echo isset( $wtl_settings['template_bgcolor2'] ) ? 'background-color:' . esc_attr( $wtl_settings['template_bgcolor2'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(3) .milestone-border:before{
			<?php echo isset( $wtl_settings['template_bgcolor3'] ) ? 'background-color:' . esc_attr( $wtl_settings['template_bgcolor3'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(4) .milestone-border:before{
			<?php echo isset( $wtl_settings['template_bgcolor4'] ) ? 'background-color:' . esc_attr( $wtl_settings['template_bgcolor4'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(5) .milestone-border:before{
			<?php echo isset( $wtl_settings['template_bgcolor5'] ) ? 'background-color:' . esc_attr( $wtl_settings['template_bgcolor5'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-post-content:nth-child(6) .milestone-border:before{
			<?php echo isset( $wtl_settings['template_bgcolor6'] ) ? 'background-color:' . esc_attr( $wtl_settings['template_bgcolor6'] ) . ' !important;' : ''; ?>
		}
		<?php
}
/* ------------------ Template: Glossary Layout ----------- */
if ( 'glossary_layout' === $wp_timeline_theme ) {
	?>
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper{
			<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) . ';' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl-schedule-wrap:before,
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl-schedule-wrap:after,
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_blog_template:before,
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_blog_template:after,
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_left_side .blog_header:before,
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_right_side .blog_header:before,
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_left_side .blog_header:after,
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_right_side .blog_header:after
		{
			<?php
			if ( isset( $wtl_settings['template_color'] ) ) {
				echo 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
			}
			if ( isset( $wtl_settings['template_color'] ) ) {
				echo 'border-radius:' . esc_attr( $wtl_settings['template_icon_border_radious'] ) . 'px !important;';
			}
			?>
		}
		/* Box Settings */
		<?php echo esc_attr( $layout_id ); ?> .blog_template.glossary .blog_item {
			<?php
			echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
			if ( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) ) {
				?>
				overflow: hidden;
				<?php
			}
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .glossary .post_summary_outer .label_featured_post {
			font-size: <?php echo esc_attr( $content_fontsize ) . 'px'; ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .glossary .blog_header h2 a,
		<?php echo esc_attr( $layout_id ); ?>.bdp_archive .author-avatar-div .author_content .author{}
		<?php echo esc_attr( $layout_id ); ?> .glossary .blog_header h2,
		<?php echo esc_attr( $layout_id ); ?> .glossary .blog_header h2 a {
			display: block;
		}
		/* Meta */
		<?php echo esc_attr( $layout_id ); ?> .glossary .footer_meta .wtl-post-category span,
		<?php echo esc_attr( $layout_id ); ?> .glossary .footer_meta .wtl-post-tags span,
		<?php echo esc_attr( $layout_id ); ?> .glossary .post-bottom .post-by span,
		<?php echo esc_attr( $layout_id ); ?> .glossary .footer_meta .category-link a,
		<?php echo esc_attr( $layout_id ); ?> .glossary .footer_meta .tags a,
		<?php echo esc_attr( $layout_id ); ?> .glossary .post-author,.glossary .post-author a,.glossary .comment a,.glossary .posted_by a,.glossary .post-author .link-lable,
		<?php echo esc_attr( $layout_id ); ?> .glossary .wtl_blog_template .social-component a ,
		<?php echo esc_attr( $layout_id ); ?> .glossary .posted_by a .datetime {
			<?php
			echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_family'] ) ? 'font-family:' . esc_attr( $wtl_settings['meta_font_family'] ) . ';' : '';
			echo isset( $wtl_settings['meta_fontsize'] ) ? 'font-size:' . esc_attr( $wtl_settings['meta_fontsize'] ) . 'px;' : '';
			echo isset( $wtl_settings['meta_font_weight'] ) ? 'font-weight:' . esc_attr( $wtl_settings['meta_font_weight'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_line_height'] ) ? 'line-height:' . esc_attr( $wtl_settings['meta_font_line_height'] ) . ';' : '';
			if ( 1 == $meta_font_italic ) { 
				echo 'font-style:italic;';
			} else {
				echo 'font-style:normal;';
			}
			echo isset( $wtl_settings['meta_font_text_transform'] ) ? 'text-transform:' . esc_attr( $wtl_settings['meta_font_text_transform'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_text_decoration'] ) ? 'text-decoration:' . esc_attr( $wtl_settings['meta_font_text_decoration'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_letter_spacing'] ) ? 'letter-spacing:' . esc_attr( $wtl_settings['meta_font_letter_spacing'] ) . ';' : '';
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .glossary .wtl_comment_count i{
			<?php
			echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ';' : '';
			?>
		}
		.wtl_is_horizontal .wtl-ss-left i, .wtl_is_horizontal .wtl-ss-right i {
			<?php
			echo isset( $wtl_settings['navigation_color'] ) ? 'color:' . esc_attr( $wtl_settings['navigation_color'] ) . ';' : '';
			echo isset( $wtl_settings['navigation_bg_color'] ) ? 'background:' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ' !important;' : '';
			echo isset( $wtl_settings['navigation_arrow_size'] ) ? 'font-size:' . esc_attr( $wtl_settings['navigation_arrow_size'] ) . 'px;' : '';
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .glossary .posted_by a .datetime:hover{
			<?php echo isset( $wtl_settings['template_fthovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_fthovercolor'] ) : ''; ?>
		}
		/* Read More Button */
		<?php echo esc_attr( $layout_id ); ?> .glossary .read-more-class a.more-tag{
			<?php
			/* Font */
			echo isset( $wtl_settings['readmore_font_family'] ) ? 'font-family:' . esc_attr( $wtl_settings['readmore_font_family'] ) . ';' : '';
			echo isset( $wtl_settings['readmore_fontsize'] ) ? 'font-size:' . esc_attr( $wtl_settings['readmore_fontsize'] ) . 'px;' : '';
			echo isset( $wtl_settings['readmore_font_weight'] ) ? 'font-weight:' . esc_attr( $wtl_settings['readmore_font_weight'] ) . ';' : '';
			echo isset( $wtl_settings['readmore_font_line_height'] ) ? 'line-height:' . esc_attr( $wtl_settings['readmore_font_line_height'] ) . ';' : '';
			echo isset( $wtl_settings['readmore_font_italic'] ) ? 'font-style' . esc_attr( $wtl_settings['readmore_font_italic'] ) . ';' : '';
			echo isset( $wtl_settings['readmore_font_text_transform'] ) ? 'text-transform:' . esc_attr( $wtl_settings['readmore_font_text_transform'] ) . ';' : '';
			echo isset( $wtl_settings['readmore_font_text_decoration'] ) ? 'text-decoration:' . esc_attr( $wtl_settings['readmore_font_text_decoration'] ) . ';' : '';
			echo isset( $wtl_settings['readmore_font_letter_spacing'] ) ? 'letter-spacing:' . esc_attr( $wtl_settings['readmore_font_letter_spacing'] ) . ';' : '';
			/* Padding */
			echo isset( $wtl_settings['readmore_button_paddingleft'] ) ? 'padding-left:' . esc_attr( $wtl_settings['readmore_button_paddingleft'] ) . 'px;' : '';
			echo isset( $wtl_settings['readmore_button_paddingright'] ) ? 'padding-right:' . esc_attr( $wtl_settings['readmore_button_paddingright'] ) . 'px;' : '';
			echo isset( $wtl_settings['readmore_button_paddingtop'] ) ? 'padding-top:' . esc_attr( $wtl_settings['readmore_button_paddingtop'] ) . 'px;' : '';
			echo isset( $wtl_settings['readmore_button_paddingbottom'] ) ? 'padding-bottom:' . esc_attr( $wtl_settings['readmore_button_paddingbottom'] ) . 'px;' : '';
			/* Margin */
			echo isset( $wtl_settings['readmore_button_marginleft'] ) ? 'margin-top:' . esc_attr( $wtl_settings['readmore_button_marginleft'] ) . 'px;' : '';
			echo isset( $wtl_settings['readmore_button_marginright'] ) ? 'margin-bottom:' . esc_attr( $wtl_settings['readmore_button_marginright'] ) : '';
			echo isset( $wtl_settings['readmore_button_margintop'] ) ? 'margin-right:' . esc_attr( $wtl_settings['readmore_button_margintop'] ) . 'px;' : '';
			echo isset( $wtl_settings['readmore_button_marginbottom'] ) ? 'margin-left:' . esc_attr( $wtl_settings['readmore_button_marginbottom'] ) . 'px;' : '';
			/* Background/Color */
			echo isset( $wtl_settings['template_readmorebackcolor'] ) ? 'background: ' . esc_attr( $wtl_settings['template_readmorebackcolor'] ) . ' !important;' : '';
			echo isset( $wtl_settings['template_readmorecolor'] ) ? 'color: ' . esc_attr( $wtl_settings['template_readmorecolor'] ) . ';' : '';
			/* Border Radiouis */
			echo isset( $wtl_settings['readmore_button_border_radius'] ) ? 'border-radius:' . esc_attr( $wtl_settings['readmore_button_border_radius'] ) . 'px;' : '';
			/* Border Size */
			echo isset( $wtl_settings['wp_timeline_readmore_button_borderleft'] ) ? 'border-left:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_borderleft'] ) . 'px;' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_borderright'] ) ? 'border-right:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_borderright'] ) . 'px;' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_bordertop'] ) ? 'border-top:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_bordertop'] ) . 'px;' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_borderbottom'] ) ? 'border-bottom:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_borderbottom'] ) . 'px;' : '';
			/* Border Style */
			echo isset( $wtl_settings['read_more_button_border_style'] ) ? 'border-style:' . esc_attr( $wtl_settings['read_more_button_border_style'] ) . ';' : '';
			/* Border Color */
			echo isset( $wtl_settings['wp_timeline_readmore_button_borderleftcolor'] ) ? 'border-left-color: ' . esc_attr( $wtl_settings['wp_timeline_readmore_button_borderleftcolor'] ) . ';' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_borderrightcolor'] ) ? 'border-right-color: ' . esc_attr( $wtl_settings['wp_timeline_readmore_button_borderrightcolor'] ) . ';' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_bordertopcolor'] ) ? 'border-top-color: ' . esc_attr( $wtl_settings['wp_timeline_readmore_button_bordertopcolor'] ) . ';' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_borderbottomcolor'] ) ? 'border-bottom-color:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_borderbottomcolor'] ) . ';' : '';
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .glossary .read-more-class a.more-tag:hover{
			<?php
			/* Color */
			echo isset( $wtl_settings['template_readmore_hover_backcolor'] ) ? 'background: ' . esc_attr( $wtl_settings['template_readmore_hover_backcolor'] ) . ' !important;' : '';
			echo isset( $wtl_settings['template_readmorehovercolor'] ) ? 'color: ' . esc_attr( $wtl_settings['template_readmorehovercolor'] ) . ';' : '';
			/* Border Radiouis */
			echo isset( $wtl_settings['readmore_button_hover_border_radius'] ) ? 'border-radius:' . esc_attr( $wtl_settings['readmore_button_hover_border_radius'] ) . 'px;' : '';
			/* Border Size */
			echo isset( $wtl_settings['wp_timeline_readmore_button_hover_borderleft'] ) ? 'border-left:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_hover_borderleft'] ) . 'px;' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_hover_borderright'] ) ? 'border-right:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_hover_borderright'] ) . 'px;' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_hover_bordertop'] ) ? 'border-top:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_hover_bordertop'] ) . 'px;' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_hover_borderbottom'] ) ? 'border-bottom:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_hover_borderbottom'] ) . 'px;' : '';
			/* Border Style */
			echo isset( $wtl_settings['read_more_button_hover_border_style'] ) ? 'border-style:' . esc_attr( $wtl_settings['read_more_button_hover_border_style'] ) . ';' : '';
			/* Border Color */
			echo isset( $wtl_settings['wp_timeline_readmore_button_hover_borderleftcolor'] ) ? 'border-left-color: ' . esc_attr( $wtl_settings['wp_timeline_readmore_button_hover_borderleftcolor'] ) . ';' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_hover_borderrightcolor'] ) ? 'border-right-color: ' . esc_attr( $wtl_settings['wp_timeline_readmore_button_hover_borderrightcolor'] ) . ';' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_hover_bordertopcolor'] ) ? 'border-top-color: ' . esc_attr( $wtl_settings['wp_timeline_readmore_button_hover_bordertopcolor'] ) . ';' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_hover_borderbottomcolor'] ) ? 'border-bottom-color:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_hover_borderbottomcolor'] ) . ';' : '';
			?>
		}
		<?php echo esc_attr( $layout_id ); ?>.glossary a.more-tag{
			opacity:0.9
		}
		<?php if ( isset( $readmorebutton_on ) && 2 == $readmorebutton_on ) {  ?>
			<?php echo esc_attr( $layout_id ); ?> .glossary a.more-tag:hover {
				<?php echo isset( $wtl_settings['readmorehoverbackcolor'] ) ? 'background: ' . esc_attr( $wtl_settings['readmorehoverbackcolor'] ) . ';' : ''; ?>
			}
		<?php } ?>
		<?php echo esc_attr( $layout_id ); ?> .glossary .post_content-inner {
			border-color: <?php echo esc_attr( $wtl_settings['template_readmore_hover_backcolor'] ); ?> !important;
		}
		<?php if ( isset( $firstletter_big ) && 1 == $firstletter_big ) {  ?>
			<?php echo esc_attr( $layout_id ); ?> .glossary div.post-content .post_content-inner > *:first-child:first-letter,
			<?php echo esc_attr( $layout_id ); ?> .glossary div.post-content .post_content-inner> p:first-child:first-letter,
			<?php echo esc_attr( $layout_id ); ?> .glossary div.post-content .post_content-inner:first-letter,
			<?php echo esc_attr( $layout_id ); ?> .glossary div.post_content .post_content-inner > *:first-child:first-letter,
			<?php echo esc_attr( $layout_id ); ?> .glossary div.post_content .post_content-inner> p:first-child:first-letter {
				float: left;
				margin-right:5px;
			}
		<?php } ?>
		/* Drop Cap css*/
		<?php
		echo Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ); 
		echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
}

/* ------------------ Template: Business Layout ----------- */
if ( 'business_layout' === $wp_timeline_theme ) {
	?>
		<?php echo esc_attr( $layout_id ); ?> .wp_timeline_main_section .post_summary_outer .wtl-post-content a
		{
			<?php echo isset( $template_metacolor ) ? 'color:' . esc_attr($template_metacolor) . ';' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .business .blog_item {
			<?php echo isset( $template_category_border_color ) ? 'border-color:' . esc_attr($template_category_border_color) . ';' : ''; 
			echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) ); ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .blog_template.business .wp-timeline-item-divier-dots {
			background: <?php echo isset( $template_category_dots_bg_color ) ? esc_attr($template_category_dots_bg_color) . ';' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .blog_template.business .wp-timeline-item-divier-item {
			background: <?php echo isset( $template_category_dots_line_color ) ? esc_attr($template_category_dots_line_color) . ';' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .blog_template.business .wp-timeline-dots-wave.right-side {
			background: <?php echo isset( $template_category_dots_wave_color ) ? esc_attr($template_category_dots_wave_color) . ';' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper{
			<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) . ';' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl-schedule-wrap:before,
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl-schedule-wrap:after,
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_blog_template:before,
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_blog_template:after,
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_left_side .blog_header:before,
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_right_side .blog_header:before,
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_left_side .blog_header:after,
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_right_side .blog_header:after
		{
			<?php
			if ( isset( $wtl_settings['template_color'] ) ) {
				echo 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
			}
			if ( isset( $wtl_settings['template_color'] ) ) {
				echo 'border-radius:' . esc_attr( $wtl_settings['template_icon_border_radious'] ) . 'px !important;';
			}
			?>
		}
		/* Box Settings */
		<?php echo esc_attr( $layout_id ); ?> .blog_template.glossary .blog_item {
			<?php
			echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
			if ( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) ) {
				?>
				overflow: hidden;
				<?php
			}
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .glossary .post_summary_outer .label_featured_post {
			font-size: <?php echo esc_attr( $content_fontsize ) . 'px'; ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .glossary .blog_header h2 a,
		<?php echo esc_attr( $layout_id ); ?>.bdp_archive .author-avatar-div .author_content .author{}
		<?php echo esc_attr( $layout_id ); ?> .glossary .blog_header h2,
		<?php echo esc_attr( $layout_id ); ?> .glossary .blog_header h2 a {
			display: block;
		}
		/* Meta */
		<?php echo esc_attr( $layout_id ); ?> .glossary .footer_meta .wtl-post-category span,
		<?php echo esc_attr( $layout_id ); ?> .glossary .footer_meta .wtl-post-tags span,
		<?php echo esc_attr( $layout_id ); ?> .glossary .post-bottom .post-by span,
		<?php echo esc_attr( $layout_id ); ?> .glossary .footer_meta .category-link a,
		<?php echo esc_attr( $layout_id ); ?> .glossary .footer_meta .tags a,
		<?php echo esc_attr( $layout_id ); ?> .glossary .post-author,.glossary .post-author a,.glossary .comment a,.glossary .posted_by a,.glossary .post-author .link-lable,
		<?php echo esc_attr( $layout_id ); ?> .glossary .wtl_blog_template .social-component a ,
		<?php echo esc_attr( $layout_id ); ?> .glossary .posted_by a .datetime {
			<?php
			echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_family'] ) ? 'font-family:' . esc_attr( $wtl_settings['meta_font_family'] ) . ';' : '';
			echo isset( $wtl_settings['meta_fontsize'] ) ? 'font-size:' . esc_attr( $wtl_settings['meta_fontsize'] ) . 'px;' : '';
			echo isset( $wtl_settings['meta_font_weight'] ) ? 'font-weight:' . esc_attr( $wtl_settings['meta_font_weight'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_line_height'] ) ? 'line-height:' . esc_attr( $wtl_settings['meta_font_line_height'] ) . ';' : '';
			if ( 1 == $meta_font_italic ) { 
				echo 'font-style:italic;';
			} else {
				echo 'font-style:normal;';
			}
			echo isset( $wtl_settings['meta_font_text_transform'] ) ? 'text-transform:' . esc_attr( $wtl_settings['meta_font_text_transform'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_text_decoration'] ) ? 'text-decoration:' . esc_attr( $wtl_settings['meta_font_text_decoration'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_letter_spacing'] ) ? 'letter-spacing:' . esc_attr( $wtl_settings['meta_font_letter_spacing'] ) . ';' : '';
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .glossary .wtl_comment_count i{
			<?php
			echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ';' : '';
			?>
		}
		.wtl_is_horizontal .wtl-ss-left i, .wtl_is_horizontal .wtl-ss-right i {
			<?php
			echo isset( $wtl_settings['navigation_color'] ) ? 'color:' . esc_attr( $wtl_settings['navigation_color'] ) . ';' : '';
			echo isset( $wtl_settings['navigation_bg_color'] ) ? 'background:' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ' !important;' : '';
			echo isset( $wtl_settings['navigation_arrow_size'] ) ? 'font-size:' . esc_attr( $wtl_settings['navigation_arrow_size'] ) . 'px;' : '';
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .glossary .posted_by a .datetime:hover{
			<?php echo isset( $wtl_settings['template_fthovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_fthovercolor'] ) : ''; ?>
		}
		/* Read More Button */
		<?php echo esc_attr( $layout_id ); ?> .glossary .read-more-class a.more-tag{
			<?php
			/* Font */
			echo isset( $wtl_settings['readmore_font_family'] ) ? 'font-family:' . esc_attr( $wtl_settings['readmore_font_family'] ) . ';' : '';
			echo isset( $wtl_settings['readmore_fontsize'] ) ? 'font-size:' . esc_attr( $wtl_settings['readmore_fontsize'] ) . 'px;' : '';
			echo isset( $wtl_settings['readmore_font_weight'] ) ? 'font-weight:' . esc_attr( $wtl_settings['readmore_font_weight'] ) . ';' : '';
			echo isset( $wtl_settings['readmore_font_line_height'] ) ? 'line-height:' . esc_attr( $wtl_settings['readmore_font_line_height'] ) . ';' : '';
			echo isset( $wtl_settings['readmore_font_italic'] ) ? 'font-style' . esc_attr( $wtl_settings['readmore_font_italic'] ) . ';' : '';
			echo isset( $wtl_settings['readmore_font_text_transform'] ) ? 'text-transform:' . esc_attr( $wtl_settings['readmore_font_text_transform'] ) . ';' : '';
			echo isset( $wtl_settings['readmore_font_text_decoration'] ) ? 'text-decoration:' . esc_attr( $wtl_settings['readmore_font_text_decoration'] ) . ';' : '';
			echo isset( $wtl_settings['readmore_font_letter_spacing'] ) ? 'letter-spacing:' . esc_attr( $wtl_settings['readmore_font_letter_spacing'] ) . ';' : '';
			/* Padding */
			echo isset( $wtl_settings['readmore_button_paddingleft'] ) ? 'padding-left:' . esc_attr( $wtl_settings['readmore_button_paddingleft'] ) . 'px;' : '';
			echo isset( $wtl_settings['readmore_button_paddingright'] ) ? 'padding-right:' . esc_attr( $wtl_settings['readmore_button_paddingright'] ) . 'px;' : '';
			echo isset( $wtl_settings['readmore_button_paddingtop'] ) ? 'padding-top:' . esc_attr( $wtl_settings['readmore_button_paddingtop'] ) . 'px;' : '';
			echo isset( $wtl_settings['readmore_button_paddingbottom'] ) ? 'padding-bottom:' . esc_attr( $wtl_settings['readmore_button_paddingbottom'] ) . 'px;' : '';
			/* Margin */
			echo isset( $wtl_settings['readmore_button_marginleft'] ) ? 'margin-top:' . esc_attr( $wtl_settings['readmore_button_marginleft'] ) . 'px;' : '';
			echo isset( $wtl_settings['readmore_button_marginright'] ) ? 'margin-bottom:' . esc_attr( $wtl_settings['readmore_button_marginright'] ) : '';
			echo isset( $wtl_settings['readmore_button_margintop'] ) ? 'margin-right:' . esc_attr( $wtl_settings['readmore_button_margintop'] ) . 'px;' : '';
			echo isset( $wtl_settings['readmore_button_marginbottom'] ) ? 'margin-left:' . esc_attr( $wtl_settings['readmore_button_marginbottom'] ) . 'px;' : '';
			/* Background/Color */
			echo isset( $wtl_settings['template_readmorebackcolor'] ) ? 'background: ' . esc_attr( $wtl_settings['template_readmorebackcolor'] ) . ' !important;' : '';
			echo isset( $wtl_settings['template_readmorecolor'] ) ? 'color: ' . esc_attr( $wtl_settings['template_readmorecolor'] ) . ';' : '';
			/* Border Radiouis */
			echo isset( $wtl_settings['readmore_button_border_radius'] ) ? 'border-radius:' . esc_attr( $wtl_settings['readmore_button_border_radius'] ) . 'px;' : '';
			/* Border Size */
			echo isset( $wtl_settings['wp_timeline_readmore_button_borderleft'] ) ? 'border-left:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_borderleft'] ) . 'px;' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_borderright'] ) ? 'border-right:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_borderright'] ) . 'px;' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_bordertop'] ) ? 'border-top:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_bordertop'] ) . 'px;' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_borderbottom'] ) ? 'border-bottom:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_borderbottom'] ) . 'px;' : '';
			/* Border Style */
			echo isset( $wtl_settings['read_more_button_border_style'] ) ? 'border-style:' . esc_attr( $wtl_settings['read_more_button_border_style'] ) . ';' : '';
			/* Border Color */
			echo isset( $wtl_settings['wp_timeline_readmore_button_borderleftcolor'] ) ? 'border-left-color: ' . esc_attr( $wtl_settings['wp_timeline_readmore_button_borderleftcolor'] ) . ';' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_borderrightcolor'] ) ? 'border-right-color: ' . esc_attr( $wtl_settings['wp_timeline_readmore_button_borderrightcolor'] ) . ';' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_bordertopcolor'] ) ? 'border-top-color: ' . esc_attr( $wtl_settings['wp_timeline_readmore_button_bordertopcolor'] ) . ';' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_borderbottomcolor'] ) ? 'border-bottom-color:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_borderbottomcolor'] ) . ';' : '';
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .glossary .read-more-class a.more-tag:hover{
			<?php
			/* Color */
			echo isset( $wtl_settings['template_readmore_hover_backcolor'] ) ? 'background: ' . esc_attr( $wtl_settings['template_readmore_hover_backcolor'] ) . ' !important;' : '';
			echo isset( $wtl_settings['template_readmorehovercolor'] ) ? 'color: ' . esc_attr( $wtl_settings['template_readmorehovercolor'] ) . ';' : '';
			/* Border Radiouis */
			echo isset( $wtl_settings['readmore_button_hover_border_radius'] ) ? 'border-radius:' . esc_attr( $wtl_settings['readmore_button_hover_border_radius'] ) . 'px;' : '';
			/* Border Size */
			echo isset( $wtl_settings['wp_timeline_readmore_button_hover_borderleft'] ) ? 'border-left:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_hover_borderleft'] ) . 'px;' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_hover_borderright'] ) ? 'border-right:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_hover_borderright'] ) . 'px;' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_hover_bordertop'] ) ? 'border-top:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_hover_bordertop'] ) . 'px;' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_hover_borderbottom'] ) ? 'border-bottom:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_hover_borderbottom'] ) . 'px;' : '';
			/* Border Style */
			echo isset( $wtl_settings['read_more_button_hover_border_style'] ) ? 'border-style:' . esc_attr( $wtl_settings['read_more_button_hover_border_style'] ) . ';' : '';
			/* Border Color */
			echo isset( $wtl_settings['wp_timeline_readmore_button_hover_borderleftcolor'] ) ? 'border-left-color: ' . esc_attr( $wtl_settings['wp_timeline_readmore_button_hover_borderleftcolor'] ) . ';' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_hover_borderrightcolor'] ) ? 'border-right-color: ' . esc_attr( $wtl_settings['wp_timeline_readmore_button_hover_borderrightcolor'] ) . ';' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_hover_bordertopcolor'] ) ? 'border-top-color: ' . esc_attr( $wtl_settings['wp_timeline_readmore_button_hover_bordertopcolor'] ) . ';' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_hover_borderbottomcolor'] ) ? 'border-bottom-color:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_hover_borderbottomcolor'] ) . ';' : '';
			?>
		}
		<?php echo esc_attr( $layout_id ); ?>.glossary a.more-tag{
			opacity:0.9
		}
		<?php if ( isset( $readmorebutton_on ) && 2 == $readmorebutton_on ) {  ?>
			<?php echo esc_attr( $layout_id ); ?> .glossary a.more-tag:hover {
				<?php echo isset( $wtl_settings['readmorehoverbackcolor'] ) ? 'background: ' . esc_attr( $wtl_settings['readmorehoverbackcolor'] ) . ';' : ''; ?>
			}
		<?php } ?>
		<?php echo esc_attr( $layout_id ); ?> .glossary .post_content-inner {
			border-color: <?php echo esc_attr( $wtl_settings['template_readmore_hover_backcolor'] ); ?> !important;
		}
		<?php if ( isset( $firstletter_big ) && 1 == $firstletter_big ) {  ?>
			<?php echo esc_attr( $layout_id ); ?> .glossary div.post-content .post_content-inner > *:first-child:first-letter,
			<?php echo esc_attr( $layout_id ); ?> .glossary div.post-content .post_content-inner> p:first-child:first-letter,
			<?php echo esc_attr( $layout_id ); ?> .glossary div.post-content .post_content-inner:first-letter,
			<?php echo esc_attr( $layout_id ); ?> .glossary div.post_content .post_content-inner > *:first-child:first-letter,
			<?php echo esc_attr( $layout_id ); ?> .glossary div.post_content .post_content-inner> p:first-child:first-letter {
				float: left;
				margin-right:5px;
			}
		<?php } ?>
		/* Drop Cap css*/
		<?php
		echo Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ); 
		echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
}

/* ------------------ Template: Timeline Graph Layout ----------- */
if ( 'timeline_graph_layout' === $wp_timeline_theme ) {
	?>
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .blog_template.timeline_graph:nth-child(4n+1) .posted_by{
			background-color: <?php echo isset( $template_bgcolor1 ) ? esc_attr($template_bgcolor1) . ';' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .blog_template.timeline_graph:nth-child(4n+1) .wtl-post-title a::after {
			background-color: <?php echo isset( $template_bgcolor1 ) ? esc_attr($template_bgcolor1) . ';' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .blog_template.timeline_graph:nth-child(4n+2) .wtl-post-title a::after {
			background-color: <?php echo isset( $template_bgcolor2 ) ? esc_attr($template_bgcolor2) . ';' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .blog_template.timeline_graph:nth-child(4n+3) .wtl-post-title a::after {
			background-color: <?php echo isset( $template_bgcolor3 ) ? esc_attr($template_bgcolor3) . ';' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .blog_template.timeline_graph:nth-child(4n+4) .wtl-post-title a::after {
			background-color: <?php echo isset( $template_bgcolor4 ) ? esc_attr($template_bgcolor4) . ';' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .blog_template.timeline_graph:nth-child(4n+2) .posted_by{
			background-color: <?php echo isset( $template_bgcolor2 ) ? esc_attr($template_bgcolor2) . ';' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .blog_template.timeline_graph:nth-child(4n+3) .posted_by{
			background-color: <?php echo isset( $template_bgcolor3 ) ? esc_attr($template_bgcolor3) . ';' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .blog_template.timeline_graph:nth-child(4n+4) .posted_by{
			background-color: <?php echo isset( $template_bgcolor4 ) ? esc_attr($template_bgcolor4) . ';' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .business .blog_item {
			<?php echo isset( $template_category_border_color ) ? 'border-color:' . esc_attr($template_category_border_color) . ';' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .blog_template.business .wp-timeline-item-divier-dots {
			background: <?php echo isset( $template_category_dots_bg_color ) ? esc_attr($template_category_dots_bg_color) . ';' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .blog_template.business .wp-timeline-item-divier-item {
			background: <?php echo isset( $template_category_dots_line_color ) ? esc_attr($template_category_dots_line_color) . ';' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .blog_template.business .wp-timeline-dots-wave.right-side {
			background: <?php echo isset( $template_category_dots_wave_color ) ? esc_attr($template_category_dots_wave_color) . ';' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper{
			<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) . ';' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl-schedule-wrap:before,
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl-schedule-wrap:after,
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_blog_template:before,
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_blog_template:after,
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_left_side .blog_header:before,
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_right_side .blog_header:before,
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_left_side .blog_header:after,
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_right_side .blog_header:after
		{
			<?php
			if ( isset( $wtl_settings['template_color'] ) ) {
				echo 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
			}
			if ( isset( $wtl_settings['template_color'] ) ) {
				echo 'border-radius:' . esc_attr( $wtl_settings['template_icon_border_radious'] ) . 'px !important;';
			}
			?>
		}
		/* Box Settings */
		<?php echo esc_attr( $layout_id ); ?> .blog_template.glossary .blog_item {
			<?php
			echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
			if ( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) ) {
				?>
				overflow: hidden;
				<?php
			}
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .glossary .post_summary_outer .label_featured_post {
			font-size: <?php echo esc_attr( $content_fontsize ) . 'px'; ?>;
		}
		<?php echo esc_attr( $layout_id ); ?> .glossary .blog_header h2 a,
		<?php echo esc_attr( $layout_id ); ?>.bdp_archive .author-avatar-div .author_content .author{}
		<?php echo esc_attr( $layout_id ); ?> .glossary .blog_header h2,
		<?php echo esc_attr( $layout_id ); ?> .glossary .blog_header h2 a {
			display: block;
		}
		/* Meta */
		<?php echo esc_attr( $layout_id ); ?> .glossary .footer_meta .wtl-post-category span,
		<?php echo esc_attr( $layout_id ); ?> .glossary .footer_meta .wtl-post-tags span,
		<?php echo esc_attr( $layout_id ); ?> .glossary .post-bottom .post-by span,
		<?php echo esc_attr( $layout_id ); ?> .glossary .footer_meta .category-link a,
		<?php echo esc_attr( $layout_id ); ?> .glossary .footer_meta .tags a,
		<?php echo esc_attr( $layout_id ); ?> .glossary .post-author,.glossary .post-author a,.glossary .comment a,.glossary .posted_by a,.glossary .post-author .link-lable,
		<?php echo esc_attr( $layout_id ); ?> .glossary .wtl_blog_template .social-component a ,
		<?php echo esc_attr( $layout_id ); ?> .glossary .posted_by a .datetime {
			<?php
			echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_family'] ) ? 'font-family:' . esc_attr( $wtl_settings['meta_font_family'] ) . ';' : '';
			echo isset( $wtl_settings['meta_fontsize'] ) ? 'font-size:' . esc_attr( $wtl_settings['meta_fontsize'] ) . 'px;' : '';
			echo isset( $wtl_settings['meta_font_weight'] ) ? 'font-weight:' . esc_attr( $wtl_settings['meta_font_weight'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_line_height'] ) ? 'line-height:' . esc_attr( $wtl_settings['meta_font_line_height'] ) . ';' : '';
			if ( 1 == $meta_font_italic ) { 
				echo 'font-style:italic;';
			} else {
				echo 'font-style:normal;';
			}
			echo isset( $wtl_settings['meta_font_text_transform'] ) ? 'text-transform:' . esc_attr( $wtl_settings['meta_font_text_transform'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_text_decoration'] ) ? 'text-decoration:' . esc_attr( $wtl_settings['meta_font_text_decoration'] ) . ';' : '';
			echo isset( $wtl_settings['meta_font_letter_spacing'] ) ? 'letter-spacing:' . esc_attr( $wtl_settings['meta_font_letter_spacing'] ) . ';' : '';
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .glossary .wtl_comment_count i{
			<?php
			echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ';' : '';
			?>
		}
		.wtl_is_horizontal .wtl-ss-left i, .wtl_is_horizontal .wtl-ss-right i {
			<?php
			echo isset( $wtl_settings['navigation_color'] ) ? 'color:' . esc_attr( $wtl_settings['navigation_color'] ) . ';' : '';
			echo isset( $wtl_settings['navigation_bg_color'] ) ? 'background:' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ' !important;' : '';
			echo isset( $wtl_settings['navigation_arrow_size'] ) ? 'font-size:' . esc_attr( $wtl_settings['navigation_arrow_size'] ) . 'px;' : '';
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .glossary .posted_by a .datetime:hover{
			<?php echo isset( $wtl_settings['template_fthovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_fthovercolor'] ) : ''; ?>
		}
		/* Read More Button */
		<?php echo esc_attr( $layout_id ); ?> .glossary .read-more-class a.more-tag{
			<?php
			/* Font */
			echo isset( $wtl_settings['readmore_font_family'] ) ? 'font-family:' . esc_attr( $wtl_settings['readmore_font_family'] ) . ';' : '';
			echo isset( $wtl_settings['readmore_fontsize'] ) ? 'font-size:' . esc_attr( $wtl_settings['readmore_fontsize'] ) . 'px;' : '';
			echo isset( $wtl_settings['readmore_font_weight'] ) ? 'font-weight:' . esc_attr( $wtl_settings['readmore_font_weight'] ) . ';' : '';
			echo isset( $wtl_settings['readmore_font_line_height'] ) ? 'line-height:' . esc_attr( $wtl_settings['readmore_font_line_height'] ) . ';' : '';
			echo isset( $wtl_settings['readmore_font_italic'] ) ? 'font-style' . esc_attr( $wtl_settings['readmore_font_italic'] ) . ';' : '';
			echo isset( $wtl_settings['readmore_font_text_transform'] ) ? 'text-transform:' . esc_attr( $wtl_settings['readmore_font_text_transform'] ) . ';' : '';
			echo isset( $wtl_settings['readmore_font_text_decoration'] ) ? 'text-decoration:' . esc_attr( $wtl_settings['readmore_font_text_decoration'] ) . ';' : '';
			echo isset( $wtl_settings['readmore_font_letter_spacing'] ) ? 'letter-spacing:' . esc_attr( $wtl_settings['readmore_font_letter_spacing'] ) . ';' : '';
			/* Padding */
			echo isset( $wtl_settings['readmore_button_paddingleft'] ) ? 'padding-left:' . esc_attr( $wtl_settings['readmore_button_paddingleft'] ) . 'px;' : '';
			echo isset( $wtl_settings['readmore_button_paddingright'] ) ? 'padding-right:' . esc_attr( $wtl_settings['readmore_button_paddingright'] ) . 'px;' : '';
			echo isset( $wtl_settings['readmore_button_paddingtop'] ) ? 'padding-top:' . esc_attr( $wtl_settings['readmore_button_paddingtop'] ) . 'px;' : '';
			echo isset( $wtl_settings['readmore_button_paddingbottom'] ) ? 'padding-bottom:' . esc_attr( $wtl_settings['readmore_button_paddingbottom'] ) . 'px;' : '';
			/* Margin */
			echo isset( $wtl_settings['readmore_button_marginleft'] ) ? 'margin-top:' . esc_attr( $wtl_settings['readmore_button_marginleft'] ) . 'px;' : '';
			echo isset( $wtl_settings['readmore_button_marginright'] ) ? 'margin-bottom:' . esc_attr( $wtl_settings['readmore_button_marginright'] ) : '';
			echo isset( $wtl_settings['readmore_button_margintop'] ) ? 'margin-right:' . esc_attr( $wtl_settings['readmore_button_margintop'] ) . 'px;' : '';
			echo isset( $wtl_settings['readmore_button_marginbottom'] ) ? 'margin-left:' . esc_attr( $wtl_settings['readmore_button_marginbottom'] ) . 'px;' : '';
			/* Background/Color */
			echo isset( $wtl_settings['template_readmorebackcolor'] ) ? 'background: ' . esc_attr( $wtl_settings['template_readmorebackcolor'] ) . ' !important;' : '';
			echo isset( $wtl_settings['template_readmorecolor'] ) ? 'color: ' . esc_attr( $wtl_settings['template_readmorecolor'] ) . ';' : '';
			/* Border Radiouis */
			echo isset( $wtl_settings['readmore_button_border_radius'] ) ? 'border-radius:' . esc_attr( $wtl_settings['readmore_button_border_radius'] ) . 'px;' : '';
			/* Border Size */
			echo isset( $wtl_settings['wp_timeline_readmore_button_borderleft'] ) ? 'border-left:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_borderleft'] ) . 'px;' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_borderright'] ) ? 'border-right:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_borderright'] ) . 'px;' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_bordertop'] ) ? 'border-top:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_bordertop'] ) . 'px;' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_borderbottom'] ) ? 'border-bottom:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_borderbottom'] ) . 'px;' : '';
			/* Border Style */
			echo isset( $wtl_settings['read_more_button_border_style'] ) ? 'border-style:' . esc_attr( $wtl_settings['read_more_button_border_style'] ) . ';' : '';
			/* Border Color */
			echo isset( $wtl_settings['wp_timeline_readmore_button_borderleftcolor'] ) ? 'border-left-color: ' . esc_attr( $wtl_settings['wp_timeline_readmore_button_borderleftcolor'] ) . ';' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_borderrightcolor'] ) ? 'border-right-color: ' . esc_attr( $wtl_settings['wp_timeline_readmore_button_borderrightcolor'] ) . ';' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_bordertopcolor'] ) ? 'border-top-color: ' . esc_attr( $wtl_settings['wp_timeline_readmore_button_bordertopcolor'] ) . ';' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_borderbottomcolor'] ) ? 'border-bottom-color:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_borderbottomcolor'] ) . ';' : '';
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .glossary .read-more-class a.more-tag:hover{
			<?php
			/* Color */
			echo isset( $wtl_settings['template_readmore_hover_backcolor'] ) ? 'background: ' . esc_attr( $wtl_settings['template_readmore_hover_backcolor'] ) . ' !important;' : '';
			echo isset( $wtl_settings['template_readmorehovercolor'] ) ? 'color: ' . esc_attr( $wtl_settings['template_readmorehovercolor'] ) . ';' : '';
			/* Border Radiouis */
			echo isset( $wtl_settings['readmore_button_hover_border_radius'] ) ? 'border-radius:' . esc_attr( $wtl_settings['readmore_button_hover_border_radius'] ) . 'px;' : '';
			/* Border Size */
			echo isset( $wtl_settings['wp_timeline_readmore_button_hover_borderleft'] ) ? 'border-left:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_hover_borderleft'] ) . 'px;' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_hover_borderright'] ) ? 'border-right:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_hover_borderright'] ) . 'px;' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_hover_bordertop'] ) ? 'border-top:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_hover_bordertop'] ) . 'px;' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_hover_borderbottom'] ) ? 'border-bottom:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_hover_borderbottom'] ) . 'px;' : '';
			/* Border Style */
			echo isset( $wtl_settings['read_more_button_hover_border_style'] ) ? 'border-style:' . esc_attr( $wtl_settings['read_more_button_hover_border_style'] ) . ';' : '';
			/* Border Color */
			echo isset( $wtl_settings['wp_timeline_readmore_button_hover_borderleftcolor'] ) ? 'border-left-color: ' . esc_attr( $wtl_settings['wp_timeline_readmore_button_hover_borderleftcolor'] ) . ';' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_hover_borderrightcolor'] ) ? 'border-right-color: ' . esc_attr( $wtl_settings['wp_timeline_readmore_button_hover_borderrightcolor'] ) . ';' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_hover_bordertopcolor'] ) ? 'border-top-color: ' . esc_attr( $wtl_settings['wp_timeline_readmore_button_hover_bordertopcolor'] ) . ';' : '';
			echo isset( $wtl_settings['wp_timeline_readmore_button_hover_borderbottomcolor'] ) ? 'border-bottom-color:' . esc_attr( $wtl_settings['wp_timeline_readmore_button_hover_borderbottomcolor'] ) . ';' : '';
			?>
		}
		<?php echo esc_attr( $layout_id ); ?>.glossary a.more-tag{
			opacity:0.9
		}
		<?php if ( isset( $readmorebutton_on ) && 2 == $readmorebutton_on ) {  ?>
			<?php echo esc_attr( $layout_id ); ?> .glossary a.more-tag:hover {
				<?php echo isset( $wtl_settings['readmorehoverbackcolor'] ) ? 'background: ' . esc_attr( $wtl_settings['readmorehoverbackcolor'] ) . ';' : ''; ?>
			}
		<?php } ?>
		<?php echo esc_attr( $layout_id ); ?> .glossary .post_content-inner {
			border-color: <?php echo esc_attr( $wtl_settings['template_readmore_hover_backcolor'] ); ?> !important;
		}
		<?php if ( isset( $firstletter_big ) && 1 == $firstletter_big ) {  ?>
			<?php echo esc_attr( $layout_id ); ?> .glossary div.post-content .post_content-inner > *:first-child:first-letter,
			<?php echo esc_attr( $layout_id ); ?> .glossary div.post-content .post_content-inner> p:first-child:first-letter,
			<?php echo esc_attr( $layout_id ); ?> .glossary div.post-content .post_content-inner:first-letter,
			<?php echo esc_attr( $layout_id ); ?> .glossary div.post_content .post_content-inner > *:first-child:first-letter,
			<?php echo esc_attr( $layout_id ); ?> .glossary div.post_content .post_content-inner> p:first-child:first-letter {
				float: left;
				margin-right:5px;
			}
		<?php } ?>
		/*media */
		@media screen and (max-width: 979px) {
			<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .blog_template.timeline_graph:nth-child(3n+1) .posted_by{
				background-color: <?php echo isset( $template_bgcolor1 ) ? esc_attr($template_bgcolor1) . ';' : ''; ?>
			}
			<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .blog_template.timeline_graph:nth-child(3n+2) .posted_by{
				background-color: <?php echo isset( $template_bgcolor2 ) ? esc_attr($template_bgcolor2) . ';' : ''; ?>
			}
			<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .blog_template.timeline_graph:nth-child(3n+3) .posted_by{
				background-color: <?php echo isset( $template_bgcolor3 ) ? esc_attr($template_bgcolor3) . ';' : ''; ?>
			}
		}
		@media screen and (max-width: 721px) {
			<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .blog_template.timeline_graph:nth-child(2n+1) .posted_by{
				background-color: <?php echo isset( $template_bgcolor1 ) ? esc_attr($template_bgcolor1) . ';' : ''; ?>
			}
			<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper .blog_template.timeline_graph:nth-child(2n+2) .posted_by{
				background-color: <?php echo isset( $template_bgcolor2 ) ? esc_attr($template_bgcolor2) . ';' : ''; ?>
			}
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category .category-link {
			background: <?php echo $template_categorybgcolor; ?> !important;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category {
			background: transparent !important;
		}
		/* Drop Cap css*/
		<?php
		echo Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ); 
		echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
}

	/* ------------------ Template: Boxy Layout ----------- */
if ( 'boxy_layout' === $wp_timeline_theme ) {
	echo Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ); 
	echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
	?>
	/* Time Line Settings */
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl-schedule-wrap:before,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_loop_cnt:before,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_loop_cnt:after,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_left_side .post-body-div:before,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_right_side .post-body-div:before,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_left_side .post-body-div:after,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_right_side .post-body-div:after
	{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'border-radius:' . esc_attr( $wtl_settings['template_icon_border_radious'] ) . 'px !important;';
		}
		?>
	}
	/* Time Line Settings End */
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper{
		<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) . ';' : ''; ?>
		}
		<?php
		$template_ftcolor          = isset( $wtl_settings['template_ftcolor'] ) ? $wtl_settings['template_ftcolor'] : '';
		$template_fthovercolor     = isset( $wtl_settings['template_fthovercolor'] ) ? $wtl_settings['template_fthovercolor'] : '';
		$meta_font_family          = isset( $wtl_settings['meta_font_family'] ) ? $wtl_settings['meta_font_family'] : '';
		$meta_fontsize             = isset( $wtl_settings['meta_fontsize'] ) ? $wtl_settings['meta_fontsize'] : '';
		$meta_font_weight          = isset( $wtl_settings['meta_font_weight'] ) ? $wtl_settings['meta_font_weight'] : '';
		$meta_font_line_height     = isset( $wtl_settings['meta_font_line_height'] ) ? $wtl_settings['meta_font_line_height'] : '';
		$meta_font_italic          = isset( $wtl_settings['meta_font_italic'] ) ? $wtl_settings['meta_font_italic'] : '';
		$meta_font_text_transform  = isset( $wtl_settings['meta_font_text_transform'] ) ? $wtl_settings['meta_font_text_transform'] : '';
		$meta_font_text_decoration = isset( $wtl_settings['meta_font_text_decoration'] ) ? $wtl_settings['meta_font_text_decoration'] : '';
		$meta_font_letter_spacing  = isset( $wtl_settings['meta_font_letter_spacing'] ) ? $wtl_settings['meta_font_letter_spacing'] : '';

		?>
		/* Meta Font Family */
		<?php echo esc_attr( $layout_id ); ?> .metadatabox span,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-image .category-link,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-image .category-link a,
		<?php echo esc_attr( $layout_id ); ?> .metadatabox{
		<?php
		if ( $meta_font_family ) {
			echo 'font-family:' . esc_attr( $meta_font_family ) . ';';
		}
		echo 'font-size:' . esc_attr( $meta_fontsize ) . 'px;';
		echo 'font-weight:' . esc_attr( $meta_font_weight ) . ';';
		echo 'line-height:' . esc_attr( $meta_font_line_height ) . ';';
		if ( 1 == $meta_font_italic ) { 
			echo 'font-style:italic;';
		} else {
			echo 'font-style:normal;';
		}
		echo 'text-transform:' . esc_attr( $meta_font_text_transform ) . ';';
		echo 'text-decoration:' . esc_attr( $meta_font_text_decoration ) . ' !important;';
		echo 'letter-spacing:' . esc_attr( $meta_font_letter_spacing ) . 'px;';
		?>
		}
		<?php echo esc_attr( $layout_id ); ?> .footer_meta .wtl-post-category span,
		<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .link-lable,
		<?php echo esc_attr( $layout_id ); ?> .metadatabox span,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-content a,
		<?php echo esc_attr( $layout_id ); ?> .metadatabox .post-author a,
		<?php echo esc_attr( $layout_id ); ?> .metadatabox .mdate a,
		<?php echo esc_attr( $layout_id ); ?> .metadatabox .metacomments a,
		<?php echo esc_attr( $layout_id ); ?>  .wtl-wrapper-like a{
		<?php
		if ( $meta_font_family ) {
			echo 'font-family:' . esc_attr( $meta_font_family ) . ';';
		}
		echo 'color:' . esc_attr( $template_ftcolor ) . ';';
		echo 'font-size:' . esc_attr( $meta_fontsize ) . 'px;';
		echo 'font-weight:' . esc_attr( $meta_font_weight ) . ';';
		echo 'line-height:' . esc_attr( $meta_font_line_height ) . ';';
		if ( 1 == $meta_font_italic ) { 
			echo 'font-style:italic;';
		} else {
			echo 'font-style:normal;';
		}
		echo 'text-transform:' . esc_attr( $meta_font_text_transform ) . ';';
		echo 'text-decoration:' . esc_attr( $meta_font_text_decoration ) . ' !important;';
		echo 'letter-spacing:' . esc_attr( $meta_font_letter_spacing ) . 'px;';
		?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-content a:hover,
		<?php echo esc_attr( $layout_id ); ?> .metadatabox .post-author a:hover,
		<?php echo esc_attr( $layout_id ); ?> .metadatabox .mdate a:hover,
		<?php echo esc_attr( $layout_id ); ?> .metadatabox .metacomments a:hover,
		<?php echo esc_attr( $layout_id ); ?>  .wtl-wrapper-like a:hover{
			<?php
			echo 'color:' . esc_attr( $template_fthovercolor ) . ' !important;';
			?>
		}
		.wtl_is_horizontal .wtl-ss-left i, .wtl_is_horizontal .wtl-ss-right i {
			<?php
			echo isset( $wtl_settings['navigation_color'] ) ? 'color:' . esc_attr( $wtl_settings['navigation_color'] ) . ';' : '';
			echo isset( $wtl_settings['navigation_bg_color'] ) ? 'background:' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ' !important;' : '';
			echo isset( $wtl_settings['navigation_arrow_size'] ) ? 'font-size:' . esc_attr( $wtl_settings['navigation_arrow_size'] ) . 'px;' : '';
			?>
		}
		/* Category */
		<?php
		$template_readmorebackcolor        = isset( $wtl_settings['template_readmorebackcolor'] ) ? $wtl_settings['template_readmorebackcolor'] : '';
		$template_readmore_hover_backcolor = isset( $wtl_settings['template_readmore_hover_backcolor'] ) ? $wtl_settings['template_readmore_hover_backcolor'] : '';
		$readmore_font_family              = isset( $wtl_settings['readmore_font_family'] ) ? $wtl_settings['readmore_font_family'] : '';
		$readmore_fontsize                 = isset( $wtl_settings['readmore_fontsize'] ) ? $wtl_settings['readmore_fontsize'] : '';
		$readmore_font_weight              = isset( $wtl_settings['readmore_font_weight'] ) ? $wtl_settings['readmore_font_weight'] : '';
		$readmore_font_line_height         = isset( $wtl_settings['readmore_font_line_height'] ) ? $wtl_settings['readmore_font_line_height'] : '';
		$readmore_font_italic              = isset( $wtl_settings['readmore_font_italic'] ) ? $wtl_settings['readmore_font_italic'] : '';
		$readmore_font_text_transform      = isset( $wtl_settings['readmore_font_text_transform'] ) ? $wtl_settings['readmore_font_text_transform'] : '';
		$readmore_font_text_decoration     = isset( $wtl_settings['readmore_font_text_decoration'] ) ? $wtl_settings['readmore_font_text_decoration'] : '';
		$readmore_font_letter_spacing      = isset( $wtl_settings['readmore_font_letter_spacing'] ) ? $wtl_settings['readmore_font_letter_spacing'] : '';
		?>
		<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template.media-grid .wtl-post-image .category-link {
		<?php
		echo 'background:' . esc_attr( $template_readmorebackcolor ) . ' !important;';
		if ( $readmore_font_family ) {
			echo 'font-family:' . esc_attr( $readmore_font_family ) . ' !important;';
		}
		echo 'font-size:' . esc_attr( $readmore_fontsize ) . 'px;';
		echo 'font-weight:' . esc_attr( $readmore_font_weight ) . ';';
		echo 'line-height:' . esc_attr( $readmore_font_line_height ) . ';';
		if ( 1 == $readmore_font_italic ) { 
			echo 'font-style:italic;';
		} else {
			echo 'font-style:normal;';
		}
		echo 'text-transform:' . esc_attr( $readmore_font_text_transform ) . ';';
		echo 'text-decoration:' . esc_attr( $readmore_font_text_decoration ) . ';';
		echo 'letter-spacing:' . esc_attr( $readmore_font_letter_spacing ) . 'px;';
		echo isset( $wtl_settings['template_readmorecolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_readmorecolor'] ) . ' !important;' : '';
		?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template.media-grid .wtl-post-image .category-link a{
			<?php
			echo isset( $wtl_settings['template_readmorecolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_readmorecolor'] ) . ' !important;' : '';
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template.media-grid .wtl-post-image .category-link:hover,
		<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template.media-grid .wtl-post-image .category-link a:hover{
			<?php
			echo isset( $wtl_settings['template_readmorehovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_readmorehovercolor'] ) . ' !important;' : '';
			?>
		}
		/* Content Box */
		<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template.media-grid .content-inner{
			<?php
			echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
			?>
		}
		<?php
		/* Check if Media Enable */
		if ( isset( $wtl_settings['wp_timeline_enable_media'] ) ? $wtl_settings['wp_timeline_enable_media'] : '' ) {
			?>
			<?php echo esc_attr( $layout_id ); ?> .footer_meta .wtl-post-category span{ display: none !important; }
			<?php echo esc_attr( $layout_id ); ?> .footer_meta .wtl-post-category .post-category.taxonomies,
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-category .post-category.taxonomies span	{ display: block !important; }
			<?php
		} else {
			?>
			<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template.media-grid .content-container{
				top: unset !important;
			}
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-image span{  opacity: 0 }
			<?php
		}
		?>

		<?php
}
	/* ------------------ Template: Wise Layout ----------- */
if ( 'wise_layout' === $wp_timeline_theme ) {
	echo Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ); 
	echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
	?>
	/* Time Line Settings */
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl-schedule-wrap:before,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_loop_cnt:before,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_loop_cnt:after,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_left_side:before,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_right_side:before,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_left_side:after,
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wtl_is_vertical .wtl_right_side:after
	{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'border-radius:' . esc_attr( $wtl_settings['template_icon_border_radious'] ) . 'px !important;';
		}
		?>
	}
	/* Time Line Settings End */
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper,
		/*<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wise_block_cover:before{*/
			<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper.wise_block_cover{
		<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) . ';' : ''; ?>
		}
		/* Box */
		<?php echo esc_attr( $layout_id ); ?> .blog_template.wise_block_blog .wtl_blog_wraper{
		<?php
		echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
		echo isset( $wtl_settings['template_categorybgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_categorybgcolor'] ) . ';' : '';
		?>
		}
		/* Meta */
		<?php
		$template_ftcolor          = isset( $wtl_settings['template_ftcolor'] ) ? $wtl_settings['template_ftcolor'] : '';
		$template_fthovercolor     = isset( $wtl_settings['template_fthovercolor'] ) ? $wtl_settings['template_fthovercolor'] : '';
		$meta_font_family          = isset( $wtl_settings['meta_font_family'] ) ? $wtl_settings['meta_font_family'] : '';
		$meta_fontsize             = isset( $wtl_settings['meta_fontsize'] ) ? $wtl_settings['meta_fontsize'] : '';
		$meta_font_weight          = isset( $wtl_settings['meta_font_weight'] ) ? $wtl_settings['meta_font_weight'] : '';
		$meta_font_line_height     = isset( $wtl_settings['meta_font_line_height'] ) ? $wtl_settings['meta_font_line_height'] : '';
		$meta_font_italic          = isset( $wtl_settings['meta_font_italic'] ) ? $wtl_settings['meta_font_italic'] : '';
		$meta_font_text_transform  = isset( $wtl_settings['meta_font_text_transform'] ) ? $wtl_settings['meta_font_text_transform'] : '';
		$meta_font_text_decoration = isset( $wtl_settings['meta_font_text_decoration'] ) ? $wtl_settings['meta_font_text_decoration'] : '';
		$meta_font_letter_spacing  = isset( $wtl_settings['meta_font_letter_spacing'] ) ? $wtl_settings['meta_font_letter_spacing'] : '';
		?>
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category .post-category span,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags .link-lable,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category span,
		<?php echo esc_attr( $layout_id ); ?> .metadatabox span,
		<?php echo esc_attr( $layout_id ); ?> .metadatabox a.comments-link,
		<?php echo esc_attr( $layout_id ); ?> .metadatabox a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-wise-block-author span,
		<?php echo esc_attr( $layout_id ); ?> .wtl-wise-block-author span a,
		<?php echo esc_attr( $layout_id ); ?> .post-category,
		<?php echo esc_attr( $layout_id ); ?> .post-category a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a{
		<?php
		if ( $meta_font_family ) {
			echo 'font-family:' . esc_attr( $meta_font_family ) . ';';
		}
		echo 'color:' . esc_attr( $template_ftcolor ) . ';';
		echo 'font-size:' . esc_attr( $meta_fontsize ) . 'px !important;';
		echo 'font-weight:' . esc_attr( $meta_font_weight ) . ';';
		echo 'line-height:' . esc_attr( $meta_font_line_height ) . ';';
		if ( 1 == $meta_font_italic ) { 
			echo 'font-style:italic;';
		} else {
			echo 'font-style:normal;';
		}
		echo 'text-transform:' . esc_attr( $meta_font_text_transform ) . ';';
		echo 'text-decoration:' . esc_attr( $meta_font_text_decoration ) . ' !important;';
		echo 'letter-spacing:' . esc_attr( $meta_font_letter_spacing ) . 'px;';
		?>
		}
		<?php echo esc_attr( $layout_id ); ?> .metadatabox span:hover,
		<?php echo esc_attr( $layout_id ); ?> .metadatabox a.comments-link:hover,
		<?php echo esc_attr( $layout_id ); ?> .metadatabox a:hover,
		<?php echo esc_attr( $layout_id ); ?> .wtl-wise-block-author span:hover,
		<?php echo esc_attr( $layout_id ); ?> .wtl-wise-block-author span a:hover,
		<?php echo esc_attr( $layout_id ); ?> .post-category a:hover{
			<?php
			echo 'color:' . esc_attr( $template_fthovercolor ) . ';';
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category span{ display: none !important; }
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category .post-category.taxonomies,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category .post-category.taxonomies span{ display: inline-block !important; }
		<?php echo esc_attr( $layout_id ); ?> .wtl-ss-left, 
		<?php echo esc_attr( $layout_id ); ?> .wtl-ss-right {
			<?php echo isset( $wtl_settings['navigation_bg_color'] ) ? 'background:' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-ss-left i, 
		<?php echo esc_attr( $layout_id ); ?> .wtl-ss-right i {
			<?php echo isset( $wtl_settings['navigation_color'] ) ? 'color:' . esc_attr( $wtl_settings['navigation_color'] ) . ';' : ''; ?>
			<?php echo isset( $wtl_settings['navigation_arrow_size'] ) ? 'font-size:' . esc_attr( $wtl_settings['navigation_arrow_size'] ) . 'px;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .post-category {
			<?php echo isset( $wtl_settings['template_categorybgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_categorybgcolor'] ) . ';' : ''; ?>
		}
		<?php
}

/*------------------ Template: Cover Layout --------------- */
if ( 'cover_layout' === $wp_timeline_theme ) {
	?>
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper{
		<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) : '#fff'; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl_steps_wrap{
		<?php echo isset( $wtl_settings['template_titlecolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_titlecolor'] ) . ' !important;' : ''; ?>
	}
	/* Box */
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl_steps .wtl_blog_single_post_wrapp{
		<?php
		echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) );
		echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) : '#f0f0f0';
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> h2.wtl-post-title{
		<?php echo esc_attr( Wtl_Template_Advanced_Layout::content_box_border_radious_title( $wtl_settings ) ); ?>
	}
	<?php
	echo esc_attr( Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_content_color( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
	?>
	/* Timeline Color */
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_post_year,
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_wrap .wtl_steps::before,
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_wrap .wtl_steps:after{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_wrap:before{
		<?php
		if ( isset( $wtl_settings['template_color2'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_color2'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl_steps .wtl_blog_single_post_wrapp .wtl_steps_post_format:before{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?>.hide_timeline_icon .wtl_steps_post_format:before{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl_steps .wtl_blog_single_post_wrapp .wtl_steps_post_format{
		<?php
		if ( isset( $wtl_settings['template_icon_border_radious'] ) ) {
			echo 'border-radius:' . esc_attr( $wtl_settings['template_icon_border_radious'] ) . '% !important';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a{
		<?php
		$template_ftcolor = isset( $wtl_settings['template_ftcolor'] ) ? $wtl_settings['template_ftcolor'] : '';
		if ( $template_ftcolor ) {
			echo 'color:' . esc_attr( $template_ftcolor ) . ';';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a:hover{
		<?php
		$template_fthovercolor = isset( $wtl_settings['template_fthovercolor'] ) ? $wtl_settings['template_fthovercolor'] : '';
		if ( $template_fthovercolor ) {
			echo 'color:' . esc_attr( $template_fthovercolor ) . ';';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-ss-left i,
	<?php echo esc_attr( $layout_id ); ?> .wtl-ss-right i,
	<?php echo esc_attr( $layout_id ); ?>.hide_timeline_icon .wtl_steps_post_format:after {
		<?php
		$navigation_bg_color = isset( $wtl_settings['navigation_bg_color'] ) ? $wtl_settings['navigation_bg_color'] : '';
		if ( $navigation_bg_color ) {
			echo 'background:' . esc_attr( $navigation_bg_color ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtl_al_nav .slick-track:before {
		<?php
		$navigation_bg_color = isset( $wtl_settings['navigation_bg_color'] ) ? $wtl_settings['navigation_bg_color'] : '';
		if ( $navigation_bg_color ) {
			echo 'border-color:' . esc_attr( $navigation_bg_color ) . ';';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-ss-left i,
	<?php echo esc_attr( $layout_id ); ?> .wtl-ss-right i,
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_post_format i {
		<?php
		$navigation_color = isset( $wtl_settings['navigation_color'] ) ? $wtl_settings['navigation_color'] : '';
		if ( $navigation_color ) {
			echo 'color:' . esc_attr( $navigation_color ) . ' !important;';
		}
		$navigation_arrow_size = isset( $wtl_settings['navigation_arrow_size'] ) ? $wtl_settings['navigation_arrow_size'] : '';
		if ( $navigation_arrow_size ) {
			echo 'font-size:' . esc_attr( $navigation_arrow_size ) . 'px;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_post_format {
		<?php
		if ( isset( $wtl_settings['navigation_color'] ) ) {
			echo 'border-color:' . esc_attr( $wtl_settings['navigation_color'] ) . ' !important;';
		}
		?>
	}
	/* Tag only*/
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a{
		<?php
		echo isset( $wtl_settings['template_readmorebackcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_readmorebackcolor'] ) . ';' : '';
		echo isset( $wtl_settings['template_readmorecolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_readmorecolor'] ) . ';' : '';
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a:hover{
		<?php
		echo isset( $wtl_settings['template_readmore_hover_backcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_readmore_hover_backcolor'] ) . ';' : '';
		echo isset( $wtl_settings['template_readmorehovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_readmorehovercolor'] ) . ' !important;' : '';
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .author a,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a,
	<?php echo esc_attr( $layout_id ); ?> .comments-link{
		<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ' !important;' : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .author a:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a:hover,
	<?php echo esc_attr( $layout_id ); ?> .comments-link:hover{
		<?php echo isset( $wtl_settings['template_fthovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_fthovercolor'] ) . ' !important;' : ''; ?>
	}
	<?php
	$border_width = isset( $wtl_settings['wp_timeline_content_border_width'] ) ? $wtl_settings['wp_timeline_content_border_width'] : '';
	$border_style = isset( $wtl_settings['wp_timeline_content_border_style'] ) ? $wtl_settings['wp_timeline_content_border_style'] : '';
	$border_color = isset( $wtl_settings['wp_timeline_content_border_color'] ) ? $wtl_settings['wp_timeline_content_border_color'] : '';
	?>
	<?php echo esc_attr( $layout_id ); ?> #wtl_steps .wtl_blog_template .wtl_blog_single_post_wrapp:before{
		border-top: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
		border-right: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
		<?php echo isset( $wtl_settings['template_content_box_bg_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_content_box_bg_color'] ) : '#fff'; ?>
	}
	<?php
}
/*------------------ Template: Rounded Layout --------------- */
if ( 'rounded_layout' === $wp_timeline_theme ) {
	?>
	<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper{
		<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) : '#fff'; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl_steps_wrap{
		<?php echo isset( $wtl_settings['template_titlecolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_titlecolor'] ) . ' !important;' : ''; ?>
	}
	/* Box */
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl_steps .wtl_blog_single_post_wrapp{
		<?php
		echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) );
		echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> h2.wtl-post-title{
		<?php echo esc_attr( Wtl_Template_Advanced_Layout::content_box_border_radious_title( $wtl_settings ) ); ?>
	}
	<?php
	echo esc_attr( Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_content_color( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
	echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
	?>
	/* Timeline Color */
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_post_year,
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_wrap .wtl_steps::before,
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_wrap .wtl_steps:after{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_wrap:before{
		<?php
		if ( isset( $wtl_settings['template_color2'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_color2'] ) . ' !important;';
		}
		?>
	}
	/* Slider Navigation */
	<?php echo esc_attr( $layout_id ); ?> .wtl-ss-left,
	<?php echo esc_attr( $layout_id ); ?> .wtl-ss-right{
		<?php
		if ( isset( $wtl_settings['template_color2'] ) ) {
			echo 'border-color:' . esc_attr( $wtl_settings['template_color2'] ) . ' !important;';
		}
		?>
		background: #fff;
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-ss-left i,
	<?php echo esc_attr( $layout_id ); ?> .wtl-ss-right i{
		<?php
		echo 'color:' . esc_attr( $wtl_settings['navigation_color'] ) . ' !important;';
		echo 'background:' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ' !important;';
		echo 'font-size:' . esc_attr( $wtl_settings['navigation_arrow_size'] ) . 'px;';
		?>
	}
	<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtl_al_nav .slick-track:before{
		<?php
		if ( isset( $wtl_settings['navigation_color'] ) ) {
			echo 'border-color:' . esc_attr( $wtl_settings['navigation_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_post_format{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'border-color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_steps_post_format i,
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl_steps .wtl_blog_single_post_wrapp .wtl_steps_post_format:before{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?>.hide_timeline_icon .wtl_steps_post_format:after{
		<?php
		if ( isset( $wtl_settings['template_color2'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_color2'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?>.hide_timeline_icon .wtl_steps_post_format:before{
		<?php
		if ( isset( $wtl_settings['template_color'] ) ) {
			echo 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl_steps .wtl_blog_single_post_wrapp .wtl_steps_post_format{
		<?php
		if ( isset( $wtl_settings['template_icon_border_radious'] ) ) {
			echo 'border-radius:' . esc_attr( $wtl_settings['template_icon_border_radious'] ) . '% !important';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a{
		<?php
		$template_ftcolor = isset( $wtl_settings['template_ftcolor'] ) ? $wtl_settings['template_ftcolor'] : '';
		if ( $template_ftcolor ) {
			echo 'color:' . esc_attr( $template_ftcolor ) . ';';
		}
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a:hover{
		<?php
		$template_fthovercolor = isset( $wtl_settings['template_fthovercolor'] ) ? $wtl_settings['template_fthovercolor'] : '';
		if ( $template_fthovercolor ) {
			echo 'color:' . esc_attr( $template_fthovercolor ) . ';';
		}
		?>
	}

	/* Meta Font Family */
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-meta,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-content a,
	<?php echo esc_attr( $layout_id ); ?> .metadatabox .post-author a,
	<?php echo esc_attr( $layout_id ); ?> .metadatabox .mdate a,
	<?php echo esc_attr( $layout_id ); ?> .metadatabox .metacomments a,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-wrapper-like a{
	<?php
	if ( $meta_font_family ) {
		echo 'font-family:' . esc_attr( $meta_font_family ) . ';';
	}
	echo 'color:' . esc_attr( $template_ftcolor ) . ';';
	echo 'font-size:' . esc_attr( $meta_fontsize ) . 'px;';
	echo 'font-weight:' . esc_attr( $meta_font_weight ) . ';';
	echo 'line-height:' . esc_attr( $meta_font_line_height ) . ';';
	if ( 1 == $meta_font_italic ) { 
		echo 'font-style:italic;';
	} else {
		echo 'font-style:normal;';
	}
	echo 'text-transform:' . esc_attr( $meta_font_text_transform ) . ';';
	echo 'text-decoration:' . esc_attr( $meta_font_text_decoration ) . ' !important;';
	echo 'letter-spacing:' . esc_attr( $meta_font_letter_spacing ) . 'px;';
	?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-content a:hover,
	<?php echo esc_attr( $layout_id ); ?> .metadatabox .post-author a:hover,
	<?php echo esc_attr( $layout_id ); ?> .metadatabox .mdate a:hover,
	<?php echo esc_attr( $layout_id ); ?> .metadatabox .metacomments a:hover,
	<?php echo esc_attr( $layout_id ); ?>  .wtl-wrapper-like a:hover{
		<?php
		echo 'color:' . esc_attr( $template_fthovercolor ) . ' !important;';
		?>
	}
	/* Caegory */
	<?php
	$template_readmorebackcolor        = isset( $wtl_settings['template_readmorebackcolor'] ) ? $wtl_settings['template_readmorebackcolor'] : '';
	$template_readmore_hover_backcolor = isset( $wtl_settings['template_readmore_hover_backcolor'] ) ? $wtl_settings['template_readmore_hover_backcolor'] : '';
	$readmore_font_family              = isset( $wtl_settings['readmore_font_family'] ) ? $wtl_settings['readmore_font_family'] : '';
	$readmore_fontsize                 = isset( $wtl_settings['readmore_fontsize'] ) ? $wtl_settings['readmore_fontsize'] : '';
	$readmore_font_weight              = isset( $wtl_settings['readmore_font_weight'] ) ? $wtl_settings['readmore_font_weight'] : '';
	$readmore_font_line_height         = isset( $wtl_settings['readmore_font_line_height'] ) ? $wtl_settings['readmore_font_line_height'] : '';
	$readmore_font_italic              = isset( $wtl_settings['readmore_font_italic'] ) ? $wtl_settings['readmore_font_italic'] : '';
	$readmore_font_text_transform      = isset( $wtl_settings['readmore_font_text_transform'] ) ? $wtl_settings['readmore_font_text_transform'] : '';
	$readmore_font_text_decoration     = isset( $wtl_settings['readmore_font_text_decoration'] ) ? $wtl_settings['readmore_font_text_decoration'] : '';
	$readmore_font_letter_spacing      = isset( $wtl_settings['readmore_font_letter_spacing'] ) ? $wtl_settings['readmore_font_letter_spacing'] : '';
	?>
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template.media-grid .wtl-post-image .category-link {
	<?php
	echo 'background:' . esc_attr( $template_readmorebackcolor ) . ' !important;';
	if ( $readmore_font_family ) {
		echo 'font-family:' . esc_attr( $readmore_font_family ) . ' !important;';
	}
	echo 'font-size:' . esc_attr( $readmore_fontsize ) . 'px;';
	echo 'font-weight:' . esc_attr( $readmore_font_weight ) . ';';
	echo 'line-height:' . esc_attr( $readmore_font_line_height ) . ';';
	if ( 1 == $readmore_font_italic ) { 
		echo 'font-style:italic;';
	} else {
		echo 'font-style:normal;';
	}
	echo 'text-transform:' . esc_attr( $readmore_font_text_transform ) . ';';
	echo 'text-decoration:' . esc_attr( $readmore_font_text_decoration ) . ';';
	echo 'letter-spacing:' . esc_attr( $readmore_font_letter_spacing ) . 'px;';
	echo isset( $wtl_settings['template_readmorecolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_readmorecolor'] ) . ' !important;' : '';
	?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template.media-grid .wtl-post-image .category-link a{
		<?php
		echo isset( $wtl_settings['template_readmorecolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_readmorecolor'] ) . ' !important;' : '';
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template.media-grid .wtl-post-image .category-link:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template.media-grid .wtl-post-image .category-link a:hover{
		<?php
		echo isset( $wtl_settings['template_readmorehovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_readmorehovercolor'] ) . ' !important;' : '';
		?>
	}
	/* Tag only*/
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a{
		<?php
		echo isset( $wtl_settings['template_readmorebackcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_readmorebackcolor'] ) . ';' : '';
		echo isset( $wtl_settings['template_readmorecolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_readmorecolor'] ) . ';' : '';
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a:hover{
		<?php
		echo isset( $wtl_settings['template_readmore_hover_backcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_readmore_hover_backcolor'] ) . ';' : '';
		echo isset( $wtl_settings['template_readmorehovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_readmorehovercolor'] ) . ' !important;' : '';
		?>
	}
	<?php echo esc_attr( $layout_id ); ?> .author a,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a,
	<?php echo esc_attr( $layout_id ); ?> .comments-link,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-meta
	{
		<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ' !important;' : ''; ?>
	}
	<?php echo esc_attr( $layout_id ); ?> .author a:hover,
	<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a:hover,
	<?php echo esc_attr( $layout_id ); ?> .comments-link:hover{
		<?php echo isset( $wtl_settings['template_fthovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_fthovercolor'] ) . ' !important;' : ''; ?>
	}
	<?php
	$border_width = isset( $wtl_settings['wp_timeline_content_border_width'] ) ? $wtl_settings['wp_timeline_content_border_width'] : '';
	$border_style = isset( $wtl_settings['wp_timeline_content_border_style'] ) ? $wtl_settings['wp_timeline_content_border_style'] : '';
	$border_color = isset( $wtl_settings['wp_timeline_content_border_color'] ) ? $wtl_settings['wp_timeline_content_border_color'] : '';
	?>
	<?php echo esc_attr( $layout_id ); ?> #wtl_steps .wtl_blog_template .wtl_blog_single_post_wrapp:before{
		border-top: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
		border-right: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
		<?php echo isset( $wtl_settings['template_content_box_bg_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_content_box_bg_color'] ) : '#fff'; ?>
	}
	/* if media disabled */
	<?php
	if ( isset( $wtl_settings['wp_timeline_enable_media'] ) ? $wtl_settings['wp_timeline_enable_media'] : '' ) {
		?>
		<?php
	} else {
		?>
		<?php echo esc_attr( $layout_id ); ?> .wtl_clid_left,
		<?php echo esc_attr( $layout_id ); ?> .wtl_clid_right{
			width: 100%;
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-social{ position: unset !important; }
		<?php
	}
	?>
	<?php
}

/* ------------------ Template: Infographic Layout --------------- */
if ( 'infographic_layout' === $wp_timeline_theme ) {
	$template_color                     = isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#fff';
	$template_content_box_bg_color = isset( $wtl_settings['template_content_box_bg_color'] ) ? $wtl_settings['template_content_box_bg_color'] : '#fff';
	?>
	<?php if ( isset( $template_title_alignment ) && 'left' === $template_title_alignment ) { ?>
		<?php echo esc_attr( $layout_id ); ?> .infographic_layout_cover .post_even .wtl-post-title {
			text-align: right !important;
		}
	<?php } ?>
	<?php if ( isset( $template_title_alignment ) && 'right' === $template_title_alignment ) { ?>
		<?php echo esc_attr( $layout_id ); ?> .infographic_layout_cover .post_even .wtl-post-title {
			text-align: left !important;
		}
		<?php
	}
	?>
	<?php if ( isset( $wp_timeline_pricetext_alignment ) && 'left' === $wp_timeline_pricetext_alignment ) { ?>
		<?php echo esc_attr( $layout_id ); ?> .infographic_layout_cover .post_even .wp_timeline_woocommerce_price_wrap, <?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_price_wrap .price .woocommerce-Price-amount {
			text-align: right !important;
		}
	<?php } ?>
	<?php if ( isset( $wp_timeline_pricetext_alignment ) && 'right' === $wp_timeline_pricetext_alignment ) { ?>
		<?php echo esc_attr( $layout_id ); ?> .infographic_layout_cover .post_even .wp_timeline_woocommerce_price_wrap, <?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_price_wrap .price .woocommerce-Price-amount  {
			text-align: left !important;
		}
		<?php
	}
	
	?>
		<?php if ( isset( $wp_timeline_addtocartbutton_alignment ) && 'left' === $wp_timeline_addtocartbutton_alignment ) { ?>
			<?php echo esc_attr( $layout_id ); ?> .infographic_layout_cover .post_even .wp_timeline_woocommerce_add_to_cart_wrap {
			text-align: right !important;
		}
	<?php } ?>
	<?php if ( isset( $wp_timeline_addtocartbutton_alignment ) && 'right' === $wp_timeline_addtocartbutton_alignment ) { ?>
		<?php echo esc_attr( $layout_id ); ?> .infographic_layout_cover .post_even .wp_timeline_woocommerce_add_to_cart_wrap  {
			text-align: left !important;
		}
		<?php
	}
	?>
		<?php if ( isset( $wp_timeline_edd_price_alignment ) && 'left' === $wp_timeline_edd_price_alignment ) { ?>
			<?php echo esc_attr( $layout_id ); ?> .infographic_layout_cover .post_even .wp_timeline_edd_price_wrapper {
			text-align: right !important;
		}
	<?php } ?>
	<?php if ( isset( $wp_timeline_edd_price_alignment ) && 'right' === $wp_timeline_edd_price_alignment ) { ?>
		<?php echo esc_attr( $layout_id ); ?> .infographic_layout_cover .post_even .wp_timeline_edd_price_wrapper  {
			text-align: left !important;
		}
		<?php
	}
	?>
	<?php if ( isset( $wp_timeline_edd_addtocartbutton_alignment ) && 'left' === $wp_timeline_edd_addtocartbutton_alignment ) { ?>
			<?php echo esc_attr( $layout_id ); ?> .infographic_layout_cover .post_even .wtl_edd_download_buy_button {
			text-align: right !important;
		}
	<?php } ?>
	<?php if ( isset( $wp_timeline_edd_addtocartbutton_alignment ) && 'right' === $wp_timeline_edd_addtocartbutton_alignment ) { ?>
		<?php echo esc_attr( $layout_id ); ?> .infographic_layout_cover .post_even .wtl_edd_download_buy_button  {
			text-align: left !important;
		}
		<?php
	}
	?>
	<?php echo esc_attr( $layout_id ); ?>{
		<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) : '#fff'; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-read-more-div{overflow:hidden;}
		<?php echo esc_attr( $layout_id ); ?> .wp-timeline-load-more-pre,
		<?php echo esc_attr( $layout_id ); ?> .wp-timeline-load-more{z-index: 3;position: relative}
		<?php echo esc_attr( $layout_id ); ?> #wtl-load-more-hidden{ float:none; }
		<?php
		echo esc_attr( Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::post_content_color( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
		?>
		<?php echo esc_attr( $layout_id ); ?> .wtl-author a,
		<?php echo esc_attr( $layout_id ); ?> .post-comment a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-meta-comment i,
		<?php echo esc_attr( $layout_id ); ?> a.comments-link
		{
		<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-author a:hover,
		<?php echo esc_attr( $layout_id ); ?> .post-comment a:hover,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a:hover,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a:hover,
		<?php echo esc_attr( $layout_id ); ?> .wtl-meta-comment i:hover,
		<?php echo esc_attr( $layout_id ); ?> a.comments-link:hover
		{
		<?php echo isset( $wtl_settings['template_fthovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_fthovercolor'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl_post_content_schedule{
		<?php echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) ); ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-content{
		<?php
		if ( $template_content_box_bg_color ) {
			echo 'background:' . esc_attr( $template_content_box_bg_color ) . ';';
		}
		?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl_main_title{text-align:center;}

		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a
		{
		<?php echo isset( $wtl_settings['template_categorybgcolor'] ) ? 'background-color:' . esc_attr( $wtl_settings['template_categorybgcolor'] ) . ' !important;' : ''; ?>
		}
		/* Box */
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-schedule-all-post-content{
			<?php
			echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
			?>
		}
		
		/* Post Date */
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-date {
			<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-date:hover
			<?php echo isset( $wtl_settings['template_fthovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_fthovercolor'] ) . ' !important;' : ''; ?>
		}
		<?php
		echo esc_attr( Wtl_Template_Config::post_date_typography( $wtl_settings, $layout_id ) );
}

/* ------------------ Template: ZigZag Layout --------------- */
if ( 'zigzag_layout' === $wp_timeline_theme ) {
	if ( isset( $wtl_settings['wp_timeline_image_shape'] ) ) {
		if ( 'round' == $wtl_settings['wp_timeline_image_shape'] ) { ?>
				<?php echo esc_attr( $layout_id ); ?> .wtl_al_nav .wtl-post-center-image span.wtl-post-icon {  
					border-radius: 50%;
				}
			<?php } else { ?>
				<?php echo esc_attr( $layout_id ); ?> .wp-timeline-post-image img, .wp-timeline-post-image figure {  
					border-radius: 0;
				}
	<?php }
	}
	$default_line_color = isset( $wtl_settings['template_color'] ) ? $wtl_settings['template_color'] : '';
	if ( isset( $default_line_color ) ) { ?>
		<?php echo esc_attr( $layout_id ); ?> .post_odd .wtl-schedule-all-post-content:before, 
		<?php echo esc_attr( $layout_id ); ?> .post_even .wtl-schedule-all-post-content:before,
		<?php echo esc_attr( $layout_id ); ?> .post_odd .cross-line:before, 
		<?php echo esc_attr( $layout_id ); ?> .post_even .cross-line:before {
			background: <?php echo $default_line_color; ?>;
		}
   <?php }
   
	$template_color                     = isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#fff';
	$template_content_box_bg_color = isset( $wtl_settings['template_content_box_bg_color'] ) ? $wtl_settings['template_content_box_bg_color'] : '#fff';
	?>
	<?php echo esc_attr( $layout_id ); ?>{
		<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) : '#fff'; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-read-more-div{overflow:hidden;}
		<?php echo esc_attr( $layout_id ); ?> .wp-timeline-load-more-pre,
		<?php echo esc_attr( $layout_id ); ?> .wp-timeline-load-more{z-index: 3;position: relative}
		<?php echo esc_attr( $layout_id ); ?> #wtl-load-more-hidden{ float:none; }
		<?php
		echo esc_attr( Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::post_content_color( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
		?>
		<?php echo esc_attr( $layout_id ); ?> .wtl-author a,
		<?php echo esc_attr( $layout_id ); ?> .post-comment a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-meta-comment i,
		<?php echo esc_attr( $layout_id ); ?> a.comments-link,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a
		{
		<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-author a:hover,
		<?php echo esc_attr( $layout_id ); ?> .post-comment a:hover,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a:hover,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a:hover,
		<?php echo esc_attr( $layout_id ); ?> .wtl-meta-comment i:hover,
		<?php echo esc_attr( $layout_id ); ?> a.comments-link:hover,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a:hover
		{
		<?php echo isset( $wtl_settings['template_fthovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_fthovercolor'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-content{
		<?php echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) ); ?>
		}
		<?php echo esc_attr( $layout_id ); ?>.zigzag_layout .wp-timeline-post-image img {
			<?php echo isset( $wtl_settings['template_color'] ) ? 'border-color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;' : ''; ?>
		}
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-content{
		<?php
		if ( $template_content_box_bg_color ) {
			echo 'background:' . esc_attr( $template_content_box_bg_color ) . ';';
		}
		?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl_main_title{text-align:center;}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a
		{
		<?php echo isset( $wtl_settings['template_categorybgcolor'] ) ? 'background-color:' . esc_attr( $wtl_settings['template_categorybgcolor'] ) . ' !important;' : ''; ?>
		}
		/* Box */
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-schedule-all-post-content{
			<?php
			echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wp-timeline-post-image figure {width: 100%;height: 150px;}
		
		<?php echo esc_attr( $layout_id ); ?> .wp-timeline-post-image img { width: 100%; border: 5px solid #000;}
		<?php if( isset( $wp_timeline_image_shape) && 'round' == $wp_timeline_image_shape ) { ?>

		<?php echo esc_attr( $layout_id ); ?> .wp-timeline-post-image img {  
			border-radius: 50%;
		}
		<?php } ?>
		/* Post Date */
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-date {
			<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-date:hover {
			<?php echo isset( $wtl_settings['template_fthovercolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_fthovercolor'] ) . ' !important;' : ''; ?>
		}
		<?php
		echo esc_attr( Wtl_Template_Config::post_date_typography( $wtl_settings, $layout_id ) );
}


	/*------------------ Template: Columy Layout --------------- */
	if ( 'columy_layout' === $wp_timeline_theme ) {
		?>

		<?php echo esc_attr( $layout_id ) ?> .columy_layout .wtl-schedule-post-content, <?php echo esc_attr( $layout_id ) ?> .columy_layout .wtl-post-date {
			<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) : '#ABCB88'; ?>
		}
		<?php echo esc_attr( $layout_id ) ?> .columy_layout .post-tag-inner {
			<?php
			if ( isset( $wtl_settings['template_categorybgcolor'] ) ) {
				echo 'background:' . esc_attr( $wtl_settings['template_categorybgcolor'] );
			}
			?>
		}
		/* Meta */
		<?php echo esc_attr( $layout_id ); ?> .footer_meta .wtl-post-category span,
			<?php echo esc_attr( $layout_id ); ?> .footer_meta .wtl-post-tags span,
			<?php echo esc_attr( $layout_id ); ?> .post-bottom .post-by span,
			<?php echo esc_attr( $layout_id ); ?> .footer_meta .category-link a,
			<?php echo esc_attr( $layout_id ); ?> .footer_meta .tags a,
			<?php echo esc_attr( $layout_id ); ?> .post-author,.post-author a,.comment a,span.wtl-comment,span.wtl-wrapper-like,.posted_by a, .post-author .link-lable,
			<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component a ,
			<?php echo esc_attr( $layout_id ); ?> .posted_by a .datetime {
				<?php
				echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_family'] ) ? 'font-family:' . esc_attr( $wtl_settings['meta_font_family'] ) . ';' : '';
				echo isset( $wtl_settings['meta_fontsize'] ) ? 'font-size:' . esc_attr( $wtl_settings['meta_fontsize'] ) . 'px;' : '';
				echo isset( $wtl_settings['meta_font_weight'] ) ? 'font-weight:' . esc_attr( $wtl_settings['meta_font_weight'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_line_height'] ) ? 'line-height:' . esc_attr( $wtl_settings['meta_font_line_height'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_text_transform'] ) ? 'text-transform:' . esc_attr( $wtl_settings['meta_font_text_transform'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_text_decoration'] ) ? 'text-decoration:' . esc_attr( $wtl_settings['meta_font_text_decoration'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_letter_spacing'] ) ? 'letter-spacing:' . esc_attr( $wtl_settings['meta_font_letter_spacing'] ) . ';' : '';
				?>
			}
	
		<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-schedule-post-content {
			<?php echo isset( $wtl_settings['template_titlecolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_titlecolor'] ) . ' !important;' : ''; ?>
		}
		/* Box */
		<?php echo esc_attr( $layout_id ); ?>  .wtl_al_slider{
			<?php
			echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
			?>
		}
		<?php
		echo esc_attr( Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::post_content_color( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
		?>
		<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl_blog_single_post_wrapp .wtl_steps_post_format:before{
			<?php
			if ( isset( $wtl_settings['template_color'] ) ) {
				echo 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
			}
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a{
			<?php
			$template_ftcolor = isset( $wtl_settings['template_ftcolor'] ) ? $wtl_settings['template_ftcolor'] : '';
			if ( $template_ftcolor ) {
				echo 'color:' . esc_attr( $template_ftcolor ) . ';';
			}
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a:hover{
			<?php
			$template_fthovercolor = isset( $wtl_settings['template_fthovercolor'] ) ? $wtl_settings['template_fthovercolor'] : '#23527c';
			if ( $template_fthovercolor ) {
				echo 'color:' . esc_attr( $template_fthovercolor ) . ';';
			}
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl_al_slider span.wtl-ss-left i, 
		<?php echo esc_attr( $layout_id ); ?> .wtl_al_slider span.wtl-ss-right i {
			<?php
				if ( isset( $wtl_settings['navigation_arrow_size'] ) ) {
					echo 'font-size:' . esc_attr( $wtl_settings['navigation_arrow_size'] ) . 'px;';
				}
				if ( isset( $wtl_settings['navigation_color'] ) ) {
					echo 'color:' . esc_attr( $wtl_settings['navigation_color'] ) . ';';
				}
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl_al_slider span.wtl-ss-left i, 
		<?php echo esc_attr( $layout_id ); ?> .wtl_al_slider span.wtl-ss-right i{
			<?php
				if ( isset( $wtl_settings['navigation_bg_color'] ) ) {
					echo 'background:' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ' !important;';
				}
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .author a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a,
		<?php echo esc_attr( $layout_id ); ?> .comments-link,
		<?php echo esc_attr( $layout_id ); ?> .wtl-wrapper-like a{
			<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ' !important;' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?>.columy_layout hr.line-hr {
			<?php if ( isset( $template_contentcolor ) && '' !== $template_contentcolor ) {
			?>
				border-color: <?php echo esc_attr( $template_contentcolor ); ?>;
			<?php } ?>
		}
		<?php
		$border_width = isset( $wtl_settings['wp_timeline_content_border_width'] ) ? $wtl_settings['wp_timeline_content_border_width'] : '';
		$border_style = isset( $wtl_settings['wp_timeline_content_border_style'] ) ? $wtl_settings['wp_timeline_content_border_style'] : '';
		$border_color = isset( $wtl_settings['wp_timeline_content_border_color'] ) ? $wtl_settings['wp_timeline_content_border_color'] : '';
		?>

		<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl_blog_single_post_wrapp:before{
			border-top: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
			border-right: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
			<?php echo isset( $wtl_settings['template_content_box_bg_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_content_box_bg_color'] ) : '#fff'; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .columy_layout .social-component a {
			border-radius: 0;
			border: none;
		}
		
		<?php 
			if ( isset( $firstletter_big ) && 1 == $firstletter_big ) { 
				$first_letter_line_height = $firstletter_fontsize * 75 / 100;
				?>
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-content .post-content-inner:first-letter {
					<?php
					if ( isset( $firstletter_font_family ) && $firstletter_font_family ) {
						?>
						font-family :<?php echo esc_attr( $firstletter_font_family ); ?>; <?php } ?>
						font-size   : <?php echo esc_attr( $firstletter_fontsize ) . 'px'; ?>;
						color       : <?php echo esc_attr( $firstletter_contentcolor ); ?>;
						margin-right: 5px;
						line-height : <?php echo esc_attr( $first_letter_line_height ) . 'px'; ?>;
						display     : inline-block;
						<?php
						if ( isset( $content_font_text_decoration ) && $content_font_text_decoration ) {
							?>
							text-decoration: <?php echo esc_attr( $content_font_text_decoration ); ?>;
						<?php } ?>
					}
			<?php } 
	}

	/*------------------ Template: Leafty Layout --------------- */
	if ( 'leafty_layout' === $wp_timeline_theme ) {
		?>

		<?php echo esc_attr( $layout_id ) ?> .leafty_layout .wtl-schedule-post-content, span.month-date {
			<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) : '#ABCB88'; ?>
		}
		/* Meta */
		<?php echo esc_attr( $layout_id ); ?> .footer_meta .wtl-post-category span,
			<?php echo esc_attr( $layout_id ); ?> .footer_meta .wtl-post-tags span,
			<?php echo esc_attr( $layout_id ); ?> .post-bottom .post-by span,
			<?php echo esc_attr( $layout_id ); ?> .footer_meta .category-link a,
			<?php echo esc_attr( $layout_id ); ?> .footer_meta .tags a,
			<?php echo esc_attr( $layout_id ); ?> span.author-name,<?php echo esc_attr( $layout_id ); ?> span.author-name a,<?php echo esc_attr( $layout_id ); ?> span.wtl-comment,<?php echo esc_attr( $layout_id ); ?> span.wtl-comment a,<?php echo esc_attr( $layout_id ); ?> span.wtl-wrapper-like,<?php echo esc_attr( $layout_id ); ?> .posted_by a, <?php echo esc_attr( $layout_id ); ?> .post-author .link-lable,
			<?php echo esc_attr( $layout_id ); ?> span.wtl-post-date .mdate,
			<?php echo esc_attr( $layout_id ); ?> .posted_by a .datetime {
				<?php
				echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_family'] ) ? 'font-family:' . esc_attr( $wtl_settings['meta_font_family'] ) . ';' : '';
				echo isset( $wtl_settings['meta_fontsize'] ) ? 'font-size:' . esc_attr( $wtl_settings['meta_fontsize'] ) . 'px;' : '';
				echo isset( $wtl_settings['meta_font_weight'] ) ? 'font-weight:' . esc_attr( $wtl_settings['meta_font_weight'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_line_height'] ) ? 'line-height:' . esc_attr( $wtl_settings['meta_font_line_height'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_text_transform'] ) ? 'text-transform:' . esc_attr( $wtl_settings['meta_font_text_transform'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_text_decoration'] ) ? 'text-decoration:' . esc_attr( $wtl_settings['meta_font_text_decoration'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_letter_spacing'] ) ? 'letter-spacing:' . esc_attr( $wtl_settings['meta_font_letter_spacing'] ) . ';' : '';
				?>
			}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a {
			text-transform: uppercase !important;
		}
		/* Box */
		<?php echo esc_attr( $layout_id ); ?>  .wtl_single_post_wrapp {
			<?php
			echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
			?>
		}
		<?php
		echo esc_attr( Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::post_content_color( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
		?>
		<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl_blog_single_post_wrapp .wtl_steps_post_format:before{
			<?php
			if ( isset( $wtl_settings['template_color'] ) ) {
				echo 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
			}
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a, 
		<?php echo esc_attr( $layout_id ); ?> span.author-name a i,
		<?php echo esc_attr( $layout_id ); ?> .wtl-comment i,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags i,
		<?php echo esc_attr( $layout_id ); ?> .wtl-meta-content-left i,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category .post-category a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-meta-content-left i:before {
			<?php
			$template_ftcolor = isset( $wtl_settings['template_ftcolor'] ) ? $wtl_settings['template_ftcolor'] : '';
			if ( $template_ftcolor ) {
				echo 'color:' . esc_attr( $template_ftcolor ) . ';';
			}
			?>
		}

		<?php echo esc_attr( $layout_id ); ?> .wtl_al_nav .wtl-post-date.slick-current.slick-active a:before,
		<?php echo esc_attr( $layout_id ); ?> .wtl_al_nav .wtl-post-date.slick-current.slick-active a {
			<?php
			$ad_background_color = isset( $wtl_settings['ad_background_color'] ) ? $wtl_settings['ad_background_color'] : '#c87f76';
			if ( $ad_background_color ) {
				echo 'background:' . esc_attr( $ad_background_color ) . ';';
			}
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl_al_nav .wtl-ss-right,
		<?php echo esc_attr( $layout_id ); ?> .wtl_al_nav .wtl-ss-left {
			<?php
			$navigation_bg_color = isset( $wtl_settings['navigation_bg_color'] ) ? $wtl_settings['navigation_bg_color'] : '';
			if ( $navigation_bg_color ) {
				echo 'background:' . esc_attr( $navigation_bg_color ) . ';';
			}
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl_al_nav .wtl-ss-right i,
		<?php echo esc_attr( $layout_id ); ?> .wtl_al_nav .wtl-ss-left i {
			<?php
			$navigation_color = isset( $wtl_settings['navigation_color'] ) ? $wtl_settings['navigation_color'] : '';
			$navigation_arrow_size = isset( $wtl_settings['navigation_arrow_size'] ) ? $wtl_settings['navigation_arrow_size'] : '';
			if ( $navigation_color ) {
				echo 'color:' . esc_attr( $navigation_color ) . ';';
			}
			if ( $navigation_arrow_size ) {
				echo 'font-size:' . esc_attr( $navigation_arrow_size ) . 'px;';
			}
			?>
		}

		<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a:hover{
			<?php
			$template_fthovercolor = isset( $wtl_settings['template_fthovercolor'] ) ? $wtl_settings['template_fthovercolor'] : '#23527c';
			if ( $template_fthovercolor ) {
				echo 'color:' . esc_attr( $template_fthovercolor ) . ';';
			}
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .author a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a,
		<?php echo esc_attr( $layout_id ); ?> .comments-link,
		<?php echo esc_attr( $layout_id ); ?> .wtl-wrapper-like a{
			<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ' !important;' : ''; ?>
		}
		<?php
		$border_width = isset( $wtl_settings['wp_timeline_content_border_width'] ) ? $wtl_settings['wp_timeline_content_border_width'] : '';
		$border_style = isset( $wtl_settings['wp_timeline_content_border_style'] ) ? $wtl_settings['wp_timeline_content_border_style'] : '';
		$border_color = isset( $wtl_settings['wp_timeline_content_border_color'] ) ? $wtl_settings['wp_timeline_content_border_color'] : '';
		?>
		<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl_blog_single_post_wrapp:before{
			border-top: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
			border-right: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
			<?php echo isset( $wtl_settings['template_content_box_bg_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_content_box_bg_color'] ) : '#fff'; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .leafty_layout .social-component a {
			border-radius: 0;
			border: none;
		}
		<?php echo esc_attr( $layout_id ); ?> .leafty_layout .social-component a:hover {
			background-color: inherit !important;
		}
		<?php echo esc_attr( $layout_id ); ?> .leafty_layout .wtl_blog_template .wtl-post-title a {
			font-style: normal;
		}
		
		<?php 
			if ( isset( $firstletter_big ) && 1 == $firstletter_big ) { 
				$first_letter_line_height = $firstletter_fontsize * 75 / 100;
				?>
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-content .post-content-inner:first-letter {
					<?php
					if ( isset( $firstletter_font_family ) && $firstletter_font_family ) {
						?>
						font-family :<?php echo esc_attr( $firstletter_font_family ); ?>; <?php } ?>
						font-size   : <?php echo esc_attr( $firstletter_fontsize ) . 'px'; ?>;
						color       : <?php echo esc_attr( $firstletter_contentcolor ); ?>;
						margin-right: 5px;
						line-height : <?php echo esc_attr( $first_letter_line_height ) . 'px'; ?>;
						display     : inline-block;
						<?php
						if ( isset( $content_font_text_decoration ) && $content_font_text_decoration ) {
							?>
							text-decoration: <?php echo esc_attr( $content_font_text_decoration ); ?>;
						<?php } ?>
					}
			<?php }
	}
	/*------------------ Template: Sportking Layout --------------- */
	if ( 'sportking_layout' === $wp_timeline_theme ) {
		?>

		<?php echo esc_attr( $layout_id ) ?> .sportking_layout .wtl-schedule-post-content, span.month-date {
			<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) : '#ABCB88'; ?>
		}
			<?php $template_color = isset( $wtl_settings['template_color'] ) ? esc_attr( $wtl_settings['template_color'] ) : '#fff' ;?>
			<?php echo esc_attr( $layout_id ); ?> .wtl_al_slider .wtl-schedule-post-content{
			<?php echo isset( $wtl_settings['template_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;' : ''; ?>
		}
		/* Meta */
		<?php echo esc_attr( $layout_id ); ?> .footer_meta .wtl-post-category span,
			<?php echo esc_attr( $layout_id ); ?> .footer_meta .wtl-post-tags span,
			<?php echo esc_attr( $layout_id ); ?> .post-bottom .post-by span,
			<?php echo esc_attr( $layout_id ); ?> .footer_meta .category-link a,
			<?php echo esc_attr( $layout_id ); ?> .footer_meta .tags a,
			<?php echo esc_attr( $layout_id ); ?> span.author-name,<?php echo esc_attr( $layout_id ); ?> span.author-name a,<?php echo esc_attr( $layout_id ); ?> span.wtl-comment,<?php echo esc_attr( $layout_id ); ?> span.wtl-comment a,<?php echo esc_attr( $layout_id ); ?> span.wtl-wrapper-like,<?php echo esc_attr( $layout_id ); ?> .posted_by a, <?php echo esc_attr( $layout_id ); ?> .post-author .link-lable,
			<?php echo esc_attr( $layout_id ); ?> span.wtl-post-date .mdate,
			<?php echo esc_attr( $layout_id ); ?> .posted_by a .datetime {
				<?php
				echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_family'] ) ? 'font-family:' . esc_attr( $wtl_settings['meta_font_family'] ) . ';' : '';
				echo isset( $wtl_settings['meta_fontsize'] ) ? 'font-size:' . esc_attr( $wtl_settings['meta_fontsize'] ) . 'px;' : '';
				echo isset( $wtl_settings['meta_font_weight'] ) ? 'font-weight:' . esc_attr( $wtl_settings['meta_font_weight'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_line_height'] ) ? 'line-height:' . esc_attr( $wtl_settings['meta_font_line_height'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_text_transform'] ) ? 'text-transform:' . esc_attr( $wtl_settings['meta_font_text_transform'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_text_decoration'] ) ? 'text-decoration:' . esc_attr( $wtl_settings['meta_font_text_decoration'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_letter_spacing'] ) ? 'letter-spacing:' . esc_attr( $wtl_settings['meta_font_letter_spacing'] ) . ';' : '';
				?>
			}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a {
			text-transform: uppercase !important;
		}
		/* Box */
		<?php echo esc_attr( $layout_id ); ?>  .wtl_single_post_wrapp {
			<?php
			echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) );
			echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
			?>
		}
		<?php
		echo esc_attr( Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::post_content_color( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
		echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
		?>
		<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl_blog_single_post_wrapp .wtl_steps_post_format:before{
			<?php
			if ( isset( $wtl_settings['template_color'] ) ) {
				echo 'color:' . esc_attr( $wtl_settings['template_color'] ) . ' !important;';
			}
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a, 
		<?php echo esc_attr( $layout_id ); ?> span.author-name a i,
		<?php echo esc_attr( $layout_id ); ?> .wtl-comment i,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags i,
		<?php echo esc_attr( $layout_id ); ?> .wtl-meta-content-left i,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-category .post-category a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-meta-content-left i:before {
			<?php
			$template_ftcolor = isset( $wtl_settings['template_ftcolor'] ) ? $wtl_settings['template_ftcolor'] : '';
			if ( $template_ftcolor ) {
				echo 'color:' . esc_attr( $template_ftcolor ) . ';';
			}
			?>
		}

		<?php echo esc_attr( $layout_id ); ?> .wtl_al_slider .wtl-post-date.slick-current.slick-active a:before,
		<?php echo esc_attr( $layout_id ); ?> .wtl_al_slider .schedule-image-wrapper.wtl-post-thumbnail {
			<?php
			$ad_background_color = isset( $wtl_settings['ad_background_color'] ) ? $wtl_settings['ad_background_color'] : '#c87f76';
			if ( $ad_background_color ) {
				echo 'background:' . esc_attr( $ad_background_color ) . ';';
			}
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl_al_slider .wtl-ss-right,
		<?php echo esc_attr( $layout_id ); ?> .wtl_al_slider .wtl-ss-left {
			<?php
			$navigation_bg_color = isset( $wtl_settings['navigation_bg_color'] ) ? $wtl_settings['navigation_bg_color'] : '';
			if ( $navigation_bg_color ) {
				echo 'background:' . esc_attr( $navigation_bg_color ) . ';';
			}
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl_al_slider .wtl-ss-right i,
		<?php echo esc_attr( $layout_id ); ?> .wtl_al_slider .wtl-ss-left i {
			<?php
			$navigation_color = isset( $wtl_settings['navigation_color'] ) ? $wtl_settings['navigation_color'] : '';
			$navigation_arrow_size = isset( $wtl_settings['navigation_arrow_size'] ) ? $wtl_settings['navigation_arrow_size'] : '';
			if ( $navigation_color ) {
				echo 'color:' . esc_attr( $navigation_color ) . ';';
			}
			if ( $navigation_arrow_size ) {
				echo 'font-size:' . esc_attr( $navigation_arrow_size ) . 'px;';
			}
			?>
		}

		<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a:hover{
			<?php
			$template_fthovercolor = isset( $wtl_settings['template_fthovercolor'] ) ? $wtl_settings['template_fthovercolor'] : '#23527c';
			if ( $template_fthovercolor ) {
				echo 'color:' . esc_attr( $template_fthovercolor ) . ';';
			}
			?>
		}
		<?php echo esc_attr( $layout_id ); ?> .author a,
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a,
		<?php echo esc_attr( $layout_id ); ?> .comments-link,
		<?php echo esc_attr( $layout_id ); ?> .wtl-wrapper-like a{
			<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ' !important;' : ''; ?>
		}
		<?php
		$border_width = isset( $wtl_settings['wp_timeline_content_border_width'] ) ? $wtl_settings['wp_timeline_content_border_width'] : '';
		$border_style = isset( $wtl_settings['wp_timeline_content_border_style'] ) ? $wtl_settings['wp_timeline_content_border_style'] : '';
		$border_color = isset( $wtl_settings['wp_timeline_content_border_color'] ) ? $wtl_settings['wp_timeline_content_border_color'] : '';
		?>
		<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl_blog_single_post_wrapp:before{
			border-top: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
			border-right: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
			<?php echo isset( $wtl_settings['template_content_box_bg_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_content_box_bg_color'] ) : '#fff'; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .sportking_layout .social-component a {
			border-radius: 0;
			border: none;
		}
		<?php echo esc_attr( $layout_id ); ?> .sportking_layout .social-component a:hover {
			background-color: inherit !important;
		}
		<?php echo esc_attr( $layout_id ); ?> .sportking_layout .wtl_blog_template .wtl-post-title a {
			font-style: normal;
		}
		
		<?php 
			if ( isset( $firstletter_big ) && 1 == $firstletter_big ) { 
				$first_letter_line_height = $firstletter_fontsize * 75 / 100;
				?>
				<?php echo esc_attr( $layout_id ); ?> .wtl-post-content .post-content-inner:first-letter {
					<?php
					if ( isset( $firstletter_font_family ) && $firstletter_font_family ) {
						?>
						font-family :<?php echo esc_attr( $firstletter_font_family ); ?>; <?php } ?>
						font-size   : <?php echo esc_attr( $firstletter_fontsize ) . 'px'; ?>;
						color       : <?php echo esc_attr( $firstletter_contentcolor ); ?>;
						margin-right: 5px;
						line-height : <?php echo esc_attr( $first_letter_line_height ) . 'px'; ?>;
						display     : inline-block;
						<?php
						if ( isset( $content_font_text_decoration ) && $content_font_text_decoration ) {
							?>
							text-decoration: <?php echo esc_attr( $content_font_text_decoration ); ?>;
						<?php } ?>
					}
			<?php }
	}
	/*------------------ Template: FilledTimeline Layout --------------- */
	if ( 'filledtimeline_layout' === $wp_timeline_theme ) { ?>
		<?php echo esc_attr( $layout_id ); ?>.wtl_wrapper, <?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-schedule-post-content .wtl-post-center-image .stem-wrappericon {
			<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) . ';' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtl-ss-right i,<?php echo esc_attr( $layout_id ); ?>.wtl_is_horizontal .wtl-ss-left i {
			<?php
				$navigation_color = isset( $wtl_settings['navigation_color'] ) ? $wtl_settings['navigation_color'] : '';
				$navigation_bg_color = isset( $wtl_settings['navigation_bg_color'] ) ? $wtl_settings['navigation_bg_color'] : '';
				$navigation_arrow_size = isset( $wtl_settings['navigation_arrow_size'] ) ? $wtl_settings['navigation_arrow_size'] : '';
				if ( $navigation_color ) {
					echo 'color:' . esc_attr( $navigation_color ) . ';';
				}
				if ( $navigation_bg_color ) {
					echo 'background:' . esc_attr( $navigation_bg_color ) . ';';
				}
				if ( $navigation_arrow_size ) {
					echo 'font-size:' . esc_attr( $navigation_arrow_size ) . 'px;';
				}
				?>
		}
		/* Meta */
		<?php echo esc_attr( $layout_id ); ?> .footer_meta .wtl-post-category span,
			<?php echo esc_attr( $layout_id ); ?> .footer_meta .wtl-post-tags span,
			<?php echo esc_attr( $layout_id ); ?> .post-bottom .post-by span,
			<?php echo esc_attr( $layout_id ); ?> .footer_meta .category-link a,
			<?php echo esc_attr( $layout_id ); ?> .footer_meta .tags a,
			<?php echo esc_attr( $layout_id ); ?> span.author-name,span.author-name a,span.wtl-comment,span.wtl-comment a,span.wtl-wrapper-like,.posted_by a, .post-author .link-lable,
			<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component a ,
			<?php echo esc_attr( $layout_id ); ?> .posted_by a .datetime {
				<?php
				echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_family'] ) ? 'font-family:' . esc_attr( $wtl_settings['meta_font_family'] ) . ';' : '';
				echo isset( $wtl_settings['meta_fontsize'] ) ? 'font-size:' . esc_attr( $wtl_settings['meta_fontsize'] ) . 'px;' : '';
				echo isset( $wtl_settings['meta_font_weight'] ) ? 'font-weight:' . esc_attr( $wtl_settings['meta_font_weight'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_line_height'] ) ? 'line-height:' . esc_attr( $wtl_settings['meta_font_line_height'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_text_transform'] ) ? 'text-transform:' . esc_attr( $wtl_settings['meta_font_text_transform'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_text_decoration'] ) ? 'text-decoration:' . esc_attr( $wtl_settings['meta_font_text_decoration'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_letter_spacing'] ) ? 'letter-spacing:' . esc_attr( $wtl_settings['meta_font_letter_spacing'] ) . ';' : '';
				?>
			}
			/* Box */
			<?php echo esc_attr( $layout_id ); ?>  .wtl_al_slider{
				<?php
				echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
				echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
				echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
				echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) );
				echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
				?>
			}
			<?php
			echo esc_attr( Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ) );
			echo esc_attr( Wtl_Template_Config::post_content_color( $wtl_settings, $layout_id ) );
			echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
			echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
			echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
			?>
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a,
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a, 
			<?php echo esc_attr( $layout_id ); ?> span.author-name a i,
			<?php echo esc_attr( $layout_id ); ?> .wtl-comment i,
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags i,
			<?php echo esc_attr( $layout_id ); ?> .wtl-meta-content-left i,
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-category .post-category a,
			<?php echo esc_attr( $layout_id ); ?> .wtl-meta-content-left i:before {
				<?php
				$template_ftcolor = isset( $wtl_settings['template_ftcolor'] ) ? $wtl_settings['template_ftcolor'] : '';
				if ( $template_ftcolor ) {
					echo 'color:' . esc_attr( $template_ftcolor ) . ';';
				}
				?>
			}
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a:hover{
				<?php
				$template_fthovercolor = isset( $wtl_settings['template_fthovercolor'] ) ? $wtl_settings['template_fthovercolor'] : '#23527c';
				if ( $template_fthovercolor ) {
					echo 'color:' . esc_attr( $template_fthovercolor ) . ';';
				}
				?>
			}
			<?php echo esc_attr( $layout_id ); ?> .wtl_al_nav .fa-angle-left, 
			<?php echo esc_attr( $layout_id ); ?> .wtl_al_nav .fa-angle-right {
				<?php
				$navigation_color = isset( $wtl_settings['navigation_color'] ) ? $wtl_settings['navigation_color'] : '';
				$navigation_bg_color = isset( $wtl_settings['navigation_bg_color'] ) ? $wtl_settings['navigation_bg_color'] : '';
				$navigation_arrow_size = isset( $wtl_settings['navigation_arrow_size'] ) ? $wtl_settings['navigation_arrow_size'] : '';
				if ( $navigation_color ) {
					echo 'color:' . esc_attr( $navigation_color ) . ';';
				}
				if ( $navigation_bg_color ) {
					echo 'background:' . esc_attr( $navigation_bg_color ) . ';';
				}
				if ( $navigation_arrow_size ) {
					echo 'font-size:' . esc_attr( $navigation_arrow_size ) . 'px;';
				}
				?>
			}
			<?php echo esc_attr( $layout_id ); ?> .author a,
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a,
			<?php echo esc_attr( $layout_id ); ?> .comments-link,
			<?php echo esc_attr( $layout_id ); ?> .wtl-wrapper-like a{
				<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ';' : ''; ?>
			}
			<?php echo esc_attr( $layout_id ); ?> .author a:hover,
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-date a:hover,
			<?php echo esc_attr( $layout_id ); ?> .comments-link:hover,
			<?php echo esc_attr( $layout_id ); ?> .wtl-wrapper-like a:hover{
				<?php
				$template_fthovercolor = isset( $wtl_settings['template_fthovercolor'] ) ? $wtl_settings['template_fthovercolor'] : '#23527c';
				if ( $template_fthovercolor ) {
					echo 'color:' . esc_attr( $template_fthovercolor ) . ';';
				}
				?>
			}
			<?php
			$border_width = isset( $wtl_settings['wp_timeline_content_border_width'] ) ? $wtl_settings['wp_timeline_content_border_width'] : '';
			$border_style = isset( $wtl_settings['wp_timeline_content_border_style'] ) ? $wtl_settings['wp_timeline_content_border_style'] : '';
			$border_color = isset( $wtl_settings['wp_timeline_content_border_color'] ) ? $wtl_settings['wp_timeline_content_border_color'] : '';
			?>
			<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl_blog_single_post_wrapp:before{
				border-top: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
				border-right: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
				<?php echo isset( $wtl_settings['template_content_box_bg_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_content_box_bg_color'] ) : '#fff'; ?>
			}
			<?php echo esc_attr( $layout_id ); ?>.filledtimeline .social-component a {
				border-radius: 0;
				border: none;
			}
			<?php echo esc_attr( $layout_id ); ?>.filledtimeline .social-component a:hover {
				background-color: inherit !important;
			}
			<?php echo esc_attr( $layout_id ); ?>.filledtimeline .wtl_blog_template .wtl-post-title a {
				font-style: normal;
			}
			
			<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_price_wrap {
				<?php
				if ( isset( $wp_timeline_pricetextcolor ) && '' !== $wp_timeline_pricetextcolor ) { ?>
					color: <?php echo esc_attr( $wp_timeline_pricetextcolor ); ?> !important;<?php } ?>
			}
			<?php 
				if ( isset( $firstletter_big ) && 1 == $firstletter_big ) { 
					$first_letter_line_height = $firstletter_fontsize * 75 / 100;
					?>
					<?php echo esc_attr( $layout_id ); ?> .wtl-post-content .post-content-inner:first-letter {
						<?php
						if ( isset( $firstletter_font_family ) && $firstletter_font_family ) {
							?>
							font-family :<?php echo esc_attr( $firstletter_font_family ); ?>; <?php } ?>
							font-size   : <?php echo esc_attr( $firstletter_fontsize ) . 'px'; ?>;
							color       : <?php echo esc_attr( $firstletter_contentcolor ); ?>;
							margin-right: 5px;
							line-height : <?php echo esc_attr( $first_letter_line_height ) . 'px'; ?>;
							display     : inline-block;
							<?php
							if ( isset( $content_font_text_decoration ) && $content_font_text_decoration ) {
								?>
								text-decoration: <?php echo esc_attr( $content_font_text_decoration ); ?>;
							<?php } ?>
						}
				<?php }

		if ( 1 == $wtl_settings['layout_type'] ) {  ?>
			<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-schedule-post-content .wtl-schedule-all-post-content {
				opacity: 1 !important;
			}
			<?php echo esc_attr( $layout_id ); ?> .wtl_al_nav .wtl-post-center-image:nth-child(3n + 1):before {
				<?php
				echo isset( $wtl_settings['template_navigation_background_color1'] ) ? 'background:' . esc_attr( $wtl_settings['template_navigation_background_color1'] ) . ';' : ''; ?>
			}
			<?php echo esc_attr( $layout_id ); ?> .wtl_al_nav .wtl-post-center-image:nth-child(3n + 2):before {
				<?php
				echo isset( $wtl_settings['template_navigation_background_color2'] ) ? 'background:' . esc_attr( $wtl_settings['template_navigation_background_color2'] ) . ';' : ''; ?>
			}
			<?php echo esc_attr( $layout_id ); ?> .wtl_al_nav .wtl-post-center-image:nth-child(3n + 3):before {
				<?php
				echo isset( $wtl_settings['template_navigation_background_color3'] ) ? 'background:' . esc_attr( $wtl_settings['template_navigation_background_color3'] ) . ';' : ''; ?>
			}
			<?php echo esc_attr( $layout_id ); ?> .wtl_al_nav .wtl-post-center-image:nth-child(3n + 1) i {
				<?php
				echo isset( $wtl_settings['template_navigation_background_color1'] ) ? 'color:' . esc_attr( $wtl_settings['template_navigation_background_color1'] ) . ';' : ''; ?>
			}
			<?php echo esc_attr( $layout_id ); ?> .wtl_al_nav .wtl-post-center-image:nth-child(3n + 2) i {
				<?php
				echo isset( $wtl_settings['template_navigation_background_color2'] ) ? 'color:' . esc_attr( $wtl_settings['template_navigation_background_color2'] ) . ';' : ''; ?>
			}
			<?php echo esc_attr( $layout_id ); ?> .wtl_al_nav .wtl-post-center-image:nth-child(3n + 3) i {
				<?php
				echo isset( $wtl_settings['template_navigation_background_color3'] ) ? 'color:' . esc_attr( $wtl_settings['template_navigation_background_color3'] ) . ';' : ''; ?>
			}
		<?php } else { ?>
			.wtl_wrapper {
				max-width: 100% !important;
			}
			<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap {
				float: left;
			}
			.wtl-schedule-wrap .wtl-schedule-post-content .wtl-schedule-all-post-content {
				width: 40%;
			}
			<?php echo esc_attr( $layout_id ); ?> .stem-wrapper.color-green .stem-background,
			<?php echo esc_attr( $layout_id ); ?> .stem-wrapper .stem-background {
				<?php
				echo isset( $wtl_settings['template_navigation_background_color1'] ) ? 'background:' . esc_attr( $wtl_settings['template_navigation_background_color1'] ) . ';' : ''; ?>
			}
			<?php echo esc_attr( $layout_id ); ?> .active .stem-wrappericon.color-green i, .stem-wrapper.color-green + .wtl-schedule-wrap .topactive .stem-wrappericon.color-green i, <?php echo esc_attr( $layout_id ); ?>.filledtimeline .active .stem-wrappericon.color-green i:before, .filledtimeline .stem-wrapper.color-green + .wtl-schedule-wrap .topactive .stem-wrappericon.color-green i:before {
				<?php
				echo isset( $wtl_settings['template_navigation_background_color1'] ) ? 'color:' . esc_attr( $wtl_settings['template_navigation_background_color1'] ) . ';' : ''; ?>
			}
			<?php echo esc_attr( $layout_id ); ?> .stem-wrapper.color-yellow .stem-background {
				<?php
				echo isset( $wtl_settings['template_navigation_background_color2'] ) ? 'background:' . esc_attr( $wtl_settings['template_navigation_background_color2'] ) . ';' : ''; ?>
			}
			<?php echo esc_attr( $layout_id ); ?> .active .stem-wrappericon.color-yellow i, .stem-wrapper.color-yellow + .wtl-schedule-wrap .topactive .stem-wrappericon.color-yellow i {
				<?php
				echo isset( $wtl_settings['template_navigation_background_color2'] ) ? 'color:' . esc_attr( $wtl_settings['template_navigation_background_color2'] ) . ';' : ''; ?>
			}
			<?php echo esc_attr( $layout_id ); ?> .stem-wrapper.color-white .stem-background {
				<?php
				echo isset( $wtl_settings['template_navigation_background_color3'] ) ? 'background:' . esc_attr( $wtl_settings['template_navigation_background_color3'] ) . ';' : ''; ?>
			}
			<?php echo esc_attr( $layout_id ); ?> .active .stem-wrappericon.color-white i, .stem-wrapper.color-white + .wtl-schedule-wrap .topactive .stem-wrappericon.color-white i {
				<?php
				echo isset( $wtl_settings['template_navigation_background_color3'] ) ? 'color:' . esc_attr( $wtl_settings['template_navigation_background_color3'] ) . ';' : ''; ?>
			}
			<?php echo esc_attr( $layout_id ); ?> .stem-wrappericon i,
			<?php echo esc_attr( $layout_id ); ?> .single-stem-icon i {
				<?php
				echo isset( $wtl_settings['default_icon_bar_color'] ) ? 'color:' . esc_attr( $wtl_settings['default_icon_bar_color'] ) . ';' : ''; ?>
			}
			<?php echo esc_attr( $layout_id ); ?> .stem-wrapper .stem {
				<?php
				echo isset( $wtl_settings['default_icon_bar_color'] ) ? 'background:' . esc_attr( $wtl_settings['default_icon_bar_color'] ) . ';' : ''; ?>
			}
			@media only screen and (max-width: 767px) {

				.wtl-schedule-wrap .wtl-schedule-post-content {
					width: auto;
					margin-left: 110px;
					float: none;
					padding-left: 20px;
				}
				.wtl-schedule-wrap .wtl-schedule-post-content .wtl-post-center-image {
					left: -57px !important;
					right: auto !important;
				}
				.wtl-schedule-wrap .wtl-schedule-post-content {
					margin-left: 90px !important;
				}
				.stem-wrapper {
					left: 60px;
				}
				.wtl-schedule-wrap .wtl-schedule-post-content .wtl-schedule-all-post-content {
					width: auto;
				}
				.single-stem-icon i {
					position: relative;
					left: 40px;
				}
				.stem-wrapper .stem, .stem-wrapper .stem-background {
					left: 60px;
				}
			}

				@media only screen and (min-width: 768px) {
					.post_even .wtl-schedule-all-post-content {
					float: right;
					}
					.scroll-to-top {
					text-align: center;
					}
					.stem-wrapper, .stem-wrapper .stem,	.stem-wrapper .stem-background {
					left: 0;
					right: 0;
					margin-left: auto;
					margin-right: auto;
					}
					.wtl-schedule-wrap .wtl-schedule-post-content {
						width: 100%;
					}
				}
		<?php
		} 
	}

	/*------------------ Template: ClassicTimeline Layout --------------- */
	if ( 'classictimeline_layout' === $wp_timeline_theme ) { ?>
		.wtl_wrapper, .wtl-schedule-wrap .wtl-schedule-post-content .wtl-post-center-image {
			<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) . ';' : ''; ?>
		}
		/* Meta */
		<?php echo esc_attr( $layout_id ); ?> .footer_meta .wtl-post-category span,
			<?php echo esc_attr( $layout_id ); ?> .footer_meta .wtl-post-tags span,
			<?php echo esc_attr( $layout_id ); ?> .post-bottom .post-by span,
			<?php echo esc_attr( $layout_id ); ?> .footer_meta .category-link a,
			<?php echo esc_attr( $layout_id ); ?> .footer_meta .tags a,
			<?php echo esc_attr( $layout_id ); ?> span.author-name,span.author-name a,span.wtl-comment,span.wtl-comment a,span.wtl-wrapper-like,.posted_by a, .post-author .link-lable,
			<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component a ,
			<?php echo esc_attr( $layout_id ); ?> .posted_by a .datetime {
				<?php
				echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_family'] ) ? 'font-family:' . esc_attr( $wtl_settings['meta_font_family'] ) . ';' : '';
				echo isset( $wtl_settings['meta_fontsize'] ) ? 'font-size:' . esc_attr( $wtl_settings['meta_fontsize'] ) . 'px;' : '';
				echo isset( $wtl_settings['meta_font_weight'] ) ? 'font-weight:' . esc_attr( $wtl_settings['meta_font_weight'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_line_height'] ) ? 'line-height:' . esc_attr( $wtl_settings['meta_font_line_height'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_text_transform'] ) ? 'text-transform:' . esc_attr( $wtl_settings['meta_font_text_transform'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_text_decoration'] ) ? 'text-decoration:' . esc_attr( $wtl_settings['meta_font_text_decoration'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_letter_spacing'] ) ? 'letter-spacing:' . esc_attr( $wtl_settings['meta_font_letter_spacing'] ) . ';' : '';
				?>
			}
			/* Box */
			<?php echo esc_attr( $layout_id ); ?>  .wtl_wrapper {
				<?php
				echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
				echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
				echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
				echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) );
				echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
				?>
			}
			<?php
			echo esc_attr( Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ) );
			echo esc_attr( Wtl_Template_Config::post_content_color( $wtl_settings, $layout_id ) );
			echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
			echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
			echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
			?>
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a,
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a, 
			<?php echo esc_attr( $layout_id ); ?> span.author-name a i,
			<?php echo esc_attr( $layout_id ); ?> .wtl-comment i,
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags i,
			<?php echo esc_attr( $layout_id ); ?> .wtl-meta-content-left i,
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-category .post-category a,
			<?php echo esc_attr( $layout_id ); ?> .wtl-meta-content-left i:before {
				<?php
				$template_ftcolor = isset( $wtl_settings['template_ftcolor'] ) ? $wtl_settings['template_ftcolor'] : '';
				if ( $template_ftcolor ) {
					echo 'color:' . esc_attr( $template_ftcolor ) . ';';
				}
				?>
			}
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a:hover{
				<?php
				$template_fthovercolor = isset( $wtl_settings['template_fthovercolor'] ) ? $wtl_settings['template_fthovercolor'] : '#23527c';
				if ( $template_fthovercolor ) {
					echo 'color:' . esc_attr( $template_fthovercolor ) . ';';
				}
				?>
			}
			<?php echo esc_attr( $layout_id ); ?> .author a,
			<?php echo esc_attr( $layout_id ); ?> .comments-link,
			<?php echo esc_attr( $layout_id ); ?> .wtl-wrapper-like a{
				<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ' !important;' : ''; ?>
			}
			<?php
			$border_width = isset( $wtl_settings['wp_timeline_content_border_width'] ) ? $wtl_settings['wp_timeline_content_border_width'] : '';
			$border_style = isset( $wtl_settings['wp_timeline_content_border_style'] ) ? $wtl_settings['wp_timeline_content_border_style'] : '';
			$border_color = isset( $wtl_settings['wp_timeline_content_border_color'] ) ? $wtl_settings['wp_timeline_content_border_color'] : '';
			?>
			<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl_blog_single_post_wrapp:before{
				border-top: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
				border-right: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
				<?php echo isset( $wtl_settings['template_content_box_bg_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_content_box_bg_color'] ) : '#fff'; ?>
			}
			<?php echo esc_attr( $layout_id ); ?> .social-component a {
				border-radius: 0;
				border: none;
			}
			<?php echo esc_attr( $layout_id ); ?> .social-component a:hover {
				background-color: inherit !important;
			}
			<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl-post-title a {
				font-style: normal;
			}
			
			<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_price_wrap {
				<?php
				if ( isset( $wp_timeline_pricetextcolor ) && '' !== $wp_timeline_pricetextcolor ) { ?>
					color: <?php echo esc_attr( $wp_timeline_pricetextcolor ); ?> !important;<?php } ?>
			}
			<?php 
				if ( isset( $firstletter_big ) && 1 == $firstletter_big ) { 
					$first_letter_line_height = $firstletter_fontsize * 75 / 100;
					?>
					<?php echo esc_attr( $layout_id ); ?> .wtl-post-content .post-content-inner:first-letter {
						<?php
						if ( isset( $firstletter_font_family ) && $firstletter_font_family ) {
							?>
							font-family :<?php echo esc_attr( $firstletter_font_family ); ?>; <?php } ?>
							font-size   : <?php echo esc_attr( $firstletter_fontsize ) . 'px'; ?>;
							color       : <?php echo esc_attr( $firstletter_contentcolor ); ?>;
							margin-right: 5px;
							line-height : <?php echo esc_attr( $first_letter_line_height ) . 'px'; ?>;
							display     : inline-block;
							<?php
							if ( isset( $content_font_text_decoration ) && $content_font_text_decoration ) {
								?>
								text-decoration: <?php echo esc_attr( $content_font_text_decoration ); ?>;
							<?php } ?>
						}
				<?php } ?>
			.wtl_wrapper {
				max-width: 100% !important;
			}
			<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl_year span,
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-center-image i { 
				<?php echo isset( $wtl_settings['icon_content_bg_color'] ) ? 'background:' . esc_attr( $wtl_settings['icon_content_bg_color'] ) : '#00bcd4'; ?>;
				<?php echo isset( $wtl_settings['template_color'] ) ? 'color:' . esc_attr( $wtl_settings['template_color'] ) : '#FFFFFF'; ?>;
			}
			<?php echo esc_attr( $layout_id ); ?> .wtl_blog_single_post_wrapp:nth-child(odd) .wtl-post-inner-content .wtl-post-content:before,
			<?php echo esc_attr( $layout_id ); ?> .wtl_blog_single_post_wrapp:nth-child(even) .wtl-post-inner-content .wtl-post-content:before { 
				<?php echo isset( $wtl_settings['icon_content_bg_color'] ) ? 'border-top: 20px solid ' . esc_attr( $wtl_settings['icon_content_bg_color'] ) : '#00bcd4'; ?>;
			}
			<?php echo esc_attr( $layout_id ); ?> .wtl-image-date .wtl-post-date a {
				<?php echo isset( $wtl_settings['icon_content_bg_color'] ) ? 'color:' . esc_attr( $wtl_settings['icon_content_bg_color'] ) : '#00bcd4'; ?>;
			}
			<?php echo esc_attr( $layout_id ); ?> .wtl_blog_single_post_wrapp:nth-child(odd) .wtl-post-inner-content .wtl-post-content {
				<?php echo isset( $wtl_settings['icon_content_bg_color'] ) ? 'border-right: 6px solid ' . esc_attr( $wtl_settings['icon_content_bg_color'] ) : '#00bcd4'; ?>;
				<?php echo isset( $wtl_settings['template_line_color'] ) ? 'border-left: 1px solid ' . esc_attr( $wtl_settings['template_line_color'] ) : '#d6d6d6'; ?>;
			}
			<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-schedule-all-post-content .wtl-post-content {
				<?php echo isset( $wtl_settings['icon_content_bg_color'] ) ? 'border-left: 6px solid ' . esc_attr( $wtl_settings['icon_content_bg_color'] ) : '#00bcd4'; ?>;
				<?php echo isset( $wtl_settings['template_line_color'] ) ? 'border-right: 1px solid ' . esc_attr( $wtl_settings['template_line_color'] ) : '#d6d6d6'; ?>;
				<?php echo isset( $wtl_settings['template_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_color'] ) : '#FFFFFF'; ?>;
			}
			<?php echo esc_attr( $layout_id ); ?> .wtl_blog_single_post_wrapp:after {
				<?php echo isset( $wtl_settings['template_line_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_line_color'] ) : '#d6d6d6'; ?>;
			}
			<?php echo esc_attr( $layout_id ); ?> .wtl-schedule-wrap .wtl-schedule-all-post-content .wtl-post-content,
			<?php echo esc_attr( $layout_id ); ?> .wtl_blog_single_post_wrapp:nth-child(odd) .wtl-post-inner-content .wtl-post-content {
				<?php echo isset( $wtl_settings['template_line_color'] ) ? 'border-top: 1px solid ' . esc_attr( $wtl_settings['template_line_color'] ) : '#d6d6d6'; ?>;
				<?php echo isset( $wtl_settings['template_line_color'] ) ? 'border-bottom: 1px solid ' . esc_attr( $wtl_settings['template_line_color'] ) : '#d6d6d6'; ?>;
			}
			<?php echo esc_attr( $layout_id ); ?> .wtl_blog_single_post_wrapp figure {
				<?php echo isset( $wtl_settings['template_line_color'] ) ? 'border: 2px solid ' . esc_attr( $wtl_settings['template_line_color'] ) : '#d6d6d6'; ?>;
				padding: 10px 10px;
			}
			@media only screen and (max-width: 767px) {

				.wtl-schedule-wrap .wtl-schedule-post-content {
					width: auto;
					margin-left: 110px;
					float: none;
					padding-left: 20px;
				}
				.wtl-schedule-wrap .wtl-schedule-post-content .wtl-post-center-image {
					left: -57px !important;
					right: auto !important;
				}
				.wtl-schedule-wrap .wtl-schedule-post-content {
					margin-left: 90px !important;
				}
				.wtl-schedule-wrap .wtl-schedule-post-content .wtl-schedule-all-post-content {
					width: auto;
				}
				<?php echo esc_attr( $layout_id ); ?> .wtl_blog_single_post_wrapp:nth-child(odd) .wtl-post-inner-content .wtl-post-content {
					<?php echo isset( $wtl_settings['template_line_color'] ) ? 'border-right: 1px solid ' . esc_attr( $wtl_settings['template_line_color'] ) : '#d6d6d6'; ?>;
					<?php echo isset( $wtl_settings['icon_content_bg_color'] ) ? 'border-left: 6px solid ' . esc_attr( $wtl_settings['icon_content_bg_color'] ) : '#00bcd4'; ?>;
				}
			}
			@media only screen and (min-width: 768px) {
				.post_even .wtl-schedule-all-post-content {
				float: right;
				}
				.scroll-to-top {
				text-align: center;
				}
				.wtl-schedule-wrap .wtl-schedule-post-content {
					width: 100%;
				}
			}
		<?php
		}

		/*------------------ Template: MilestoneTimeline Layout --------------- */
	if ( 'milestonetimeline_layout' === $wp_timeline_theme ) { ?>
		.wtl_blog_template {
			<?php echo isset( $wtl_settings['template_bgcolor'] ) ? 'background:' . esc_attr( $wtl_settings['template_bgcolor'] ) . ';' : ''; ?>
		}
		<?php echo esc_attr( $layout_id ); ?> .wtl-post-content .wtl-post-text {
			<?php echo isset( $wtl_settings['content_font_text_decoration'] ) ? 'text-decoration:' . esc_attr( $wtl_settings['content_font_text_decoration'] ) : ''; ?> !important;
		}
		/* Meta */
			<?php echo esc_attr( $layout_id ); ?> .wtl-meta-content .wtl-post-category span,
			<?php echo esc_attr( $layout_id ); ?> .wtl-meta-content .wtl-post-tags span,
			<?php echo esc_attr( $layout_id ); ?> .post-bottom .post-by span,
			<?php echo esc_attr( $layout_id ); ?> .wtl-meta-content .category-link a,
			<?php echo esc_attr( $layout_id ); ?> .wtl-meta-content .tags a,
			<?php echo esc_attr( $layout_id ); ?> span.author-name,span.author-name a,span.wtl-comment,span.wtl-comment a,span.wtl-wrapper-like,.posted_by a, .post-author .link-lable,
			<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .social-component a ,
			<?php echo esc_attr( $layout_id ); ?> .posted_by a .datetime {
				<?php
				echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_family'] ) ? 'font-family:' . esc_attr( $wtl_settings['meta_font_family'] ) . ';' : '';
				echo isset( $wtl_settings['meta_fontsize'] ) ? 'font-size:' . esc_attr( $wtl_settings['meta_fontsize'] ) . 'px;' : '';
				echo isset( $wtl_settings['meta_font_weight'] ) ? 'font-weight:' . esc_attr( $wtl_settings['meta_font_weight'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_line_height'] ) ? 'line-height:' . esc_attr( $wtl_settings['meta_font_line_height'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_text_transform'] ) ? 'text-transform:' . esc_attr( $wtl_settings['meta_font_text_transform'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_text_decoration'] ) ? 'text-decoration:' . esc_attr( $wtl_settings['meta_font_text_decoration'] ) . ';' : '';
				echo isset( $wtl_settings['meta_font_letter_spacing'] ) ? 'letter-spacing:' . esc_attr( $wtl_settings['meta_font_letter_spacing'] ) . ';' : '';
				?>
			}
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-date,
			<?php echo esc_attr( $layout_id ); ?> .wtl-ss-left, 
			<?php echo esc_attr( $layout_id ); ?> .wtl-ss-right {
				<?php echo isset( $wtl_settings['template_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_color'] ) : '#0087BF'; ?>;
			}
			<?php echo esc_attr( $layout_id ); ?> .wp-timeline-post-image i {
				<?php echo isset( $wtl_settings['template_color'] ) ? 'color:' . esc_attr( $wtl_settings['template_color'] ) : '#0087BF'; ?>;
			}
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-date:after {
				<?php echo isset( $wtl_settings['template_color'] ) ? 'border-left: 40px solid ' . esc_attr( $wtl_settings['template_color'] ) : '#0087BF'; ?>;
			}
			<?php echo esc_attr( $layout_id ); ?> .wtl-ss-left > i, 
			<?php echo esc_attr( $layout_id ); ?> .wtl-ss-right > i {
				<?php echo isset( $wtl_settings['template_icon_color'] ) ? 'color:' . esc_attr( $wtl_settings['template_icon_color'] ) : '#FFFFFF'; ?>;
			}
			<?php echo esc_attr( $layout_id ); ?> .wp-timeline-post-image i {
				<?php echo isset( $wtl_settings['template_icon_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_icon_color'] ) : '#FFFFFF'; ?>;
			}
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-date:before {
				<?php echo isset( $wtl_settings['template_icon_color'] ) ? 'border-left: 40px solid ' . esc_attr( $wtl_settings['template_bgcolor'] ) : '#FFFFFF'; ?>;
			}
			/* Box */
			<?php echo esc_attr( $layout_id ); ?>  .wtl_blog_template {
				<?php
				echo esc_attr( Wtl_Template_Config::content_box_shadow( $wtl_settings ) );
				echo esc_attr( Wtl_Template_Config::content_box_border_radius( $wtl_settings ) );
				echo esc_attr( Wtl_Template_Config::content_box_border( $wtl_settings ) );
				echo esc_attr( Wtl_Template_Config::content_box_padding( $wtl_settings ) );
				echo esc_attr( Wtl_Template_Config::content_box_bg_color( $wtl_settings ) );
				?>
			}
			<?php
			echo esc_attr( Wtl_Template_Config::dropcap( $wtl_settings, $layout_id ) );
			echo esc_attr( Wtl_Template_Config::post_content_color( $wtl_settings, $layout_id ) );
			echo esc_attr( Wtl_Template_Config::read_more_style( $wtl_settings, $layout_id ) );
			echo esc_attr( Wtl_Template_Config::load_more_button( $wtl_settings, $layout_id ) );
			echo esc_attr( Wtl_Template_Config::post_meta_typography( $wtl_settings, $layout_id ) );
			?>
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-category a,
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a, 
			<?php echo esc_attr( $layout_id ); ?> span.author-name a i,
			<?php echo esc_attr( $layout_id ); ?> .wtl-comment i,
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags i,
			<?php echo esc_attr( $layout_id ); ?> .wtl-meta-content-left i,
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-category .post-category a,
			<?php echo esc_attr( $layout_id ); ?> .wtl-meta-content-left i:before {
				<?php
				$template_ftcolor = isset( $wtl_settings['template_ftcolor'] ) ? $wtl_settings['template_ftcolor'] : '';
				if ( $template_ftcolor ) {
					echo 'color:' . esc_attr( $template_ftcolor ) . ';';
				}
				?>
			}
			<?php echo esc_attr( $layout_id ); ?> .wtl-post-tags a:hover{
				<?php
				$template_fthovercolor = isset( $wtl_settings['template_fthovercolor'] ) ? $wtl_settings['template_fthovercolor'] : '#23527c';
				if ( $template_fthovercolor ) {
					echo 'color:' . esc_attr( $template_fthovercolor ) . ';';
				}
				?>
			}
			<?php echo esc_attr( $layout_id ); ?> .author a,
			<?php echo esc_attr( $layout_id ); ?> .comments-link,
			<?php echo esc_attr( $layout_id ); ?> .wtl-wrapper-like a{
				<?php echo isset( $wtl_settings['template_ftcolor'] ) ? 'color:' . esc_attr( $wtl_settings['template_ftcolor'] ) . ' !important;' : ''; ?>
			}
			<?php
			$border_width = isset( $wtl_settings['wp_timeline_content_border_width'] ) ? $wtl_settings['wp_timeline_content_border_width'] : '';
			$border_style = isset( $wtl_settings['wp_timeline_content_border_style'] ) ? $wtl_settings['wp_timeline_content_border_style'] : '';
			$border_color = isset( $wtl_settings['wp_timeline_content_border_color'] ) ? $wtl_settings['wp_timeline_content_border_color'] : '';
			?>
			<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl_blog_single_post_wrapp:before{
				border-top: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
				border-right: <?php echo esc_attr( $border_width ); ?>px <?php echo esc_attr( $border_style ); ?> <?php echo esc_attr( $border_color ); ?>;
				<?php echo isset( $wtl_settings['template_content_box_bg_color'] ) ? 'background:' . esc_attr( $wtl_settings['template_content_box_bg_color'] ) : '#fff'; ?>
			}
			<?php echo esc_attr( $layout_id ); ?> .social-component a {
				border-radius: 0;
				border: none;
			}
			<?php echo esc_attr( $layout_id ); ?> .social-component a:hover {
				background-color: inherit !important;
			}
			<?php echo esc_attr( $layout_id ); ?> .wtl_blog_template .wtl-post-title a {
				font-style: normal;
			}

			<?php echo esc_attr( $layout_id ); ?> .wtl_woo_sale_wrap.left-top span.onsale,
			<?php echo esc_attr( $layout_id ); ?> .wtl_woo_sale_wrap.left-bottom span.onsale {
				width: 20%;
			}
			
			<?php echo esc_attr( $layout_id ); ?> .wp_timeline_woocommerce_price_wrap {
				<?php
				if ( isset( $wp_timeline_pricetextcolor ) && '' !== $wp_timeline_pricetextcolor ) { ?>
					color: <?php echo esc_attr( $wp_timeline_pricetextcolor ); ?> !important;<?php } ?>
			}
			<?php echo esc_attr( $layout_id ); ?> .wtl-ss-left, <?php echo esc_attr( $layout_id ); ?> .wtl-ss-right {
				<?php
				if ( isset( $wtl_settings['navigation_bg_color'] ) ) {
					echo 'background-color:' . esc_attr( $wtl_settings['navigation_bg_color'] ) . ';';
				}
				?>
			}
			<?php echo esc_attr( $layout_id ); ?> .wtl-ss-left > i, <?php echo esc_attr( $layout_id ); ?> .wtl-ss-right > i {
				<?php
					if ( isset( $wtl_settings['navigation_color'] ) ) {
						echo 'color:' . esc_attr( $wtl_settings['navigation_color'] ) . ';';
					}
					if ( isset( $wtl_settings['navigation_arrow_size'] ) ) {
						echo 'font-size:' . esc_attr( $wtl_settings['navigation_arrow_size'] ) . 'px;';
					}
				?>
			}
			<?php 
				if ( isset( $firstletter_big ) && 1 == $firstletter_big ) { 
					$first_letter_line_height = $firstletter_fontsize * 75 / 100;
					?>
					<?php echo esc_attr( $layout_id ); ?> .wtl-post-content .post-content-inner:first-letter {
						<?php
						if ( isset( $firstletter_font_family ) && $firstletter_font_family ) {
							?>
							font-family :<?php echo esc_attr( $firstletter_font_family ); ?>; <?php } ?>
							font-size   : <?php echo esc_attr( $firstletter_fontsize ) . 'px'; ?>;
							color       : <?php echo esc_attr( $firstletter_contentcolor ); ?>;
							margin-right: 5px;
							line-height : <?php echo esc_attr( $first_letter_line_height ) . 'px'; ?>;
							display     : inline-block;
							<?php
							if ( isset( $content_font_text_decoration ) && $content_font_text_decoration ) {
								?>
								text-decoration: <?php echo esc_attr( $content_font_text_decoration ); ?>;
							<?php } ?>
						}
				<?php } ?>
		<?php
		}
/* Custom CSS */
if ( isset( $wtl_settings['custom_css'] ) && ! empty( $wtl_settings['custom_css'] ) ) {
	echo esc_attr( wp_unslash( $wtl_settings['custom_css'] ) );
}
?>
</style>
<?php
/* Dynamic Style End. */
?>
