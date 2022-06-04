import React, { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import { Formulario } from "./Formulario";
import { useActividad } from "Hooks/useActividad";
import { TablaActividad } from "./TableActividad";
import { AlertMessage } from "Components/AlertMessage/alertMessage";
import Modal from "../Modal";
import "./css/index.css";

const Actividad = () => {
  const navigate = useNavigate();

  const [showModal, setShowModal] = useState(false);
  const [childrenModal, setChildrenModal] = useState(null);
  const [heightC, setHeigtC] = useState("");
  const [widthC, setWidthC] = useState("");

  const {
    actividad,
    storeActivity,
    deleteActivity,
    error,
    errorResponse,
    errorDescription,
    loading,
    setLoading,
    updateData
  } = useActividad();

  /*useEffect(() => {
    if (error) {
      navigate("/error403");
    }
  }, [error, navigate]);*/

  const handlePost = () => {
    setHeigtC("350px");
    setWidthC("580px");
    setChildrenModal(
      <Formulario
        onClose={onClose}
        onStore={storeActivity}
        errorResponse={errorResponse}
        errorDescription={errorDescription}
        loading={loading}
        setLoading={setLoading}
      />
    );
    setShowModal(true);
  };

  const handleClickDelete = (id) => {
    setHeigtC("200px");
    setWidthC("530px");
    const dataUpdate = {
      id: actividad[id].id,
    };
    setChildrenModal(
      <AlertMessage
        title="Eliminar actividad"
        descripction="¿Desea eliminar la actividad?"
        onClose={onClose}
        onEvent={deleteActivity}
        dataUpdate={dataUpdate}
      />
    );
    setShowModal(true);
  };

  /*const handleClickUpdate = (id) =>{
    setHeigtC("200px");
    setWidthC("530px");
    const dataUpdate = {
      id: actividad[id].id,
      nombre_actividad: actividad[id].nombre_actividad,
      codigo_actividad: actividad[id].codigo_actividad,
      porcentaje_actividad: actividad[id].porcentaje_actividad,
      id_curso_nivel: actividad[id].id_curso_nivel,
      id_periodo: actividad[id].id_periodo,
      numero_actividades: actividad[id].numero_actividades
    };
    <Formulario
        onClose={onClose}
        onStore={}
        errorResponse={errorResponse}
        errorDescription={errorDescription}
        loading={loading}
        setLoading={setLoading}
      />
  }*/

  const onClose = () => {
    setShowModal(false);
  };

  return (
    <div className="Actividad-container">
      {showModal ? (
        <Modal heightC={heightC} widthC={widthC}>
          {childrenModal}
        </Modal>
      ) : (
        ""
      )}
      <h1 className="Actividad-title">Gestión de Actividades</h1>
      <div className="Actividad-grid">
        <button className="Actividad-btn" onClick={handlePost}>
          Registrar nueva actividad
        </button>
        <TablaActividad
          actividades={actividad}
          handleClickDelete={handleClickDelete}
        />
      </div>
    </div>
  );
};

export { Actividad };
