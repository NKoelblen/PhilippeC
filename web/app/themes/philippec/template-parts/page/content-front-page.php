<?php
/**
 * Displays content for front page
 *
 * @package WordPress
 * @subpackage PhilippeC
 * @since PhilippeC 1.0
 * @version 1.0
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('philippec-panel '); ?>>

	<?php
	if (has_post_thumbnail()):
		$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'philippec-featured-image');

		// Calculate aspect ratio: h / w * 100%.
		$ratio = $thumbnail[2] / $thumbnail[1] * 100;
		?>

			<div class="panel-image" style="background-image: url(<?php echo esc_url($thumbnail[0]); ?>);">
				<div class="panel-image-prop" style="padding-top: <?php echo esc_attr($ratio); ?>%"></div>
			</div><!-- .panel-image -->

	<?php endif; ?>

	<div class="panel-content">
		<div class="wrap">
			<header class="entry-header">
				<?php the_title('<h2 class="entry-title">', '</h2>'); ?>

				<?php philippec_edit_link(get_the_ID()); ?>

			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php
				the_content(
					sprintf(
						/* translators: %s: Post title. Only visible to screen readers. */
						__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'philippec'),
						get_the_title()
					)
				);
				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . __('Pages:', 'philippec'),
						'after' => '</div>',
					)
				);
				?>
			</div><!-- .entry-content -->

		</div><!-- .wrap -->
	</div><!-- .panel-content -->

</article><!-- #post-<?php the_ID(); ?> -->