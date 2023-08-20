<?php
namespace EssentialBlocks\blocks;

use EssentialBlocks\Core\Block;

class AdvancedVideo extends Block {
	protected $frontend_scripts = array( 'essential-blocks-advanced-video-frontend' );
	protected $frontend_styles  = array( 'essential-blocks-frontend-style', 'essential-blocks-fontawesome' );

	/**
	 * Unique name of the block.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'advanced-video';
	}

	/**
	 * Register all other scripts
	 *
	 * @return void
	 */
	public function register_scripts() {
		$this->assets_manager->register(
			'advanced-video-frontend',
			$this->path() . '/frontend/index.js',
			array( 'essential-blocks-vendor-bundle' )
		);
	}
}
