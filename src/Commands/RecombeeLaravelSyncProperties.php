<?php

namespace Soiposervices\RecombeeLaravel\Commands;

use Illuminate\Console\Command;
use Soiposervices\RecombeeLaravel\RecombeeLaravelFacade;

class RecombeeLaravelSyncProperties extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recombee:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will sync the configured properties for items and users to recombee';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        RecombeeLaravelFacade::syncProperties();
        $this->info("Properties should have been synced.");
    }
}
