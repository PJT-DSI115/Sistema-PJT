import { useState, useEffect, useContext } from "react";

import { getAllNivels } from "Service/NivelService";
import Context from "Context/UserContext";

function useNivel() {
    const {jwt} = useContext(Context);

    const [nivel, setNivel] = useState([]);
    const [loading, setLoading] = useState(false);
    const [errorPermission, setErrorPermission] = useState(false);
    const [errorSave, setErrorSave] = useState(false);
    const [saveSuccess, setSaveSuccess] = useState(false);

    useEffect(() => {
        setLoading(true);
        getAllNivels({jwt})
        .then((data) => {
            if(data.status){
                if(data.status === 401){
                    setErrorPermission(true);
                }
            }else{
                data.forEach((da, index) => {
                    da.index = index;
                    return data;
                });
                setNivel(data);
                setLoading(false);
            }
        })
    }, [jwt, setErrorPermission, setLoading, setNivel])

    const getNivel = () => {
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

    return {
        nivel,
        loading,
        getNivel
    }
}

export {useNivel};