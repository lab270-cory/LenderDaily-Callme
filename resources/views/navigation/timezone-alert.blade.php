<div>
    <x-jet-dialog-modal wire:model="showPopup">
        <x-slot name="title">
            {{ __('New Timezone Detected') }}
        </x-slot>

        <x-slot name="content">
            Your current timezone is detected to be <b>{{$browserTimezone}}</b> but your profile timezone is set to <b>{{$databaseTimezone}}</b>.
                    Do you want to update your timezone?
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="hidePopup">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-button wire:click="updateTimezone">
                {{ __('Update') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>

@push('scripts')
    @include('utils.moment-scripts')

    <script>
        document.addEventListener('livewire:load', function() {
            @if($sendBrowserTimezone)
                @this.set('browserTimezone', moment.tz.guess());
            @endif
        });
    </script>
@endpush
