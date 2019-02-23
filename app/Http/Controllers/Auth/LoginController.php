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
use App\Exceptions\User\DuplicatedEmail;
use App\Exceptions\User\DuplicatedCPF;

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

              if($user->isEmailAlreadyRegistered()) {
                throw new DuplicatedEmail("Este e-mail já foi cadastrado ! ({$user->email})");
              }

              if($user->isCPFAlreadyRegistered()) {
                throw new DuplicatedCPF("Este CPF já foi cadastrado ! ({$user->cpf})");
              }

              $user->password = hash("sha256", rand(11111, 99999) . "9dcdea2899ee01c4d3ba9ff86423ff099661632aabdec43574a8206abded4203" . rand(11111, 99999));
              $user->save();
              SocialUser::create([ "social_id" => $data["social_id"], "user_id" => $user->id ]);
              Auth::loginUsingId($user->id);
          });


          return redirect($this->redirectTo);

        } catch (DuplicatedEmail | DuplicatedCPF $e) {
            return redirect("/login")->with([ "error" => $e->getMessage() ]);
        } catch (\Exception $e) {
            dd($e);
            return redirect("/login")->with([ "error" => "Ocorreu um erro inesperado ao tentar registrar usuário !" ]);
        }
    }
}
