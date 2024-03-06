@extends('layouts.admin')

@section('content')
    <div class="ui container">
        <div class="ui grid">
            <div class="four wide column">
                <div class="fc-header-form">
                    <h2 class="fc-header-form-title" id="fc-header-form-title-dom-1">Time Table</h2>
                </div>
                <div class="ui hidden divider"></div>
                <div class="ui form">
                    <div class="field">
                        <p>Date</p>
                        <input type="text" id="datepicker">
                    </div>
                    <div class="field">
                        <p>Department</p>
                        <div class="ui dropdown selection">
                            <input type="hidden" id="department-input" name="department">
                            <div class="default text">Department</div>
                            <i class="dropdown icon"></i>
                            <div class="menu" id="department-menu">
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <p>Class</p>
                        <div class="ui dropdown selection">
                            <input type="hidden" id="class-input" name="class">
                            <div class="default text">Class</div>
                            <i class="dropdown icon"></i>
                            <div class="menu" id="class-menu">
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <p>Jour de la séance</p>
                        <div class="ui dropdown selection">
                            <input type="hidden" id="day-of-week-input" name="seance_jour">
                            <div class="default text">Jour de la séance</div>
                            <i class="dropdown icon"></i>
                            <div class="menu">
                                @php
                                    $days = [
                                        'Monday' => 'Lundi',
                                        'Tuesday' => 'Mardi',
                                        'Wednesday' => 'Mercredi',
                                        'Thursday' => 'Jeudi',
                                        'Friday' => 'Vendredi',
                                        'Saturday' => 'Samedi',
                                        'Sunday' => 'Dimanche',
                                    ];
                                @endphp
                                @foreach ($days as $day => $translatedDay)
                                    <div class="item" data-value="{{ $day }}">{{ $translatedDay }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <p>Heure Démmarage</p>
                        <div class="ui dropdown selection">
                            <input type="hidden" id="heure_demarrage" name="heure_demarrage">
                            <div class="default text">Heure Démmarage</div>
                            <i class="dropdown icon"></i>
                            <div class="menu">
                                @php
                                    $startTime = strtotime('08:30');
                                    $endTime = strtotime('18:30');
                                    $interval = 30 * 60; // 30 minutes in seconds
                                @endphp
                                @for ($time = $startTime; $time <= $endTime; $time += $interval)
                                    @php
                                        $formattedTime = date('H:i:s', $time);
                                    @endphp
                                    <div class="item" data-value="{{ $formattedTime }}">{{ $formattedTime }}</div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <p>Heure Fin</p>
                        <div class="ui dropdown selection">
                            <input type="hidden" id="heure_fin" name="heure_fin">
                            <div class="default text">Heure Fin</div>
                            <i class="dropdown icon"></i>
                            <div class="menu">
                                @php
                                    $startTime = strtotime('08:30');
                                    $endTime = strtotime('18:30');
                                    $interval = 30 * 60; // 30 minutes in seconds
                                @endphp
                                @for ($time = $startTime; $time <= $endTime; $time += $interval)
                                    @php
                                        $formattedTime = date('H:i:s', $time);
                                    @endphp
                                    <div class="item" data-value="{{ $formattedTime }}">{{ $formattedTime }}</div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <button id="session-submit" class="ui labeled icon fluid green button">
                        <i class="calendar plus outline icon"></i>
                        Valider la séance
                    </button>
                </div>
            </div>
            <div class="twelve wide column">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
@endsection

@push('calendar-scripts')
    <!-- Initialize FullCalendar using jQuery -->
    <script>
        var calendarEl = null;

        $(document).ready(function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                slotDuration: '00:30:00', // 30-minute time slots
                slotMinTime: '08:30:00', // 08:30 AM
                slotMaxTime: '18:30:00', // 06:00 PM
                height: 'auto', // Auto-adjust the height based on content
                selectable: true, // Enable selection
                select: function(info) {
                    // Handle the selection here
                    var startTime = info.start;
                    var endTime = info.end;

                    // Create a new event based on the selection
                    var newEvent = {
                        title: 'New Event', // You can set the event title
                        start: startTime,
                        end: endTime,
                        allDay: false // This event is not an all-day event
                    };

                    // Render the new event on the calendar
                    calendar.addEvent(newEvent);

                    // Clear the selection after creating the event
                    calendar.unselect();
                },
                editable: true, // Enable event editing (move events)
                eventDrop: function(info) {
                    // Handle event drop (when an event is moved)
                    console.log('Event dropped:', info.event.title, 'New start:', info.event.start,
                        'New end:', info.event.end);
                },
                allDaySlot: false, // Hide the "all day" section
                slotLabelInterval: {
                    minutes: 30
                }, // Display labels every 30 minutes
                slotLabelContent: function(arg) {
                    // Calculate the end time of the slot
                    var endTime = new Date(arg.date.getTime() + 30 * 60 * 1000); // Add 30 minutes

                    // Format the label in the desired range format (e.g., "08:30 - 09:00")
                    var formattedStartTime = arg.date.toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: false
                    });
                    var formattedEndTime = endTime.toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: false
                    });
                    return formattedStartTime + ' - ' + formattedEndTime;
                },
                firstDay: 1 // Set Monday (0 = Sunday, 1 = Monday, 2 = Tuesday, etc.)
            });

            // Fetch data from the provided URL
            fetch('http://127.0.0.1:8000/api/schedules/show/department/2/classes/4/year/1')
                .then(response => response.json())
                .then(data => {
                    // Add fetched events to the calendar
                    calendar.addEventSource(data);
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });

            calendar.render();
            $("#datepicker").datepicker({
                defaultDate: null,
                changeMonth: true,
                minDate: new Date(new Date().getFullYear(), 0, 1), 
                maxDate: new Date(new Date().getFullYear(), 11, 31),
                beforeShowDay: function(date) {
                    var day = date.getDay();
                    return [(day == 1)]; // Only allow selection of Mondays
                },
                onSelect: function(dateText, inst) {
                    var date = $(this).datepicker('getDate');
                    var startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date
                        .getDay() + 1);
                    var endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date
                        .getDay() + 7);
                    calendar.gotoDate(startDate); // Change the start date of the FullCalendar
                    calendar.render(); // Render the calendar to display the selected week
                }
            });
        });
    </script>

    <script>
        $('.ui.dropdown.selection')
            .dropdown({
                clearable: true
            });
    </script>

    <script></script>

    <script>
        $.ajax({
            url: 'http://127.0.0.1:8000/api/departments',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                // Clear any existing content in the "department-menu"
                $('#department-menu').empty();

                // Iterate through the response and create labels
                $.each(response, function(index, department) {
                    var label = $('<div class="item" onclick="refillClassAfterDepartement(' + department
                        .department_id + ')" data-value="' + department.department_id + '">' +
                        department.name + '</div>');
                    $('#department-menu').append(label);
                });
            },
            error: function(xhr, status, error) {
                // Handle errors if any
                console.error('Error:', status, error);
            }
        });
    </script>

    <script>
        function refillClassAfterDepartement(department_id) {
            $.ajax({
                url: 'http://127.0.0.1:8000/api/classes/show/' + department_id,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Clear any existing content in the "department-menu"
                    $('#class-menu').empty();

                    // Iterate through the response and create labels
                    $.each(response, function(index, classes) {
                        var label = $('<div class="item" data-value="' + classes.class_id +
                            '">' + classes.name + '</div>');
                        $('#class-menu').append(label);
                    });
                },
                error: function(xhr, status, error) {
                    // Handle errors if any
                    console.error('Error:', status, error);
                }
            });
        }
    </script>

    <script>
        $("#session-submit").on('click', () => {
            var form = new FormData();
            form.append("year_id", "1");
            form.append("semester_id", "1");
            form.append("group_id", "1");
            form.append("class_id", $("#class-input").val());
            form.append("module_id", "1");
            form.append("teacher_id", "1");
            form.append("classroom_id", "1");
            form.append("day_of_week", $("#day-of-week-input").val());
            form.append("start_time", $("#heure_demarrage").val());
            form.append("end_time", $("#heure_fin").val());

            var settings = {
                "url": "http://127.0.0.1:8000/api/schedules/create",
                "method": "POST",
                "timeout": 0,
                "headers": {
                    "Accept": "application/json"
                },
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": form
            };

            $.ajax(settings).done(function(response) {
                if (response.errors) {
                    // Handle validation errors here
                    $.each(response.errors, function(field, error) {
                        // Display the error message for the corresponding field
                        $("#" + field + "-error").text(error[0]);
                    });
                } else {
                    // Request was successful, process the response data
                    console.log(response);
                }
            }).fail(function(xhr, status, error) {
                // Handle other errors (e.g., 500 Internal Server Error)
                console.error(xhr.responseText);
            });
        });
    </script>
@endpush
