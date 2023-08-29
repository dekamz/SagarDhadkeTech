<?php 

namespace WTS_EAE\Modules\AdvanceButton\Widgets;

use WTS_EAE\Base\EAE_Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class AdvanceButton extends EAE_Widget_Base {

    public function get_name() {
		return 'eae-advance-button';
	}

	public function get_title() {
		return __( 'EAE - Advanced Button', 'wts-eae' );
	}

	public function get_icon() {
		return 'eae-icons eae-dual-button';
	}
    
    protected function register_controls()
    {

        $this->start_controls_section(//advance button label
            'advance button',
            [
                'label'=>esc_html__('Advance Button','wts-eae'),
            ]            
        );
        $this->add_responsive_control(//action layout
			'button-layout',
			[
				'label' => esc_html__( 'Layout',  'wts-eae'),
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
				'default' => 'column', 
                'separator'=>'after',
				'selectors_dictionary' => [
					'row' => '--eae-ab-dir:row; --eae-ab-sep-row:block; --eae-ab-sep-col:none',
					'column' => '--eae-ab-dir:column; --eae-ab-sep-row:none; --eae-ab-sep-col:block',
				],
				'selectors' => [
					'{{WRAPPER}}' => '{{VALUE}}',	
				],
				'toggle' => false
			]
		);
        $this->add_control(//label name of content
            'content',
            [
                'label' => esc_html__( 'Content', 'wts-eae' ),
                'type' => Controls_Manager::HEADING,  
            ]
        );
      
        $this->add_control(//button title
            'title',[
				'label' => esc_html__( 'Title', 'wts-eae' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter your title', 'wts-eae' ),
				'default' => esc_html__( 'WATCH VIDEO', 'wts-eae'),
			
			]
        );
        $this->add_control(//button  description
            'description',
            [
                'label'=>esc_html__('Description','wts-eae'),
                'type'=>Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Description Here', 'wts-eae' ),
				'default' => esc_html__( 'FOLLOW THE STEP BY STEP GUIDE', 'wts-eae'),
			]
        );
        $this->add_control(//link
			'link',
			[
				'label' => esc_html__( 'Link', 'wts-eae' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'wts-eae' ),
				'default' => [
					'url' => '#',
				],
			]
		);


        $this->add_control(//icon lable
            'icon',[
                'label'=>esc_html__('Icon','wts-eae'),
                'type'=>Controls_Manager::HEADING,  
            ]
        );
        $this->add_control(//icon
			'selected_icon',
			[
				'label' => esc_html__( 'Icon', 'wts-eae' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-play-circle',
					'library' => 'fa-solid',
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
				'prefix_class' => 'wts-eae-advance-button-icon-view-',
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
				'prefix_class' => 'wts-eae-advance-button-icon-shape-',
			]
		);
		$this->add_responsive_control(//icon position
				'button_icon_align',
				[
					'label'   => __( 'Icon Position', 'wts-eae' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'before',
					'options' => [
						'before' => __( 'Before', 'wts-eae' ),
						'after'  => __( 'After', 'wts-eae' ),
					],
					'prefix_class' =>'icon-align-',
					]
		);


        $this->add_control(//give lable name for  separator
			'advance-button-separator',
			[
				'label' => esc_html__( 'Separator',  'wts-eae' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(//separator show or not
			'show_separator',
			[
				'label' => esc_html__( 'Show Separator', 'wts-eae' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
			
		);
        $this->add_responsive_control(//separator type
			'separator-border-type',
			[
				'label' => esc_html__( 'Type', 'wts-eae' ),
				'type' => Controls_Manager::SELECT,
                'options' => [
					'solid' => esc_html__( 'Solid', 'wts-eae' ),
					'double' => esc_html__( 'Double', 'wts-eae' ),
					'dotted' => esc_html__( 'Dotted', 'wts-eae' ),
					'dashed' => esc_html__( 'Dashed', 'wts-eae' ),
				],
                'default' => 'solid',
                'selectors' => [
					'{{WRAPPER}} .eae-button .eae-advance-button-separator-col' => 'border-top-style:{{VALUE}};',
					'{{WRAPPER}} .eae-button .eae-advance-button-separator-row' => 'border-right-style:{{VALUE}};',
				],
				'condition' => [
					'show_separator' => 'yes',
				]
            ]
		);
        
        $this->add_responsive_control(//separator width
			'separator-size',
			[
				'label' => esc_html__( 'Size', 'wts-eae' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 100,
					'unit' => '%',
				],
				'selectors' => [
                    '{{WRAPPER}} .eae-advance-button-separator-col' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .eae-advance-button-separator-row' => 'height: {{SIZE}}{{UNIT}};',
						],
				'condition' => [
					'show_separator' => 'yes',
				],
			]
		);
    
		$this->add_responsive_control(//separator alignment
			'align',
			[
				'label' => esc_html__( 'Alignment', 'wts-eae' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'self-start' => [
						'title' => esc_html__( 'Left', 'wts-eae' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'wts-eae' ),
						'icon' => 'eicon-text-align-center',
					],
					'self-end' => [
						'title' => esc_html__( 'Right', 'wts-eae' ),
						'icon' => 'eicon-text-align-right',
					],
				],
                'condition'=>[
                    'button-layout'=>'column',
						'show_separator' => 'yes'
					
            ],
				'selectors' => [
					'{{WRAPPER}} .eae-advance-button-separator-col' => 'align-self: {{VALUE}}',
					'{{WRAPPER}} .eae-advance-button-separator-row' => 'align-self: {{VALUE}}',
					],
			]
		);

        $this->end_controls_section();


        $this->start_controls_section(//style part section of heading
			'advance-button-style',
			[
                'label'=>esc_html__('General','wts-eae'),
				'tab'   => Controls_Manager::TAB_STYLE,
		
			]
		);
        $this->start_controls_tabs(// start tab
			'style_tabs'
		);

		$this->start_controls_tab(//normal tab
			'style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'wts-eae' ),
			]
		);
        $this->add_group_control(//button background 
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Background','wts-eae' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
					'color' => [
						'global' => [
							'default' => Global_Colors::COLOR_PRIMARY,
						],
					],
				],
				'selector' => '{{WRAPPER}} .eae-button',
				
			
			]
		);
		$this->add_group_control(//advance button border
			Group_Control_Border::get_type(),
			[
				'name' => 'advance-button_border',
				'selector' => '{{WRAPPER}} .eae-button',
					
			]
		);
	
        $this->end_controls_tab();

        $this->start_controls_tab(//hover tab
			'style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'wts-eae' ),
			]
		);
        $this->add_group_control(//button background 
			Group_Control_Background::get_type(),
			[
				'name' => 'background_hover',
				'label' => esc_html__( 'Background','wts-eae' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .eae-button:hover, {{WRAPPER}} .eae-button:focus',
				
			]
		);
		$this->add_group_control(//advance button border
			Group_Control_Border::get_type(),
			[
				'name' => 'advance-hover-button-border',
				'selector' => '{{WRAPPER}} .eae-button:hover',
					
			]
		);
		
        $this->end_controls_tab();
        $this->end_controls_tabs();
		$this->add_control(//hover animation
			'hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'wts-eae' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			'separator'=>'before',
			]
		);
		$this->add_responsive_control(//advance button padding
			'advance-button-padding',
			[
				'label' => esc_html__( 'Padding', 'wts-eae' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eae-button ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
			]
		);
		$this->add_control(//advance button radius
			'advance-button_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wts-eae' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .eae-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				
			]
		);
		$this->add_responsive_control(//separator spacing
			'advance-separator-space',
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
					'{{WRAPPER}} .eae-button ' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(//advance button shadow
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'advance-button_shadow',
				'selector' => '{{WRAPPER}} .eae-button',
				
			]
		);
        $this->end_controls_section(); 
       
       
        $this->start_controls_section(//style part section of content
			'advance-button-content',
			[
                'label'=>esc_html__('Content','wts-eae'),
				'tab'   => Controls_Manager::TAB_STYLE,
		
			]
		);
		$this->start_controls_tabs(// start tab
			'style_content_tabs'
		);
		$this->start_controls_tab(//normal tab
			'style_content_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'wts-eae' ),
			]
		);
		$this->add_control(//heading style color
				'heading_color',
				[
					'label' => esc_html__( 'Title Color', 'wts-eae'),
					'type' => Controls_Manager::COLOR,
					'global'    => [
						'default' => Global_Colors::COLOR_SECONDARY,
					],
					'selectors' => [
						'{{WRAPPER}} .eae-advance-button-title ' => 'color: {{VALUE}};',
					],
					
				]
			);
			$this->add_control(// description style color
				'description_color',
				[
					'label' => esc_html__( 'Description Color',  'wts-eae' ),
					'type' => Controls_Manager::COLOR,
					'global'    => [
						'default' => Global_Colors::COLOR_SECONDARY,
					],
					'selectors' => [
						'{{WRAPPER}} .eae-advance-button-description' => 'color: {{VALUE}};',
					],
					
				]
			);
        $this->end_controls_tab();

        $this->start_controls_tab(//hover tab
			'style_content_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'wts-eae' ),
			]
		);  
		$this->add_control(//heading style color
				'heading-hover-color',
				[
					'label' => esc_html__( 'Title Color', 'wts-eae'),
					'type' => Controls_Manager::COLOR,
					
					'selectors' => [
						'{{WRAPPER}} .eae-button:hover .eae-advance-button-title ' => 'color: {{VALUE}};',
					],
					
				]
		);$this->add_control(//description style color
			'description-hover-color',
			[
				'label' => esc_html__( 'Description Color', 'wts-eae'),
				'type' => Controls_Manager::COLOR,
				
				'selectors' => [
				'{{WRAPPER}} .eae-button:hover .eae-advance-button-description' => 'color: {{VALUE}};',
					
				],
			]
		);
	
        $this->end_controls_tab();

        $this->end_controls_tabs();
		$this->add_control(//give lable name for title
			'title_style',
			[
				'label' => esc_html__( 'Title',  'wts-eae' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(//heading padding
			'advance-heading-padding',
			[
				'label' => esc_html__( 'Padding', 'wts-eae' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eae-advance-button-title ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
			]
		);
		$this->add_group_control(//heading style typography
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'selector' => '{{WRAPPER}} .column, 
				{{WRAPPER}} .eae-advance-button-title',
				
			]
		);
		$this->add_group_control(//heading shadow
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .eae-advance-button-title',
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
	
		$this->add_group_control(// description style typography
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .column, 
				{{WRAPPER}} .eae-advance-button-description',
				
			]
		);
        $this->add_responsive_control(//description alignment
			'description_align',
			[
				'label' => esc_html__( 'Alignment', 'wts-eae' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Left', 'wts-eae' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'wts-eae' ),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__( 'Right', 'wts-eae' ),
						'icon' => 'eicon-text-align-right',
					],
				],
                'condition'=>[
                    'button-layout'=>'column',

                ],
				'selectors' => [
					'{{WRAPPER}} .eae-advance-button-description' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} .eae-advance-button-title' => 'text-align: {{VALUE}}',
						
				],
			]
		);
		
		$this->end_controls_section();

        $this->start_controls_section(//style part section of heading
			'icon-label',
			[
                'label'=>esc_html__('Icon','wts-eae'),
				'tab'   => Controls_Manager::TAB_STYLE,
		
			]
		);
		$this->start_controls_tabs(// start tab
			'style_icon_tabs'
		);
		$this->start_controls_tab(//normal tab
			'style_icon_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'wts-eae' ),
			]
		);
		
		$this->add_control(// icon style color
			'icon_color',
			[
				'label' => esc_html__( 'Color',  'wts-eae' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eae-advance-button-title i' => 'color: {{VALUE}};',
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
					'{{WRAPPER}}.wts-eae-advance-button-icon-view-stacked .eae-advance-button-title i:before' => 'background: {{VALUE}};',
					'{{WRAPPER}}.wts-eae-advance-button-icon-view-framed .eae-advance-button-title i:before' => 'color: {{VALUE}}; border-color: {{VALUE}};',
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
					'{{WRAPPER}}.wts-eae-advance-button-icon-view-framed  .eae-advance-button-title i:before' => 'background: {{VALUE}};',
					'{{WRAPPER}}.wts-eae-advance-button-icon-view-stacked .eae-advance-button-title i:before' => 'color: {{VALUE}};',

					],
			]
		);
    
        $this->end_controls_tab();

        $this->start_controls_tab(//hover tab
			'style_icon_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'wts-eae' ),
			]
		);  
		
			$this->add_control(// icon style color
				'icon-hover-color',
				[
					'label' => esc_html__( 'Hover Color',  'wts-eae' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .eae-button:hover .eae-advance-button-title i' => 'color: {{VALUE}};',
					],
					'condition' => [
						'view' => 'default',
						
					],
					
				]
			);
			$this->add_control(//primary_color
				'primary_hover_color',
				[
					'label' => esc_html__( 'Primary Hover Color', 'elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'condition' => [
						'view!' => 'default',
					],
					'selectors' => [
						'{{WRAPPER}} .eae-button:hover .eae-advance-button-title i:before' => 'background: {{VALUE}};',
							],
	
				]
			);
			$this->add_control(//secondary color
				'secondary_hover_color',
				[
					'label' => esc_html__( 'Secondary Hover Color', 'elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'condition' => [
						'view!' => 'default',
					],
					'selectors' => [
						'{{WRAPPER}} .eae-button:hover .eae-advance-button-title i:before' => 'color: {{VALUE}};',
	
						],
				]
			);
	
        $this->end_controls_tab();

        $this->end_controls_tabs();
   
		$this->add_responsive_control(//icon padding
			'icon_padding',
			[
				'label' => esc_html__( 'Padding', 'wts-eae' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eae-advance-button-title i:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'=>'before',
				
			]
		);
		$this->add_responsive_control(//icon size
			'advance_icon_size',
			[
				'label' => esc_html__( 'Size', 'wts-eae' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eae-advance-button-title i:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				
			]
		);
		
		$this->add_responsive_control(//icon spacing
			'icon-content-space',
			[
				'label' => esc_html__( 'Spacing',  'wts-eae' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 5
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eae-advance-button-title ' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(//icon border
			Group_Control_Border::get_type(),
			[
				'name'           => 'icon_border',
				'fields_options' => [
					'border' => [
						'default' => ' ',
					],
				],
				'selector' => '{{WRAPPER}} .eae-advance-button-title ::before',
			]
		);
	
		$this->add_control(//icon border redius
			'icon_radius',
			[
				'label'      => __( 'Border Radius', 'wts-eae' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .eae-advance-button-title i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(//style separator
			'separator-label',
			[
                'label'=>esc_html__('Separator','wts-eae'),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_separator' => 'yes',
				]
			]
		);
	
		
		$this->add_control(// separator style color
			'advance-separator_color',
			[
				'label' => esc_html__( 'Color',  'wts-eae' ),
				'type' => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eae-advance-button-separator-col' => 'color: {{VALUE}};',
					'{{WRAPPER}} .eae-advance-button-separator-row' => 'color: {{VALUE}};',
					],
			]
		);
		$this->add_control(//separator style hover color
				'separator-hover-color',
				[
					'label' => esc_html__( 'Hover Color', 'wts-eae'),
					'type' => Controls_Manager::COLOR,
					
					'selectors' => [
						'{{WRAPPER}} .eae-button:hover .eae-advance-button-separator-col' => 'color: {{VALUE}};',
					'{{WRAPPER}} .eae-button:hover .eae-advance-button-separator-row' => 'color: {{VALUE}};',
					],
					
				]
		);
		$this->add_control(//separator weight
			'weight',
			[
				'label' => esc_html__( 'Weight', 'wts-eae' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 10,
						'step' => 0.1,
					],
				],
				'selectors' => [
					
					'{{WRAPPER}} .eae-advance-button-separator-col' => 'border-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .eae-advance-button-separator-row' => 'border-width: {{SIZE}}{{UNIT}}',
				
				],
			]
		);
     
        $this->end_controls_section();

    }
protected function render()
    { 
		  $settings = $this->get_settings_for_display();
            $this->add_render_attribute('wrapper', 'class', ' eae-button');
			// echo $settings['separator-border-type'];
      
      if ( !empty( $settings['hover_animation'] ) ) {
        $this->add_render_attribute('wrapper', 'class', ' eae-button elementor-animation-' . $settings['hover_animation'] );
         }
         if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'wrapper', $settings['link'] );
		}
        
		$this->add_render_attribute('description', 'class', 'eae-advance-button-description');
		$this->add_inline_editing_attributes( 'description' );

		$this->add_render_attribute('title-wrapper', 'class', 'eae-advance-button-title');
		

		$this->add_render_attribute('title', 'class', 'eae-button-title-text');
		$this->add_inline_editing_attributes( 'title' );
         ?>


    <div class="eae-advance-button">
        <a  <?php $this->print_render_attribute_string('wrapper');  ?>> 
         <span <?php $this->print_render_attribute_string('title-wrapper'); ?>>
                <?php Icons_Manager::render_icon( $settings['selected_icon'] );
                if(!empty($settings['title'])) { 
			      ?>
				  <span <?php $this->print_render_attribute_string('title'); ?> >
					<?php $this->print_unescaped_setting('title');  ?>
				  </span> 				
				  
				<?php } ?>
            </span>
					<?php if(!empty($settings['separator-border-type'])) {?>
            <span class="eae-advance-button-separator-row"></span>
			<span class="eae-advance-button-separator-col"></span> 
			<?php } ?>
            <span <?php $this->print_render_attribute_string('description'); ?>>
                 <?php 
                    if(!empty($settings['description'])){ ?>
					    <?php
						    $this->print_unescaped_setting( 'description' );?>
						<?php } ?>
            </span>
        </a>
    </div> <?php
    }
}