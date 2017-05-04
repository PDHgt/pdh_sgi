<?php

namespace Procuracion\Form;

use Zend\Form\Form;

/**
 * Description of FormularioAdmin
 *
 * @author Jorge Morales
 */
class FormularioAdmin extends Form {

    function __construct($name = null) {
        parent::__construct("admin");
        /*
         * Campo contraseña
         */
        $this->add(array(
            'name' => 'password',
            'options' => array(
                'label' => 'Contraseña',
            ),
            'attributes' => array(
                'type' => 'password',
                'class' => 'form-control input-password',
                'data-minlength' => 6
            )
        ));
        $this->add(array(
            'name' => 'cfmpassword',
            'options' => array(
                'label' => 'Confirmar contraseña',
            ),
            'attributes' => array(
                'type' => 'password',
                'class' => 'form-control input-password',
                'data-minlength' => 6,
                'data-minlength-error' => 'No se cumple el mínimo requerido',
                'data-match' => '#inputPassword',
                'data-match-error' => 'No son iguales'
            )
        ));


        /*
         * Campo checkbox
         */
        $this->add(array(
            'name' => 'checkbox',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'type' => 'Checkbox',
                'class' => 'checkbox-unmask',
            ),
            'options' => array(
                'label' => 'Mostrar contraseña',
            ),
        ));
    }

}
