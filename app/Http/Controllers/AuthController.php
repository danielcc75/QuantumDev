<?php

namespace App\Http\Controllers;
use App\Models\Perfil;

use App\Models\Usuario;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function redirectGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGithub()
    {
        $githubUser = Socialite::driver('github')->user();

        $nombreCompleto = $githubUser->name ?? $githubUser->nickname;

        $partes = explode(' ', $nombreCompleto, 2);

        $nombre = $partes[0] ?? 'Usuario';
        $apellido = $partes[1] ?? 'GitHub';

        $user = Usuario::updateOrCreate(
            [
                'correo_electronico' => $githubUser->email
            ],
            [
                'nombre' => $nombre,
                'apellido' => $apellido,
                'github_id' => $githubUser->id,
                'contrasenia' => bcrypt(str()->random(16)),
                'estado' => 'activo'
            ]
        );

        Perfil::firstOrCreate([
            'id_usuario' => $user->id_usuario
        ]);

        session([
            'usuario_id' => $user->id_usuario,
            'usuario_nombre' => $user->nombre . ' ' . $user->apellido,
            'usuario_email' => $user->correo_electronico
        ]);

        return redirect('/dashboard');
    }

    public function callbackGoogle()
    {
        $googleUser = Socialite::driver('google')->user();

        $nombreCompleto = $googleUser->name;

        $partes = explode(' ', $nombreCompleto, 2);

        $nombre = $partes[0] ?? 'Usuario';
        $apellido = $partes[1] ?? 'Google';

        $user = Usuario::updateOrCreate(
            [
                'correo_electronico' => $googleUser->email
            ],
            [
                'nombre' => $nombre,
                'apellido' => $apellido,
                'contrasenia' => bcrypt(str()->random(16)),
                'estado' => 'activo'
            ]
        );

        Perfil::firstOrCreate([
            'id_usuario' => $user->id_usuario
        ]);

        session([
            'usuario_id' => $user->id_usuario,
            'usuario_nombre' => $user->nombre . ' ' . $user->apellido,
            'usuario_email' => $user->correo_electronico
        ]);

        return redirect('/dashboard');
    }
}