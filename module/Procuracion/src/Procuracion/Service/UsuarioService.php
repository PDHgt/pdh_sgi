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
        $perfil = $em->getRepository('\Procuracion\Entity\Empleado')->find($nvo['idperfil']);
        $usuario = new Usuario();
        $usuario->setUsuario($nvo['usuario']);
        $usuario->setPassword($nvo['password']);
        $usuario->setCreatedat(date_create($hoy));
        $usuario->setIdempleado($empleado);
        $usuario->setIdperfil($perfil);
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

	public function listOne(EntityManager $em, $dato){
		$usuario = $em->getRepository('\Procuracion\Entity\Usuario')->findByUsuario($dato);
		//return new JsonModel($enCola);
		return $usuario;
	}

	public function getPermisos(EntityManager $em, $usr){
		$usuario = $this->listOne($em,$usr);
		//var_dump($usuario);
		foreach ($usuario as $uno) {
			$perfil = $uno->getIdPerfil();
		}		
		$accionpermiso = $em->getRepository('Procuracion\Entity\Permisoperfilaccion')->findBy(array('idPerfil' => $perfil));
		$permisos = array();
		//var_dump($accionpermiso);
		$i = 0;
		foreach ($accionpermiso as $unaporuna) {
			//var_dump($unaporuna);
			//$accion = $em->getRepository('Procuracion\Entity\Accion')->find($unaporuna->getIdAccion());
			$arr_permisos = explode(',',$unaporuna->getPermisos());
			//echo $unaporuna->getIdAccion();
			$permisos[$i]['accion'] = $unaporuna->getIdAccion()->getAccion();
			$permisos[$i]['permiso'] = $arr_permisos;
			$i++;
		}
		return $permisos;
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