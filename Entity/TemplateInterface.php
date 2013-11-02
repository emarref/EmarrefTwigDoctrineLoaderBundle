<?php

namespace Emarref\Bundle\TwigDoctrineLoaderBundle\Entity;

interface TemplateInterface
{
    /**
     * Return the template content to be rendered.
     *
     * @return string
     */
    public function getContent();

    /**
     * Return the date/time at which this template was last modified.
     *
     * @return \DateTime
     */
    public function getUpdatedAt();
} 