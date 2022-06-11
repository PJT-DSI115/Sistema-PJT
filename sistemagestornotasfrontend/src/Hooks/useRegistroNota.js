import { useState, useEffect, useContext } from "react";
import Context from "Context/UserContext";
import { useParams } from "react-router-dom";
import { getAllLineasActividadFromCurso } from "Service/CargaAcademicaService";
import { registrarNota } from "Service/RegistroNotaService";

function useRegistroNota() {
  const { jwt } = useContext(Context);
  const { idCargaAcademica } = useParams();
  const [lineasActividad, setLineasActividad] = useState([]);
  const [loading, setLoading] = useState(null);
  const [errorPermission, setErrorPermission] = useState(null);
  const [errorLog, setErrorLog] = useState(null);
  const [saveSucces, setSaveSuccess] = useState(null);
  const [messageLog, setMessageLog] = useState(null);

  const carga = {
    cargaAcademica: idCargaAcademica,
  };

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

  function registrerNota({ data }) {
    setLoading(true);
    setErrorPermission(false);
    setErrorLog(false);
    setSaveSuccess(false);
    registrarNota({ data, jwt })
      .then((data) => {               //Dice que acá hay un error!
        if (data.status === 401) {
          setErrorPermission(true);
          return;
        }
        if (data.status === 403 || data.status === 500) {
          setErrorLog(true);
          return;
        }
        return data.json();
      })
      .then((data) => {
        if (data.message === "Error") {
          setMessageLog(data.descripcionMessage);
          setTimeout(() => setMessageLog(null), 1500);
          return;
        }
        if (data.message === "Ok") {
          setErrorLog("");
          setErrorLog(false);
          setErrorPermission(false);
          setSaveSuccess(true);
          return;
        }
      });
  }

  return {
    lineasActividad,
    registrerNota,
    loading,
    errorPermission,
    errorLog,
    messageLog,
  };
}

export { useRegistroNota };
