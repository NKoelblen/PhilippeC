<?php
/**
 * Displays footer widgets if assigned
 *
 * @package WordPress
 * @subpackage PhilippeC
 * @since PhilippeC 1.0
 * @version 1.0
 */

?>

<?php
if (
	is_active_sidebar('sidebar-2') ||
	is_active_sidebar('sidebar-3')
):
	?>

		<aside class="widget-area" aria-label="<?php esc_attr_e('Footer', 'philippec'); ?>">
			<?php
			if (is_active_sidebar('sidebar-2')) {
				?>
					<div class="widget-column footer-widget-1">
						<?php dynamic_sidebar('sidebar-2'); ?>
					</div>
					<?php
			}
			if (is_active_sidebar('sidebar-3')) {
				?>
					<div class="widget-column footer-widget-2">
						<?php dynamic_sidebar('sidebar-3'); ?>
					</div>
			<?php } ?>
		</aside><!-- .widget-area -->

		<?php
endif;
