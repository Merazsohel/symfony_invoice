<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="InvoiceDetail", mappedBy="product")
     */
    private $saleDetails;

    public function __construct()
    {
        $this->saleDetails = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
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

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|InvoiceDetail[]
     */
    public function getSaleDetails(): Collection
    {
        return $this->saleDetails;
    }

    public function addSaleDetail(InvoiceDetail $saleDetail): self
    {
        if (!$this->saleDetails->contains($saleDetail)) {
            $this->saleDetails[] = $saleDetail;
            $saleDetail->setProduct($this);
        }

        return $this;
    }

    public function removeSaleDetail(InvoiceDetail $saleDetail): self
    {
        if ($this->saleDetails->contains($saleDetail)) {
            $this->saleDetails->removeElement($saleDetail);
            // set the owning side to null (unless already changed)
            if ($saleDetail->getProduct() === $this) {
                $saleDetail->setProduct(null);
            }
        }

        return $this;
    }



    
}
