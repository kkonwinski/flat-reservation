<?php


namespace App\Services\Order;

use App\Entity\Flat;
use App\Entity\Order;
use App\Repository\OrderRepository;
use App\Services\Flat\ChangeFlatSlots;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class CreateOrder
{
    const VALUE_DISCOUNT = 7;

    private $security;
    private $em;
    private $orderRepository;

    public function __construct(
        Security $security,
        EntityManagerInterface $em,
        OrderRepository $orderRepository
    ) {

        $this->security = $security;
        $this->em = $em;
        $this->orderRepository = $orderRepository;
    }

    public function createOrder(Flat $flat, Order $order)
    {
        $this->createOrderByFormData($order, $flat);
        return true;
    }

    public function checkIfDiscountAvailable(Order $order): int
    {
        $startReservation = $order->getStart();
        $finishReservation = $order->getFinish();
        $dateDiff = $startReservation->diff($finishReservation);
        return $dateDiff->days;
    }

    public function createOrderByFormData($formData, $flat): void
    {
        $formData->setUser($this->security->getUser());
        $formData->setFlat($flat);
        $this->checkIfDiscountAvailable($formData) > 0 ? $formData->setDiscount(self::VALUE_DISCOUNT) : null;
        $this->orderRepository->create($formData);
    }
}
