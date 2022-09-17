function FormRegister( { onClose, handleInsert } ) {

    return (
        <div>
            <div className='formCustom__container'>
                <label className='formCustom__label'>Foto</label>
                <input 
                    onChange={(e) => {
                    }}
                    type = "file" className='formCustom__input'
                />
            </div>
            <div className = "formCustom__container--button">
                <button

                    onClick={handleInsert}
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