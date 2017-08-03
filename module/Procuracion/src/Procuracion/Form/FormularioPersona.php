<?php

/*
 * Copyright (C) 2017 Procurador de los Derechos Humanos
 */

namespace Procuracion\Form;

use Zend\Form\Form;

/**
 * Campos de los atributos de la entidad persona
 *
 * @author Jorge Morales
 */
class FormularioPersona extends Form {

    function __construct($name) {
        parent::__construct($name);

        //****************** id ***************************/
        $this->add(array(
            'name' => 'id',
            'type' => 'hidden'
        ));

        //****************** Tipo persona *****************/
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'tipovictima',
            'options' => array(
                'label' => 'Tipo víctima',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'tipodenunciado',
            'options' => array(
                'label' => 'Tipo denuncaido',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            )
        ));


        //******************* Nombres *********************/
        $this->add(array(
            'name' => 'nombres',
            'options' => array(
                'label' => 'Nombres',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'nombres'
            )
        ));

        //***************** Apellidos *********************/
        $this->add(array(
            'name' => 'apellidos',
            'options' => array(
                'label' => 'Apellidos',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'apellidos'
            )
        ));

        //*************** Tipo documento ******************/
        $this->add(array(
            'name' => 'tipodoc',
            'type' => 'select',
            'options' => array(
                'label' => 'Tipo de documento',
                'empty_option' => 'Seleccione una opción',
                'value_options' => array(
                    'Carné' => 'Carné',
                    'Cédula' => 'Cédula',
                    'DPI' => 'DPI',
                    'Licencia' => 'Licencia',
                    'Pasaporte' => 'Pasaporte'
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'tipodoc'
            )
        ));

        //************** Número de documento ****************/
        $this->add(array(
            'name' => 'numdoc',
            'options' => array(
                'label' => '# de documento',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'numdoc',
                'autocomplete' => false
            )
        ));

        //*************** Fecha de nacimiento ***************/
        $this->add(array(
            'name' => 'fechanac',
            'options' => array(
                'label' => 'Fecha de nacimiento',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control datepicker',
                'id' => 'fechanac'
            )
        ));

        //******************* Edad *********************/
        $this->add(array(
            'name' => 'edad',
            'options' => array(
                'label' => 'Edad',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'edad'
            )
        ));

        //******************* Sexo **********************/
        $this->add(array(
            'name' => 'sexo',
            'type' => 'Radio',
            'options' => array(
                'label' => 'Sexo',
                'label_attributes' => array(
                    'class' => 'radio-inline'
                ),
                'value_options' => array(
                    '1' => 'Masculino',
                    '2' => 'Femenino',
                )
            ),
            'attributes' => array(
            )
        ));

        //******************** LBTI **********************/
        $this->add(array(
            'name' => 'lgbti',
            'type' => 'Radio',
            'options' => array(
                'label' => 'Orientación sexual',
                'label_attributes' => array(
                    'class' => 'radio-inline'
                ),
                'value_options' => array(
                    //'H' => 'Heterosexual',
                    'L' => 'Lesbiana',
                    'G' => 'Gay',
                    'B' => 'Bisexual',
                    'T' => 'Transexual',
                    'I' => 'Intersexual'
                )
            )
        ));

        //******************* Nombre usual *******************/
        $this->add(array(
            'name' => 'nombreusual',
            'options' => array(
                'label' => 'Nombre Usual / Social',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'nombreusual'
            )
        ));

        //******************** Direccion ********************/
        $this->add(array(
            'name' => 'direccion',
            'options' => array(
                'label' => 'Dirección',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control'
            )
        ));

        //******************* Departamento *******************/
        $this->add(array(
            'name' => 'depto',
            'type' => 'select',
            'options' => array(
                'label' => 'Departamento',
                'empty_option' => 'Seleccione una opción'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));

        //****************** Municipio ********************/
        $this->add(array(
            'name' => 'muni',
            'type' => 'select',
            'options' => array(
                'label' => 'Municipio',
                'empty_option' => 'Seleccione una opción'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));

        //***************** Telefono **********************/
        $this->add(array(
            'name' => 'telefono',
            'options' => array(
                'label' => 'Teléfono',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control'
            )
        ));

        //***************** Correo **********************/
        $this->add(array(
            'name' => 'correo',
            'options' => array(
                'label' => 'Correo electrónico',
            ),
            'attributes' => array(
                'type' => 'email',
                'class' => 'form-control'
            )
        ));

        //***************** Relación ********************/
        $this->add(array(
            'name' => 'relacion',
            'type' => 'select',
            'options' => array(
                'label' => 'Relación',
                'empty_option' => 'Seleccione una opción'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));

        //******************* Comunidad *******************/
        $this->add(array(
            'name' => 'comunidad',
            'type' => 'select',
            'options' => array(
                'label' => 'Comunidad lingüistica',
                'empty_option' => 'Seleccione una opción'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));


        //****************** Pueblo pertenencia *************/
        $this->add(array(
            'name' => 'pertenencia',
            'type' => 'select',
            'options' => array(
                'label' => 'Pueblo de pertenencia',
                'empty_option' => 'Seleccione una opción'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));

        //******************* Grupo vulnerable **************/
        $this->add(array(
            'name' => 'grupovulnerable',
            'type' => 'Multicheckbox',
            'options' => array(
                'label_attributes' => array(
                    'class' => 'checkbox-inline'
                ),
                'label' => 'Seleccione una o varias opciones',
                'use_hidden_element' => false,
                'checked_value' => 1,
                'unchecked_value' => 0,
                'value_options' => array(
                    '1' => 'Apple',
                    '2' => 'Orange',
                    '3' => 'Lemon',
                ),
            ),
        ));

        //****************** Nacionalidad *************/
        $this->add(array(
            'name' => 'nacionalidad',
            'type' => 'select',
            'options' => array(
                'label' => 'Nacionalidad',
                'empty_option' => 'Seleccione una opción'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));

        //****************** Alfabeta *****************/
        $this->add(array(
            'name' => 'alfabeta',
            'type' => 'Checkbox',
            'options' => array(
                'label' => 'Alfabeta',
                'use_hidden_element' => true,
                'checked_value' => 1,
                'unchecked_value' => 0,
            ),
            'attributes' => array(
                'value' => 1,
            ),
        ));

        //****************** Escolaridad *****************/
        $this->add(array(
            'name' => 'escolaridad',
            'type' => 'select',
            'options' => array(
                'label' => 'Escolaridad',
                'empty_option' => 'Seleccione una opción'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));

        //****************** Estado conyugal *****************/
        $this->add(array(
            'name' => 'conyugal',
            'type' => 'select',
            'options' => array(
                'label' => 'Estado conyugal',
                'empty_option' => 'Seleccione una opción'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));

        //****************** Trabaja ******************/
        $this->add(array(
            'name' => 'trabaja',
            'type' => 'select',
            'options' => array(
                'label' => 'Trabaja',
                'empty_option' => 'Seleccione una opción'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));

        //****************** Ocupación ***************/
        $this->add(array(
            'name' => 'ocupacion',
            'type' => 'select',
            'options' => array(
                'label' => 'Ocupación',
                'empty_option' => 'Seleccione una opción'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));

        //****************** A que se dedica ***************/
        $this->add(array(
            'name' => 'aquesededica',
            'type' => 'select',
            'options' => array(
                'label' => '¿A qué se dedica?',
                'empty_option' => 'Seleccione una opción'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));

        //****************** Discapacidad ****************/
        $this->add(array(
            'name' => 'discapacidad',
            'type' => 'select',
            'options' => array(
                'label' => 'Discapacidad',
                'empty_option' => 'Seleccione una opción'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));

        //****************** Tipo de discapacidad ***************/
        $this->add(array(
            'name' => 'tipodiscapacidad',
            'type' => 'select',
            'options' => array(
                'label' => 'Tipo de discapacidad',
                'empty_option' => 'Seleccione una opción'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));

        //******************* Nombre no individual *********************/
        $this->add(array(
            'name' => 'nombrecolectivo',
            'options' => array(
                'label' => 'Nombre',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'nombrecolectivo'
            )
        ));

        //******************* Contacto ***************************/
        $this->add(array(
            'name' => 'contacto',
            'options' => array(
                'label' => 'Contacto',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control'
            )
        ));

        //******************* Cargo ***************************/
        $this->add(array(
            'name' => 'cargo',
            'options' => array(
                'label' => 'Cargo',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control'
            )
        ));

        //****************** Institución ***************/
        $this->add(array(
            'name' => 'institucion',
            'options' => array(
                'label' => 'Institución',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control'
            )
        ));
    }

}
