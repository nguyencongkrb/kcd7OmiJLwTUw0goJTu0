if(typeof ketnoimoi == 'undefined')
	var ketnoimoi = {};
if(typeof ketnoimoi.users == 'undefined')
	ketnoimoi.users = {};
ketnoimoi.users.create = {
	init: function(){
		var thisObj = ketnoimoi.users.create;

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
				blockContainer: '#user-form .box',
				callback: function (argument) {
					if(!$('#user-form input[name="_method"]').length || $('#user-form input[name="_method"]').val().toUpperCase() == 'POST'){
						$('#user-form input[type="checkbox"]').iCheck('uncheck');
						$('#user-form')[0].reset();
					}
				}
			});
		});
	}
};


$(function () {
	ketnoimoi.users.create.init();	
});