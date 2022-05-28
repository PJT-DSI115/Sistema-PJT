import { useContext, useCallback, useState } from "react";

import Context from "Context/UserContext";


import { loginService } from 'Service/loginService';

function useUser() {
    const { jwt, setJWT, nombreRol, setNombreRol, idRol, setIdRol } = useContext(Context);
    const [state, setState] = useState({loading: false, error: false});
    const [messageError, setMessageError] = useState("");

    const login = useCallback(({ username, password }) => {
        setState({loading: true, error: false});
        loginService({username, password})
        .then(data => {
            if(data.message) {
                window.sessionStorage.removeItem('jwt');
                setState({loading: false, error: true})
                setMessageError(data.message);
            } else {
                window.sessionStorage.setItem('jwt', data.jwt);
                window.sessionStorage.setItem('nombreRol', data.nombreRol);
                window.sessionStorage.setItem('idRol', data.idRol);
                setJWT(data.jwt);
                setIdRol(data.idRol);
                setNombreRol(data.nombreRol);
                setState({loading: false, error: false});
            }
        })
    }, [setJWT, setIdRol, setNombreRol]);

    const logout = useCallback(() => {

        setJWT(null);
        setIdRol(null);
        setNombreRol(null);
        window.sessionStorage.removeItem('jwt');
        window.sessionStorage.removeItem('nombreRol');
        window.sessionStorage.removeItem('idRol');

    }, [setJWT, setIdRol, setNombreRol]);

    return {
        logout,
        login,
        idRol,
        nombreRol,
        isLogged: Boolean(jwt),
        isLoginLoading: state.loading,
        isLoginError: state.error,
        messageError
    }
}
export {useUser};
