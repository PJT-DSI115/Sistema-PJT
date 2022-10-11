import { useState, useContext } from "react";
import {
  consultarNotasCursoNivelMesPeriodo
} from "../Service/ConsultarNotasService";
import Context from "Context/UserContext";
import { useParams } from "react-router-dom";

function useConsultarNotas() {
  const { jwt } = useContext(Context);
  const [datos, setDatos] = useState({});
  const [loading, setLoading] = useState(null);
  const [error, setError] = useState(null);
  const {idPeriodo, idCursoNivel} = useParams();

  const dataParams = {
    idPeriodo: idPeriodo,
    idCursoNivel: idCursoNivel
  }

  //Select
  const consultarNotas = ({id_mes}) => {
    setLoading(true);
    consultarNotasCursoNivelMesPeriodo({jwt, dataParams, id_mes})
    .then(res => {
        setDatos(res);
        setLoading(false);
        setError(false);
    })
  };

  return {
    consultarNotas,
    datos,
    loading,
    error
  };

}

export { useConsultarNotas };