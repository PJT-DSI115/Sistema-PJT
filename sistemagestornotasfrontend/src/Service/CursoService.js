import { ENDPOINT } from "Config/EndPoint";

//Todas las funciones para las peticiones al backend


function getAllCursos({ jwt }) {
    return(
        fetch(`${ENDPOINT}/curso/index`, {
            method: 'GET',
            headers: {
                'Authorization': jwt ? `Bearer ${jwt}`: ""
            }
        })
        .then(response =>  response)
    );
}

export { getAllCursos };
