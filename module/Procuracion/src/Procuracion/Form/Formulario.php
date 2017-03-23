<?php

namespace Procuracion\Form;

use Zend\Form\Form;

/*
 * Clase que contiene todos los campos de los formularios de registro de recepcion
 */

class Formulario extends Form {

    function __construct($name = null) {
        parent::__construct($name);
        /*
         * Campo fecha
         */
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
        /*
         * Campo hora
         */
        $this->add(array(
            'name' => 'hora',
            'options' => array(
                'label' => 'Hora',
            ),
            'attributes' => array(
                'type' => 'time',
                'class' => 'form-control',
                'readonly' => true
            )
        ));
        /*
         * Campo pid hidden
         */
        $this->add(array(
            'name' => 'pid',
            'attributes' => array(
                'type' => 'hidden',
            )
        ));
        /*
         * Campo vid hidden
         */
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden'
            )
        ));
        /*
         * Campo cid hidden
         */
        $this->add(array(
            'name' => 'cid',
            'attributes' => array(
                'type' => 'hidden',
            )
        ));
        /*
         * Campo nombre
         */
        $this->add(array(
            'name' => 'nombre',
            'options' => array(
                'label' => 'Nombres',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'nombres'
            )
        ));
        /*
         * Campo apellido
         */
        $this->add(array(
            'name' => 'apellido',
            'options' => array(
                'label' => 'Apellidos',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'apellidos'
            )
        ));
        /*
         * Fecha de nacimiento
         */
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
        /*
         * Campo tipo de documento
         */
        $this->add(array(
            'type' => 'select',
            'name' => 'tipodoc',
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
        /*
         * Campo número de documento
         */
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
        /*
         * Campo de insitucion o empresa
         */
        $this->add(array(
            'name' => 'institucion',
            'options' => array(
                'label' => 'Institución / Empresa',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control'
            )
        ));
        /*
         * Campo de empleado
         */
        $this->add(array(
            'type' => 'select',
            'name' => 'empleado',
            'options' => array(
                'label' => 'Empleado',
                'empty_option' => 'Seleccione una opción'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'required' => true
            )
        ));
        /*
         * Campo de oficina
         */
        $this->add(array(
            'name' => 'unidad',
            'options' => array(
                'label' => 'Oficina / Unidad',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            )
        ));
        /*
         * Campo de motivo
         */
        $this->add(array(
            'name' => 'motivo',
            'options' => array(
                'label' => 'Motivo',
            ),
            'attributes' => array(
                'type' => 'textarea',
                'class' => 'form-control'
            )
        ));
        /*
         * Campo observaciones
         */
        $this->add(array(
            'name' => 'obs',
            'options' => array(
                'label' => 'Observaciones',
            ),
            'attributes' => array(
                'type' => 'textarea',
                'class' => 'form-control'
            )
        ));
        /*
         * Campo de prioridad
         */
        $this->add(array(
            'type' => 'Radio',
            'name' => 'prioridad',
            'options' => array(
                'label' => 'Prioridad',
                'label_attributes' => array(
                    'class' => 'radio-inline'
                ),
                'value_options' => array(
                    '1' => 'Urgente',
                    '2' => 'Importante',
                    '3' => 'Normal',
                )
            ),
            'attributes' => array(
                'value' => '3'
            )
        ));
        /*
         * Campo lapicero verde
         */
        $this->add(array(
            'type' => 'Radio',
            'name' => 'lapiceroverde',
            'options' => array(
                'label' => '¿Es lapicero verde?',
                'label_attributes' => array(
                    'class' => 'radio-inline'
                ),
                'value_options' => array(
                    '0' => 'No',
                    '1' => 'Si'
                )
            )
        ));
        /*
         * Sexo Masculino o femenino
         */
        $this->add(array(
            'type' => 'Radio',
            'name' => 'sexo',
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
                'id' => 'sexo'
            )
        ));
        /*
         * LGBTI
         */
        $this->add(array(
            'type' => 'Radio',
            'name' => 'lgbti',
            'options' => array(
                'label' => 'Identidad de género',
                'label_attributes' => array(
                    'class' => 'radio-inline'
                ),
                'value_options' => array(
                    'L' => 'Lesbiana',
                    'G' => 'Gay',
                    'B' => 'Bisexual',
                    'T' => 'Transexual',
                    'I' => 'Intersexual'
                )
            )
        ));
        /*
         * input oculto con el parametro visitante o solicitante
         */
        $this->add(array(
            'name' => 'tipopersona',
            'options' => array(
            ),
            'attributes' => array(
                'type' => 'hidden',
            //'class' => 'form-control'
            )
        ));
        /*
         * Botón de enviar o guardar
         */
        $this->add(array(
            'name' => 'guardar',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Guardar',
                'class' => 'btn btn-primary btn-flat'
            )
        ));
        /*
         * Botón de cancelar
         */
        $this->add(array(
            'name' => 'cancelar',
            'attributes' => array(
                'type' => 'button',
                'id' => 'historyBack',
                'value' => 'Cancelar',
                'class' => 'btn btn-danger btn-flat'
            )
        ));
        /*
         * Botón modificar
         */
        $this->add(array(
            'name' => 'cambiar',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Cambiar tipo',
                'class' => 'btn btn-warning btn-flat',
            )
        ));
        /*
         * Botón buscar
         */
        $this->add(array(
            'name' => 'buscar',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Buscar',
                'class' => 'btn btn-success btn-flat'
            )
        ));
    }

}
