<?php

namespace App\Controller;

use App\Entity\PostDates;
use App\Form\PostDatesType;
use App\Repository\PostDatesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/post/dates")
 */
class PostDatesController extends AbstractController
{
    /**
     * @Route("/", name="post_dates_index", methods={"GET"})
     */
    public function index(PostDatesRepository $postDatesRepository): Response
    {
        return $this->render('post_dates/index.html.twig', [
            'post_dates' => $postDatesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="post_dates_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $postDate = new PostDates();
        $form = $this->createForm(PostDatesType::class, $postDate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($postDate);
            $entityManager->flush();

            return $this->redirectToRoute('post_dates_index');
        }

        return $this->render('post_dates/new.html.twig', [
            'post_date' => $postDate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="post_dates_show", methods={"GET"})
     */
    public function show(PostDates $postDate): Response
    {
        return $this->render('post_dates/show.html.twig', [
            'post_date' => $postDate,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="post_dates_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PostDates $postDate): Response
    {
        $form = $this->createForm(PostDatesType::class, $postDate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('post_dates_index');
        }

        return $this->render('post_dates/edit.html.twig', [
            'post_date' => $postDate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="post_dates_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PostDates $postDate): Response
    {
        if ($this->isCsrfTokenValid('delete'.$postDate->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($postDate);
            $entityManager->flush();
        }

        return $this->redirectToRoute('post_dates_index');
    }
}
