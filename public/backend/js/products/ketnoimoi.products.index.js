if (typeof ketnoimoi == 'undefined')
	var ketnoimoi = {};
if (typeof ketnoimoi.products == 'undefined')
	ketnoimoi.products = {};

ketnoimoi.products.index = {
	table: null,
	commonControls: [
		{
			'label': 'Thông tin chung',
			'type': 'divider'
		},
		{
			'label': 'Key',
			'id': 'key',
			'name': 'Product[key]',
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
			'label': 'Mã sản phẩm',
			'id': 'code',
			'name': 'Product[code]',
			'type': 'text',
			'required': true,
			'placeholder': 'Mã sản phẩm',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'help_block': 'Mã sản phẩm không được trùng với sản phẩm khác.',
			'input_icon': '',
			'dbfieldname': 'code'
		},
		{
			'label': 'Model',
			'id': 'model',
			'name': 'Product[model]',
			'type': 'text',
			'required': false,
			'placeholder': 'Model',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'model'
		},
		{
			'label': 'Danh mục sản phẩm',
			'id': 'product_categories',
			'name': 'Product[productCategories][]',
			'type': 'select',
			'required': false,
			'placeholder': '',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'url': '/backend/productcategories/filter',
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'product_categories',
			'multiple': true
		},
		{
			'label': 'Loại sản phẩm',
			'id': 'product_types',
			'name': 'Product[productTypes][]',
			'type': 'select',
			'required': false,
			'placeholder': '',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'url': '/backend/producttypes/filter',
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'product_types',
			'multiple': true
		},
		{
			'label': 'Tags',
			'id': 'tags',
			'name': 'Product[tags][]',
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
			'label': 'Màu sắc',
			'id': 'product_colors',
			'name': 'Product[productColors][]',
			'type': 'select',
			'required': false,
			'placeholder': '',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'url': '/backend/productcolors/filter',
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'product_colors',
			'multiple': true
		},
		{
			'label': 'Kích thước',
			'id': 'product_sizes',
			'name': 'Product[productSizes][]',
			'type': 'select',
			'required': false,
			'placeholder': '',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'url': '/backend/productsizes/filter',
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'product_sizes',
			'multiple': true
		},
		{
			'label': 'Kích thước riêng',
			'id': 'custom_size',
			'name': 'Product[custom_size]',
			'type': 'text',
			'required': false,
			'placeholder': 'Kích thước riêng',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'custom_size'
		},
		{
			'label': 'Nhà sản xuất',
			'id': 'producer_id',
			'name': 'Product[producer_id]',
			'type': 'select',
			'required': false,
			'placeholder': '',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'url': '/backend/producers/filter',
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'producer_id',
			'multiple': true
		},
		{
			'label': 'Xuất xứ',
			'id': 'origin',
			'name': 'Product[origin]',
			'type': 'text',
			'required': false,
			'placeholder': 'Xuất xứ',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'origin'
		},
		{
			'label': 'Đơn vị tính',
			'id': 'unit',
			'name': 'Product[unit]',
			'type': 'text',
			'required': false,
			'placeholder': 'Đơn vị tính',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'unit'
		},
		{
			'label': 'Trọng lượng (gram)',
			'id': 'weight',
			'name': 'Product[weight]',
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
			'dbfieldname': 'weight'
		},
		{
			'label': 'Bảo hành',
			'id': 'warranty',
			'name': 'Product[warranty]',
			'type': 'text',
			'required': false,
			'placeholder': 'Bảo hành',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'warranty'
		},
		{
			'label': 'Số lượng trong kho',
			'id': 'inventory_quantity',
			'name': 'Product[inventory_quantity]',
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
			'dbfieldname': 'inventory_quantity'
		},
		{
			'label': 'Ngày có hàng',
			'id': 'instock_date',
			'name': 'Product[instock_date]',
			'type': 'text',
			'required': false,
			'placeholder': 'yyyy-mm-dd',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'instock_date'
		},
		{
			'label': 'Giá sản phẩm',
			'id': 'price',
			'name': 'Product[price]',
			'type': 'number',
			'required': true,
			'placeholder': 'Giá sản phẩm',
			'cssclass': '',
			'value': '0',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'price'
		},
		{
			'label': 'Giảm giá',
			'id': 'sale_price',
			'name': 'Product[sale_price]',
			'type': 'number',
			'required': true,
			'placeholder': 'Giá sản phẩm',
			'cssclass': '',
			'value': '0',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'sale_price'
		},
		{
			'label': 'Giảm giá (%)',
			'id': 'sale_ratio',
			'name': 'Product[sale_ratio]',
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
			'dbfieldname': 'sale_ratio'
		},
		{
			'label': 'Thứ tự ưu tiên',
			'id': 'priority',
			'name': 'Product[priority]',
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
			'label': 'Hình ảnh',
			'id': 'attachments',
			'name': 'Product[attachments]',
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
			'label': 'Sản phẩm liên quan',
			'id': 'related_products',
			'name': 'Product[relatedProducts][]',
			'type': 'select',
			'required': false,
			'placeholder': '',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'url': '/backend/products/filter',
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'related_products',
			'multiple': true
		},

		{
			'label': 'Trạng thái hàng hóa',
			'id': 'availability',
			'name': 'Product[availability]',
			'type': 'select',
			'required': false,
			'placeholder': '',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [{'value': 'instock', 'text': 'Có hàng', 'id': 'instock', selected: true}, {'value': 'outofstock', 'text': 'Hết hàng', 'id': 'outofstock', selected: false}, {'value': 'preorder', 'text': 'Sắp có hàng', 'id': 'preorder', selected: false}, {'value': 'availablefororder', 'text': 'Có hàng trong 1-2 tuần', 'id': 'availablefororder', selected: false}],
			'url': '',
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'availability',
			'multiple': false
		},
		{
			'label': 'Xuất bản',
			'id': 'published',
			'name': 'Product[published]',
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
			'name': 'Product[created_by]',
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
			'name': 'Product[updated_by]',
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
		'name': 'Product[ProductTranslation][locale][name]',
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
		'name': 'Product[ProductTranslation][locale][summary]',
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
		'label': 'Thông tin chi tiết',
		'id': 'description',
		'name': 'Product[ProductTranslation][locale][description]',
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
	},{
		'label': 'Thông tin thêm',
		'id': 'additional_information',
		'name': 'Product[ProductTranslation][locale][additional_information]',
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
		'dbfieldname': 'additional_information'
	},
	{
		'label': 'Meta Description',
		'id': 'meta_description',
		'name': 'Product[ProductTranslation][locale][meta_description]',
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
		'name': 'Product[ProductTranslation][locale][meta_keywords]',
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
		var thisObj = ketnoimoi.products.index;
		thisObj.initTable();
		thisObj.events();
	},
	initTable: function () {
		var thisObj = ketnoimoi.products.index;

		thisObj.table = new CDatatable({
			tableId: '#tblEntryList',
			url: '/backend/products/filter',
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
				data: 'inventory_quantity',
				className: 'text-right',
				render: function (data, type, row) {
					if (type=== 'display') {
						return numbro(data).format();
					}
					return data;
				}
			},
			{ 
				data: 'priority',
				className: 'text-right'
			},
			{
				data: 'product_categories',
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
				data: 'product_types',
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
	var thisObj = ketnoimoi.products.index;

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
				$('#entry-form').attr('action', '/backend/products/' + dataId);
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
				$('#entry-form').attr('action', '/backend/products');
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
	var thisObj = ketnoimoi.products.index;

	$.ketnoimoiAjax({
		url: '/backend/products/' + id,
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
	ketnoimoi.products.index.init();
});