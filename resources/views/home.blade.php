@extends('layouts.app')

@section('content')
    @include('components.loaders.loader', ['id' => 'home-loader', 'text' => 'Loading...'])

    @include('components.modals.message', [
        'type' => 'error',
        'icon' => 'question',
        'header' => 'Attention!',
        'content' =>
            'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus cumque enim a omnis, ratione totam voluptatem. Laborum ad quisquam laboriosam, quas dolor unde earum nam. Laboriosam nihil laudantium illum magni!',
    ])

    {{-- @include('components.modals.warning') --}}

    <div id="home-distinct-times" style="display: none;" class="ui container">
        @include('components.pagination.simple')

        <div class="ui center aligned basic segment">
            <div id="distinct-times-list" class="ui center aligned stackable four column grid">
            </div>
        </div>
    </div>
@endsection

@push('home-scripts')
    <script>
        const formDays = new FormData();

        var homeButtonToggleId = "";

        const settingsDays = {
            "url": "http://127.0.0.1:8000/api/distinctDays",
            "method": "POST",
            "timeout": 0,
            "processData": false,
            "mimeType": "multipart/form-data",
            "contentType": false,
            "data": formDays
        };

        const requestDays = $.ajax(settingsDays);

        // Use $.when to handle the requestDays
        $.when(requestDays).done(function(responseDays) {
            try {
                responseDays = JSON.parse(responseDays);

                // Check if data is fully loaded
                if (responseDays) {
                    // Set the value of the current day
                    $("#current-day").text(responseDays[0].day);
                    getdistinctTimesView(responseDays[0].day);
                }
            } catch (error) {
                console.error("Error parsing responseDays:", error);
            }
        });

        function getdistinctTimesView(day) {
            const formTimes = new FormData();

            formTimes.append("day", day);

            const settingsTimes = {
                "url": "http://127.0.0.1:8000/api/distinctTimesView",
                "method": "POST",
                "timeout": 0,
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": formTimes
            };

            const requestTimes = $.ajax(settingsTimes);

            // Use $.when to handle both requests
            $.when(requestTimes).done(function(responseTimes) {
                try {
                    // console.log(responseTimes)
                    // Check if data is fully loaded, then fade out the loader and fade in distinct times
                    if (responseTimes) {
                        $("#home-loader").fadeOut();
                        $("#home-distinct-times").fadeIn();
                        $("#distinct-times-list").html(responseTimes);

                        $('.homeToggleBookingButton').click((e) => {
                            var id = $(e.currentTarget).attr('id');
                            homeButtonToggleId = id;
                            $('.ui.modal').modal('show');
                        });
                    }
                } catch (error) {
                    console.error("Error parsing responseTimes:", error);
                }
            });
        }

        $("#btn-modal-accept").click((event) => {
            if (!$('#' + homeButtonToggleId).hasClass('active')) {
                $('#' + homeButtonToggleId).html(
                    '<i class="calendar check outline icon"></i> Classroom Reserved. Thank You!'
                ).addClass('active');

                // Get the start and end times from the data attributes
                var startTime = $('#' + homeButtonToggleId).data('start-time');
                var endTime = $('#' + homeButtonToggleId).data('end-time');
                var currentDay = $("#current-day").text();

                // Log the start and end times
                console.log('Current Day: ' + currentDay);
                console.log('Start Time: ' + startTime);
                console.log('End Time: ' + endTime);

            } else {
                $('#' + homeButtonToggleId).html(
                    '<i class="calendar plus outline icon"></i> Book Your Classroom'
                ).removeClass('active');
            }

            $('.ui.modal').modal('hide');
            homeButtonToggleId = "";
        });

        $("#btn-modal-decline").click(function() {
            $('.ui.modal').modal('hide');
            homeButtonToggleId = "";
        });
    </script>

    <script></script>
@endpush
