if (typeof ketnoimoi == 'undefined')
	var ketnoimoi = {};
if (typeof ketnoimoi.configs == 'undefined')
	ketnoimoi.configs = {};

ketnoimoi.configs.index = {
	table: null,
	commonControls: [
	{
		'label': 'Key',
		'id': 'key',
		'name': 'Config[key]',
		'type': 'static',
		'placeholder': '',
		'cssclass': '',
		'value': '',
		'disabled': true,
		'readonly': true,
		'datas': [],
		'help_block': '',
		'input_icon': '',
		'dbfieldname': 'key'
	},
	{
		'label': 'Giá trị',
		'id': 'value',
		'name': 'Config[value]',
		'type': 'textarea',
		'required': false,
		'placeholder': '',
		'cssclass': '',
		'value': '0',
		'disabled': false,
		'readonly': false,
		'datas': [],
		'help_block': '',
		'input_icon': '',
		'dbfieldname': 'value'
	}
	],
	init: function () {
		var thisObj = ketnoimoi.configs.index;
		thisObj.initTable();
		thisObj.events();
	},
	initTable: function () {
		var thisObj = ketnoimoi.configs.index;

		thisObj.table = new CDatatable({
			tableId: '#tblEntryList',
			url: '/backend/configs/filter',
			params: null,
			data: [],
			rowId: 'id',
			ordering: false,
			paging: false,
			columns: [
			{ data: "text" },
			{ 
				data: 'value',
				render: function (data, type, row) {
					if(type === 'display'){
						if(data && data.length > 100){
							if (data.indexOf('<iframe') == 0) {
								return '<pre>' + data + '</pre>';
							};
							return $.format('{0}...', data.substring(0, 100));
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
						return $.format('<a href="javascript:;"  data-toggle="modal" data-target="#modalEntry" data-id="{0}"><span data-toggle="tooltip" data-placement="top" title="Thay đổi"><i class="fa fa-edit text-red fa-lg"></i></span></a>', row.id);
					}
					return data;
				}
			}]
		});		
	thisObj.table.init();
},
events: function () {
	var thisObj = ketnoimoi.configs.index;

	$('#btnUpdateSitemap').click(function () {
		$.ketnoimoiAjax({
			url: '/backend/configs/sitemap',
			type: 'POST',
			beforeSend:function () {
				$('#btnUpdateSitemap').button('loading');
			},
			success: function (data, textStatus, jqXHR) {
				toastr['success']("Cập nhật sitemap thành công.", "Thông báo");
				$('#btnUpdateSitemap').button('reset');
			},
			error: function () {
				toastr['warning']("Cập nhật sitemap không thành công.", "Thông báo");
				$('#btnUpdateSitemap').button('reset');
			}
		});
	});

	$('#modalEntry').on('shown.bs.modal', function (event) {
			var control = $(event.relatedTarget);
			var dataId = control.data('id');
			var modal = $(this);
			// if update
			if (dataId) {
				// update attribute form
				$('#entry-form').attr('action', '/backend/configs/' + dataId);
				$('#entry-form #_method').val('PATCH');

				var data = thisObj.table.getdata(dataId);

				$.ketnoimoiAjax({
					url: $('#entry-form').attr('action'),
					type: 'GET',
					success: function (data, textStatus, jqXHR) {
						CControl.init({
							dom:$('#modalEntryContent'), 
							commonControls: thisObj.commonControls, 
							languageControls: [],
							commonData: data,
							languageDatas: []
						});
					}
				});
				modal.find('#modalEntryHeader').text('Đối tượng: ' + data.text);
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
	var thisObj = ketnoimoi.configs.index;

	$.ketnoimoiAjax({
		url: '/backend/configs/' + id,
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
	ketnoimoi.configs.index.init();
});