<?php

namespace DoctrineORMModule\Proxy\__CG__\Procuracion\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Persona extends \Procuracion\Entity\Persona implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = [];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'id', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'anonimo', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'nombres', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'apellidos', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'tipodocumento', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'numerodocumento', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'sexo', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'lgbti', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'fechanacimiento', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'edad', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'direccion', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'depto', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'muni', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'updated_at', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'updated_by'];
        }

        return ['__isInitialized__', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'id', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'anonimo', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'nombres', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'apellidos', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'tipodocumento', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'numerodocumento', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'sexo', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'lgbti', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'fechanacimiento', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'edad', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'direccion', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'depto', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'muni', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'updated_at', '' . "\0" . 'Procuracion\\Entity\\Persona' . "\0" . 'updated_by'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Persona $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setAnonimo($anonimo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAnonimo', [$anonimo]);

        return parent::setAnonimo($anonimo);
    }

    /**
     * {@inheritDoc}
     */
    public function getAnonimo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAnonimo', []);

        return parent::getAnonimo();
    }

    /**
     * {@inheritDoc}
     */
    public function setNombres($nombres)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNombres', [$nombres]);

        return parent::setNombres($nombres);
    }

    /**
     * {@inheritDoc}
     */
    public function getNombres()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNombres', []);

        return parent::getNombres();
    }

    /**
     * {@inheritDoc}
     */
    public function setApellidos($apellidos)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setApellidos', [$apellidos]);

        return parent::setApellidos($apellidos);
    }

    /**
     * {@inheritDoc}
     */
    public function getApellidos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getApellidos', []);

        return parent::getApellidos();
    }

    /**
     * {@inheritDoc}
     */
    public function setTipodocumento($tipodocumento)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTipodocumento', [$tipodocumento]);

        return parent::setTipodocumento($tipodocumento);
    }

    /**
     * {@inheritDoc}
     */
    public function getTipodocumento()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTipodocumento', []);

        return parent::getTipodocumento();
    }

    /**
     * {@inheritDoc}
     */
    public function setNumerodocumento($numerodocumento)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNumerodocumento', [$numerodocumento]);

        return parent::setNumerodocumento($numerodocumento);
    }

    /**
     * {@inheritDoc}
     */
    public function getNumerodocumento()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNumerodocumento', []);

        return parent::getNumerodocumento();
    }

    /**
     * {@inheritDoc}
     */
    public function setSexo($sexo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSexo', [$sexo]);

        return parent::setSexo($sexo);
    }

    /**
     * {@inheritDoc}
     */
    public function getSexo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSexo', []);

        return parent::getSexo();
    }

    /**
     * {@inheritDoc}
     */
    public function setLgbti($lgbti)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLgbti', [$lgbti]);

        return parent::setLgbti($lgbti);
    }

    /**
     * {@inheritDoc}
     */
    public function getLgbti()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLgbti', []);

        return parent::getLgbti();
    }

    /**
     * {@inheritDoc}
     */
    public function setFechanacimiento($fechanacimiento)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFechanacimiento', [$fechanacimiento]);

        return parent::setFechanacimiento($fechanacimiento);
    }

    /**
     * {@inheritDoc}
     */
    public function getFechanacimiento()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFechanacimiento', []);

        return parent::getFechanacimiento();
    }

    /**
     * {@inheritDoc}
     */
    public function setEdad($edad)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEdad', [$edad]);

        return parent::setEdad($edad);
    }

    /**
     * {@inheritDoc}
     */
    public function getEdad()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEdad', []);

        return parent::getEdad();
    }

    /**
     * {@inheritDoc}
     */
    public function setDireccion($direccion)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDireccion', [$direccion]);

        return parent::setDireccion($direccion);
    }

    /**
     * {@inheritDoc}
     */
    public function getDireccion()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDireccion', []);

        return parent::getDireccion();
    }

    /**
     * {@inheritDoc}
     */
    public function setDepto(\Procuracion\Entity\Departamento $depto = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDepto', [$depto]);

        return parent::setDepto($depto);
    }

    /**
     * {@inheritDoc}
     */
    public function getDepto()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDepto', []);

        return parent::getDepto();
    }

    /**
     * {@inheritDoc}
     */
    public function setMuni(\Procuracion\Entity\Municipio $muni = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMuni', [$muni]);

        return parent::setMuni($muni);
    }

    /**
     * {@inheritDoc}
     */
    public function getMuni()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMuni', []);

        return parent::getMuni();
    }

    /**
     * {@inheritDoc}
     */
    public function setUpdatedBy(\Procuracion\Entity\Usuario $usuario = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUpdatedBy', [$usuario]);

        return parent::setUpdatedBy($usuario);
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdatedBy()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUpdatedBy', []);

        return parent::getUpdatedBy();
    }

}
