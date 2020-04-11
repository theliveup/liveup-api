<?php
/**
 * Created by PhpStorm.
 * User: ayobami
 * Date: 4/11/2020
 * Time: 1:13 PM
 */

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupsController extends Controller
{

    public function getAll(Request $request)
    {
        return $request->user()->groups()->get();
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:2|max:255|unique:groups,user_id',
            'description' => 'required|min:2',
        ]);
        $user = $request->user();
        return $this->createNewGroup($user, $validated);
    }

    protected function createNewGroup(User $user, array $record)
    {
        $group = Group::create(['user_id'=>$user->id, 'description'=>$record->description, 'name'=>$record->name]);
        return $user->groups()->attach($group->id);
    }

}
