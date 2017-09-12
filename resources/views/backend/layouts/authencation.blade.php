<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title')</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="icon" type="image/png" href="/backend/img/favicon.png" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="/backend/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="/backend/plugins/font-awesome/css/font-awesome.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="/backend/plugins/iCheck/square/green.css">
	@yield('plugins.css')
	<!-- Theme style -->
	<link rel="stylesheet" href="/backend/css/AdminLTE.min.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
	@yield('content')
	<!-- jQuery 2.2.3 -->
	<script src="/backend/plugins/jQuery/jquery-2.2.3.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="/backend/bootstrap/js/bootstrap.min.js"></script>
	@yield('plugins.js')
	@yield('javascript.customize')
</body>
</html>
