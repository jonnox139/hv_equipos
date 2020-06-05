<?php  
   require_once('../db/utilities.php');
?>
<table>
   <tr>
      <td colspan=5 style="text-align: center;"><h4>EQUIPO DE COMUNICACIONES E INFORMATICA</h4></td>
   </tr>     
   <tr>
      <?php  
         $campos = array('id_desc_equipo','nom_desc_equipo');
         $result = seleccionar_db($campos, 'desc_equipo', 'WHERE id_clasf_equipo=3');
         while ($row = $result->fetch_array()) {
            echo "<td class='celda-nombre'>";
            echo utf8_encode("<input type='radio' name='rd_informatica' value='".$row['id_desc_equipo']."' id='rd_informatica' checked='checked'> ".$row['nom_desc_equipo']);
            echo "</td>";
         }
         echo "<input type='hidden' value='sistemas' name='area'>";
      ?>
   </tr>
</table>