<?php

namespace AppBundle\Entity;

/**
 * Competence
 */
class Competence
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var bool
     */
    private $isInfo;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Competence
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set isInfo
     *
     * @param boolean $isInfo
     *
     * @return Competence
     */
    public function setIsInfo($isInfo)
    {
        $this->isInfo = $isInfo;

        return $this;
    }

    /**
     * Get isInfo
     *
     * @return bool
     */
    public function getIsInfo()
    {
        return $this->isInfo;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $stagiaires;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->stagiaires = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add stagiaire
     *
     * @param \AppBundle\Entity\Stagiaire $stagiaire
     *
     * @return Competence
     */
    public function addStagiaire(\AppBundle\Entity\Stagiaire $stagiaire)
    {
        $this->stagiaires[] = $stagiaire;

        return $this;
    }

    /**
     * Remove stagiaire
     *
     * @param \AppBundle\Entity\Stagiaire $stagiaire
     */
    public function removeStagiaire(\AppBundle\Entity\Stagiaire $stagiaire)
    {
        $this->stagiaires->removeElement($stagiaire);
    }

    /**
     * Get stagiaires
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStagiaires()
    {
        return $this->stagiaires;
    }

    public function __toString()
    {
       return $this->type;
    }
}
