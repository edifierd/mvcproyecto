<?php

class Usuario {

    private $id;
    private $email;
    private $password;
    private $activo;
    private $updated_at;
    private $created_at;
    private $first_name;
    private $last_name;

    public function __construct($id, $email, $password, $activo, $updated_at, $created_at, $first_name, $last_name) {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->activo = $activo;
        $this->update_at = $updated_at;
        $this->created_at = $created_at;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }

    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getActivo() {
        return ($this->activo)? 'Activo' : 'Suspendido';
    }

    public function getUpdateAt() {
        return $this->update_at;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function getRol($filter = ""){
      $roles = RolRepository::getInstance()->getAllByUserId($this->getId());
      if($filter == "onlyId"){
        $roles_aux = [];
        foreach ($roles as $rol) {
          $roles_aux[] = $rol->getId();
        }
        $roles = $roles_aux;
      }
      return $roles;
    }




}
