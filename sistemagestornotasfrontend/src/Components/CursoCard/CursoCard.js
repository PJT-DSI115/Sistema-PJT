import React from "react";
import "./CursoCard.css";
import { Link } from "react-router-dom";

function CursoCard({nombre, nivel}) {
  return (
    <Link to="#">
      <div className="Card">
        <div className="Card-title">{nombre}</div>
        <div className="Card-description">{nivel}</div>
      </div>
    </Link>
  );
}

export { CursoCard };
