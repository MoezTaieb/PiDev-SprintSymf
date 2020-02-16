<?php

namespace DonBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CategorieService
 *
 * @ORM\Table(name="categorie_service")
 * @ORM\Entity(repositoryClass="DonBundle\Repository\CategorieServiceRepository")
 */
class CategorieService
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Service" , mappedBy="categorieService")
     */
    private $services ;

    /**
     * @return ArrayCollection
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * @param ArrayCollection $services
     */
    public function setServices($services)
    {
        $this->services = $services;
    }


    public function __construct()
    {
        $this->services=new ArrayCollection();


    }


    /**
     * @var string
     *
     * @ORM\Column(name="nomCategorie", type="string", length=255)
     */
    private $nomCategorie;


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
     * Set nomCategorie
     *
     * @param string $nomCategorie
     *
     * @return CategorieService
     */
    public function setNomCategorie($nomCategorie)
    {
        $this->nomCategorie = $nomCategorie;

        return $this;
    }

    /**
     * Get nomCategorie
     *
     * @return string
     */
    public function getNomCategorie()
    {
        return $this->nomCategorie;
    }

    public function __toString()
    {
        return $this->nomCategorie;
    }
}

