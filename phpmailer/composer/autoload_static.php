<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitceaffdb9d1d73be295dcf3ca01538757
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'SIMS\\Classes\\' => 13,
            'SIMS\\App\\Models\\' => 16,
            'SIMS\\App\\Entities\\' => 18,
            'SIMS\\App\\Controllers\\' => 21,
        ),
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'SIMS\\Classes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
        'SIMS\\App\\Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/models',
        ),
        'SIMS\\App\\Entities\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/entities',
        ),
        'SIMS\\App\\Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/controllers',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitceaffdb9d1d73be295dcf3ca01538757::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitceaffdb9d1d73be295dcf3ca01538757::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
