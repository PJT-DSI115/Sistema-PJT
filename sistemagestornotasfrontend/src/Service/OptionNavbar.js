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
    }
]
const optionsMaestro = [
    {
        id: 1,
        nombre: 'Mis Cursos',
        ruta: '/cursosAsignados',
    },
    {
        id: 2,
        nombre: 'Gestionar Actividades',
        ruta: '/actividad'
    },
    {
        id: 3,
        nombre: 'Gestionar Notas',
        ruta: '/gestionarNotas'
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
}

export {
    selectOption
}
