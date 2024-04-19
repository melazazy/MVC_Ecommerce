<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0bc889e31bd98b6643eb6b8c404007cb
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0bc889e31bd98b6643eb6b8c404007cb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0bc889e31bd98b6643eb6b8c404007cb::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0bc889e31bd98b6643eb6b8c404007cb::$classMap;

        }, null, ClassLoader::class);
    }
}