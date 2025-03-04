<?php

namespace App\Services;

use App\Models\Developer;
use Carbon\Carbon;

class CakeDayService
{
    public function calculateCakeDays()
    {
        $developers = Developer::all();
        $cakeDays = [];

        foreach ($developers as $developer) {
            $birthday = Carbon::parse($developer->date_of_birth)->year(Carbon::now()->year);

            // ✅ Step 1: Employees get their birthday off
            $dayOff = $this->nextWorkingDay($birthday);

            // ✅ Step 2: Cake Day is the first working day after their day off
            $cakeDay = $this->nextWorkingDay($dayOff->copy()->addDay());

            // ✅ Step 3: Store Cake Days (but don't handle cake-free logic yet)
            $cakeDays[$cakeDay->toDateString()][] = $developer->name;
        }

        return $this->applyCakeRules($cakeDays);
    }

    private function isHoliday(Carbon $date)
    {
        $holidays = ['12-25', '12-26', '01-01'];
        return in_array($date->format('m-d'), $holidays);
    }

    private function nextWorkingDay(Carbon $date)
    {
        while ($date->isWeekend() || $this->isHoliday($date)) {
            $date->addDay();
        }
        return $date;
    }

    private function applyCakeRules(array $cakeDays): array
    {
        ksort($cakeDays);
        $finalCakeSchedule = [];
        $previousCakeDay = null;
        $cakeFreeDays = [];

        foreach ($cakeDays as $date => $people) {
            // ✅ If the date is a Cake-Free Day, move the cake to the next working day
            while (in_array($date, $cakeFreeDays)) {
                $date = $this->nextWorkingDay(Carbon::parse($date)->addDay())->toDateString();
            }

            $isLargeCake = count($people) > 1;

            // ✅ Merge consecutive Cake Days
            if ($previousCakeDay && isset($finalCakeSchedule[$previousCakeDay])
                && Carbon::parse($previousCakeDay)->addDay()->toDateString() === $date) {
                
                $finalCakeSchedule[$date]['people'] = $finalCakeSchedule[$previousCakeDay]['people'] . ', ' . implode(', ', $people);
                $finalCakeSchedule[$date]['small_cakes'] = 0; // No small cakes when merged
                $finalCakeSchedule[$date]['large_cakes'] = 1; // Ensure it's a large cake

                // ✅ Remove the merged day
                unset($finalCakeSchedule[$previousCakeDay]);
            } else {
                // ✅ Normal Cake Day processing
                $finalCakeSchedule[$date] = [
                    'date' => $date,
                    'small_cakes' => $isLargeCake ? 0 : 1,
                    'large_cakes' => $isLargeCake ? 1 : 0,
                    'people' => implode(', ', $people)
                ];
            }

            // ✅ Mark the next working day as Cake-Free
            $cakeFreeDays[] = $this->nextWorkingDay(Carbon::parse($date)->addDay())->toDateString();

            // ✅ Update previous Cake Day
            $previousCakeDay = $date;
        }

        // ✅ Step 2: Mark Cake-Free Days in the schedule
        foreach ($cakeFreeDays as $date) {
            if (!isset($finalCakeSchedule[$date])) {
                $finalCakeSchedule[$date] = [
                    'date' => $date,
                    'small_cakes' => 0,
                    'large_cakes' => 0,
                    'people' => 'Cake-Free Day'
                ];
            }
        }

        return $finalCakeSchedule;
    }
}
