<?php

function create_timeline_block_init() {
	$dir = dirname( __FILE__ );

	$script_asset_path = "$dir/build/index.asset.php";
	if ( ! file_exists( $script_asset_path ) ) {
		throw new Error(
			'You need to run `npm start` or `npm run build` for the "cooltimeline/timeline-block" block first.'
		);
	}
	// Scripts.
	wp_register_script(
		'create-block-timeline-block-editor', // Handle.
		plugins_url( 'gutenberg-block/build/blocks.build.js', $dir ), // Block.build.js: We register the block here. Built with Webpack.
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-editor' ), // Dependencies, defined above.
		true // Enqueue the script in the footer.
	);
	// Styles.
	wp_register_style(
		'create-block-timeline-block-editor-css', // Handle.
		plugins_url( 'gutenberg-block/build/blocks.editor.build.css', $dir ), // Block editor CSS.
		array( 'wp-edit-blocks' ) // Dependency to include the CSS after it.
		// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.editor.build.css' ) // Version: filemtime — Gets file modification time.
	);
	wp_register_style(
		'gctl-timeline-styles-css',
		plugins_url( 'gutenberg-block/build/blocks.style.build.css', $dir ),
		array()
	);
	if ( class_exists( 'WP_Block_Type_Registry' ) ) {
		if ( ! WP_Block_Type_Registry::get_instance()->is_registered( 'essential-blocks/timeline-block' ) ) {
			register_block_type(
				'cooltimeline/timeline-block',
				array(
					'style'         => 'gctl-timeline-styles-css',
					'editor_style'  => 'create-block-timeline-block-editor-css',
					'editor_script' => 'create-block-timeline-block-editor',
				)
			);
		}
	}
}

// dequeue instant timeline block css file
function cltb_gctl_block_editor_assets() {
	$id = get_the_ID();

	if ( ! has_block( 'cooltimeline/timeline-block', $id ) ) {
		wp_dequeue_style( 'gctl-timeline-styles-css' );
	}
}

add_action( 'enqueue_block_assets', 'cltb_gctl_block_editor_assets' );
add_action( 'init', 'create_timeline_block_init' );
