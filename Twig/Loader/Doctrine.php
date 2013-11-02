<?php

namespace Emarref\Bundle\TwigDoctrineLoaderBundle\Twig\Loader;

use Doctrine\ORM\EntityManager;
use Twig_LoaderInterface;
use Doctrine\ORM\NoResultException;

class Doctrine implements Twig_LoaderInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entity_manager)
    {
        $this->entityManager = $entity_manager;
    }

    /**
     * {@inheritdoc}
     */
    public function getSource($name)
    {
        $template = $this->getTemplateByName($name);
        
        if (!$template) {
            throw new \Twig_Error_Loader(sprintf('Unable to find database template %s', $name));
        }

        return $template->getContent();
    }

    public function getRepositoryName()
    {
        return 'EmarrefTwigDoctrineLoaderBundle:Template';
    }

    public function getColumn()
    {
        return 'name';
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
        try {
            $template = $this->getTemplateByName($name);
        } catch (NoResultException $ex) {
            throw new Twig_Error_Loader(sprintf('Template "%s" not found by Doctrine.', $name));
        }

        $updated_at = $template->getUpdatedAt()->getTimestamp();

        return $updated_at <= $time;
    }

    protected function getTemplateByName($name)
    {
        $query_builder = $this->entityManager->createQueryBuilder();
        
        $repository_name = $this->getRepositoryName();
        $column = $this->getColumn();

        $query = $query_builder
            ->select('t')
            ->from($repository_name, 't')
            ->where(sprintf('t.%s = :identifier', $column))
            ->setParameter('identifier', $name)
            ->getQuery();

        $template = $query->getSingleResult();

        return $template;
    }
}
