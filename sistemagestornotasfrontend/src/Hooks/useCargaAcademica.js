import { useState, useEffect, useContext } from "react";
import Context from "Context/UserContext"
import { useParams } from "react-router-dom";
import {getAllAlumnosFromCarga} from 'Hooks/useCargaAcademica';

function useCargaAcademica () {

    const {jwt} = useContext(Context);
    const {idPeriodo, idCursoNivel} = useParams();
    const [listaAlumnos, setListaAlumnos] = useState([]);
    const [loading, setLoading] = useState(null);
    const [errorPermission, setErrorPermission] = useState(null);
    const [errorLog, setErrorLog] = useState(null);

    const data = {
        id_periodo: idPeriodo,
        id_curso_nivel: idCursoNivel
    }

    useEffect(() => {
        setLoading(true);
        setErrorPermission(false);
        getAllAlumnosFromCarga({data, jwt})
        .then(data => {
            if(data.status){
                if(data.status === 401){
                    setErrorPermission(true);
                    return;
                }
                if(data.status === 500){
                    setErrorLog(true);
                    return;
                }
            }
            else {
                setLoading(false);
                setErrorLog(false);
                setErrorPermission(false);
                data.forEach((da, index) => (da.index = index));
                setListaAlumnos(data);
            }
        })
    }, [jwt])

    return[
        listaAlumnos,
        loading,
        errorLog,
        errorPermission
    ]
}

export {useCargaAcademica}