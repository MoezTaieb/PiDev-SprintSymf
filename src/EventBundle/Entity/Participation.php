<?php

namespace EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation")
 * @ORM\Entity(repositoryClass="EventBundle\Repository\ParticipationRepository")
 */
class Participation
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User" , inversedBy="participation")
     * @ORM\JoinColumn(name="participant_id",referencedColumnName="id")
     */
    private $participant ;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateParticipation", type="datetime")
     */
    private $dateParticipation;

    /**
     * @ORM\ManyToOne(targetEntity="Evenement" , inversedBy="participations")
     * @ORM\JoinColumn(name="participation_id",referencedColumnName="id")
     */
    private $evenement ;

    /**
     * @ORM\ManyToOne(targetEntity="ProduitBundle\Entity\Produit")
     * @ORM\JoinColumn(name="produit_id",referencedColumnName="id")
     */
    private $produit ;

    /**
     * @ORM\OneToOne(targetEntity="DonBundle\Entity\Argent" , mappedBy="participation")
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateParticipation
     *
     * @param \DateTime $dateParticipation
     *
     * @return Participation
     */
    public function setDateParticipation($dateParticipation)
    {
        $this->dateParticipation = $dateParticipation;

        return $this;
    }

    /**
     * Get dateParticipation
     *
     * @return \DateTime
     */
    public function getDateParticipation()
    {
        return $this->dateParticipation;
    }
}

