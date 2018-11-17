<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Products;
use App\Entity\Prices;
use App\Entity\PriceDiscounts;


class ProductController extends AbstractController
{
    /**
     * @Route("/products", name="listproducts",  methods={"GET"} )
     */
    public function listAction()
    {
        $products = $this->getDoctrine()
        ->getRepository(Products::class)
        ->findAll();
        return $this->json($products);
    }

    /**
     * @Route("/product/{id}", requirements={"id" = "\d+"}, name="productdetails", methods={"GET"})
     */
    public function productAction(int $id)
    {
        $product = $this->getDoctrine()
        ->getRepository(Products::class)
        ->find($id);
       return $this->json($product);
    }

    /**
    * @Route("/cost/{productId}/{amountId}/{qty}", requirements={"id" = "\d+"}, name="totalcost", methods={"GET"})
     */
    public function getCost(int $productId, int $amountId, float $qty)
    {
        $price = $this->getDoctrine()
        ->getRepository(Prices::class)
        ->createQueryBuilder('p')
        ->andWhere('p.amount = :aid')
        ->setParameter('aid', $amountId)
        ->andWhere('p.products = :pid')
        ->setParameter('pid', $productId)
        ->getQuery()
        ->getOneOrNullResult();

        $cost = 0;
        if ($price != null) {
            $cost = $price->getValue() * $qty;
        }

        $discount = $this->calculateDiscount($price->getId(), $qty);
       return $this->json([
           "total" => $cost,
           "discounts"=> $discount,
           "discounted" => $cost-$discount
        ]);
    }

    private function calculateDiscount(int $priceId, int $qty) {
        $discount = 0;
        $pds = $this->getDoctrine()
        ->getRepository(PriceDiscounts::class)
        ->createQueryBuilder('p')
        ->innerJoin('p.discount', 'd')
        ->andWhere('p.price = :priceId')
        ->setParameter('priceId', $priceId)
        ->andWhere('d.qty <= :qty')
        ->setParameter('qty', $qty)
        ->orderBy('d.qty', "DESC")
        ->getQuery()
        ->getResult();

        while ($qty> 0) {
            $sdsc = $this->getSingleDiscount($pds, $qty, $discount);
            $discount += $sdsc;
            if ($sdsc == 0) {
                $qty = 0;
            }
        }
        
        return $discount;
    }

    private function getSingleDiscount($pds, int &$qty)
    {
        $discount = 0;
        foreach ($pds as $pd) {
            $price = $pd->getPrice()->getValue();
            $discVal = $pd->getDiscount()->getValue();
            $discQty = $pd->getDiscount()->getQty();
            if ($qty >= $discQty) {
                switch ($pd->getDiscount()->getType()) {
                    case "amount":
                        $discount += $price*$discVal;
                        break;
                    case "percent" :
                        $discount += ($price*$discQty*$discVal)/100;
                        break;
                    case "fixed" :
                    $discount += ($price*$qty)-$discVal;
                    break;
                }
                $qty -= $discQty;
                break;
            }
        }

        return $discount;
    }
}