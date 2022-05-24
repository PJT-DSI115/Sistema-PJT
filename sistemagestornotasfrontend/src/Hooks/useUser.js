import { useContext, useCallback, useState } from "react";

import Context from "Context/UserContext";


import { loginService } from 'Service/loginService';

function useUser() {
    const { jwt, setJWT } = useContext(Context);
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
                setJWT(data.jwt);
                setState({loading: false, error: false});
            }
            console.log("estado del error", state.error);
        })
    }, [setJWT, state]);

    const logout = useCallback(() => {

        setJWT(null);
        window.sessionStorage.removeItem('jwt');

    }, [setJWT])

    return {
        logout,
        login,
        isLogged: Boolean(jwt),
        isLoginLoading: state.loading,
        isLoginError: state.error,
        messageError
    }
}
export {useUser};
