<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        @if (Auth::user()->id != $user->id)
            @livewire('users.update-profile-information-form', ['user'=>$user])
            <x-jet-section-border />

            @livewire('users.reset-password-form', ['user'=>$user])
            <x-jet-section-border />

        @else

            @livewire('profile.update-profile-information-form')
            <x-jet-section-border />

            @livewire('profile.update-password-form')
            <x-jet-section-border />

            @livewire('profile.two-factor-authentication-form')
            <x-jet-section-border />

            @livewire('profile.logout-other-browser-sessions-form')

            <x-jet-section-border />
        @endif
    </div>
</x-app-layout>
