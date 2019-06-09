<?php

namespace AppBundle\Entity;

/**
 * Product
 */
class Product
{
    /**
     * @var int
     */
    private $idproduct;

    /**
     * @var string
     */
    private $productname;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set productname
     *
     * @param string $productname
     *
     * @return Product
     */
    public function setProductname($productname)
    {
        $this->productname = $productname;

        return $this;
    }

    /**
     * Get productname
     *
     * @return string
     */
    public function getProductname()
    {
        return $this->productname;
    }
}

