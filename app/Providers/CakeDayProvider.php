<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Developer;
use Carbon\Carbon;

class CakeDayProvider extends ServiceProvider
{
    public function calculateCakeDays()
    {
        $developers = Developer::all();
        $cakeDays = [];

        foreach ($developers as $developer) {
            $birthday = Carbon::parse($developer->date_of_birth)->year(Carbon::now()->year);

            if ($birthday->isWeekend() || $this->isHoliday($birthday)) {
                $birthday = $this->nextWorkingDay($birthday);
            }

            $cakeDays[$birthday->toDateString()][] = $developer->name;
        }

        return $this->applyCakeRules($cakeDays);
    }


    private function isHoliday(Carbon $date)
    {
        $holidays = ['12-25', '12-26', '01-01'];
        return in_array($date->format('m-d'), $holidays);
    }
    /**
     * Bootstrap services.
     */
    private function nextWorkingDay(Carbon $date)
    {
        while ($date->isWeekend() || $this->isHoliday($date)) {
            $date->addDay();
        }
        return $date;
    }
    private function applyCakeRules($cakeDays)
    {
        $finalCakeSchedule = [];
        foreach ($cakeDays as $date => $people) {
            $finalCakeSchedule[$date] = [
                'date' => $date,
                'small_cakes' => count($people) === 1 ? 1 : 0,
                'large_cakes' => count($people) > 1 ? 1 : 0,
                'people' => implode(', ', $people)
            ];
        }
        return $finalCakeSchedule;
    }

}


