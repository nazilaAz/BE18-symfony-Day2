<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        $myArray = array(
            'number' => 1, 'text' => 'Hello','name' => 'Nazila','type' => 'string');
        return $this->render('home/index.html.twig', array(
            'myArray'=>$myArray
        ));
    }
}
