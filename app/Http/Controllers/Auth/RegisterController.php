<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewUserNotification;
use Illuminate\Http\Request;
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
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users|email_checker',

            'password' => 'required|string|min:2|confirmed',
        ]);

      
    }

     // $mail=EmailVerifier::verify($data['email']);

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
     $registered_user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),

        ]);

     $admin = User::where('roles', 1)->first();
    if ($admin) {
         $registered_user->notify(new NewUserNotification($registered_user));
    }


        
    return $registered_user;

        // return NewUserNotification::create([
        //     'data' => $data['name'],
        //     'data' => $data['email'],
        //     'type' => $data['password'],
        //     'notifiable_id' => $data['notifiable_id'],

        // ]);


         // $user = Auth::user();
         //    $user->notify(new NewUserNotification($user))->create();


    }

    //  public function store(User $user)
    // {
    //    request()->user()->notify(new NewUserNotification());

    //        $post->user->notify(new Commented($post, $request->user()->id));

    // }
// public function register_user(Request $request){

  


// $user = new NewUserNotification();
//   $user->data = $user->name ;
//   $user->data = $user->email;
//   $user->type = $request->client;
//   $user->notifiable_id = $request->notifiable_id;
 
// $user->save();
  

     
 
   



// }

    
}


