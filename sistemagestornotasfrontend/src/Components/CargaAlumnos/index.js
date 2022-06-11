import React from "react";
import { useCargaAcademica } from "Hooks/useCargaAcademica";
import { Loader } from "Components/Loader";
import { AlumnosTable } from "./AlumnosTable";

function CargaAlumnos() {
  const { listaAlumnos, loading, errorLog, errorPermission } =
    useCargaAcademica();

  if (loading) {
    return <Loader />;
  }

  return (
    <div className="Carga-alumnos-container">
      {listaAlumnos != [] ? (
          <AlumnosTable listaAlumnos={listaAlumnos} />
      ) : ""}
    </div>
  );
}

export { CargaAlumnos };
