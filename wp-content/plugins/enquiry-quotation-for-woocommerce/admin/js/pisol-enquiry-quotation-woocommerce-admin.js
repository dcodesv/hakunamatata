(function ($) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	jQuery(function ($) {
		hideWhenEnabled('#row_pi_eqw_loop_show_on_out_of_stock', '#pi_eqw_enquiry_loop');
		hideWhenEnabled('#row_pi_eqw_single_show_on_out_of_stock', '#pi_eqw_enquiry_single');
	});

	function hideWhenEnabled(to_hide, based_on) {
		var $ = jQuery;
		$(based_on).on('change', function () {
			if ($(this).is(':checked')) {
				$(to_hide).fadeOut();
			} else {
				$(to_hide).fadeIn();
			}
		});

		$(based_on).trigger('change');
	}

})(jQuery);
