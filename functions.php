<?php
/**
 * Travel Tribe Theme Functions.
 *
 * @package Travel Tribe
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

$traveltribe_theme_data = wp_get_theme();
define( 'TRAVEL_TRIBE_THEME_VERSION', $traveltribe_theme_data->get( 'Version' ) );
define( 'TRAVEL_TRIBE_THEME_DIR', get_stylesheet_directory() );
define( 'TRAVEL_TRIBE_THEME_URI', get_stylesheet_directory_uri() );

function travel_tribe_enqueue_styles() {
	
	wp_enqueue_style( 'travel-tribe-style', get_stylesheet_uri(), array( 'travelscape-style' ), TRAVEL_TRIBE_THEME_VERSION);	
	
}	
add_action( 'wp_enqueue_scripts', 'travel_tribe_enqueue_styles' );

function travel_tribe_setup() {

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'travel_tribe_custom_background_args',
			array(
				'default-color' => '#ffffff',
				'default-image' => '',
			)
		)
	);		
	
}
add_action( 'after_setup_theme', 'travel_tribe_setup' );

/**
 * Enqueue fonts
 */
function travel_tribe_fonts() {	
	
	wp_dequeue_style( 'travelscape-fonts' );
	
	$font_families = array(
		'Tenor+Sans',
		'Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900'
	);

	$fonts_url = add_query_arg( array(
		'family' => implode( '&family=', $font_families ),
		'display' => 'swap',
	), 'https://fonts.googleapis.com/css2' );

	$fonts = wptt_get_webfont_url( esc_url_raw( $fonts_url ) );	
	
	wp_enqueue_style( 'travel-tribe-fonts', $fonts, array(), TRAVEL_TRIBE_THEME_VERSION);
	
}
add_action( 'wp_enqueue_scripts', 'travel_tribe_fonts', 15 );
add_action( 'enqueue_block_editor_assets', 'travel_tribe_fonts', 15 );

// Create a function to override styles
function travel_tribe_override_primary_color($defaults) {
	
    $defaults['primary-color'] 			= '#030303';
	$defaults['secondary-color'] 		= '#191919';
	$defaults['body-color'] 			= '#23262f';
	$defaults['heading-color'] 			= '#23262f';
	$defaults['subtle-color'] 			= '#f1f5f5';
	$defaults['border-color'] 			= '#f1f5f5';
	$defaults['base-color'] 			= '#ffffff';			
	
	$defaults['font-family'] 	= 'Roboto';
	$defaults['font-family-h1'] = 'Tenor Sans';
	$defaults['font-family-h2'] = 'Tenor Sans';
	$defaults['font-family-h3'] = 'Tenor Sans';
	$defaults['font-family-h4'] = 'Tenor Sans';
	$defaults['font-family-h5'] = 'Tenor Sans';
	$defaults['font-family-h6'] = 'Tenor Sans';
	
    return $defaults;
}
add_filter('travelscape_style', 'travel_tribe_override_primary_color', 15);

//theme customizer sections
require_once TRAVEL_TRIBE_THEME_DIR . '/customizer.php';

function travel_tribe_header_topbar() {
	
	$site_header = new Travelscape_Header();	
			
	if($site_header->email || $site_header->social_ed) {
		echo '<div class="travelscape-header-top">';
			echo '<div class="container">';
					echo '<div class="row">';
						echo '<div class="travelscape-header-top-center">';							
							$site_header->travelscape_header_email();		
						echo '</div>';		
						echo '<div class="travelscape-header-top-right">';																			
							$site_header->travelscape_header_social_icons();
						echo '</div>';			
					echo '</div>';			
			echo '</div>';					
		echo '</div>';
	}			
}
add_filter('travelscape_header_topbar', 'travel_tribe_header_topbar', 15);

function travel_tribe_header_desktop() {
	
	$ta_button_label = get_theme_mod('travel_tribe_header_button_label');
	$ta_button_url = get_theme_mod('travel_tribe_header_button_link');
	
	$site_header = new Travelscape_Header();
	echo '<div class="container">';
		echo '<div class="row header-desktop">';			
			$site_header->travelscape_header_menu();
			$site_header->travelscape_header_logo();
			echo '<div class="header-bottom-right">';
				if($ta_button_label && $ta_button_url) {
					$site_header->travelscape_header_phone();
				}
				if($ta_button_label && $ta_button_url) {
					echo '<div class="travelscape-header-button">';
						echo '<a class="header-button" href="'.esc_url($ta_button_url).'">';
						echo esc_html($ta_button_label);
						echo '</a>';
					echo '</div>';
				}
			echo '</div>';
		echo '</div>';	
	echo '</div>';	
	
}
add_filter('travelscape_header_desktop', 'travel_tribe_header_desktop', 15);

function travel_tribe_header_mobile() {
	
	$ta_button_label = get_theme_mod('travel_tribe_header_button_label');
	$ta_button_url = get_theme_mod('travel_tribe_header_button_link');
	
	$site_header = new Travelscape_Header();
	echo '<div class="container">';
		echo '<div class="header-mobile">';		
			echo '<div class="row top-wrap">';
				$site_header->travelscape_header_logo();
				if($ta_button_label && $ta_button_url) {
					echo '<div class="travelscape-header-button">';
						echo '<a class="header-button" href="'.esc_url($ta_button_url).'">';
						echo esc_html($ta_button_label);
						echo '</a>';
					echo '</div>';
				}	
				$site_header->travelscape_header_menu_toggle();
			echo '</div>';	
			echo '<div class="row">';
				$site_header->travelscape_header_menu();			
			echo '</div>';				
		echo '</div>';	
	echo '</div>';	
	
	
}
add_filter('travelscape_header_mobile', 'travel_tribe_header_mobile', 15);


/**
 * Add filter only if function exists
 */
function travelscape_demo_importer_checked() {
    if ( function_exists('DEMO_IMPORTER_PLUS_setup') ) {
        add_filter(
            'demo_importer_plus_api_id',
            function () {
                return  array( '5591', '5580', '5574', '5568', '5564', '5558'  );
            }
        );
    }
}