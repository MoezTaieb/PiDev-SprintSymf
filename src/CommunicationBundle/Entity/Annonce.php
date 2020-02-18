<?php

namespace CommunicationBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User" , inversedBy="annonces"  )
     * @ORM\JoinColumn(name="posteur_id",referencedColumnName="id")
     */
    private $posteur ;

    /**
     * @ORM\OneToMany(targetEntity="Commentaire" , mappedBy="annonce" ,cascade={"remove"})
     */
    private $comments ;


    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param ArrayCollection $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }
    /**
     * @return mixed
     */
    public function getPosteur()
    {
        return $this->posteur;
    }

    /**
     * @param mixed $posteur
     */
    public function setPosteur($posteur)
    {
        $this->posteur = $posteur;
    }



    /**
     * @var string
     *
     * @ORM\Column(name="titreAnnonce", type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "Your title must be at least {{ limit }} characters long",
     * )
     */
    private $titreAnnonce;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionAnnonce", type="text")
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "Your description must be at least {{ limit }} characters long",
     * )
     */
    private $descriptionAnnonce;

    /**
     * @var string
     *
     * @ORM\Column(name="imageUrlAnnonce", type="string", length=255 ,nullable=true)
     */
    private $imageUrlAnnonce;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAnnonce", type="datetime" ,nullable=true)
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

