import { useState, useContext, useEffect } from 'react'
import Context from 'Context/UserContext';
import { getAllCursos } from 'Service/CursoService'

function useCurso() {

    const [cursos, setCursos] = useState([]);
    const [errorServer, setErrorServer] = useState(false);
    const { jwt } = useContext(Context);

    useEffect(() => {
        getAllCursos({ jwt })
        .then(response => {
            if(response.status === 500) {
                setErrorServer(true);
            }
            if(response.status === 401) {
                setErrorServer(true);
            }
            if(response.status === 403) {
                setErrorServer(true);
            }
            return response.json();
        })
        .then(data => setCursos(data));

    }, []);


    return {
        cursos,
        errorServer
    }


}

export { useCurso }