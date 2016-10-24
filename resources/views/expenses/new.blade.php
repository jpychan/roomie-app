@extends('layouts.app')

@section('content')

<div class="container">
  <h2>New Expense</h2>

  <form id="newExpenseForm" class="form-horizontal" role="form" method="POST" action="{{ url('expenses/create') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
      <input type="hidden" name="groupId" value="{{ $group->id }}">
      <label class="control-label col-md-2" for="expenseName">Expense Name</label>
      <div class="col-md-10">
          <input type="text" class="form-control" id="expenseName" name="expenseName" placeholder="Expense Name">
      </div>
      @if ($errors->has('name'))
        <span class="help-block">
          <strong>{{ $errors->first('name') }}</strong>
        </span>
      @endif
    </div>

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
      <label class="control-label col-md-2" for="totalCents">Total</label>
      <div class="col-md-10">
        <input id="totalCents" type="number" class="form-control" name="totalCents" placeholder="Amount">
      </div>
      @if ($errors->has('total_cents'))
        <span class="help-block">
          <strong>{{ $errors->first('total_cents') }}</strong>
        </span>
      @endif
    </div>

    <div class="form-group">
      <label class="control-label col-md-2" for="divideCheckbox">Divide Equally in Group?</label>
      <div class="col-md-10">
        <input id="divideCheckbox" name="divide" type="checkbox" value="1" checked>
      </div>
    </div>

    <div class="form-group" id="expenseBreakdown">
      <label class="control-label col-md-2">Expense Breakdown</label>
      <div class="col-md-10">
        @foreach ($users as $user)
          <div class="row">
            <div class="col-md-4">
              <p>{{ $user->first_name }} {{ $user->last_name}}</p>
              <input type="hidden" name="userId[]" value="{{ $user->id }}">
            </div>
            <div class="col-md-4">
              <input type="number" class="form-control" name="fractionCents[]">
            </div>
            <div class="col-md-4">
              <button class="btn btn-danger groupMemberRemoveBtn">
                <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i>
              </button>
            </div>
          </div>
        @endforeach
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-6">
        <button type="submit" class="btn btn-primary">
          <i class="fa fa-btn fa-sign-in"></i> Submit
        </button>
      </div>
    </div>
  </form>
</div>


@endsection