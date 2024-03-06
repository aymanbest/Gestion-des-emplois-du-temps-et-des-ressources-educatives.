<div class="three ui buttons">
    <a id="prev-day" data-previous-day="" class="ui button">
        <i class="left chevron icon"></i>
        <span id="previous-day-text">Back</span>
    </a>

    <button id="current-day" class="ui button">2023-07-11</button>

    <a id="next-day" data-next-day="" class="ui button">
        <span id="next-day-text">Forward</span>
        <i class="right chevron icon"></i>
    </a>
</div>

@push('components-script')
    <script>
        let daysArray = null;

        $(document).ready(function() {
            var settings = {
                "url": "{{ route('distinctDays') }}",
                "method": "POST",
            };

            $.ajax(settings).done(function(response) {
                if (response != null) {
                    daysArray = response;
                }
            });
        });

        function nextDay(currentDay) {
            const currentIndex = daysArray.findIndex(dayObj => dayObj.day === currentDay);
            if (currentIndex !== -1 && currentIndex < daysArray.length - 1) {
                return daysArray[currentIndex + 1].day;
            }
            // If currentDay is the last day or not found, return null or handle as needed
            return null;
        }

        function prevDay(currentDay) {
            const currentIndex = daysArray.findIndex(dayObj => dayObj.day === currentDay);
            if (currentIndex !== -1 && currentIndex > 0) {
                return daysArray[currentIndex - 1].day;
            }
            // If currentDay is the first day or not found, return null or handle as needed
            return null;
        }

        $("#current-day").on('click', (e) => {
            console.log(e.currentTarget.innerText);
        });

        $("#next-day").on('click', (e) => {
            const currentDay = $("#current-day").text();
            const nextDayResult = nextDay(currentDay);
            if (nextDayResult != null) {
                $("#current-day").text(nextDayResult)
                $("#prev-day").removeClass("disabled")
                // $('#distinct-times-list').html('');
                getdistinctTimesView(nextDayResult);
            }else if (nextDayResult == null) {
                if (!$("#next-day").hasClass("disabled")) {
                    $("#next-day").addClass("disabled")
                }
            }
        });

        $("#prev-day").on('click', (e) => {
            const currentDay = $("#current-day").text();
            const prevDayResult = prevDay(currentDay);
            if (prevDayResult != null) {
                $("#current-day").text(prevDayResult)
                $("#next-day").removeClass("disabled")
                // $('#distinct-times-list').html('');
                getdistinctTimesView(prevDayResult);
            } else if (prevDayResult == null) {
                if (!$("#prev-day").hasClass("disabled")) {
                    $("#prev-day").addClass("disabled")
                }
            }
        });
    </script>
@endpush
