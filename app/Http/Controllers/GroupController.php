<?php

namespace App\Http\Controllers;

use App\User;
use App\Group;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Repositories\GroupRepository;


class GroupController extends Controller
{

  public function __construct(GroupRepository $groups)
  {
    $this->middleware('auth');
    $this->groups = $groups;
  }

  /**
   * Display a list of all of the user's groups.
   *
   * @param  Request  $request
   * @return Response
   */
  public function index(Request $request)
  {
      return view('groups.index', [
          'groups' => $this->groups->forUser($request->user()),
      ]);
  }

  /**
   * Create a new group.
   *
   * @param  Request  $request
   * @return Response
   */
  public function create(Request $request)
  {
      $this->validate($request, [
          'name' => 'required|max:255',
      ]);

      $group = $request->user()->groups()->create([
          'name'    => $request->name,
          'user_id' => $request->user->id,
      ]);

      return redirect('/groups.index');
  }

  /**
   * Edit the given group.
   *
   * @param  Request  $request
   * @param  Group  $group
   * @return Response
   */
  public function edit(Request $request, Group $group)
  {
      $this->validate($request, [
          'name' => 'required|max:255',
      ]);

      $group->update([
        'name' => $request->name,
      ]);

      return redirect('/groups.index');
  }

  public function show(Request $request, Group $group)
  {

    $this->authorize('show', $group);

    $user_id = $request->user()->id;

    $group_expenses = $group->expenses->sortByDesc('created_at')->take(5);

    $debts = $request->user()->debts;

    $debts = $debts->where('paid', 0);

    $loans = $request->user()->loans;

    $loans = $loans->load(['fractions' => function ($query) use ($user_id) {
      $query->where('borrower_id', '!=', $user_id);
    }]);

    return view('groups.show', [
      'group'           => $group,
      'users'           => $group->users,
      'group_expenses'  => $group_expenses,
      'debts'           => $debts,
      'loans'           => $loans,
    ]);
  }

  /**
   * Destroy the given group.
   *
   * @param  Request  $request
   * @param  Group  $group
   * @return Response
   */
  public function destroy(Request $request, Group $group)
  {
    $this->authorize('destroy', $group);
    $group->delete();

    return redirect('/groups.index');
  }

  public function removeMember(Request $request, Group $group)
  {

    $this->authorize('manageMembers', $group);
    $group->users()->detach($request->user_id);

    return response()->json($request);
  }

  public function addMember(Request $request, Group $group)
  {
    $this->authorize('manageMembers', $group);
    $user = User::where('email', $request->email)->get()->first();
    $group->users()->attach($user->id);

    return redirect()->action('GroupController@show', ['id' => $group->id]);
  }



    // $this->authorize('removeMember', $group);
  //   $group->user()->detach($request->user_id);
  //   return response()->setStatusCode(200, 'The member was deleted!');
  // }

//   Route::delete('/tasks/{task_id?}',function($task_id){
//     $task = Task::destroy($task_id);

//     return Response::json($task);
// });
}
