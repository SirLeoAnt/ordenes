<?php
global $objModulo;
switch($objModulo->getId()){
	case 'reporte':
		$db = TBase::conectaDB();
		if (in_array($userSesion->getIdTipo(), array(1, 3, 5)))
			$rs = $db->Execute("select * from sucursal");
		else
			$rs = $db->Execute("select * from sucursal where idSucursal in (select idSucursal from usuariosucursal where idUsuario = ".$userSesion->getId().")");
		$datos = array();
		while(!$rs->EOF){
			$rs->fields['json'] = json_encode($rs->fields);
			
			array_push($datos, $rs->fields);
			$rs->moveNext();
		}
		
		$smarty->assign("sucursales", $datos);
	break;
	case 'listaOrdenesReportes':
		$db = TBase::conectaDB();
		global $userSesion;
		//$sucursal = $userSesion->sucursal->getId();
		$sucursal = $_POST['sucursal'] == ''?$sucursal:$_POST['sucursal'];
		$estado = $_POST['estado'];
		
		if ($_POST['sucursal'] == '')
			$rs = $db->Execute("select a.*, b.nombre as vendedor, c.nombre as sucursal, d.color as colorEstado, observaciones, descripcion, d.nombre as estado, if(cast(registro as date) < cast(now() as date), 1, 0) as actual, f.nombre as area from orden a join vendedor b using(idVendedor) join sucursal c using(idSucursal) join estado d using(idEstado) join movimiento e using(idOrden) join area f using(idArea) where idSucursal in (select idSucursal from usuariosucursal where idUsuario = ".$userSesion->getId().") and ".($estado == ''?"":("and idEstado = ".$estado)));
		else
			$rs = $db->Execute("select a.*, b.nombre as vendedor, observaciones, descripcion, c.nombre as sucursal, d.color as colorEstado, d.nombre as estado, if(cast(registro as date) < cast(now() as date), 1, 0) as actual, f.nombre as area from orden a join vendedor b using(idVendedor) join sucursal c using(idSucursal) join estado d using(idEstado) join movimiento e using(idOrden) join area f using(idArea) where idSucursal = ".$sucursal." ".($estado == ''?"":("and idEstado = ".$estado)));
		$datos = array();
		while(!$rs->EOF){
			$rs->fields['json'] = json_encode($rs->fields);
			
			array_push($datos, $rs->fields);
			$rs->moveNext();
		}
		
		$smarty->assign("lista", $datos);
	break;
	case 'creportes':
		switch($objModulo->getAction()){
			case 'getResumen':
				$db = TBase::conectaDB();
				
				$rsEstado = $db->Execute("select * from estado");
				$datos = array();
				while(!$rsEstado->EOF){
					$rs = $db->Execute("select count(*) as total from orden where idEstado = ".$rsEstado->fields['idEstado']." and idSucursal = ".($_POST['sucursal'] == ''?$pageSesion->sucursal->getId():$_POST['sucursal']));
					$rsEstado->fields['total'] = $rs->fields['total'];
					
					array_push($datos, $rsEstado->fields);
					$rsEstado->moveNext();
				}
				
				echo json_encode(array("estados" => $datos));
			break;
		}
	break;
}
?>