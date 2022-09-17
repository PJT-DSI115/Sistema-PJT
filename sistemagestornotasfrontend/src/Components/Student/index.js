import { useEffect, useState, useContext } from "react";
import { getAllStudent } from 'Service/StudentService';
import Context from "Context/UserContext";
import { StudentTable } from './StudentTable';

function Student() {

    const { jwt } = useContext(Context);
    const [students, setStudents] = useState([]);

    useEffect(() => {
        getStudents();
    },[])

    const getStudents = () => {
        getAllStudent({jwt}).then(response => response.json())
        .then(data => {
            console.log(data);
            setStudents(data)

        });

    }


    return (
        <div className="main">
            <h1 className="text-lg font-bold mt-10 user__title">
                Estudiantes
            </h1>
            <div className = "buttonRegisterContainer mt-5">
                <button
                    className="Actividad-btn rounded-lg lg-lime-600 px-10 py-1 text-gray-100 cursor-pointer hover:bg-line-800 mt-10"
                >
                    Registrar Estudiante
                </button>
            </div>
            {
                <StudentTable students={students} />
            }
        </div>
    )

}


export {
    Student
}