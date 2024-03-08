@extends('layouts.admin')

@section('content')
    <div class="ui container">
        <div class="ui grid">
            <div class="four wide column">
                <div class="fc-header-form">
                    <h2 class="fc-header-form-title" id="fc-header-form-title-dom-1">Time Table</h2>
                </div>
                <button id="toggle-search">Toggle Search</button>
                <button id="updates-button">Updates</button>
                <button id="Insert-button">Insert</button>
                <div class="ui hidden divider"></div>

                <input type="hidden" id="searchpep" value="false">
                <input type="hidden" id="updatepep" value="false">
                <input type="hidden" id="event-key" value="">


                <div class="ui form">
                    <div class="ui grid">
                        <div class="two column row">
                            <div class=" eight wide column">
                                <div class="field" id="date-field">
                                    <p>Date</p>
                                    <div class="ui dropdown selection">
                                        <input type="hidden" id="date-input" name="date">
                                        <div class="default text">date</div>
                                        <i class="dropdown icon"></i>
                                        <div class="menu" id="date-menu">
                                        </div>
                                    </div>
                                </div>
                                <div class="field" id="class-field">
                                    <p>Class</p>
                                    <div class="ui dropdown selection">
                                        <input type="hidden" id="class-input" name="class">
                                        <div class="default text">Class</div>
                                        <i class="dropdown icon"></i>
                                        <div class="menu" id="class-menu">
                                        </div>
                                    </div>
                                </div>
                                <div class="field" id="semester-field">
                                    <p>semester</p>
                                    <div class="ui dropdown selection">
                                        <input type="hidden" id="semester-input" name="semester">
                                        <div class="default text">semester</div>
                                        <i class="dropdown icon"></i>
                                        <div class="menu" id="semester-menu">
                                        </div>
                                    </div>
                                </div>
                                <div class="field" id="salle-field">
                                    <p>Salle</p>
                                    <div class="ui dropdown selection">
                                        <input type="hidden" id="Salle-input" name="Salle">
                                        <div class="default text">Salle</div>
                                        <i class="dropdown icon"></i>
                                        <div class="menu" id="Salle-menu">
                                        </div>
                                    </div>
                                </div>
                                <div class="field" id="teacher-type-field">
                                    <p>Teacher Type:</p>
                                    <div class="ui dropdown selection">
                                        <input type="hidden" id="TeacherT-input" name="TeacherT">
                                        <div class="default text">Position</div>
                                        <i class="dropdown icon"></i>
                                        <div class="menu" id="TeacherT-menu">
                                        </div>
                                    </div>
                                </div>
                                <div class="field" id="teacher-field">
                                    <p>teacher</p>
                                    <div class="ui dropdown selection">
                                        <input type="hidden" id="teacher-input" name="teacher">
                                        <div class="default text">teacher</div>
                                        <i class="dropdown icon"></i>
                                        <div class="menu" id="teacher-menu">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="eight wide column">
                                <div class="field" id="department-field">
                                    <p>Department</p>
                                    <div class="ui dropdown selection">
                                        <input type="hidden" id="department-input" name="department">
                                        <div class="default text">Department</div>
                                        <i class="dropdown icon"></i>
                                        <div class="menu" id="department-menu">
                                        </div>
                                    </div>
                                </div>
                                <div class="field" id="module-field">
                                    <p>module</p>
                                    <div class="ui dropdown selection">
                                        <input type="hidden" id="module-input" name="module">
                                        <div class="default text">module</div>
                                        <i class="dropdown icon"></i>
                                        <div class="menu" id="module-menu">
                                        </div>
                                    </div>
                                </div>
                                <div class="field" id="group-field">
                                    <p>Group</p>
                                    <div class="ui dropdown selection">
                                        <input type="hidden" id="Group-input" name="Group">
                                        <div class="default text">Group</div>
                                        <i class="dropdown icon"></i>
                                        <div class="menu" id="Group-menu">
                                        </div>
                                    </div>
                                </div>
                                <div class="field" id="seance-jour-field">
                                    <p>Jour de la séance</p>
                                    <div class="ui dropdown selection">
                                        <input type="hidden" id="day-of-week-input" name="seance_jour">
                                        <div class="default text">Jourséance</div>
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
                                                <div class="item" data-value="{{ $day }}">{{ $translatedDay }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="field" id="heure-demarrage-field">
                                    <p>Heure Démmarage</p>
                                    <div class="ui dropdown selection">
                                        <input type="hidden" id="heure_demarrage" name="heure_demarrage">
                                        <div class="default text">Démmarage</div>
                                        <i class="dropdown icon"></i>
                                        <div class="menu">
                                            @php
                                                $startTime = strtotime('08:30');
                                                $endTime = strtotime('18:30');
                                                $interval = 30 * 60; // 30 minutes in seconds
                                            @endphp
                                            @for ($time = $startTime; $time <= $endTime; $time += $interval)
                                                @php $formattedTime=date('H:i:s', $time); @endphp <div class="item" data-value="{{ $formattedTime }}">
                                                    {{ $formattedTime }}</div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="field" id="heure-fin-field">
                                    <p>Heure Fin</p>
                                    <div class="ui dropdown selection">
                                        <input type="hidden" id="heure_fin" name="heure_fin">
                                        <div class="default text">Fin</div>
                                        <i class="dropdown icon"></i>
                                        <div class="menu">
                                            @php
                                                $startTime = strtotime('08:30');
                                                $endTime = strtotime('18:30');
                                                $interval = 30 * 60; // 30 minutes in seconds
                                            @endphp
                                            @for ($time = $startTime; $time <= $endTime; $time += $interval)
                                                @php $formattedTime=date('H:i:s', $time); @endphp <div class="item" data-value="{{ $formattedTime }}">
                                                    {{ $formattedTime }}</div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button id="session-submit" class="ui labeled icon fluid green button">
                            <i class="calendar plus outline icon"></i>
                            Valider la séance
                        </button>

                    </div>
                </div>
            </div>
            <div class="twelve wide column">
                <table id="calendar">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Monday</th>
                            <th>Tuesday</th>
                            <th>Wednesday</th>
                            <th>Thursday</th>
                            <th>Friday</th>
                            <th>Saturday</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('calendar-scripts')
    <!-- Initialize FullCalendar using jQuery -->

    <script>
        function notify(header, message, type = 'success', timeout = 3000) {
            var messageDiv = $('<div class="ui ' + type + ' message"></div>');
            messageDiv.append('<i class="close icon"></i>');
            messageDiv.append('<div class="header">' + header + '</div>');
            messageDiv.append('<p>' + message + '</p>');
            $('body').append(messageDiv);

            messageDiv.css({
                'position': 'fixed',
                'right': '20px',
                'top': '20px',
                'z-index': '9999'
            });

            messageDiv.find('.close').on('click', function() {
                $(this).closest('.message').remove();
            });
            setTimeout(function() {
                messageDiv.remove();
            }, timeout);
        }

        $("#Insert-button").on('click', () => {
            document.location.reload();
        });

        $(document).ready(function() {
            $('#searchpep').val('false');
            $('#updatepep').val('false');
            $("#datepicker").val("");
        });

        var updateEnabled = false;

        $('#updates-button').on('click', function() {
            $(".ui.dropdown").dropdown("clear");
            updateEnabled = !updateEnabled;
            toggleSearch(); // Function to toggle search
            $('#updatepep').val(updateEnabled ? 'true' : 'false');

            // Check if update toggle is on
            if ($('#updatepep').val() == 'true') {

                $('#session-submit').text(updateEnabled ? 'Update' : 'Valider la séance').toggleClass(
                    'centered-text', searchEnabled);

            }
        });

        function toggleSearch() {
            $('#toggle-search').trigger('click'); // Trigger search toggle
        }


        function captureEvent(event) {

            var eventData = event; // Access the first element of the eventData array

            console.log(eventData);

            // Fetch teacher types
            $.get('/api/teacher_types', function(data) {
                var menu = $('#TeacherT-menu');
                menu.empty(); // Clear previous options
                data.forEach(function(teacherType) {
                    menu.append('<div class="item" data-value="' + teacherType.teacher_type_id + '">' +
                        teacherType.name + '</div>');
                });

            });




            // Fetch semesters
            $.get('/api/semestre', function(data) {
                var menu = $('#semester-menu');
                menu.empty(); // Clear previous options
                data.forEach(function(semester) {
                    menu.append('<div class="item" data-value="' + semester.semester_id + '">' + semester
                        .semester_code + '</div>');
                });
                // Set selected value if needed

            });

            // Fetch departments
            $.ajax({
                url: 'http://127.0.0.1:8000/api/departments',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Clear any existing content in the "department-menu"
                    $('#department-menu').empty();

                    // Iterate through the response and create labels
                    $.each(response, function(index, department) {
                        var label = $('<div class="item" onclick="refillClassAfterDepartement(' +
                            department.department_id + ')" data-value="' + department
                            .department_id + '">' + department.name + '</div>');
                        $('#department-menu').append(label);
                    });
                    // Set selected value if needed

                },
                error: function(xhr, status, error) {
                    // Handle errors if any
                    console.error('Error:', status, error);
                }
            });

            // Fetch classes based on department
            $.get('/api/classes/show/' + eventData.department_id, function(data) {
                var menu = $('#class-menu');
                menu.empty(); // Clear previous options
                data.forEach(function(classData) {
                    menu.append('<div class="item" data-value="' + classData.class_id + '">' + classData
                        .name + '</div>');
                });
                // Set selected value if needed

            });

            // Fetch modules based on class
            $.get('/api/classes/' + eventData.class_id + '/modules', function(data) {
                var menu = $('#module-menu');
                menu.empty(); // Clear previous options
                data.forEach(function(module) {
                    menu.append('<div class="item" data-value="' + module.module_id + '">' + module.name +
                        '</div>');
                });
                // Set selected value if needed

            });

            // Fetch teachers based on teacher type
            $.get('/api/teachers/' + eventData.teacher_type_id, function(data) {
                var menu = $('#teacher-menu');
                menu.empty(); // Clear previous options
                data.forEach(function(teacher) {
                    menu.append('<div class="item" data-value="' + teacher.teacher_id + '">' + teacher
                        .fullname + '</div>');
                });
                $('#module-input').dropdown('refresh');
                // Set selected value if needed

            });

            // Fetch classrooms based on department and class
            $.get('/api/classrooms/show/' + eventData.department_id + '/' + eventData.class_id, function(data) {
                var menu = $('#Salle-menu');
                menu.empty(); // Clear previous options
                data.forEach(function(classroom) {
                    menu.append('<div class="item" data-value="' + classroom.classroom_id + '">' + classroom
                        .name + '</div>');
                });
                // Set selected value if needed

            });

            $("#event-key").val(eventData.schedule_id);

            $(".ui.dropdown").dropdown("refresh"); // Refresh dropdowns

            $('.ui.dropdown #TeacherT-input').parent('.ui.dropdown').dropdown('set selected', eventData.teacher_type_id);
            $('.ui.dropdown #semester-input').parent('.ui.dropdown').dropdown('set selected', eventData.semester_id);
            $('.ui.dropdown #department-input').parent('.ui.dropdown').dropdown('set selected', eventData.department_id);
            $('.ui.dropdown #class-input').parent('.ui.dropdown').dropdown('set selected', eventData.class_id);
            $('.ui.dropdown #module-input').parent('.ui.dropdown').dropdown('set selected', eventData.module_id);
            $('.ui.dropdown #teacher-input').parent('.ui.dropdown').dropdown('set selected', eventData.teacher_id);
            $('.ui.dropdown #Salle-menu').parent('.ui.dropdown').dropdown('set selected', eventData.classroom_id);
            $('.ui.dropdown #day-of-week-input').parent('.ui.dropdown').dropdown('set selected', eventData.day_of_week);
            $('.ui.dropdown #heure_demarrage').parent('.ui.dropdown').dropdown('set selected', eventData.start_time);
            $('.ui.dropdown #heure_fin').parent('.ui.dropdown').dropdown('set selected', eventData.end_time);

            // $(".ui.dropdown").dropdown("refresh"); // Refresh dropdowns



        }



        function addEvent(event) {
            // Extract day, time, and title from the event
            var day = event.day_of_week;
            var time = event.start_time + ' - ' + event.end_time;
            var title = event.title;

            // Get the table body
            var tbody = document.querySelector('#calendar tbody');

            // Loop through the table rows
            Array.from(tbody.rows).forEach(function(row) {
                // Check if this row's time slot matches the event's time
                if (row.cells[0].textContent === time) {
                    // Loop through the rest of the cells
                    for (var i = 1; i < row.cells.length; i++) {
                        // Check if this cell's day matches the event's day
                        if (daysOfWeek[i - 1] === day) {
                            // Add the event to the cell
                            row.cells[i].textContent = title;
                        }
                    }
                }
            });
        }

        var searchEnabled = false;

        // Toggle search functionality
        $('#toggle-search').click(function() {
            $(".ui.dropdown").dropdown("clear");
            searchEnabled = !searchEnabled;
            // Hide/show fields based on the searchEnabled flag
            // Replace #fields with the actual selector of your fields
            $('#semester-field').toggle(!searchEnabled);
            $('#module-field').toggle(!searchEnabled);
            // Add other field IDs here
            $('#salle-field').toggle(!searchEnabled);
            $('#teacher-type-field').toggle(!searchEnabled);
            $('#group-field').find('p').text(searchEnabled ? 'GP (OPTIONAL)' : 'Group');
            $('#heure-demarrage-field').toggle(!searchEnabled);
            $('#heure-fin-field').toggle(!searchEnabled);
            $('#seance-jour-field').toggle(!searchEnabled);
            $('#teacher-field').toggle(!searchEnabled);
            $('#searchpep').val(searchEnabled ? 'true' : 'false');

            if ($("#updatepep").val() == "false") {
                $('#session-submit').text(searchEnabled ? 'Search' : 'Valider la séance').toggleClass(
                    'centered-text', searchEnabled);
            }

        });

        // Fetch data from the provided URL
        $('#session-submit').click(function() {
            if (searchEnabled) {
                //e.preventDefault();
                var classInput = $("#class-input").val();
                var departmentInput = $("#department-input").val();
                var selectedDate = $("#datepicker").datepicker("getDate");

                var groupInput = $("#Group-input").val();


                // $.get('api/years/show/' + selectedYear, function(data) {
                var selectedYearID = $("#date-input").val();

                var fetchUrl = 'http://127.0.0.1:8000/api/schedules/show/department/' +
                    departmentInput + '/classes/' + classInput + '/year/' + selectedYearID;

                if (groupInput) {
                    fetchUrl += '/group/' + groupInput;
                }

                // Fetch data from the provided URL
                fetch(fetchUrl)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status == "empty") {
                            notify('No events found On this Weak', 'Try another Groupe',
                                "negative");
                        }

                        if (!data.hasOwnProperty('status')) {
                            calendar.removeAllEvents();
                            notify('successful', 'Found Events');

                            calendar.addEventSource(data);
                        }
                        if ($('#updatepep').val() == 'true') {
                            toggleSearch();
                            //captureEvent(data);
                        }
                    })
                    .catch(error => {
                        console.error(error);
                        notify('Error fetching data', "error", "negative");
                    });
                // });
            }
        });

        calendar.render();
        $.get('/api/years', function(data) {
        var minYear = Infinity;
        var maxYear = -Infinity;

        for (var i = 0; i < data.length; i++) {
            var year = parseInt(data[i].year);
            if (year < minYear) minYear = year;
            if (year > maxYear) maxYear = year;
        }

        minYear = new Date(minYear, 0, 1);
        maxYear = new Date(maxYear, 11, 31);

        $("#datepicker").datepicker({
            defaultDate: null,
            changeMonth: true,
            changeYear: true,
            minDate: minYear,
            maxDate: maxYear,
            beforeShowDay: function(date) {
                var day = date.getDay();
                return [(day == 1)]; // Only allow selection of Mondays
            },
            onSelect: function(dateText, inst) {
                var date = $(this).datepicker('getDate');
                var startDate = new Date(date.getFullYear(), date.getMonth(), date
                    .getDate() - date.getDay() + 1);
                var endDate = new Date(date.getFullYear(), date.getMonth(), date
                    .getDate() - date.getDay() + 7);
                calendar.gotoDate(
                    startDate); // Change the start date of the FullCalendar
                calendar.render(); // Render the calendar to display the selected week
            }
        });
        });
        });
    </script>

    <script>
        $('.ui.dropdown.selection')
            .dropdown({
                clearable: true
            });
    </script>

    <script>
        $(document).ready(function() {
            function generateCalendar(startTime, endTime, interval) {
                var daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                var tableBody = document.querySelector('#calendar tbody');

                for (var i = startTime; i < endTime; i += interval) {
                    var timeSlotStart = formatTime(i);
                    var timeSlotEnd = formatTime(i + interval);
                    var row = document.createElement('tr');
                    var cell = document.createElement('td');
                    cell.textContent = timeSlotStart + ' - ' + timeSlotEnd;
                    row.appendChild(cell);

                    for (var j = 0; j < daysOfWeek.length; j++) {
                        var cell = document.createElement('td');
                        row.appendChild(cell);
                    }

                    tableBody.appendChild(row);
                }
            }

            function formatTime(time) {
                var hours = Math.floor(time / 60);
                var minutes = time % 60;
                return pad(hours) + ':' + pad(minutes);
            }

            function pad(number) {
                return (number < 10 ? '0' : '') + number;
            }

            generateCalendar(510, 1080, 90);
            // Fetch the teacher types
            $.get('/api/teacher_types', function(data) {
                var menu = $('#TeacherT-menu');
                data.forEach(function(teacherType) {
                    menu.append('<div class="item" data-value="' + teacherType.teacher_type_id +
                        '">' + teacherType.name + '</div>');
                });
            });

            // Fetch the semesters
            $.get('/api/semestre', function(data) {
                var menu = $('#semester-menu');
                data.forEach(function(semester) {
                    menu.append('<div class="item" data-value="' + semester.semester_id + '">' +
                        semester.semester_code + '</div>');
                });
            });

            $.get('/api/years', function(data) {
                var menu = $('#date-menu');
                data.forEach(function(date) {
                    menu.append('<div class="item" data-value="' + date.year_id + '">' + date.year +
                        '</div>');
                });
            });

            // Fetch the modules for the selected class
            $('#class-input').change(function() {
                var classId = $(this).val();

                // Clear the module dropdown menu
                $('#module-menu').empty();

                $.get('/api/classes/' + classId + '/modules', function(data) {
                    var menu = $('#module-menu');
                    data.forEach(function(module) {
                        menu.append('<div class="item" data-value="' + module.module_id +
                            '">' + module.name + '</div>');
                    });
                });
            });

            // Fetch the classrooms for the selected department and class
            $('#department-input, #class-input').change(function() {
                var departmentId = $('#department-input').val();
                var classId = $('#class-input').val();

                if (departmentId && classId) {
                    // Clear the salle dropdown menu
                    $('#salle-menu').empty();

                    $.get('/api/classrooms/show/' + departmentId + '/' + classId, function(data) {
                        var menu = $('#Salle-menu');
                        data.forEach(function(classroom) {
                            menu.append('<div class="item" data-value="' + classroom
                                .classroom_id + '">' + classroom.name + '</div>');
                        });
                    });
                }
            });

            // Fetch the teachers for the selected teacher type
            $('#TeacherT-input').change(function() {
                var teacherTypeId = $(this).val();

                // Clear the teacher dropdown menu
                $('#teacher-menu').empty();

                $.get('/api/teachers/' + teacherTypeId, function(data) {
                    var menu = $('#teacher-menu');
                    data.forEach(function(teacher) {
                        menu.append('<div class="item" data-value="' + teacher.teacher_id +
                            '">' + teacher.fullname + '</div>');
                    });
                });
            });
        });


        $.get('/api/groups', function(data) {
            var groupMenu = $('#Group-menu');
            for (var i = 0; i < data.length; i++) {
                groupMenu.append('<div class="item" data-value="' + data[i].group_id + '">' + data[i].group_code +
                    '</div>');
            }
            $('#Group-input').parent().dropdown();


        });


        // var dropdowns = ["group-input", "class-input", "module-input", "teacher-input", "Salle-input", "day-of-week-input"];

        // dropdowns.forEach(function(dropdown) {
        //     $('#' + dropdown).parent().dropdown({
        //         onChange: function(value) {
        //             $('#' + dropdown).val(value);
        //         }
        //     });
        // });


        // SEARCH TABLE IDEA 
        // $(document).ready(function() {
        // When the datepicker or the day of the week dropdown changes...
        //     $("#datepicker, #day-of-week-input").change(function() {
        //         // Get the selected date and day of the week
        //         var date = $("#datepicker").datepicker("getDate");
        //         var dayOfWeek = $("#day-of-week-input").val();
        //         console.log(dayOfWeek);

        //         // Map the day of the week to a number
        //         var daysOfWeek = {
        //             'sunday': 0,
        //             'monday': 1,
        //             'tuesday': 2,
        //             'wednesday': 3,
        //             'thursday': 4,
        //             'friday': 5,
        //             'saturday': 6
        //         };
        //         var dayOfWeekNumber = daysOfWeek[dayOfWeek.toLowerCase()];

        //         console.log(dayOfWeekNumber);

        //         // Calculate the start and end times
        //         var startTime = new Date(date.getFullYear(), date.getMonth(), date.getDate(), 8, 30);
        //         var endTime = new Date(date.getFullYear(), date.getMonth(), date.getDate(), 18, 30);

        //         // Adjust the date based on the selected day of the week
        //         startTime.setDate(startTime.getDate() - startTime.getDay() + dayOfWeekNumber);
        //         endTime.setDate(endTime.getDate() - endTime.getDay() + dayOfWeekNumber);

        //         // Clear the dropdown menu
        //         // $("#heure_demarrage-menu").empty();

        //         // Populate the dropdown menu with the new times
        //         for (var time = startTime; time <= endTime; time.setMinutes(time.getMinutes() + 30)) {
        //             var formattedDateTime = time.toISOString().slice(0, 19).replace('T', ' ');
        //             var formattedDate = formattedDateTime.split(' ')[0];
        //             var formattedTime = formattedDateTime.split(' ')[1];
        //             $("#heure_demarrage-menu").append('<div class="item" data-value="' + formattedDateTime + '">' + formattedTime + '</div>');
        //         }

        //         // Refresh the dropdown to show the new items
        //         $("#heure_demarrage-menu").dropdown('refresh');
        //     });
        // });
    </script>

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
            if ($("#searchpep").val() == "false") {
                // Fetch all schedules
                $.get('http://127.0.0.1:8000/api/schedules', function(schedules) {
                    var conflict = false;
                    var conflictGroups = [];

                    // Check each schedule for conflicts
                    $.each(schedules, function(index, schedule) {
                        if ($("#Salle-input").val() == schedule.classroom_id &&
                            $("#heure_demarrage").val() == schedule.start_time &&
                            $("#heure_fin").val() == schedule.end_time &&
                            $("#day-of-week-input").val() == schedule.day_of_week) {
                            conflict = true;
                            conflictGroups.push(schedule.group.group_id);
                        }
                    });

                    // If there's a conflict, show a confirmation dialog
                    if (conflict) {
                        var message = 'The classroom is already full. Do you want to proceed?';
                        if (conflictGroups.length > 0) {
                            message += ' The conflicting groups are: ' + conflictGroups.join(', ') + '.';
                        }
                        if (!confirm(message)) {
                            return; // Cancel the form submission
                        }
                    }

                    var schedulekey = $("#event-key").val();

                    var Link = $("#updatepep").val() == "true" ? 'http://127.0.0.1:8000/api/schedules/' +
                        schedulekey : 'http://127.0.0.1:8000/api/schedules/create'

                    // If there's no conflict or the user confirmed, proceed with the form submission
                    var form = new FormData();
                    form.append("year_id", $("#date-input").val());
                    form.append("semester_id", $("#semester-input").val());
                    form.append("group_id", $("#Group-input").val());
                    form.append("class_id", $("#class-input").val());
                    form.append("module_id", $("#module-input").val());
                    form.append("teacher_id", $("#teacher-input").val());
                    form.append("classroom_id", $("#Salle-input").val());
                    form.append("day_of_week", $("#day-of-week-input").val());
                    form.append("start_time", $("#heure_demarrage").val());
                    form.append("end_time", $("#heure_fin").val());

                    var isUpdate = $("#updatepep").val() == "true";
                    // var contentType = isUpdate ? false : "multipart/form-data";
                    // var data = isUpdate ? JSON.stringify(form) : form;
                    console.log("data");
                    console.log(form);

                    var settings = {
                        "url": Link,
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

                    // if (isUpdate) {
                    //     form.append("_method", "PUT");
                    // }

                    $.ajax(settings).done(function(response) {
                        if (response.errors) {
                            // Handle validation errors here
                            $.each(response.errors, function(field, error) {
                                // Display the error message for the corresponding field
                                $("#" + field + "-error").text(error[0]);
                            });
                        } else {
                            // Request was successful, process the response data
                            notify($("#updatepep").val() == "true" ? 'Update' : "Insert",
                                'successful');
                        }
                    }).fail(function(xhr, status, error) {
                        // Handle other errors (e.g., 500 Internal Server Error)
                        // console.error(xhr.responseText);
                        notify.error('error: ' + xhr.responseText);
                    });
                });
            }
        });
        // $("#session-submit").on('click', () => {


        //     if ($("#searchpep").val() == "false") {
        //         // var selectedDate = $("#datepicker").datepicker("getDate");
        //         // var selectedYear = selectedDate.getFullYear();
        //         // $.get('api/years/show/' + selectedYear, function(data) {
        //             // var selectedYearID = data.id;
        //             var form = new FormData();
        //             form.append("year_id",  $("#date-input").val());
        //             form.append("semester_id", $("#semester-input").val());
        //             form.append("group_id", $("#Group-input").val());
        //             form.append("class_id", $("#class-input").val());
        //             form.append("module_id", $("#module-input").val());
        //             form.append("teacher_id", $("#teacher-input").val());
        //             form.append("classroom_id", $("#Salle-input").val());
        //             form.append("day_of_week", $("#day-of-week-input").val());
        //             // var selectedDate = $("#datepicker").datepicker("getDate");
        //             // var formattedDate = selectedDate.getFullYear() + '-' + (selectedDate.getMonth() + 1).toString().padStart(2, '0') + '-' + selectedDate.getDate().toString().padStart(2, '0');
        //             form.append("start_time", $("#heure_demarrage").val());
        //             form.append("end_time", $("#heure_fin").val());

        //             console.log(form);

        //             var settings = {
        //                 "url": "http://127.0.0.1:8000/api/schedules/create",
        //                 "method": "POST",
        //                 "timeout": 0,
        //                 "headers": {
        //                     "Accept": "application/json"
        //                 },
        //                 "processData": false,
        //                 "mimeType": "multipart/form-data",
        //                 "contentType": false,
        //                 "data": form
        //             };

        //             $.ajax(settings).done(function(response) {
        //                 if (response.errors) {
        //                     // Handle validation errors here
        //                     $.each(response.errors, function(field, error) {
        //                         // Display the error message for the corresponding field
        //                         $("#" + field + "-error").text(error[0]);
        //                     });
        //                 } else {
        //                     // Request was successful, process the response data
        //                     console.log(response);
        //                 }
        //             }).fail(function(xhr, status, error) {
        //                 // Handle other errors (e.g., 500 Internal Server Error)
        //                 console.error(xhr.responseText);
        //             });
        //         // });
        //     }
        // });
    </script>
@endpush
