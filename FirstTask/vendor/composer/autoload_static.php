<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite8cd1952b8aba5491e32ab4ae40fdf98
{
    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInite8cd1952b8aba5491e32ab4ae40fdf98::$classMap;

        }, null, ClassLoader::class);
    }
}
