<?php
/**
 * Apple 2000e functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package apple-2000-e
 */

if (! function_exists( 'register_customizer_fields' ) ) : 

	/**
	 * Register stuff that can be set via the customizer
	 * 
	 * @TODO - this might need to be replaced whn Wordpress starts supporting
	 * theme variants in the styles/ directory, but for now this will have to do :/
	 */
	function register_customizer_fields($wp_customize) {
		$wp_customize->add_section('apple_2000e', array(
			'title'    => __('Apple ][000e'),
			'description' => 'Settings related to the Apple ][000e theme',
			'priority' => 120,
		));

		// Theme Select

		$wp_customize->add_setting('apple_2000e_theme', array(
			'default'        => 'white',
			'capability'     => 'edit_theme_options',
		));

		$wp_customize->add_control( 'apple_2000e_theme_select', array(
				'settings' => 'apple_2000e_theme',
				'label'   => 'Select a theme:',
				'section' => 'apple_2000e',
				'type'    => 'select',
				'choices'    => array(
						'black' => 'Black',
						'blue' => 'Blue',
						'brown' => 'Brown',
						'darkGray' => 'Dark Gray',
						'darkGreen' => 'Dark Green',
						'purple' => 'Purple',
						'salmon' => 'Salmon',
						'darkBlue' => 'Dark Blue',
						'lightBlue' => 'Light Blue',
						'lightGray' => 'Light Gray',
						'lightGreen' => 'Light Green',
						'magenta' => 'Magenta',
						'orange' => 'Orange',
						'pink' => 'Pink',
						'white' => 'White',
						'yellow' => 'Yellow',
				),
		));
	}

	add_action('customize_register', 'register_customizer_fields');

endif;

if ( ! function_exists( 'full_site_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function full_site_support() {

		// Add support for block styles.
		add_theme_support( 'editor-styles' );


		// Enqueue editor styles.
		wp_enqueue_style( 'gutenberg-starter-themeblocks-style', get_template_directory_uri() . '/css/editor.css' );
		add_editor_style( 'css/editor.css' );
		// wp_enqueue_style( 'gutenberg-starter-themeblocks-style', get_template_directory_uri() . '/styles/blocks.css' );

		// var_dump(get_template_directory_uri() . '/styles/blocks.css');
	}

endif;

add_action( 'after_setup_theme', 'full_site_support' );


// Load the CSS styles
function apple_2000e_setup() {
	wp_enqueue_style( 'apple2000e', get_template_directory_uri() . '/node_modules/css/dist/styles.css');
}
add_action( 'wp_enqueue_scripts', 'apple_2000e_setup');

// Load our custom blocks
include_once get_template_directory() . '/plugins/Apple2000e-Blocks/apple2000e-blocks.php';
include_once get_template_directory() . '/plugins/Apple2000e-Blocks/build/index.asset.php';
function load_block_editor_assets() {
	wp_enqueue_script('apple-2000e-block-scripts', get_template_directory_uri() . '/plugins/Apple2000e-Blocks/build/index.js');
	wp_enqueue_style('apple-2000e-block-styles', get_template_directory_uri() . '/plugins/Apple2000e-Blocks/build/index.css');
}
add_action( 'enqueue_block_editor_assets', 'load_block_editor_assets');

// Apply admin overrides
function apply_css_overrides() {
	if (is_admin_bar_showing()) {
		wp_enqueue_style(
			'apple-2000e-admin-overrde-styles',
			get_template_directory_uri() . '/css/admin_overrides.css',
			["apple2000e"]
		);
	}
	wp_enqueue_style(
		'apple-2000e-overrde-styles',
		get_template_directory_uri() . '/css/overrides.css',
		["apple2000e"]
	);
}
add_action( 'wp_enqueue_scripts', 'apply_css_overrides');

// cache setting values
add_filter("root_styles", function($styles = []) {
	return $styles;
});

add_filter("theme_classes", function($classes = []) {
	return $classes;
});

function set_default_theme() {
	$theme = get_theme_mod('apple_2000e_theme');
	// var_dump(get_theme_mods());
	$theme_classes = ["theme-root"];
	switch($theme) {
		case "blue":
			array_push($theme_classes, "theme-root--blue");
			break;
		case "brown":
			array_push($theme_classes, "theme-root--brown");
			break;	
		case "darkGray":
			array_push($theme_classes, "theme-root--darkGray");
			break;	
		case "darkGreen":
			array_push($theme_classes, "theme-root--darkGreen");
			break;	
		case "purple":
			array_push($theme_classes, "theme-root--purple");
			break;	
		case "salmon":
			array_push($theme_classes, "theme-root--salmon");
			break;	
		case "black":
			array_push($theme_classes, "theme-root--black");
			break;	
		case "darkBlue":
			array_push($theme_classes, "theme-root--darkBlue");
			break;
		case "lightBlue":
			array_push($theme_classes, "theme-root--lightBlue");
			break;	
		case "lightGray":
			array_push($theme_classes, "theme-root--lightGray");
			break;	
		case "lightGreen":
			array_push($theme_classes, "theme-root--lightGreen");
			break;	
		case "magenta":
			array_push($theme_classes, "theme-root--magenta");
			break;
		case "orange":
			array_push($theme_classes, "theme-root--orange");
			break;	
		case "pink":
			array_push($theme_classes, "theme-root--pink");
			break;	
		case "white":
			array_push($theme_classes, "theme-root--white");
			break;	
		case "yellow":
			array_push($theme_classes, "theme-root--yellow");
			break;
	}

	$classes = implode($theme_classes, " ");

	register_block_pattern(
		'apple2000e/wrapper',
		array(
			'title' => __( 'Wrapper' ),
			'content' => ""
				. '<!-- wp:template-part {"slug":"header","theme":"Apple2000e"} /-->'
				. "<!-- wp:group { 'className': '$classes' } -->"
				. 	'<div class="wp-block-group">'
				. 	'</div>'
				. '<!-- /wp:group -->',
			'inserter'   => true
		)
	);

	// add_filter( 'theme_classes', function( $classes ) use ($theme_classes) {	
	// 	return array_merge($classes, $theme_classes);
	// });
}

add_action( 'init', 'set_default_theme');

// function cacheCookie() {
// 	$settingsString = $_COOKIE['apple-2000e-settings'];
// 	$settingsState = json_decode(stripslashes($settingsString));

// 	$theme_classes = ["theme-root"];
// 	$root_styles = [];

// 	if ($settingsState) {
// 		foreach ($settingsState as $key => $value) {
// 			switch ($key) {
// 				case "enableMotion":
// 					if (!$value) {
// 						array_push($theme_classes, "theme-root--no-motion");
// 					}
// 					break;
// 				case "useSimpleText":
// 					if ($value) {
// 						array_push($theme_classes, "theme-root--simple-text");
// 					}
// 					break;
// 				case "siteWidth":
// 					array_push($root_styles, "--site-width: " . $value . "px");
// 					break;
// 				case "fontSizeMultiplier":
// 					array_push($root_styles, "--font-base-size-multiplier: " . $value);
// 					break;
// 				case "theme":
// 					switch($value) {
// 						case "blue":
// 							array_push($theme_classes, "theme-root--blue");
// 							break;
// 						case "brown":
// 							array_push($theme_classes, "theme-root--brown");
// 							break;	
// 						case "darkGray":
// 							array_push($theme_classes, "theme-root--darkGray");
// 							break;	
// 						case "darkGreen":
// 							array_push($theme_classes, "theme-root--darkGreen");
// 							break;	
// 						case "purple":
// 							array_push($theme_classes, "theme-root--purple");
// 							break;	
// 						case "salmon":
// 							array_push($theme_classes, "theme-root--salmon");
// 							break;	
// 						case "black":
// 							array_push($theme_classes, "theme-root--black");
// 							break;	
// 						case "darkBlue":
// 							array_push($theme_classes, "theme-root--darkBlue");
// 							break;
// 						case "lightBlue":
// 							array_push($theme_classes, "theme-root--lightBlue");
// 							break;	
// 						case "lightGray":
// 							array_push($theme_classes, "theme-root--lightGray");
// 							break;	
// 						case "lightGreen":
// 							array_push($theme_classes, "theme-root--lightGreen");
// 							break;	
// 						case "magenta":
// 							array_push($theme_classes, "theme-root--magenta");
// 							break;
// 						case "orange":
// 							array_push($theme_classes, "theme-root--orange");
// 							break;	
// 						case "pink":
// 							array_push($theme_classes, "theme-root--pink");
// 							break;	
// 						case "white":
// 							array_push($theme_classes, "theme-root--white");
// 							break;	
// 						case "yellow":
// 							array_push($theme_classes, "theme-root--yellow");
// 							break;
// 					}
// 					break;
// 			}
// 		}
// 	}

// 	add_filter( 'theme_classes', function( $classes ) use ($theme_classes) {	
// 		return array_merge($classes, $theme_classes);
// 	});

// 	add_filter( 'root_styles', function( $styles ) use ($root_styles) {	
// 		return array_merge($styles, $root_styles);
// 	});

// }

// add_action( 'init', 'cacheCookie');
