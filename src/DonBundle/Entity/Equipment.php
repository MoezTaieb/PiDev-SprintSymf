<?php

namespace DonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipment
 *
 * @ORM\Table(name="equipment")
 * @ORM\Entity(repositoryClass="DonBundle\Repository\EquipmentRepository")
 */
class Equipment
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
     * @ORM\OneToOne(targetEntity="Affectation" , inversedBy="equipement")
     * @ORM\JoinColumn(name="affectation_id",referencedColumnName="id")
     */
    private $affectation ;
    /**
     * @ORM\OneToMany(targetEntity="Demande" , mappedBy="equipment")
     */
    private $demandes;

    /**
     * @ORM\ManyToOne(targetEntity="EventBundle\Entity\Evenement" , inversedBy="equipments")
     * @ORM\JoinColumn(name="evenement_id",referencedColumnName="id")
     */
    private $evenement ;

    /**
     * @return mixed
     */
    public function getEvenement()
    {
        return $this->evenement;
    }

    /**
     * @param mixed $evenement
     */
    public function setEvenement($evenement)
    {
        $this->evenement = $evenement;
    }

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
    public function __construct()
    {
        $this->demandes=new ArrayCollection();


    }

    /**
     * @ORM\ManyToOne(targetEntity="CategorieEquipment" , inversedBy="equipments")
     * @ORM\JoinColumn(name="CategorieEquipment_id",referencedColumnName="id")
     */
    private $categorieEquipment;

    /**
     * @return mixed
     */
    public function getCategorieEquipment()
    {
        return $this->categorieEquipment;
    }

    /**
     * @param mixed $categorieEquipment
     */
    public function setCategorieEquipment($categorieEquipment)
    {
        $this->categorieEquipment = $categorieEquipment;
    }

    /**
     * @return mixed
     */
    public function getAffectation()
    {
        return $this->affectation;
    }

    /**
     * @param mixed $affectation
     */
    public function setAffectation($affectation)
    {
        $this->affectation = $affectation;
    }




    /**
     * @var string
     *
     * @ORM\Column(name="nomEquipment", type="string", length=255)
     */
    private $nomEquipment;

    /**
     * @var string
     *
     * @ORM\Column(name="etatEquipment", type="string", length=255)
     */
    private $etatEquipment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDonEquipment", type="datetime")
     */
    private $dateDonEquipment;


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
     * Set nomEquipment
     *
     * @param string $nomEquipment
     *
     * @return Equipment
     */
    public function setNomEquipment($nomEquipment)
    {
        $this->nomEquipment = $nomEquipment;

        return $this;
    }

    /**
     * Get nomEquipment
     *
     * @return string
     */
    public function getNomEquipment()
    {
        return $this->nomEquipment;
    }

    /**
     * Set etatEquipment
     *
     * @param string $etatEquipment
     *
     * @return Equipment
     */
    public function setEtatEquipment($etatEquipment)
    {
        $this->etatEquipment = $etatEquipment;

        return $this;
    }

    /**
     * Get etatEquipment
     *
     * @return string
     */
    public function getEtatEquipment()
    {
        return $this->etatEquipment;
    }

    /**
     * Set dateDonEquipment
     *
     * @param \DateTime $dateDonEquipment
     *
     * @return Equipment
     */
    public function setDateDonEquipment($dateDonEquipment)
    {
        $this->dateDonEquipment = $dateDonEquipment;

        return $this;
    }

    /**
     * Get dateDonEquipment
     *
     * @return \DateTime
     */
    public function getDateDonEquipment()
    {
        return $this->dateDonEquipment;
    }
}

