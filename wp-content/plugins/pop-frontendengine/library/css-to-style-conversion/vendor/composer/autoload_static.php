<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit87870d306849e8743fb754236716d9c0
{
    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Sabberworm\\CSS' => 
            array (
                0 => __DIR__ . '/..' . '/sabberworm/php-css-parser/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit87870d306849e8743fb754236716d9c0::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
