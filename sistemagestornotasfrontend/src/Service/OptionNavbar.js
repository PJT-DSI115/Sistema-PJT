const optionsAdministrador = [
    {
        id: 1,
        nombre: 'Periodo',
        ruta: '/gestionPeriodo',
    },
    {
        id: 2,
        nombre: 'Asignacion Docentes',
        ruta: '/asignacionDocentes'
    },
    {
        id:3,
        nombre: 'Gestion Cursos',
        ruta: '/gestionCursos'
    },
    {
        id: 4,
        nombre: 'Gestion Niveles',
        ruta: '/gestionNiveles'
    }
]
const optionsMaestro = [
    {
        id: 1,
        nombre: 'Cursos',
        ruta: '/cursosAsignados',
    },
    {
        id: 2,
        nombre: 'Gestionar Actividades',
        ruta: '/actividad'
    }
]

function selectOption({ value }) {
    if(value === 'Administrador') {
        return optionsAdministrador;
    } 
    if(value === 'Docente') {
        return optionsMaestro;
    }
}

export {
    selectOption
}
