if (typeof ketnoimoi == 'undefined')
	var ketnoimoi = {};
if (typeof ketnoimoi.users == 'undefined')
	ketnoimoi.users = {};

ketnoimoi.users.index = {
	table: null,
	init: function () {
		var thisObj = ketnoimoi.users.index;
		thisObj.initTable();
		thisObj.events();
	},
	initTable: function () {
		var thisObj = ketnoimoi.users.index;

		thisObj.table = new CDatatable({
			tableId: '#tblEntryList',
			url: '/backend/users/filter',
			params: null,
			data: [],
			rowId: 'id',
			columns: [
			{ 
				data: "attachments",
				render: function (data, type, row) {
					if (type=== 'display' && data && data.length) {
						data.sort($.sortByProperty('priority'));
						return  $.format('<a href="/backend/users/{0}/edit"><img src="/imagecache/small/{1}" class="img-responsive"></a>', row.id, data[0].path);
					}
					return data;
				}
			},
			{ 
				data: "first_name",
				render: function (data, type, row) {
					if(type === 'display'){
						return  $.format('<a href="/backend/users/{0}/edit">{1} {2}</a>', row.id, row.last_name, data);
					}
					return data;
				}
			},
			{ 
				data: 'mobile_phone',
				className: 'text-right',
			},
			{ 
				data: 'username',
				className: 'text-right',
			},
			{ 
				data: 'email',
				className: 'text-right',
				render: function (data, type, row) {
					if(type === 'display' && data){
						return $.format('{0} <a href="javascript:;" data-action="sendverifyemail" data-id="{1}" data-toggle="tooltip" data-placement="top" title="Gửi email thông tin tài khoản"><i class="fa fa-paper-plane text-green" aria-hidden="true"></i></a>', data, row.id);
					}
					return data;	
				}
			},
			{ 
				data: 'active',
				className: 'text-center',
				render: function (data, type, row) {
					if(type === 'display'){
						if(data){
							return $.format('<a href="javascript:;" data-action="toggleactive" data-id="{0}" data-toggle="tooltip" data-placement="top" title="Nhấp để khóa hoạt đông"><i class="fa fa-check-square-o text-green" aria-hidden="true"></i></a>', row.id);
						}
						else{
							return $.format('<a href="javascript:;" data-action="toggleactive" data-id="{0}" data-toggle="tooltip" data-placement="top" title="Nhấp để cho phép hoạt đông"><i class="fa fa-square-o text-yellow" aria-hidden="true"></i></a>', row.id);
						}
					}
					return data;	
				}
			},
			{ 
				data: 'roles',
				className: 'text-center',
				render: function (data, type, row) {
					if (type === 'display' && data && data.length) {
						var html = '';
						$.each(data, function (index, item) {
							html += $.format('<span class="label label-success">{0}</span> ', item.name);
						});
						return html;
					}
					return data;
				}
			}
			/*
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
			}
			*/
			]
		});		
	thisObj.table.init();
},
events: function () {
	var thisObj = ketnoimoi.users.index;

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
			case 'toggleactive':
				thisObj.toggleActive(dataId);
			break;
			case 'sendverifyemail':
			thisObj.sendVerifyEmail(dataId);
			break
			default:
			break;
		};
	});
},
delete: function (id) {
	var thisObj = ketnoimoi.users.index;

	$.ketnoimoiAjax({
		url: '/backend/users/' + id,
		type: 'DELETE',
		success: function (data, textStatus, jqXHR) {
			toastr['success']("Xóa đối tượng thành công.", "Xóa đối tượng");
			thisObj.table.delrow(id);
		},
		error: function (argument) {
			toastr['error']("Xóa đối tượng không thành công.", "Xóa đối tượng");
		}
	});
},
toggleActive: function (id) {
	var thisObj = ketnoimoi.users.index;

	var currentData = thisObj.table.getdata(id);

	$.ketnoimoiAjax({
		url: '/backend/users/toggleactive',
		type: 'POST',
		data: { id : id },
		success: function (data, textStatus, jqXHR) {
			toastr['success']("Thay đổi thành công.", "Thông báo");
			currentData.active = currentData.active == 1 ? 0 : 1;
			thisObj.table.setdata(id, currentData);
		},
		error: function (argument) {
			toastr['error']("Thay đổi không thành công.", "Thông báo");
		}
	});
},
sendVerifyEmail: function(id) {
	var thisObj = ketnoimoi.users.index;

	$.ketnoimoiAjax({
		url: '/backend/users/sendverifyemail',
		type: 'POST',
		data: { id : id },
		success: function (data, textStatus, jqXHR) {
			toastr['success']("Gửi email thông tin tài khoản thành công.", "Thông báo");
		},
		error: function (argument) {
			toastr['error']("Gửi email thông tin tài khoản không thành công.", "Thông báo");
		}
	});
}
};

$(function () {
	ketnoimoi.users.index.init();
});