import { useState, useEffect, useContext } from 'react'; 

import {getAllPeriod, storeOnePeriod} from 'Service/periodoService';
import Context from 'Context/UserContext';


function usePeriodo() {

    const { jwt } = useContext(Context);

    const [periodo, setPeriodo] = useState([]);
    const [loading, setLoading] = useState(false);
    const [errorPermission, setErrorPermission] = useState(false);
    const [errorSave, setErrorSave] = useState(false);

    useEffect(() => {
        setLoading(true);
        getAllPeriod({ jwt })
        .then((data) => {
            if(data.status) {
                if(data.status === 401) {
                    setErrorPermission(true);
                }
            }else {
                setPeriodo(data);
                setLoading(false);
            }
        })

    }, [jwt, setErrorPermission, setLoading, setPeriodo])


    const storePeriod = ({data}) => {

        storeOnePeriod({data, jwt})
        .then(data => {
            if(data.status === 500) {
                setErrorSave(true);
                return;
            }
            if(data.status === 401) {
                setErrorPermission(true);
                return;
            }
            setErrorPermission(false);
            setErrorSave(false);
            return data.json()
        })
        .then(data => {
            console.log(data);
        });
    };
    
    return {
        periodo,
        loading,
        errorPermission,
        storePeriod,
        errorSave,
        setErrorSave
    }

}
export {usePeriodo};