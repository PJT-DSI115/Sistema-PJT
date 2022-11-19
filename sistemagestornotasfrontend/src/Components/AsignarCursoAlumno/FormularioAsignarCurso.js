/**
 * @author RO Andrés
 */
 import { useState } from 'react';

 import { useParams } from 'react-router-dom';
 
 import { getAsignarCursoAlumno } from 'Service/CargaAcademicaService';
 import { useCargaAcademicaAlumno } from 'Hooks/useAsignarCursoAlumno';
 import example from 'assets/image/excel-ex.png';

 function FormularioAsignarCurso( { dataUpdate, onEvent, onClose, title } ) {
    //Variables del archivo.
    const [file,setFile] = useState(null);
    //Inicio del return.
    return (
        <div className='py-8'>
            <div className='formCustom__container'>
                <label className='text-sm text-center block'>Seleccione un archivo .xlsx o .xls. Debe cumplir con el siguiente formato:</label>
                <label className='text-xs text-center block'><b>id_categoria_alumno:</b> 1 ordinario ó 2 olimpico</label>
                <img src={example} className="px-3 py-8" />
                <input 
                    onChange={(e) => {
                        setFile(e.target.files[0]);
                    }}
                    type = "file"
                    className='block m-auto text-sm'
                    accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel,text/comma-separated-values, text/csv, application/csv"
                />
            </div>
            <div className = "formCustom__container--button">
                <button

                    onClick={() => onEvent({data: file})}
                    className = "formCustom__button"
                >Aceptar</button>
                <button
                    onClick={ onClose }
                    className = "formCustom__button formCustom__button--red"
                >Cancelar</button>
            </div>
        </div>
    )
    //  const { alumnosCursosAsignados } = useCargaAcademicaAlumno();
    //  const  { idPeriodo, idCursoNivel, idAlumno }  = useParams();
    //  const [cursoNivel, setCursoNivel] = useState( () =>  dataUpdate ? dataUpdate.idCursoNivel: "" );
    // //  const [rolDocente, setRolDocente] = useState( () => dataUpdate ? dataUpdate.rol: "");
 
    //  const [messageError, setMessageError] = useState("");
    //  const [loading, setLoading] = useState(false);
 
 
    //  const handleSubmit =  (e) => {
    //      setLoading(true);
    //      e.preventDefault();
    //      const data = {
    //          "idNivelCurso": idCursoNivel,
    //          "idPeriodo": idPeriodo,
    //         //  "rol": rolDocente,
    //          "idAlumno": idAlumno,
    //          "id": dataUpdate ? dataUpdate.id: ""
    //      }
    //      if(cursoNivel === "") {
    //      } else {
    //          onEvent({ data })
    //              .then(data => {
    //                  if(data.type === "Error") {
    //                      setMessageError(data.descripcion);
    //                      setLoading(false);
    //                  }
    //                  if(data.type === "Ok") {
    //                      setMessageError("");
    //                      setLoading(false);
    //                  }
    //              });
    //      }
    //  }
 
 
    //  const onChangeCursoNivelSelect = (e) => {
    //      setCursoNivel(e.target.value)
    //  }
 
    //  /* const onChangeDocente = (e) => {
    //      setDocente(e.target.value);
    //  } */
    //  //Formulario del Archivo.


    //  return (
 
    //      <form 
    //          className = "formCustom"
    //      >
    //          <h2 className = "formCustom__title">{ title }</h2>
    //          {/* <div className = "formCustom__container">
    //              <label className = "formCustom__label">Docente</label>
    //              <select value={docente} onChange = { onChangeDocente } className = "formCustom__input">
    //                  <option disabled value = "">--Selected--</option>
    //                  {
    //                     alumnosCursosAsignados.map( (docente) => (
    //                          <option value = { docente.id } key = {docente.id}> { docente.nombre_profesor }</option>
    //                      ))
    //                  }
    //              </select>
    //          </div> */}
    //          <div className = "formCustom__container">
    //              <label className = "formCustom__label">Curso Nivel</label>
    //              <select value = { idCursoNivel } onChange = {onChangeCursoNivelSelect} className = "formCustom__input">
    //                  <option disabled value = "">--Selected--</option>
    //                  {
    //                      alumnosCursosAsignados.map( (cursoNivel) => (
    //                          <option value = { cursoNivel.value } key = { cursoNivel.id }>{cursoNivel.nombre}</option>
    //                      ))
    //                  }
    //              </select>
    //          </div>
    //          <div>
    //              {
    //                  <>
    //                  <p className = "formCustom__error">{ messageError }</p>
    //                  </>
    //              }
    //          </div>
    //          <div className = "formCustom__container--button">
    //              <button
    //                  onClick={handleSubmit}
    //                  className = "formCustom__button"
    //              >
    //                  {
    //                      loading ? "Cargando...": "Aceptar"
    //                  }
    //              </button>
    //              <button
    //                  className = "formCustom__button formCustom__button--red"
    //                  onClick={onClose}
    //              >Cancelar</button>
    //          </div>
    //      </form>
    //  );
 }
 
 export { FormularioAsignarCurso }
 