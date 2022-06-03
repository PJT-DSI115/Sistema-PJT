import { useState, useContext, useEffect } from "react";
import {getAllActividad, storeActividad, updateActividad, deleteActividad} from '../Service/ActividadService';
import Context from "Context/UserContext";

function useActividad () {

    const { jwt } = useContext(Context);
    const [actividad, setActividad] = useState([]);
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(false);
    const [errorResponse, setErrorResponse] = useState(false);
    const [errorDescription, setErrorDescription] = useState("");
    const [updateData, setUpdateData] = useState(false);

    useEffect(() => {
        return () => {
            setLoading(true);
            getAllActividad({jwt})
            .then(data =>{
                if(data.status){
                    if(data.status === 500 || data.status === 401 || data.status === 403){
                        setError(true);
                        return;
                    }
                }
                else{
                    data.forEach((da, index) =>{
                        da.index = index;
                        return data;
                    })
                    setActividad(data);
                    setError(false);
                }
            })
        };
    }, [jwt])

    const getActivity = () =>{
        setLoading(true);
        getAllActividad({jwt})
        .then(data => {
            if(data.status){
                if(data.status === 500 || data.status === 401){
                    setError(true);
                    return;
                }
            }
            else{
                data.forEach((da, index) => {
                    da.index = index;
                    return data;
                })
                setActividad(data);
                setLoading(false);
                setError(false)
            }
        });
    }

    const storeActivity = ({data}) =>{
        setLoading(true);
        storeActividad({data, jwt})
        .then(data => {
            if(data.status === 500 || data.status === 401) {
                setError(true);
                return;
            }
            return data.json()
        })
        .then(data => {
            console.log("Antes")
            if(data.message === 'Error'){
                setErrorResponse(true);
                setErrorDescription(data.descripcionMessage);
                console.log("durante")
                console.log(errorDescription);
                return;
            }
            console.lof("despues")
            setErrorResponse(false);
        });
    }

    /*const updateActivity = ({data}) =>{
        setLoading(true);
        updateActividad({data, jwt})
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
    }*/

    const deleteActivity = ({data}) =>{
        setLoading(true);
        deleteActividad({data, jwt})
        .then(data => {
            if(data.message === 'Error'){
                setLoading(false);
                setErrorResponse(true);
                setErrorDescription(data.descripcionMessage);
            }
            if(data.message === 'Ok'){
                setLoading(false);
                setErrorResponse(false);
                setErrorDescription(data.descripcionMessage);
            }
        })
    }

    return{
        actividad,
        storeActivity,
        deleteActivity,
        error,
        errorResponse,
        errorDescription,
        loading,
        setLoading,
        updateData
    }

}

export {useActividad};
