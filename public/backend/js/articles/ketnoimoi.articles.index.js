if (typeof ketnoimoi == 'undefined')
	var ketnoimoi = {};
if (typeof ketnoimoi.articles == 'undefined')
	ketnoimoi.articles = {};

ketnoimoi.articles.index = {
	table: null,
	commonControls: [
		{
			'label': 'Thông tin chung',
			'type': 'divider'
		},
		{
			'label': 'Key',
			'id': 'key',
			'name': 'Article[key]',
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
			'id': 'articleCategories',
			'name': 'Article[articleCategories][]',
			'type': 'select',
			'required': false,
			'placeholder': '',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'url': '/backend/articlecategories/filter',
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'article_categories',
			'multiple': false
		},
		{
			'label': 'Loại bài viết',
			'id': 'articleTypes',
			'name': 'Article[articleTypes][]',
			'type': 'select',
			'required': false,
			'placeholder': '',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'url': '/backend/articletypes/filter',
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'article_types',
			'multiple': true
		},
		{
			'label': 'Tags',
			'id': 'tags',
			'name': 'Article[tags][]',
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
			'name': 'Article[attachments]',
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
			'label': 'Thứ tự ưu tiên',
			'id': 'priority',
			'name': 'Article[priority]',
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
			'label': 'Bài viết liên quan',
			'id': 'related_articles',
			'name': 'Article[relatedArticles][]',
			'type': 'select',
			'required': false,
			'placeholder': '',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'url': '/backend/articles/filter',
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'related_articles',
			'multiple': true
		},
		{
			'label': 'Xuất bản',
			'id': 'published',
			'name': 'Article[published]',
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
			'name': 'Article[created_by]',
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
			'name': 'Article[updated_by]',
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
			'label': 'Tên bài viết',
			'id': 'name',
			'name': 'Article[ArticleTranslation][locale][name]',
			'type': 'text',
			'required': true,
			'placeholder': 'Tên bài viết',
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
			'label': 'Tóm tắt',
			'id': 'summary',
			'name': 'Article[ArticleTranslation][locale][summary]',
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
			'name': 'Article[ArticleTranslation][locale][content]',
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
			'dbfieldname': 'content'
		},
		{
			'label': 'Meta Description',
			'id': 'meta_description',
			'name': 'Article[ArticleTranslation][locale][meta_description]',
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
			'name': 'Article[ArticleTranslation][locale][meta_keywords]',
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
		var thisObj = ketnoimoi.articles.index;
		thisObj.initFilter();
		//thisObj.initTable();
		thisObj.events();
	},
	initFilter: function () {
		var thisObj = ketnoimoi.articles.index;
		$('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true
        });

		var initCategories = function (callback) {
			$.ketnoimoiAjax({
				url: '/backend/articlecategories/filter',
				type: 'POST',
				success: function (data, textStatus, jqXHR) {
					$.each(data, function (index, item) {
						var html ='';
						html += $.format('<option value="{0}">{1}</option>', item.id, item.name);
						$('#filter_articles_categories').append(html);
					});
					if (typeof callback == 'function') {
						callback();
					};
				}
			});
		}

		var initUsers = function (callback) {
			$.ketnoimoiAjax({
				url: '/backend/users/filter',
				type: 'POST',
				success: function (data, textStatus, jqXHR) {
					$.each(data, function (index, item) {
						var html ='';
						html += $.format('<option value="{0}">{1} {2}</option>', item.id, item.last_name, item.first_name);
						$('#filter_articles_created_by').append(html);
					});
					if (typeof callback == 'function') {
						callback();
					};
				}
			});
		}

		initCategories(initUsers(thisObj.initTable));		
	},
	initTable: function () {
		var thisObj = ketnoimoi.articles.index;

		thisObj.table = new CDatatable({
			tableId: '#tblEntryList',
			url: '/backend/articles/filter',
			params: {
				type: 'filter',
				search: $('#filter_articles_code').val(),
				fromdate: $('#filter_articles_created_at_from').val(),
				todate: $('#filter_articles_created_at_to').val(),
				category: $('#filter_articles_categories').val(),
				createdby: $('#filter_articles_created_by').val(),
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
				data: 'article_categories',
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
				data: 'article_types',
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
				data: 'user_created',
				render: function (data, type, row) {
					if(type === 'display'){
						return  $.format('{0} {1}', data.last_name, data.first_name);
					}
					return data;	
				}
			},
			{
				data: null,
				className: 'text-center',
				render: function (data, type, row) {
					if (type === 'display') {
						var link = '#';
						if (data.article_categories && data.article_categories.length) {
							link = $.format('/{0}/{1}.html', data.article_categories[0].key, data.key);
						};
						
						if(!parseInt(row.not_delete)){
							return $.format('<a data-toggle="tooltip" data-placement="top" title="Xem online" target="_blank" href="{0}"><i class="fa fa-globe fa-lg" aria-hidden="true"></i></a> <a href="javascript:;" data-action="delete" data-id="{1}" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fa fa-trash text-red fa-lg"></i></a>', link, row.id);
						}
						else{
							return $.format('<a data-toggle="tooltip" data-placement="top" title="Xem online" target="_blank" href="{0}"><i class="fa fa-globe fa-lg" aria-hidden="true"></i></a> <a href="javascript:;" data-id="{1}" data-toggle="tooltip" data-placement="top" title="Không được xóa"><i class="fa fa-ban text-red fa-lg"></i></a>', link, row.id);
						}
					}
					return data;
				}
			}]
		});		
	thisObj.table.init();
},
events: function () {
	var thisObj = ketnoimoi.articles.index;

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
				$('#entry-form').attr('action', '/backend/articles/' + dataId);
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
				$('#entry-form').attr('action', '/backend/articles');
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

	$(document).on('click', '#btn_filter_articles', function (argument) {
		$('#tblEntryList').DataTable().destroy();
		ketnoimoi.articles.index.initTable();
	});
},
delete: function (id) {
	var thisObj = ketnoimoi.articles.index;

	$.ketnoimoiAjax({
		url: '/backend/articles/' + id,
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
	ketnoimoi.articles.index.init();
});