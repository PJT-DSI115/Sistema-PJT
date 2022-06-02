function CursoTable({cursos, handleClickDelete, handleClickUpdate})
{

    /* function handleClickUpdate(index)
    {
        //
    }

    function handleClickDelete(index)
    {
        //
    } */

    return (
        <table 
            className= "table-custom text-sm text-left text-gray-500 dark:text-gray-400"
        >
        <thead
            className = "text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
            <tr>
                <th scope = "col" className = "px-6 py-3">Código de Curso</th>
                <th scope = "col" className = "px-6 py-3">Nombre del Curso</th>
                <th scope = "col" className = "px-6 py-3">Opciones</th>
            </tr>
        </thead>

        <tbody>
            {
                cursos.map( (curso) => {
                    return (
                        <tr key = {curso.id} 
                            className = "bg-white border-b dark:bg-gray-800 dark:border-gray-700 py-10"
                        >
                            <th 
                                scope = "row"
                                className = "px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                            >{curso.codigo_curso}</th>
                            <td className = "px-6 py-4">{curso.nombre_curso}</td>
                            <td className = "px-6 py-4">
                                        <button 
                                            className = "formCustom__button mx-2"
                                            onClick = {() => handleClickUpdate(curso.index)}
                                        >Editar
                                        </button> 

                                        <button 
                                            className = "formCustom__button formCustom__button--red"
                                            onClick = {() => handleClickDelete(curso.index)}
                                        >Eliminar
                                        </button>
                            </td>
                        </tr>

                    );
                })
            }
        </tbody>
    </table>
    );
}

export {CursoTable}