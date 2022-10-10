import { useState } from 'react';


function FormRegister( { onClose, handleInsert } ) {

    const [file, setFile] = useState(null);

    return (
        <div>
            <div className='formCustom__container'>
                <label className='formCustom__label'>Foto</label>
                <input 
                    onChange={(e) => {
                        setFile(e.target.files[0]);
                    }}
                    type = "file" className='formCustom__input'
                />
            </div>
            <div className = "formCustom__container--button">
                <button

                    onClick={() => handleInsert({data: file})}
                    className = "formCustom__button"
                >Aceptar</button>
                <button
                    onClick={ onClose }
                    className = "formCustom__button formCustom__button--red"
                >Cancelar</button>
            </div>
        </div>
    )

}

export {
    FormRegister
}