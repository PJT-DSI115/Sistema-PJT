import { useParams } from 'react-router-dom';
import { useListadoCursosDocentes } from 'Hooks/useListadoCursosDocente';
import { useEffect } from 'react';
import { CursoCard } from 'Components/CursoCard/CursoCard'
import { Loader } from 'Components/Loader';
function ListadocursoDocente() {
    const  { idPeriodo }  = useParams();

    const { cursos, getAllCursos, loading } = useListadoCursosDocentes();

    useEffect(() => {
        getAllCursos({idPeriodo});
    }, [idPeriodo]);

    if(!cursos) {
        return "";
    }

    if(loading) {
        return <Loader />
    }

    return (
        <div>
            <h1
                className = "text-lg font-bold mt-10 text-center"
            >Cursos</h1>
            {
                cursos.map( (curso, index) => (
                    <div key = {index} className = "mb-10">
                        <h2 key = {index} className = "text-sm font-bold text-center mt-10 mb-8">{curso.nombre}</h2>
                        <div className="Cursos-list">
                            {
                                curso.values.map((va, index) => (
                                    <CursoCard 
                                        key = { index }
                                        id_curso_nivel={va.idCursoNivel}
                                        nombre = {va.nombre_curso}
                                        nivel = {va.nombre_nivel}
                                    />
                                ))
                            }
                        </div>
                    </div>

                ))
            }
        </div>
    );

}

export {
    ListadocursoDocente
}