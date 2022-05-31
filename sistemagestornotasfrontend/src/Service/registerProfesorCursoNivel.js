import { ENDPOINT } from 'Config/EndPoint';

function getAllRegisterByNivelCursoAndPeriodo({ idPeriodo, idCursoNivel, jwt }) {
    return (
        fetch(`${ENDPOINT}/registroDocenteCurso/showRegister?idNivelCurso=${idCursoNivel}&idPeriodo=${idPeriodo}`, {
            method: 'GET',
            headers: {
                'Authorization': jwt ? `Bearer ${jwt}` : ""
            }
        })
        .then(response => response)
    );
}

function storeRegister({ data, jwt }) {
    return (
        fetch(`${ENDPOINT}/api/registroDocenteCurso/storeRegister`, {
            method: 'POST',
            headers: {
                'Authorization': jwt ? `Bearer ${jwt}` : "",
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response)
    )
}

export { getAllRegisterByNivelCursoAndPeriodo, storeRegister };
