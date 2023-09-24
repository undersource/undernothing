<?php

namespace App\Http\Controllers;


use App\Models\VirtualDomain;

use Illuminate\Http\Request;

class XMPPController extends Controller {
    private $domain_id;

    public function __construct() {
        $this->domain_id = 1;
    }

    public function index() {
        return view('xmpp/index', ['title' => 'XMPP']);
    }

    public function registerForm() {
        return view('xmpp/register', ['title' => 'XMPP REGISTER']);
    }

    public function passwordForm() {
        return view('xmpp/password', ['title' => 'XMPP PASSWORD']);
    }

    public function unregisterForm() {
        return view('xmpp/unregister', ['title' => 'XMPP UNREGISTER']);
    }

    public function register(Request $request) {
        $name = $request->name;
        $password = $request->password;
        $domain = VirtualDomain::where('id', $this->domain_id)->first()->name;

        $request->validate([
            'name'      => ['required', 'string', 'max:20'],
            'password'  => ['required', 'confirmed', 'string', 'min:10', 'max:100'],
            'captcha'   => ['required', 'captcha']
        ]);

        system('ejabberdctl check_account '.$name.' '.$domain, $result);
        if ($result == 0) {
            return redirect()->back()->withErrors(['name' => 'User already exist']);
        }

        system('ejabberdctl register '.$name.' '.$domain.' '.$password, $result);
        dd($result);
        if ($result != 0) {
            return redirect()->back()->withErrors(['name' => 'Server error. Try in next time']);
        }

        return redirect()->route('xmppIndex');
    }

    public function password(Request $request) {
        $name = Request()->name;
        $domain = VirtualDomain::where('id', $this->domain_id)->first()->name;

        $request->validate([
            'name'          => ['required', 'string', 'max:20'],
            'oldpassword'   => ['required', 'string', 'min:10', 'max:100'],
            'newpassword'   => ['required', 'string', 'min:10', 'max:100'],
            'captcha'       => ['required', 'captcha']
        ]);

        system('ejabberdctl check_account '.$name.' '.$domain, $result);
        if ($result != 0) {
            return redirect()->back()->withErrors(['name' => 'User not exist']);
        }

        $oldpassword = $request->oldpassword;
        $newpassword = $request->newpassword;
        if ($oldpassword == $newpassword) {
            return redirect()->back()->withErrors(['newpassword' => 'Passwords must not match']);
        }

        system('ejabberdctl check_password '.$name.' '.$domain.' '.$oldpassword, $result);
        if ($result != 0) {
            return redirect()->back()->withErrors(['name' => 'Invalid password']);
        }

        system('ejabberdctl change_password '.$name.' '.$domain.' '.$newpassword, $result);
        if ($result != 0) {
            return redirect()->back()->withErrors(['name' => 'Server error. Try next time']);
        }

        return redirect()->route('xmppIndex');
    }

    public function unregister(Request $request) {
        $name = Request()->name;
        $domain = VirtualDomain::where('id', $this->domain_id)->first()->name;

        $request->validate([
            'name'      => ['required', 'string', 'max:20'],
            'password'  => ['required', 'string', 'min:10', 'max:100'],
            'captcha'   => ['required', 'captcha']
        ]);

        system('ejabberdctl check_account '.$name.' '.$domain, $result);
        if ($result != 0) {
            return redirect()->back()->withErrors(['name' => 'User not exist']);
        }

        system('ejabberdctl check_password '.$name.' '.$domain.' '.$request->password, $result);
        if ($result != 0) {
            return redirect()->back()->withErrors(['name' => 'Invalid password']);
        }

        system('ejabberdctl unregister '.$name.' '.$domain, $result);
        if ($result != 0) {
            return redirect()->back()->withErrors(['name' => 'Server error. Try next time']);
        }

        return redirect()->route('xmppIndex');
    }
}
