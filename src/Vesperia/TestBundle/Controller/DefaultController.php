<?php

namespace Vesperia\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('VesperiaTestBundle:Default:index.html.twig');
    }
}
