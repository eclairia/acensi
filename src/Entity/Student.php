<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 * @ApiResource()
 */
class Student
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\NotBlank(message="Le prénom  doit être rempli.")
     * @Assert\Length(
     *     max=25,
     *     maxMessage = "Le prénom  ne doit pas dépasser {{ limit }} charactères."
     * )
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\NotBlank(message="Le nom  doit être rempli.")
     * @Assert\Length(
     *     max=25,
     *     maxMessage = "Le nom  ne doit pas dépasser {{ limit }} charactères."
     * )
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank(message="Le numéro étudiant  doit être rempli.")
     * @Assert\Regex(
     *     "/^\d{10}$/",
     *     message="Le numéro étudiant doit contenir 10 chiffres."
     * )
     */
    private $numEtud;

    /**
     * @ORM\ManyToOne(targetEntity=Department::class, inversedBy="student")
     */
    private $department;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getNumEtud(): ?string
    {
        return $this->numEtud;
    }

    public function setNumEtud(string $numEtud): self
    {
        $this->numEtud = $numEtud;

        return $this;
    }

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(?Department $department): self
    {
        $this->department = $department;

        return $this;
    }
}
