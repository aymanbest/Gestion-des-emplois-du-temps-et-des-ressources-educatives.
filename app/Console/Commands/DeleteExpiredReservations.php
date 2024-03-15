<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeleteExpiredReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:expiredreservations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            DB::table('reservations')
                ->where('date', '<', now())
                ->delete();

            $this->info('Expired reservations deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete expired reservations: ' . $e->getMessage());
        }

        return 0;
    }
}
