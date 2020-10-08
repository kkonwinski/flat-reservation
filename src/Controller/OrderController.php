<?php

namespace App\Controller;

use App\Entity\Flat;
use App\Form\OrderType;
use App\Repository\FlatRepository;
use App\Services\Flat\FlatSlots;
use App\Services\Order\CreateOrder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/order")
 */
class OrderController extends AbstractController
{
    private $flatRepository;
    public function __construct(FlatRepository $flatRepository)
    {
        $this->flatRepository = $flatRepository;
    }

    /**
     * @Route ("/show/{id}",name="app_order_show")
     * @param Request $request
     * @param CreateOrder $createOrder
     * @param FlatSlots $flatSlots
     * @param Flat $flat
     * @return Response
     */
    public function show(Request $request, CreateOrder $createOrder, FlatSlots $flatSlots, Flat $flat): Response
    {
        $form = $this->createForm(OrderType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $orderFormData = $form->getData();

            $createOrder->createOrder($flat, $orderFormData);
            return $this->redirectToRoute('flat');
        }

        $getOneFlatWithSlotsNumber = $this->flatRepository->returnOneFlatWithActuallyAvailableSlots($flat);
        $availableFlat = $flatSlots->getFlatsWithAvailableSlots($getOneFlatWithSlotsNumber);


        return $this->render('order/index.html.twig', [
            'flats' => $availableFlat[0],
            'flatReservationInfos' => $form->createView()
        ]);
    }
}
