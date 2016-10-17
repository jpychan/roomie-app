@extends('layouts.app')

@section('content')
<div class="container">

  <div class="col-md-8" id="groupName">
    <h1>{{$group->name}}</h1>
    <button
      id="manageGroupBtn"
      class="btn btn-primary btn-xs"
      data-toggle="modal"
      data-target="#groupEditModal">
      Manage
    </button>
  </div>

  <div class="modal fade" id="groupEditModal"
     tabindex="-1" role="dialog"
     aria-labelledby="groupEditModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close"
            data-dismiss="modal"
            aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"
          id="groupEditModalLabel">Edit {{ $group->name }}</h4>
        </div>
        <div class="modal-body">
          <div>
            <input id='groupId' type='hidden' value='{{ $group->id }}'>
            <meta name="_token" content="{{ csrf_token() }}" />
            @foreach ($users as $user)
              <div id="user{{ $user->id }}" class="row">
                <div class="col-md-6">
                  <p>
                    {{ $user->first_name }} {{ $user->last_name}}
                  </p>
                </div>

                @can('manageMembers', $group)
                  <div class="col-md-6">
                      <button class="btn btn-danger groupMemberRemove" value='{{ $user->id }}'>
                        <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i>
                      </button>
                  </div>
                @endcan
              </div>
              @endforeach
              @can('manageMembers', $group)
                <div class="row">
                  <div class="col-md-12">
                    <form id='groupMemberAdd' class="form-inline" role="form" method="POST" action="{{ url('group/' . $group->id . '/addMember') }}">
                      <div class="form-group">
                        {{ csrf_field() }}
                        <label for="userEmailInput">Add user to group</label>
                        <input type="email" class="form-control" id="userEmailInput" name="email" placeholder="User Email">
                      </div>
                      <button type="submit" class="btn btn-primary">Add Member</button>
                    </form>
                  </div>
                </div>
              @endcan
          </div>
        </div>
        <div class="modal-footer">
          <button type="button"
             class="btn btn-default"
             data-dismiss="modal">Close</button>
          </span>
        </div>
      </div>
    </div>
  </div>

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
  <div class="col-md-4">
    <h2>Members</h2>
    <ul>
      @foreach ($users as $user)
        <li>
          {{ $user->first_name }} {{ $user->last_name}}
        </li>
      @endforeach
    </ul>
  </div>

  <div>
    <h2>Group Expenses</h2>
    <ul>
      @foreach ($group_expenses as $expense)
        <li>
          {{ $expense->name }} $ {{number_format($expense->total_cents / 100, 2, '.', '')}}
        </li>
      @endforeach
    </ul>

    <a class="btn btn-primary" href="{{ route('newExpense', ['id' => $group->id]) }}">Add an expense</a>
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
    <div>
      @foreach ($loans as $loan)
        <h3>
          {{ $loan->name }}: ${{number_format($loan->total_cents / 100, 2, '.', '')}}
        </h3>
        <ul>
          @foreach ($loan->fractions as $fraction)
            <li>{{ $users->find($fraction->borrower_id)->first_name }}: ${{ number_format($fraction->amount_owed_cents / 100, 2, '.', '') }}</li>
          @endforeach
        </ul>
      @endforeach
    </div>
  </div>
</div>
@endsection