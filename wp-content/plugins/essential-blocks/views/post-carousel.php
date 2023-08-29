<?php
	$_wrapper_classes = array(
		$blockId,
		$preset,
		$className,
		$arrows == 1 ? 'slick-arrows' : 'arrow-none',
		$adaptiveHeight == 1 ? 'equal-height' : 'arrow-none',
		$dotPreset,
	);
	?>

<div class="eb-parent-wrapper eb-parent-<?php esc_attr_e( $blockId ); ?><?php esc_attr_e( $classHook ); ?>">
	<div
		class="eb-post-carousel-wrapper                                        <?php esc_attr_e( implode( ' ', $_wrapper_classes ) ); ?>"
		data-id="<?php esc_attr_e( $blockId ); ?>"
		data-querydata="<?php esc_attr_e( json_encode( $queryData ) ); ?>"
		data-slidersettings="<?php esc_attr_e( json_encode( $sliderSettings ) ); ?>"
		data-attributes="<?php esc_attr_e( json_encode( $essentialAttr ) ); ?>">

		<?php
			/**
			 * Post Grid Markup
			 */

		if ( ! empty( $posts ) ) {
			$_defined_vars = get_defined_vars();
			$_params       = isset( $_defined_vars['data'] ) ? $_defined_vars['data'] : array();

			$_params = array_merge(
				$_params,
				array(
					'posts'      => $posts,
					'queryData'  => isset( $queryData ) ? $queryData : array(),
					'source'     => isset( $queryData['source'] ) ? $queryData['source'] : 'post',
					'headerMeta' => ! empty( $headerMeta ) ? json_decode( $headerMeta ) : array(),
					'footerMeta' => ! empty( $footerMeta ) ? json_decode( $footerMeta ) : array(),
				)
			);

			$helper::views( 'post-partials/carousel-markup', $_params );
		}

			/**
			 * No Post Markup
			 */
		if ( empty( $posts ) ) {
			$helper::views(
				'common/no-content',
				array(
					'content' => __( 'No Posts Found', 'essential-blocks' ),
				)
			);
		}
		?>
	</div>
</div>
