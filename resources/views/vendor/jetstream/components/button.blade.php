<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-dark text-uppercase']) }}  wire:loading.attr="disabled">
	<x-content-with-loader {{$attributes}}>{{$slot}}</x-content-with-loader>
</button>
