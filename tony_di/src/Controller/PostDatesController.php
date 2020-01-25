<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Entity\PostDates;
use App\Entity\User;
use App\Form\PostDatesType;
use App\Repository\PostDatesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

/**
 * @Route("/post/dates")
 */
class PostDatesController extends PagesController
{
    /**
     * @Route("/", name="post_dates_index", methods={"GET", "POST"})
     */
    public function index(Request $request, PostDatesRepository $postDatesRepository, TokenGeneratorInterface $tokenGenerator, \Swift_Mailer $mailer): Response
    {
        return $this->newsletter($mailer, $tokenGenerator, $request, 'post_dates/index.html.twig', 'post_dates', $postDatesRepository->findBy(array(), array("startDate" => "ASC")));
    }

    /**
     * @Route("/new/admin", name="post_dates_new", methods={"GET","POST"})
     */
    public function new(Request $request, \Swift_Mailer $mailer): Response
    {
        $postDate = new PostDates();
        $form = $this->createForm(PostDatesType::class, $postDate);
        $form->handleRequest($request);

        $entityManager = $this->getDoctrine()->getManager();
        $emails = [];
        $emailsNewsletter = $entityManager->getRepository(Newsletter::class)->findAll();

        foreach ($emailsNewsletter as $emailNewsletter) {
            $emails[] = $emailNewsletter->getEmail();
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($postDate);
            $entityManager->flush();

            if ($postDate->getStartDate() == $postDate->getEndDate()) {
                $message = (new \Swift_Message('Une nouvelle date de spectacle a été publiée'))
                    ->setFrom('meganeberthelot@tonydi.meganeberthelot.fr')
                    ->setBcc($emails)
                    ->setBody("Tony DI vient de publier une nouvelle date à " . $postDate->getLieu() . " concernant le spectacle " . $postDate->getSpectacle() . " le " . $postDate->getStartDate()->format('d/m/Y à H:i') . ". Pour ne rien manquer, retrouvez toutes ses dates de spectacle en cliquant sur le lien suivant : http://localhost/git_tony/tony_di/tony_di/public/post/dates/ \n Si vous ne souhaitez plus recevoir d'emails, cliquez sur le lien suivant : http://localhost/git_tony/tony_di/tony_di/public/stopReceivingEmails/",
                        'text/html'
                    );
            } else {
                $message = (new \Swift_Message('Des nouvelles dates de spectacle ont été publiées'))
                    ->setFrom('meganeberthelot@tonydi.meganeberthelot.fr')
                    ->setBcc($emails)
                    ->setBody("Tony DI vient de publier des nouvelles dates à " . $postDate->getLieu() . " concernant le spectacle " . $postDate->getSpectacle() . " du " . $postDate->getStartDate()->format('d/m/Y') . " au " . $postDate->getEndDate()->format('d/m/Y à H:i') . ". Pour ne rien manquer, retrouvez toutes ses dates de spectacle en cliquant sur le lien suivant : http://localhost/git_tony/tony_di/tony_di/public/post/dates/ \n Si vous ne souhaitez plus recevoir d'emails, cliquez sur le lien suivant : http://localhost/git_tony/tony_di/tony_di/public/stopReceivingEmails/",
                "text/html"
                    );
            }
            $mailer->send($message);

            return $this->redirectToRoute('post_dates_index');
        }

        return $this->render('post_dates/new.html.twig', [
            'post_date' => $postDate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit/admin", name="post_dates_edit", methods={"GET","POST"})
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
     * @Route("/{id}/admin", name="post_dates_delete", methods={"DELETE"})
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
