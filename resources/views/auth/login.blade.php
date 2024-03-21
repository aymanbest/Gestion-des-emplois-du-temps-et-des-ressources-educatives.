<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<link rel="stylesheet" href="./style.css">
<link rel="stylesheet" href="{{ asset('css/log.css') }}">
<style>
    /* Error message styling */
    .error.alert {
        background-color: #f8d7da;
        /* Light red background */
        color: #721c24;
        /* Dark red text color */
        border: 1px solid #f5c6cb;
        /* Light red border */
        border-radius: 0.25rem;
        /* Rounded corners */
        padding: 0.75rem 1.25rem;
        /* Padding inside the alert */
        margin-bottom: 1rem;
        /* Space below the alert */
        display: flex;
        align-items: center;
    }

    .error-icon {
        margin-right: 0.5rem;
        /* Space after the icon */
    }

    .error-message {
        flex-grow: 1;
    }
</style>

<body>
    <div class="session">
        <div class="left">
            <svg enable-background="new 0 0 300 302.5" version="1.1" viewBox="0 0 300 302.5" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                <style type="text/css">
                    .st0 {
                        fill: #fff;
                    }
                </style>
                <path class="st0" d="m126 302.2c-2.3 0.7-5.7 0.2-7.7-1.2l-105-71.6c-2-1.3-3.7-4.4-3.9-6.7l-9.4-126.7c-0.2-2.4 1.1-5.6 2.8-7.2l93.2-86.4c1.7-1.6 5.1-2.6 7.4-2.3l125.6 18.9c2.3 0.4 5.2 2.3 6.4 4.4l63.5 110.1c1.2 2 1.4 5.5 0.6 7.7l-46.4 118.3c-0.9 2.2-3.4 4.6-5.7 5.3l-121.4 37.4zm63.4-102.7c2.3-0.7 4.8-3.1 5.7-5.3l19.9-50.8c0.9-2.2 0.6-5.7-0.6-7.7l-27.3-47.3c-1.2-2-4.1-4-6.4-4.4l-53.9-8c-2.3-0.4-5.7 0.7-7.4 2.3l-40 37.1c-1.7 1.6-3 4.9-2.8 7.2l4.1 54.4c0.2 2.4 1.9 5.4 3.9 6.7l45.1 30.8c2 1.3 5.4 1.9 7.7 1.2l52-16.2z" />
            </svg>
        </div>
        <header class="cd-header">
            <div class="header-wrapper">
                <div class="nav-but-wrap">
                    <div class="menu-icon hover-target">
                        <span class="menu-icon__line menu-icon__line-left"></span>
                        <span class="menu-icon__line"></span>
                        <span class="menu-icon__line menu-icon__line-right"></span>
                    </div>
                </div>
            </div>
        </header>
        <div class="nav">
            <div class="nav__content">
                <ul class="nav__list">
                    <li class="nav__list-item"><a href="{{route('timetable')}}">TimeTable</a></li>
                    <li class="nav__list-item"><a href="{{route('raport')}}">Teachers Raport</a></li>
                    <li class="nav__list-item"><a href="{{route('reserve')}}">Reserve Classroom</a></li>
                    <li class="nav__list-item"><a href="{{route('classrooms')}}">Classrooms</a></li>
                </ul>
            </div>
        </div>

        <form class="log-in" method="POST" action="{{ route('login') }}" autocomplete="off">
            @csrf
            <h4>Bienvenue à <span>FSHS</span></h4>
            <p>Nous sommes heureux de vous retrouver ! Connectez-vous à votre compte pour organiser votre emploi du temps universitaire avec facilité.</p>
            <div class="floating-label">
                <input placeholder="Email" type="text" name="email" id="email" autocomplete="off">
                <label for="email">Email:</label>
            </div>
            <div class="floating-label">
                <input placeholder="Password" type="password" name="password" id="password" autocomplete="off">
                <label for="password">Password:</label>
            </div>
            @error('email')
            <div class="error alert" role="alert">
                <span class="error-icon">&#9888;</span> <!-- This is a warning sign emoji -->
                <span class="error-message">{{ $message }}</span>
            </div>
            @enderror

            @error('password')
            <div class="error alert" role="alert">
                <span class="error-icon">&#9888;</span> <!-- This is a warning sign emoji -->
                <span class="error-message">{{ $message }}</span>
            </div>
            @enderror


            <button type="submit">Log in</button>
        </form>
    </div>
</body>

<script>
    var app = function() {
        var body = undefined;
        var menu = undefined;
        var menuItems = undefined;
        var init = function init() {
            body = document.querySelector('body');
            menu = document.querySelector('.menu-icon');
            menuItems = document.querySelectorAll('.nav__list-item');
            applyListeners();
        };
        var applyListeners = function applyListeners() {
            menu.addEventListener('click', function() {
                return toggleClass(body, 'nav-active');
            });
        };
        var toggleClass = function toggleClass(element, stringClass) {
            if (element.classList.contains(stringClass)) element.classList.remove(stringClass);
            else element.classList.add(stringClass);
        };
        init();
    }();

    setTimeout(function() {
        var errorMessages = document.querySelectorAll('.error.alert');
        errorMessages.forEach(function(errorMessage) {
            errorMessage.remove();
        });
    }, 5000);
</script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src="./script.js"></script>