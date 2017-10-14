if(typeof ketnoimoi == 'undefined')
	var ketnoimoi = {};

ketnoimoi.site = {
	init: function () {
		var thisObj = ketnoimoi.site;
		$('span#cart-total').text(thisObj.cart.getTotalProducts());

		if(location.pathname == '/gio-hang.html' || location.pathname == '/thong-tin-thanh-toan.html'){
			thisObj.calculateFormInfo();
		}

		thisObj.events();

		if($('[data-toggle="tooltip"]').length)
			$('[data-toggle="tooltip"]').tooltip()
	},
	events: function () {
		var thisObj = ketnoimoi.site;

		// add-to-cart
		$('button.add-to-cart, a.add-to-cart').click(function () {
			var data = $(this).data();
			if ($(this).hasClass('quick-add-to-cart')) {
				data.quantity = 1;
			}
			else{
				data.product_size_id = $('.attr-size select').val();
				data.product_color_id = $('#input-color').val();
				data.quantity = $('#input-quantity').val();
			}

			thisObj.cart.addToCart(data, !$(this).hasClass('go-payment'));
			$('span#cart-total').text(thisObj.cart.getTotalProducts());

			if($(this).hasClass('go-payment'))
				window.location = '/gio-hang.html';
		});

		// remove item in cart
		$('span.remove-item').click(function () {
			if (confirm("Bạn thật sự muốn xóa sản phẩm này ra khỏi giỏ hàng?")) {
				var data = $(this).data();
				data.quantity = 0;
				thisObj.cart.updateQuantity(data);
				$('span#cart-total').text(thisObj.cart.getTotalProducts());
				$(this).parents('tr').remove();
				
				var totalAmount = thisObj.cart.getTotalAmount();
				$('span.total-amount').text(numbro(totalAmount).format());

				thisObj.calculateFormInfo();
			};
		});

		// change item quantity in cart
		$('input.quantity').change(function () {
			var value = $.parseJSON($(this).val());
			var max = $.parseJSON($(this).attr('max'));
			var min = $.parseJSON($(this).attr('min'));
			value = value < min ? min : value;
			value = value > max ? max : value;
			$(this).val(value);

			var data = $(this).data();
			data.quantity = value;
			thisObj.cart.updateQuantity(data);
			$('span#cart-total').text(thisObj.cart.getTotalProducts());
			if (!parseInt(data.quantity)) {
				$(this).parents('tr').remove();
			}

			$(this).parents('tr').find('span.item-amount').text(numbro(data.quantity * data.product_price).format());
			
			var totalAmount = thisObj.cart.getTotalAmount();
			$('span.total-amount').text(numbro(totalAmount).format());

			thisObj.calculateFormInfo();
		});

		// dropdown province -> district
		$('select.province').change(function (argument) {
			var province = $(this).val();
			var subcontrol = $(this).attr('sub-control');
			subcontrol = $('#' + subcontrol);
			if(province != ''){
				thisObj.getDistricts(province, function (data) {
					var html = '<option value="">Quận/Huyện</option>';
					$.each(data, function (index, item) {
						html += $.format('<option value="{0}">{1}</option>', item.id, item.name);
					});
					subcontrol.html(html);
					subcontrol.val('');
				});
			}
			else{
				subcontrol.html('<option value="">Quận/Huyện</option>');
			}

			thisObj.calculateFormInfo();
		});

		// open shipping form
		$('#cboOpenShippingForm').change(function (argument) {
			if(this.checked){
				$('.shipping-form').show('slow');
				$('.shipping-form input, .shipping-form select, .shipping-form textarea').attr('required', true);
			}
			else{
				$('.shipping-form').hide('slow');
				$('.shipping-form input, .shipping-form select, .shipping-form textarea').removeAttr('required');
			}
		});

		// open invoice form
		$('#cboOpenInvoiceForm').change(function (argument) {
			if(this.checked){
				$('.invoice-form').show('slow');
				$('.invoice-form input, .invoice-form select, .invoice-form textarea').attr('required', true);
			}
			else{
				$('.invoice-form').hide('slow');
				$('.invoice-form input, .invoice-form select, .invoice-form textarea').removeAttr('required');
			}
		});

		$('.delivery-method').click(function (argument) {
			$('.delivery-method').removeClass('active');
			$(this).addClass('active');
			$('.delivery-method input[type="radio"]').removeAttr('checked');
			$(this).find('input[type="radio"]').eq(0).prop('checked', true).trigger('change');
			thisObj.calculateFormInfo();
		});

		$('.payment-method').click(function (argument) {
			$('.payment-method').removeClass('active');
			$(this).addClass('active');
			$('.payment-method input[type="radio"]').removeAttr('checked');
			$(this).find('input[type="radio"]').eq(0).prop('checked', true);
			$('.payment-method-info').addClass('hide');
			$activeTab = $(this).data('tab');
			$('#' + $activeTab).removeClass('hide');
			thisObj.calculateFormInfo();
		});

		$('#btnApplyPromotionCode').click(function (argument) {
			var promotioncode = $.trim($('#txtPromotionCode').val());
			if(promotioncode != ''){
				thisObj.getPromotionCode(promotioncode, function (data) {
					var amount = 0;
					if($.parseJSON(data.value_type)){	// percent
						//amount = thisObj.cart.getTotalAmount() * ($.parseJSON(data.percent_value) / 100)

						// không sử dụng mã thưởng %
						alert('Mã thưởng không hợp lệ!');
						return false;
					}
					else{
						amount = $.parseJSON(data.cash_value)
					}
					if (amount > 0) {
						var result = thisObj.cart.applyPromotionCode({
							code: promotioncode,
							amount: amount
						});

						if(result){
							var html = $('#promtion-template').html();
							html = $.format(html, promotioncode, numbro(amount).format(), data.id)
							$(html).insertBefore('#promtion-template');

							var totalAmount = thisObj.cart.getTotalAmountWithPromotion();
							$('span.total-payment-amount').text(numbro(totalAmount).format());
						}
						else{
							alert('Mã thưởng đã tồn tại!');
						}
					}
					else{
						alert('Mã thưởng không hợp lệ!');
					}
					$('#txtPromotionCode').val('');
				});
			}
		});

		// send contact
		$('#btnSendContact').click(function (argument) {
			thisObj.sendContact();
		});
	},
	calculateFormInfo: function () {
		var thisObj = ketnoimoi.site;
		var delivery_province = $('select[name="ShoppingCart[province_id]"]').val();
		if($('#cboOpenShippingForm:checked').prop('checked')){
			delivery_province = $('select[name="ShoppingCart[shipping_province_id]"]').val();
		}

		// calculate delivery fee & time
		if(delivery_province == ''){
			$('#express-delivery-fee').html('--');
			$('#delivery-time').html('--/--/----');
			$('#express-delivery-fee-pay').html('0');
		}
		if (delivery_province) {
			thisObj.calculateDeliveryDate(delivery_province, function (data) {
				var delivery_method = $('input[name="ShoppingCart[delivery_method_id]"]:checked').val() || 0;
				var delivery_fee_pay = 0;
				$('#express-delivery-fee').html(numbro(data.fee).format());
				if($.parseJSON(delivery_method)){	// express delivery
					delivery_fee_pay = data.fee;
					$('#delivery-time').html(data.express_delivery_days);
				}
				else{
					$('#delivery-time').html(data.standard_delivery_days);
				}
				$('#express-delivery-fee-pay').html(numbro(delivery_fee_pay).format());
				$('input[name="ShoppingCart[shipping_fee]"]').val(delivery_fee_pay);

				var totalAmountWithPromotion = thisObj.cart.getTotalAmountWithPromotion();
				$('span.total-payment-amount').text(numbro(totalAmountWithPromotion + parseFloat(delivery_fee_pay)).format());
			});
		}
		else{
			var totalAmountWithPromotion = thisObj.cart.getTotalAmountWithPromotion();
			$('span.total-payment-amount').text(numbro(totalAmountWithPromotion).format());
		}
		thisObj.validatePurchase();
	},
	getPromotionCode: function (code, callback) {
		$.ajax({
			url: 'promotioncodes/' + code,
			type: 'GET',
			beforeSend: function (argument) {
				
			},
			success: function (data) {
				if (typeof callback == 'function') {
					callback(data);
				}
			},
			error: function (argument) {
				alert('Mã thưởng không hợp lệ!');
			}
		});
	},
	removePromotionCode: function (promotioncode) {
		var thisObj = ketnoimoi.site;
		$('.promotion-code-' + promotioncode).remove();
		thisObj.cart.removePromotionCode(promotioncode);
		var totalAmount = thisObj.cart.getTotalAmountWithPromotion();
		$('span.total-payment-amount').text(numbro(totalAmount).format());
	},
	calculateDeliveryDate: function (province, callback) {
		$.ajax({
			url: 'deliverydetail/' + province,
			type: 'GET',
			beforeSend: function (argument) {
				
			},
			success: function (data) {
				if (typeof callback == 'function') {
					callback(data);
				}
			},
			error: function (argument) {
				
			}
		});
	},
	getDistricts: function (province_id, callback) {
		$.ajax({
			url: 'province/' + province_id + '/districts',
			type: 'GET',
			beforeSend: function (argument) {
				
			},
			success: function (data) {
				if (typeof callback == 'function') {
					callback(data);
				}
			},
			error: function (argument) {
				
			}
		});
	},
	validatePurchase: function (argument) {
		var thisObj = ketnoimoi.site;

		if($("#fromCheckout").length){
			$("#fromCheckout").validate({
				lang: 'vi',
				errorClass: 'text-danger',
				rules: {
					'ShoppingCart[customer_phone]': {
						regex: /^(01[2689]|09)[0-9]{8}$/
					},
					'ShoppingCart[shipping_phone]': {
						number: /^(01[2689]|09)[0-9]{8}$/
					}
				}
			});
		}

		if(thisObj.cart.getTotalAmountWithPromotion() < 100000){
			$('#shoppingcart-notify').text('Giá trị đơn hàng tối thiểu 100.000, bạn vui lòng đặt hàng lại');
			$('#btnDeliveryAndPayment').addClass('disabled');
			return false;
		}
		else{
			$('#shoppingcart-notify').text('');
			$('#btnDeliveryAndPayment').removeClass('disabled');
		}
		if(thisObj.cart.getTotalAmountWithPromotion() >= 5000000 && $('input[name="ShoppingCart[payment_method_id]"]:checked').val() == '1'){
			$('#shoppingcart-notify').text('Giá trị đơn hàng thanh toán COD tối đa: 5.000.000 VND/order. Bạn vui lòng thanh toán chuyển khoản');
			$('#btnConfirmShoppingCart').attr('disabled', 'disabled');
			return false;
		}
		else{
			$('#shoppingcart-notify').text('');
			$('#btnConfirmShoppingCart').removeAttr('disabled');
		}

		return thisObj.cart.purchase();
	},
	sendContact: function () {
		if (!$.validateEmail($('#input-email').val())) {
			alert('Vui lòng nhập chính xác email của bạn!');
			return false;
		};

		$.ajax({
			url: 'lien-he.html',
			type: 'POST',
			data: {
				Contact: {
					full_name:$('#input-name').val(),
					email: $('#input-email').val(),
					phone: 'Không cung cấp',
					subject: 'Liên hệ từ website',
					content: $('#input-enquiry').val()
				}
			},
			beforeSend: function (argument) {
				$btn = $('#btnSendContact').button('loading');
			},
			success: function (data) {
				alert('Nội dung liên hệ của bạn đã tiếp nhận. Chúng tôi sẽ phản hồi bạn trong thời gian sớm nhất!');
				$('#btnSendContact').button('reset');
			},
			error: function (argument) {
				$('#btnSendContact').button('reset');
				alert('Có lỗi xảy ra. Vui lòng thử lại!');
			}
		});
	},
	cart: {
		data: Cookies.getJSON('ShoppingCartData') || [],
		promotionCodes: [],
		addToCart: function(option, notify){
			var thisObj = ketnoimoi.site.cart;
			var _default = {
				product_id: 0,
				product_size_id: 0,
				product_color_id: 0,
				quantity: 0,
				product_price: 0
			};
			$.extend(true, _default, option);
			if(_default.product_id > 0 && _default.quantity > 0){
				var isNew = true;
				$.each(thisObj.data, function(index, item){
					if(item.product_id == _default.product_id && item.product_size_id == _default.product_size_id && item.product_color_id == _default.product_color_id ){
						isNew = false;
						item.quantity = parseInt(item.quantity) + parseInt(_default.quantity);
						if(item.quantity <= 0){
							thisObj.data.splice(index, 1);
							return false;
						}
					}
				});
				if(isNew)
					thisObj.data.push(_default);

				Cookies.set('ShoppingCartData', thisObj.data, { path: '/' });
				if(notify){
					alert('Sản phẩm đã được thêm vào giỏ hàng');
				}
			}
		},
		updateQuantity: function(option){
			var thisObj = this;
			var _default = {
				product_id: 0,
				product_size_id: 0,
				product_color_id: 0,
				quantity: 0,
				product_price: 0
			};
			$.extend(true, _default, option);
			if(_default.product_id > 0){
				$.each(thisObj.data, function(index, item){
					if(item.product_id == _default.product_id && item.product_size_id == _default.product_size_id && item.product_color_id == _default.product_color_id ){
						item.quantity = parseInt(_default.quantity);
						if(item.quantity <= 0){
							thisObj.data.splice(index, 1);
							return false;
						}
					}
				});
				Cookies.set('ShoppingCartData', thisObj.data, { path: '/' });
			}
		},
		changeAttribute: function (option) {
			var thisObj = this;
			var _default = {
				product_id: 0,
				product_size_id: 0,
				product_size_id_to: 0,
				product_color_id: 0,
				product_color_id_to: 0,
				quantity: 0,
				product_price: 0
			};
			$.extend(true, _default, option);
			if(_default.product_id > 0 && _default.quantity > 0){
				var currentQuantity = 0;
				$.each(thisObj.data, function(index, item){
					if(item.product_id == _default.product_id && item.product_size_id == _default.product_size_id && item.product_color_id == _default.product_color_id ){
						currentQuantity = item.quantity;
						thisObj.data.splice(index, 1);
						return false;
					}
				});
				_default.quantity = currentQuantity;
				if (_default.product_size_id_to != 0) {
					_default.product_size_id = _default.product_size_id_to;
				};
				if (_default.product_color_id_to != 0) {
					_default.product_color_id = _default.product_color_id_to;
				}
				delete _default.product_size_id_to;
				delete _default.product_color_id_to;

				thisObj.addToCart(_default);
				location.reload();
			}
		},
		getShoppingCart: function(){
			return Cookies.getJSON('ShoppingCartData') || [];
		},
		getTotalAmount: function(){
			var thisObj = this;
			var count = 0;
			$.each(thisObj.data, function(index, item){
				count += parseInt(item.product_price) * parseInt(item.quantity);
			});

			return count;
		},
		getTotalAmountWithPromotion: function(){
			var thisObj = this;
			var count = 0;
			$.each(thisObj.data, function(index, item){
				count += parseInt(item.product_price) * parseInt(item.quantity);
			});

			// apply promotion code
			$.each(thisObj.promotionCodes, function(index, item){
				count -= parseInt(item.amount);
			});

			return count < 0 ? 0 : count;
		},
		getTotalQuantity: function(){
			var thisObj = this;
			var count = 0;
			$.each(thisObj.data, function(index, item){
				count += parseInt(item.quantity);
			});
			return count;
		},
		getTotalProducts: function(){
			var thisObj = this;
			return thisObj.data.length;
		},
		clearShoppingCart: function(){
			var thisObj = this;
			Cookies.remove('ShoppingCartData');
		},
		applyPromotionCode: function (promotiondata) {
			var thisObj = this;
			var _default = {
				code: '',
				amount: 0
			};
			$.extend(true, _default, promotiondata);
			var exists = false;
			$.each(thisObj.promotionCodes, function (index, item) {
				if(item.code == _default.code){
					exists = true;
					return false
				}
			});
			if(!exists)
				thisObj.promotionCodes.push(_default);

			return !exists;
		},
		removePromotionCode: function (promotioncode) {
			var thisObj = ketnoimoi.site.cart;
			$.each(thisObj.promotionCodes, function (index, item) {
				if (item.code == promotioncode) {
					thisObj.promotionCodes.splice(index, 1);
					return false;
				}
			})
		},
		purchase: function () {
			var thisObj = this;
			var html = '';
			$.each(thisObj.data, function(index, item){
				html += $.format('<input type="hidden" name="ShoppingCart[cartDetails][{0}][product_id]" value="{1}">', index, item.product_id);
				html += $.format('<input type="hidden" name="ShoppingCart[cartDetails][{0}][product_size_id]" value="{1}">', index, item.product_size_id);
				html += $.format('<input type="hidden" name="ShoppingCart[cartDetails][{0}][product_color_id]" value="{1}">', index, item.product_color_id);
				html += $.format('<input type="hidden" name="ShoppingCart[cartDetails][{0}][quantity]" value="{1}">', index, item.quantity);
			});
			$('form').append(html);
			//console.log($('form').serialize());
			return true;
		}
	}
};

$(function () {
	ketnoimoi.site.init();
})