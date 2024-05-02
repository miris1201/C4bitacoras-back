<?php
$proydes = "_siv3_local_rem";             //En caso de que sea producción cambiar este valor.

define('c_page_title','C4 Bitacoras');            //Titulo del proyecto
define('c_num_reg',10);                                 //Número general de registros en páginas a ocupar

//Sesiones Generales de Administración  ---
define('id_usr','cve_admin_'.$proydes);                 //Sesión principal del Usuario.
define('id_rol','tram_id_rol_'.$proydes);               //Para el id del rol
define('admin','tram_admin_'.$proydes);                 //Para checar si es usuaruo Admin o standard
define('rol','tram_rol_'.$proydes);                     //Para el nombre o desc. rol
define('imp','tram_imp_'.$proydes);                     //Si tiene permisos de imprimir
define('edit','tram_edit_'.$proydes);                   //Si tiene permisos de editar
define('elim','tram_elim_'.$proydes);                   //Si tiene permisos de eliminar
define('nuev','tram_nuev_'.$proydes);                   //Si tiene permisos para agregar un nuevo registro
define('export','tram_exp_'.$proydes);                  //Si tiene permisos para exportar
define('s_sexo','tram_sexo_'.$proydes);                 //Género
define('s_img','tram_img_'.$proydes);                   //Imagen del user
define('s_nombre','tram_nombre_'.$proydes);             //Nombre del user
define('s_ncompleto','tram_ncompleto_'.$proydes);       //Nombre completo del user
define('s_f_i','tram_fecha_ingreso_'.$proydes);         //Fecha de ingreso
define('looked','tram_lock_session_'.$proydes);         //Sesión bloqueada

define('_editar_', 's_peditar_tram_'.$proydes);
define('_editar_ws', 's_peditarws_tram_'.$proydes);
define('_editar_dtl_', 's_peditar_dtl_tram_'.$proydes);

define('_editar_master_', 's_peditar_master_tram_'.$proydes);
define('_is_view_', 's_is_v_tram_'.$proydes);
define('_type_', 's_is_type_'.$proydes);
define('_id_estatus_', 'id_estatus_'.$proydes);
define('_menu_', 'id_menu_navega_'.$proydes);

define('_P_ANIO_', 'anio_'.$proydes);
define('_P_MES_', 'mes_'.$proydes);

//Sesiones extras ---
define('s_puesto', 's_puestp_tram_'.$proydes);
define('s_area', 's_area_tram_'.$proydes);
define('s_estatusvar', 's_estatus_val_'.$proydes);            //Para las barras de estado o bien filtros de estado
define('s_estatusvar_tram', 's_estatus_val_tram_'.$proydes);

define('fil_prog_presu', 'fil_prog_presu_'.$proydes);
define('fil_ff', 'fil_ff_'.$proydes);

define('archivo_alt', 'archivo_alt_d_'.$proydes);
define('id_responsable', 'id_responsable_'.$proydes);
define('id_oficio', 'id_oficio_d_'.$proydes);
define('filtro', 'filtro_'.$proydes);

define('year_desc', 2); //Numero de años a restar para que muestre en los formularios
define('year_combo', 10); //Numero de aÃ±os a mostrar en los combos

define('_SECRET_JWT_', '-Jess-SK-@-tinuy-ON-S3erv!');
define('_issuer_claim_', 'localhost');
define('_audience_claim_', 'audience');