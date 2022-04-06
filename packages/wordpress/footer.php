<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package gutenberg-starter-theme
 */

?>

		<footer class="TextBox TextBox--center">
			<?php printf( esc_html__( 'Brought to you by: ' )); ?>
			<?php
				printf( esc_html__( '%s', 'gutenberg-starter-theme' ), '<a href="https://github.com/reccanti/Apple2000/">Apple ][000e</a>' );
			?>
			<?php printf( esc_html__( ' and ' )); ?>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'gutenberg-starter-theme' ) ); ?>">
				<?php printf( esc_html__( '%s', 'gutenberg-starter-theme' ), 'WordPress' ); ?>
			</a>
		</footer>
	</div>
</div><!-- #page -->

<?php wp_footer(); ?>
</div>
</body>
</html>
