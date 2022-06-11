import React from "react";
import { useRegistroNota } from "Hooks/useRegistroNota";
import { Loader } from "Components/Loader";
import { LineasActividadList } from "./LineasActividadList";
import './index.css';

function CargaNotas() {
  const { lineasActividad, loading, errorPermission, errorLog } =
    useRegistroNota();

    if(loading){
        return <Loader/>;
    }

  return (
    <div className="Carga-notas-container">
        <LineasActividadList lineasActividad={lineasActividad}/>
    </div>
  );
}

export { CargaNotas };
