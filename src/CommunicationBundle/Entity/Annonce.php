<?php

namespace CommunicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annonce
 *
 * @ORM\Table(name="annonce")
 * @ORM\Entity(repositoryClass="CommunicationBundle\Repository\AnnonceRepository")
 */
class Annonce
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User" , inversedBy="annonces")
     * @ORM\JoinColumn(name="posteur_id",referencedColumnName="id")
     */
    private $posteur ;



    /**
     * @var string
     *
     * @ORM\Column(name="titreAnnonce", type="string", length=255)
     */
    private $titreAnnonce;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionAnnonce", type="text")
     */
    private $descriptionAnnonce;

    /**
     * @var string
     *
     * @ORM\Column(name="imageUrlAnnonce", type="string", length=255)
     */
    private $imageUrlAnnonce;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAnnonce", type="datetime")
     */
    private $dateAnnonce;


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
     * Set titreAnnonce
     *
     * @param string $titreAnnonce
     *
     * @return Annonce
     */
    public function setTitreAnnonce($titreAnnonce)
    {
        $this->titreAnnonce = $titreAnnonce;

        return $this;
    }

    /**
     * Get titreAnnonce
     *
     * @return string
     */
    public function getTitreAnnonce()
    {
        return $this->titreAnnonce;
    }

    /**
     * Set descriptionAnnonce
     *
     * @param string $descriptionAnnonce
     *
     * @return Annonce
     */
    public function setDescriptionAnnonce($descriptionAnnonce)
    {
        $this->descriptionAnnonce = $descriptionAnnonce;

        return $this;
    }

    /**
     * Get descriptionAnnonce
     *
     * @return string
     */
    public function getDescriptionAnnonce()
    {
        return $this->descriptionAnnonce;
    }

    /**
     * Set imageUrlAnnonce
     *
     * @param string $imageUrlAnnonce
     *
     * @return Annonce
     */
    public function setImageUrlAnnonce($imageUrlAnnonce)
    {
        $this->imageUrlAnnonce = $imageUrlAnnonce;

        return $this;
    }

    /**
     * Get imageUrlAnnonce
     *
     * @return string
     */
    public function getImageUrlAnnonce()
    {
        return $this->imageUrlAnnonce;
    }

    /**
     * Set dateAnnonce
     *
     * @param \DateTime $dateAnnonce
     *
     * @return Annonce
     */
    public function setDateAnnonce($dateAnnonce)
    {
        $this->dateAnnonce = $dateAnnonce;

        return $this;
    }

    /**
     * Get dateAnnonce
     *
     * @return \DateTime
     */
    public function getDateAnnonce()
    {
        return $this->dateAnnonce;
    }
}

