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
class Wtl_Template_Reset {
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'wp_ajax_wtl_do_rest_layout_ajax', array( $this, 'wtl_do_rest_layout_ajax' ) );
		add_action( 'wp_ajax_nopriv_wtl_do_rest_layout_ajax', array( $this, 'wtl_do_rest_layout_ajax' ) );
	}

	/**
	 * Layout Reset Ajax.
	 *
	 * @since    1.0.0
	 * @return void
	 */
	public function wtl_do_rest_layout_ajax() {
		header( 'Access-Cotrol-Allow-Origin: *' );
		if ( isset( $_POST['nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'ajax-nonce' ) ) {
			if ( isset( $_POST ) ) {
				if ( isset( $_POST['layout'] ) ) {
					$layout       = sanitize_text_field( wp_unslash( $_POST['layout'] ) );
					$lid          = isset( $_POST['lid'] ) ? sanitize_text_field( wp_unslash( $_POST['lid'] ) ) : '';
					$page_display = isset( $_POST['page_display'] ) ? sanitize_text_field( wp_unslash( $_POST['page_display'] ) ) : '';
					$json         = self::get_default_layout_settings( $layout );
					$arr          = json_decode( $json );
					if ( $arr ) {
						echo wp_json_encode( $arr );
					}
				}
			}
		}
		die();
	}
	/**
	 * Layout Reset Ajax 2.
	 *
	 * @since    1.0.0
	 * @return void
	 */
	public static function wtl_load_default_layout_ajax() {
		header( 'Access-Cotrol-Allow-Origin: *' );
		if ( isset( $_POST['nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'ajax-nonce' ) ) {
			if ( isset( $_POST ) ) {
				if ( isset( $_POST['layout'] ) ) {
					$layout = sanitize_text_field( wp_unslash( $_POST['layout'] ) );
					$json   = self::get_default_layout_settings( $layout );
					$arr    = json_decode( $json );
					if ( $arr ) {
						echo wp_json_encode( $arr );
					}
				}
			}
		}
		die();
	}
	/**
	 * Do reset layout out
	 *
	 * @since    1.0.0
	 * @return html
	 */
	public static function do_reset_layout() {

		if ( isset( $_POST ) ) {
			$layout       = isset( $_POST['layout'] ) ? sanitize_text_field( wp_unslash( $_POST['layout'] ) ) : '';
			$lid          = isset( $_POST['lid'] ) ? sanitize_text_field( wp_unslash( $_POST['lid'] ) ) : '';
			$page_display = isset( $_POST['page_display'] ) ? sanitize_text_field( wp_unslash( $_POST['page_display'] ) ) : '';
			$reset_json   = '';
			if ( 'advanced_layout' === $layout ) {
				include 'json/json-advanced-layout.php';
			} elseif ( 'verticalblur_layout' === $layout ) {
				include 'json/json-verticalblur-layout.php';
			} elseif ( 'fullvertical_layout' === $layout ) {
				include 'json/json-fullvertical-layout.php';
			} elseif ( 'cool_horizontal' === $layout ) {
				include 'json/json-cool-horizontal.php';
			} elseif ( 'curve_layout' === $layout ) {
				include 'json/json-curve-layout.php';
			} elseif ( 'easy_layout' === $layout ) {
				include 'json/json-easy-layout.php';
			} elseif ( 'attract_layout' === $layout ) {
				include 'json/json-attract-layout.php';
			} elseif ( 'processinfo_layout' === $layout ) {
				include 'json/json-processinfo-layout.php';
			} elseif ( 'fullwidth_layout' === $layout ) {
				include 'json/json-fullwidth-layout.php';
			} elseif ( 'hire_layout' === $layout ) {
				include 'json/json-hire-layout.php';
			} elseif ( 'milestone_layout' === $layout ) {
				include 'json/json-milestone-layout.php';
			} elseif ( 'overlay_horizontal' === $layout ) {
				include 'json/json-overlay-horizontal.php';
			} elseif ( 'schedule' === $layout ) {
				include 'json/json-schedule.php';
			} elseif ( 'soft_block' === $layout ) {
				include 'json/json-soft-block.php';
			} elseif ( 'accordion' === $layout ) {
				include 'json/json-accordion.php';
			} elseif ( 'collapsible' === $layout ) {
				include 'json/json-collapsible.php';
			} elseif ( 'story_layout' === $layout ) {
				include 'json/json-story-layout.php';
			} elseif ( 'divide_layout' === $layout ) {
				include 'json/json-divide-layout.php';
			} elseif ( 'topdivide_layout' === $layout ) {
				include 'json/json-topdivide-layout.php';
			} elseif ( 'year_layout' === $layout ) {
				include 'json/json-year-layout.php';
			} elseif ( 'boxy_layout' === $layout ) {
				include 'json/json-boxy-layout.php';
			} elseif ( 'cover_layout' === $layout ) {
				include 'json/json-cover-layout.php';
			} elseif ( 'glossary_layout' === $layout ) {
				include 'json/json-glossary-layout.php';
			} elseif ( 'business_layout' === $layout ) {
				include 'json/json-business-layout.php';
			} elseif ( 'timeline_graph_layout' === $layout ) {
				include 'json/json-timeline-graph-layout.php';
			} elseif ( 'rounded_layout' === $layout ) {
				include 'json/json-rounded-layout.php';
			} elseif ( 'wise_layout' === $layout ) {
				include 'json/json-wise-layout.php';
			} elseif ( 'fullhorizontal_layout' === $layout ) {
				include 'json/json-fullhorizontal-layout.php';
			} elseif ( 'infographic_layout' === $layout ) {
				include 'json/json-inforgraphic-layout.php';
			} elseif ( 'zigzag_layout' === $layout ) {
				include 'json/json-zigzag-layout.php';
			} elseif ( 'columy_layout' === $layout ) {
				include 'json/json-columy-layout.php';
			} elseif ( 'leafty_layout' === $layout ) {
				include 'json/json-leafty-layout.php';
			} elseif ( 'sportking_layout' === $layout ) {
				include 'json/json-sportking-layout.php';
			} elseif ( 'filledtimeline_layout' === $layout ) {
				include 'json/json-filledtimeline-layout.php';
			} elseif ( 'classictimeline_layout' === $layout ) {
				include 'json/json-classictimeline-layout.php';
			} elseif ( 'milestonetimeline_layout' === $layout ) {
				include 'json/json-milestonetimeline-layout.php';
			}
			if ( $reset_json ) {
				return self::update_settings_meta( $lid, $page_display, $reset_json );
			}
		}
	}

	/**
	 * Update Settings Meta.
	 *
	 * @since    1.0.0
	 * @param string $lid lid.
	 * @param string $page_display peage display.
	 * @param string $reset_json json.
	 * @return boolean
	 */
	public static function update_settings_meta( $lid, $page_display, $reset_json ) {
		// print_r($reset_json);.
		if ( is_serialized( $reset_json ) ) {
			if ( $page_display ) {
				$wtl_settings['wtl_page_display'] = $page_display;
			}
			$status = self::update_reset_json( $lid, $wtl_settings );
			if ( $status ) {
				return 'reset_done';
			} else {
				return false;
			}
		}
		return false;
	}

	/**
	 * Update Reset Json.
	 *
	 * @since    1.0.0
	 * @param string $lid lid.
	 * @param string $wtl_settings settings.
	 * @return array
	 */
	public static function update_reset_json( $lid, $wtl_settings ) {
		global $wpdb;
		$wtl_table_name = $wpdb->prefix . 'wtl_shortcodes';
		if ( isset( $wtl_settings ) && ! empty( $wtl_settings ) ) {
			foreach ( $wtl_settings as $single_key => $single_val ) {
				if ( is_array( $single_val ) ) {
					foreach ( $single_val as $s_key => $s_val ) {
						$wtl_settings[ $single_key ][ $s_key ] = sanitize_text_field( $s_val );
					}
				} else {
					if ( 'custom_css' === $single_key ) {
						$wtl_settings[ $single_key ] = wp_strip_all_tags( $single_val );
					} else {
						$wtl_settings[ $single_key ] = sanitize_text_field( $single_val );
					}
				}
			}
		}
		$insert = $wpdb->update(
			$wtl_table_name,
			array(
				'wtlsettngs' => maybe_serialize( $wtl_settings ),
			),
			array( 'wtlid' => $lid )
		);
		return true;
	}

	/**
	 * Update Settings Meta.
	 *
	 * @since    1.0.0
	 * @param string $layout lid.
	 * @return array
	 */
	public static function get_default_layout_settings( $layout ) {
		$reset_json = '';
		if ( 'advanced_layout' === $layout ) {
			include 'json/json-advanced-layout.php';
		} elseif ( 'verticalblur_layout' === $layout ) {
			include 'json/json-verticalblur-layout.php';
		} elseif ( 'fullvertical_layout' === $layout ) {
			include 'json/json-fullvertical-layout.php';
		} elseif ( 'cool_horizontal' === $layout ) {
			include 'json/json-cool-horizontal.php';
		} elseif ( 'curve_layout' === $layout ) {
			include 'json/json-curve-layout.php';
		} elseif ( 'easy_layout' === $layout ) {
			include 'json/json-easy-layout.php';
		} elseif ( 'attract_layout' === $layout ) {
			include 'json/json-attract-layout.php';
		} elseif ( 'processinfo_layout' === $layout ) {
			include 'json/json-processinfo-layout.php';
		} elseif ( 'divide_layout' === $layout ) {
			include 'json/json-divide-layout.php';
		} elseif ( 'topdivide_layout' === $layout ) {
			include 'json/json-topdivide-layout.php';
		} elseif ( 'fullwidth_layout' === $layout ) {
			include 'json/json-fullwidth-layout.php';
		} elseif ( 'hire_layout' === $layout ) {
			include 'json/json-hire-layout.php';
		} elseif ( 'milestone_layout' === $layout ) {
			include 'json/json-milestone-layout.php';
		} elseif ( 'overlay_horizontal' === $layout ) {
			include 'json/json-overlay-horizontal.php';
		} elseif ( 'schedule' === $layout ) {
			include 'json/json-schedule.php';
		} elseif ( 'soft_block' === $layout ) {
			include 'json/json-soft-block.php';
		} elseif ( 'accordion' === $layout ) {
			include 'json/json-accordion.php';
		} elseif ( 'collapsible' === $layout ) {
			include 'json/json-collapsible.php';
		} elseif ( 'story_layout' === $layout ) {
			include 'json/json-story-layout.php';
		} elseif ( 'year_layout' === $layout ) {
			include 'json/json-year-layout.php';
		} elseif ( 'boxy_layout' === $layout ) {
			include 'json/json-boxy-layout.php';
		} elseif ( 'cover_layout' === $layout ) {
			include 'json/json-cover-layout.php';
		} elseif ( 'glossary_layout' === $layout ) {
			include 'json/json-glossary-layout.php';
		} elseif ( 'business_layout' === $layout ) {
			include 'json/json-business-layout.php';
		} elseif ( 'timeline_graph_layout' === $layout ) {
			include 'json/json-timeline-graph-layout.php';
		} elseif ( 'rounded_layout' === $layout ) {
			include 'json/json-rounded-layout.php';
		} elseif ( 'wise_layout' === $layout ) {
			include 'json/json-wise-layout.php';
		} elseif ( 'fullhorizontal_layout' === $layout ) {
			include 'json/json-fullhorizontal-layout.php';
		} elseif ( 'infographic_layout' === $layout ) {
			include 'json/json-infographic-layout.php';
		} elseif ( 'zigzag_layout' === $layout ) {
			include 'json/json-zigzag-layout.php';
		} elseif ( 'columy_layout' === $layout ) {
			include 'json/json-columy-layout.php';
		} elseif ( 'leafty_layout' === $layout ) {
			include 'json/json-leafty-layout.php';
		} elseif ( 'sportking_layout' === $layout ) {
			include 'json/json-sportking-layout.php';
		} elseif ( 'filledtimeline_layout' === $layout ) {
			include 'json/json-filledtimeline-layout.php';
		} elseif ( 'classictimeline_layout' === $layout ) {
			include 'json/json-classictimeline-layout.php';
		} elseif ( 'milestonetimeline_layout' === $layout ) {
			include 'json/json-milestonetimeline-layout.php';
		}
		if ( $reset_json ) {
			return $reset_json;
		}
		return false;
	}
}
$wtl_template_config = new Wtl_Template_Reset();
