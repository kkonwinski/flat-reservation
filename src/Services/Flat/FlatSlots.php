<?php


namespace App\Services\Flat;

class FlatSlots
{


    /**
     * @param array $flats
     * @return array
     */
    public function getFlatsWithAvailableSlots(array $flats): array
    {
        $availableFlatsArr = array();
        $mergedArrays = array();
        foreach ($flats as $key => $flat) {
            $availableSlots = $flat['slots'] - $flat['reservedSlots'];
            if ($availableSlots > 0) {
                $arr1 = $availableFlatsArr[] = $flat;
                $arr2 = $availableFlatsArr[] = ['availableSlots' => $availableSlots];
                $mergedArrays[] = array_merge($arr1, $arr2);
            }
        }
        return $mergedArrays;
    }
}
