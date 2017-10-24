if (typeof ketnoimoi == 'undefined')
	var ketnoimoi = {};
if (typeof ketnoimoi.reports == 'undefined')
	ketnoimoi.reports = {};

ketnoimoi.reports.filter = {
	init: function () {
		var thisObj = ketnoimoi.reports.filter;
		thisObj.initFilter();
	},
	initFilter: function () {
		var thisObj = ketnoimoi.reports.filter;
		$('.datepicker').datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true,
			todayHighlight: true
		});
	}
};

$(function () {
	ketnoimoi.reports.filter.init();
});