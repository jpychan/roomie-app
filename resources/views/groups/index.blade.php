@extends('layouts.app')

@section('content')
<div class="container">

  @if (count($groups)> 0)

    Here are your groups!

    @foreach ($groups as $group)
      <h1> {{$group->name}} </h1>
      <button><a href="{{ url('group/'.$group->id) }}">Edit</a></button>
    @endforeach

  @else
    You are not in a group yet. Add a group now.
  @endif

</div>
@endsection
