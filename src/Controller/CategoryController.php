<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category", name="category_")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();

        $entities = $manager->getRepository(Category::class)->findAll();

        $category = new Category;
        $formCategory = $this->createForm(CategoryType::class, $category,
            [
                'action' => $this->generateUrl('category_create')
            ]
        );

        $entities = $manager->getRepository(Category::class)->findAll();

        return $this->render('category/list.html.twig', [
            'entities' => $entities,
            'form' => $formCategory->createView(),
            'controller_name' => 'CategoryController',
        ]);
    }


    /* ANCIEN
     * @Route("/create", name="create", methods={"GET","HEAD"})
     */
    /**
     * @Route("/create", name="create", methods={"POST","PUT"})
     */
    public function create(Request $request)
    {

        $name = $request->get('category')['name'];

        $category = new Category;
        $category->setName($name);

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($category);
        $manager->flush();

        return new Response('OK', 200, []);



        /*
        $manager = $this->getDoctrine()->getManager();

        $category = new Category;
        $formCategory = $this->createForm(CategoryType::class, $category,
            [
                'action' => $this->generateUrl('category_create')
            ]
        );

        $categories = $manager->getRepository(Category::class)->findAll();
        */

//        $formCategory->handleRequest($request);
        /*if ($formCategory->isSubmitted() && $formCategory->isValid()) {
            $manager->persist($category);
            $manager->flush();
        }

        return $this->render('category/form.html.twig', [
            'entities' => $categories,
            'form' => $formCategory->createView(),
            'controller_name' => 'CategoryController',
        ]);*/
    }


    /*
     * @Route("/create", name="store", methods={"POST","PATCH","PUT"})
     */
    /*public function store()
    {
    }*/


    /**
     * @Route("/edit", name="edit", methods={"GET","HEAD"})
     */
    public function edit()
    {
        return $this->render('category/form.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }


    /**
     * @Route("/edit", name="update", methods={"POST","PUT"})
     */
    public function update()
    {
        return $this->render('category/form.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }
}
