<?php


namespace App\Services\BookingCart;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AddToBookingCart
{

    private $session;

    public function __construct(SessionInterface $session)
    {

        $this->session = $session;
    }

    public function addUniqueElementIdFromSessionToCart(int $elementId): void
    {

        $cart = $this->session->get('flatBooking', []);

        if (!in_array($elementId, $cart, true)) {
            $cart[] = $elementId;
            $this->session->set('flatBooking', $cart);
        }
    }
}
