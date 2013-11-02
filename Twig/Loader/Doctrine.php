<?php

namespace Emarref\Bundle\TwigDoctrineLoaderBundle\Twig\Loader;

use Doctrine\ORM\EntityManager;
use Emarref\Bundle\TwigDoctrineLoaderBundle\Entity\TemplateInterface;
use Emarref\Bundle\TwigDoctrineLoaderBundle\Entity\TemplateRepositoryInterface;
use Twig_LoaderInterface;
use Doctrine\ORM\NoResultException;

class Doctrine implements Twig_LoaderInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var TemplateRepositoryInterface
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
     * @param string $repository_name
     */
    public function setRepositoryByName($repository_name)
    {
        $repository = $this->entityManager->getRepository($repository_name);

        $this->setRepository($repository);
    }

    public function setRepository(TemplateRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return TemplateRepositoryInterface
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
     * @return TemplateInterface
     */
    protected function getTemplateByName($name)
    {
        try {
            $template = $this->getRepository()->getTemplateByName($name);
        } catch (NoResultException $ex) {
            throw $this->getTemplateNotFoundException($name);
        }

        return $template;
    }

    /**
     * @param string $name
     * @return \Twig_Error_Loader
     */
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
