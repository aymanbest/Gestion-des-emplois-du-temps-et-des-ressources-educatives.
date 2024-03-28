@extends('layouts.admin')

@section('content')
@include('components.loaders.loader', ['id' => 'home-loader', 'text' => 'Loading...'])
<div id="dialog-confirm" title="Confirm Reservation" style="display: none;">
    <p>The schedule is full. Do you want to proceed?</p>
</div>

<div class="ui hidden divider"></div>
<div class="ui hidden divider"></div>
<div class="ui hidden divider"></div>
<div class="ui container" id="container">
    <div class="ui hidden divider"></div>

    <div class="ui grid">
        <div class="four wide column">
            <div id="content-to-hide">
                <div class="fc-header-form">
                    <h2 class="fc-header-form-title" id="fc-header-form-title-dom-1">Reserve</h2>
                </div>
                <div class="ui form">
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
                    <div class="field">
                        <p>La Date:</p>
                        <input id="datetimepicker" type="text">
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
                                @for ($time = $startTime; $time <= $endTime; $time +=$interval) @php $formattedTime=date('H:i:s', $time); @endphp <div class="item" data-value="{{ $formattedTime }}">
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
                            @for ($time = $startTime; $time <= $endTime; $time +=$interval) @php $formattedTime=date('H:i:s', $time); @endphp <div class="item" data-value="{{ $formattedTime }}">
                                {{ $formattedTime }}</div>
                        @endfor
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
            </div>
            <button id="attend-button" class="ui labeled icon fluid green button">
                <i class="calendar plus outline icon"></i>
                Attended
            </button>
        </div>
    </div>
</div>
<div class="twelve wide column">
    <div class="ui grid">
        <div id="content-to-hide2">
            <div class="row">
                <div class="one wide column">
                    <button class="ui red icon button" id="Insert-button">
                        <i class="undo icon"></i>
                    </button>

                </div>
                <div class="one wide column">
                    <button class="ui icon button" id="print">
                        <i class="save icon"></i>
                    </button>
                </div>

            </div>
        </div>
        <div style="text-align: center;" id="attendinfo"></div>
        <div class="ui hidden divider"></div>
        <div class="field" style="display: flex; align-items: center;">
            <div id="content-to-show" style="width: 900px; display: flex; flex-direction: column; align-items: center;">
                <div style="text-align:center;">
                    <p>Date:</p>
                    <div style="display: flex; align-items: center;">
                        <input id="datetimepicker1" type="text" style="margin-right: 10px;">
                        <button style="margin-top: 0;" class="ui icon button" id="search-button">
                            <i class="search icon"></i>
                        </button>
                    </div>
                </div>

                <div class="ui hidden divider"></div>

                <table border="1" id="attendance-table" style="direction: rtl; width: 100%;">
                    <thead>
                        <tr>
                            <th style="text-align:center;">Classroom Name</th>
                            <th style="text-align:center;">Time Zone</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Rows will be added here dynamically -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('calendar-scripts')
<script>
    $(document).ready(function() {
        $('#print').click(function() {
            // Hide the content to hide
            $('#attend-button').hide();
            $('#content-to-hide').hide();
            $('#content-to-hide2').hide();

            $('#attendinfo').prepend('<div id="header"><div id="left">Year scholair: 2024/2025</div><div id="right">Faculter des sciene</div></div>');

            $('#header').css({
                'display': 'flex',
                'justify-content': 'space-between',
                'position': 'absolute',
                'top': '0',
                'left': '0',
                'right': '0'
            });

            $('#content-to-show').css({
                'align-item': 'center',
                'margin-right': '500px'
            });

            $('#left').css({
                'position': 'absolute',
                'top': '0',
                'left': '0'
            });

            $('#right').css({
                'position': 'absolute',
                'top': '0',
                'right': '0'
            });

            $('#attendance-table').css({
                'width': '210mm',
                'height': '297mm',
                'margin': '0 auto'
            });

            window.print();
        });

        // After print dialog is closed
        window.onafterprint = function() {
            // Show the content again
            $('#attend-button').show();
            $('#content-to-hide').show();
            $('#content-to-hide2').show();

            $('#header').remove();

            $('#attendance-table').css({
                'width': '',
                'height': '',
                'margin': ''
            });
        }
    });

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
    $('#datetimepicker').datetimepicker({
        format: 'MM/DD/YYYY'
    });
    $('#datetimepicker1').datetimepicker({
        format: 'MM/DD/YYYY'
    });
    $('.ui.dropdown').dropdown('clear');
    $(document).ready(function() {
        $('.ui.dropdown').dropdown();
        $.get('/api/teacher_types', function(data) {
            var menu = $('#TeacherT-menu');
            data.forEach(function(teacherType) {
                menu.append('<div class="item" data-value="' + teacherType.teacher_type_id +
                    '">' + teacherType.name + '</div>');
            });
            $('#TeacherT-menu').parent().dropdown('refresh');
            $('#TeacherT-input').trigger('change');
        });

        $('#TeacherT-input').change(function() {
            var teacherTypeId = $(this).val();
            $('#teacher-menu').empty();
            $.get('/api/teachers/' + teacherTypeId, function(data) {
                var menu = $('#teacher-menu');
                data.forEach(function(teacher) {
                    menu.append('<div class="item" data-value="' + teacher.teacher_id +
                        '">' + teacher.fullname + '</div>');
                });

                $('#teacher-menu').parent().dropdown('refresh');
            });
        });
    });

    $.get('/api/classrooms/getAllClassrooms', function(data) {
        var menu = $('#Salle-menu');
        data.forEach(function(classroom) {
            menu.append('<div class="item" data-value="' + classroom
                .classroom_id +
                '">' + classroom.name + '</div>');
        });
        $("#home-loader").fadeOut();
        $('#Salle-menu').parent().dropdown('refresh');
        $('#Salle-input').trigger('change');
    });

    $('#attend-button').click(function() {

        var classroom_id = $('#Salle-input').val();
        var teacher_id = $('#teacher-input').val();
        var start_time = $('#heure_demarrage').val();
        var date = $('#datetimepicker').val();
        var end_time = $('#heure_fin').val();

        $.post('/api/teacher-attendance', {
                _token: '{{ csrf_token() }}',
                classroom_id: classroom_id,
                teacher_id: teacher_id,
                start_time: start_time,
                end_time: end_time,
                date: date
            })
            .done(function(response) {
                console.log(response);
                notify('Success', 'Attendance has been recorded successfully.', 'success');
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                notify('Error', 'An error occurred while recording the attendance.', 'error');
            });
    });

    $.get('/api/classrooms/getAllClassrooms', function(classrooms) {
        classrooms.forEach(function(classroom) {
            // Add a row to the table for this classroom
            $('#attendance-table tbody').append(
                '<tr data-classroom-id="' + classroom.classroom_id + '">' +
                '<td style="text-align:center;">' + classroom.name + '</td>' +
                '<td class="time-zone"></td>' +
                '</tr>'
            );
        });
    });

    // $(document).ready(function() {
    //     $('#datetimepicker1').change(function() {
    //         var date = $(this).val();
    //         console.log(date);
    //     });
    // });
    $('#search-button').click(function() {
        var date = $('#datetimepicker1').val();
        console.log(date);

        $.get('/api/getattendance', {
                date: date
            })
            .done(function(response) {
                // Clear the time zones
                $('.time-zone').empty();

                response.attendance.forEach(function(attendance) {
                    // Find the row for this classroom
                    var row = $('#attendance-table tbody tr[data-classroom-id="' + attendance.classroom_id + '"]');
                    if (row.length > 0) {
                        var timeZoneCell = row.find('.time-zone');
                        timeZoneCell.append(
                            '<div>' +
                            '<p>' + attendance.teacher.fullname + '</p>' +
                            '<p>' + attendance.start_time + ' - ' + attendance.end_time + '</p>' +
                            '</div>' +
                            '<hr>'
                        );
                    }
                });
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            });
    });
</script>
@endpush