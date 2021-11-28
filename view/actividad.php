<section class="container">
<?php 
      if (isset($_SESSION['error-message'])) { ?>
        <div class="alert alert-danger" role="alert">
          <?php 
          echo $_SESSION['error-message'];
          unset($_SESSION['error-message']);
          ?>
        </div>
       <?php } ?>

       <?php 
      if (isset($_SESSION['success-message'])) { ?>
        <div class="alert alert-success" role="alert">
          <?php 
          echo $_SESSION['success-message'];
          unset($_SESSION['success-message']);
          ?>
        </div>
       <?php } ?>
    <div class="row">
        <div class="col-md-6">
            <div class="row g-4">
            <?php if ( AppController::getListaDeActividades() ) {
                $actividades = AppController::getListaDeActividades();
                foreach($actividades as $actividad) {
            ?>
            <div class="col-6">
            <div class="card">
                <img class="card-img-top"
                    src="./imagenes/<?php echo strtolower(quitar_acentos($actividad->getTipoDeActividad())); ?>.jpg"
                    alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $actividad->getTitulo();?></h5>
                    <p class="card-text">Fecha: <?php echo $actividad->getFecha(); ?></p>
                    <p class="card-text">Ciudad: <?php echo $actividad->getCiudad(); ?></p>
                    <p class="card-text">Precio:
                        <?php echo $actividad->getPrecio() == 'dePago' ? 'De Pago' : 'Gratis' ?>
                    </p>
                </div>
            </div>
            </div>  
            <?php } 
         }?>
            </div>
        </div>
        <div class="offset-md-1 col-md-5">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <label for="titulo">Titulo</label>
                    <input required name="titulo" type="text" class="form-control" id="titulo" aria-describedby="titulo"
                        placeholder="Introduzca el titulo de la actividad">
                </div>

                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <div class="input-group date" data-provide="datepicker">

                        <input autocomplete="off" name="fecha" type="text" class="form-control"
                            placeholder="Introduzca la fecha de la Actividad">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="fecha">Ciudad</label>
                    <input required name="ciudad" type="text" class="form-control" id="ciudad" aria-describedby="ciudad"
                        placeholder="Introduzca la ciudad de la actividad">
                </div>

                <div class="form-group">
                    <label for="tipoDeActividad">Tipo de Actividad</label>
                    <select required class="form-control" name="tipoDeActividad" id="tipodeActividad">
                        <option>Cine</option>
                        <option>Comida</option>
                        <option>Copas</option>
                        <option>Cultura</option>
                        <option>Música</option>
                        <option>Viajes</option>
                    </select>
                </div>

                <div class="form-check">
                    <input required class="form-check-input" type="radio" name="precio" id="gratis" value="gratis"
                        checked>
                    <label class="form-check-label" for="gratis">
                        Gratis
                    </label>
                </div>
                <div class="form-check">
                    <input required class="form-check-input" type="radio" name="precio" id="dePago" value="dePago">
                    <label class="form-check-label" for="dePago">
                        De Pago
                    </label>
                </div>
                <br>

                <button type="submit" name="crearActividad" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
</section>

<?php function quitar_acentos($cadena){
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyyby';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    return utf8_encode($cadena);
    } ?>