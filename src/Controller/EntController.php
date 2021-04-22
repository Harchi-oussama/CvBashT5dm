<?php

namespace App\Controller;

use App\Entity\Ent;
use App\Form\EntType;
use App\Repository\EntRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @Route("/ent")
 */
class EntController extends AbstractController
{
    /**
     * @Route("/", name="ent_index", methods={"GET"})
     */
    public function index(EntRepository $entRepository): Response
    {
        return $this->render('ent/index.html.twig', [
            'ents' => $entRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ent_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ent = new Ent();
        $form = $this->createForm(EntType::class, $ent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ent);
            $entityManager->flush();

            return $this->redirectToRoute('ent_index');
        }

        return $this->render('ent/new.html.twig', [
            'ent' => $ent,
            'form' => $form->createView(),
        ]);
    }
        /**
     * @Route("/login", name="app_login")
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

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
    /**
     * @Route("/{id}", name="ent_show", methods={"GET"})
     */
    public function show(Ent $ent): Response
    {
        return $this->render('ent/show.html.twig', [
            'ent' => $ent,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ent_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ent $ent): Response
    {
        $form = $this->createForm(EntType::class, $ent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ent_index');
        }

        return $this->render('ent/edit.html.twig', [
            'ent' => $ent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ent_delete", methods={"POST"})
     */
    public function delete(Request $request, Ent $ent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ent->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ent_index');
    }


}
