<?php

namespace rc\ficoscore\Client;

use \rc\ficoscore\Client\Configuration;
use \rc\ficoscore\Client\ApiException;
use \rc\ficoscore\Client\ObjectSerializer;

use rc\ficoscore\Client\Model\CatalogoEstados;
use rc\ficoscore\Client\Model\PersonaPeticion;
use rc\ficoscore\Client\Model\DomicilioPeticion;

use \rc\ficoscore\Client\Api\ReporteDeCreditoConFicoScoreApi;

use Signer\Manager\Interceptor\MiddlewareEvents;
use Signer\Manager\Interceptor\KeyHandler;


class ReporteDeCreditoConFicoScoreApiTest extends \PHPUnit_Framework_TestCase
{
    
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
        $this->x_full_report = 'false';
    }
    
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
            $result = $this->apiInstance->getReporte($this->x_api_key, $this->username, $this->password, $persona, $this->x_full_report);
            $this->signer->close();
            print_r($result);
            $this->assertTrue($result->getFolioConsulta()!==null);
            return $result->getFolioConsulta();
        } catch (ApiException $e) {
            echo 'Exception when calling ReporteDeCreditoConFicoScoreApi->getReporte: ', $e->getMessage(), PHP_EOL;
        }

    }


    /**
     * @depends testGetReporte
     */    
    
    public function testGetConsultas($folioConsulta)
    {
        if($this->x_full_report == "false") {
            try {
                $result = $this->apiInstance->getConsultas($folioConsulta, $this->x_api_key, $this->username, $this->password);
                $this->signer->close();
                print_r($result);
                $this->assertTrue($result->getConsultas()!==null);
            } catch (ApiException $e) {
                echo 'Exception when calling ReporteDeCreditoConFicoScoreApi->testGetConsultas: ', $e->getMessage(), PHP_EOL;
            }
        } else {
            print_r("x_full_report inicializado en true");
        }
    }


    /**
     * @depends testGetReporte
     */
    
    public function testGetCreditos($folioConsulta)
    {
        if($this->x_full_report == "false") {
            try {
                $result = $this->apiInstance->getCreditos($folioConsulta, $this->x_api_key, $this->username, $this->password);
                $this->signer->close();
                print_r($result);
                $this->assertTrue($result->getCreditos()!==null);
            } catch (ApiException $e) {
                echo 'Exception when calling ReporteDeCreditoConFicoScoreApi->testGetCreditos: ', $e->getMessage(), PHP_EOL;
            }
        } else {
            print_r("x_full_report inicializado en true");
        }        
    }

    /**
     * @depends testGetReporte
     */
    
    public function testGetDomicilios($folioConsulta)
    {
        if($this->x_full_report == "false") {
            try {
                $result = $this->apiInstance->getDomicilios($folioConsulta, $this->x_api_key, $this->username, $this->password);
                $this->signer->close();
                print_r($result);
                $this->assertTrue($result->getDomicilios()!==null);
            } catch (ApiException $e) {
                echo 'Exception when calling ReporteDeCreditoConFicoScoreApi->testGetDomicilios: ', $e->getMessage(), PHP_EOL;
            }
        } else {
            print_r("x_full_report inicializado en true");
        }          
    }
    

    /**
     * @depends testGetReporte
     */
    
    public function testGetEmpleos($folioConsulta)
    {
        if($this->x_full_report == "false") {
            try {
                $result = $this->apiInstance->getEmpleos($folioConsulta, $this->x_api_key, $this->username, $this->password);
                $this->signer->close();
                print_r($result);
                $this->assertTrue($result->getEmpleos()!==null);
            } catch (ApiException $e) {
                echo 'Exception when calling ReporteDeCreditoConFicoScoreApi->testGetEmpleos: ', $e->getMessage(), PHP_EOL;
            }
        } else {
            print_r("x_full_report inicializado en true");
        }          
    }

    /**
     * @depends testGetReporte
     */
    public function testGetScores($folioConsulta)
    {
        if($this->x_full_report == "false") {
            try {
                $result = $this->apiInstance->getScores($folioConsulta, $this->x_api_key, $this->username, $this->password);
                $this->signer->close();
                print_r($result);
                $this->assertTrue($result->getScores()!==null);
            } catch (ApiException $e) {
                echo 'Exception when calling ReporteDeCreditoConFicoScoreApi->testGetScores: ', $e->getMessage(), PHP_EOL;
            }
        } else {
            print_r("x_full_report inicializado en true");
        }         
    }

    /**
     * @depends testGetReporte
     */
    public function testGetMensajes($folioConsulta)
    {
        if($this->x_full_report == "false") {
            try {
                $result = $this->apiInstance->getMensajes($folioConsulta, $this->x_api_key, $this->username, $this->password);
                $this->signer->close();
                print_r($result);
                $this->assertTrue($result->getMensajes()!==null);
            } catch (ApiException $e) {
                echo 'Exception when calling ReporteDeCreditoConFicoScoreApi->testGetMensajes: ', $e->getMessage(), PHP_EOL;
            }
        } else {
            print_r("x_full_report inicializado en true");
        }         
    }
    
}
