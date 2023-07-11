<section class="content-header">
	<form id="exp_excel" style="float:right;padding:0px;margin: 0px;" method="post" action="<?php echo base_url();?>transferencia/excel/<?php echo $permisos->opc_id?>/<?php echo $fec1?>/<?php echo $fec2?>" onsubmit="return exportar_excel()"  >
        	<input type="submit" value="EXCEL" class="btn btn-success" />
        	<input type="hidden" id="datatodisplay" name="datatodisplay">
       	</form>
      <h1>
        Transferencias
      </h1>
</section>
<section class="content">
	<div class="box box-solid">
		<div class="box box-body">
			
			<div class="row">
				
				<div class="col-md-8">
					<div class="col-md-2">
					<?php 
					if($permisos->rop_insertar){
					?>
						<a href="<?php echo base_url();?>transferencia/nuevo/<?php echo $opc_id?>" class="btn btn-success btn-flat"><span class="fa fa-plus"></span> Nueva Transferencia</a>
					<?php 
					}
					?>
					</div>	
					</br></br></br>
					<form action="<?php echo $buscar;?>" method="post" id="frm_buscar">
						
					<table width="100%">
						<tr>
							<td><label>Buscar:</label></td>
							<td><input type="text" id='txt' name='txt' class="form-control" style="width: 180px" value='<?php echo $txt?>'/></td>
							<td hidden>
								<select name="tipo" id="tipo" class="form-control" style="width: 200px">
									<option value="26">PRODUCTO TERMINADO</option>
									<option value="69">MATERIA PRIMA</option>
								</select>
								<script>
									var tp="<?php echo $ids?>";
									tipo.value=tp;
								</script>
							</td>
							<td><label>Desde:</label></td>
							<td><input type="date" id='fec1' name='fec1' class="form-control" style="width: 150px" value='<?php echo $fec1?>' /></td>
							<td><label>Hasta:</label></td>
							<td><input type="date" id='fec2' name='fec2' class="form-control" style="width: 150px" value='<?php echo $fec2?>' /></td>
							
						</tr>
						
					</table>
					<br>
					<div class="row">
						<div class="col-md-12">
							<button type="submit" class="btn btn-info"><span class="fa fa-search"></span> Buscar</button>
						</div>
					</div>	
					</form>
				</div>		
				
			</div>
			<br>
			<div class="row">
				<div class="col-md-12">
					<table id="tbl_list" class="table table-bordered table-list table-hover table-striped" width="100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Fecha</th>
								<th>Usuario</th>
								<th>Origen</th>
								<th>Documento No</th>
								<th>Documento/Informacion</th>
								<th>Destino</th>
								<th>Codigo</th>
								<th>Descripcion</th>
								<th>Unidad</th>
								<th>Cantidad</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						$dec=$dec->con_valor;
						$dcc=$dcc->con_valor;
						$grup='';
						$n=0;
						if(!empty($transferencias)){
							foreach ($transferencias as $transferencia) {
								$n++;
								    
						?>
							<tr>
								<td><?php echo $n?></td>
								<td><?php echo $transferencia->mov_fecha_trans?></td>
								<td><?php echo $transferencia->mov_usuario?></td>
								<td><?php echo $transferencia->emi_nombre?></td>
								<td style="mso-number-format:'@'"><?php echo $transferencia->mov_documento?></td>
								<td style="mso-number-format:'@'"><?php echo $transferencia->mov_guia_transporte?></td>
								<td><?php echo $transferencia->cli_raz_social?></td>
								<td style="mso-number-format:'@'"><?php echo $transferencia->mp_c?></td>
								<td><?php echo $transferencia->mp_d?></td>
								<td><?php echo $transferencia->mp_q?></td>
								<td class="number"><?php echo str_replace(',','', number_format($transferencia->mov_cantidad,$dcc))?></td>
								<?php
								if($grup!=$transferencia->mov_documento){
									if($permisos->rop_reporte){
								?>
								<td>
										<a href="#" onclick="envio('<?php echo $transferencia->mov_documento?>',1)" class="btn btn-warning" title="RIDE"> <span class="fa fa-file-pdf-o" ></span></a>
								</td>		
								<?php 
									}
								
								}else{
								?>
								<td></td>
								<?php
								}
								?>
							</tr>
						<?php
								$grup=$transferencia->mov_documento;
							}
						}
						?>
						</tbody>
					</table>
				</div>	
			</div>
		</div>
	</div>

<style>
td{
	font-size: 11px !important;
}
.number{
	text-align: right !important;
}	
</style>
<script type="text/javascript">
	function envio(id,opc){
		if(opc==0){
			url='<?php echo $buscar?>';
		}else if(opc==1){
			url="<?php echo base_url();?>transferencia/show_frame/"+id+"/<?php echo $permisos->opc_id?>";
		}
		
		$('#frm_buscar').attr('action',url);
		$('#frm_buscar').submit();
	}
</script>
</section>

