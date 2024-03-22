<!-- <div class="ui black inverted secondary menu">
    <div class="ui container">
        <div class="header item">
            <img src="/img/fshs.png">
        </div>
        <a href="{{route('timetable')}}" class=" active item">
            TimeTable
        </a>
        <a href="{{route('raport')}}" class=" item">
            Teachers Raport
        </a>
        <a href="{{route('reserve')}}" class="item">
            Reserve Classroom
        </a>
        <a href="{{route('classrooms')}}" class="item">
            Reserve Classroom
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
</div> -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> --}}
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
{{-- <link rel="stylesheet" href="/resources/demos/style.css"> --}}
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker-standalone.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


<div class="navigation-wrap bg-light start-header start-style">
    <div class="container">
        <div class="row">
            <div class="col-12"> <!-- Adjust the column size based on your layout -->
                <nav class="navbar navbar-expand-md navbar-light justify-content-between">
                    <a class="navbar-brand logo" href="https://fshs.uit.ac.ma/" target="_blank">
                        <img src="https://i.ibb.co/F3TDqBd/7-prev-ui.png" alt="" >
                    </a>
                    <!-- Navbar content -->
                    <ul class="navbar-nav">
                        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                            <a href="{{route('timetable')}}" class="{{ Route::currentRouteName() == 'timetable' ? 'nav-link active' : 'nav-link' }} item">
                                TimeTable
                            </a>
                        </li>
                        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                            <a href="{{route('raport')}}" class="{{ Route::currentRouteName() == 'raport' ? 'nav-link active' : 'nav-link' }} item">
                                Teachers Raport
                            </a>
                        </li>
                        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                            <a href="{{route('reserve')}}" class="{{ Route::currentRouteName() == 'reserve' ? 'nav-link active' : 'nav-link' }} item">
                                Reserve Classroom
                            </a>
                        </li>
                        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                            <a href="{{route('classrooms')}}" class="{{ Route::currentRouteName() == 'classrooms' ? 'nav-link active' : 'nav-link' }} item">
                                Classrooms
                            </a>
                        </li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                    <div class="item">
                        @if (Auth::user())
                        <a class="nav-link text-danger" id="logout-button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" type="submit">
                            Log out
                        </a>
                        @else
                        <a class="nav-link text-primary" href="{{ route('login') }}">
                            Log in
                        </a>
                        @endif
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>



@push('login-scripts')
<script>
    $('.ui.dropdown').dropdown();
    $('.ui.secondary.menu .item').on('click', function() {
        $(this).addClass('active');
    });

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
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.9.3/dist/semantic.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker-standalone.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/locales-all.min.js"></script>
<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.5/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker-standalone.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<script>
    (function($) {
        "use strict";

        
        $('body').on('mouseenter mouseleave', '.nav-item', function(e) {
            if ($(window).width() > 750) {
                var _d = $(e.target).closest('.nav-item');
                _d.addClass('show');
                setTimeout(function() {
                    _d[_d.is(':hover') ? 'addClass' : 'removeClass']('show');
                }, 1);
            }
        });

    })(jQuery);
</script>
@endpush