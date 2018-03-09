<?php
/**
 * Created by PhpStorm.
 * User: Aleck
 * Date: 25/10/2017
 * Time: 08:53
 */
namespace BT\AdminBundle\Controller;
use BT\NaoBundle\Entity\Post;
use BT\NaoBundle\Form\PostType;
use BT\UserBundle\Form\EditPasswordType;
use BT\UserBundle\Form\EditUserType;
use BT\UserBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
/**
 * @Route("/dashboard")
 * Class AdminController
 * @package BT\AdminBundle\Controller
 */
class AdminController extends Controller
{
    /**
     * @Route("/", name="dashboard")
     */
    public function homeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user_id = $user = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $myObservations = $em->getRepository('BTNaoBundle:Observation')->myObservations($user_id);
        $naturalisteCount = $em->getRepository('BTUserBundle:User')->countToValidate();
        $toValid = $em->getRepository('BTNaoBundle:Observation')->countToValidate();
        $refuse = $em->getRepository('BTNaoBundle:Observation')->countRefuse($user_id);
        $noconfirm = $em->getRepository('BTNaoBundle:Observation')->countNoConfirm($user_id);
        $confirm = $em->getRepository('BTNaoBundle:Observation')->countConfirm($user_id);
        return $this->render('BTAdminBundle:Dashboard:home.html.twig',[
            'observations' => $myObservations,
            'toValid' => $toValid,
            'refuse'=> $refuse,
            'confirm'=> $confirm,
            'naturalisteCount' => $naturalisteCount,
            'noconfirm' => $noconfirm
        ]);
    }
    /**
     * @Route("/to-validate-observation", name="dashboard-to-validate")
     */
    public function toValidateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $observations = $em->getRepository('BTNaoBundle:Observation')->findNoValid();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($observations, $request->query->getInt('page', 1), 1);
        return $this->render('BTAdminBundle:Dashboard:list-observations.html.twig', [
            'observations' => $pagination
        ]);
    }
    /**
     * @Route("/observation/validate/{id}", name="dashboard-validate-observation")
     */
    public function validateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $observation = $em->getRepository('BTNaoBundle:Observation')->find($id);
        $observation->setConfirm(2);
        $em->persist($observation);
        $em->flush();
             $this->addFlash(
            'notice',
              'L\'observation a bien été validée'
        );
        return $this->redirectToRoute('dashboard-to-validate');
    }
    /**
     * @Route("/observation/refuse/{id}", name="dashboard-refuse-observation")
     */
    public function refuseAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $observation = $em->getRepository('BTNaoBundle:Observation')->find($id);
        $observation->setConfirm(3);
        $em->persist($observation);
        $em->flush();
        $this->addFlash('signal', 'L\'observation a bien été refusé');
        return $this->redirectToRoute('dashboard-to-validate');
    }
    /**
     * @Route("/account", name="dashboard-account")
     */
    public function accountAction(Request $request)
    {
        $id = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('BTUserBundle:User')->find($id);
        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($user);
            $em->flush();
            $this->addFlash('success3', 'Vos informations ont été mise à jour.');
            return $this->redirectToRoute('dashboard-account');
        }
        return $this->render('BTAdminBundle:Dashboard:account.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/edit-password", name="dashboard-password")
     */
    public function editPasswordAction(Request $request)
    {
        $id = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('BTUserBundle:User')->find($id);
        $form = $this->createForm(EditPasswordType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $datas = $form->getData();
            $encoder = $this->get('security.encoder_factory')->getEncoder($user);
            $newpassword = $encoder->encodePassword($datas->getNewPassword(), $user->getSalt());
            $user->setPassword($newpassword);
            $em->persist($user);
            $em->flush();
            $this->addFlash('modif1', 'Le mot de passe a bien été modifié');
                return $this->redirectToRoute('dashboard-password');


            }
          
        return $this->render('BTAdminBundle:Dashboard:edit-password.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/blog", name="dashboard-blog")
     */
    public function blogAction()
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('BTNaoBundle:Post')->findAll();
        return $this->render('BTAdminBundle:Admin:blog.html.twig', [
            'posts' => $posts
        ]);
    }
    /**
     * @Route("/blog/add", name="dashboard-blog-add")
     */
    public function addPostAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $post->setDate(new \DateTime('now'));
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $post->setAuthor($user);
            $post->setImageName(uniqid());
            $em->persist($post);
            $em->flush();
        $this->addFlash('signal', 'L\'article a été publié');
            return $this->redirectToRoute('dashboard-blog');
        }
        return $this->render('BTAdminBundle:Admin:add-blog.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/blog/edit/{id}", name="dashboard-blog-edit")
     */
    public function editPostAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('BTNaoBundle:Post')->find($id);
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
          $post->setDate(new \DateTime('now'));
            $em->persist($post);
            $em->flush();
            $this->addFlash('success', 'L\'article a bien été modifié');
            return $this->redirectToRoute('dashboard-blog');
        }
        return $this->render('BTAdminBundle:Admin:add-blog.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/blog/remove/{id}", name="dashboard-blog-remove")
     */
    public function removePostAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('BTNaoBundle:Post')->find($id);
        $em->remove($post);
        $em->flush();
        $this->addFlash('signal2', 'L\'article a bien été supprimé');
        return $this->redirectToRoute('dashboard-blog');
    }
    /**
     * @Route("/users", name="dashboard-users")
     */
    public function naturalisteToValidateAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('BTUserBundle:User')->findNaturalisteNoConfirm();
        return $this->render('BTAdminBundle:Admin:user.html.twig', [
            'users' => $users
        ]);
    }
    /**
     * @Route("/users/validate/{id}", name="dashboard-users-validate")
     */
    public function naturalisteValidateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('BTUserBundle:User')->find($id);
        $user->setNaturalisteConfirm(true);
        $user->setRoles(['ROLE_NATURALISTE']);
        $em->persist($user);
        $em->flush();
        $this->addFlash('success2', 'L\'utilisateur a bien été validé');
        return $this->redirectToRoute('dashboard-users');
    }
    /**
     * @Route("/users/refuse/{id}", name="dashboard-users-refuse")
     */
    public function naturalisteRefuseAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('BTUserBundle:User')->find($id);
        $user->setNaturalisteConfirm(false);
        $user->setNaturaliste(false);
        $user->setRoles(['ROLE_OBSERVATEUR']);
        $em->persist($user);
        $em->flush();
        $this->addFlash('notice2', 'Le refus a bien été pris en compte');
        return $this->redirectToRoute('dashboard-users');
    }

    /**
    * @Route("/user/delete/{id}", name="dashboard-user-delete")
     */
    public function deleteUserAction($id)
    {
    $em = $this->getDoctrine()->getManager();
    $user = $em->getRepository('BTUserBundle:User')->find($id);
    if ($user->getRoles() !== ['ROLE_ADMIN']) {
        $em->remove($user);
        $em->flush();
        $this->addFlash('success5', 'L\'utilisateur a bien été supprimé');
    }

    return $this->redirectToRoute('dashboard-user');
     }


         /**
     * @Route("/user", name="dashboard-user")
     */
    public function allUserAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('BTUserBundle:User')->findBy(['confirm' => true]);
        return $this->render('BTAdminBundle:Admin:all-user.html.twig', [
            'users' => $users
            ]);
    }


}