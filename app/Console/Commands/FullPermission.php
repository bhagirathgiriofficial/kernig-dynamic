<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class FullPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:full';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Give -R 777 permission to project.';

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
        $process = new Process('sudo chmod -R 777 ../kautilya-classes');

        $process->run();
        
        if (! $process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        
        echo $process->getOutput();
    }
}
