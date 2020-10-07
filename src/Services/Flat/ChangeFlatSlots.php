<?php


namespace App\Services\Flat;

use App\Entity\Flat;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Exception\ValidatorException;

class ChangeFlatSlots
{


    public function changingValueAvailableSlots(Flat $flat, int $numberSlots)
    {
        try {
            if ($flat->getSlots()>=$numberSlots) {
                $changeValueAvailableSlots = $flat->getSlots() - $numberSlots;
                $flat->setSlots($changeValueAvailableSlots);
            }
        } catch (ValidationFailedException $validationFailedException) {
            $validationFailedException->getMessage('Podana wartość nie może być większa niż ilość dostepnych slotów');
        }
    }
}
