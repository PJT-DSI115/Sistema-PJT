import React from "react";

function LineasActividadList({ lineasActividad, handlePost }) {
  function handleClickRegister(e) {
    handlePost(e.target.value);
  }

  const [promedio, setPromedio] = React.useState();

  return (
    <div className="Carga-listActividad-table">
      {lineasActividad.map((linea, index) => (
        <div key={index}>
          <h4 className="ListActividad-title">{linea.nombre_actividad}</h4>
          <div className="Carga-listActividad-table-head">
            <h4 className="Carga-listActividad-h">Nombre</h4>
            {linea.cursoNivelMes.map((cursoNiv, index) => {
              return (
                <h4 key={index} className="Carga-listActividad-h">
                  {cursoNiv.meses[0].codigo_mes}
                </h4>
              );
            })}
            <h4 className="Carga-listActividad-h">Opciones</h4>
          </div>
          <div className="ListActividad-table">
            {linea.lineaActividad.map((lineas, index1) => (
              <div key={index1}>
                <div className="ListActividad-table-name">
                  <div className="ListActividad-table-lname">
                    {lineas.nombre_linea_actividad}
                  </div>
                  {linea.cursoNivelMes.map((curso, index3) => (
                    <div key={index3} className="ListActividad-table-nota">
                      {lineas.registroNotas[index3]
                        ? lineas.registroNotas[index3].nota
                        : "-"}
                    </div>
                  ))}
                  <div className="ListActividad-table-options">
                    {lineas.registroNotas.length <
                    linea.cursoNivelMes.length ? (
                      <button
                        className="ListActividad-table-btn list-btn-reg"
                        value={lineas.id}
                        onClick={handleClickRegister}
                      >
                        Registrar
                      </button>
                    ) : (
                      ""
                    )}
                    <button
                      className="ListActividad-table-btn list-btn-edit"
                      value={lineas.id}
                    >
                      Editar
                    </button>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      ))}
    </div>
  );
}

export { LineasActividadList };
