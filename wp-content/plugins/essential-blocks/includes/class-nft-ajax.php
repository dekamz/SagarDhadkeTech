<?php

/**
 * EB_Nft_Ajax
 *
 * AJAX Event Handler
 *
 * @class    EB_Nft_Ajax
 * @version  3.6.0
 * @package  admin/frontend
 * @category Class
 * @author   Jamil Uddin
 */

if (!defined('ABSPATH')) {
    exit;
}

class EB_Nft_Ajax
{
    private static $instance;

    public static function init()
    {
        if (null === self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * The Constructor.
     */
    public function __construct()
    {
        self::eb_ajax_action_init();
    }

    private static function isset_check($value, $default = '')
    {
        if (isset($_POST[$value])) {
            return $_POST[$value];
        } else {
            return $default;
        }
    }

    public static function eb_ajax_action_init()
    {
        $ajax_events = array(
            'opensea_nft_collections'   => array(
                'callback' => 'opensea_nft_collections_callback',
                'nopriv' => true
            ),
            'opensea_api_key'   => array(
                'callback' => 'opensea_api_key_callback',
                'nopriv' => true
            ),
            'opensea_api_key_save'   => array(
                'callback' => 'opensea_api_key_save_callback',
                'nopriv' => false
            ),
        );

        foreach ($ajax_events as $ajax_event_key => $ajax_event_func) {
            add_action('wp_ajax_' . $ajax_event_key, array(__CLASS__, $ajax_event_func['callback']));
            if ($ajax_event_func['nopriv']) {
                add_action('wp_ajax_nopriv_' . $ajax_event_key, array(__CLASS__, $ajax_event_func['callback']));
            }
        }
    }

    /**
     * API Call to Get NFT Data
     */
    public static function opensea_nft_collections_callback()
    {
        if (!wp_verify_nonce($_POST['nft_nonce'], 'eb-nft-nonce')) {
            die(__('Nonce did not match', 'essential-blocks'));
        }

        $limit = 6;

        if (isset($_POST['nft_source'])) {
            if ($_POST['nft_source'] === "opensea") {

                $opensea_api = "b61c8a54123d4dcb9acc1b9c26a01cd1";
                $settings = get_option('eb_settings');

                if (isset($_POST['openseaApiKey'])) {
                    $opensea_api = $_POST['openseaApiKey'];
                } elseif (is_array($settings) && isset($settings['openseaApi'])) {
                    $opensea_api = $settings['openseaApi'];
                }

                $url = "https://api.opensea.io/api/v1";
                $param = array();

                if (isset($_POST['openseaType'])) {
                    //To retrieve Collections
                    if ($_POST['openseaType'] === "collections") {
                        $url .= "/collections";
                        $values = array(
                            'asset_owner' => self::isset_check('openseaCollectionmWalletId'),
                            'offset' => self::isset_check('offset', 0),
                            'limit' => self::isset_check('openseaCollectionLimit', $limit),
                        );
                        $param = array_merge($param, $values);
                    }
                    //To retrieve Assets
                    elseif ($_POST['openseaType'] === "items") {
                        $url .= "/assets";
                        $values = array(
                            'include_orders' => self::isset_check('openseaItemIncludeOrder', true),
                            'limit' => self::isset_check('openseaItemLimit', $limit),
                            'order_direction' => self::isset_check('openseaItemOrderBy', 'desc'),
                        );
                        if (isset($_POST['openseaItemFilterBy'])) {
                            if ($_POST['openseaItemFilterBy'] === "slug") {
                                $values['collection_slug'] = self::isset_check('openseaCollectionSlug');
                            } else if ($_POST['openseaItemFilterBy'] === "wallet") {
                                $values['owner'] = self::isset_check('openseaItemWalletId');
                            }
                        }
                        $param = array_merge($param, $values);
                    }
                }
                $headers = array(
                    'headers' => array(
                        'Content-Type' => 'application/json',
                        'X-API-KEY' => $opensea_api,
                    )
                );
                $options = array(
                    'timeout' => 240
                );
                $response = Essential_Blocks_Api::get($url, $param, $headers, $options);
                return $response;
            }
        }

        exit;
    }

    public static function opensea_api_key_callback()
    {
        if (!wp_verify_nonce($_POST['nft_nonce'], 'eb-nft-nonce')) {
            die(__('Nonce did not match', 'essential-blocks'));
        }

        $settings = get_option('eb_settings');

        if (is_array($settings) && isset($settings['openseaApi'])) {
            wp_send_json_success($settings['openseaApi']);
        } else {
            wp_send_json_error("Couldn't found data");
        }
        exit;
    }

    public static function opensea_api_key_save_callback()
    {
        if (!wp_verify_nonce($_POST['nft_nonce'], 'eb-nft-nonce')) {
            die(__('Nonce did not match', 'essential-blocks'));
        }

        $api = "";
        if (isset($_POST['openseaApi'])) {
            $api = trim($_POST['openseaApi']);
        }

        $settings = is_array(get_option('eb_settings')) ? get_option('eb_settings') : [];
        if (strlen($api) === 0 ) {
            unset($settings['openseaApi']);
        }
        else {
            $settings['openseaApi'] = $api;
        }

        if (is_array($settings) > 0) {
            $output = update_option('eb_settings', $settings);
            wp_send_json_success($output);
        }
        else {
            wp_send_json_error("Couldn't save data");
        }

        exit;
    }
}

EB_Nft_Ajax::init();
