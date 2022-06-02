
function PeriodTable({ periodo, handleClickDelete, handleClickUpdate }) {


    const handleClickTable = (e) => {

        if(e.target.getAttribute('op') === 'edit') {
            handleClickUpdate(e.target.getAttribute('index'));
        }
        if(e.target.getAttribute('op') === 'close'){

            handleClickDelete(e.target.getAttribute('index'))
        }
    }

    return (
        <table 
            onClick={handleClickTable}
            className= "table-custom text-sm text-left text-gray-500 dark:text-gray-400"
        >
        <thead
            className = "text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
            <tr>
                <th scope = "col" className = "px-6 py-3">Codigo Periodo</th>
                <th scope = "col" className = "px-6 py-3">Fecha Inicio Periodo</th>
                <th scope = "col" className = "px-6 py-3">Fecha Fin Periodo</th>
                <th scope = "col" className = "px-6 py-3">Accion</th>
            </tr>
        </thead>
        <tbody>
            {
                periodo.map( (periodo) => {
                    return (
                        <tr key = {periodo.id} 
                            className = "bg-white border-b dark:bg-gray-800 dark:border-gray-700 py-10"
                        >
                            <th 
                                scope = "row"
                                className = "px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                            >{periodo.codigo_periodo}</th>
                            <td className = "px-6 py-4">{periodo.fecha_inicio_periodo}</td>
                            <td className = "px-6 py-4">{periodo.fecha_fin_periodo}</td>
                            <td className = "px-6 py-4">
                                {
                                        periodo.activo_periodo ? 
                                        <>
                                        <button 
                                            op = "edit"
                                            index = { periodo.index }
                                            className = "formCustom__button mx-2"
                                        >Editar</button> 
                                        <button 
                                            index = { periodo.index }
                                            op = "close"
                                            className = "formCustom__button formCustom__button--red"
                                        >Cerrar</button> 
                                    </>
                                    : ""
                                }
                            </td>
                        </tr>

                    );
                })
            }
        </tbody>
    </table>
    );

}

export {PeriodTable};
