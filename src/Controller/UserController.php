<?php

namespace App\Controller;

use App\Repository\GiftCardRepository;
use App\Repository\PromoCodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController
{

    
    #[Route('/user', name: 'app_user')]
    public function index(GiftCardRepository $giftCardRepository,PromoCodeRepository $promoCodeRepository): Response
    {
        return $this->render('user/boutique.html.twig', [
            'cartes' => $giftCardRepository->findAll(),
            'codes' => $promoCodeRepository->findAll()
        ]);
    }
}
