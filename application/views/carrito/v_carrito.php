<?php $carro = $carrito->get_content(); ?>
<div class="container titulo">
    <br/><h1><i class="fa fa-shopping-cart" aria-hidden="true"></i> Carrito de la compra</h1><br/><br/><br/>
    <div class="row centrado">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th>TOTAL: <?=$carrito->precio_total().' €'?></th>
                </tr>
            </tfoot>
            <tbody>
            <?php if($carro):?>
            <?php foreach($carro as $producto):?>
                <tr>
                    <td><?=$producto["nombre"]?></td>
                    <td><?=$producto["cantidad"]?></td>
                    <td><?=$producto["precio"]*$producto["cantidad"].' €'?></td>
                </tr>
            <?php endforeach;?>
        <?php else: ?>
            <tr><td>El carrito está vacío.<td></tr>
        <?php endif;?>
            </tbody>
        </table>
    </div>
    <a class="btn btn-primary" href="<?=base_url('index.php/ctrl_carrito/Destroy')?>">Vaciar carrito</a><br/><br/>
</div>