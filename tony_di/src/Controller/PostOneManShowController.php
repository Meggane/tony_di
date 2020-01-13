<?php

namespace App\Controller;

use App\Entity\PostOneManShow;
use App\Form\PostOneManShowType;
use App\Repository\CommentsRepository;
use App\Repository\ImagesRepository;
use App\Repository\PostOneManShowRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

/**
 * @Route("/post/seul_en_scene")
 */
class PostOneManShowController extends PagesController
{
    /**
     * @Route("/", name="post_one_man_show_index", methods={"GET", "POST"})
     */
    public function index(Request $request, PostOneManShowRepository $postOneManShowRepository, ImagesRepository $imagesRepository, CommentsRepository $commentsRepository, TokenGeneratorInterface $tokenGenerator, \Swift_Mailer $mailer): Response
    {
        return $this->newsletter($mailer, $tokenGenerator, $request, 'post_one_man_show/index.html.twig', 'post_one_man_shows', $postOneManShowRepository->findAll(), 'images', $imagesRepository->findAll(), 'comments', $commentsRepository->findAll());
    }

    /**
     * @Route("/new/admin", name="post_one_man_show_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $postOneManShow = new PostOneManShow();
        $form = $this->createForm(PostOneManShowType::class, $postOneManShow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['image']->getData();

            if ($file != null) {
                $directory = $this->getParameter('imageDir');

                $error = $file->getError();
                $size = $file->getSize();
                $extension = $file->getClientOriginalExtension();
                $filename = $file->getClientOriginalName();

                $file->move($directory, "$filename");

                $imageUrl = $this->getParameter('imageUrl');
                $postOneManShow->setUrlImage("$imageUrl/$filename");
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($postOneManShow);
            $entityManager->flush();

            return $this->redirectToRoute('post_one_man_show_index');
        }

        return $this->render('post_one_man_show/new.html.twig', [
            'post_one_man_show' => $postOneManShow,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit/admin", name="post_one_man_show_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PostOneManShow $postOneManShow): Response
    {
        $form = $this->createForm(PostOneManShowType::class, $postOneManShow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['image']->getData();

            if ($file != null) {
                $directory = $this->getParameter('imageDir');

                $error = $file->getError();
                $size = $file->getSize();
                $extension = $file->getClientOriginalExtension();
                $filename = $file->getClientOriginalName();

                $file->move($directory, "$filename");

                $imageUrl = $this->getParameter('imageUrl');
                $postOneManShow->setUrlImage("$imageUrl/$filename");
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('post_one_man_show_index');
        }


        return $this->render('post_one_man_show/edit.html.twig', [
            'post_one_man_show' => $postOneManShow,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/admin", name="post_one_man_show_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PostOneManShow $postOneManShow, ImagesRepository $imagesRepository, CommentsRepository $commentsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$postOneManShow->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $postOneManShowTitle = $postOneManShow->getTitle();
            $images = $imagesRepository->findBy(['show_name' => $postOneManShowTitle]);
            foreach ($images as $image) {
                $entityManager->remove($image);
            }
            $comments = $commentsRepository->findBy(['show_name' => $postOneManShowTitle]);
            foreach ($comments as $comment) {
                $entityManager->remove($comment);
            }

            $entityManager->remove($postOneManShow);
            $entityManager->flush();
        }

        return $this->redirectToRoute('post_one_man_show_index');
    }
}
