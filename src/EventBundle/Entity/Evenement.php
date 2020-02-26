<?php

namespace EventBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity(repositoryClass="EventBundle\Repository\EvenementRepository")
 */
class Evenement
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
     * @ORM\OneToMany(targetEntity="Invite" , mappedBy="evenement" )
     */
    private $invites ;

    /**
     * @ORM\OneToMany(targetEntity="Participation" , mappedBy="evenement" )
     */
    private $participations ;

    /**
     * @ORM\OneToMany(targetEntity="DonBundle\Entity\Equipment" , mappedBy="evenement")
     */
    private $equipments ;



    /**
     * @var string
     *
     * @ORM\Column(name="nomEvenement", type="string", length=255)
     * @Assert\NotBlank(message="Nom obligatoire")
     */
    private $nomEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="lieuEvenement", type="string", length=255)
     * @Assert\NotBlank(message="Lieu obligatoire")
     */
    private $lieuEvenement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEvenement", type="datetime")
     *
     */
    private $dateEvenement;

    /**
     * @var int
     *
     * @ORM\Column(name="nombreMaxParticipant", type="integer")
     * @Assert\NotBlank(message="Définir un nombre maximal")
     * @Assert\GreaterThan(value = 10, message = "Minimum du nombre maximal est 10")
     */
    private $nombreMaxParticipant;


    /**
     * @var string
     * @Assert\NotBlank(message="entrer une image")
     * @Assert\Image()
     * @ORM\Column(name="image", type="string", length=255,nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="ProduitBundle\Entity\Produit" )
     * @ORM\JoinColumn(name="id_produit",referencedColumnName="id")
     */
    private $produit;



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


    /**
     * @return mixed
     */
    public function getParticipations()
    {
        return $this->participations;
    }

    /**
     * @param mixed $participations
     */
    public function setParticipations($participations)
    {
        $this->participations = $participations;
    }

    public function __construct()
    {
        /** $this->invites=new ArrayCollection();**/

        $this->participations=new ArrayCollection();
        $this->equipments=new ArrayCollection();

    }

    /**
     * @return mixed
     */
    public function getInvites()
    {
        return $this->invites;
    }

    /**
     * @param mixed $invites
     */
    public function setInvites($invites)
    {
        $this->invites = $invites;
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
     * Set nomEvenement
     *
     * @param string $nomEvenement
     *
     * @return Evenement
     */
    public function setNomEvenement($nomEvenement)
    {
        $this->nomEvenement = $nomEvenement;

        return $this;
    }

    /**
     * Get nomEvenement
     *
     * @return string
     */
    public function getNomEvenement()
    {
        return $this->nomEvenement;
    }

    /**
     * Set lieuEvenement
     *
     * @param string $lieuEvenement
     *
     * @return Evenement
     */
    public function setLieuEvenement($lieuEvenement)
    {
        $this->lieuEvenement = $lieuEvenement;

        return $this;
    }

    /**
     * Get lieuEvenement
     *
     * @return string
     */
    public function getLieuEvenement()
    {
        return $this->lieuEvenement;
    }

    /**
     * Set dateEvenement
     *
     * @param \DateTime $dateEvenement
     *
     * @return Evenement
     */
    public function setDateEvenement($dateEvenement)
    {
        $this->dateEvenement = $dateEvenement;

        return $this;
    }

    /**
     * Get dateEvenement
     *
     * @return \DateTime
     */
    public function getDateEvenement()
    {
        return $this->dateEvenement;
    }

    /**
     * Set nombreMaxParticipant
     *
     * @param integer $nombreMaxParticipant
     *
     * @return Evenement
     */
    public function setNombreMaxParticipant($nombreMaxParticipant)
    {
        $this->nombreMaxParticipant = $nombreMaxParticipant;

        return $this;
    }

    /**
     * Get nombreMaxParticipant
     *
     * @return int
     */
    public function getNombreMaxParticipant()
    {
        return $this->nombreMaxParticipant;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    public function __toString() {
        return $this->getNomEvenement();
    }

    /**
     * @return mixed
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * @param mixed $produit
     */
    public function setProduit($produit)
    {
        $this->produit = $produit;
    }

}

