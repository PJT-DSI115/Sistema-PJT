import { useState } from "react";
import { useNivel } from "Hooks/useNiveles";
import CursoList from "./CursoList";
import { ListNivel } from 'Components/CursoCard/ListNivel'
import { useCursoNivel } from 'Hooks/useCursoNivel';
import "./css/index.css";

function CursosNivel() {

    const { niveles, loading } = useNivel();
    const {cursoNivel, getCursosNivel} = useCursoNivel();
    const [idNivel, setIdNivel] = useState(0);

    async function handleChange(e){
        setIdNivel(e.target.value);
        getCursosNivel({id: e.target.value});
    }
  

  return (
  
    <div className="Curso-Nivel">
        <div className="Nivel-List_container"><ListNivel handleChange={ handleChange } nivel = {niveles} /></div>
        <div className="Curso-List_container">{idNivel > 0?<CursoList cursoNivel = { cursoNivel  }/>:""}</div>
    </div>
  
  );
}

export { CursosNivel };
