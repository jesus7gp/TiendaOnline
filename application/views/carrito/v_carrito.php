<?php $carro = $carrito->get_content(); ?>
<div class="container titulo">
<?php if(isset($mensaje)): ?>
    <p><?=$mensaje?></p>
<?php endif; ?>
    <br/><h1><i class="fa fa-shopping-cart" aria-hidden="true"></i> Carrito de la compra</h1><br/><br/><br/>
    <div class="row centrado">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>TOTAL: <?=$carrito->precio_total().' €'?></th>
                    <th></th>
                </tr>
            </tfoot>
            <tbody>
            <?php if($carro):?>
            <?php foreach($carro as $producto):?>
                <tr>
                    <td><a href="<?=base_url('index.php/Ctrl_carrito/Remove_producto/'.$producto['unique_id'])?>" class="btn btn-danger cantip"><i class="fa fa-remove" aria-hidden="true"></i></a></td>
                    <td><a class="h6" href="<?=base_url('index.php/Ctrl_portada/producto/'.$producto['id']) ?>"><?=$producto["nombre"]?></a></td>
                    <td>
                        <?=$producto["cantidad"]?>
                        <div class="btn-group">
                        <?php if($producto['cantidad']>1): ?>
                        <a href="<?=base_url('index.php/Ctrl_carrito/Add/'.$producto['id'].'/'.-1)?>" class="btn btn-danger cantip"><i class="fa fa-minus" aria-hidden="true"></i></a>
                    <?php endif; ?>
                        <a href="<?=base_url('index.php/Ctrl_carrito/Add/'.$producto['id'])?>" class="btn btn-success cantip"><i class="fa fa-plus" aria-hidden="true"></i>
</a>
                        </div>
                    </td>
                    <td><?=$producto["precio"]?></td>
                    <td><?=$producto["precio"]*$producto["cantidad"].' €'?></td>
                </tr>
            <?php endforeach;?>
        <?php else: ?>
            <tr><td>El carrito está vacío.<td></tr>
        <?php endif;?>
            </tbody>
        </table>
    </div>
    <div class="btn-group">
    <a class="btn btn-primary" href="<?=base_url('index.php/Ctrl_carrito/Destroy')?>">Vaciar carrito</a>
    <?php if(!($this->session->has_userdata('id'))): ?>
    <!--No se ha iniciado sesión-->
    <a class="btn btn-success" href="<?=base_url('index.php/Ctrl_user')?>">Debes iniciar sesión para realizar el pedido</a>
    <?php elseif($carrito->articulos_total()==0): ?>
    <!--Si no hay productos en el carrito no se mostrará el botón de finalizar pedido-->
    <?php else: ?>
    <!--Se puede finalizar el pedido-->
    <a class="btn btn-success" href="<?=base_url('index.php/Ctrl_carrito/FinalizaPedido')?>">Finalizar pedido</a>
    <?php endif; ?>
    </div><br/><br/>
</div>