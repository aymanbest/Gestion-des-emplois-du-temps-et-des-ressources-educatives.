@extends('layouts.admin')

@section('content')
<div class="ui hidden divider"></div>
<div class="ui hidden divider"></div>
<div class="ui hidden divider"></div>
<div id="progress-dialog" title="Downloading and zipping files...">
    <div id="progressbar"></div>
</div>
<div class="ui container" id="container">
<div class="ui hidden divider"></div>
    <div class="ui grid">
        <div class="four wide column">
            <div class="fc-header-form">
                <h2 class="fc-header-form-title" id="fc-header-form-title-dom-1">Classroom Schedules</h2>
            </div>
            <div class="ui  form">
                <div class="field" id="salle-field">
                    <p>Salle</p>
                    <div class="ui fluid search selection dropdown">
                        <input type="hidden" id="Salle-input" name="Salle">
                        <div class="default text">Salle</div>
                        <i class="dropdown icon"></i>
                        <div class="menu" id="Salle-menu">
                        </div>
                    </div>
                </div>
                <button id="session-submit" class="ui labeled icon fluid green button">
                    <i class="calendar plus outline icon"></i>
                    Search schedules
                </button>
            </div>
        </div>


        <div class="twelve wide column">
            <div class="ui grid">
                <div class="row">
                    <div class="one wide column">
                        <button class="ui red icon button" id="Insert-button">
                            <i class="undo icon"></i>
                        </button>

                    </div>
                    <div class="one wide column">
                        <button class="ui icon button" id="settings">
                            <i class="cog icon"></i>
                        </button>
                    </div>
                    <div class="one wide column">
                        <button class="ui icon button" id="export-excel">
                            <i class="save icon"></i>
                        </button>
                    </div>

                </div>
            </div>
            <div style="text-align: center;" id="depclassinfo"></div>
            <table id="calendar">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
</div>





@endsection

@push('calendar-scripts')
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

    document.getElementById('settings').addEventListener('click', function() {
        var newTimeSlotDuration = prompt(
            'Please enter the new time slot duration in hours. For example: "2" for 2 hours');
        if (newTimeSlotDuration) {
            var startTime = 8.5; // Start time in hours
            var endTime = 18;
            var newTimeSlots = [];
            for (var time = startTime; time < endTime; time += parseFloat(newTimeSlotDuration)) {
                var startHour = Math.floor(time).toString().padStart(2, '0');
                var startMinutes = (time % 1) * 60;
                var endHour = Math.floor(time + parseFloat(newTimeSlotDuration));
                var endMinutes = ((time + parseFloat(newTimeSlotDuration)) % 1) * 60;
                // Check if the end time of the last time slot exceeds the endTime
                // if (endHour > endTime || (endHour === endTime && endMinutes > 0)) {
                //     break;
                // }
                newTimeSlots.push(
                    `${startHour}:${startMinutes < 10 ? '0' : ''}${startMinutes} - ${endHour}:${endMinutes < 10 ? '0' : ''}${endMinutes}`
                );
                // Check if the start time of the next time slot is 13:00
                if (endHour === 13 && endMinutes === 0) {
                    time += 0.5; // Add the half-hour break
                }
            }
            localStorage.setItem('timeSlots', JSON.stringify(newTimeSlots));
            generateCalendar();
        }
    });

    function formatTime(time) {
        var hours = Math.floor(time / 60);
        var minutes = time % 60;
        return (hours < 10 ? '0' : '') + hours + ':' + (minutes < 10 ? '0' : '') + minutes;
    }

    function pad(number) {
        return (number < 10 ? '0' : '') + number;
    }

    var dayNamesArabic = {
        "Sunday": "الأحد",
        "Monday": "الاثنين",
        "Tuesday": "الثلاثاء",
        "Wednesday": "الأربعاء",
        "Thursday": "الخميس",
        "Friday": "الجمعة",
        "Saturday": "السبت"
    };

    function generateCalendar() {
        var daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        var timeSlots = JSON.parse(localStorage.getItem('timeSlots')) || ['08:30 - 10:00', '10:00 - 11:30',
            '11:30 - 13:00', '13:30 - 15:00', '15:00 - 16:30', '16:30 - 18:00'
        ];
        var tableBody = document.querySelector('#calendar tbody');
        var tableHead = document.querySelector('#calendar thead');



        tableBody.innerHTML = '';
        tableHead.innerHTML = '';

        // Create a row for the time slots and append it to the table head
        var timeRow = document.createElement('tr');
        var emptyCell = document.createElement('th');
        timeRow.appendChild(emptyCell);

        for (var i = 0; i < timeSlots.length; i++) {
            var timeCell = document.createElement('th');
            timeCell.textContent = timeSlots[i];
            timeRow.appendChild(timeCell);
        }

        tableHead.appendChild(timeRow);

        // Create a row for each day of the week and append it to the table body
        for (var j = 0; j < daysOfWeek.length; j++) {
            var row = document.createElement('tr');
            var dayCell = document.createElement('td');
            dayCell.textContent = dayNamesArabic[daysOfWeek[j]];
            dayCell.style.textAlign = 'center';
            row.appendChild(dayCell);

            for (var i = 0; i < timeSlots.length; i++) {
                var cell = document.createElement('td');
                cell.style.width = '142px'; // Set width
                cell.style.height = '89px'; // Set height
                cell.style.overflow = 'hidden'; // Hide overflow
                row.appendChild(cell);
            }

            tableBody.appendChild(row);
        }
    }
    $(document).ready(function() {
        $.get('/api/classrooms/getAllClassrooms', function(data) {
            var menu = $('#Salle-menu');
            data.forEach(function(c) {
                menu.append('<div class="item" data-value="' + c
                    .classroom_id + '">' + c.name + " " + (c.full ? '' : '<span style="color: lightblue;">No S</span>' ) + '</div>');
            });
        });
        $('#Salle-input').parent().dropdown();

        generateCalendar();
    });

    $("#Insert-button").on('click', () => {
        document.location.reload();
    });

    function addEvent(event) {
        var daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        var day = event.day_of_week;
        var startTime = event.start_time.slice(0, 5); // Remove seconds from start time
        var endTime = event.end_time.slice(0, 5); // Remove seconds from end time
        if (!event.reserve) {
            var title = (event.module_name ? event.module_name + "<br>" : "") + "<br>" + event.fullname;
        } else {
            var title = event.fullname + "<br>" + "<p class='resstate'>Reserved</p>";
        }

        // Get the table body
        var tbody = document.querySelector('#calendar tbody');
        var thead = document.querySelector('#calendar thead');

        // Loop through the table rows
        Array.from(tbody.rows).forEach(function(row, rowIndex) {
            // Check if this row's day matches the event's day
            if (dayNamesArabic[daysOfWeek[rowIndex]] === dayNamesArabic[day]) {
                // Loop through the rest of the cells
                var eventStartCellIndex = -1;
                var eventEndCellIndex = -1;
                for (var i = 1; i < row.cells.length; i++) {
                    // Extract start and end time from the cell's time slot
                    var cellTime = thead.rows[0].cells[i].textContent.split(' - ');
                    var cellStartTime = cellTime[0];
                    var cellEndTime = cellTime[1];

                    // Check if the event overlaps with the cell's time range
                    if (startTime < cellEndTime && endTime > cellStartTime) {
                        if (eventStartCellIndex === -1) {
                            eventStartCellIndex = i;
                        }
                        eventEndCellIndex = i;
                    }
                }


                if (eventStartCellIndex !== -1 && eventEndCellIndex !== -1) {
                    var eventDiv = document.createElement('div');
                    eventDiv.className = 'event';
                    eventDiv.style.border = '1px solid black';
                    eventDiv.style.backgroundColor = 'lightblue';
                    eventDiv.style.overflow = 'hidden'; // Hide overflow
                    eventDiv.style.textOverflow = 'ellipsis'; // Add ellipsis for overflow text
                    eventDiv.style.whiteSpace = 'nowrap'; // Prevent text from wrapping to the next line
                    eventDiv.style.width = '100%'; // Set width
                    eventDiv.style.height = '100%'; // Set height
                    eventDiv.innerHTML = title;

                    // Add the event to the cell
                    row.cells[eventStartCellIndex].appendChild(eventDiv);
                    row.cells[eventStartCellIndex].colSpan = eventEndCellIndex - eventStartCellIndex + 1;

                    // Remove the cells that are spanned by the event
                    for (var i = eventStartCellIndex + 1; i <= eventEndCellIndex; i++) {
                        row.cells[i].style.display = 'none';
                    }
                }
            }
        });
    }

    function clearEvents() {
        var cells = document.querySelectorAll('#calendar td');
        cells.forEach(function(cell) {
            var events = cell.querySelectorAll('.event');
            events.forEach(function(event) {
                event.remove();
            });
        });
        generateCalendar();
    }

    $('#session-submit').click(function() {
        var classroomId = $('#Salle-input').val();
        $.get('/api/scherev/classroom/' + classroomId, function(data) {
            if (data.status == "empty") {
                notify('Aucun événement trouvé', 'Pour cette salle de classe', 'négatif');
                return;
            }
            console.log(data);
            $('#depclassinfo').html('<p>' + data.events[0].classroom_code + '</p>');
            clearEvents();
            data.events.forEach(function(events) {
                addEvent(events);
            });
        });
    });


    $('#export-excel').click(function() {
        var zip = new JSZip();
        $('#container').addClass('bluryat');
        $("<div>Export only the selected group or all groups?</div>").dialog({

            buttons: {
                "Selected Group": function() {
                    var departmentId = $('#department-input').val();
                    var classroomId = $('#Salle-input').val();
                    var yearId = $('#date-input').val();
                    var groupId = $('#Group-input').val();



                    $(this).dialog("close");
                    $('#container').removeClass('bluryat');

                    $.ajax({
                        url: 'api/export/classroom/' + classroomId,
                        method: 'GET',
                        xhrFields: {
                            responseType: 'blob' // Important
                        },
                        success: function(data, textStatus, xhr) {
                            var filename = '';
                            var disposition = xhr.getResponseHeader('Content-Disposition');
                            if (disposition && disposition.indexOf('attachment') !== -1) {
                                var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                                var matches = filenameRegex.exec(disposition);
                                if (matches != null && matches[1]) {
                                    filename = matches[1].replace(/['"]/g, '');
                                }
                            }
                            //blob
                            var blob = new Blob([data], {
                                type: xhr.getResponseHeader('Content-Type')
                            });
                            var url = URL.createObjectURL(blob);
                            var a = document.createElement('a');
                            a.href = url;
                            a.download = filename || 'classroom.xlsx';
                            document.body.appendChild(a);
                            a.click();
                            notify('Success', 'Data exported successfully');
                            document.body.removeChild(a);
                            URL.revokeObjectURL(url);
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            notify('Error', 'Error exporting data', 'negative');
                        }
                    });
                },
                "All Groups": function() {
                    var classroom_id = $('#Salle-input').val();

                    $(this).dialog("close");

                    $("#progress-dialog").dialog("open");

                    $.get('/api/classrooms', function(data) {
                        var requests = [];
                        $.each(data, function(index, c) {
                            console.log('Group ID:', c.classroom_id);
                            var request = $.ajax({
                                url: 'api/export/classroom/' + c.classroom_id,
                                method: 'GET',
                                xhrFields: {
                                    responseType: 'blob'
                                }
                            });

                            request.done(function(data) {
                                console.log('Data:', data);
                                zip.file(c.classroom_code + '.xlsx', data, {
                                    binary: true
                                });
                            });

                            requests.push(request);
                        });

                        // Wait for all AJAX requests to complete
                        Promise.all(requests).then(function() {
                            zip.generateAsync({
                                type: "blob"
                            }).then(function(content) {
                                saveAs(content, "classrooms.zip");
                                $('#container').removeClass('bluryat');
                                $("#progress-dialog").dialog("close");
                            });
                        });
                    });
                }
            },
            close: function() {
                $('#container').removeClass('bluryat');
            }
        });
    });




</script>

@endpush