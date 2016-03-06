<?php
//src/KristofL/PHPProject/Entities/Product.php

namespace KristofL\PHPProject\Entities; 

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *
 * @author kristof.liesenborghs
 */
class Product {
    
    private static $idMap = array(); 
    
    private $productId; 
    private $productNaam; 
    private $productOmschrijving; 
    private $productPrijs;
    private $categorie; // = obj. v. Categorie
    
    private function __construct($productId, $productNaam, $productOmschrijving, $productPrijs, $categorie) {
        $this->productId = $productId;
        $this->productNaam = $productNaam;
        $this->productOmschrijving = $productOmschrijving;
        $this->productPrijs = $productPrijs;
        $this->categorie =$categorie; 
    }
    
    public static function create($productId, $productNaam, $productOmschrijving, $productPrijs, $categorie) {
        if (!isset(self::$idMap[$productId])) {
            self::$idMap[$productId] = new Product($productId, $productNaam, $productOmschrijving, $productPrijs, $categorie); 
        }
        return self::$idMap[$productId]; 
    }
    
    function getProductId() {
        return $this->productId;
    }

    function getProductNaam() {
        return $this->productNaam;
    }

    function getProductOmschrijving() {
        return $this->productOmschrijving;
    }

    function getProductPrijs() {
        return $this->productPrijs;
    }
    
    function getCategorie() {
        return $this->categorie; 
    }
    
    function setProductNaam($productNaam) {
        $this->productNaam = $productNaam;
    }

    function setProductOmschrijving($productOmschrijving) {
        $this->productOmschrijving = $productOmschrijving;
    }

    function setProductPrijs($productPrijs) {
        $this->productPrijs = $productPrijs;
    }
    
    function setCategorie($categorie) {
        $this->categorie = $categorie; 
    }





}
