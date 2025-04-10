<?php
// src/Controller/OrderController.php

namespace App\Controller;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('/order/checkout', name: 'app_order_checkout')]
    public function checkout(SessionInterface $session, EntityManagerInterface $em): Response
    {
        $cart = $session->get('cart', []);
        if (empty($cart)) {
            $this->addFlash('warning', 'Votre panier est vide.');
            return $this->redirectToRoute('app_cart');
        }

        // Calculer le total
        $total = array_reduce($cart, fn($sum, $item) => $sum + $item['prix'], 0);

        // Créer la commande
        $order = new Order();
        $order->setUserId($this->getUser()->getId()); // Assurez-vous que l'utilisateur est connecté
        $order->setTotal($total);

        $em->persist($order);
        $em->flush();

        // Vider le panier
        $session->remove('cart');

        $this->addFlash('success', 'Commande passée avec succès !');
        return $this->redirectToRoute('app_boutique');
    }
}
