<?php
/**
 * Plugin Auto Update.
 *
 * @link       https://www.solwininfotech.com/
 * @since      1.0.0
 *
 * @package    Wp_Timeline_Designer_PRO
 * @subpackage Wp_Timeline_Designer_PRO/wp_timeline_templates
 * @author     Solwin Infotech <info@solwininfotech.com>
 */

/**
 * To update plugin  auto
 *
 * @class   Wp_Timeline_Auto_Update
 * @version 1.0.0
 */
class Wp_Timeline_Auto_Update {

	/**
	 * The plugin current version
	 *
	 * @var string
	 */
	public $current_version;

	/**
	 * The plugin remote update path
	 *
	 * @var string
	 */
	public $update_path;

	/**
	 * Plugin Slug (plugin_directory/plugin_file.php)
	 *
	 * @var string
	 */
	public $plugin_slug;

	/**
	 * Plugin name (plugin_file)
	 *
	 * @var string
	 */
	public $slug;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$plugin_data = get_plugin_data( WP_PLUGIN_DIR . '/wp-timeline-designer-pro/wp-timeline-designer-pro.php', $markup = true, $translate = true );
		// Set the class public variables.
		$this->current_version = $plugin_data['Version'];
		$this->update_path     = 'https://www.solwininfotech.com/sollicweb/timeline_check_purchase_code_tf.php';
		$this->plugin_slug     = 'wp-timeline-designer-pro/wp-timeline-designer-pro.php';
		list ($t1, $t2)        = explode( '/', $this->plugin_slug );
		$this->slug            = str_replace( '.php', '', $t2 );
		// define the alternative API for updating checking.
		add_filter( 'pre_set_site_transient_update_plugins', array( &$this, 'check_update' ) );
		// Define the alternative response for information checking.
		add_filter( 'plugins_api', array( &$this, 'check_info' ), 10, 3 );
	}
	/**
	 * Add our self-hosted autoupdate plugin to the filter transient
	 *
	 * @param string $username username.
	 * @param string $purchase_code purchase code.
	 * @return $return
	 */
	public function update_license( $username, $purchase_code ) {
		$return = $this->get_remote_license( $username, $purchase_code );
		if ( 'correct' === $return ) {
			update_option( 'wp_timeline_username', sanitize_text_field( $username ) );
			update_option( 'wp_timeline_purchase_code', sanitize_text_field( $purchase_code ) );
		}
		return $return;
	}

	/**
	 * Add our self-hosted autoupdate plugin to the filter transient
	 *
	 * @param string $transient transient.
	 * @return object $transient
	 */
	public function check_update( $transient ) {
		if ( empty( $transient->checked ) ) {
			return $transient;
		}
		if ( 'correct' === $this->get_remote_license() ) {
			// Get the remote version.
			$remote_version = $this->get_remote_version();
			// If a newer version is available, add the update.
			if ( version_compare( $this->current_version, $remote_version, '<' ) ) {
				$obj                                       = new stdClass();
				$obj->slug                                 = $this->slug;
				$obj->new_version                          = $remote_version;
				$obj->url                                  = $this->update_path;
				$obj->package                              = $this->update_path;
				$transient->response[ $this->plugin_slug ] = $obj;
			}
		}
		return $transient;
	}

	/**
	 * Add our self-hosted description to the filter
	 *
	 * @param boolean $false false.
	 * @param array   $action action.
	 * @param object  $arg arg.
	 * @return bool|object
	 */
	public function check_info( $false, $action, $arg ) {
		if ( 'correct' === $this->get_remote_license() ) {
			if ( isset( $arg->slug ) ) {
				if ( $arg->slug === $this->slug ) {
					$information = $this->get_remote_information();
					return $information;
				}
			}
		}
		return false;
	}

	/**
	 * Return the remote version
	 *
	 * @return string $remote_version
	 */
	public function get_remote_version() {
		$request = wp_remote_post(
			$this->update_path,
			array(
				'body' => array(
					'action'  => 'version',
					'product' => $this->slug,
				),
			)
		);
		if ( ! is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) === 200 ) {
			return $request['body'];
		}
		return false;
	}

	/**
	 * Return the changelog
	 *
	 * @return string $changelog
	 */
	public function get_remote_changelog() {
		$request = wp_remote_post(
			$this->update_path,
			array(
				'body' => array(
					'action'  => 'changelog',
					'product' => $this->slug,
				),
			)
		);
		if ( ! is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) === 200 ) {
			return $request['body'];
		}
		return false;
	}

	/**
	 * Get information about the remote version
	 *
	 * @return bool|object
	 */
	public function get_remote_information() {
		$request = wp_remote_post(
			$this->update_path,
			array(
				'body' => array(
					'action'  => 'info',
					'product' => $this->slug,
				),
			)
		);
		if ( ! is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) === 200 ) {
			return maybe_unserialize( $request['body'] );
		}
		return false;
	}

	/**
	 * Get remote notice
	 *
	 * @return bool|object
	 */
	public function get_remote_notice() {
		$request = wp_remote_post(
			$this->update_path,
			array(
				'body' => array(
					'action'  => 'message',
					'product' => $this->slug,
				),
			)
		);

		if ( ! is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) === 200 ) {
			if ( '' != $request['body'] ) {
				return $request['body'];
			} else {
				return '';
			}
		}
		return false;
	}

	/**
	 * Return the status of the plugin licensing
	 *
	 * @param string $username username.
	 * @param string $purchase_code purchase code.
	 * @return boolean $remote_license
	 */
	public function get_remote_license( $username = '', $purchase_code = '' ) {
		if ( '' == $username ) {
			$username = get_option( 'wp_timeline_username' );
		}
		if ( '' == $purchase_code ) {
			$purchase_code = get_option( 'wp_timeline_purchase_code' );
		}
		$site_url = get_site_url();
		$request  = wp_remote_post(
			$this->update_path,
			array(
				'body' => array(
					'action'        => 'license',
					'plugin_name'   => $this->slug,
					'site_url'      => $site_url,
					'username'      => $username,
					'purchase_code' => $purchase_code,
				),
			)
		);
		if ( ! is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) === 200 ) {
			return $request['body'];
		}
		return false;
	}


	/**
	 * Deregister Site
	 *
	 * @param string $username username.
	 * @param string $purchase_code purchase code.
	 * @return $return
	 */
	public function deregister_site( $username, $purchase_code ) {
		$site_url = get_site_url();
		$request  = wp_remote_post(
			$this->update_path,
			array(
				'body' => array(
					'action'        => 'unregister',
					'plugin_name'   => $this->slug,
					'site_url'      => $site_url,
					'username'      => $username,
					'purchase_code' => $purchase_code,
				),
			)
		);
		if ( ! is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) === 200 ) {
			$return = $request['body'];
			if ( 'success' === $return ) {
				delete_option( 'wp_timeline_username' );
				delete_option( 'wp_timeline_purchase_code' );
			}
		}
		return $return;
	}

}
