import { ENDPOINT } from 'Config/EndPoint';

function getAllPeriod({ jwt }) {
    return (
        fetch(`${ENDPOINT}/periodos/index`, {
            method: 'GET',
            headers: {
                'Authorization': jwt ? `Bearer ${jwt}` : ""
            }
        })
        .then(response => {
            console.log(response);
            return response.json();
        })
        .then(data => {
            return data;
        })
    );
}

const storeOnePeriod = ({ data , jwt}) => {

    return (
        fetch(`${ENDPOINT}/periodos/store`, {
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

export { getAllPeriod, storeOnePeriod }; 