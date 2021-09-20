<div>
    <x-jet-form-section submit="submit">
        <x-slot name="title">
            {{ __('Widget Settings') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Configure widget settings to start using it') }}
        </x-slot>

        <x-slot name="form">

            <div class="w-md-75">

                <div class="form-group">
                    <x-jet-label for="call_center_number" value="{{ __('Call Center Number') }}" />
                    <x-jet-input id="call_center_number" class="{{ $errors->has('call_center_number') ? 'is-invalid' : '' }}" type="text" wire:model.defer="state.call_center_number" autocomplete="off" />
                    <x-jet-input-error for="call_center_number" />
                </div>

                <div class="form-group">
                    <x-jet-label for="name" value="{{ __('Domains') }}" />

                    @foreach($state['domains'] as $index => $domain)
                        <div class="input-group mb-3" wire:key="domain-{{$index}}">
                            <x-jet-input id="domains.{{$index}}" class="{{ $errors->has('domains.'.$index) ? 'is-invalid' : '' }}" type="text" wire:model.defer="state.domains.{{$index}}" autocomplete="off" />
                            @if($index === count($state['domains']) -1)
                                <x-jet-button type="button" wire:click="addDomain" class="ml-1"><i class="fas fa-plus"></i></x-jet-button>
                            @endif

                            @if(count($state['domains']) !== 1)
                                <x-jet-danger-button type="button" wire:click="removeDomain({{$index}})" class="ml-1"><i class="fas fa-minus"></i></x-jet-danger-button>
                            @endif
                            <x-jet-input-error for="domains.{{$index}}" />
                        </div>
                    @endforeach
                </div>
            </div>
        </x-slot>

        <x-slot name="actions">
            <div class="d-flex align-items-baseline">
                <x-jet-button wire:target="submit">
                    {{ __('Save') }}
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-form-section>

    @if($model)
        <br><br>
        <hr><br>
        <x-jet-form-section submit="codeToCopy">
            <x-slot name="title">
                {{ __('Instructions') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Follow the instruction to start using widget') }}
            </x-slot>

            <x-slot name="form">
                <div class="w-md-75">
                    <div class="form-group">
                        <x-jet-label for="position-code" value="{{ __('Paste this code at the position where you want the button to be visible') }}" />
                        <div class="input-group">
                            <x-jet-input id="position-code" wire:model="positionCode"/>
                            <x-jet-button type="button" onclick="copyToClipboard('position-code')" class="ml-1"><i class="fas fa-clipboard"></i></x-jet-button>
                        </div>
                    </div>

                    <div class="form-group">
                        <x-jet-label for="button-script" value="{{ __('Paste this code at the end of your body tag') }}" />
                        <div class="input-group">
                            <x-jet-input id="button-script" type="textarea" wire:model="buttonScript"/>
                            <x-jet-button type="button" onclick="copyToClipboard('button-script')" class="ml-1"><i class="fas fa-clipboard"></i></x-jet-button>
                        </div>
                    </div>
                </div>
            </x-slot>
        </x-jet-form-section>
    @endif

    <script>
        function copyToClipboard(divId) {
            let copyText = document.getElementById(divId);

            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            navigator.clipboard.writeText(copyText.value);
        }
    </script>
</div>


