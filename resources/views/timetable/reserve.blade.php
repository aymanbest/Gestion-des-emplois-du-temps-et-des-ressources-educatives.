@extends('layouts.admin')


@section('content')
    <div class="ui container">
        <div class="ui grid">
            <div class="four wide column">
                <div class="fc-header-form">
                    <h2 class="fc-header-form-title" id="fc-header-form-title-dom-1">Reservation</h2>
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
                    <button id="session-submit" class="ui labeled icon fluid green button">
                        <i class="calendar plus outline icon"></i>
                        Search Raport
                    </button>
                </div>
            </div>
            <div class="twelve wide column">
                <div id="raport"></div>
                <div id="total-duration"></div>
            </div>
        </div>
    </div>
@endsection
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker-standalone.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@push('calendar-scripts')
    <script>
        $('#datetimepicker').datetimepicker();

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
    </script>
@endpush
