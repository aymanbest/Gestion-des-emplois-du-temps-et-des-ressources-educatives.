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
@push('calendar-scripts')
    <script>
        $(document).ready(function() {
            $('.ui.dropdown').dropdown();

            $('#session-submit').click(function(e) {
                e.preventDefault();

                var teacherId = $('#teacher-input').val();
                var totalDuration = 0;

                $.get('api/raport/teacher/' + teacherId, function(data) {
                    console.log(data);
                    if (data.status == "empty") {
                        reportCard = '<div class="report-card-container">';
                        reportCard += '<p>There is no report for this teacher.</p>';
                        reportCard += '</div>';
                        $('#raport').html(reportCard);
                        $('#total-duration').empty();
                    } else {
                        var reportCard = '';
                        var teacherName = '';
                        var groupedData = {};
                        
                        function formatDuration(minutes) {
                            var hours = Math.floor(minutes / 60);
                            var remainingMinutes = minutes % 60;
                            return hours + ' h ' + remainingMinutes + ' min';
                        }

                        // Group data by department_name and class_name
                        $.each(data, function(index, report) {
                            var key = report.department_name + '-' + report.class_name;
                            if (!groupedData[key]) {
                                groupedData[key] = {
                                    teacher_name: report.teacher_name,
                                    department_name: report.department_name,
                                    class_name: report.class_name,
                                    groups: [],
                                    total_duration: 0
                                };
                            }
                            groupedData[key].groups.push({
                                group_id: report.group_id,
                                total_duration: parseInt(report.total_duration)
                            });
                            groupedData[key].total_duration += parseInt(report
                                .total_duration);
                            totalDuration += parseInt(report.total_duration);
                        });

                        // Generate report card
                        reportCard += '<div class="report-card-container">';
                        $.each(groupedData, function(key, report) {
                            if (!teacherName) {
                                teacherName = '<h3 class="teacher-name">' + report
                                    .teacher_name + '</h3>';
                            }

                            reportCard += '<div class="report-card">';
                            reportCard += '<h1 class="department-name">' + report
                                .department_name + ' - Total Duration: ' + report
                                .total_duration + ' min (' + formatDuration(report
                                    .total_duration) + ')' + '</h1>';
                            reportCard += '<p class="class-name">' + report.class_name +
                                '</p>';

                            var sameDurationGroups = {};
                            $.each(report.groups, function(index, group) {
                                if (!sameDurationGroups[group.total_duration]) {
                                    sameDurationGroups[group.total_duration] = [];
                                }
                                sameDurationGroups[group.total_duration].push(group
                                    .group_id);
                            });


                            $.each(sameDurationGroups, function(duration, groups) {
                                var totalGroupDuration = duration * groups.length;
                                reportCard += '<div class="card">';
                                reportCard += '<p>Group : ' + groups.join(' & ') +
                                    '</p>';
                                if (groups.length > 1) {
                                    reportCard += '<p>Total Duration: ' + duration +
                                        ' min (' + formatDuration(duration) + ')' +
                                        ' x ' + groups.length + ' = ' +
                                        totalGroupDuration + ' min (' +
                                        formatDuration(totalGroupDuration) + ')' +
                                        '</p>';
                                } else {
                                    reportCard += '<p>Duration: ' + duration +
                                        ' min (' + formatDuration(duration) + ')' +
                                        '</p>';
                                }

                                reportCard += '</div>';
                            });

                            reportCard += '</div>';

                        });
                        reportCard += '</div>';

                        $('#raport').html(teacherName + reportCard);
                        $('#total-duration').text(
                            'Total Duration for All Classes and Departments: ' + totalDuration +
                            ' min (' + formatDuration(totalDuration) + ')'
                            ); // Display overall total duration
                    }
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
