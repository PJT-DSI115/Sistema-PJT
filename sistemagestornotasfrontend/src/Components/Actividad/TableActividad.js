import React from "react";
import "./css/TableActividad.css";

const TablaActividad = ({ actividades, handleClickDelete, handleClickUpdate }) => {
  const handleClickTable = (e) => {
    if (e.target.getAttribute("op") === "edit") {
      handleClickUpdate(e.target.getAttribute("index"));
    }
    if (e.target.getAttribute("op") === "close") {
      handleClickDelete(e.target.getAttribute("index"));
    }
  };

  return (
    <table
      className="table-custom text-sm text-left text-gray-500 dark:text-gray-400"
      onClick={handleClickTable}
    >
      <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr className="Actividad-t-tr">
          <th scope="col" className="px-6 py-3">
            Codigo
          </th>
          <th scope="col" className="px-6 py-3">
            Nombre
          </th>
          <th scope="col" className="px-6 py-3">
            Porcentaje
          </th>
          <th scope="col" className="px-6 py-3">
            Cantidad actividades
          </th>
          <th scope="col" className="px-6 py-3">
            Opciones
          </th>
        </tr>
      </thead>
      <tbody className="Actividad-t-tbody">
        {actividades
          ? actividades.map((actividad) => (
              <tr
                className="bg-white border-b dark:bg-gray-800 dark:border-gray-700 py-10"
                key={actividad.id}
              >
                <th
                  scope="row"
                  className="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                >
                  {actividad.codigo_actividad}
                </th>
                <td className="px-6 py-4">{actividad.nombre_actividad}</td>
                <td className="px-6 py-4">{parseInt(actividad.porcentaje_actividad)} %</td>
                <td className="px-6 py-4">{actividad.numero_actividades}</td>
                <td className="px-6 py-4 td-grid">
                  <button
                    op="edit"
                    index={actividad.index}
                    className="formCustom__button mx-2"
                  >
                    Editar
                  </button>
                  <button
                    index={actividad.index}
                    op="close"
                    className="formCustom__button formCustom__button--red"
                  >
                    Eliminar
                  </button>
                </td>
              </tr>
            ))
          : "No hay actividades"}
      </tbody>
    </table>
  );
};

export { TablaActividad };
