<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use App\Models\Profile;
use App\Models\User;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CustomAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //afficher le formulaire pour ajouter un étudiant
        $villes = Ville::all(); //récupérer toutes les villes de la DB
        return view('auth.create', [
            'villes' => $villes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //If validation fails, laravel will redirect you back to the form page
        $attributes = $request->validate([
            'prenom' => 'required',
            'nom' => 'required',
            'date_de_naissance' => 'required',
            'phone' => 'required',
            'adresse' => 'required',
            'villeId' => 'required',
            'image' => 'required',
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => 'required|min:6|max:20'
        ]);

        // Create a profile
        $user = new User;
        $user->name = $request->input('prenom');
        $user->email = $request->input('email');
        $user->email_verified_at = now();
        $user->password = Hash::make($request->password);
        $user->save();
        $profile = $user->profile()->create([
            'prenom' => $request->input('prenom'),
            'nom' => $request->input('nom'),
            'adresse' => $request->input('adresse'),
            'phone'=> $request->input('phone'),
            'email'=>$request->input('email'),
            'image'=>$request->input('image'),
            'date_de_naissance'=>$request->input('date_de_naissance'),
            'villeId' => $request->input('villeId'),
            'type_id' => Profile::$Etudiant,
            'user_id' => $user->id
        ]);

        $to_name = $request->name;
        $to_email = $request->email;
        $body="<a href='https://e0859973.webdev.cmaisonneuve.qc.ca/login'>".$to_name."! Cliquez ici pour confirmer</a>";

        Mail::send('email.mail', $data = [
            'name' => $to_name,
            'body' => $body
        ],
        function($message) use ($to_name, $to_email){
            $message->to($to_email, $to_name)->subject('Projet Laravel Pedro');
        }
        );

        return redirect()->back()->withSuccess(trans('lang.msg_1'));

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function authentication(Request $request){
        $request->validate([
            'email'=> 'required|email|exists:users',
            'password' => 'required|min:6|max:20'
        ]);

        $credentials = $request->only('email', 'password');

        if(!Auth::validate($credentials)):
            return redirect(route('login'))
                      ->withErrors(trans('auth.failed'))
                      ->withInput();
         endif;

         $user = Auth::getProvider()->retrieveByCredentials($credentials);

         Auth::login($user, $request->get('remember'));

         return redirect()->intended('dashboard')->withSuccess('Signed in');
    }

    public function dashboard(){


        if(Auth::check()){
            $forums = ForumPost::all();
            return view('forum.index', ['forums'=>$forums]);
        }
        return redirect(route('login'))->withErrors('Vous n\'êtes pas autorisé à accéder');
    }

    public function logout(){
        Session::flush();
        Auth::logout();

        return redirect(route('login'));
    }

    public function forgotPassword(){
        return view('auth.forgot-password');
    }

    public function tempPassword(Request $request){
        $request->validate([
            'email'=> 'required|email|exists:users',
        ]);

        $user = User::where('email', $request->email)->get();
        $user = $user[0];
        $tempPass = str::random(25);
        $user->temp_password = $tempPass;
        $user->save();
        $userId = $user->id;

        $link = "<a href='http://localhost:8000/new-password/".$userId."/".$tempPass."'>Cliquez ici pour réinitialiser votre mot de passe</a>";

        //http://localhost:8000/new-password/23/ORar0RQHfrzkoqWFSLSyXedrt
        //return $link;

        $to_email = $user->email;
        $to_name = $user->name;

        Mail::send('email.mail', $data = [
            'name' => $to_name,
            'body' => $link
        ],
        function($message) use ($to_name, $to_email){
            $message->to($to_email, $to_name)->subject('Reset Password');
        }
        );
        return redirect()->back()->withSuccess('Check your email to change your password');







    }
    public function newPassword(User $user, $tempPassword){
        if ($user->temp_password === $tempPassword) {
            return view ('auth.new-password');
        }
        return redirect('forgot-password')->withErrors('Les identifiants ne correspondent pas');
    }

    public function storeNewPassword(User $user, $tempPassword, Request $request){
        if ($user->temp_password === $tempPassword) {
            $request->validate([
                'password' => 'required|min:6|confirmed'
            ]);

            $user->temp_password = null;
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect(route('login'))->withSuccess(trans('lang.msg_success'));
            //return redirect(route('login'))->withSuccess('mot de passe reinitialisé');

        }
        return redirect('forgot-password')->withErrors('Les identifiants ne correspondent pas');
    }

}
