/********************* eventos cargados desde inicio *************************/

$(document).ready(function() {
    $('#historyBack').click(function() {
        window.history.go(-1);
    });
    $('#numdoc').on('keypress', function(e) {
        if (e.which === 32)
            return false;
    });
    $("#editarsolicitante").click(function() {
        $("input[name='nombre']").attr('readonly', !$("input[name='nombre']").attr('readonly'));
        $("input[name='apellido']").attr('readonly', !$("input[name='apellido']").attr('readonly'));
        $("input[name='nac']").attr('readonly', !$("input[name='nac']").attr('readonly'));
        $("input[name='edad']").attr('readonly', !$("input[name='edad']").attr('readonly'));
        $("select[name='tipodoc']").attr('readonly', !$("select[name='tipodoc']").attr('readonly'));
        $("input[name='numdoc']").attr('readonly', !$("input[name='numdoc']").attr('readonly'));
        $("input[name='sexo']").attr('readonly', !$("input[name='sexo']").attr('readonly'));
        $("input[name='lgbti']").attr('readonly', !$("input[name='lgbti']").attr('readonly'));
        $("input[name='anonimo']").attr('readonly', !$("input[name='anonimo']").attr('readonly'));
    });
    $("input[name='tipoexpediente']").click(function() {
        $("#calificacion").removeClass("collapsed-box");
        $("input[name='derecho[]']").attr('checked', false);
        $("#hechosviolatorios").empty();
        $("#resumen").empty();
    });
    $("#datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd/mm/yy'});
    $(".datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd/mm/yy'});
});

/************************* funcion calificador ********************************/

function calificadorDerecho(input, url, id, comp) {
    if ($(input).is(":checked")) {
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
    } else {

        alert(id);
        $("div[data-group='" + id + "']").empty();
    }
}

/***************************** funcion departamento y municipio dependiente ******************************/

function cambiarDepto(url, depto) {
    $.ajax({
        url: url,
        dataType: 'json',
        type: 'POST',
        data: {depto: depto},
        success: function(data) {
            $.each(data, function(key, value) {
                $("select[name='muni']")
                        .append($("<option></option>")
                                .attr("value", key)
                                .text(value));
            });

        }
    });
    $("select[name='muni']").empty();
}

/**************************** funcion validar campos *************************************/

function validarNumdoc() {
    $("#numdoc").attr("required", "true");
    if ($("#numdoc").val() !== '') {
        $("#tipodoc").attr("required", "true");
    }
}

/***************************** funcion autocompletar datos con dpi ***************************/


function validarDPI(url, request, response) {
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

function completarDatosDPI(url) {
    $.ajax({
        url: url,
        dataType: "json",
        type: "POST",
        data: {
            term: $("#numdoc").val()
        },
        success: function(data) {
            if (!$("#numdoc").val()) {

            } else {
                $('#id').val(data[0]);
                $('input[name="pid"]').val(data[0]);
                $('#tipodoc').val(data[1]);
                $('#datepicker').val(data[2]);
                $('#nombres').val(data[4]);
                $('#apellidos').val(data[5]);
                var $radios = $("input[name='sexo']");
                if ($radios.is(':checked') === false) {
                    $radios.filter('[value=' + data[3] + ']').prop('checked', true);
                }
            }
        },
        error: function() {
            $('#id').val();
            $('input[name="pid"]').val();
            $('#tipodoc').val();
            $('#datepicker').val();
            $('#nombres').val();
            $('#apellidos').val();
        }
    });

}

/************************** funcion para cambiar campos cuando es anonimo ***********************/
function esAnonimo(input) {
    if ($(input).is(":checked")) {
        $("#tipodoc").attr('readonly', true).val('', true);
        $("#numdoc").attr('readonly', true).val('', true);
        $("#nombres").attr('readonly', true).val('Anónimo', true);
        $("#apellidos").attr('readonly', true).val('Anónimo', true);
        $("input[name='edad']").attr('readonly', true).val('', true);
        $("#datepicker").attr('readonly', true).val('', true);
    } else {
        $('#recepcion').trigger("reset");
        $("#tipodoc").attr('readonly', false);
        $("#numdoc").attr('readonly', false);
        $("#nombres").attr('readonly', false);
        $("#apellidos").attr('readonly', false);
        $("input[name='edad']").attr('readonly', false);
        $("#datepicker").attr('readonly', false);
    }
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

