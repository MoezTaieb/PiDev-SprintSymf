<?php

namespace CampBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Refugie
 *
 * @ORM\Table(name="refugie")
 * @ORM\Entity(repositoryClass="CampBundle\Repository\RefugieRepository")
 */
class Refugie
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
     * @ORM\ManyToOne(targetEntity="Camp" , inversedBy="refugies")
     * @ORM\JoinColumn(name="camp_id",referencedColumnName="id")
     */
    private $camp ;

    /**
     * @return mixed
     */
    public function getCamp()
    {
        return $this->camp;
    }

    /**
     * @param mixed $camp
     */
    public function setCamp($camp)
    {
        $this->camp = $camp;
    }



    /**
     * @var string
     *
     * @ORM\Column(name="nomRefugie", type="string", length=255)
     */
    private $nomRefugie;

    /**
     * @var string
     *
     * @ORM\Column(name="prenomRefugie", type="string", length=255)
     */
    private $prenomRefugie;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseRefugie", type="string", length=255)
     */
    private $adresseRefugie;

    /**
     * @var string
     *
     * @ORM\Column(name="telRefugie", type="string", length=255)
     */
    private $telRefugie;

    /**
     * @var string
     *
     * @ORM\Column(name="numassportRefugie", type="string", length=255)
     */
    private $numassportRefugie;

    /**
     * @var string
     *
     * @ORM\Column(name="nationaliteRefugie", type="string", length=255)
     */
    private $nationaliteRefugie;

    /**
     * @var string
     *
     * @ORM\Column(name="imageUrlRefugie", type="string", length=255)
     */
    private $imageUrlRefugie;


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
     * Set nomRefugie
     *
     * @param string $nomRefugie
     *
     * @return Refugie
     */
    public function setNomRefugie($nomRefugie)
    {
        $this->nomRefugie = $nomRefugie;

        return $this;
    }

    /**
     * Get nomRefugie
     *
     * @return string
     */
    public function getNomRefugie()
    {
        return $this->nomRefugie;
    }

    /**
     * Set prenomRefugie
     *
     * @param string $prenomRefugie
     *
     * @return Refugie
     */
    public function setPrenomRefugie($prenomRefugie)
    {
        $this->prenomRefugie = $prenomRefugie;

        return $this;
    }

    /**
     * Get prenomRefugie
     *
     * @return string
     */
    public function getPrenomRefugie()
    {
        return $this->prenomRefugie;
    }

    /**
     * Set adresseRefugie
     *
     * @param string $adresseRefugie
     *
     * @return Refugie
     */
    public function setAdresseRefugie($adresseRefugie)
    {
        $this->adresseRefugie = $adresseRefugie;

        return $this;
    }

    /**
     * Get adresseRefugie
     *
     * @return string
     */
    public function getAdresseRefugie()
    {
        return $this->adresseRefugie;
    }

    /**
     * Set telRefugie
     *
     * @param string $telRefugie
     *
     * @return Refugie
     */
    public function setTelRefugie($telRefugie)
    {
        $this->telRefugie = $telRefugie;

        return $this;
    }

    /**
     * Get telRefugie
     *
     * @return string
     */
    public function getTelRefugie()
    {
        return $this->telRefugie;
    }

    /**
     * Set numassportRefugie
     *
     * @param string $numassportRefugie
     *
     * @return Refugie
     */
    public function setNumassportRefugie($numassportRefugie)
    {
        $this->numassportRefugie = $numassportRefugie;

        return $this;
    }

    /**
     * Get numassportRefugie
     *
     * @return string
     */
    public function getNumassportRefugie()
    {
        return $this->numassportRefugie;
    }

    /**
     * Set nationaliteRefugie
     *
     * @param string $nationaliteRefugie
     *
     * @return Refugie
     */
    public function setNationaliteRefugie($nationaliteRefugie)
    {
        $this->nationaliteRefugie = $nationaliteRefugie;

        return $this;
    }

    /**
     * Get nationaliteRefugie
     *
     * @return string
     */
    public function getNationaliteRefugie()
    {
        return $this->nationaliteRefugie;
    }

    /**
     * Set imageUrlRefugie
     *
     * @param string $imageUrlRefugie
     *
     * @return Refugie
     */
    public function setImageUrlRefugie($imageUrlRefugie)
    {
        $this->imageUrlRefugie = $imageUrlRefugie;

        return $this;
    }

    /**
     * Get imageUrlRefugie
     *
     * @return string
     */
    public function getImageUrlRefugie()
    {
        return $this->imageUrlRefugie;
    }
}

