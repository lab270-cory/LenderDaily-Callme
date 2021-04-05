<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-danger text-white text-uppercase']) }}  wire:loading.attr="disabled">
	<x-content-with-loader {{$attributes}}>{{$slot}}</x-content-with-loader>
</button>
