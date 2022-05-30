import {useEffect} from "react";
import { useCursoNivel } from "Hooks/useCursoNivel";
import { CursoCard } from "./CursoCard";

const CursoList = ({id}) =>{

    const {cursoNivel, loading, getCursosNivel} = useCursoNivel();

    useEffect(() => {
        getCursosNivel({id});
    }, [id])

    console.log(cursoNivel);

    function mostrarCursos(){
        return(
            cursoNivel.map(cn => (
                <CursoCard
                    key={cn.id}
                    nombre={cn.curso.nombre_curso}
                    nivel={cn.nivel.nombre_nivel}
                />
            ))
        );
    }

    return(
        <div className="Cursos-list">
            {mostrarCursos()}
        </div>
    );

}

export default CursoList;