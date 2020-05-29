<?php

namespace App\Controller\Admin\EasyAdmin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminController extends EasyAdminController
{
    protected $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;

        // parent::__construct();
    }

    public function persistClientEntity($entity) {
        $entity->setPassword($this->encoder->encodePassword($entity, $entity->getPassword()));
        $entity->setCreatedAt(time());
        $entity->setUpdatedAt(time());
        $entity->setRoles(array("ROLE_USER"));

        parent::persistEntity($entity);
    }

    public function updateClientEntity($entity){
        if (!is_null($entity->getPassword())) {
            //  update password
            $original = $this->em->getUnitOfWork()->getOriginalEntityData($entity);
            $password = $original['password'];
            if( $password != $entity->getPassword()) {
                $entity->setPassword($this->encoder->encodePassword($entity, $entity->getPassword()));
            }
        } else {
            $original = $this->em->getUnitOfWork()->getOriginalEntityData($entity);
            $password = $original['password'];
            $entity->setPassword($password);
        }

        $entity->setUpdatedAt(time());

        parent::updateEntity($entity);
    }

    public function updateAdminEntity($entity){
        if (!is_null($entity->getPassword())) {
            //  update password
            $original = $this->em->getUnitOfWork()->getOriginalEntityData($entity);
            $password = $original['password'];
            if( $password != $entity->getPassword()) {
                $entity->setPassword($this->encoder->encodePassword($entity, $entity->getPassword()));
            }
        } else {
            $original = $this->em->getUnitOfWork()->getOriginalEntityData($entity);
            $password = $original['password'];
            $entity->setPassword($password);
        }

        $entity->setUpdatedAt(time());

        parent::updateEntity($entity);
    }

    public function persistAdminEntity($entity) {
        $entity->setPassword($this->encoder->encodePassword($entity, $entity->getPassword()));
        $entity->setCreatedAt(time());
        $entity->setUpdatedAt(time());
        $entity->setRoles(array("ROLE_ADMIN"));

        parent::persistEntity($entity);
    }

    public function persistCompanyEntity($entity) {
        $entity->setCreatedAt(time());
        $entity->setUpdatedAt(time());

        parent::persistEntity($entity);
    }

    public function updateCompanyEntity($entity){
        
        $entity->setUpdatedAt(time());
        parent::updateEntity($entity);
    }
}