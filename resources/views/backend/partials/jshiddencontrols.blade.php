@if($hiddenControls)
function jshiddencontrols(){
	$('
	@foreach($hiddenControls as $control)
		*[name="{{ $control->name }}"]@if(!$loop->last),@endif
	@endforeach
	').parent().parent().hide();
};
@endif