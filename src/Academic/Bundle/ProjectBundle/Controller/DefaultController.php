<?php

namespace Academic\Bundle\ProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AcademicProjectBundle:Default:index.html.twig', array('name' => $name));
    }
}
