<?php

namespace App\Http\Controllers;


use App\Models\VirtualDomain;
use App\Models\VirtualAlias;
use App\Models\VirtualUser;

use Illuminate\Http\Request;

class EmailController extends Controller {
    private $domain_id;

    public function __construct() {
        $this->domain_id = 1;
    }

    public function index() {
        return view('email/index', ['title' => 'EMAIL']);
    }

    public function registerForm() {
        return view('email/register', ['title' => 'EMAIL REGISTER']);
    }

    public function passwordForm() {
        return view('email/password', ['title' => 'EMAIL PASSWORD']);
    }

    public function unregisterForm() {
        return view('email/unregister', ['title' => 'EMAIL UNREGISTER']);
    }

    public function register(Request $request) {
        $name = Request()->name;
        $domain = VirtualDomain::where('id', $this->domain_id)->first()->name;
        $email = $name.'@'.$domain;

        $request->validate([
            'name'      => ['required', 'string', 'max:20'],
            'password'  => ['required', 'confirmed', 'string', 'min:10', 'max:100'],
            'captcha'   => ['required', 'captcha']
        ]);

        if (VirtualUser::where('email', $email)->count() > 0) {
            return redirect()->back()->withErrors(['name' => 'User already exist']);
        }
        $password = $request->password;

        VirtualUser::create([
            'domain_id' => $this->domain_id,
            'email'     => $email,
            'password'  => hash('sha512', $password)
        ])->save();

        VirtualAlias::create([
            'domain_id'     => $this->domain_id,
            'source'        => $email,
            'destination'   => $email
        ])->save();

        return redirect()->route('emailIndex');
    }

    public function password(Request $request) {
        $name = Request()->name;
        $domain = VirtualDomain::where('id', $this->domain_id)->first()->name;
        $email = $name.'@'.$domain;

        $request->validate([
            'name'          => ['required', 'string', 'max:20'],
            'oldpassword'   => ['required', 'string', 'min:10', 'max:100'],
            'newpassword'   => ['required', 'string', 'min:10', 'max:100'],
            'captcha'       => ['required', 'captcha']
        ]);

        if (VirtualUser::where('email', $email)->count() < 1) {
            return redirect()->back()->withErrors(['name' => 'User not exist']);
        }

        $oldpassword = $request->oldpassword;
        $newpassword = $request->newpassword;
        if ($oldpassword == $newpassword) {
            return redirect()->back()->withErrors(['newpassword' => 'Passwords must not match']);
        }

        $user = VirtualUser::where('email', $email)->first();

        $password = hash('sha512', $oldpassword);

        if ($password == $user->password) {
            $user->password = hash('sha512', $newpassword);
            $user->save();

            return redirect()->route('emailIndex');
        } else {
            return redirect()->back()->withErrors(['password' => 'Invalid password']);
        }
    }

    public function unregister(Request $request) {
        $name = Request()->name;
        $domain = VirtualDomain::where('id', $this->domain_id)->first()->name;
        $email = $name.'@'.$domain;

        $request->validate([
            'name'      => ['required', 'string', 'max:20'],
            'password'  => ['required', 'string', 'min:10', 'max:100'],
            'captcha'   => ['required', 'captcha']
        ]);

        if (VirtualUser::where('email', $email)->count() < 1) {
            return redirect()->back()->withErrors(['name' => 'User not exist']);
        }
        $virtualUser = VirtualUser::where('email', $email)->first();

        if (VirtualUser::where('email', $email)->count() < 1) {
            return redirect()->back()->withErrors(['name' => 'User not exist']);
        }
        $virtualAlias = VirtualAlias::where('source', $email)->first();

        $password = hash('sha512', $request->password);

        if ($password == $virtualUser->password) {
            $virtualUser->delete();
            $virtualAlias->delete();

            return redirect()->route('emailIndex');
        } else {
            return redirect()->back()->withErrors(['password' => 'Invalid password']);
        }
    }
}
