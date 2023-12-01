<?php

namespace Soiposervices\RecombeeLaravel\Commands;

use Illuminate\Console\Command;
use Soiposervices\RecombeeLaravel\RecombeeLaravelFacade;

use function Laravel\Prompts\confirm;

class RecombeeLaravelResedDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recombee:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command can be used to reset recombee database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $confirmed = confirm(
            label: 'Do really want to do this? It will delete your database.',
            default: false,
            yes: 'I accept',
            no: 'I decline'
        );
        if($confirmed){
            RecombeeLaravelFacade::resetDatabase();
            $this->info("Database rest request. It should be done soon enough.");
        }
    }
}
