import { useState, useContext, useEffect } from "react";
import { useParams, useNavigate } from 'react-router-dom';
import { AlumnoCTable } from "Components/Student/AlumnoCategoriaTable";
import Context from 'Context/UserContext';
import {
    getAlumnoCategoria,
  } from "Service/StudentService";
function AlumnoCate()
{   
    const[alumnosCa,setAlumnosCa] = useState([]);
    const { jwt } = useContext(Context);
    const [success, setSuccess] = useState(false);

    useEffect(() => {
        getAlumnosCa();
    },[]);

    //Función Obtener.
  const getAlumnosCa = () => {
    setSuccess(false);
    getAlumnoCategoria({ jwt })
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        setAlumnosCa(data);
      });
  };
    return(

        <AlumnoCTable alumnosCategorias={alumnosCa}/>
    )
    
}

export {AlumnoCate}