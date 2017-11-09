<?php
namespace Vesperia\TrainingBundle\Util\Provider;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Vesperia\TrainingBundle\Entity\ConnectionLog;
use Symfony\Component\EventDispatcher\GenericEvent;

class ClientLogger
{
    private $doctrine;
    
    private $clientIp;
    
    public function __construct(Registry $doctrine, $clientIp)
    {
        $this->doctrine = $doctrine;
        $this->clientIp = $clientIp;
    }
    
    public function provide(GenericEvent $event)
    {
        $log = new ConnectionLog($this->clientIp);
        
        $manager = $this->doctrine->getManager($this->doctrine->getDefaultManagerName());
        $manager->persist($log);
        $manager->flush();
        
        $repository = $manager->getRepository(ConnectionLog::class); 
        $lastConnections = $repository->findByClientIp($this->clientIp);
        $event->setArgument('lastConnections', $lastConnections);
    }
}

