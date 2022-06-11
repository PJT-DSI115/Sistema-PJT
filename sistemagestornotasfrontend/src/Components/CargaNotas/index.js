import React, {useState} from "react";
import { useRegistroNota } from "Hooks/useRegistroNota";
import { useCursoNivelMes } from "Hooks/useCursoNivelMes";
import { Loader } from "Components/Loader";
import { LineasActividadList } from "./LineasActividadList";
import { Formulario } from "./Formulario";
import Modal from "../Modal";
import "./index.css";

function CargaNotas() {
  const { lineasActividad, registrerNota, loading, errorPermission, errorLog, messageLog } =
    useRegistroNota();

  const { meses, load, errorPer, errorL, idCargaAcademica } =
    useCursoNivelMes();

  const [showModal, setShowModal] = useState(false);
  const [heightC, setHeigtC] = useState("");
  const [widthC, setWidthC] = useState("");
  const [idLinea, setIdLinea] = useState(0);

  const handlePost = (id) => {
    setHeigtC("350px");
    setWidthC("580px");
    setShowModal(true);
    setIdLinea(id)
  };

  const handleRegister = d =>{
    console.log(d);
    registrerNota({data: d});
  }

  const onClose = () =>{
    setShowModal(false);
  }

  if (loading || load) {
    return <Loader />;
  }

  return (
    <div className="Carga-notas-container">
      {
          showModal?(
            <Modal
              heightC={heightC}
              widthC={widthC}
            >
              <Formulario
                meses={meses}
                idCargaAcademica={idCargaAcademica}
                idLinea={idLinea} 
                onClose={onClose}
                onStore={handleRegister}
                messageLog={messageLog}
                loading={loading}
              />
            </Modal>
          ):""
      }
      <LineasActividadList 
        lineasActividad={lineasActividad} 
        handlePost={handlePost}
      />
    </div>
  );
}

export { CargaNotas };
