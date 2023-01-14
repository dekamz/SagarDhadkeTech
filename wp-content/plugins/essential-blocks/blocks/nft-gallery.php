<?php

/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package essential-blocks
 */

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * @see https://wordpress.org/gutenberg/handbook/designers-developers/developers/tutorials/block-tutorial/applying-styles-with-stylesheets/
 */
function nft_gallery_block_init()
{
	// Skip block registration if Gutenberg is not enabled/merged.
	if (!function_exists('register_block_type')) {
		return;
	}

	/* Frontend Script */
	$dependencies = include_once ESSENTIAL_BLOCKS_DIR_PATH . 'blocks/nft-gallery/frontend/index.asset.php';
	wp_register_script(
		'essential-blocks-nft-gallery-frontend',
		ESSENTIAL_BLOCKS_ADMIN_URL . 'blocks/nft-gallery/frontend/index.js',
		$dependencies['dependencies'],
		EssentialAdmin::get_version(ESSENTIAL_BLOCKS_DIR_PATH . 'blocks/nft-gallery/frontend/index.js'),
		true
	);

	register_block_type(
		EssentialBlocks::get_block_register_path("nft-gallery"),
		array(
			'editor_script' => 'essential-blocks-editor-script',
			'editor_style'    	=> ESSENTIAL_BLOCKS_NAME . '-editor-css',
			'render_callback' => function ($attributes, $content) {
				if (!is_admin()) {
					wp_enqueue_script('essential-blocks-nft-gallery-frontend');

					wp_enqueue_style('essential-blocks-frontend-style');
				}
				return $content;
			}
		)
	);
}
add_action('init', 'nft_gallery_block_init');
