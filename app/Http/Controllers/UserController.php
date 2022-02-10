<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('users');
    }

    public function profile($id)
    {
        $user = User::where('id', $id)->firstOrFail();
        return view('profile')->with([
            'user' => $user
        ]);
    }

    public function editProfile(UserEditRequest $request)
    {
        $user = User::where('id', $request->input('id'))->firstOrFail();

        $user->name                 = $request->input('name');
        $user->instagram            = $request->input('instagram');
        $user->date_of_birth        = $request->input('date_of_birth');
        $user->facebook             = $request->input('facebook');
        $user->position             = $request->input('position');
        $user->address              = $request->input('address');
        $user->phone                = $request->input('phone');
        $user->email                = $request->input('email');
        $user->last_place_of_work   = $request->input('last_place_of_work');

        if($request->file('image')) {
            switch ($request->file('image')->getMimeType()) {
                case 'image/png':
                    $type = 'png';
                    break;
                default:
                    $type = 'jpg';
                    break;
            }

            $path = $request->file('image')->storeAs(
                'public/profiles', $request->input('id') . '.' . $type
            );

            $user->image = str_replace('public/', '', $path);

            $test=1;
        }

        $user->save();

        $request->session()->flash('success', trans('Saved'));

        return redirect()->route('user-profile', ['id' => $request->input('id')]);
    }

    public function getList()
    {
        return [
            'users' => User::all()->toArray()
        ];
    }
}
