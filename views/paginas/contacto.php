<main data-cy='contacto'class="contenedor seccion">
    <h1>Contacto</h1>

    <?php if($mensaje) { ?>
        <p data-cy='alerta-exito' class="alerta exito"><?php echo $mensaje; ?></p>
    <?php } ?>
    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen Contacto">
    </picture>

    <h2>Llene el formulario de Contacto</h2>

    <form data-cy='formulario-contacto' class="formulario" method="POST" action="/contacto">
        <fieldset>
            <legend>Información Personal</legend>

            <label for="nombre">Nombre</label>
            <input data-cy='input-nombre' required type="text" placeholder="Tu Nombre" id="nombre" name="contacto[nombre]">

            <label for="email">E-mail</label>
            <input data-cy='input-email' required name="contacto[email]" type="email" placeholder="Tu Email" id="email">

            <label for="mensaje">Mensaje:</label>
            <textarea data-cy='input-mensaje' required id="mensaje" name="contacto[mensaje]"></textarea>
        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>

            <label for="opciones">Vende o Compra:</label>
            <select data-cy='input-opciones' required id="opciones" name="contacto[opciones]">
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>

            <label for="presupuesto">Precio o Presupuesto</label>
            <input data-cy='input-presupuesto' required type="number" placeholder="Tu Precio o Presupuesto" id="presupuesto" name="contacto[presupuesto]">

        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>

            <p>Como desea ser contactado</p>

            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input data-cy='input-contacto' required name="contacto[contacto]" type="radio" value="telefono" id="contactar-telefono" >

                <label for="contactar-email">E-mail</label>
                <input data-cy='input-contacto' required name="contacto[contacto]" type="radio" value="email" id="contactar-email" >
            </div>

            <div id="contacto"></div>

        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>