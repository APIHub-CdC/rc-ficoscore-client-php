# rc-ficoscore-client-php
Esta API reporta el historial crediticio, el cumplimiento de pago de los compromisos que la persona ha adquirido con entidades financieras, no financieras e instituciones comerciales que dan crédito o participan en actividades afines al crédito. En esta versión se retornan los campos del Crédito Asociado a Nomina (CAN) en el nodo de créditos.
<br/><img src='https://github.com/APIHub-CdC/imagenes-cdc/blob/master/circulo_de_credito-apihub.png' height='37' width='160'/><br/>

## Requisitos

PHP 7.1 ó superior


### Dependencias adicionales
- Se debe contar con las siguientes dependencias de PHP:
    - ext-curl
    - ext-mbstring
- En caso de no ser así, para linux use los siguientes comandos

```sh
#ejemplo con php en versión 7.3 para otra versión colocar php{version}-curl
apt-get install php7.3-curl
apt-get install php7.3-mbstring
```
- Composer [vea como instalar][1]

## Instalación

Ejecutar: `composer install`

## Guía de inicio

### Paso 1. Agregar el producto a la aplicación

Al iniciar sesión seguir los siguientes pasos:

 1. Dar clic en la sección "**Mis aplicaciones**".
 2. Seleccionar la aplicación.
 3. Ir a la pestaña de "**Editar '@tuApp**' ".
    <p align="center">
      <img src="https://github.com/APIHub-CdC/imagenes-cdc/blob/master/edit_applications.jpg" width="900">
    </p>
 4. Al abrirse la ventana emergente, seleccionar el producto.
 5. Dar clic en el botón "**Guardar App**":
    <p align="center">
      <img src="https://github.com/APIHub-CdC/imagenes-cdc/blob/master/selected_product.jpg" width="400">
    </p>

### Paso 2. Capturar los datos de la petición

Los siguientes datos a modificar se encuentran en ***test/Api/ReporteDeCreditoConFicoScoreApiTest.php***

Es importante contar con el setUp() que se encargará de inicializar la url. Modificar la URL ***('the_url')*** de la petición del objeto ***$config***, como se muestra en el siguiente fragmento de código:

```php
<?php
public function setUp()
    {
        $password = getenv('KEY_PASSWORD');
        $this->signer = new KeyHandler(null, null, $password);

        
        $events = new MiddlewareEvents($this->signer);
        $handler = \GuzzleHttp\HandlerStack::create();
        $handler->push($events->add_signature_header('x-signature'));
        $handler->push($events->verify_signature_header('x-signature'));
        $config = new \rc\ficoscore\Client\Configuration();
        $config->setHost('the_url');
        
        $client = new \GuzzleHttp\Client(['handler' => $handler]);
        $this->apiInstance = new ReporteDeCreditoConFicoScoreApi($client, $config);


        $this->x_api_key = "your_api_key";
        $this->username = "your_username";
        $this->password = "your_password";
    }
```
```php

public function testGetReporte()
    {

        $persona = new PersonaPeticion();
        $estado = new CatalogoEstados();
        $domicilio = new DomicilioPeticion();

        $persona->setPrimerNombre("XX");
        $persona->setApellidoPaterno("XX");
        $persona->setApellidoMaterno("XX");
        $persona->setFechaNacimiento("XX");
        $persona->setRfc("XX");
        $persona->setNacionalidad("XX");

        $domicilio->setDireccion("XX");
        $domicilio->setColoniaPoblacion("XX");
        $domicilio->setDelegacionMunicipio("XX");
        $domicilio->setCiudad("XX");
        $domicilio->setEstado($estado::MEX);
        $domicilio->setCp("XX");
        $domicilio->setFechaResidencia("XX");
        $domicilio->setNumeroTelefono("XX");
        $domicilio->setTipoDomicilio("XX");
        $domicilio->setTipoAsentamiento("XX");

        $persona->setDomicilio($domicilio);

        try {
            $result = $this->apiInstance->getReporte($this->x_api_key, $this->username, $this->password, $persona);
            $this->signer->close();
            print_r($result);
            $this->assertTrue($result->getFolioConsulta()!==null);
            return $result->getFolioConsulta();
        } catch (ApiException $e) {
            echo 'Exception when calling ReporteDeCreditoConFicoScoreApi->getReporte: ', $e->getMessage(), PHP_EOL;
        }

    }


```
## Pruebas unitarias

Para ejecutar las pruebas unitarias:

```sh
./vendor/bin/phpunit
```

---
[TERMINOS Y CONDICIONES](https://github.com/APIHub-CdC/licencias-cdc)

[1]: https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos