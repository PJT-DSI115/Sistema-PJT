/**
 * @author RO Andrés
 */
 import { useState, useEffect, useContext } from 'react';
 import { useParams } from 'react-router-dom';
 import { useNavigate } from 'react-router-dom';
 
 import Context from 'Context/UserContext';
 import ContextPeriodo from 'Context/PeriodoContext';//Preguntar
 import { AsignarCursoTable } from './AsignarCursoAlumnoTable';
 import { FormularioAsignarCurso } from './FormularioAsignarCurso';
 import { AlertMessage } from 'Components/AlertMessage/alertMessage';
 import  Modal  from 'Components/Modal';
 import { getAsignarCursoAlumno,storeAsignarCursoAlumno,updateAsignarCursoAlumno,deleteAsignarCursoAlumno
 } from 'Service/CargaAcademicaService';
 import { Loader } from 'Components/Loader';
 
 
 function AsignarCursoAlumno() {
     const  { idPeriodo, idCursoNivel,idAlumno }  = useParams();
 
     const navigate = useNavigate();
     const [showModal, setShowModal] = useState(false);
     const [register, setRegister] = useState([]);
     const { jwt } = useContext(Context);
     const { periodo } = useContext(ContextPeriodo);
     const [errorLogic, setErrorLogic] = useState(false);
     const [messageErrorLogic, setMessageErrorLogic] = useState("");
     const [buttonActive, setButtonActive] = useState(false);
     const [loading, setLoading] = useState(false);
     const [success, setSuccess] = useState(false);
 
     const [heightC, setHeigtC] = useState("");
     const [widthC, setWidthC] = useState("");
     const [children, setChildren] = useState("");
    
     const getData = () => {
        const data = {
            id_periodo: idPeriodo,
            id_curso_nivel: idCursoNivel,
        }
        setLoading(true);
        getAsignarCursoAlumno({ jwt, data })
            .then(response => {
                return response.json()
            })
            .then(data => {
                data.forEach((data, index) => {
                    data['index'] = index;
                    return data
                });
                setRegister(data);
                buttonActiveSet();
                setLoading(false);
                console.log(data);
            })

    }
     useEffect(() => {
         getData();
 
     },[] )
 
 
     const updateAsignarCursoAlu = ({ data }) => {
         return (updateAsignarCursoAlumno({data, jwt})
             .then(response => {
                 if( response.status === 500) {
                     setErrorLogic(true);
                     return
                 }
                 if(response.status === 401) {
                     navigate('/login');
                 }
                 if(response.status === 403) {
                     navigate('/error403');
                 }
                 return response.json();
             })
             .then(data => {
                 if(data.message === "Error") {
                     return {
                         "type" : data.message,
                         "descripcion": data.descripcionMessage
                     }
                 }
                 if(data.message === "Ok") {
                     getData();
                     onClose();
                     return {
                         "type": data.message,
                         "descripcion": data.descripcionMessage
                     };
                 }
             })
         );
         
 
     }
 
     const storeAsignarCursoAlu = ({ data }) => {
        storeAsignarCursoAlumno({ data, jwt,idPeriodo,idCursoNivel })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            if (data.codeError === 0) {
            setSuccess(true);
            onClose();
            getData();
            }
      });
         /* return (storeAsignarCursoAlumno({data, jwt})
         .then(response => response.json())
             .then(dataResponse => {
                 if(dataResponse.message === "Error") {
                     setErrorLogic(true);
                     setMessageErrorLogic(dataResponse.descripcionMessage);
                     return {
                         "type": dataResponse.message,
                         "descripcion": dataResponse.descripcionMessage
                     }
                 }
                 if(dataResponse.message === 'Ok') {
                     getData();
                     onClose();
                     return {
                         "type": data.message,
                         "descripcion": data.descripcionMessage
                     }
                 }
             })) */
     };//Fin de storeAsignarCursoAlu
 
     const deleteAsignarCursoAlu = ( { data } ) => {
         const id = data.id
         console.log("Se ejecuta");
         return (deleteAsignarCursoAlumno({ data , jwt })
         .then(response => {
             if(response.status === 401 || response.status === 403 || response.status === 500) {
                 return;
             }
             return response.json();
         })
         .then(data => {
             if(data.message === "Error") {
                 return {
                     "type": data.message,
                     "descripcion": data.descripcionMessage
                 }
             }
             if(data.message === "Ok") {
                 getData();
                 onClose();
                 return {
                     "type": data.message,
                     "descripcion": data.descripcionMessage
                 }
             }
         }));
     }
 
     const verifiedButton = () => {
         if(register.length >= 3) {
             return true;
         } else {
             return false;
         }
     }
 
     const onClose = () => {
         setShowModal(false);
     }
 
     const handleClickRegister = () => {
         setHeigtC("400px");
         setWidthC("600px");
         setChildren(
             <FormularioAsignarCurso 
                 title={ "Asignar Curso Alumno" }
                 onClose = { onClose }
                 onEvent = { storeAsignarCursoAlu }
                 />
         );
         setShowModal(true);
 
     }
 
     const handleClickDelete = (id) => {
         setHeigtC("200px");
         setWidthC("600px");
         const data = {
             id: register[id].id
         }
         setChildren(
             <AlertMessage 
                 title =  "Eliminar Curso Alumno "
                 descripction =  "Desea eliminar el alumno del curso asignado"
                 onClose={onClose}
                 onEvent = { deleteAsignarCursoAlu }
                 dataUpdate = {data}
             />
         )
         setShowModal(true);
     }
 
     const handleClickUpdate = (id) => {
         const registerTemp = register[id];
         const data = {
             idCursoNivel: registerTemp.cursoNivel.id,
             //rol: registerTemp.rol,
             id: registerTemp.id
         }
         setHeigtC("400px");
         setWidthC("600px");
         setChildren( 
             <FormularioAsignarCurso
                 title = { "Editar Curso Alumno" }
                 onClose = { onClose }
                 dataUpdate = { data }
                 onEvent = { updateAsignarCursoAlumno }
             />
         );
 
         setShowModal(true);
 
     }
     const buttonActiveSet = () => {
         if(periodo === idPeriodo) {
             setButtonActive(true)
             return;
         }
         setButtonActive(false);
     }
 
     if(loading) {
         return <Loader />
     }
 
     return (
         <div className= "main">
             <h1 
                 className= "text-lg font-bold text-center mt-10"
             >Asignación de Alumnos</h1>
             <div className="buttonRegisterContainer">
                 {
                     
                         <button 
                             className="rounded-lg bg-lime-600 px-10 py-1 
                             text-gray-100 cursor-pointer hover:bg-line-800
                             mt-10"
                             onClick={handleClickRegister}
                         >
                             Asignar
                         </button>
                         
                 }
             </div>
             <AsignarCursoTable register={ register }  handleClickDelete = { handleClickDelete} handleClickUpdate = { handleClickUpdate} />
 
             { showModal && <Modal heightC = {heightC} widthC = { widthC } children = {children} />}
             
         </div>
     );
 }
 
 
 export { AsignarCursoAlumno };
 