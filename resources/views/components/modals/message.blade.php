
<div class="ui basic modal">
    <div class="ui icon header">
        <i class="archive icon"></i>
        {{ $title }}
    </div>
    <div class="content">
        <p>{{ $content }}</p>
    </div>
    <div class="actions">
        <div class="ui blue basic cancel inverted button">
            <i class="archive icon"></i>
            {{ $allGroupsText }}
        </div>
        <div id="selectedGroupButton" class="ui green ok inverted button">
            <i class="checkmark icon"></i>
            {{ $selectedGroupText }}
        </div>
    </div>
</div>