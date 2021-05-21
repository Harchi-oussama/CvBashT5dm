<?php

namespace App\Controller;


use App\Entity\CategorieSearch;
use App\Entity\PropertySearch;
use App\Entity\Articles;
use App\Form\ArticlesType;
use App\Form\PropertySearchType;
use App\Form\CategorieSearchType;
use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/articles")
 */
class ArticlesController extends AbstractController
{
    /**
    *@Route("/",name="articles_index")
    */
    public function searchName (Request $request)
    {
    $propertySearch = new PropertySearch();
    $categorieSearch = new CategorieSearch();
    $formCategorie = $this->createForm(CategorieSearchType::class,$categorieSearch);    
    $formCategorie->handleRequest($request);
    $forms = $this->createForm(PropertySearchType::class,$propertySearch);
    $forms->handleRequest($request);



    $articles= [];
    
    if(($forms->isSubmitted() && $forms->isValid()) OR ($formCategorie->isSubmitted() && $formCategorie->isValid())) {

    $nom = $propertySearch->getNom(); 
    $categorie = $categorieSearch->getCategorie();
    if ($nom!="")
    //si on a fourni un nom d'article on affiche tous les articles ayant ce nom
    $articles= $this->getDoctrine()->getRepository(Articles::class)->findBy(['object' => $nom] );
    elseif ($categorie!="")
    //si on a fourni un nom d'article on affiche tous les articles ayant ce nom
    $articles= $this->getDoctrine()->getRepository(Articles::class)->findBy(['entreprise' => $categorie] );

    else 
    //si si aucun nom n'est fourni on affiche tous les articles
    $articles= $this->getDoctrine()->getRepository(Articles::class)->findAll();
    }

    return $this->render('articles/index.html.twig',[ 'form' =>$forms->createView(), 'articles' => $articles, 'forma' =>$formCategorie->createView()]); 
    }

    /**
     * @Route("/new", name="articles_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $article = new Articles();
        $article->setDateCreation(new \DateTime('now'));
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('articles_index');
        }

        return $this->render('articles/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="articles_show", methods={"GET"})
     */
    public function show(Articles $article): Response
    {
        return $this->render('articles/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="articles_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Articles $article): Response
    {
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('articles_index');
        }

        return $this->render('articles/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{id}", name="articles_delete", methods={"POST"})
     */
    public function delete(Request $request, Articles $article): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('articles_index');
    }

    
}
