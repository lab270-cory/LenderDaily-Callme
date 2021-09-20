<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Widget') }}
        </h2>
    </x-slot>

    <livewire:widgets.update-or-create :model="$callWidget"/>
</x-app-layout>
