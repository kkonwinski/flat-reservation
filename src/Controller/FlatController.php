<?php

namespace App\Controller;

use App\Repository\FlatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FlatController extends AbstractController
{

    private $flatRepository;

    public function __construct(FlatRepository  $flatRepository)
    {

        $this->flatRepository = $flatRepository;
    }

    /**
     * @Route("/flat", name="flat")
     */
    public function index(): Response
    {

        return $this->render('flat/index.html.twig', [
            'flats' => $this->flatRepository->findAll(),
        ]);
    }
}
