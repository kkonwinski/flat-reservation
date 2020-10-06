<?php


namespace App\Controller;

use App\Entity\Flat;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cart")
 */
class BookingCart extends AbstractController
{

    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route ("/add/{id}",name="app_add_to_booking_cart")
     */
    public function add(Flat $flat)
    {
        $cart = $this->session->get('flatBooking', []);
        $cart[] = $flat->getId();
        if (!in_array($flat->getId(), $cart)) {
            $this->session->set('flatBooking', $cart);
        }
        return $this->redirectToRoute('flat');
    }

    /**
     * @Route ("/show",name="app_show_booking_cart")
     */
    public function showCart()
    {

        $cart = $this->session->get('flatBooking', []);
        //$this->session->remove('flatBooking');
dd($cart);

        foreach ($cart as $id => $slots) {
            $cartWithData[] = [
                'id' => $id,
                'slots' => $slots
            ];
        }
        return $this->redirectToRoute('flat');
    }

}
