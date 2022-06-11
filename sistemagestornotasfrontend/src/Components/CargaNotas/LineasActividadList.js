import React from "react";

function LineasActividadList({ lineasActividad }) {
  
    function handleClickRegister()

  return (
    <div className="Carga-listActividad-table">
      {lineasActividad.map((linea, index) => (
        <div key={index}>
          <h4 className="ListActividad-title">{linea.nombre_actividad}</h4>
          <div className="Carga-listActividad-table-head">
            <h4 className="Carga-listActividad-h">Nombre</h4>
            <h4 className="Carga-listActividad-h">Nota</h4>
            <h4 className="Carga-listActividad-h">Opciones</h4>
          </div>
          <div className="ListActividad-table">
            <div>
              {linea.lineaActividad.map((lineas, index) => (
                <div className="ListActividad-table-name" key={index}>
                  <div className="ListActividad-table-lname">
                    {lineas.nombre_linea_actividad}
                  </div>
                  <div className="ListActividad-table-nota">
                    {lineas.registroNotas.length > 0
                      ? lineas.registroNotas[0].nota
                      : "-"}
                  </div>
                  <div className="ListActividad-table-options">
                    {!lineas.registroNotas.length > 0 ? (
                      <button className="ListActividad-table-btn list-btn-reg" value={lineas.id}>
                        Registrar
                      </button>
                    ) : (
                      ""
                    )}
                    <button className="ListActividad-table-btn list-btn-edit" value={lineas.id}>Editar</button>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </div>
      ))}
    </div>
  );
}

export { LineasActividadList };
