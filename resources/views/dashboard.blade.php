<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Widgets') }}
        </h2>
    </x-slot>

    <x-jet-button class="float-right mb-4" href="{{route('widgets.create')}}">
        <i class="fas fa-plus"></i>
        Add New
    </x-jet-button>

    <table class="table bg-white">
        <tr>
            <th>Call Center Number</th>
            <th>Domains</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
        @php
            $widgets = \App\Models\CallWidget::get();
        @endphp

        @foreach($widgets as $widget)
            <tr>
                <td>{{$widget->call_center_number}}</td>
                <td>{{implode(', ', $widget->domains)}}</td>
                <td>{{formattedDateTime($widget->created_at)}}</td>
                <td>
                    <x-jet-button class="px-2 py-1" onclick="window.location.href = '{{route('widgets.edit', $widget->id)}}'">
                        <i class="fas fa-pencil-alt"></i>
                    </x-jet-button>

                    <form id="delete-widget-{{$widget->id}}" method="post" action="{{route('widgets.destroy', $widget->id)}}" class="d-none">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                    </form>

                    <x-jet-danger-button class="px-2 py-1" onclick="document.getElementById('delete-widget-{{$widget->id}}').submit()">
                        <i class="fas fa-trash-alt"></i>
                    </x-jet-danger-button>
                </td>
            </tr>
        @endforeach
    </table>

    @if(!count($widgets))
        <div class="text-center m-auto">
            No Records Found
        </div>
    @endif


</x-app-layout>
