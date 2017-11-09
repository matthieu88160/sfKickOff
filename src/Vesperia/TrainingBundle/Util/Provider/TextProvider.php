<?php
namespace Vesperia\TrainingBundle\Util\Provider;

use Symfony\Component\EventDispatcher\GenericEvent;

class TextProvider
{
    private $text;
    
    public function __construct($text)
    {
        $this->text = $text;
    }
    
    public function provide(GenericEvent $event)
    {
        $event->setArgument('text', $this->text);
    }
}

