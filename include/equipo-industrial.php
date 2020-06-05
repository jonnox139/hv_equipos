<?php  
   require_once('../db/utilities.php');
?>
<table>
   <tr>
      <td colspan=11 style="text-align: center;"><h4>EQUIPO INDUSTRIAL DE USO HOSPITALARIO</h4></td>
   </tr>     
   <tr>
      <?php  
         $campos = array('id_desc_equipo','nom_desc_equipo');
         $result = seleccionar_db($campos, 'desc_equipo', 'WHERE id_clasf_equipo=2');
         while ($row = $result->fetch_array()) {
            echo "<td class='celda-nombre'>";
            echo utf8_encode("<input type='radio' name='rd_industrial' value='".$row['id_desc_equipo']."' id='rd_industrial' checked='checked'> ".$row['nom_desc_equipo']);
            echo "</td>";
         }
         echo "<input type='hidden' value='sterilize' name='area'>";
      ?>
   </tr>
</table>