<?php
include_once "../funciones/funcionesproductos.php";
$datos = getAllProductos();

?>
<link rel="stylesheet" href="../css/all.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css>

<script src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js></script>

<?php
include_once "head.php";
?>
<h3>ESTOY EN EL CRUD</h3>
<a href="pronuevo.php" class="btn btn-primary">
  <i class="fa-sharp fa-solid fa-cart-plus"></i> Nuevo producto</a>
  <div class="dt-buttons">      <button class="dt-button buttons-copy buttons-html5 btn btn-secondary" tabindex="0" aria-controls="tableUsuarios" type="button" title="Copiar"><span><i class="far fa-copy" aria-hidden="true"></i> Copiar</span></button> <button class="dt-button buttons-excel buttons-html5 btn btn-success" tabindex="0" aria-controls="tableUsuarios" type="button" title="Esportar a Excel"><span><i class="fas fa-file-excel" aria-hidden="true"></i> Excel</span></button> <button class="dt-button buttons-pdf buttons-html5 btn btn-danger" tabindex="0" aria-controls="tableUsuarios" type="button" title="Esportar a PDF"><span><i class="fas fa-file-pdf" aria-hidden="true"></i> PDF</span></button> <button class="dt-button buttons-csv buttons-html5 btn btn-info" tabindex="0" aria-controls="tableUsuarios" type="button" title="Esportar a CSV"><span><i class="fas fa-file-csv" aria-hidden="true"></i> CSV</span></button> </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div class="table-responsive">
            <table class="table table-hover table-bordered" id="tableRoles">
              <thead>
                <tr>
                <th>ID</th>
                    <th>Descripción</th>
                    <th>P. Costo</th>
                    <th>Marca</th>
                    <th>Categoria</th>
                    <th>Azúcar</th>
                    <th>IVA</th>
                    <th>Foto</th>
                    <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                
                    <?php
                    if ($datos != null) {
                      foreach ($datos as $indice => $row) {
                    ?>
                        <tr>
                          <th scope="row"><?php echo $row['pro_id']; ?></th>
                          <td><?php echo $row['pro_descripcion']; ?></td>
                          <td><?php echo $row['pro_precio_c']; ?></td>
                          <td><?php echo $row['marca_descripcion']; ?></td>
                          <td><?php echo $row['catego_descripcion']; ?></td>
                          <td><?php
                              switch ($row['pro_nivel_azucar']) {
                                case 'M':
                                  echo "Medio";
                                  break;
                                case 'B':
                                  echo "Bajo";
                                  break;
                                case 'A':
                                  echo "Alto";
                                  break;
                                case 'N':
                                  echo "Ninguno";
                                  break;
                              }
                
                              ?>
                
                          </td>
                          <td><?php
                              if ($row['pro_aplica_iva'] == 1)
                                echo "Si";
                              else
                                echo "No";
                              ?>
                          </td>
                          <td>
                            <img src="../imagenes/<?php echo $row['pro_imagen']; ?>" width="60" height="60">
                          </td>
                          <td>
                            <a href="#" class="btn btn-sm btn-info">Ver</a>
                            <a href="proeditar.php?pro_id=<?php echo $row['pro_id'];?>" type="button"  class="btn btn-sm btn-warning">Editar</a>
                            <a href="#" class="btn btn-sm btn-danger">Eliminar</a>
                          </td>
                        </tr>
                    <?php
                      } //foreach
                    } //if
                    ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function(){

  tableRoles = $('#tableRoles').dataTable( {
		
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        
  }});
</script>

<?php
include_once "footer.php";
?>