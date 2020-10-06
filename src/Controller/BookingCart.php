<?php


namespace App\Controller;

use App\Entity\Flat;
use App\Repository\FlatRepository;
use App\Services\BookingCart\AddToBookingCart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
     * @param Flat $flat
     * @param AddToBookingCart $toBookingCart
     * @return RedirectResponse
     */
    public function add(Flat $flat, AddToBookingCart $toBookingCart): RedirectResponse
    {
        $toBookingCart->addUniqueElementIdFromSessionToCart($flat->getId());

        return $this->redirectToRoute('flat');
    }

    /**
     * @Route ("/show",name="app_show_booking_cart")
     */
    public function showCart(FlatRepository $flatRepository)
    {
        $cart = $this->session->get('flatBooking', []);
        $flats = [];
        foreach ($cart as $cartId) {
            $flats[] = $flatRepository->find($cartId);

        }
        return $this->render('bookingCart/show.html.twig', [
            'flats' => $flats
        ]);

    }

}
