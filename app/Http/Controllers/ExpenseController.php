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
        'name'        => 'required|max:255',
        'total_cents' => 'required|integer',
        'divide'      => 'required|boolean',
        'group_id'    => 'required|integer'
    ]);

    $user_id = $request->user()->id;
    $expense = new Expense();

    $expense->name = $request->name;
    $expense->total_cents = $request->total_cents;
    $expense->lender_id = $user_id;
    $expense->creator_id = $user_id;
    $expense->group_id = $request->group_id;

    $expense->save();

    $group = Group::find($request->group_id);

    $users = $group->users;
    $fraction = (int)($request->total_cents) / count($users);

    foreach ($users as $user) {
      $this->createExpenseFraction($expense->id, $user->id, $fraction, $user_id);
    }

    return redirect()->route('group', ['id' => $group->id]);
  }

  public function new(Group $group) {
    return view('expenses.new', [
      'group'     => $group
      ]);
  }

  private function createExpenseFraction($expense_id, $user_id, $fraction) {
    $expenseFraction = new expenseFraction;

    $expenseFraction->create([
        'expense_id'        => $expense_id,
        'borrower_id'       => $user_id,
        'amount_owed_cents' => $fraction,
        ]);

    return $expenseFraction;
  }

  // For a route with the following URI: profile/{id}




}
