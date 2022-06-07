import { useState, useContext, useEffect } from 'react'
import Context from 'Context/UserContext';
import { getAllCursos, storeCursos, updateCursos, deleteCursos } from 'Service/CursoService'

function useCurso({showModal}) {

    const [cursos, setCursos] = useState([]);
    const [loading, setLoading] = useState(false);
    const [errorServer, setErrorServer] = useState(false);
    const [errorPermission, setErrorPermission] = useState(false);
    const [saveSuccess, setSaveSuccess] = useState(false);
    const { jwt } = useContext(Context);

    useEffect(() => {
        setLoading(true);
        getAllCursos({ jwt })
        .then(response => {
            if(response.status === 500) {
                setErrorServer(true);
            }
            if(response.status === 401) {
                setErrorServer(true);
            }
            if(response.status === 403) {
                setErrorServer(true);
            }
            return response.json();
        })
        .then(data => {
            data.forEach( (cu, index) => {
                cu.index= index;
                return data;
            })
            setCursos(data);
            setLoading(false);
        });

    }, [jwt, setErrorPermission, setLoading, setCursos, showModal]);

    const getCurso = () =>{
        setLoading(true);
        getAllCursos({jwt})
        .then ( (data) => {
            if(data.status){
                if(data.status === 401){
                    setErrorPermission(true);
                }
            }
                else{
                    data.forEach( (cu, index) => {
                        cu.index= index;
                        return data;
                    })
                    setCursos(data);
                    setLoading(false);
                }
        });
    }

    const storeCurso = ({data})=>{
        storeCursos({data, jwt})
        .then( (data) =>{
            if(data.status === 500){
                setErrorServer(true);
                return;
            }
            
            if(data.status === 401){
                setErrorPermission(true);
                return;
            }
            
            setErrorPermission(false);
            setSaveSuccess(true);
            return data.json();
        })
        .then(data => {
            if(data.message === 'Ok'){
                setLoading(false);
                setSaveSuccess(true);
            }
        })
    }

    const updateCurso =({data}) => {
        setLoading(true);
        updateCursos({data,jwt})
        .then( (data) => {
            if(data.status === 500){
                setSaveSuccess(false);
                setErrorServer(true);
                return;
            }
            if( data.status === 401){
                setSaveSuccess(false);
                setErrorPermission(true);
                return;
            }

            setErrorPermission(false);
            setErrorServer(false);
            setSaveSuccess(true);
            return data.json();
        })
        .then( (data) => {
            if(data.message === 'OK'){
                setLoading(false);
                setSaveSuccess(true);
            }
        })
    }

    const deleteCurso = ({data}) =>{
        deleteCursos({data, jwt})
        .then (data => {
            if(data.status === 500){
                setSaveSuccess(false);
                setErrorServer(true);
                return;
            }

            if(data.status === 401){
                setSaveSuccess(false);
                setErrorPermission(true);
                return;
            }

            setErrorPermission(false);
            setErrorServer(false);
            setSaveSuccess(true);
            return data.json();
        })

        .then( (data) => {
            if(data.message === 'OK'){
                setLoading(false);
                setSaveSuccess(true);
            }
        })
    }

    return {
        cursos,
        errorServer,
        loading,
        errorPermission,
        saveSuccess,
        setCursos,
        setLoading,
        setErrorServer,
        setErrorPermission,
        setSaveSuccess,
        getCurso,
        storeCurso,
        updateCurso,
        deleteCurso
    }


}

export { useCurso}