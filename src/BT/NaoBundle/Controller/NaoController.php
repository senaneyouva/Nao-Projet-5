<?php

namespace BT\NaoBundle\Controller;

use BT\NaoBundle\Entity\Observation;
use BT\NaoBundle\Entity\Post;
use BT\NaoBundle\Form\ContactType;
use BT\NaoBundle\Form\NewsletterType;
use BT\NaoBundle\Form\ObservationType;
use BT\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\EmailValidator;

class NaoController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $observations = $em->getRepository('BTNaoBundle:Observation')->findThreeValid(); // 4 last observations
        return $this->render('BTNaoBundle::index.html.twig', [
           'observations' => $observations
        ]);
    }

    /**
     * @Route("/post", name="blog")
     */
    public function blogAction(Request $request)
    {
       $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('BTNaoBundle:Post')->getBlogPosts();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($posts, $request->query->getInt('page', 1), 4);
        return $this->render('BTNaoBundle:Blog:blog.html.twig', [
            'pagination' => $pagination
        ]);
    }


    /**
     * @Route("/blog/single/{id}", name="blog-single")
     */
    public function singleBlogAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('BTNaoBundle:Post')->find($id);
        $email= $post->getAuthor()->getEmail();
        $email = trim($email);
        $email = strtolower($email);
        $email_hash = md5($email);
        $gravatar = 'http://www.gravatar.com/avatar/' . $email_hash;
        return $this->render('BTNaoBundle:Blog:single.html.twig', [
            'post' => $post,
            'gravatar' => $gravatar
        ]);
    }

    /**
     * @Route("/observation", name="observation")
     */
    public function observationAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $observation = new Observation();
        $observations = $em->getRepository('BTNaoBundle:Observation')->findValid();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($observations, $request->query->getInt('page', 1), 6);
        $form = $this->createForm(ObservationType::class, $observation);
        $form->handleRequest($request);
        $security = $this->get('security.authorization_checker');
        if ($form->isSubmitted() && $form->isValid()) {
            if ($request->request->get('birds')) {
                $idBird = $request->request->get('birds');
                $bird = $em->getRepository('BTNaoBundle:Bird')->find($idBird);
                if (!$bird) {
                    $this->addFlash('error', 'Merci de selectionner un oiseau dans la liste');
                    return $this->redirectToRoute('observation');
                }
                $user = $this->get('security.token_storage')->getToken()->getUser();
                if ($observation->getObservationFile() !== null) {
                    $observation->setObservationName(uniqid());
                }
                if (!$security->isGranted('ROLE_NATURALISTE')) {
                    $observation->setConfirm(1);
                } else {
                    $observation->setConfirm(2);
                }
                $observation->setUser($user);
                $observation->setBird($bird);
                $em->persist($observation);
                $em->flush();
                if (!$security->isGranted('ROLE_NATURALISTE')) {
                    $this->addFlash('success', 'Votre observation à bien été soumise. Elle est en attente de validation.');
                }
                else {
                    $this->addFlash('success', 'Votre observation à bien été enregistré.');

                }
                return $this->redirectToRoute('observation');
            }
            else{
                $this->addFlash('error', 'Merci de selectionner un oiseau dans la liste');
            }

        }
        return $this->render('BTNaoBundle:Nao:observation.html.twig', [
            'form' => $form->createView(),
            'observations' => $pagination
        ]);
    }


    /**
     * @Route("/search", options={"expose"=true}, name="search-bird")
     * @param $id
     * @return Response
     */
    public function searchBirdAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $term = $request->query->get('search');
        $observations = $em->getRepository('BTNaoBundle:Bird')->findBirds($term);
        return new JsonResponse($observations);
    }


    /**
     * @Route("/birds", options={"expose"=true}, name="search-observation")
     */
    public function searchObservationAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $term = $request->query->get('search');
        $birds = $em->getRepository('BTNaoBundle:Observation')->findObservations($term);
        if ($request->query->get('query')) {
            $id = $request->query->get('id');
            $observations = $em->getRepository('BTNaoBundle:Observation')->findValid($id);
            return $this->render('BTNaoBundle:Nao:search-observation.html.twig', [
                'observations' => $observations
            ]);
        }
        return new JsonResponse($birds);
    }


    /**
     * @Route("/observation/single/{id}", name="observation-single")
     */
    public function singleObservationAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $observation = $em->getRepository('BTNaoBundle:Observation')->find($id);
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if ($observation->getConfirm() !== 2 && $user !== $observation->getUser()) {
            return $this->redirectToRoute('observation');
        }
        return $this->render('BTNaoBundle:Nao:single.html.twig', [
            'observation' => $observation
        ]);

    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction(Request $request)
    {
        $form = $this->createForm(ContactType::class, null, [
            'action' => $this->generateUrl('contact'),
            'method' => 'POST'
        ]);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                if ($this->sendEmail($form->getData())) {
                    $this->addFlash('success', 'Le mail a bien été envoyé. Nous vous en remercions.');
                    return $this->redirectToRoute('contact');
                } else {
                    $this->addFlash('error', 'Il y a une erreur.');
                }
            }
        }

        return $this->render('BTNaoBundle:Nao:contact.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @param $data
     * @return mixed
     */
    private function sendEmail($data, $page = null)
    {
        if ($page == 'adherer') {
            $objet = 'Demande d\'adhesion';
        } else {
            $objet = 'Contact - NAO';
        }
        $message = (new \Swift_Message($objet))
            ->setFrom(['nosamislesoiseaux.nao@gmail.com' => 'Nos Amis les oiseaux'])
            ->setTo('nosamislesoiseaux.nao@gmail.com')
            ->setBody($this->renderView('BTNaoBundle:Nao:email.html.twig', [
                'email' => $data['email'],
                'firstname' => $data['firstname'],
                'message' => $data['message']
            ]));

        return $this->get('mailer')->send($message);
    }




    /**
     * @Route("/adherer", name="adherer")
     */
    public function adhererAction(Request $request)
    {
        $form = $this->createForm(ContactType::class, null, [
            'action' => $this->generateUrl('adherer'),
            'method' => 'POST'
        ]);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                if ($this->sendEmail($form->getData(), 'adherer')) {
                    $this->addFlash('success', 'Le message a bien été envoyé. Nous vous en remercions.');
                    return $this->redirectToRoute('adherer');
                } else {
                    $this->addFlash('error', 'Il y a une erreur.');
                }
            }


        }
        return $this->render('BTNaoBundle:Nao:adherer.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/newsletter", name="newsletter")
     */
    public function newsletterAction(Request $request)
    {
        $referer = $request->headers->get('referer');
        $email = $request->query->get('email');
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = (new \Swift_Message('Inscription à la newsletter'))
                ->setFrom(['nosamislesoiseaux.nao@gmail.com' => 'Nos Amis les Oiseaux'])
                ->setTo($email)
                ->setBody($this->renderView('BTNaoBundle:Nao:newsletter.html.twig', [
                    'email' => $email
                ]));
            $this->addFlash('success', 'Votre inscription à la newsletter a bien été pris en compte. Un email vous a été envoyé. Verifiez vos spams.');
            $this->get('mailer')->send($message);
            return $this->redirect($referer);
        }
        else {
          $this->addFlash('error', 'Erreur. Merci d\'inscrire une adresse email valide');
          return $this->redirect($referer);
        }
    }

    /**
     * @Route("/mentions", name="mentions")
     */
    public function mentionAction(Request $request)
    {
       return $this->render('BTNaoBundle::mentions.html.twig');
    }



}
