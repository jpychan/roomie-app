<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use App\Http\Requests;
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

      $request->user()->groups()->create([
          'name' => $request->name,
      ]);

      return redirect('/groups');
  }

  public function edit(Request $request)
  {
      $this->validate($request, [
          'name' => 'required|max:255',
      ]);

      $request->user()->groups()->create([
          'name' => $request->name,
      ]);

      return redirect('/groups');
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

    return redirect('/groups');
  }

}
