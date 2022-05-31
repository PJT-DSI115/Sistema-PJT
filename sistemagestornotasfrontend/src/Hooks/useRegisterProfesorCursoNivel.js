import { useContext, useEffect, useState } from "react";
import { getAllRegisterByNivelCursoAndPeriodo, storeRegister } from 'Service/registerProfesorCursoNivel';
import Context from "Context/UserContext";

function useRegisterProfesorCursoNivel({ idPeriodo, idCursoNivel }) {

    const { jwt } = useContext(Context);

    const [error, setError] = useState(false);
    const [errorLogic, setErrorLogic] = useState(false);
    const [messageErrorLogic, setMessageLogic] = useState("");
    const [register, setRegister] = useState([]);

    useEffect( () => {
        getAllRegisterByNivelCursoAndPeriodo({ idPeriodo, idCursoNivel, jwt })
            .then(response => {
                setError(false);
                if(response.status === 500 || response.status === 401 || 
                    response.status === 403) {
                    setError(true);
                    return;
                }
                return response.json();
            })
            .then(data => {
                data.forEach((data, index) => {
                    data['index'] = index;
                    return data
                });
                console.log(data, "data que nos esta retornando");
                setRegister(data);
                setError(false);
            })
    }, [idPeriodo, idCursoNivel, jwt] );


    const registerDocenteCursoNivel = ({ data }) => {
        storeRegister({ data, jwt })
        .then(response => {
            if(response.status === 500 || response.status === 401 || response.status === 403) {
                setError(true);
                return;
            }
            return response.json();
        })
        .then(data => {
            if(data.message === "Error") {
                setErrorLogic(true);
                setMessageLogic(data.descripcionMessage);
            }
        });

    }



    return {
        register,
        setRegister,
        error,
        errorLogic,
        messageErrorLogic,
        registerDocenteCursoNivel
    }
}

export { useRegisterProfesorCursoNivel};
