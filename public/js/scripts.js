/********************* eventos cargados desde inicio *************************/

$(function() {
    /******************** mostrar calendarios ******************/
    $('#recepcion').validator();

    $("#datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd/mm/yy'});
    $(".datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd/mm/yy'});

    $(function($) {
        $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: '<Ant',
            nextText: 'Sig>',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
            weekHeader: 'Sm',
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['es']);
    });

    /******************** boton regresar *********************/
    $('#historyBack').click(function() {
        window.history.back();
    });

    /************** no permitir espacios en numdoc ****************/
    $('#numdoc').on('keypress', function(e) {
        if (e.which === 32)
            return false;
    });
    /************** Editar solicitante ******************/
    $("#editarsolicitante").click(function() {
        $("input[name='idpersona']").attr('disabled', !$("input[name='idpersona']").attr('disabled'));
        $("input[name='solicitante_nombre']").attr('disabled', !$("input[name='solicitante_nombre']").attr('disabled'));
        $("input[name='solicitante_apellido']").attr('disabled', !$("input[name='solicitante_apellido']").attr('disabled'));
        $("input[name='solicitante_fechanac']").attr('disabled', !$("input[name='solicitante_fechanac']").attr('disabled'));
        $("input[name='solicitante_edad']").attr('disabled', !$("input[name='solicitante_edad']").attr('disabled'));
        $("select[name='solicitante_tipodoc']").attr('disabled', !$("select[name='solicitante_tipodoc']").attr('disabled'));
        $("input[name='solicitante_numdoc']").attr('disabled', !$("input[name='solicitante_numdoc']").attr('disabled'));
        $("input[name='solicitante_sexo']").attr('disabled', !$("input[name='solicitante_sexo']").attr('disabled'));
        $("input[name='solicitante_lgbti']").attr('disabled', !$("input[name='solicitante_lgbti']").attr('disabled'));
        $("input[name='solicitante_correo']").attr('disabled', !$("input[name='solicitante_correo']").attr('disabled'));
        $("input[name='solicitante_telefono']").attr('disabled', !$("input[name='solicitante_telefono']").attr('disabled'));
        $("input[name='solicitante_direccion']").attr('disabled', !$("input[name='solicitante_direccion']").attr('disabled'));
        $("select[name='solicitante_depto']").attr('disabled', !$("select[name='solicitante_depto']").attr('disabled'));
        $("select[name='solicitante_muni']").attr('disabled', !$("select[name='solicitante_muni']").attr('disabled'));
        $("input[name='solicitante_anonimo']").attr('disabled', !$("input[name='solicitante_anonimo']").attr('disabled'));
    });

    /******************* Editar hechos ********************/
    $("#editarhechos").click(function() {
        $("input[name='idexpediente']").attr('disabled', !$("input[name='idexpediente']").attr('disabled'));
        $("input[name='hechos_fecha']").attr('disabled', !$("input[name='hechos_fecha']").attr('disabled'));
        $("select[name='hechos_ubicacion']").attr('disabled', !$("select[name='hechos_ubicacion']").attr('disabled'));
        $("input[name='hechos_direccion']").attr('disabled', !$("input[name='hechos_direccion']").attr('disabled'));
        $("select[name='hechos_depto']").attr('disabled', !$("select[name='hechos_depto']").attr('disabled'));
        $("select[name='hechos_muni']").attr('disabled', !$("select[name='hechos_muni']").attr('disabled'));
        $("textarea[name='hechos_descripcion']").attr('disabled', !$("textarea[name='hechos_descripcion']").attr('disabled'));
        $("textarea[name='hechos_peticion']").attr('disabled', !$("textarea[name='hechos_peticion']").attr('disabled'));
        $("textarea[name='hechos_pruebas']").attr('disabled', !$("textarea[name='hechos_pruebas']").attr('disabled'));
        $("input[name='tipoexpediente']").attr('disabled', !$("input[name='tipoexpediente']").attr('disabled'));
    });

    /*************** Editar orientacion *******************/
    $("#editarorientacion").click(function() {
        $("input[name='idorientacion']").attr('disabled', !$("input[name='idorientacion']").attr('disabled'));
        $("textarea[name='detalleorientacion']").attr('disabled', !$("textarea[name='detalleorientacion']").attr('disabled'));
        $("input[name='remision']").attr('disabled', !$("input[name='remision']").attr('disabled'));
        //$("input[name='institucion[]']").attr('disabled', !$("input[name='institucion[]']").attr('disabled'));
    });


    /*************** Tipo de expediente muestra la calificacion *******************/
    $("input[name='tipoexpediente']").click(function() {
        $('#calificacion').collapse('show');
        //$("#calificacion").removeClass("collapsed-box");
        $("input[name='derecho[]']").attr('checked', false);
        $("#hechosviolatorios").empty();
        $("#resumen").empty();
    });



    /*
     * Muestra y oculta instituciones si hay remision
     */
    $("input[name='remision']").click(function() {

        if ($("input[name='remision']:checked").val() === "2") {

            $("#remisiones").collapse("hide");
            $("input[name='institucion[]']").attr("disabled", true);
            $("#instdependientes").empty();
            $("#resumenremision").empty();
        } else {

            $("#remisiones").collapse("show");
            $("input[name='institucion[]']").attr("disabled", false);
        }
    });


    $("#editarhechos").click(function(e) {
        $("#guardarhechos").toggle("show");
        e.preventDefault();
    });
    $("#editarsolicitante").click(function(e) {
        $("#guardardenunciante").toggle("show");
        e.preventDefault();
    });
});

/**************************** funcion validar campos *************************************/
function validarNumdoc() {
    $("#numdoc").attr("required", "true");
}

/***************************** funcion obtener datos con dpi ***************************/
function obtenerDatos(url, request, response) {
    $.ajax({
        url: url,
        dataType: "json",
        type: "POST",
        data: {
            term: request.term
        },
        success: function(data) {
            response($.map(data, function(item) {
                return {
                    label: item,
                    value: item
                };
            }));
        }
    });
}

/********************* funcion completar formulario con datos obtenidos del dpi **********************/
function completarDatosDPI(url) {
    $.ajax({
        url: url,
        dataType: "json",
        type: "POST",
        data: {
            term: $("#numdoc").val()
        },
        success: function(data) {
            if ($("#numdoc").val()) {
                $('#id').val(data[0]);
                //$('input[name="id"]').val(data[0]);
                $('#tipodoc').val(data[1]);
                $('#fechanac').val(data[2]);
                $('#nombres').val(data[4]);
                $('#apellidos').val(data[5]);
                var radios = $("input[name='sexo']");
                if (radios.is(':checked') === false) {
                    radios.filter('[value=' + data[3] + ']').prop('checked', true);
                }
                var lgbti = $("input[name='lgbti']");
                if (lgbti.is(':checked') === false) {
                    lgbti.filter('[value=' + data[6] + ']').prop('checked', true);
                }
            }
        },
        error: function() {
            $('#id').val();
            $('input[name="idp"]').val();
            $('#tipodoc').val();
            $('#fechanac').val();
            $('#nombres').val();
            $('#apellidos').val();
        }
    });
    if ($("#numdoc").val() !== '') {
        $("#tipodoc").attr("required", "true");
    }

}

/************************** funcion para cambiar campos cuando es anonimo ***********************/
function esAnonimo(input) {
    if ($(input).is(":checked")) {
        $("#tipodoc").attr('readonly', true).val('', true);
        $("#numdoc").attr('readonly', true).val('', true);
        $("#nombres").attr('readonly', true).val('Anónimo', true);
        $("#apellidos").attr('readonly', true).val('Anónimo', true);
        $("input[name='edad']").attr('readonly', true).val('', true);
        $("#fechanac").attr('readonly', true).val('', true);
    } else {
        $('#recepcion').trigger("reset");
        $("#tipodoc").attr('readonly', false);
        $("#numdoc").attr('readonly', false);
        $("#nombres").attr('readonly', false);
        $("#apellidos").attr('readonly', false);
        $("input[name='edad']").attr('readonly', false);
        $("#fechanac").attr('readonly', false);
    }
}

/************************* funcion calificador ********************************/
function calificadorDerecho(url, id, comp) {
    $.ajax({
        url: url,
        dataType: "json",
        type: "POST",
        data: {id: id,
            comp: comp
        },
        success: function(data) {
            $.each(data, function(i) {
                $("#hechosviolatorios").append("<div class='checkbox' data-group='" + id + "' data-toogle='tooltip' title='" + data[i].desc + "'><label><input type='checkbox'  value='" + data[i].id + "' name='hechos[]'/> " + data[i].hecho + "</label></div>");
                $("[data-toogle='tooltip']").tooltip({placement: "left", trigger: "hover"});
                $("input[name='hechos[]'][value='" + data[i].id + "']").click(function() {
                    if ($(this).is(":checked")) {
                        $("#resumen").append("<div data-group='" + id + "'><p class='bg-info " + data[i].id + "'>" + data[i].hecho + "</p></div>");
                    } else {
                        $("p." + data[i].id + "").remove();
                    }
                });
            });
        }
    });
}

/************************* funcion checkbox instituciones ********************************/
function checkboxInsitucion(url, id) {
    $.ajax({
        url: url,
        dataType: "json",
        type: "POST",
        data: {id: id
        },
        success: function(data) {

            $.each(data, function(i) {
                $("#instdependientes").append("<div class='checkbox' data-group='" + id + "' data-toogle='tooltip' title='" + data[i].institucion + "'><label><input type='checkbox'  value='" + data[i].id + "' name='instdependientes[]'/> " + data[i].institucion + "</label></div>");
                $("[data-toogle='tooltip']").tooltip({placement: "left", trigger: "hover"});
                $("input[name='instdependientes[]'][value='" + data[i].id + "']").click(function() {
                    if ($(this).is(":checked")) {
                        $("#resumenremision").append("<div data-group='" + id + "'><p class='bg-info " + data[i].id + "'>" + data[i].institucion + "</p></div>");
                    } else {
                        $("p." + data[i].id + "").remove();
                    }
                });
            });

        }
    });
}

/***************************** funcion departamento y municipio dependiente ******************************/
function cambiarDepto(url, depto, prefix) {
    $.ajax({
        url: url,
        dataType: 'json',
        type: 'POST',
        data: {depto: depto},
        success: function(data) {
            $("select[name='" + prefix + "_muni']").append($("<option>Seleccione una opción</option>"));
            $.each(data, function(key, value) {
                $("select[name='" + prefix + "_muni']")
                        .append($("<option></option>")
                                .attr("value", key)
                                .text(value));
            });

        }
    });
    $("select[name='" + prefix + "_muni']").empty();
}

/***************************** funcion unidad y empleado dependiente ******************************/
function cambiarUnidad(url, unidad) {
    $.ajax({
        url: url,
        dataType: 'json',
        type: 'POST',
        data: {unidad: unidad},
        success: function(data) {
            $.each(data, function(key, value) {
                $("select[name='empleado']")
                        .append($("<option></option>")
                                .attr("value", key)
                                .text(value));
            });

        }
    });
    $("select[name='empleado']").empty();

}

/**************************** funcion validar checkboxlist ***********************************/
function validateDerecho()
{
    var derecho = $("input[name='derecho[]']").serializeArray();
    var hechos = $("input[name='hechos[]']").serializeArray();
    if ($("input[name='tipoexpediente']").is(':enabled')) {
        if (derecho.length == 0)
        {
            //alert('nothing selected');
            // cancel submit
            $("#calificacion").prepend($("<div class='col-xs-12' id='alertderecho'><div class='alert alert-danger alert-dismissible'>Debe seleccionar un derecho</div></div>").fadeIn('slow', function() {
                $(this).delay(3000).fadeOut('slow');
            }));
            return false;
        } else {
            if (hechos.length == 0) {
                $("#calificacion").prepend($("<div class='col-xs-12' id='alerthecho'><div class='alert alert-danger alert-dismissible'>Debe seleccionar un hecho violatorio</div></div>").fadeIn('slow', function() {
                    $(this).delay(3000).fadeOut('slow');
                }));
                return false;
            }
        }
    }
}

/**************************** funcion validar checkboxlist ***********************************/
function validateinstitucion()
{
    var institucion = $("input[name='institucion[]']").serializeArray();
    var instdependientes = $("input[name='instdependientes[]']").serializeArray();
    var remision = $("input[name='remision']:checked").val();
    if ($("input[name='remision']").is(':enabled')) {
        if (remision == 1) {
            if (institucion.length == 0)
            {

                // cancel submit
                $("#remisiones").prepend($("<div class='col-xs-12' id='alertderecho'><div class='alert alert-danger alert-dismissible'>Debe seleccionar un sector</div></div>").fadeIn('slow', function() {
                    $(this).delay(3000).fadeOut('slow');
                }));
                return false;
            } else {
                if (instdependientes.length == 0) {

                    $("#remisiones").prepend($("<div class='col-xs-12' id='alerthecho'><div class='alert alert-danger alert-dismissible'>Debe seleccionar una institucion</div></div>").fadeIn('slow', function() {
                        $(this).delay(3000).fadeOut('slow');
                    }));
                    return false;
                }
            }
        }
    }
}

/*************************** funcion para guardar datos **************************************/
function guardarPersona(url)
{
    var inputs = $('#denunciante :input').serializeArray();
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: url,
        data: {inputs: inputs},
        success: function(data) {
            //alert(data['nombres']);
            alert('success');
        },
        error: function() {
            alert('error');

        }
    })
    //$.post(url, data);
}

/*************************** funcion para guardar datos **************************************/
function guardarhechos(url, newURL)
{
    var inputs = $('#recepcion').serializeArray();
    $.ajax({
        type: 'POST',
        url: url,
        data: inputs,
        success: function() {
            $('#messagesuccessmodal').modal('toggle');
            top.location.href = newURL;
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $('#messageerrormodal').modal('toggle');
            console.log(textStatus, errorThrown);
        }
    });
}

/*************************** funcion para guardar datos **************************************/
function guardardenunciante(url, newURL)
{
    var inputs = $('#recepcion').serializeArray();
    $.ajax({
        type: 'POST',
        url: url,
        data: inputs,
        success: function() {
            $('#messagesuccessmodal').modal('toggle');
            top.location.href = newURL;
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $('#messageerrormodal').modal('toggle');
            console.log(textStatus, errorThrown);
        }
    });
}


/**************************** funciones efectos de botones ***********************************/
(function(window) {
    'use strict';
    var Waves = Waves || {};
    var $$ = document.querySelectorAll.bind(document);
    // Find exact position of element
    function isWindow(obj) {
        return obj !== null && obj === obj.window;
    }

    function getWindow(elem) {
        return isWindow(elem) ? elem : elem.nodeType === 9 && elem.defaultView;
    }

    function offset(elem) {
        var docElem, win,
                box = {top: 0, left: 0},
                doc = elem && elem.ownerDocument;
        docElem = doc.documentElement;
        if (typeof elem.getBoundingClientRect !== typeof undefined) {
            box = elem.getBoundingClientRect();
        }
        win = getWindow(doc);
        return {
            top: box.top + win.pageYOffset - docElem.clientTop,
            left: box.left + win.pageXOffset - docElem.clientLeft
        };
    }

    function convertStyle(obj) {
        var style = '';
        for (var a in obj) {
            if (obj.hasOwnProperty(a)) {
                style += (a + ':' + obj[a] + ';');
            }
        }

        return style;
    }

    var Effect = {

        // Effect delay
        duration: 750,
        show: function(e, element) {

            // Disable right click
            if (e.button === 2) {
                return false;
            }

            var el = element || this;
            // Create ripple
            var ripple = document.createElement('div');
            ripple.className = 'waves-ripple';
            el.appendChild(ripple);
            // Get click coordinate and element witdh
            var pos = offset(el);
            var relativeY = (e.pageY - pos.top);
            var relativeX = (e.pageX - pos.left);
            var scale = 'scale(' + ((el.clientWidth / 100) * 10) + ')';
            // Support for touch devices
            if ('touches' in e) {
                relativeY = (e.touches[0].pageY - pos.top);
                relativeX = (e.touches[0].pageX - pos.left);
            }

            // Attach data to element
            ripple.setAttribute('data-hold', Date.now());
            ripple.setAttribute('data-scale', scale);
            ripple.setAttribute('data-x', relativeX);
            ripple.setAttribute('data-y', relativeY);
            // Set ripple position
            var rippleStyle = {
                'top': relativeY + 'px',
                'left': relativeX + 'px'
            };
            ripple.className = ripple.className + ' waves-notransition';
            ripple.setAttribute('style', convertStyle(rippleStyle));
            ripple.className = ripple.className.replace('waves-notransition', '');
            // Scale the ripple
            rippleStyle['-webkit-transform'] = scale;
            rippleStyle['-moz-transform'] = scale;
            rippleStyle['-ms-transform'] = scale;
            rippleStyle['-o-transform'] = scale;
            rippleStyle.transform = scale;
            rippleStyle.opacity = '1';
            rippleStyle['-webkit-transition-duration'] = Effect.duration + 'ms';
            rippleStyle['-moz-transition-duration'] = Effect.duration + 'ms';
            rippleStyle['-o-transition-duration'] = Effect.duration + 'ms';
            rippleStyle['transition-duration'] = Effect.duration + 'ms';
            rippleStyle['-webkit-transition-timing-function'] = 'cubic-bezier(0.250, 0.460, 0.450, 0.940)';
            rippleStyle['-moz-transition-timing-function'] = 'cubic-bezier(0.250, 0.460, 0.450, 0.940)';
            rippleStyle['-o-transition-timing-function'] = 'cubic-bezier(0.250, 0.460, 0.450, 0.940)';
            rippleStyle['transition-timing-function'] = 'cubic-bezier(0.250, 0.460, 0.450, 0.940)';
            ripple.setAttribute('style', convertStyle(rippleStyle));
        },
        hide: function(e) {
            TouchHandler.touchup(e);
            var el = this;
            var width = el.clientWidth * 1.4;
            // Get first ripple
            var ripple = null;
            var ripples = el.getElementsByClassName('waves-ripple');
            if (ripples.length > 0) {
                ripple = ripples[ripples.length - 1];
            } else {
                return false;
            }

            var relativeX = ripple.getAttribute('data-x');
            var relativeY = ripple.getAttribute('data-y');
            var scale = ripple.getAttribute('data-scale');
            // Get delay beetween mousedown and mouse leave
            var diff = Date.now() - Number(ripple.getAttribute('data-hold'));
            var delay = 350 - diff;
            if (delay < 0) {
                delay = 0;
            }

            // Fade out ripple after delay
            setTimeout(function() {
                var style = {
                    'top': relativeY + 'px',
                    'left': relativeX + 'px',
                    'opacity': '0',
                    // Duration
                    '-webkit-transition-duration': Effect.duration + 'ms',
                    '-moz-transition-duration': Effect.duration + 'ms',
                    '-o-transition-duration': Effect.duration + 'ms',
                    'transition-duration': Effect.duration + 'ms',
                    '-webkit-transform': scale,
                    '-moz-transform': scale,
                    '-ms-transform': scale,
                    '-o-transform': scale,
                    'transform': scale,
                };
                ripple.setAttribute('style', convertStyle(style));
                setTimeout(function() {
                    try {
                        el.removeChild(ripple);
                    } catch (e) {
                        return false;
                    }
                }, Effect.duration);
            }, delay);
        },
        // Little hack to make <input> can perform waves effect
        wrapInput: function(elements) {
            for (var a = 0; a < elements.length; a++) {
                var el = elements[a];
                if (el.tagName.toLowerCase() === 'input') {
                    var parent = el.parentNode;
                    // If input already have parent just pass through
                    if (parent.tagName.toLowerCase() === 'i' && parent.className.indexOf('waves-effect') !== -1) {
                        continue;
                    }

                    // Put element class and style to the specified parent
                    var wrapper = document.createElement('i');
                    wrapper.className = el.className + ' waves-input-wrapper';
                    var elementStyle = el.getAttribute('style');
                    if (!elementStyle) {
                        elementStyle = '';
                    }

                    wrapper.setAttribute('style', elementStyle);
                    el.className = 'waves-button-input';
                    el.removeAttribute('style');
                    // Put element as child
                    parent.replaceChild(wrapper, el);
                    wrapper.appendChild(el);
                }
            }
        }
    };
    /**
     * Disable mousedown event for 500ms during and after touch
     */
    var TouchHandler = {
        /* uses an integer rather than bool so there's no issues with
         * needing to clear timeouts if another touch event occurred
         * within the 500ms. Cannot mouseup between touchstart and
         * touchend, nor in the 500ms after touchend. */
        touches: 0,
        allowEvent: function(e) {
            var allow = true;
            if (e.type === 'touchstart') {
                TouchHandler.touches += 1; //push
            } else if (e.type === 'touchend' || e.type === 'touchcancel') {
                setTimeout(function() {
                    if (TouchHandler.touches > 0) {
                        TouchHandler.touches -= 1; //pop after 500ms
                    }
                }, 500);
            } else if (e.type === 'mousedown' && TouchHandler.touches > 0) {
                allow = false;
            }

            return allow;
        },
        touchup: function(e) {
            TouchHandler.allowEvent(e);
        }
    };
    /**
     * Delegated click handler for .waves-effect element.
     * returns null when .waves-effect element not in "click tree"
     */
    function getWavesEffectElement(e) {
        if (TouchHandler.allowEvent(e) === false) {
            return null;
        }

        var element = null;
        var target = e.target || e.srcElement;
        while (target.parentElement !== null) {
            if (!(target instanceof SVGElement) && target.className.indexOf('waves-effect') !== -1) {
                element = target;
                break;
            } else if (target.classList.contains('waves-effect')) {
                element = target;
                break;
            }
            target = target.parentElement;
        }

        return element;
    }

    /**
     * Bubble the click and show effect if .waves-effect elem was found
     */
    function showEffect(e) {
        var element = getWavesEffectElement(e);
        if (element !== null) {
            Effect.show(e, element);
            if ('ontouchstart' in window) {
                element.addEventListener('touchend', Effect.hide, false);
                element.addEventListener('touchcancel', Effect.hide, false);
            }

            element.addEventListener('mouseup', Effect.hide, false);
            element.addEventListener('mouseleave', Effect.hide, false);
        }
    }

    Waves.displayEffect = function(options) {
        options = options || {};
        if ('duration' in options) {
            Effect.duration = options.duration;
        }

        //Wrap input inside <i> tag
        Effect.wrapInput($$('.waves-effect'));
        if ('ontouchstart' in window) {
            document.body.addEventListener('touchstart', showEffect, false);
        }

        document.body.addEventListener('mousedown', showEffect, false);
    };
    /**
     * Attach Waves to an input element (or any element which doesn't
     * bubble mouseup/mousedown events).
     *   Intended to be used with dynamically loaded forms/inputs, or
     * where the user doesn't want a delegated click handler.
     */
    Waves.attach = function(element) {
        //FUTURE: automatically add waves classes and allow users
        // to specify them with an options param? Eg. light/classic/button
        if (element.tagName.toLowerCase() === 'input') {
            Effect.wrapInput([element]);
            element = element.parentElement;
        }

        if ('ontouchstart' in window) {
            element.addEventListener('touchstart', showEffect, false);
        }

        element.addEventListener('mousedown', showEffect, false);
    };
    window.Waves = Waves;
    document.addEventListener('DOMContentLoaded', function() {
        Waves.displayEffect();
    }, false);
}
)(window);

