<?php
/**
 * Travel Tribe Theme Customizer Functions.
 *
 * @package Travel Tribe
 */

function travel_tribe_customize_register_panel( $wp_customize ) {
	
$wp_customize->add_section( 'travel_tribe_header_button_settings', array(
	'priority'       => 15,
	'title'          => __('Header Button', 'travel-tribe'),	
	'panel' 		 => 'travelscape_header_settings'
) );				
	
// Header Button Label	
$wp_customize->add_setting( 'travel_tribe_header_button_label' , array(	
	'type'          => 'theme_mod',
	'transport'     => 'refresh',
	'sanitize_callback' => 'wp_filter_nohtml_kses'
) );
$wp_customize->add_control( 'travel_tribe_header_button_label_control', array(
	'label'      => __('Header Button Label', 'travel-tribe'),
	'section'    => 'travel_tribe_header_button_settings',
	'settings'   => 'travel_tribe_header_button_label',
	'priority'   => 5,
	'type'       => 'text',
) );	

	
//Header Button URL
$wp_customize->add_setting( 'travel_tribe_header_button_link' , array(
	'type'          => 'theme_mod',
	'transport'     => 'refresh',
	'sanitize_callback' => 'esc_url_raw'
) );
	
$wp_customize->add_control( 'travel_tribe_header_button_link_control', array(
	'label'      		=> __('Header Button URL', 'travel-tribe'),
	'description'      	=> __('Enter button URL/Link Here.', 'travel-tribe'),
	'section'    		=> 'travel_tribe_header_button_settings',
	'settings'   		=> 'travel_tribe_header_button_link',
	'priority'   		=> 10,
	'type'       		=> 'url',
) );	
		
}
add_action( 'customize_register', 'travel_tribe_customize_register_panel' );