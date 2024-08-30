<?php

namespace App\Http\Controllers\Mrs;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('mrs.index')->with(compact('users'));
    }

    public function removed()
    {
        return 'here';
        $users = User::all();
        return view('mrs.removed')->with(compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mrs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'type' => 'required|string|max:255',
            'prefixname' => 'required|string|in:Mr,Mrs,Ms',
            'firstname' => 'required|string|max:255',
            'middlename' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'suffixname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('picture')) {
            $filePath = $request->file('picture')->store('images', 'public');
        }

        User::create([
            'username'=>$request->username,
            'prefixname' => $request->prefixname,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'suffixname' => $request->suffixname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $filePath,
        ]);

        return redirect()->route('mrs.users.index')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = User::find($user)->first();
        return view('mrs.edit')->with(compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $request->validate([
            'prefixname' => 'required|string|in:Mr,Mrs,Ms',
            'firstname' => 'required|string|max:255',
            'middlename' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'suffixname' => 'required|string|max:255',
        ]);

        $filePath = $user->photo;

        if ($request->hasFile('picture')) {
            if ($user->photo && Storage::exists('public/' . $user->photo)) {
                Storage::delete('public/' . $user->photo);
            }
            $filePath = $request->file('picture')->store('images', 'public');
        }

        User::where('id',$user->id)->update([
            'prefixname' => $request->prefixname,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'type' => $request->type,
            'suffixname' => $request->suffixname,
            'photo' => $filePath,
        ]);

        if($user->prefixname===$request->prefixname){
            return redirect()->back()->with('success', 'User has been updated successfully!');
        }
        switch ($request->prefixname) {
            case 'Mrs':
                return redirect()->route('mrs.users.index')->with('success', 'User has been updated successfully!');
                break;
            case 'Mr':
                return redirect()->route('mr.users.index')->with('success', 'User has been updated successfully!');
                break;
            case 'Ms':
                return redirect()->route('ms.users.index')->with('success', 'User has been updated successfully!');
                break;
            default:
                abort(404);
                break;
        }

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Auth()->id()===$user->id){
            return redirect()->back()->with('danger', 'You can\'t remove a user who is logged in');
        }
        $user->destroy($user->id);
        return redirect()->back()->with('danger', 'User has been deleted successfully!');
    }
}
