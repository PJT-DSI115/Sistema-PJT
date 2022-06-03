import React, { useState, useEffect } from "react";
import { actividadData } from "Service/actividadData";
import './css/Formulario.css';

const Formulario = ({
  onClose,
  onStore,
  errorResponse,
  errorDescription,
  loading,
  setLoading,
  dataUpdate
}) => {
  const [dataForm, setDataFrom] = useState(() => {
    return dataUpdate
      ? {
          nombre_actividad: dataUpdate.nombre_actividad,
          codigo_actividad: dataUpdate.codigo_actividad,
          porcentaje_actividad: dataUpdate.porcentaje_actividad,
          id_curso_nivel: dataUpdate.id_curso_nivel,
          id_periodo: dataUpdate.id_periodo,
          numero_actividades: "",
        }
      : {
          nombre_actividad: "",
          codigo_actividad: "",
          porcentaje_actividad: "",
          id_curso_nivel: "1",
          id_periodo: "1",
          numero_actividades: "",
        };
  });

  const handleChange = (e) => {
    setDataFrom({
      ...dataForm,
      [e.target.name]: e.target.value,
    });
  };

  const handleSelect = (e) => {
    if (e.target.value === "") {
        return;
    } else {
      setDataFrom({
        ...dataForm,
        nombre_actividad: actividadData[e.target.value].nombre,
        codigo_actividad: actividadData[e.target.value].codigo,
      });
    }
  };


  const handleSubmit = () => {
    onStore({data:dataForm})
    console.log(errorResponse);
    console.log(errorDescription)
    if(errorResponse){
      console.log(errorResponse)
      //onClose();
    }
  };

  const setData = () => {
    return actividadData.map((data, index) => (
      <option key={data.id} value={index}>
        {data.nombre}
      </option>
    ));
  };

  const handleKeyUp = e =>{
      const code = (e.charCode) ? e.charCode : e.keyCode;
      if((code >= 48 && code <= 57 ) || code === 8){
          return
      }
      else {
        e.preventDefault();
        return
      }
  }

  return (
    <div className="Actividad-form-container">
      <h1 className="Actividad-form-title">Registro de actividad</h1>
      <form className="Form-actividad">
        <div className="form-group">
          <select
            name="nombre_actividad"
            className="form-input"
            onChange={handleSelect}
          >
            <option value={""}>Seleccione un tipo</option>
            {setData()}
          </select>
        </div>
        <div className="form-group">
          <input
            type="text"
            name="porcentaje_actividad"
            className="form-input"
            placeholder="Porcentaje general"
            value={dataForm.porcentaje_actividad}
            onChange={handleChange}
            onKeyDown={handleKeyUp}
          />
        </div>
        <div className="form-group">
          <input
            type="text"
            name="numero_actividades"
            className="form-input"
            placeholder="Número de actividades"
            value={dataForm.numero_actividades}
            onChange={handleChange}
            onKeyDown={handleKeyUp}
          />
        </div>
        <div>{<p className="formCustom__error">{errorDescription}</p>}</div>
        <div className="form-group btns">
          <button
            type="button"
            className="btn-form btn-sub"
            onClick={handleSubmit}
          >
            Guardar
          </button>
          <button type="button" className="btn-form btn-can" onClick={onClose}>
            Cancelar
          </button>
        </div>
      </form>
    </div>
  );
};

export { Formulario };
