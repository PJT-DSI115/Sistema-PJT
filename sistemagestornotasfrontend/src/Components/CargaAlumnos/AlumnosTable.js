import React from "react";
import { Link } from "react-router-dom";

function AlumnosTable({ listaAlumnos }) {
    
  return (
    <table className="table-custom text-sm text-left text-gray-500 dark:text-gray-400">
      <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" className="px-6 py-3">
            Código
          </th>
          <th scope="col" className="px-6 py-3">
            Nombres
          </th>
          <th scope="col" className="px-6 py-3">
            Apellidos
          </th>
          <th scope="col" className="px-6 py-3">
            Opciones
          </th>
        </tr>
      </thead>
      <tbody>
        {listaAlumnos.map((alumno) => {
          return (
            <tr
              key={alumno.id_alumno}
              className="bg-white border-b dark:bg-gray-800 dark:border-gray-700 py-10"
            >
              <td className="px-6 py-4">{alumno.alumno[0].codigo_alumno}</td>
              <td className="px-6 py-4">{alumno.alumno[0].nombre_alumno}</td>
              <td className="px-6 py-4">{alumno.alumno[0].apellido_alumno}</td>
              <td className="px-6 py-4">
                <Link to={`${alumno.id}`}>
                  Gestionar notas
                </Link>
              </td>
            </tr>
          );
        })}
      </tbody>
    </table>
  );
}

export { AlumnosTable };
