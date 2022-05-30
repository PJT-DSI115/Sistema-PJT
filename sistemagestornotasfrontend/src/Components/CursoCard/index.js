import { useState, useEffect } from "react";
import { useNivel } from "Hooks/useNiveles";
import CursoList from "./CursoList";

function CursosNivel() {

    const { nivel, loading } = useNivel();
    const [idNivel, setIdNivel] = useState(0);

  function llenarSelect() {
    return (
      <select 
        className="Niveles-select"
        onChange={handleChange}
        >
          <option value="0"></option>
        {nivel.map((nl) => (
          <option key={nl.id} value={nl.id}>
            {nl.nombre_nivel}
          </option>
        ))}
      </select>
    );
  }

  function handleChange(e){
    setIdNivel(e.target.value);
    //console.log(e.target.value)
  }
  

  return (
  
    <div className="Curso-Nivel">
        {llenarSelect()}
        {idNivel>0?<CursoList id={idNivel}/>:""}
    </div>
  
  );
}

export { CursosNivel };
