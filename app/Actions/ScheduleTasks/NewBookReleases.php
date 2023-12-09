<?php

namespace App\Actions\ScheduleTasks;

use App\Models\Book;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NewBookReleases {

    public function __invoke(){
        try {
            $currentDate = new DateTime();
            $firstDayOfMonth = new DateTime($currentDate->format('Y-m-01'));
            // Get the last day of the current month
            $lastDayOfMonth = new DateTime($currentDate->format('Y-m-t'));
         
            $results = Book::select('id')->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
            ->take(100)->get();

            var_dump($results);
            
            $firstDayOfMonth = now()->firstOfMonth()->toDateString();
            $lastDayOfMonth = now()->lastOfMonth()->toDateString();
            if(!empty($results)){
                foreach ($results as $result) {
                    DB::table('new_book_releases')->updateOrInsert([
                        'book_id' => $result->id,
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
