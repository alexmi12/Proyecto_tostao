@extends('layouts.pedidoscomandamaster')
@section('content')
<div class="row" style="position:; height:100px; background-color:white; z-index:99">
    <div class="col-xs-12 col-sm-12 col-12 col-lg-12" style="position:fixed; top:auto; z-index:99">
            <div class="panel panel-danger">
            <div class="panel-heading">
            <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <form class="navbar-form navbar-left" role="search">
                <button type="submit" class="btn btn-default" id="btn_precuenta"><i class="fa fa-tasks"></i> Precuenta</button>
                <button type="submit" class="btn btn-default"><i class="fa fa-retweet"></i> Mover Mesa</button>
                 <button type="submit" class="btn btn-default" id="btn_cerrarmesa"><i class="fa fa-external-link"></i> Cerrar Mesa</button>
                <button type="submit" class="btn btn-default" id="ordenarpedidos"> <i class="fa fa-shopping-cart"></i>Ordenar Pedido</button>
                <button type="submit" class="btn btn-default" id="btn_salirmesa"><i class="fa fa-reply-all"></i> Regresar</button>
            </form>
          </div>
          </div>
          </div>
          </div>
    </div>
</div>
<div class="row">

	<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7" style="position:fixed;top:auto;">
            <div class="panel panel-warning">
                <div class="panel-heading">
                	<div class="row">
                		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                			<h4>Total de productos: <span class="NmrItms"></span></h4>
	                	</div>
	                	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
	                	<h4>Importe Total: <span class="montoTotalcu"></span></h4>
	                	</div>
	                </div>
                </div >
                <div style="overflow-y:scroll; height: 400px; overflow-x:hidden;">
                <ul class="list-group text-center" id="enviarcombi">

                </ul>
                <ul class="list-group text-center" id="enviarpf">
                </ul>
                <ul class="list-group list-group-flush text-center" id="productosenviados">
                @if (isset($platosp))
                	@foreach ($platosp as $dato)
						<li class="list-group-item {{$dato->estado}}" data-iddetped="{{$dato->id}}" data-estado="{{$dato->estado}}" data-enviado="1">
						<div class="row">
							<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
								{{$dato->cantidad}}
							</div>
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 text-left" style="line-height: 30px">
                                @if ($dato->estado == 'C')
                                {{HTML::image('images/I.png', 'alt', array('height'=>30, 'width'=>30))}}
                                @else
                                    {{HTML::image('images/'.$dato->estado.'.png', 'alt', array('height'=>30, 'width'=>30))}}
                                @endif
                                &nbsp;{{$dato->pnombre}}
							</div>
							<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
								S/. <span class="montoTotal">{{$dato->importefinal}}</span>
							</div>
						</div>
						</li>
					@endforeach
                @endif
                @if (isset($combinacionesp))
                	@foreach ($combinacionesp as $dato)
						<li class="list-group-item" data-enviado="1">
							<div class="row">
								<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
									{{$dato->cantidad}}
								</div>
								<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
									<ul class="list-group list-group-flush">
										@foreach ($placombinacionp[$dato->combinacion_id.'_'.$dato->combinacion_c] as $plato)
											<li class="list-group-item {{$plato->estado}} text-left" data-iddetped="{{$plato->id}}" data-estado="{{$plato->estado}}" data-tipo="c" style="line-height: 30px">
                                            @if ($plato->estado == 'C')
                                            {{HTML::image('images/I.png', 'alt', array('height'=>30, 'width'=>30))}}
                                            @else
                                                {{HTML::image('images/'.$plato->estado.'.png', 'alt', array('height'=>30, 'width'=>30))}}
                                            @endif
                                            &nbsp;{{$plato->pnombre}}
											</li>
										@endforeach
									</ul>
								</div>
								<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
									S/. <span class="montoTotal">{{$dato->preciotcomb * $dato->cantidad}}</span>
								</div>
							</div>
						</li>
					@endforeach
                @endif
                </ul>
                </div>
            </div>
	</div>
	<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xs-offset-7 col-sm-offset-7 col-md-offset-7 col-lg-offset-7" style="position:fixed;top:auto;overflow-y:scroll;height:72%;">
		<ul class="text-center" id="carta">
		@foreach ($tiposcomb as $tipocomb)
            <li>
            {{$tipocomb->TipoCombinacionNombre}}
            <ul>
            @foreach ($combinaciones[$tipocomb->TipoCombinacionId] as $pcom)
                <li><a href="javascript:void(0)" class="btn_createcombi" data-idcombi="{{$pcom->CombinacionId}}" data-combiprecio ="{{$pcom->CombinacionPrecio}}">{{$pcom->CombinacionNombre}}</a>
                </li>
            @endforeach
            </ul>
            </li>
        @endforeach
		@foreach ($familias as $familia)
			<li class="familia" data-idf="{{$familia->id}}">
			{{$familia->nombre}}
            @foreach ($platosfamilia[$familia->nombre] as $datos)
            <div class="product" data-pronombre = "{{$datos->nombre}}" 
                data-proid="{{$datos->id}}" data-proprecio = "{{$datos->precio}}"
                data-cantsabores = "
                @if ($datos->cantidadsabores)
                {{$datos->cantidadsabores}}
                @endif">
            {{HTML::image('/images/productos/shake.jpg')}}
            <h3>{{$datos->nombre}}</h3>
            <p>{{$datos->precio}}</p>
            </div>
            @endforeach
		  </li>
		@endforeach
		</ul>
	</div>
</div>
<script type="text/x-kendo-template" id="template_cestacombinaciones">
    <li class="list-group-item">
    	<div class="row">
    		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    			<div class="row">
    				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-center">
    					<a href="javascript:void(0)" class="btn btn-primary btn_pluscanti" data-iddatasour = "#:id#">
    					<span class="glyphicon glyphicon-plus"></span>
						</a>
    				</div>
    				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-center">
    					<a href="javascript:void(0)" class="btn btn-primary btn_mincanti" data-iddatasour = "#:id#">
    						<span class="glyphicon glyphicon-minus"></span>
    					</a>
    				</div>
    				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center">
    					<input type="text" value="#:cantidad#" class="form-control" >
    				</div>
    			</div>
    		</div>
    		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    			<ul class="list-group">
    			#for (var i = 0; i < fcantidad; i++) {#
    				#if( eval(producombi[i]).nombre != '-'){#
	    				<li class="list-group-item">
	    					<div class="row">
		    					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
					    			<i class="fi-clipboard-pencil notas" data-filaid ="#=id#" data-id="#=eval(producombi[i]).idprocombi#" data-procombi ="#=producombi[i]#"></i>
					    		</div>
	    						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
	    							#=eval(producombi[i]).nombre#
	    							<ul class="list-inline" id="notas_#=id#">
				    				#for (var y = eval(producombi[i]).cantidadnotas - 1; y >= 0; y--) {#
				    					<li><span class="glyphicon glyphicon-pencil"></span> #=eval(producombi[i])['notas'][y]['nombre']#</li>
				    				#}#
				    				</ul>
				    				<ul class="list-inline" id="sabores_#=id#">
				    				#for (var y = eval(producombi[i]).cantidadsabores - 1; y >= 0; y--) {#
				    					<li> #=eval(producombi[i])['sabores'][i]['nombre']#</li>
				    				#}#
				    				</ul>
				    				<ul class="list-unstyled adicionales" id="adiconales_#=id#">
				    				#for (var y = eval(producombi[i]).cantidadadicionales - 1; y >= 0; y--) {#
				    					<li> <a href="javascript:void(0)" class="btn btn-primary btn_mincanti" data-iddatasour = "#:id#">
				    						<span class="glyphicon glyphicon-minus"></span>
				    						</a>
				    						#=eval(producombi[i])['adicionales'][y]['nombre']# x #=eval(producombi[i])['adicionales'][y]['cantidad']# - S/. <span class="montoTotal">eval(producombi[i])['adicionales'][y]['precio']</span>
				    					</li>
				    				#}#
				    				</ul>
	    						</div>
	    						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
			    					<a href="javascript:void(0)" class="btn btn-info">
			    					<span class="glyphicon glyphicon-th-list"></span>
									</a>
	    						</div>
	    					</div>
	    				</li>
    				#}#
    			#}#
    			</ul>
    		</div>
    		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    			<div class="row">
    				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    					S/. #:preciot#
    				</div>
    				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    					<a href="javascript:void(0)" class="btn btn-default reitemcesta" data-iddatasour = "#:id#">
    					<span class="glyphicon glyphicon-floppy-remove"></span>
						</a>
    				</div>
    			</div>
    		</div>
    	</div>
    </li>
</script>

<script type="text/x-kendo-template" id="template_cestaproductos">
    <li class="list-group-item">
    	<div class="row">
    		<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    			<i class="fi-clipboard-pencil notas" data-filaid ="#=id#" data-id="#=idpro#"></i>
    		</div>
    		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    			<div class="row">
    				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-center">
    					<a href="javascript:void(0)" class="btn btn-primary btn_pluscanti" data-iddatasour = "#:id#">
    					<span class="glyphicon glyphicon-plus"></span>
						</a>
    				</div>
    				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-center">
    					<a href="javascript:void(0)" class="btn btn-primary btn_mincanti" data-iddatasour = "#:id#">
    						<span class="glyphicon glyphicon-minus"></span>
    					</a>
    				</div>
    				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center">
    					<input type="text" value="#:cantidad#" class="form-control" >
    				</div>
    			</div>
    		</div>
    		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
    			<p class="text-primary produnombre"  style="word-wrap: break-word;"
                #if (numsabores) {#
                    data-numsabores = #=numsabores#
                #}#
                data-iddatasour = "#:id#" >#:nombre#</p>
    				<ul class="list-inline" id="notas_#=id#">
    				#for (var i = cantidadnotas - 1; i >= 0; i--) {#
    					<li style="font-size:12px; text-align: left; margin: 5px">
                        <span class="glyphicon glyphicon-pencil"></span> #=notas[i]['nombre']#</li>
    				#}#
    				</ul>
    				<ul class="list-inline sabores" id="sabores_#=id#">
    				#for (var i = cantidadsabores - 1; i >= 0; i--) {#
    					<li style="font-size:12px; text-align: left; margin: 5px">
                         <a href="javascript:void(0)" class="btn btn-primary btn-sm btn_minsabor" 
                                data-idsabor="#=sabores[i]['idsabor']#" data-idfila = "#:id#">
                            <span class="glyphicon glyphicon-minus"></span>
                         </a>
                         #=sabores[i]['nombre']#
                        </li>
    				#}#
    				</ul>
    				<ul class="list-unstyled adicionales" id="adiconales_#=id#">
    				#for (var i = cantidadadicionales - 1; i >= 0; i--) {#
    					<li style="font-size:12px; text-align: left; margin: 5px"> 
                            <a href="javascript:void(0)" class="btn btn-primary btn_minadi" 
                                data-idadi="#=adicionales[i]['idadicional']#" data-idfila = "#:id#">
    						<span class="glyphicon glyphicon-minus"></span>
    						</a>
    						#=adicionales[i]['nombre']# x #=adicionales[i]['cantidad']# - S/. <span class="montoTotal">
                            #=adicionales[i]['preciot']#</span>
    					</li>
    				#}#
    				</ul>
    		</div>
    		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
    			<div class="row">
    				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    					S/. <span class="montoTotal">#:preciot#</span>
    				</div>
    				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    					<a href="javascript:void(0)" class="btn btn-info btn_adi" data-filaid ="#=id#" data-id="#=idpro#">
    					<span class="glyphicon glyphicon-th-list"></span>
						</a>
    				</div>
    				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    					<a href="javascript:void(0)" class="btn btn-default reitemcesta" data-iddatasour = "#:id#">
    					<span class="glyphicon glyphicon-floppy-remove"></span>
						</a>
    				</div>
    			</div>
    		</div>
    	</div>
    </li>
</script>
<script type="text/x-kendo-template" id="template_platos">
        <div class="product" data-pronombre = "#:nombre#" data-proid="#:id#" data-proprecio = "#:precio#"
         data-cantsabores = 
            #if (cantidadsabores) {# 
            #=cantidadsabores#
            #}#>
            {{HTML::image('/images/productos/shake.jpg')}}
            <h3>#:nombre#</h3>
            <p>#:kendo.toString(precio, "c")#</p>
        </div>
</script>

<script type="text/x-kendo-template" id="template_productosf">
	<li class="list-group-item #=pestado#" data-iddetped="#=iddetpedido#" data-estado="#=pestado#" data-enviado="1">
			<div class="row">
				<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
					#=cantidad#
				</div>
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 text-left" style="line-height: 30px">
                <img width="30" height="30" alt="alt" src="/images/#=pestado#.png">
                    &nbsp;#=pronombre#
				</div>
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
					S/. <span class="montoTotal">#=precio#</span>
				</div>
			</div>
	</li>
</script>

<script type="text/x-kendo-template" id="template_productosc">
	<li class="list-group-item" data-enviado="1">
		<div class="row">
			<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
				#=cantidad#
			</div>
			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
				<ul class="list-group list-group-flush">
					#for(var i in produccomb){#
						<li class="list-group-item #=produccomb[i]['pestado']# text-left" data-iddetped="#=produccomb[i]['iddetpedido']#" data-estado="#=produccomb[i]['pestado']#" data-tipo="c"
                        style="line-height: 30px">
                        <img width="30" height="30" alt="alt" src="/images/#=produccomb[i]['pestado']#.png">
                            &nbsp;#=produccomb[i]['pronombre']#
						</li>
					#}#
				</ul>
			</div>
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				S/. <span class="montoTotal">#=precio#</span>
			</div>
		</div>
	</li>
</script>

<div class="modalwindowprecuenta" style="display:none;">
        <table class="table table-striped">
        <thead style="font-size: 13px">
            <tr class="info">
                <td>Descripcion</td>
                <td>PreUni</td>
                <td>Cant</td>
                <td>PrecioT</td>
            </tr>
        </thead>
        <tbody id="listaprecuenta" style="font-size: 12px">
        <script type="text/x-kendo-template" id="template_precuenta">
        #var importefinal = 0;#
        #for (var i = 0 ; i < precuenta.length ; i++) {#
            <tr>
                <td>#=precuenta[i]['nombre']#</td>
                <td>#=precuenta[i]['preciou']#</td>
                <td>#=precuenta[i]['cantidad']#</td>
                <td>#=parseFloat(precuenta[i]['precio']).toFixed(2)#</td>
            </tr>
        #importefinal +=parseFloat(precuenta[i]['precio']); }#
        <tr>
            <td>Total</td>
            <td></td>
            <td></td>
            <td>#=parseFloat(importefinal).toFixed(2)#</td>
        </tr>
        </script>
        </tbody>
        </table>
          <button type="button" class="btn btn-danger pull-right" id="btn_cancelarpre">Cancelar</button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;" id="btn_aceptarpre">
          Aceptar</button>
</div>
<div class="modalwindowscuenta modal-content" style="width: 100%;display:none;">
    <div class="modal-body">
        <div class="pull-left" style="width: 40%">
            <div class="btn-group btn-group-lg">
              <button type="button" class="btn btn-primary" id="btn_efectivo">Efectivo</button>
              <button type="button" class="btn btn-primary" id="btn_tarjeta">Tarjeta</button>
              <button type="button" class="btn btn-primary" id="btn_vale">Vale</button>
            </div>
            <div class="cont_inputcaja">
                <div class="input-group">
                  <span class="input-group-addon" >I. Total S/. </span>
                  <input type="text" id="input_itotal" class="form-control cobrarm input_num" placeholder="S/. 0.00">
                </div>
            </div>
            <div class="cont_inputcaja">
                <div class="input-group">
                  <span class="input-group-addon ">I. Efec. S/.</span>
                  <input type="text" id="input_iefectivo" class="form-control input_num" placeholder="S/. 0.00">
                </div>
            </div>
            <div class="cont_inputcaja">
                <div class="input-group">
                  <span class="input-group-addon">I. Tarj. S/.</span>
                  <input type="text" id="input_itarjeta"  class="form-control input_num" placeholder="S/. 0.00">
                </div>
            </div>
            <div class="cont_inputcaja">
                <div class="input-group">
                  <span class="input-group-addon"   >Dig. Tarje. </span>
                  <input type="text" class="form-control" id="input_dtarjeta" placeholder="#-#-#-#">
                </div>
            </div>
            <div class="cont_inputcaja">
                <div class="input-group">
                  <span class="input-group-addon" >I. Vale &nbsp;S/. </span>
                  <input type="text" class="form-control input_num" id="input_ivale" placeholder="S/. 0.00">
                </div>
            </div>
            <div class="cont_inputcaja">
                <div class="input-group">
                  <span class="input-group-addon">I. Paga S/. </span>
                  <input type="text" class="form-control input_num" id="input_ipagado" placeholder="S/. 0.00">
                </div>
            </div>
            <div class="cont_inputcaja">
                <div class="input-group">
                  <span class="input-group-addon">Descuento</span>
                  <input type="text" class="form-control input_num" id="input_descuento"  placeholder="% Descuento">
                </div>
            </div>
            <div class="cont_inputcaja">
                <div class="input-group">
                  <span class="input-group-addon">I. Descuen</span>
                  <input type="text" class="form-control" id="input_idescuento"  placeholder="S/. Descuento">
                </div>
            </div>
            <div class="cont_inputcaja">
                <div class="input-group">
                  <span class="input-group-addon">Vuelto &nbsp;S/. </span>
                  <input type="text" class="form-control input_num" id="input_ivuelto"  placeholder="S/. 0.00">
                </div>
            </div>
        </div>
        <div class="pull-left" style="width: 50%">
            <form class="form-inline" role="form">
              <div class="form-group">
                <input type="text" id="buscar_cliente" class="form-control" placeholder="Ingrese DNI/RUC/TEXTO">
              </div>
              <a href="javascript:void(0)" class="btn btn-primary" id="btn_nuevocliente">Nuevo Cliente</a>
            </form>
            <br>
            <br>
            <div class="calculadora" style="float: left;">
                <div class="top">
                    <input class="btn_calcu clear" type="button" value="C" id="C">
                    <input type="text" value="" id="resultado" class="screen">
                </div>
                <div class="keys">
                    <input class="btn_calcu" type="button" value="1" id="1">
                    <input class="btn_calcu" type="button" value="2" id="2">
                    <input class="btn_calcu" type="button" value="3" id="3">
                    <input class="btn_calcu operator" type="button" value="+" id="+">
                    <input class="btn_calcu" type="button" value="4" id="4">
                    <input class="btn_calcu" type="button" value="5" id="5">
                    <input class="btn_calcu" type="button" value="6" id="6">
                    <input class="btn_calcu operator" type="button" value="-" id="-">
                    <input class="btn_calcu" type="button" value="7" id="7">
                    <input class="btn_calcu" type="button" value="8" id="8">
                    <input class="btn_calcu" type="button" value="9" id="9">
                    <input class="btn_calcu operator" type="button" value="*" id="*">
                    <input class="btn_calcu" type="button" value="0" id="0">
                    <input class="btn_calcu" type="button" value="." id=".">
                    <input class="btn_calcu eval" type="button" value="=" id="=">
                    <input class="btn_calcu operator" type="button" value="/" id="/">
                </div>
            </div>
            <div style="float: left; margin-left: 10px; width: 100px">
            <ul class="list-group">
                <li class="list-group-item btn_montorapido" data-valor ="10.00">
                {{HTML::image('images/10s.jpg','2 Soles',array('style'=>'width: 100%; cursor: pointer;'))}}
                </li>
                <li class="list-group-item btn_montorapido" data-valor ="20.00">
                {{HTML::image('images/20s.jpg','2 Soles',array('style'=>'width: 100%;cursor: pointer;'))}}
                </li>
                <li class="list-group-item btn_montorapido" data-valor ="50.00">
                {{HTML::image('images/50s.jpg','2 Soles',array('style'=>'width: 100%;cursor: pointer;'))}}
                </li>
                <li class="list-group-item btn_montorapido" data-valor ="100.00">
                {{HTML::image('images/100s.jpg','2 Soles',array('style'=>'width: 100%;cursor: pointer;'))}}
                </li>
                <li class="list-group-item btn_montorapido" data-valor ="200.00">
                {{HTML::image('images/200s.jpg','2 Soles',array('style'=>'width: 100%;cursor: pointer;'))}}
                </li>
                <li class="list-group-item">
                    <button type="button" class="btn btn-primary"  id="btn_montoexacto"
                style="margin-top: -8px"> M. Exact</button>
                </li>
            </ul>
            </div>
        </div>
        <div class="clearfix"></div>
        <button type="button" class="btn btn-primary pull-right"  id="btn_cobraraceptar"
                style="margin-top: -8px">
                Aceptar</button>
        <button type="button" class="btn btn-default pull-right" style="margin-right: 5px; margin-top: -8px"
        id="btn_cobrarclose">Cancelar</button>
    </div>
</div>


<div class="modalwindowspartircuenta" style="width: 100%;display:none;">
    <div class="panel panel-info">
          <div class="panel-heading">
                <h3 class="panel-title">Total a Pagar - S/. <span id="itotal_partircuenta"></span>
                <button type="button" class="btn btn-primary pull-right"  id="btn_aceptarpartircu"
                style="margin-top: -8px">
                Aceptar</button>
                <button type="button" class="btn btn-default pull-right" style="margin-right: 5px; margin-top: -8px"
                id="btn_cancelarpartircu">Cancelar</button>
                </h3>
          </div>
          <ul class="list-group list-group-flush" id="lispartircuenta">
          <script type="text/x-kendo-template" id="template_partircuenta">
              <li  data-cobrar = "#=cobrar#" class="list-group-item" 
              #if (cobrar == 1) {#
                style="background: rgba(56,156,6,0.2)"
              #}#>
                  <ul class="list-inline">
                    <li class="btn_selectitem" data-fila ="#=id#" style="width: 45%; overflow: hidden">
                          <span class="badge">#=cantidad#</span>
                            &nbsp; #=nombre#
                      </li>
                      <li style="width: 25%;overflow: hidden">
                          <a data-fila ="#=id#" href="javascript:void(0)" class="btn btn-info btn_partirminus">
                              <span class="glyphicon glyphicon-minus"></span>
                          </a>
                          <a data-fila ="#=id#" href="javascript:void(0)" class="btn btn-info btn_partirplus">
                              <span class="glyphicon glyphicon-plus"></span>
                          </a>
                      </li>
                      <li style="width: 20%; overflow: hidden; text-align: right">
                          #=precio#
                    </li>
                  </ul>
              </li>
            </script>
          </ul>
    </div>
</div>

<div class="windowsregistrarcliente" style="width:100%;display:none;">

    <div class="btn-group btn-group-lg">
      <button type="button" class="btn btn-primary" id="btn_rpersona">Persona</button>
      <button type="button" class="btn btn-primary" id="btn_rempresa">Empresa</button>
    </div>
    <br>
    <br>
    <div id="cont_cliperona" style="display: none">
        <div style="width: 500px;" class="pull-left">
            <div class="row centered-form">
            <div class="col-xs-12 col-sm-8 col-md-9 col-lg-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                            <h3 class="panel-title">Registrar Nueva Persona</h3>
                            </div>
                            <div class="panel-body">
                            <form role="form" id="frm_clipersona">
                                <div class="row">
                                    <div class="col-xs-10 col-sm-10 col-md-10">
                                        <div class="form-group">
                                        <input type="text" name="first_name" id="input_nombres" class="form-control input-sm" placeholder="Nombres">
                                        </div>
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10">
                                        <div class="form-group">
                                            <input type="text" name="last_name" id="input_apPaterno" class="form-control input-sm" placeholder="Apellido Materno">
                                        </div>
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10">
                                        <div class="form-group">
                                            <input type="text" name="last_name" id="input_apMaterno" class="form-control input-sm" placeholder="Apellido Paterno">
                                        </div>
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10">
                                        <div class="form-group">
                                            <input type="text" name="password" id="input_dni" class="form-control input-sm" placeholder="DNI">
                                        </div>
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10">
                                        <div class="form-group">
                                            <input type="text" name="password_confirmation" id="input_direccion" class="form-control input-sm" placeholder="Dirección">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 pull-right">
                                        <div class="form-group">
                                        <a href="javascript:void(0)" class="btn btn-info btn-block registrarcliente"> Registrar</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pull-left" style="margin-left: 10px; width: 300px" id="datos_persona">
            <script type="text/x-kendo-template" id="template">
                <div class="container-fluid well span6">
                    <div class="row-fluid">
                        <div class="span8">
                            <h4>Datos Persona</h4>
                            <h6>Nombres: #=nombres#</h6>
                            <h6>Apellidos: #=apPaterno# #=apMaterno#</h6>
                            <h6>DNI: #=dni#</h6>
                            <h6>Dirección: #=Direccion#</h6>
                        </div>
                    </div>
                </div>
            </script>
        </div>
    </div>

    <div id="cont_cliempresa" style="display: none">
        <div style="width: 500px;" class="pull-left">
            <div class="row centered-form">
            <div class="col-xs-12 col-sm-8 col-md-9 col-lg-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                            <h3 class="panel-title">Registrar Nueva Empresa</h3>
                            </div>
                            <div class="panel-body">
                            <form role="form" id="frm_cliempresa">
                                <div class="row">
                                    <div class="col-xs-10 col-sm-10 col-md-10">
                                        <div class="form-group">
                                        <input type="text" name="first_name" id="input_rs" class="form-control input-sm" placeholder="Razon Social">
                                        </div>
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10">
                                        <div class="form-group">
                                            <input type="text" name="password" id="input_ruc" class="form-control input-sm" placeholder="RUC">
                                        </div>
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10">
                                        <div class="form-group">
                                            <input type="text" name="password_confirmation" id="input_direccionem" class="form-control input-sm" placeholder="Dirección">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 pull-right">
                                        <div class="form-group">
                                        <a href="javascript:void(0)" class="btn btn-info btn-block registrarcliente"> Registrar</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pull-left" style="margin-left: 10px; width: 300px" id="datos_empresa">
            <script type="text/x-kendo-template" id="template_cliem">
                <div class="container-fluid well span6">
                    <div class="row-fluid">
                        <div class="span8">
                            <h4>Datos Empresa</h4>
                            <h6>Razon Soc.: #=nombres#</h6>
                            <h6>RUC: #=ruc#</h6>
                            <h6>Dirección: #=Direccion#</h6>
                        </div>
                    </div>
                </div>
            </script>
        </div>
    </div>

</div>


<div class="windowseliminarproductos" style="display:none;">
    <p>No puedes eliminar productos</p>
</div>

<style>
    input.btn{padding:8px; width:30px;}
	.product {
            float: left;
            position: relative;
            width: 111px;
            height: 170px;
            margin: 0 5px;
            padding: 0;
            z-index: 2;
        }
        .product img {
            width: 110px;
            height: 110px;
        }
        .product h3 {
            margin: 0;
            padding: 3px 5px 0 0;
            max-width: 96px;
            overflow: hidden;
            line-height: 1.1em;
            font-size: .9em;
            font-weight: normal;
            text-transform: uppercase;
            color: #999;
        }
        .product p {
            visibility: hidden;
        }
        .product:hover p {
            visibility: visible;
            position: absolute;
            width: 110px;
            height: 110px;
            top: 0;
            margin: 0;
            padding: 0;
            line-height: 110px;
            vertical-align: middle;
            text-align: center;
            color: #fff;
            background-color: rgba(0,0,0,0.75);
            transition: background .2s linear, color .2s linear;
            -moz-transition: background .2s linear, color .2s linear;
            -webkit-transition: background .2s linear, color .2s linear;
            -o-transition: background .2s linear, color .2s linear;
        }
        .k-state-active:after {
            content: ".";
            display: block;
            height: 0;
            clear: both;
            visibility: hidden;
        }
        .k-panelbar .k-panel, .k-panelbar .k-content{
            border: none;
        }
</style>
@stop

@section('js')
    {{HTML::script('js/cargarmesa.js')}}
@stop