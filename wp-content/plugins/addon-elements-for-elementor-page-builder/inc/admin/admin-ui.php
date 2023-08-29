<?php

namespace WTS_EAE;

use WTS_EAE\Classes\Helper;

class Admin_Ui {
    public static $instance;

	public $module_manager;
	private $screens = [];
	protected $modules = [];

	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'register_admin_menu' ], 20 );
		add_action('in_admin_header', [$this, 'top_bar']);
		//add_action( 'wp_ajax_load_eae_modules', [ $this, 'load_eae_modules' ] );
		add_action( 'wp_ajax_eae_elements_save', [ $this, 'eae_save_elements' ] );
		add_action( 'wp_ajax_eae_save_config', [ $this, 'eae_save_config' ] );
		$this->set_screens();
	}
	// public function load_eae_modules(){
	// 	$helper        = new Helper();
	// 	$modules = $helper->get_eae_modules();
	// 	$items    = [];
	// 	foreach($modules as $key => $module){
	// 		$items[$key] = $module['enabled'];
	// 	}
	// 	if ( current_user_can( 'manage_options' ) ) {
	// 		update_option( 'wts_eae_elements', $items );
	// 	}
	// 	//echo "<pre>"; print_r($items); echo "</pre>";
	// 	wp_send_json([
	// 		'modules' => $items
	// 	]);
	// }

	public function eae_save_elements() {
		$helper        = new Helper();
		//check_ajax_referer( 'eae_ajax_nonce', 'nonce' );
		$elements = $_REQUEST['moduleData'];
		if(empty($elements)){
			return;
		}
		$modules = $helper->get_eae_modules();
		$items    = [];
		$count    = count( $modules );
		foreach($elements as $element => $value){
			if($value == 'deactivate'){
				$enabled = "false";
			}else{
				$enabled = "true";
			}
			$modules[$element]['enabled'] = $enabled;
		}
		foreach($modules as $key => $module){
			$items[$key] = $module['enabled'];
		}
		if ( current_user_can( 'manage_options' ) ) {
			update_option( 'wts_eae_elements', $items );
		}
		wp_send_json([
			'modules' => $items
		]);
	}

	public function eae_save_config() {
		$settings = $_REQUEST['config'];
		$gmap_api = sanitize_text_field($settings['wts_eae_gmap_key']);
		if ( current_user_can( 'manage_options' ) ) {
			update_option( 'wts_eae_gmap_key', $gmap_api );
			if($settings['eae_particle_library'] == 'tsParticle'){
				$use_tsParticle = 'true';
			}else{
				$use_tsParticle = 'false';	
			}

			update_option( 'use_tsParticle', $use_tsParticle);
		}
		wp_send_json([
			'success' => 1
		]);
	}

	public function register_admin_menu() {

		add_menu_page(
			__( 'Elementor Addons Elements', 'wts-eae' ),
			__( 'Elementor Addons Elements', 'wts-eae' ),
			'manage_options',
			'eae-settings',
			[ $this, 'display_settings_page' ],
			'',
			99
		);
	}

	public function display_settings_page() {
		$helper        = new Helper();
		$eae_widgets = [];
		$eae_ext = [];
		$this->modules = $helper->get_eae_modules();
		$map_key = get_option('wts_eae_gmap_key');
		$use_tsParticle = get_option('use_tsParticle' ,false);
		$modules = apply_filters( 'wts_eae_active_modules', $this->modules );
		foreach($modules as $module_key => $module){
			if($module['type'] == 'widget'){
				$eae_widgets[$module_key] = $module;
			}else{
				$eae_ext[$module_key] = $module;
			}
		}
		?>
		<div class="eae-wrap">
			<div class="eae-content-wrapper">
				<div class="eae-settings-main-wrapper">
					<div class="eae-tabs tabs">
						<h3 class="eae-title eae-modules active">
							<a href="#" data-tabid="eae-module-manager">Modules</a>
						</h3>
						<h3 class="eae-title eae-config">
							<a href="#" data-tabid="eae-config">Configuration</a>
						</h3>
					</div>
					<div class="eae-settings-box eae-metabox">	
						<div class="eae-metabox-content">
							<form class="eae-tab-content active" id="eae-module-manager" method="post">
								<div class="eae-bulk-action eae-module-row">
									<input type="checkbox" id="eae-select-all" />
									<select name="eae-bulk-action">
										<option value="">Bulk Action</option>
										<option value="activate">Activate</option>
										<option value="deactivate">Deactivate</option>
									</select>
									<input id="eae-apply" class="button" type="button" value="<?php echo __('Apply', 'aepro'); ?>" />
								</div>
								<div class="eae-module-row eae-module-group eae-widgets">
									<h4 class="eae-group-title"><?php echo __('Widgets', 'aepro'); ?></h4>
								</div>
								<?php
									foreach ($eae_widgets as $module_key => $widget) {
										//echo "<pre>";  print_r($widget);  echo "</pre>";
										$class = 'eae-module-row';
										if ($widget['enabled'] === 'true' || $widget['enabled'] === true) {
											$class .= ' eae-enabled';
											$action_text = __('Deactivate', 'eae-wts');
											$action = 'deactivate';
										} else {
											$class .= ' eae-disabled';
											$action_text = __('Activate', 'eae-wts');
											$action = 'activate';
										}?>
										<div class="<?php echo $class; ?>">
											<input class="eae-module-item" type="checkbox" name="eae_modules[]" value="<?php echo $module_key; ?>" />
											<?php echo $widget['name']; ?>

											<div class="eae-module-action">
												<a data-action="<?php echo $action; ?>" data-moduleId="<?php echo $module_key; ?>" href="#"> <?php echo $action_text; ?> </a>
											</div>
										</div>
								<?php } ?>
								<div class="eae-module-row eae-module-group eae-extension">
														<h4 class="eae-group-title"><?php echo __('Extensions', 'aepro'); ?></h4>
								</div>
								<?php
									foreach ($eae_ext as $module_key => $widget) {

										$class = 'eae-module-row';
										if ($widget['enabled'] === 'true' || $widget['enabled'] === true) {
											$class .= ' eae-enabled';
											$action_text = __('Deactivate', 'eae-wts');
											$action = 'deactivate';
										} else {
											$class .= ' eae-disabled';
											$action_text = __('Activate', 'eae-wts');
											$action = 'activate';
										}

								?>
										<div class="<?php echo $class; ?>">
											<input class="eae-module-item" type="checkbox" name="eae_modules[]" value="<?php echo $module_key; ?>" />
											<?php echo $widget['name']; ?>

											<div class="eae-module-action">
												<a data-action="<?php echo $action; ?>" data-moduleId="<?php echo $module_key; ?>" href="#"> <?php echo $action_text; ?> </a>
											</div>
										</div>
									<?php } ?>
							</form>

							<form class="eae-tab-content" id="eae-config">
								<table>
									<tr>
										<td>
											<label for="wts_eae_gmap_key"> Google Map Api Key </label>
										</td>
										<td>
											<input type="text" name="wts_eae_gmap_key" id="wts_eae_gmap_key" class="regular-text" value="<?php echo $map_key; ?>">
											<br/>
											<span class="eae-field-desc">
												<a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">
													<?php echo _e('Click Here') ?>
												</a> to generate API KEY
											</span>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<button type="button" value="Save" class="button button-primary" name="save_config" id="save-config" data-action="save-config">
												<span class="eae-action-text">Save</span>
												<span class="eae-action-loading dashicons dashicons-update-alt"></span>
											</button>		
										</td>
										
									</tr>
								</table>		

							</form>
						</div>
					</div>
				</div>
				<div class="eae-settings-sidebar-wrapper"></div>
			</div>
		</div>
		<?php
	}


	protected function set_screens()
	{

		$this->screens = [
			'toplevel_page_eae-settings',
		];
	}



    public function top_bar(){

		$nav_links = [
			'toplevel_page_eae-settings' => [
				'label' => __('Home', 'wts-eae'),
				'link'  => 'admin.php?page=eae-settings'
			],
			'doc' => [
				'label' => __('Documentation', 'wts-eae'),
				'link'  => 'https://wpvibes.link/go/ea-docs/'
			],
			'support' => [
				'label' => __('Get Support', 'wts-eae'),
				'link'  => 'https://wpvibes.link/go/ea-support/'
			]
		];


		$current_screen = get_current_screen();
		//print_r( $current_screen->id);

		if (!in_array($current_screen->id, $this->screens)) {
			return;
		}


?>

		<div class="eae-admin-topbar">
			<div class="eae-branding">
				<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					viewBox="0 0 976.2 976.2" style="enable-background:new 0 0 976.2 976.2;" xml:space="preserve">
				<style type="text/css">
					.dsfew{fill:none;}
					.uthe{fill:#0F5E9E;}
					.ruhew{fill:#003558;}
					.uhhe{fill:#FF6300;}
				</style>
				<g>
					<path class="dsfew" d="M276.8,413.1c-37.2,0-59.4,24.7-67,52.5c-0.6,2.4,1.1,4.7,3.5,4.7H336c2.3,0,4.1-2.1,3.6-4.3
						C332.5,433.1,309.3,413.1,276.8,413.1z"/>
					<path class="dsfew" d="M639.4,470.4h122.7c2.3,0,4.1-2.1,3.6-4.3c-7-32.9-30.2-52.9-62.7-52.9c-37.2,0-59.4,24.7-67,52.5
						C635.3,468,637,470.4,639.4,470.4z"/>
					<path class="dsfew" d="M493.2,413.6c-0.3,0-0.5,0-0.8,0c-40.8,0-74,34-74,75.8c0,42.8,32.5,76.3,74,76.3c0.3,0,0.5,0,0.8,0
						c35.4-0.3,63.7-29.8,63.7-65.3v-21.5C556.9,443.4,528.6,413.9,493.2,413.6z"/>
					<path class="uthe" d="M646.7,26.2c-0.2,0.1-0.4,0.4-0.6,0.5C646.3,26.6,646.5,26.4,646.7,26.2C646.7,26.3,646.7,26.2,646.7,26.2z"/>
					<path class="uthe" d="M808.5,183.9c0.6-0.6,1.1-1.2,1.5-1.9l19-31.9L810,182C809.6,182.7,809.1,183.4,808.5,183.9z"/>
					<path class="uthe" d="M765.8,86.5C765.8,86.5,765.7,86.5,765.8,86.5l-9.3-0.1h-0.2c-0.7,0-1.3,0.1-2,0.3c0.7-0.1,1.4-0.3,2.2-0.2
						L765.8,86.5z"/>
					<path class="uthe" d="M807.7,184.7c0.1-0.1,0.1-0.1,0.2-0.2C807.9,184.5,807.8,184.6,807.7,184.7
						C807.7,184.7,807.7,184.7,807.7,184.7z"/>
					<polygon class="uthe" points="730.4,120 730.4,120 737.4,108.2 	"/>
					<path class="uthe" d="M748.3,90.4c0.3-0.3,0.5-0.7,0.8-1C748.8,89.6,748.5,90,748.3,90.4z"/>
					<path class="uthe" d="M746.5,73.8c-0.4-0.3-0.8-0.5-1.1-0.7c0,0.4,0.1,0.8,0.1,1.2C745.8,74.1,746.2,74,746.5,73.8z"/>
					<path class="uthe" d="M620.7,67.7C620.7,67.7,620.7,67.7,620.7,67.7L637,40.4L620.7,67.7z"/>
					<path class="uthe" d="M751.6,87.6c0.7-0.3,1.4-0.7,2.1-0.8C753,86.9,752.3,87.2,751.6,87.6z"/>
					<path class="uthe" d="M643.7,29.3c0.4-0.6,0.8-1.2,1.3-1.7C644.5,28.1,644,28.7,643.7,29.3z"/>
					<g>
						<path class="ruhew" d="M639.3,508.9h169.5c1.9,0,3.4-1.4,3.6-3.2l0.4-3.2c0.5-4.5,0.5-9.3,0.5-14c-0.2-32.5-11.1-62.1-30.7-83.2
							c-19.9-21.5-47.8-33.4-78.7-33.4c-44.8,0-82.1,23.1-101.6,58.9v58.7v59.2c4.9,9,10.8,17.2,17.9,24.6
							c21.3,22.1,51.1,34.3,83.7,34.3c48.8,0,88.9-25.1,102.2-63.9l1.6-4.8c0.8-2.4-0.9-4.8-3.4-4.8l-28.5,0c-1.2,0-2.2,0.6-2.9,1.5
							c-19.2,26.2-42.9,30.7-68.1,30.7c-34.5,0-60.5-20.2-69-52.6C635.2,511.2,636.9,508.9,639.3,508.9z M635.9,465.7
							c7.6-27.8,29.8-52.5,67-52.5c32.5,0,55.7,20,62.7,52.9c0.5,2.2-1.3,4.3-3.6,4.3H639.4C637,470.4,635.3,468,635.9,465.7z"/>
						<path class="ruhew" d="M386.3,505.7l0.4-3.2c0.5-4.5,0.5-9.3,0.5-14c-0.1-14.7-2.4-28.8-6.7-41.8c-5.2-15.7-13.3-29.8-24-41.4
							c-19.9-21.5-47.8-33.4-78.7-33.4c-66.3,0-116.2,50.5-116.2,117.6c0,32.3,11.5,62,32.5,83.7c21.3,22.1,51.1,34.3,83.7,34.3
							c48.8,0,88.9-25.1,102.2-63.9l1.6-4.8c0.8-2.4-0.9-4.8-3.4-4.8l-28.5,0c-1.2,0-2.2,0.6-2.9,1.5c-19.2,26.2-42.9,30.7-68.1,30.7
							c-34.5,0-60.5-20.2-69-52.6c-0.6-2.3,1.1-4.7,3.5-4.7h160.9h8.5C384.5,508.9,386.1,507.5,386.3,505.7z M336,470.4H213.3
							c-2.4,0-4.1-2.3-3.5-4.7c7.6-27.8,29.8-52.5,67-52.5c32.5,0,55.7,20,62.7,52.9C340,468.3,338.3,470.4,336,470.4z"/>
						<path class="ruhew" d="M843.8,153.8l-26.2,41.6c69.2,77.8,111.2,180.4,111.2,292.7c0,243.4-197.3,440.7-440.8,440.7
							c-243.4,0-440.7-197.3-440.7-440.7c0-243.4,197.3-440.8,440.7-440.8c41,0,80.7,5.6,118.4,16.1c0.3-0.7,0.6-1.3,1-2l23.4-39.3
							c0.2-0.3,0.4-0.6,0.6-0.9C585.6,7.3,537.4,0,488.1,0C357.7,0,235.1,50.8,143,143C50.8,235.2,0,357.8,0,488.1s50.8,253,143,345.1
							c92.2,92.2,214.8,143,345.1,143s253-50.7,345.2-143c92.2-92.2,143-214.8,143-345.1C976.2,362.8,929.3,244.7,843.8,153.8z"/>
					</g>
					<path class="uthe" d="M749.4,89.1c0.6-0.5,1.2-1,1.8-1.4C750.6,88.1,750,88.6,749.4,89.1z"/>
					<g>
						<path class="uhhe" d="M602.3,430.7v-49.8c0-2-1.6-3.6-3.6-3.6h-38.1c-2,0-3.6,1.6-3.6,3.6v5.1c0,2.8-3.1,4.6-5.5,3.1
							c-18.2-11.3-39.6-17.3-63-17.3c-31,0-60.1,12.2-81.9,34.3c-11.5,11.7-20.3,25.4-26,40.4c4.3,13,6.6,27.1,6.7,41.8
							c0,4.7,0,9.5-0.5,14l-0.4,3.2c-0.2,1.8-1.8,3.2-3.6,3.2h-8.5c3.9,24.2,15,46.5,32.3,64.1c21.8,22.2,50.9,34.4,81.9,34.4
							c25.8,0,49.2-7.2,68.6-20.9v17.3c0,2,1.6,3.6,3.6,3.6h38.1c2,0,3.6-1.6,3.6-3.6v-55.2v-59.2V430.7z M556.9,500.4
							c0,35.4-28.3,65-63.7,65.3c-0.3,0-0.5,0-0.8,0c-41.5,0-74-33.5-74-76.3c0-41.8,33.2-75.8,74-75.8c0.3,0,0.5,0,0.8,0
							c35.4,0.3,63.7,29.8,63.7,65.3V500.4z"/>
						<g>
							<path class="uhhe" d="M737.4,108.2l-7,11.8l-6.5,10.9c-1.9,3.2-1.9,7.2-0.1,10.4c0,0,0,0,0,0l22.4,40c0,0,0,0,0,0
								c1.8,3.2,5.2,5.2,8.9,5.3l45.8,0.6c2.5,0.1,4.9-0.9,6.8-2.5c0.1-0.1,0.2-0.1,0.3-0.2c0.2-0.2,0.4-0.4,0.6-0.6
								c0.5-0.6,1.1-1.2,1.5-1.9l19-31.9l4.4-7.4c1.9-3.2,2-7.2,0.1-10.4l-22.4-40c-1.8-3.2-5.3-5.3-9-5.4l-36.5-0.5l-9.3-0.1
								c-0.7,0-1.5,0.1-2.2,0.2c-0.2,0-0.4,0-0.6,0.1c-0.7,0.2-1.4,0.5-2.1,0.8c-0.1,0.1-0.2,0.1-0.4,0.1c-0.7,0.4-1.2,0.8-1.8,1.4
								c-0.1,0.1-0.2,0.2-0.3,0.3c-0.3,0.3-0.5,0.7-0.8,1c-0.3,0.4-0.6,0.7-0.9,1.1L737.4,108.2z"/>
							<path class="uhhe" d="M637,40.4l-16.3,27.3l-0.7,1.2c-1.9,3.2-1.9,7.2-0.1,10.4l22.4,40c1.8,3.2,5.2,5.3,8.9,5.3l45.8,0.6
								c3.7,0,7.2-1.9,9.1-5.1l23.5-39.4c1.9-3.2,1.9-7.2,0.1-10.4l-22.4-40c-1.7-3.1-5-5.1-8.4-5.3l-0.5,0l-45.8-0.6
								c-2.1,0-4.1,0.6-5.8,1.7c-0.2,0.2-0.5,0.3-0.7,0.5c-0.4,0.3-0.7,0.5-1.1,0.9c-0.5,0.5-1,1.1-1.3,1.7c-0.1,0.1-0.1,0.2-0.2,0.3
								L637,40.4z"/>
							<path class="uhhe" d="M649.6,245.6l45.8,0.6c3.7,0,7.2-1.9,9.1-5.1l23.4-39.4c1.9-3.2,2-7.2,0.1-10.4l-22.4-40
								c-1.7-3.1-5-5.1-8.4-5.3l-0.5,0l-45.8-0.6c-3.7,0-7.2,1.9-9.1,5.1l-23.5,39.4c-1.9,3.2-1.9,7.2-0.1,10.4l22.4,40
								C642.5,243.5,645.9,245.6,649.6,245.6z"/>
						</g>
					</g>
				</g>
				</svg>
				<h1>Elementor Addon Elements</h1>
				<span class="eae-version"><?php echo EAE_VERSION; ?></span>
			</div>


			<nav class="eae-nav">
				<ul>
					<?php
					if (isset($nav_links) && count($nav_links)) {
						foreach ($nav_links as $id => $link) {
							
							
							$active = ($current_screen->id === $id) ? 'eae-nav-active' : '';

							$target = '';
							if ($id === 'doc' || $id === 'support') {
								$target = 'target="_blank"';
							}
					?>
							<li class="<?php echo $active; ?>">
								<a <?php echo $target; ?> href="<?php echo $link['link']; ?>"><?php echo $link['label']; ?></a>
							</li>
					<?php
						}
					}
					?>
				</ul>
			</nav>
		</div>

	<?php
	}
    
}
new Admin_Ui();