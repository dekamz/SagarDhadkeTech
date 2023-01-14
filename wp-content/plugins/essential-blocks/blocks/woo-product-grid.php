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
function eb_woo_product_grid()
{
    // Skip block registration if Gutenberg is not enabled/merged.
    if (!function_exists('register_block_type')) {
        return;
    }

    $dir = dirname(__FILE__);

    $frontend_dependencies = include_once ESSENTIAL_BLOCKS_DIR_PATH . 'blocks/woo-product-grid/frontend/index.asset.php';
    //  Frontend Script
    $frontEnd_js = 'woo-product-grid/frontend/index.js';
    wp_register_script(
        'essential-blocks-woo-product-grid-frontend',
        ESSENTIAL_BLOCKS_ADMIN_URL . 'blocks/woo-product-grid/frontend/index.js',
        $frontend_dependencies['dependencies'],
        EssentialAdmin::get_version($dir . "/" . $frontEnd_js),
        true
    );

    register_block_type(
        EssentialBlocks::get_block_register_path("woo-product-grid"),
        array(
            'editor_script' => 'essential-blocks-editor-script',
            'editor_style'        => ESSENTIAL_BLOCKS_NAME . '-editor-css',
            'render_callback' =>  'eb_woo_product_grid_callback'
        )
    );
}
add_action('init', 'eb_woo_product_grid');

// queries api
if (!function_exists('eb_woo_product_grid_get_posts_api_callback')) {

    // Create API Endpoint for
    add_action('rest_api_init', function () {
        register_rest_route('eb-woo-product-grid/v1', '/queries', array(
            'methods'  => 'GET',
            'callback' => 'eb_woo_product_grid_get_posts_api_callback',
            'permission_callback' => function () {
                return true;
            }
        ));
    });

    function eb_woo_product_grid_get_posts_api_callback($request)
    {

        $queryData = unserialize($request['query_data']);
        $attributes = unserialize($request['attributes']);
        $pageNumber = (int)$request['pageNumber'] - 1;

        if (isset($queryData['per_page']) && isset($queryData['offset'])) {
            $queryData['offset'] = (int)$queryData['offset'] + ((int)$queryData['per_page'] * (int)$pageNumber);
        }

        $args = [];
        $args['per_page']   = isset($queryData['per_page']) ? $queryData['per_page'] : 10;
        $args['orderby']    = isset($queryData['orderby']) && !empty($queryData['orderby']) ? implode(",", EBHelpers::array_column_from_json($queryData['orderby'], 'value')) : 'date';
        $args['order']      = isset($queryData['order']) && !empty($queryData['order']) ? implode(",", EBHelpers::array_column_from_json($queryData['order'], 'value')) : 'desc';
        $args['offset']     = isset($queryData['offset']) ? $queryData['offset'] : 0;
        $args['category'] = isset($queryData['category']) && !empty($queryData['category']) ? implode(",", EBHelpers::array_column_from_json($queryData['category'], 'value')) : array();
        $args['tag']       = isset($queryData['tag']) && !empty($queryData['tag']) ? implode(",", EBHelpers::array_column_from_json($queryData['tag'], 'value')) : array();

        $args = EBHelpers::woo_products_query_builder($args);

        $query = new \WP_Query($args);

        // $queryResult = $query;
        if ($query) {
            $posts_markup = eb_woo_products_markup($attributes, $query);
            return $posts_markup;
            wp_die();
        } else {
            return false;
        }

        wp_die();
    }
}

/**
 * render callback function
 */
function eb_woo_product_grid_callback($attributes)
{
    // return if WooCommerce is not activate/installed
    if (!function_exists('WC')) {
        return;
    }

    if (!is_admin()) {
        wp_enqueue_style("essential-blocks-frontend-style");
        wp_enqueue_style(
            'eb-fontawesome-frontend',
            plugins_url('assets/css/font-awesome5.css', dirname(__FILE__)),
            array()
        );
        wp_enqueue_script('essential-blocks-woo-product-grid-frontend');

        $blockId            = EBHelpers::get_data($attributes, 'blockId', '');
        $classHook          = isset($attributes["classHook"]) ? $attributes["classHook"] : "";
        $layout             = EBHelpers::get_data($attributes, 'layout', 'grid');
        $gridPreset         = EBHelpers::get_data($attributes, 'gridPreset', 'grid-preset-1');
        $listPreset         = EBHelpers::get_data($attributes, 'listPreset', 'list-preset-1');
        $presetClass = "grid" === $layout ? $gridPreset : $listPreset;

        $essentialAttr = array(
            'layout' => EBHelpers::get_data($attributes, 'layout', 'grid'),
            'gridPreset' => EBHelpers::get_data($attributes, 'gridPreset', 'grid-preset-1'),
            'listPreset' => EBHelpers::get_data($attributes, 'listPreset', 'list-preset-1'),
            'saleBadgeAlign' => EBHelpers::get_data($attributes, 'saleBadgeAlign', 'align-left'),
            'saleText' => EBHelpers::get_data($attributes, 'saleText', 'sale'),
            'showRating' => isset($attributes["showRating"]) ? $attributes["showRating"] : true,
            'showPrice' => isset($attributes["showPrice"]) ? $attributes["showPrice"] : true,
            'showSaleBadge' => isset($attributes["showSaleBadge"]) ? $attributes["showSaleBadge"] : true,
            'productDescLength' => EBHelpers::get_data($attributes, 'productDescLength', 5),
            'isCustomCartBtn' => EBHelpers::get_data($attributes, 'isCustomCartBtn', false),
            'simpleCartText' => EBHelpers::get_data($attributes, 'simpleCartText', 'Buy Now'),
            'variableCartText' => EBHelpers::get_data($attributes, 'variableCartText', 'Select options'),
            'groupedCartText' => EBHelpers::get_data($attributes, 'groupedCartText', 'View products'),
            'externalCartText' => EBHelpers::get_data($attributes, 'externalCartText', 'Buy now'),
            'defaultCartText' => EBHelpers::get_data($attributes, 'defaultCartText', 'Read more'),
        );

        $queryData          = EBHelpers::get_data($attributes, 'queryData', array());
        $args = [];
        $args['per_page']   = isset($queryData['per_page']) ? $queryData['per_page'] : 10;
        $args['orderby']    = isset($queryData['orderby']) && !empty($queryData['orderby']) ? implode(",", EBHelpers::array_column_from_json($queryData['orderby'], 'value')) : 'date';
        $args['order']      = isset($queryData['order']) && !empty($queryData['order']) ? implode(",", EBHelpers::array_column_from_json($queryData['order'], 'value')) : 'desc';
        $args['offset']     = isset($queryData['offset']) ? $queryData['offset'] : 0;
        $args['category'] = isset($queryData['category']) && !empty($queryData['category']) ? implode(",", EBHelpers::array_column_from_json($queryData['category'], 'value')) : array();
        $args['tag']       = isset($queryData['tag']) && !empty($queryData['tag']) ? implode(",", EBHelpers::array_column_from_json($queryData['tag'], 'value')) : array();

        $args = EBHelpers::woo_products_query_builder($args);

        $query = new \WP_Query($args);

        ob_start();
?>
        <div class="eb-parent-wrapper eb-parent-<?php echo esc_attr($blockId); ?> <?php echo esc_attr($classHook); ?>">
            <div class="eb-woo-products-wrapper <?php echo $blockId; ?>" data-id="<?php echo $blockId; ?>" data-querydata='<?php echo serialize($queryData); ?>' data-attributes='<?php echo serialize($essentialAttr); ?>'>
                <div class="eb-woo-products-gallery <?php echo $presetClass; ?>">
                    <?php
                    if ($query->have_posts()) {
                        echo eb_woo_products_markup($attributes, $query);
                    }

                    if (!$query->have_posts()) {
                    ?><p><?php _e('No product found', 'essential-blocks'); ?></p><?php
                                                                                }
                                                                                    ?>
                </div>
                <?php
                // Pagination
                if ($query->have_posts()) {
                    $pagination = isset($attributes["loadMoreOptions"]) ? $attributes["loadMoreOptions"] : [];
                    if (isset($pagination['totalPosts']) && (int)$pagination['totalPosts'] > (int)$queryData['per_page']) {
                        if (is_array($pagination) && isset($pagination['enableMorePosts']) && $pagination['enableMorePosts']) {
                            $prev_next_class = $pagination['loadMoreType'] === '3' ? "prev-next-btn" : "";
                            echo '<div class="ebpg-pagination ' . $prev_next_class . '">';

                            if ($pagination['loadMoreType'] === '1') {
                                echo  sprintf(
                                    '<button class="btn ebpg-pagination-button" data-pagenumber="1">
								%1$s
							</button>',
                                    $pagination['loadMoreButtonTxt']
                                );
                            }

                            $prevTxt = isset($pagination['prevTxt']) ? $pagination['prevTxt'] : "<";
                            $nextTxt = isset($pagination['nextTxt']) ? $pagination['nextTxt'] : ">";
                            if (isset($pagination['totalPosts']) && ($pagination['loadMoreType'] === '2' || $pagination['loadMoreType'] === '3')) {
                                $totalPages = ceil((int)$pagination['totalPosts'] / (int)$queryData['per_page']);
                                echo sprintf(
                                    '<button class="ebpg-pagination-item-previous">
								%1$s
							</button>',
                                    esc_html__($prevTxt)
                                );
                                for ($i = 1; $i <= $totalPages; $i++) {
                                    $active = $i == 1 ? "active" : "";

                                    echo sprintf(
                                        '<button class="ebpg-pagination-item %2$s" data-pagenumber="%1$s">
									%1$s
								</button>',
                                        $i,
                                        $active
                                    );
                                }
                                echo sprintf(
                                    '<button class="ebpg-pagination-item-next">
								%1$s
							</button>',
                                    esc_html__($nextTxt)
                                );
                            }

                            echo  '</div>';
                        }
                    }
                }
                ?>
            </div>
        </div>

<?php
        wp_reset_postdata();
        return ob_get_clean();
    } // is_admin
}



if (!function_exists('eb_woo_products_markup')) {
    function eb_woo_products_markup($attributes, $query)
    {
        $html = '';
        $layout             = EBHelpers::get_data($attributes, 'layout', 'grid');
        $gridPreset         = EBHelpers::get_data($attributes, 'gridPreset', 'grid-preset-1');
        $listPreset         = EBHelpers::get_data($attributes, 'listPreset', 'list-preset-1');
        $saleBadgeAlign     = EBHelpers::get_data($attributes, 'saleBadgeAlign', 'align-left');
        $saleText           = EBHelpers::get_data($attributes, 'saleText', 'sale');
        $showRating         = isset($attributes["showRating"]) ? $attributes["showRating"] : true;
        $showPrice          = isset($attributes["showPrice"]) ? $attributes["showPrice"] : true;
        $showSaleBadge      = EBHelpers::get_data($attributes, 'showSaleBadge', true);
        $productDescLength  = EBHelpers::get_data($attributes, 'productDescLength', 5);


        $isCustomCartBtn    = EBHelpers::get_data($attributes, 'isCustomCartBtn', false);
        $simpleCartText     = EBHelpers::get_data($attributes, 'simpleCartText', 'Buy Now');
        $variableCartText   = EBHelpers::get_data($attributes, 'variableCartText', 'Select options');
        $groupedCartText    = EBHelpers::get_data($attributes, 'groupedCartText', 'View products');
        $externalCartText   = EBHelpers::get_data($attributes, 'externalCartText', 'Buy now');
        $defaultCartText    = EBHelpers::get_data($attributes, 'defaultCartText', 'Read more');

        $customCartText     = array('simple' => $simpleCartText, 'variable' => $variableCartText, 'group' => $groupedCartText, 'external' => $externalCartText, 'default' => $defaultCartText);


        if ($isCustomCartBtn) {
            add_filter('woocommerce_product_add_to_cart_text', function () use ($isCustomCartBtn, $customCartText) {

                global $product;
                switch ($product->get_type()) {
                    case 'external':
                        return $customCartText['external'];
                    case 'grouped':
                        return $customCartText['group'];
                    case 'simple':
                        if (!$product->is_in_stock()) {
                            return $customCartText['default'];
                        }
                        return $customCartText['simple'];
                    case 'variable':
                        return $customCartText['variable'];
                    default:
                        return $customCartText['default'];
                }

                if ('Read more' === $customCartText['default']) {
                    return esc_html__('View More', 'essential-blocks');
                }

                return $customCartText['default'];
            });
        }

        while ($query->have_posts()) {
            $query->the_post();
            $product = wc_get_product(get_the_ID());
            $html .= '<div class="eb-woo-products-col"><div class="eb-woo-product">';
            if ("grid" === $layout && 'grid-preset-3' === $gridPreset) {
                $html .= '<a class="grid-preset-anchor" href="' . esc_url(get_permalink()) . '"></a>';
            }
            $html .= '<div class="eb-woo-product-image-wrapper">';
            $html .= '<div class="eb-woo-product-image">';

            if ("list" === $layout) {
                $html .= '<a href="' . esc_url(get_permalink()) . '">';
            }
            $html .= wp_kses_post($product->get_image('woocommerce_thumbnail'));

            if ($showSaleBadge && $product->is_on_sale()) {
                $html .= '<span class="eb-woo-product-ribbon ' . $saleBadgeAlign . '">' . $saleText . '</span>';
            }
            if ("list" === $layout) {
                $html .= '</a>';
            }
            $html .= '</div>';

            if ('grid' === $layout) {
                $html .= '<div class="eb-woo-product-overlay">';
                $html .= '<div class="eb-woo-product-button-list">';
                ob_start();
                woocommerce_template_loop_add_to_cart();
                $html .= ob_get_clean();
                $html .= '</div>';
                $html .= '</div>';
            }
            $html .= '</div>';

            if ('grid' === $layout) {
                $html .= '<div class="eb-woo-product-content-wrapper">';
                $html .= '<div class="eb-woo-product-content">';
                if ($showRating) {
                    $html .= '<div class="eb-woo-product-rating-wrapper">';
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $product->get_average_rating()) {
                            $html .= '<span class="eb-woo-product-rating filled"><i class="fas fa-star"></i></span>';
                        } else {
                            $html .= '<span class="eb-woo-product-rating"><i class="far fa-star"></i></span>';
                        }
                    }
                    $html .=  '</div>';
                }
                $html .= '<h3 class="eb-woo-product-title"><a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a></h3>';
                if ($showPrice) {
                    $html .=  '<p class="eb-woo-product-price">' . $product->get_price_html() . '</p>';
                }
                $html .= '</div>';
                $html .= '</div>';
            }


            if ('list' === $layout) {
                $html .= '<div class="eb-woo-product-content-wrapper">';
                $html .= '<div class="eb-woo-product-content">';
                $html .= '<h3 class="eb-woo-product-title"><a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a></h3>';
                if ($showPrice) {
                    $html .= '<p class="eb-woo-product-price">' . wp_kses_post($product->get_price_html()) . '</p>';
                }
                if ($showRating) {
                    $html .= '<div class="eb-woo-product-rating-wrapper">';
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $product->get_average_rating()) {
                            $html .= '<span class="eb-woo-product-rating filled"><i class="fas fa-star"></i></span>';
                        } else {
                            $html .= '<span class="eb-woo-product-rating"><i class="far fa-star"></i></span>';
                        }
                    }
                    $html .= '</div>';
                }
                $html .= '<p class="eb-woo-product-details">';
                $html .= wp_trim_words(get_the_content(),$productDescLength);
                $html .= '</p>';
                $html .= '<div class="eb-woo-product-button-list">';
                ob_start();
                woocommerce_template_loop_add_to_cart();
                $html .= ob_get_clean();
                $html .= '</div></div></div>';
            }
            $html .= '</div></div>';
        }
        return $html;
    }
}
