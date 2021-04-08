<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <livewire:users.create-form/>

    <table class="table bg-white">
        <tr>
            <th>Profile Pic</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td><img src="{{$user->profile_photo_url}}" class="rounded-circle" alt="{{$user->name}}" width="35"></td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role->display_name}}</td>
                <td>
                    <x-jet-button onclick="window.location.href = '{{route('users.edit', $user->id)}}'">
                        <i class="fas fa-pencil-alt"></i>
                    </x-jet-button>

                    <form id="delete-user-{{$user->id}}" method="post" action="{{route('users.destroy', $user->id)}}" class="d-none">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                    </form>

                    <x-jet-danger-button onclick="document.getElementById('delete-user-{{$user->id}}').submit()">
                        <i class="fas fa-trash-alt"></i>
                    </x-jet-danger-button>

                </td>
            </tr>
        @endforeach
    </table>
</x-app-layout>
