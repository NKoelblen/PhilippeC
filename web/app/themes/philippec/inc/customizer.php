<?php
/**
 * PhilippeC: Customizer
 *
 * @package WordPress
 * @subpackage PhilippeC
 * @since PhilippeC 1.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function philippec_customize_register(WP_Customize_Manager $wp_customize)
{
	$wp_customize->get_setting('blogname')->transport = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport = 'postMessage';

	$wp_customize->selective_refresh->add_partial(
		'blogname',
		array(
			'selector' => '.site-title a',
			'render_callback' => 'philippec_customize_partial_blogname',
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'blogdescription',
		array(
			'selector' => '.site-description',
			'render_callback' => 'philippec_customize_partial_blogdescription',
		)
	);

	/**
	 * Custom colors.
	 */
	$wp_customize->add_setting(
		'colorscheme',
		array(
			'default' => 'light',
			'transport' => 'postMessage',
			'sanitize_callback' => 'philippec_sanitize_colorscheme',
		)
	);

	$wp_customize->add_control(
		'colorscheme',
		array(
			'type' => 'radio',
			'label' => __('Color Scheme', 'philippec'),
			'choices' => array(
				'light' => __('Light', 'philippec'),
				'dark' => __('Dark', 'philippec'),
			),
			'section' => 'colors',
			'priority' => 5,
		)
	);

	$wp_customize->remove_control('header_textcolor');

}
add_action('customize_register', 'philippec_customize_register');


/**
 * Sanitize the colorscheme.
 *
 * @param string $input Color scheme.
 */
function philippec_sanitize_colorscheme($input)
{
	$valid = array('light', 'dark');

	if (in_array($input, $valid, true)) {
		return $input;
	}

	return 'light';
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since PhilippeC 1.0
 *
 * @see philippec_customize_register()
 *
 * @return void
 */
function philippec_customize_partial_blogname()
{
	bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since PhilippeC 1.0
 *
 * @see philippec_customize_register()
 *
 * @return void
 */
function philippec_customize_partial_blogdescription()
{
	bloginfo('description');
}

/**
 * Return whether we're previewing the front page and it's a static page.
 *
 * This function is an alias for philippec_is_frontpage().
 *
 * @since PhilippeC 1.0 Converted function to an alias.
 *
 * @return bool Whether the current page is the front page and static.
 */
function philippec_is_static_front_page()
{
	return philippec_is_frontpage();
}

/**
 * Return whether we're on a view that supports a one or two column layout.
 */
function philippec_is_view_with_layout_option()
{
	// This option is available on all pages. It's also available on archives when there isn't a sidebar.
	return (is_page() || (is_archive() && !is_active_sidebar('sidebar-1')));
}

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function philippec_customize_preview_js()
{
	wp_enqueue_script('philippec-customize-preview', get_theme_file_uri('/assets/js/customize-preview.js'), array('customize-preview'), '20161002', array('in_footer' => true));
}
add_action('customize_preview_init', 'philippec_customize_preview_js');

/**
 * Load dynamic logic for the customizer controls area.
 */
function philippec_panels_js()
{
	wp_enqueue_script('philippec-customize-controls', get_theme_file_uri('/assets/js/customize-controls.js'), array(), '20161020', array('in_footer' => true));
}
add_action('customize_controls_enqueue_scripts', 'philippec_panels_js');
