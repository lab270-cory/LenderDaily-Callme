<div>
    @php($onClickMethod = $attributes->getAttributes()['wire:click'] ?? $attributes->getAttributes()['wire:target'] ?? null)

    @if($onClickMethod)
        <div class="position-relative" wire:loading.delay wire:target="{{$onClickMethod}}" style="display: none;">
            <span class="position-absolute m-auto" style="left: 0; right: 0; bottom: 0; top: 0; text-align: center">
                <span class="saving">
                    <span class="fas fa-circle">&nbsp;</span>
                    <span class="fas fa-circle">&nbsp;</span>
                    <span class="fas fa-circle"></span>
                </span>
            </span>
            <span style="opacity: 0">{{ $slot }}</span>
        </div>

        <span wire:loading.delay.remove wire:target="{{$onClickMethod}}">
                {{ $slot }}
        </span>
    @else
        {{ $slot }}
    @endif
</div>
