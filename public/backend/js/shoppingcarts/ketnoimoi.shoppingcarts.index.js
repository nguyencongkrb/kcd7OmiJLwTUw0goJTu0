if (typeof ketnoimoi == 'undefined')
	var ketnoimoi = {};
if (typeof ketnoimoi.shoppingcarts == 'undefined')
	ketnoimoi.shoppingcarts = {};

ketnoimoi.shoppingcarts.index = {
	table: null,
	commonControls: [],
	languageControls: [],
	init: function () {
		var thisObj = ketnoimoi.shoppingcarts.index;
		thisObj.initFilter();
		thisObj.events();
	},
	initFilter: function () {
		var thisObj = ketnoimoi.shoppingcarts.index;
		$('.datepicker').datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true,
			todayHighlight: true
		});

		var initStautuses = function (callback) {
			$.ketnoimoiAjax({
				url: '/backend/shoppingcartstatuses/filter',
				type: 'POST',
				success: function (data, textStatus, jqXHR) {
					$.each(data, function (index, item) {
						var html ='';
						html += $.format('<option value="{0}">{1}</option>', item.id, item.name);
						$('#filter_shoppingcarts_statuses').append(html);
					});
					if (typeof callback == 'function') {
						callback();
					};
				}
			});
		};

		initStautuses(thisObj.initTable);
	},
	initTable: function () {
		var thisObj = ketnoimoi.shoppingcarts.index;

		thisObj.table = new CDatatable({
			tableId: '#tblEntryList',
			url: '/backend/shoppingcarts/filter',
			params: {
				type: 'filter',
				search: $('#filter_shoppingcarts_code').val(),
				fromdate: $('#filter_shoppingcarts_created_at_from').val(),
				todate: $('#filter_shoppingcarts_created_at_to').val(),
				status: $('#filter_shoppingcarts_statuses').val(),
				payment_status: $('#filter_shoppingcarts_payment_status').val(),
			},
			data: [],
			rowId: 'id',
			order: [[ 0, "desc" ]],
			searching: false,
			columns: [
			{
				data: 'id',
				visible: false
			},
			{ 
				data: 'code',
				className: 'text-center',
				render: function (data, type, row) {
					if (type === 'display') {
						return $.format('<a href="/backend/shoppingcarts/{0}">{1}</a>', row.id, data);
					}
					return data;
				}
			},
			{ 
				data: 'created_at',
				className: 'text-center',
				render: function (data, type, row) {
					if (type === 'display') {
						return moment(data).format('DD/MM/Y');
					}
					return data;
				}
			},
			{ 
				data: 'user_created.username'
			},
			{ 
				data: 'customer_name'
			},
			{ 
				data: 'customer_phone'
			},
			{
				data: 'total_payment_amount',
				className: 'text-right',
				render: function (data, type, row) {
					if (type === 'display') {
						return numbro(data).format();
					}
					return data;
				}
			},
			{
				data: 'payment_status',
				className: 'text-center',
				render: function (data, type, row) {
					if (type === 'display') {
						if($.parseJSON(data)){
							return $.format('<a href="javascript:;" data-action="updatepaymentstatus" data-id="{0}" data-value="0" data-toggle="tooltip" data-placement="top" title="Đã thanh toán"><i class="fa fa-check-square-o text-green" aria-hidden="true"></i></a>', row.id);
						}
						else{
							return $.format('<a href="javascript:;" data-action="updatepaymentstatus" data-id="{0}" data-value="1" data-toggle="tooltip" data-placement="top" title="Chưa thanh toán"><i class="fa fa-square-o text-yellow" aria-hidden="true"></i></a>', row.id);
						}
					}
					return data;
				}
			},
			{
				data: 'status',
				className: 'text-right',
				render: function (data, type, row) {
					if (type === 'display' && data) {
						var cssClass = $.parseJSON(data.id) == 1 ? 'danger' : ($.parseJSON(data.id) == 5 ? 'success' : 'info');
						var template = '<div class="btn-group">\
						<button type="button" class="btn btn-{0} btn-flat btn-xs">{1}</button>\
						<button type="button" class="btn btn-{0} btn-flat btn-xs dropdown-toggle" data-toggle="dropdown">\
						<span class="caret"></span>\
						<span class="sr-only">Toggle Dropdown</span>\
						</button>\
						<ul class="dropdown-menu" role="menu">\
						<li><a href="#" data-action="updatestatus" data-id="{2}" data-value="3">Đã xác nhận</a></li>\
						<li><a href="#" data-action="updatestatus" data-id="{2}" data-value="4">Đang giao hàng</a></li>\
						<li><a href="#" data-action="updatestatus" data-id="{2}" data-value="5">Đã giao hàng</a></li>\
						<li class="divider"></li>\
						<li><a href="#" data-action="updatestatus" data-id="{2}" data-value="1">Huỷ đơn hàng</a></li>\
						</ul>\
						</div>';
						return $.format(template, cssClass, data.name, row.id);
					}
					return data;
				}
			},
			{
				data: 'invoice_exported',
				className: 'text-center',
				render: function (data, type, row) {
					if (type === 'display') {
						if($.parseJSON(row.invoice_export)){
							if($.parseJSON(data)){
								return $.format('<a href="javascript:;" data-action="updateinvoicestatus" data-id="{0}" data-value="0" data-toggle="tooltip" data-placement="top" title="Đã xuất"><i class="fa fa-check-square-o text-green" aria-hidden="true"></i></a>', row.id);
							}
							else{
								return $.format('<a href="javascript:;" data-action="updateinvoicestatus" data-id="{0}" data-value="1" data-toggle="tooltip" data-placement="top" title="Chưa xuất"><i class="fa fa-square-o text-yellow" aria-hidden="true"></i></a>', row.id);
							}
						}
						return '';
					}
					return data;
				}
			}]
		});		
		thisObj.table.init();
},
events: function () {
	var thisObj = ketnoimoi.shoppingcarts.index;

	$(document).on('click', 'a[data-action]', function (argument) {
		var dataId = $(this).data('id');
		var action = $(this).data('action');
		switch(action){
			case 'delete':
			bootbox.confirm("Bạn thật sự muốn xóa đối tượng này?", function(result) {
				if (result) {
					thisObj.delete(dataId);
				}
			});
			break;
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

	$(document).on('click', '#btn_filter_shoppingcarts', function (argument) {
		$('#tblEntryList').DataTable().destroy();
		ketnoimoi.shoppingcarts.index.initTable();
	});
},
updateStatus: function (id, status) {
	var thisObj = ketnoimoi.shoppingcarts.index;
	var currentData = thisObj.table.getdata(id);

	$.ketnoimoiAjax({
		url: '/backend/shoppingcarts/' + id,
		type: 'PATCH',
		data: {
			ShoppingCart: {
				shopping_cart_status_id: status
			}
		},
		success: function (data, textStatus, jqXHR) {
			var statusData = {
				id: status,
				name: $('#filter_shoppingcarts_statuses option[value="' + status + '"]').text()
			};
			currentData.status = statusData;
			thisObj.table.setdata(id, currentData);
			toastr['success']("Cập nhật trạng thái thành công.", "Cập nhật trạng thái");
		},
		error: function (jqXHR, textStatus, errorThrown) {
			toastr['error']("Cập nhật trạng thái không thành công.", "Cập nhật trạng thái");
		}
	});
},
updatePaymentStatus: function (id, status) {
	var thisObj = ketnoimoi.shoppingcarts.index;
	var currentData = thisObj.table.getdata(id);

	$.ketnoimoiAjax({
		url: '/backend/shoppingcarts/' + id,
		type: 'PATCH',
		data: {
			ShoppingCart: {
				payment_status: status
			}
		},
		success: function (data, textStatus, jqXHR) {
			currentData.payment_status = status;
			thisObj.table.setdata(id, currentData);
			toastr['success']("Cập nhật trạng thái thanh toán thành công.", "Thanh toán");
		},
		error: function (argument) {
			toastr['error']("Cập nhật trạng thái thanh toán không thành công.", "Thanh toán");
		}
	});
},
updateInvoiceStatus: function (id, status) {
	var thisObj = ketnoimoi.shoppingcarts.index;
	var currentData = thisObj.table.getdata(id);

	$.ketnoimoiAjax({
		url: '/backend/shoppingcarts/' + id,
		type: 'PATCH',
		data: {
			ShoppingCart: {
				invoice_exported: status
			}
		},
		success: function (data, textStatus, jqXHR) {
			currentData.invoice_exported = status;
			thisObj.table.setdata(id, currentData);
			toastr['success']("Cập nhật trạng thái hoá đơn thành công.", "Hoá đơn");
		},
		error: function (argument) {
			toastr['error']("Cập nhật trạng thái hoá đơn không thành công.", "Hoá đơn");
		}
	});
}
};

$(function () {
	ketnoimoi.shoppingcarts.index.init();
});