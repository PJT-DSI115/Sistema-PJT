
function AlertMessage({ title, descripction, onClose, onEvent, dataUpdate }) {

    return (
        <div >
            <h2 className = "formCustom__title">{ title }</h2>
            <p className = "alertMessage">{ descripction }</p>
            
            <div className = "formCustom__container--button">
                <button 
                    onClick = { () => {
                            onEvent({ data: dataUpdate }) 
                            onClose()
                        }
                    }
                    className = "formCustom__button"
                >Aceptar</button>
                <button 
                    className = "formCustom__button formCustom__button--red"
                    onClick = { onClose }
                >
                    Cancelar
                </button>
            </div>

        </div>
    )
}

export {AlertMessage};
