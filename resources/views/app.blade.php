@extends('layouts.layout')

@section('content')
    <div class="col-xs-12">
        <div id="app">
            <app :movies="{{ $movies->toJSON() }}" inline-template>
            </app>
        </div>
    </div>
@endsection

