<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FlatController extends AbstractController
{
    /**
     * @Route("/flat", name="flat")
     */
    public function index()
    {
        return $this->render('flat/index.html.twig', [
            'controller_name' => 'FlatController',
        ]);
    }
}
