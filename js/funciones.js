var procedimiento = "nuevo";

$(document).ready(function() {
   
   $(document).keypress(function(e){
		if (e.which == 13) {
			login();
		}
	});
   
   $('#post_verificacion').hide();
   
   //Ventana modal inicial que se carga al cargar un registro nuevo
   $( "#dialogo_verificacion" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      //open: function(event, ui) { $(".ui-dialog-titlebar-close", ui.dialog).hide(); },
      buttons: {
        "Verificar": function() {
             var serie = $('#verificar_serie').val(); 
             $.ajax({
                url: 'verificar_serial.php',
                type: 'post',
                data: 'serie='+serie,
                dataType: 'html',
                success: function(respuesta) {
                   
                   if (respuesta == 'Debe digitar un número de serie!!!') {
                        $('#resultado_buscar_serial').html('<strong>'+respuesta+'</strong>');
                   } else if (respuesta == 'El número de serie digitado no está registrado en la base de datos, puede ingresar el nuevo registro!') {
                        $( "#dialogo_verificacion" ).dialog( "close" );
                        alert(respuesta);
                        $('#post_verificacion').show();
                   } else if (respuesta == 'El número de serie digitado ya se encuentra registrado en la base de datos!!!') {
                        $('#resultado_buscar_serial').html('<strong>'+respuesta+'</strong>');
                   }  else {
                      alert(respuesta);
                   }                   
                }
            });
            //$( this ).dialog( "close" );
        },
        Cancelar: function() {
          $( this ).dialog( "close" );
           window.location.href = "menu.php";
        }
      }
    });
   //Fin Ventana modal inicial carga de nuevo registro
   
   $("input[name='file']").on("change", function() {
      var formData = new FormData($("#frm_hoja_de_vida")[0]);
      var ruta = "subir_imagen.php";
      $.ajax({
         url: ruta,
         type: "POST",
         data: formData,
         contentType: false,
         processData: false,
         success: function(datos) {          
               $('#imagen').html(datos);
         }
      });
   });
   
   //$('.numero_entero').numeric();
   //$('.numero_decimal').numeric(",");

   var MensajeCampoNoVacio = "<span class='error'>Este campo no puede estar vacío!!!</span>";
   
	$('#accordion').hide();

	$('#btn_Agregar').click(function() {     
         
		/*var error = 0;
		var MensajeCampoNoVacio = "<span class='error'>Faltan campos por diligenciar en el formulario!</span>";
		$('.error').remove();

		$('.requerido').each(function(i, elem) {
			if ($(elem).val() == "") {
				$(elem).css({'box-shadow':'3px 3px 5px red'});
				error++;
			} else {
				$(elem).css({'box-shadow':'none'});
			}
		});*/ 
         
       if ($('#seleccion-equipo').val() == 0) {
         alert("Seleccione una clase de equipo!!!");
       } else {
            $( "#dialog-confirm" ).dialog({
               resizable: false,
               height: "auto",
               width: 400,
               modal: true,
               buttons: {
                 "Guardar": function() {
                    guardar_registro();
                   $( this ).dialog( "close" );
                    setTimeout("location.href='buscar.php'", 1500);
                 },
                 Cancelar: function() {
                   $( this ).dialog( "close" );
                 }
               }
             });
       }
	});
   
   
   
   cargarRegistros(0);
    
    $('#contenedor_editar').hide();
    $('#span_clase').hide();
    $('#seleccion-equipo_input').hide();
    $('#btn_Editar').hide();
    $('#btn_cancelar_edicion').hide();
   
   //Busqueda en tiempo real
   var consulta;
        $('#busqueda').val('');
        $('#busqueda').focus();                

        $('#busqueda').keyup(function(e) {
            consulta = $('#busqueda').val();
            $.ajax({
                url: 'buscar_tiempo_real.php',
                type: 'post',
                data: "b="+consulta,
                dataType: 'html',
                success: function(respuesta) {
                    $('#registros').empty();
                    $('#registros').html(respuesta);
                    if ($('#busqueda').val() == "") {
                        cargarRegistros(0);
                    };
                }
            });
        });
   //Fin Busqueda en tiempo real
   
   
   //Cambiar contraseña del usuario
   $('#btnCambiarContrasena').click(function() {
        var ca = $('#ca').val();
        var cn = $('#cn').val();
        var rcn = $('#rcn').val();
        var idu = $('#idu').val();
        $.ajax({
            url: "cambiar_contrasena.php",
            type: "post",
            data: "ca="+ca+"&cn="+cn+"&rcn="+rcn+"&idu="+idu,
            success: function(r) {
                alert(r);
                if (r == "Contraseña actualizada con éxito!") {
                    $('#frmCambiarContrasena input[type="password"]').val('');
                };                
            }
        });
    });
   
   //Fin cambiar contreseña del usuario
   
   
   //********** Formulario Nuevo Usuario ***********
      $('#nuevo_usuario').hide();
   
      $('#btn_crear_usuario').click(function() {
         $('#listado_usuarios').hide();
         $('#nuevo_usuario').show();
      }); 
   
      $('#btn_cancelar_usuario').click(function() {
         $('#listado_usuarios').show();
         $('#nuevo_usuario').hide();
      });
   
      $('#btn_guardar_usuario').click(function() {
         var datos = $('#frm_nuevo_usuario').serialize();
         $.ajax({
            url: 'crear_usuario.php',
            type: 'post',
            data: datos,
            success: function(respuesta) {               
               if (respuesta == "Usuario creado con éxito!") {
                  alert(respuesta);
                  //$('#nuevo_usuario').hide();
                  //$('#listado_usuarios').show();
                  location.reload();
               } else {
                  alert(respuesta);
               }
            }
         });
      });
   //---------- Fin formulario nuevo usuario ---------
    
    $('#btn_Editar').click(function() {
        guardar_editar();
    });
    
    
    $('#btn_cancelar_edicion').click(function() {
        
        $('#registros').show();
        $('#contenedor_editar').hide();
        cargarRegistros(0);
        $('#span_buscar').show();
        $('#busqueda').show();
        $('#busqueda').val('');
        $('#span_clase').hide();
        $('#seleccion-equipo_input').hide();
        $('#btn_Editar').hide();
        $('#btn_cancelar_edicion').hide();
        $('#centro').html('<span>BUSCAR EQUIPO DE OPERACION</span>');
        
    });
   
   $('#seccion_est_por_equipos').hide();
   $('#seccion_est_por_usuarios').hide();
   $('#seccion_est_por_marca').hide();
   $('#seccion_est_por_edificio_piso').hide();
      
});

//FIN document.ready


//INICIO FUNCIONES

function login() {
	var datos = $('#frm-login').serialize();
	$.ajax({
		url: 'php/login.php',
		type: 'post',
		data: datos,
		success: function(r) {
			if (r=='true') {
				window.location.href = "php/menu.php";
			} else {
		      alert(r);
               $('#user').val('');
               $('#password').val('');
               $('#user').focus();
			}
		}
	});	
}

function cambiar_tipo_equipo(valor) {
	if (valor==1) {
			$('#accordion input[type="text"]').val('');
			$('#accordion').show();
			$('#descrip').html('');
			$('#descrip').load('../include/equipo-biomedico.php');
			//obtener_valor();
		} else if(valor==2) {
			$('#accordion input[type="text"]').val('');
			$('#accordion').show();
			$('#descrip').html('');
			$('#descrip').load('../include/equipo-industrial.php');
		} else if(valor==3) {
			$('#accordion input[type="text"]').val('');
			$('#accordion').show();
			$('#descrip').html('');
			$('#descrip').load('../include/equipo-informatica.php');
		} else if(valor==0) {
			$('#accordion input[type="text"]').val('');
			$('#accordion').hide();
		}
}	 

function guardar_registro() {
   var datos = $('#frm_hoja_de_vida').serialize();
   var nom_img = $('#nombre_imagen').val();
        $.ajax({
            url: 'crud_hv/create.php',
            type: 'post',
            data: datos+"&nombre_imagen="+nom_img,
            success: function(r) {
               
               if (r == 'ERROR: El serial digitado ya se encuentra registrado!!!') {
                  alert(r);
                  $('#serie').val('');
                  $('#serie').focus();
               } else if (r == 'El campo serie es obligatorio!!!') {
                  alert(r);
                  $('#serie').val('');
               } else {                  
                alert(r);
                $('.requerido').val('');
               }
               
            }
        }); 
}

function guardar_editar() {
    var datos = $('#frm_hoja_de_vida_editada').serialize();
    $.ajax({
        url: 'crud_hv/editar.php',
        type: 'post',
        data: datos,
        success: function(r) {
            alert(r);
            cargarRegistros(0);
            $('#registros').show();
            $('#contenedor_editar').hide();
            $('#span_buscar').show();
            $('#busqueda').show();
            $('#busqueda').val('');
            $('#span_clase').hide();
            $('#seleccion-equipo_input').hide();
            $('#btn_Editar').hide();
            $('#btn_cancelar_edicion').hide();
            $('#centro').html('<span>BUSCAR EQUIPO DE OPERACION</span>');
        }
    }); 
}

function cargarRegistros(limite) {
    var ulr = 'cargarRegistros.php';
    $.post( ulr, {limite: limite}, function(resposeText) { $('#registros').html(resposeText); } );
}

function eliminar_registro(id_hv_equipo) {
   var id_hv = "id_hv_equipo="+id_hv_equipo;
   var mensaje = confirm("Está seguro que desea eliminar este registro? Esta acción no puede deshacerse!!!");
   if (mensaje) {
      $.ajax({
          url: "crud_hv/eliminar.php",
          data: id_hv,
          type: "POST",
          success: function(r) {
              cargarRegistros(0);
          }
      });
   } else {
      
   }
}

function ver_pdf(id_hv_equipo) {
   var id_hv = "id_hv_equipo="+id_hv_equipo;
   $.ajax({
       url: "generar_pdf.php",
       data: id_hv,
       type: "POST",
       success: function(r) {
           //alert("mal");
       }
   });
}

function editar_registro(id_hv_equipo) {
    procedimiento = "editar";
    var id_hv = "id_hv_equipo="+id_hv_equipo;
    
    var data21, data22;
    
    $.ajax({
        url: "crud_hv/buscar.php",
        data: id_hv,
        type: "POST",
        dataType: "json",
        success: function(r) {
            //window.location.href = 'editar.php';
            //alert(r.nde);
            //$('#rd_informatica').val(r.nde);
            
            $('#span_buscar').hide();
            $('#busqueda').hide();
            $('#span_clase').show();
            $('#seleccion-equipo_input').show();
            $('#btn_Editar').show();
            $('#btn_cancelar_edicion').show();
            
            $('#registros').hide();
            $('#contenedor_editar').show();
            $('#centro').html('<span>EDITAR HOJA DE VIDA No. '+r.id_hv_equipo+'</span>');
            
            /*
            $.each(r, function(i, item) {
                alert(item);
                //$('#').val(r.item);
            });
            */
            
            //Nombres de campos provenientes del array info
            
            $('#id_hv_equipo').val(r.id_hv_equipo);            
            $('#seleccion-equipo_input').val(r.nce);
            $('#rd_infor').val(r.nde);
            $('#id_desc_equipo').val(r.id_desc_equipo);
            $('#rd_selected').val(r.nde);
            $('#inv_activo').val(r.inv_activo);
            $('#reg_sanit').val(r.reg_sanit);
            $('#perm_comerc').val(r.perm_comerc);
            $('#edificio').val(r.edificio);
            $('#piso').val(r.piso);
            $('#num_carpeta').val(r.num_carpeta);
            $('#descripcion_equipo').val(r.descripcion_equipo);
            $('#marca').val(r.marca);
            $('#id_marca').val(r.marca);
            $('#modelo').val(r.modelo);
            $('#serie').val(r.serie);
            $('#servicio').val(r.servicio);
            $('#ubicacion').val(r.ubicacion);
            $('#equipo_2').val(r.rd_equipo);
            $('#rd_equipo').val(r.rd_equipo);
            $('#fec_adquis').val(r.fec_adquis);
            $('#num_ord_comp').val(r.num_ord_comp);
            $('#num_fact').val(r.num_fact);
            $('#num_act_tec').val(r.num_act_tec);
            $('#fec_ent_inst').val(r.fec_ent_inst);
            $('#fec_inic_oper').val(r.fec_inic_oper);
            $('#fec_venc_gar').val(r.fec_venc_gar);
            $('#anio_fabr').val(r.anio_fabr);
            $('#costo').val(r.costo);
            $('#vida_util').val(r.vida_util);
            $('#proveed').val(r.proveed);
            $('#telf_proveed').val(r.telf_proveed);
            $('#email_proveed').val(r.email_proveed);
            $('#represent').val(r.represent);
            $('#telf_represent').val(r.telf_represent);
            $('#email_represent').val(r.email_represent);
            $('#fabric').val(r.fabric);
            $('#telf_fabric').val(r.telf_fabric);
            $('#email_fabric').val(r.email_fabric);
            $('#rd_form_adquis').val(r.rd_form_adquis);
            $('#txt_otro_form_adquis').val(r.txt_otro_form_adquis);
            $('#fue_alim').val(r.fue_alim);
            $('#tec_predom').val(r.tec_predom);
            $('#vol_max').val(r.vol_max);
            $('#vol_min').val(r.vol_min);
            $('#cor_max').val(r.cor_max);
            $('#cor_min').val(r.cor_min);
            $('#potencia').val(r.potencia);
            $('#velocidad').val(r.velocidad);
            $('#peso').val(r.peso);
            $('#temp').val(r.temp);
            $('#presion').val(r.presion);
            $('#reg_tec_otro').val(r.reg_tec_otro);
            $('#operacion').val(r.operacion);
            $('#electricos').val(r.electricos);
            $('#clase_i').val(r.clase_i);
            $('#mantenimiento').val(r.mantenimiento);
            $('#electronicos').val(r.electronicos);
            $('#clase_iia').val(r.clase_iia);
            $('#partes').val(r.partes);
            $('#hidraulicos').val(r.hidraulicos);
            $('#clase_iib').val(r.clase_iib);
            $('#neumaticos').val(r.neumaticos);
            $('#clase_iii').val(r.clase_iii);
            $('#mecanicos').val(r.mecanicos);
            $('#acce_nom1').val(r.acce_nom1);
            $('#acce_nom2').val(r.acce_nom2);
            $('#acce_nom3').val(r.acce_nom3);
            $('#acce_nom4').val(r.acce_nom4);
            $('#acce_nom5').val(r.acce_nom5);
            $('#acce_obs1').val(r.acce_obs1);
            $('#acce_obs2').val(r.acce_obs2);
            $('#acce_obs3').val(r.acce_obs3);
            $('#acce_obs4').val(r.acce_obs4);
            $('#acce_obs5').val(r.acce_obs5);
            $('#per_mant').val(r.per_mant);
            $('#req_calib').val(r.req_calib);
            $('#per_calib').val(r.per_calib);
            $('#rd_cop_reg_san').val(r.rd_cop_reg_san);
            $('#obs_cop_reg_san').val(r.obs_cop_reg_san);
            $('#rd_cop_perm_comerc').val(r.rd_cop_perm_comerc);
            $('#obs_cop_perm_comerc').val(r.obs_cop_perm_comerc);
            $('#rd_cop_reg_imp').val(r.rd_cop_reg_imp);
            $('#obs_cop_reg_imp').val(r.obs_cop_reg_imp);
            $('#rd_cop_fact').val(r.rd_cop_fact);
            $('#obs_cop_fact').val(r.obs_cop_fact);
            $('#rd_cop_ing_alm').val(r.rd_cop_ing_alm);
            $('#obs_cop_ing_alm').val(r.obs_cop_ing_alm);
            $('#rd_act_ent').val(r.rd_act_ent);
            $('#obs_act_ent').val(r.obs_act_ent);
            $('#rd_man_usu').val(r.rd_man_usu);
            $('#obs_man_usu').val(r.obs_man_usu);
            $('#rd_cron_mant').val(r.rd_cron_mant);
            $('#obs_cron_mant').val(r.obs_cron_mant);
            $('#rd_guia_rap').val(r.rd_guia_rap);
            $('#obs_guia_rap').val(r.obs_guia_rap);
            $('#rd_cop_act_tec').val(r.rd_cop_act_tec);
            $('#obs_cop_act_tec').val(r.obs_cop_act_tec);
            $('#rd_est_cost_acces').val(r.rd_est_cost_acces);
            $('#obs_est_cost_acces').val(r.obs_est_cost_acces);
            $('#rd_car_garant').val(r.rd_car_garant);
            $('#obs_car_garant').val(r.obs_car_garant);
            $('#rd_sop_tec').val(r.rd_sop_tec);
            $('#obs_sop_tec').val(r.obs_sop_tec);
            $('#rd_capacit').val(r.rd_capacit);
            $('#obs_capacit').val(r.obs_capacit);
            $('#rd_calib').val(r.rd_calib);
            $('#obs_calib').val(r.obs_calib);
            $('#rd_uso').val(r.rd_uso);
            $('#nombre_imagen').val(r.nombre_imagen);
            $('#fec_registro_hv').val(r.fec_registro_hv);
            $('#hora_registro_hv').val(r.hora_registro_hv);
            $('#id_usuario').val(r.id_usuario);
            $('#ip_usuario').val(r.ip_usuario);
            
        }       
    });
}

function escoger_reporte(num_reporte) {
   
      if (num_reporte == 1) {
         $('#seccion_est_por_equipos').show();
         $('#seccion_est_por_usuarios').hide();
         $('#seccion_est_por_marca').hide();
         $('#seccion_est_por_edificio_piso').hide();
      } else if (num_reporte == 2) {
         $('#seccion_est_por_equipos').hide();
         $('#seccion_est_por_usuarios').show();
         $('#seccion_est_por_marca').hide();
         $('#seccion_est_por_edificio_piso').hide();
      } else if (num_reporte == 3) {
         $('#seccion_est_por_marca').show();
         $('#seccion_est_por_equipos').hide();
         $('#seccion_est_por_usuarios').hide();
         $('#seccion_est_por_edificio_piso').hide();
      } else if (num_reporte == 4) {
         $('#seccion_est_por_marca').hide();
         $('#seccion_est_por_equipos').hide();
         $('#seccion_est_por_usuarios').hide();
         $('#seccion_est_por_edificio_piso').show();
      } else {
         $('#seccion_est_por_equipos').hide();
         $('#seccion_est_por_usuarios').hide();
         $('#seccion_est_por_marca').hide();
         $('#seccion_est_por_edificio_piso').hide();
      }
}

