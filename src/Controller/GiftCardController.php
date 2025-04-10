<?php

namespace App\Controller;

use App\Entity\GiftCard;
use App\Form\GiftCardType;
use App\Repository\GiftCardRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/gift/card')]
final class GiftCardController extends AbstractController
{
    #[Route(name: 'app_gift_card_index', methods: ['GET'])]
    public function index(GiftCardRepository $giftCardRepository): Response
    {
        return $this->render('gift_card/index.html.twig', [
            'gift_cards' => $giftCardRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_gift_card_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $giftCard = new GiftCard();
        $form = $this->createForm(GiftCardType::class, $giftCard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($giftCard);
            $entityManager->flush();

            return $this->redirectToRoute('app_gift_card_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('gift_card/new.html.twig', [
            'gift_card' => $giftCard,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_gift_card_show', methods: ['GET'])]
    public function show(GiftCard $giftCard): Response
    {
        return $this->render('gift_card/show.html.twig', [
            'gift_card' => $giftCard,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_gift_card_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, GiftCard $giftCard, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GiftCardType::class, $giftCard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_gift_card_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('gift_card/edit.html.twig', [
            'gift_card' => $giftCard,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_gift_card_delete', methods: ['POST'])]
    public function delete(Request $request, GiftCard $giftCard, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$giftCard->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($giftCard);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_gift_card_index', [], Response::HTTP_SEE_OTHER);
    }
}
