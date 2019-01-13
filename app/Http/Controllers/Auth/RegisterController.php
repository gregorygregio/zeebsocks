<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        //https://github.com/geekcom/validator-docs
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'cpf' => 'required|string|max:15|cpf|unique:users',
            'password' => 'required|string|min:6|max:255|confirmed',
        ], [
            //messages
            "cpf.unique" => "Este CPF já foi cadastrado",
            "cpf.required" => "É necessário informar um CPF",
            "cpf.max" => "O valor digitado no campo CPF é muito grande",
            "cpf.cpf" => "CPF inválido",

            "name.required" => "É necessário informar um NOME",
            "name.max" => "O valor digitado no campo NOME é muito grande",

            "email.required" => "É necessário informar um e-mail",
            "email.max" => "O valor digitado no campo EMAIL é muito grande",
            "email.email" => "O e-mail informado é inválido",
            "email.unique" => "Este e-mail já foi cadastrado",

            "password.required" => "É necessário informar uma senha",
            "password.max" => "O valor digitado no campo SENHA é muito grande",
            "password.min" => "A senha deve ter no mínimo 6 carácteres",
            "password.confirmed" => "A confirmação de senha não bate",
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'cpf' => preg_replace('/[^0-9]/s', '', $data['cpf']),
            'password' => bcrypt($data['password']),
        ]);
    }
}
