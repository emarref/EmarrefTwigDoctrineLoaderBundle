<?php

namespace Emarref\Bundle\TwigDoctrineLoaderBundle\Twig\Loader;

use Doctrine\ORM\EntityManager;
use Twig_LoaderInterface;

class Doctrine implements Twig_LoaderInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    function __construct(EntityManager $entity_manager)
    {
        $this->entityManager = $entity_manager;
    }

    /**
     * {@inheritdoc}
     */
    public function getSource($name)
    {
        $template = $this->entityManager
            ->getRepository('EmarrefTwigDoctrineLoaderBundle:Template')
            ->findOneBy(array('name' => $name));

        if (!$template) {
            throw new \Twig_Error_Loader(sprintf('Unable to find database template %s', $name));
        }

        return $template->getContent();
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheKey($name)
    {
        return $name;
    }

    /**
     * {@inheritdoc}
     */
    public function isFresh($name, $time)
    {
        return false;
    }
}
