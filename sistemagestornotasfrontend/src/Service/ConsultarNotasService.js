import { ENDPOINT } from "Config/EndPoint";

const consultarRendimientoAcademicoService = ({ jwt, dataParams, id_mes }) => {
    return(
        fetch(`${ENDPOINT}/consultaRendimiento/${dataParams.idPeriodo}/${dataParams.idCursoNivel}/${id_mes}`, {
            method: 'GET',
            headers: {
                'Authorization': jwt ? `Bearer ${jwt}` : ""
            }
        })
        .then(response => response.json())
        .then(data => data)
    );
}

const consultarNominaNotasService = ({ jwt, dataParams, id_mes }) => {
    return(
        fetch(`${ENDPOINT}/consultaNomina/${dataParams.idPeriodo}/${dataParams.idCursoNivel}/${id_mes}`, {
            method: 'GET',
            headers: {
                'Authorization': jwt ? `Bearer ${jwt}` : ""
            }
        })
        .then(response => response.json())
        .then(data => data)
    );
}

export { consultarRendimientoAcademicoService, consultarNominaNotasService }