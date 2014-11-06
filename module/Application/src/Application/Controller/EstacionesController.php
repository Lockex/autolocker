<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

use Zend\Form\FormInterface;

use Application\Form\EstacionesForm;

use CsnUser\Entity\Estaciones;
use CsnUser\Entity\Usuariosestaciones;

class EstacionesController extends AbstractActionController
{
	/**
     * @var Doctrine\ORM\EntityManager
     */
    protected $_objectManager;

    public function estacionesAction()
    {
        return new ViewModel();
    }

    public function listaestacionesAction() 
    {
    	$this->layout('layout/vacio');
    	$query = $this->getObjectManager()->createQuery("SELECT e FROM CsnUser\Entity\Estaciones e");
    	$estaciones = $query->getArrayResult();
        $objEstaciones = json_encode($estaciones);
    	$resultado = array('estaciones' => $estaciones,'objEstaciones' => $objEstaciones);
    	return new ViewModel($resultado);
    }

    public function crearestacionAction()
    {
    	$form = new EstacionesForm($this->getObjectManager(),$this->identity()->getID());
    	$this->layout('layout/vacio');
    	
    	$id = $this->params()->fromRoute('id');
    	$resultado = array('form' => $form, 'mensajes' => $form->getMessages(),'idEstacion' => '');
    	if($id){
    		$queryEstacion = $this->getObjectManager()->createQuery("SELECT e FROM CsnUser\Entity\Estaciones e WHERE e.ID = $id");
    		$dEstacion = $queryEstacion->getArrayResult();
    		$queryEmpleados = $this->getObjectManager()->createQuery("SELECT em,u.ID as USUARIO FROM CsnUser\Entity\Usuariosestaciones em JOIN em.USUARIO u WHERE em.ESTACION = $id");
    		$usuariosEstacion = $queryEmpleados->getArrayResult();
    		$usuarios = array();
    		foreach ($usuariosEstacion as $usuarioEst) {
    			$usuarios[] = $usuarioEst['USUARIO'];
    		}
    		$form->get('NOMBRE')->setAttribute('value',$dEstacion[0]['NOMBRE']);
    		$form->get('LATITUD')->setAttribute('value',$dEstacion[0]['LATITUD']);
    		$form->get('LONGITUD')->setAttribute('value',$dEstacion[0]['LONGITUD']);
    		$form->get('LATITUD2')->setAttribute('value',$dEstacion[0]['LATITUD2']);
    		$form->get('LONGITUD2')->setAttribute('value',$dEstacion[0]['LONGITUD2']);
    		$form->get('USUARIOS')->setAttribute('value',$usuarios);
    		$resultado['idEstacion'] = $id;
    	}
    	if($this->request->isPost()){
            $form->setData($this->request->getPost());
            if($form->isValid()) {
            	$resultado = array('form' => $form, 'mensajes' => $form->getMessages());
            	$hydrator = new DoctrineObject(
            	            $this->getObjectManager(),
            	            'CsnUser\Entity\Estaciones'
            	        );
            	$estaciones = new Estaciones();
                $data = $form->getData(FormInterface::VALUES_AS_ARRAY);
                $estaciones = $hydrator->hydrate($data,$estaciones);
                $estaciones->setEstado(true);
                $estaciones->setUSUARIO($this->getObjectManager()->find('CsnUser\Entity\User',$this->identity()->getId());
                if($id) {
                	$estaciones->setID($id);
                	$this->getObjectManager()->merge($estaciones);
                	$this->getObjectManager()->flush();
                	
                } else {
                	$this->getObjectManager()->persist($estaciones);
                	$this->getObjectManager()->flush();
                }
                foreach ($usuarios as $usuario) {
                	$Usuariosestaciones = new Usuariosestaciones();
                	$Usuariosestaciones->setUSUARIO($this->getObjectManager()->find('CsnUser\Entity\Empleados',$usuario));
                	$Usuariosestaciones->setESTACION($this->getObjectManager()->find('CsnUser\Entity\Estaciones',$estaciones->getID()));
                	$borrarusuario = $this->getObjectManager()->merge($Usuariosestaciones);
                	$this->getObjectManager()->remove($borrarusuario);
                }
                $this->getObjectManager()->flush();
                foreach($data['USUARIOS'] as $empleado) {

                	$Usuariosestaciones = new Usuariosestaciones();
                	$Usuariosestaciones->setUSUARIO($this->getObjectManager()->find('CsnUser\Entity\Empleados',$empleado));
                	$Usuariosestaciones->setESTACION($this->getObjectManager()->find('CsnUser\Entity\Estaciones',$estaciones->getID()));
                	$this->getObjectManager()->persist($Usuariosestaciones);
                	
                }
                $this->getObjectManager()->flush();
            }

            $data = $form->getData(FormInterface::VALUES_AS_ARRAY);
            return new JsonModel($resultado);
        } else {	
        	return new ViewModel($resultado);	
        }
    	
    }
     /**
     * get entityManager
     *
     * @return Doctrine\ORM\EntityManager
     */   
    protected function getObjectManager()
    {
          if (!$this->_objectManager) {
              $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
          }

          return $this->_objectManager;
    }
}
