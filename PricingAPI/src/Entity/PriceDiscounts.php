<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PriceDiscounts
 *
 * @ORM\Table(name="price_discounts", indexes={@ORM\Index(name="price", columns={"price"}), @ORM\Index(name="discount", columns={"discount"})})
 * @ORM\Entity(repositoryClass="App\Repository\PriceDiscountsRepository")
 */
class PriceDiscounts
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Prices
     *
     * @ORM\ManyToOne(targetEntity="Prices")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="price", referencedColumnName="id")
     * })
     */
    private $price;

    /**
     * @var \Discounts
     *
     * @ORM\ManyToOne(targetEntity="Discounts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="discount", referencedColumnName="id")
     * })
     */
    private $discount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?Prices
    {
        return $this->price;
    }

    public function setPrice(?Prices $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDiscount(): ?Discounts
    {
        return $this->discount;
    }

    public function setDiscount(?Discounts $discount): self
    {
        $this->discount = $discount;

        return $this;
    }


}
