import { ENDPOINT } from "Config/EndPoint";

function getAllAlumnosFromCarga({ data, jwt }) {
    return (
        fetch(`${ENDPOINT}/cargaAcademica/${data.id_periodo}/${data.id_curso_nivel}`, {
            method: "GET",
            headers: {
              Authorization: jwt ? `Bearer ${jwt}` : "",
            }
          })
          .then(response => response.json())
          .then(data => data)
    );
}

function getAllLineasActividadFromCurso({data, jwt}){
  return(
    fetch(`${ENDPOINT}/cargaAcademica/lineasActividad/${data.cargaAcademica}`, {
      method: "GET",
      headers:{
        Authorization: jwt ? `Bearer ${jwt}` : "",
      }
    })
    .then(response => response.json())
    .then(data => data)
  )
}

export {getAllAlumnosFromCarga, getAllLineasActividadFromCurso}