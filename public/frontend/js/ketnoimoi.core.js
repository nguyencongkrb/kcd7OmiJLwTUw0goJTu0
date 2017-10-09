$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

$.sortByProperty = function (property) {
	return function (x, y) {
		return ((x[property] === y[property]) ? 0 : ((x[property] > y[property]) ? 1 : -1));
	};
};
//data.sort($.sortByProperty('priority'));

$.validator.addMethod("regex", function(value, element, regexpr) {          
	return this.optional(element) || regexpr.test(value);
}, "Dữ liệu không đúng định dạng.");

$.validator.addMethod("captcha", function(value, element, referctrl) {   
	return eval($(referctrl).val()) == $(element).val();
}, "Dữ liệu không chính xác.");


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

$.validateEmail = function (email) {
	return /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test(email);
}

// parser query string
jQuery.extend({
	parseQuerystring: function(){
		var nvpair = {};
		var qs = window.location.search.replace('?', '');
		if (qs != '') {
			var pairs = qs.split('&');
			$.each(pairs, function(i, v){
				var pair = v.split('=');
				nvpair[pair[0]] = pair[1];
			});
		};
		return nvpair;
	}
});