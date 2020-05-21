@extends('layouts.app')

@section('content')

    <div class="container">
        <div id="app">
            <contacts></contacts>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        window.Laravel = {!! json_encode([
       'csrfToken' => csrf_token(),
       'apiToken' => $currentUser->api_token ?? null,
   ]) !!};
    </script>
@endsection

<script src="https://unpkg.com/lodash@4.13.1/lodash.min.js"></script>
<script>
    var urlSearch = '{{route('getUsers')}}';
</script>
