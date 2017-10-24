if (typeof ketnoimoi == 'undefined')
	var ketnoimoi = {};
if (typeof ketnoimoi.shoppingcarts == 'undefined')
	ketnoimoi.shoppingcarts = {};

ketnoimoi.shoppingcarts.show = {
	init: function () {
		var thisObj = ketnoimoi.shoppingcarts.show;
		thisObj.events();
	},
	events: function () {
		var thisObj = ketnoimoi.shoppingcarts.show;

		$(document).on('click', 'a[data-action]', function (argument) {
			var dataId = $(this).data('id');
			var action = $(this).data('action');
			switch(action){
				case 'updatestatus':
				var value = $(this).data('value');
				thisObj.updateStatus(dataId, value);
				break;
				case 'updatepaymentstatus':
				var value = $(this).data('value');
				thisObj.updatePaymentStatus(dataId, value);
				break;
				case 'updateinvoicestatus':
				var value = $(this).data('value');
				thisObj.updateInvoiceStatus(dataId, value);
				break;
				default:
				break;
			};
		});
	},
	updateStatus: function (id, status) {
		var thisObj = ketnoimoi.shoppingcarts.show;

		$.ketnoimoiAjax({
			url: '/backend/shoppingcarts/' + id,
			type: 'PATCH',
			data: {
				ShoppingCart: {
					shopping_cart_status_id: status
				}
			},
			success: function (data, textStatus, jqXHR) {
				toastr['success']("Cập nhật trạng thái thành công.", "Cập nhật trạng thái");
				location.reload();
			},
			error: function (jqXHR, textStatus, errorThrown) {
				toastr['error']("Cập nhật trạng thái không thành công.", "Cập nhật trạng thái");
			}
		});
	},
	updatePaymentStatus: function (id, status) {
		var thisObj = ketnoimoi.shoppingcarts.show;

		$.ketnoimoiAjax({
			url: '/backend/shoppingcarts/' + id,
			type: 'PATCH',
			data: {
				ShoppingCart: {
					payment_status: status
				}
			},
			success: function (data, textStatus, jqXHR) {
				toastr['success']("Cập nhật trạng thái thanh toán thành công.", "Thanh toán");
				location.reload();
			},
			error: function (argument) {
				toastr['error']("Cập nhật trạng thái thanh toán không thành công.", "Thanh toán");
			}
		});
	},
	updateInvoiceStatus: function (id, status) {
		var thisObj = ketnoimoi.shoppingcarts.show;

		$.ketnoimoiAjax({
			url: '/backend/shoppingcarts/' + id,
			type: 'PATCH',
			data: {
				ShoppingCart: {
					invoice_exported: status
				}
			},
			success: function (data, textStatus, jqXHR) {
				toastr['success']("Cập nhật trạng thái hoá đơn thành công.", "Hoá đơn");
				location.reload();
			},
			error: function (argument) {
				toastr['error']("Cập nhật trạng thái hoá đơn không thành công.", "Hoá đơn");
			}
		});
	}
};

$(function () {
	ketnoimoi.shoppingcarts.show.init();
});