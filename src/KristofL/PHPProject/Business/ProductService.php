<?php

//src/KristofL/PHPProject/Business/ProductService.php

namespace KristofL\PHPProject\Business;

use KristofL\PHPProject\Data\ProductDAO;
use KristofL\PHPProject\Data\CategorieDAO; 


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductService
 *
 * @author kristof.liesenborghs
 */
class ProductService {

    public function getProductList() {
        $productDAO = new ProductDAO();
        $productlijst = $productDAO->getAll();
        return $productlijst;
    }
    
    public function getProductListByCategorieList() {
        $productDAO = new ProductDAO(); 
        $categorieDAO = new CategorieDAO(); 
        $categorielijst = $categorieDAO->getAll();
        $lijst = array(); 
        foreach ($categorielijst as $categorie) {
            $key = array($categorie->getCategorieNaam()); 
            $productlijstByCategorie = $productDAO->getByCategorie($categorie);
            if (!empty($productlijstByCategorie)) {
            $productenByCategorie = array_fill_keys($key, $productlijstByCategorie);
            $lijst =  array_merge($lijst, $productenByCategorie); 
            }
        }
        return $lijst; 
    }
    
    
}
