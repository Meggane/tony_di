<?php

namespace App\Controller;

use App\Entity\Newsletter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends PagesController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }

    /**
     * @Route("/forgottenPassword", name="app_forgotten_password")
     */
    public function forgottenPassword(
        Request $request,
        UserPasswordEncoderInterface $encoder,
        \Swift_Mailer $mailer,
        TokenGeneratorInterface $tokenGenerator
    ): Response
    {

        if ($request->isMethod('POST')) {

            $email = $request->request->get('email');

            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->findOneByEmail($email);
            /* @var $user User */

            if ($user === null) {
                $this->addFlash('danger', 'Email Inconnu');
                return $this->redirectToRoute('app_forgotten_password');
            }
            $token = $tokenGenerator->generateToken();

            try{
                $user->setResetToken($token);
                $entityManager->flush();
            } catch (\Exception $e) {
                $this->addFlash('warning', $e->getMessage());
                return $this->redirectToRoute('homepage');
            }

            $url = $this->generateUrl('app_reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);

            $message = (new \Swift_Message('Forgot Password'))
                ->setFrom('meganeberthelot@tonydi.meganeberthelot.fr')
                ->setTo($user->getEmail())
                ->setBody(
                    "Cliquez sur le lien pour réinitialiser votre mot de passe : " . $url,
                    'text/html'
                );

            $mailer->send($message);

            $this->addFlash('notice', 'Mail envoyé');

            return $this->redirectToRoute('homepage');
        }

        return $this->render('security/forgotten_password.html.twig');
    }

    /**
     * @Route("/reset_password/{token}", name="app_reset_password")
     */
    public function resetPassword(Request $request, string $token, UserPasswordEncoderInterface $passwordEncoder)
    {

        if ($request->isMethod('POST')) {
            $entityManager = $this->getDoctrine()->getManager();

            $user = $entityManager->getRepository(User::class)->findOneByResetToken($token);
            /* @var $user User */

            if ($user === null) {
                $this->addFlash('danger', 'Token Inconnu');
                return $this->redirectToRoute('homepage');
            }

            $user->setResetToken(null);
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
            $entityManager->flush();

            $this->addFlash('notice', 'Mot de passe mis à jour');



            return $this->redirectToRoute('homepage');
        } else {

            return $this->render('security/reset_password.html.twig', ['token' => $token]);
        }

    }

    /**
     * @Route("/remove_user/profile", name="remove_user")
     */
    public function removeUser(Request $request): Response {
        $entityManager = $this->getDoctrine()->getManager();

        $users = $entityManager->getRepository(User::class);
        $id = $this->getUser()->getId();
        $email = $this->getUser()->getEmail();
        $user = $users->find($id);

        $newsletter = $entityManager->getRepository(Newsletter::class);
        $emailNewsletter = $newsletter->findOneBy(['email' => $email]);
        if (isset($emailNewsletter)) {
            $getEmailNewsletter = $emailNewsletter->getEmail();
            if ($email == $getEmailNewsletter) {
                $idEmail = $emailNewsletter->getId();
                $emailNewsletterRemove = $newsletter->find($idEmail);

                $entityManager->remove($emailNewsletterRemove);
            }
        }

        session_destroy();

        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/mon_compte/profile", name="change_password")
     */
    public function changePassword(Request $request, UserPasswordEncoderInterface $passwordEncoder, TokenGeneratorInterface $tokenGenerator, \Swift_Mailer $mailer)
    {
        if ($request->isMethod('POST')) {
            $entityManager = $this->getDoctrine()->getManager();

            $id = $this->getUser()->getId();
            $user = $entityManager->getRepository(User::class)->find($id);
            /* @var $user User */

            if (isset($_POST['password']) && $_POST['password'] == $_POST['confirm_password']) {
                $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
                $entityManager->flush();

                $this->addFlash('notice', 'Mot de passe mis à jour');

                return $this->redirectToRoute('homepage');
            } else {
                return $this->redirectToRoute('change_password');
            }
        }

        return $this->newsletter($mailer, $tokenGenerator, $request, 'security/change_password.html.twig');
    }

    /**
     * @Route("/changer_email/profile", name="change_email")
     */
    public function changeEmail(Request $request, TokenGeneratorInterface $tokenGenerator, \Swift_Mailer $mailer) {
        if ($request->isMethod('POST')) {
            $entityManager = $this->getDoctrine()->getManager();

            $id = $this->getUser()->getId();
            $user = $entityManager->getRepository(User::class)->find($id);
            $email = $this->getUser()->getEmail();
            $usersEmails = $entityManager->getRepository(User::class)->findAll();
            $newsletter = $entityManager->getRepository(Newsletter::class)->findOneBy(['email' => $email]);
            /* @var $user User */
            foreach ($usersEmails as $userEmail) {
                $emails = $userEmail->getEmail();
                if (isset($_POST['email']) && $_POST['email'] != $email && $_POST['email'] != $emails) {
                    $user->setEmail($_POST['email']);
                    if ($user->getReceiveEmails() == 1) {
                        $newsletter->setEmail($_POST['email']);
                    }
                    $entityManager->flush();
                    $this->addFlash('notice', 'Email mis à jour');

                    return $this->redirectToRoute('homepage');
                } else {
                    return $this->redirectToRoute('change_email');
                }
            }
        }

        return $this->newsletter($mailer, $tokenGenerator, $request, 'email/change_email.html.twig');
    }

    /**
     * @Route("/stopReceivingEmails", name="stop_receiving_emails")
     */
    public function checkToStopEmails(Request $request) {
        if ($request->isMethod("POST")) {
            $email = $_POST['email'];
            $entityManager = $this->getDoctrine()->getManager();
            $emailsNewsletter = $entityManager->getRepository(Newsletter::class);
            $emailToStop = $emailsNewsletter->findOneBy(['email' => $email]);
            $idEmail = $emailToStop->getId();

            if ($email == $emailToStop->getEmail()) {

                return $this->redirectToRoute('stop_emails', [
                    'email' => $email,
                ]);
            }
        }

        return $this->render('email/stopReceivingEmails.html.twig');
    }

    /**
     * @Route("/stopReceivingEmails/{email}", name="stop_emails")
     */
    public function stopReceivingEmails(string $email) {
        $entityManager = $this->getDoctrine()->getManager();

        $users = $entityManager->getRepository(User::class);
        $userToStop = $users->findOneBy(['email' => $email]);

        $emailsNewsletter = $entityManager->getRepository(Newsletter::class);
        $emailToStop = $emailsNewsletter->findOneBy(['email' => $email]);
        $idEmail = $emailToStop->getId();

        if ($email == $emailToStop->getEmail()) {
            if (isset($userToStop) && $email == $userToStop->getEmail()) {
                $userToStop->setReceiveEmails("0");
            }
            $newsletterToStop = $emailsNewsletter->find($idEmail);
            $entityManager->remove($newsletterToStop);
            $entityManager->flush();
        }

        return $this->redirectToRoute('homepage');
    }
}
