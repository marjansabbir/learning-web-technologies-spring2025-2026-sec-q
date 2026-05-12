<?php
// ============================================
//  BASE MODEL
//  All models extend this class.
//  Gives every model access to the database.
//  Models ONLY contain DB queries & data logic.
//  NO HTML, NO echo, NO redirects here.
// ============================================

class Model {

    protected $pdo;

    public function __construct() {
        $this->pdo = getDB();
    }
}
