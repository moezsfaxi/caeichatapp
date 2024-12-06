@extends('layouts.app')


@section('content')

<h1> LIST of the users</h1>

<ol>
@foreach($users as $user )
<li><a href="{{route('sending' , ['receiverId' => $user->id ])}}">{{$user->name }}</a> </li>


@endforeach

</ol>



@endsection