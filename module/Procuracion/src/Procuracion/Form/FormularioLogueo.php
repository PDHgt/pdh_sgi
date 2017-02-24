<?php

namespace Procuracion\Form;

use Zend\Form\Form;

/*
 * Clase para crear el formulario de logueo
 */

Class FormularioLogueo extends Form {

    function __construct($user = null) {
        parent::__construct($user);


        //Campo usuario
        $this->add(array(
            'name' => 'usuario',
            /* 'options' => array(
              'label' => 'Usuario',
              ), */
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'required' => true
            //'disabled' => true
            )
        ));
        //Campo contraseña
        $this->add(array(
            'name' => 'password',
            /* 'options' => array(
              'label' => 'Contraseña',
              ), */
            'attributes' => array(
                'type' => 'password',
                'class' => 'form-control',
                'required' => true
            //'disabled' => true
            )
        ));
        //Botón entrar
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Entrar',
                'class' => 'btn btn-primary btn-block btn-flat'
            )
        ));
        //Checkbox recordar
        $this->add(array(
            'type' => 'checkbox',
            'name' => 'rememberme'
        ));
    }

}
