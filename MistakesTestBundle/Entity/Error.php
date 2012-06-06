<?php

namespace Mistakes\MistakesTestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mistakes\MistakesTestBundle\Entity\Error
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Error
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $ab_id
     *
     * @ORM\Column(name="ab_id", type="integer")
     */
    private $ab_id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer $cont
     *
     * @ORM\Column(name="cont", type="integer")
     */
    private $cont;


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
     * Set ab_id
     *
     * @param integer $abId
     */
    public function setAbId($abId)
    {
        $this->ab_id = $abId;
    }

    /**
     * Get ab_id
     *
     * @return integer 
     */
    public function getAbId()
    {
        return $this->ab_id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * Set cont
     *
     * @param integer $cont
     */
    public function setCont($cont)
    {
        $this->cont = $cont;
    }

    /**
     * Get cont
     *
     * @return integer 
     */
    public function getCont()
    {
        return $this->cont;
    }
}