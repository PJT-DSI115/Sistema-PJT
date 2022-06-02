import React, { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import { Formulario } from "./Formulario";
import { useActividad } from "Hooks/useActividad";
import Modal from "../Modal";

const Actividad = () => {
  const navigate = useNavigate();

  const [showModal, setShowModal] = useState(false);
  const [childrenModal, setChildrenModal] = useState(null);
  const [heightC, setHeigtC] = useState("");
  const [widthC, setWidthC] = useState("");

  const {
    actividad,
    getActivities,
    storeActivity,
    errorPermission,
    loading,
    setLoading,
    errorSave,
    setErrorSave,
    saveSuccess,
  } = useActividad();

  useEffect(() => {
    if (errorPermission) {
      navigate("/error403");
    }
  }, [errorPermission, navigate]);

  const handlePost = () => {
    setHeigtC("350px");
    setWidthC("580px");
    setChildrenModal(
      <Formulario
        onClose={onClose}
        onStore={storeActivity}
        errorSave={errorSave}
        saveSuccess={saveSuccess}
        loading={setLoading}
      />
    );
    setShowModal(true);
  };

  const onClose = () => {
    setShowModal(false);
    setErrorSave(false);
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
      </div>
    </div>
  );
};

export { Actividad };
