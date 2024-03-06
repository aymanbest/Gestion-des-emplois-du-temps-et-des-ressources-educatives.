@php
    $i = 0;
@endphp

@foreach ($distinctTimes as $row)
    <div class="column">
        <div class="ui cards">
            <div class="card" style="margin-left: auto; margin-right: auto;">
                <div class="content">
                    <div class="header">
                        <i class="clock icon"></i>
                        <span class="card-start-time">{{ $row->start_time }}</span> - <span
                            class="card-end-time">{{ $row->end_time }}</span>
                    </div>
                </div>
                @include('components.buttons.toggle', [
                    'class' => 'homeToggleBookingButton bottom attached',
                    'id' => 'homeToggleBookingButton-' . $i++,
                    'startTime' => $row->start_time,
                    'endTime' => $row->end_time,
                    'text' => '<i class="calendar plus outline icon"></i> Book Your Classroom',
                ])
            </div>
        </div>
    </div>
@endforeach
