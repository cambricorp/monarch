<?php

namespace Monarch\Console\Commands;

/* Laravel */
use Illuminate\Console\Command;
use Illuminate\Support\Str;

/* Third Party */
use Symfony\Component\Process\Process;

/* Monarch */
use Monarch\Services\MigrationFinder;

class ExampleCommand extends Command
{
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monarch:example';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Example monarch migration command.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
        
        $finder = new MigrationFinder;

        $this->finder = $finder;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $this->call('monarch:migrate', [
        '--path' => array_merge(
                      $this->finder->getMigrations('module'), 
                      $this->finder->getMigrations('plugin'),
                    )
      ]); 
    }

}