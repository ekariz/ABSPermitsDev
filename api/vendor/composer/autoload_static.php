<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit465dd4029efbe7ae424f54f190dc47d9
{
    public static $prefixesPsr0 = array (
        'o' => 
        array (
            'org\\bovigo\\vfs' => 
            array (
                0 => __DIR__ . '/..' . '/mikey179/vfsStream/src/main/php',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit465dd4029efbe7ae424f54f190dc47d9::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
