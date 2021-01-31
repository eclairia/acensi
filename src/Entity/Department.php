<?php

namespace App\Entity;

use App\Repository\DepartmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\DepartmentController;

/**
 * @ORM\Entity(repositoryClass=DepartmentRepository::class)
 * @ApiResource(itemOperations={
 *     "get_department_registered_students"={
 *          "method"="GET",
 *          "path"="/departments/{id}/students",
 *          "controller"=DepartmentController::class,
 *     }
 * })
 */
class Department
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Student::class, mappedBy="department")
     */
    private $student;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $capacity;

    public function __construct()
    {
        $this->student = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Student[]
     */
    public function getStudent(): Collection
    {
        return $this->student;
    }

    public function addStudent(Student $student): self
    {
        if (!$this->student->contains($student)) {
            $this->student[] = $student;
            $student->setDepartment($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->student->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getDepartment() === $this) {
                $student->setDepartment(null);
            }
        }

        return $this;
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

    public function getCapacity(): ?string
    {
        return $this->capacity;
    }

    public function setCapacity(string $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function __toString()
    {
        return $this->firstName;
    }
}