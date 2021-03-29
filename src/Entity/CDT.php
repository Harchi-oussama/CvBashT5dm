<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CDTRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;



/**
 * @ORM\Entity(repositoryClass=CDTRepository::class)
 * @UniqueEntity(
 *  fields= {"email_cdt"},
 * message= "L'email que vous avez indiqué est déja utilisé"
 * )
 */
class CDT implements UserInterface
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
    private $nom_cdt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom_cdt;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email_cdt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $num_cdt;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 6,
     *      minMessage = "ton mot de pass doit dépasser {{ limit }} characters ",
     *      
     * )
     * @Assert\EqualTo(propertyPath="confirmez_password_cdt" , message="Votre mot de pass n'est pas compatible avec le confirmation mot de pass ....esseyer une autre fois")
     */
    private $password_cdt;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\EqualTo(propertyPath="password_cdt" , message="Votre mot de pass n'est pas compatible avec le confirmation mot de pass ....esseyer une autre fois")
     */
    private $confirmez_password_cdt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $evaluation_cdt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCdt(): ?string
    {
        return $this->nom_cdt;
    }

    public function setNomCdt(string $nom_cdt): self
    {
        $this->nom_cdt = $nom_cdt;

        return $this;
    }

    public function getPrenomCdt(): ?string
    {
        return $this->prenom_cdt;
    }

    public function setPrenomCdt(string $prenom_cdt): self
    {
        $this->prenom_cdt = $prenom_cdt;

        return $this;
    }

    public function getEmailCdt(): ?string
    {
        return $this->email_cdt;
    }

    public function setEmailCdt(string $email_cdt): self
    {
        $this->email_cdt = $email_cdt;

        return $this;
    }

    public function getNumCdt(): ?string
    {
        return $this->num_cdt;
    }

    public function setNumCdt(string $num_cdt): self
    {
        $this->num_cdt = $num_cdt;

        return $this;
    }

    public function getPasswordCdt(): ?string
    {
        return $this->password_cdt;
    }

    public function setPasswordCdt(string $password_cdt): self
    {
        $this->password_cdt = $password_cdt;

        return $this;
    }

    public function getConfirmezPasswordCdt(): ?string
    {
        return $this->confirmez_password_cdt;
    }

    public function setConfirmezPasswordCdt(string $confirmez_password_cdt): self
    {
        $this->confirmez_password_cdt = $confirmez_password_cdt;

        return $this;
    }

    public function getEvaluationCdt(): ?string
    {
        return $this->evaluation_cdt;
    }

    public function setEvaluationCdt(?string $evaluation_cdt): self
    {
        $this->evaluation_cdt = $evaluation_cdt;

        return $this;
    }

    public function eraseCredentials(){}
    public function getSalt(){}
    public function getPassword(){
        return $this->password_cdt;
    }
    public function getUsername(){
        return $this->email_cdt;
    }
    public function getRoles() {
        return ['ROLE_USER'];
    }
}
