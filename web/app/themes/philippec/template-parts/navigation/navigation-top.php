<?php
/**
 * Displays top navigation
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.2
 */

?>
<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e('Top Menu', 'philippec'); ?>">
	<button class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
		<?php
		echo philippec_get_svg(array('icon' => 'bars'));
		echo philippec_get_svg(array('icon' => 'close'));
		_e('Menu', 'philippec');
		?>
	</button>

	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'top',
			'menu_id' => 'top-menu',
		)
	);
	?>

	<?php if ((philippec_is_frontpage() || (is_home() && is_front_page())) && has_custom_header()): ?>
		<a href="#content"
			class="menu-scroll-down"><?php echo philippec_get_svg(array('icon' => 'arrow-right')); ?><span
				class="screen-reader-text">
				<?php
				/* translators: Hidden accessibility text. */
				_e('Scroll down to content', 'philippec');
				?>
			</span></a>
	<?php endif; ?>
</nav><!-- #site-navigation -->