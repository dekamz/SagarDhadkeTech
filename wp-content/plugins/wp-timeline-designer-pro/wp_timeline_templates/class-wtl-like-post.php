<?php
/**
 * Template Day Layout Config File
 *
 * @link       https://www.solwininfotech.com/
 * @since      1.0.0
 *
 * @package    Wp_Timeline_Designer_PRO
 * @subpackage Wp_Timeline_Designer_PRO/wp_timeline_templates
 */

/**
 * This class contain template configuration of template.
 *
 * @package    Wp_Timeline_Designer_PRO
 * @subpackage Wp_Timeline_Designer_PRO/wp_timeline_templates
 * @author     Solwin Infotech <info@solwininfotech.com>
 */
class Wtl_Like_Post {
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'wp_ajax_nopriv_get_wtl_process_posts_like', array( &$this, 'wtl_process_posts_like' ), 15 );
		add_action( 'wp_ajax_get_wtl_process_posts_like', array( &$this, 'wtl_process_posts_like' ), 15 );
		add_shortcode( 'likebtn_shortcode', array( $this, 'likebtn_shortcode' ) );
	}

	/**
	 * Processes like/unlike
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public static function wtl_process_posts_like() {
		// Security.
		$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : 0;
		if ( ! wp_verify_nonce( $nonce, 'bdp-simple-likes-nonce' ) ) {
			exit( esc_html__( 'Not permitted', 'wp-timeline-designer-pro' ) );
		}
		// Base variables.
		$post_id    = ( isset( $_POST['post_id'] ) && is_numeric( $_POST['post_id'] ) ) ? sanitize_text_field( wp_unslash( $_POST['post_id'] ) ) : '';
		$response   = array();
		$post_users = null;
		$like_count = 0;
		// Get plugin options.
		if ( '' != $post_id ) {
			$count = get_post_meta( $post_id, '_post_like_count', true ); // like count.
			$count = ( isset( $count ) && is_numeric( $count ) ) ? $count : 0;
			if ( ! self::already_liked( $post_id ) ) { // Like the post.
				if ( is_user_logged_in() ) { // user is logged in.
					$user_id    = get_current_user_id();
					$post_users = self::post_user_likes( $user_id, $post_id );

					// Update User & Post.
					$user_like_count = get_user_option( '_user_like_count', $user_id );
					$user_like_count = ( isset( $user_like_count ) && is_numeric( $user_like_count ) ) ? $user_like_count : 0;
					update_user_option( $user_id, '_user_like_count', ++$user_like_count );
					if ( ! empty( $post_users ) ) {
						update_post_meta( $post_id, 'like_users', $post_users );
					} else {
						update_post_meta( $post_id, 'like_users', $user_id );
					}
				} else { // user is anonymous.
					$user_ip    = self::get_ip();
					$post_users = self::post_ip_likes( $user_ip, $post_id );
					// Update Post.
					if ( $post_users ) {
						update_post_meta( $post_id, 'like_ipaddresses', $post_users );
					}
				}
				$like_count         = ++$count;
				$response['status'] = 'liked';
				$response['icon']   = self::get_liked_icon();
			} else { // Unlike the post.
				if ( is_user_logged_in() ) { // user is logged in.
					$user_id    = get_current_user_id();
					$post_users = self::post_user_likes( $user_id, $post_id );
					// Update User.
					$user_like_count = get_user_option( '_user_like_count', $user_id );
					$user_like_count = ( isset( $user_like_count ) && is_numeric( $user_like_count ) ) ? $user_like_count : 0;
					if ( $user_like_count > 0 ) {
						update_user_option( $user_id, '_user_like_count', --$user_like_count );
					}
					// Update Post.
					if ( ! empty( $post_users ) ) {
						$uid_key = array_search( $user_id, $post_users, true );
						unset( $post_users[ $uid_key ] );
						update_post_meta( $post_id, 'like_users', $post_users );
					} else {
						update_post_meta( $post_id, 'like_users', $user_id );
					}
				} else { // user is anonymous.
					$user_ip    = self::get_ip();
					$post_users = self::post_ip_likes( $user_ip, $post_id );
					// Update Post.
					if ( $post_users ) {
						$uip_key = array_search( $user_ip, $post_users, true );
						unset( $post_users[ $uip_key ] );
						update_post_meta( $post_id, 'like_ipaddresses', $post_users );
					}
				}
				$like_count         = ( $count > 0 ) ? --$count : 0; // Prevent negative number.
				$response['status'] = 'unliked';
				$response['icon']   = self::get_unliked_icon();
			}
			update_post_meta( $post_id, '_post_like_count', $like_count );
			update_post_meta( $post_id, '_post_like_modified', gmdate( 'Y-m-d H:i:s' ) );
			$response['count'] = self::get_like_count( $like_count );
			wp_send_json( $response );
		}
		exit();
	}

	/**
	 * Utility to test if the post is already liked
	 *
	 * @since 1.0.0
	 * @param int $post_id post id.
	 * @return array
	 */
	public static function already_liked( $post_id ) {
		$post_users = null;
		$user_id    = null;
		if ( is_user_logged_in() ) { // user is logged in.
			$user_id         = get_current_user_id();
			$post_meta_users = get_post_meta( $post_id, 'like_users' );
			if ( count( $post_meta_users ) != 0 ) {
				$post_users = $post_meta_users[0];
			}
		} else { // user is anonymous.
			$user_id         = self::get_ip();
			$post_meta_users = get_post_meta( $post_id, 'like_ipaddresses' );
			// meta exists, set up values.
			if ( count( $post_meta_users ) != 0 ) {
				$post_users = $post_meta_users[0];
			}
		}
		if ( is_array( $post_users ) && in_array( $user_id, $post_users, true ) ) {
			return true;
		} else {
			return false;
		}
	}
	/**
	 * Output the like button
	 *
	 * @since 1.0.0
	 * @param int $post_id post id.
	 * @return array
	 */
	public static function get_simple_likes_button( $post_id ) {
		$output        = '';
		$nonce         = wp_create_nonce( 'bdp-simple-likes-nonce' ); // Security.
		$post_id_class = esc_attr( ' bdp-button-' . $post_id );
		$comment_class = esc_attr( '' );
		$like_count    = get_post_meta( $post_id, '_post_like_count', true );
		$like_count    = ( isset( $like_count ) && is_numeric( $like_count ) ) ? $like_count : 0;
		$count         = self::get_like_count( $like_count );
		$icon_empty    = self::get_unliked_icon();
		$icon_full     = self::get_liked_icon();
		// Loader.
		$loader = '<span id="bdp-loader"></span>';
		// Liked/Unliked Variables.
		if ( self::already_liked( $post_id ) ) {
			$class = esc_attr( ' liked' );
			$title = esc_html__( 'Unlike', 'wp-timeline-designer-pro' );
			$icon  = $icon_full;
		} else {
			$class = '';
			$title = esc_html__( 'Like', 'wp-timeline-designer-pro' );
			$icon  = $icon_empty;
		}
		$output = '<span class="wtl-wrapper-like"><a href="javascript:void(0)" class="wtl-like-button' . $post_id_class . $class . '" data-nonce="' . $nonce . '" data-post-id="' . $post_id . '" title="' . $title . '"> ' . $icon . $count . '</a>' . $loader . '</span>';
		return $output;
	}

	/**
	 * Utility retrieves count plus count options,
	 * returns appropriate format based on options
	 *
	 * @since 1.0.0
	 * @param int $like_count like count.
	 * @return array
	 */
	public static function get_like_count( $like_count ) {
		$like_text = esc_html__( 'Like', 'wp-timeline-designer-pro' );
		if ( is_numeric( $like_count ) && $like_count > 0 ) {
			$number = self::format_count( $like_count );
		} else {
			$number = $like_text;
		}
		$count = '<span class="bdp-count">' . $number . '</span>';
		return $count;
	}

	/**
	 * Utility function to format the button count,
	 * appending "K" if one thousand or greater,
	 * "M" if one million or greater,
	 * and "B" if one billion or greater (unlikely).
	 * $precision = how many decimal points to display (1.25K)
	 *
	 * @since 1.0.0
	 * @param int $number number.
	 * @return array
	 */
	public static function format_count( $number ) {
		$precision = 2;
		if ( $number >= 1000 && $number < 1000000 ) {
			$formatted = number_format( $number / 1000, $precision ) . 'K';
		} elseif ( $number >= 1000000 && $number < 1000000000 ) {
			$formatted = number_format( $number / 1000000, $precision ) . 'M';
		} elseif ( $number >= 1000000000 ) {
			$formatted = number_format( $number / 1000000000, $precision ) . 'B';
		} else {
			$formatted = $number; // Number is less than 1000.
		}
		$formatted = str_replace( '.00', '', $formatted );
		return $formatted;
	}

	/**
	 * Utility returns the button icon for "like" action
	 */
	public static function get_liked_icon() {
		$icon = ' <i class="fas fa-heart"></i> ';
		return $icon;
	}

	/**
	 * Utility returns the button icon for "unlike" action
	 */
	public static function get_unliked_icon() {
		$icon = ' <i class="far fa-heart"></i> ';
		return $icon;
	}

	/**
	 * Utility to retrieve IP address
	 */
	public static function get_ip() {
		if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) && ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
			$ip = sanitize_text_field( wp_unslash( $_SERVER['HTTP_CLIENT_IP'] ) );
		} elseif ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) && ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			$ip = sanitize_text_field( wp_unslash( $_SERVER['HTTP_X_FORWARDED_FOR'] ) );
		} else {
			$ip = ( isset( $_SERVER['REMOTE_ADDR'] ) ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '0.0.0.0';
		}
		$ip = filter_var( $ip, FILTER_VALIDATE_IP );
		$ip = ( false === $ip ) ? '0.0.0.0' : $ip;
		return $ip;
	}

	/**
	 * Processes shortcode to manually add the button to posts
	 */
	public static function likebtn_shortcode() {
		return self::get_simple_likes_button( get_the_ID(), 0 );
	}

	/**
	 * Utility retrieves post meta user likes (user id array),
	 * then adds new user id to retrieved array
	 *
	 * @since 1.0.0
	 * @param int $user_id user id.
	 * @param int $post_id post id.
	 * @return array
	 */
	public static function post_user_likes( $user_id, $post_id ) {
		$post_users      = '';
		$post_meta_users = get_post_meta( $post_id, 'like_users' );
		if ( 0 != count( $post_meta_users ) ) {
			$post_users = $post_meta_users[0];
		}
		if ( ! is_array( $post_users ) ) {
			$post_users = array();
		}
		if ( ! in_array( $user_id, $post_users, true ) ) {
			$post_users[ 'user-' . $user_id ] = $user_id;
		}
		return $post_users;
	}

	/**
	 * Utility retrieves post meta ip likes (ip array),
	 * then adds new ip to retrieved array
	 *
	 * @since 1.0.0
	 * @param int $user_ip user ip.
	 * @param int $post_id post id.
	 * @return array
	 */
	public static function post_ip_likes( $user_ip, $post_id ) {
		$post_users      = '';
		$post_meta_users = get_post_meta( $post_id, 'like_ipaddresses' );
		// Retrieve post information.
		if ( 0 != count( $post_meta_users ) ) {
			$post_users = $post_meta_users[0];
		}
		if ( ! is_array( $post_users ) ) {
			$post_users = array();
		}
		if ( ! in_array( $user_ip, $post_users, true ) ) {
			$post_users[ 'ip-' . $user_ip ] = $user_ip;
		}
		return $post_users;
	}

}
$wtl_like_post = new Wtl_Like_Post();
