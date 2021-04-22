<?php

namespace App\Controller;

use App\Entity\CDT;
use App\Form\CDTType;
use App\Repository\CDTRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class CDTController extends AbstractController
{
    /**
     * @Route("/", name="c_d_t_index", methods={"GET"})
     */
    public function index(CDTRepository $cDTRepository): Response
    {
        return $this->render('home.html.twig', [
            'c_d_ts' => $cDTRepository->findAll(),
        ]);
    }


    /**
     * @Route("/inscriptionChoix")
     */
    public function inscriptionChoix(): Response
    {
        return $this->render('inscriptionChoix.html.twig');
    }
    /**
     * @Route("/loginChoix")
     */
    public function LoginChoix(): Response
    {
        return $this->render('loginChoix.html.twig');
    }

    /**
     * @Route("/new", name="c_d_t_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $cDT = new CDT();
        $form = $this->createForm(CDTType::class, $cDT);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($cDT, $cDT->getPasswordCdt());
            $cDT->setPasswordCdt($hash);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cDT);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('cdt/new.html.twig', [
            'c_d_t' => $cDT,
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/login", name="app_login_cdt")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/loginCdt.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout_cdt")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
    /**
     * @Route("/{id}", name="c_d_t_show", methods={"GET"})
     */
    public function show(CDT $cDT): Response
    {
        return $this->render('cdt/show.html.twig', [
            'c_d_t' => $cDT,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="c_d_t_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CDT $cDT): Response
    {
        $form = $this->createForm(CDTType::class, $cDT);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('c_d_t_index');
        }

        return $this->render('cdt/edit.html.twig', [
            'c_d_t' => $cDT,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="c_d_t_delete", methods={"POST"})
     */
    public function delete(Request $request, CDT $cDT): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cDT->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cDT);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cdt_login');
    }




}
