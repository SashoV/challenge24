<?php

namespace App\Console\Commands;

use App\Vehicle;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Console\Command;

class ClearDeletedExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vehicle:delete';

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
        $this->info('Deletes soft deleted and vehicles with expired insurance');

        $vehicles = Vehicle::withTrashed()->whereNotNull('deleted_at')->OrWhere('insurance_date', '<', date('Y-m-d'));
        $vehicles->forceDelete();
    }
}
