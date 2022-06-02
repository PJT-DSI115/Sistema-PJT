import { ENDPOINT } from "Config/EndPoint";

const getAllActividad = ({jwt}) =>{
    return (
        fetch(`${ENDPOINT}/actividad`, {
            method: 'GET',
            headers: {
                'Authorization': jwt ? `Bearer ${jwt}` : ""
            }
        })
        .then(response => response.json())
        .then(data => data)
    );
}

const storeActividad = ({data, jwt}) =>{
    return (
        fetch(`${ENDPOINT}/actividad`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${jwt}`
            },
            body: JSON.stringify(data)
        })
        .then(response => response)
    );
}

const updateActividad = ({data, jwt}) =>{
    return (
        fetch(`${ENDPOINT}/actividad/${data.id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${jwt}`
            },
            body: JSON.stringify(data)
        })
        .then(response => response)
    );
}

const deleteActividad = ({id, jwt}) => {
    return(
        fetch(`${ENDPOINT}/actividad/${id}`, {
            method: 'DELETE',
            headers: {
                'Authorization': `Bearer ${jwt}`
            }
        })
        .then(response => response)
    );
}

export {getAllActividad, storeActividad, updateActividad, deleteActividad};