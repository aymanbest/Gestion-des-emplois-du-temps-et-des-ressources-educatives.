<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<link rel="stylesheet" href="./style.css">
<link rel="stylesheet" href="{{ asset('css/log.css') }}">

<body>
    <div class="session">
        <div class="left">
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

        <form id="login-form" method="POST" action="{{ route('login') }}" autocomplete="off">
            @csrf
            <svg class="logo" version="1.0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500.000000 500.000000" preserveAspectRatio="xMidYMid meet">
                <g transform="translate(0.000000,500.000000) scale(0.100000,-0.100000)" fill="#233ce4" stroke="none">
                    <path d="M2015 4271 c-23 -10 -54 -42 -69 -73 -21 -43 -3 -157 39 -246 42 -89 42 -112 2 -59 -33 44 -83 67 -141 67 -123 0 -209 -102 -193 -225 14 -96 84 -175 206 -232 l76 -36 -37 -9 c-51 -13 -99 -74 -106 -133 -11 -100 71 -194 221 -254 112 -45 167 -105 167 -182 0 -20 5 -29 16 -29 14 0 16 9 12 58 -7 95 -54 146 -208 222 -105 52 -150 105 -150 177 0 90 97 141 175 93 18 -11 40 -32 49 -45 16 -24 46 -34 46 -16 0 21 -130 140 -175 160 -26 11 -78 41 -115 66 -56 38 -74 56 -96 101 -20 42 -25 64 -21 95 22 162 227 173 305 16 12 -24 22 -49 22 -56 0 -6 5 -11 10 -11 10 0 14 36 10 100 -1 19 -17 80 -35 135 -18 55 -36 121 -40 146 -9 60 9 125 40 145 40 26 33 42 -10 25z" />
                    <path d="M2311 4008 c-63 -193 -75 -361 -42 -593 11 -82 23 -171 25 -197 3 -26 7 -51 9 -55 11 -18 22 -188 21 -323 -1 -148 -21 -267 -60 -341 -20 -39 2 -40 38 -1 106 112 141 355 100 692 -11 91 -21 172 -21 180 -1 8 -3 31 -6 50 -2 19 -7 56 -9 81 -3 25 -10 86 -16 135 -14 121 -12 285 4 367 12 62 12 67 -5 67 -13 0 -23 -17 -38 -62z m0 -345 c1 -46 32 -290 51 -403 12 -73 23 -428 12 -418 -3 4 -8 44 -10 90 -2 46 -5 97 -8 113 -3 17 -7 50 -10 75 -3 25 -10 65 -15 90 -6 25 -13 72 -16 105 -3 33 -10 87 -15 120 -5 33 -12 104 -14 158 -3 79 -1 97 10 97 8 0 14 -11 15 -27z" />
                </g>
            </svg>

            <h1>Sign In</h1>

            <div class="input email">
                <input type="text" name="email" id="email" value="email@uit.ac.ma" placeholder=" " autocomplete="off">
                <label for="email">Email</label>
            </div>

            <div class="input password">
                <div class="dots"></div>
                <input type="password" name="password" id="password" placeholder=" " autocomplete="off">
                <label for="password">Password</label>
                <div class="cursor"></div>
                <div class="line">
                    <svg>
                        <use xlink:href="#line">
                    </svg>
                </div>
                <div class="tick">
                    <svg>
                        <use xlink:href="#tick">
                    </svg>
                </div>
            </div>

            <button type="submit" disabled>
                <svg viewBox="0 0 16 16">
                    <circle stroke-opacity=".1" cx="8" cy="8" r="6"></circle>
                    <circle class="load" cx="8" cy="8" r="6"></circle>
                </svg>
                <span>Submit</span>
            </button>

        </form>

        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 900 22" id="line">
                <path d="M0,11 L180,11 C240,11.00344 300,13.6718267 360,19.00516 C450,27.00516 450,-4.99483997 540,3.00516003 C600,8.33849336 660,11.00344 720,11 L900,11"></path>
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 28" id="tick">
                <path d="M3,12.5026479 L7,16.5026479 L13,9.50264792 C29.6216402,-12.0066881 40.3541164,26.00516 19,26.0026479 L-3.37507799e-13,26.0026479"></path>
            </symbol>
        </svg>
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

    window.onload = () => {
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        emailInput.onpaste = e => e.preventDefault();
        passwordInput.onpaste = e => e.preventDefault();
    }

    const $ = (s, o = document) => o.querySelector(s);
    const $$ = (s, o = document) => o.querySelectorAll(s);

    const login = $('#login-form');
    const passwordContainer = $('.password', login);
    const password = $('input', passwordContainer);
    const passwordList = $('.dots', passwordContainer);
    const submit = $('button', login);

    password.addEventListener('input', e => {
        if (password.value.length > $$('i', passwordList).length) {
            passwordList.appendChild(document.createElement('i'));
        }
        submit.disabled = !password.value.length;
        passwordContainer.style.setProperty('--cursor-x', password.value.length * 10 + 'px');
    });

    let pressed = false;

    password.addEventListener('keydown', e => {

        if (pressed || login.classList.contains('processing') || (password.value.length > 14 && e.keyCode != 8 && e.keyCode != 13)) {
            e.preventDefault();
        }
        pressed = true;

        setTimeout(() => pressed = false, 50);

        if (e.keyCode == 8) {
            let last = $('i:last-child', passwordList);
            if (last !== undefined && last) {
                last.classList.add('remove');
                setTimeout(() => last.remove(), 50);
            }
        }

    });

    password.addEventListener('select', function() {
        this.selectionStart = this.selectionEnd;
    });

    login.addEventListener('submit', e => {
        e.preventDefault();

        if (!login.classList.contains('processing')) {
            login.classList.add('processing');

            // Create a new FormData object and append the email and password values
            let formData = new FormData();
            formData.append('email', document.querySelector('#email').value);
            formData.append('password', password.value);

            // Send a POST request to the server
            fetch("{{ route('login') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    let cls = data.message !== "connected" ? 'error' : 'success';

                    login.classList.add(cls);
                    setTimeout(() => {
                        login.classList.remove('processing', cls);
                        if (cls == 'error') {
                            password.value = '';
                            passwordList.innerHTML = '';
                            submit.disabled = true;
                        } else {
                            window.location.href = "{{ route('timetable') }}";
                        }
                    }, 2000);
                    setTimeout(() => {
                        if (cls == 'error') {
                            passwordContainer.style.setProperty('--cursor-x', 0 + 'px');
                        }
                    }, 600);
                });
        }
    });
</script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src="./script.js"></script>