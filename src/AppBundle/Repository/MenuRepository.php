<?php

namespace AppBundle\Repository;

/**
 * MenuRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MenuRepository extends \Doctrine\ORM\EntityRepository
{
        //Le paso como argumento la cantidad que quiero que muestre y la pagina por default 1.
        //realiza una consulta desde repository seleccionando el top = true mostrando los 3 
        //primeros resultados y limitando como un maximo de 3, retorna la pagina.
    public function paginaActual($nummenu=3, $pagina=1){
        $query =  $this->createQueryBuilder('t')
        -> where ('t.top = 1')
        -> setFirstResult($nummenu*($pagina-1))
        ->setMaxResults($nummenu)
        ->getQuery();
        return $query->getResult();
    }
}
