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

export {
    getAllStudent,
    getStudentById
}