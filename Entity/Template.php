<?php

namespace Emarref\Bundle\TwigDoctrineLoaderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Template
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Emarref\Bundle\TwigDoctrineLoaderBundle\Entity\TemplateRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity("name")
 */
class Template implements TemplateInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt; 


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Template
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Template
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Template
     */
    public function setCreatedAt(\DateTime $created_at)
    {
        $this->createdAt = $created_at;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Template
     */
    public function setUpdatedAt(\DateTime $updated_at)
    {
        $this->updatedAt = $updated_at;
    
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Returns a string representation of this entity
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Update the created and update timestamps of this entity
     */
    public function touch()
    {
        $now = new DateTime();

        if (!$this->createdAt) {
            $this->setCreatedAt($now);
        }

        $this->setUpdatedAt($now);
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function timestampable()
    {
        $this->touch();
    }
}
