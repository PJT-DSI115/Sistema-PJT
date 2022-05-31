import React from "react";
import { Link } from "react-router-dom";

function ListOptions () {

    const values = [
        {
            nombre: "Card",
            ruta: "/card"
        },
        {
            nombre: "Periodo",
            ruta: "/periodo"
        },
        {
            nombre: "Ruta 3",
            ruta: "/card"
        }
    ]

    return(
        values.map(rut =>(
            <Link to={rut.ruta}>
                <li className="NavBar-item">{rut.nombre}</li>
            </Link>
        ))
    );
}

export {ListOptions};