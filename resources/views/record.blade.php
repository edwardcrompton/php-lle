@extends('layouts.default')

@section('content')

    <h1>Record</h1>

    <p>Record a sound clip</p>

    <div x-data="">
        <button x-on:click="console.log('test')">Record</button>
    </div>

@stop
