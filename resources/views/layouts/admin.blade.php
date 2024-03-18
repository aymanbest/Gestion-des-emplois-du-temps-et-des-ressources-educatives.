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
            width: 142px;
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
        .ui.grid.buttonat > .row {
    padding-top: 0.5em;
    padding-bottom: 0.5em;
}
.ui.container.modal-open {
    filter: blur(2px);
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
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    @stack('calendar-scripts')

</body>

</html>
