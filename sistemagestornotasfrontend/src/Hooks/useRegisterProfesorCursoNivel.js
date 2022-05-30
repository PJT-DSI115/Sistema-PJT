import { useContext, useEffect, useState } from "react";
import { getAllRegisterByNivelCursoAndPeriodo } from 'Service/registerProfesorCursoNivel';
import Context from "Context/UserContext";

function useRegisterProfesorCursoNivel({ idPeriodo, idCursoNivel }) {

    const { jwt } = useContext(Context);

    const [error, setError] = useState(false);
    const [register, setRegister] = useState([]);

    useEffect( () => {

        getAllRegisterByNivelCursoAndPeriodo({ idPeriodo, idCursoNivel, jwt })
            .then(response => {
                setError(false);
                if(response.status === 500 || response.status === 401 || 
                    response.status === Error403) {
                    setError(true);
                    return;
                }
                return response.json();
            })
            .then(data => () => {
                setRegister(data);
                setError(false);
            })
    }, [idPeriodo, idCursoNivel] );

    return {
        register,
        setRegister,
        error
    }
}

export { useRegisterProfesorCursoNivel };
