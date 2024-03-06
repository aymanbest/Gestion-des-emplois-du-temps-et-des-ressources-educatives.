<div class="ui dropdown item" tabindex="0">
    {{ $label }}
    <i class="dropdown icon"></i>
    <div id="{{ $id }}" class="menu" tabindex="-1">
        @foreach($data as $row)
            <div class="item" data-item="{{$row['value']}}">{{$row['name']}}</div>
        @endforeach
    </div>
</div>

@push('login-scripts')
    <script>
        $('.ui.dropdown').dropdown();
    </script>
@endpush
