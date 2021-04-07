@props(['model', 'initialValue'=> null])

@php
    $timezones = \App\Models\Timezone::orderBy('id')->get()->toArray();
@endphp
<x-select2
    placeholder="Select a timezone"
    :options="$timezones"
    displayKey="display_name"
    model="{{$model}}"
    :initialValue="$initialValue"
/>
