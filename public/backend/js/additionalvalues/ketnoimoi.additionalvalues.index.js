if (typeof ketnoimoi == 'undefined')
	var ketnoimoi = {};
if (typeof ketnoimoi.additionalvalues == 'undefined')
	ketnoimoi.additionalvalues = {};

ketnoimoi.additionalvalues.index = {
	table: null,
	commonControls: [
	{
		'label': 'Thông tin chung',
		'type': 'divider'
	},
	{
		'label': 'Đối tượng cha',
		'id': 'additional_category_id',
		'name': 'AdditionalValue[additional_category_id]',
		'type': 'select',
		'required': false,
		'placeholder': '',
		'cssclass': '',
		'value': '',
		'disabled': false,
		'readonly': false,
		'datas': [],
		'help_block': '',
		'input_icon': '',
		'dbfieldname': 'additional_category_id',
		'url': '/backend/additionalcategories/filter',
		'multiple': false
	},
	{
		'label': 'Thứ tự ưu tiên',
		'id': 'priority',
		'name': 'AdditionalValue[priority]',
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
		'dbfieldname': 'priority'
	},
	{
		'label': 'Xuất bản',
		'id': 'published',
		'name': 'AdditionalValue[published]',
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
		'dbfieldname': 'published',
		'selected': true
	},
	{
		'label': 'Tạo bởi',
		'id': 'created_by',
		'name': 'AdditionalValue[created_by]',
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
		'name': 'AdditionalValue[updated_by]',
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
	languageControls: [
	{
		'label': 'Tên đối tượng',
		'id': 'name',
		'name': 'AdditionalValue[AdditionalValueTranslation][locale][name]',
		'type': 'text',
		'required': true,
		'placeholder': 'Tên đối tượng',
		'cssclass': '',
		'value': '',
		'disabled': false,
		'readonly': false,
		'datas': [],
		'help_block': '',
		'input_icon': '',
		'dbfieldname': 'name'
	},
	{
		'label': 'Mô tả đối tượng',
		'id': 'summary',
		'name': 'AdditionalValue[AdditionalValueTranslation][locale][summary]',
		'type': 'textarea',
		'required': false,
		'placeholder': '',
		'cssclass': '',
		'value': '',
		'disabled': false,
		'readonly': false,
		'datas': [],
		'help_block': '',
		'input_icon': '',
		'dbfieldname': 'summary'
	},
	{
		'label': 'Nội dung',
		'id': 'content',
		'name': 'AdditionalValue[AdditionalValueTranslation][locale][content]',
		'type': 'textarea',
		'required': false,
		'placeholder': '',
		'cssclass': '',
		'value': '',
		'disabled': false,
		'readonly': false,
		'datas': [],
		'help_block': '',
		'input_icon': '',
		'dbfieldname': 'content'
	}
	],
	init: function () {
		var thisObj = ketnoimoi.additionalvalues.index;
		thisObj.initTable();
		thisObj.events();
	},
	initTable: function () {
		var thisObj = ketnoimoi.additionalvalues.index;

		thisObj.table = new CDatatable({
			tableId: '#tblEntryList',
			url: '/backend/additionalvalues/filter',
			params: null,
			data: [],
			rowId: 'id',
			columns: [
			{ 
				data: "name",
				render: function (data, type, row) {
					if(type === 'display'){
						return  $.format('<a href="#" data-toggle="modal" data-target="#modalEntry" data-id="{0}">{1}</a>', row.id, data);
					}
					return data;
				}
			},
			{ 
				data: 'priority',
				className: 'text-right',
			},
			{ 
				data: 'published',
				className: 'text-center',
				render: function (data, type, row) {
					if(type === 'display'){
						if(data){
							return $.format('<a href="javascript:;" data-action="unpublish" data-id="{0}" data-toggle="tooltip" data-placement="top" title="Xuất bản"><i class="fa fa-check-square-o text-green" aria-hidden="true"></i></a>', row.id);
						}
						else{
							return $.format('<a href="javascript:;" data-action="publish" data-id="{0}" data-toggle="tooltip" data-placement="top" title="Không xuất bản"><i class="fa fa-square-o text-yellow" aria-hidden="true"></i></a>', row.id);
						}
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
	var thisObj = ketnoimoi.additionalvalues.index;

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
				$('#entry-form').attr('action', '/backend/additionalvalues/' + dataId);
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
				$('#entry-form').attr('action', '/backend/additionalvalues');
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
	var thisObj = ketnoimoi.additionalvalues.index;

	$.ketnoimoiAjax({
		url: '/backend/additionalvalues/' + id,
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
	ketnoimoi.additionalvalues.index.init();
});