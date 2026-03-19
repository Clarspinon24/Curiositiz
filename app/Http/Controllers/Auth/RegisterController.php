<?php

namespace App\Http\Controllers\Auth;

use App\Mail\VerifyMail;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname'  => 'required|string|max:255',
            'lastname'   => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => 'required|string|min:6|confirmed',
            'phone'      => 'numeric|digits:10',
            'postal'     => 'numeric|digits:5',
            'image_name' => 'image',
            'cgu'        => 'accepted',
        ]);
    }

    protected function create(array $data)
    {
        if (empty($data['firstname']) && empty($data['lastname']) && ! empty($data['name'])) {
            [$data['firstname'], $data['lastname']] = explode(' ', $data['name'], 2);
        }

        $slug = strtolower($data['firstname'] . '.' . $data['lastname']);
        $nb   = 0;

        while (User::where('slug', $slug)->exists()) {
            $nb++;
            $slug = strtolower($data['firstname'] . '.' . $data['lastname']) . $nb;
        }

        $user = User::create([
            'name'       => $data['firstname'] . ' ' . $data['lastname'],
            'email'      => $data['email'],
            'password'   => bcrypt($data['password']),
            'firstname'  => $data['firstname'],
            'lastname'   => $data['lastname'],
            'phone'      => $data['phone'] ?? null,
            'city'       => $data['city'] ?? null,
            'postal'     => $data['postal'] ?? null,
            'image_name' => 'default.png',
            'slug'       => $slug,
            'cgu'        => 1,
        ]);

        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token'   => \Illuminate\Support\Str::random(40),
        ]);

        Mail::to($user->email)->send(new VerifyMail($user));

        return $user;
    }

    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        return redirect('/login')->with('status_mail', "Un email de confirmation vous a été envoyé. Pensez à vérifier la réception de l'email dans vos courriels indésirables ...");
    }

    public function verifyUser(string $token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();

        if (! $verifyUser) {
            return redirect('/login')->with('warning', 'Désolé, votre email ne peut pas être identifié.');
        }

        $user = $verifyUser->user;

        if (! $user->verified) {
            $user->verified = 1;
            $user->save();
            $status = 'Votre email est vérifié, vous pouvez maintenant vous connecter.';
        } else {
            $status = 'Votre email est déjà vérifié, vous pouvez vous connecter.';
        }

        return redirect('/login')->with('status', $status);
    }
}
