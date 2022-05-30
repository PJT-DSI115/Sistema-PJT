import { ENDPOINT } from "Config/EndPoint";

const getAllNivels = ({jwt}) =>{
    return(
        fetch(`${ENDPOINT}/nivels/index`, {
            method: 'GET',
            headers:{
                'Authorization': jwt ? `Bearer ${jwt}` : ""
            }
        })
        .then(response => {
            return response.json();
        })
        .then(data => {
            return data;
        })
    );
}

export {getAllNivels};