@extends('layouts.app')

@section('content')
<div class="container">
  <form class="form-horizontal" role="form" method="POST" action="{{ url('group/'.$group->id) }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
      <label for="name" class="col-md-4 control-label">Group Name</label>

      <div class="col-md-6">
        <input id="name" type="text" class="form-control" name="name" value="{{$group->name}} ">

        @if ($errors->has('name'))
          <span class="help-block">
          <strong>{{ $errors->first('name') }}</strong>
          </span>
        @endif
      </div>

    <div class="form-group">
      <div class="col-md-6 col-md-offset-4">

        <button type="submit" class="btn btn-primary">
          <i class="fa fa-btn fa-sign-in"></i> Submit
        </button>
      </div>
    </div>
      <div>
        <h1>Members</h1>
        <ul>
          @foreach ($group->users as $user)
            <li>
              {{ $user->first_name }} {{ $user->last_name}}
              <button>Remove</button>
            </li>
          @endforeach
        </ul>

        <button>Add a member</button>
      </div>
    </div>
  </div>
</form>
</div>
@endsection