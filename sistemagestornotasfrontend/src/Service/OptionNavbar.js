const optionsAdministrador = [
    {
        id: 1,
        nombre: 'Gestionar Periodos',
        ruta: '/gestionPeriodos',
    },
    {
        id: 2,
        nombre: 'Gestionar Cursos',
        ruta: '/gestionCursos'
    },
    {
        id: 3,
        nombre: 'Gestionar Niveles',
        ruta: '/gestionNiveles'
    },
    {
        id: 4,
        nombre: 'Asignación Docentes',
        ruta: '/asignacionDocentes'
    },
    {
        id: 5,
        nombre: 'Gestionar Actividades',
        ruta: '/gestionActividad'
    },
    {
        id: 6,
        nombre: 'Gestionar Usuarios',
        ruta: '/gestionUsuarios'
    },
    {
        id: 7,
        nombre: 'Gestionar Categorias',
        ruta: '/gestionCategoriasAlumno'
    },
    {
        id: 8,
        nombre: 'Gestionar Alumnos',
        ruta: '/gestionAlumnos'
    },
    {
        id: 9,
        nombre: 'Gestionar Docente',
        ruta: '/gestionarDocente'
    },


    {
        id: 10,
        nombre: 'Asignación Alumnos',
        ruta: '/AsignarCursoAlumno'
    },
    {
        id: 11,
        nombre: 'Boleta Sabatina',
        ruta: '/boletaSabatina'

    }
]
const optionsMaestro = [
    {
        id: 1,
        nombre: 'Gestionar Actividades',
        ruta: '/actividad'
    },
    {
        id: 2,
        nombre: 'Gestionar Notas',
        ruta: '/gestionarNotas'
    },
    {
        id: 3,
        nombre: 'Rendimiento Académico',
        ruta: '/consultarRendimientoAcademico'
    },
    {
        id: 4,
        nombre: 'Nómina de Notas',
        ruta: '/consultarNomina'
    },
    {
        id: 5,
        nombre: 'Consulta de Notas Acumuladas',
        ruta: '/consultarAcumulada'
    }
]
const optionsCoordinador = [
    {
        id: 1,
        nombre: 'Consultar Notas',
        ruta: '/consultarNotas',
    },
    {
        id: 2,
        nombre: 'Asignación Docentes',
        ruta: '/asignacionDocentes'
    }
]

const optionsFilter = [
    {
        id: 1,
        name: 'Alumnos',
        active: true,
        option: 'students'
    },
    {
        id: 2,
        name: 'Empleados',
        active: false,
        option: 'teachers'
    }
]

function selectOption({ value }) {
    if(value === 'Administrador') {
        return optionsAdministrador;
    } 
    if(value === 'Docente') {
        return optionsMaestro;
    }
    if(value === 'Coordinador'){
        return optionsCoordinador;;
    }
    if(value === 'userFilter') {
        return optionsFilter;
    }
}

export {
    selectOption
}
