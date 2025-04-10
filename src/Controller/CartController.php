<?php
// src/Controller/CartController.php
// src/Controller/CartController.php

namespace App\Controller;

use App\Repository\GiftCardRepository;
use App\Repository\PromoCodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    
    #[Route('/boutique', name: 'app_boutique')]
    public function boutique(GiftCardRepository $giftCardRepo, PromoCodeRepository $promoCodeRepo): Response
    {
        $giftCards = $giftCardRepo->findAll();
        $promoCodes = $promoCodeRepo->findAll();
       // dd([$giftCards], $promoCodes);
    
        return $this->render('user/boutique.html.twig', [
            'giftCards' => $giftCards,
            'promoCodes' => $promoCodes,
        ]);
    }


    #[Route('/cart/add/{id}/{type}/{amount}', name: 'app_add_to_cart')]
public function addToCart(int $id, string $type,float $amount, SessionInterface $session, GiftCardRepository $giftCardRepo, PromoCodeRepository $promoCodeRepo): Response
{

    $cart = $session->get('cart', []);
 
    // Ajoute l'article au panier
    $cart[] = [
        'id' => $id,
        'type' => $type,
        'amount'=>$amount
    ];

    //dd($cart);

    // Sauvegarde le panier dans la session
    $session->set('cart', $cart);

    $this->addFlash('success', 'Article ajouté au panier !');
    return $this->redirectToRoute('app_boutique');
}


}
