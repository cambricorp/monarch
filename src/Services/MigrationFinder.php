<?php

namespace Monarch\Services;

/* Laravel */
use Illuminate\Filesystem\Filesystem;

class MigrationFinder
{

    /**
     * Create a filesystem instance.
     */
    public function __construct()
    {
        $filesystem = new Filesystem;

        $this->filesystem = $filesystem;
    }

    /**
     * Compiled migrations from all paths
     * @return [type] [description]
     */
    public function compiledMigrations()
    {
        $module = $this->getMigrations('module');
        $plugin = $this->getMigrations('plugin');

        return $merged = array_merge($module, $plugin);
    }

    /**
     * Get migrations from specific location
     * @param  string $preference [description]
     * @return [type]             [description]
     */
    public function getMigrations(string $preference)
    {
        $path = base_path(config('monarch.datafile-path'));

        switch ($preference) {
            case 'module':
                if($this->filesystem->exists($path . 'module-migrations.php'))
                {
                    return $module = include $path . 'module-migrations.php';
                }else{
                    return $module = [];
                }
                break;
            case 'plugin':
                if($this->filesystem->exists($path . 'plugin-migrations.php'))
                {
                    return $plugin = include $path . 'plugin-migrations.php';
                }else{
                    return $plugin = [];
                }
                break;
            default:
                return FALSE;
                break;
        }
    }

}