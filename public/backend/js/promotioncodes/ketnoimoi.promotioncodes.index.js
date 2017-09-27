if (typeof ketnoimoi == 'undefined')
	var ketnoimoi = {};
if (typeof ketnoimoi.promotioncodes == 'undefined')
	ketnoimoi.promotioncodes = {};

ketnoimoi.promotioncodes.index = {
	table: null,
	commonControls: [
	{
		'label': 'Thông tin chung',
		'type': 'divider'
	},
	{
		'label': 'Mã khuyến mãi',
		'id': 'code',
		'name': 'PromotionCode[code]',
		'type': 'text',
		'required': true,
		'placeholder': 'Mã khuyến mãi',
		'cssclass': '',
		'value': '',
		'disabled': false,
		'readonly': false,
		'datas': [],
		'help_block': '',
		'input_icon': '',
		'dbfieldname': 'code'
	},
	{
		'label': 'Tính theo %',
		'id': 'value_type',
		'name': 'PromotionCode[value_type]',
		'type': 'checkbox',
		'required': false,
		'placeholder': '',
		'cssclass': '',
		'value': '1',
		'disabled': false,
		'readonly': false,
		'datas': [],
		'help_block': '',
		'input_icon': '',
		'dbfieldname': 'value_type',
		'selected': true
	},
	{
		'label': 'Giá trị %',
		'id': 'percent_value',
		'name': 'PromotionCode[percent_value]',
		'type': 'number',
		'required': false,
		'placeholder': '',
		'cssclass': '',
		'value': '0',
		'disabled': false,
		'readonly': false,
		'datas': [],
		'help_block': '',
		'input_icon': '',
		'dbfieldname': 'percent_value'
	},
	{
		'label': 'Giá trị tiền tệ',
		'id': 'cash_value',
		'name': 'PromotionCode[cash_value]',
		'type': 'number',
		'required': false,
		'placeholder': 'Giá trị tiền tệ',
		'cssclass': '',
		'value': '0',
		'disabled': false,
		'readonly': false,
		'datas': [],
		'help_block': '',
		'input_icon': '',
		'dbfieldname': 'cash_value'
	},
	{
		'label': 'Ngày hiệu lực',
		'id': 'effective_date',
		'name': 'PromotionCode[effective_date]',
		'type': 'text',
		'required': true,
		'placeholder': 'Y-m-d',
		'cssclass': '',
		'value': '',
		'disabled': false,
		'readonly': false,
		'datas': [],
		'help_block': '',
		'input_icon': '',
		'dbfieldname': 'effective_date'
	},
	{
		'label': 'Ngày hết hạn',
		'id': 'expiry_date',
		'name': 'PromotionCode[expiry_date]',
		'type': 'text',
		'required': true,
		'placeholder': 'Y-m-d',
		'cssclass': '',
		'value': '',
		'disabled': false,
		'readonly': false,
		'datas': [],
		'help_block': '',
		'input_icon': '',
		'dbfieldname': 'expiry_date'
	},
	{
		'label': 'Số lượng',
		'id': 'quantity',
		'name': 'PromotionCode[quantity]',
		'type': 'number',
		'required': false,
		'placeholder': '',
		'cssclass': '',
		'value': '0',
		'disabled': false,
		'readonly': false,
		'datas': [],
		'help_block': '',
		'input_icon': '',
		'dbfieldname': 'quantity'
	},
	{
		'label': 'Tạo bởi',
		'id': 'created_by',
		'name': 'PromotionCode[created_by]',
		'type': 'static',
		'placeholder': 'Tạo bởi',
		'cssclass': '',
		'value': '',
		'disabled': true,
		'readonly': true,
		'datas': [],
		'help_block': '',
		'input_icon': '',
		'dbfieldname': 'created_by'
	},
	{
		'label': 'Cập nhật bởi',
		'id': 'updated_by',
		'name': 'PromotionCode[updated_by]',
		'type': 'static',
		'placeholder': 'Cập nhật bởi',
		'cssclass': '',
		'value': '',
		'disabled': true,
		'readonly': true,
		'datas': [],
		'help_block': '',
		'input_icon': '',
		'dbfieldname': 'updated_by'
	}
	],
	languageControls: [],
	init: function () {
		var thisObj = ketnoimoi.promotioncodes.index;
		thisObj.initTable();
		thisObj.events();
	},
	initTable: function () {
		var thisObj = ketnoimoi.promotioncodes.index;

		thisObj.table = new CDatatable({
			tableId: '#tblEntryList',
			url: '/backend/promotioncodes/filter',
			params: null,
			data: [],
			rowId: 'id',
			columns: [
			{ 
				data: "code",
				render: function (data, type, row) {
					if(type === 'display'){
						return  $.format('<a href="#" data-toggle="modal" data-target="#modalEntry" data-id="{0}">{1}</a>', row.id, data);
					}
					return data;
				}
			},
			{ 
				data: 'value_type',
				className: 'text-center',
				render: function (data, type, row) {
					if(type === 'display'){
						if(data){
							return $.format('<a href="javascript:;" data-action="" data-id="{0}" data-toggle="tooltip" data-placement="top" title="Tính theo %"><i class="fa fa-check-square-o text-green" aria-hidden="true"></i></a>', row.id);
						}
						else{
							return $.format('<a href="javascript:;" data-action="" data-id="{0}" data-toggle="tooltip" data-placement="top" title="Tính theo tiền tệ"><i class="fa fa-square-o text-yellow" aria-hidden="true"></i></a>', row.id);
						}
					}
					return data;
				}
			},
			{ 
				data: 'percent_value',
				className: 'text-right',
			},
			{ 
				data: 'cash_value',
				className: 'text-right',
				render: function (data, type, row) {
					if(type === 'display'){
						return numbro(data).format();
					}
					return data;
				}
			},
			{ 
				data: 'effective_date',
				className: 'text-center',
				render: function (data, type, row) {
					if(type === 'display' && data.date){
						return moment(data.date).format('YYYY-MM-DD');
					}
					return data;
				}
			},
			{ 
				data: 'expiry_date',
				className: 'text-center',
				render: function (data, type, row) {
					if(type === 'display' && data.date){
						return moment(data.date).format('YYYY-MM-DD');
					}
					return data;
				}
			},
			{ 
				data: 'quantity',
				className: 'text-right',
				render: function (data, type, row) {
					if(type === 'display'){
						return numbro(data).format();
					}
					return data;
				}
			},
			{ 
				data: 'quantity_used',
				className: 'text-right',
				render: function (data, type, row) {
					if(type === 'display'){
						return numbro(data).format();
					}
					return data;
				}
			},
			{
				data: null,
				className: 'text-center',
				render: function (data, type, row) {
					if (type === 'display') {
						if(!parseInt(row.not_delete)){
							return $.format('<a href="javascript:;" data-action="delete" data-id="{0}" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fa fa-trash text-red fa-lg"></i></a>', row.id);
						}
						else{
							return $.format('<a href="javascript:;" data-id="{0}" data-toggle="tooltip" data-placement="top" title="Không được xóa"><i class="fa fa-ban text-red fa-lg"></i></a>', row.id);
						}
					}
					return data;
				}
			}]
		});		
	thisObj.table.init();
},
events: function () {
	var thisObj = ketnoimoi.promotioncodes.index;

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
			default:
			break;
		};
	});

	$('#modalEntry').on('shown.bs.modal', function (event) {
			var control = $(event.relatedTarget);
			var dataId = control.data('id');
			var modal = $(this);
			// if update
			if (dataId) {
				// update attribute form
				$('#entry-form').attr('action', '/backend/promotioncodes/' + dataId);
				$('#entry-form #_method').val('PATCH');

				var data = thisObj.table.getdata(dataId);

				$.ketnoimoiAjax({
					url: $('#entry-form').attr('action'),
					type: 'GET',
					success: function (data, textStatus, jqXHR) {
						CControl.init({
							dom:$('#modalEntryContent'), 
							commonControls: thisObj.commonControls, 
							languageControls: thisObj.languageControls,
							commonData: data,
							languageDatas: data.translations
						});
					}
				});
				modal.find('#modalEntryHeader').text('Đối tượng: ' + data.name);
			}
			else{
				// update attribute form
				$('#entry-form').attr('action', '/backend/promotioncodes');
				$('#entry-form #_method').val('POST');
				$('#entry-form')[0].reset();

				modal.find('#modalEntryHeader').text('Đối tượng mới')

				CControl.init({
					dom:$('#modalEntryContent'), 
					commonControls: thisObj.commonControls, 
					languageControls: thisObj.languageControls
				});
			}
		});

	$('#entry-form').submit(function(e){
			e.preventDefault();
			ketnoimoi.core.postForm({
				formId: 'entry-form',
				containerNotify: 'container-notify',
				blockContainer: '#modalEntry .modal-content',
				callback: function (data, textStatus, jqXHR) {
					if(!$('#entry-form input[name="_method"]').length || $('#entry-form input[name="_method"]').val().toUpperCase() == 'POST'){
						$('#entry-form')[0].reset();
						
						// add entry to table list
						thisObj.table.addrow(data);
					}
					else{
						// update entry to table list
						thisObj.table.setdata(data.id, data);
					}
					$('#modalEntry').modal('hide');
				}
			});
		});
},
delete: function (id) {
	var thisObj = ketnoimoi.promotioncodes.index;

	$.ketnoimoiAjax({
		url: '/backend/promotioncodes/' + id,
		type: 'DELETE',
		success: function (data, textStatus, jqXHR) {
			toastr['success']("Xóa đối tượng thành công.", "Xóa đối tượng");
			thisObj.table.delrow(id);
		},
		error: function (argument) {
			toastr['error']("Xóa đối tượng không thành công.", "Xóa đối tượng");
		}
	});
}
};

$(function () {
	ketnoimoi.promotioncodes.index.init();
});