{include 'header.tpl'}
<div class="container" id="detail">
    <section class="contenedorProductos">
        <article class="contenido-productos">
        <h1 class="color"> Producto | {$product->name}</h1>
        <h4 class="d"> Descripción | {$product->description}</h4>
        <h4> Precio: {$product->price}</h4>
        <h4> Stock: {$product->stock}</h4>
        <h4> Categoría: {$product->name_caegory}</h4>
        <input id="productoId" type="hidden" value="{$product->id_product}">
            <!--<table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Producto</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <{foreach from=$prod item=product}
                        <tr>
                            <input id="productoId" type="hidden" value="{$product->id_product}">
                            <td>{$product->id_product}</td>
                            <td>{$product->name_product}</td>
                            <td>{$product->description}</td>
                            <td>{$product->price}</td>
                        </tr>
                    {/foreach}
            </table>-->
        

            <form class="product_form" action="">
                <table>
                    <thead>
                        <tr>
                            <th>Comentario </th>
                            <th>Valoracion</th>
                            <th>Usuario Email</th>
                        </tr>
                    </thead>
                    <tbody id="productos_tabla">

                    </tbody>

                </table>
            </form>
            <h1>Insertar Comentario y Valoracion</h1>
            <form action="api/comentarios" method="POST">
            <input id="productId" type="hidden" value="{$product->id_product}">
                <textarea id="comentario" type="text" name="comentario" maxlength="255"></textarea>
                <select name="valoracion" id="valoracion">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <button type="submit" name="agregar" id="btnInsertarComentario">InsertarComentario</button>
            </form>
        </article>
        <aside> </aside>

    </section>
</div>

<!--<div class="imagen">
        <h1 class="color"> Producto | {$product->name}</h1>
        <div class="row">
            <div class="col-xs-6">
                <img src="uploads/{$product->image}"  class="img-thumbnail" alt="Responsive image">
            </div>
        </div>
        <h4 class="d"> Descripción | {$product->description}</h4>
        <h4> Precio: {$product->price}</h4>
        <h4> Stock: {$product->stock}</h4>
        <h4> Categoría: {$product->name_caegory}</h4>
    </div>

    <div class="container">
        <input type="hidden" name="product" id="id_product" value="{$product->id_product}">
        

        <form class="formulario" id="commentForm" action="api/comentarios" method="POST">
            <h2 class="opinion">Opiniones sobre {$product->name}</h2>

            <div>
                <div id="div-comentarios" class="div-comentarios">
                </div>
            </div>

            <input type="hidden" name="product_id" id='prod_id' value='{$product->id_product}' readonly>
            {if (isset($smarty.session.email))}
                    {foreach from=users item=user}
                            <label for="nickname">Usuario</label>
                            <input type="text" name="nickname" id='nickname' value='{$user->email}' readonly>
                            <input type="hidden" name="usuario_id" id='usuario_id' value='{$user->id_user}'>
                            <input type="hidden" id="admin" value='{$user->admin}'>
                            <input type="hidden" id="sesion" value={$smarty.session.email}>
                    {/foreach}
            {/if}
            <input type="hidden" id="id_usuario" value='{$smarty.session.idUser}'-> value='13' data-id={$smarty.session.id_user}> 
            {if (isset($smarty.session.email))}
                    <input type="hidden" id="admin" value='3'>
                    
            {/if}
            

            <label class="comment" for="comentario">
                <h2>Comentario</h2>
            </label>
            <textarea name="comentarios" class="comment" id="comment" cols="60" rows="10"></textarea>
            <!-<input class="comment" type="submit" id="btn-send">--
            <input type="submit" class="btn btn-info mt-2" value="Enviar" id="btnComment">

        </form>

        <div class="comment">
            <a href="{BASE_URL}productos">volver</a>
        </div>
    </div>
</div>-->


{include 'footer.tpl'}