<?php
include_once "../config/conectarDB.php";
//

function getAllProductos()
{
  try {
    $sql = "SELECT * FROM tab_productos p, tab_marcas m, tab_categorias c 
                WHERE p.catego_id=c.catego_id
                AND p.marca_id=m.marca_id
                ORDER BY pro_descripcion";
    $conexion = conectaBaseDatos();
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $lista;
    } else
      return null;
  } catch (PDOException $e) {
    echo $e->getMessage();
    return null;
  }
}
// RETORNA UN REGISTRO
function getProductoById($idbusca)
{
  try {
    $sql = "SELECT * FROM tab_productos
          WHERE pro_id=:ppro_id";
    $conexion = conectaBaseDatos();
    $stmt = $conexion->prepare($sql);
    $stmt->bindparam(":ppro_id", $idbusca);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      $registro = $stmt->fetch(PDO::FETCH_ASSOC);
      return $registro;
    } else {
      return null;
    }
  } catch (PDOException $e) {
    echo $e->getMessage();
    return null;
  }
}
function insertProducto($pro_id,$pro_descripcion, $pro_precio_c,$pro_precio_v,
$pro_stock,$pro_fecha_elab,$pro_nivel_azucar, $pro_aplica_iva,
$pro_especifica, $pro_imagen, $marca_id, $catego_id )
{ 
  try {
    $sql = "INSERT INTO tab_productos (pro_id,pro_descripcion,pro_precio_c,pro_precio_v,pro_stock,pro_fecha_elab,pro_nivel_azucar,pro_aplica_iva,pro_especifica,pro_imagen,marca_id,catego_id)
    VALUES(:ppro_id,:ppro_descripcion,:ppro_precio_c,:ppro_precio_v,
    :ppro_stock,:ppro_fecha_elab,:ppro_nivel_azucar,:ppro_aplica_iva,
    :ppro_especifica,:ppro_imagen,:pmarca_id,:pcatego_id)";
    $conexion = conectaBaseDatos();
    $stmt = $conexion->prepare($sql);
    $stmt->bindparam(":ppro_id",$pro_id );
    $stmt->bindparam(":ppro_descripcion",$pro_descripcion );
    $stmt->bindparam(":ppro_precio_c",$pro_precio_c );
    $stmt->bindparam(":ppro_precio_v",$pro_precio_v );
    $stmt->bindparam(":ppro_stock",$pro_stock );
    $stmt->bindparam(":ppro_fecha_elab",$pro_fecha_elab );
    $stmt->bindparam(":ppro_nivel_azucar",$pro_nivel_azucar );
    $stmt->bindparam(":ppro_aplica_iva",$pro_aplica_iva );
    $stmt->bindparam(":ppro_especifica",$pro_especifica );
    $stmt->bindparam(":ppro_imagen",$pro_imagen );
    $stmt->bindparam(":pmarca_id",$marca_id );
    $stmt->bindparam(":pcatego_id", $catego_id);
    $stmt->execute();
    return true; //OPCIONAL
  } catch (PDOException $e) {
    echo $e->getMessage();
    return false; //OPCIONAL
  }
}

?>