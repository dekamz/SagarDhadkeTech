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
 * @subpackage Wp_Timeline_Designer_PRO/wp_timeline_templates
 * @author     Solwin Infotech <info@solwininfotech.com>
 */
class Wtl_Template_Schedule_Layout {
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
	}

	/**
	 * Template Render
	 *
	 * @param array $layout_id settings arrray.
	 * @param array $wtl_settings settings arrray.
	 * @param array $template_wrapper settings arrray.
	 * @return html
	 */
	public static function render( $layout_id, $wtl_settings, $template_wrapper ) {
		$out  = '';
		$out .= '<div class="wtl_wrapper wp_timeline_post_list schedule_cover layout_id_' . $layout_id . ' wtl_story_layout" id="wtl_story_layout" >';
		$out .= '<div class="wtl_template story story_wrapper">';
		$out .= $template_wrapper;
		$out .= '</div>';
		$out .= '</div>';
		return $out;
	}
}

$wtl_template_schedule_layout = new Wtl_Template_Schedule_Layout();
