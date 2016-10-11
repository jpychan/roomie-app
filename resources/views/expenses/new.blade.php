@extends('layouts.app')

@section('content')

<div class="container">
  <h2>New Expense</h2>

  <form id="newExpenseForm" class="form-horizontal" role="form" method="POST" action="{{ url('expenses/create') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
      <input type="hidden" name="group_id" value="{{ $group->id }}">
      <div class="col-md-12">
      <label>Expense Name</label>
        <input id="name" type="text" class="form-control" name="name">
        @if ($errors->has('name'))
          <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
          </span>
        @endif
      </div>
      <div class="col-md-12">
        <label>Total</label>
        <input id="total_cents" type="text" class="form-control" name="total_cents">
        @if ($errors->has('total_cents'))
          <span class="help-block">
            <strong>{{ $errors->first('total_cents') }}</strong>
          </span>
        @endif
      </div>

      <div class="col-md-12">
        <label>Divide Equally in Group?</label>
        <input name="divide" type="checkbox" value="1">
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
          <i class="fa fa-btn fa-sign-in"></i> Submit
        </button>
      </div>
    </div>
  </form>
</div>


@endsection