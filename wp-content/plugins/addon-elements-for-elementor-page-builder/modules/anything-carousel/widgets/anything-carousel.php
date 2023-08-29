<?php

namespace WTS_EAE\Modules\AnythingCarousel\Widgets;

use Elementor\Controls_Manager;
use WTS_EAE\Base\EAE_Widget_Base;
use Elementor\Repeater;
use WTS_EAE\Classes\Helper;
use Elementor\Plugin as EPlugin;
Use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class AnythingCarousel extends EAE_Widget_Base {
    public function get_name() {
		return 'eae-anythingcarousel';
	}

	public function get_title() {
		return __( 'EAE - Anything Carousel', 'wts-eae' );
	}

	public function get_icon() {
		return 'eicon-slider-push';
	}

	public function get_categories() {
		return [ 'wts-eae' ];
	}
	private function content_type_options() {
		$options = [
			''	   => __('Select', 'wts-eae'),	
			'shortcode'     => __( 'Shortcode', 'wts-eae' ),
			'saved_section' => __( 'Saved Section', 'wts-eae' ),
			'saved_page'    => __( 'Saved Page', 'wts-eae' ),
			'ae_template'   => __( 'AE-Template', 'wts-eae' ),
		];

		return $options;
	}
	protected function register_controls() {
		$this->start_controls_section(
			'section_general',
			[
				'label' => __( 'General', 'wts-eae' ),
			]
		);
		$repeater = new Repeater();

		$repeater->add_control(
			'title', [
				'label' => esc_html__( 'Title', 'plugin-name' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title' , 'plugin-name' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'template_type', [
				'label' => esc_html__( 'Content', 'plugin-name' ),
				'type' => Controls_Manager::SELECT,
				'options' => $this->content_type_options(),
				'default' => '',
			]
		);
		$repeater->add_control(
			'shortcode',
			[
				'label' => esc_html__( 'Enter your shortcode', 'elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => '[gallery id="123" size="medium"]',
				'default' => '',
				'condition'	=>	[
					'template_type'	=>	'shortcode'
				]
			]
		);
		$saved_sections[''] = __( 'Select Section', 'wts-eae' );
		$saved_sections     = $saved_sections + Helper::select_elementor_page( 'section' );
		$repeater->add_control(
			'saved_section',
			[
				'label'     => __( 'Sections', 'wts-eae' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $saved_sections,
				'condition' => [
					'template_type' => 'saved_section',
				],
			]
		);
		$saved_page[''] = __( 'Select Pages', 'wts-eae' );
		$saved_page     = $saved_page + Helper::select_elementor_page( 'page' );
		$repeater->add_control(
			'saved_page',
			[
				'label'     => __( 'Pages', 'wts-eae' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $saved_page,
				'condition' => [
					'template_type' => 'saved_page',
				],
			]
		);

		$saved_ae_template[''] = __( 'Select AE Template', 'wts-eae' );
		$saved_ae_template     = $saved_ae_template + Helper::select_ae_templates();
		$repeater->add_control(
			'ae_template',
			[
				'label'     => __( 'AE-Templates', 'wts-eae' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $saved_ae_template,
				'condition' => [
					'template_type' => 'ae_template',
				],
			]
		);
		$repeater->add_control(
			'thumb_image',
			[
				'label'       => __( 'Image', 'wts-eae' ),
				'type'        => Controls_Manager::MEDIA,
				'dynamic'     => [
					'active' => true,
				],
				'default'     => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'show_label'  => false,
				'selectors'   => [
					'{{WRAPPER}} .eae-thumb-slide{{CURRENT_ITEM}}' => 'background-image: url({{URL}})',
				],
				'render_type' => 'template',
			]
		);
		$this->add_control(
			'templates',
			[
				'label' => esc_html__( 'Content', 'plugin-name' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => esc_html__( 'Title #1', 'plugin-name' ),
						'template_type' => '',
					],
					[
						'title' => esc_html__( 'Title #2', 'plugin-name' ),
						'template_type' => '',
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label' => esc_html__( 'Height', 'wts-eae' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 400,
				],
				'size_units' => [ 'px', 'vh', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .eae-swiper-slide' => 'height: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'show_thumbnails',
			[
				'label'   => __( 'Show Thumbnail', 'wts-eae' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'wts-eae' ),
				'label_off' => esc_html__( 'Hide', 'wts-eae' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->end_controls_section();

		$this->thumbnail_controls_section();
		
		$this->carousel_controls();
    }
    
    protected function render(){
		$settings = $this->get_settings_for_display();
		// echo "<pre>"; print_r($settings); echo "</pre>";
		// die('dfaf');
		$templates = $settings['templates'];
		$swiper_data   = $this->get_swiper_data($settings);	
		$pagination_type   = $settings['ptype'];
		$navigation_button = $settings['navigation_button'];
		$scrollbar         = $settings['scrollbar'];
		$arrows_layout     = $settings['arrows_layout'];
		$this->add_render_attribute( 'outer-wrapper', 'class', 'eae-swiper-outer-wrapper' );
		$this->add_render_attribute( 'outer-wrapper', 'data-swiper-settings', wp_json_encode( $swiper_data ) );
		$this->add_render_attribute( 'outer-wrapper', 'data-show-thumbnail', $settings['show_thumbnails'] );
		if($settings['show_thumbnails'] == 'yes'){
			
			$thumbnail_data = $this->get_thumb_data($settings);
			
			$this->add_render_attribute( 'outer-wrapper', 'data-thumb-settings', wp_json_encode( $thumbnail_data ) );
		}
		if ( $settings['arrows_layout'] === 'inside' ) {
			$this->add_render_attribute( 'outer-wrapper', 'class', 'ae-hpos-' . $settings['arrow_horizontal_position'] );
			$this->add_render_attribute( 'outer-wrapper', 'class', 'ae-vpos-' . $settings['arrow_vertical_position'] );
		}
		$this->add_render_attribute( 'widget-wrapper', 'class', 'eae-widget-wrapper' );
		$eae_slider_id = wp_rand(0, 99999);
		$this->add_render_attribute('swiper-container', 
				[
					'class' => 'eae-swiper-container swiper-container eae-slider-id-' . $eae_slider_id,
					'data-eae-slider-id' => $eae_slider_id,
				]);
		?>
			<div <?php echo $this->get_render_attribute_string('outer-wrapper');?>>
				<div <?php echo $this->get_render_attribute_string('swiper-container'); ?>>
					<div class="eae-swiper-wrapper swiper-wrapper">
						<?php 
							foreach($templates as $template){
								
								$template_type = $template['template_type'];
								if($template_type == 'shortcode' && !empty($template[$template_type])){ ?>
									<div class="eae-swiper-slide swiper-slide eae-swiper-slider-<?php echo $template['_id'];?>">
										<?php echo do_shortcode($template['shortcode']); ?>
									</div>	
									<?php
								}else{
									if(!empty($template[$template_type])){?>
										<div class="eae-swiper-slide swiper-slide eae-swiper-slider-<?php echo $template['_id'];?>">
											<?php echo EPlugin::instance()->frontend->get_builder_content_for_display( $template[$template_type] ); ?>
										</div>
									<?php } 
								}
							}
						?>
					</div>
					<?php if ( $pagination_type !== '' ) { ?>
						<div class = "eae-swiper-pagination swiper-pagination"></div>
					<?php } ?>
					 
					<?php if ( $settings ['navigation_button' ] === 'yes' && $settings['arrows_layout'] === 'inside' ) { 
						// <!-- Arrows Inside  -->
						$this->get_swiper_arrows($settings);
					}?>
					<?php if ( $settings['scrollbar'] === 'yes' ) {?>
						<div class = "eae-swiper-scrollbar swiper-scrollbar"></div>
					<?php } ?>
				</div>
				<?php if ( $settings ['navigation_button' ] === 'yes' && $settings['arrows_layout'] === 'outside' ) { 
						$this->get_swiper_arrows($settings);
				}
				if($settings['show_thumbnails'] == 'yes'){
					$this->render_thumbslider($templates,$settings);
				}
				?>	
			</div>
		<?php
		
    }

	public function thumbnail_controls_section(){
		$this->start_controls_section(
			'section_thumb_setting',
			[
				'label' => __( 'Thumbnails', 'wts-eae' ),
				'type'  => Controls_Manager::SECTION,
				'condition'	=>	[
					'show_thumbnails'	=>	'yes'
				]
			]
		);

		$this->add_responsive_control(
			'thumb_container_width',
			[
				'label'	=>	__('Width', 'wts-eae'),
				'type'	=>	Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min' => 100,
						'max' => 1000,
					],
					'%'	=>	[
						'min'	=>	10,
						'max'	=>	100
					],
				],
				'size_units' => [ 'px','%' ],
				'selectors'  => [
					'{{WRAPPER}} .eae-thumb-container' => 'width: {{SIZE}}{{UNIT}};',
				],
				
			]
		);

		$this->add_responsive_control(
			'thumb_slides_per_view',
			[
				'label'          => __( 'Thumbs Per View', 'wts-eae' ),
				'type'           => Controls_Manager::NUMBER,
				'default'        => 3,
				'tablet_default' => 3,
				'mobile_default' => 2,
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'thumb_space_between',
			[
				'label'          => __( 'Space Between Thumbs', 'wts-eae' ),
				'type'           => Controls_Manager::NUMBER,
				'default'        => 10,
				'tablet_default' => 10,
				'mobile_default' => 5,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'thumb_navigation',
			[
				'label'   => __( 'Arrows', 'wts-eae' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => '',
				'return_value' => 'yes'
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'label'     => __( 'Size', 'wts-eae' ),
				'name'      => 'eae_thumb_image',
				'default'   => 'full',
				'exclude'   => [ 'custom' ],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'thumb_background_size',
			[
				'label'     => __( 'Image Fit', 'wts-eae' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'cover',
				'options'   => [
					'cover'   => _x( 'Cover', 'Background Control', 'wts-eae' ),
					'contain' => _x( 'Contain', 'Background Control', 'wts-eae' ),
					'auto'    => _x( 'Auto', 'Background Control', 'wts-eae' ),
				],
				'selectors' => [
					'{{WRAPPER}}  .eae-swiper-outer-wrapper .eae-thumb-slide' => 'background-size: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'thumb_background_position',
			[
				'label'     => __( 'Image Position', 'wts-eae' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center center',
				'options'   => [
					''              => __( 'Default', 'wts-eae' ),
					'center center' => __( 'Center Center', 'wts-eae' ),
					'center left'   => __( 'Center Left', 'wts-eae' ),
					'center right'  => __( 'Center Right', 'wts-eae' ),
					'top center'    => __( 'Top Center', 'wts-eae' ),
					'top left'      => __( 'Top Left', 'wts-eae' ),
					'top right'     => __( 'Top Right', 'wts-eae' ),
					'bottom center' => __( 'Bottom Center', 'wts-eae' ),
					'bottom left'   => __( 'Bottom Left', 'wts-eae' ),
					'bottom right'  => __( 'Bottom Right', 'wts-eae' ),
				],
				'selectors' => [
					'{{WRAPPER}}  .eae-swiper-outer-wrapper .eae-thumb-slide' => 'background-position: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'thumb_background_repeat',
			[
				'label'     => __( 'Image Position', 'wts-eae' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'repeat',
				'options'   => [
					''				=>	__('Default', 'wts-eae'),
					'repeat' 		=> __( 'Repeat', 'wts-eae' ),
					'no-repeat'   	=> __( 'No Repeat', 'wts-eae' ),
					'repeat-x'  	=> __( 'Repeat X', 'wts-eae' ),
					'repeat-y'    	=> __( 'Repeat Y', 'wts-eae' ),
				],
				'selectors' => [
					'{{WRAPPER}}  .eae-swiper-outer-wrapper .eae-thumb-slide' => 'background-repeat: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'thumb_ratio',
			[
				'label'          => __( 'Ratio', 'wts-eae' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [
					'size' => 0.42,
				],
				'tablet_default' => [
					'size' => '',
				],
				'mobile_default' => [
					'size' => 0.5,
				],
				'range'          => [
					'px' => [
						'min'  => 0.1,
						'max'  => 2,
						'step' => 0.01,
					],
				],
				'selectors'      => [
					'{{WRAPPER}} .eae-thumb-slide .eae-fit-aspect-ratio' => 'padding-bottom: calc( {{SIZE}} * 100% );',
				],
			]
		);

		$this->add_responsive_control(
			'thumb_alignment',
			[
				'label'        => __( 'Horizontal Position', 'wts-eae' ),
				'type'         => Controls_Manager::CHOOSE,
				'default'      => 'center',
				'options'      => [
					'left' => [
						'title' => __( 'Left', 'wts-eae' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'wts-eae' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'wts-eae' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'selectors_dictionary' => [
					'left' => '100%',
					'center' => 'auto',
					'right'	=> '0%'
				],
				'selectors' => [
					'{{WRAPPER}} .eae-swiper-outer-wrapper .eae-thumb-container.swiper-container' => 'margin-right: {{VALUE}};',
				],
				
			]
		);

		$this->add_control(
			'thumb_horizontal_align',
			[
				'label'   => __( 'Position', 'wts-eae' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'top'    => __( 'Top', 'wts-eae' ),
					'bottom' => __( 'Bottom', 'wts-eae' ),
				],
				'default' => 'bottom',
			]
		);

		$this->end_controls_section();
	}

	public function get_thumb_data($settings){
		//echo "<pre>"; print_r($settings); echo "</pre>";
		$ele_breakpoints = EPlugin::$instance->breakpoints->get_active_breakpoints();
		$active_devices = EPlugin::$instance->breakpoints->get_active_devices_list();
		$active_breakpoints = array_keys($ele_breakpoints);
		$break_value = [];
		foreach($active_devices as $active_device){
			$min_breakpoint = EPlugin::$instance->breakpoints->get_device_min_breakpoint($active_device);
			$break_value[$active_device] = $min_breakpoint; 
		}

		foreach($active_devices as $break_key => $active_device){
			if(in_array($active_device, ['mobile', 'tablet', 'desktop'])){
				switch ($active_device) {
					case 'mobile': 	$thumb_swiper_data['spaceBetween'][$active_device] = intval($settings['thumb_space_between_'.$active_device] !== '' ? $settings['thumb_space_between_'.$active_device] : 5);
									break;
					case 'tablet': 	$thumb_swiper_data['spaceBetween'][$active_device] = intval($settings['thumb_space_between_'.$active_device] !== '' ? $settings['thumb_space_between_'.$active_device] : 10);
									break;
					case 'desktop' : $thumb_swiper_data['spaceBetween']['default']  = intval($settings['thumb_space_between'] !== '' ? $settings['thumb_space_between'] : 15);
									break;								
				}
			}else{
				$thumb_swiper_data['spaceBetween'][$active_device] = intval($settings['thumb_space_between_'.$active_device] !== '' ? $settings['thumb_space_between_'.$active_device ] : 15);
			}
		}

		foreach($active_devices as $break_key => $active_device){
			if(in_array($active_device, ['mobile', 'tablet','desktop'])){			
				switch ($active_device) {
					case 'mobile': 	$thumb_swiper_data['slidesPerView'][$active_device] = intval($settings['thumb_slides_per_view_'.$active_device] !== '' ? $settings['thumb_slides_per_view_'.$active_device] : 1);
									break;
					case 'tablet': 	$thumb_swiper_data['slidesPerView'][$active_device] = intval($settings['thumb_slides_per_view_'.$active_device] !== '' ? $settings['thumb_slides_per_view_'.$active_device] : 2);
									break;
					case 'desktop' : $thumb_swiper_data['slidesPerView']['default']  = intval($settings['thumb_slides_per_view'] !== '' ? $settings['thumb_slides_per_view'] : 3);
									break;				
				}
			}else{
				$thumb_swiper_data['slidesPerView'][$active_device] = intval($settings['thumb_slides_per_view_'.$active_device] !== '' ? $settings['thumb_slide_per_view_'.$active_device] : 2);
			}
		}
		if($settings['thumb_navigation'] == 'yes'){
			$thumb_swiper_data['thumb_navigation'] = $settings['thumb_navigation'];
		}
		
		return $thumb_swiper_data;
	}

	public function render_thumbslider( $templates, $settings ) {
		
		$this->add_render_attribute( 'thumb-container', 'class', [ 'eae-thumb-container', 'swiper-container', 'eae-gallery-thumbs' ] );
		$this->add_render_attribute( 'thumb-wrapper', 'class', [ 'eae-thumb-wrapper', 'swiper-wrapper' ] );

		//$thumb_navigation = $settings['thumb_navigation'];

		// if ( $settings['thumb_horizontal_align'] === 'top' ) {
		// 	$this->add_render_attribute( 'thumb-container', 'class', [ 'eae-thumb-horizontal-top' ] );
		// }
		// if ( $settings['thumb_horizontal_align'] === 'bottom' ) {
		// 	$this->add_render_attribute( 'thumb-container', 'class', [ 'eae-thumb-horizontal-bottom' ] );
		// }

		?>
			<div <?php echo $this->get_render_attribute_string( 'thumb-container' ); ?>>
				<div <?php echo $this->get_render_attribute_string( 'thumb-wrapper' ); ?>>
					<?php
					foreach ( $templates as $template ) {
						$template_type = $template['template_type'];
						if(empty($template[$template_type])){
							continue;
						}						
						$id = $template['_id'];
						$this->set_render_attribute( 'thumb-repeater-item', 'class', [ 'elementor-repeater-item-' . $id, 'eae-thumb-slide', 'swiper-slide' ] );
						$thumb_image_id = $template['thumb_image']['id'];
						if ( ! empty( $thumb_image_id ) ) {
							$thumb_image_url = Group_Control_Image_Size::get_attachment_image_src( $thumb_image_id, 'eae_thumb_image', $settings );
						} else {
							$thumb_image_url = Utils::get_placeholder_image_src();
						}

						$this->set_render_attribute( 'thumb-repeater-item', 'style', 'background-image : url(' . $thumb_image_url . ');' );

						?>
					   
						<div <?php echo $this->get_render_attribute_string( 'thumb-repeater-item' ); ?>>
								<div class='eae-fit-aspect-ratio'></div>
						</div>
					<?php } ?> 
				</div>

			
			</div>

		<?php
	}

	public function carousel_controls() {

		$this->start_controls_section(
			'carousel_control',
			[
				'label'     => __( 'Carousel', 'ae-pro' ),
			]
		);

		$this->add_control(
			'image_carousel',
			[
				'label'     => __( 'Carousel', 'ae-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		// Todo:: different effects management
		$this->add_control(
			'effect',
			[
				'label'   => __( 'Effects', 'ae-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'fade'      => __( 'Fade', 'ae-pro' ),
					'slide'     => __( 'Slide', 'ae-pro' ),
					'coverflow' => __( 'Coverflow', 'ae-pro' ),
					'flip'      => __( 'Flip', 'ae-pro' ),
				],
				'default' => 'slide',
			]
		);

		$this->add_responsive_control(
			'slide_per_view',
			[
				'label'          => __( 'Slides Per View', 'ae-pro' ),
				'type'           => Controls_Manager::NUMBER,
				'min'            => 1,
				'max'            => 100,
				'default'        => 3,
				'tablet_default' => 2,
				'mobile_default' => 1,
				'condition'      => [
					'effect' => [ 'slide', 'coverflow' ],
				],
				'frontend_available' => true
			]
		);

		$this->add_responsive_control(
			'slides_per_group',
			[
				'label'          => __( 'Slides Per Group', 'ae-pro' ),
				'type'           => Controls_Manager::NUMBER,
				'min'            => 1,
				'max'            => 100,
				'default'        => 1,
				'tablet_default' => 1,
				'mobile_default' => 1,
				'condition'      => [
					'effect'=> [ 'slide', 'coverflow' ],
				],
				'frontend_available' => true
			]
		);

		$this->add_control(
			'carousel_settings_heading',
			[
				'label'     => __( 'Setting', 'ae-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'speed',
			[
				'label'       => __( 'Speed', 'ae-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size' => 5000,
				],
				'description' => __( 'Duration of transition between slides (in ms)', 'ae-pro' ),
				'range'       => [
					'px' => [
						'min'  => 300,
						'max'  => 10000,
						'step' => 300,
					],
				],

			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'        => __( 'Autoplay', 'ae-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => __( 'On', 'ae-pro' ),
				'label_off'    => __( 'Off', 'ae-pro' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'duration',
			[
				'label'       => __( 'Duration', 'ae-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size' => 900,
				],
				'description' => __( 'Delay between transitions (in ms)', 'ae-pro' ),
				'range'       => [
					'px' => [
						'min'  => 300,
						'max'  => 10000,
						'step' => 300,
					],
				],
				'condition'   => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'space',
			[
				'label'          => __( 'Space Between Slides', 'ae-pro' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [
					'size' => 15,
				],
				'tablet_default' => [
					'size' => 10,
				],
				'mobile_default' => [
					'size' => 5,
				],
				'range'          => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 5,
					],
				],
				'condition'      => [
					'effect' => [ 'slide', 'coverflow' ],
				],
				'frontend_available' => true
			]
		);

		$this->add_control(
			'loop',
			[
				'label'        => __( 'Loop', 'ae-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'ae-pro' ),
				'label_off'    => __( 'No', 'ae-pro' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'auto_height',
			[
				'label'        => __( 'Auto Height', 'ae-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => __( 'Yes', 'ae-pro' ),
				'label_off'    => __( 'No', 'ae-pro' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label'        => __( 'Pause on Hover', 'ae-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => __( 'Yes', 'ae-pro' ),
				'label_off'    => __( 'No', 'ae-pro' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'pagination_heading',
			[
				'label'     => __( 'Pagination', 'ae-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'ptype',
			[
				'label'   => __( ' Pagination Type', 'ae-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' =>
					[
						''            => __( 'None', 'ae-pro' ),
						'bullets'     => __( 'Bullets', 'ae-pro' ),
						'fraction'    => __( 'Fraction', 'ae-pro' ),
						'progressbar' => __( 'Progress', 'ae-pro' ),
					],
				'default' => 'bullets',
			]
		);

		$this->add_control(
			'clickable',
			[
				'label'     => __( 'Clickable', 'ae-pro' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => __( 'Yes', 'ae-pro' ),
				'label_off' => __( 'No', 'ae-pro' ),
				'condition' => [
					'ptype' => 'bullets',
				],
			]
		);

		$this->add_control(
			'keyboard',
			[
				'label'        => __( 'Keyboard Control', 'ae-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'ae-pro' ),
				'label_off'    => __( 'No', 'ae-pro' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'scrollbar',
			[
				'label'        => __( 'Scroll bar', 'ae-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'ae-pro' ),
				'label_off'    => __( 'No', 'ae-pro' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'navigation_arrow_heading',
			[
				'label'     => __( 'Prev/Next Navigaton', 'ae-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',

			]
		);

		$this->add_control(
			'navigation_button',
			[
				'label'        => __( 'Enable', 'ae-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'ae-pro' ),
				'label_off'    => __( 'No', 'ae-pro' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'arrows_layout',
			[
				'label'     => __( 'Position', 'ae-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'inside',
				'options'   => [
					'inside'  => __( 'Inside', 'ae-pro' ),
					'outside' => __( 'Outside', 'ae-pro' ),
				],
				'condition' => [
					'navigation_button'  => 'yes',
				],

			]
		);

		$this->add_control(
			'arrow_icon_left',
			[
				'label'            => __( 'Icon Prev', 'ae-pro' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'fa fa-angle-left',
					'library' => 'fa-solid',
				],
				'condition'        => [
						'navigation_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'arrow_icon_right',
			[
				'label'            => __( 'Icon Next', 'ae-pro' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'fa fa-angle-right',
					'library' => 'fa-solid',
				],
				'condition'        => [
					'navigation_button'  => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'arrow_horizontal_position',
			[
				'label'       => __( 'Horizontal Position', 'ae-pro' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'left' => [
						'title' => __( 'Left', 'ae-pro' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ae-pro' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'ae-pro' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'     => 'center',
				'condition'   => [
					'navigation_button' => 'yes',
					'arrows_layout' 	=> 'inside',
				],
			]
		);

		$this->add_responsive_control(
			'arrow_vertical_position',
			[
				'label'       => __( 'Vertical Position', 'ae-pro' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'top' => [
						'title' => __( 'Top', 'ae-pro' ),
						'icon'  => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'ae-pro' ),
						'icon'  => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'ae-pro' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'default'     => 'center',
				'condition'   => [
					'navigation_button'  => 'yes',
					'arrows_layout' => 'inside',

				],
			]
		);

		$this->end_controls_section();
	}

	public function get_swiper_data($settings) {
		// TODO:: Swiper Data Populate
		if ($settings['speed']['size'] ) {
			$swiper_data['speed'] = $settings['speed']['size'];
		} else {
			$swiper_data['speed'] = 1000;
		}
		$swiper_data['direction'] = 'horizontal';
		if ( $settings['autoplay'] === 'yes' ) {
			$duration                                        = $settings['duration'];
			$swiper_data['autoplay']['delay']                = $duration['size'];
			$swiper_data['autoplay']['disableOnInteraction'] = false;
			//$swiper_data['autoplay']['waitForTransition'] = false;			
		} else {
			$swiper_data['autoplay'] = false;
		}

		if ( $settings['pause_on_hover'] === 'yes' ) {
			$swiper_data['pause_on_hover'] = $settings['pause_on_hover'];
		}
		$swiper_data['effect'] = $settings['effect'];
		$swiper_data['loop']                    = $settings['loop'];
		$swiper_data['autoHeight']              = $settings['auto_height'];

		$ele_breakpoints = EPlugin::$instance->breakpoints->get_active_breakpoints();
		$active_devices = EPlugin::$instance->breakpoints->get_active_devices_list();
		$active_breakpoints = array_keys($ele_breakpoints);
		$break_value = [];
		foreach($active_devices as $active_device){
			$min_breakpoint = EPlugin::$instance->breakpoints->get_device_min_breakpoint($active_device);
			$break_value[$active_device] = $min_breakpoint; 
		}

		foreach($active_devices as $break_key => $active_device){
			if(in_array($active_device, ['mobile', 'tablet', 'desktop'])){
				switch ($active_device) {
					case 'mobile': 	$swiper_data['spaceBetween'][$active_device] = intval($settings['space_'.$active_device]['size'] !== '' ? $settings['space_'.$active_device]['size'] : 5);
									break;
					case 'tablet': 	$swiper_data['spaceBetween'][$active_device] = intval($settings['space_'.$active_device]['size'] !== '' ? $settings['space_'.$active_device]['size'] : 10);
									break;
					case 'desktop' : $swiper_data['spaceBetween']['default']  = intval($settings['space']['size'] !== '' ? $settings['space']['size'] : 15);
									break;								
				}
			}else{
				$swiper_data['spaceBetween'][$active_device] = intval($settings['space_'.$active_device]['size'] !== '' ? $settings['space_'.$active_device ]['size'] : 15);
			}
		}

		foreach($active_devices as $break_key => $active_device){
			if(in_array($active_device, ['mobile', 'tablet','desktop'])){			
				switch ($active_device) {
					case 'mobile': 	$swiper_data['slidesPerView'][$active_device] = intval($settings['slide_per_view_'.$active_device] !== '' ? $settings['slide_per_view_'.$active_device] : 1);
									break;
					case 'tablet': 	$swiper_data['slidesPerView'][$active_device] = intval($settings['slide_per_view_'.$active_device] !== '' ? $settings['slide_per_view_'.$active_device] : 2);
									break;
					case 'desktop' : $swiper_data['slidesPerView']['default']  = intval($settings['slide_per_view'] !== '' ? $settings['slide_per_view'] : 3);
									break;				
				}
			}else{
				$swiper_data['slidesPerView'][$active_device] = intval($settings['slide_per_view_'.$active_device] !== '' ? $settings['slide_per_view_'.$active_device] : 2);
			}
		}

		foreach($active_devices as $break_key => $active_device){
			if(in_array($active_device, ['mobile', 'tablet','desktop'])){			
				switch ($active_device) {
					case 'mobile': 	$swiper_data['slidesPerGroup'][$active_device] = $settings['slides_per_group_'.$active_device] !== '' ? $settings['slides_per_group_'.$active_device] : 1;
									break;
					case 'tablet': 	$swiper_data['slidesPerGroup'][$active_device] = $settings['slides_per_group_'.$active_device] !== '' ? $settings['slides_per_group_'.$active_device] : 1;
									break;
					case 'desktop' : $swiper_data['slidesPerGroup']['default']  = $settings['slides_per_group']  !== '' ? $settings['slides_per_group'] : 1; 										
									break;
				}
			}else{
				$swiper_data['slidesPerGroup'][$active_device] = $settings['slides_per_group_'.$active_device] !== '' ? $settings['slides_per_group_'.$active_device] : 1;
			}
		}

		$swiper_data['breakpoints_value'] = $break_value; 
		$swiper_data['ptype']                     = $settings['ptype'];
		$swiper_data['clickable']                 = $settings['clickable'];
		$swiper_data['navigation']                = $settings['navigation_button'];
		$swiper_data['scrollbar']                 = $settings['scrollbar'];
		// echo "<pre>"; print_r($swiper_data); echo "</pre>";
		// die('dfadf');
		return $swiper_data;
	}

	public function get_swiper_arrows($settings) {
		$arrow_Hpos = $settings['arrow_horizontal_position'];
		$arrow_layout = $settings['arrows_layout'];
		if ( $arrow_Hpos !== 'center' && $arrow_layout === 'inside' ) {?>
			<div class="eae-swiper-button-wrapper">
				<?php
			}
		?>
				<div class = "eae-swiper-button-prev swiper-button-prev">
					<?php
					if ( is_rtl() ) {
						Icons_Manager::render_icon( $settings['arrow_icon_right'], [ 'aria-hidden' => 'true' ] );
					} else {
						Icons_Manager::render_icon( $settings['arrow_icon_left'], [ 'aria-hidden' => 'true' ] );
					}
					?>
				</div>
				<div class = "eae-swiper-button-next swiper-button-next">
					<?php
					if ( is_rtl() ) {
						Icons_Manager::render_icon( $settings['arrow_icon_left'], [ 'aria-hidden' => 'true' ] );
					} else {
						Icons_Manager::render_icon( $settings['arrow_icon_right'], [ 'aria-hidden' => 'true' ] );
					}
					?>
				</div>
		<?php
		if ( $arrow_Hpos !== 'center' && $arrow_layout === 'inside' ) {?>
			</div>
		<?php }
	}
}
