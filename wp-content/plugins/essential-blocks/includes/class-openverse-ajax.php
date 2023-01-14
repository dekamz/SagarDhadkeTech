<?php
/**
 * EB_Openverse_Ajax
 *
 * AJAX Event Handler
 *
 * @class    EB_Openverse_Ajax
 * @version  3.6.0
 * @package  admin/frontend
 * @category Class
 * @author   Sumaiya Siddika
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class EB_Openverse_Ajax {

    private static $instance;

    public static function init() {
		if ( null === self::$instance ) {
            self::$instance = new self();
		}
        return self::$instance;
    }

    /**
     * The Constructor.
     */
    public function __construct() {
         self::eb_ajax_action_init();
    }

    private static function isset_check( $value, $default = '' ) {
        if ( isset( $_POST[ $value ] ) ) {
            return $_POST[ $value ];
        } else {
            return $default;
        }
    }

    public static function eb_ajax_action_init() {
         $ajax_events = array(
			 'eb_get_collections'      => 'eb_get_openverse_collections',
			 'eb_get_item'             => 'eb_get_openverse_item',
			 'eb_get_registration'     => 'eb_get_openverse_registration',
			 'eb_openverse_token'      => 'eb_generate_openverse_token',
			 'openverse_email_name_DB' => 'openverse_email_name_DB_callback',
		 );

		 foreach ( $ajax_events as $ajax_event_key => $ajax_event_func ) {
			 add_action( 'wp_ajax_' . $ajax_event_key, array( __CLASS__, $ajax_event_func ) );
			//  add_action( 'wp_ajax_nopriv_' . $ajax_event_key, array( __CLASS__, $ajax_event_func ) );
		 }
    }

    /**
     * Openverse Registration
     */
    public static function eb_get_openverse_registration() {
		if ( !isset( $_POST['openverse_reg_nonce'] ) || !wp_verify_nonce( sanitize_key( $_POST['openverse_reg_nonce'] ), 'eb-openverse-reg-nonce' ) ) {
            die( esc_html__( 'Nonce did not match', 'essential-blocks' ) );
		}

        $name  = sanitize_text_field( self::isset_check( 'openverseName' ) );
        $email = sanitize_email( self::isset_check( 'openverseEmail' ) );

        // Registration for client id and client secret
        $url = 'https://api.openverse.engineering/v1/auth_tokens/register/';

        $response = Essential_Blocks_Api::post(
            $url,
            array(
                'name'        => $name,
                // todo: will generate description dynamically later
                'description' => '1234xyzv',
                'email'       => $email,
            ),
            EBHelpers::makeRequestHeader(
                array(
					'Content-Type' => 'application/json',
                )
            ),
            array(
                'timeout' => 240,
            )
        );

        $response_array = get_object_vars( $response );

        if ( isset( $response_array['client_id'] ) && isset( $response_array['client_secret'] ) && isset( $response_array['name'] ) ) {
            self::openverse_reg_data_save(
                array(
					'client_id'     => $response_array['client_id'],
					'client_secret' => $response_array['client_secret'],
					'name'          => $response_array['name'],
					'email'         => $email,
                )
            );
        }

        wp_send_json( $response );
    }

    /**
     * Openverse Registration
     */
    public static function openverse_email_name_DB_callback() {
		if ( !isset( $_POST['openverse_nonce'] ) || !wp_verify_nonce( sanitize_key( $_POST['openverse_nonce'] ), 'eb-openverse-nonce' ) ) {
            die( esc_html__( 'Nonce did not match', 'essential-blocks' ) );
		}

        $settings    = get_option( 'eb_settings' );
        $admin_email = get_bloginfo( 'admin_email' );
        $site_name   = get_bloginfo( 'name' );

		if ( is_array( $settings ) && isset( $settings['openverseApi'] ) ) {
			wp_send_json_success( $settings['openverseApi'] );
		} elseif ( ! empty( $admin_email ) || ! empty( $site_name ) ) {
			$site_info = array(
				'email' => $admin_email,
				'name'  => $site_name,
			);
			wp_send_json_success( $site_info );
		} else {
			wp_send_json_error( "Couldn't found data " );
		}
        exit;
    }

    /**
     * Openverse token generate
     */
    private static function eb_generate_openverse_token_callback() {
        // get client idd ... from db
        $settings = get_option( 'eb_settings' );

        if ( ! is_array( $settings ) && ! isset( $settings['openverseApi'] ) ) {
            wp_send_json_error( "Couldn't found data" );
        }

		$client_id     = $settings['openverseApi']['client_id'];
		$client_secret = $settings['openverseApi']['client_secret'];

        // Registration for client id and client secret
        $url = 'https://api.openverse.engineering/v1/auth_tokens/token/';

        $response = Essential_Blocks_Api::post(
            $url,
            array(
                'client_id'     => $client_id,
                'client_secret' => $client_secret,
                'grant_type'    => 'client_credentials',
            ),
            EBHelpers::makeRequestHeader(
                array(
					'Content-Type' => 'multipart/form-data',
                )
            ),
            array(
                'timeout' => 240,
            )
        );

        $response_array                  = get_object_vars( $response );
        $access_token                    = $response_array['access_token'];
        $access_token_expires_in         = $response_array['expires_in'];
        $deduct_second_from_expire_token = 60;

        $set = set_transient( 'eb_openverse_token', $access_token, $access_token_expires_in - $deduct_second_from_expire_token );

        return $response_array;
    }

    /**
     * Openverse Token
     */
    public static function eb_generate_openverse_token() {
        $response = self::eb_generate_openverse_token_callback();

        wp_send_json( $response );

    }

    /**
     * API Call to Get Data
     */
    public static function eb_get_openverse_collections() {
        if ( !isset( $_POST['openverse_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['openverse_nonce'] ), 'eb-openverse-nonce' ) ) {
            die( esc_html__( 'Nonce did not match', 'essential-blocks' ) );
		}

        // Fetching the token and check the expire time
        $token = get_transient( 'eb_openverse_token' );

		if ( empty( $token ) ) {
			$token_info = self::eb_generate_openverse_token_callback();
			$token      = $token_info['access_token'];
		}

        $limit = 12;

        $url   = 'https://api.openverse.engineering/v1/images';
        $param = array();

        $values = array(
			'page_size'    => self::isset_check( $limit ),
            'q'            => sanitize_text_field( self::isset_check( 'openverseQ' ) ),
            'license'      => sanitize_text_field( self::isset_check( 'openverseFilterLicenses' ) ),
            'categories'   => sanitize_text_field( self::isset_check( 'openverseFilterImgtype' ) ),
            'size'         => sanitize_text_field( self::isset_check( 'openverseFilterSize' ) ),
            'extension'    => sanitize_text_field( self::isset_check( 'openverseFilterExtension' ) ),
            'license_type' => sanitize_text_field( self::isset_check( 'openverseFilterLicensesType' ) ),
            'page'         => sanitize_text_field( self::isset_check( 'openversePage', 1 ) ),
        );

        $param = array_merge( $param, $values );

        $response = Essential_Blocks_Api::get(
            $url,
            $param,
            EBHelpers::makeRequestHeader(
                array(
					'Content-Type' => 'application/json',
					'X-API-KEY'    => $token,
                )
            ),
            array(
                'timeout' => 240,
            )
        );
        return $response;
    }

    /**
     * Upload selected item to media
     */
    public static function eb_get_openverse_item() {
        if ( !isset( $_POST['openverse_item_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['openverse_item_nonce'] ), 'eb-openverse-item-nonce' ) ) {
            die( esc_html__( 'Nonce did not match', 'essential-blocks' ) );
        }

        if ( isset( $_POST['image_url'] ) ) {
            $file = esc_url_raw( $_POST['image_url'] );

            $filename = basename( $file );
            try {
                echo esc_url( wp_get_attachment_url( self::do_upload( $file, $filename ) ) );
            } catch ( \Exception $e ) {
                echo esc_html( 'Upload failed, details: ' . $e->getMessage() );
            }
        }
        else {
            echo esc_html( 'Invalid Image URL' );
        }

        wp_die();

    }

    /**
     * Upload to media
     */
    private static function do_upload( $url, $title = null ) {

		if(!function_exists('download_url') && !function_exists('media_handle_sideload')){
			return false;
		}
        // Download url to a temp file
        $tmp = download_url( $url );
        if ( is_wp_error( $tmp ) ) {
			return false;
        }

        $filename  = pathinfo( $url, PATHINFO_FILENAME );
        $extension = pathinfo( $url, PATHINFO_EXTENSION );

        $mime_extensions = array(
            // mime_type         => extension (no period)
            'image/jpg'  => 'jpg',
            'image/jpeg' => 'jpeg',
            'image/gif'  => 'gif',
            'image/png'  => 'png',
            'image/svg'  => 'svg',
        );

        if ( ! $extension ) {
            $mime = mime_content_type( $tmp );
            $mime = is_string( $mime ) ? sanitize_mime_type( $mime ) : false;

            if ( isset( $mime_extensions[ $mime ] ) ) {
                $extension = $mime_extensions[ $mime ];
            } else {
                @unlink( $tmp );
                return false;
            }
        }
        if (!in_array($extension, $mime_extensions)) {
            return false;
        }
        //
        $args = array(
            'name'     => "$filename.$extension",
            'tmp_name' => $tmp,
        );

        // Do the upload
        $attachment_id = media_handle_sideload( $args, 0, $title );

        @unlink( $tmp );

        // Error uploading
        if ( is_wp_error( $attachment_id ) ) {
			return false;
        }

        return (int) $attachment_id;
    }

    /**
     * Openverse Reg Data Save to Option Table
     */
    private static function openverse_reg_data_save( $reg_data ) {

        $settings = is_array( get_option( 'eb_settings' ) ) ? get_option( 'eb_settings' ) : array();
        if ( empty( $reg_data ) ) {
            unset( $settings['openverseApi'] );
        } else {
            $settings['openverseApi'] = $reg_data;
        }

        if ( is_array( $settings ) > 0 ) {
            $output = update_option( 'eb_settings', $settings );
            // wp_send_json_success($output);
        } else {
            wp_send_json_error( "Couldn't save data" );
        }
		// exit;
    }
}

EB_Openverse_Ajax::init();
