<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Upload dir
    |--------------------------------------------------------------------------
    |
    | The dir where to store the images (relative from public).
    |
    */
    'dir' => ['uploads'],

    /*
    |--------------------------------------------------------------------------
    | Filesystem disks (Flysytem)
    |--------------------------------------------------------------------------
    |
    | Define an array of Filesystem disks, which use Flysystem.
    | You can set extra options, example:
    |
    | 'my-disk' => [
    |        'URL' => url('to/disk'),
    |        'alias' => 'Local storage',
    |    ]
    */
    'disks' => [
        // 'uploads',
    ],

    /*
    |--------------------------------------------------------------------------
    | Routes group config
    |--------------------------------------------------------------------------
    |
    | The default group settings for the elFinder routes.
    |
    */

    'route' => [
        'prefix'     => config('backpack.base.route_prefix', 'admin').'/elfinder',
        'middleware' => ['web', config('backpack.base.middleware_key', 'admin')], //Set to null to disable middleware filter
    ],

    /*
    |--------------------------------------------------------------------------
    | Access filter
    |--------------------------------------------------------------------------
    |
    | Filter callback to check the files
    |
    */

    'access' => 'Barryvdh\Elfinder\Elfinder::checkAccess',

    /*
    |--------------------------------------------------------------------------
    | Roots
    |--------------------------------------------------------------------------
    |
    | By default, the roots file is LocalFileSystem, with the above public dir.
    | If you want custom options, you can set your own roots below.
    |
    */

    'root_options' => ['tmbPath'=>'tmp'],

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    |
    | These options are merged, together with 'roots' and passed to the Connector.
    | See https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options-2.1
    |
    */

    'options' => [
        'bind'   => array(
            'mkdir.pre mkfile.pre rename.pre' => array(
                'Plugin.Normalizer.cmdPreprocess',
                'Plugin.Sanitizer.cmdPreprocess'
            ),
            'upload.presave' => array(
                'Plugin.Normalizer.onUpLoadPreSave',
                'Plugin.Sanitizer.onUpLoadPreSave'
            )
        ),
        // global configure (optional)
        'plugin' => array(
            'Normalizer' => array(
                'enable'    => true,
                'nfc'       => true,
                'nfkc'      => true,
                'umlauts'   => false,
                'lowercase' => true,
                'convmap'   => array(
                    'Š'=>'s', 'š'=>'s', 'Ž'=>'z', 'ž'=>'z', 'À'=>'a', 'Á'=>'a', 'Â'=>'a', 'Ã'=>'a', 'Ä'=>'a', 'Å'=>'a', 'Æ'=>'a', 'Ç'=>'c', 'È'=>'e', 'É'=>'e',
                    'Ê'=>'e', 'Ë'=>'e', 'Ì'=>'i', 'Í'=>'i', 'Î'=>'i', 'Ï'=>'i', 'Ñ'=>'n', 'Ò'=>'o', 'Ó'=>'o', 'Ô'=>'o', 'Õ'=>'o', 'Ö'=>'o', 'Ø'=>'o', 'Ù'=>'u',
                    'Ú'=>'u', 'Û'=>'u', 'Ü'=>'u', 'Ý'=>'y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                    'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                    'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y'
                )
            ),
            'Sanitizer' => array(
                'enable'  => true,
                'targets' => array('\\', '/', ':', '*', '?', '"', '<', '>', '|', ' ','(',')'), // target chars
                'replace' => '_'    // replace to this
            )
        ),
    ],

];
