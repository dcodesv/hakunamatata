(function ($) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
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

		var add_to_enquiry = {

			init: function () {

				$(document).on('click', '.add-to-enquiry', function (event) {
					event.preventDefault();
					add_to_enquiry.sendData(this);
				});

				$(document).on('click', '.pi-remove-product', function () {
					var hash = $(this).data('id');
					add_to_enquiry.removeProduct(hash);
				});

				$(document).on('click', '#pi-update-enquiry', function () {
					var products = window.pisol_products;
					add_to_enquiry.updateProduct(products);
				});

				$(document).on('change', '.pi-quantity', function () {
					add_to_enquiry.enableUpdate();
					var new_quantity = $(this).val();
					var hash = $(this).data('hash');
					window.pisol_products[hash]['quantity'] = new_quantity;
					var products = window.pisol_products;
					add_to_enquiry.updateProduct(products);
				});

				$(document).on('change', '.pi-message', function () {
					add_to_enquiry.enableUpdate();
					var new_message = $(this).val();
					var hash = $(this).data('hash');
					window.pisol_products[hash]['message'] = new_message;
					var products = window.pisol_products;
					add_to_enquiry.updateProduct(products);
				});

				add_to_enquiry.successSubmit();
			},

			successSubmit: function () {
				/** this hides the cart on success full submition */
				if ($("#pi-form-submitted-success").length) {
					$(".shop_table_responsive").css("display", "none");
				}
			},

			getData: function (button) {
				var action = $(button).data('action');
				var id = $(button).data('id');
				var variation_id = add_to_enquiry.variationSelected();
				var variation_detail = add_to_enquiry.variationDetail();
				var quantity = add_to_enquiry.quantity(id);
				return { action: action, id: id, variation_id: variation_id, quantity: quantity, variation_detail: variation_detail };
			},

			variationSelected: function () {
				var variation_selected = $("form.variations_form input[name='variation_id']").val();

				if (typeof variation_selected != "undefined" && variation_selected != 0) {
					return parseInt(variation_selected);
				}
				return 0;
			},

			variationDetail: function () {
				var variation_selected = $("form.variations_form input[name='variation_id']").val();
				var variation_detail = {};
				if (typeof variation_selected != "undefined" && variation_selected != 0) {
					jQuery('select[name^=attribute_]').each(function (ind, obj) {
						variation_detail[jQuery(this).attr('name')] = jQuery(this).val();
					});
				}
				if (jQuery.isEmptyObject(variation_detail)) {
					return 0;
				}
				return variation_detail;
			},

			quantity: function (id) {

				var quantity = $('form.cart input[name="quantity"]').val();

				if (typeof quantity != "undefined") {
					return quantity;
				}
				return 1;
			},

			sendData: function (button) {
				add_to_enquiry.data = add_to_enquiry.getData(button);

				if (add_to_enquiry.alertIfVariationNotSelected()) {
					add_to_enquiry.addingToCart(button);
					jQuery.post(pi_ajax.ajax_url, add_to_enquiry.data, function (response) {
						add_to_enquiry.addedToCart(button);
					});
				}
			},

			removeProduct: function (hash) {
				add_to_enquiry.showLoading();
				jQuery.post(pi_ajax.ajax_url, { action: 'pi_remove_product', hash: hash }, function (response) {
					$("#pi-enquiry-list-row").html(response);
					add_to_enquiry.hideLoading();
				});
			},

			updateProduct: function (products) {
				add_to_enquiry.showLoading();
				jQuery.post(pi_ajax.ajax_url, { action: 'pi_update_products', products: products }, function (response) {
					$("#pi-enquiry-list-row").html(response);
					add_to_enquiry.hideLoading();
				});
			},

			enableUpdate: function () {
				$('#pi-update-enquiry').removeAttr('disabled');
			},

			showLoading: function () {
				$('#pi-enquiry-container').append('<div id="pi-loading"></div>');
			},

			hideLoading: function () {
				$('#pi-loading').remove();
			},

			alertIfVariationNotSelected: function () {
				if (jQuery('.variation_id').length > 0 && jQuery('.variation_id').val() == '' || jQuery('.variation_id').val() == 0) {
					alert('Variation not selected');
					return false;
				}
				return true;
			},

			addingToCart: function (button) {
				$(button).addClass('loading');
			},

			addedToCart: function (button) {
				$(button).removeClass('loading');
				$(button).addClass('added');
				add_to_enquiry.viewEnquiryCart(button);
			},

			viewEnquiryCart: function (button) {
				var url = pi_ajax.cart_page;
				if (url != false) {
					$(".pisol-view-cart").remove();
					$(button).after('<a class="pisol-view-cart"  href="' + url + '">View Enquiry Cart</a>');
				}
			}


		}

		add_to_enquiry.init();


	})

})(jQuery);
