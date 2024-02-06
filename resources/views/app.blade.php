@extends('layouts.layout')

@section('content')
        <div id="app">
            <app :movies="{{ $movies->toJSON() }}"
                 :logout="{{ json_encode(route('logout')) }}"
                 :login="{{ json_encode(route('login')) }}"
                 :register="{{ json_encode(route('register')) }}"
                 :user="{{ auth()->user() }}"
                 csrf="{{ csrf_token() }}"
                 inline-template>
            </app>
        </div>
@endsection

