<?php

class Config
{

    public static function DB_HOST()
    {
        return Config::get_env("DB_HOST", "containers-us-west-117.railway.app");
    }
    public static function DB_USERNAME()
    {
        return Config::get_env("DB_USERNAME", "root");
    }
    public static function DB_PASSWORD()
    {
        return Config::get_env("DB_PASSWORD", "IFPSDl7C4N4TLKSUIgy1");
    }
    public static function DB_SCHEME()
    {
        return Config::get_env("DB_SCHEME", "flight_reservation");
    }
    public static function DB_PORT()
    {
        return Config::get_env("DB_PORT", "7687");
    }
    public static function JWT_SECRET()
    {
        return Config::get_env("JWT_SECRET", "ezcb9s8UcF");
    }

    public static function get_env($name, $default)
    {
        return isset($_ENV[$name]) && trim($_ENV[$name]) != '' ? $_ENV[$name] : $default;
    }
}
