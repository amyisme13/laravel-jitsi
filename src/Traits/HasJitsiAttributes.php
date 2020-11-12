<?php

namespace Amyisme13\LaravelJitsi\Traits;

trait HasJitsiAttributes
{
    /**
     * @return string
     */
    public function getJitsiName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getJitsiEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getJitsiAvatar()
    {
        return $this->avatar;
    }
}
