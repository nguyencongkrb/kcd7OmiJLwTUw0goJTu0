if (typeof ketnoimoi == 'undefined')
	var ketnoimoi = {};
if (typeof ketnoimoi.projects == 'undefined')
	ketnoimoi.projects = {};

ketnoimoi.projects.index = {
	table: null,
	commonControls: [
		{
			'label': 'Thông tin chung',
			'type': 'divider'
		},
		{
			'label': 'Key',
			'id': 'key',
			'name': 'Project[key]',
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
			'label': 'Danh mục',
			'id': 'ProjectCategories',
			'name': 'Project[projectCategories][]',
			'type': 'select',
			'required': false,
			'placeholder': '',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'url': '/backend/projectcategories/filter',
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'project_categories',
			'multiple': true
		},
		{
			'label': 'Loại bài viết',
			'id': 'ProjectTypes',
			'name': 'Project[projectTypes][]',
			'type': 'select',
			'required': false,
			'placeholder': '',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'url': '/backend/projecttypes/filter',
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'project_types',
			'multiple': true
		},
		{
			'label': 'Tags',
			'id': 'tags',
			'name': 'Project[tags][]',
			'type': 'select',
			'required': false,
			'placeholder': '',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'url': '/backend/tags/filter',
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'tags',
			'multiple': true
		},
		{
			'label': 'Hình ảnh',
			'id': 'attachments',
			'name': 'Project[attachments]',
			'type': 'inputimages',
			'required': false,
			'placeholder': '',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'attachments',
			'selected': true
		},
		{
			'label': 'Thời gian',
			'id': 'execution_time',
			'name': 'Project[execution_time]',
			'type': 'text',
			'required': false,
			'placeholder': 'yyyy-mm-dd',
			'cssclass': '',
			'value': '0',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'execution_time'
		},
		{
			'label': 'Website',
			'id': 'website',
			'name': 'Project[website]',
			'type': 'text',
			'required': false,
			'placeholder': '',
			'cssclass': '',
			'value': '0',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'website'
		},
		{
			'label': 'Thứ tự ưu tiên',
			'id': 'priority',
			'name': 'Project[priority]',
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
			'name': 'Project[published]',
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
			'name': 'Project[created_by]',
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
			'name': 'Project[updated_by]',
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
			'label': 'Tên dự án',
			'id': 'name',
			'name': 'Project[ProjectTranslation][locale][name]',
			'type': 'text',
			'required': true,
			'placeholder': 'Tên dự án',
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
			'label': 'Tên khách hàng',
			'id': 'client_name',
			'name': 'Project[ProjectTranslation][locale][client_name]',
			'type': 'text',
			'required': true,
			'placeholder': 'Tên khách hàng',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'client_name'
		},
		{
			'label': 'Tóm tắt',
			'id': 'summary',
			'name': 'Project[ProjectTranslation][locale][summary]',
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
			'id': 'description',
			'name': 'Project[ProjectTranslation][locale][description]',
			'type': 'editor',
			'required': false,
			'placeholder': '',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'description'
		},
		{
			'label': 'Meta Description',
			'id': 'meta_description',
			'name': 'Project[ProjectTranslation][locale][meta_description]',
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
			'dbfieldname': 'meta_description'
		},
		{
			'label': 'Meta Keywords',
			'id': 'meta_keywords',
			'name': 'Project[ProjectTranslation][locale][meta_keywords]',
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
			'dbfieldname': 'meta_keywords'
		}
	],
	init: function () {
		var thisObj = ketnoimoi.projects.index;
		thisObj.initTable();
		thisObj.events();
	},
	initTable: function () {
		var thisObj = ketnoimoi.projects.index;

		thisObj.table = new CDatatable({
			tableId: '#tblEntryList',
			url: '/backend/projects/filter',
			params: null,
			data: [],
			rowId: 'id',
			columns: [
			{ 
				data: "attachments",
				render: function (data, type, row) {
					if (type=== 'display' && data && data.length) {
						data.sort($.sortByProperty('priority'));
						return  $.format('<a href="#" data-toggle="modal" data-target="#modalEntry" data-id="{0}"><img src="/imagecache/small/{1}" class="img-responsive"></a>', row.id, data[0].path);
					}
					return data;
				}
			},
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
				data: 'project_categories',
				render: function (data, type, row) {
					if (type=== 'display' && data && data.length) {
						data.sort($.sortByProperty('id'));
						var html = '';
						$.each(data, function (index, item) {
							html += $.format('<span class="label label-success">{0}</span> ', item.name);
						});
						return html;
					}
					return data;
				}
			},
			{
				data: 'project_types',
				render: function (data, type, row) {
					if (type=== 'display' && data && data.length) {
						data.sort($.sortByProperty('id'));
						var html = '';
						$.each(data, function (index, item) {
							html += $.format('<span class="label label-success">{0}</span> ', item.name);
						});
						return html;
					}
					return data;
				}
			},
			{
				data: 'tags',
				render: function (data, type, row) {
					if (type=== 'display' && data && data.length) {
						data.sort($.sortByProperty('id'));
						var html = '';
						$.each(data, function (index, item) {
							html += $.format('<span class="label label-success">{0}</span> ', item.name);
						});
						return html;
					}
					return data;
				}
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
	var thisObj = ketnoimoi.projects.index;

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
				$('#entry-form').attr('action', '/backend/projects/' + dataId);
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
				$('#entry-form').attr('action', '/backend/projects');
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
	var thisObj = ketnoimoi.projects.index;

	$.ketnoimoiAjax({
		url: '/backend/projects/' + id,
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
	ketnoimoi.projects.index.init();
});