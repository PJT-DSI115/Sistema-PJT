/**
 * @author JS Martinez
 */
import { ENDPOINT } from 'Config/EndPoint';

function getAllDocentes({ jwt }) {
    return (
        fetch(`${ENDPOINT}/docente/getAll`, {
            method: 'GET',
            headers: {
                'Authorization': jwt ? `Bearer ${jwt}` : ""
            }
        })
        .then(response => response)
    );
}

export { getAllDocentes };