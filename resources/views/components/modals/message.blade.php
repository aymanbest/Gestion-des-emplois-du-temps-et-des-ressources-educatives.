<div class="ui mini modal">
    <div class="ui top attached {{ $type }} icon message">
        <i class="{{ $icon }} icon"></i>
        <div class="content">
            {{ $header }}
        </div>
    </div>
    <div class="ui bottom attached segment">
        <div class="ui justified container">
            {{ $content }}
        </div>
        <div class="ui divider"></div>
        <div class="ui center aligned container">
            <div class="ui buttons">
                <button class="ui labeled icon button red" id="btn-modal-decline">
                    <i class="thumbs down icon"></i>
                    Decline
                </button>
                <div class="or"></div>
                <button class="ui right labeled icon button teal" id="btn-modal-accept">
                    <i class="thumbs up icon"></i>
                    Accept
                </button>
            </div>
        </div>
    </div>
</div>
