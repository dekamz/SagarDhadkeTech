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
function social_share_block_init()
{
    // Skip block registration if Gutenberg is not enabled/merged.
    if (!function_exists('register_block_type')) {
        return;
    }

    /* Frontend Script */
    wp_register_script(
        'essential-blocks-social-share-js',
        ESSENTIAL_BLOCKS_ADMIN_URL . 'blocks/social-share/frontend/index.js',
        array(),
        EssentialAdmin::get_version(ESSENTIAL_BLOCKS_DIR_PATH . 'blocks/social-share/frontend/index.js'),
        true
    );

    register_block_type(
        EssentialBlocks::get_block_register_path("social-share"),
        array(
            'editor_script' => 'essential-blocks-editor-script',
            'editor_style'  => ESSENTIAL_BLOCKS_NAME . '-editor-css',
            'render_callback' => function ($attributes, $content) {
                ob_start();
                if (!is_admin()) {
                    wp_enqueue_style('essential-blocks-frontend-style');
                    wp_enqueue_style(
                        'eb-fontawesome-frontend',
                        plugins_url('assets/css/font-awesome5.css', dirname(__FILE__)),
                        array(),
                        ESSENTIAL_BLOCKS_VERSION,
                        'all'
                    );

                    wp_enqueue_style(
                        'essential-blocks-hover-css',
                        plugins_url('assets/css/hover-min.css', dirname(__FILE__)),
                        array(),
                        ESSENTIAL_BLOCKS_VERSION,
                        'all'
                    );
                    wp_enqueue_script("essential-blocks-social-share-js");
                }
                global $post;
                $profilesOnly = !empty($attributes['profilesOnly']) ? $attributes['profilesOnly'] : [];
                $iconEffect = !empty($attributes['icnEffect']) ? $attributes['icnEffect'] : '';
                $blockId = $attributes['blockId'];
                $classHook = !empty($attributes['classHook']) ? $attributes['classHook'] : '';
                $showTitle = isset($attributes['showTitle']) ? $attributes['showTitle'] : true;
                $isFloating = isset($attributes['isFloating']) ? $attributes['isFloating'] : false;
                $iconShape = isset($attributes['iconShape']) ? $attributes['iconShape'] : '';

?>
        <div <?php echo wp_kses_data(get_block_wrapper_attributes()); ?>>
            <div class="eb-parent-wrapper eb-parent-<?php echo esc_attr($blockId); ?> <?php echo esc_attr($classHook); ?>">
                <div class="<?php echo esc_attr($blockId); ?> eb-social-share-wrapper<?php echo $isFloating ? esc_attr(' eb-social-share-floating') : ''; ?><?php echo $isFloating && 'circular' == $iconShape ? esc_attr(' eb-social-share-circular') : "" ?>">
                    <ul class="eb-social-shares">
                        <?php
                        foreach ($profilesOnly as $profile) {
                            preg_match('/fa-([\w\-]+)/', $profile['icon'], $matches);
                            $iconClass = is_array($matches) && !empty($matches[1]) ? $matches[1] . '-original' : '';
                        ?>
                            <li>
                                <a class="<?php echo esc_attr($iconClass); ?><?php echo " " . esc_attr($iconEffect); ?>" href=<?php echo EBHelpers::eb_social_share_name_link($post->ID, $profile['icon']); ?> target="_blank" rel="nofollow noopener noreferrer">
                                    <i class="hvr-icon eb-social-share-icon <?php echo esc_attr($profile['icon']); ?>"></i>
                                    <?php
                                    if (!empty($showTitle && !empty($profile['iconText']))) { ?>
                                        <span class="eb-social-share-text"><?php echo esc_html($profile['iconText']); ?></span>
                                    <?php } ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
<?php
                return ob_get_clean();
            }
        )
    );
}
add_action('init', 'social_share_block_init');
