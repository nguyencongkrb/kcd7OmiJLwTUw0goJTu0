/**
CControl.js

Required:
bootstrap-fileinput
ckeditor
select2

var datas = [{
'label': '',
'id': '',
'name': '',
'type': 'text', // text, password, datetime, datetime-local, date, month, time, week, number, email, url, search, tel, color, select, textarea, static, checkboxlist, radiolist, inputfile, inputimages, editor, inputtag, calendar, divider
'required': false,
'placeholder': '',
'cssclass': '',
'value': '',
'disabled': false,
'readonly': false,
'datas': [],    // {'value': '', 'text': '', 'id': '', selected: false}, data for select, checkboxlist, radio
'url': '',	// url get data
'help_block': '',
'input_icon': '',
'dbfieldname': '',
'selected': true,	// checked for checkbox
'multiple': true,	// multiple select for select2
'joinfield': ''	// dung cho staticjoinstring
}
];
 **/

var CControl = function () {

	// private functions & variables

	var _dom;

	var _getHTMLText = function (options) {
		options.input_icon = $.trim(options.input_icon) == '' ? 'fa fa-angle-right' : options.input_icon;

		var template = '<div class="form-group">\
				<label for="{0}" class="col-md-2 control-label">{1}</label>\
				<div class="col-md-10">\
				<input type="{3}" id="{0}" name="{4}" placeholder="{5}" class="form-control {6}" value="{7}" {8} {9} {10} data-languagecontrol="{11}" data-dbfieldname="{12}">\
				<span id="help-block-{0}" class="help-block">{13}</span>\
				</div>\
				</div>';
		var resutlHtml = $.format(template, options.id, options.label, options.input_icon, options.type, options.name, options.placeholder, options.cssclass, options.value, options.disabled ? 'disabled' : '', options.readonly ? 'readonly' : '', options.required ? 'required' : '', options.languagecontrol, options.dbfieldname, options.help_block);
		return resutlHtml;
	};

	var _getHTMLTextarea = function (options) {
		options.input_icon = $.trim(options.input_icon) == '' ? 'fa fa-angle-right' : options.input_icon;
		var template = '<div class="form-group">\
				<label for="{2}" class="col-md-2 control-label">{0}</label>\
				<div class="col-md-10">\
				<textarea rows="3" id="{2}" name="{3}" placeholder="{4}" class="form-control {5}" {6} {7} {8} data-languagecontrol="{9}" data-dbfieldname="{10}">{11}</textarea>\
				<span id="help-block-{2}" class="help-block">{12}</span>\
				</div>\
				</div>';
		var resutlHtml = $.format(template, options.label, options.input_icon, options.id, options.name, options.placeholder, options.cssclass, options.disabled ? 'disabled' : '', options.readonly ? 'readonly' : '', options.required ? 'required' : '', options.languagecontrol, options.dbfieldname, options.value, options.help_block);
		return resutlHtml;
	};

	var _getHTMLStatic = function (options) {
		var template = '<div class="form-group">\
				<label class="col-md-2 control-label">{0}</label>\
				<div class="col-md-10">\
				<p class="form-control-static" data-languagecontrol="{1}" data-dbfieldname="{2}">{3}</p>\
				</div>\
				</div>';
		var resutlHtml = $.format(template, options.label, options.languagecontrol, options.dbfieldname, options.value);
		return resutlHtml;
	};

	var _getHTMLStaticJoinString = function (options) {
		var template = '<div class="form-group">\
				<label class="col-md-2 control-label">{0}</label>\
				<div class="col-md-10">\
				<p class="form-control-static join-string" data-languagecontrol="{1}" data-dbfieldname="{2}" >{3}</p>\
				</div>\
				</div>';
		var resutlHtml = $.format(template, options.label, options.languagecontrol, options.dbfieldname, options.value);
		return resutlHtml;
	};

	var _getHTMLCheckbox = function (options) {
		var template = '<div class="form-group">\
				<label class="col-md-2 control-label">{0}</label>\
				<div class="col-md-10">\
				<label class="{1}">\
				<input type="checkbox" class="minimal" id="{2}" name="{3}" value="{4}" {5} {6} {7} data-languagecontrol="{8}" data-dbfieldname="{9}">\
				{10}\
				</label>\
				<span id="help-block-{2}" class="help-block">{11}</span>\
				</div>\
				</div>';
		var resutlHtml = $.format(template, options.label, options.cssclass, options.id, options.name, options.value, options.selected ? 'checked' : '', options.disabled ? 'disabled' : '', options.readonly ? 'readonly' : '', options.languagecontrol, options.dbfieldname, options.label, options.help_block);
		return resutlHtml;
	};

	var _getHTMLEditor = function (options) {
		var template = '<div class="form-group">\
				<label class="col-md-2 control-label">{0}</label>\
				<div class="col-md-10">\
				<textarea id="{1}" name="{2}" class="editor {3}" data-languagecontrol="{4}" data-dbfieldname="{5}">{6}</textarea>\
				<span id="help-block-{1}" class="help-block">{7}</span>\
				</div>\
				</div>';
		var resutlHtml = $.format(template, options.label, options.id, options.name, options.cssclass, options.languagecontrol, options.dbfieldname, options.value, options.help_block);
		return resutlHtml;
	};

	var _getHTMLInputImages = function (options) {
		var template = '<div class="form-group">\
				<label class="col-md-2 control-label">{0}</label>\
				<div class="col-md-10">\
				<input id="{1}-upload" name="{2}-upload" type="file" multiple class="file-loading input-images {3}" data-languagecontrol="{4}" data-dbfieldname="{5}" data-initpreview="{6}">\
				<input id="{1}" name="{7}" type="hidden" data-languagecontrol="{4}" data-dbfieldname="{5}" value="{6}">\
				<span id="help-block-{1}" class="help-block">{8}</span>\
				</div>\
				</div>';
		var nameUpload = options.name.replace('[', '').replace(']', '').toLowerCase();
		var resutlHtml = $.format(template, options.label, options.id, nameUpload, options.cssclass, options.languagecontrol, options.dbfieldname, options.value, options.name, options.help_block);
		return resutlHtml;
	};

	var _getHTMLSelect = function (options) {
		var template = '<div class="form-group">\
				<label class="col-md-2 control-label">{0}</label>\
				<div class="col-md-10">\
				<select class="form-control select2 {13}" id="{1}" name="{2}" {3} {4} {5} data-languagecontrol="{6}" data-dbfieldname="{7}" {10} data-url="{11}" {12} data-initselected="{14}">{8}</select>\
				<span id="help-block-{1}" class="help-block">{9}</span>\
				</div>\
				</div>';
		var subTemplate = '<option id="{0}" value="{1}" {2}>{3}</option>';
		var subResultHtml = '';
		$.each(options.datas, function (index, item) {
			var selected = item.selected || options.value == item.value ? 'selected' : '';
			subResultHtml += $.format(subTemplate, item.id, item.value, selected, item.text);
		});
		subResultHtml = '<option value="0">Chọn giá trị ...</option>' + subResultHtml;
		if ($.isArray(options.value)) {
			var t = [];
			$.each(options.value, function (index, item) {
				t.push(item.id)
			});
			options.value = t;
		}

		var resutlHtml = $.format(template, options.label, options.id, options.name, options.disabled ? 'disabled' : '', options.readonly ? 'readonly' : '', options.required ? 'required' : '', options.languagecontrol, options.dbfieldname, subResultHtml, options.help_block, options.required ? 'required' : '', options.url, options.multiple ? 'multiple' : '', options.cssclass, options.value);
		return resutlHtml;
	};

	var _getHTMLCheckboxList = function (options) {
		var template = '<div class="form-group">\
				<label class="col-md-2 control-label">{0}</label>\
				<div class="col-md-10">\
				<div class="checkbox-list">{1}</div>\
				<span id="help-block-{2}" class="help-block">{3}</span>\
				</div>\
				</div>';
		var subTemplate = '<label class="{0}"><input type="checkbox" id="{1}" name="{2}" value="{3}" {4} {5} {6} data-languagecontrol="{7}" data-dbfieldname="{8}"> {9} </label>';
		var subResultHtml = '';
		$.each(options.datas, function (index, item) {
			subResultHtml += $.format(subTemplate, options.cssclass, item.id, options.name, item.value, item.selected ? 'checked' : '', options.disabled ? 'disabled' : '', options.readonly ? 'readonly' : '', options.languagecontrol, options.dbfieldname, item.text);
		});
		var resutlHtml = $.format(template, options.label, subResultHtml, options.id, options.help_block);
		return resutlHtml;
	};

	var _getHTMLRadioList = function (options) {
		var template = '<div class="form-group">\
				<label class="col-md-2 control-label">{0}</label>\
				<div class="col-md-10">\
				<div class="radio-list">{1}</div>\
				<span id="help-block-{2}" class="help-block">{3}</span>\
				</div>\
				</div>';
		var subTemplate = '<label class="{0}"><input type="radio" id="{1}" name="{2}" value="{3}" {4} {5} {6} {7} data-languagecontrol="{8}" data-dbfieldname="{9}"> {10} </label>';
		var subResultHtml = '';
		$.each(options.datas, function (index, item) {
			subResultHtml += $.format(subTemplate, options.cssclass, item.id, options.name, item.value, item.selected ? 'checked' : '', options.disabled ? 'disabled' : '', options.readonly ? 'readonly' : '', options.required ? 'required' : '', options.languagecontrol, options.dbfieldname, item.text);
		});
		var resutlHtml = $.format(template, options.label, subResultHtml, options.id, options.help_block);
		return resutlHtml;
	};

	var _getHTMLInputFile = function (options) {
		var template = '<div class="form-group">\
				<label class="control-label col-md-3">{0}</label>\
				<div class="col-md-10">\
				<input id="{1}-upload" name="{2}-upload" type="file" multiple class="file-loading input-images {3}" data-languagecontrol="{4}" data-dbfieldname="{5}">\
				<input id="{1}" name="{6}" type="hidden" data-languagecontrol="{4}" data-dbfieldname="{5}">\
				<span id="help-block-{1}" class="help-block">{7}</span>\
				</div>\
				</div>';
		var nameUpload = options.name.replace('[', '').replace(']', '').toLowerCase();
		var resutlHtml = $.format(template, options.label, options.id, nameUpload, options.cssclass, options.languagecontrol, options.dbfieldname, options.name, options.help_block);
		return resutlHtml;
	}

	var _getHTMLInputTag = function (options) {};

	var _getHTMLInputCalendar = function () {};

	var _afterInit = function () {

		$(_dom).find('input.minimal').iCheck({
			checkboxClass : 'icheckbox_square-green',
			radioClass : 'iradio_square-green'
		});

		$(_dom).find('textarea.editor').each(function (index, item) {
			CKEDITOR.replace($(item).attr('id'), {
				filebrowserBrowseUrl : '/elfinder/ckeditor'
			});
		});

		$(_dom).find("input.input-images").each(function (index, item) {
			var ctrlid = $(item).attr('id');
			var ctrlname = $(item).attr('name');
			var initpreview = $(item).data('initpreview');
			initpreview = initpreview.toString().split(',');
			var initPreviewData = [];
			var initPreviewConfig = [];
			$.each(initpreview, function (_index, _item) {
				if (_item != '') {
					var dbid = _item.split('|')[0];
					var path = _item.split('|')[1];
					initPreviewData.push($.format('<img src="/imagecache/small/{0}" class="file-preview-image">', path));
					initPreviewConfig.push({
						caption : '&nbsp;',
						key : dbid,
						url : '/backend/uploads/destroy',
						extra : {
							data : _item,
							id : ctrlid,
							path : path,
							_method : 'DELETE'
						}
					});
				}
			});

			$(item).fileinput({
				uploadUrl : '/backend/uploads',
				uploadExtraData : {
					name : ctrlname,
					id : ctrlid
				},
				uploadAsync : true,
				minFileCount : 1,
				maxFileCount : 10,
				allowedFileExtensions : ['jpg', 'jpeg', "gif", "png"],
				maxFileSize : 5120, // 5MB
				fileActionSettings : {
					showZoom : false
				},
				initialPreview : initPreviewData,
				initialPreviewConfig : initPreviewConfig,
				previewSettings : {
					image : {
						width : "auto",
						height : "90px"
					}
				},
				overwriteInitial : false
			});
		});

		$(_dom).find("input.input-images").on('fileuploaded', function (event, data, previewId, index) {
			var ctrlid = data.extra.id.substr(0, data.extra.id.lastIndexOf('-upload'));
			var $control = $('#' + ctrlid);
			var currentValue = $control.val();
			var newValue = data.response.initialPreview[0];
			newValue = newValue.match(/src=[\"'](.+?)[\"']/g).toString();
			newValue = newValue.replace('src=', '').replace(/"/g, '');
			if (typeof currentValue != 'undefined' && currentValue != 'undefined' && currentValue != '') {
				newValue = $.format('{0},{1}', currentValue, newValue);
			}
			// remove path
			newValue = newValue.replace('/imagecache/small/', '').replace(/"/g, '');
			$control.val(newValue);
		});

		$(_dom).find("input.input-images").on('filedeleted', function (event, key, jqXHR, data) {
			var ctrlid = data.id.substr(0, data.id.lastIndexOf('-upload'));
			var $control = $('#' + ctrlid);
			var currentValue = $control.val();
			var delStr = currentValue.indexOf(data.data) > 0 ? (',' + data.data) : data.data;
			var newValue = currentValue.replace(delStr, '');
			// remove path
			newValue = newValue.replace('/imagecache/small/', '').replace(/"/g, '');
			$control.val(newValue);
		});

		$(_dom).find("input.input-images").on('filesorted', function(event, params) {
			if (!params.stack.length) return;
			var ctrlid = '';
			var value = '';
			$.each(params.stack, function(index, item) {
				if (typeof item != 'undefined') {
					if (ctrlid == '') {
						ctrlid = item.extra.id.substr(0, item.extra.id.lastIndexOf('-upload'));;
					}
					if (value.length) {
						value += ',' ;
					}
					value += item.extra.data;
				}
			});

			var $control = $('#' + ctrlid);
			var currentValue = $control.val();
			var keep = currentValue.split(",");
			var keepValue = '';
			$.each(keep, function(index, item) {
				if (item.indexOf('|') == -1) {
					keepValue +=  $.format(',{0}', item);
				}
			});
			value += keepValue;
			$control.val(value);
		});

		$(_dom).find('.select2').each(function (index, item) {
			if ($(item).data('url') && $(item).data('url') != '') {

				var initselected = String($(item).data('initselected'));
				initselected = initselected.split(',');

				$.ketnoimoiAjax({
					url : $(item).data('url'),
					type : 'POST',
					data : {
						ids : initselected,
						type : 'dropdown',
						multiple : $(item).prop('multiple')
					},
					success : function (data, textStatus, jqXHR) {
						var htmlOptions = '<option value="0">Chọn giá trị ...</option>';
						$.each(data, function (i, ele) {
							htmlOptions += $.format('<option value="{0}" {1}>{2}</option>', ele.id, $.inArray(String(ele.id), initselected) != -1 ? 'selected' : '', ele.name)
						});
						$(item).html(htmlOptions);

						var selectSetting = {
							url : $(item).data('url'),
							dropdownParent : $(_dom)
						};
						if (!$(item).prop('multiple')) {
							selectSetting.url = '';
							selectSetting.minimumInputLength = 0;
						} else {
							selectSetting.params = function (params) {
								var query = {
									search : params.term,
									type : 'dropdown',
									multiple : $(item).prop('multiple')
								}
								return query;
							};
						}
						new CSelect('#' + $(item).attr('id'), selectSetting).init();
					}
				});
			}
		});

		// hidden controls by customer require
		if (typeof jshiddencontrols == 'function') {
			jshiddencontrols();
		};
	};

	// public functions
	return {

		//main function
		init : function (options) {

			var opts = {
				dom : null,
				commonControls : [],
				languageControls : [],
				commonData : {},
				languageDatas : []
			};

			$.extend(true, opts, options);
			_dom = opts.dom;
			$(_dom).html('');

			// apply data for commonControls
			if (opts.commonControls.length && !$.isEmptyObject(opts.commonData)) {
				$.each(opts.commonControls, function (index, item) {
					if (item.dbfieldname == 'created_by') {
						opts.commonData.created_by = $.format('{0} {1} - {2}', opts.commonData.user_created.first_name, opts.commonData.user_created.last_name, moment(opts.commonData.created_at).format('lll'));
					}
					if (item.dbfieldname == 'updated_by') {
						if (opts.commonData.updated_by) {
							opts.commonData.updated_by = $.format('{0} {1} - {2}', opts.commonData.user_updated.first_name, opts.commonData.user_updated.last_name, moment(opts.commonData.updated_at).format('lll'));
						} else {
							opts.commonData.updated_by = '---'
						}
					}
					if (item.dbfieldname == 'deleted_by') {
						opts.commonData.deleted_by = $.format('{0} - {1}', opts.commonData.deleted_by, opts.commonData.deleted_at);
					}
					if (item.dbfieldname == 'published_by') {
						opts.commonData.published_by = $.format('{0} - {1}', opts.commonData.published_by, opts.commonData.published_at);
					}

					if (item.type == 'checkbox') {
						item.selected = opts.commonData[item.dbfieldname] == '1' ? true : false;
					} else if (item.type == 'inputimages') {
						item.value = '';
						opts.commonData[item.dbfieldname].sort($.sortByProperty('priority'));
						$.each(opts.commonData[item.dbfieldname], function (_index, _item) {
							item.value += $.format('{0}|{1},', _item.id, _item.path);
						});
						if (item.value.lastIndexOf(',') == (item.value.length - 1)) {
							item.value = item.value.substr(0, item.value.length - 1);
						}
					} else if (item.type == 'staticjoinstring') {
						if ($.isArray(opts.commonData[item.dbfieldname])) {
							item.value = $.map(opts.commonData[item.dbfieldname], function (n) {
									return n[item.joinfield];
								});
						} else {
							item.value = opts.commonData[item.dbfieldname];
						}
					} else {
						item.value = opts.commonData[item.dbfieldname];
					}
				});
			}

			var fn_wait = function () {
				// apply data for languageControls
				if (opts.commonControls.length && opts.languageDatas.length) {
					$.each(opts.commonControls, function (index, item) {
						if (typeof item.languagecontrol != 'undefined' || item.languagecontrol != 'undefined') {
							$.each(opts.languageDatas, function (_index, _item) {
								if (_item.locale == item.languagecontrol) {
									item.value = _item[item.dbfieldname];
									return false;
								};
							});
						}
					});
				}

				var resutlHtml = '';
				$.each(opts.commonControls, function (index, item) {
					switch (item.type) {
					case 'divider':
						resutlHtml += $.format('<h3 class="form-section">{0}</h3>', item.label);
						break;
					case 'text':
					case 'password':
					case 'datetime':
					case 'datetime-local':
					case 'date':
					case 'month':
					case 'time':
					case 'week':
					case 'number':
					case 'email':
					case 'url':
					case 'search':
					case 'tel':
					case 'color':
						resutlHtml += _getHTMLText(item);
						break;
					case 'select':
						resutlHtml += _getHTMLSelect(item);
						break;
					case 'textarea':
						resutlHtml += _getHTMLTextarea(item);
						break;
					case 'static':
						resutlHtml += _getHTMLStatic(item);
						break;
					case 'staticjoinstring':
						resutlHtml += _getHTMLStaticJoinString(item);
						break;
					case 'checkbox':
						resutlHtml += _getHTMLCheckbox(item);
						break;
					case 'checkboxlist':
						resutlHtml += _getHTMLCheckboxList(item);
					case 'radiolist':
						resutlHtml += _getHTMLRadioList(item);
						break;
					case 'inputfile':
					case 'file':
						resutlHtml += _getHTMLInputFile(item);
						break;
					case 'inputimages':
						resutlHtml += _getHTMLInputImages(item);
						break;
					case 'editor':
						resutlHtml += _getHTMLEditor(item);
						break;
					case 'inputtag':
						resutlHtml += _getHTMLInputTag(item);
						break;
					case 'calendar':
						resutlHtml += _getHTMLInputCalendar(item);
						break;
					};
				});
				$(_dom).append(resutlHtml);
				_afterInit();
			};

			$.getLanguages(function (data) {
				$.each(data, function (index, item) {
					if (opts.languageControls.length) {
						opts.commonControls.push({
							'label' : item.name,
							'type' : 'divider'
						});
					};
					$.each(opts.languageControls, function (_index, _item) {
						var languageControl = $.extend(true, {}, _item);
						languageControl.id = $.format('{0}_{1}', languageControl.id, item.code);
						languageControl.name = languageControl.name.replace('[locale]', $.format('[{0}]', item.code));
						languageControl.languagecontrol = item.code;
						opts.commonControls.push(languageControl);
					});
				});
				fn_wait();
			});
		},
		getHTMLText : function (options) {
			return _getHTMLText(options);
		},
		getHTMLEmail : function (options) {
			return _getHTMLEmail(options);
		},
		getHTMLPassword : function (options) {
			return _getHTMLPassword(options);
		},
		getHTMLSelect : function (options) {
			return _getHTMLSelect(options);
		},
		getHTMLTextarea : function (options) {
			return _getHTMLTextarea(options);
		},
		getHTMLStatic : function (options) {
			return _getHTMLStatic(options);
		},
		getHTMLCheckboxList : function (options) {
			return _getHTMLCheckboxList(options);
		},
		getHTMLRadio : function (options) {
			return _getHTMLRadio(options);
		},
		getHTMLInputFile : function (options) {
			return _getHTMLInputFile(options);
		}
	};
}();

/***
Usage
 ***/
//CControl.init();
//CControl.doSomeStuff();