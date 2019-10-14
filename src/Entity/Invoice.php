<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InvoiceRepository")
 */
class Invoice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $BillNumber;

    /**
     * @ORM\Column(type="datetime")
     */
    private $BillDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="invoices")
     */
    private $customer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $remarks;

    /**
     * @ORM\Column(type="float")
     */
    private $subtotal;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $vat;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $discount;

    /**
     * @ORM\OneToMany(targetEntity="InvoiceDetail", mappedBy="invoice")
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

    public function getBillNumber(): ?string
    {
        return $this->BillNumber;
    }

    public function setBillNumber(string $BillNumber): self
    {
        $this->BillNumber = $BillNumber;

        return $this;
    }

    public function getBillDate(): ?\DateTimeInterface
    {
        return $this->BillDate;
    }

    public function setBillDate(\DateTimeInterface $BillDate): self
    {
        $this->BillDate = $BillDate;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getRemarks(): ?string
    {
        return $this->remarks;
    }

    public function setRemarks(?string $remarks): self
    {
        $this->remarks = $remarks;

        return $this;
    }

    public function getSubtotal(): ?float
    {
        return $this->subtotal;
    }

    public function setSubtotal(float $subtotal): self
    {
        $this->subtotal = $subtotal;

        return $this;
    }

    public function getVat(): ?float
    {
        return $this->vat;
    }

    public function setVat(?float $vat): self
    {
        $this->vat = $vat;

        return $this;
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function setDiscount(?float $discount): self
    {
        $this->discount = $discount;

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
            $saleDetail->setInvoice($this);
        }

        return $this;
    }

    public function removeSaleDetail(InvoiceDetail $saleDetail): self
    {
        if ($this->saleDetails->contains($saleDetail)) {
            $this->saleDetails->removeElement($saleDetail);
            // set the owning side to null (unless already changed)
            if ($saleDetail->getInvoice() === $this) {
                $saleDetail->setInvoice(null);
            }
        }

        return $this;
    }
}
