<?php

namespace App\Actions\ScheduleTasks;

use App\Models\PurchaseOrder;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MostPurchasesByMonth {

    public function __invoke(){
        try {
            $currentDate = new DateTime();
            $firstDayOfMonth = new DateTime($currentDate->format('Y-m-01'));
            // Get the last day of the current month
            $lastDayOfMonth = new DateTime($currentDate->format('Y-m-t'));
         
            $results = PurchaseOrder::select('book_id', DB::raw('COUNT(book_id) as purchases'))
            ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
            ->groupBy('book_id')
            ->orderByDesc('purchases')
            ->limit(20)
            ->get();
            
            $firstDayOfMonth = now()->firstOfMonth()->toDateString();
            $lastDayOfMonth = now()->lastOfMonth()->toDateString();
            if(!empty($results)){
                foreach ($results as $result) {
                    DB::table('most_purchases_per_month')->updateOrInsert([
                        'book_id' => $result->book_id,
                        'purchases' => $result->purchases,
                        'first_of_month' => $firstDayOfMonth,
                        'last_of_month' => $lastDayOfMonth,
                    ]);
                }
            }
        } catch (\Exception $e) {
            // Log any exceptions that occur
            Log::error('Scheduled task failed: ' . $e->getMessage());
        }
    }
}
