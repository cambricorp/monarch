<?php

namespace Monarch\Console\Commands;

/* Laravel */
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Console\ConfirmableTrait;

/* Third Party */
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\Process;

class MigrateCommand extends Command
{
    use ConfirmableTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monarch:migrate {--path=* : Array of migration paths to migrate.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prepare Monarch Migrations';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Check for path option
        if(! $this->option('path'))
        {
            $this->error("No migration paths set!");
        }

        // Get migration paths
        foreach($this->option('path') as $key => $path)
        {
            $this->triggerMigrations($path);        
        }

        $this->info(">>>>> Migration Complete!");
    }

    /**
     * Run the migrations.
     *
     * @return void.
     */
    protected function triggerMigrations($path)
    {
        // command
        $this->call('migrate', [
            '--path' => $path
        ]);    
    }

}