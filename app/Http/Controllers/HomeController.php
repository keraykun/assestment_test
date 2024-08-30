<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('store');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

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

        return redirect()->back()->with('success', 'User created successfully!');
    }
}
