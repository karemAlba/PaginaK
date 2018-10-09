<?php

namespace CoreBundle\Entity;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ORM\EntityRepository;

class UsuariosRepository extends EntityRepository implements UserLoaderInterface
{
    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.nombre = :nombre')
            ->andWhere('u.activo = :act')
            ->setParameter('nombre', $username)
            ->setParameter('act', 1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}