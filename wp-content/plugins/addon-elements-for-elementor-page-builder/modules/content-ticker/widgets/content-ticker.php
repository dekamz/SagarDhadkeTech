<?php
namespace WTS_EAE\Modules\ContentTicker\Widgets;


use WTS_EAE\Base\EAE_Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Background;




if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class ContentTicker extends EAE_Widget_Base{

    public function get_name() {
		return 'wts-content-ticker';
	}
    public function get_title() {
		return __( 'EAE - Content Ticker', 'wts-eae' );
	}

	public function get_icon() {
		return 'eicon-code-highlight';
	}

	public function get_categories() {
		return [ 'wts-eae' ];
	}

    protected function register_controls() {

    // For controls 

        $this->contentHeadingControls();

        $this->sliderOptions();

        //  For Styling 

        $this->headingStyle();

        $this->sliderStyle();

        $this->navigationStyle();

        $this->boxStyle();

    }
    function contentHeadingControls(){
        $this->start_controls_section(
            'section_heading',
            [
                'label' => __( 'Content', 'wts-eae' ),
            ]
        );
        $this->add_control(
            'select_icon',
            [
                'label' => esc_html__( 'Heading Icon', 'wts-eae' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-bolt',
                    'library' => 'fa-solid',
                ],
                
            ]
        );

        $this->add_control(
            'text_heading',
            [
                'label' => esc_html__( 'Heading Text', 'wts-eae' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Trending',	
                'placeholder' => __( 'Trending', 'wts-eae' ),

                
            ]
        );
        
        $this->add_control(
            'icon_position',
            [
                'label'   => esc_html__( 'Icon Position', 'wts-eae' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'before'  => 'Before',
                    'after' => 'After',
                ],
                'default' => 'before',
            ]
        );
        $this->add_control(
            'heading_enable_arrow',
            [
                'label'        => __( 'Enable Arrow', 'wts-eae' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'wts-eae' ),
                'label_off'    => __( 'No', 'wts-eae' ),
                'return_value' => 'yes',

            ]
        );
        $this->add_control(
            'heading_stack_on_mobile',
            [
                'label'        => __( 'Stack On Mobile', 'wts-eae' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'wts-eae' ),
                'label_off'    => __( 'No', 'wts-eae' ),
                'return_value' => 'yes',
                'separator' => 'after',
                'default'   => 'yes'
            ]
        );
        $repeater = new Repeater();

        $repeater->add_control(
            
            'list_content',
            [
                'label' => esc_html__( 'Text', 'wts-eae' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Add List ' , 'wts-eae' ),
                'placeholder'=>("Add Some Text"),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'content_list_link',
            [
                'label'       => esc_html__( 'Link', 'wts-eae' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'wts-eae' ),
                
            ]
        );

        $this->add_control(
            'content_list_add',
            [
                'label' => esc_html__( 'Content List', 'wts-eae' ),
                'type' => Controls_Manager::REPEATER,
                'seperator' => 'before',
                
                
                'fields'      =>  $repeater->get_controls() ,
                'default' => [
                    [
                        'list_content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit','wts-eae' ),
                    ],
                    [
                        
                        'list_content' => esc_html__( 'There are many variations of passages of Lorem Ipsum available,','wts-eae' ),
                    ],
                    [
                        
                        'list_content' => esc_html__( 'Contrary to popular belief, Lorem Ipsum is not simply random text','wts-eae' ),
                    ],
                    [
                        
                        'list_content' => esc_html__( 'It has survived not only five centuries','wts-eae' ),
                    ],
                
                ],
                'title_field' => '{{{ list_content }}}',
                
            ]
        );

        $this->end_controls_section();
    }

    function sliderOptions(){

        $this->start_controls_section(
            'carousel_setting',
            [
                'label' => __( 'Slider Options', 'wts-eae' ),
                'type'  => Controls_Manager::SECTION,
            ]
        );

        $this->add_control(
            'carousel_effect',
            [
                'label'   => esc_html__( 'Effect', 'wts-eae' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'slide'  => 'Slide',
                    'fade' => 'Fade',
                ],
                'default' => 'slide', 
                'separator' => 'after',   
            ]
        );

        $this->add_control(
            'carousel_speed',
            [
                'label'       => __( 'Speed', 'wts-eae' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 1000,
                'description' => __( 'Duration of transition between slides (in ms)', 'wts-eae' ),
                'range'       => [
                    'px' => [
                        'min'  => 500,
                        'max'  => 10000,
                        'step' => 500,
                    ],
                ],
            ]
        );

        $this->add_control(
            'carousel_direction',
            [
                'label'   => esc_html__( 'Direction', 'wts-eae' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'horizontal'  => 'Horizontal',
                    'vertical' => 'Vertical',
                ],
                'default' => 'horizontal',  
                'condition' => [
                    'carousel_effect' => 'slide',
                ],
            ]
        );
        $this->add_control(
            'vertical_height',
            [
                'label'       => __( 'Height', 'wts-eae' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 50,
                'condition' => [
                    'carousel_direction' => 'vertical',
                    'carousel_effect' => 'slide',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eae-content-ticker-wrapper' => 'height: {{SIZE}}px;',
                    '(mobile){{WRAPPER}} .eae-content-ticker-wrapper.eae-slide-vertical .eae-content-ticker-content-wrapper' => 'height: {{SIZE}}px !important;',
                ],
            ]
        );
        

        $this->add_control(
            'carousel_autoplay',
            [
                'label'   => __( 'Autoplay', 'wts-eae' ),
                'type'    => Controls_Manager::SWITCHER,
                'label_on'         => __( 'On', 'wts-eae' ),
                'label_off'        => __( 'Off', 'wts-eae' ),
                'return_value'     => 'yes',
            ]
        );

        $this->add_control(
            'carousel_autoplay_speed',
            [
                'label' => esc_html__( 'Duration', 'wts-eae' ),
                'type' => Controls_Manager::NUMBER,
                'default'     => 500,
                'description' => __( 'Delay between transitions (in ms)', 'wts-eae' ),
                'range'       => [
                    'px' => [
                        'min'  => 300,
                        'max'  => 3000,
                        'step' => 300,
                    ],
                ],
                'condition' => [
                    'carousel_autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'carousel_hover_pause',
            [
                'label'   => __( 'Pause On Hover', 'wts-eae' ),
                'type'    => Controls_Manager::SWITCHER,
                'label_on'         => __( 'ON', 'wts-eae' ),
                'label_off'        => __( 'OFF', 'wts-eae' ),
                'return_value'     => 'true',
                'condition' => [
                    'carousel_autoplay' => 'yes',
                ],
            
            ]
        );

        $this->add_control(
            'carousel_transition_effect',
            [
                'label'   => esc_html__( 'Transition Effect', 'wts-eae' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'linear'      => 'Linear',
                    'ease'        => 'Ease',
                    'ease-in'     => 'Ease-In',
                    'ease-out'    => 'Ease-Out',
                    'ease-in-out' => 'Ease-In-Out',
                ],
                'default' => 'ease-in-out',  
                'condition' => [
                    'carousel_effect' => 'slide',
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-wrapper' => '-webkit-transition-timing-function:{{VALUE}} !important;,
                    transition-timing-function:{{VALUE}} !important;,
                    position: relative; ',
                ],


            ]
        );

        $this->add_control(
            'carousel_loop',
            [
                'label'   => __( 'Loop', 'wts-eae' ),
                'type'    => Controls_Manager::SWITCHER,
                'label_on'         => __( 'ON', 'wts-eae' ),
                'label_off'        => __( 'OFF', 'wts-eae' ),
                'return_value'     => 'yes',         
            ]
        );
        $this->add_control(
            'carousel_Keyboard_Control',
            [
                'label'   => __( 'Keyboard Control', 'wts-eae' ),
                'type'    => Controls_Manager::SWITCHER,
                'label_on'         => __( 'ON', 'wts-eae' ),
                'label_off'        => __( 'OFF', 'wts-eae' ),
                'return_value'     => 'yes',
                'separator' => 'after',  
            
            ]
        );

        $this->add_control(
            'carousel_navigation',
            [
                'label'        => __( 'Navigation', 'wts-eae' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'label_on'     => __( 'Yes', 'wts-eae' ),
                'label_off'    => __( 'No', 'wts-eae' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'navigation_icon_left',
            [
                'label'            => __( 'Icon Prev', 'wts-eae' ),
                'type'             => Controls_Manager::ICONS,
                'default' => [
					'value' => 'fas fa-angle-left',
					'library' => 'fa-solid',
				],
                'condition'        => [
                    'carousel_navigation' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'navigation_icon_right',
            [
                'label'            => __( 'Icon Next', 'wts-eae' ),
                'type'             => Controls_Manager::ICONS,
                'default' => [
					'value' => 'fas fa-angle-right',
					'library' => 'fa-solid',
				],
                'condition'        => [
                    'carousel_navigation' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'carousel_navigation_hide_on_mobile',
            [
                'label'   => __( 'Hide On Mobile', 'wts-eae' ),
                'type'    => Controls_Manager::SWITCHER,
                'label_on'         => __( 'Yes', 'wts-eae' ),
                'label_off'        => __( 'No', 'wts-eae' ),
                'return_value'     => 'true',  
                'condition'        => [
                    'carousel_navigation' => 'yes',
                ], 
            ]
        );

        $this->add_control(
            'carousel_navigation_position',
            [
                'label'   => __( 'Navigation Position', 'wts-eae' ),
                'type'    => Controls_Manager::SWITCHER,
                'label_on'         => __( 'Yes', 'wts-eae' ),
                'label_off'        => __( 'No', 'wts-eae' ),
                'return_value'     => 'yes',  
                'condition'        => [
                    'carousel_navigation' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'carousel_navigation_position_top',
            [
                'label' => esc_html__( 'Top', 'wts-eae' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' =>'%',           
                'selectors' => [
                    '{{WRAPPER}} .eae-navigation-icon-wrapper' => 'Top:{{SIZE}}%;',
                ],
                'condition'        => [
                    'carousel_navigation_position' => 'yes',
                    'carousel_navigation' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'carousel_navigation_position_right',
            [
                'label' => esc_html__( 'Right', 'wts-eae' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => '%',           
                'selectors' => [
                    '{{WRAPPER}} .eae-navigation-icon-wrapper' => 'right:{{SIZE}}%;',
                ],
                'condition'        => [
                    'carousel_navigation_position' => 'yes',
                    'carousel_navigation' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
    }

    function headingStyle(){
   
        $this->start_controls_section(
            'section_heading_style',
            [
                'label' => esc_html__( 'Heading', 'wts-eae' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
    
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_ACCENT,
                ],
                'selector' => '{{WRAPPER}} .eae-content-ticker-heading',
            ]
        );

        $this->add_responsive_control(
            'size_icon',
            [
                'label' => esc_html__( 'Icon Size', 'wts-eae' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eae-content-ticker-heading i  ' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'rotate_heading_icon',
            [
                'label' => esc_html__( 'Rotate', 'wts-eae' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'deg', 'grad', 'rad', 'turn' ],
                'default' => [
                    'unit' => 'deg',
                ],
                'tablet_default' => [
                    'unit' => 'deg',
                ],
                'mobile_default' => [
                    'unit' => 'deg',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eae-content-ticker-heading i, {{WRAPPER}} .eae-content-ticker-heading svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->start_controls_tabs(
            'style_tabs'
        );
        $this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'wts-eae' ),
            ]
        );
        $this->add_control(
            'icon__color',
            [
                'label' => esc_html__( 'Icon Color', 'wts-eae' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eae-content-ticker-heading i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'heading_text_color',
            [
                'label' => esc_html__( 'Text Color', 'wts-eae' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eae-content-ticker-heading' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'heading_arrow_color',
            [
                'label' => esc_html__( 'Arrow Color', 'wts-eae' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eae-heading-arrow .eae-content-ticker-heading::after' => 'border-left-color : {{VALUE}};',
                ],
                'condition' => [
                    'heading_enable_arrow!' => ''
                ],
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'types' => [ 'classic', 'gradient' ],
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .eae-content-ticker-heading',
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
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'wts-eae' ),
            ]
        );

        $this->add_control(
            'icon__color_hover',
            [
                'label' => esc_html__( 'Icon Color', 'wts-eae' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eae-content-ticker-heading i:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'heading_text_color_hover',
            [
                'label' => esc_html__( 'Text Color', 'wts-eae' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eae-content-ticker-heading:hover' => 'fill: {{VALUE}}; color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'heading_arrow_color_hover',
            [
                'label' => esc_html__( 'Arrow Color', 'wts-eae' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eae-heading-arrow .eae-content-ticker-heading:hover::after' => 'border-left-color : {{VALUE}};',
                ],
                'condition' => [
                    'heading_enable_arrow!' => ''
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_hover',
                'types' => [ 'classic', 'gradient' ],
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .eae-content-ticker-heading:hover',
                'fields_options' => [
                    'background' => [
                        'default' => '',
                    ],
                    'color' => [
                        'global' => [
                            'default' => Global_Colors::COLOR_PRIMARY,
                        ],
                    ],
                ],
            ]
        );      
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'wts-eae' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .eae-content-ticker-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'text_padding',
            [
                'label' => esc_html__( 'Padding', 'wts-eae' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .eae-content-ticker-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],               
            ]
        );
        $this->end_controls_section();
    }

    function sliderStyle(){

        $this->start_controls_section(
            'section_slider_style',
            [
                'label' => esc_html__( 'Slider', 'wts-eae' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_slider_text',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_TEXT,
                ],
                'selector' => '{{WRAPPER}} .swiper-slide',
            ]
        );

        $this->start_controls_tabs(
            'style_tabs_slider'
        );

        $this->start_controls_tab(
            'style_slider_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'wts-eae' ),
            ]
        );

        $this->add_control(
            'style_slider_tab',
            [
                'label' => esc_html__( 'Text Color', 'wts-eae' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'eae_background',
                'types' =>[ 'classic', 'gradient'],
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .eae-content-ticker-wrapper',
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'style_slider_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'wts-eae' ),
            ]
        );

        $this->add_control(
            'eae-slider_text_color_hover',
            [
                'label' => esc_html__( 'Text Color', 'wts-eae' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'eae_background_hover',
                'types' =>[ 'classic', 'gradient'],
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .eae-content-ticker-wrapper:hover',
            ]
        );  

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'slider_text_padding',  
            [
                'label' => esc_html__( 'Padding', 'wts-eae' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .eae-content-ticker-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }
    function navigationStyle(){

        $this->start_controls_section(
            'section_navigation_icon_style',
            [
                'label' => esc_html__( 'Navigation', 'wts-eae' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'        => [
                    'carousel_navigation' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'size_navigation_icon',
            [
                'label' => esc_html__( 'Icon Size', 'wts-eae' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eae-navigation-icon-wrapper i  ' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'eae_icon_gap',
            [
                'label' => esc_html__( 'Icon gap', 'wts-eae' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eae-navigation-icon-wrapper  ' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'style_tabs_navigation'
        );

        $this->start_controls_tab(
            'style_navigation_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'wts-eae' ),
            ]
        );

        $this->add_control(
            'navigation_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'wts-eae' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eae-navigation-icon-wrapper i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_navigation_icon',
                'exclude' => [ 'image' ],
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .eae-navigation-icon-wrapper i',
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
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_navigation_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'wts-eae' ),
            ]
        );
        $this->add_control(
            'navigation_icon_color_hover',
            [
                'label' => esc_html__( 'Icon Color', 'wts-eae' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eae-navigation-icon-wrapper i:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_navigation_icon_hover',
                'exclude' => [ 'image' ],
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .eae-navigation-icon-wrapper i:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'navigation_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'wts-eae' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .eae-navigation-icon-wrapper i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                
                
            ]
        );
        $this->add_responsive_control(
            'border_radius_navigation_icon',
            [
                'label' => esc_html__( 'Border Radius', 'wts-eae' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .eae-navigation-icon-wrapper i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'rotate_navigation_icon',
            [
                'label' => esc_html__( 'Rotate', 'wts-eae' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'deg', 'grad', 'rad', 'turn' ],
                'default' => [
                    'unit' => 'deg',
                ],
                'tablet_default' => [
                    'unit' => 'deg',
                ],
                'mobile_default' => [
                    'unit' => 'deg',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eae-navigation-icon-wrapper i' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );
        $this->end_controls_section();    
    }
    function boxStyle(){

        $this->start_controls_section(
            'section_box_style',
            [
                'label' => esc_html__( 'Box', 'wts-eae' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'border_radius_full_container_box',
            [
                'label' => esc_html__( 'Border Radius', 'wts-eae' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .eae-content-ticker-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'box_border',
				'fields_options' => [
					'border' => [
						'default' => 'none',
					],
					'width'  => [
						'default' => [
							'top'    => 1,
							'right'  => 1,
							'bottom' => 1,
							'left'   => 1,
							'unit'   => 'px',
						],
					],
					'color'  => [
						'default' => '#0c0c0c',
					],
				],
				'selector'       => '{{WRAPPER}} .eae-content-ticker-wrapper',
				'separator'      => 'before',
			]
		);
        $this->add_responsive_control(
            'box_style_padding',
            [
                'label' => esc_html__( 'Padding', 'wts-eae' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .eae-content-ticker-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],             
            ]
        );
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .eae-content-ticker-wrapper',
            ]
		);

    }
    
    protected function render(){
      
        $settings = $this->get_settings_for_display(); 
        
        $swiper_data = [];
        $swiper_data['effect'] = $settings['carousel_effect'] ?? 'slide';
        $swiper_data['speed'] = $settings['carousel_speed'];
        $swiper_data['loop'] = $settings['carousel_loop'];
        $swiper_data['keyboardControl'] = $settings['carousel_Keyboard_Control'];
        $swiper_data['arrows'] = $settings['carousel_navigation'];
        
        if($settings['carousel_effect'] == 'slide'){
            $swiper_data['direction'] = $settings['carousel_direction'];
        }
        if($settings['carousel_autoplay'] == 'yes'){
            $swiper_data['autoplayDuration'] = $settings['carousel_autoplay_speed'];
            $swiper_data['pauseOnHover'] = $settings['carousel_hover_pause'];
        }
             
        $this->add_render_attribute('wrapper', [    
            'class' => ['eae-content-ticker-wrapper', 'eae-slide-'. $settings['carousel_direction'],]  ,
            'data-swiper' => json_encode($swiper_data),
        ]);
        if($settings['heading_enable_arrow'] == 'yes'){
            $this->add_render_attribute('wrapper', 'class', 'eae-heading-arrow');
        }
        if($settings['carousel_navigation_hide_on_mobile'] == 'true'){
            $this->add_render_attribute('wrapper', 'class', 'eae-nav-on-mobile');
        }
        if($settings['heading_stack_on_mobile'] == 'yes'){
            $this->add_render_attribute('wrapper', 'class', 'eae-mobile-stack');
        }      
        $icon=$settings['select_icon'];
        ?>
        <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
           <?php if($settings['text_heading']!=null  || $icon['value']!=null){ ?>
            <div class="eae-content-ticker-heading">
                <?php if ($settings['icon_position']=='before'){ ?>     
                    <?php Icons_Manager::render_icon( $settings['select_icon'], [ 'aria-hidden' => 'true' ] );?>
                    <?php echo $settings['text_heading'];?>
                <?php } if ($settings['icon_position']=='after'){ ?>

                    <?php echo $settings['text_heading'];?>
                    <?php Icons_Manager::render_icon( $settings['select_icon'], [ 'aria-hidden' => 'true' ] );?>
                <?php } ?>
            </div>
            <?php } ?>
            
            <div class="eae-content-ticker-content-wrapper  swiper">
                <div class="eae-content-ticker swiper-wrapper">
                    <?php foreach ( $settings['content_list_add'] as $content_text => $item){
                        $title=$item['list_content']
                        ?>
                        <div class="swiper-slide">
                           <?php if ( ! empty( $item['content_list_link']['url'] ) ) {
                                $link_key = 'link_' . $content_text;
                                $this->add_link_attributes( $link_key, $item['content_list_link'] );
                           }?>
                            <?php if ( ! empty( $item['content_list_link']['url'] ) ){
                                ?> <a <?php $this->print_render_attribute_string( $link_key ); ?>> <?php
                            }?>
                            <?php echo $title ?>
                            <?php if ( ! empty( $item['content_list_link']['url'] ) ){
                                ?> </a> <?php
                            }?>
                        </div>
                    <?php } ?>
                </div>
                <div class="eae-navigation-icon-wrapper">
                    <div class="swiper-button-prev eae-swiper-button-prev">
                        <?php Icons_Manager::render_icon( $settings['navigation_icon_left'] ); ?>
                    </div>
                    <div class="swiper-button-next eae-swiper-button-next">
                        <?php Icons_Manager::render_icon( $settings['navigation_icon_right'] ); ?>
                    </div>
                </div>               
            </div>
        </div>               
        <?php
    }
}

