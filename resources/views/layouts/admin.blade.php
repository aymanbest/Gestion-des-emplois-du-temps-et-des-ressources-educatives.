<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Let browser know website is optimized for mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/fomantic-ui@2.9.3/dist/semantic.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    {{-- <link rel="stylesheet" href="/resources/demos/style.css"> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.9.3/dist/semantic.min.js"></script> -->
    <style>
        #calendar {
            direction: rtl;
        }
        /* Add some basic styles for the table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            border: 1px solid black;
            position: relative;
            width: 140px;
            height: 89px;
        }

        /* Add some styles for the events */
        .event {
            /* position: absolute; */
            left: 0;
            right: 0;
            background-color: lightblue;
            text-align: center;
            display: flex;
            /* Stack contents vertically */
            flex-direction: column;
            /* Stack contents vertically */
            align-items: center;
            /* Center contents horizontally */
            justify-content: center;
            /* Center contents vertically */
            width: 140px;
            height: 89px;
            /* Ensure the div has enough space for the text */
        }

        /* .active {
            background-color: #007BFF;
            
            color: white;
            
        } */

        #depclassinfo p {
            margin-bottom: 0;
            font-size: large;
            font-weight: bold;
        }

        #depclassinfo {
            margin-bottom: 20px;
            /* Add a gap between the div and the table */
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 51px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 27px;
            width: 27px;
            left: -2px;
            /* Adjust the left position */
            bottom: -2px;
            /* Adjust the bottom position */
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider span {
            position: absolute;
            top: -20px;
            left: 0;
            right: 0;
            text-align: center;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .insertBTN {
            background-color: #fff;
            border: 1px solid #d5d9d9;
            border-radius: 8px;
            box-shadow: rgba(213, 217, 217, .5) 0 2px 5px 0;
            box-sizing: border-box;
            color: #0f1111;
            cursor: pointer;
            display: inline-block;
            font-family: "Amazon Ember", sans-serif;
            font-size: 13px;
            line-height: 29px;

            position: relative;
            text-align: center;
            text-decoration: none;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            vertical-align: middle;
            width: 50px;
        }

        .teacher-name {
            text-align: center;
            font-size: 2em;
            margin-bottom: 1em;
        }

        .report-card {
            border: 1px solid #ccc;
            padding: 1em;
            margin-bottom: 1em;
        }

        .department-name {
            font-size: 1.5em;
            margin-bottom: 0.5em;
        }

        .class-name {
            font-size: 1.2em;
            margin-bottom: 1em;
        }

        .card {
            margin-bottom: 0.5em;
        }
        .report-card-container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 20px;
}
@media (max-width: 600px) {
    .report-card-container {
        grid-template-columns: 1fr;
    }
}
    </style>

</head>

<body>

    <div id="app">
        @include('components.navbar')
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.9.3/dist/semantic.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/locales-all.min.js"></script>
    <script src="https://momentjs.com/downloads/moment-with-locales.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    @stack('calendar-scripts')

</body>

</html>