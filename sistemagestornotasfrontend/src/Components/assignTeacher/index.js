import { useParams } from 'react-router-dom';

function AssignTeacher() {

    const  { periodo, nivelCurso }  = useParams();

    console.log(periodo, "Periodo");
    console.log(nivelCurso, "Nivel Curso");

    return (
        <div>
            <h1>Asignacion de profesores</h1>
            
        </div>
    );
}


export { AssignTeacher };
