@if (session('status'))
<div class="alert alert-info alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<h4><i class="icon fa fa-info-circle"></i> Thông báo!</h4>
	{{ session('status') }}
</div>
@endif