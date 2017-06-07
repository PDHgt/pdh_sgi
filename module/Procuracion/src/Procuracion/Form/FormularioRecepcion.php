<?php

namespace Procuracion\Form;

use Zend\Form\Form;

/*
 * Clase que contiene todos los campos de los formularios de registro de recepcion
 */

class FormularioRecepcion extends Form {

    function __construct($name = null) {
        parent::__construct("recepcion");

        //****************************INPUT HIDDEN*****************************/
        //Fecha registro
        $this->add(array(
            'name' => 'fecha',
            'options' => array(
                'label' => 'Fecha',
            ),
            'attributes' => array(
                'type' => 'hidden',
                'class' => 'form-control',
                'readonly' => true
            )
        ));
        //ID persona
        $this->add(array(
            'name' => 'pid',
            'attributes' => array(
                'type' => 'hidden',
            )
        ));
        //ID visita
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden'
            )
        ));
        //ID cola
        $this->add(array(
            'name' => 'cid',
            'attributes' => array(
                'type' => 'hidden',
            )
        ));
        //Campo tipo persona
        $this->add(array(
            'name' => 'tipopersona',
            'options' => array(
            ),
            'attributes' => array(
                'type' => 'hidden',
            //'class' => 'form-control'
            )
        ));

        //************************INPUT TEXT******************************/
        //Campo nombres
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
        //Campo apellidos
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
        //Campo número de documento
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
        //Campo indistucion o empresa
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
        //Campo ofician
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
        //Campo direccion
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


        //************************INPUTS SELECT*****************************/
        //Campo tipo de documento
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
        //Campo empleado
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
        //Campo area ubicacion
        $this->add(array(
            'type' => 'select',
            'name' => 'areaubicacion',
            'options' => array(
                'label' => 'Tipo de área',
                'empty_option' => 'Seleccione una opción',
                'value_options' => array(
                    '0' => 'Rural',
                    '1' => 'Urbana'
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',
            )
        ));
        //Campo departamento
        $this->add(array(
            'type' => 'select',
            'name' => 'depto',
            'options' => array(
                'label' => 'Departamento',
                'empty_option' => 'Seleccione una opción'
            ),
            'attributes' => array(
                'class' => 'form-control',
            //'required' => true
            )
        ));
        //Campo municipio
        $this->add(array(
            'type' => 'select',
            'name' => 'muni',
            'options' => array(
                'label' => 'Municipio',
                'empty_option' => 'Seleccione una opción'
            ),
            'attributes' => array(
                'class' => 'form-control',
            //'required' => true
            )
        ));

        //************************INPUTS DATE*****************************/
        //Campo hora
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
        //Campo fecha de nacimiento
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

        //**************************INPUTS CHECKBOX****************************/
        //Campo anonimo
        $this->add(array(
            //'name' => 'checkbox',
            'type' => 'Checkbox',
            'name' => 'checkbox',
            'options' => [
                'label' => 'Si el solicitante no desea ser identificado (Anónimo), haga clic en el cuadro de selección, ',
                'use_hidden_element' => true,
                'checked_value' => 1,
                'unchecked_value' => 0,
            ],
            'attributes' => [
                'value' => 1,
            ],
        ));
        //Campo DERECHOS
        $this->add(array(
            //'name' => 'checkbox',
            'type' => 'Multicheckbox',
            'name' => 'derecho',
            'options' => [
                'label_attributes' => array(
                ),
                'label' => 'Seleccione los derechos',
                'use_hidden_element' => false,
                'checked_value' => 1,
                'unchecked_value' => 0,
            ],
            'attributes' => [
            /* 'value' => 1, */
            ],
        ));
        //Campo HECHOS
        $this->add(array(
            //'name' => 'checkbox',
            'type' => 'Multicheckbox',
            'name' => 'hecho',
            'options' => [
                'label_attributes' => array(
                ),
                'label' => 'Seleccione los hechos violatorios',
                'use_hidden_element' => false,
                'checked_value' => 1,
                'unchecked_value' => 0,
            ],
            'attributes' => [
            /* 'value' => 1, */
            ],
        ));




        //**************************INPUTS RADIO*******************************/
        //Campo prioridad
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
                'required' => true
            )
        ));
        //Campo discapacidad psicosocial
        $this->add(array(
            'type' => 'Radio',
            'name' => 'lapiceroverde',
            'options' => array(
                'label' => 'Discapacidad Psicosocial',
                'label_attributes' => array(
                    'class' => 'radio-inline'
                ),
                'value_options' => array(
                    '0' => 'No',
                    '1' => 'Si'
                )
            ),
            'attributes' => array(
                'value' => '0'
            )
        ));
        //Campos sexo
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
        //Campo lgbti
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
        //Campo tipo de expediente
        $this->add(array(
            'type' => 'radio',
            'name' => 'tipoexpediente',
            'options' => array(
                'label' => '¿Qué tipo de acción amerita esta solicitud?',
                'label_attributes' => array(
                    'class' => 'radio-inline tipoexpediente'
                ),
                'value_options' => array(
                    '0' => 'Orientación',
                    '1' => 'Investigación'
                )
            )
        ));

        //***************************INPUTS TEXTAREA***************************/
        //Campo motivo
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
        //Campo observaciones
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
        //Campo hechos
        $this->add(array(
            'name' => 'hechos',
            'options' => array(
                'label' => 'Hechos',
            ),
            'attributes' => array(
                'type' => 'textarea',
                'class' => 'form-control',
                'spellcheck' => true
            )
        ));
        //Campo peticion
        $this->add(array(
            'name' => 'peticion',
            'options' => array(
                'label' => 'Petición',
            ),
            'attributes' => array(
                'type' => 'textarea',
                'class' => 'form-control'
            )
        ));
        //Campo pruebas
        $this->add(array(
            'name' => 'pruebas',
            'options' => array(
                'label' => 'Pruebas',
            ),
            'attributes' => array(
                'type' => 'textarea',
                'class' => 'form-control'
            )
        ));

        //*************************INPUTS SUBMIT*******************************/
        //Input Guardar
        $this->add(array(
            'name' => 'guardar',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Guardar',
                'class' => 'btn btn-primary btn-flat'
            )
        ));
        //Input Cancelar
        $this->add(array(
            'name' => 'cancelar',
            'attributes' => array(
                'type' => 'button',
                'id' => 'historyBack',
                'value' => 'Cancelar',
                'class' => 'btn btn-danger btn-flat'
            )
        ));
        //Input Modificar
        $this->add(array(
            'name' => 'cambiar',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Cambiar tipo',
                'class' => 'btn btn-warning btn-flat',
            )
        ));
        //Input Buscar
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
