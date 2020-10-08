<?php


namespace App\Services\Order;

use App\Entity\Flat;
use App\Entity\Order;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    )
    {

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
      //  if ($startReservation < $finishReservation) {
            $dateDiff = $startReservation->diff($finishReservation);
            return $dateDiff->days;
//        }
//        return false;
    }

    public function createOrderByFormData($formData, $flat): void
    {
        $formData->setUser($this->security->getUser());
        $formData->setFlat($flat);
        $this->checkIfDiscountAvailable($formData) > 0 ? $formData->setDiscount(self::VALUE_DISCOUNT) : null;
        $this->orderRepository->create($formData);
    }
}
