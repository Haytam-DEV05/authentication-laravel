<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class ForgetPasswordController extends Controller
{
    public function ViewforgetPassword()
    {
        return view('auth.forget-password');
    }


    public function forgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $findUser = User::where('email', $request->input('email'))->first();
        // ILA MAKANCHE L USER BDAK L EMAIL LI KTAB LINA DIK SA3A GHADI NRAJ3O L AKHIR MARHALA KAN FIHA
        if (!$findUser) {
            return redirect()->back()->with('error', 'there is no user with this email !');
        }
        // ILA DAK L EMAIL LI 3TANA KHOUNA DIK SA3A GHADI NSIFT LIHA WAHD L CODE FAL EMAIL DYALO 
        // FIH 6 DYAL L AR9AM OU DIK SA3A IDAKHAL DOUK L AR9AM OU WRAHA N9ALAB WAX DOUK L AR9AM BHAL BHALLE
        // return
        $code = rand(100000, 999999);
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email], // Chrt l-ba7t (ila kayn had l-email, bdl lih gha l-code)
            [
                'token' => $code,
                'created_at' => now()
            ]
        );
        Mail::to($request->email)->send(new ForgetPasswordMail($code));
        return redirect()->route('users.view-verify-code', ['email' => $request->email])
            ->with('success', 'le code a ete envoye a votre  adresse email !');
    }


    public function viewVerifyCode($email)
    {
        return view('auth.verify-code', compact('email'));
    }


    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|numeric'
        ]);
        $resetData = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->code)
            ->first();

        if (!$resetData) {
            return redirect()->back()->with('error', 'Le code est incorrect !');
        }
        return redirect()->route('users.view-rest-password', ['email' => $request->email])
            ->with('success', 'Code vérifié avec succès. Entrez votre nouveau mot de passe.');
    }

    public function viewResetPassword($email)
    {
        $hasToken = DB::table('password_reset_tokens')->where('email', $email)->exists();
        if (!$hasToken) {
            return redirect()->route('users.view-forget-password')->with('error', 'Session expirée ou invalide.');
        }
        return view('auth.reset-password', ['email' => $email]);
    }


    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->route('users.view-forget-password')
                ->with('error', 'Utilisateur introuvable.');
        }
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        return redirect()->route('users.login')
            ->with('success', 'Mot De pass updated successfuly !');
    }
}
