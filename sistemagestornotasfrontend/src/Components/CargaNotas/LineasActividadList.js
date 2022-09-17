import { Loader } from "Components/Loader";
import React from "react";

function LineasActividadList({ data, handlePost }) {
  function handleClickRegister(e) {
    handlePost(e.target.value);
  }

  function mostrarNotas(notas, mes){
    if(notas.length === 0){ 
      return (
      <>
        <div>-</div>
        <div>-</div>
        <div>-</div>
        <div>-</div>
        <div>-</div>
        <div>-</div>
      </>
      )
    }

    if(notas.leng  === 6) {
      return (
        <>
          <div>{notas[0].nota}</div>
          <div>{notas[1].nota}</div>
          <div>{notas[2].nota}</div>
          <div>{notas[3].nota}</div>
          <div>{notas[4].nota}</div>
          <div>{notas[5].nota}</div>
        </>
      )
    }
    /**
     * {
     *  id
     * nota
     * id_mes
     * codigo_mes
     * }
     */

    if(notas.length > 0 && notas.length < 6) {
      let numbersMesId = [];
      notas.forEach(nota => {
        numbersMesId.push(nota.id_mes);
      });
    }
  }
  
  return (
    <div className="Carga-listActividad-table">
      {data.actividades.map((actividad, index) => (
        <div key={index}>
          <h4 className="ListActividad-title">{actividad.nombre_actividad}</h4>
          <div className="Carga-listActividad-table-head">
            <h4 className="Carga-listActividad-h">Nombre</h4>
            {
              data.meses.map((mes, index) => (
                <h4 key={mes.id} className="Carga-listActividad-h">
                  {mes.codigo_mes}
                </h4>
              ))
            }
            <h4 className="Carga-listActividad-h">Promedio</h4>
            <h4 className="Carga-listActividad-h">Opciones</h4>
          </div>
          <div className="ListActividad-table">
            {actividad.lineaActividad.map((linea, index1) => (
              <div className="ListActividad-table-name" key={index1}>
                <div>
                  {linea.nombre_linea_actividad}
                </div>
                {mostrarNotas(linea.registro_notas, data.meses)}
                <div>{linea.promedio_nota}</div>
                <div>...</div>
              </div>
            ))}
          </div>
        </div>
      ))}
    </div>
  );
}

export { LineasActividadList };
