<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-outline-secondary text-uppercase']) }}   wire:loading.attr="disabled">
    {{ $slot }}
</button>
