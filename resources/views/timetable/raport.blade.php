@extends('layouts.admin')

@section('content')
<div class="ui container">
    <div class="ui grid">
        <div class="four wide column">
            <div class="fc-header-form">
                <h2 class="fc-header-form-title" id="fc-header-form-title-dom-1">Teacher Raport</h2>
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
                <button id="session-submit" class="ui labeled icon fluid green button">
                    <i class="calendar plus outline icon"></i>
                    Valider la séance
                </button>
            </div>
        </div>
        <div class="twelve wide column">
            <div id="raport"></div>

        </div>
    </div>
</div>
@endsection
@push('calendar-scripts')

<script>
$(document).ready(function() {
    $('.ui.dropdown').dropdown();

    $('#session-submit').click(function(e) {
        e.preventDefault();

        var teacherId = $('#teacher-input').val();

        $.get('raport/teacher/' + teacherId, function(data) {
            var reportCard = '';
            var teacherName = '';
            var groupedData = {};

            // Group data by department_name and class_name
            $.each(data, function(index, report) {
                var key = report.department_name + '-' + report.class_name;
                if (!groupedData[key]) {
                    groupedData[key] = {
                        teacher_name: report.teacher_name,
                        department_name: report.department_name,
                        class_name: report.class_name,
                        groups: []
                    };
                }
                groupedData[key].groups.push({
                    group_id: report.group_id,
                    total_duration: report.total_duration
                });
            });

            // Generate report card
            reportCard += '<div class="report-card-container">';
            $.each(groupedData, function(key, report) {
                if (!teacherName) {
                    teacherName = '<h3 class="teacher-name">' + report.teacher_name + '</h3>';
                }
                
                reportCard += '<div class="report-card">';
                reportCard += '<h1 class="department-name">' + report.department_name + '</h1>';
                reportCard += '<p class="class-name">' + report.class_name + '</p>';
                
                var sameDurationGroups = {};
                $.each(report.groups, function(index, group) {
                    if (!sameDurationGroups[group.total_duration]) {
                        sameDurationGroups[group.total_duration] = [];
                    }
                    sameDurationGroups[group.total_duration].push(group.group_id);
                });

                
                $.each(sameDurationGroups, function(duration, groups) {
                    reportCard += '<div class="card">';
                    reportCard += '<p>Group : ' + groups.join(' & ') + '</p>';
                    reportCard += '<p>Total Duration: ' + duration + ' min</p>';
                    reportCard += '</div>';
                });

                reportCard += '</div>';
                
            });
            reportCard += '</div>';

            $('#raport').html(teacherName + reportCard);
        });
    });
});
$(document).ready(function() {
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