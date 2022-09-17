import { ENDPOINT } from 'Config/EndPoint';

const getAllStudent = ({ jwt }) => {
    return (
        fetch(`${ENDPOINT}/alumno`, {
            method: 'GET',
            headers: {
                'Authorization': jwt ? `Bearer ${jwt}` : '',
            }
        }).then(response => response)
    )
}

const getStudentById = ({ jwt, id }) => {
    return (
        fetch(`${ENDPOINT}/alumno/${id}`, {
            method: 'GET',
            headers: {
                'Authorization': jwt ? `Bearer ${jwt}` : '',
            }
        }).then(response => response)
    )
}

const updateStudent = ({ jwt, student }) => {
    return (
        fetch(`${ENDPOINT}/alumno/${student.id}`, {
            method: "PUT",
            headers: {
                'Authorization': jwt ? `Bearer ${jwt}` : '',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(student)
        })
        .then(response => response)
    )

}

export {
    getAllStudent,
    getStudentById,
    updateStudent
}