@extends('layouts.layout')

@section('content')
        <div id="app" class="d-flex">
            <app :movies="{{ $movies->toJSON() }}" inline-template>
            </app>
        </div>
@endsection

