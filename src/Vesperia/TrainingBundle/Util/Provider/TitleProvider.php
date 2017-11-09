<?php
namespace Vesperia\TrainingBundle\Util\Provider;

use Symfony\Component\EventDispatcher\GenericEvent;

class TitleProvider
{
    private $title;
    
    public function __construct($title)
    {
        $this->title = $title;
    }
    public function provide(GenericEvent $event)
    {
        $event->setArgument('title', $this->title);
    }
}

