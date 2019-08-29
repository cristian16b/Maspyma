<?php

namespace Maspyma\UsuariosBundle\Entity;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ORM\EntityRepository;

class UsuarioRepository extends EntityRepository implements UserLoaderInterface {

    public function loadUserByUsername($iup) {
        return $this->createQueryBuilder('u')
                        ->where('u.fechaBaja IS NULL')
                        ->andWhere('u.iup = :iup')
                        ->setParameter('iup', $iup)
                        ->getQuery()
                        ->getOneOrNullResult();
    }

}
