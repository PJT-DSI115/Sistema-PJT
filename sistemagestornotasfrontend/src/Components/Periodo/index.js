import { usePeriodo } from 'Hooks/usePeriodo';

import {useEffect} from 'react';
import { useNavigate } from 'react-router-dom'
import { useState } from 'react';
import { Formulario } from './formulario';
import Modal from 'Components/Modal';

import "./index.css";

function Periodo() {

    const { periodo, loading, errorPermission, 
		storePeriod, errorSave, setErrorSave } = usePeriodo();
	const [showModal, setShowModal] = useState(false);
    const navigate = useNavigate();

    useEffect(() => {
		console.log(errorSave, "error ");
        if(errorPermission) {
            navigate('/error403');
        }
    })

	const handleClick = () => {
		setShowModal(true);
	}

	const onClose = () => {
		setShowModal(false);
		setErrorSave(false);
	}

    return (
        <div className="main">
			{
				showModal ? <Modal onClose={onClose}>
					<Formulario onClose = {onClose}
						onStore = {storePeriod}
						errorSave = {errorSave}
					/>
					</Modal>: ""
			}
            <h1 
				className = "text-lg font-bold mt-10"
			>Periodos</h1>
            <div>
                <button 
                    className="rounded-lg bg-lime-600 px-10 py-1 
					text-gray-100 cursor-pointer hover:bg-line-800
					mt-10"
					onClick={handleClick}
                >
					Registrar
				</button>
            </div>
            <table 
				className= "table-custom"
			>
                <thead>
                    <tr>
                        <th>Codigo Periodo</th>
                        <th>Fecha Inicio Periodo</th>
                        <th>Fecha Fin Periodo</th>
						<th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    {
                        periodo.map( ({id, activo_periodo, 
                            codigo_periodo, fecha_inicio_periodo, 
                            fecha_fin_periodo}) => {
                            return (
                                <tr key = {id}>
                                    <th>{codigo_periodo}</th>
                                    <th>{fecha_inicio_periodo}</th>
                                    <th>{fecha_fin_periodo}</th>
									<th>
										<button>Editar</button>
									</th>
                                </tr>

                            );
                        })
                    }
                </tbody>
            </table>
        </div>
    );

}

export { Periodo };