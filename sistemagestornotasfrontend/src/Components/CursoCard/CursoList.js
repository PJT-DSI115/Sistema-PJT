import { CursoCard } from "./CursoCard";

const CursoList = ({cursoNivel}) =>{


    function mostrarCursos(){
        return(
            cursoNivel ? 
            cursoNivel.map(cn => (
                <CursoCard
                    key={cn.id}
                    nombre={cn.curso.nombre_curso}
                    nivel={cn.nivel.nombre_nivel}
                />
            )): ""
        );
    }

    return(
        <div className="Cursos-list">
            {mostrarCursos()}
        </div>
    );

}

export default CursoList;
