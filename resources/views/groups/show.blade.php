@extends('layouts.app')

@section('content')
<div class="container">
  <form class="form-horizontal" role="form" method="POST" action="{{ url('/group/$group->id/edit') }}">
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
    </div>

  </form>


</div>
@endsection