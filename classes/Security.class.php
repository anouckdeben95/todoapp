<?php
    Abstract class Security{
        public static function hash($password){
            $options = [
                'cost' => 10
            ];

            $hash = password_hash($password, PASSWORD_BCRYPT, $options);
            return $hash;
        }
    }