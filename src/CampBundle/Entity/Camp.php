<?php

namespace CampBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Camp
 *
 * @ORM\Table(name="camp")
 * @ORM\Entity(repositoryClass="CampBundle\Repository\CampRepository")
 */
class Camp
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
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User" , inversedBy="camp")
     * @ORM\JoinColumn(name="responsable_id",referencedColumnName="id")
     * @Assert\NotBlank(message="Définir le nombre refugier")
     */
    private $responsable ;

    /**
     * @return mixed
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * @param mixed $responsable
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;
    }

    /**
     * toString
     * @return string
     */
    public function __toString()

    {

                return $this->getNomCamp();

    }


    /**
     * @ORM\OneToMany(targetEntity="Refugie" , mappedBy="camp")
     */
    private $refugies ;

    /**
     * @ORM\OneToMany(targetEntity="DonBundle\Entity\Affectation" , mappedBy="camps")
     */
    private $affectations ;


    /**
     * @ORM\OneToMany(targetEntity="DonBundle\Entity\Demande" , mappedBy="camp")
     */
    private $demandes;

    /**
     *
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
       $this->refugies=new ArrayCollection();
        $this->affectations=new ArrayCollection();
        $this->demandes=new ArrayCollection();



    }



    /**
     * @return mixed
     */
    public function getAffectations()
    {
        return $this->affectations;
    }

    /**
     * @param mixed $affectations
     */
    public function setAffectations($affectations)
    {
        $this->affectations = $affectations;
    }

    /**
     * @return ArrayCollection
     */
    public function getRefugies()
    {
        return $this->refugies;
    }

    /**
     * @param ArrayCollection $refugies
     */
    public function setRefugies($refugies)
    {
        $this->refugies = $refugies;
    }


    /**
     * @var string
     *
     * @ORM\Column(name="nomCamp", type="string", length=255)
     * @Assert\NotBlank(message="Définir le nom")
     */
    private $nomCamp;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseCamp", type="string", length=255)
     * @Assert\NotBlank(message="Définir l'adresse")
     */
    private $adresseCamp;


    /**
     * @var int
     *
     * @ORM\Column(name="nbrefugier", type="integer")
     * @Assert\NotBlank(message="Définir le nombre refugier")
     * @Assert\GreaterThan(value = 0, message="le nombre refugier doit étre non null" )
     */
    private $nbrefugier;

    /**
     * @return int
     */
    public function getNbrefugier()
    {
        return $this->nbrefugier;
    }

    /**
     * @param int $nbrefugier
     */
    public function setNbrefugier($nbrefugier)
    {
        $this->nbrefugier = $nbrefugier;
    }


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
     * Set nomCamp
     *
     * @param string $nomCamp
     *
     * @return Camp
     */
    public function setNomCamp($nomCamp)
    {
        $this->nomCamp = $nomCamp;

        return $this;
    }

    /**
     * Get nomCamp
     *
     * @return string
     */
    public function getNomCamp()
    {
        return $this->nomCamp;
    }

    /**
     * Set adresseCamp
     *
     * @param string $adresseCamp
     *
     * @return Camp
     */
    public function setAdresseCamp($adresseCamp)
    {
        $this->adresseCamp = $adresseCamp;

        return $this;
    }

    /**
     * Get adresseCamp
     *
     * @return string
     */
    public function getAdresseCamp()
    {
        return $this->adresseCamp;
    }
}

