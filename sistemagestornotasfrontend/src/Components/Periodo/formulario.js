import { useState } from 'react';

function Formulario({onClose, onStore, errorSave}) {
    const [dateStart, setDateStart]  = useState("");
    const [dateEnd, setDateEnd] = useState("");

    const handleChangeDateStart = (e) => {
        setDateStart(e.target.value);
    }

    const handleChangeDateEnd = (e) => {
        setDateEnd(e.target.value);
    }

    const handleSubmit = (e) => {
        e.preventDefault();
        const data = {
            "fechaInicio": dateStart,
            "fechaFin": dateEnd
        }
        onStore({data});
    }

    return (
        <form onSubmit={handleSubmit}>
            <h2>Registro Nuevo Periodo</h2>
            <div>
                <label>Fecha de Inicio</label>
                <input 
                    type= "date"
                    onChange={handleChangeDateStart}
                />
            </div>
            <div>
                <label>Fecha de Fin</label>
                <input 
                    type= "date"
                    onChange={handleChangeDateEnd}
                />
            </div>
            <div>
                <button
                >Aceptar</button>
                <button
                    onClick={onClose}
                >Cancelar</button>
                {errorSave ? "Ha ocurrido un error": ""}
            </div>
        </form>

    );

}

export { Formulario };