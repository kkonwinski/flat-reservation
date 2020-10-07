<?php


namespace App\Services\Order;

use App\Entity\Flat;
use App\Repository\OrderRepository;
use App\Services\Flat\ChangeFlatSlots;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class CreateOrder
{
    const NAME_SLOTS_IN_REQUEST = 'slots';

    private $security;

    private $em;

    private $orderRepository;
    /**
     * @var ChangeFlatSlots
     */
    private $changeFlatSlots;

    public function __construct(Security $security, EntityManagerInterface $em, OrderRepository $orderRepository, ChangeFlatSlots $changeFlatSlots)
    {

        $this->security = $security;
        $this->em = $em;
        $this->orderRepository = $orderRepository;
        $this->changeFlatSlots = $changeFlatSlots;
    }

    public function createOrder(Flat $flat, $form, Request $request)
    {
        $checkForm = $this->getCheckForm($form, $request);
        if ($checkForm == true) {
            $numberReservationSlots = $this->getReservationSlots($request);
            $this->changeFlatSlots->changingValueAvailableSlots($flat, $numberReservationSlots);
            $this->createOrderByFormData($form->getData(), $flat);
            return true;
        }
    }

    /**
     * @param $form
     * @param $request
     */
    public function getCheckForm($form, $request)
    {
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return true;
        }
    }

    public function createOrderByFormData($formData, $flat): void
    {
        $formData->setUser($this->security->getUser());
        $formData->setFlat($flat);
        $this->orderRepository->create($formData);
    }

    public function getReservationSlots($request): int
    {
        $reservationSlots = $request->request->get("order");
        return $reservationSlots[self::NAME_SLOTS_IN_REQUEST];
    }
}
