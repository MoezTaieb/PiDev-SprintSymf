<?php

namespace DonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="service")
 * @ORM\Entity(repositoryClass="DonBundle\Repository\ServiceRepository")
 */
class Service
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
     * @ORM\OneToMany(targetEntity="Affectation" , mappedBy="services")
     */
    private $affectations ;


    /**
     * @ORM\ManyToOne(targetEntity="CategorieService" , inversedBy="services")
     * @ORM\JoinColumn(name="categorieService_id",referencedColumnName="id")
     */
    private $categorieService ;

    /**
     * @ORM\OneToMany(targetEntity="Demande" , mappedBy="service")
     */
    private $demandes;

    /**
     * @return ArrayCollection
     */
    public function getDemandes()
    {
        return $this->demandes;
    }

    /**
     * @param ArrayCollection $demandes
     */
    public function setDemandes($demandes)
    {
        $this->demandes = $demandes;
    }

    /**
     * @return mixed
     */
    public function getCategorieService()
    {
        return $this->categorieService;
    }

    /**
     * @param mixed $categorieService
     */
    public function setCategorieService($categorieService)
    {
        $this->categorieService = $categorieService;
    }

    public function __construct()
    {
        $this->affectations=new ArrayCollection();
        $this->demandes=new ArrayCollection();

    }

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
     * @var string
     *
     * @ORM\Column(name="nomService", type="string", length=255)
     */
    private $nomService;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionService", type="text")
     */
    private $descriptionService;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDon", type="datetime")
     */
    private $dateDon;


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
     * Set nomService
     *
     * @param string $nomService
     *
     * @return Service
     */
    public function setNomService($nomService)
    {
        $this->nomService = $nomService;

        return $this;
    }

    /**
     * Get nomService
     *
     * @return string
     */
    public function getNomService()
    {
        return $this->nomService;
    }

    /**
     * Set descriptionService
     *
     * @param string $descriptionService
     *
     * @return Service
     */
    public function setDescriptionService($descriptionService)
    {
        $this->descriptionService = $descriptionService;

        return $this;
    }

    /**
     * Get descriptionService
     *
     * @return string
     */
    public function getDescriptionService()
    {
        return $this->descriptionService;
    }

    /**
     * Set dateDon
     *
     * @param \DateTime $dateDon
     *
     * @return Service
     */
    public function setDateDon($dateDon)
    {
        $this->dateDon = $dateDon;

        return $this;
    }

    /**
     * Get dateDon
     *
     * @return \DateTime
     */
    public function getDateDon()
    {
        return $this->dateDon;
    }
}

