<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd328e513facb714a54cb5de5a86cf3a4
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd328e513facb714a54cb5de5a86cf3a4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd328e513facb714a54cb5de5a86cf3a4::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
