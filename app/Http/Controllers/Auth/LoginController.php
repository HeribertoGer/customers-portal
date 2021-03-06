<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Google\Service\Docs\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;
use JBtje\VtigerLaravel\Vtiger;

use Illuminate\Support\Facades\Auth;

use App\Models\User;



class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {
        $parameters = ['access_type' => 'offline'];
        return Socialite::driver('google')->scopes(["https://www.googleapis.com/auth/drive"])->with($parameters)->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
  /*   public function handleProviderCallback()
    {
        $userLogin = Socialite::driver('google')->stateless()->user();

        //dd($userLogin);
        $user = User::updateOrCreate(
            [
                //'email' => $userLogin->email
                'user_name' => $userLogin->user_name,
                //'alternative_username' => $userLogin->alternative_username
            ],

            [
                'refresh_token' => $userLogin->token,
                'name' => $userLogin->name
            ]
        );

       /*  $vtiger = new Vtiger();
        //Get contact data of this user

        //vars
        $userQuery = DB::table('Contacts')->select('id')->where("contact_no", $user->vtiger_contact_id)->take(1);
        $contact = $vtiger->search($userQuery);

        if (count($contact->result) === 0) {
            Auth::logout();
           // return ["Contact not found", 404];
        } else {
            Auth::login($user, true);
            return redirect()->to('/');
        } * /
    } * /

    /*   public function logout(Request $request)
    {
        session('g_token', '');
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    } */
}
