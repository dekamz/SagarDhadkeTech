<?php
/**
 * The template-config functionality of the plugin.
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
 * @subpackage Wp_Timeline_Designer_PRO/admin
 * @author     Solwin Infotech <info@solwininfotech.com>
 */
class Wtl_Custom_Post_Type {
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'admin_init', array( $this, 'save_cpts' ), 11 );
		add_action( 'init', array( $this, 'create_custom_post_type' ), 12 ); /* Create Costom Post Type */
		add_action( 'admin_init', array( $this, 'delete' ), 19 );
		add_action( 'admin_init', array( &$this, 'wtl_multiple_delete_cpt' ), 5 );
		add_action( 'admin_init', array( &$this, 'wtl_multiple_export_cpt' ), 7 );
	}
	/**
	 * Save Custom Post Type.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function save_cpts() {
		if ( isset( $_GET['page'] ) && 'add_wtl_cpt' === $_GET['page'] ) {
			if ( ! isset( $_GET['action'] ) || ( isset( $_GET['action'] ) && 'add' === $_GET['action'] ) ) {
				$user = wp_get_current_user();
				update_user_option( $user->ID, 'wtlselectedtab_add_custom_post_types', 'portdesignposttype', true );
			}
			if ( isset( $_REQUEST['savedata'] ) ) {
				global $wpdb;
				if ( ! isset( $_POST['wtl-cpt-form-submit-nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wtl-cpt-form-submit-nonce'] ) ), 'wtl-cpt-form-submit' ) ) {
					esc_html_e( 'Sorry, your nonce did not verify.', 'wp-timeline-designer-pro' );
					exit;
				} else {
					if ( isset( $_REQUEST['cpt_icon_type'] ) && 1 == $_REQUEST['cpt_icon_type'] ) {
						$cpts_icon = ( isset( $_REQUEST['cpt_icon_wordpress'] ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['cpt_icon_wordpress'] ) ) : 'dashicons-portfolio';
					} else {
						$cpts_icon = ( isset( $_REQUEST['cpt_icon_custom_img_src'] ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['cpt_icon_custom_img_src'] ) ) : 'dashicons-portfolio';
					}
					$cpt_icon_type              = ( isset( $_REQUEST['cpt_icon_type'] ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['cpt_icon_type'] ) ) : 1;
					$cpts_plural                = ( isset( $_REQUEST['cpts_plural'] ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['cpts_plural'] ) ) : '';
					$cpts_singular              = ( isset( $_REQUEST['cpts_singular'] ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['cpts_singular'] ) ) : '';
					$cpts_slug                  = ( isset( $_REQUEST['cpts_slug'] ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['cpts_slug'] ) ) : '';
					$cpts_category              = ( isset( $_REQUEST['cpt_category'] ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['cpt_category'] ) ) : 0;
					$cpts_category_name         = ( isset( $_REQUEST['cpt_category_name'] ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['cpt_category_name'] ) ) : 0;
					$cpts_category_slug         = ( isset( $_REQUEST['cpt_category_slug'] ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['cpt_category_slug'] ) ) : 0;
					$cpts_tag                   = ( isset( $_REQUEST['cpt_taxonomy_tag'] ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['cpt_taxonomy_tag'] ) ) : 0;
					$cpts_tag_name              = ( isset( $_REQUEST['cpt_tag_name'] ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['cpt_tag_name'] ) ) : '';
					$cpts_tag_slug              = ( isset( $_REQUEST['cpt_tag_slug'] ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['cpt_tag_slug'] ) ) : '';
					$cpt_icon_wordpress         = ( isset( $_REQUEST['cpt_icon_wordpress'] ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['cpt_icon_wordpress'] ) ) : '';
					$cpt_icon_custom_img_id     = ( isset( $_REQUEST['cpt_icon_custom_img_id'] ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['cpt_icon_custom_img_id'] ) ) : '';
					$cpt_icon_custom_img_src    = ( isset( $_REQUEST['cpt_icon_custom_img_src'] ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['cpt_icon_custom_img_src'] ) ) : '';
					$wtl_create_custom_category = ( isset( $_REQUEST['wtl_create_custom_category'] ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['wtl_create_custom_category'] ) ) : '';
					$wtl_create_custom_tag      = ( isset( $_REQUEST['wtl_create_custom_tag'] ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['wtl_create_custom_tag'] ) ) : '';
					$cpts_additional_tax        = ( isset( $_REQUEST['template_category'] ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['template_category'] ) ) : '';

					$setting = array(
						'cpt_icon_type'       => $cpt_icon_type,
						'cpts_icon'           => $cpts_icon,
						'cpts_singular'       => $cpts_singular,
						'cpts_category'       => $cpts_category,
						'cpts_category_name'  => $cpts_category_name,
						'cpts_category_slug'  => trim( $cpts_category_slug ),
						'cpts_tag'            => $cpts_tag,
						'cpts_tag_name'       => $cpts_tag_name,
						'cpts_tag_slug'       => trim( $cpts_tag_slug ),
						'cpts_additional_tax' => $cpts_additional_tax,
						'cpt_icon_wp'         => $cpt_icon_wordpress,
						'cpt_img_id'          => $cpt_icon_custom_img_id,
						'cpt_img_src'         => $cpt_icon_custom_img_src,
						'cpt_ccc'             => $wtl_create_custom_category,
						'cpt_cct'             => $wtl_create_custom_tag,
					);
					$data    = array(
						'name'    => $cpts_plural,
						'slug'    => $cpts_slug,
						'setting' => maybe_serialize( $setting ),
					);
					if ( '' == $cpts_plural ) {
						wp_die( esc_html_e( 'Custom Post Type Plural Name is required.', 'wp-timeline-designer-pro' ), '', array( 'back_link' => true ) );
					}
					if ( '' == $cpts_singular ) {
						wp_die( esc_html_e( 'Custom Post Type Singular Name is required.', 'wp-timeline-designer-pro' ), '', array( 'back_link' => true ) );
					}
					if ( '' == $cpts_slug ) {
						wp_die( esc_html_e( 'Custom Post Type Slug is required.', 'wp-timeline-designer-pro' ), '', array( 'back_link' => true ) );
					}
					if ( 1 == $cpts_category && '' == $cpts_category_slug ) {
						wp_die( esc_html_e( 'Custom Category Slug is required.', 'wp-timeline-designer-pro' ), '', array( 'back_link' => true ) );
					}
					if ( 1 == $cpts_tag && '' == $cpts_tag_slug ) {
						wp_die( esc_html_e( 'Custom Tag Slug is required.', 'wp-timeline-designer-pro' ), '', array( 'back_link' => true ) );
					}
					if ( isset( $_GET['action'] ) && 'edit' === $_GET['action'] && isset( $_GET['id'] ) && '' !== $_GET['id'] ) {
						$id                   = intval( $_GET['id'] );
						$table_name           = $wpdb->prefix . 'wtl_cpts';
						$get_current_data     = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}wtl_cpts WHERE id=%d", $id ) );
						$get_current_settings = maybe_unserialize( $get_current_data[0]->setting );
						$get_current_posttype = $get_current_data[0]->slug;
						$get_all_post_type    = get_post_types();
						$get_all_post_type    = array_keys( $get_all_post_type );
						if ( $get_current_posttype != $cpts_slug && in_array( $cpts_slug, $get_all_post_type, true ) ) {
							wp_safe_redirect( '?page=add_wtl_cpt&action=edit&id=' . $id . '&notice=exists' );
							return;
						}
						$get_current_category = $get_current_settings['cpts_category_slug'];
						$get_current_tag      = $get_current_settings['cpts_tag_slug'];
						$get_all_taxonomies   = get_taxonomies();
						$get_all_taxonomies   = array_keys( $get_all_taxonomies );
						if ( $get_current_category != $cpts_category_slug && in_array( $cpts_category_slug, $get_all_taxonomies, true ) ) {
							wp_safe_redirect( '?page=add_wtl_cpt&action=edit&id=' . $id . '&notice=taxonomy_exists' );
							return;
						}
						if ( $get_current_tag != $cpts_tag_slug && in_array( $cpts_tag_slug, $get_all_taxonomies, true ) ) {
							wp_safe_redirect( '?page=add_wtl_cpt&action=edit&id=' . $id . '&notice=taxonomy_exists' );
							return;
						}
						if ( 1 == $cpts_tag && 1 == $cpts_category ) {
							if ( $cpts_category_slug == $cpts_tag_slug ) {
								wp_safe_redirect( '?page=add_wtl_cpt&action=edit&id=' . $id . '&notice=taxonomy_exists' );
								return;
							}
						}
						$where = array( 'id' => $id );
						self::update_cpts( $data, $where );
						wp_safe_redirect( '?page=add_wtl_cpt&action=edit&id=' . $id . '&notice=update' );
					} elseif ( ! empty( $cpts_category_slug ) && ( $cpts_category_slug == $cpts_tag_slug ) ) {
						wp_safe_redirect( '?page=add_wtl_cpt&action=edit&id=0&notice=taxonomy_exists' );
					} elseif ( post_type_exists( $cpts_slug ) ) {
						wp_safe_redirect( '?page=add_wtl_cpt&notice=exists' );
					} else {
						self::insert_cpts( $data );
						wp_safe_redirect( '?page=add_wtl_cpt&id=' . $wpdb->insert_id . '&notice=create&name=' . $cpts_plural );
					}
				}
			}
		}
	}
	/**
	 * Custom Pust Type Delete
	 *
	 * @return void
	 */
	public function delete() {
		if ( isset( $_GET['page'] ) && 'wtl_cpts' === $_GET['page'] && isset( $_GET['action'] ) && 'delete' === $_GET['action'] && isset( $_GET['id'] ) && '' !== $_GET['id'] ) {
			if ( isset( $_GET['_wpnonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ) ) ) {
				global $wpdb;
				$id         = intval( $_GET['id'] );
				$table_name = $wpdb->prefix . 'wtl_cpts';
				$data       = $wpdb->get_row( "SELECT * FROM $table_name WHERE id = $id" );
				if ( ! empty( $data ) ) {
					$qry_args  = array(
						'post_type'      => $data->slug,
						'posts_per_page' => -1,
					);
					$all_posts = new WP_Query( $qry_args );
					while ( $all_posts->have_posts() ) {
						$all_posts->the_post();
						$media = get_children(
							array(
								'post_parent' => get_the_ID(),
								'post_type'   => 'attachment',
							)
						);
						if ( ! empty( $media ) ) {
							foreach ( $media as $file ) {
								wp_delete_attachment( intval( $file->ID ) );
							}
						}
						wp_delete_post( get_the_ID(), true );
					}
					$where = array( 'id' => $id );
					self::delete_cpts( $where );
					unregister_post_type( $data->name );
					$_SESSION['cpts_name'] = $data->name;
					header( 'Location: ?page=wtl_cpts' );
					die();
				}
			}
		}
	}
	/**
	 * Insert data into portfolio_designer_cpts
	 *
	 * @global Object $wpdb
	 * @param Array $data data.
	 */
	public function insert_cpts( $data = '' ) {
		if ( '' !== $data ) {
			global $wpdb;
			$table_name = $wpdb->prefix . 'wtl_cpts';
			$wpdb->insert( $table_name, $data );
		}
	}
	/**
	 * Update data in portfolio_designer_cpts table
	 *
	 * @global Object $wpdb
	 * @param Array  $data data.
	 * @param String $where where.
	 */
	public function update_cpts( $data = '', $where = '' ) {
		if ( '' !== $data && '' !== $where ) {
			global $wpdb;
			$table_name = $wpdb->prefix . 'wtl_cpts';
			$wpdb->update( $table_name, $data, $where );
		}
	}

	/**
	 * Delete data from portfolio_designer_cpts table
	 *
	 * @param string $where where.
	 * @return void
	 */
	public function delete_cpts( $where = '' ) {
		if ( '' != $where ) {
			global $wpdb;
			$table_name = $wpdb->prefix . 'wtl_cpts';
			$wpdb->delete( $table_name, $where );
		}
	}
	/**
	 * Create Custom Posttype
	 *
	 * @return void
	 */
	public function create_custom_post_type() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'wtl_cpts';
		if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) ) {
			$datas = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wtl_cpts", ARRAY_A );

			if ( ! empty( $datas ) ) {
				foreach ( $datas as $data ) {
					$data_setting = maybe_unserialize( $data['setting'] );
					$cpts_labels  = array(
						'name'               => ucfirst( $data['name'] ),
						'singular_name'      => ucfirst( $data_setting['cpts_singular'] ),
						'menu_name'          => ucfirst( $data['name'] ),
						'name_admin_bar'     => ucfirst( $data['name'] ),
						'add_new'            => esc_html__( 'Add New', 'wp-timeline-designer-pro' ),
						'add_new_item'       => esc_html__( 'Add New', 'wp-timeline-designer-pro' ) . sprintf( ' %s', $data_setting['cpts_singular'] ),
						'new_item'           => esc_html__( 'New', 'wp-timeline-designer-pro' ) . sprintf( ' %s', $data_setting['cpts_singular'] ),
						'edit_item'          => esc_html__( 'Edit', 'wp-timeline-designer-pro' ) . sprintf( ' %s', $data_setting['cpts_singular'] ),
						'view_item'          => esc_html__( 'View', 'wp-timeline-designer-pro' ) . sprintf( ' %s', $data_setting['cpts_singular'] ),
						'all_items'          => esc_html__( 'All', 'wp-timeline-designer-pro' ) . sprintf( ' %s', $data['name'] ),
						'search_items'       => esc_html__( 'Search', 'wp-timeline-designer-pro' ) . sprintf( ' %s', $data['name'] ),
						'parent_item_colon'  => esc_html__( 'Parent', 'wp-timeline-designer-pro' ) . sprintf( ' %s', $data['name'] ),
						'not_found'          => esc_html__( 'No', 'wp-timeline-designer-pro' ) . sprintf( ' %s ', $data['name'] ) . esc_html__( 'found', 'wp-timeline-designer-pro' ),
						'not_found_in_trash' => esc_html__( 'No', 'wp-timeline-designer-pro' ) . sprintf( ' %s ', $data['name'] ) . esc_html__( 'found in Trash', 'wp-timeline-designer-pro' ),
					);
					if ( isset( $data_setting['cpts_icon'] ) && '' !== $data_setting['cpts_icon'] ) {
						$cpt_ico = $data_setting['cpts_icon'];
					} else {
						$cpt_ico = 'dashicons-portfolio';
					}
					$cpt_support = array( 'title', 'editor', 'thumbnail', 'custom-fields', 'comments', 'page-attributes', 'excerpt', 'revisions', 'post-formats' );
					$cpts_args   = array(
						'labels'             => $cpts_labels,
						'public'             => true,
						'publicly_queryable' => true,
						'show_ui'            => true,
						'show_in_menu'       => true,
						'menu_icon'          => $cpt_ico,
						'query_var'          => true,
						'rewrite'            => array( 'slug' => $data['slug'] ),
						'capability_type'    => 'post',
						'has_archive'        => true,
						'hierarchical'       => false,
						'supports'           => $cpt_support,
					);

					if ( ! empty( $data_setting['cpts_additional_tax'] ) ) {
						$cpts_args['taxonomies'] = $data_setting['cpts_additional_tax'];
					}
					register_post_type( $data['slug'], $cpts_args );
					if ( 1 == $data_setting['cpts_category'] ) {
						$category_name = ( '' !== $data_setting['cpts_category_name'] ) ? $data_setting['cpts_category_name'] : sprintf( '%s ', $data_setting['cpts_singular'] ) . esc_html__( 'Categories', 'wp-timeline-designer-pro' );
						$category_slug = ( '' !== $data_setting['cpts_category_slug'] ) ? $data_setting['cpts_category_slug'] : $data['slug'] . '_category';
						$args          = array(
							'label'        => ucfirst( $category_name ),
							'hierarchical' => true,
							'query_var'    => true,
							'rewrite'      => array(
								'slug'       => apply_filters( 'change_taxonomy_rewrite_slug', $args = $category_slug ),
								'with_front' => false,
							),
						);
						register_taxonomy( $category_slug, array( $data['slug'] ), $args );
					}
					if ( 1 == $data_setting['cpts_tag'] ) {
						$tag_name = ( '' !== $data_setting['cpts_tag_name'] ) ? $data_setting['cpts_tag_name'] : sprintf( '%s ', $data_setting['cpts_singular'] ) . esc_html__( 'Tags', 'wp-timeline-designer-pro' );
						$tag_slug = ( '' !== $data_setting['cpts_tag_slug'] ) ? $data_setting['cpts_tag_slug'] : $data['slug'] . '_tag';
						$args     = array(
							'label'        => ucfirst( $tag_name ),
							'hierarchical' => false,
							'query_var'    => true,
							'rewrite'      => array(
								'slug'       => apply_filters( 'change_taxonomy_rewrite_slug', $args = $tag_slug ),
								'with_front' => false,
							),
						);
						register_taxonomy( $tag_slug, array( $data['slug'] ), $args );
					}
				}
			}
		}

	}

	/**
	 * Multiple Deletion of shortcode
	 *
	 * @global object $wpdb
	 */
	public function wtl_multiple_delete_cpt() {
		global $wpdb;
		$wtl_table_name = $wpdb->prefix . 'wtl_cpts';
		if ( isset( $_POST['wtl-cpt-form-list-nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wtl-cpt-form-list-nonce'] ) ), 'wtl-cpt-form-list' ) ) {
			if ( isset( $_POST['take_action'] ) && isset( $_GET['page'] ) && 'wtl_cpts' === $_GET['page'] ) {
				if ( ( isset( $_POST['wtl-action-top'] ) && 'delete_pr' === esc_html( sanitize_text_field( wp_unslash( $_POST['wtl-action-top'] ) ) ) ) || ( isset( $_POST['wtl-action-top2'] ) && 'delete_pr' === esc_html( sanitize_text_field( wp_unslash( $_POST['wtl-action-top2'] ) ) ) ) ) {
					if ( isset( $_POST['chk_remove_all'] ) && ! empty( $_POST['chk_remove_all'] ) ) {
						$shortcodes = array_map( 'sanitize_text_field', wp_unslash( $_POST['chk_remove_all'] ) );
						if ( isset( $_GET['page'] ) ) {
							$result = wp_cache_get( 'add_wtl_cpt' );
							if ( false == $result ) {
								wp_cache_set( 'add_wtl_cpt', $result );
							}
							foreach ( $shortcodes as $shortcode ) {
								$shortcode = intval( $shortcode );
								$wpdb->delete( $wtl_table_name, array( 'id' => $shortcode ) );
							}
						}
					}
				}
			}
		}
	}


	/**
	 * Export Layout
	 *
	 * @since 1.0
	 */
	public function wtl_multiple_export_cpt() {
		global $wpdb;
		if ( isset( $_POST['wtl-cpt-form-list-nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wtl-cpt-form-list-nonce'] ) ), 'wtl-cpt-form-list' ) ) {
			if ( isset( $_POST['take_action'] ) && isset( $_GET['page'] ) && 'wtl_cpts' === $_GET['page'] ) {
				if ( ( isset( $_POST['wtl-action-top'] ) && 'wtl_export' === esc_html( sanitize_text_field( wp_unslash( $_POST['wtl-action-top'] ) ) ) ) || ( isset( $_POST['wtl-action-top2'] ) && 'wtl_export' === esc_html( sanitize_text_field( wp_unslash( $_POST['wtl-action-top2'] ) ) ) ) ) {
					if ( isset( $_POST['chk_remove_all'] ) && ! empty( $_POST['chk_remove_all'] ) && isset( $_GET['page'] ) && 'wtl_cpts' === $_GET['page'] ) {
						$wp_timeline_table = $wpdb->prefix . 'wtl_cpts';
						$export_layout     = array();
						$shortcodes        = array_map( 'sanitize_text_field', wp_unslash( $_POST['chk_remove_all'] ) );
						foreach ( $shortcodes as $shortcode ) {
							$get_data  = '';
							$shortcode = intval( $shortcode );
							if ( is_numeric( $shortcode ) ) {
								$get_data = $wpdb->get_row( "SELECT * FROM $wp_timeline_table WHERE id = $shortcode", ARRAY_A );
							}
							if ( ! empty( $get_data ) ) {
								$wptsettings                     = maybe_unserialize( $get_data['setting'] );
								$wptsettings['wtl_page_display'] = '0';
								$get_data['setting']             = maybe_serialize( $wptsettings );
								$export_layout[]                 = $get_data;
							}
						}
						if ( count( $export_layout ) > 0 ) {
							$output = base64_encode( maybe_serialize( $export_layout ) );
							$this->save_as_txt_file( 'wp_timeline_custom_post_type.txt', $output );
						}
					}
				}
			}
		}
	}

	/**
	 * Save Text file.
	 *
	 * @param string $file_name file name.
	 * @param string $output output.
	 * @return void
	 */
	public function save_as_txt_file( $file_name, $output ) {
		header( 'Content-type: application/text', true, 200 );
		header( "Content-Disposition: attachment; filename=$file_name" );
		header( 'Pragma: no-cache' );
		header( 'Expires: 0' );
		echo esc_html( $output );
		exit;
	}

}
$wtl_custom_post_type = new Wtl_Custom_Post_Type();
