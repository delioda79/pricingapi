<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prices
 *
 * @ORM\Table(name="prices", indexes={@ORM\Index(name="product", columns={"product"}), @ORM\Index(name="amount", columns={"amount"})})
 * @ORM\Entity(repositoryClass="App\Repository\PricesRepository")
 */
class Prices
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
     * @var float
     *
     * @ORM\Column(name="value", type="float", precision=10, scale=0, nullable=false)
     */
    private $value = '0';

    /**
     * @var \Amounts
     *
     * @ORM\ManyToOne(targetEntity="Amounts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="amount", referencedColumnName="id")
     * })
     */
    private $amount;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Products", inversedBy="prices")
     * @ORM\JoinColumn(nullable=false)
     */
    private $products;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getAmount(): ?Amounts
    {
        return $this->amount;
    }

    public function setAmount(?Amounts $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

}
