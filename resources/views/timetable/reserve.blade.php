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
                    <p>Expire Date and Time:</p>
                    <input id="datetimepicker" type="text">
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
                            'Monday' => 'الاثنين',
                            'Tuesday' => 'الثلاثاء',
                            'Wednesday' => 'الأربعاء',
                            'Thursday' => 'الخميس',
                            'Friday' => 'الجمعة',
                            'Saturday' => 'السبت',
                            'Sunday' => 'الأحد',
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
        <button id="reserve-button" class="ui labeled icon fluid green button">
            <i class="calendar plus outline icon"></i>
            Reserve
        </button>
    </div>
</div>
<div class="twelve wide column">
    <h1 style="text-align:center">Reservations</h1>
    <div class="ui grid">
        <div class="right floated right aligned column">
            <button class="ui blue icon button Refresh-button" id="Refresh-button">
                <i class="undo icon"></i>
            </button>
        </div>
        <div class="ui hidden divider"></div>
    </div>
    <div class="ui cards centered" id="raport"></div>
</div>
</div>
</div>
@endsection

@push('calendar-scripts')
<script>

    $(document).ready(function() {
        getreserv();

        function getreserv() {
            $.ajax({
                url: '/api/getReservations',
                method: 'GET',
                success: function(reservations) {
                    $("#home-loader").fadeOut();
                    var report = $('#raport');
                    if (reservations.length === 0) {
                        var message = `
                            <div class="col-md-12 text-center" style="color: red; font-weight: bold;">
                                There is no reservations at the moment
                            </div>
                        `;
                        report.html(message);
                    } else {
                        reservations.forEach(function(reservation) {
                            var card = `
                                    <div class=" blue card">
                                        <div class="content" style="text-align:center;">
                                            <div class="header">${reservation.teacher.fullname}</div>
                                            <div class="meta">${reservation.classroom.classroom_code}</div>
                                            <div class="description" style="color:red">
                                                    ${reservation.date}
                                            </div>
                                        </div>
                                    </div>
                            `;
                            report.append(card);
                        });
                    }
                }
            });
        }
        $('#Refresh-button').click(function(e) {
            e.preventDefault();
            $('#raport').empty();
            // console.log('refresh');
            getreserv();
        });
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
    $('#datetimepicker').datetimepicker();
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

    $(document).ready(function() {
        $('#day-of-week-input, #heure_demarrage, #heure_fin').change(function() {
            var dayOfWeek = $('#day-of-week-input').val();
            var startTime = $('#heure_demarrage').val();
            var endTime = $('#heure_fin').val();
            $.post('/api/avClasses', {
                dayOfWeek: dayOfWeek,
                startTime: startTime,
                endTime: endTime,
                _token: '{{ csrf_token() }}'
            }, function(data) {
                $('#Salle-menu').empty();
                data.forEach(function(classroom) {
                    $('#Salle-menu').append('<div class="item" data-value="' + classroom
                        .classroom_id +
                        '">' + classroom.name + '</div>');
                });
                $('#Salle-menu').parent().dropdown('refresh');
            });
        });
    });
    $(document).ready(function() {
        $('#reserve-button').click(function(e) {
            e.preventDefault();

            var classroom_id = $('#Salle-input').val();
            var day_of_week = $('#day-of-week-input').val();
            var teacher_id = $('#teacher-input').val();
            var start_time = $('#heure_demarrage').val();
            var date = $('#datetimepicker').val();
            var end_time = $('#heure_fin').val();

            $.post('/api/reserveClass', {
                classroom_id: classroom_id,
                day_of_week: day_of_week,
                teacher_id: teacher_id,
                start_time: start_time,
                date: date,
                end_time: end_time,
                _token: '{{ csrf_token() }}'
            }, function(response) {
                if (response.status === 'success') {
                    $("#dialog-confirm").dialog({
                        resizable: false,
                        height: "auto",
                        width: 400,
                        modal: true,
                        buttons: {
                            "Proceed": function() {
                                $(this).dialog("close");
                                // Make another request to the server to force the reservation
                                $.post('/reserveClass', {
                                    classroom_id: classroom_id,
                                    day_of_week: day_of_week,
                                    teacher_id: teacher_id,
                                    start_time: start_time,
                                    date: date,
                                    end_time: end_time,
                                    force: true, // Add a new parameter to indicate that the reservation should be forced
                                    _token: '{{ csrf_token() }}'
                                }, function(response) {
                                    notify('Success', response.message);
                                    $('#Refresh-button').trigger('click');
                                });
                            },
                            Cancel: function() {
                                $(this).dialog("close");
                            }

                        },
                        open: function() {
                            $('#container').addClass('modal-open');
                        },
                        close: function() {
                            $('#container').removeClass('modal-open');
                        }
                    });
                } else if (response.status === 'success') {

                    notify('Success', 'The class has been reserved successfully');
                    $('#Refresh-button').trigger('click');
                }
            });
        });
    });
</script>
@endpush