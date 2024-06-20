<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-11-01 00:12:40 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11926, 'I.E \"Las Capullanas\" Sullana ', 5758, '5', '2', 0, 0, 1)
ERROR - 2020-11-01 05:43:03 --> 404 Page Not Found: Robotstxt/index
ERROR - 2020-11-01 07:45:29 --> 404 Page Not Found: Env/index
ERROR - 2020-11-01 08:46:56 --> 404 Page Not Found: Env/index
ERROR - 2020-11-01 12:21:03 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11928, 'I. E Las Capullanas', 5759, '5', '2', 0, 0, 1)
ERROR - 2020-11-01 21:12:53 --> Severity: Notice --> Undefined variable: value /home/academiaexitus/factura.academiaexitus.edu.pe/exitus/application/views/home/areas.php 14
ERROR - 2020-11-01 21:12:53 --> Severity: Notice --> Trying to get property 'Descripcion' of non-object /home/academiaexitus/factura.academiaexitus.edu.pe/exitus/application/views/home/areas.php 14
ERROR - 2020-11-01 21:20:52 --> 404 Page Not Found: Assets/assets
ERROR - 2020-11-01 21:20:52 --> 404 Page Not Found: Assets/assets
ERROR - 2020-11-01 21:22:23 --> Severity: Notice --> Undefined variable: user_info_logged_in /home/academiaexitus/factura.academiaexitus.edu.pe/exitus/application/views/body.php 81
ERROR - 2020-11-01 21:22:23 --> Severity: Notice --> Trying to get property 'avatar' of non-object /home/academiaexitus/factura.academiaexitus.edu.pe/exitus/application/views/body.php 81
ERROR - 2020-11-01 21:22:23 --> 404 Page Not Found: Assets/assets
ERROR - 2020-11-01 21:22:24 --> 404 Page Not Found: Assets/assets
ERROR - 2020-11-01 21:22:24 --> 404 Page Not Found: Assets/assets
ERROR - 2020-11-01 21:22:35 --> 404 Page Not Found: Assets/assets
ERROR - 2020-11-01 21:22:35 --> 404 Page Not Found: Assets/assets
ERROR - 2020-11-01 21:22:36 --> 404 Page Not Found: Assets/assets
ERROR - 2020-11-01 21:22:52 --> 404 Page Not Found: Assets/assets
ERROR - 2020-11-01 21:22:52 --> 404 Page Not Found: Assets/assets
ERROR - 2020-11-01 21:22:53 --> 404 Page Not Found: Assets/assets
ERROR - 2020-11-01 21:22:56 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: SELECT `id`
FROM `alumno`
WHERE `estado` = 0
ERROR - 2020-11-01 21:22:56 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: SELECT `id`
FROM `alumno`
WHERE `estado` = 1
ERROR - 2020-11-01 21:23:03 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: SELECT `p`.`id` as `id_persona`, concat(ti.abrev, " : ", i.nroidentificacion) as identificacion, concat(p.apellidos, " ", p.nombres) as persona, `p`.`direccion`, `p`.`email`, `p`.`fch_nac`, `p`.`telefono`, `p`.`estado`, `a`.`id` as `id_alumno`
FROM `alumno` `a`
JOIN `persona` `p` ON `p`.`id` = `a`.`persona_id`
JOIN `identificacion` `i` ON `i`.`persona_id` = `p`.`id`
JOIN `tipo_identificacion` `ti` ON `ti`.`id` = `i`.`tipo_identificacion_id`
WHERE `a`.`estado` = 0
ERROR - 2020-11-01 21:23:06 --> 404 Page Not Found: Faviconico/index
ERROR - 2020-11-01 23:29:09 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11930, 'Trilce Fe Y Esperanza ', 5760, '5', '2', 0, 0, 1)
ERROR - 2020-11-01 23:29:44 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11932, 'Trilce Fe Y Esperanza ', 5761, '5', '2', 0, 0, 1)
ERROR - 2020-11-01 23:29:57 --> Query error: Table 'academia_factura.alumno' doesn't exist - Invalid query: INSERT INTO `alumno` (`persona_id`, `colegio`, `tutor_id`, `area_id`, `turno_id`, `estado`, `estadia`, `ciclo_id`) VALUES (11934, 'Trilce Fe Y Esperanza ', 5762, '5', '2', 0, 0, 1)
