<?php 

namespace WTS_EAE\Modules\AlertMessage\Widgets;

use WTS_EAE\Base\EAE_Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class AlertMessage extends EAE_Widget_Base {

    public function get_name() {
		return 'eae-alert-message';
	}

	public function get_title() {
		return __( 'EAE - Alert Message', 'wts-eae' );
	}

	public function get_icon() {
		return 'eae-icons eae-dual-button';
	}
    

    protected function register_controls(){
      
        $this->start_controls_section(//icon label
            'alert',
            [
                'label'=>esc_html__('Alert Box','wts-eae'),
            ]            

        );
        $this->add_control(//alert box type
			'alert_type',
			[
				'label' => esc_html__( 'Type', 'wts-eae' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'info',
				'options' => [
					'info' => esc_html__( 'Info',  'wts-eae'  ),
					'success' => esc_html__( 'Success',  'wts-eae'  ),
					'warning' => esc_html__( 'Warning',  'wts-eae'  ),
					'danger' => esc_html__( 'Danger',  'wts-eae' ),
				],
				'prefix_class' => 'eae-alert-type-',
                'separator'=> 'after',   
			]
		);

        $this->add_control(//label name of content
            'content',
            [
                'label' => esc_html__( 'Content', 'wts-eae' ),
                'type' => Controls_Manager::HEADING,  
            ]
        );
        $this->add_control(//add heading area
			'heading',
			[
				'label' => esc_html__( 'Heading', 'wts-eae' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter your title', 'wts-eae' ),
				'default' => esc_html__( 'Heading text', 'wts-eae'),
			
			]
		);
       
		$this->add_control(//description
			'description',
			[
				'label' => esc_html__( 'Description', 'wts-eae' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter your subtitle', 'wts-eae' ),
				'default' => esc_html__( 'Add Your Description text', 'wts-eae' ),
			
			]
		);
        $this->add_responsive_control(//content alignment
			'content_align',
			[
				'label' => esc_html__( 'Alignment',  'wts-eae'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left',   'wts-eae' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center',  'wts-eae' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right',  'wts-eae'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eae-alert-content' => 'text-align: {{VALUE}};',
                    
				],'separator' => 'after',
			]
		);

        $this->add_control(//icon lable
            'icon',[
                'label'=>esc_html__('Icon','wts-eae'),
                'type'=>Controls_Manager::HEADING,  
            ]
        );
        $this->add_control(//garphic element
			'graphic_element',
			[
				'label' => esc_html__( 'Media Element',  'wts-eae'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'none' => [
						'title' => esc_html__( 'None',  'wts-eae' ),
						'icon' => 'eicon-ban',
					],
					'image' => [
						'title' => esc_html__( 'Image',  'wts-eae' ),
						'icon' => 'eicon-image-bold',
					],
					'icon' => [
						'title' => esc_html__( 'Icon',  'wts-eae' ),
						'icon' => 'eicon-star',
					],
				],
				'default' => 'icon',
			]
		);
		$this->add_control(//garphic element image contain
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'wts-eae' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
                    'type' => Controls_Manager::URL,
					'url' => Utils::get_placeholder_image_src()
				],
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'graphic_element' => 'image',
				],
			]
		);
		$this->add_group_control(//image size
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image', // Actually its `image_size`
				'default' => 'thumbnail',
				'condition' => [
					'graphic_element' => 'image',
				],
			]
		);
		$this->add_control(//garphic element icon contain
			'selected_icon',
			[
				'label' => esc_html__( 'Icon', 'wts-eae' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-info-circle',
					'library' => 'fa-solid',
				],
				'condition' => [
					'graphic_element' => 'icon',
				],
			]
		);
		$this->add_control(//icon view
			'view',
			[
				'label' => esc_html__( 'View', 'wts-eae' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'wts-eae' ),
					'stacked' => esc_html__( 'Stacked', 'wts-eae' ),
					'framed' => esc_html__( 'Framed', 'wts-eae' ),
				],
				'default' => 'default',
				'prefix_class' => 'wts-eae-icon-view-',
			]
		);
		$this->add_control(//icon shape
			'shape',
			[
				'label' => esc_html__( 'Shape', 'wts-eae' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'circle' => esc_html__( 'Circle', 'wts-eae' ),
					'square' => esc_html__( 'Square', 'wts-eae' ),
				],
				'default' => 'circle',
				'condition' => [
					'view!' => 'default',
				],
				'prefix_class' => 'wts-eae-icon-shape-',
			]
		);
        $this->add_responsive_control(//icon rotation
			'rotate',
			[
				'label' => esc_html__( 'Rotate',  'wts-eae' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'range' => [
					'deg' => [
						'min' => 0,
						'max' => 360,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'deg',
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .eae-alert-icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);
        $this->add_responsive_control(//icon size
			'icon_size',
			[
				'label' => esc_html__( 'Size',  'wts-eae' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eae-alert-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				
			]
		);
        $this->add_responsive_control(//icon position
			'position',
			[
				'label' => esc_html__( 'Icon Position', 'wts-eae' ),
				'type' => Controls_Manager::CHOOSE,
				'mobile_default' => 'top',
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'wts-eae' ),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => esc_html__( 'Top', 'wts-eae' ),
						'icon' => 'eicon-v-align-top',
					],
				],
				'default'=>'left',
				'prefix_class' => 'eae-icon-position-',
				'condition' => [
					'selected_icon[value]!' => ''
				],
			]
		);
        	
        $this->add_control(//Dismiss icon label
            'dismiss-icon-label ',
            ['label' => esc_html__( 'Dismiss icon', 'wts-eae' ),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before ',
            ]
        );
		$this->add_control(//Dismiss icon
			'dismiss-icon',
			[
				'label' => esc_html__( 'Icon', 'wts-eae' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-times-circle',
					'library' => 'fa-solid',
				],
				
			]
		);
		$this->add_responsive_control(//dismiss icon vertical position
			'dismiss_icon_vertical_position',
			[
				'label' => esc_html__( 'Vertical Position', 'wts-eae' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'%' =>[
						'min'=>0,
						'max'=>100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'size_units' => [ '%', 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .eae-alert-dismiss' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(//Dismiss icon horizontal position
			'dismiss_icon_horizontal_position',
			[
				'label' => esc_html__( 'Horizontal Position',  'wts-eae' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'%' =>[
						'min' => 0,
						'max' =>100,
						'default' => 0,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'size_units' => [ '%', 'px' ],
				'selectors' => [
					'{{WRAPPER}} .eae-alert-dismiss' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);  
		$this->add_responsive_control(//action layout
			'button-layout',
			[
				'label' => esc_html__( 'Action Layout',  'wts-eae'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'row' => [
						'title' => esc_html__( 'Right',   'wts-eae' ),
						'icon' => ' eicon-h-align-right',
					],
					'column' => [
						'title' => esc_html__( 'Bottom',  'wts-eae' ),
						'icon' => 'eicon-v-align-bottom',
					],
			
				],
				'default' => '',
				'separator'=> 'before',   
				'selectors' => [
					'{{WRAPPER}} .eae-alert-content ' => 'flex-direction: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
        

        //style part...................

        $this->start_controls_section(//style part section of heading
			'alert-box-label',
			[
                'label'=>esc_html__('Alert Box','wts-eae'),
				'tab'   => Controls_Manager::TAB_STYLE,
		
			]
		);
        $this->add_control(//alert box style background color
			'alert-box-color',
			[
				'label' => esc_html__( 'Background Color', 'wts-eae'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eae-alert-box' => 'background-color: {{VALUE}};',
				],
				
			]
		);
        $this->add_responsive_control(//contain space
			'contain_bottom_space',
			[
				'label' => esc_html__( 'Spacing',  'wts-eae' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eae-alert-box ' => 'gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .eae-alert-text ' => 'gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .eae-alert-content ' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(//alert box padding
			'alert-box-padding',
			[
				'label' => esc_html__( 'Padding', 'wts-eae' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eae-alert-box ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .eae-alert-dismiss ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(//alert box border
			Group_Control_Border::get_type(),
			[
				'name' => 'alert_box_border',
				'selector' => '{{WRAPPER}} .eae-alert-box',
				'separator' => 'before',
				
			]
		);
		$this->add_control(//alert box radius
			'alert_box_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wts-eae' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .eae-alert-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				
			]
		);
		$this->add_group_control(//alert box shadow
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'alert_box_shadow',
				'selector' => '{{WRAPPER}} .eae-alert-box',
				
			]
		);
       $this->end_controls_section();   
    


        $this->start_controls_section(//style part section of heading
			'content_heading',
			[
                'label'=>esc_html__('Content','wts-eae'),
				'tab'   => Controls_Manager::TAB_STYLE,
		
			]
		);
        //heading.............
        $this->add_control(//heading label
            'heading-label',[
                'label'=>esc_html__('Heading','wts-eae'),
                'type' =>Controls_Manager::HEADING,
            ]
        );
		$this->add_control(//heading style color
			'heading_color',
			[
				'label' => esc_html__( 'Color', 'wts-eae'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eae-alert-text h3' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->add_group_control(//heading style typography
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'selector' => '{{WRAPPER}} .column, 
				{{WRAPPER}} .eae-alert-text h3',
				
			]
		);
		$this->add_group_control(//heading shadow
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .eae-alert-text h3',
			]
		);
		$this->add_responsive_control(//alert box padding
			'alert-heading-padding',
			[
				'label' => esc_html__( 'Padding', 'wts-eae' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eae-alert-text h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
			]
		);
        //description .............
		$this->add_control(//give lable name for  description
			'description_style',
			[
				'label' => esc_html__( 'Description',  'wts-eae' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(// description style color
			'description_color',
			[
				'label' => esc_html__( 'Color',  'wts-eae' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eae-alert-text p' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->add_group_control(// description style typography
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .column, 
				{{WRAPPER}} .eae-alert-text p',
				
			]
		);
		$this->end_controls_section();

		//icon...............
        $this->start_controls_section(//style part section of heading
			'icon-label',
			[
                'label'=>esc_html__('Icon Box','wts-eae'),
				'tab'   => Controls_Manager::TAB_STYLE,
		
			]
		);
        $this->add_control(//icon label
            'icon-heading',[
                'label'=>esc_html__('Icon','wts-eae'),
                'type'=>Controls_Manager::HEADING,
            ]

        );
        $this->add_control(// icon style color
			'icon_color',
			[
				'label' => esc_html__( 'Color',  'wts-eae' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eae-alert-icon i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'view' => 'default',
					
				],
				
			]
		);
		$this->add_control(//primary_color
			'primary_color',
			[
				'label' => esc_html__( 'Primary Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.wts-eae-icon-view-stacked .eae-alert-icon i' => 'background: {{VALUE}};',
					'{{WRAPPER}}.wts-eae-icon-view-framed .eae-alert-icon i' => 'color: {{VALUE}}; border-color: {{VALUE}};',
						],

			]
		);
		$this->add_control(//secondary color
			'secondary_color',
			[
				'label' => esc_html__( 'Secondary Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.wts-eae-icon-view-framed .eae-alert-icon i ' => 'background: {{VALUE}};',
					'{{WRAPPER}}.wts-eae-icon-view-stacked .eae-alert-icon i ' => 'color: {{VALUE}};',

					],
			]
		);
		$this->add_responsive_control(//icon alignment
			'icon_align',
			[
				'label' => esc_html__( 'Alignment',  'wts-eae'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Left',   'wts-eae' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center',  'wts-eae' ),
						'icon' => 'eicon-text-align-center',
					],
					'flex-end' => [
						'title' => esc_html__( 'Right',  'wts-eae'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => '',
				'condition' => [
					'position' => 'top'
				],
				'selectors' => [
					'{{WRAPPER}} .eae-alert-icon' => 'justify-content: {{VALUE}};',
                    
				],
			]
		);
		$this->add_responsive_control(//icon padding
			'icon_padding',
			[
				'label' => esc_html__( 'Padding', 'wts-eae' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eae-alert-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(//button spacing
			'icon-content-space',
			[
				'label' => esc_html__( 'Spacing',  'wts-eae' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eae-alert-box ' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(//alert box border
			Group_Control_Border::get_type(),
			[
				'name'           => 'icon',
				'fields_options' => [
					'border' => [
						'default' => ' ',
					],
				],
				'selector' => '{{WRAPPER}} .eae-alert-icon i',
			]
		);
	
		$this->add_control(//icon border redius
			'icon_radius',
			[
				'label'      => __( 'Border Radius', 'wts-eae' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .eae-alert-icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
			]
		);
        $this->add_group_control(//alert box shadow
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_shadow',
				'selector' => '{{WRAPPER}} .eae-alert-icon i',

			]
		);

        $this->end_controls_section();

        //dismiss icon.......
        $this->start_controls_section(//style part section of dismiss icon
			'dismiss_icon-tab',
			[
                'label'=>esc_html__('Dismiss Icon','wts-eae'),
				'tab'   => Controls_Manager::TAB_STYLE,
		
			]
		);
	
		$this->add_responsive_control(//dismiss box padding
			'dismiss_icon_padding',
			[
				'label' => esc_html__( 'Padding', 'wts-eae' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eae-alert-dismiss ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(//dismiss icon border
			Group_Control_Border::get_type(),
			[
				'name' => 'dismiss_icon_border',
				'selector' => '{{WRAPPER}} .eae-alert-dismiss',
				'separator' => 'before',
				]
			
		);
		
		$this->add_control(//dismiss icon border radius
			'dismiss_icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wts-eae' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .eae-alert-dismiss' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'dismiss_button_box_shadow',
				'selector' => '{{WRAPPER}} .eae-alert-dismiss',
				
			]
		);
		$this->add_control(// icon style color
			'dismiss-icon-color',
			[
				'label' => esc_html__( 'Color',  'wts-eae' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eae-alert-dismiss ' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->end_controls_section();

       //button ................

        $this->start_controls_section(//action label
            'action',
            [
                'label'=>esc_html__('Action','wts-eae'),
			]
        );
        $repeater = new Repeater();

		$repeater->start_controls_tabs( 
			'alert_button_tabs' 
		);
		$repeater->start_controls_tab(//button content tab
			'content',[
				'label' => esc_html__( 'Content', 'wts-eae' ) 
			  ] 
		);
		$repeater->add_control(//button text area
			'text',
			[
				'label' => esc_html__( 'Text', 'wts-eae'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'List Item', 'wts-eae' ),
				'default' => esc_html__( 'List Item', 'wts-eae' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(//insert icon
			'button_selected_icon',
			[
				'label' => esc_html__( 'Icon', 'wts-eae' ),
				'type' => Controls_Manager::ICONS,
			]
		);
		$repeater->add_control(//submit action
			'submit_action',
			[
				'label' => esc_html__( 'Submit Action', 'wts-eae' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => [
					'redirect'  => esc_html__( 'Redirect', 'wts-eae' ),
					'defer' => esc_html__( 'Defer', 'wts-eae' ),
				],
				'default' => 'redirect',
					
			]
		);
		$repeater->add_control(//button Redirect
			'link',
			[
				'label' => esc_html__( 'Redirect', 'wts-eae' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => '#'
				],
				'condition' => [
					'submit_action' => 'redirect',
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'wts-eae'),
				
				]
		);
		$repeater->add_control(//Expire time
			'button_defer',[
				'label' => esc_html__( 'Expire Time', 'wts-eae' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'submit_action' => 'defer',
				],
			],
		);
        $repeater->add_control(//button icon alignment
			'button_icon_align',
			[
				'label'   => __( 'Icon Position', 'wts-eae' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'before',
				'options' => [
					'before' => __( 'Before', 'wts-eae' ),
					'after'  => __( 'After', 'wts-eae' ),
				],
				]
		);
		$repeater->add_control(//button icon spacing
			'button_icon_spacing',
			[
				'label'     => __( 'Icon Spacing', 'wts-eae' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eae-alert-action {{CURRENT_ITEM}}' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater->end_controls_tab();


		$repeater->start_controls_tab( //button style tab
			'button_style_tab',
			[
				 'label' => esc_html__( 'Style', 'wts-eae' ),
			]
	 	);
		$repeater->add_responsive_control(//button padding
			'button-padding',
			[
				'label' => esc_html__( 'Padding', 'wts-eae' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}'=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$repeater->add_group_control(//button border
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} ',
				'separator' => 'before',
				
			]
		);
		$repeater->add_control(//button radius
			'button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wts-eae' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				
			]
		);
		$repeater->add_group_control(//button background 
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Background','wts-eae' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
				
			
			]
		);
		$repeater->add_control(//button content color
			'content_color',
			[
				'label' => esc_html__( 'Content Color', 'wts-eae' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
				],
				
			]
		);
		$repeater->add_group_control(//button text style typography
					Group_Control_Typography::get_type(),
					[
						'name' => 'button_typography',
						'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}'
						
					]
		);
		$repeater->end_controls_tab();
	

		$repeater->start_controls_tab( //hover tab
			'button_hover_tab',
			[
				 'label' => esc_html__( 'Hover', 'wts-eae' ),
			]
	 	);
		$repeater->add_control(//hover content color
			'hover_color',
			[
				'label' => esc_html__( 'Text Color', 'wts-eae' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover, {{WRAPPER}}  {{CURRENT_ITEM}}:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover svg, {{WRAPPER}} {{CURRENT_ITEM}}:focus svg' => 'fill: {{VALUE}};',
				],
			
			]
		);
		$repeater->add_control(
			'button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'wts-eae' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'button_border_border!' => '',
				],
			]
		);
		$repeater->add_group_control(//background color
			Group_Control_Background::get_type(),
			[
				'name' => 'button_background_hover',
				'label' => esc_html__( 'Background', 'wts-eae' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}:hover, {{WRAPPER}} {{CURRENT_ITEM}}:focus',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
				],
			
			]
		);
		$repeater->add_control(//hover animation
			'hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'wts-eae' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			
			]
		);
		$this->add_control(//button list
			'button_list',
			[
				'label' => esc_html__( 'Buttons', 'wts-eae'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'text' => esc_html__( 'Click Here', 'wts-eae' ),
						'button_selected_icon' => [
							'value' => 'fas fa-arrow-right',
							'library' => 'fa-solid',
						],
					],
				
				],
				'title_field' => '{{{ elementor.helpers.renderIcon( this, button_selected_icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}} {{{ text }}}',
			]
	  	);
		$this->add_responsive_control(//button layout 
			'button-layout-align',
			[
				'label' => esc_html__( 'Button Layout',  'wts-eae'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'row' => [
						'title' => esc_html__( 'Inline',   'wts-eae' ),
						'icon' => 'eicon-navigation-horizontal',
					],
					'column' => [
						'title' => esc_html__( 'List',  'wts-eae' ),
						'icon' => ' eicon-editor-list-ul',
					],
					
				],
				'default' => '',
				'condition'=>[
					'button-layout'=>'column',
				],
				'selectors' => [
					'{{WRAPPER}} .eae-alert-action ' => 'flex-direction: {{VALUE}};',
					
				],
			]
		);
		$this->add_responsive_control(//button inline alignment
		'button-row-align',
		[
			'label' => esc_html__( 'Alignment',  'wts-eae'),
			'type' => Controls_Manager::CHOOSE,
			'options' => [
				'flex-start' => [
					'title' => esc_html__( 'Left',   'wts-eae' ),
					'icon' => 'eicon-text-align-left',
				],
				'center' => [
					'title' => esc_html__( 'Center',  'wts-eae' ),
					'icon' => 'eicon-text-align-center',
				],
				'flex-end' => [
					'title' => esc_html__( 'Right',  'wts-eae'),
					'icon' => 'eicon-text-align-right',
				],
			],
			'default' => '',
			'condition' => [
				'button-layout-align' => 'row',
			],
			'selectors' => [
				'{{WRAPPER}} .eae-alert-action ' => 'justify-content: {{VALUE}};',
			],
		]
		);
		$this->add_responsive_control(//button list alignment
			'button-column-align',
			[
			'label' => esc_html__( 'Alignment',  'wts-eae'),
			'type' => Controls_Manager::CHOOSE,
			'options' => [
				'flex-start' => [
					'title' => esc_html__( 'Left',   'wts-eae' ),
					'icon' => 'eicon-text-align-left',
				],
				'center' => [
					'title' => esc_html__( 'Center',  'wts-eae' ),
					'icon' => 'eicon-text-align-center',
				],
				'flex-end' => [
					'title' => esc_html__( 'Right',  'wts-eae'),
					'icon' => 'eicon-text-align-right',
				],
			],
			'default' => '',
			'condition' => [
				'button-layout-align' => 'column',
			],
			'selectors' => [
				'{{WRAPPER}} .eae-alert-action ' => 'align-items: {{VALUE}};',
			],
				]
		);
		$this->add_control(//button width
		'button-width',
		[
			'label'=>esc_html__('Button Width', 'wts-eae'),
			'type'=>Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
			'condition'=>[
				'button-layout-align'=>'column',
			],
			'selectors'=>[
				'{{WRAPPER}} .eae-alert-action a '=> 'width:{{SIZE}}{{UNIT}};',
			],
		]
		);
        $this->add_responsive_control(//button spacing
			'title_bottom_space',
			[
				'label' => esc_html__( 'Spacing',  'wts-eae' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eae-alert-action ' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(//button spacing
			'button-content-spacing',
			[
				'label' => esc_html__( 'Heading & Button Spacing',  'wts-eae' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eae-alert-content' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);


		
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();
		$this->end_controls_section();
    
    }








    protected function render(){
        $settings = $this->get_settings_for_display();
		
		$this->add_render_attribute( 'wrapper', 'class', 'eae-alert-box' );
		$this->add_render_attribute('wrapper', 'role', 'alert');
		$icon = empty( $settings['selected_icon'] );
		$this->add_render_attribute( 'button_list', 'class', 'eae-alert-dismiss' );
		?>

		
            
<div <?php $this->print_render_attribute_string( 'wrapper' ); ?> >
	<?php if(  $settings['graphic_element'] !='none')  { ?>
		<div class="eae-alert-icon"><?php 
			if ( 'image' === $settings['graphic_element'] && ! empty( $settings['image']['url'] ) ) 
				{ ?>
					<?php Group_Control_Image_Size::print_attachment_image_html( $settings ); ?>
				<?php }
			elseif ( 'icon' === $settings['graphic_element'] && !$icon )
					{ ?>
					 <?php Icons_Manager::render_icon( $settings['selected_icon'] );?> 
				<?php }?>
					
        </div>
	 <?php } ?>

        <div class="eae-alert-content">
			<div class="eae-alert-text"><?php 	
				if(!empty($settings['heading'])){ ?>
					<h3><?php   
						$this->print_unescaped_setting( 'heading' );?> 
					</h3><?}?><?php
				 if(!empty($settings['description'])){ ?>
					<p><?php
						$this->print_unescaped_setting( 'description' );?>
						</p><?}?>
            </div><?php
         		$this->render_actions($settings); ?>
        </div><?php 
			if(!empty($settings['dismiss-icon']['value']))
					{?>
                		<div class="eae-alert-dismiss">
						 <?php Icons_Manager::render_icon( $settings['dismiss-icon'] );?>	      
              			</div><?php
			 		}?>
</div><?php
?><?php
}

	function render_actions($settings){
		$buttons = $settings['button_list'];
		if ( empty($settings['button_list']) ) 
			{
			return;
			}?> 
		
		<div class="eae-alert-action"><?php	
			foreach($buttons as $index => $button)
				{
					// echo "<pre>"; print_r($button['link']); echo "</pre>";
		
					//echo "<pre>"; print_r($button); echo "</pre>";
					$link_key = 'button' . $index;
					$this->add_render_attribute( $link_key, 'class', 'eae-button-icon-pos-'.$button['button_icon_align'] );//button icon position
					$this->add_render_attribute($link_key,'class','elementor-repeater-item-' . $button['_id']);	
					if(!empty($button['link'])){
						$this->add_link_attributes( $link_key, $button['link'] );	
						}
					$this->add_render_attribute($link_key,'actions',$button['submit_action']);
					if(!empty($button['button_defer'])){
					$this->add_render_attribute($link_key,'defer',$button['button_defer']);
					}
					
					if ( $button['hover_animation'] )
						{
						$this->add_render_attribute($link_key,'class','elementor-animation-' . $button['hover_animation']);	
						}?>
			
			
					<a <?php $this->print_render_attribute_string( $link_key ); 
					 ?>>
						<?php $this->print_unescaped_setting( 'text', 'button_list', $index ); 
						if( ! empty( $button['button_selected_icon']['value'] )){
							Icons_Manager::render_icon( $button['button_selected_icon'], [ 'aria-hidden' => 'true' ] );
							}
						?>
					</a><?php 		
				}?>
		</div><?php
	    	
  }
}
