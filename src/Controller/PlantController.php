<?php

namespace App\Controller;

use App\Entity\Plant;
use App\Form\PlantType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/plant")
 */
class PlantController extends AbstractController
{
    /**
     * @Route("/", name="plant_index", methods="GET")
     */
    public function index(): Response
    {
        $plants = $this->getDoctrine()
            ->getRepository(Plant::class)
            ->findAll();

        return $this->render('plant/index.html.twig', ['plants' => $plants]);
    }

    /**
     * @Route("/new", name="plant_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $plant = new Plant();
        $form = $this->createForm(PlantType::class, $plant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($plant);
            $em->flush();

            return $this->redirectToRoute('plant_index');
        }

        return $this->render('plant/new.html.twig', [
            'plant' => $plant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="plant_show", methods="GET")
     */
    public function show(Plant $plant): Response
    {
        return $this->render('plant/show.html.twig', ['plant' => $plant]);
    }

    /**
     * @Route("/{id}/edit", name="plant_edit", methods="GET|POST")
     */
    public function edit(Request $request, Plant $plant): Response
    {
        $form = $this->createForm(PlantType::class, $plant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('plant_index', ['id' => $plant->getId()]);
        }

        return $this->render('plant/edit.html.twig', [
            'plant' => $plant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="plant_delete", methods="DELETE")
     */
    public function delete(Request $request, Plant $plant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plant->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($plant);
            $em->flush();
        }

        return $this->redirectToRoute('plant_index');
    }
}
