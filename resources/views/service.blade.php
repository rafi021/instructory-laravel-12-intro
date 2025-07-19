@extends('welcome')
@section('main-content')
    <h1>Service Page</h1>
    @if ($isServices)
        @for ($index = 0; $index < count($services); $index++)
            <li class="ps-3">{{ $services[$index] }}</li>
        @endfor
    @else
        <li class="ps-3">No Services</li>
    @endif
@endsection
