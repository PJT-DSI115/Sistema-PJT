import React from "react";

function LineasActividadList({ lineasActividad, handlePost }) {
  function handleClickRegister(e) {
    handlePost(e.target.value);
  }

  console.log(lineasActividad)
  return (
    <div className="Carga-listActividad-table">
      
    </div>
  );
}

export { LineasActividadList };
