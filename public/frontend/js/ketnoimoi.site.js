if(typeof ketnoimoi == 'undefined')
	var ketnoimoi = {};

ketnoimoi.site = {
	init: function () {
		var thisObj = ketnoimoi.site;
		$('span#cart-total').text(thisObj.cart.getTotalQuantity() + ' Sản phẩm');

		thisObj.events();
	},
	events: function () {
		var thisObj = ketnoimoi.site;

		// filter product, sort product
		$('.filter-param, .sort-param').change(function () {
			var urlParams = $.parseQuerystring();
			urlParams[$(this).data('param')] = $(this).val();
			if ($(this).val() == 0 || $(this).val() == '') {
				delete urlParams[$(this).data('param')];
			};

			var queryString = $.param(urlParams);

			window.location = $.format('{0}?{1}', window.location.pathname, queryString);
		});

		// add-to-cart
		$('button.add-to-cart').click(function () {
			var data = $(this).data();
			if ($(this).hasClass('quick-add-to-cart')) {
				data.quantity = 1;
			}
			else{
				data.product_size_id = $('.attr-size select').val();
				data.product_color_id = $('#input-color').val();
				data.quantity = $('#input-quantity').val();
			}

			thisObj.cart.addToCart(data);
			$('span#cart-total').text(thisObj.cart.getTotalQuantity() + ' Sản phẩm');
		});

		// remove item in cart
		$('button.remove-item').click(function () {
			if (confirm("Bạn thật sự muốn xóa sản phẩm này ra khỏi giỏ hàng?")) {
				var data = $(this).data();
				data.quantity = 0;
				thisObj.cart.updateQuantity(data);
				$('span#cart-total').text(thisObj.cart.getTotalQuantity() + ' Sản phẩm');
				$(this).parents('tr').remove();
				
				var shippingFee = numbro().unformat($('span.shipping-cost').text());
				var totalAmount = thisObj.cart.getTotalAmount();

				$('span.total-amount-without-shipping-cost').text(numbro(totalAmount).format());
				$('span.total-amount').text(numbro(totalAmount + shippingFee).format());
			};
		});

		// change item quantity in cart
		$('button.change-quantity').click(function () {
			var data = $(this).data();
			data.quantity = $(this).parents('td').find('input[name="quantity"]').val();
			thisObj.cart.updateQuantity(data);
			$('span#cart-total').text(thisObj.cart.getTotalQuantity() + ' Sản phẩm');
			if (!parseInt(data.quantity)) {
				$(this).parents('tr').remove();
			}

			$(this).parents('tr').find('span.item-amount').text(numbro(data.quantity * data.product_price).format());
			
			var shippingFee = numbro().unformat($('span.shipping-cost').text());
			var totalAmount = thisObj.cart.getTotalAmount();

			$('span.total-amount-without-shipping-cost').text(numbro(totalAmount).format());
			$('span.total-amount').text(numbro(totalAmount + shippingFee).format());
		});

		$('#cart select.change-attribute').change(function () {
			var data = $(this).data();

			if ($(this).hasClass('attribute-color')) {
				data.product_color_id_to = $(this).val();
			};
			if ($(this).hasClass('attribute-size')) {
				data.product_size_id_to = $(this).val();
			};

			thisObj.cart.changeAttribute(data);
		});

		// send contact
		$('#btnSendContact').click(function (argument) {
			thisObj.sendContact();
		});

		$(window).scroll(function(){
			$(".banner-fixed-left, .banner-fixed-right").css("top", Math.max(40, 270 - $(this).scrollTop()));
		});
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
		addToCart: function(option){
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
				alert('Sản phẩm đã được thêm vào giỏ hàng');
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
		getTotalQuantity: function(){
			var thisObj = this;
			var count = 0;
			$.each(thisObj.data, function(index, item){
				count += parseInt(item.quantity);
			});
			return count;
		},
		clearShoppingCart: function(){
			var thisObj = this;
			Cookies.remove('ShoppingCartData');
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
			return true;
		}
	}
};

$(function () {
	ketnoimoi.site.init();
})