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
            'name' => 'idp',
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

        //Campo direccion denunciante
        $this->add(array(
            'name' => 'direccionden',
            'options' => array(
                'label' => 'Dirección',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control'
            )
        ));

        //Campo lugar remision
        $this->add(array(
            'name' => 'lugarremision',
            'options' => array(
                'label' => 'Insitución a la que remite',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control'
            )
        ));

        //Campo telefono
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


        //Campo correo
        $this->add(array(
            'name' => 'correo',
            'options' => array(
                'label' => 'Correo electrónico',
            ),
            'attributes' => array(
                'type' => 'Zend\Form\Element\Email',
                'class' => 'form-control'
            )
        ));

        //************************INPUTS NUMBER****************************/
        $this->add(array(
            'name' => 'edad',
            'options' => array(
                'label' => 'Edad',
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
        //Campo unidad
        $this->add(array(
            'type' => 'select',
            'name' => 'unidad',
            'options' => array(
                'label' => 'Unidad / Oficina',
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
                    '1' => 'Rural',
                    '2' => 'Urbana'
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

        //************************INPUTS DATE*****************************/
        //Fecha solicitud
        $this->add(array(
            'name' => 'fechasol',
            'options' => array(
                'label' => 'Fecha',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control'
            )
        ));
        //Campo fecha de nacimiento
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
        //Campo fecha hechos
        $this->add(array(
            'name' => 'fechahecho',
            'options' => array(
                'label' => 'Fecha',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control datepicker'
            )
        ));


        //**************************INPUTS TIME********************************/
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

        //**************************INPUTS CHECKBOX****************************/
        //Campo anonimo
        $this->add(array(
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
            'name' => 'derecho[]'
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
        //Campo INSTITUCIONES
        $this->add(array(
            //'name' => 'checkbox',
            'type' => 'Multicheckbox',
            'name' => 'institucion[]'
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
                    'H' => 'Heterosexual',
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
                    '1' => 'Orientación',
                    '4' => 'Investigación'
                )
            )
        ));

        //Campo remision
        $this->add(array(
            'type' => 'radio',
            'name' => 'remision',
            'options' => array(
                'label' => '¿Necesita remitir a otra institución?',
                'label_attributes' => array(
                    'class' => 'radio-inline'
                ),
                'value_options' => array(
                    '1' => 'Si',
                    '2' => 'No'
                )
            )
        ));

        //************** victima *****************/
        $this->add(array(
            'type' => 'Radio',
            'name' => 'victima',
            'options' => array(
                'label' => 'Víctima',
                'label_attributes' => array(
                    'class' => 'radio-inline'
                ),
                'value_options' => array(
                    '1' => 'Si',
                    '0' => 'No'
                )
            ),
            'attributes' => array(
                'required' => true
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
            'name' => 'deschechos',
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
        //Campo pruebas
        $this->add(array(
            'name' => 'detalleorientacion',
            'options' => array(
                'label' => 'Detalle de la orientación',
            ),
            'attributes' => array(
                'type' => 'textarea',
                'class' => 'form-control'
            )
        ));



        //*************************INPUTS SUBMIT*******************************/
        //Input Guardar
        $this->add(array(
            'type' => 'Button',
            'name' => 'guardar',
            'options' => array(
                'label' => '<i class="glyphicon glyphicon-floppy-disk"></i> Guardar',
                'label_options' => array(
                    'disable_html_escape' => true,
                )
            ),
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

        //Input siguiente
        $this->add(array(
            'type' => 'Button',
            'name' => 'siguiente',
            'options' => array(
                'label' => 'Siguiente <i class="glyphicon glyphicon-chevron-right"></i>',
                'label_options' => array(
                    'disable_html_escape' => true,
                )
            ),
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Siguiente',
                'class' => 'btn btn-success btn-flat pull-right'
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
        //Input Imprimir
        $this->add(array(
            'type' => 'Button',
            'name' => 'imprimir',
            'options' => array(
                'label' => '<i class="glyphicon glyphicon-print"></i> Imprimir',
                'label_options' => array(
                    'disable_html_escape' => true,
                )
            ),
            'attributes' => array(
                //'type' => 'button',
                'value' => 'Imprimir',
                'class' => 'btn btn-default btn-flat'
            )
        ));
    }

}
