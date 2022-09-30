import { useEffect, useState, useContext } from "react";
import { getAllStudent, deleteStudent, insertStudents } from 'Service/StudentService';
import Context from "Context/UserContext";
import { StudentTable } from './StudentTable';
import Modal from "Components/Modal";
import { AlertMessage } from "Components/AlertMessage/alertMessage";
import { FormRegister } from './FormRegister';


function Student() {

    const { jwt } = useContext(Context);
    const [students, setStudents] = useState([]);
    const [showModal, setShowModal] = useState(false);
    const [heightC, setHeigtC] = useState("");
    const [widthC, setWidthC] = useState("");
    const [children, setChildren] = useState(null);
    const [success, setSuccess] = useState(false);

    useEffect(() => {
        getStudents();
    },[success])

    const getStudents = () => {
        setSuccess(false);
        getAllStudent({jwt}).then(response => response.json())
        .then(data => {
            setStudents(data)

        });

    }

    const onClose = () => {
        setShowModal(false);
    }

    const showRegisterModal = () => {
        setHeigtC("200px");
        setWidthC("400px");
        setChildren(
            <FormRegister 
                onClose={onClose}
                handleInsert = { insertStudentsHandle }
            />
        )
        setShowModal(true);
    }

    const insertStudentsHandle = ({data}) => {
        insertStudents({jwt, data})
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if(data.codeError === 0) {

            setSuccess(true);
            onClose();

            }
        });
    }

    const showModalDetele = ({id}) => {
        setHeigtC("250px");
        setWidthC("600px");
        const dataUpdate =  {
            id: id
        }

        setChildren(
            <AlertMessage 
                dataUpdate={dataUpdate}
                onClose = {onClose}
                title  = "Eliminar  Alumno"
                descripction={"¿Esta seguro que desea eliminar al alumno?"}
                onEvent = { deleteStudentHandle }
            />
        )

        setShowModal(true);
    }

    const deleteStudentHandle = ({data: dataUpdate}) => {
        deleteStudent({jwt, id: dataUpdate.id})
        .then(response => response.json())
        .then(data => {
            if(data.codeError === 0) {
                setSuccess(true);
                setShowModal(false);
            }

        })
    }



    return (
        <div className="main">
            <h1 className="text-lg font-bold mt-10 user__title">
                Estudiantes
            </h1>
            <div className = "buttonRegisterContainer mt-5">
                <button
                    onClick={showRegisterModal}
                    className="Actividad-btn rounded-lg lg-lime-600 px-10 py-1 text-gray-100 cursor-pointer hover:bg-line-800 mt-10"
                >
                    Registrar Estudiante
                </button>
            </div>
            {
                <StudentTable 
                    students={students} 
                    handleDelete = { showModalDetele }
                />
            }
            {
                showModal ?
                <Modal
                    heightC = { heightC }
                    widthC = { widthC }
                >
                    {
                        children
                    }
                </Modal>
                : ''
            }
        </div>
    )

}


export {
    Student
}