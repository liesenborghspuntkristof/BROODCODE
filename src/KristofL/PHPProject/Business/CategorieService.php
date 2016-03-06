<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace KristofL\PHPProject\Business;

use KristofL\PHPProject\Data\CategorieDAO; 

/**
 * Description of CategorieService
 *
 * @author kristof
 */
class CategorieService {
    
    public function getCategorieList() {
        $categorieDAO = new CategorieDAO(); 
        $categorielijst = $categorieDAO->getAll(); 
        return $categorielijst; 
    }
}
