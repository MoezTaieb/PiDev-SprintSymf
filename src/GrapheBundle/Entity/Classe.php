<?php

namespace GrapheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classe
 *
 * @ORM\Table(name="classe")
 * @ORM\Entity(repositoryClass="GrapheBundle\Repository\ClasseRepository")
 */
class Classe
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="nbModules", type="integer")
     */
    private $nbModules;

    /**
     * @var int
     *
     * @ORM\Column(name="nbEtudiants", type="integer")
     */
    private $nbEtudiants;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Classe
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set nbModules
     *
     * @param integer $nbModules
     *
     * @return Classe
     */
    public function setNbModules($nbModules)
    {
        $this->nbModules = $nbModules;

        return $this;
    }

    /**
     * Get nbModules
     *
     * @return int
     */
    public function getNbModules()
    {
        return $this->nbModules;
    }

    /**
     * Set nbEtudiants
     *
     * @param integer $nbEtudiants
     *
     * @return Classe
     */
    public function setNbEtudiants($nbEtudiants)
    {
        $this->nbEtudiants = $nbEtudiants;

        return $this;
    }

    /**
     * Get nbEtudiants
     *
     * @return int
     */
    public function getNbEtudiants()
    {
        return $this->nbEtudiants;
    }
}

