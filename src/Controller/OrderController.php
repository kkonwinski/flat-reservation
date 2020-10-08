<?php

namespace App\Controller;

use App\Entity\Flat;
use App\Form\OrderType;
use App\Services\Order\CreateOrder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route ("/order")
 */
class OrderController extends AbstractController
{

    /**
     * @Route ("/show/{id}",name="app_order_show")
     * @param CreateOrder $createOrder
     * @param Flat $flat
     * @param Request $request
     * @return Response
     */
    public function show(CreateOrder $createOrder, Flat $flat, Request $request): Response
    {
        $form = $this->createForm(OrderType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $orderFormData = $form->getData();

            $createOrder->createOrder($flat, $orderFormData);
            return $this->redirectToRoute('flat');
        }


        return $this->render('order/index.html.twig', [
            'flats' => $flat,
            'flatReservationInfos' => $form->createView()
        ]);
    }
}
