import React from "react";
import { Link } from "react-router-dom";

function ListOptions () {

    const values = [
        {
            id: 1,
            nombre: "Card",
            ruta: "/card"
        },
        {
            id: 2,
            nombre: "Periodo",
            ruta: "/periodo"
        },
        {
            id: 3,
            nombre: "Ruta 3",
            ruta: "/card"
        }
    ]

    return(
        values.map(rut =>(
            <Link to={rut.ruta} key = { rut.id }>
                <li className="NavBar-item" >{rut.nombre}</li>
            </Link>
        ))
    );
}

export {ListOptions};