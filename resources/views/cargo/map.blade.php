@extends('cargo.index')
@section('cargo_content')
    <section class="slice">
        <div class="container">
            <div id="map" data-table="cargo"></div>
            <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
            <script
                src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap&libraries=&v=weekly"
                async>
            </script>
        </div>
    </section>
    <script>
        var dataObject = {!! json_encode($cargos) ?? '' !!};
    </script>
@endsection
