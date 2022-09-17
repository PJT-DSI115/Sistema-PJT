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

export {
    getAllStudent
}