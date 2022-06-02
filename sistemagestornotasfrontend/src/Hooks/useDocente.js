import { useEffect, useContext, useState } from 'react';
import Context from 'Context/UserContext';
import { getAllDocentes } from 'Service/docenteService';

function useDocente() {

    const { jwt } = useContext(Context);
    const [docentes, setDocentes] = useState([]);
    const [error, setError] = useState(false);


    useEffect( () => {
        getAllDocentes( { jwt } )
        .then(response => {
            if(response.status === 500 || response.status === 401 || response.status === 403) {
                setError(true);
                return;
            }

            return response.json();
        })
        .then(data => {
            if(data.length > 0) {
                setDocentes(data);
                setError(false);
            }
        })

    }, [jwt])

    return {
        docentes,
        error
    }
}

export { useDocente };