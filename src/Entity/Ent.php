<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\EntRepository;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=EntRepository::class)
 */
class Ent implements UserInterface,\Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_ent;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail_ent;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $site_ent;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse_ent;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $num_ent;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville_ent;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $img_logo_ent;

    /**
     * @ORM\Column(type="text")
     */
    private $description_ent;

    /**
     * @ORM\Column(type="date")
     */
    private $date_creation_ent;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEnt(): ?string
    {
        return $this->nom_ent;
    }

    public function setNomEnt(string $nom_ent): self
    {
        $this->nom_ent = $nom_ent;

        return $this;
    }

    public function getMailEnt(): ?string
    {
        return $this->mail_ent;
    }

    public function setMailEnt(string $mail_ent): self
    {
        $this->mail_ent = $mail_ent;

        return $this;
    }

    public function getSiteEnt(): ?string
    {
        return $this->site_ent;
    }

    public function setSiteEnt(string $site_ent): self
    {
        $this->site_ent = $site_ent;

        return $this;
    }

    public function getAdresseEnt(): ?string
    {
        return $this->adresse_ent;
    }

    public function setAdresseEnt(string $adresse_ent): self
    {
        $this->adresse_ent = $adresse_ent;

        return $this;
    }

    public function getNumEnt(): ?string
    {
        return $this->num_ent;
    }

    public function setNumEnt(string $num_ent): self
    {
        $this->num_ent = $num_ent;

        return $this;
    }

    public function getVilleEnt(): ?string
    {
        return $this->ville_ent;
    }

    public function setVilleEnt(string $ville_ent): self
    {
        $this->ville_ent = $ville_ent;

        return $this;
    }

    public function getImgLogoEnt(): ?string
    {
        return $this->img_logo_ent;
    }

    public function setImgLogoEnt(string $img_logo_ent): self
    {
        $this->img_logo_ent = $img_logo_ent;

        return $this;
    }

    public function getDescriptionEnt(): ?string
    {
        return $this->description_ent;
    }

    public function setDescriptionEnt(string $description_ent): self
    {
        $this->description_ent = $description_ent;

        return $this;
    }

    public function getDateCreationEnt(): ?\DateTimeInterface
    {
        return $this->date_creation_ent;
    }

    public function setDateCreationEnt(\DateTimeInterface $date_creation_ent): self
    {
        $this->date_creation_ent = $date_creation_ent;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    public function eraseCredentials(){}
    public function getSalt(){}

    public function getUsername(){
        return $this->mail_ent;
    }
    public function getRoles() {
        return ['ROLE_USER'];
    }

    public function serialize()
    {
        return serialize([
        $this->id,
        $this->mail_ent,
        $this->password,
        ]);

    }
    public function unserialize($serialized){
        list (
            $this->id,
            $this->mail_ent,
            $this->password) = unserialize($serialized, ['allowed_classes' => false]);
    }
}
