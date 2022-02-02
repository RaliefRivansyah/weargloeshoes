<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SentToEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class SentToMailController extends Controller
{
    public function index($id, Request $request)
    {
        DB::table('users')
            ->where('id', $id)
            ->update(
                ['status' => '1']
            );

        $request->session()->flash('register', 'Account Verified. You can login now!');
        return redirect('/login-register');
    }
}
