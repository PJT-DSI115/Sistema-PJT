import { useState, useEffect } from "react";
import { useNivel } from "Hooks/useNiveles";
import CursoList from "./CursoList";
import { ListNivel } from 'Components/CursoCard/ListNivel'
import { useCursoNivel } from 'Hooks/useCursoNivel';

function CursosNivel() {

    const { nivel, loading } = useNivel();
    const {cursoNivel, getCursosNivel} = useCursoNivel();
    const [idNivel, setIdNivel] = useState(0);



    async function handleChange(e){
        setIdNivel(e.target.value);
        getCursosNivel({id: e.target.value});
    }
  

  return (
  
    <div className="Curso-Nivel">
        <ListNivel handleChange={ handleChange } nivel = {nivel} />
        {idNivel > 0?<CursoList cursoNivel = { cursoNivel  }/>:""}
    </div>
  
  );
}

export { CursosNivel };
