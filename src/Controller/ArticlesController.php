<?php

namespace App\Controller;
use App\Entity\Articles;
use App\Entity\CvUpload;

use App\Form\ArticlesType;
use App\Form\CvUploadType;
use App\Entity\PropertySearch;
use App\Entity\CategorieSearch;
use App\Form\PropertySearchType;
use App\Form\CategorieSearchType;
use App\Repository\ArticlesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

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
    $articles= $this->getDoctrine()->getRepository(Articles::class)->findAll();
    if(($forms->isSubmitted() && $forms->isValid()) OR ($formCategorie->isSubmitted() && $formCategorie->isValid())) {

    $nom = $propertySearch->getNom(); 
    $categorie = $categorieSearch->getCategorie();
    if ($nom!="")
    //si on a fourni un nom d'article on affiche tous les articles ayant ce nom
    $articles= $this->getDoctrine()->getRepository(Articles::class)->findBy(['object' => $nom] );
    elseif ($categorie!="")
    //si on a fourni un catégorie d'article on affiche tous les articles ayant ce catégorie
    $articles= $this->getDoctrine()->getRepository(Articles::class)->findBy(['entreprise' => $categorie] );


    }

    return $this->render('articles/index.html.twig',[ 'form' =>$forms->createView(), 'articles' => $articles, 'forma' =>$formCategorie->createView(), ]); 
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
    public function show(Articles $article , Request $request,SluggerInterface $slugger): Response
    {
        $upload = new CvUpload();
        $form = $this->createForm(CvUploadType::class, $upload);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $cvFile = $form->get('name')->getData();
            if($cvFile){
                $originalFilename = pathinfo($cvFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$cvFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $cvFile->move(
                        $this->getParameter('upload_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $upload->setName($newFilename);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($upload);
            $entityManager->flush();

            return $this->redirectToRoute('articles_postuler');
        } 
        return $this->render('articles/show.html.twig', [
            'article' => $article,
            'formPostuler' => $form->createView(),
            
        ]);
    }

    /**
     * @Route("/{id}/postuler", name="articles_postuler", methods={"GET"})
     */
    public function postuler(Articles $article): Response
    {
        return $this->render('articles/postuler.html.twig', [
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
