<?php
namespace Vesperia\TrainingBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;


class VesperiaTrainingExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        
        $container->setParameter('vesperia_training.text', $config['text']);
        $container->setParameter('vesperia_training.title', $config['title']);
        $container->setParameter('vesperia_training.range.min', $config['range']['min']);
        $container->setParameter('vesperia_training.range.max', $config['range']['max']);
        
        $locator= new FileLocator(__DIR__.'/../Resources/config');
        $loader = new YamlFileLoader($container,$locator);
        $loader->load('services.yml');
    }
}

