@extends('layouts.default')

@section('content')

    <h1>Record</h1>

    <p>Record a sound clip</p>

    <body>
        <button wire:click="record">+</button>
        <script src="main.js"></script>
    </body>

@stop
