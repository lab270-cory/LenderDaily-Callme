<div>
    <x-jet-button class="float-right mb-2" wire:click="$toggle('showForm')">
        <i class="fas fa-plus"></i>
        Add New
    </x-jet-button>

    <x-jet-dialog-modal wire:model="showForm">
        <x-slot name="title">
            {{ __('Create User') }}
        </x-slot>

        <x-slot name="content">
            <div class="m-2">
                <div class="form-group">
                    <x-jet-label value="{{ __('Name') }}" />

                    <x-jet-input class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                                 :value="old('name')" wire:model="state.name" />
                    <x-jet-input-error for="name"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <x-jet-label value="{{ __('Email') }}" />

                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                 :value="old('email')" wire:model="state.email"/>
                    <x-jet-input-error for="email"></x-jet-input-error>
                </div>

                <!-- Role -->
                <div class="form-group">
                    @php($roles = \App\Models\Role::get()->toArray())
                    <x-jet-label for="timezone" value="{{ __('Role') }}" />
                    <x-select2
                        :options="$roles"
                        displayKey="display_name"
                        model="state.role_id"
                        identifier="role"
                        :initialValue="$state['role_id']"
                        :searchable="false"
                    />

                    <x-jet-input-error for="role_id"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <x-jet-label value="{{ __('Password') }}" />

                    <x-jet-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                                 name="password" required autocomplete="new-password" wire:model="state.password"/>
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <x-jet-label value="{{ __('Confirm Password') }}" />

                    <x-jet-input class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" wire:model="state.password_confirmation"/>
                </div>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showForm')">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-button wire:click="create">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>

@push('scripts')
    @include('utils.moment-scripts')
    <script>
        document.addEventListener('livewire:load', function() {
            @this.set('state.timezone', moment.tz.guess());
        });
    </script>
@endpush
