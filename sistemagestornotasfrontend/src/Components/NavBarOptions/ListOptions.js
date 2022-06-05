import React from "react";
import { Link } from "react-router-dom";

function ListOptions() {
  const values = [
    {
      id: 1,
      nombre: "Actividad",
      ruta: "/actividad",
    },
    {
      id: 2,
      nombre: "Periodo",
      ruta: "/periodo",
    },
    {
      id: 3,
      nombre: "Ruta 3",
      ruta: "/card",
    },
  ];

  return values.map((rut) => (
    <Link to={rut.ruta} key={rut.id} className="NavBar-item-content">
      <div className="NavBar-icon"></div>
      <li className="NavBar-item">{rut.nombre}</li>
    </Link>
  ));
}

export { ListOptions };
