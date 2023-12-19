<?php

namespace App\Traits;

trait Sessionable
{

    public function getFromSessionOrCalculate($key, $callback)
    {
        $userKey = $this->getKeyByUser($key);
        $session_value = session()->get($userKey);
        if ($session_value) {
            return $session_value;
        }

        $value = $callback();

        session()->put($userKey, $value);

        return $value;
    }

    public function forgetSession($key)
    {
        $userKey = $this->getKeyByUser($key);
        session()->forget($userKey);
    }

    public function getKeyByUser($key){
        return $key . '_' . auth()->id();
    }

    // Puedes agregar más métodos según tus necesidades
}

