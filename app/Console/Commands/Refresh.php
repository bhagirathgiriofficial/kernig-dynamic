<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class Refresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh migration and install passport.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $process = new Process('composer dump-autoload');

        $process->run();
        
        if (! $process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        
        echo $process->getOutput();

        $process = new Process('php artisan migrate:fresh --seed');

        $process->run();
        
        if (! $process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        
        echo $process->getOutput();

        $process = new Process('php artisan passport:install');

        $process->run();
        
        if (! $process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        
        echo $process->getOutput();
    }
}
