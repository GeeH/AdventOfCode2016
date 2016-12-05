<?php

namespace Advent2016\DayFive;


class Password
{

    public function isValidHash(string $hash) : bool
    {
        return preg_match('#^00000#', $hash);
    }

    public function getPassword(string $key) : string
    {
        $password = '';
        for ($i = 0; $i <= PHP_INT_MAX; $i++) {
            $hash = md5($key . $i);
            if ($this->isValidHash($hash)) {
                $password .= substr($hash, 5, 1);
                if (strlen($password) === 8) {
                    break;
                }
            }
        }

        return $password;
    }

}