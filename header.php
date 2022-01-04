<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package gutenberg-starter-theme
 */
?>

<?php 
	function root_styles() {
		$styles = apply_filters("root_styles", []);
		return implode("; ", $styles);
	}

	function theme_classes() {
		$classes = apply_filters("theme_classes", []);
		return implode(" ", $classes);
	}
?>

<!doctype html>
<html <?php language_attributes(); ?> style="<?php echo root_styles(); ?>">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="theme-root" class="<?php echo theme_classes(); ?>">
		<div class="SkipNav">
			<a class="button" href="#primary"><?php esc_html_e( 'Skip to content', 'gutenberg-starter-theme' ); ?></a>
		</div>
		<?php 
			get_template_part("template-parts/themenu");
		?>
		<div id="page" class="Wrapper">
			<div class="Wrapper-inner">
				<header id="masthead" class="site-header">
					<div class="site-branding">
						<?php
						the_custom_logo();
						if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
						endif;

						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
						<?php
						endif; ?>
					</div><!-- .site-branding -->
				</header><!-- #masthead -->
