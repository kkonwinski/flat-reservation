<?php


namespace App\Services\Order;

use App\Entity\Flat;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class CreateOrder
{


    private $security;

    private $em;

    private $orderRepository;

    public function __construct(Security $security, EntityManagerInterface $em, OrderRepository $orderRepository)
    {

        $this->security = $security;
        $this->em = $em;
        $this->orderRepository = $orderRepository;
    }

    public function createOrder(Flat $flat, $form, Request $request)
    {
        $checkForm = $this->getCheckForm($form, $request);
        if ($checkForm == true) {
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
}
