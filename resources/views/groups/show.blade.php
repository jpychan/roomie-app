@extends('layouts.app')

@section('content')
<div class="container">

  <h1>{{$group->name}}</h1>
  <p>Edit</p>

  <form id='groupNameEdit' class="form-horizontal" role="form" method="POST" action="{{ url('group/'.$group->id) }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
      <div class="col-md-6">
        <input id="name" type="text" class="form-control" name="name" value="{{$group->name}} ">

        @if ($errors->has('name'))
          <span class="help-block">
          <strong>{{ $errors->first('name') }}</strong>
          </span>
        @endif
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
  <div>
    <h2>Members</h2>
    <ul>
      @foreach ($users as $user)
        <li>
          {{ $user->first_name }} {{ $user->last_name}}
          <button>Remove</button>
        </li>
      @endforeach
    </ul>

    <button>Add a member</button>
  </div>
  <div>
    <h2>Expenses</h2>
    <ul>
      @foreach ($group_expenses as $expense)
        <li>
          {{ $expense->name }} $ {{number_format($expense->total_cents / 100, 2, '.', '')}}
          <button>Remove</button>
        </li>
      @endforeach
    </ul>

    <button>Add an expense</button>
  </div>

  <div>
    <h2>Debts</h2>
    <ul>
      @foreach ($debts as $debt)
        <li>
          {{ $debt->expense->name }} owe ${{number_format($debt->amount_owed_cents / 100, 2, '.', '')}} to {{ $debt->expense->lender->first_name }} {{ $debt->expense->lender->last_name }}
        </li>
      @endforeach
    </ul>

    <button>Pay Debts</button>
  </div>

    <div>
    <h2>Loans</h2>
    <ul>
      @foreach ($loans as $loan)
        <li>
          {{ $loan->expense->name }} owe ${{number_format($loan->amount_owed_cents / 100, 2, '.', '')}} to {{ $loan->expense->borrower->first_name }} {{ $loan->expense->borrower->last_name }}
        </li>
      @endforeach
    </ul>

    <button>Pay Debts</button>
  </div>
</div>
@endsection