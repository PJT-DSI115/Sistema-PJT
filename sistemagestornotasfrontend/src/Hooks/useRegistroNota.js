import { useState, useEffect, useContext } from "react";
import Context from "Context/UserContext";
import { useParams } from "react-router-dom";
import { getAllLineasActividadFromCurso } from "Service/CargaAcademicaService";

function useRegistroNota() {
  
    const {jwt} = useContext(Context);
    const {idCargaAcademica} = useParams();
    const [lineasActividad, setLineasActividad] = useState([]);
    const [loading, setLoading] = useState(null);
    const [errorPermission, setErrorPermission] = useState(null);
    const [errorLog, setErrorLog] = useState(null);

    const carga = {
        cargaAcademica: idCargaAcademica
    }

  useEffect(() => {
    getAllLineasActividadFromCurso({ data: carga, jwt }).then((data) => {
      if (data.status) {
        if (data.status === 401) {
          setErrorPermission(true);
          return;
        }
        if (data.status === 500) {
          setErrorLog(true);
          return;
        }
      } else {
        setLoading(false);
        setErrorLog(false);
        setErrorPermission(false);
        data.forEach((da, index) => (da.index = index));
        setLineasActividad(data);
      }
    });
  }, [jwt]);

  return {
    lineasActividad,
    loading,
    errorPermission,
    errorLog
  }
}

export {useRegistroNota}
