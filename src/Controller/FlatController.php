<?php

namespace App\Controller;

use App\Repository\FlatRepository;
use App\Services\Flat\FlatSlots;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FlatController extends AbstractController
{

    private $flatRepository;
    private $flatSlots;

    public function __construct(FlatRepository $flatRepository, FlatSlots $flatSlots)
    {

        $this->flatRepository = $flatRepository;
        $this->flatSlots = $flatSlots;
    }

    /**
     * @Route("/flat", name="flat")
     */
    public function index(): Response
    {
        $flats = $this->flatRepository->returnFlatsWithActuallyAvailableSlots();
        $availableFlats = $this->flatSlots->changingValueAvailableSlots($flats);
        return $this->render('flat/index.html.twig', [
            'flats' => $availableFlats,
        ]);
    }
}
