<?php
/**
 * Created by PhpStorm.
 * User: Aleck
 * Date: 19/10/2017
 * Time: 16:05
 */
namespace BT\UserBundle\Controller;
use BT\UserBundle\Entity\User;
use BT\UserBundle\Form\AskPasswordType;
use BT\UserBundle\Form\ResetType;
use BT\UserBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('dashboard');
        }

        $authenticationUtils = $this->get('security.authentication_utils');
        return $this->render('BTUserBundle:Security:login.html.twig', array(
            'last_username' => $authenticationUtils->getLastUsername(),
            'error'         => $authenticationUtils->getLastAuthenticationError(),
        ));
    }



    /**
     * @Route("/register", name="user_registration")
     */
    public function registerAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('dashboard');
        }
        $em = $this->getDoctrine()->getManager();
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        $encoder = $this->get('security.encoder_factory')->getEncoder($user);
        if ($form->isSubmitted() && $form->isValid()) {
            $email = strtolower(trim($user->getEmail()));
            $email_hash = md5($email);
            $password = $encoder->encodePassword($user->getPlainPassword(), $user->getSalt());
            $user->setPassword($password);
            $user->setRoles(['ROLE_OBSERVATEUR']);
            $user->setConfirmationToken(true);
            $em->persist($user);
            $em->flush();
           $message = (new \Swift_Message('Confirmation de votre inscription'))
                ->setFrom(['nosamislesoiseaux.nao@gmail.com' => 'Nos Amis les Oiseaux'])
                ->setTo($user->getEmail())
                ->setBody($this->renderView('BTUserBundle:Email:register.html.twig', [
                    'user' => $user
                ]));
            $this->get('mailer')->send($message);
            $this->addFlash('notice', 'Un email vous a été envoyé avec un lien de confirmation. Verifiez vos spams.');
            return $this->redirectToRoute('login');
        }
        return $this->render('BTUserBundle:Security:register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/confirmation/{confirmationToken}", name="confirmation")
     */
    public function confirmAction($confirmationToken)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('dashboard');
        }
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('BTUserBundle:User')->findUserByConfirmation($confirmationToken);
        if (!$user) {
          return $this->redirectToRoute('login');
        }
        $user->setConfirm(true);
        $em->persist($user);
        $em->flush();
        $this->addFlash('notice', 'Votre compte a été activé.');
        return $this->redirectToRoute('login');
    }

    /**
     * @Route("/askforgot", name="askforgot")
     */
    public function askForgotAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('dashboard');
        }
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(AskPasswordType::class);
        $form->handleRequest($request);
        if ($request->isMethod('POST') && $form->isSubmitted() && $form->isValid()) {
            $datas = $form->getData();
            $user = $em->getRepository('BTUserBundle:User')->findOneBy(array('email' => $datas['email']));
            if ($user == null) {
                $this->addFlash('error', 'Votre email est introuvable');
                return $this->redirectToRoute('askforgot');
            }
            $user->setForgotToken();
            $em->persist($user);
            $em->flush();
            $message = (new \Swift_Message('Votre demande de reinitialisation'))
                ->setFrom(['nosamislesoiseaux.nao@gmail.com' => 'Nos Amis les Oiseaux'])
                ->setTo($user->getEmail())
                ->setBody($this->renderView('BTUserBundle:Email:forgot.html.twig', [
                    'user' => $user
                ]));
            $this->get('mailer')->send($message);
            $this->addFlash('notice', 'Un email avec un lien de reinitialisation a été envoyé sur votre boite mail. Verifiez vos spams');
            return $this->redirectToRoute('login');
        }

        return $this->render('BTUserBundle:Security:ask-password.html.twig', [
            'form' => $form->createView()
        ]);


    }

    /**
     * @Route("/edit-password/{forgotToken}", name="edit-password")
     */
    public function editPasswordAction(Request $request,$forgotToken)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('dashboard');
        }
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('BTUserBundle:User')->findForgot($forgotToken);
        if (!$user) {
           return $this->redirectToRoute('login');
        }
        $form = $this->createForm(ResetType::class, $user);
        $encoder = $this->get('security.encoder_factory')->getEncoder($user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $encoder->encodePassword($user->getPlainPassword(), $user->getSalt());
            $user->setPassword($password);
            $user->setForgotToken(null);
            $em->persist($user);
            $em->flush();
            $this->addFlash('notice', 'Votre mot de passe a été modifié, vous pouvez désormais vous connecter.');
            return $this->redirectToRoute('login');
        }
        return $this->render('BTUserBundle:Security:reset.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
