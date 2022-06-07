import { useState, useEffect, useContext } from 'react'; 

import {getAllPeriod, storeOnePeriod, updateOnePeriodo, 
    changeStatePeriod} from 'Service/periodoService';
import Context from 'Context/UserContext';


function usePeriodo() {

    const { jwt } = useContext(Context);

    const [periodo, setPeriodo] = useState([]);
    const [loading, setLoading] = useState(false);
    const [errorPermission, setErrorPermission] = useState(false);
    const [errorSave, setErrorSave] = useState(false);
    const [saveSuccess, setSaveSuccess] = useState(false);
    const [updateData, setUpdateData] = useState(false);

    useEffect(() => {
        setLoading(true);
        getAllPeriod({ jwt })
        .then((data) => {
            if(data.status) {
                if(data.status === 401) {
                    setErrorPermission(true);
                }
            }else {
                data.forEach((da, index) => {
                    da.index = index
                    return data;
                }) 
                setPeriodo(data);
                setLoading(false);
            }
        })
    }, [jwt, setErrorPermission, setLoading, setPeriodo, updateData])

    const getPeriod = () => {
        setLoading(true);
        getAllPeriod({ jwt })
        .then((data) => {
            if(data.status) {
                if(data.status === 401) {
                    setErrorPermission(true);
                }
            }else {
                data.forEach((da, index) => {
                    da.index = index
                    return data;
                }) 
                setPeriodo(data);
                setLoading(false);
            }
        });

    }


    const storePeriod = ({data}) => {
        setLoading(true);
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
            setSaveSuccess(true);
            return data.json()
        })
        .then(data => {
            if(data.message === 'Ok') {
                setLoading(false)
                setSaveSuccess(true);
                setUpdateData(!updateData);
            }
        });
    };

    const updatePeriod = ({data}) => {
        setLoading(true);
        updateOnePeriodo({data, jwt})
        .then(data => {
            if(data.status === 500) {
                setSaveSuccess(false);
                setErrorSave(true);
                return;
            }
            if(data.status === 401) {
                setSaveSuccess(false);
                setErrorPermission(true);
                return;
            }
            setErrorPermission(false);
            setErrorSave(false);
            setSaveSuccess(true);
            return data.json();
        })
        .then(data => {
            if(data.message === 'Ok') {
                setLoading(false);
                setSaveSuccess(true);
                setUpdateData(!updateData);
            }
        })
    }

    const changeState = ({ data, onClose }) => {

        changeStatePeriod({ data, jwt })
        .then(data => {

            if(data.status === 500) {
                setSaveSuccess(false);
                setErrorSave(true);
                return;
            }
            if(data.status === 401) {
                setSaveSuccess(false);
                setErrorPermission(true);
                return;
            }
            setErrorPermission(false);
            setErrorSave(false);
            setSaveSuccess(true);
            return data.json();
        })
        .then(data => {
            if(data.message === 'Ok') {
                setLoading(false);
                setSaveSuccess(true);
                setUpdateData(!updateData);
                onClose()
            }
        })
    }
    

    return {
        periodo,
        loading,
        errorPermission,
        storePeriod,
        errorSave,
        setErrorSave,
        updatePeriod,
        saveSuccess,
        setLoading,
        setPeriodo,
        getPeriod,
        changeState
    }

}
export {usePeriodo};
