<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package gutenberg-starter-theme
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<section id="comments" class="Box comments-area">
	<header class="Header">
		<h2 class="Header-inner comments-title">
			Potentially Cool Comments
		</h2><!-- .comments-title -->
	</header>
	<div class="Box-inner">
		<?php if ( have_comments() ) : ?>
			<?php the_comments_navigation(); ?>
			<ol class="comment-list">
				<?php
					wp_list_comments( array(
						'style'      => 'ol',
						'short_ping' => true,
					) );
				?>
			</ol><!-- .comment-list -->
			<?php the_comments_navigation(); ?>
			<?php if ( ! comments_open() ) : ?>
				<p class="no-comments">
					<?php esc_html_e( 'Comments are closed.', 'gutenberg-starter-theme' ); ?>
				</p>
			<?php endif; ?>
		<?php endif; ?>
		<?php comment_form(); ?>
	</div>
</section>