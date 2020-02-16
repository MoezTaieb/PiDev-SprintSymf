<?php

namespace DonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Argent
 *
 * @ORM\Table(name="argent")
 * @ORM\Entity(repositoryClass="DonBundle\Repository\ArgentRepository")
 */
class Argent
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User" , inversedBy="argentDon")
     * @ORM\JoinColumn(name="donneur_id",referencedColumnName="id")
     */
    private $donneur ;



    /**
     * @ORM\OneToMany(targetEntity="Demande" , mappedBy="argent")
     */
    private $demandes;

    /**
     * @ORM\OneToOne(targetEntity="EventBundle\Entity\Participation" , inversedBy="argent")
     * @ORM\JoinColumn(name="paticipation_id",referencedColumnName="id")
     */
    private $participation ;

    /**
     * @return mixed
     */
    public function getParticipation()
    {
        return $this->participation;
    }

    /**
     * @param mixed $participation
     */
    public function setParticipation($participation)
    {
        $this->participation = $participation;
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

    /**
     * @ORM\OneToOne(targetEntity="Affectation" , inversedBy="agrent")
     * @ORM\JoinColumn(name="affectation_id",referencedColumnName="id")
     */
    private $affectation ;

    public function __construct()
    {
        $this->demandes=new ArrayCollection();

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
     * @var float
     *
     * @ORM\Column(name="montant", type="float")
     */
    private $montant;

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
     * Set montant
     *
     * @param float $montant
     *
     * @return Argent
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return float
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set dateDon
     *
     * @param \DateTime $dateDon
     *
     * @return Argent
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

