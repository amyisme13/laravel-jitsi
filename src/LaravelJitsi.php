<?php

namespace Amyisme13\LaravelJitsi;

use Firebase\JWT\JWT;
use Illuminate\Support\Str;

class LaravelJitsi
{
    /**
     * Generate jwt based on jitsi documentation
     * https://github.com/jitsi/lib-jitsi-meet/blob/master/doc/tokens.md
     *
     * @param \Illuminate\Database\Eloquent\Model $user
     * @param string $room will be assigned all (*) when null
     * @return string
     */
    public function generateJwt($user, $room = '*')
    {
        $user = collect([
            'id' => $user->getKey(),
            'name' => $user->getJitsiName(),
            'email' => $user->getJitsiEmail(),
            'avatar' => $user->getJitsiAvatar(),
        ]);

        $payload = [
            'iss' => config('laravel-jitsi.id'),
            'aud' => config('laravel-jitsi.id'),
            'sub' => config('laravel-jitsi.domain'),
            'exp' => now()->addMinutes(5)->timestamp,
            'room' => $room,
            'user' => $user->filter()->all(),
        ];

        return JWT::encode($payload, config('laravel-jitsi.secret'));
    }

    /**
     * Return a view instance for the given room
     *
     * @param string|null $room will be assigned random string when null
     * @param \Illuminate\Database\Eloquent\Model|null $user
     * @return \Illuminate\View\View
     */
    public function viewRoom($room = null, $user = null)
    {
        if (is_null($room)) {
            $room = Str::random();
        }

        $jwt = null;
        if (! is_null($user)) {
            $jwt = $this->generateJwt($user, $room);
        }

        return view('laravel-jitsi::room', compact('room', 'jwt'));
    }
}
