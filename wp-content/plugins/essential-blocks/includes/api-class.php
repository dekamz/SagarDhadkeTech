<?php

defined('ABSPATH') || exit;

class Essential_Blocks_Api {

	/**
	 * Get data for specific endpoints
	 *
	 * @param string $url
	 * @param array $params
	 * @param string $key
	 * @return false|object
     */
    public static function get( $url, $params = array(), $header=[], $options=[] ) {
        if ( empty( $url ) ) {
            return false;
        }
        if ( empty( $params ) ) {
            return self::remote_get( $url, $header );
        }

        $url = rtrim( $url, '/' ) . '?';

        foreach ( $params as $key => $param ) {
            $url .= $key . '=' . $param . '&';
        }
        $url = rtrim( $url, '&' );
        return self::remote_get( $url, $header, $options );
    }

    /**
     * @param string $url
     * @param array $data
     * @param string $key
     * @param array $headers
     * @return array|bool|mixed|object|string
     */
    public static function post( $url, $data = array(), $key = '', $headers = array() ) {
        if ( empty( $url ) ) {
            return false;
        }
        return self::remote_post( $url, $data, $key, $headers );
    }

    /**
     * Get data from api
     *
     * @param string $url
     * @param string $api_key
     * @param array $options
     * @return object
     */
    private static function remote_get( $url, $header = [], $options = [] ) {

        $options = array_merge(
            $header,
            $options
        );

        $response = wp_remote_get(
            $url, $options
        );
        
        if ( is_array( $response ) && isset($response['response']) ) {
            if ($response['response']['code'] === 200) {
                return wp_send_json_success( $response['body'] );
            }
            else {
                wp_send_json_error($response['body']);
            }
        }
        else {
            wp_send_json_error("Something went wrong!");
        }
    }

    /**
     * Post data to api
     *
     * @param string $url
     * @param array  $data
     * @param bool   $token
     * @param array  $headers
     * @return array|mixed|object
     */
    private static function remote_post( $url, $data, $apiKey = '', $headers = array()) {
        $request = array();

        if ( ! empty( $data ) ) {
            $request = array(
                'body' => $data,
            );
        }

        if ( $apiKey ) {
            $request['headers']['X-API-KEY'] = $apiKey;
        }
        if ( ! empty( $headers ) ) {
            $request['headers'] = array_merge( $request['headers'], $headers );
        }
        $response = wp_remote_post( $url, $request );
        if ( is_wp_error( $response ) ) {
            $error_message = $response->get_error_message();
            return array(
                'status'  => 'error',
                'message' => 'Something went wrong: ' . $error_message,
            );
        }
        return json_decode( $response['body'] );
    }
}