import { useCurso } from 'Hooks/useCurso';
function Curso() {

    const { cursos, errorServer } = useCurso();
    console.log("cursos", cursos);
    console.log(errorServer, "error");
    return (
        <div>
            Prueba
        </div>
    )
}

export { Curso };