<?php

namespace App\Controller;

use App\Entity\PostTheater;
use App\Form\PostTheaterType;
use App\Repository\PostTheaterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/post/theater")
 */
class PostTheaterController extends AbstractController
{
    /**
     * @Route("/", name="post_theater_index", methods={"GET"})
     */
    public function index(PostTheaterRepository $postTheaterRepository): Response
    {
        return $this->render('post_theater/index.html.twig', [
            'post_theaters' => $postTheaterRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="post_theater_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $postTheater = new PostTheater();
        $form = $this->createForm(PostTheaterType::class, $postTheater);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $directory = $this->getParameter('imageDir');

            $file = $form['image']->getData();

            $error = $file->getError();
            $size = $file->getSize();
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();

            $file->move($directory, "$filename");

            $imageUrl = $this->getParameter('imageUrl');
            $postTheater->setUrlImage("$imageUrl/$filename");

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($postTheater);
            $entityManager->flush();

            return $this->redirectToRoute('post_theater_index');
        }

        return $this->render('post_theater/new.html.twig', [
            'post_theater' => $postTheater,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="post_theater_show", methods={"GET"})
     */
    public function show(PostTheater $postTheater): Response
    {
        return $this->render('post_theater/show.html.twig', [
            'post_theater' => $postTheater,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="post_theater_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PostTheater $postTheater): Response
    {
        $form = $this->createForm(PostTheaterType::class, $postTheater);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $directory = $this->getParameter('imageDir');

            $file = $form['image']->getData();

            $error = $file->getError();
            $size = $file->getSize();
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();

            $file->move($directory, "$filename");

            $imageUrl = $this->getParameter('imageUrl');
            $postTheater->setUrlImage("$imageUrl/$filename");

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('post_theater_index');
        }

        return $this->render('post_theater/edit.html.twig', [
            'post_theater' => $postTheater,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="post_theater_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PostTheater $postTheater): Response
    {
        if ($this->isCsrfTokenValid('delete'.$postTheater->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($postTheater);
            $entityManager->flush();
        }

        return $this->redirectToRoute('post_theater_index');
    }
}
