import { useEffect, useState, useContext } from "react";
import { getAllStudent } from 'Service/StudentService';
import Context from "Context/UserContext";

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
        <div>
            <h1>Estudiantes</h1>

        </div>
    )

}


export {
    Student
}