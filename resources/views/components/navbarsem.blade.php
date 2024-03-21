<div class="ui small menu">
    <div class="ui container">
    <a href="{{route('timetable')}}" class="{{ Route::currentRouteName() == 'timetable' ? 'active' : '' }} item">
            TimeTable
        </a>
        <a href="{{route('raport')}}" class="{{ Route::currentRouteName() == 'raport' ? 'active' : '' }} item">
            Teachers Raport
        </a>
        <a href="{{route('reserve')}}" class="{{ Route::currentRouteName() == 'reserve' ? 'active' : '' }} item">
            Reserve Classroom
        </a>
        <a href="{{route('classrooms')}}" class="{{ Route::currentRouteName() == 'classrooms' ? 'active' : '' }} item">
            Classrooms
        </a>
        @if(Auth::user())
            <a class="item">
                Hi, {{Auth::user()->name}}
            </a>
        @endif
        <div class="right menu">
            <div class="item">
                @if (Auth::user())
                <a class="ui button red" id="logout-button" type="submit">
                    Log out
                </a>
                @else
                <a class="ui button primary" href="{{ route('login') }}">
                    Log in
                </a>
                @endif
            </div>
        </div>
    </div>
</div>

@push('login-scripts')
<script>
    $('.ui.dropdown').dropdown();

    // jQuery script for the logout button
    $(document).ready(function() {
        $('#logout-button').on('click', function() {
            // Get the CSRF token from the meta tag
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Make an AJAX POST request to /logout
            $.ajax({
                type: 'POST',
                url: '/logout',
                data: {
                    _token: csrfToken // Include the CSRF token in the request data
                },
                dataType: 'json', // Change the datatype if your server responds with a different type
                success: function(response) {
                    // Redirect the user to a specified URL (e.g., the home page)
                    window.location.href = "{{ route('login') }}";
                },
                error: function(error) {
                    // Handle errors, if needed
                    console.error('Logout error:', error);
                }
            });
        });
    });
</script>
@endpush
