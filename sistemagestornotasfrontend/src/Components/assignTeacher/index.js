
import { useState } from 'react';
import { useParams } from 'react-router-dom';

import { AssignTeacheTable } from './AssignTeacherTable';
import { useRegisterProfesorCursoNivel } from 'Hooks/useRegisterProfesorCursoNivel';
import { FormRegister } from './FormRegister';
import  Modal  from 'Components/Modal';


function AssignTeacher() {

    const  { idPeriodo, idCursoNivel }  = useParams();
    const { register } = useRegisterProfesorCursoNivel({ idPeriodo, idCursoNivel });
    const [showModal, setShowModal] = useState(false);
    const [heightC, setHeigtC] = useState("");
    const [widthC, setWidthC] = useState("");
    const [children, setChildren] = useState("");

    const onClose = () => {
        setShowModal(false);
    }

    const handleClickRegister = () => {
        setHeigtC("400px");
        setWidthC("600px");
        setChildren(
            <FormRegister 
                title={ "Registro docente curso" }
                onClose = { onClose }
                />
        );
        setShowModal(true);

    }

    return (
        <div className= "main">
            <h1 
                className= "text-lg font-bold text-center mt-10"
            >Asignación de profesores</h1>
            <div className="buttonRegisterContainer">
                <button 
                    className="rounded-lg bg-lime-600 px-10 py-1 
                    text-gray-100 cursor-pointer hover:bg-line-800
                    mt-10"
                    onClick={handleClickRegister}
                >
                    Registrar
                </button>
            </div>
            <AssignTeacheTable register={ register } />

            { showModal && <Modal heightC = {heightC} widthC = { widthC } children = {children} />}
            
        </div>
    );
}


export { AssignTeacher };
