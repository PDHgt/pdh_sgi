<?php

namespace Procuracion\Service;

use Doctrine\ORM\EntityRepository;
use Procuracion\Entity\Usuario;
use Procuracion\Entity\Empleado;
use Doctrine\ORM\EntityManager as EntityManager;
use Zend\View\Model\JsonModel;


class UsuarioService{

	public function save(EntityManager $em, array $nvo){
		$hoy = date("Y-m-d");
        $empleado = $em->getRepository('\Procuracion\Entity\Empleado')->find($nvo['idEmpleado']);
        $usuario = new Usuario();
        $usuario->setUsuario($nvo['usuario']);
        $usuario->setPassword($nvo['password']);
        $usuario->setCreatedat(date_create($hoy));
        $usuario->setIdempleado($empleado);
        $em->persist($usuario);
        $em->flush();

		return $usuario->getId();
	}

	public function listAll(EntityManager $em){
		$listado = $em->getRepository('\Procuracion\Entity\Usuario')->findAll();
		//var_dump($listado);
		//return new JsonModel($listado);
		return $listado;
	}

	public function listOne(EntityManager $em, $usr){
		$usuario = $em->getRepository('\Procuracion\Entity\Usuario')->findByUsuario($usr);
		//return new JsonModel($enCola);
		return $usuario;
	}

	public function changePass(EntityManager $em, array $usr){
		$hoy = date("Y-m-d");
		$data = $em->getReference('Procuracion\Entity\Usuario', $usr['id']);
        $data->setPassword($usr['password']);
        $data->setModifyat(date_create($hoy));
		$em->flush(); 
		return $data->getId();
	}	
}