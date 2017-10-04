<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	'accepted'             => 'Trường :attribute phải được chấp nhận.',
	'active_url'           => 'Trường :attribute không phải là một URL hợp lệ.',
	'after'                => 'Trường :attribute phải sau :date.',
	'alpha'                => 'Trường :attribute chỉ có thể chứa ký tự chữ',
	'alpha_dash'           => 'Trường :attribute chỉ có thể chứa ký tự chữ, số và dấu gạch ngang (-)',
	'alpha_num'            => 'Trường :attribute chỉ có thể chứa ký tự chữ và số',
	'array'                => 'Trường :attribute phải là một mảng',
	'before'               => 'Trường :attribute phải trước :date.',
	'between'              => [
		'numeric' => 'Trường :attribute phải nằm trong khoảng :min và :max.',
		'file'    => 'Trường :attribute phải có kích thước trong khoảng :min và :max kilobytes.',
		'string'  => 'Trường :attribute phải có nằm trong khoảng :min và :max ký tự.',
		'array'   => 'Trường :attribute phải có nằm trong khoảng :min và :max phần tử.',
	],
	'boolean'              => 'Trường :attribute phải có giá trị true hoặc false.',
	'confirmed'            => 'Giá trị xác nhận :attribute không khớp.',
	'date'                 => 'Trường :attribute không phải là một ngày hợp lệ.',
	'date_format'          => 'Trường :attribute không phù hợp với định dạng :format.',
	'different'            => 'Trường :attribute và :other phải khác nhau.',
	'digits'               => 'Trường :attribute phải có :digits chữ số.',
	'digits_between'       => 'Trường :attribute phải nằm trong khoảng :min và :max chữ số.',
	'dimensions'           => 'Trường :attribute không đúng kích thước.',
	'distinct'             => 'Trường :attribute có giá trị trùng lặp.',
	'email'                => 'Trường :attribute phải là môt địa chỉ email hợp lệ.',
	'exists'               => 'Trường :attribute đã chợn không hợp lệ.',
	'file'                 => 'Trường :attribute phải là một tập tin.',
	'filled'               => 'Trường :attribute là yêu cầu.',
	'image'                => 'Trường :attribute phải là dạng hình ảnh (image).',
	'in'                   => 'Trường :attribute đã chọn không hợp lệ.',
	'in_array'             => 'Trường :attribute không tồn tại trong :other.',
	'integer'              => 'Trường :attribute phải là một số nguyên.',
	'ip'                   => 'Trường :attribute phải là một địa chỉ IP hợp lệ.',
	'json'                 => 'Trường :attribute phải là một chuỗi JSON hợp lệ.',
	'max'                  => [
		'numeric' => 'Trường :attribute không được lớn hơn :max.',
		'file'    => 'Trường :attribute không được lớn hơn :max kilobytes.',
		'string'  => 'Trường :attribute không được lớn hơn :max ký tự.',
		'array'   => 'Trường :attribute không được lớn hơn :max phần từ.',
	],
	'mimes'                => 'Trường :attribute phải là một tập tin có định dạng: :values.',
	'min'                  => [
		'numeric' => 'Trường :attribute không được nhỏ hơn  :min.',
		'file'    => 'Trường :attribute không được nhỏ hơn :min kilobytes.',
		'string'  => 'Trường :attribute không được nhỏ hơn :min ký tự.',
		'array'   => 'Trường :attribute không được nhỏ hơn :min phần tử.',
	],
	'not_in'               => 'Trường :attribute đã chọn không hợp lệ.',
	'numeric'              => 'Trường :attribute phải là một số.',
	'present'              => 'Trường :attribute phải có mặt.',
	'regex'                => 'Trường :attribute không đúng định dạng yêu cầu.',
	'required'             => 'Trường :attribute là yêu cầu.',
	'required_if'          => 'Trường :attribute là yêu cầu khi :other là :value.',
	'required_unless'      => 'Trường :attribute là yêu cầu trừ khi :other trong :values.',
	'required_with'        => 'Trường :attribute là yêu cầu khi :values có mặt.',
	'required_with_all'    => 'Trường :attribute là yêu cầu khi :values có mặt.',
	'required_without'     => 'Trường :attribute là yêu cầu khi :values không có mặt.',
	'required_without_all' => 'Trường :attribute là yêu cầu khi không có :values có mặt.',
	'same'                 => 'Trường :attribute và :other phải giống nhau.',
	'size'                 => [
		'numeric' => 'Trường :attribute phải là :size.',
		'file'    => 'Trường :attribute phải là :size kilobytes.',
		'string'  => 'Trường :attribute phải là :size ký tự.',
		'array'   => 'Trường :attribute phải chứa :size phần tử.',
	],
	'string'               => 'Trường :attribute phải là một chuỗi.',
	'timezone'             => 'Trường :attribute phải đúng định dạng timezone.',
	'unique'               => 'Trường :attribute đã được sử dụng.',
	'url'                  => 'Trường :attribute là định dạng url.',
	'hash'        => 'Trường :attribute không khớp với giá trị hiện tại.',
	'userinput'        => 'Trường :attribute chứa ký tự không cho phép.',

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => [
		'attribute-name' => [
			'rule-name' => 'custom-message',
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => [],

];