@extends('web.components.layout')

@section('title', $pageTitle)

@section('main')
    <h1 class="mt-5">ηΈιζθ½</h1>
    <ul>
        @foreach ($envAry as $tech)
            <li>{{$loop->index + 1}}. {{$tech}}
            @if ($loop->first)
                    (first)
            @elseif ($loop->last)
                    (last)
            @endif
            </li>
        @endforeach
    </ul>
@endsection
