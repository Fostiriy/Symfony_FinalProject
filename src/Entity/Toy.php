<?php

namespace App\Entity;

use App\Repository\ToyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ToyRepository::class)
 */
class Toy
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=ToyCategory::class, inversedBy="toys")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity=UseRestriction::class, inversedBy="toys")
     */
    private $useRestriction;

    /**
     * @ORM\ManyToMany(targetEntity=Child::class, inversedBy="toys")
     */
    private $children;

    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCategory(): ?ToyCategory
    {
        return $this->category;
    }

    public function setCategory(?ToyCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getUseRestriction(): ?UseRestriction
    {
        return $this->useRestriction;
    }

    public function setUseRestriction(?UseRestriction $useRestriction): self
    {
        $this->useRestriction = $useRestriction;

        return $this;
    }

    /**
     * @return Collection<int, Child>
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function addChild(Child $child): self
    {
        if (!$this->children->contains($child)) {
            $this->children[] = $child;
        }

        return $this;
    }

    public function removeChild(Child $child): self
    {
        $this->children->removeElement($child);

        return $this;
    }

    public function __toString()
    {
        return strval($this->getName());
    }

}
