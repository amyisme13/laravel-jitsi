<?php

namespace Amyisme13\LaravelJitsi;

use Illuminate\Support\Str;

class LaravelJitsi
{
    /**
     * Generate jwt based on jitsi documentation
     * https://github.com/jitsi/lib-jitsi-meet/blob/master/doc/tokens.md
     *
     * @param \Illuminate\Database\Eloquent\Model $user
     * @param string $room will be assigned all (*) when null
     * @return void
     */
    public function generateJwt($user, $room = '*')
    {
        // TODO: Implement jwt
        return 'jwt';
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
