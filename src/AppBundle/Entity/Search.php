<?php

namespace AppBundle\Entity;

/**
 * Search class. This haven't db representation. Only will use for
 * representate the data received from search box  
 */
class Search
{
    /**
     * @var string
     */
    private $product;

    /**
     * Set product
     *
     * @param string $product
     *
     * @return Sale
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return string
     */
    public function getProduct()
    {
        return $this->product;
    }

}

