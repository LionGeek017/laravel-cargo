<?php

namespace App\Console\Commands;

use App\Models\Cargo;
use Illuminate\Console\Command;

class CheckActualCargo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:actual-cargo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        Cargo::checkActual();
        return 0;
    }
}
