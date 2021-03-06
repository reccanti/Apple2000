<?php
/**
 * gutenberg-starter-theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package gutenberg-starter-theme
 */

if ( ! function_exists( 'gutenberg_starter_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function gutenberg_starter_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on gutenberg-starter-theme, use a find and replace
		 * to change 'gutenberg-starter-theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'gutenberg-starter-theme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'gutenberg-starter-theme' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( '_s_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'gutenberg_starter_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gutenberg_starter_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'gutenberg_starter_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'gutenberg_starter_theme_content_width', 0 );

/**
 * Register Google Fonts
 */
function gutenberg_starter_theme_fonts_url() {
	$fonts_url = '';

	/*
	 *Translators: If there are characters in your language that are not
	 * supported by Noto Serif, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$notoserif = esc_html_x( 'on', 'Noto Serif font: on or off', 'gutenberg-starter-theme' );

	if ( 'off' !== $notoserif ) {
		$font_families = array();
		$font_families[] = 'Noto Serif:400,400italic,700,700italic';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;

}

/**
 * Enqueue scripts and styles.
 */
function gutenberg_starter_theme_scripts() {
	wp_enqueue_style( 'gutenbergbase-style', get_stylesheet_uri() );

	wp_enqueue_style( 'gutenberg-starter-themeblocks-style', get_template_directory_uri() . '/css/blocks.css' );

	wp_enqueue_style( 'gutenberg-starter-theme-fonts', gutenberg_starter_theme_fonts_url() );

	wp_enqueue_script( 'gutenberg-starter-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'gutenberg-starter-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'gutenberg_starter_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Theme Settings
 */
require get_template_directory() . '/inc/theme-options.php';

/**
 * ==========================================================================
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * THIS IS WHERE THE THEME GETS SET UP!!!
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * ==========================================================================
 */

// Load the CSS styles
function apple_2000_setup() {
	wp_enqueue_style( 'apple2000', get_template_directory_uri() . '/css/styles.css');
}
add_action( 'wp_enqueue_scripts', 'apple_2000_setup');

// Load our custom blocks
include_once get_template_directory() . '/plugins/Apple2000-Blocks/apple2000-blocks.php';
include_once get_template_directory() . '/plugins/Apple2000-Blocks/build/index.asset.php';
function load_block_editor_assets() {
	wp_enqueue_script('apple-2000e-block-scripts', get_template_directory_uri() . '/plugins/Apple2000-Blocks/build/index.js');
	wp_enqueue_style('apple-2000e-block-styles', get_template_directory_uri() . '/plugins/Apple2000-Blocks/build/index.css');
}
add_action( 'enqueue_block_editor_assets', 'load_block_editor_assets');

// Apply admin overrides
function apply_css_overrides() {
	if (is_admin_bar_showing()) {
		wp_enqueue_style(
			'apple-2000e-admin-overrde-styles',
			get_template_directory_uri() . '/css-other/admin_overrides.css',
			["apple2000"]
		);
	}
	wp_enqueue_style(
		'apple-2000e-overrde-styles',
		get_template_directory_uri() . '/css-other/overrides.css',
		["apple2000"]
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

function cacheCookie() {
	$settingsString = $_COOKIE['apple-2000e-settings'];
	$settingsState = json_decode(stripslashes($settingsString));

	$theme_classes = ["theme-root"];
	$root_styles = [];

	foreach ($settingsState as $key => $value) {
		switch ($key) {
			case "enableMotion":
				if (!$value) {
					array_push($theme_classes, "theme-root--no-motion");
				}
				break;
			case "useSimpleText":
				if ($value) {
					array_push($theme_classes, "theme-root--simple-text");
				}
				break;
			case "siteWidth":
				array_push($root_styles, "--site-width: " . $value . "px");
				break;
			case "fontSizeMultiplier":
				array_push($root_styles, "--font-base-size-multiplier: " . $value);
				break;
			case "theme":
				switch($value) {
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
				break;
		}
	}

	add_filter( 'theme_classes', function( $classes ) use ($theme_classes) {	
		return array_merge($classes, $theme_classes);
	});

	add_filter( 'root_styles', function( $styles ) use ($root_styles) {	
		return array_merge($styles, $root_styles);
	});

}

add_action( 'init', 'cacheCookie');
