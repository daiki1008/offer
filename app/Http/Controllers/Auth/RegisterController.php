<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Storage;

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
    protected $redirectTo = '/admin/profile/info';
   //  protected function redirectTo() {
   //    return route('/admin/profile/info', ['user' => Auth::id()]);
   // }

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    // public function __construct()
    // {
    //   dd('ミドルウェア');
    //     $this->middleware('guest');
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'introduction' => ['required', 'string'],
            'tag.*' =>  ['string'],
            'yagou' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User  array $data
     */
    protected function create(array $data)
    {
        // dd($data['profile_image_path']);
        // $path = $data['profile_image_path']->store('public/image');
        // $path2 = str_replace('public/', '', $path);
        $image = $data['profile_image_path'];
        $path = Storage::disk('s3')->putFile('/',$image,'public');
        // $path2 = str_replace('public/', '', $path);
        // dd($path);

        $tag = implode(" ",$data['tag']);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'introduction' => $data['introduction'],
            'tag' => $tag,
            'yagou' => $data['yagou'],
            'profile_image_path' => Storage::disk('s3')->url($path),
            'password' => Hash::make($data['password']),
        ]);
    }
}
