if(typeof ketnoimoi == 'undefined')
	var ketnoimoi = {};
if(typeof ketnoimoi.user == 'undefined')
	ketnoimoi.user = {};
ketnoimoi.user.profile = {
	init: function(){
		var thisObj = ketnoimoi.user.profile;

		//iCheck for checkbox and radio inputs
		$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			checkboxClass: 'icheckbox_square-green',
			radioClass: 'iradio_square-green',
			increaseArea: '10%' // optional
		});

		thisObj.events();
	},
	events: function (argument) {
		$('#user-form').submit(function(e){
			e.preventDefault();
			ketnoimoi.core.postForm({
				formId: 'user-form',
				containerNotify: 'container-notify',
				blockContainer: '#settings',
				callback: function (argument) {
					
				}
			});
		});

		$('#user-password-change').submit(function(e){
			e.preventDefault();
			ketnoimoi.core.postForm({
				formId: 'user-password-change',
				containerNotify: 'container-notify',
				blockContainer: '#password',
				callback: function (argument) {
					
				}
			});
		});
	}
};


$(function () {
	ketnoimoi.user.profile.init();	
});