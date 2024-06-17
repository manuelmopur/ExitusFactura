<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-10-27 06:21:14 --> 404 Page Not Found: Robotstxt/index
ERROR - 2020-10-27 09:29:56 --> Severity: Notice --> Undefined variable: user_info_logged_in /home/academiaexitus/factura.academiaexitus.edu.pe/exitus/application/views/body.php 81
ERROR - 2020-10-27 09:29:56 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/academiaexitus/factura.academiaexitus.edu.pe/exitus/application/views/body.php 81
ERROR - 2020-10-27 09:29:57 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-27 09:29:57 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-27 09:29:58 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-27 09:30:00 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-27 09:30:01 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-27 09:30:03 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-27 09:30:10 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-27 09:30:11 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-27 09:30:11 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-27 09:30:12 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: SELECT `id`
FROM `alumno`
WHERE `estado` = 0
ERROR - 2020-10-27 09:30:13 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: SELECT `id`
FROM `alumno`
WHERE `estado` = 1
ERROR - 2020-10-27 09:30:27 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: SELECT `p`.`id`, concat(ti.abrev, " : ", i.nroidentificacion) as identificacion, `p`.`apellidos`, `p`.`nombres`, concat(p.apellidos, " ", p.nombres) as persona, `a`.`codigo`, `a`.`Grupo` as `grupo`, `a`.`Grupo_fin` as `grupo_fin`, `p`.`direccion`, `p`.`email`, `p`.`fch_nac`, `p`.`telefono`, `p`.`estado`, `a`.`id` as `id_alumno`, `ar`.`Descripcion` as `area`, `ci`.`Descripcion` as `ciclo`, `t`.`descripcion` as `turno`
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
ERROR - 2020-10-27 09:30:37 --> 404 Page Not Found: Faviconico/index
ERROR - 2020-10-27 11:06:16 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11578, 'LUIS AlBERTO SANCHES', 5584, '5', '2', 0, 0, 1)
ERROR - 2020-10-27 11:06:25 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11580, 'LUIS AlBERTO SANCHES', 5585, '5', '2', 0, 0, 1)
ERROR - 2020-10-27 11:11:30 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11582, 'Luis Alberto Sanches', 5586, '5', '2', 0, 0, 1)
ERROR - 2020-10-27 11:11:31 --> 404 Page Not Found: Faviconico/index
ERROR - 2020-10-27 11:13:16 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11584, 'Luis Alberto Sanches', 5587, '5', '2', 0, 0, 1)
ERROR - 2020-10-27 11:13:16 --> 404 Page Not Found: Faviconico/index
ERROR - 2020-10-27 11:25:06 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11586, 'I.E.P MIGUEL CORTES', 5588, '5', '2', 0, 0, 1)
ERROR - 2020-10-27 11:25:40 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11588, 'I.E.P MIGUEL CORTES', 5589, '5', '2', 0, 0, 1)
ERROR - 2020-10-27 11:26:15 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11590, 'I.E.P MIGUEL CORTES', 5590, '5', '2', 0, 0, 1)
ERROR - 2020-10-27 11:26:44 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11592, 'I.E.P MIGUEL CORTES', 5591, '5', '2', 0, 0, 1)
ERROR - 2020-10-27 11:28:03 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11594, 'I.E.P MIGUEL CORTES', 5592, '5', '2', 0, 0, 1)
ERROR - 2020-10-27 11:28:36 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11596, 'I.E.P MIGUEL CORTES', 5593, '5', '2', 0, 0, 1)
ERROR - 2020-10-27 11:30:29 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11598, 'Instituto San Pablo Apóstol ', 5594, '3', '1', 0, 0, 1)
ERROR - 2020-10-27 11:30:42 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11600, 'Instituto San Pablo Apóstol ', 5595, '3', '1', 0, 0, 1)
ERROR - 2020-10-27 11:31:23 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11602, 'Instituto San Pablo Apóstol ', 5596, '3', '1', 0, 0, 1)
ERROR - 2020-10-27 11:31:36 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11604, 'Instituto San Pablo Apóstol ', 5597, '3', '1', 0, 0, 1)
ERROR - 2020-10-27 11:33:26 --> Severity: Notice --> Undefined variable: user_info_logged_in /home/academiaexitus/factura.academiaexitus.edu.pe/exitus/application/views/body.php 81
ERROR - 2020-10-27 11:33:26 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/academiaexitus/factura.academiaexitus.edu.pe/exitus/application/views/body.php 81
ERROR - 2020-10-27 11:33:26 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-27 11:33:26 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-27 11:33:26 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-27 11:33:26 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-27 11:33:26 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-27 11:33:26 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-27 11:33:27 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-27 11:33:27 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-27 11:33:27 --> 404 Page Not Found: Assets/assets
ERROR - 2020-10-27 11:33:28 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: SELECT `id`
FROM `alumno`
WHERE `estado` = 0
ERROR - 2020-10-27 11:33:28 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: SELECT `id`
FROM `alumno`
WHERE `estado` = 1
ERROR - 2020-10-27 11:33:29 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: SELECT `p`.`id`, concat(ti.abrev, " : ", i.nroidentificacion) as identificacion, `p`.`apellidos`, `p`.`nombres`, concat(p.apellidos, " ", p.nombres) as persona, `a`.`codigo`, `a`.`Grupo` as `grupo`, `a`.`Grupo_fin` as `grupo_fin`, `p`.`direccion`, `p`.`email`, `p`.`fch_nac`, `p`.`telefono`, `p`.`estado`, `a`.`id` as `id_alumno`, `ar`.`Descripcion` as `area`, `ci`.`Descripcion` as `ciclo`, `t`.`descripcion` as `turno`
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
ERROR - 2020-10-27 11:45:10 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11606, 'EXITUS', 5598, '5', '2', 0, 0, 1)
ERROR - 2020-10-27 11:45:18 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11608, 'Instituto San Pab Apóstol', 5599, '3', '1', 0, 0, 1)
ERROR - 2020-10-27 11:46:04 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11610, 'Luis Alberto Sanches', 5600, '5', '2', 0, 0, 1)
ERROR - 2020-10-27 11:46:05 --> 404 Page Not Found: Faviconico/index
ERROR - 2020-10-27 11:51:59 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11612, 'M.R.G.R', 5601, '5', '1', 0, 0, 1)
ERROR - 2020-10-27 11:52:13 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11614, 'M.R.G.R', 5602, '5', '1', 0, 0, 1)
ERROR - 2020-10-27 11:53:15 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11616, 'M.R.G.R', 5603, '5', '1', 0, 0, 1)
ERROR - 2020-10-27 11:53:39 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11618, 'M.R.G.R', 5604, '4', '1', 0, 0, 1)
ERROR - 2020-10-27 11:53:51 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11620, 'Instituto San Pablo Apóstol', 5605, '3', '1', 0, 0, 1)
ERROR - 2020-10-27 11:54:08 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11622, 'Instituto San Pablo Apóstol', 5606, '3', '1', 0, 0, 1)
ERROR - 2020-10-27 11:54:19 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11624, 'M.R.G.R', 5607, '4', '1', 0, 0, 1)
ERROR - 2020-10-27 11:54:31 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11626, 'Instituto San Pablo Apóstol', 5608, '3', '1', 0, 0, 1)
ERROR - 2020-10-27 11:55:04 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11628, 'M.R.G.R', 5609, '4', '1', 0, 0, 1)
ERROR - 2020-10-27 11:55:10 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11630, 'M.R.G.R', 5610, '4', '1', 0, 0, 1)
ERROR - 2020-10-27 11:59:02 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11632, 'M.R.G.R', 5611, '4', '1', 0, 0, 1)
ERROR - 2020-10-27 11:59:30 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11634, 'M.R.G.R', 5612, '4', '1', 0, 0, 1)
ERROR - 2020-10-27 12:00:10 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11636, 'M.R.G.R', 5613, '4', '1', 0, 0, 1)
ERROR - 2020-10-27 12:09:35 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11638, 'M.R.G.R', 5614, '4', '1', 0, 0, 1)
ERROR - 2020-10-27 12:10:25 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11640, 'M.R.G.R', 5615, '4', '1', 0, 0, 1)
ERROR - 2020-10-27 12:11:22 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11642, 'I.E Mauro Giraldo Romero', 5616, '4', '1', 0, 0, 1)
ERROR - 2020-10-27 12:12:09 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11644, 'I.E Mauro Giraldo Romero', 5617, '4', '1', 0, 0, 1)
ERROR - 2020-10-27 12:12:15 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11646, 'I.E Mauro Giraldo Romero', 5618, '4', '1', 0, 0, 1)
ERROR - 2020-10-27 12:13:03 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11648, 'I.E Mauro Giraldo Romero', 5619, '4', '1', 0, 0, 1)
ERROR - 2020-10-27 12:14:22 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11650, 'Instituto San Pablo Apostol', 5620, '3', '1', 0, 0, 1)
ERROR - 2020-10-27 12:15:23 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11652, 'Luis Alberto Sanches', 5621, '5', '2', 0, 0, 1)
ERROR - 2020-10-27 12:17:44 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11654, 'Instituto San Pablo Apostol', 5622, '3', '1', 0, 0, 1)
ERROR - 2020-10-27 12:37:05 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11656, 'Instituto San Pablo Apostol', 5623, '3', '1', 0, 0, 1)
ERROR - 2020-10-27 14:08:20 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11658, 'Instituto San Pablo Apóstol ', 5624, '3', '1', 0, 0, 1)
ERROR - 2020-10-27 14:08:29 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11660, 'Instituto San Pablo Apóstol ', 5625, '3', '1', 0, 0, 1)
ERROR - 2020-10-27 14:15:25 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11662, 'Miguel Cortes', 5626, '5', '1', 0, 0, 1)
ERROR - 2020-10-27 14:15:38 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11664, 'Miguel Cortes', 5627, '5', '1', 0, 0, 1)
ERROR - 2020-10-27 14:16:08 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11666, 'Miguel Cortes', 5628, '5', '1', 0, 0, 1)
ERROR - 2020-10-27 14:16:35 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11668, 'Miguel Cortes', 5629, '5', '1', 0, 0, 1)
ERROR - 2020-10-27 14:16:55 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11670, 'Miguel Cortes', 5630, '5', '1', 0, 0, 1)
ERROR - 2020-10-27 14:22:35 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11672, 'Miguel Cortes', 5631, '5', '1', 0, 0, 1)
ERROR - 2020-10-27 15:57:26 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11674, 'I.E.P MIGUEL CORTES', 5632, '5', '2', 0, 0, 1)
ERROR - 2020-10-27 15:57:31 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11676, 'I.E.P MIGUEL CORTES', 5633, '5', '2', 0, 0, 1)
ERROR - 2020-10-27 15:57:35 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11678, 'I.E.P MIGUEL CORTES', 5634, '5', '2', 0, 0, 1)
ERROR - 2020-10-27 15:57:39 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11680, 'I.E.P MIGUEL CORTES', 5635, '5', '2', 0, 0, 1)
ERROR - 2020-10-27 16:00:12 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11682, 'I.E.P MIGUEL CORTES', 5636, '5', '2', 0, 0, 1)
ERROR - 2020-10-27 16:00:18 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11684, 'I.E.P MIGUEL CORTES', 5637, '5', '2', 0, 0, 1)
ERROR - 2020-10-27 16:27:08 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11686, 'I.E Mauro Giraldo Romero', 5638, '4', '1', 0, 0, 1)
ERROR - 2020-10-27 16:27:23 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11688, 'I.E Mauro Giraldo Romero', 5639, '4', '1', 0, 0, 1)
ERROR - 2020-10-27 16:27:28 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11690, 'I.E Mauro Giraldo Romero', 5640, '4', '1', 0, 0, 1)
ERROR - 2020-10-27 16:27:31 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11692, 'I.E Mauro Giraldo Romero', 5641, '4', '1', 0, 0, 1)
ERROR - 2020-10-27 16:27:34 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11694, 'I.E Mauro Giraldo Romero', 5642, '4', '1', 0, 0, 1)
ERROR - 2020-10-27 16:28:46 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11696, 'I.E Mauro Giraldo Romero', 5643, '4', '1', 0, 0, 1)
ERROR - 2020-10-27 17:55:06 --> 404 Page Not Found: Robotstxt/index
ERROR - 2020-10-27 18:36:53 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11698, 'I.E REPÚBLICA DEL PERU', 5644, '3', '2', 0, 0, 1)
ERROR - 2020-10-27 18:37:02 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11700, 'I.E REPÚBLICA DEL PERU', 5645, '3', '2', 0, 0, 1)
ERROR - 2020-10-27 18:40:15 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11702, 'República del Perú ', 5646, '5', '2', 0, 0, 1)
ERROR - 2020-10-27 18:41:11 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11704, 'República del Perú ', 5647, '5', '2', 0, 0, 1)
ERROR - 2020-10-27 18:41:36 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11706, 'República del Perú ', 5648, '5', '2', 0, 0, 1)
ERROR - 2020-10-27 18:41:50 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11708, 'República del Perú ', 5649, '3', '2', 0, 0, 1)
ERROR - 2020-10-27 18:42:11 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11710, 'República del Perú ', 5650, '3', '2', 0, 0, 1)
ERROR - 2020-10-27 20:48:26 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11712, 'Exitus', 5651, '1', '2', 0, 0, 1)
ERROR - 2020-10-27 22:06:58 --> 404 Page Not Found: Robotstxt/index
ERROR - 2020-10-27 22:24:11 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11714, 'I.E.P Sagrado Corazón de Jesús La Unión', 5652, '5', '2', 0, 0, 1)
ERROR - 2020-10-27 22:25:10 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11716, 'I.E.P Sagrado Corazón de Jesús La Unión', 5653, '5', '2', 0, 0, 1)
ERROR - 2020-10-27 22:26:22 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11718, 'I.E.P Sagrado Corazón de Jesús La Unión', 5654, '5', '2', 0, 0, 1)
ERROR - 2020-10-27 22:27:03 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11720, 'I.E.P Sagrado Corazón de Jesús La Unión', 5655, '5', '2', 0, 0, 1)
