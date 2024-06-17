<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8c820e7769869f41fb2ced4a6523d813
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'S\\P\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'S\\P\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8c820e7769869f41fb2ced4a6523d813::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8c820e7769869f41fb2ced4a6523d813::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8c820e7769869f41fb2ced4a6523d813::$classMap;

        }, null, ClassLoader::class);
    }
}
