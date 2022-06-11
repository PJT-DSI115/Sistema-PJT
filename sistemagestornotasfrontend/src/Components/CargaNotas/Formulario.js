import React, {useState} from "react";

function Formulario ({meses, idCargaAcademica, idLinea, onClose, onStore, messageLog, loading}) {

    const [dataForm, setDataForm] = useState({
        id_carga_academica: idCargaAcademica,
        id_linea_actividad: idLinea,
        id_curso_nivel_mes: "",
        nota: 0.00
    })

    function handleClick(){
        onStore(dataForm);
    }

    function handleChange(e){
        setDataForm({
            ...dataForm,
            [e.target.name]: e.target.value
        })
    }
    
    return(
        <form className="Form-notas">
            <h2 className="Form-title"></h2>
            <div className="Form-group">
                <select className="Form-select" name="id_curso_nivel_mes" onChange={handleChange}>
                    <option value="">Seleccione el mes</option>
                    {meses?(
                        meses.map(mes => (
                            <option key={mes.id} value={mes.id}>{mes.meses[0].nombre_mes}</option>
                        ))
                    ):""}
                </select>
            </div>
            <div className="Form-group">
                <input type="text" className="Form-input" name="nota" onChange={handleChange}/>
            </div>
            <div className="Form-group">
                <p className="errorMesage">{messageLog?messageLog:""}</p>
            </div>
            <div className="Form-group btn-group">
                <button type="button" className="Form-btn btn-gr" onClick={handleClick}>Guardar</button>
                <button type="button" className="Form-btn btn-can" onClick={onClose}>Cancelar</button>
            </div>
        </form>
    );

}

export {Formulario}