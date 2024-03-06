@extends('layouts.app')

@section('content')

<div class="ui container">
    <div class="three ui buttons">
        <button class="ui button">
            <i class="left chevron icon"></i>
            Back
        </button>
        <button class="ui button">Lundi</button>
        <button class="ui button">
            Forward
            <i class="right chevron icon"></i>
        </button>
    </div>

    <div class="ui segment">
        <div class="ui relaxed divided list">
            <div class="item">
                <div class="content">
                    <div class="header">Snickerdoodle</div>
                    An excellent companion
                </div>
            </div>
            <div class="item">
                <div class="content">
                    <div class="header">Poodle</div>
                    A poodle, its pretty basic
                </div>
            </div>
            <div class="item">
                <div class="content">
                    <div class="header">Paulo</div>
                    He's also a dog
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
