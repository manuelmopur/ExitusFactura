<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-10-28 02:51:49 --> 404 Page Not Found: Robotstxt/index
ERROR - 2020-10-28 07:43:53 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11722, 'Coronel José Andrés razuri almirante Miguel Grau', 5656, '2', '2', 0, 0, 1)
ERROR - 2020-10-28 07:44:19 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11724, 'Coronel José Andrés razuri almirante Miguel Grau', 5657, '2', '2', 0, 0, 1)
ERROR - 2020-10-28 07:45:18 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11726, 'Coronel José Andrés razuri almirante Miguel Grau', 5658, '2', '2', 0, 0, 1)
ERROR - 2020-10-28 07:46:05 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11728, 'Coronel José Andrés razuri almirante Miguel Grau', 5659, '2', '2', 0, 0, 1)
ERROR - 2020-10-28 07:48:49 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11730, 'Coronel José Andrés razuri almirante Miguel Grau', 5660, '2', '2', 0, 0, 1)
ERROR - 2020-10-28 07:49:13 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11732, '', 5661, '2', '2', 0, 0, 1)
ERROR - 2020-10-28 08:53:09 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11734, 'I.E.P EULER', 5662, '3', '2', 0, 0, 1)
ERROR - 2020-10-28 08:53:31 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11736, 'I.E.P EULER', 5663, '3', '2', 0, 0, 1)
ERROR - 2020-10-28 08:53:45 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11738, 'I.E.P EULER', 5664, '3', '2', 0, 0, 1)
ERROR - 2020-10-28 08:54:05 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11740, 'I.E.P EULER', 5665, '3', '2', 0, 0, 1)
ERROR - 2020-10-28 08:55:02 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11742, 'I.E.P EULER', 5666, '3', '2', 0, 0, 1)
ERROR - 2020-10-28 09:31:30 --> Severity: Notice --> Undefined variable: user_info_logged_in /home/academiaexitus/factura.academiaexitus.edu.pe/exitus/application/views/body.php 81
ERROR - 2020-10-28 09:31:30 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/academiaexitus/factura.academiaexitus.edu.pe/exitus/application/views/body.php 81
ERROR - 2020-10-28 09:31:30 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 09:31:30 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 09:31:30 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 09:31:31 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 09:31:31 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 09:31:31 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 09:31:32 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 09:31:32 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 09:31:32 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 09:31:32 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: SELECT `id`
FROM `alumno`
WHERE `estado` = 0
ERROR - 2020-10-28 09:31:32 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: SELECT `id`
FROM `alumno`
WHERE `estado` = 1
ERROR - 2020-10-28 09:31:43 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: SELECT `p`.`id` as `id_persona`, concat(ti.abrev, " : ", i.nroidentificacion) as identificacion, concat(p.apellidos, " ", p.nombres) as persona, `p`.`direccion`, `p`.`email`, `p`.`fch_nac`, `p`.`telefono`, `p`.`estado`, `a`.`id` as `id_alumno`
FROM `alumno` `a`
JOIN `persona` `p` ON `p`.`id` = `a`.`persona_id`
JOIN `identificacion` `i` ON `i`.`persona_id` = `p`.`id`
JOIN `tipo_identificacion` `ti` ON `ti`.`id` = `i`.`tipo_identificacion_id`
WHERE `a`.`estado` = 0
ERROR - 2020-10-28 09:31:43 --> 404 Page Not Found: Faviconico/index
ERROR - 2020-10-28 13:04:29 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:04:29 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:05:07 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:05:07 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:05:30 --> 404 Page Not Found: Administracion/index
ERROR - 2020-10-28 13:05:31 --> 404 Page Not Found: Faviconico/index
ERROR - 2020-10-28 13:07:09 --> Severity: Notice --> Undefined variable: user_info_logged_in /home/academiaexitus/factura.academiaexitus.edu.pe/exitus/application/views/body.php 81
ERROR - 2020-10-28 13:07:09 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/academiaexitus/factura.academiaexitus.edu.pe/exitus/application/views/body.php 81
ERROR - 2020-10-28 13:07:45 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: SELECT `p`.`id`, concat(ti.abrev, " : ", i.nroidentificacion) as identificacion, `p`.`apellidos`, `p`.`nombres`, concat(p.apellidos, " ", p.nombres) as persona, `a`.`codigo`, `a`.`Grupo` as `grupo`, `a`.`Grupo_fin` as `grupo_fin`, `p`.`direccion`, `p`.`email`, `p`.`fch_nac`, `p`.`telefono`, `p`.`estado`, `a`.`id` as `id_alumno`, `ar`.`Descripcion` as `area`, `ci`.`Descripcion` as `ciclo`, `t`.`descripcion` as `turno`
FROM `alumno` `a`
JOIN `persona` `p` ON `p`.`id` = `a`.`persona_id`
JOIN `identificacion` `i` ON `i`.`persona_id` = `p`.`id`
JOIN `tipo_identificacion` `ti` ON `ti`.`id` = `i`.`tipo_identificacion_id`
JOIN `area` `ar` ON `ar`.`id` = `a`.`Area_id`
JOIN `ciclo` `ci` ON `ci`.`id` = `a`.`ciclo_id`
JOIN `turno` `t` ON `t`.`id` = `a`.`Turno_id`
WHERE `a`.`estado` = 1
AND `a`.`estadia` = 1
AND `a`.`sede_id` = '1'
ERROR - 2020-10-28 13:07:54 --> Severity: Notice --> Undefined variable: user_info_logged_in /home/academiaexitus/factura.academiaexitus.edu.pe/exitus/application/views/body.php 81
ERROR - 2020-10-28 13:07:54 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/academiaexitus/factura.academiaexitus.edu.pe/exitus/application/views/body.php 81
ERROR - 2020-10-28 13:07:54 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:07:55 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:07:55 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:07:56 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:07:56 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:07:56 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:07:58 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: SELECT `id`
FROM `alumno`
WHERE `estado` = 0
ERROR - 2020-10-28 13:07:58 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: SELECT `id`
FROM `alumno`
WHERE `estado` = 1
ERROR - 2020-10-28 13:08:55 --> Severity: Notice --> Undefined variable: user_info_logged_in /home/academiaexitus/factura.academiaexitus.edu.pe/exitus/application/views/body.php 81
ERROR - 2020-10-28 13:08:55 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/academiaexitus/factura.academiaexitus.edu.pe/exitus/application/views/body.php 81
ERROR - 2020-10-28 13:08:55 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:08:56 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:08:56 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:08:56 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:08:56 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:08:56 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:08:57 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:08:57 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:08:58 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:13:45 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11744, '', 5667, '18', '2', 0, 0, 1)
ERROR - 2020-10-28 13:13:57 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11746, '', 5668, '18', '2', 0, 0, 1)
ERROR - 2020-10-28 13:14:03 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11748, '', 5669, '18', '2', 0, 0, 1)
ERROR - 2020-10-28 13:14:08 --> Severity: Notice --> Undefined variable: user_info_logged_in /home/academiaexitus/factura.academiaexitus.edu.pe/exitus/application/views/body.php 81
ERROR - 2020-10-28 13:14:08 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/academiaexitus/factura.academiaexitus.edu.pe/exitus/application/views/body.php 81
ERROR - 2020-10-28 13:14:08 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:14:08 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:14:08 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:14:08 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:14:08 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:14:08 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:14:09 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:14:09 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:14:09 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:14:26 --> Severity: Notice --> Undefined variable: user_info_logged_in /home/academiaexitus/factura.academiaexitus.edu.pe/exitus/application/views/body.php 81
ERROR - 2020-10-28 13:14:26 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/academiaexitus/factura.academiaexitus.edu.pe/exitus/application/views/body.php 81
ERROR - 2020-10-28 13:14:26 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:14:26 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:14:26 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:14:26 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:14:26 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:14:26 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:14:27 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:14:27 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:14:27 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-28 13:14:28 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: SELECT `p`.`id` as `id_persona`, concat(ti.abrev, " : ", i.nroidentificacion) as identificacion, concat(p.apellidos, " ", p.nombres) as persona, `p`.`direccion`, `p`.`email`, `p`.`fch_nac`, `p`.`telefono`, `p`.`estado`, `a`.`id` as `id_alumno`
FROM `alumno` `a`
JOIN `persona` `p` ON `p`.`id` = `a`.`persona_id`
JOIN `identificacion` `i` ON `i`.`persona_id` = `p`.`id`
JOIN `tipo_identificacion` `ti` ON `ti`.`id` = `i`.`tipo_identificacion_id`
WHERE `a`.`estado` = 0
ERROR - 2020-10-28 13:14:31 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: SELECT `p`.`id` as `id_persona`, concat(ti.abrev, " : ", i.nroidentificacion) as identificacion, concat(p.apellidos, " ", p.nombres) as persona, `p`.`direccion`, `p`.`email`, `p`.`fch_nac`, `p`.`telefono`, `p`.`estado`, `a`.`id` as `id_alumno`
FROM `alumno` `a`
JOIN `persona` `p` ON `p`.`id` = `a`.`persona_id`
JOIN `identificacion` `i` ON `i`.`persona_id` = `p`.`id`
JOIN `tipo_identificacion` `ti` ON `ti`.`id` = `i`.`tipo_identificacion_id`
WHERE `a`.`estado` = 0
ERROR - 2020-10-28 13:14:33 --> Severity: Notice --> Undefined variable: user_info_logged_in /home/academiaexitus/factura.academiaexitus.edu.pe/exitus/application/views/body.php 81
ERROR - 2020-10-28 13:14:33 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/academiaexitus/factura.academiaexitus.edu.pe/exitus/application/views/body.php 81
ERROR - 2020-10-28 13:14:38 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: SELECT `p`.`id` as `id_persona`, concat(ti.abrev, " : ", i.nroidentificacion) as identificacion, concat(p.apellidos, " ", p.nombres) as persona, `p`.`direccion`, `p`.`email`, `p`.`fch_nac`, `p`.`telefono`, `p`.`estado`, `a`.`id` as `id_alumno`
FROM `alumno` `a`
JOIN `persona` `p` ON `p`.`id` = `a`.`persona_id`
JOIN `identificacion` `i` ON `i`.`persona_id` = `p`.`id`
JOIN `tipo_identificacion` `ti` ON `ti`.`id` = `i`.`tipo_identificacion_id`
WHERE `a`.`estado` = 0
ERROR - 2020-10-28 13:14:40 --> Severity: Notice --> Undefined variable: user_info_logged_in /home/academiaexitus/factura.academiaexitus.edu.pe/exitus/application/views/body.php 81
ERROR - 2020-10-28 13:14:40 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/academiaexitus/factura.academiaexitus.edu.pe/exitus/application/views/body.php 81
ERROR - 2020-10-28 13:14:44 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: SELECT `p`.`id` as `id_persona`, concat(ti.abrev, " : ", i.nroidentificacion) as identificacion, concat(p.apellidos, " ", p.nombres) as persona, `p`.`direccion`, `p`.`email`, `p`.`fch_nac`, `p`.`telefono`, `p`.`estado`, `a`.`id` as `id_alumno`
FROM `alumno` `a`
JOIN `persona` `p` ON `p`.`id` = `a`.`persona_id`
JOIN `identificacion` `i` ON `i`.`persona_id` = `p`.`id`
JOIN `tipo_identificacion` `ti` ON `ti`.`id` = `i`.`tipo_identificacion_id`
WHERE `a`.`estado` = 0
ERROR - 2020-10-28 13:14:54 --> Severity: Notice --> Undefined variable: user_info_logged_in /home/academiaexitus/factura.academiaexitus.edu.pe/exitus/application/views/body.php 81
ERROR - 2020-10-28 13:14:54 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/academiaexitus/factura.academiaexitus.edu.pe/exitus/application/views/body.php 81
ERROR - 2020-10-28 13:15:01 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: SELECT `p`.`id`, concat(ti.abrev, " : ", i.nroidentificacion) as identificacion, `p`.`apellidos`, `p`.`nombres`, concat(p.apellidos, " ", p.nombres) as persona, `a`.`codigo`, `a`.`Grupo` as `grupo`, `a`.`Grupo_fin` as `grupo_fin`, `p`.`direccion`, `p`.`email`, `p`.`fch_nac`, `p`.`telefono`, `p`.`estado`, `a`.`id` as `id_alumno`, `ar`.`Descripcion` as `area`, `ci`.`Descripcion` as `ciclo`, `t`.`descripcion` as `turno`
FROM `alumno` `a`
JOIN `persona` `p` ON `p`.`id` = `a`.`persona_id`
JOIN `identificacion` `i` ON `i`.`persona_id` = `p`.`id`
JOIN `tipo_identificacion` `ti` ON `ti`.`id` = `i`.`tipo_identificacion_id`
JOIN `area` `ar` ON `ar`.`id` = `a`.`Area_id`
JOIN `ciclo` `ci` ON `ci`.`id` = `a`.`ciclo_id`
JOIN `turno` `t` ON `t`.`id` = `a`.`Turno_id`
WHERE `a`.`estado` = 1
AND `a`.`estadia` = 1
AND `a`.`sede_id` = '1'
ERROR - 2020-10-28 13:15:06 --> Severity: Notice --> Undefined variable: user_info_logged_in /home/academiaexitus/factura.academiaexitus.edu.pe/exitus/application/views/body.php 81
ERROR - 2020-10-28 13:15:06 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/academiaexitus/factura.academiaexitus.edu.pe/exitus/application/views/body.php 81
ERROR - 2020-10-28 13:15:15 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: SELECT `p`.`id` as `id_persona`, concat(ti.abrev, " : ", i.nroidentificacion) as identificacion, concat(p.apellidos, " ", p.nombres) as persona, `p`.`direccion`, `p`.`email`, `p`.`fch_nac`, `p`.`telefono`, `p`.`estado`, `a`.`id` as `id_alumno`
FROM `alumno` `a`
JOIN `persona` `p` ON `p`.`id` = `a`.`persona_id`
JOIN `identificacion` `i` ON `i`.`persona_id` = `p`.`id`
JOIN `tipo_identificacion` `ti` ON `ti`.`id` = `i`.`tipo_identificacion_id`
WHERE `a`.`estado` = 0
ERROR - 2020-10-28 13:15:22 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11750, '', 5670, '18', '2', 0, 0, 1)
ERROR - 2020-10-28 13:16:27 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11752, '', 5671, '18', '2', 0, 0, 1)
ERROR - 2020-10-28 17:03:04 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11754, 'COAR PIURA', 5672, '1', '1', 0, 0, 1)
ERROR - 2020-10-28 17:03:18 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11756, 'COAR PIURA', 5673, '1', '1', 0, 0, 1)
ERROR - 2020-10-28 17:03:29 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11758, 'COAR PIURA', 5674, '1', '1', 0, 0, 1)
ERROR - 2020-10-28 17:03:58 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11760, 'COAR PIURA', 5675, '1', '1', 0, 0, 1)
ERROR - 2020-10-28 17:13:48 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11762, 'Pamer', 5676, '5', '2', 0, 0, 1)
ERROR - 2020-10-28 17:14:20 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11764, 'Pamer', 5677, '5', '2', 0, 0, 1)
ERROR - 2020-10-28 17:14:33 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11766, 'Pamer', 5678, '5', '2', 0, 0, 1)
ERROR - 2020-10-28 17:14:41 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11768, 'Pamer', 5679, '5', '2', 0, 0, 1)
ERROR - 2020-10-28 17:15:01 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11770, 'Pamer', 5680, '5', '2', 0, 0, 1)
ERROR - 2020-10-28 17:26:07 --> 404 Page Not Found: Robotstxt/index
ERROR - 2020-10-28 17:26:08 --> 404 Page Not Found: Blog/robots.txt
ERROR - 2020-10-28 17:26:08 --> 404 Page Not Found: Blog/index
ERROR - 2020-10-28 17:26:08 --> 404 Page Not Found: Wordpress/index
ERROR - 2020-10-28 17:26:08 --> 404 Page Not Found: Wp/index
ERROR - 2020-10-28 17:34:34 --> 404 Page Not Found: Wp-loginphp/index
ERROR - 2020-10-28 22:09:58 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11772, '', 5681, '1', '1', 0, 0, 1)
