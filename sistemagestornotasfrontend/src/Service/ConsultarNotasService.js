import { ENDPOINT } from "Config/EndPoint";

const consultarNotasCursoNivelMesPeriodo = ({ jwt, dataParams, id_mes }) => {
    return(
        fetch(`${ENDPOINT}/consultaNotas/${dataParams.idPeriodo}/${dataParams.idCursoNivel}/${id_mes}`, {
            method: 'GET',
            headers: {
                'Authorization': jwt ? `Bearer ${jwt}` : ""
            }
        })
        .then(response => response.json())
        .then(data => data)
    );
}

export { consultarNotasCursoNivelMesPeriodo }