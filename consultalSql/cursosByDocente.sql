SELECT r.id, cu.id_curso, c.nombre_curso, n.nombre_nivel  
FROM registro_docente_cursos r 
INNER JOIN curso_nivels cu on r.id_nivel_curso = cu.id 
INNER JOIN cursos c on c.id = cu.id_curso 
INNER JOIN nivels n on n.id = cu.id_nivel 
WHERE r.id_docente = 1

select n.nombre_nivel, n.id from registro_docente_cursos r 
INNER JOIN curso_nivels cn on r.id_nivel_curso = cn.id
INNER JOIN nivels n on n.id = cn.id_nivel
WHERE r.id_docente = 3 AND r.id_periodo = 1
GROUP by n.id

//Cursos for nivel
select n.nombre_nivel, n.id as idNivel, cn.id as idNivelCurso, c.nombre_curso, c.id as idCurso from registro_docente_cursos r 
INNER JOIN curso_nivels cn on r.id_nivel_curso = cn.id
INNER JOIN nivels n on n.id = cn.id_nivel
INNER JOIN cursos c on c.id = cn.id_curso
WHERE r.id_docente = 1 AND r.id_periodo = 1
and n.id = 2

