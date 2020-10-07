<?php

namespace App\Controller;

use App\Entity\Flat;
use App\Form\OrderType;
use App\Services\Order\CreateOrder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route ("/order")
 */
class OrderController extends AbstractController
{


    /**
     * @Route ("/show/{id}",name="app_order_show")
     */
    public function show(CreateOrder $createOrder, Flat $flat, Request $request)
    {
        $form = $this->createForm(OrderType::class);
        if ($createOrder->createOrder($flat, $form, $request) == true) {
            return $this->redirectToRoute('flat');
        } else {
            return $this->render('order/index.html.twig', [
                'flats' => $flat,
                'flatReservationInfos' => $form->createView()
            ]);
        }
    }
}
