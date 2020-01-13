<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Entity\User;
use App\Form\NewsletterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class PagesController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @Route("/homepage", name="homepage")
     */
    public function indexHomepage(Request $request, TokenGeneratorInterface $tokenGenerator, \Swift_Mailer $mailer): Response
    {
        return $this->newsletter($mailer, $tokenGenerator, $request, "pages/index.html.twig");
    }

    /**
     * @Route("/presentation", name="presentation")
     */
    public function presentation(Request $request, TokenGeneratorInterface $tokenGenerator, \Swift_Mailer $mailer) {
        return $this->newsletter($mailer, $tokenGenerator, $request, "pages/presentation.html.twig");
    }

    /**
     * @Route("/mentions_legales", name="legal_notice")
     */
    public function legalNotice(Request $request, TokenGeneratorInterface $tokenGenerator, \Swift_Mailer $mailer) {
        return $this->newsletter($mailer, $tokenGenerator, $request, "pages/legal_notice.html.twig");
    }

    /**
     * @Route("/footer", name="footer")
     */
    public function newsletter(\Swift_Mailer $mailer, TokenGeneratorInterface $tokenGenerator, Request $request, $page, $option = null, $variable = null, $option2 = null, $variable2 = null, $option3 = null, $variable3 = null) {
        if ($request->isMethod('POST')) {
            $entityManager = $this->getDoctrine()->getManager();
            $newsletter = $entityManager->getRepository(Newsletter::class);
            $emailNewsletter = $newsletter->findOneBy(['email' => $_POST['emailNewsletter']]);

            if (!isset($emailNewsletter) || $emailNewsletter->getEmail() != $_POST['emailNewsletter']) {
                $newsletter = new Newsletter();
                $entityManager = $this->getDoctrine()->getManager();
                $newsletter->setEmail($_POST['emailNewsletter']);

                $token = $tokenGenerator->generateToken();
                $url = $this->generateUrl('checkEmail', array('email' => $_POST['emailNewsletter'], 'token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);

                $message = (new \Swift_Message("Confirmation de l'adresse mail"))
                    ->setFrom('meganeberthelot@tonydi.meganeberthelot.fr')
                    ->setBcc($_POST['emailNewsletter'])
                    ->setBody("Merci de cliquer sur le lien suivant pour confirmer votre adresse email : " . $url,
                        'text/html'
                    );

                $mailer->send($message);

                return $this->redirectToRoute('homepage');
            }
        }

        return $this->render($page, [
            $option => $variable,
            $option2 => $variable2,
            $option3 => $variable3,
        ]);
    }

    /**
     * @Route("/check_email/{email}/{token}", name="checkEmail")
     */
    public function checkEmail(Request $request, string $token, $email) {
        $newsletter = new Newsletter();
        $newsletter->setEmail($email);
        var_dump($email);
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
        if (isset($user)) {
            $user->setReceiveEmails(1);
        }
        $entityManager->persist($newsletter);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }
}
