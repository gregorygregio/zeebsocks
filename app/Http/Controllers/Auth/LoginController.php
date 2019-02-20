<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Entities\SocialUser;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use DB;
use Auth;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public  function redirectToFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public  function handleFacebookCallback(Request $request){
        try {
            $state = $request->get('state');
            $request->session()->put('state',$state);

            if(\Auth::check()==false){
              session()->regenerate();
            }
            $user = Socialite::driver('facebook')->user();

            $create['name'] = $user->getName();
            $create['email'] = $user->getEmail();
            $create['facebook_id'] = $user->getId();

            if($existingUser = SocialUser::getUserIfExists($create['facebook_id'])){
              Auth::loginUsingId($existingUser->id);
              return redirect($this->redirectTo);
            }

            $userModel = new User($create);


            return view('auth.register-with-facebook', [ "user" => $userModel, "social_id" => $create['facebook_id'] ]);


        } catch (Exception $e) {


            return redirect('auth/facebook');


        }
    }

    public function registerFacebookUser(Request $request) {
        try {
          $data = $request->all();

          DB::transaction(function () use($data) {
              $user = new User($data);
              $user->password = hash("sha256", "9dcdea2899ee01c4d3ba9ff86423ff099661632aabdec43574a8206abded4203");
              $user->save();
              SocialUser::create([ "social_id" => $data["social_id"], "user_id" => $user->id ]);
              Auth::loginUsingId($user->id);
          });


        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect("/login")->with([ "error" => "Ocorreu um erro inesperado ao tentar registrar usuário !" ]);
        }
    }
}
