<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sale;
use AppBundle\Entity\Search;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Sale controller.
 *
 */
class SaleController extends Controller
{
    /**
     * Lists all sale entities. Check if the searching form is valid and then 
     * filter sales by product field  
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $salesRepository = $em->getRepository('AppBundle:Sale');

        $productsTemp = $em->getRepository('AppBundle:Product')->findAll();

        $products = [];
        
        foreach($productsTemp as $product) {
            $products[$product->getProductname()] = $product->getProductname();
        }

        // Checking if search form was submitted and then filter 
        $search = new Search();
        $form = $this->createForm('AppBundle\Form\SearchType', $search, ["products" => $products]);
        $form->handleRequest($request);

        // Choice if filter or not
        $sales = ($form->isSubmitted() && $form->isValid()) ?
            $salesRepository->findBy(['product' => $search->getProduct()]) : $salesRepository->findAll();

        
        return $this->render('sale/index.html.twig', array(
            'sales' => $sales,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new sale entity.
     *
     */
    public function newAction(Request $request)
    {
        $sale = new Sale();

        $em = $this->getDoctrine()->getManager();

        $productsTemp = $em->getRepository('AppBundle:Product')->findAll();

        $products = [];
        
        foreach($productsTemp as $product) {
            $products[$product->getProductname()] = $product->getProductname();
        }

        $form = $this->createForm('AppBundle\Form\SaleType', $sale, ["products" => $products]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sale->setDate(new \Datetime());
            $em->persist($sale);
            $em->flush();

            return $this->redirectToRoute('_index');
        }

        return $this->render('sale/new.html.twig', array(
            'sale' => $sale,
            'form' => $form->createView(),
        ));
    }

}
