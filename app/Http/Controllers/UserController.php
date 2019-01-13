<?php

namespace App\Http\Controllers;

use App\Entities\Address;
use App\Http\Requests\StoreAddressRequest;
use App\Services\FreteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index() {
        return view('user.index', [ 'user' => Auth::user() ]);
    }


    public function alterPassword(){
        return view('user.password');
    }

    public function storePassword(Request $request){
        $user = Auth::user();
        $check = Hash::check($request->get("currentPassword"), $user->password);
        if(!$check)
            return redirect()->back()->with('error', 'A senha atual digitada está incorreta');

        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6|max:255|confirmed',
        ], [
            "password.required" => "É necessário informar uma senha",
            "password.max" => "O valor digitado no campo SENHA é muito grande",
            "password.min" => "A senha deve ter no mínimo 6 carácteres",
            "password.confirmed" => "A confirmação de senha não bate",
        ]);
        $validator->validate();

        $user->password = bcrypt($request->get("password"));
        $user->save();

        return redirect()->back()->with('success', 'A senha foi alterada com sucesso');
    }



    public function alterProfile() {
        $user = Auth::user();
        return view('user.profile', [ 'user' => $user ]);
    }

    public function storeProfile(Request $request){
        $data = $request->all();

        $data['phone'] = preg_replace('/[^0-9]/s', '', $data['phone']);

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|min:10|max:11',
            'birth' => 'required|string|min:10|date|max:10',
        ], [
            "birth.required" => "O formato da data de nascimento informada é inválido",
            "birth.min" => "O formato da data de nascimento informada é inválido",
            "birth.max" => "O formato da data de nascimento informada é inválido",
            "birth.date" => "O formato da data de nascimento informada é inválido",

            "phone.required" => "É necessário informar um telefone",
            "phone.max" => "O valor digitado no campo TELEFONE é muito grande",
            "phone.min" => "O telefone deve conter DDD + número",
        ]);
        $validator->validate();

        $user = Auth::user();
        $user->name = $data["name"];
        $user->phone = $data["phone"];
        $user->birth = $data["birth"];

        $user->save();


        return redirect()->back()->with('success', 'Dados salvos com sucesso !');
    }

    public function alterAddress(){
        $user = Auth::user();
        $address = is_null($user->address) ? new Address() : $user->address;

        return view('user.address', [ "address" => $address ]);
    }

    public function storeAddress(StoreAddressRequest $request){
        $user = Auth::user();

        $data = $request->all();
        $zipcode = $data['zipcode'];

        $data['zipcode'] = preg_replace('/[^0-9]/s', '', $zipcode);


        try{
            if( is_null($user->address) )
                $user->address()->create($data);
            else
                $user->address->fill($data)->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro inesperado ao tentar salvar o endereço !');
        }

        return redirect()->back()->with('success', 'Endereço salvo com sucesso !');
    }


    public function getLocationByZipCode($zipcode){
        try {
            return response()->json(FreteService::getLocationByZIPCode($zipcode));
        } catch (\Exception $e){
            return response()->json([
                "error" => $e->getMessage()
            ]);
        }
    }
}
