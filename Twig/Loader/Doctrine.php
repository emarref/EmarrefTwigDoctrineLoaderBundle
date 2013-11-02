<?php

namespace Emarref\Bundle\TwigDoctrineLoaderBundle\Twig\Loader;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManager;
use Twig_LoaderInterface;
use Doctrine\ORM\NoResultException;

class Doctrine implements Twig_LoaderInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var ObjectRepository
     */
    private $repository;

    /**
     * @var string
     */
    private $nameColumn;

    public function __construct(EntityManager $entity_manager)
    {
        $this->entityManager = $entity_manager;
    }

    /**
     * @param string $repository
     */
    public function setRepository($repository)
    {
        $this->repository = $this->entityManager->getRepository($repository);
    }

    /**
     * @return ObjectRepository
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param string $name_column
     */
    public function setNameColumn($name_column)
    {
        $this->nameColumn = $name_column;
    }

    /**
     * @return string
     */
    public function getNameColumn()
    {
        return $this->nameColumn;
    }

    /**
     * Return the template entity identified by the template name.
     *
     * @param string $name
     * @throws \Twig_Error_Loader
     * @return mixed
     */
    protected function getTemplateByName($name)
    {
        $query_builder = $this->getRepository()->createQueryBuilder('t');

        $query = $query_builder
            ->select('t')
            ->where(sprintf('t.%s = :identifier', $this->getNameColumn()))
            ->setParameter('identifier', $name)
            ->getQuery();

        try {
            $template = $query->getSingleResult();
        } catch (NoResultException $ex) {
            throw $this->getTemplateNotFoundException($name);
        }

        return $template;
    }

    protected function getTemplateNotFoundException($name)
    {
        return new \Twig_Error_Loader(sprintf('Doctrine was unable to find template "%s" by column "%s"', $name, $this->getNameColumn()));
    }

    /**
     * {@inheritdoc}
     */
    public function getSource($name)
    {
        $template = $this->getTemplateByName($name);

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
        $template = $this->getTemplateByName($name);

        $updated_at = $template->getUpdatedAt()->getTimestamp();

        return $updated_at <= $time;
    }
}
