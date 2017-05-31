<?php

namespace Procuracion\Form;

use Zend\Form\Form;

/*
 * Clase que contiene todos los campos de los formularios de registro de la solicitud
 */

class FormularioSolicitud extends Form {

    function __construct($name = null) {
        parent::__construct("solicitud");

        //Campo nombres
        $this->add(array(
            'name' => 'nombres',
            'options' => array(
                'label' => 'Nombres',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'readonly' => true
            )
        ));
        $this->add(array(
            'name' => 'apellidos',
            'options' => array(
                'label' => 'Apellidos',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'readonly' => true
            )
        ));
        $this->add(array(
            'name' => 'nac',
            'options' => array(
                'label' => 'Fecha de nacimiento',
            ),
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'datepicker'
            )
        ));
    }

}
