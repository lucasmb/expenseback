<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController 
{
     /**
     * @Route("/", name="app_home")
     */
    public function index() {
        return new Response('TestController');
    }

    /**
     * @Route("/users/{username}", name="app_show")
     */
    public function show($username) {

        return $this->render('user/show.html.twig', [
            'username' => $username
        ]);
    }
}


