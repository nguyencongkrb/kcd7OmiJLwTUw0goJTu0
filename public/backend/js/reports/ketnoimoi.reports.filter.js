if (typeof ketnoimoi == 'undefined')
	var ketnoimoi = {};
if (typeof ketnoimoi.reports == 'undefined')
	ketnoimoi.reports = {};

ketnoimoi.reports.filter = {
	init: function () {
		var thisObj = ketnoimoi.reports.filter;
		thisObj.initFilter();
		thisObj.events();
	},
	initFilter: function () {
		var thisObj = ketnoimoi.reports.filter;
		$('.datepicker').datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true,
			todayHighlight: true
		});
	},
	events: function (argument) {
		$('.btn-submit').click(function (e) {
			e.stopPropagation();
			if($(this).hasClass('export')){
				$('#txtExport').val(1);
			}
			else{
				$('#txtExport').val(0);
			}
			$('#frmFilter')[0].submit();
		});
	}
};

$(function () {
	ketnoimoi.reports.filter.init();
});