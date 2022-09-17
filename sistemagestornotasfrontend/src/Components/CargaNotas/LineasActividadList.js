import { Loader } from "Components/Loader";
import React from "react";

function LineasActividadList({ data, handlePost }) {
  function handleClickRegister(e) {
    handlePost(e.target.value);
  }

  function mostrarNotas(){

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
              <div className="ListActividad-table-name">
                <div>
                  {linea.nombre_linea_actividad}
                </div>
                <>
                  
                </>
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
