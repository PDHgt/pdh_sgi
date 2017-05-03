<?php

namespace Procuracion\Form;

use Zend\Form\Form;

/*
 * Clase que contiene todos los campos de los formularios de registro de la solicitud
 */

class FormularioSolicitud extends Form {

    function __construct($name = null) {
        parent::__construct("solicitud");

        //Campo numero de expediente
        $this->add(array(
            'name' => 'numero',
            'options' => array(
                'label' => 'Número',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'readonly' => true
            )
        ));

        //Campo sede actual
        $this->add(array(
            'name' => 'sede',
            'options' => array(
                'label' => 'Sede'
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'readonly' => true
            )
        ));

        //Campo descripcion de los hechos
        $this->add(array(
            'name' => 'hechos',
            'options' => array(
                'label' => 'Descripción de los hechos'
            ),
            'attributes' => array(
                'type' => 'textarea',
                'class' => 'form-control'
            )
        ));

        //Campo de departamento
        $this->add(array(
            'type' => 'select',
            'name' => 'departamento',
            'options' => array(
                'label' => 'Departamento',
                'empty_option' => 'Seleccione una opción'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'required' => true
            )
        ));

        //Campo de departamento
        $this->add(array(
            'type' => 'select',
            'name' => 'municipio',
            'options' => array(
                'label' => 'Municipio',
                'empty_option' => 'Seleccione una opción'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'required' => true
            )
        ));

        //Campo direccion
        $this->add(array(
            'name' => 'direccion',
            'options' => array(
                'label' => 'Direccion / Lugar'
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'readonly' => true
            )
        ));

        //Campo fecha de los hechos
        $this->add(array(
            'name' => 'fecha',
            'options' => array(
                'label' => 'Fecha',
            ),
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'readonly' => true
            )
        ));

        //Campo peticion o solicitud
        $this->add(array(
            'name' => 'solicitud',
            'options' => array(
                'label' => 'Solicitud / Petición',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control'
            )
        ));

        //Campo peticion o solicitud
        $this->add(array(
            'name' => 'solicitud',
            'options' => array(
                'label' => 'Solicitud / Petición',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control'
            )
        ));

        //Campo de pruebas
        $this->add(array(
            'name' => 'pruebas',
            'options' => array(
                'label' => 'Pruebas',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control'
            )
        ));
    }

}
