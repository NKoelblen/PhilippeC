/**
 * File customize-preview.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */

(function ($) {
	// Collect information from customize-controls.js about which panels are opening.
	wp.customize.bind('preview-ready', function () {
		// Initially hide the theme option placeholders on load.
		$('.panel-placeholder').hide();

		wp.customize.preview.bind('section-highlight', function (data) {
			// Only on the front page.
			if (!$('body').hasClass('philippec-front-page')) {
				return;
			}

			// When the section is expanded, show and scroll to the content placeholders, exposing the edit links.
			if (true === data.expanded) {
				$('body').addClass('highlight-front-sections');
				$('.panel-placeholder').slideDown(200, function () {
					$.scrollTo($('#panel1'), {
						duration: 600,
						offset: { top: -70 }, // Account for sticky menu.
					});
				});

				// If we've left the panel, hide the placeholders and scroll back to the top.
			} else {
				$('body').removeClass('highlight-front-sections');
				// Don't change scroll when leaving - it's likely to have unintended consequences.
				$('.panel-placeholder').slideUp(200);
			}
		});
	});

	// Site title and description.
	wp.customize('blogname', function (value) {
		value.bind(function (to) {
			$('.site-title a').text(to);
		});
	});
	wp.customize('blogdescription', function (value) {
		value.bind(function (to) {
			$('.site-description').text(to);
		});
	});

	// Color scheme.
	wp.customize('colorscheme', function (value) {
		value.bind(function (to) {
			// Update color body class.
			$('body')
				.removeClass('colors-light colors-dark colors-custom')
				.addClass('colors-' + to);
		});
	});

	// Whether a header image is available.
	function hasHeaderImage() {
		var image = wp.customize('header_image')();
		return '' !== image && 'remove-header' !== image;
	}

	// Toggle a body class if a custom header exists.
	$.each(['external_header_video', 'header_image', 'header_video'], function (index, settingId) {
		wp.customize(settingId, function (setting) {
			setting.bind(function () {
				if (hasHeaderImage()) {
					$(document.body).addClass('has-header-image');
				} else {
					$(document.body).removeClass('has-header-image');
				}
			});
		});
	});
})(jQuery);
