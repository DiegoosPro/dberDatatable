<?php
include_once "head.php";
?>
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-MDE0GzJGyrN7oHZqDOeh+0C56iLhRjpYYbYp8iNEkSTvCjQ2VZcFyjKnhRULkSK1" crossorigin="anonymous">

<?php
include_once "../funciones/funcionesmarca.php";
include_once "../funciones/funcionescategoria.php";
include_once "../funciones/funcionesproductos.php";


if(isset($_GET['pro_id'])){
    $pro_id=$_GET['pro_id'];
    $datosPro=getProductoById($pro_id);
}

if (isset($_POST['btnGrabar'])) {
  $pro_id = $_POST['txtCodigo'];
  $pro_descripcion = $_POST['txtDesc'];
  $pro_precio_c = $_POST['txtPrecioC'];
  $pro_precio_v = $_POST['txtPrecioV'];
  $pro_stock = $_POST['txtStock'];
  $pro_fecha_elab = $_POST['txtFechaElab'];
  $pro_nivel_azucar = $_POST['cboNivelAzucar'];
  $pro_aplica_iva = 0;
  if (isset($_POST["chkPagaIva"])) {
    $pro_aplica_iva = 1;
  }
  $pro_especifica = $_POST['txtEspecifica'];

  //*******************/
  $imgFile = $_FILES['imguser']['name'];
  $tmp_dir = $_FILES['imguser']['tmp_name'];
  $imgSize = $_FILES['imguser']['size'];
  $upload_dir = '../imagenes/';

  if (empty($imgFile)) {
    $pro_imagen = "sinimagen.jpeg";
    move_uploaded_file($tmp_dir, $upload_dir . $pro_imagen);
  } else {
    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
    $valid_extensions = array('jpeg', 'jpg', 'gif');
    
    $numero = rand(1000, 9999);
    $pro_imagen =  $numero . "." . $imgExt;

    if (in_array($imgExt, $valid_extensions)) {
      // Check file size '1MB'
      if ($imgSize < 1000000) {
        move_uploaded_file($tmp_dir, $upload_dir . $pro_imagen);
      } else {
        $error[] = "Atención, su archivo es muy grande, debe ser menor a 100 KB";
      }
    } else {
      $error[] = "Lo siento, JPG, JPEG, PNG & GIF formatos de archivo permitidos";
    }
  }

  //*******************/
  $marca_id = $_POST['cboMarcas'];
  $catego_id = $_POST['cboCategorias'];

  if (insertProducto(
    $pro_id,
    $pro_descripcion,
    $pro_precio_c,
    $pro_precio_v,
    $pro_stock,
    $pro_fecha_elab,
    $pro_nivel_azucar,
    $pro_aplica_iva,
    $pro_especifica,
    $pro_imagen,
    $marca_id,
    $catego_id
  ) == true) {
    ?>

    <script>
      Swal.fire(
  'Good job!',
  'You clicked the button!',
  'success'
)
    </script>

  <?php } else { echo 'no'; ?>

    <script>
      Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Something went wrong!',
  footer: '<a href="">Why do I have this issue?</a>'
})
    </script>

<?php
  }
}

?>




<h3>ESTOY EN NUEVO</h3>

<div class="container-fluid">
  <form method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-6">
        <div class="card card-primary">
          <div class="card-body">
            <label>Codigo :</label>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1" >🔢</span>
              <input type="text" name="txtCodigo" id="txtCodigoId" value="<?php echo $datosPro['pro_id'];?>" readonly  class="form-control" placeholder="Codigo">
            </div>


            <label>Descripcion :</label>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1">🗒️</span>
              <input type="text" name="txtDesc" value="<?php echo $datosPro['pro_descripcion'];?>" class="form-control" placeholder="Codigo">
            </div>

            <label>Precio costo :</label>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1">💲</span>
              <input type="number" name="txtPrecioC" value="<?php echo $datosPro['pro_precio_c'];?>" class="form-control" maxlength="10">
            </div>

            <label>Precio venta :</label>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1">💲</span>
              <input type="number" name="txtPrecioV" value="<?php echo $datosPro['pro_precio_v'];?>" class="form-control">
            </div>

            <label>Stock :</label>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1">📈</span>
              <input type="number" name="txtStock"  value="<?php echo $datosPro['pro_precio_v'];?>" class="form-control">
            </div>

            <label>Fecha  :</label>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1">📆</span>
              <input type="date" name="txtFechaElab"  value="<?php echo $datosPro['pro_precio_v'];?>" class="form-control">
            </div>

            <label>Nivel de azucar :</label>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1">🎚️</span>
              <select name="cboNivelAzucar" class="form-select">
                <option value="B" <?php if($datosPro['pro_nivel_azucar']=="B") echo "selected";?> >Bajo</option>
                <option value="M"<?php if($datosPro['pro_nivel_azucar']=="M") echo "selected";?> >Medio</option>
                <option value="A"<?php if($datosPro['pro_nivel_azucar']=="A") echo "selected";?> >Alto</option>
                <option value="N" <?php if($datosPro['pro_nivel_azucar']=="N") echo "selected";?>>Ninguno</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="card card-primary">
          <div class="card-body">
            <h5>ESTOY EN LADO DERECHO</h5>
            <div class="form-check">
              <input name="chkPagaIva" <?php if($datosPro['pro_aplica_iva']==1) echo "checked"; ?> class="form-check-input" type="checkbox">
              <label class="form-check-label"><strong>Paga Iva</strong></label>
            </div>

            <label>Especificaciones :</label>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1">📝</span>
              <textarea name="txtEspecifica" class="form-control" ><?php echo $datosPro['pro_especifica'];?></textarea>
            </div>
            <!-- imagen -->
            <div class="input-group">
              <p>
                <img src="../imagenes/<?php echo $datosPro['pro_imagen']?>" id="imguserId" class="img-circle" height="150" width="150" />
                <input class="input-group" type="file" name="imguser" id="fotoId" onchange="previewFoto()" accept="image/*">
                <label for="ejemplo_archivo_1">Imagen (Tam. máximo archivo
                  1 MB)</label>
              </p>
            </div>
            <!-- fin imagen -->
            <?php
            $marcas = getAllMarcas();
            ?>
            <label>Marca :</label>
            <select class="form-select" name="cboMarcas" required>
              <option value="<?php echo $datosPro['marca_id'];  ?>"><?php echo getNombreMarcaById($datosPro['marca_id']); ?></option>
              <?php
              if ($marcas != null) {
                foreach ($marcas as $indice => $rowm) {
              ?>
                  <option value="<?php echo $rowm['marca_id']; ?>"><?php echo $rowm['marca_descripcion']; ?></option>
              <?php
                }
              }
              ?>
            </select>
            <!--  -->
            <?php
            $categorias = getAllCategorias();
            ?>
            <label>Categoría :</label>
            <select class="form-select" name="cboCategorias" required>
            <option value="<?php  echo $datosPro['catego_id'];?>"><?php echo getNombreMarcaById($datosPro['catego_id']); ?></option>
              <?php
              if ($categorias != null) {
                foreach ($categorias as $indice => $rowc) {
              ?>
                  <option value="<?php echo $rowc['catego_id']; ?>"><?php echo $rowc['catego_descripcion']; ?></option>
              <?php
                }
              }
              ?>
            </select>
            <!--  -->
            <button type="submit" name="btnGrabar" class="btn btn-primary btn-sm mt-2 custom-btn-style">
            <i class="fa-regular fa-floppy-disk fa-lg"></i>Grabar</button>          
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<script>
  function previewFoto() {
    var input = document.getElementById("fotoId");
    var fReader = new FileReader();
    fReader.readAsDataURL(input.files[0]);
    fReader.onloadend = function(event) {
      var img = document.getElementById("imguserId");
      img.src = event.target.result;

    }
  }
</script>


<?php
include_once "footer.php";
?>