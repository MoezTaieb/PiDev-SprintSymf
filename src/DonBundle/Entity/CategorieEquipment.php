<?php

namespace DonBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CategorieEquipment
 *
 * @ORM\Table(name="categorie_equipment")
 * @ORM\Entity(repositoryClass="DonBundle\Repository\CategorieEquipmentRepository")
 */
class CategorieEquipment
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
     * @ORM\OneToMany(targetEntity="Equipment" , mappedBy="categorieEquipment")
     */
    private $equipments ;

    /**
     * @return ArrayCollection
     */
    public function getEquipments()
    {
        return $this->equipments;
    }

    /**
     * @param ArrayCollection $equipments
     */
    public function setEquipments($equipments)
    {
        $this->equipments = $equipments;
    }


    public function __construct()
    {
        $this->refugies=new ArrayCollection();
        $this->affectations=new ArrayCollection();
        $this->equipments=new ArrayCollection();

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
     * @return CategorieEquipment
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

