<?php

namespace DonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Affectation
 *
 * @ORM\Table(name="affectation")
 * @ORM\Entity(repositoryClass="DonBundle\Repository\AffectationRepository")
 */
class Affectation
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
     * @ORM\ManyToOne(targetEntity="CampBundle\Entity\Camp" , inversedBy="affectations")
     * @ORM\JoinColumn(name="camp_id",referencedColumnName="id")
     */
    private $camps ;

    /**
     * @return mixed
     */
    public function getCamps()
    {
        return $this->camps;
    }

    /**
     * @param mixed $camps
     */
    public function setCamps($camps)
    {
        $this->camps = $camps;
    }



    /**
     * @ORM\OneToOne(targetEntity="Equipment" , mappedBy="affectation")
     */
    private $equipement ;
    /**
     * @ORM\OneToOne(targetEntity="Argent" , mappedBy="affectation")
     */
    private $argent ;

    /**
     * @return mixed
     */
    public function getArgent()
    {
        return $this->argent;
    }

    /**
     * @param mixed $argent
     */
    public function setArgent($argent)
    {
        $this->argent = $argent;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Service" , inversedBy="services")
     * @ORM\JoinColumn(name="service_id",referencedColumnName="id")
     */
    private $service ;


    /**
     * @return ArrayCollection
     */
    public function getAffectations()
    {
        return $this->affectations;
    }

    /**
     * @param ArrayCollection $affectations
     */
    public function setAffectations($affectations)
    {
        $this->affectations = $affectations;
    }

    /**
     * @return mixed
     */
    public function getEquipement()
    {
        return $this->equipement;
    }

    /**

       * @param mixed $equipement

     */
    public function setEquipement($equipement)
    {
        $this->equipement = $equipement;
    }

    /**
     * @return mixed
     *
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     *
     * * @param mixed $service

     */
    public function setService($service)
    {
        $this->service = $service;
    }


    public function __construct()
    {
        $this->refugies=new ArrayCollection();
        $this->affectations=new ArrayCollection();
        $this->equipements=new ArrayCollection();
    }



    /**
     * @var string
     *
     * @ORM\Column(name="remarqueAffectation", type="text")
     */
    private $remarqueAffectation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAffectation", type="datetime")
     */
    private $dateAffectation;


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
     * Set remarqueAffectation
     *
     * @param string $remarqueAffectation
     *
     * @return Affectation
     */
    public function setRemarqueAffectation($remarqueAffectation)
    {
        $this->remarqueAffectation = $remarqueAffectation;

        return $this;
    }

    /**
     * Get remarqueAffectation
     *
     * @return string
     */
    public function getRemarqueAffectation()
    {
        return $this->remarqueAffectation;
    }

    /**
     * Set dateAffectation
     *
     * @param \DateTime $dateAffectation
     *
     * @return Affectation
     */
    public function setDateAffectation($dateAffectation)
    {
        $this->dateAffectation = $dateAffectation;

        return $this;
    }

    /**
     * Get dateAffectation
     *
     * @return \DateTime
     */
    public function getDateAffectation()
    {
        return $this->dateAffectation;
    }
}

