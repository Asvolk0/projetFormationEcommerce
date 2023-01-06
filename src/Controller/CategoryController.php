<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoryController extends AbstractController
{

    protected $slugger;
    protected $em;
    protected $categoryRepository;

    public function __construct(SluggerInterface $slugger, EntityManagerInterface $em, CategoryRepository $categoryRepository)
    {
        $this->slugger = $slugger;
        $this->em = $em;
        $this->categoryRepository = $categoryRepository;
    }


    public function renderMenuList(){
        $categories = $this->categoryRepository->findAll();

        return $this->render('category/_menu.html.twig', [
            'category' => $categories
        ]);
    }


    #[Route('/admin/category/{id}/edit', name: 'category_edit')]
    public function edit(CategoryRepository $categoryRepository, $id, Request $request)
    {
        $category = $categoryRepository->findOneBy([
            'id' => $id
        ]);
        
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();

            return $this->redirectToRoute('product_category', [
                'slug' => $category->getSlug()
            ]);
        }


        return $this->render('category/edit.html.twig', [
            'form' => $form->createView(),
            'category' => $category
        ]);
    }

    #[Route('/admin/category/create', name: 'category_create')]
    public function create(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $category->setSlug(strtolower($this->slugger->slug($category->getName())));
            
            $this->em->persist($category);
            $this->em->flush();

            return $this->redirectToRoute('product_category', [
                'slug' => $category->getSlug()
            ]);
        }


        return $this->render('category/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
