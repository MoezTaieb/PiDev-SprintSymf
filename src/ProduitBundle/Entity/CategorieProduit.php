<?php

namespace ProduitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategorieProduit
 *
 * @ORM\Table(name="categorie_produit")
 * @ORM\Entity(repositoryClass="ProduitBundle\Repository\CategorieProduitRepository")
 */
class CategorieProduit
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
     * @ORM\Column(name="nomCatgorie", type="string", length=255)
     */
    private $nomCatgorie;


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
     * Set nomCatgorie
     *
     * @param string $nomCatgorie
     *
     * @return CategorieProduit
     */
    public function setNomCatgorie($nomCatgorie)
    {
        $this->nomCatgorie = $nomCatgorie;

        return $this;
    }

    /**
     * Get nomCatgorie
     *
     * @return string
     */
    public function getNomCatgorie()
    {
        return $this->nomCatgorie;
    }
}

