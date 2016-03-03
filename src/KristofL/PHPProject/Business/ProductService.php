<?php

//src/KristofL/PHPProject/Business/ProductService.php

namespace KristofL\PHPProject\Business;

use KristofL\PHPProject\Data\ProductDAO;

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

}
