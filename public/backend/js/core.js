$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

// config bootbox
bootbox.addLocale('vi', {OK : 'Đồng ý', CANCEL : 'Thoát', CONFIRM : 'Xác nhận'});
bootbox.setLocale('vi');

//(function ($) {

//	'use strict';

$.sortByProperty = function (property) {
	return function (x, y) {
		return ((x[property] === y[property]) ? 0 : ((x[property] > y[property]) ? 1 : -1));
	};
};

$.format = function (text) {
	//check if there are two arguments in the arguments list
	if (arguments.length <= 1) {
		//if there are not 2 or more arguments there's nothing to replace
		//just return the text
		return text;
	}
	//decrement to move to the second argument in the array
	var tokenCount = arguments.length - 2;
	for (var token = 0; token <= tokenCount; ++token) {
		//iterate through the tokens and replace their placeholders from the text in order
		text = text.replace(new RegExp("\\{" + token + "\\}", "gi"), arguments[token + 1]);
	}
	return text;
};

$.ketnoimoiAjax = function (options) {
	return $.ajax(options);
};

$.getLanguages = function (callback) {
	var cookieName = 'ketnoimoi.languages';
	if (Cookies.get(cookieName) != undefined && Cookies.get(cookieName) != null && Cookies.get(cookieName) != '') {
		if (typeof callback == 'function') {
			callback(eval(Cookies.get(cookieName)));
		};
	}
	else{
		$.ketnoimoiAjax({
			url: '/backend/languages',
			type: 'GET',
			success: function (data, textStatus, jqXHR) {
				// save cookie
				Cookies.set(cookieName, data, { path: '/' });

				if (typeof callback == 'function') {
					callback(data);
				};
			}
		});
	}
};

//}(jQuery));









if(typeof ketnoimoi == 'undefined')
	var ketnoimoi = {};

ketnoimoi.core = {
	postForm: function(opts){
		var thisObj = ketnoimoi.core;

		opts = $.extend(true,{
			formId: '',
			containerNotify: '',
			blockContainer: '',
			callback: null
		}, opts)
		opts.formId = opts.formId.indexOf('#') == 0 ? opts.formId : '#' + opts.formId;
		var $form    = $(opts.formId);

		// update value ckeditor instances
		if (CKEDITOR) {
			for (instance in CKEDITOR.instances) {
				CKEDITOR.instances[instance].updateElement();
			}
		}
		
		var formData = new FormData();
		var params   = $form.serializeArray();
		//files    = $form.find('[name="uploadedFiles"]')[0].files;

		/*
		$.each(files, function(i, file) {
			// Prefix the name of uploaded files with "uploadedFiles-"
			// Of course, you can change it to any string
			formData.append('uploadedFiles-' + i, file);
		});
*/

$.each(params, function(i, val) {
	formData.append(val.name, val.value);
});

$.ketnoimoiAjax({
	url: $form.attr('action'),
	data: formData,
	cache: false,
	contentType: false,
	processData: false,
	type: 'POST',
	beforeSend: function (argument) {
		$(opts.blockContainer).block({ message: '<div class="overlay"><i class="fa fa-spinner fa-pulse"></i></div>' });
	},
	success: function(data, textStatus, jqXHR) {
		toastr['success']('Thao tác của bạn đã thực hiện thành công.', 'Thông báo');
		if (typeof(opts.callback) == 'function') {
			opts.callback(data, textStatus, jqXHR);
		};

		$(opts.blockContainer).unblock();
	},
	error: function (jqXHR, textStatus, errorThrown) {
		if (jqXHR.status != 422) {
			toastr['warning'](jqXHR.responseJSON, 'Lỗi');
		};
		$(opts.blockContainer).unblock();
	},
	statusCode: {
		422: function (jqXHR, textStatus, errorThrown) {
			var message = '';
			$.each(jqXHR.responseJSON, function (index, item) {
				message += $.format('{0}</br>', item.toString());
			});
			toastr['warning'](message, 'Lỗi');
		}
	}
});
}
};