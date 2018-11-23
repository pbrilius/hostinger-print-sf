<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Plant;

class DisplayController extends AbstractController
{
    /**
     * @Route("/display", name="display")
     */
    public function index()
    {
        $plants = $this->getDoctrine()
            ->getRepository(Plant::class)
            ->findAll();

        return $this->render('display/index.html.twig', [
            'plants' => $plants,
        ]);
    }
}
