<?php


namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function hompageAction()
    {
        return $this->render('main/hompage.html.twig');
    }
}