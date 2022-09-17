import { useEffect, useState, useContext } from 'react';
import { useParams } from 'react-router-dom';
import { getStudentById } from 'Service/StudentService';
import { getAllCategoriaAlumno } from 'Service/CategoriaAlumnoService';
import Context from 'Context/UserContext';
import { ENDPOINTIMAGE } from 'Config/EndPoint';

function DetailsStudent() {

    const { jwt } = useContext(Context);
    const [student, setStudent] = useState({});
    const {idStudent} = useParams();
    const [categorias, setCategorias] = useState([]);
    const [isEdit, setIsEdit] = useState(true);

    useEffect(() => {
        getStudentById({ jwt, id: idStudent }).then(response => response.json())
        .then(data => {
            console.log(data);
            setStudent(data);
        });
    }, [idStudent]);

    useEffect(() => {
        
        getAllCategoriaAlumno({ jwt }).then(response => response.json())
        .then(data => {
            console.log(data);
            setCategorias(data);
        })

    }, []);

    const handleAvaibleEdit = () => {
        setIsEdit(!isEdit);
    }

    return (
        <div className='main'>
            <h1 className='text-lg font-bold mt-10 user__title'>
                Detalles del estudiante {idStudent}
            </h1>
            <button onClick={ handleAvaibleEdit }>Editar</button>
            <form className='formCustom'>
                <div className='formCustom__container'>
                    <img src={
                        (student.photo_alumno || student.photo_alumno === null) ?
                        `${ENDPOINTIMAGE}/storage/avatar.png` :
                        `${ENDPOINTIMAGE}/${student.photo_alumno}`
                        } 
                        alt='foto' 
                    />

                </div>
                <div className='formCustom__container'>
                    <label 
                        className='formCustom__label'
                    >
                        Codigo Alumno
                    </label>
                    <input 
                        className='formCustom__input' 
                        type='text' 
                        value={student.codigo_alumno} 
                        disabled={isEdit}
                    />
                </div>
                <div className='formCustom__container'>
                    <label 
                        className='formCustom__label'
                    >
                        Nombre
                    </label>
                    <input 
                        className='formCustom__input' 
                        type='text' 
                        value={student.nombre_alumno} 
                        disabled={isEdit}
                        />
                </div>
                <div className='formCustom__container'>
                    <label 
                        className='formCustom__label'
                    >
                        Apellido
                    </label>
                    <input 
                        className='formCustom__input' 
                        type='text' 
                        value={student.apellido_alumno} 
                        disabled={isEdit}
                    />
                </div>
                <div className='formCustom__container'>
                    <label 
                        className='formCustom__label'
                    >
                        Nombre Encargado
                    </label>
                    <input 
                        className='formCustom__input' 
                        type='date' 
                        value={student.fecha_nacimiento_alumno} 
                        disabled={isEdit}
                    />
                </div>
                <div className='formCustom__container'>
                    <label 
                        className='formCustom__label'
                    >
                        Email
                    </label>
                    <input 
                        className='formCustom__input' 
                        type='text' 
                        value={student.email_alumno} 
                        disabled={isEdit}
                    />
                </div>
                <div className='formCustom__container'>
                    <label className='formCustom__label'>Categoria Alumno</label>
                    <select 
                        value = {student.id_categoria_alumno} 
                        className='formCustom__input'
                        disabled={isEdit}
                    >
                        <option disabled value = "">--Selected--</option>
                        {
                            categorias.map((categoria) => (
                                <option 
                                    value = {categoria.id}
                                >{categoria.nombre_categoria_alumno}</option>
                            ))
                        }
                    </select>
                </div>
                <div className='formCustom__container'>
                    <label 
                        className='formCustom__label'
                    >
                        Nombre Encargado
                    </label>
                    <input 
                        className='formCustom__input' 
                        type='text' 
                        value={student.nombre_encargado_alumno} 
                        disabled={isEdit}
                    />
                </div>
            </form>
        </div>
    )
}

export {
    DetailsStudent
}