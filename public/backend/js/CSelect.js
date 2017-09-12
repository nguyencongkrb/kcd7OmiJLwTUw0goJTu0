var CSelect = function(control, options){
	var select;
	this.opts = {
		url: '',
		minimumInputLength: 1,
		params: function (params) {
			var query = {
				search: params.term,
				page: params.page,
				type: 'dropdown'
			}
			return query;
		},
		templateResult: function (data) {
			return data.text || data.name;
		},
		templateSelection: function (data) {
			return data.text || data.name;
		},
		data: []
	}; 
	$.extend(true, this.opts, options)

	this.init = function(callback){
		var settings = {};

		$.extend(true, settings, this.opts)
		if (this.opts.url) {
			settings.ajax = {
				url: this.opts.url,
				delay: 250,
				data: this.opts.params,
				type: 'POST',
				processResults: function (data) {
					return {
						results: data
					};
				}
			}
		};

		select = $(control).select2(settings);
	};
}