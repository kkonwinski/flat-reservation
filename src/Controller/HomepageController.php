<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class HomepageController extends AbstractController
{

    private $security;


    public function __construct(Security $security)
    {

        $this->security = $security;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function index():Response
    {
        if ($this->security->getUser()) {
            return $this->redirectToRoute('flat');
        }
        return $this->render('security/login.html.twig');
    }
}
