import { useState, useContext } from "react";
import {getAllActividad, storeActividad, updateActividad, deleteActividad} from '../Service/ActividadService';
import Context from "Context/UserContext";

function useActividad () {

    const { jwt } = useContext(Context);
    const {actividad, setActividad} = useState([]);
    const [loading, setLoading]= useState(false);
    const [errorPermission, setErrorPermission] = useState(false);
    const [errorSave, setErrorSave] = useState(false);
    const [saveSuccess, setSaveSuccess] = useState(false);
    const [updateData, setUpdateData] = useState(false);

    const getActivities = () =>{
        setLoading(true);
        getAllActividad({jwt})
        .then(data => {
            if(data.status){
                if(data.status === 401){
                    setErrorPermission(true);
                }
            }
            else{
                data.forEach((da, index) => {
                    da.index = index;
                    return data;
                })
                setActividad(data);
                setLoading(false);
            }
        });
    }

    const storeActivity = ({data}) =>{
        setLoading(true);
        storeActividad({data, jwt})
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
    }

    const updateActivity = ({data}) =>{
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
    }

    return{
        actividad,
        getActivities,
        storeActivity,
        errorPermission,
        loading,
        setLoading,
        errorSave,
        setErrorSave,
        saveSuccess
    }

}

export {useActividad};
