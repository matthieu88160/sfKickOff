<?php
namespace Vesperia\TrainingBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class TrainingController extends Controller
{
    public function helloWorldAction(){
        
       return  $this->render(
            "VesperiaTrainingBundle:Training:hello_world.html.twig",
           $this->get("vesperia.hello_provider")->provideArguments()
        );
    }
}

