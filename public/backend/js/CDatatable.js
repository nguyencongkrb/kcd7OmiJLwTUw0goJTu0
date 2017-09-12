
function CDatatable(options) {
	var datatable;
	this.opts = {
		tableId: '',
		url: '',
		params: null,
		data: [],
		columns: [],
		language: {
            url: '/backend/plugins/datatables/js/Vietnamese.json'
        }
	}; 
	$.extend(true, this.opts, options);

	this.init = function(callback){

		/*
		datatable = $(this.opts.tableId).DataTable({
			rowId: this.opts.rowId,
			data: this.opts.data,
			autoWidth:false,
			pageLength: 25,
			ordering: false,
			columns: this.opts.columns
		});
		*/
		if (typeof this.opts.pageLength == 'undefined') {
			this.opts.pageLength = 25;
		};
		this.opts.autoWidth = false;
		datatable = $(this.opts.tableId).DataTable(this.opts);
		
		if(this.opts.url && this.opts.url != ''){
			this._getData(callback);			
		}
		else{
			if(typeof callback == 'function')
			  callback(this.opts.data);
		}
	};
	this.addrow = function(data){
		if (typeof data == 'array') {
			$.each(data, function (index, item) {
				datatable.row.add(item);
			});
			datatable.draw(false);
		};
		datatable.row.add(data).draw(false);
	};
	this.delrow = function(dataId){
		if (typeof dataId == 'number')
			dataId = '#' + dataId;
		datatable.row(dataId).remove().draw( false );
	};
	this.getdata = function(dataId){
		if (dataId) {
			if (typeof dataId == 'number')
				dataId = '#' + dataId;
			return datatable.row(dataId).data();
		};
		return datatable.data();
	};
	this.setdata = function(dataId, data){
		if (typeof dataId == 'number')
			dataId = '#' + dataId;
		datatable.row(dataId).data(data).draw(false);
	};
	this.cleardata = function(){
		datatable.clear().draw();
	};

	/* private function */
	this._getData = function(callback){
		$.ketnoimoiAjax({
			url: this.opts.url,
			data: this.opts.params,
			type: 'POST',
			beforeSend: function(jqXHR, settings){
			},
			success: function(data, textStatus, jqXHR) {
				$.each(data, function (index, item) {
					datatable.row.add(item);
				});
				datatable.draw(false);
				if(typeof callback == 'function')
					callback(data);
			},
			error: function(jqXHR, textStatus, errorThrown){
			}
		});
	};
};
