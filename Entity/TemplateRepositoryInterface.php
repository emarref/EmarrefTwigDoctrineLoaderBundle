<?php

namespace Emarref\Bundle\TwigDoctrineLoaderBundle\Entity;

interface TemplateRepositoryInterface
{
    /**
     * Given a template name, return an instance of the template entity.
     *
     * @param string $name
     * @return TemplateInterface
     */
    public function getTemplateByName($name);
} 