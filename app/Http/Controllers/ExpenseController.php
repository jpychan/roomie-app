<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Group;
use App\Expense;
use App\expenseFraction;
use App\Http\Controllers\Controller;
use App\Repositories\ExpenseRepository;

class ExpenseController extends Controller
{

  public function __construct(ExpenseRepository $expenses)
  {
    $this->middleware('auth');
    $this->expenses = $expenses;
  }

  /**
   * Create a new expense.
   *
   * @param  Request  $request
   * @return Response
   */
  public function create(Request $request)
  {
    $this->validate($request, [
        'expenseName'   => 'required|max:255',
        'totalCents'    => 'required|integer',
        'groupId'      => 'required|integer'
    ]);

    $user_id = $request->user()->id;
    $expense = new Expense();

    $expense->name = $request->expenseName;
    $total_cents = (int)$request->totalCents * 100;
    $expense->total_cents = $total_cents;
    $expense->lender_id = $user_id;
    $expense->creator_id = $user_id;
    $expense->group_id = $request->groupId;

    $expense->save();

    $group = Group::find($request->groupId);
    $users = $group->users;

    if ($request->divide == 1) {
      $fraction = $total_cents / count($users);

      foreach ($users as $user) {
        $this->createExpenseFraction($expense->id, $user->id, $fraction, false);
      }
    }
    else {
      for ($i = 0; $i < count($request->userId); $i++ ) {
        $fraction_cents = (int)$request->fractionCents[$i] * 100;
        $this->createExpenseFraction($expense->id, $request->userId[$i], $fraction_cents, $request->paid[$i]);
      }
    }
    return redirect()->route('group', ['id' => $group->id]);
  }

  public function new(Group $group) {

    $users = $group->users;

    return view('expenses.new', [
      'group'     => $group,
      'users'     => $users
      ]);
  }

  private function createExpenseFraction($expense_id, $user_id, $fraction, $paid) {
    $expenseFraction = new expenseFraction();

    $expenseFraction->create([
        'expense_id'        => $expense_id,
        'borrower_id'       => $user_id,
        'amount_owed_cents' => $fraction,
        'paid'              => $paid,
        ]);

    return $expenseFraction;
  }
}
