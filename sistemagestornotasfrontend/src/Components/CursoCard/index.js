import React from "react";
import "./index.css";
import { Link } from "react-router-dom";

function CursoCard() {
  return (
    <Link to="#">
      <div className="Card">
        <div className="Card-title">MATEMATICA - MAT</div>
        <div className="Card-description">NIVEL 1</div>
      </div>
    </Link>
  );
}

export { CursoCard };
