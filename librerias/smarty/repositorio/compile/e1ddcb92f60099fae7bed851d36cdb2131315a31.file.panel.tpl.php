<?php /* Smarty version Smarty-3.1.11, created on 2016-10-03 13:00:14
         compiled from "templates/plantillas/modulos/reportes/panel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:27139084857f2923bab0f29-49541800%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e1ddcb92f60099fae7bed851d36cdb2131315a31' => 
    array (
      0 => 'templates/plantillas/modulos/reportes/panel.tpl',
      1 => 1475517613,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27139084857f2923bab0f29-49541800',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57f2923bae3568_97631893',
  'variables' => 
  array (
    'PAGE' => 0,
    'sucursales' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57f2923bae3568_97631893')) {function content_57f2923bae3568_97631893($_smarty_tpl) {?><div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Ordenes</h1>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-body">
		<?php if ($_smarty_tpl->tpl_vars['PAGE']->value['usuario']->getIdTipo()==1){?>
			<form role="form" id="frmBuscar" class="form-horizontal" onsubmit="javascript: return false;">
				<div class="form-group">
					<label for="selSucursal" class="col-lg-2">Sucursal</label>
					<div class="col-lg-3">
						<select class="form-control" id="selSucursal" name="selSucursal">
							<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sucursales']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['idSucursal'];?>
" <?php if ($_smarty_tpl->tpl_vars['PAGE']->value['usuario']->sucursal->getId()==$_smarty_tpl->tpl_vars['item']->value['idSucursal']){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['nombre'];?>
</option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-info pull-right">Buscar</button>
					<input type="hidden" id="id"/>
				</div>
			</form>
		<?php }else{ ?>
			<div class="row" style="margin-left: 10px;"> <!--style="border: 1px solid #3c8dbc; margin: 5px auto;" -->
				<div class="col-md-2 text-center" style="color: <?php echo $_smarty_tpl->tpl_vars['PAGE']->value['usuario']->sucursal->getColor();?>
; background: #ecf0f5;">
					<i class="fa fa-tag fa-5x" aria-hidden="true"></i>
					<br />
					<?php echo $_smarty_tpl->tpl_vars['PAGE']->value['usuario']->sucursal->getnombre();?>

				</div>
				<div class="col-md-6">
					<h1 style="color: #3c8dbc">Orden de servicio</h1>
				</div>
			</div>
		<?php }?>
	</div>
</div>

<div id="piechart" style="width: 100%; height: 500px;"></div><?php }} ?>