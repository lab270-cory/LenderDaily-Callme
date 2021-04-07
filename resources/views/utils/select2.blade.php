@props(['options', 'model', 'displayKey'=>'name', 'valueKey'=>'id', 'resetEvent'=> null,
    'identifier'=>'select2', 'placeholder'=>'Select a value', 'initialValue'=> '', 'searchable'=> true])

<div class="form-group mb-3">
    <div wire:ignore>
        <select class="form-control" id="{{$identifier}}" {{$attributes}}>
            <option></option>
            @foreach($options as $option)
                <option value="{{$option[$valueKey]}}">{{$option[$displayKey]}}</option>
            @endforeach
        </select>
    </div>
    <x-jet-input-error for="{{$identifier}}" class="mt-2" />
</div>

@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
    <script>
        $(document).ready(function (){
            $('#{{$identifier}}').select2({
                placeholder: "{{$placeholder}}",

                @if(!$initialValue)
                allowClear: true,
                @endif

                    @if(!$searchable)
                minimumResultsForSearch: -1
                @endif
            })

            @if($resetEvent)
            @this.on(`{{$resetEvent}}`, () => {
                $('#{{$identifier}}').val('{{$initialValue}}').trigger('change')
            });
            @endif

            @if($initialValue)
            $('#{{$identifier}}').val('{{$initialValue}}').trigger('change');
            @endif

            $('#{{$identifier}}').on('change', function (e) {
                @this.set('{{$model}}', $('#{{$identifier}}').select2("val"));
            });
        })
    </script>
@endpush
