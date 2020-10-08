<?php


namespace App\Services\Flat;


class FlatSlots
{


    /**
     * @param array $flats
     * @return array
     */
    public function changingValueAvailableSlots(array $flats): array
    {
        $availableFlatsArr = array();
        foreach ($flats as $flat) {
            if (($flat['slots'] - $flat['reservedSlots']) > 0) {
                $availableFlatsArr[] = $flat;
            }
        }
        return $availableFlatsArr;
    }
}
